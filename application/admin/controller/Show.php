<?php
namespace app\admin\controller;
use \think\View;
use \think\Db;
use \think\Request;
use \think\Cache;
use \think\Controller;
class Show extends Base
{
    public function index()
    {

		
		$list = Db::table('hm_store')->order('id desc')->limit(1)->select();
		
		$view = new View();
		
		$view->assign('list',$list[0]);

		
		return $view->fetch('hot_products');
	
	}
	
	public function add(){
		$view = new View();
		
		return view('add');
	}
	
	public function allist()
    {
	
		$result = Db::table('hm_store')->field('id,name,vice_heading,image,title,url')->paginate(10);
		
		$view = new View();
		
		$view->assign('data',$result);

		
		return $view->fetch('list');
	
	}
	
/* 	public function upload(){
		
	
		if($_FILES['file']['tmp_name']){
                $file = request()->file('file');
                $info = $file->move(ROOT_PATH . 'public' . DS . '/uploads/');
                $data['img']=$info->getSaveName();
				if($data['img']){
						Db::table('hm_im')->insert($data);
				}

		}
	
		if($result){
			 $this->success('新增成功', 'company/index');
		}else{
			$this->error('添加失败');
		}
		
		
	} */
	
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
	
	
	public function edit(){
		
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_store')->where('id',$rs[1])->find();
		
		$summay = Db::table('hm_store_head')->field('id,icon,image')->order('id desc')->find();
	
		$view = new View();
		$view->assign('list',$data);
		$view->assign('data',$summay);
		
		return $view->fetch();
	}
	


	
	public function delete(){
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_store')->where('id',$rs[1])->delete();
		
		if($data){
			$this->success('删除成功','show/index');
		}else{
			$this->error('删除失败','show/index');
		}	
	}
	

	
	
	
	public function doadd(){
		
		$data['content'] = $_POST['content'];
		$data['title'] = $_POST['title'];
		$data['key'] = $_POST['key'];
		$data['image'] = $_POST['package1'];
		$data['vice_img'] = $_POST['package2'];
		$head['icon'] = $_POST['package4'];
		$result = Db::table('hm_store')->insert($data);
		$result_head = Db::table('hm_store_head')->insert($head);
		if($result && $result_head){		
			$this->success('添加成功','show/index');
		}else{
			$this->error('新增失败');
		}
		
	}
	
	public function doedit(){
		
		$data['id'] = $_POST['id'];
		$data['title'] = $_POST['title'];
		$data['content'] = $_POST['content'];
		$data['key'] = $_POST['key'];
		$data['image'] = empty($_POST['package1'])?$_POST['icon']:$_POST['package1'];
		$data['vice_img'] = empty($_POST['package2'])?$_POST['image']:$_POST['package2'];
		$head['head_id'] =  Request::instance()->param('head_id');
		$head['icon'] = $data['image'];
		$head['image'] = $data['vice_img'];
		
		
		$head_result = Db::table('hm_store_head') ->where('id',$head['head_id'])->update(['title' => $data['title'],'icon'=>$head['icon'],'image'=>$head['image'],]);
		
		$result = Db::table('hm_store')->where('id',$data['id'])->update(['title'=>$data['title'],
			'image'=>$data['image'],
			'vice_img'=>$data['vice_img'],
			'key'=>$data['key'],
			'content'=>$data['content'],
		]);
		if($result or $head_result){
			$this->success('修改成功','show/index');
		}else{
			$this->error('修改失败');
		}
	
	}
	


	
	
	
	
	
}
