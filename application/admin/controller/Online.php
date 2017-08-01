<?php
namespace app\admin\controller;
use \think\View;
use \think\Request;
use \think\Db;
use \think\Cache;
use \think\Paginator;
use \think\Controller;
class Online extends Base
{
    public function index()
    {

		$result = Db::table('hm_diamonds')->field('id,name,url')->select();
		
		$list = Db::table('hm_product_head')->order('id desc')->limit(1)->select();
		
		$view = new View();
		

		
		$view->assign('data',$result);
		$view->assign('list',$list[0]);
		
		
		return $view->fetch('online_products');

	
	}
	
	public function dolink(){
		if (Request::instance()->isAjax()){
			$cate['name'] = $_POST['name'];

			Cache::set('name',$_POST['name']);	
		}
		$data['name'] = Cache::get('name');
		$result = Db::table('hm_diamonds')->insert($data);
		if($result){			
		if($result){			
			//$this->success('添加成功','index/index');
			echo '1';
		}else{
			$this->error('新增失败');
		}
	}
	}
	
	
		public function doadd(){
		if (Request::instance()->isAjax()){
			$cate['module'] = $_POST['name'];

			Cache::set('module',$_POST['name']);	
		}
		$data['all_store'] = Cache::get('module');
		$data['vice_heading'] = $_POST['vice_heading'];
		$data['title'] = $_POST['title'];
		$data['url'] = $_POST['url'];
		$data['key'] = $_POST['key'];
		$data['img'] = $_POST['package1'];
		$data['img2'] = $_POST['package2'];
		$head['icon'] = $_POST['package4'];
		$result = Db::table('hm_product')->insert($data);
		$result_head = Db::table('hm_product_head')->insert($head);
		if($result and $result_head){		
			$this->success('添加成功','online/index');
		}else{
			$this->error('新增失败');
		}
	}
	
	public function delete(){
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_product')->where('id',$rs[1])->delete();
		
		if($data){
			$this->success('删除成功','online/index');
		}else{
			$this->error('删除失败','online/index');
		}	
	}
	
	public function edit(){
		
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_product')->where('id',$rs[1])->find();
		$head = Db::table('hm_product_head')->order('id desc')->limit(1)->find();
		
		$summay = Db::table('hm_flagship')->field('id,store_name')->select();
		
		
		$this->assign('store',$summay);
		
		$this->assign('list',$data);
		$this->assign('head',$head);
			
		$view = new View();
		
		return view();
	}
	
	public function allist()
    {
		$aData = input('post.search');
		$result = Db::table('hm_product')->field('id,img,vice_heading,img2,title,url')->where('title','like','%'.$aData.'%')->paginate(10);
		
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
	
	public function doedit(){
		
		$data['id'] = $_POST['id'];
		$data['vice_heading'] = $_POST['vice_heading'];
		$data['title'] = $_POST['title'];
		$data['img'] = empty($_POST['package1'])?$_POST['image']:$_POST['package1'];
		$data['img2'] = empty($_POST['package2'])?$_POST['vice_img']:$_POST['package2'];
		$head['icon'] = empty($_POST['package4'])?$_POST['icon']:$_POST['package4'];
		$head['head_id'] =  Request::instance()->param('head_id');
		
		
		$head_result = Db::table('hm_product_head') ->where('id',$head['head_id'])->update(['title' => $data['title'],'icon'=>$head['icon'],'image'=>$data['img2'],]);
		
		$result = Db::table('hm_product')->where('id',$data['id'])->update(['title'=>$data['title'],
			'img'=>$data['img'],
			'vice_heading'=>$data['vice_heading'],
			'img2'=>$data['img2'],
		]);
		if($result or $head_result){
			$this->success('修改成功','online/index');
		}else{
			$this->error('修改失败');
		}

	}
	
}
