<?php

namespace media\controllers;

use backend\classes\IFramePageController;
use backend\form\Plupload;
use media\classes\model\Media;
use wulaphp\app\App;
use wulaphp\io\Ajax;
use wulaphp\validator\JQueryValidator;

/**
 * 默认控制器.
 * @acl m:media
 */
class IndexController extends IFramePageController {
	use JQueryValidator, Plupload;

	/**
	 * 默认控制方法.
	 */
	public function index() {
		return $this->render();
	}

	public function add() {
		//上传目录
		$max_upload = App::icfgn('max_upload@media', 20);
		$rst        = $this->upload(null, $max_upload * 1024 * 1000);

		if ($rst['done']) {
			$media_model = new Media();
			$media_model->newFile($rst, $this->passport->uid);

			return Ajax::reload('#core-admin-table', '文件上传成功');
		}

		return Ajax::error($rst['error']['message']);
	}

	//媒体表格数据
	public function data($type = '', $q = '', $count = '') {
		$model = new Media();
		$where = ['id >=' => 1];
		if ($type) {
			$where['type'] = $type;
		}
		if ($q) {
			$where1['filename LIKE'] = '%' . $q . '%';
			$where[]                 = $where1;
		}
		$where['deleted'] = 0;
		$query            = $model->select('*')->where($where)->page()->sort();
		$rows             = $query->toArray();
		$total            = '';
		if ($count) {
			$total = $query->total('id');
		}
		$data['items'] = $rows;
		$data['total'] = $total;

		return view($data);
	}

	//删除文件
	public function del($ids = '') {
		$ids = safe_ids2($ids);
		if ($ids) {
			if ($ids) {
				$media = new Media();
				$rst   = $media->del(['id IN' => $ids]);
				if ($rst) {
					return Ajax::reload('#core-admin-table', '所选文件已删除');
				} else {
					return Ajax::error('删除文件出错，请找系统管理员');
				}
			}
		}

		return Ajax::error('未指定文件');
	}
}