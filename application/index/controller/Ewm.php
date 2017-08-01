<?php
namespace app\index\controller;
use \think\View;
use \think\Db;
use \think\Request;
use \think\Cache;
use \think\Response;
use phpqrcode\QRcode;
class Ewm extends Base
{
	
  public function view()
    {
        //生成当前的二维码
		$view = new View();
        $qrCode = new \Endroid\QrCode\QrCode();
        if($id='1') {
            //想显示在二维码中的文字内容，这里设置了一个查看文章的地址
            $url = url('index/article/read/'.$id,'',true,true);
            $qrCode->setText($url)
                ->setSize(300)
                ->setPadding(10)
                ->setErrorCorrection('high')
                ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
                ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
                ->setLabel('thinkphp.cn')
                ->setLabelFontSize(16)
                ->setImageType(\Endroid\QrCode\QrCode::IMAGE_TYPE_PNG);
           // $qrCode->render('view');
		   //return $view->fetch('view');
        }
    }
	
	 /*  public function qrcode($url="http://www.baidu.com",$size){
      //  $url='http://www.baidu.com';
        qrcode($url,$size);
    } */
	
	  public function qrcode($url = "http://blog.csdn.net/zhihua_w", $level = 3, $size = 4)  
    {  
        Vendor('phpqrcode.phpqrcode');  
        //容错级别  
        $errorCorrectionLevel = intval($level);  
        //生成图片大小  
        $matrixPointSize = intval($size);  
        //生成二维码图片  
        $object = new \QRcode();  
        //第二个参数false的意思是不生成图片文件，如果你写上‘picture.png’则会在根目录下生成一个png格式的图片文件  
        $object->png($url, false, $errorCorrectionLevel, $matrixPointSize, 2);  
    }  
	
}
