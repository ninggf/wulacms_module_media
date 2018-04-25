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

use backend\classes\IFramePageController;
use backend\form\Plupload;
use media\classes\model\Media;
use wulaphp\app\App;

/**
 * Class InsController
 * @package media\controllers
 * @acl     m:media
 */
class InsController extends IFramePageController {
	use Plupload;

	public function index() {
		$max_upload = App::icfgn('max_upload@media', 20);
		$rst        = $this->upload(null, $max_upload * 1024 * 1000);
		if (isset($rst['error'])) {
			return ['done' => 0];
		}
		if ($rst['done']) {
			$media_model = new Media();
			$media_model->newFile($rst, $this->passport->uid);
		}

		return $rst;
	}
}