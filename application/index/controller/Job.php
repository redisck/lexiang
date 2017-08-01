<?php
namespace app\index\controller;
use \think\View;
use \think\Db;
use \think\Cache;
use \think\Request;
class Job extends Base
{
    public function index()
    {
		$aData = input('post.search');
		$result = Db::table('hm_cate_job')->field('id,cate_name')->where('cate_name','like','%'.$aData.'%')->paginate(5);
		
		$view = new View();
		
		$view->assign('data',$result);
		$view->assign('roleName',Cache::get('role_name'));
		
		return $view->fetch('index');
	
	}
	
	public function add(){
		
		$view = new View();
		return view();
	}
	

	
	public function doadd(){
		$data['cate_name'] = $_POST['cate_name'];
		$result = Db::table('hm_cate_job')->insert($data);
		if($result){
			$this->success('添加成功','job/index');
		}else{
			$this->error('新增失败');
		}
	}
	
	public function delete(){
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_cate_job')->where('id',$rs[1])->delete();
		
		if($data){
			$this->success('删除成功','job/index');
		}else{
			$this->error('删除失败','job/index');
		}	
	}
	
	
}
