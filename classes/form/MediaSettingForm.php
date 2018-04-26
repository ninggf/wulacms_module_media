<?php
/**
 * DEC : 媒体库表单
 * User: wangwei
 * Time: 2018/3/6 下午3:21
 */

namespace media\classes\form;

use backend\form\Plupload;
use wulaphp\form\FormTable;
use wulaphp\validator\JQueryValidator;

class MediaSettingForm extends FormTable {
	use JQueryValidator;
	public $table = null;

	/**
	 * 媒体服务器域名
	 * @var \backend\form\TextareaField
	 * @type string
	 * @note  多媒体显示域名,一行一个。
	 * @option {"row":3}
	 */
	public $media_domain;

	/**
	 * 存储路径
	 * @var \backend\form\TextField
	 * @type string
	 * @note   默认为files
	 * @layout 2,col-xs-4
	 * @option {"placeholder":"目录"}
	 */
	public $save_path;

	/**
	 * @var \backend\form\SelectField
	 * @type int
	 * @dataSource \wulaphp\form\providor\LineDataProvidor
	 * @dsCfg {"0":"按年","1":"按年/月","2":"按年/月/日"}
	 * @layout 2,col-xs-4
	 */
	public $dir = 1;
	/**
	 * @var \backend\form\TextField
	 * @type int
	 * @layout 2,col-xs-4
	 * @note   随机分组
	 */
	public $group_num = 0;

	/**
	 * 上传限制
	 * @var \backend\form\TextField
	 * @type int
	 * @layout 3,col-xs-2
	 * @note   文件尺寸
	 */
	public $max_upload = 20;

	/**
	 * 允许文件类型
	 * @var \backend\form\TextField
	 * @type string
	 * @layout 3,col-xs-10
	 * @note   扩展名
	 */
	public $upload_type = 'jpg,gif,png,jpeg,zip,doc,docx,txt,pdf,mp3,mp4';

	/**
	 * 添加水印
	 * @var \backend\form\RadioField
	 * @type int
	 * @see    param
	 * @data   0=否&1=是
	 * @option {"inline":1}
	 * @layout 5,col-xs-3
	 */
	public $enable_watermark = 0;
	/**
	 *
	 * @var \backend\form\TextField
	 * @type string
	 * @pattern (/^[\d]+x[\d]+$/) => 格式为:宽x高
	 * @layout 5,col-xs-3
	 * @note   最小添加尺寸(宽x高)
	 */
	public $watermark_min_size = '200x200';
	/**
	 * @var \backend\form\SelectField
	 * @type string
	 * @see    param
	 * @data   rd=随机&tl=左上(tl)&tm=上中(tm)&tr=右上(tr)&ml=左中(ml)&mm=居中(mm)&mr=右中(mr)&bl=右下(bl)&bm=下中(bm)&br=右下(br)
	 * @note   水印位置
	 * @layout 5,col-xs-3
	 */
	public $watermark_pos = 'bl';
	/**
	 *
	 * @var \backend\form\TextField
	 * @type string
	 * @pattern (/^[\d]+x[\d]+$/) => 格式为:水平距离x垂直距离
	 * @layout 5,col-xs-3
	 * @note   随机偏移
	 */
	public $transxy = '150x150';

	/**
	 * 水印图片(只能是png哦)
	 * @var \backend\form\FileUploaderField
	 * @type string
	 * @option {"width":120,"height":60,"auto":1,"maxFileSize":"10kb","noWater":1,"exts":"png","url":"media/watermark","local":1}
	 * @layout 6,col-xs-6
	 */
	public $watermark;
	/**
	 * 补齐图片的ALT
	 * @var \backend\form\RadioField
	 * @type int
	 * @see    param
	 * @data   0=否&1=是
	 * @option {"inline":1}
	 * @layout 7,col-xs-6
	 */
	public $title_alt = 0;
	/**
	 * 文件上传器
	 * @var \backend\form\SelectField
	 * @type string
	 * @dsCfg ::uploaders
	 * @required
	 * @layout 8,col-xs-3
	 */
	public $default_uploader = 'file';
	/**
	 * 文件上传器配置
	 * @var \backend\form\TextField
	 * @type string
	 * @layout 9,col-xs-12
	 * @note   上传器参数配置，请参数具体上传器说明.
	 */
	public $params;

	public function uploaders() {
		$uploaders = Plupload::uploaders();
		$up        = [];
		foreach ($uploaders as $id => $u) {
			$up[ $id ] = $u->getName();
		}

		return $up;
	}
}