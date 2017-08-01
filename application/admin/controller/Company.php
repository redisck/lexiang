<?php
namespace app\admin\controller;
use \think\View;
use \think\Db;
use \think\Request;
use \think\Cache;
use \think\Controller;
class Company extends Base
{
    public function index()
    {

		$result = Db::table('hm_company_head')->order('id desc')->limit(1)->select();
		
		$view = new View();
		
		$view->assign('data',$result[0]);

		
		return $view->fetch('index');
	
	}
	
	  public function allist()
    {
		$aData = input('post.search');
		$result = Db::table('hm_company')->field('id,title,vice_heading,add_time,img,author')->where('title','like','%'.$aData.'%')->paginate(5);
		
		$view = new View();
		
		$view->assign('data',$result);
		$view->assign('roleName',Cache::get('role_name'));
		
		return $view->fetch('list');
	
	}
	
	
	public function add(){
		$view = new View();
		
		return view('add');
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
	
	public function edit(){
		
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_company')->where('id',$rs[1])->find();
		
		$summay = Db::table('hm_company_head')->order('id desc')->find();
		
		$this->assign('summary',$summay);
		
		$this->assign('data',$data);
			
		$view = new View();
		
		return view();
	}
	



	
	public function delete(){
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_company')->where('id',$rs[1])->delete();
		
		if($data){
			$this->success('删除成功','company/index');
		}else{
			$this->error('删除失败','company/index');
		}	
	}
	

	
	
	public function doadd(){
		
		$data['vice_heading'] = $_POST['vice_heading'];
		$data['title'] = $_POST['title'];
		$data['content'] = empty($_POST['myContent'])?'话梅':$_POST['myContent'];
		$head['icon'] = $_POST['package1'];
		$head['image'] = $_POST['package2'];
		$result = Db::table('hm_company')->insert($data);
		$result_head = Db::table('hm_company_head')->insert($head);
		if($result and $result_head){
			
			$this->success('添加成功','company/index');
		}else{
			$this->error('新增失败');
		}
		
	}
	
	public function doedit(){
		$data['id'] = $_POST['id'];
		$data['vice_heading'] = $_POST['vice_heading'];
		$data['title'] = $_POST['title'];
		$data['content'] = empty($_POST['myContent'])?'话梅':$_POST['myContent'];
		$head['icon'] = empty($_POST['package1'])?$_POST['img']:$_POST['package1'];
		$head['image'] = empty($_POST['package2'])?$_POST['vice_img']:$_POST['package2'];;
		$head['title'] = $_POST['title'];
		
		$head['head_id'] =  Request::instance()->param('head_id');
		
		
		$head_result = Db::table('hm_company_head') ->where('id',$head['head_id'])->update(['title' => $head['title'],'icon'=>$head['icon'],'image'=>$head['image'],]);
		
		$result = Db::table('hm_company')->where('id',$data['id'])->update(['title'=>$data['title'],
			'img'=>$head['image'],
			'vice_heading'=>$data['vice_heading'],
			'content'=>$data['content'],
		]);
		if($result or $head_result){
			$this->success('修改成功','company/index');
		}else{
			$this->error('修改失败');
		}
	}
		
	
	
}
