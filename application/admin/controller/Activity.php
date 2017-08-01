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
class Activity extends Controller
{
    public function index()
    {
		$result = Db::table('hm_huodong')->order('id desc')->limit(1)->select();
		
		$view = new View();
		
		$view->assign('data',$result[0]);
		
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
		
		$data = Db::table('hm_huodong')->where('id',$rs[1])->delete();
		
		if($data){
			$this->success('删除成功','Activity/index');
		}	
			
	}
	
	public function allist()
    {
		$aData = input('post.search');
		$result = Db::table('hm_huodong')->field('id,news,vice_heading,img,img2')->where('news','like','%'.$aData.'%')->paginate(10);
		
		$view = new View();
		
		$view->assign('data',$result);

		
		return $view->fetch('list');
	
	}
	
	public function edit(){
		
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_huodong')->where('id',$rs[1])->find();
		
		$summay = Db::table('hm_news_head')->order('id desc')->limit(1)->find();
		
			
		$view = new View();
		
		
		$view->assign('data',$data);
		
		$view->assign('summary',$summay);
		
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
		
		$data['vice_heading'] = $_POST['vice_heading'];
		$data['news'] = $_POST['title'];
		$data['content'] = empty($_POST['myContent'])?'话梅':$_POST['myContent'];
		$data['key'] = $_POST['key'];
		$data['img'] = $_POST['package1'];
		$data['img2'] = $_POST['package2'];
		$result = Db::table('hm_huodong')->insert($data);
		if($result){		
			$this->success('添加成功','activity/index');
		}else{
			$this->error('新增失败');
		}
		
	}
	
		public function doedit(){
		$data['id'] = $_POST['id'];
		$data['vice_heading'] = $_POST['vice_heading'];
		$data['news'] = $_POST['title'];
		$data['img'] = empty($_POST['package1'])?$_POST['img']:$_POST['package1'];
		$data['img2'] = empty($_POST['package2'])?$_POST['img2']:$_POST['package2'];
		$data['content'] = empty($_POST['myContent'])?'话梅':$_POST['myContent'];
		//$head['icon'] = empty($_POST['package3'])?$_POST['icon']:$_POST['package3'];
		//$head['image'] = empty($_POST['package4'])?$_POST['image']:$_POST['package4'];
		//$head['head_id'] =  Request::instance()->param('head_id');
		
		
		//$head_result = Db::table('hm_news_head') ->where('id',$head['head_id'])->update(['title' => $data['news'],'icon'=>$head['icon'],'image'=>$head['image'],]);
		
		$result = Db::table('hm_huodong')->where('id',$data['id'])->update(['news'=>$data['news'],
			'img'=>$data['img'],
			'vice_heading'=>$data['vice_heading'],
			'img2'=>$data['img2'],
			'content'=>$data['content'],
		]);
		if($result){
			$this->success('修改成功','activity/index');
		}else{
			$this->error('修改失败');
		}
	}
	
	
	
}
