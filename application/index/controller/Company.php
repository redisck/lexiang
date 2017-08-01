<?php
namespace app\index\controller;
use \think\View;
use \think\Db;
use \think\Request;
use \think\Cache;
class Company extends Base
{
    public function index()
    {
		$aData = input('post.search');
		$result = Db::table('hm_company')->field('id,title,vice_heading,add_time,img,author')->where('title','like','%'.$aData.'%')->paginate(5);
		
		$view = new View();
		
		$view->assign('data',$result);
		$view->assign('roleName',Cache::get('role_name'));
		
		return $view->fetch('index');
	
	}
	
	public function add(){
		$view = new View();
		
		return view('add');
	}
	
	public function edit(){
		
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_company')->where('id',$rs[1])->find();
		
		$summay = Db::table('hm_company_head')->where('id',$data['head_id'])->find();
		
		 $summay['icon'] = str_replace('uploads/','',$summay['icon']);
		 $summay['image'] = str_replace('uploads/','',$summay['image']);
		
		 $data['img'] = str_replace('uploads/','',$data['img']);


		$this->assign('summary',$summay);
		
		$this->assign('data',$data);
			
		$view = new View();
		
		return view();
	}
	
	public function head(){
		$view = new View();
		
		return view('head');
	}
	
	public function dohead(){
		
		$file = request()->file('icon');
		 if($file==NULL){
			 $rs = $_SERVER["HTTP_REFERER"];
			$this->redirect($rs); 
		 }
		$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
		if($info){
		}else{

			echo $file->getError();
		}
		$filehead = request()->file('head_image');
		 if($filehead==NULL){
			 $rs = $_SERVER["HTTP_REFERER"];
			$this->redirect($rs); 
		 }
		$infohead = $filehead->move(ROOT_PATH . 'public' . DS . 'uploads');
		if($infohead){
		}else{

			echo $filehead->getError();
		}
		$data['title'] = Request::instance()->param('title');
		$data['icon'] = $info->getSaveName();
		$data['image'] = $infohead->getSaveName();
		
		$result = Db::table('hm_activity_head')->insert($data);
		if($result){
			$this->success('添加成功','company/headlist');
		}else{
			$this->error('新增失败');
		}
		
	}
	
	public function headlist(){
		$aData = input('post.search');
		$result = Db::table('hm_activity_head')->field('id,title,icon,image')->where('title','like','%'.$aData.'%')->paginate(5);
		
		$view = new View();
		
		$view->assign('data',$result);
		$view->assign('roleName',Cache::get('role_name'));
		
		return $view->fetch('head_index');
		
	}
	
	public function head_edit(){
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_activity_head')->where('id',$rs[1])->find();
		$view = new View();
		$view->assign('data',$data);
		return $view->fetch();
	}
	
	public function do_head_edit(){
		$file =request()->file('icon');
		if($file == NULL){
			$icon_name = Request::instance()->param('icon_name');
			if($icon_name){
				$head['icon'] = $icon_name;
			}else{
				$rs = $_SERVER['HTTP_REFERER'];
				$this->redirect($rs);
			}
		}else{
			$info = $file->move(ROOT_PATH.'public'.DS.'uploads');
			$head['icon'] = $info->getSaveName();
			if($info){
			}else{
				echo $file->getError();
			}
		}
		
		
		$fileimage = request()->file('head_image');
		if($fileimage ==NULL){
			$head_image_logo = Request::instance()->param('head_image_logo');
			if($head_image_logo){
				$head['image'] = $head_image_logo;
			}else{
				$rs = $_SERVER['HTTP_REFERER'];
				$this->redirect($rs);
			}
		}else{
			$infoimage = $fileimage->move(ROOT_PATH.'public'.DS.'uploads');
				$head['image'] = $infoimage->getSaveName();
				if($infoimage){
					
				}else{
					echo $fileimage->getError();
				}
		}
		$head['title'] = Request::instance()->param('title');
		$head['id'] = Request::instance()->param('id');
		$result = Db::table('hm_activity_head')->where('id',$head['id'])->update(['title'=>$head['title'],'icon'=>$head['icon'],
			'image'=>$head['image'],
		]);
		if($result){
			$this->success('添加成功','company/headlist');
		}else{
			$this->error('新增失败');
		}
	}
	
