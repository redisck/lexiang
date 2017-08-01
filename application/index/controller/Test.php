<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\View;
class Test extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
		$aData = input('post.search');
		$result = \think\Db::table('hm_store_third_head')->field('id,icon,image,action,title,crop')->where('title','like','%'.$aData.'%')->paginate(10);
        $view = new View();
		$view->assign('data',$result);
		return $view->fetch(APP_PATH.request()->module().'/view/public/head/detail.html');
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
		

        $file = request()->file('icon');
        if($file == NULL){
            $rs = $_SERVER['HTTP_REFERER'];
            $this->redirect($rs);
        }

		$path = $file->buildSaveName(true);
		$name = substr($path,0,8);

        $info = $file ->move(ROOT_PATH . 'public' . DS .'uploads');
		 $data['icon'] = $info->getSaveName();

		$image = \think\Image::open( request()->file('icon'));
		 $saveName = request()->time() . '.png';
		 $image->crop(300, 30)->save(ROOT_PATH . 'public/uploads/' .$name.DS. $saveName);
        //$image->save(ROOT_PATH . 'public/uploads/' .$name.DS. $saveName);
     
        if($info){
        }else{
            echo $file->getError();
        }

        $filehead = request()->file('head_image');
        if($filehead == NULL){
            $rs = $_SERVER['HTTP_REFERER'];
            $this->redirect($rs);
        }
        $infohead = $filehead ->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($infohead){
        }else{
            echo $filehead->getError();
        }

    
        $data['image'] = $infohead->getSaveName();
        $data['action'] = Request::instance()->param('head');
        $data['title'] = Request::instance()->param('title');
		$data['crop'] = $name.DS.$saveName;
        $data['is_list'] = Request::instance()->param('is_list');
		
        $result = db('store_third_head')->insert($data);
        if($result){
          $this->success('添加成功','Test/index');
        }else{
            $this->error('添加失败','Test/index');
        }

      
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read()
    {
        //
		 $view = new View();
	
		return $view->fetch(APP_PATH.request()->module().'/view/public/head/head.html');
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit()
    {
        //
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = \think\Db::table('hm_store_third_head')->where('id',$rs[1])->find();
		
		
			
		$view = new View();
		$view->assign('data',$data);
		
		return $view->fetch(APP_PATH.request()->module().'/view/public/head/edit.html');
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update()
    {
        //
		  $file = request()->file('icon');
        if($file == NULL){
			$icon_name = Request::instance()->param('icon_name');
		 	if($icon_name){
			$data['icon'] = $icon_name;
			}else{
            $rs = $_SERVER['HTTP_REFERER'];
            $this->redirect($rs);
			}
        }else{
			$path = $file->buildSaveName(true);
			$name = substr($path,0,8);
			$info = $file ->move(ROOT_PATH . 'public' . DS .'uploads');
			$data['icon'] = $info->getSaveName();
			$image = \think\Image::open( request()->file('icon'));
			 $saveName = request()->time() . '.png';
			//$image->save(ROOT_PATH . 'public/uploads/' .$name.DS. $saveName);
			 $image->crop(300, 30)->save(ROOT_PATH . 'public/uploads/' .$name.DS. $saveName);
        if($info){
        }else{
            echo $file->getError();
        }
		}
        

        $filehead = request()->file('head_image');
        if($filehead == NULL){
			$head_image_logo = Request::instance()->param('head_image_logo');
		 	if($head_image_logo){
			$data['image'] = $head_image_logo;
			}else{
				$rs = $_SERVER['HTTP_REFERER'];
				$this->redirect($rs);
			}
            
        }else{
			$infohead = $filehead ->move(ROOT_PATH . 'public' . DS . 'uploads');
		 $data['image'] = $infohead->getSaveName();
			if($infohead){
			}else{
				echo $filehead->getError();
			}
		}
        

        $data['id'] =  Request::instance()->param('id');

     
        $data['action'] =  Request::instance()->param('head');
        $data['title'] =  Request::instance()->param('title');
        $data['crop'] =  $name.DS.$saveName;
        $data['is_list'] =  Request::instance()->param('is_list');
		$result = \think\Db::table('hm_store_third_head')->where('id',$data['id'])->update(['icon'=>$data['icon'],'image'=>$data['image'],
			'action'=>$data['action'],
			'title'=>$data['title'],
			'crop'=>$data['crop'],
			'is_list'=>$data['is_list'],
		]);
        if($result){
          $this->success('修改成功','Test/index');
        }else{
            $this->error('修改失败','Test/index');
        }
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete()
    {
        //
		$request = Request::instance();
		$path = $request->path();
		$rs = explode("=",$path);
		
		$data = \think\Db::table('hm_store_third_head')->where('id',$rs[1])->delete();
		
		if($data){
			$this->success('删除成功','test/index');
		}else{
			$this->error('删除失败','test/index');
		}	
		
    }
}
