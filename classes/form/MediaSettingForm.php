<?php
/**
 * DEC : 媒体库表单
 * User: wangwei
 * Time: 2018/3/6 下午3:21
 */

namespace media\classes\form;

use wulaphp\form\FormTable;
use wulaphp\validator\JQueryValidator;

class MediaSettingForm extends FormTable {
	use JQueryValidator;
	public $table = null;

	/**
	 * 媒体域名
	 * @var \backend\form\TextareaField
	 * @type string
	 * @note  多媒体显示域名,一行一个。
	 * @option {"row":6}
	 */
	public $media_domain;

	/**
	 * 存储
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
	 * 最大上传尺寸(单位M)
	 * @var \backend\form\TextField
	 * @type int
	 * @layout 3,col-xs-4
	 */
	public $max_upload = 20;

	/**
	 * 允许文件类型
	 * @var \backend\form\TextField
	 * @type string
	 * @layout 4,col-xs-12
	 */
	public $upload_type = 'jpg,gif,png,bmp,jpeg,zip,rar,7z,tar,gz,bz2,doc,docx,txt,ppt,pptx,xls,xlsx,pdf,mp3,avi,mp4,flv,swf,apk';

}