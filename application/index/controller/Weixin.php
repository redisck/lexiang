<?php
namespace app\index\controller;
use \think\View;
use \think\Controller;
use org\wechat\Jssdk;
use think\Request;
use \think\Config;
use fast\third\Application;
class Weixin extends Controller
{
	   public function index()
    {
		$view = new View();
			
		return $view->fetch('index');
	
	}
	
}
