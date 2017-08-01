<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:55:"D:\WWW\public/../application/admin\view\home\index.html";i:1501291710;s:56:"D:\WWW\public/../application/admin\view\public\head.html";i:1501312762;s:56:"D:\WWW\public/../application/admin\view\public\left.html";i:1501404083;}*/ ?>
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

	   <link rel="stylesheet" href="/static/assets/css/amazeui.min.css" />
    <link rel="stylesheet" href="/static/assets/css/admin.css">
    <link rel="stylesheet" href="/static/assets/css/app.css">
    <link rel="stylesheet" href="/static/assets/css/font-awesome.4.6.0.css">
    <script src="/static/assets/js/echarts.min.js"></script>

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
      

            <div class="row">
                <div class="am-u-lg-3 am-u-md-6 am-u-sm-12">
                    <div class="dashboard-stat blue">
                        <div class="visual">
                            <i class="am-icon-comments-o"></i>
                        </div>
                        <div class="details">
                            <div class="number"> <?php echo $pv; ?> </div>
                            <div class="desc"> PV浏览量 </div>
                        </div>
                        <a class="more" href="#"> 查看更多
                    <i class="m-icon-swapright m-icon-white"></i>
                </a>
                    </div>
                </div>
                <div class="am-u-lg-3 am-u-md-6 am-u-sm-12">
                    <div class="dashboard-stat red">
                        <div class="visual">
                            <i class="am-icon-bar-chart-o"></i>
                        </div>
                        <div class="details">
                            <div class="number"> <?php echo $PC; ?> </div>
                            <div class="desc"> PC访问 </div>
                        </div>
                        <a class="more" href="#"> 查看更多
                    <i class="m-icon-swapright m-icon-white"></i>
                </a>
                    </div>
                </div>
                <div class="am-u-lg-3 am-u-md-6 am-u-sm-12">
                    <div class="dashboard-stat green">
                        <div class="visual">
                            <i class="am-icon-apple"></i>
                        </div>
                        <div class="details">
                            <div class="number"> <?php echo $iphone; ?> </div>
                            <div class="desc"> 苹果设备 </div>
                        </div>
                        <a class="more" href="#"> 查看更多
                    <i class="m-icon-swapright m-icon-white"></i>
                </a>
                    </div>
                </div>
                <div class="am-u-lg-3 am-u-md-6 am-u-sm-12">
                    <div class="dashboard-stat purple">
                        <div class="visual">
                            <i class="am-icon-android"></i>
                        </div>
                        <div class="details">
                            <div class="number"> <?php echo $android; ?> </div>
                            <div class="desc"> 安卓设备 </div>
                        </div>
                        <a class="more" href="#"> 查看更多
                    <i class="m-icon-swapright m-icon-white"></i>
                </a>
				<input type="hidden" name="mobile" id="mobile" value="11">
                    </div>
                </div>



            </div>

            <div class="row">
                <div class="am-u-md-6 am-u-sm-12 row-mb" style="width:100%">
                    <div class="tpl-portlet">
                        <div class="tpl-portlet-title">
                            <div class="tpl-caption font-green ">
                                <i class="am-icon-cloud-download"></i>
                                <span> Cloud 数据统计</span>
                            </div>
                            <div class="actions">
                                <ul class="actions-btn">
                                    <li class="red-on yesterday">昨天</li>
                                    <li class="green today">今天</li>
                                    <li class="blue week">本周</li>
                                </ul>
                            </div>
                        </div>

                        <!--此部分数据请在 js文件夹下中的 app.js 中的 “百度图表A” 处修改数据 插件使用的是 百度echarts-->
                      <!--  <div id="main" style="width: 600px;height:400px;"></div> -->
						
						 <div class="tpl-echarts" id="main" style="width:1600px;height:400px;">
                        </div>
                        </div>
                    </div>
                </div>
          
            </div>


            <div class="row">
           
    
            </div>



        </div>

    </div>
	
	<script type="text/javascript">

var mobileAgent = new Array("iphone", "ipod", "ipad", "android", "mobile", "blackberry", "webos", "incognito", "webmate", "bada", "nokia", "lg", "ucweb", "skyfire");

