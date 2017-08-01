<?php
namespace app\admin\controller;
use \think\View;
use \think\Db;
use \think\Cache;
use \think\Request;
use \think\File;
use \think\Controller;
class Background  extends Controller
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
	
 public function upload(){
		 
		if($_FILES['file']['tmp_name']){
                $file = request()->file('file');
                $info = $file->move(ROOT_PATH . 'public' . DS . '/uploads/');
                $data['img']=$info->getSaveName();
				
				if($data['img']){
						Db::table('hm_im')->insert($data);
				}
			
        }
		
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
	
	public function allist()
    {
	
		$result = Db::table('hm_backgroundimg')->field('id,bg_img,bg_content,module,is_display')->select();
		
		$view = new View();
		
		$view->assign('data',$result);

		
		return $view->fetch('list');
	
	}
	
	
	public function doadd(){
		
		$data['module'] = $_POST['company'];
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
	
	public function vv(){
		
		if (Request::instance()->isAjax()){
			$cate['module'] = $_POST['name'];

			Cache::set('module',$_POST['name']);
             
		}
	 	$img = Db::table('hm_im')->select();
		 if(!$img){
			 $rs = $_SERVER["HTTP_REFERER"];
			$this->redirect($rs); 
		 }
		$img = Db::table('hm_im')->select();
		$cate['bg_img'] = $img[0]['img'];
		$cate['module'] = $_POST['module'];
		$cate['bg_content'] = Cache::get('module');
		//$cate['bg_img'] = Cache::get('bg_img');
		$result = Db::table('hm_backgroundimg')->insert($cate);
		if($result){
			Db::execute('truncate hm_im');	
			 $this->success('新增成功', 'Background/index');
		}else{
			$this->error('添加失败');
		}
		
		
	}
	
	
	public function mm(){
		
		if (Request::instance()->isAjax()){
			$cate['module'] = $_POST['name'];

			Cache::set('url',$_POST['name']);	
		}
	
		if($_FILES['file']['tmp_name']){
                $file = request()->file('file');
                $info = $file->move(ROOT_PATH . 'public' . DS . '/uploads/');
                $data['bg_img']=$info->getSaveName();
				Cache::set('bg_img',$data['bg_img']);

		}
		$cate['id'] = $_POST['id'];
		$cate['bg_content'] = Cache::get('url');
		$cate['bg_img'] = Cache::get('bg_img');
		$result = Db::table('hm_backgroundimg')->where('id', $cate['id'])->update(['bg_content' => $cate['bg_content'],'bg_img'=>$cate['bg_img']]);
		if($result){
			Db::execute('truncate hm_im');	
			 $this->success('编辑成功', 'background/index');
		}else{
			$this->error('编辑失败');
		}	
	}
	
	
	public function edit(){
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_backgroundimg')->where('id',$rs[1])->find();
		
		$view = new View();
		
		$view->assign('data',$data);
		
		return $view->fetch();
	}
	
	public function doedit(){
		
		$data['id'] = $_POST['id'];
		$img = Db::table('hm_im')->select();
		if($img){
			$head['img'] = $img[0]['img'];
		}else{
			$head['img'] = $_POST['icon'];
		}
		
		$result = Db::table('hm_backgroundimg')->where('id',$data['id'])->update(['bg_img'=>$head['img'],
			//'img'=>$head['icon'],
			//'vice_img'=>$head['image'],
		]);
		if($result){
			Db::execute('truncate hm_im');	
			$this->success('修改成功','background/index');
		}else{
			$this->error('修改失败');
		}
	
	}
	
}
