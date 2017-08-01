<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:56:"D:\WWW\public/../application/admin\view\guide\guide.html";i:1501319251;s:56:"D:\WWW\public/../application/admin\view\public\left.html";i:1501404083;}*/ ?>
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
	<link href="/static/admin/css/guide.css" rel="stylesheet">
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
			 <form class="am-form tpl-form-line-form" action="<?php echo url('guide/vv'); ?>" enctype="multipart/form-data" method="post">
         	<div class="nav_html">
         		<ul>
         			<li>
         				<div class="nav_top">
         					<div class="left">
         						 <a class="navbar-brand" href="#">公司</a>
         					</div>
         					<div class="right">
         							<ul class="nav navbar-nav navbar-right">
						            <li class="edit"><button href="#" class="btn btn-primary button_edit" type="submit">编辑</button></li>
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
         						<li><input type="text" value="引导页" name="module"> </li>
         						<li>* 文字内容不超过6个字符</li>
         					</ul>
         				</div>
         			</li>
         			<li>
         				<div class="nav_top content">
         					<div class="left">
         						 <a class="" href="#">
								<img src="/static/admin/img/nav_09.png" width="20">
         						 <span>引导页面选填</span></a>
         					</div>
         					<div class="right">
         						<img src="/static/admin/img/nav_08.png">
         					</div>

         				</div>
         				<div class="bottom">
         						<button type="button" class="btn btn-primary module" 
								   	data-toggle="button"> 
                                    引导1
								</button>
								<button type="button" class="btn btn-primary module" 
								   	data-toggle="button"> 引导2
								</button>
								<button type="button" class="btn btn-primary module" 
                                    data-toggle="button"> 引导3
                                </button>
                                <button type="button" class="btn btn-primary module add_to" 
                                    data-toggle="button"> +
                                </button>
                               

         				</div>
         			</li>
         			<li>
         				<div class="upload_top">
	         				<img src="/static/admin/img/nav_12.png" width="20">
	         				<span>图标上传</span>
         				</div>
         				<div class="upload_bottom">
         					<div>
         						<input type="text">
							     <button type="button" class="btn btn-default" id="filePicker">上传文件</button>
         					</div>
         					<div>
         						<a><div id="fileList" class="uploader-list">
        </div></a>
							    <span>预览图  50*150像素</span>
         					</div>
         					<div>
         					
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
                    <li><label style="color:#1e1d1d;"><font color="#ff0000">* </font>引导：<input type="text" name="nick" required value="" class="ipt" /></label></li>
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
			$("#jia").before("<button type='button' class='btn btn-primary module' data-toggle='button'>"+s+"</button>");
			$.ajax({
					  method: "POST",
					  url: "/index.php/admin/guide/dolink",
					  data: { name: s }
					}).done(function( msg ) {
					  //alert( "Data Saved: " + msg );
					});
			$('#dialogBg').fadeOut(300,function(){
			$('#dialog').addClass('bounceOutUp').fadeOut();
		});
			})
	</script>

		<script type="text/javascript">
		
		var $list=$("#fileList");   //这几个初始化全局的百度文档上没说明，好蛋疼
           var thumbnailWidth = 100;   //缩略图高度和宽度 （单位是像素），当宽高度是0~1的时候，是按照百分比计算，具体可以看api文档  
           var thumbnailHeight = 100;  
           var uploader = WebUploader.create({
            // 选完文件后，是否自动上传。
           auto: true,
            // swf文件路径
           swf: '/static/admin/webuploader/uploader.swf', //加载swf文件，路径一定要对
            // 文件接收服务端。
            server: '/index.php/admin/guide/upload',
            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',
            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/'
            }
        });
      //上传完成事件监听
        uploader.on( 'fileQueued', function(file) {
				$(".button_saved").css("display","block");
			$(".button_edit").css("display","none");
            var $li = $(
                    '<div id="' + file.id + '" class="file-item thumbnail">' +
                        '<img width="100" height="160">' +
                        +
                    '</div>'
                    ),
                $img = $li.find('img');
            // $list为容器jQuery实例
				//alert($li.html());
                   $list.append( $li );
            // 创建缩略图
            // 如果为非图片文件，可以不用调用此方法。
            // thumbnailWidth x thumbnailHeight 为 100 x 100
            uploader.makeThumb( file, function( error, src ) {
                if ( error ) {
                    $img.replaceWith('<span>不能预览</span>');
                    return;
                }
                $img.attr( 'src', src );
            }, thumbnailWidth, thumbnailHeight );
        });
		
			$(function(){
			$(".module").click(function(){
				var name=$(this).text();
			
				$(this).click(function(){
					$.ajax({
					  method: "POST",
					  url: "/index.php/admin/guide/vv",
					  data: { name: name }
					}).done(function( msg ) {
					  alert( "Data Saved: " + msg );
					});
				
			});
			})
		})
</script>
 <script type="text/javascript" src="/static/admin/js/index.js"></script>
  </body>
</html>