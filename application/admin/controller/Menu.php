<?php
namespace app\admin\controller;
use \think\View;
use \think\Controller;
use \think\Db;

class Menu extends Base
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
	
	public function doadd(){
		$data['title'] = $_POST['title'];
		$data['content'] = $_POST['content'];
		$img = Db::table('hm_im')->select();
		$data['image'] = $img[0]['img'];
		$data['vice_img'] = $img[0]['img'];
		$result = Db::table('hm_modular')->insert($data);
		if($result){
			Db::execute('truncate hm_im');			
			$this->success('添加成功','add/index');
		}else{
			$this->error('新增失败');
		}
	}
	
}
