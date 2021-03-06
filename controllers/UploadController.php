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
use media\classes\model\Media;
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
		if ($rst['done']) {
			$media_model = new Media();
			$media_model->newFile($rst, $this->passport->uid);
		}

		return $rst;
	}
}