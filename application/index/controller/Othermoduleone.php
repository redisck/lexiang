<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use think\View;
use think\Db;
class Othermoduleone extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
		$aData = input('post.search');
		$result = \think\Db::table('hm_other_module_one')->field('id,title,vice_heading,content,add_time,status,key,url,img,collect_status')->where('title','like','%'.$aData.'%')->paginate(10);
        $view = new View();
		$view->assign('data',$result);
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
		
		
		$data['title'] = $_POST['news'];
		$data['vice_heading'] = $_POST['vice_heading'];
		$data['add_time'] = strtotime($_POST['time']);
		$data['img'] = $info->getSaveName(); 
		$data['url'] = $_POST['url'];
		$data['title'] = $_POST['summary'];
		$data['content'] = $_POST['myContent'];
		$data['img'] = $info->getSaveName();
		$result = Db::table('hm_other_module_one')->insert($data);
		if($result){
			$this->success('添加成功','othermoduleone/index');
		}else{
			$this->error('新增失败');
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
	
		return $view->fetch('add');
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
		
		$data = \think\Db::table('hm_other_module_one')->where('id',$rs[1])->find();
		
		
			
		$view = new View();
		$view->assign('data',$data);
		
		return $view->fetch();
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
		
		$data['id'] = $_POST['id'];
		$data['title'] = $_POST['title'];
		$data['add_time'] = $_POST['add_time'];
		$data['vice_heading'] = $_POST['vice_heading'];
		$data['url'] = $_POST['url'];
		$data['key'] = $_POST['key']; 
		$data['content'] = $_POST['myContent'];
		$head['title'] = $_POST['summary'];
		
	
		
		$result = Db::table('hm_other_module_one')->where('id',$data['id'])->update(['title'=>$data['title'],'add_time'=>$data['add_time'],
			'url'=>$data['url'],
			'img'=>$data['img'],
			'key'=>$data['key'],
			'content'=>$data['content'],
			'vice_heading'=>$data['vice_heading'],
		]);
		if($result or $head_result){
			$this->success('修改成功','othermoduleone/index');
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
		
		$data = \think\Db::table('hm_other_module_one')->where('id',$rs[1])->delete();
		
		if($data){
			$this->success('删除成功','othermoduleone/index');
		}else{
			$this->error('删除失败','othermoduleone/index');
		}	
		
    }
}