	public function head_delete(){
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_activity_head')->where('id',$rs[1])->delete();
		
		if($data){
			$this->success('删除成功','company/headlist');
		}else{
			$this->error('删除失败','company/headlist');
		}
	}
	
	
	public function news_edit(){
		
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_huodong')->where('id',$rs[1])->find();
		
		$summay = Db::table('hm_news_head')->where('id',$data['head_id'])->find();
		
		 $summay['icon'] = str_replace('/uploads/','',$summay['icon']);
		 $summay['image'] = str_replace('/uploads/','',$summay['image']);
		
		$this->assign('summary',$summay);
		
		$this->assign('data',$data);
			
		$view = new View();
		
		return view();
	}
	
	public function huodong(){
		
		$aData = input('post.search');
		
		$result = Db::table('hm_huodong')->field('id,news,vice_heading,add_time,img,author,url,content')->where('news|add_time','like','%'.$aData.'%')->paginate(5);
		
		
		
		$view = new View();
		
		$view->assign('data',$result);
		$view->assign('roleName',Cache::get('role_name'));
		
		return $view->fetch('huodong');
	}
	
	public function news(){
		
		$view = new View();
		
		return view();
	}
	
	public function donews(){
		
		$iconfile = request()->file('icon');
		if($iconfile==NULL){
			$rs = $_SERVER['HTTP_REFERER'];
			$this->redirect($rs);
		}
		$iconinfo = $iconfile->move(ROOT_PATH.'public'.DS.'uploads');
		if($iconinfo){
		}else{
			echo $iconfile->getError();
		}
		
		$head_image_file = request()->file('head_image');
		if($head_image_file==NULL){
			$rs = $_SERVER['HTTP_REFERER'];
			$this->redirect($rs);
		}
		$headinfo = $head_image_file->move(ROOT_PATH.'public'.DS.'uploads');
		if($headinfo){
		}else{
			echo $head_image_file->getError();
		}
		
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
		
		
		$data['news'] = $_POST['news'];
		$data['vice_heading'] = $_POST['vice_heading'];
		$data['add_time'] = strtotime($_POST['time']);
		$data['author'] = $_POST['author'];
		//$del=array("/style=.+?['|\"]/i");  
		//$file = preg_replace($del,"",);//去除style样式  
		$data['content'] = $_POST['editorValue'];
		//$data['content'] = htmlspecialchars($_POST['editorValue']);
		if($_POST['hot'][0]=='1'){
				$data['hot'] = '1';
		}else{
			$data['hot'] = '0';
		}
		$data['url'] = $_POST['url'];
		$data['key'] = $_POST['key'];
		$data['img'] = $info->getSaveName();
		$head['title'] = $_POST['summary'];
		$head['icon'] = $iconinfo->getSaveName();
		$head['image'] =$headinfo->getSaveName();
		$head_id = Db::table('hm_news_head')->insert($head);
		$head_id = Db::name('hm_news_head')->getLastInsID();
		$data['head_id'] = $head_id;

		$result = Db::table('hm_huodong')->insert($data);
		if($result){
			$this->success('添加成功','company/huodong');
		}else{
			$this->error('新增失败');
		}
		
	}
	
	public function delete(){
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_company')->where('id',$rs[1])->delete();
		
		if($data){
			$this->success('删除成功','company/index');
		}else{
			$this->error('删除失败','company/index');
		}	
	}
	
	public function news_delete(){
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_huodong')->where('id',$rs[1])->delete();
		
		if($data){
			$this->success('删除成功','company/huodong');
		}else{
			$this->error('删除失败','company/huodong');
		}	
	}
	
	
	
