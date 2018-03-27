<?php

namespace media\classes;

/**
 * 通过multipart/form-data上传的文件.
 * @author Guangfeng
 *
 */
class UploadedFile {
	private $file;
	private $maxSize = 0;
	private $exts;
	private $error   = null;

	/**
	 * UploadedFile constructor.
	 *
	 * @param string|array $name 参数名或上传的文件数组.
	 * @param array        $ext  扩展名列表.
	 * @param int          $max  最大上传尺寸.
	 */
	public function __construct($name, $ext = [], $max = 0) {
		if (is_array($name)) {
			$this->file = $name;
		} else if (isset($_FILES[ $name ])) {
			$this->file = $_FILES[ $name ];
		} else {
			$this->file = null;
		}
		$this->exts    = $ext;
		$this->maxSize = abs($max);
	}

	/**
	 * 上传出错信息.
	 *
	 * @return string
	 */
	public function last_error() {
		return $this->error;
	}

	/**
	 * 保存上传的文件.
	 *
	 * @param string $destdir  目录.
	 * @param null   $fileName 文件名(不包括扩展名).
	 * @param bool   $random   是否随机生成文件名.
	 *
	 * @return bool|string 保存成功返回文件路径,失败返回false。
	 */
	public function save($destdir, $fileName = null, $random = false) {
		if (!$this->file) {
			return false;
		}
		if (isset ($this->file ['error']) && $this->file['error']) {
			switch ($this->file ['error']) {
				case '1' :
					$error = '超过php.ini允许的大小。';
					break;
				case '2' :
					$error = '超过表单允许的大小。';
					break;
				case '3' :
					$error = '图片只有部分被上传。';
					break;
				case '4' :
					$error = '请选择图片。';
					break;
				case '6' :
					$error = '找不到临时目录。';
					break;
				case '7' :
					$error = '写文件到硬盘出错。';
					break;
				case '8' :
					$error = 'File upload stopped by extension。';
					break;
				case '999' :
				default :
					$error = '未知错误。';
			}
			$this->error = $error;

			return false;
		} else if (isset ($this->file ['tmp_name']) && is_uploaded_file($this->file ['tmp_name'])) {
			$file     = $this->file;
			$name     = $file ['name'];
			$size     = $file ['size'];
			$tmp_file = $file ['tmp_name'];
			if ($this->maxSize && $size > $this->maxSize) {
				$this->error = '文件太大啦，已经超出系统允许的最大值.';

				return false;
			}
			$name   = thefilename($name);
			$fName  = preg_replace('/[^\w\._]+/', '-', $name);
			$filext = strtolower(strrchr($fName, '.'));
			if ($this->exts && !in_array($filext, $this->exts)) {
				$this->error = '不支持的扩展名';

				return false;
			}
			if ($random) {
				$fName = rand_str(5, "a-z,0-9") . $filext;
			} else if (!$fileName) {
				$fName = thefilename($fileName) . $filext;
			}
			if (!is_dir($destdir) && !mkdir($destdir, 0755, true)) {
				$this->error = '无法创建目标目录';

				return false;
			}
			$fName    = unique_filename($destdir, $fName);
			$destfile = trailingslashit($destdir) . $fName;
			if (@move_uploaded_file($tmp_file, $destfile)) {
				return $destfile;
			} else {
				$this->error = '无法移动文件';

				return false;
			}
		}
		$this->error = '非法的上传文件';

		return false;
	}
}