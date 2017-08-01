<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\Weblog as ModelWebLog;
use think\Db;
use think\View;
use think\Cache;
class Weblog extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
		 $model = new ModelWebLog();
		 $aData = input('post.search');
		$result = Db::table('hm_web_log')->field('id,uid,ip,location,os,browser,url,module,controller,action,method,data,create_at,name')->order('id desc')->paginate(10)->toArray();
		$result2 = Db::table('hm_web_log')->field('id,uid,ip,location,os,browser,url,module,controller,action,method,data,create_at')->paginate(10);
		$rolename = Db::table('hm_role')->field('id,name')->where('id','=',Cache::get('role_id'))->find();
		

		
		$view = new View();
		
		
		$view->assign('data',$result['data']);
		$view->assign('list',$result2);

		
		return $view->fetch('index');
	
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
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

		$data = Db::table('hm_web_log')->where('id',$rs[1])->delete();
		
		if($data){
			$this->success('删除成功','weblog/index');
		}	
			
    }
}
