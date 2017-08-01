<?php
namespace app\index\controller;
use \think\View;
use \think\Db;
use \think\Request;
use \think\Cache;
class Corporation extends Base
{
    public function index()
    {
		$aData = input('post.search');
		$result = Db::table('hm_module_company')->field('id,title,vice_heading,add_time,img,author')->where('title','like','%'.$aData.'%')->paginate(5);
		
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
		
		$data = Db::table('hm_module_company')->where('id',$rs[1])->find();
		
		$summay = Db::table('hm_company_head')->order('id desc')->limit(1)->find();
		
		
		 $data['img'] = str_replace('/uploads/','',$data['img']);
		 $data['vice_img'] = str_replace('/uploads/','',$data['vice_img']);
		 $data['nav_img'] = str_replace('/uploads/','',$data['nav_img']);
		 
		
		$this->assign('summary',$summay);
		
		$this->assign('data',$data);
			
		$view = new View();
		
		return view();
	}
	
	public function huodong(){
		
		$result = Db::table('hm_huodong')->field('id,news,vice_heading,add_time,img,author,content')->select();
		
		$view = new View();
		
		$view->assign('data',$result);
		$view->assign('roleName',Cache::get('role_name'));
		
		return $view->fetch('huodong');
	}
	
	public function news(){
		
		$view = new View();
		
		return view();
	}
	
	public function donews(){
		
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
		$data['news'] = $_POST['news'];
		$data['vice_heading'] = $_POST['vice_heading'];
		$data['add_time'] = strtotime($_POST['time']);
		$data['author'] = $_POST['author'];
		$data['content'] = $_POST['editorValue'];
		$data['img'] = $info->getSaveName();
		$result = Db::table('hm_huodong')->insert($data);
		if($result){
			$this->success('添加成功','Corporation/huodong');
		}else{
			$this->error('新增失败');
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
		$data['title'] = $_POST['company'];
		$data['vice_heading'] = $_POST['vice_heading'];
		$data['add_time'] = strtotime($_POST['time']);
		$data['author'] = $_POST['author'];
		$data['img'] = $info->getSaveName();
		$data['vice_img'] = $info1->getSaveName();
		$data['nav_img'] = $infonav->getSaveName();
		$data['url'] = $_POST['url'];
		$data['key'] = $_POST['key'];
		$head['title'] = $_POST['summary'];
		$head['icon'] = $infoicon ->getSaveName();
		$head['image'] = $info_image ->getSaveName();
		$head_id = Db::table('hm_company_head')->insert($head);

		$result = Db::table('hm_module_company')->insert($data);
		if($result){
			$this->success('添加成功','Corporation/index');
		}else{
			$this->error('新增失败');
		}
		
	}
	
	public function doedit(){
		
		$file = request()->file('image');
		 if($file==NULL){
			 $image_f = Request::instance()->param('image_f');
			if($image_f){
				$data['img'] = str_replace('/uploads/','',$image_f);
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
				$data['vice_img'] = str_replace('/uploads/','',$image_t);
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
				$data['nav_img'] = str_replace('/uploads/','',$image_s);
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
		
	
		$fileicon = request()->file('icon');
		 if($fileicon==NULL){
			 $icon_name = Request::instance()->param('icon_name');
			if($icon_name){
				$head['icon'] = $icon_name;
			}else{
			 $rs = $_SERVER["HTTP_REFERER"];
			$this->redirect($rs); 
			}
		 }else{
			 $infoicon = $fileicon->move(ROOT_PATH . 'public' . DS . 'uploads');
			$head['icon'] = $infoicon ->getSaveName();
			if($infoicon){
			}else{

				echo $fileicon->getError();
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
		
		$head['title'] =  $_POST['summary'];
	
		$data['id'] = $_POST['id'];
		$data['title'] = $_POST['title'];
		$data['add_time'] = strtotime($_POST['add_time']);
		$data['vice_heading'] = $_POST['vice_heading'];
		$data['url'] = $_POST['url'];
		$head['head_id'] =  Request::instance()->param('head_id');
		$head_result = Db::table('hm_company_head') ->where('id',$head['head_id'])->update(['title' => $head['title'],'icon'=>$head['icon'],'image'=>$head['image'],]);
		
		$result = Db::table('hm_module_company')->where('id',$data['id'])->update(['title'=>$data['title'],'add_time'=>$data['add_time'],
			'url'=>$data['url'],
			'vice_heading'=>$data['vice_heading'],
			'img'=>$data['img'],
			'vice_img'=>$data['vice_img'],
			'nav_img'=>$data['nav_img'],
		
		]);
		if($result){
			$this->success('修改成功','Corporation/index');
		}else{
			$this->error('修改失败');
		}
	}
	
	public function delete(){
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_module_company')->where('id',$rs[1])->delete();
		if($data){
			$this->success('删除成功','Corporation/index');
		}	
			
	}
	
	
}
