<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:57:"D:\WWW\public/../application/admin\view\weblog\index.html";i:1501312786;s:56:"D:\WWW\public/../application/admin\view\public\left.html";i:1501404083;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>话梅管理系统</title>

    <!-- Bootstrap -->
    <link href="/static/admin/css/bootstrap.min.css" rel="stylesheet">
	<link href="/static/admin/css/online_products.css" rel="stylesheet">
	 <link rel="stylesheet" href="/static/admin/css/common.css"/>
	<link rel="stylesheet" type="text/css" href="/static/admin/webuploader/webuploader.css"><!-- 引用插件css -->
	<script src="/static/admin/js/jquery-1.12.4.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/static/admin/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/static/assets/css/amazeui.min.css" />
	<script type="text/javascript" src="/static/admin/webuploader/webuploader.js"></script>    <!-- 引用插件js -->

  </head>
  <body>
     <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
           <img src="/static//admin/img/logo.png" style="    margin-top: 1.4em;
    margin-left: 2em;">
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
          	<li><a href="#"><img src="/static/admin/img/nav_01.png"></a></li>
            <li><a href="#">用户名</a></li>
            <li><a href="#">|</a></li>
            <li><a href="#">退出</a></li>
          </ul>
         
        </div>
      </div>
    </nav>

    <div class="tpl-page-container tpl-page-header-fixed">

	 <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active">
            	<a class="tit" href="<?php echo url('home/index'); ?>"><img src="/static/admin/img/nav_02.png"> 首页<span class="sr-only">(current)</span></a>
            </li>
            <li><img src="/static/admin/img/nav_03.png"><a href="<?php echo url('Mcompany/index'); ?>">公司模块展示</a></li>
            <li><img src="/static/admin/img/nav_03.png"><a href="<?php echo url('Mproduct/index'); ?>">产品模块展示</a></li>
            <li><img src="/static/admin/img/nav_03.png"><a href="<?php echo url('Mrecruit/index'); ?>">招聘模块展示</a></li>
            <li class="add"><img src="/static/admin/img/nav_06.png"><a href="<?php echo url('add/index'); ?>">新增模块</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li class="active">
            	<img src="">
            	<a class="tit" href="#"><img src="/static/admin/img/nav_07.png">公司<span class="sr-only">(current)</span></a>
            </li>
            <li><a href="<?php echo url('company/index'); ?>">公司简介</a></li>
            <li><a href="<?php echo url('activity/allist'); ?>">活动</a></li>
            <li><a href="<?php echo url('Activityhead/index'); ?>">活动头部</a></li>
            <li class="add"><img src="/static/admin/img/nav_06.png"><a href="<?php echo url('add/index'); ?>">新增模块</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li class="active">
            	<a class="tit" href="#"><img src="/static/admin/img/nav_11.png">产品<span class="sr-only">(current)</span></a>
            </li>
            <li><a href="<?php echo url('hcity/index'); ?>">实体门店</a></li>
            <li><a href="<?php echo url('online/index'); ?>">线上产品</a></li>
            <li><a href="<?php echo url('show/index'); ?>">线下产品</a></li>
          </ul>
           <ul class="nav nav-sidebar">
            <li class="active">
            	<a class="tit" href="#"><img src="/static/admin/img/nav_13.png">招聘<span class="sr-only">(current)</span></a>
            </li>
            <li><a href="<?php echo url('Carousel/index'); ?>">基本展示</a></li>
            <li><a href="<?php echo url('recruit/index'); ?>">职位</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li class="active">
            	<a class="tit" href="#"><img src="/static/admin/img/nav_14.png">其他参数<span class="sr-only">(current)</span></a>
            </li>
            <li><a href="<?php echo url('index/index'); ?>">菜单功能</a></li>
            <li><a href="<?php echo url('search/index'); ?>">搜索功能</a></li>
            <li><a href="<?php echo url('friend/index'); ?>">友情链接</a></li>
            <li><a href="<?php echo url('guide/index'); ?>">引导页面</a></li>
            <li><a href="<?php echo url('background/index'); ?>">页面背景</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li class="active">
            	<a class="tit" href="#"><img src="/static/admin/img/nav_18.png">系统设置<span class="sr-only">(current)</span></a>
            </li>
            <li><a href="<?php echo url('role/index'); ?>">角色权限</a></li>
            <li><a href="<?php echo url('Weblog/index'); ?>">操作日志</a></li>
           <!--  <li><a href="<?php echo url('help/index'); ?>">技术帮助</a></li> -->
            <li><a href="<?php echo url('clear/index'); ?>">图片缓存清理</a></li>
            <li><a href="<?php echo url('admin/logout'); ?>">退出</a></li>
          </ul>
        </div>

         <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
           <div class="am-g">
                        <div class="am-u-sm-12">
                            <form class="am-form">
                                <table class="am-table am-table-striped am-table-hover table-main">
                                    <thead>
                                        <tr>
                                            <th class="table-check"><input type="checkbox" class="tpl-table-fz-check"></th>
                                            <th class="table-id">ID</th>
                                            <th class="table-title">标题</th>
                                            <th class="table-type">ip地址</th>
                                            <th class="table-author am-hide-sm-only">请求方式</th>
											 <th class="table-author am-hide-sm-only">模块</th>
                                            <th class="table-date am-hide-sm-only">节点</th>
                                            <th class="table-set">操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                        <tr>
                                            <td><input type="checkbox"></td>
                                            <td><?php echo $vo['id']; ?></td>
                                            <td><?php echo $vo['name']; ?></td>
                                       
											<td>
												<?php echo $vo['location']; ?>
											</td>
                                            <td>
                                       <?php echo $vo['method']; ?>
                                    </td><td class="am-hide-sm-only"><?php echo $vo['module']; ?></td>
                                            <td class="am-hide-sm-only"><?php echo $vo['controller']; ?>/<?php echo $vo['action']; ?></td>
                                            <td>
                                                <div class="am-btn-toolbar">
                                                    <div class="am-btn-group am-btn-group-xs">
                                                       <!--  <button class="am-btn am-btn-default am-btn-xs am-text-secondary"><span class="am-icon-pencil-square-o"></span><a href="<?php echo \think\Request::instance()->server('script_name'); ?>/index/activity/edit/id=<?php echo $vo['id']; ?>"> 编辑</a></button> -->
                                                        <!-- <button class="am-btn am-btn-default am-btn-xs am-hide-sm-only"><span class="am-icon-copy"></span> 复制</button> -->
                                                        <button class="am-btn am-btn-default am-btn-xs am-text-danger am-hide-sm-only"><span class="am-icon-trash-o"></span><a href="<?php echo \think\Request::instance()->server('script_name'); ?>/admin/weblog/delete/id=<?php echo $vo['id']; ?>"> 删除</a></button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
										
										<?php endforeach; endif; else: echo "" ;endif; ?>
                                    </tbody>
                                </table>
                                <div class="am-cf">

                                    <div class="am-fr">
                                     <!--    <ul class="am-pagination tpl-pagination">
                                            <li class="am-disabled"><a href="#">«</a></li>
                                            <li class="am-active"><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">4</a></li>
                                            <li><a href="#">5</a></li>
                                            <li><a href="#">»</a></li>
                                        </ul> -->
										<?php echo $list->render(); ?>
                                    </div>
                                </div>
                                <hr>

                            </form>
                        </div>

                    </div>

        </div>

    </div>


    <script src="/static/assets/js/jquery.min.js"></script>
    <script src="/static/assets/js/amazeui.min.js"></script>
    <script src="/static/assets/js/app.js"></script>
</body>

</html>