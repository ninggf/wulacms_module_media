<?php
/*
 * This file is part of wulacms.
 *
 * (c) Leo Ning <windywany@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace media\controllers;

use backend\classes\BackendController;
use backend\form\Plupload;
use wulaphp\io\LocaleUploader;

/**
 * 上传水印图片
 * @package media\controllers
 * @acl     m:media
 */
class WatermarkController extends BackendController {
	use Plupload;

	public function index() {
		$maxSize = 100000;
		$rst     = $this->upload('~watermark', $maxSize, true, new LocaleUploader(null, 'water'));

		return $rst;
	}

	public function allowed($ext) {
		$allowed = ['png'];

		return in_array(ltrim($ext, '.'), $allowed);
	}

	/**
	 * 不添加水印
	 * @return null
	 */
	protected function watermark() {
		return null;
	}
}