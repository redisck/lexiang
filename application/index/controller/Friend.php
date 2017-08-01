<?php
namespace app\index\controller;
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

		
		$view = new View();
		
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
	
	public function doadd(){

		$file = Request() ->file('image');
		if($file == NULL){
			$rs = $_SERVER['HTTP_REFERER'];
			$this->redirect($rs);
		}
		$info = $file->move(ROOT_PATH . 'public' . DS .'uploads');
		if($info){
		}else{
			echo $file->getError();
		}

		$data['name'] = Request::instance()->param('shopname');
		$data['img'] = $info->getSaveName();
		$data['url'] = Request::instance()->param('url');
		$Result = Db::name('friendship_link')->insert($data);
		if($Result){
			$this->success('添加成功','friend/index');
		}else{
			$this->error('添加失败','friend/index');
		}
 
	}

	public function edit(){

		
	}

	public function doedit(){

		
	}
}
