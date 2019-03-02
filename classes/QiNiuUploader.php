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

use wulaphp\io\Uploader;

class QiNiuUploader extends Uploader {
    public function __construct() {

    }

    public function getName() {
        return '七牛云存储';
    }

    public function save($filepath, $path = null) {

    }

    public function delete($file) {

    }

    public function close() {
        return parent::close();
    }

    public function configHint() {
        return parent::configHint();
    }

    public function configValidate($config) {
        return true;
    }
}