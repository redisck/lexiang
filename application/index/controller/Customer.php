<?php
namespace app\index\controller;
use \think\View;
use \think\Request;
use \think\Db;
use \think\Controller;
use \think\Cache;

class Customer extends Base
{
    public function index()
    {
		
		
		$view = new View();
		

		return $view->fetch();
	
	}
	

	
}
