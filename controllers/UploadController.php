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
use wulaphp\app\App;

/**
 * Class UploadController
 * @package media\controllers
 * @acl     m:media
 */
class UploadController extends BackendController {
	use Plupload;

	public function index() {
		$maxSize = App::icfgn('max_upload@media', 20) * 1024 * 1000;
		$rst     = $this->upload(null, $maxSize);

		return $rst;
	}

	public function allowed($ext) {
		$allowed = App::cfg('upload_type@media', 'jpg,gif,png,bmp,jpeg,zip,rar,7z,tar,gz,bz2,doc,docx,txt,ppt,pptx,xls,xlsx,pdf,mp3,avi,mp4,flv,swf,apk');
		$allowed = explode(',', $allowed);

		return in_array(ltrim($ext, '.'), $allowed);
	}
}