<?php
namespace app\index\controller;
use \think\View;
use \think\Db;
use \think\Response;
use \think\Request;
use \think\Cache;
class Second extends Base
{
    public function index()
    {
		
		$view = new View();
		
		$data = Db::select(function($query){
			$query->table('hm_other_huodong');
		});

		$view->assign('data',$data);
		return $view->fetch('index');
	
	}
	
	public function add(){
		
		$view = new View();
		
		return $view->fetch();
	
	}

	public function delete(){
		$request = Request::instance();
		$path = $request ->path();
		$rs = explode('=', $path);

		$data =Db::table('hm_other_huodong')->where('id',$rs[1])->delete();
		if($data){
			$this->success('删除成功','second/index');
		}else{
			$this->error('删除错误','second/index');
		}
	}
	
	public function doadd(){
		
		$file = request()->file('image');
		if($file == NULL){
			$data['img'] = 'a5.png';
		}else{
			$info = $file->move(ROOT_PATH .'public' . DS .'uploads' );
			$data['img'] = $info ->getSaveName();
			if($info){

			}else{
				echo $file->getError();
			}
		}
		

		$fileicon = request()->file('icon');
		if($fileicon == NULL){
			$head['icon'] = 'a5.png';
		}else{
			$infoicon = $fileicon -> move(ROOT_PATH . 'public' . DS . 'uploads');
			$head['icon'] = $infoicon -> getSaveName();
			if($infoicon){
			}else{
				echo $infoicon->getError();
			}
		}

		$head_image = request() -> file('head_image');
		if($head_image == NULL){
			$head['image'] = 'a5.png';
		}else{
			$info_image = $head_image -> move(ROOT_PATH . 'public' . DS . 'uploads');
			$head['image'] = $info_image -> getSaveName();
			if($info_image){

			}else{
				echo $info_image->getError();
			}
		}

		$data['news'] = Request::instance()->param('news');
		$data['vice_heading'] = Request::instance() ->param('vice_heading');
		$data['summary'] = Request::instance()->param('summary');
		$data['key'] = Request::instance()->param('key');
		$data['add_time'] = Request::instance()->param('time');
		$data['url'] = Request::instance() -> param('url');
		$data['author'] = Request::instance() -> param('author');
		$data['content'] = Request::instance() -> param('myContent');

		$id = Db::table('hm_other_huodong_head')->insert($head);
		$result = DB::table('hm_other_huodong')->insert($data);
		if($result){
			$this->success('添加成功','Second/index');
		}else{
			$this->error('添加失败');
		}
	}

	public function edit(){

		$request = Request::instance();
		$path = $request ->path();
		$rs = explode('=', $path);
		
		$summary = Db::select(function($query){
			$query->table('hm_other_huodong_head')->where('id','1')->order('id desc')->limit(1);
		});

		$query = new \think\db\Query();
		 $query->table('hm_other_huodong')->where('id',$rs[1]);
		$data = Db::find($query);
		
		$view = new View();
		
		$view -> assign('data',$data);
		$view -> assign('summary',$summary[0]);
		return $view->fetch();
	}

	public function doedit(){

		$file = request() -> file('image');
		if($file == NULL){
			$image_master = Request::instance() -> param('image_master');
			if($image_master){
				$data['img'] = $image_master;
			}else{
				$rs = $_SERVER['HTTP_REFERER'];
				$this ->redirect($rs);
			}
		}else{
			$info = $file ->move(ROOT_PATH . 'public' . DS .'uploads');
			$data['img'] = $info->getSaveName();
			if($info){
			}else{
				echo $file->getError();
			}
		}

		$fileicon = request() ->file('icon');
		if($fileicon == NULL){
			$icon_name = Request::instance() ->param('icon_name');
			if($icon_name){
				$head['icon'] = $icon_name;
			}else{
				$rs = $_SERVER['HTTP_REFERER'];
				$this->redirect($rs);
			}
		}else{
			$infoicon = $fileicon->move(ROOT_PATH . 'public' . DS . 'uploads');
			$head['icon'] = $infoicon ->getSaveName();
			if($infoicon){
			}else{
				echo $infoicon->getError();
			}
		}

		$head_image = request() -> file('head_image');
		if($head_image == NULL){
			$head_image_name = Request::instance() ->param('head_image_name');
			if($head_image_name){
				$head['image'] = $head_image_name;
			}else{
				$rs = $_SERVER['HTTP_REFERER'];
				$this->redirect($rs);
			}
		}else{
			$info_image = $head_image -> move(ROOT_PATH . 'public' . DS .'uploads');
			$head['image'] = $info_image -> getSaveName();
			if($info_image){
			}else{
				echo $info_image -> getError();
			}
		}

		$data['id'] = Request::instance() -> param('id');
		$data['title'] = Request::instance() -> param('title');
		$data['vice_heading'] = Request::instance() -> param('vice_heading');
		$data['key'] = Request::instance() ->param('key');
		$data['add_time'] = strtotime(Request::instance() -> param('add_time'));
		$data['url'] = Request::instance() -> param('url');
		$data['author'] = Request::instance() -> param('author');
		$data['content'] = Request::instance() ->param('myContent');
 
		$head['title'] = Request::instance() -> param('summary');
		$head['id'] = Request::instance() ->param('head_id');

		$head_result = Db::table('hm_other_huodong_head')->where('id',$head['id'])->update(['title'=>$head['title'],
			'icon'=>$head['icon'],
			'image'=>$head['image'],
			]);
		$result = Db::table('hm_other_huodong')->where('id',$data['id'])->update(['news'=>$data['title'],'add_time'=>$data['add_time'],
			'vice_heading'=>$data['vice_heading'],
			'key'=>$data['key'],
			'url'=>$data['url'],
			'author'=>$data['author'],
			'content'=>$data['content'],
			]);
		if($result or $head_result){
			$this->success('修改成功','second/index');
		}else{
			$this->error('修改失败');
		}
	}
}
