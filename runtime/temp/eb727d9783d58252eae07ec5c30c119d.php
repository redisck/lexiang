<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:57:"D:\WWW\public/../application/admin\view\company\edit.html";i:1501407565;s:56:"D:\WWW\public/../application/admin\view\public\left.html";i:1501404083;}*/ ?>
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
	<link href="/static/admin/css/company.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/static/admin/webuploader/webuploader.css"><!-- 引用插件css -->
	<script type="text/javascript" charset="utf-8" src="/static/editor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/static/editor/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="/static/editor/lang/zh-cn/zh-cn.js"></script>	
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
          <a class="navbar-brand logo" href="#">话梅</a>
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
		 <form class="am-form tpl-form-line-form" action="<?php echo url('company/doedit'); ?>" enctype="multipart/form-data" method="post">
         	<div class="nav_html">
         		<ul>
         			<li>
         				<div class="nav_top">
         					<div class="left">
         						 <a class="navbar-brand" href="#">公司</a>
         					</div>
         					<div class="right">
         						<ul class="nav navbar-nav navbar-right">
						            <li class="edit"><button href="#" class="btn btn-primary button_edit" type="submit"><?php if(($data['id'] > 0)): ?> 编辑<?php endif; ?></button></li>
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
         						<li><input type="text" value="公司简介" name="company"> </li>
								 <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
         						<li>* 文字内容不超过6个字符</li>
         					</ul>
                            <div>
                            <button type="button" class="btn btn-primary module p_header" 
                                    data-toggle="button"> 页面头部
                                </button>
                                <button type="button" class="btn btn-primary module p_content" 
                                    data-toggle="button"> 页面内容
                                </button>
                                </div>
         				</div>
         			</li>
         			
         			<li class="page_header">
         				<div class="upload_top">
						<div id="dls"></div>
						<div id="dls2"></div>
	         				<img src="/static/admin/img/nav_12.png" width="20">
							 <input type="hidden" name="head_id" value="<?php echo $summary['id']; ?>">
	         				<span>小图标上传</span>
         				</div>
         				<div class="upload_bottom">
         					<div>
         						<input type="text">
							     <button type="button" class="btn btn-default" id="filePicker">上传文件</button>
         					</div>
         					<div>
         						<a><div id="fileList" class="uploader-list">
								 <input type="hidden" name="img" value="<?php echo $summary['icon']; ?>"> 
        </div><img src="/uploads/<?php echo $summary['icon']; ?>" width="100" height="160"></a>
							    <span>预览图  20*160像素</span>
         					</div>
         					<div>
         					<button type="button" class="btn btn-primary saved" 
								   	data-toggle="button"> 保存
								</button>
							</div>
         				</div>
         			</li>
                    <li class="page_header">
                        <div class="upload_top">
                            <img src="/static/admin/img/company_01.png" width="20">
                            <span>大图标上传</span>
                        </div>
                        <div class="upload_bottom">
                            <div>
                                <input type="text">
                                 <button type="button" class="btn btn-default" id="filePicker2">上传文件</button>
                            </div>
                            <div>
                                <a><div id="fileList2" class="uploader-list">
								<input type="hidden" name="vice_img" value="<?php echo $summary['image']; ?>"> 
        </div><img src="/uploads/<?php echo $summary['image']; ?>" width="100" height="160"></a>
                                <span>预览图  100*160像素</span>
                            </div>
                            <div>
                            <button type="button" class="btn btn-primary saved" 
                                    data-toggle="button"> 保存
                                </button>
                            </div>
                        </div>
                    </li>
         			
         			<li class="page_header">
         				<div class="upload_top">
	         				<img src="/static/admin/img/company_02.png" width="20">
	         				<span>文字内容</span>
         				</div>
                        <hr>
         				<div class="upload_bottom">
         					<div>
                                <p>标题</p>  
                                <input type="text" class="title" placeholder="请输入标题内容" name="title" value="<?php echo $data['title']; ?>"> <span>*此内容最多20字</span>         
                            </div>
                            <div>
                                <p>副标题</p>   
                                <input type="text" class="title" placeholder="请输入标题内容" name="vice_heading" value="<?php echo $data['vice_heading']; ?>"> <span>*此内容最多10字</span>           
                            </div>
         				</div>
         				
         			</li>
         			<li class="page_content">
                        <div class="upload_top">
                            <img src="/static/admin/img/company_02.png" width="20">
                            <span>页面内容</span>
                        </div>
                      
                        <div class="editor">
                          <script id="editor" type="text/plain" style="width:1024px;height:500px;" name="myContent"><?php echo $data['content']; ?></script>
                        </div>
                        
                    </li>
         		</ul>
         	</div>
			</form>
        </div>
      </div>
    </div>

    
	<script src="/static/admin/js/jquery-1.12.4.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/static/admin/js/bootstrap.min.js"></script>
	<script type="text/javascript">
           var $list2=$("#fileList2");   //这几个初始化全局的百度文档上没说明，好蛋疼
           var thumbnailWidth = 100;   //缩略图高度和宽度 （单位是像素），当宽高度是0~1的时候，是按照百分比计算，具体可以看api文档  
           var thumbnailHeight = 100;  
           var uploader = WebUploader.create({
            // 选完文件后，是否自动上传。
           auto: true,
            // swf文件路径
           swf: '/static/admin/webuploader/uploader.swf', //加载swf文件，路径一定要对
            // 文件接收服务端。
            server: '/index.php/admin/company/upload',
            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker2',
            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/'
            }
        });
      //上传完成事件监听
        uploader.on( 'fileQueued', function(file) {
            var $li = $(
                    '<div id="' + file.id + '" class="file-item thumbnail">' +
                        '<img width="100" height="160">' +
                        '<div class="info">' + file.name + '</div>' +
                    '</div>'
                    ),
                $img = $li.find('img');
            // $list为容器jQuery实例
				//alert($list.parents().parents().parents().parents().parents().find("#fileList2").html());
				//alert($li.html());
                   $list2.append( $li );
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
		 uploader.on('uploadSuccess', function (file, response) {
            $("#dls").append('<input name="package1" type="hidden" value="' + response._raw + '">')
			//alert(response._raw);
		});
		var $list=$("#fileList");   //这几个初始化全局的百度文档上没说明，好蛋疼
           var thumbnailWidth = 100;   //缩略图高度和宽度 （单位是像素），当宽高度是0~1的时候，是按照百分比计算，具体可以看api文档  
           var thumbnailHeight = 100;  
           var uploader = WebUploader.create({
            // 选完文件后，是否自动上传。
           auto: true,
            // swf文件路径
           swf: '/static/admin/webuploader/uploader.swf', //加载swf文件，路径一定要对
            // 文件接收服务端。
            server: '/index.php/admin/company/upload',
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
                        '<div class="info">' + file.name + '</div>' +
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
		 uploader.on('uploadSuccess', function (file, response) {
            $("#dls2").append('<input name="package2" type="hidden" value="' + response._raw + '">')
		
		});
</script>


    <script type="text/javascript">
		$(function(){
		$(".button_saved").css("display","none");
	})
    $(function() {  
     $(".p_header").click(function(){
        $(".page_content").css("display","none");
        $(".page_header").css("display","block");
     })
     $(".p_content").click(function(){
        $(".page_header").css("display","none");
        $(".page_content").css("display","block");
     })

    })



    </script>
	<script type="text/javascript">

    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('editor');


</script>
  </body>
</html>