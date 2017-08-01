<?php
namespace app\index\controller;
use \think\View;
use \think\Db;
use \think\Cache;
use \think\Request;
class Town extends Base
{
    public function index()
    {
		$aData = input('post.search');
		$result = Db::table('hm_sh_city')->field('id,city_name')->where('city_name','like','%'.$aData.'%')->paginate(5);
		
		$view = new View();
		
		$view->assign('data',$result);
		$view->assign('roleName',Cache::get('role_name'));
		
		return $view->fetch('index');
	
	}
	
	public function add_store(){
		
		$view = new View();
		return view('add_store');
	}
	
	public function add_city(){
		
		$view = new View();
		return view('add_city');
	}
	
	public function docity(){
		$data['city_name'] = $_POST['city_name'];
		$result = Db::table('hm_sh_city')->insert($data);
		if($result){
			$this->success('添加成功','town/index');
		}else{
			$this->error('新增失败');
		}
	}
	
	public function delete(){
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_sh_city')->where('id',$rs[1])->delete();
		
		if($data){
			$this->success('删除成功','town/index');
		}else{
			$this->error('删除失败','town/index');
		}	
	}
	
	public function tab_delete(){
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_store')->where('id',$rs[1])->delete();
		
		if($data){
			$this->success('删除成功','town/tabulate');
		}else{
			$this->error('删除失败','town/tabulate');
		}	
	}
	
	public function doadd(){
		
		$data['store_name'] = $_POST['shopname'];
		$data['url'] = $_POST['url'];
		$data['add_time'] = strtotime($_POST['time']);
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
		$data['image'] = $info->getSaveName();
		$result = Db::table('hm_store')->insert($data);
		if($result){
			$this->success('添加成功','town/tabulate');
		}else{
			$this->error('新增失败');
		}
	}
	
	public function tabulate(){
		$aData = input('post.search');
		$result = Db::table('hm_store')->field('id,store_name,add_time,url')->where('store_name','like','%'.$aData.'%')->paginate(5);
		$view = new View();
		$view->assign('data',$result);
		$view->assign('roleName',Cache::get('role_name'));
		
		return $view->fetch('list');
	}
}
