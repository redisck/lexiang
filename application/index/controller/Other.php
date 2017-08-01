<?php
namespace app\index\controller;
use \think\View;
use \think\Db;
use \think\Request;
use \think\Cache;
class Other extends Base
{
    public function index()
    {
		$aData = input('post.search');
		$result = Db::table('hm_other')->field('id,title,vice_heading,activity,add_time,url,img')->where('title','like','%'.$aData.'%')->paginate(5);
		
		$view = new View();
		
		$view->assign('data',$result);
		$view->assign('roleName',Cache::get('role_name'));
		
		return $view->fetch('index');
	
	}
	
	public function add(){
		$view = new View();
		
		return view('add');
	}
	
	public function edit(){
		
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_other')->where('id',$rs[1])->find();
		
		$this->assign('data',$data);
			
		$view = new View();
		
		return view();
	}
	
	public function delete(){
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_other')->where('id',$rs[1])->delete();
		
		if($data){
			$this->success('删除成功','other/index');
		}else{
			$this->error('删除失败','other/index');
		}	
	}
	

	
	public function doadd(){
		
		$file = request()->file('image');
		 if($file==NULL){
			 $rs = $_SERVER["HTTP_REFERER"];
			$this->redirect($rs); 
		 }
		$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
		if($info){
		}else{

			echo $file->getError();
		}
		
		$file1 = request()->file('image1');
		 if($file1==NULL){
			 $rs = $_SERVER["HTTP_REFERER"];
			$this->redirect($rs); 
		 }
		$info1 = $file1->move(ROOT_PATH . 'public' . DS . 'uploads');
		if($info1){
		}else{

			echo $file1->getError();
		}
		
		$filenav = request()->file('nav_img');
		 if($filenav==NULL){
			 $rs = $_SERVER["HTTP_REFERER"];
			$this->redirect($rs); 
		 }
		$infonav = $filenav->move(ROOT_PATH . 'public' . DS . 'uploads');
		if($infonav){
		}else{

			echo $filenav->getError();
		}
		$data['title'] = $_POST['title'];
		$data['vice_heading'] = $_POST['vice_heading'];
		$data['add_time'] = strtotime($_POST['time']);
		$data['url'] = $_POST['url'];
		$data['img'] = $info->getSaveName();
		$data['vice_img'] = $info1->getSaveName();
		$data['nav_img'] = $infonav->getSaveName();
		$result = Db::table('hm_other')->insert($data);
		if($result){
			$this->success('添加成功','other/index');
		}else{
			$this->error('新增失败');
		}
		
	}
	
	public function doedit(){
		
		$file = request()->file('image');
		 if($file==NULL){
			 $image_f = Request::instance()->param("image_f");
			 if($image_f){
				 $data['img'] = $image_f;
			 }else{
				 $rs = $_SERVER["HTTP_REFERER"];
				$this->redirect($rs);
			 } 
		 }else{
			$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
			$data['img'] = $info->getSaveName();
			if($info){
			}else{

				echo $file->getError();
			} 
		 }
	
		
		$file1 = request()->file('image1');
		 if($file1==NULL){
			 $image_t = Request::instance()->param("image_t");
			 if($image_t){
				 $data['vice_img'] = $image_t;
			 }else{
				 $rs = $_SERVER["HTTP_REFERER"];
				$this->redirect($rs); 
			 } 
		 }else{
			 $info1 = $file1->move(ROOT_PATH . 'public' . DS . 'uploads');
			 $data['vice_img'] = $info1->getSaveName();
			if($info1){
			}else{

				echo $file1->getError();
			}
		 }
	
		
		$filenav = request()->file('nav_img');
		 if($filenav==NULL){
			 $image_s = Request::instance()->param('image_s');
			 if($image_s){
				 $data['nav_img'] = $image_s;
			 }else{
				$rs = $_SERVER["HTTP_REFERER"];
				$this->redirect($rs); 
			 } 
		 }else{
			$infonav = $filenav->move(ROOT_PATH . 'public' . DS . 'uploads');
			$data['nav_img'] = $infonav->getSaveName();
			if($infonav){
			}else{

				echo $filenav->getError();
			} 
		 }
		
		$data['id'] = $_POST['id'];
		$data['title'] = $_POST['title'];
		$data['add_time'] = strtotime($_POST['time']);
		$data['vice_heading'] = $_POST['vice_heading'];
		$data['email'] = $_POST['email'];

	
		

		$result = Db::table('hm_other')->where('id',$data['id'])->update(['title'=>$data['title'],'add_time'=>$data['add_time'],
			'vice_heading'=>$data['vice_heading'],
			'img'=>$data['img'],
			'vice_img'=>$data['vice_img'],
			'nav_img'=>$data['nav_img'],

		]);
		if($result){
			$this->success('修改成功','other/index');
		}else{
			$this->error('修改失败');
		}
	}
	
	
}
