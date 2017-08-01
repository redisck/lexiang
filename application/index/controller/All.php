<?php
namespace app\index\controller;
use \think\View;
use \think\Request;
use \think\Db;
use \think\Cache;
use \think\Paginator;
use \think\Config;
class All extends Base
{
    public function index()
    {
			
		$aData = input('post.search');
		$result = Db::table('hm_all')->field('id,title,vice_heading,activity,top,module,img,url,vice_img')->where('title','like','%'.$aData.'%')->paginate(10);
		$view = new View();
		$view->assign('data',$result);
		$view->assign('roleName',Cache::get('role_name'));
		return $view->fetch('index');

	
	}
	
	public function add(){
		
		$view = new View();
		
		return view('add');
	}
	
	public function delete(){
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_all')->where('id',$rs[1])->delete();
		
		if($data){
			$this->success('删除成功','all/index');
		}	
			
	}
	
	public function edit(){
		
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_all')->where('id',$rs[1])->find();
		
		 
		
		$this->assign('data',$data);
		
			
		$view = new View();
		
		return view();
	}
	
	
	 public function upload(){

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
		$file2 = request()->file('image2');
		 if($file2==NULL){
			 $rs = $_SERVER["HTTP_REFERER"];
			$this->redirect($rs); 
		 }
		$info2 = $file2->move(ROOT_PATH . 'public' . DS . 'uploads');
		if($info2){
		}else{

			echo $file2->getError();
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
		$data['module'] = $_POST['module'];
		$data['img'] = $info->getSaveName();
		$data['vice_img'] = $info2->getSaveName();
		$data['nav_img'] = $infonav->getSaveName();
		$data['is_list'] = $_POST['is_list'];
		$data['add_time'] = time();
		$result = Db::table('hm_all')->insert($data);
		if($result){
			$this->success('添加成功','all/index');
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
		
		

		$file2 = request()->file('image2');
		if($file2==NULL){
			$image_t = Request::instance()->param('image_t');
			if($image_t){
				$data['vice_img'] = $image_t;
			}else{
				 $rs = $_SERVER["HTTP_REFERER"];
				$this->redirect($rs); 
			 }
		}else{
			$info2 = $file2->move(ROOT_PATH . 'public' . DS . 'uploads');
			$data['vice_img'] = $info2->getSaveName();
			if($info2){
			}else{

				echo $file2->getError();
			}
		}
		
		$filenav = request()->file('nav_img');
		if($filenav==NULL){
			$image_t = Request::instance()->param('image_nav');
			if($image_t){
				$data['nav_img'] = $image_t;
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

		
		$data['id'] = Request::instance()->param('id');
		$data['title'] = Request::instance()->param('title');
		$data['vice_heading'] =  Request::instance()->param('vice_heading');
		$data['module'] =  Request::instance()->param('module');
		$data['is_list'] =  Request::instance()->param('is_list');
		$data['add_time'] =  time();

		$result = Db::table('hm_all')->where('id',$data['id'])->update(['title'=>$data['title'],'vice_heading'=>$data['vice_heading'],
			'module'=>$data['module'],
			'vice_img'=>$data['vice_img'],
			'is_list'=>$data['is_list'],
			'img'=>$data['img'],
			'add_time'=>$data['add_time'],
			'nav_img'=>$data['nav_img'],
		]);
		if($result){
			$this->success('修改成功','all/index');
		}else{
			$this->error('修改失败');
		}
	}
	
	public function top(){
				
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$result = Db::table('hm_all')->where('id',$rs[1])->update(['top'=>time(),
		]);
		if($result){
			$this->success('置顶成功','all/index');
		}else{
			$this->error('置顶失败');
		}
	}
	
	public function caneltop(){
				
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$result = Db::table('hm_all')->where('id',$rs[1])->update(['top'=>'1',
		]);
		if($result){
			$this->success('取消置顶成功','all/index');
		}else{
			$this->error('取消置顶失败');
		}
	}
	
}
