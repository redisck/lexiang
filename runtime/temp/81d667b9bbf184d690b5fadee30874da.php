<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:55:"D:\WWW\public/../application/admin\view\role\index.html";i:1501228029;s:56:"D:\WWW\public/../application/admin\view\public\head.html";i:1501312762;s:56:"D:\WWW\public/../application/admin\view\public\left.html";i:1501404083;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>话梅</title>

    <!-- Bootstrap -->
    <link href="/static/admin/css/bootstrap.min.css" rel="stylesheet">
	<link href="/static/admin/css/background.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/static/admin/webuploader/webuploader.css"><!-- 引用插件css -->
		<script src="/static/admin/js/jquery-1.12.4.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/static/admin/js/bootstrap.min.js"></script>
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

<link rel="stylesheet" type="text/css" href="/static/assets/css/amazeui.min.css" />
	<link rel="stylesheet" type="text/css" href="/static/assets/css/app.css" />

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



        <div class="tpl-content-wrapper">
          
            <div class="tpl-portlet-components">
           
                <div class="tpl-block ">

                    <div class="am-g tpl-amazeui-form">


                        <div class="am-u-sm-12 am-u-md-9">
                            <form class="am-form am-form-horizontal" action="<?php echo url('role/add'); ?>" enctype="multipart/form-data" method="post">
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">姓名 / Name</label>
                                    <div class="am-u-sm-9">
										 <input type="text" id="user-name" placeholder="姓名 / Name" name="name" value="">
                                        <small>输入角色名字。</small>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">邮箱 / Email</label>
                                    <div class="am-u-sm-9">
                                         <input type="text" id="user-name" placeholder="邮箱 / Email" name="email" value="">
                                        <small>输入邮箱。</small>
                                    </div>
                                </div>
                                <div class="am-form-group">
                                    <label for="user-name" class="am-u-sm-3 am-form-label">密码 / Passwd</label>
                                    <div class="am-u-sm-9">
                                         <input type="password" id="user-name" placeholder="密码 / Passwd" name="passwd" value="">
                                        <small>输入密码。</small>
                                    </div>
                                </div>
                 
                                <div class="am-form-group">
                                    <label for="user-phone" class="am-u-sm-3 am-form-label">商品 / Goods</label>
                                    <div class="am-u-sm-9">
                                      <div class="am-form-group">
									
										  <label class="am-checkbox-inline">
											<input type="checkbox"  value="Goods_add" name="goods[]" data-am-ucheck> 添加
										  </label>
										  <label class="am-checkbox-inline">
											<input type="checkbox"  value="Goods_edit" name="goods[]" data-am-ucheck> 编辑
										  </label>
										  <label class="am-checkbox-inline">
											<input type="checkbox"  value="Goods_del" name="goods[]" data-am-ucheck> 删除
										  </label>
										  	  <label class="am-checkbox-inline">
											<input type="checkbox"  value="Goods_index" name="goods[]" data-am-ucheck> 列表
										  </label>
										</div>
                                    </div>
                                </div>
								
								 <div class="am-form-group">
                                    <label for="user-phone" class="am-u-sm-3 am-form-label">公司 / Company</label>
                                    <div class="am-u-sm-9">
                                      <div class="am-form-group">
										 
										  <label class="am-checkbox-inline">
											<input type="checkbox"  value="Company_add" name="company[]" data-am-ucheck> 添加
										  </label>
										  <label class="am-checkbox-inline">
											<input type="checkbox"  value="Company_edit" name="company[]" data-am-ucheck> 编辑
										  </label>
										  <label class="am-checkbox-inline">
											<input type="checkbox"  value="Company_del" name="company[]" data-am-ucheck> 删除
										  </label>
										   <label class="am-checkbox-inline">
											<input type="checkbox"  value="Company_index" name="company[]" data-am-ucheck> 列表
										  </label>
										</div>
                                    </div>
                                </div>
								
								<div class="am-form-group">
                                    <label for="user-phone" class="am-u-sm-3 am-form-label">招聘 / Substance</label>
                                    <div class="am-u-sm-9">
                                      <div class="am-form-group">
										
										  <label class="am-checkbox-inline">
											<input type="checkbox"  value="Substance_add" name="substance[]" data-am-ucheck> 添加
										  </label>
										  <label class="am-checkbox-inline">
											<input type="checkbox"  value="Substance_edit" name="substance[]" data-am-ucheck> 编辑
										  </label>
										  <label class="am-checkbox-inline">
											<input type="checkbox"  value="Substance_del" name="substance[]" data-am-ucheck> 删除
										  </label>
										    <label class="am-checkbox-inline">
											<input type="checkbox"  value="Substance_index" name="substance[]" data-am-ucheck> 列表
										  </label>
										</div>
                                    </div>
                                </div>

									<div class="am-form-group">
                                    <label for="user-phone" class="am-u-sm-3 am-form-label">用户 / User</label>
                                    <div class="am-u-sm-9">
                                      <div class="am-form-group">
										 
										  <label class="am-checkbox-inline">
											<input type="checkbox"  value="User_add" name="user[]" data-am-ucheck> 添加
										  </label>
										  <label class="am-checkbox-inline">
											<input type="checkbox"  value="User_edit" name="user[]" data-am-ucheck> 编辑
										  </label>
										  <label class="am-checkbox-inline">
											<input type="checkbox"  value="User_del" name="user[]" data-am-ucheck> 删除
										  </label>
										   <label class="am-checkbox-inline">
											<input type="checkbox"  value="User_index" name="user[]" data-am-ucheck> 列表
										  </label>
										</div>
                                    </div>
                                </div>

                        

                         
                   

                                <div class="am-form-group">
                                    <div class="am-u-sm-9 am-u-sm-push-3">
                                        <button type="submit" class="am-btn am-btn-primary">保存修改</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>










        </div>

    </div>


  <script src="/static/assets/js/jquery.min.js"></script>
    <script src="/static/assets/js/amazeui.min.js"></script>
    <script src="/static/assets/js/app.js"></script>
</body>

</html>