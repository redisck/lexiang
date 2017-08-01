<?php
namespace app\index\controller;
use \think\View;
use \think\Request;
use \think\Db;
use \think\Controller;
use \think\Cache;
class Manager extends Base
{
    public function index()
    {
		$aData = input('post.search');
		//$result = Db::table('hm_company')->field('id,title,vice_heading,add_time,img,author')->where('title','like','%'.$aData.'%')->paginate(5);
		
		$result = Db::table('hm_admin')->field('id,admin_name,admin_password,role_id,login_time,beizhu,login_ip')->where('admin_name','like','%'.$aData.'%')->paginate(5);
		
		$view = new View();
		$view->assign('data',$result);
		$view->assign('roleName',Cache::get('role_name'));
		return $view->fetch();
	
	}
	
	
	public function add(){
		
		$role = Db::table('hm_role')->select();
		$this->assign('role',$role);
		
		$view = new View();
		$view->assign('roleName',Cache::get('role_name'));
		return view();
		
	}
	
	public function edit(){
		
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_admin')->where('id',$rs[1])->find();
		
		$role = Db::table('hm_role')->select();
		
		$this->assign('role',$role);
		
		$this->assign('data',$data);
			
		$view = new View();
		
		return view();
	}
	

	
	public function delete(){
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		if($rs[1]!='1'){
			$role_id = Db::table('hm_admin')->where('id',$rs[1])->find();
			
			$data = Db::table('hm_admin')->where('id',$rs[1])->delete();
			$data = Db::table('hm_role')->where('id',$role_id['role_id'])->delete();
			$data = Db::table('hm_role_access')->where('role_id',$role_id['role_id'])->delete();
		
		if($data){
			$this->success('删除成功','manager/index');
		}else{
			$this->error('删除失败','manager/index');
		}	
		}else{
			$this->redirect('manager/index');
		}
		
		
	}
	
	
	public function doadd(){
		
		$data['admin_name'] = Request::instance()->param('admin_name');
		$data['admin_password'] = md5(Request::instance()->param('admin_pwd'));
		$data['role_id'] = Request::instance()->param('role');
		$data['beizhu'] = Request::instance()->param('beizhu');
		$data['login_time'] = time();
		$data['login_ip'] = $_SERVER["REMOTE_ADDR"];  
		$result = Db::table('hm_admin')->insert($data);
		if($result){
			  $this->success('新增成功', 'manager/index');
		}else{
				$this->error('新增失败');	
		}
		
	}
	
		public function doedit(){
		
		$data['id'] = $_POST['id'];
		$data['admin_name'] = $_POST['email'];
		$data['admin_password'] = md5($_POST['admin_pwd']);
		$data['role_id'] = $_POST['role_id'];
		$data['beizhu'] = $_POST['beizhu'];
		$data['login_time'] = time();
		$data['login_ip'] = $_SERVER["REMOTE_ADDR"];  
		$result = Db::table('hm_admin')->where('id',$data['id'])->update(['admin_name'=>$data['admin_name'],'login_ip'=>$data['login_ip'],
			'login_time'=>$data['login_time'],
			'admin_password'=>$data['admin_password'],
			'role_id'=>$data['role_id'],
			'beizhu'=>$data['beizhu'],
		]);
		if($result){
			$this->success('修改成功','manager/index');
		}else{
			$this->error('修改失败');
		}
	}
	
	
	
}
