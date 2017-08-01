<?php
namespace app\index\controller;
use \think\View;
use \think\Db;
use \think\Request;
use \think\Cache;
class Substance extends Base
{
    public function index()
    {
		$aData = input('post.search');
		$result = Db::table('hm_substance')->field('id,substance,title,vice_heading,email,time,author,img,content')->where('title','like','%'.$aData.'%')->paginate(5);
		
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
		
		$data = Db::table('hm_substance')->where('id',$rs[1])->find();
		
		$summay = Db::table('hm_substance_head')->where('id',$data['head_id'])->find();
		
		$summay['icon'] = str_replace('/uploads/','',$summay['icon']);
		 $summay['image'] = str_replace('/uploads/','',$summay['image']);
		
		 $data['img'] = str_replace('/uploads/','',$data['img']);
		
		$this->assign('summary',$summay);
		
		$this->assign('data',$data);
			
		$view = new View();
		
		return view();
	}
	
	public function delete(){
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_substance')->where('id',$rs[1])->delete();
		
		if($data){
			$this->success('删除成功','substance/index');
		}else{
			$this->error('删除失败','substance/index');
		}	
	}
	

	
	public function doadd(){
		
		$iconfile = request()->file('icon');
		if($iconfile ==NULL){
			$rs = $_SERVER['HTTP_REFERER'];
			$this->redirect($rs);
		}
		$iconinfo = $iconfile->move(ROOT_PATH.'public'.DS.'uploads');
		if($iconinfo){
		}else{
			echo $iconfile->getError();
		}
		
		$head_image_file = request()->file('head_image');
		if($head_image_file == NULL){
			$rs = $_SERVER['HTTP_REFERER'];
			$this->redirect($rs);
		}
		$head_image_info = $head_image_file->move(ROOT_PATH.'pulic'.DS.'uploads');
		if($head_image_info){
		}else{
			echo $head_image_file->getError();
		}
		
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
		
		$data['title'] = $_POST['title'];
		$data['vice_heading'] = $_POST['vice_heading'];
		$data['time'] = strtotime($_POST['time']);
		$data['author'] = $_POST['author'];
		$data['email'] = $_POST['email'];
		$data['content'] = htmlspecialchars($_POST['editorValue']);
		$data['substance'] = $_POST['substance'];
		$data['key'] = $_POST['key'];
		$data['img'] = $info->getSaveName();
		$head['title'] = $_POST['summary'];
		$head['icon'] = $iconinfo ->getSaveName();
		$head['image'] = $head_image_info ->getSaveName();
		$head_id = Db::table('hm_substance_head')->insert($head);
		$head_id = Db::name('hm_substance_head')->getLastInsID();
		$data['head_id'] = $head_id;
		$result = Db::table('hm_substance')->insert($data);
		if($result){
			$this->success('添加成功','substance/index');
		}else{
			$this->error('新增失败');
		}
		
	}
	
	public function doedit(){
		
		$fileicon = request()->file('icon');
		if($fileicon == NULL){
			$icon_name = Request::instance()->param('icon_name');
			if($icon_name){
				$head['icon'] = $icon_name;
			}else{
				$rs = $_SERVER['HTTP_REFERER'];
				$this->redirect($rs);
			}
			
		}else{
			$infoicon = $fileicon->move(ROOT_PATH .'public'.DS.'uploads');
			$head['icon'] = $infoicon->getSaveName();
			if($infoicon){
			}else{
				echo $fileicon->getError();
			}
		}
		
		
		$filehead = request()->file('head_image');
		if($filehead == NULL){
			$head_image_name = Request::instance()->param('head_image_name');
			if($head_image_name){
				$head['image'] = $head_image_name;
			}else{
				$rs = $_SERVER['HTTP_REFERER'];
				$this->redirect($rs);
			}
			
		}else{
			$infohead = $filehead->move(ROOT_PATH .'public'.DS.'uploads');
			$head['image']= $infohead->getSaveName();
			if($infohead){
			}else{
				echo $filehead->getError();
			}
		}
		
		
		$file = request()->file('image');
		 if($file==NULL){
			 $image_f = Request::instance()->param('image_f');
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
		 
		 
		$data['id'] = $_POST['id'];
		$data['title'] = $_POST['title'];
		$data['time'] = strtotime($_POST['time']);
		$data['vice_heading'] = $_POST['vice_heading'];
		$data['email'] = $_POST['email'];
		$data['author'] = $_POST['author'];
		$data['content'] = $_POST['editorValue'];
		$data['substance'] = $_POST['substance'];
		$data['key'] = $_POST['key'];
		
		$head['title'] = $_POST['summary'];
		$head_id = Db::table('hm_substance_head')->insert($head);
		$head_id = Db::name('hm_substance_head')->getLastInsID();
		$data['head_id'] = $head_id;
		$result = Db::table('hm_substance')->where('id',$data['id'])->update(['title'=>$data['title'],'time'=>$data['time'],
			'email'=>$data['email'],
			'vice_heading'=>$data['vice_heading'],
			'author'=>$data['author'],
			'img'=>$data['img'],
			'key'=>$data['key'],
			'head_id'=>$data['head_id'],
			'substance'=>$data['substance'],
			'content'=>$data['content'],
		]);
		if($result){
			$this->success('修改成功','substance/index');
		}else{
			$this->error('修改失败');
		}
	}
	
	
}
