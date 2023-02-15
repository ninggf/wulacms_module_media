<?php
/*
 * This file is part of wulacms.
 *
 * (c) Leo Ning <windywany@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace media\classes;

use OSS\Core\OssException;
use OSS\OssClient;
use wulaphp\app\App;
use wulaphp\io\Uploader;

class AliOssUploader extends Uploader {
    /**
     * @var OssClient
     */
    private $ossClient = null;
    private $bucket    = null;

    public function __construct($config = null) {
        $rst = $this->configValidate($config);
        if ($rst !== true) {
            $this->error = $rst;
        }
    }

    public function getName():string {
        return '阿里云OSS';
    }

    public function save(string $filepath, ?string  $path = null) {
        if ($this->ossClient) {
            $pathinfo = pathinfo($filepath);
            $ext      = strtolower(strrchr($filepath, '.'));
            $object   = str_replace(['/', '=', '+'], '', base64_encode(md5_file($filepath, true))) . $ext;
            $objs []  = substr($object, 0, 2);
            $objs []  = substr($object, 2, 2);
            $objs []  = substr($object, 4);
            $object   = implode('/', $objs);
            try {
                $rst = $this->ossClient->uploadFile($this->bucket, $object, $filepath);
                if ($rst && isset($rst['oss-request-url']) && preg_match('#^https?://[^/]+/(.+)$#', $rst['oss-request-url'], $ms)) {
                    return ['url' => $ms[1], 'name' => $pathinfo ['basename'], 'path' => $object];
                } else {
                    $this->error = '无法上传文件到OSS';
                }
            } catch (\Exception $e) {
                $this->error = $e->getMessage();
            }
        }

        if ($this->error) {
            log_error($this->error, 'alioss');
        }

        return false;
    }

    public function delete($file) {
        if ($this->ossClient) {
            if (preg_match('#^https?://[^/]+/(.+)$#', $file, $ms)) {
                $file = $ms[1];
            }
            try {
                $rst = $this->ossClient->deleteObject($this->bucket, ltrim($file, '/'));
                if ($rst && isset($rst['oss-request-url'])) {
                    return true;
                } else {
                    $this->error = '无法删除OSS里的文件';
                }
            } catch (\Exception $e) {
                $this->error = $e->getMessage();
            }
        }
        if ($this->error) {
            log_error($this->error, 'alioss');
        }

        return false;
    }

    public function close() {
        if ($this->ossClient) {
            unset($this->ossClient);
        }

        return true;
    }

    public function configHint() {
        return 'bucket=存储空间&accessKeyId=AccessKeyID&accessKeySecret=AccessKeySecret&endpoint=接入域名';
    }

    public function configValidate($config = null) {
        try {
            if ($config) {
                $opts = str_replace(["\n", "\r"], ['&', ''], trim($config));
            } else {
                $opts = str_replace(["\n", "\r"], ['&', ''], trim(App::cfg('params@media', App::cfg('upload.alioss'))));
            }
            @parse_str($opts, $params);
            $accessKeyId     = aryget('accessKeyId', $params);
            $accessKeySecret = aryget('accessKeySecret', $params);
            $endpoint        = aryget('endpoint', $params);
            $this->bucket    = aryget('bucket', $params);
            if ($accessKeyId && $accessKeySecret && $endpoint && $this->bucket) {
                $this->ossClient = new OssClient($accessKeyId, $accessKeySecret, $endpoint);

                return true;
            } else {
                return '配置不正确';
            }
        } catch (OssException $e) {
            return $e->getMessage();
        }
    }

    protected function getDestDir($base = null) {
        $dir = App::icfg('dir@media', App::icfg('upload.dir', 1));
        switch ($dir) {
            case 0:
                $path = date('Y/');
                break;
            case 1:
                $path = date('Y/n/');
                break;
            default:
                $path = date('Y/n/d/');
        }
        if ($base) {
            $path = ltrim(trim($base, '/~') . '/' . $path, '/');
        }

        return $path;
    }
}
