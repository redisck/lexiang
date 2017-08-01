<?php
namespace app\admin\controller;
use \think\View;
use \think\Db;
use \think\Cache;
use \think\Request;
use \think\Controller;
class Recruit extends Base
{
    public function index()
    {
		$aData = input('post.search');
		$result = Db::table('hm_cate_job')->field('id,cate_name')->where('cate_name','like','%'.$aData.'%')->paginate(5);
		
		$view = new View();
		
		$view->assign('data',$result);
		
		return $view->fetch('recruit');
	
	}
	
	public function edit(){
		
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_substance')->where('id',$rs[1])->find();
		
		$summay = Db::table('hm_substance_head')->field('id,icon,image')->order('id desc')->find();
		
		$result = Db::table('hm_cate_job')->field('id,cate_name')->paginate(5);
	
		$view = new View();
		$view->assign('list',$data);
		$view->assign('data',$summay);
		$view->assign('cate',$result);
		
		return $view->fetch();
	}
	
	public function doedit(){
		
		$data['id'] = $_POST['id'];
		$data['title'] = $_POST['title'];
		$data['vice_heading'] = $_POST['vice_heading'];
		$data['content'] = $_POST['content'];
		$img = Db::table('hm_im')->select();
		$head['title'] = $_POST['title'];
		$head['icon'] = $img[0]['img'];
		$head['image'] = $img[1]['img'];
		$data['vice_img'] = $img[2]['img'];
		$head['head_id'] =  Request::instance()->param('head_id');
		
		
		$head_result = Db::table('hm_substance_head') ->where('id',$head['head_id'])->update(['title' => $head['title'],'icon'=>$head['icon'],'image'=>$head['image'],]);
		
		$result = Db::table('hm_substance')->where('id',$data['id'])->update(['title'=>$data['title'],
			'img'=>$head['image'],
			'vice_heading'=>$data['vice_heading'],
			'content'=>$data['content'],
		]);
		if($result or $head_result){
			$this->success('修改成功','recruit/index');
		}else{
			$this->error('修改失败');
		}
	
	}
	
	public function allist()
    {
		$aData = input('post.search');
		$result = Db::table('hm_substance')->field('id,title,vice_heading,name,img,key')->where('title','like','%'.$aData.'%')->paginate(10);
		
		$view = new View();
		
		$view->assign('data',$result);

		
		return $view->fetch('list');
	
	}
	
	
	public function docate(){
		if (Request::instance()->isAjax()){
			$cate['name'] = $_POST['name'];

			Cache::set('name',$_POST['name']);	
		}
		$data['cate_name'] = Cache::get('name');
		$result = Db::table('hm_cate_job')->insert($data);
		if($result){						
			//$this->success('添加成功','index/index');
			echo '1';
		}else{
			$this->error('新增失败');
		}
	}
	
	public function add(){
		
		$view = new View();
		return view();
	}
	
	public function upload(){
			 
		if($_FILES['file']['tmp_name']){
					$file = request()->file('file');
					$info = $file->move(ROOT_PATH . 'public' . DS . '/uploads/');
					$data['img']=$info->getSaveName();
					
					if($data['img']){
							Db::table('hm_im')->insert($data);
			}
	
		}

	} 

	
	public function doadd(){
		if (Request::instance()->isAjax()){
			$cate['module'] = $_POST['name'];

			Cache::set('module',$_POST['name']);	
		}
		$data['name'] = Cache::get('module');
		$data['vice_heading'] = $_POST['vice_heading'];
		$data['title'] = $_POST['title'];
		$img = Db::table('hm_im')->select();
		$data['img'] = $img[0]['img'];
		$head['icon'] = $img[0]['img'];
		$head['image'] = $img[0]['img'];
		$result = Db::table('hm_substance')->insert($data);
		$result_head = Db::table('hm_job_head')->insert($head);
		if($result and $result_head){
			Db::execute('truncate hm_im');			
			$this->success('添加成功','recruit/index');
		}else{
			$this->error('新增失败');
		}
	}
	

	
	
}
