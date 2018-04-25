# 多媒体模块

给第三方模块提供文件上传服务,使用本模块上传的图片需要注意:
1. 在模板中需要通过`media`修改器输出文件链接.
2. 在代码里刚需要通过`the_media_src`获取文件链接.
3. 在js中可以通过`wulaui`的`media`函数获取文件链接.


## 文件上传器

通过不同的文件上传器可以将文件上传到不同的服务器。只需要实现`IUploader`接口，并通过`media\regUploaders`注册.

例如实现一个叫`MyUploader`的文件上传器:

**实现类**

```php
<?php
class MyUploader implements IUploader {
   /**
   	 * 上传文件.
   	 *
   	 * @param string $filepath 要上传的文件路径.
   	 * @param string $path     存储路径,如果是null则自系统自动生成.
   	 *
   	 * @return array array(url,name,path,width,height,size)
   	 *         <code>
   	 *         <ul>
   	 *         <li>url-相对URL路径</li>
   	 *         <li>name-文件名</li>
   	 *         <li>path-存储路径</li>
   	 *         </ul>
   	 *         </code>
   	 */
   	public function save($filepath, $path = null){
   	    //代码
   	}
   
   	/**
   	 * 返回错误信息.
   	 */
   	public function get_last_error(){
   	    //代码
   	}
   
   	/**
   	 * delete the file.
   	 *
   	 * @param string $file
   	 *            要删除的文件路径.
   	 *
   	 * @return boolean 成功返回true,反之返回false.
   	 */
   	public function delete($file){
   	   //代码
   	}
   
   	/**
   	 * 生成缩略图.
   	 *
   	 * @param string $file
   	 * @param int    $w
   	 * @param int    $h
   	 *
   	 * @return mixed
   	 */
   	public function thumbnail($file, $w, $h){
   	    //代码
   	}
   
   	/**
   	 * close connection if there is.
   	 */
   	public function close(){
   	    //代码
   	}
}
```

**注册**

```php
bind('media\regUploaders',function( $ups ){ 
    $ups['my']='我的文件上传器';
    return $ups; 
});
```

**设置**

在**系统 > 设置 > 媒体库设置**里选择『我的文件上传器』即可。

## 内置文件上传器

1. `LocaleUploader` 本地文件上传器，它将文件上传到当前服务器（无需配置）。
2. `FtpUploader`  FTP文件上传器，它将文件上传到FTP服务器，使用它之前，请配置以下参数:
    * path FTP端路径，可以没有
    * host FTP服务器主机, 默认是`localhost`
    * port FTP服务器端口，默认是25.
    * user FTP用户名,默认是ftp
    * password 用户密码,默认是空
    * timeout 超时
    * passive 被动模式，默认否
    
    
## 媒体服务器域名

当通过文件上传器将文件上传到不同服务器时，请设置**媒体服务器域名**，否则文件有可能不可访问哦。

## 自己控制文件上传

在你的控制器里使用`Plupload` Trasit，并完成相应的代码即可自行控制文件上传，
具体可以参考本模块的`InsControoler`、`UploadController`和`WatermarkController`三个控制器。