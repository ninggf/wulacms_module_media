<?php
/**
 * DEC : 媒体库设置
 * User: wangwei
 * Time: 2018/3/6 下午3:06
 */

namespace media\classes;

use backend\classes\Setting;
use media\classes\form\MediaSettingForm;

class MediaSetting extends Setting {
	public function getForm($group = '') {
		return new MediaSettingForm(true);
	}

	public function getName() {
		return '媒体库设置';
	}


}