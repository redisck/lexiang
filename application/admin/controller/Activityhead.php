<?php
namespace app\admin\controller;
use \think\View;
use \think\Request;
use \think\Db;
use \think\Cache;
use \think\Paginator;
use \think\Config;
use think\File;
use think\Controller;
class Activityhead extends Controller
{
    public function index()
    {
		
		$result = Db::table('hm_news_head')->order('id desc')->limit(1)->find();
		
		$view = new View();
		
		$view->assign('data',$result);
		
		return $view->fetch('activity');

	
	}
	
	public function add(){
		
		$view = new View();
		
		return view('add');
	}
	
	public function delete(){
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_news_head')->where('id',$rs[1])->delete();
		
		if($data){
			$this->success('删除成功','Activityhead/index');
		}	
			
	}
	
	public function allist()
    {
		$aData = input('post.search');
		$result = Db::table('hm_news_head')->field('id,title,icon,image')->where('title','like','%'.$aData.'%')->paginate(10);
		
		$view = new View();
		
		$view->assign('data',$result);

		
		return $view->fetch('list');
	
	}
	
	public function edit(){
		
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_news_head')->where('id',$rs[1])->find();
		
			
		$view = new View();
		
		
		$view->assign('data',$data);
		
		
		return $view->fetch('edit');
	}
	
	
	public function upload(){
		
	
		if($_FILES['file']['tmp_name']){
                $file = request()->file('file');
                $info = $file->move(ROOT_PATH . 'public' . DS . '/uploads/');
                $data['img']=$info->getSaveName();
		}
		
		exit($data['img']);
	
		
	} 
	
	public function doadd(){
		
		$head['title'] = $_POST['title'];
		$head['icon'] = $_POST['package1'];
		$head['image'] = $_POST['package2'];
		$result_head = Db::table('hm_news_head')->insert($head);
		if($result_head){		
			$this->success('添加成功','activityhead/index');
		}else{
			$this->error('新增失败');
		}
		
	}
	
		public function doedit(){
		$data['id'] = $_POST['id'];
		//$data['vice_heading'] = $_POST['vice_heading'];
		$data['title'] = $_POST['title'];
		$data['icon'] = empty($_POST['package1'])?$_POST['icon']:$_POST['package1'];
		$data['image'] = empty($_POST['package2'])?$_POST['image']:$_POST['package2'];

		
		$head_result = Db::table('hm_news_head') ->where('id',$data['id'])->update(['title' => $data['title'],'icon'=>$data['icon'],'image'=>$data['image'],]);
		

		if($head_result){
			$this->success('修改成功','activityhead/index');
		}else{
			$this->error('修改失败');
		}
	}
	
	
	
}
