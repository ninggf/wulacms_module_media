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

	public function create($data) {
		return $this->insert($data);
	}

	public function del($cond){
		if(!is_array($cond)){
			$where = ['id'=>$cond];
		}else{
			$where = $cond;
		}
		return $this->update(['deleted'=>1],$where);
	}
}