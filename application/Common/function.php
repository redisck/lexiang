<?php	
	
	/**
 * 生成二维码
 * @param  string  $url  url连接
 * @param  integer $size 尺寸 纯数字
 */
	public function add(){
	
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