var browser = navigator.userAgent.toLowerCase(); 

var isMobile = false; 

var s;

for (var i=0; i<mobileAgent.length; i++){ if (browser.indexOf(mobileAgent[i])!=-1){ isMobile = true; 

mobileAgent[i];



break; } } 

</script>

<script type="text/javascript">
            var  option = {
                    tooltip: {
                        trigger: 'axis'
                    },
                    legend: {
                        data:['浏览量','折线']
                    },
                    xAxis: [
                        {
                            type: 'category',
                            data: ['周一','周二','周三','周四','周五','周六']
                        }
                    ],
                    yAxis: [
                        {
                            type: 'value',
                            name: '访问量/click',
                            min: 0,
                            max: 2000,
                            interval: 500,
                            axisLabel: {
                                formatter: '{value} '
                            }
                        }
                    ],
                    series: [
                         
                        {
                            name:'访问量',
                            type:'bar',
                            /*itemStyle: {
                                normal: {
                                    color: new echarts.graphic.LinearGradient(
                                        0, 0, 0, 1,
                                        [
                                            {offset: 0, color: '#fe6262'},
                                            {offset: 0.5, color: '#fe4141'},
                                            {offset: 1, color: '#fe1818'}
                                        ]
                                    ),
                                },
                                emphasis: {
                                    color: new echarts.graphic.LinearGradient(
                                        0, 0, 0, 1,
                                        [
                                            {offset: 0, color: '#fe6262'},
                                            {offset: 0.5, color: '#fe4141'},
                                            {offset: 1, color: '#fe1818'}
                                        ]
                                    )
                                }
                            },*/
                            
                            /*设置柱状图颜色*/
                            itemStyle: {
                                normal: {
                                    color: function(params) {
                                        // build a color map as your need.
                                        var colorList = [
                                          '#fe4f4f','#fead33','#feca2b','#fef728','#c5ee4a',
                                           '#87ee4a','#46eda9','#47e4ed','#4bbbee','#7646d8',
                                           '#924ae2','#C6E579','#F4E001','#F0805A','#26C0C0'
                                        ];
                                        return colorList[params.dataIndex]
                                    },
                                    /*信息显示方式*/
                                    label: {
                                        show: true,
                                        position: 'top',
                                        formatter: '{b}\n{c}'
                                    }
                                }
                            },
                            data:<?php echo $paylist; ?>
                        },
                        {
                            name:'折线',
                            type:'line',
                            itemStyle : {  /*设置折线颜色*/
                                normal : {
                                   /* color:'#c4cddc'*/
                                }
                            },
                            data:<?php echo $paylist; ?>
                        }
                    ]
            };
            // 基于准备好的dom，初始化echarts实例
            var myChart = echarts.init(document.getElementById('main'));
            // 使用刚指定的配置项和数据显示图表。
            myChart.setOption(option); 
        </script>


	<!-- <script type="text/javascript">
	
	
		var myChart = echarts.init(document.getElementById('main'));
		
		var option = {
			title :{
				text :'访问量报表'
			},
			tooltip:{
				  trigger: 'axis'
			},
			legend:{
				data:['浏览量']
			},
			xAxis:{
				 data: ["周一","周二","周三","周四","周五","周六"]
			},
			yAxis:{},
			series:[{
				name:'浏览量',
				type:'bar',
				data:<?php echo $paylist; ?>
			}]
		};
		
		myChart.setOption(option);
	</script> -->
    <script src="/static/assets/js/jquery.min.js"></script>
    <script src="/static/assets/js/amazeui.min.js"></script>
    <script src="/static/assets/js/iscroll.js"></script>
   <script type="text/javascript">
	$(".yesterday").click(function(){
		$(this).text(<?php echo $yesterdaysum; ?>);
	})
	$(".today").click(function(){
		$(this).text(<?php echo $todaysum; ?>);
	})
	$(".week").click(function(){
		$(this).text(<?php echo $Thisweeksum; ?>);
	})
   </script>
</body>

</html>