<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\View;
use app\index\model\ElseOther as User;
use think\Db;
class Elseother extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
         $User_model = new User();    

        $userdatas = $User_model->getAllUserDatas(); 

        $view = new View();

        $view ->assign('data',$userdatas);

       return $view->fetch();
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //


           $view = new View();

           return view();

      
  
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save()
    {
        //

		if($_FILES['image']['tmp_name']){
                $file = request()->file('image');
                $info = $file->move(ROOT_PATH . 'public' . DS . '/uploads/');
                $data['img']=$info->getSaveName();
        }
		
		if($_FILES['image1']['tmp_name']){
                $file = request()->file('image1');
                $info = $file->move(ROOT_PATH . 'public' . DS . '/uploads/');
                $data['vice_img']=$info->getSaveName();
        }
		
		if($_FILES['nav_img']['tmp_name']){
                $file = request()->file('nav_img');
                $info = $file->move(ROOT_PATH . 'public' . DS . '/uploads/');
                $data['nav_img']=$info->getSaveName();
        }
		
        if(request()->isPost()){

             $User_model = new User();
             $User_model->data([
                'title'=>input('title'),
                'vice_heading'=>input('vice_heading'),
                'add_time'=>input('time'),
				'docInlineRadio'=>input('docInlineRadio'),
				'img'=>$data['img'],
				'vice_img'=>$data['vice_img'],
				'nav_img'=>$data['nav_img'],
                ]); 
		

				 $validate = \think\Loader::validate('User');
				 if($validate->check($User_model)){
					 $db = $User_model->save();
					if($db){
						return $this->success('添加成功','elseother/index');
					}else{
						return $this->error('添加失败');
					} 
				 }else{
					
				 }
				
				 
			
        }
		
		 return $this->fetch('create');
        
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
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
		
		$data = Db::table('hm_else_other')->where('id',$rs[1])->find();
		
		$this->assign('data',$data);
			
		$view = new View();
		
		return view();
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
			$file = request()->file('image');
		 if($file==NULL){
			 $image_f = Request::instance()->param("image_f");
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
	
		
		$file1 = request()->file('image1');
		 if($file1==NULL){
			 $image_t = Request::instance()->param("image_t");
			 if($image_t){
				 $data['vice_img'] = $image_t;
			 }else{
				 $rs = $_SERVER["HTTP_REFERER"];
				$this->redirect($rs); 
			 } 
		 }else{
			 $info1 = $file1->move(ROOT_PATH . 'public' . DS . 'uploads');
			 $data['vice_img'] = $info1->getSaveName();
			if($info1){
			}else{

				echo $file1->getError();
			}
		 }
	
		
		$filenav = request()->file('nav_img');
		 if($filenav==NULL){
			 $image_s = Request::instance()->param('image_s');
			 if($image_s){
				 $data['nav_img'] = $image_s;
			 }else{
				$rs = $_SERVER["HTTP_REFERER"];
				$this->redirect($rs); 
			 } 
		 }else{
			$infonav = $filenav->move(ROOT_PATH . 'public' . DS . 'uploads');
			$data['nav_img'] = $infonav->getSaveName();
			if($infonav){
			}else{

				echo $filenav->getError();
			} 
		 }
		
		$data['id'] = $_POST['id'];
		$data['title'] = $_POST['title'];
		$data['add_time'] = strtotime($_POST['time']);
		$data['vice_heading'] = $_POST['vice_heading'];
		$data['email'] = $_POST['email'];
		$data['docInlineRadio'] = $_POST['docInlineRadio'];

	
		

		$result = Db::table('hm_else_other')->where('id',$data['id'])->update(['title'=>$data['title'],'add_time'=>$data['add_time'],
			'vice_heading'=>$data['vice_heading'],
			'docInlineRadio'=>$data['docInlineRadio'],
			'img'=>$data['img'],
			'vice_img'=>$data['vice_img'],
			'nav_img'=>$data['nav_img'],

		]);
		if($result){
			$this->success('修改成功','elseother/index');
		}else{
			$this->error('修改失败');
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
		
		$data = Db::table('hm_else_other')->where('id',$rs[1])->delete();
		
		if($data){
			$this->success('删除成功','elseother/index');
		}else{
			$this->error('删除失败','elseother/index');
		}	
    }
}
