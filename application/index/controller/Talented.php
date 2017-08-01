<?php
namespace app\index\controller;
use \think\View;
use \think\Db;
use \think\Request;
use \think\Cache;
class Talented extends Base
{
    public function index()
    {
		$aData = input('post.search');
		$result = Db::table('hm_module_substance')->field('id,substance,title,vice_heading,telephone,email,time,img,content')->where('title','like','%'.$aData.'%')->order('id desc')->paginate(5);
		
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
		
		$data = Db::table('hm_module_substance')->where('id',$rs[1])->find();
		
		$summay = Db::table('hm_job_head')->order('id desc')->limit(1)->find();
		

		$this->assign('summary',$summay);
		
		$this->assign('data',$data);
			
		$view = new View();
		
		return view();
	}
	
	public function delete(){
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_module_substance')->where('id',$rs[1])->delete();
		
		if($data){
			$this->success('删除成功','talented/index');
		}else{
			$this->error('删除失败','talented/index');
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
		if($info){
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
			$fileicon = request()->file('icon');
		 if($fileicon==NULL){
			 $rs = $_SERVER["HTTP_REFERER"];
			$this->redirect($rs); 
		 }
		$infoicon = $fileicon->move(ROOT_PATH . 'public' . DS . 'uploads');
		if($infoicon){
		}else{

			echo $fileicon->getError();
		}
		
		$head_image = request()->file('head_image');
		if($head_image ==NULL){
			$rs = $_SERVER['HTTP_REFERER'];
			$this->redirect($rs);
		}
		$info_image = $head_image ->move(ROOT_PATH . 'public' . DS . 'uploads');
		if($info_image){
		}else{
			echo $info_image->getError();
		}
		$data['title'] = $_POST['title'];
		$data['vice_heading'] = $_POST['vice_heading'];
		$data['time'] = strtotime($_POST['time']);
		$data['telephone'] = input('param.telephone');
		$data['email'] = $_POST['email'];
		$data['key'] = $_POST['key'];
		$data['substance'] = $_POST['substance'];
		$data['img'] = $info->getSaveName();
		$data['vice_img'] = $info1->getSaveName();
		$data['nav_img'] = $infonav->getSaveName();
		$head['title'] = $_POST['summary'];
		$head['icon'] = $infoicon ->getSaveName();
		$head['image'] = $info_image ->getSaveName();
		$head_id = Db::table('hm_job_head')->insert($head);
	
		$result = Db::table('hm_module_substance')->insert($data);
		if($result){
			$this->success('添加成功','talented/index');
		}else{
			$this->error('新增失败');
		}
		
	}
	
	public function doedit(){
		
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
	
		
		$file1 = request()->file('image1');
		if($file1==NULL){
				$image_t = Request::instance()->param('image_t');	
				if($image_t){
				$data['vice_img'] = $image_t;
				}else{
					 $rs = $_SERVER["HTTP_REFERER"];
					$this->redirect($rs); 
				 }
		}else{
			$info1 = $file1->move(ROOT_PATH . 'public' . DS . 'uploads');
				$data['vice_img'] = $info1->getSaveName();
			if($info){
			}else{

				echo $file1->getError();
			}
		}
		

		
		$image_s = Request::instance()->param('image_s');
		if($image_s){
			$data['nav_img'] = $image_s;
		}else{
			$filenav = request()->file('nav_img');
			 if($filenav==NULL){
				 $rs = $_SERVER["HTTP_REFERER"];
				$this->redirect($rs); 
			 }
			$infonav = $filenav->move(ROOT_PATH . 'public' . DS . 'uploads');
			$data['nav_img'] = $infonav->getSaveName();
			if($infonav){
			}else{

				echo $filenav->getError();
			}
		}
		
		$fileicon = request()->file('icon');
			if($fileicon ==NULL){
				$icon_name =  Request::instance()->param('icon_name');
				if($icon_name){
				$head['icon'] = $icon_name;
				}else{
					$rs = $_SERVER['HTTP_REFERER'];
					$this->redirect($rs);
				}
				
			}else{
				$infoicon = $fileicon ->move(ROOT_PATH . 'public' . DS .'uploads');
				$head['icon'] = $infoicon ->getSaveName();
				if($infoicon){
				}else{
					echo $infoicon->getError();
				}
			}
		
		$head_image = request()->file('head_image');
		
		if($head_image ==NULL){
				$head_image_name = Request::instance()->param('head_image_name');
				if($head_image_name){
				$head['image'] = $head_image_name;
				}else{
				$rs = $_SERVER['HTTP_REFERER'];
				$this->redirect($rs);
				}
		
		}else{
			$info_image = $head_image ->move(ROOT_PATH . 'public' . DS . 'uploads');
			$head['image'] = $info_image ->getSaveName();
			if($info_image){
			}else{
				echo $info_image->getError();
			}
		}
		
		
		$data['id'] = $_POST['id'];
		$data['title'] = $_POST['title'];
		$data['time'] = strtotime($_POST['time']);
		$data['vice_heading'] = $_POST['vice_heading'];
		$data['email'] = $_POST['email'];
		$data['telephone'] = Request::instance()->param('telephone');

	
		
		
		$data['substance'] = $_POST['substance'];
		$head['id'] = Request::instance()->param('head_id');
		$head['key'] = Request::instance()->param('key');
		$head['title'] = $_POST['summary'];
		$head['head_id'] =  Request::instance()->param('head_id');

		$head_result = Db::table('hm_job_head') ->where('id',$head['id'])->update(['title' => $head['title'],'icon'=>$head['icon'],'image'=>$head['image'],]);

		$result = Db::table('hm_module_substance')->where('id',$data['id'])->update(['title'=>$data['title'],'time'=>$data['time'],
			'email'=>$data['email'],
			'vice_heading'=>$data['vice_heading'],
			'telephone'=>$data['telephone'],
			'img'=>$data['img'],
			'vice_img'=>$data['vice_img'],
			'nav_img'=>$data['nav_img'],
			'substance'=>$data['substance'],
		]);
		if($result){
			$this->success('修改成功','talented/index');
		}else{
			$this->error('修改失败');
		}
	}
	
	
}
