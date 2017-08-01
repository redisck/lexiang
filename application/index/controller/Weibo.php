<?php
namespace app\index\controller;
use \think\View;
use \think\Db;
use \think\Response;
use \think\Request;
class Index extends Base
{
    public function index()
    {
		
		$view = new View();
		
		return $view->fetch('index');
	
	}
	

}
