<?php
namespace app\index\controller;
use \think\View;
use \think\Db;
use \think\Response;
use \think\Request;
use \think\Cache;
class Index extends Base
{
    public function index()
    {
		
		$view = new View();
		$data['count'] = Db::table('hm_product')->count('id');
		//$paylist = array('1','2');
		//$paylist = array_column($arr,array(5,20,36,10,10,20));
		//$view->assign('paylist',json_encode($paylist));
		//$view->assign('paylist',json_encode($paylist));
		$records = array('1','6','8','7','10','7');
		
		$view->assign('paylist',json_encode($records));
		//$view->assign('data',$data);
		
		return $view->fetch('index');
	
	}
	
	public function add(){
		$data['count'] = Db::table('hm_product')->count('id');
		$data['company'] = Db::table('hm_company')->count('id');
		$data['substance'] = Db::table('hm_substance')->count('id');
		$data['city'] = Db::table('hm_city')->count('id');
		//$view = new View();
		//$view->assign('data',$data);
		//return $view->fetch('index');
		   // $this->ajaxReturn('message','ok',1);
		 // $data = ['name'=>'thinkphp','url'=>'thinkphp.cn'];
        // 指定json数据输出
		  $eqq['status'] = 1;
        $eqq['info'] = 'info';
	}
}
