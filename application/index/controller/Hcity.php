<?php
namespace app\index\controller;
use \think\View;
use \think\Db;
use \think\Cache;
use \think\Request;
class Hcity extends Base
{
    public function index()
    {
		$aData = input('post.search');
		$result = Db::table('hm_city')->field('id,city,title,vice_heading,img,summary,address,tel,business_hours')->where('title','like','%'.$aData.'%')->paginate(5);
		

		$view = new View();
		
		$view->assign('data',$result);
		$view->assign('roleName',Cache::get('role_name'));
		
		return $view->fetch('index');
	
	}
	
	public function add(){
		
		$view = new View();
		return view();
		
	}
	
	public function edit(){
		
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_city')->where('id',$rs[1])->find();
		
		$summay = Db::table('hm_city_head')->order('id desc')->limit(1)->find();
		
		
		$this->assign('data',$data);
		
		$this->assign('summary',$summay);
			
		$view = new View();
		
		return view();
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
		$head_image_info = $head_image_file->move(ROOT_PATH . 'public' .DS . 'uploads');
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
		$data['city'] = $_POST['city_id'];
		$data['address'] = $_POST['address'];
		$data['business_hours'] = $_POST['business_hours'];
		$data['tel'] = $_POST['tel'];
		$data['summary'] = $_POST['summary'];
		$data['img'] = $info->getSaveName();
		$head['title'] = $_POST['summary'];
		$head['icon'] = $iconinfo ->getSaveName();
		$head['image'] = $head_image_info ->getSaveName();
		$head_id = Db::table('hm_city_head')->insert($head);

		$result = Db::table('hm_city')->insert($data);
		if($result){
			$this->success('添加成功','hcity/index');
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
		
		$data['id'] = Request::instance()->post('id');
		$data['title'] = Request::instance()->post('title'); 
		$data['vice_heading'] = $_POST['vice_heading'];
		$data['city'] = $_POST['city_id'];
		$data['address'] = $_POST['address'];
		$data['url'] = Request::instance()->post('url'); 
		$data['tel'] = Request::instance()->post('tel'); 
		$data['summary'] = $_POST['summary'];
		$data['business_hours'] = $_POST['business_hours'];
		
		$head['title'] = $_POST['summary'];
		$head['head_id'] = Request::instance()->post('head_id');
		$head_id = Db::table('hm_city_head')->where('id',$head['head_id'])->update(['title'=>$head['title'],'icon'=>$head['icon'],'image'=>$head['image'],]);

		$result = Db::table('hm_city')->where('id',$data['id'])->update(['title'=>$data['title'],
			'img'=>$data['img'],
			'summary'=>$data['summary'],
			'city'=>$data['city'],
			'vice_heading'=>$data['vice_heading'],
			'url'=>$data['url'],
			'address'=>$data['address'],
			'tel'=>$data['tel'],
			'business_hours'=>$data['business_hours'],
		]);
		if($result or $head_id){
			$this->success('修改成功','hcity/index');
		}else{
			$this->error('修改失败');
		}
	}
	
		public function delete(){
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_city')->where('id',$rs[1])->delete();
		if($data){
			$this->success('删除成功','hcity/index');
		}	
			
	}




	public function head(){
		$view = new View();

		return $view->fetch(APP_PATH.request()->module().'/view/public/head/head.html');
	}
}
