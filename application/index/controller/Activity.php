<?php
namespace app\index\controller;
use \think\View;
use \think\Request;
use \think\Db;
use \think\Cache;
use \think\Paginator;
use \think\Config;
class Activity extends Base
{
    public function index()
    {
		$aData = input('post.search');
		$result = Db::table('hm_module_product')->field('id,title,vice_heading,activity,all_store,add_time,status,collect_status,img')->where('title','like','%'.$aData.'%')->paginate(10);
		
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
		
		$data = Db::table('hm_module_product')->where('id',$rs[1])->delete();
		
		if($data){
			$this->success('删除成功','Activity/index');
		}	
			
	}
	
	public function edit(){
		
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_module_product')->where('id',$rs[1])->find();
		
		$summay = Db::table('hm_product_head')->order('id desc')->limit(1)->find();
		
		 
		$this->assign('data',$data);
		
		$this->assign('summary',$summay);
			
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
		$filenav = request()->file('nav');
		 if($filenav==NULL){
			 $rs = $_SERVER["HTTP_REFERER"];
			$this->redirect($rs); 
		 }
		$infonav = $filenav->move(ROOT_PATH . 'public' . DS . 'uploads');
		if($infonav){
		}else{

			echo $infonav->getError();
		}
		
		$fileicon = request()->file('icon');
		if($fileicon ==NULL){
			$rs = $_SERVER['HTTP_REFERER'];
			$this->redirect($rs);
		}
		$infoicon = $fileicon ->move(ROOT_PATH . 'public' . DS .'uploads');
		if($infoicon){
		}else{
			echo $infoicon->getError();
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
		
		$data['title'] = $_POST['shopname'];
		$data['all_store'] = $_POST['all_store'];
		$data['add_time'] = strtotime($_POST['time']);
		$data['vice_heading'] = $_POST['vice_heading'];
		$head['title'] = $_POST['summary'];
		$head['icon'] = $infoicon ->getSaveName();
		$head['image'] = $info_image ->getSaveName();
		$data['city'] = $_POST['city_id'];
		$data['key'] = $_POST['key'];
		$data['img'] = $info->getSaveName();
		$data['vice_img'] = $info2->getSaveName();
		$data['nav_img'] = $infonav->getSaveName();
		$head_id = Db::table('hm_product_head')->insert($head);
	
		$result = Db::table('hm_module_product')->insert($data);
		if($result){
			$this->success('添加成功','Activity/index');
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
		
	
		$filenav = request()->file('nav');
		if($filenav==NULL){
			$image_nav = Request::instance()->param('image_s');
			if($image_nav){
			$data['nav_img'] = $image_nav;
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
		if($fileicon ==NULL){
			$icon_name = Request::instance()->param('icon_name');
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
		if($head_image == NULL){
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
		
		
		
		$data['id'] = Request::instance()->param('id');
		$data['title'] = Request::instance()->param('shopname');
		$data['begin_time'] = strtotime($_POST['time']);
		$data['current_price'] = $_POST['current_price'];
		$data['city_id'] = $_POST['city_id'];
		$data['cate_id'] = $_POST['cate_id'];
		$data['status'] = $_POST['checkbox'];
		$data['url'] = $_POST['url'];
		$data['key'] = Request::instance()->param('key');
		$head['head_id'] =  Request::instance()->param('head_id');
		$head['title'] = $_POST['summary'];
		$head_result = Db::table('hm_product_head') ->where('id',$head['head_id'])->update(['title' => $head['title'],'icon'=>$head['icon'],'image'=>$head['image'],]);

		if($data['status'] =='on'){
			$data['status'] = '1';
		}else{
			$data['status'] = '0';
		}
		

		$result = Db::table('hm_module_product')->where('id',$data['id'])->update(['title'=>$data['title'],'add_time'=>$data['begin_time'],
			'city'=>$data['city_id'],
			'all_store'=>$data['cate_id'],
			'status'=>$data['status'],
			'head_id'=>$head['head_id'],
			'url'=>$data['url'],
			'img'=>$data['img'],
			'key'=>$data['key'],
			'vice_img'=>$data['vice_img'],
			'nav_img'=>$data['nav_img'],
		]);
		if($result){
			$this->success('修改成功','Activity/index');
		}else{
			$this->error('修改失败');
		}
	}
	
}
