<section class="hbox stretch wulaui" id="core-account-workset">
    <aside class="aside aside-md b-r">
        <section class="vbox">
            <header class="header bg-light b-b">
                <button class="btn btn-icon btn-default btn-sm pull-right visible-xs m-r-xs" data-toggle="class:show"
                        data-target="#core-role-wrap">
                    <i class="fa fa-reorder"></i>
                </button>
                <p class="h4">媒体库</p>
            </header>
            <section class="hidden-xs scrollable w-f m-t-xs" id="core-role-wrap">
                <div id="core-role-list"  data-loading="#core-role-list">
                    <div class="wulaui">

                            <ul class="nav nav-pills nav-stacked no-radius" data-pop-menu="#core-role-pop-menu">
                                <li class="active" data-type="">
                                    <a href="javascript:void(0);" class="role-li">全部</a>
                                </li>
                                <li class="" data-type="image">
                                    <a href="javascript:void(0);" class="role-li">图片</a>
                                </li>
                                <li class="" data-type="video">
                                    <a href="javascript:void(0);" class="role-li">视频</a>
                                </li>
                                <li class="" data-type="mp3">
                                    <a href="javascript:void(0);" class="role-li">音频</a>
                                </li>
                            </ul>


                    </div>
                </div>
            </section>

        </section>
    </aside>

    <section>

        <section class="hbox stretch">

            <aside class="aside b-r" id="admin-grid" data-load="{'system/account/users/grid'|app}">
                <section class="vbox wulaui" id="core-users-workset">
                    <header class="bg-light header b-b clearfix">
                        <div class="row m-t-sm">
                            <div class="col-sm-6 m-b-xs">
                                <a class="btn btn-sm btn-success edit-admin"
                                    data-title="新的管理员" id="upload">
                                    <i class="layui-icon" style="font-size: 12px; color: #1E9FFF;">&#xe681;</i> 上传
                                </a>
                                <div class="btn-group">
                                    <a href="{'media/del'|app}" data-ajax data-grp="#core-admin-table tbody input.grp:checked"
                                       data-confirm="你真的要删除这些文件吗？" data-warn="请选择要删除的文件" class="btn btn-danger btn-sm"><i
                                                class="fa fa-trash"></i> 删除</a>
                                </div>
                            </div>
                            <div class="col-sm-5 m-b-xs text-right">
                                <form data-table-form="#core-admin-table" class="form-inline">
                                    <input type="hidden" id="admin-role-id" name="type" value=""/>
                                    <div class="input-group input-group-sm">
                                        <input type="text" name="q" class="input-sm form-control" placeholder="{'Search'|t}"/>
                                        <span class="input-group-btn">
                            <button class="btn btn-sm btn-info" id="btn-do-search" type="submit">Go!</button>
                        </span>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-1 m-b-xs text-right">
                            <a id="tog" href="#aside" data-toggle="class:show" class="btn btn-sm btn-success edit-admin"><i class="fa fa-mail-forward (alias)" ></i></a>
                            </div>
                        </div>
                    </header>
                    <section class="w-f bg-white">
                        <div class="table-responsive">
                            <table id="core-admin-table" data-auto data-table="{'media/data'|app}" data-sort="id,d"
                                   style="min-width: 800px">
                                <thead>
                                <tr>
                                    <th width="20">
                                        <input type="checkbox" class="grp"/>
                                    </th>
                                    <th width="160" data-sort="id,d">ID</th>
                                    <th width="160">展示</th>
                                    <th width="200" data-sort="filename,a">文件名</th>
                                    <th width="200" data-sort="type,a">URL</th>

                                </tr>
                                </thead>
                            </table>
                        </div>
                    </section>
                    <footer class="footer b-t">
                        <div data-table-pager="#core-admin-table"></div>
                    </footer>
                </section>
            </aside>
            <aside class="aside hidden" id="acl-space"></aside>
        </section>
    </section>
    <aside class="aside-lg bg-white b-l hide" id="aside">
        <section class="vbox stretch" >
            <div class="layui-fluid"  id="flu" style="display: none;">
                <div class="layui-col-md12">
                   <img src="" id="preview">
                </div>

                <section class="panel panel-default" style="padding-top: 20px;">
                    <h4 class="font-thin padder">About This</h4>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <p>Size </p>
                            <small class="block text-muted" ><i class="fa fa-folder"></i> <i id="size"></i></small>
                        </li>
                        <li class="list-group-item">
                            <p>Width</p>
                            <small class="block text-muted"><i class="fa  fa-text-width"></i> <i id="width"></i></small>
                        </li>
                        <li class="list-group-item">
                            <p> Height </p>
                            <small class="block text-muted"><i class="fa  fa-text-height"></i> <i id="height"></i></small>
                        </li>
                        <li class="list-group-item">
                            <p> Preview </p>
                            <small class="block text-muted"><i class="fa  fa-eye"></i> <a href="" id="pre" target="_blank">click me!</a></small>
                        </li>
                    </ul>
                </section>

            </div>

        </section>
    </aside>
</section>

<script>
	layui.use(['jquery', 'layer','upload', 'wulaui'], ($, layer) => {
	//菜单处理
	$('#core-account-workset').on('click', 'a.role-li', function () { //分角色查看用户
		var me = $(this), mp = me.closest('li'), type = mp.data('type'), group = me.closest('ul');
		if (mp.hasClass('active')) {
			return;
		}
		group.find('li').not(mp).removeClass('active');
		mp.addClass('active');
		$('#admin-role-id').val(type ? type : '');
		$('[data-table-form="#core-admin-table"]').submit();
		return false;
	}).on('click','tr',function () {
          var url_path = $(this).data('url');
          var size = $(this).data('size');
          var width = $(this).data('width');
          var height = $(this).data('height');
          if(url_path) {
			  $('#flu').show();
			  $('#preview').attr('src', '/' + url_path);
			  $('#pre').attr('href', '/' + url_path);
			  $('#size').text(size / 1000 + 'k');
			  $('#width').text(width + 'px');
			  $('#height').text(height + 'px');
		  }
        }).on('click','#tog',function () {
            var left = $('#tog').find('i').hasClass('fa fa-mail-forward (alias)');
            if(left){
                $('#tog').find('i').removeClass('fa fa-mail-forward (alias)');
                $('#tog').find('i').addClass('fa fa-mail-reply (alias)');
            }else {
                $('#tog').find('i').removeClass('fa fa-mail-reply (alias)');
                $('#tog').find('i').addClass('fa fa-mail-forward (alias)');
            }
	});
	var upload = layui.upload;

	//执行实例
	var uploadInst = upload.render({
		elem: '#upload' //绑定元素
		,url: '/media/add' //上传接口
		,done: function(res){
			//上传完毕回调
            console.log(res);
            if(res.done==1){
            	layer.msg('文件上传成功');
			}
		},accept:'file'
		 ,multiple:true
		,error: function(){
			//请求异常回调
		}
	});

	})
</script>