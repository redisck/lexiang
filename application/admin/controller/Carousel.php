<?php
namespace app\admin\controller;

use \think\Controller;
use \think\View;
use think\File;
use think\Request;
use think\Db;

class Carousel extends Base
{
	   public function index()
    {
		$view = new View();
			
		return $view->fetch('index');
	
	}
	
	public function edit(){
		
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_module_substance')->where('id',$rs[1])->find();
		
		$summay = Db::table('hm_job_head')->field('id,icon,image')->order('id desc')->find();
	
		$view = new View();
		$view->assign('list',$data);
		$view->assign('data',$summay);
		
		return $view->fetch();
	}
	
	public function doedit(){
		
		$data['id'] = $_POST['id'];
		$data['title'] = $_POST['title'];
		$data['vice_heading'] = $_POST['vice_heading'];
		$img = Db::table('hm_im')->select();
		$head['title'] = $_POST['title'];
		if($img){
			$head['icon'] = $img[0]['img'];
			$head['image'] = $img[1]['img'];
			$data['vice_img'] = $img[2]['img'];
		}else{
			$head['icon'] = $_POST['icon'];
			$head['image'] = $_POST['image'];
			$data['vice_img'] = $_POST['img'];
		}
		
		$head['head_id'] =  Request::instance()->param('head_id');
		
		
		$head_result = Db::table('hm_job_head') ->where('id',$head['head_id'])->update(['title' => $head['title'],'icon'=>$head['icon'],'image'=>$head['image'],]);
		
		$result = Db::table('hm_module_substance')->where('id',$data['id'])->update(['title'=>$data['title'],
			'img'=>$head['image'],
			'vice_heading'=>$data['vice_heading'],
			'img'=>$head['icon'],
			'nav_img'=>$head['image'],
			'vice_img'=>$data['vice_img'],
		]);
		if($result or $head_result){
			$this->success('修改成功','carousel/index');
		}else{
			$this->error('修改失败');
		}
	
	}
	
	
	public function add(){
		
		$data['title'] = $_POST['module'];
		$data['vice_heading'] = $_POST['vice_heading'];
		$data['title'] = $_POST['title'];
		$img = Db::table('hm_im')->select();
		if(!$img){
				 $rs = $_SERVER["HTTP_REFERER"];
				$this->redirect($rs); 
		}
		$data['img'] = $img[0]['img'];
		$data['nav_img'] = $img[1]['img'];
		$data['vice_img'] = $img[2]['img'];
		$result = Db::table('hm_module_substance')->insert($data);
		if($result){
			Db::execute('truncate hm_im');			
			$this->success('添加成功','Carousel/index');
		}else{
			$this->error('新增失败');
		}
		
	}
	
		public function allist()
    {
		$aData = input('post.search');
		$result = Db::table('hm_module_substance')->field('id,img,vice_heading,nav_img,title,content')->where('title','like','%'.$aData.'%')->paginate(10);
		
		$view = new View();
		
		$view->assign('data',$result);

		
		return $view->fetch('list');
	
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

}