<?php
/**
 * 多媒体模块引导文件.
 *
 * (c) Leo Ning <windywany@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace media;

use wula\cms\CmfModule;
use wulaphp\app\App;

class MediaModule extends CmfModule {
	public function getName() {
		return '多媒体';
	}

	public function getDescription() {
		return '多媒体文件的上传与管理';
	}

	public function getHomePageURL() {
		return 'https://www.wulacms.com/modules/media';
	}

	protected function getVersionList() {
		$v['1.0.0'] = '';

		return $v;
	}
}

App::register(new MediaModule());