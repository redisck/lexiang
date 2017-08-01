<?php
namespace app\admin\controller;
use \think\View;
use \think\Db;
use \think\Request;
use \think\Cache;
use \think\Controller;
class Search extends Base
{
    public function index()
    {

		$result = Db::table('hm_keys')->field('id,key_name')->select();
			
		$view = new View();
		
		$view->assign('data',$result);
		
		return $view->fetch('search');
	
	}
	
	public function dokeys(){
		if (Request::instance()->isAjax()){
			$cate['name'] = $_POST['name'];
			$cate['module'] = $_POST['test'];
			Cache::set('name',$_POST['name']);	
			Cache::set('module',$_POST['test']);	
		}
		$data['key_name'] = Cache::get('name');
		$data['module'] = Cache::get('module');
		$result = Db::table('hm_keys')->insert($data);
		if($result){
			echo '1';
		}else{
			$this->error('新增失败');
		}
	}
	
	public function dosearch(){
		
		$aData = input('post.search');
		$vv = Db::table('hm_keys')->field('id,key_name')->select();
		$result = Db::table('hm_product')->field('id,title,vice_heading,activity,add_time,url,img,status')->where('title','like','%'.$aData.'%')->paginate(5);
		if($result){
			$data = $result;
			$company = Db::table('hm_company')->field('id,title,vice_heading,content,add_time,url')->where('title','like','%'.$aData.'%')->paginate(5);
		}elseif($company){
			$data = $company;
			$product = Db::table('hm_module_product')->field('id,title,vice_heading,add_time,url')->where('title','like','%'.$aData.'%')->paginate(5);
		}elseif($product){
			$data = $product;
		}
		

		
		$view = new View();
		
		$view->assign('search',$data);
		$view->assign('data',$vv);
		
		return $view->fetch('search');
		
	}
	
		
}
