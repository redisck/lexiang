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
class Index extends Base
{
    public function index()
    {
        $result = Db::table('hm_link')->field('id,name,link')->select();
		
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
		$data['nav_img'] = $img[1]['img'];
		$result = Db::table('hm_all')->insert($data);
		if($result){
			Db::execute('truncate hm_im');			
			$this->success('添加成功','index/index');
		}else{
			$this->error('新增失败');
		}
	}
	
	public function allist()
    {
		$aData = input('post.search');
		$result = Db::table('hm_all')->field('id,img,module,nav_img,title,link_name,vice_heading,url')->where('title','like','%'.$aData.'%')->paginate(10);
		
		$view = new View();
		
		$view->assign('data',$result);

		
		return $view->fetch('list');
	
	}
	
	
	public function edit(){
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_all')->where('id',$rs[1])->find();
		
		$result = Db::table('hm_link')->field('id,name,link')->select();
	
		$view = new View();
		
		$view->assign('list',$data);
		$view->assign('data',$result);
		
		return $view->fetch();
	}
	
	  public function delete()
    {
        
		
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);

		$data = Db::table('hm_all')->where('id',$rs[1])->delete();
		
		if($data){
			$this->success('删除成功','index/index');
		}	
			
    }
	
	public function doedit(){
		
		$data['id'] = $_POST['id'];
		$data['url'] = $_POST['url'];
		$img = Db::table('hm_im')->select();
		if($img){
			$head['icon'] = $img[0]['img'];
			$head['image'] = $img[1]['img'];
		}else{
			
		}
		$head['icon'] = empty($head['icon'])?$_POST['icon']:$head['icon'];
		$head['image'] = empty($head['image'])?$_POST['image']:$head['image'];
		
		$result = Db::table('hm_all')->where('id',$data['id'])->update(['url'=>$data['url'],
			'img'=>$head['icon'],
			'vice_img'=>$head['image'],
		]);
		if($result){
			$this->success('修改成功','index/index');
		}else{
			$this->error('修改失败');
		}
	
	}
	
	
	public function vv(){
		
		if (Request::instance()->isAjax()){
			$cate['module'] = $_POST['name'];

			Cache::set('url',$_POST['name']);	
		}
	
		$img = Db::table('hm_im')->select();
		if(!$img){
				 $rs = $_SERVER["HTTP_REFERER"];
				$this->redirect($rs); 
			}
		$cate['img'] = $img[0]['img'];
		$cate['nav_img'] = $img[1]['img'];
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
	
	public function mm(){
		
		if (Request::instance()->isAjax()){
			$cate['module'] = $_POST['name'];

			Cache::set('url',$_POST['name']);	
		}
	
		$img = Db::table('hm_im')->select();
		if(count($img)>0){
			$cate['img'] = $img[0]['img'];
			$cate['nav_img'] = $img[1]['img'];
		}else{
			$cate['img'] = $_POST['icon'];
			$cate['nav_img'] = $_POST['image'];
		}
		$cate['id'] = $_POST['id'];
		$cate['url'] = $_POST['url'];
		$cate['link_name'] = Cache::get('url');
		$cate['module'] = Cache::get('all');
		$cate['img'] = empty($cate['img'])?$_POST['icon']:$cate['img'];
		$cate['nav_img'] = empty($cate['image'])?$_POST['image']:$cate['image'];
		$result = Db::table('hm_all')->where('id', $cate['id'])->update(['url' => $cate['url'],'link_name'=>$cate['link_name'],'module'=>$cate['module'],
			'img'=>$cate['img'],
			'nav_img'=>$cate['nav_img']
		]);
		if($result){
			 $this->success('编辑成功', 'index/index');
		}else{
			$this->error('编辑失败');
		}	
	}
	
	public function all(){
		
		if (Request::instance()->isAjax()){
			$cate['module'] = $_POST['all'];

			Cache::set('all',$_POST['all']);	
		}
	
		
	}
}
