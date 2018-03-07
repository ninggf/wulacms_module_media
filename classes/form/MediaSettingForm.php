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
	 * 存储路径
	 * @var \backend\form\TextField
	 * @type string
	 * @note   不填写时使用默认值：files，当接入多媒体服务器时此设置无效.
	 */
	public $save_path;

	/**
	 * 存储目录
	 * @var \backend\form\SelectField
	 * @type int
	 * @note 不填写时使用默认值：按月存储，当接入多媒体服务器时此设置无效.
	 * @dataSource \wulaphp\form\providor\LineDataProvidor
	 * @dsCfg {"0":"按年","1":"按月","2":"按日"}
	 */
	public $dir = 1;

	/**
	 * 分组数
	 * @var \backend\form\TextField
	 * @type int
	 * @note   将文件随机分配到设定的组内存储.
	 */
	public $group_num=0;

	/**
	 * 最大上传文件大小(单位M)
	 * @var \backend\form\TextField
	 * @type int
	 */
	public $max_upload = 20;

	/**
	 * 允许文件类型
	 * @var \backend\form\TextField
	 * @type string
	 */
	public $upload_type = 'jpg,gif,png,bmp,jpeg,zip,rar,7z,tar,gz,bz2,doc,docx,txt,ppt,pptx,xls,xlsx,pdf,mp3,avi,mp4,flv,swf,apk';

}