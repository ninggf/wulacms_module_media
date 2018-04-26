<section class="hbox stretch wulaui" id="core-account-workset">
    <aside class="aside aside-sm b-r">
        <section class="vbox">
            <header class="header bg-light b-b">
                <button class="btn btn-icon btn-default btn-sm pull-right visible-xs m-r-xs" data-toggle="class:show"
                        data-target="#core-role-wrap">
                    <i class="fa fa-reorder"></i>
                </button>
                <p class="h4">媒体库</p>
            </header>
            <section class="hidden-xs scrollable w-f m-t-xs">
                <div id="core-role-list">
                    <div class="wulaui">
                        <ul class="nav nav-pills nav-stacked no-radius">
                            <li class="active" data-type="">
                                <a href="javascript:" class="role-li">全部</a>
                            </li>
                            <li class="" data-type="image">
                                <a href="javascript:" class="role-li">图片</a>
                            </li>
                            <li class="" data-type="video">
                                <a href="javascript:" class="role-li">视频</a>
                            </li>
                            <li class="" data-type="mp3">
                                <a href="javascript:" class="role-li">音频</a>
                            </li>
                            <li class="" data-type="file">
                                <a href="javascript:" class="role-li">文件</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
        </section>
    </aside>

    <section>
        <section class="hbox stretch">
            <aside class="aside b-r" id="admin-grid">
                <section class="vbox wulaui" id="core-users-workset">
                    <header class="bg-light header b-b clearfix">
                        <div class="row m-t-sm">
                            <div class="col-sm-6 m-b-xs">
                                <a class="btn btn-sm btn-success edit-admin" id="upload">
                                    <i class="fa fa-cloud-upload"></i> 上传
                                </a>
                                <div class="btn-group">
                                    <a href="{'media/del'|app}" data-ajax
                                       data-grp="#core-admin-table tbody input.grp:checked" data-confirm="你真的要删除这些文件吗？"
                                       data-warn="请选择要删除的文件" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>
                                        删除</a>
                                </div>
                            </div>
                            <div class="col-sm-5 m-b-xs text-right">
                                <form data-table-form="#core-admin-table" class="form-inline">
                                    <input type="hidden" id="admin-role-id" name="type" value=""/>
                                    <div class="input-group input-group-sm">
                                        <input type="text" name="q" class="input-sm form-control"
                                               placeholder="{'Search'|t}"/>
                                        <p class="input-group-btn">
                                            <button class="btn btn-sm btn-info" id="btn-do-search" type="submit">Go!
                                            </button>
                                        </p>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-1 m-b-xs text-right">
                                <a href="#aside" data-toggle="class:hidden" class="btn btn-sm btn-default active">
                                    <span class="text">
                                        <i class="fa fa-angle-double-left"></i>
                                    </span>
                                    <span class="text-active">
                                        <i class="fa fa-angle-double-right"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </header>
                    <section class="w-f bg-white">
                        <div class="table-responsive">
                            <table id="core-admin-table" data-auto data-table="{'media/data'|app}" data-sort="id,d"
                                   style="min-width: 600px">
                                <thead>
                                <tr>
                                    <th width="30">
                                        <input type="checkbox" class="grp"/>
                                    </th>
                                    <th width="80" data-sort="id,d">ID</th>
                                    <th width="60" data-sort="type,a">类型</th>
                                    <th data-sort="filename,a">文件名</th>
                                    <th width="120" data-sort="size,a">文件大小</th>
                                    <th width="150">上传时间</th>
                                    <th width="30"></th>
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
    <aside class="aside-lg bg-white" id="aside">
        <div class="layui-fluid p-t-md" id="flu">
            <section class="panel panel-default p-t-md">
                <h4 class="font-thin padder">文件信息</h4>
                <ul class="list-group">
                    <li class="list-group-item">
                        <p>文件名 </p>
                        <small class="block text-muted">
                            <i class="fa fa-folder"></i> <i id="name"></i>
                        </small>
                    </li>
                    <li class="list-group-item">
                        <p>大小 </p>
                        <small class="block text-muted">
                            <i class="fa fa-folder"></i> <i id="size"></i>
                        </small>
                    </li>
                    <li class="list-group-item">
                        <p>尺寸</p>
                        <small class="block text-muted">
                            <i id="width"></i>
                        </small>
                    </li>
                    <li class="list-group-item">
                        <p>预览</p>
                        <a href="" id="pre" target="_blank">
                            <img src="{'s.gif'|assets}" id="preview" style="max-width: 188px;height: auto;"/>
                        </a>
                        <small class="block text-muted m-t-sm">
                            <i class="fa fa-eye"></i>
                            <a href="javascript:" id="prex" target="_blank">复制链接</a>
                        </small>
                    </li>
                </ul>
            </section>
        </div>
    </aside>
</section>

<script>
	layui.use(['jquery', 'layer', 'upload', 'wulaui', 'clipboard'], ($, l, up, wui, cp) => {
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
		}).on('click', 'td i,tr', function () {
			if ($('#aside').hasClass('hidden')) {
				return;
			}
			var tr       = $(this).closest('tr'),
				type     = tr.data('type'),
				url_path = tr.data('url'),
				size     = tr.data('size'),
				width    = tr.data('width'),
				height   = tr.data('height');
			if (url_path) {
				if (type === 'image') {
					$('#pre').show();
					$('#preview').attr('src', url_path);
				} else {
					$('#pre').hide();
				}
				$('#pre').attr('href', url_path).attr('title', url_path);
				$('#name').text(tr.find('.name').text());
				$('#size').text(size / 1000 + 'k');
				$('#width').text(width + 'px X ' + height + 'px');
			}
		}).on('click', '#prex', function () {
			var code = $('#pre').attr('href');
			cp.copy({
				"text/plain": code
			}).then(function () {
				wui.toast.success('链接已复制');
			}, function () {
				wui.toast.error('无法复制链接,请手工复制吧');
			});
		});
		//执行实例
		layui.upload.render({
			elem      : '#upload' //绑定元素
			, url     : wui.app('media/add') //上传接口
			, accept  : 'file'
			, multiple: true
		});
	})
</script>