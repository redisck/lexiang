<?php
namespace app\index\controller;
use \think\View;
use \think\Db;
use \think\Cache;
use \think\Request;
class Role extends Base
{

	public function index(){
		
		
		$view = new View();
		return view('index');
	}
	
	public function add(){
		
		if(Request::instance()->isPost()){
		$data = array();
		$data['name'] = input('post.name');
		$aData = array();
		$aData['admin_name'] = input('post.email');
		$aData['admin_password'] = md5(input('post.passwd'));
		$order = input('post.company/a');
		$goods = input('post.goods/a');
		$substance = input('post.substance/a');
		$user = input('post.user/a');
		
		$role_info = Db::table('hm_role')->insert($data);
			$roleId = Db::table('hm_role')->getLastInsID();
			$role_count = count($order);
			$goods_count = count($goods);
			$substance_count = count($substance);
			$user_count =count($user);
		
			if($roleId){
				$aData['role_id'] = $roleId;
				$aData['login_time'] = time();
				$aData['login_ip'] = Request::instance()->ip();
				$admin_info = Db::table('hm_admin')->insert($aData);
				for ($i=0; $i < $role_count ; $i++) { 
					$order_info = explode('_', $order[$i]);
					$accData = array(
						'role_id' => $roleId,
						'node' => $order_info[0],
						'controller' => $order_info[1]
					);
					$order_res = Db::table('hm_role_access')->insert($accData);
				}
				for ($j=0; $j < $goods_count ; $j++) { 
					$goods_info = explode('_', $goods[$j]);
					$acceData = array(
						'role_id' => $roleId,
						'node' => $goods_info[0],
						'controller' => $goods_info[1]
					);
					$goods_res = Db::table('hm_role_access')->insert($acceData);
				}
				
				for ($j=0; $j < $substance_count ; $j++) { 
					$substance_info = explode('_', $substance[$j]);
					$acceData = array(
						'role_id' => $roleId,
						'node' => $substance_info[0],
						'controller' => $substance_info[1]
					);
					$substance_res = Db::table('hm_role_access')->insert($acceData);
				}
				
				for ($j=0; $j < $user_count ; $j++) { 
					$user_info = explode('_', $user[$j]);
					$acceData = array(
						'role_id' => $roleId,
						'node' => $user_info[0],
						'controller' => $user_info[1]
					);
					$user_res = Db::table('hm_role_access')->insert($acceData);
				}
				return $this->redirect('role/index');
			}
		
		$view = new View();
		return view();
	
	}
	}
	
}
