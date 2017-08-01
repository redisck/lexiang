<?php
namespace app\index\controller;
use \think\View;
use \think\Db;
use \think\Cache;
use \think\Request;
class Background extends Base
{
    public function index()
    {
		
		$result = Db::table('hm_backgroundimg')->field('id,bg_img,bg_content,is_display,module')->paginate(5);
		
		$view = new View();
		
		$view->assign('data',$result);
		$view->assign('roleName',Cache::get('role_name'));
		
		return $view->fetch('index');
	
	}
	
	public function add(){
		
		$view = new View();
		return view('add');
	}
	

	public function delete(){
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_backgroundimg')->where('id',$rs[1])->delete();
		
		if($data){
			$this->success('删除成功','background/index');
		}else{
			$this->error('删除失败','background/index');
		}	
	}
	
	
	public function doadd(){
		
		$data['module'] = $_POST['modulename'];
		$file = request()->file('image');
		 if($file==NULL){
			 $rs = $_SERVER["HTTP_REFERER"];
			$this->redirect($rs); 
		 }
		$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
		if($info){
		}else{

			echo $file->getError();
		}
		$data['bg_img'] = $info->getSaveName();
		$result = Db::table('hm_backgroundimg')->insert($data);
		if($result){
			$this->success('添加成功','background/index');
		}else{
			$this->error('新增失败');
		}
	}
	
	public function edit(){
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_backgroundimg')->where('id',$rs[1])->find();
		
		
 
		$this->assign('data',$data);
	
		$view = new View();
		
		return view();
	}
	
	public function doedit(){
		
		$file = request()->file('image');
		 if($file==NULL){
			 $back_name = Request::instance()->param('back_name');
			 if($back_name){
				 $data['bg_img'] = $back_name;
			 }else{
				 $rs = $_SERVER["HTTP_REFERER"];
				$this->redirect($rs);
			 }			
		 }else{
			 $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'); 
			$data['bg_img'] = $info->getSaveName();
			if($info){
				
			}else{
				echo $file->getError();
			}
		 }

		$data['id'] = Request::instance()->param('id');
		$data['module'] = Request::instance()->param('modulename');

		$result = Db::table('hm_backgroundimg')->where('id',$data['id'])->update(['module'=>$data['module'],
			'bg_img'=>$data['bg_img'],
		]);
		if($result){
			$this->success('修改成功','background/index');
		}else{
			$this->error('修改失败');
		}
	}
	
}
