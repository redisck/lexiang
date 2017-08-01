<?php
namespace app\admin\controller;
use \think\View;
use \think\Controller;
use \think\Db;
use \think\Request;
class Mrecruit extends Base
{
	   public function index()
    {
		$view = new View();
		
		$result = Db::table('hm_all')->where('module','3')->order('id desc')->limit(1)->select();
		
		
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
			
		return $view->fetch('recruit');
	
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
	
	public function add(){
		$module['main_title'] = $_POST['module'];
		
		$v = Db::table('hm_all')->insert($module);
		if($v){
			$this->success('添加成功','mrecruit/index');
		}else{
			$this->error('添加失败');
		}
	}
	
		public function doedit(){
		
		$data['id'] = $_POST['id'];
		$data['title'] = $_POST['title'];
		$data['vice_heading'] = $_POST['vice_heading'];
		$img = Db::table('hm_im')->select();
		if($img){
			$head['img'] = $img[0]['img'];
			$head['vice_img'] = $img[1]['img'];
		}else{
			$head['img'] = $_POST['img'];
			$head['vice_img'] = $_POST['vice_img'];
		}
		
		
		$result = Db::table('hm_all')->where('id',$data['id'])->update(['title'=>$data['title'],
			'img'=>$head['img'],
			'vice_heading'=>$data['vice_heading'],
			//'link_name'=>$data['link_name'],
			'vice_img'=>$head['vice_img'],
		]);
		if($result){
			$this->success('修改成功','mrecruit/index');
		}else{
			$this->error('修改失败');
		}
	
	}
	
		public function allist()
    {
		$aData = input('post.search');
		$result = Db::table('hm_all')->field('id,title,vice_heading,link_name,img,vice_img')->where('module','=','3')->paginate(10);
		
		$view = new View();
		
		$view->assign('data',$result);

		
		return $view->fetch('list');
	
	}
	
		  public function delete()
    {
        
		
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);

		$data = Db::table('hm_all')->where('id',$rs[1])->delete();
		
		if($data){
			$this->success('删除成功','mrecruit/index');
		}	
			
    }
	
		public function doadd(){
		
		$data['vice_heading'] = $_POST['module'];
		$data['title'] = $_POST['title'];
		$data['link_name'] = $_POST['content'];
		$img = Db::table('hm_im')->select();
		if(!$img){
				 $rs = $_SERVER["HTTP_REFERER"];
				$this->redirect($rs); 
		}
		$data['img'] = $img[0]['img'];
		$data['vice_img'] = $img[1]['img'];
		$data['module'] = '3';
		$result = Db::table('hm_all')->insert($data);
		if($result){
			Db::execute('truncate hm_im');			
			$this->success('添加成功','mrecruit/index');
		}else{
			$this->error('新增失败');
		}
		
	}
	
}
