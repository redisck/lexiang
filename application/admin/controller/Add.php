<?php
namespace app\admin\controller;

use \think\View;
use \think\Db;
use \think\Controller;
use \think\Config;
use \think\Request;
class Add extends Controller
{
	
	 public function index()
    {
		
		
		$view = new View();
	
		
		return $view->fetch('add_module');

	}
	
	public function allist()
    {
		$aData = input('post.search');
		$result = Db::table('hm_all')->field('id,link_name,img,vice_img,title,vice_heading,module')->where('module','=','4')->paginate(10);
		
		$view = new View();
		
		$view->assign('data',$result);

		
		return $view->fetch('list');
	
	}
	
	public function edit(){
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_all')->where('id',$rs[1])->find();
		
		$view = new View();
		
		$view->assign('data',$data);
		
		return $view->fetch();
	}
	
	public function doedit(){
		
		$data['id'] = $_POST['id'];
		$head['img'] = empty($_POST['package1'])?$_POST['img']:$_POST['package1'];
		$head['vice_img'] = empty($_POST['package2'])?$_POST['vice_img']:$_POST['package2'];
		$data['title'] = $_POST['title'];
		$data['vice_heading'] = $_POST['vice_heading'];
		$result = Db::table('hm_all')->where('id',$data['id'])->update(['img'=>$head['img'],
			'title'=>$data['title'],
			'vice_img'=>$head['vice_img'],
			'vice_heading'=>$data['vice_heading'],
		]);
		if($result){
			$this->success('修改成功','add/index');
		}else{
			$this->error('修改失败');
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
	
	 public function delete()
    {
        
		
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);

		$data = Db::table('hm_all')->where('id',$rs[1])->delete();
		
		if($data){
			$this->success('删除成功','add/index');
		}	
			
    }
	
	
		public function doadd(){
		$data['vice_heading'] = $_POST['vice_heading'];
		$data['title'] = $_POST['title'];
		$data['img'] = $_POST['package1'];
		$data['vice_img'] = $_POST['package2'];
		$data['module'] = '4';
		$result = Db::table('hm_all')->insert($data);
		if($result){
		
			$this->success('添加成功','add/index');
		}else{
			$this->error('新增失败');
		}
	}
}