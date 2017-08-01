<?php
namespace app\index\controller;
use \think\View;
use \think\Db;
use \think\Request;
use \think\Cache;
class Search extends Base
{
    public function index()
    {
		$aData = input('post.search');
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
		
		$view->assign('data',$data);
		$view->assign('roleName',Cache::get('role_name'));
		
		return $view->fetch('index');
	
	}
	
	public function testSphinx()
{
      $s = new \SphinxClient;
      $s->setServer("localhost", 9312);
      $s->SetArrayResult (true );
      $s->setMatchMode(SPH_MATCH_ANY);
      $s->setMaxQueryTime(3);
      $result = $s->query("test");
      $result = $result['matches'];
      $result = array_column($result,'id');
     // $list = M('CouponApi')->field('couponid,title,description')->where(array('couponid'=>array('in',$result)))->select();
      $list = Db::table('hm_company')->field('id,title,vice_heading,content,add_time,url')->where('title','like','%'.$aData.'%')->paginate(5);
      dump($list);
}
	
		
}
