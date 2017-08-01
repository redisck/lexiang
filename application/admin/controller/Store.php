<?php
namespace app\admin\controller;
use \think\View;
use \think\Controller;
use \think\Db;

class Help extends Base
{
	   public function index()
    {
		$view = new View();
			
		return $view->fetch('index');
	
	}
	
	public function add(){
		$module['main_title'] = $_POST['module'];
		
		$v = Db::table('hm_index_modular')->insert($module);
		if($v){
			$this->success('添加成功','share/index');
		}else{
			$this->error('添加失败');
		}
	}
	
}
