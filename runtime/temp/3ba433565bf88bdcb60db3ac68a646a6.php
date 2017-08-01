<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:58:"D:\WWW\public/../application/admin\view\search\search.html";i:1501385495;s:56:"D:\WWW\public/../application/admin\view\public\left.html";i:1501404083;}*/ ?>
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
	<link href="/static/admin/css/search.css" rel="stylesheet">
	<link rel="stylesheet" href="/static/admin/css/common.css"/>
	<script src="/static/admin/js/jquery-1.12.4.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/static/admin/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/static/assets/css/amazeui.min.css" />

	<link rel="stylesheet" type="text/css" href="/static/assets/css/app.css" />
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

    <div class="container-fluid">
      <div class="row">
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
			 <form class="am-form tpl-form-line-form" action="<?php echo url('search/dosearch'); ?>" enctype="multipart/form-data" method="post">
         	<div class="nav_html">
         		<ul>
         			<li>
         				<div class="nav_top">
         					<div class="left">
         						 <a class="navbar-brand" href="#">公司</a>
         					</div>
         					<div class="right">
         							<ul class="nav navbar-nav navbar-right">
						            <li class="edit"><button href="#" class="btn btn-primary button_edit" type="submit">保存</button></li>
						            <li><a href="#" style="font-size: 20px;">|</a></li>
									<li><button type="submit" class="btn btn-primary button_saved" id="upload_id"
										> 保存
									</button></li>
						        </ul>
         					</div>
         				</div>
         				<div class="nav_bottom">
         					<ul>
         						<li>+模块名称</li>
         						<li><input type="text" value="搜索功能"> </li>
         						<li>* 文字内容不超过6个字符</li>
         					</ul>
         				</div>
         			</li>
         			<li>
         				<div class="nav_top content">
         					<div class="left">
         						 <a class="" href="#">
								<img src="/static/admin/img/nav_09.png" width="20">
         						 <span>搜索关键词设置</span></a>
         					</div>
         					<div class="right">
         						<img src="/static/admin/img/nav_08.png">
         					</div>

         				</div>
         				<div class="bottom">
							<?php foreach($data as $vo): ?>
								<button type="button" class="btn btn-primary module" 
								   	data-toggle="button"> <?php echo $vo['key_name']; ?>
								</button>
							<?php endforeach; ?>
                                <button type="button" class="btn btn-primary module add_to" 
                                    data-toggle="button"> +
                                </button>
         				</div>

         			</li>
         			<li class="page_header">
                       
                        <div class="upload_bottom">
                            <div>
                                <p>关键词1</p>  
                                <input type="text" class="title" placeholder="请输入标题内容" name="search"> <span>*此内容最多4字</span>         
                            </div>
                        </div>
                        
                    </li>
					  
         			
         		</ul>
         	</div>
			</form>
        </div>
      </div>
    </div>
		<div class="box">
        
        <div id="dialogBg"></div>
        <div id="dialog" class="animated">
            <div class="dialogTop">
                <a href="javascript:;" class="claseDialogBtn">关闭</a>
            </div>
            <form action="" method="post" id="editForm">
                <ul class="editInfo">
				<select id="test" name="test">
					<option value="1">产品模块<option>
					<option value="2">店铺模块<option>
					<option value="3">活动模块<option>
					</select>
                    <li><label style="color:#1e1d1d;"><font color="#ff0000">* </font>关键字：<input type="text" name="nick" required value="" class="ipt" /></label></li>
              <!--       <li><label style="color:#1e1d1d;"><font color="#ff0000">* </font>手机：<input type="text" name="" required value="" class="ipt" /></label></li>
                    <li><label style="color:#1e1d1d;"><font color="#ff0000">* </font>地址：<input type="text" name="" required value="" class="ipt" /></label></li> -->
					
                    <li><input type="submit" value="确认提交" id="set_add" class="submitBtn" /></li>
                </ul>
            </form>
        </div>
    </div>
		<script type="text/javascript">
			$(function(){
			$(".button_saved").css("display","none");
		})
		$("#set_add").click(function(){
			var s = $("input[name='nick']").val();
			//var test = $("#test").val();
			var test = $("#test").find("option:selected").val();
			//var data = {
			//	name:s,
			//	module:test
			//};
			//alert(test);
			$("#jia").before("<button type='button' class='btn btn-primary module' data-toggle='button'>"+s+"</button>");
			$.ajax({
					  method: "POST",
					  url: "/index.php/admin/search/dokeys",
					  data: { name: s,test:test}
					}).done(function( msg ) {
					  alert( "Data Saved: " + msg );
					});
			$('#dialogBg').fadeOut(300,function(){
			$('#dialog').addClass('bounceOutUp').fadeOut();
		});
			})
	</script>
    
	
	 <script type="text/javascript" src="/static/admin/js/index.js"></script>
  </body>
</html>