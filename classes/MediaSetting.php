<?php
/**
 * DEC : 媒体库设置
 * User: wangwei
 * Time: 2018/3/6 下午3:06
 */

namespace media\classes;

use backend\classes\Setting;
use backend\form\Plupload;
use media\classes\form\MediaSettingForm;
use wulaphp\app\App;

class MediaSetting extends Setting {
    public function getForm($group = '') {
        return new MediaSettingForm(true);
    }

    public function getName() {
        return '媒体库设置';
    }

    public function script($group = '') {
        $uploaders = Plupload::uploaders();
        $ups       = [];
        foreach ($uploaders as $id => $up) {
            $ups[ $id ] = $up->configHint();
        }

        return [
            'var uploaderHints = ' . json_encode($ups) . ';',
            App::getModule('media')->loadFile('views/setting.js')
        ];
    }
}