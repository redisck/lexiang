<?php
namespace app\admin\controller;
use \think\View;
use \think\Controller;
use \think\Db;
use \think\Request;
class Mproduct extends Base
{
	   public function index()
    {
		$result = Db::table('hm_all')->where('module','1')->order('id desc')->limit(1)->select();
		
		$view = new View();
		
		if($result){
			$view->assign('data',$result[0]);
		}else{
			$em['img'] = '';
			$em['vice_img'] = '';
			$em['nav_img'] = '';
			$em['title'] = '';
			$em['vice_heading'] = '';
			$em['link_name'] = '';
			$view->assign('data',$em);
		}
			
		return $view->fetch('product');
	
	}
	
	public function add()
	{
		$module['main_title'] = $_POST['module'];
		
		$v = Db::table('hm_all')->insert($module);
		if($v){
			$this->success('添加成功','mproduct/index');
		}else{
			$this->error('添加失败');
		}
	}
	
		
	public function allist()
    {
		
		$result = Db::table('hm_all')->field('id,img,link_name,vice_heading,nav_img,title')->where('module','=','1')->paginate(10);
		
		$view = new View();
		
		$view->assign('data',$result);

		
		return $view->fetch('list');
	
	}
	
	public function edit(){
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_all')->where('id',$rs[1])->find();
	
		$view = new View();
		$view->assign('data',$data);
		
		return $view->fetch();
	}
	
	public function upload(){
		
	
		if($_FILES['file']['tmp_name']){
                $file = request()->file('file');
                $info = $file->move(ROOT_PATH . 'public' . DS . '/uploads/');
                $data['img']=$info->getSaveName();
				/* if($data['img']){
						Db::table('hm_im')->insert($data);
				} */

		}
		
		exit($data['img']);
	
		
	}
	
	
	
	public function doadd()
	{
		$data['vice_heading'] = $_POST['content'];
		$data['title'] = $_POST['title'];
		$data['module'] = '1';
		$data['img'] = $_POST['package1'];
		$data['vice_img'] = $_POST['package2'];
	
			$result = Db::table('hm_all')->insert($data);
		
	
		if($result){
		
			$this->success('添加成功','mproduct/index');
		}else{
			$this->error('新增失败');
		}
		
	}
	
	  public function delete()
    {
        
		
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);

		$data = Db::table('hm_all')->where('id',$rs[1])->delete();
		
		if($data){
			$this->success('删除成功','mproduct/index');
		}	
			
    }
	
	
	public function doedit(){
		
		$data['id'] = $_POST['id'];
		$data['title'] = $_POST['title'];	
		$data['module'] = '1';
		$data['vice_heading'] = $_POST['vice_heading'];
		$data['img'] = empty($_POST['package1'])?$_POST['img']:$_POST['package1'];
		$data['vice_img'] = empty($_POST['package2'])?$_POST['vice_img']:$_POST['package2'];
		
		
		$result = Db::table('hm_all')->where('id',$data['id'])->update(['title'=>$data['title'],
			'img'=>$data['img'],
			'vice_img'=>$data['vice_img'],
			'module'=>$data['module'],
			'link_name'=>$data['vice_heading'],
		]);
		if($result){
			$this->success('修改成功','mproduct/index');
		}else{
			$this->error('修改失败');
		}
	
	}
	
	
	
}