	public function doadd(){
		
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
		
			$fileicon = request()->file('icon');
		 if($fileicon==NULL){
			 $rs = $_SERVER["HTTP_REFERER"];
			$this->redirect($rs); 
		 }
		$infoicon = $fileicon->move(ROOT_PATH . 'public' . DS . 'uploads');
		if($infoicon){
		}else{

			echo $fileicon->getError();
		}
		
		$head_image = request()->file('head_image');
		if($head_image ==NULL){
			$rs = $_SERVER['HTTP_REFERER'];
			$this->redirect($rs);
		}
		$info_image = $head_image ->move(ROOT_PATH . 'public' . DS . 'uploads');
		if($info_image){
		}else{
			echo $info_image->getError();
		}
		
		$data['title'] = $_POST['company'];
		$data['vice_heading'] = $_POST['vice_heading'];
		$data['add_time'] = strtotime($_POST['time']);
		$data['author'] = $_POST['author'];
		$data['img'] = $info->getSaveName();
		//$del=array("/style=.+?['|\"]/i");  
		//$file = preg_replace($del,"",);//去除style样式  
		$data['content'] = $_POST['editorValue'];
		//$data['content'] = $_POST['editorValue'];
		$data['url'] = $_POST['url'];
		$head['title'] = $_POST['summary'];
		$head['icon'] = $infoicon ->getSaveName();
		$head['image'] = $info_image ->getSaveName();
		$head_id = Db::table('hm_company_head')->insert($head);
		$head_id = Db::name('hm_company_head')->getLastInsID();
		$data['head_id'] = $head_id;
		$result = Db::table('hm_company')->insert($data);
		if($result){
			$this->success('添加成功','company/index');
		}else{
			$this->error('新增失败');
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
			
		
		
		
		
		$fileicon = request()->file('icon');
			if($fileicon ==NULL){
				$icon_name =  Request::instance()->param('icon_name');
				if($icon_name){
				$head['icon'] = $icon_name;
				}else{
					$rs = $_SERVER['HTTP_REFERER'];
					$this->redirect($rs);
				}
				
			}else{
				$infoicon = $fileicon ->move(ROOT_PATH . 'public' . DS .'uploads');
				$head['icon'] = $infoicon ->getSaveName();
				if($infoicon){
				}else{
					echo $infoicon->getError();
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
		$data['title'] = $_POST['title'];
		$data['add_time'] = strtotime($_POST['add_time']);
		$data['vice_heading'] = $_POST['vice_heading'];
		$data['url'] = $_POST['url'];
		$data['key'] = $_POST['key'];
		//$del=array("/style=.+?['|\"]/i");  
		//$file = preg_replace($del,"",);//去除style样式  
		$data['content'] = $_POST['editorValue'];
		//$data['activity'] = $_POST['editorValue'];
		$data['activity'] = $_POST['myContent'];
		$head['id'] = $_POST['head_id'];
		$head['title'] = $_POST['summary'];
		$head['head_id'] =  Request::instance()->param('head_id');
		
		
		$head_result = Db::table('hm_company_head') ->where('id',$head['id'])->update(['title' => $head['title'],'icon'=>$head['icon'],'image'=>$head['image'],]);
		
		$result = Db::table('hm_company')->where('id',$data['id'])->update(['title'=>$data['title'],'add_time'=>$data['add_time'],
			'url'=>$data['url'],
			'img'=>$data['img'],
			'key'=>$data['key'],
			'vice_heading'=>$data['vice_heading'],
			'content'=>$data['activity'],
		]);
		if($result or $head_result){
			$this->success('修改成功','company/index');
		}else{
			$this->error('修改失败');
		}
	}
	
	public function do_news_edit(){
		
		$file = request()->file('image');
		 if($file==NULL){
			 $image_master = Request::instance()->param('image_master');
			 if($image_master){
				 $data['img'] = $image_master;
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
		
		
		$fileicon = request()->file('icon');
		 if($fileicon==NULL){
			 $icon_name = Request::instance()->param('icon_name');
			 if($icon_name ){
				$head['icon'] = $icon_name; 
			 }else{
				 $rs = $_SERVER["HTTP_REFERER"];
				$this->redirect($rs); 
			 }
			
		 }else{
			 $infoicon = $fileicon->move(ROOT_PATH . 'public' . DS . 'uploads');
			 $head['icon'] = $infoicon->getSaveName();
			if($infoicon){
			}else{

				echo $fileicon->getError();
			}
		 }
		
		$head_image = request()->file('head_image');
		if($head_image == NULL){
			$head_image_name = Request::instance()->param('head_image_name');
			if($head_image_name){
				$head['image'] = $head_image_name;
			}else{
				 $rs = $_SERVER["HTTP_REFERER"];
				$this->redirect($rs); 
			}
		}else{
			$info_image = $head_image->move(ROOT_PATH.'public'.DS.'uploads');
			$head['image'] = $info_image->getSaveName();
			if($info_image){
			}else{
				echo $info_image->getError();
			}
		}
		
		$data['id'] = $_POST['id'];
		$data['news'] = $_POST['title'];
		$data['add_time'] = strtotime($_POST['add_time']);
		$data['vice_heading'] = $_POST['vice_heading'];
		$data['url'] = $_POST['url'];
		
		$data['author'] = $_POST['author'];
		$data['hot'] = $_POST['hot'];
		//$del=array("/style=.+?['|\"]/i");  
		//$file = preg_replace($del,"",);//去除style样式  
		$data['content'] = $_POST['editorValue'];
		//$data['content'] = htmlspecialchars($_POST['editorValue']);
		$data['key'] = $_POST['key'];
		
		$head['head_id'] =  Request::instance()->param('head_id');
		$head['title'] = $_POST['summary'];
		$head_result = Db::table('hm_news_head') ->where('id',$head['head_id'])->update(['title' => $head['title'],'icon'=>$head['icon'],'image'=>$head['image'],]);
		$data['head_id'] = $head['head_id'];

		$result = Db::table('hm_huodong')->where('id',$data['id'])->update(['news'=>$data['news'],'add_time'=>$data['add_time'],
			'vice_heading'=>$data['vice_heading'],
			'author'=>$data['author'],
			'url'=>$data['url'],
			'hot'=>$data['hot'],
			'head_id'=>$head['head_id'],
			'img'=>$data['img'],
			'key'=>$data['key'],
			'content'=>$data['content'],
		]);
		if($result){
			$this->success('修改成功','company/huodong');
		}else{
			$this->error('修改失败');
		}
	}
	
	public function detail_head(){
		$aData = input('post.search');
		$result = Db::table('hm_activity_detail_head')->field('id,icon,image,title')->where('title','like','%'.$aData.'%')->paginate(10);
		
		$view = new View();
		$view->assign('data',$result);
		return $view->fetch();
	}
	
	public function detail_head_add(){
		$view = new View();
	
		return $view->fetch();
	}
	
	public function detail_head_edit(){
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_activity_detail_head')->where('id',$rs[1])->find();
		
		$this->assign('data',$data);
			
		$view = new View();
		
		return view();
	}
	
	
	public function detail_head_do_add(){
			$file = request()->file('icon');
		 if($file==NULL){
			 $rs = $_SERVER["HTTP_REFERER"];
			$this->redirect($rs); 
		 }
		$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
		if($info){
		}else{

			echo $file->getError();
		}
		$filehead = request()->file('head_image');
		 if($filehead==NULL){
			 $rs = $_SERVER["HTTP_REFERER"];
			$this->redirect($rs); 
		 }
		$infohead = $filehead->move(ROOT_PATH . 'public' . DS . 'uploads');
		if($infohead){
		}else{

			echo $filehead->getError();
		}
		$data['title'] = Request::instance()->param('title');
		$data['icon'] = $info->getSaveName();
		$data['image'] = $infohead->getSaveName();
		
		$result = Db::table('hm_activity_detail_head')->insert($data);
		if($result){
			$this->success('添加成功','company/detail_head');
		}else{
			$this->error('新增失败');
		}
		
	}
	
	public function detail_head_do_edit(){
			$file = request()->file('icon');
		 if($file==NULL){
			 $icon_name = Request::instance()->param('icon_name');
			 if($icon_name){
				 $data['icon'] = $icon_name;
			 }else{
				 $rs = $_SERVER["HTTP_REFERER"];
				$this->redirect($rs); 	
			 }
		 }else{
			 $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
			 	$data['icon'] = $info->getSaveName();
			if($info){
			}else{

				echo $file->getError();
			}
		 }
		
		$filehead = request()->file('head_image');
		 if($filehead==NULL){
			 $head_image_logo = Request::instance()->param('head_image_logo');
			 if($head_image_logo){
				 $data['image'] = $head_image_logo;
			 }else{
				$rs = $_SERVER["HTTP_REFERER"];
				$this->redirect($rs);  
			 }
			 
		 }else{
			 $infohead = $filehead->move(ROOT_PATH . 'public' . DS . 'uploads');
			 $data['image'] = $infohead->getSaveName();
			if($infohead){
			}else{

				echo $filehead->getError();
			}
		 }
	
		$data['title'] = Request::instance()->param('title');
		$data['id'] = Request::instance()->param('id');

		
		$head_result = Db::table('hm_activity_detail_head') ->where('id',$data['id'])->update(['title' => $data['title'],'icon'=>$data['icon'],'image'=>$data['image'],]);
		if($head_result){
			$this->success('修改成功','company/detail_head');
		}else{
			$this->error('修改失败');
		}
		
	}
	
		public function detail_head_delete(){
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = Db::table('hm_activity_detail_head')->where('id',$rs[1])->delete();
		
		if($data){
			$this->success('删除成功','company/detail_head');
		}else{
			$this->error('删除失败','company/detail_head');
		}	
	}
	
	
	
	
	
}
