<?php
namespace app\admin\controller;
use \think\View;
use \think\Db;
use \think\Response;
use \think\Request;
use \think\Cache;
class Friend extends Base
{
    public function index()
    {
    	$aData = input('post.search');
		$result = Db::table('hm_friendship_link')->field('id,name,url,img')->where('name','like','%'.$aData.'%')->paginate(5);


		$view = new View();

		$view->assign('data',$result);
		
		return $view->fetch('index');
	
	}
	
	public function add(){

		$result = Db::table('hm_link')->field('id,name,link')->select();
	
		$view = new View();
		
		$view->assign('data',$result);
		
		return $view->fetch();
	
	}

	public function delete(){
		$Request = Request::instance();
		$path = $Request ->path();
		$rs = explode("=", $path);

		$data = Db::name('friendship_link')->where('id',$rs[1])->delete();
		if($data){
			$this->success('删除成功','friend/index');
		}

	}
	
	public function dolink(){
		if (Request::instance()->isAjax()){
			$cate['name'] = $_POST['name'];

			Cache::set('name',$_POST['name']);	
		}
		$data['name'] = Cache::get('name');
		$result = Db::table('hm_link')->insert($data);
		if($result){
			echo '1';
		}else{
			$this->error('新增失败');
		}
	}
	

	
	public function doadd(){
		
		$data['url'] = $_POST['url'];
		$img = Db::table('hm_im')->select();
		$data['img'] = $img[0]['img'];
		if (Request::instance()->isAjax()){
			$cate['name'] = $_POST['name'];

			Cache::set('name',$_POST['name']);	
		}
		
		$data['name'] = Cache::get('name');
		$Result = Db::name('friendship_link')->insert($data);
		if($Result){
			$this->success('添加成功','friend/index');
		}else{
			$this->error('添加失败');
		}
	
	}

	
}
