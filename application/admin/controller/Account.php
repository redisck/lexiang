<?php
namespace app\admin\controller;
use \think\View;
use \think\Request;
use \think\Db;
use \think\Cache;
use \think\Paginator;
use \think\Config;
use think\File;
use think\Controller;
class Account extends Controller
{
    public function index()
    {
        $result = Db::table('hm_admin')->field('id,admin_name,login_time,login_ip')->select();
		
		$view = new View();
		
		$view->assign('data',$result);
		
		return $view->fetch('index');

    }
	
	public function dolink(){
		if (Request::instance()->isAjax()){
			$cate['name'] = $_POST['name'];

			Cache::set('name',$_POST['name']);	
		}
		$data['name'] = Cache::get('name');
		$result = Db::table('hm_link')->insert($data);
		if($result){
			echo '1';
		}else{
			$this->error('新增失败');
		}
	}
	
	
	public function doadd(){
		$data['title'] = $_POST['module'];
		$data['url'] = $_POST['url'];
		$img = Db::table('hm_im')->select();
		$data['img'] = $img[0]['img'];
		$data['nav_img'] = $img[0]['img'];
		$result = Db::table('hm_all')->insert($data);
		if($result){
			Db::execute('truncate hm_im');			
			$this->success('添加成功','index/index');
		}else{
			$this->error('新增失败');
		}
	}
	
	public function vv(){
		
		if (Request::instance()->isAjax()){
			$cate['module'] = $_POST['name'];

			Cache::set('url',$_POST['name']);	
		}
	
		$img = Db::table('hm_im')->select();
		$cate['img'] = $img[0]['img'];
		$cate['nav_img'] = $img[0]['img'];
		$cate['url'] = $_POST['url'];
		$cate['link_name'] = Cache::get('url');
		$cate['module'] = Cache::get('all');
		$result = Db::table('hm_all')->insert($cate);
		if($result){
			 $this->success('新增成功', 'index/index');
		}else{
			$this->error('添加失败');
		}	
	}
	
	public function all(){
		
		if (Request::instance()->isAjax()){
			$cate['module'] = $_POST['all'];

			Cache::set('all',$_POST['all']);	
		}
	
		
	}
}
