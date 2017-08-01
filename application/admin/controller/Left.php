<?php
namespace app\admin\controller;
use \think\View;
use \think\Controller;
use \think\Db;
use \think\Config;

class Left extends Controller
{
	   public function index()
    {
		$view = new View();
		
		$menu = Config::get('config.php','');
		
		$view->assign('menu',$menu);
		
		return $view->fetch('/public/');
	}
	
	public function add(){
		
		$view = new View();
			
		//return $view->fetch('index');
		
		//$menu = Config::get('config.php','');
		//$menu = Config::load('config.php','','user');
		/* 	$a = 'aaa';
			$b = 'bbb';
			$config = array($a=>$b);
		// $menu = Config::get('config'); 
		$menu = array("公司模块展示"=>"mcompany/index","产品模块展示"=>"mproduct/index","招聘模块展示"=>"mrecruit/index");
		$menu = $menu+$config;
		$str="<?php\r\nreturn array(\r\n";
			foreach($menu as $key=>$value){
				$str .= "  '$key'=>'$value'";
			}
			 $str.= "    )\r\n";
			 file_put_contents(APP_PATH.DS.'admin'.DS.'config.php',$str); */
		//dump($str);exit;
		
	}
	
}
