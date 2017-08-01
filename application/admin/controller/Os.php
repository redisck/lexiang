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
class Os extends Controller
{
  
public function getOS()  
{  
    $ua = $_SERVER['HTTP_USER_AGENT'];//这里只进行IOS和Android两个操作系统的判断，其他操作系统原理一样  
    if (strpos($ua, 'Android') !== false) {//strpos()定位出第一次出现字符串的位置，这里定位为0  
        preg_match("/(?<=Android )[\d\.]{1,}/", $ua, $version);  
        echo 'Platform:Android OS_Version:'.$version[0];  
    } elseif (strpos($ua, 'iPhone') !== false) {  
        preg_match("/(?<=CPU iPhone OS )[\d\_]{1,}/", $ua, $version);  
        echo 'Platform:iPhone OS_Version:'.str_replace('_', '.', $version[0]);  
    } elseif (strpos($ua, 'iPad') !== false) {  
        preg_match("/(?<=CPU OS )[\d\_]{1,}/", $ua, $version);  
        echo 'Platform:iPad OS_Version:'.str_replace('_', '.', $version[0]);  
    }   
}  
	
	
}
