<?php

namespace media;

use wula\cms\CmfModule;
use wulaphp\app\App;
use backend\classes\DashboardUI;

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
		if ($passport->cando('m:media')) {
			$menu       = $ui->getMenu('media', '媒体库');
			$menu->icon = '&#xe60b;';
			if ($passport->cando('m:media')) {
				$list              = $menu->getMenu('index', '媒体');
				$list->icon        = '&#xe60b;';
				$list->data['url'] = App::url('media/index');
			}
		}
	}

	/**
	 * @param \wulaphp\auth\AclResourceManager $manager
	 *
	 * @bind rbac\initAdminManager
	 */
	public static function initAcl($manager) {
		$acl = $manager->getResource('media', '媒体库', 'm');
		$acl->addOperate('index', '媒体');
	}

}

App::register(new Media1Module());
