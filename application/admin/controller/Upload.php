<?php
namespace app\admin\controller;

use think\Controller;
use think\File;
use think\Request;
use think\Db;
class Upload extends Base
{
    public function index()
    {
		
		return view();
     
    }
	
	 function upload(){
        //$file = $this->request->file('file');//file是传文件的名称，这是webloader插件固定写入的。因为webloader插件会写入一个隐藏input，不信你们可以通过浏览器检查页面
        //$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
		//$data['img'] = $info->getSaveName();
		if($_FILES['file']['tmp_name']){
                $file = request()->file('file');
                $info = $file->move(ROOT_PATH . 'public' . DS . '/uploads/');
                $data['img']=$info->getSaveName();
				
				//$arr[] = $info->getSaveName();
				//$c=implode(',',$arr);
				
				//	$data['img'] = $arr[0];
				//	$data['img2'] =$arr[1];
				
				if($data['img']){
						Db::table('hm_im')->insert($data);
				}
			
				/* $Id = Db::name('hm_im')->getLastInsID();
				$result = Db::table('hm_im')->where('id',$Id)->find();
				if(!$result['img2']==NULL){
					Db::table('hm_im')
						->update(['img2' => $data['img'],'id'=>$Id]);
				} */
        }
		
		//$result = Db::table('hm_company')->insert($data);
    }
	
	public function doadd(){
		
		
		$data['title'] = $_POST['modulename'];
		$data['url'] = $_POST['url'];
		$result = Db::table('hm_im')->select();
		$data['img'] = $result[0]['img'];
		$data['vice_img'] = $result[1]['img'];
		 $v = Db::table('hm_module_company')->insert($data);
		if($v){
			Db::execute('truncate hm_im');
			$this->success('添加成功','index/index');
		}else{
			$this->error('添加失败');
		}
		
		//var_dump($result[0]['img']);exit;
		
	
		
	}
	
	
}
