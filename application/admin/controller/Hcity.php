<?php
namespace app\admin\controller;
use \think\View;
use \think\Db;
use \think\Cache;
use \think\Request;
use \think\Controller;
class Hcity extends Base
{
    public function index()
    {
		
		$result = Db::table('hm_sh_city')->field('id,city_name')->select();
		
		$list = Db::table('hm_city_head')->order('id desc')->limit(1)->select();
		

		$view = new View();
		
		$view->assign('data',$result);
		$view->assign('list',$list[0]);
		
		return $view->fetch('physical_store');
	
	}
	
	public function allist()
    {
		$aData = input('post.search');
		$result = Db::table('hm_city')->field('id,title,vice_heading,name,img,url')->where('title','like','%'.$aData.'%')->paginate(10);
		
		$view = new View();
		
		$view->assign('data',$result);

		
		return $view->fetch('list');
	
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
		
		$summay = Db::table('hm_sh_city')->field('id,city_name')->select();
		
		$img = Db::table('hm_city_head')->order('id desc')->limit(1)->find();
		
			
		$view = new View();
		
		$view->assign('data',$summay);
		
		$view->assign('list',$data);
		$view->assign('img',$img);
		
		return $view->fetch();
	}
	
	
		public function doadd(){
		if (Request::instance()->isAjax()){
			$cate['city'] = $_POST['name'];

			Cache::set('city',$_POST['name']);	
		}
		$data['city'] = Cache::get('city');
		$data['vice_heading'] = $_POST['vice_heading'];
		$data['title'] = $_POST['title'];
		if(empty($_POST['package1']) || empty($_POST['package2']) || empty($_POST['package4'])){
			 $rs = $_SERVER["HTTP_REFERER"];
			$this->redirect($rs); 
		}
		$data['address'] = $_POST['address'];
		$data['tel'] = $_POST['tel'];
		$data['business_hours'] = $_POST['business_hours'];
		$head['icon'] = $_POST['package1'];
		$head['image'] = $_POST['package2'];
		$data['img'] = $_POST['package4'];
		$result = Db::table('hm_city')->insert($data);
		$result_head = Db::table('hm_city_head')->insert($head);
		if($result and $result_head){			
			$this->success('添加成功','hcity/index');
		}else{
			$this->error('新增失败');
		}
		
	
	}
	
	public function docity(){
		if (Request::instance()->isAjax()){
			$cate['name'] = $_POST['name'];

			Cache::set('name',$_POST['name']);	
		}
		$data['city_name'] = Cache::get('name');
		$result = Db::table('hm_sh_city')->insert($data);
		if($result){
			//Db::execute('truncate hm_im');			
			//$this->success('添加成功','index/index');
			echo '1';
		}else{
			$this->error('新增失败');
		}
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
		$head['icon'] = empty($_POST['package1'])?$_POST['icon']:$_POST['package1'];
		$head['image'] = empty($_POST['package2'])?$_POST['image']:$_POST['package2'];
		$data['img'] = empty($_POST['package4'])?$_POST['img']:$_POST['package4'];
		$head['title'] = $_POST['title'];
		$data['address'] = $_POST['address'];
		$data['tel'] = $_POST['tel'];
		$data['business_hours'] = $_POST['business_hours'];
		$head['head_id'] =  Request::instance()->param('head_id');
		
		
		$head_result = Db::table('hm_city_head') ->where('id',$head['head_id'])->update(['title' => $head['title'],'icon'=>$head['icon'],'image'=>$head['image'],]);
		
		$result = Db::table('hm_city')->where('id',$data['id'])->update(['title'=>$data['title'],
			'img'=>$data['img'],
			'vice_heading'=>$data['vice_heading'],
			'address'=>$data['address'],
			'tel'=>$data['tel'],
			'business_hours'=>$data['business_hours'],
		]);
		if($result or $head_result){
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
