<?php
/**
 * //                            _ooOoo_
 * //                           o8888888o
 * //                           88" . "88
 * //                           (| -_- |)
 * //                            O\ = /O
 * //                        ____/`---'\____
 * //                      .   ' \\| |// `.
 * //                       / \\||| : |||// \
 * //                     / _||||| -:- |||||- \
 * //                       | | \\\ - /// | |
 * //                     | \_| ''\---/'' | |
 * //                      \ .-\__ `-` ___/-. /
 * //                   ___`. .' /--.--\ `. . __
 * //                ."" '< `.___\_<|>_/___.' >'"".
 * //               | | : `- \`.;`\ _ /`;.`/ - ` : | |
 * //                 \ \ `-. \_ __\ /__ _/ .-` / /
 * //         ======`-.____`-.___\_____/___.-`____.-'======
 * //                            `=---='
 * //
 * //         .............................................
 * //                  佛祖保佑             永无BUG
 * DEC : 媒体model
 * User: wangwei
 * Time: 2018/1/11 下午2:56
 */

namespace media\classes\model;

use wulaphp\db\Table;

class Media extends Table {

	public function createRecord($data) {
		return $this->insert($data);
	}

	public function del($cond) {
		if (!is_array($cond)) {
			$where = ['id' => $cond];
		} else {
			$where = $cond;
		}

		return $this->update(['deleted' => 1], $where);
	}

	public function newFile($rst, $uid) {
		if ($rst['done']) {
			$url  = $rst['result']['url'];
			$name = $rst['result']['name'];
			$uid  = intval($uid);
			if ($url && !preg_match('#^(/|https?://).+#', $url)) {
				if (preg_match('/\.(gif|png|jpg|jpeg|ttf|bmp)$/i', $name)) {
					$data['type'] = 'image';
				} else if (preg_match('/\.(mp3|WAV)$/i', $name)) {
					$data['type'] = 'mp3';
				} else if (preg_match('/\.(mp4|avi)$/i', $name)) {
					$data['type'] = 'video';
				} else {
					$data['type'] = 'file';
				}
				$data['create_time'] = time();
				$data['uid']         = $uid;
				$data['filename']    = $name;
				$data['url']         = $url;
				$data['filepath']    = $rst['result']['path'];
				$data['size']        = intval($rst['result']['size']);
				$data['width']       = intval($rst['result']['width']);
				$data['height']      = intval($rst['result']['height']);
				try {
					return $this->insert($data);
				} catch (\Exception $e) {
				}
			}
		}

		return false;
	}
}