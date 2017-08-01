<?php
namespace app\admin\controller;

use \think\View;
use \think\Db;
use \think\Controller;
use \think\Cache;
use \think\Request;
use \think\File;
class Guide extends Base
{
	
	 public function index()
    {
		
		
		$view = new View();
	
		
		return $view->fetch('guide');

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
		$data['name'] = $_POST['module'];
		$img = Db::table('hm_im')->select();
		$data['img'] = $img[0]['img'];
		$result = Db::table('hm_guide')->insert($data);
		if($result){
			Db::execute('truncate hm_im');			
			$this->success('添加成功','guide/index');
		}else{
			$this->error('新增失败');
		}
	}
	
		public function allist()
    {
		$aData = input('post.search');
		$result = Db::table('hm_guide')->field('id,img,name,guide')->where('name','like','%'.$aData.'%')->paginate(10);
		
		$view = new View();
		
		$view->assign('data',$result);

		
		return $view->fetch('list');
	
	}
	
	public function edit(){
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_guide')->where('id',$rs[1])->find();
		
	
		$view = new View();
		$view->assign('data',$data);
		
		return $view->fetch();
	}
	
	  public function delete()
    {
        
		
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);

		$data = Db::table('hm_guide')->where('id',$rs[1])->delete();
		
		if($data){
			$this->success('删除成功','guide/index');
		}	
			
    }
	
	public function doedit(){
		
		$data['id'] = $_POST['id'];
		if (Request::instance()->isAjax()){
			$cate['module'] = $_POST['name'];

			Cache::set('module',$_POST['name']);	
		}
		$img = Db::table('hm_im')->select();
		if($img){
			$head['img'] = $img[0]['img'];
		}else{
			$head['img'] = $_POST['icon'];
		}
		
		$result = Db::table('hm_guide')->where('id',$data['id'])->update(['img'=>$head['img'],
			//'img'=>$head['icon'],
			//'vice_img'=>$head['image'],
		]);
		if($result){
			$this->success('修改成功','guide/index');
		}else{
			$this->error('修改失败');
		}
	
	}
	
	public function mm(){
		
		if (Request::instance()->isAjax()){
			$cate['module'] = $_POST['name'];

			Cache::set('url',$_POST['name']);	
		}
	
	/* 	$img = Db::table('hm_im')->select();
		if($img){
			$cate['img'] = $img[0]['img'];
		}else{
			$cate['img'] = $_POST['icon'];
		} */
	/* 	if($_FILES['file']['tmp_name']){
                $file = request()->file('file');
                $info = $file->move(ROOT_PATH . 'public' . DS . '/uploads/');
                $data['bg_img']=$info->getSaveName();
				Cache::set('bg_img',$data['bg_img']);

		} */
		$cate['id'] = $_POST['id'];
		$cate['guide'] = Cache::get('url');
		$img = Db::table('hm_im')->select();
		if($img){
			$cate['img'] = $img[0]['img'];
		}
		//$cate['img'] = Cache::get('bg_img');
		//$cate['img'] = $data['bg_img'];
		$$cate['img'] = empty($cate['img'])?$_POST['icon']:$cate['img'];
		$result = Db::table('hm_guide')->where('id', $cate['id'])->update(['guide' => $cate['guide'],'img'=>$cate['img']]);
		if($result){
			 $this->success('编辑成功', 'guide/index');
		}else{
			$this->error('编辑失败');
		}	
	}
	
	
	public function vv(){
		
		if (Request::instance()->isAjax()){
			$cate['module'] = $_POST['name'];

			Cache::set('module',$_POST['name']);	
		}
		
		$img = Db::table('hm_im')->select();
		if($img){
			$cate['img'] = $img[0]['img'];
		}
		
		$cate['name'] = $_POST['module'];
		$cate['guide'] = Cache::get('module');
		$result = Db::table('hm_guide')->insert($cate);
		if($result){
			 $this->success('新增成功', 'guide/index');
		}else{
			$this->error('添加失败');
		}
		
		
	}
}