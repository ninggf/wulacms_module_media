<?php

namespace media;

use backend\classes\DashboardUI;
use media\classes\MediaSetting;
use wula\cms\CmfModule;
use wulaphp\app\App;

/**
 * 系统内核模块.
 *
 * @group cms
 */
class Media1Module extends CmfModule {
	public function getName() {
		return '媒体库';
	}

	public function getDescription() {
		return '为系统提供媒体库功能';
	}

	public function getHomePageURL() {
		return 'https://www.wulacms.com/modules/media';
	}

	public function getAuthor() {
		return 'David Wang';
	}

	public function getVersionList() {
		$v['1.0.0'] = '初始版本';

		return $v;
	}

	/**
	 * @param \backend\classes\DashboardUI $ui
	 *
	 * @bind dashboard\initUI
	 */
	public static function initUI(DashboardUI $ui) {
		$passport = whoami('admin');
		if ($passport->cando('m:site') && $passport->cando('m:media')) {
			$site              = $ui->getMenu('site', '我的网站', 1);
			$site->icon        = '&#xe617;';
			$menu              = $site->getMenu('media', '附件管理', 3);
			$menu->icon        = '&#xe60b;';
			$menu->data['url'] = App::url('media');
		}
	}

	/**
	 * @param \wulaphp\auth\AclResourceManager $manager
	 *
	 * @bind rbac\initAdminManager
	 */
	public static function initAcl($manager) {
		$manager->getResource('media', '媒体库', 'm');
	}

	/**
	 * @param $settings
	 *
	 * @return mixed
	 * @filter backend/settings
	 */
	public static function setting($settings) {
		$settings['media'] = new MediaSetting();

		return $settings;
	}

}

App::register(new Media1Module());