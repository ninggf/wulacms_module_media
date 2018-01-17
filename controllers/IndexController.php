<?php

namespace media\controllers;

use backend\classes\IFramePageController;
use backend\form\Plupload;
use media\classes\model\Media;
use wulaphp\io\Ajax;
use wulaphp\mvc\controller\Controller;
use wulaphp\mvc\view\JsonView;
use wulaphp\validator\JQueryValidator;

/**
 * 默认控制器.
 */
class IndexController extends IFramePageController {
	use JQueryValidator, Plupload;

	/**
	 * 默认控制方法.
	 */
	public function index() {
		$data = ['module' => 'Index'];

		// 你的代码写在这里

		return $this->render($data);
	}

	public function add() {
		$rst = $this->upload(null, 512000);
		if (isset($rst['error']) && $rst['error']['code'] == 422) {
			return new JsonView($rst, [], 422);
		}
		if ($rst['done']) {
			$url  = $rst['result']['url'];
			$name = $rst['result']['name'];
			$uid  = $this->passport->uid;
			if ($url && !preg_match('#^(/|https?://).+#', $url)) {
				if (preg_match('/(.gif|.png|.jpg|.jpeg)/', $name)) {
					$data['type'] = 'image';
				}
				if (preg_match('/(.mp3|.WAV)/', $name)) {
					$data['type'] = 'mp3';
				}
				if (preg_match('/(.mp4|.avi)/', $name)) {
					$data['type'] = 'video';
				}
				$data['uid']      = $uid;
				$data['filename'] = $name;
				$data['url']      = $url;
				$data['filepath'] = $rst['result']['path'];
				$data['size']     = $rst['result']['size'];
				$data['width']    = $rst['result']['width'];
				$data['height']   = $rst['result']['height'];
				$media_model      = new Media();
				$re               = $media_model->create($data);
				if ($re) {
					return Ajax::reload('#core-admin-table', '文件上传成功');
				}

			}
		}

		return $rst;
	}

	//媒体表格数据
	public function data($type = '', $q = '', $count = '', $pager, $sort) {

		$page      = $pager['page'];
		$page_size = $pager['size'];
		$model     = new Media();
		$where     = ['id >=' => 1];
		if ($type) {
			$where['type'] = $type;
		}
		if ($q) {
			$where1['filename LIKE'] = '%' . $q . '%';
			$where[]                 = $where1;
		}
		$where['deleted'] = 0;
		$query            = $model->select('*')->where($where)->limit(($page - 1) * $page_size, $page_size)->sort($sort['name'], $sort['dir']);
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