<?php
namespace app\index\controller;
use \think\View;
use \think\Db;
use \think\Cache;
use \think\Request;
use \think\Controller;
use \think\Session;
use \think\Config;
class Base extends Controller
{
	public function _initialize(){
		//不存在，跳转登录
		$role_id = Cache::get('role_id');
		$admin_name = Cache::get('admin_name');
		if(empty($role_id)||empty($admin_name)){
			$this->redirect('admin/index');
		}
		//权限白名单
		
		//$acc = array('Index/index','Goods/index','Company/add','Company/edit','Company/del','Substance/add','Substance/edit','Substance/del','User/add','User/edit','User/del','User/index');
		$acc = Config::load(APP_PATH.'config/role.php');
		$request = \think\Request::instance();	 
		if(Cache::get('role_id')!=1){
			$acc_info = Db::table('hm_role_access')->where('role_id',Cache::get('role_id'))->select();
			$array = array();
			foreach ($acc_info as $k => $v) {
				
				$array[]= $v['node'].'/'.$v['controller'];
			}
			
			$ess = $request->controller().'/'.$request->action();
			if(!in_array($ess, $acc)){
				if(!in_array($ess, $array)){
					$this->error('无权操作');
				}
			}
		}
		//$title = "话梅";
		Session::set('roleName',Cache::get('role_name'));
		//$this->assign('roleName',Cache::get('role_name'));
	}
}