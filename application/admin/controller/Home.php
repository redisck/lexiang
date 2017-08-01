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
class Home extends Controller
{
    public function index()
    {
        $result = Db::table('hm_link')->field('id,name,link')->select();
        $pv = Db::table('hm_web_log')->count();
		$android = Db::table('hm_web_log')->where('browser','like','%android%')->count();
		$iphone = Db::table('hm_web_log')->where('browser','like','%iphone%')->count();
		$PC = Db::table('hm_web_log')->where('browser','like','%Chrome%')->count();
		
		
		$beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
		$endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
		
		
		//获取昨天00:00
		$timestart = strtotime(date('Y-m-d'.'00:00:00',time()-3600*24));
		//获取今天00:00
		$timeend = strtotime(date('Y-m-d'.'00:00:00',time()));
		
		//本周起止时间  
		$beginThisweek = mktime(0,0,0,date('m'),date('d')-date('w')+1,date('y'));  
		$now = time();
		
		//php获取本月起始时间戳和结束时间戳
		$beginThismonth=mktime(0,0,0,date('m'),1,date('Y'));
		$endThismonth=mktime(23,59,59,date('m'),date('t'),date('Y'));
		
		//周一
		$beginThisweek = mktime(0,0,0,date('m'),date('d')-date('w')+1,date('y'));
		$endMonday = strtotime("+1day",$beginThisweek);

		
		//周二
		$endTuesday = strtotime("+2day",$beginThisweek);

		//周三
		$endWednesday = strtotime("+3day",$beginThisweek);
		//周四
		$endThursday =strtotime("+4day",$beginThisweek);
				
		//周五
		$endFriday = strtotime("+5day",$beginThisweek);
		//周六
		$endSaturday = strtotime("+6day",$beginThisweek);
		
		$todaysum = Db::table('hm_web_log')->where('create_at','between',[$beginToday,$endToday])->count();
		$yesterdaysum = Db::table('hm_web_log')->where('create_at','between',[$timestart,$timeend])->count();
		$Thisweeksum = Db::table('hm_web_log')->where('create_at','between',[$beginThisweek,$now])->count();
		$Thismonthsum = Db::table('hm_web_log')->where('create_at','between',[$beginThismonth,$endThismonth])->count();
		
		//周一访问量
		$Mondaysum = Db::table('hm_web_log')->where('create_at','between',[$beginThisweek,$endMonday])->count();//周一访问量
		//周二访问量
		$Tuesdaysum = Db::table('hm_web_log')->where('create_at','between',[$endMonday,$endTuesday])->count();
		//周三访问量
		$Wednesdaysum = Db::table('hm_web_log')->where('create_at','between',[$endTuesday,$endWednesday])->count();
		//周四
		$Thursdaysum = Db::table('hm_web_log')->where('create_at','between',[$endWednesday,$endThursday])->count();
		//周五
		$Fridaysum = Db::table('hm_web_log')->where('create_at','between',[$endThursday,$endFriday])->count();
		//周六
		$Saturdaysum = Db::table('hm_web_log')->where('create_at','between',[$endFriday,$endSaturday])->count();
	
		$arr_week =array($Mondaysum,$Tuesdaysum,$Wednesdaysum,$Thursdaysum,$Fridaysum,$Saturdaysum);
	
		$beginThisweek = mktime(0,0,0,date('m'),date('d')-date('w')+1,date('y'));  
		

		
		$view = new View();
		
		
		$view->assign('paylist',json_encode($arr_week));
		
		$view->assign('data',$result);
		
		$view->assign('pv',$pv);
		$view->assign('PC',$PC);
		$view->assign('todaysum',$todaysum);
		$view->assign('yesterdaysum',$yesterdaysum);
		$view->assign('Thisweeksum',$Thisweeksum);
		$view->assign('Thismonthsum',$Thismonthsum);
		
		
		$view->assign('android',$android);
		$view->assign('iphone',$iphone);
		
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
		$data['nav_img'] = $img[0]['img'];
		$result = Db::table('hm_all')->insert($data);
		if($result){
			Db::execute('truncate hm_im');			
			$this->success('添加成功','index/index');
		}else{
			$this->error('新增失败');
		}
	}
	
	public function vv(){
		
		if (Request::instance()->isAjax()){
			$cate['module'] = $_POST['name'];

			Cache::set('url',$_POST['name']);	
		}
	
		$img = Db::table('hm_im')->select();
		$cate['img'] = $img[0]['img'];
		$cate['nav_img'] = $img[0]['img'];
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
	
	public function all(){
		
		if (Request::instance()->isAjax()){
			$cate['module'] = $_POST['all'];

			Cache::set('all',$_POST['all']);	
		}
	
		
	}
}
