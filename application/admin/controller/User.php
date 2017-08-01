<?php
namespace app\admin\controller;
use \think\View;
use \think\Request;
use \think\Db;
use \think\Controller;
use \think\Cache;
class User extends Base
{
    public function index()
    {
		
		$aData = input('post.search');
		$result = Db::table('hm_user')->field('id,user_name,email,mobile,weixin,my_intro')->where('user_name','like','%'.$aData.'%')->paginate(5);
		
		$view = new View();
		$view->assign('data',$result);
		$view->assign('roleName',Cache::get('role_name'));
		return $view->fetch('list');
	
	}
	
	
	public function add(){
		
		$view = new View();
		$view->assign('roleName',Cache::get('role_name'));
		return view();
		
	}
	
	public function edit(){
		
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_user')->where('id',$rs[1])->find();
		
		$this->assign('data',$data);
			
		$view = new View();
		
		return view();
	}
	
	
	public function user_list(){
		
		$aData = input('post.search');
		$result = Db::table('hm_user')->field('id,user_name,email,mobile,weixin,my_intro')->where('user_name','like','%'.$aData.'%')->paginate(5);
		
		$view = new View();
		
		$this->assign('data',$result);
		
		return view('list');
	}
	
	public function delete(){
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_user')->where('id',$rs[1])->delete();
		
		if($data){
			$this->success('删除成功','user/index');
		}else{
			$this->error('删除失败','user/index');
		}	
	}
	
	
	public function doadd(){
		
		$data['user_name'] = Request::instance()->param('user_name');
		$data['email'] = Request::instance()->param('email');
		$data['mobile'] = Request::instance()->param('mobile');
		$data['user_pwd'] = md5(Request::instance()->param('user_pwd'));
		$data['weixin'] = Request::instance()->param('weixin');
		$data['my_intro'] = Request::instance()->param('my_intro');
		
		$result = Db::table('hm_user')->insert($data);
		if($result){
			  $this->success('新增成功', 'user/index');
		}else{
				$this->error('新增失败');	
		}
		
	}
	
		public function doedit(){
		
		$data['id'] = $_POST['id'];
		$data['user_name'] = $_POST['user_name'];
		$data['mobile'] = $_POST['mobile'];
		$data['email'] = $_POST['email'];
		$data['user_pwd'] = md5($_POST['user_pwd']);
		$data['my_intro'] = $_POST['my_intro'];
		$data['weixin'] = $_POST['weixin'];
		$result = Db::table('hm_user')->where('id',$data['id'])->update(['user_name'=>$data['user_name'],'mobile'=>$data['mobile'],
			'email'=>$data['email'],
			'user_pwd'=>$data['user_pwd'],
			'weixin'=>$data['weixin'],
			'my_intro'=>$data['my_intro'],
		]);
		if($result){
			$this->success('修改成功','user/index');
		}else{
			$this->error('修改失败');
		}
	}
	
	
	
}
