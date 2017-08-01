<?php
namespace app\admin\controller;
use \think\View;
use \think\Request;
use \think\Db;
use \think\Cache;
use \think\Paginator;
use \think\Controller;
class Goods extends Base
{
    public function index()
    {	
		$aData = input('post.search');
		$result = Db::table('hm_product')->field('id,title,vice_heading,activity,all_store,add_time,status,collect_status,img,img2')->where('title','like','%'.$aData.'%')->paginate(5);
		
		$view = new View();
		
		$view->assign('data',$result);
		$view->assign('roleName',Cache::get('role_name'));
		
		return $view->fetch('hot_products');

	
	}
	
	public function add(){
		
		$data['name'] = $_POST['module'];
		$data['vice_heading'] = $_POST['vice_heading'];
		$data['title'] = $_POST['title'];
		$data['key'] = $_POST['new_title'];
		$data['key'] = $_POST['key'];
		$data['activity'] = $_POST['content'];
		$img = Db::table('hm_im')->select();
		$data['img'] = $img[0]['img'];
		$data['nav_img'] = $img[0]['img'];
		$data['vice_img'] = $img[0]['img'];
		$result = Db::table('hm_module_product')->insert($data);
		if($result){
			Db::execute('truncate hm_im');			
			$this->success('添加成功','goods/index');
		}else{
			$this->error('新增失败');
		}
	}
	
	public function delete(){
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_product')->where('id',$rs[1])->delete();
		
		if($data){
			$this->success('删除成功','Goods/index');
		}else{
			$this->error('删除失败','Goods/index');
		}	
	}
	
	public function edit(){
		
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_product')->where('id',$rs[1])->find();
		
		$summay = Db::table('hm_store_head')->where('id',$data['head_id'])->find();
		
		
		$this->assign('summary',$summay);
		
		$this->assign('data',$data);
			
		$view = new View();
		
		return view();
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
	
	public function doedit(){
		
		$file = request()->file('image');
		 if($file==NULL){
			 $image_f = Request::instance()->param('image_f');
			 if($image_f){
				 $data['img'] = $image_f;
			 }else{
				 $rs = $_SERVER["HTTP_REFERER"];
				$this->redirect($rs); 	
			 }
			
		 }else{
			$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
			$data['img'] = $info->getSaveName();
			if($info){
			}else{

				echo $file->getError();
			}	
		 }
	
		
		 $file_t = request()->file('image_two');
		 if($file_t==NULL){
			 $image_t = Request::instance()->param('image_t');
			 if($image_t){
				 $data['img2'] = $image_t;
			 }else{
				 $rs = $_SERVER["HTTP_REFERER"];
				$this->redirect($rs); 	
			 }
			
		 }else{
			$info_t = $file_t->move(ROOT_PATH . 'public' . DS . 'uploads');
			$data['img2'] = $info_t->getSaveName();
			if($info_t){
			}else{

				echo $file_t->getError();
			}
		 }
		
		$fileicon = request()->file('icon');
		if($fileicon ==NULL){
			$icon_name = Request::instance()->param('icon_name');
			if($icon_name){
				$head['icon']= $icon_name;
			}else{
				$rs = $_SERVER['HTTP_REFERER'];
				$this->redirect($rs);	
			}
			
		}else{
			$infoicon = $fileicon ->move(ROOT_PATH . 'public' . DS .'uploads');
			$head['icon'] = $infoicon ->getSaveName();
			if($infoicon){
			}else{
				echo $fileicon->getError();
			}
		}
		
		
		$head_image = request()->file('head_image');
		if($head_image ==NULL){
			$head_image_name = Request::instance()->param('head_image_name');
			if($head_image_name){
				$head['image'] = $head_image_name;
			}else{
				$rs = $_SERVER['HTTP_REFERER'];
				$this->redirect($rs);
			}
			
		}else{
			$info_image = $head_image ->move(ROOT_PATH . 'public' . DS . 'uploads');
			$head['image'] = $info_image ->getSaveName();
			if($info_image){
			}else{
				echo $info_image->getError();
			}
		}
		
		$data['id'] = $_POST['id'];
		$data['title'] = $_POST['shopname'];
		$data['begin_time'] = strtotime($_POST['time']);
		$data['current_price'] = $_POST['current_price'];
		$data['city_id'] = $_POST['city_id'];
		$data['cate_id'] = $_POST['cate_id'];
		$data['status'] = $_POST['checkbox'];
		$data['url'] = $_POST['url'];
		$data['key'] = Request::instance()->param('key');
		$head['id'] = Request::instance()->param('head_id');
		$head['title'] = $_POST['summary'];
		
	
		$head_result = Db::table('hm_store_head') ->where('id',$head['id'])->update(['title' => $head['title'],'icon'=>$head['icon'],'image'=>$head['image'],]);
		if($data['status'] =='on'){
			$data['status'] = '1';
		}else{
			$data['status'] = '0';
		}
	
		$data['head_id'] = $head['id'];
	
		$result = Db::table('hm_product')->where('id',$data['id'])->update(['title'=>$data['title'],'add_time'=>$data['begin_time'],
			'city'=>$data['city_id'],
			'all_store'=>$data['cate_id'],
			'status'=>$data['status'],
			'key'=>$data['key'],
			'head_id'=>$data['head_id'],
			'url'=>$data['url'],
			'img'=>$data['img'],
			'img2'=>$data['img2'],
		]);
		if($result or $head_result){
			$this->success('修改成功','Goods/index');
		}else{
			$this->error('修改失败');
		}
	}
	
}
