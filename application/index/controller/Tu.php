<?php
namespace app\index\controller;
use \think\View;
use \think\Db;
use \think\Request;
use \think\Cache;
use Endroid\QrCode\QrCode;
//use \think\response;
use \think\Response;
class Tu extends Base
{
	
    public function index()
    {

		
		$view = new View();
		

		
		return $view->fetch('index');
	
	}
	
	public function create_qrcode($url='http://www.baidu.com',$label='4')
    {
        $qrCode = new \Endroid\QrCode\QrCode();//创建生成二维码对象
        $qrCode->setText($url)
        ->setSize(150)
        ->setPadding(10)
        ->setErrorCorrection('high')
        ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
        ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
        ->setLabel($label)      //标签
        ->setLabelFontSize(10)  //标签中字体的大小
        ->setImageType(\Endroid\QrCode\QrCode::IMAGE_TYPE_PNG);
        header("Content-type: image/png");

        $qrCode->render();
		$response = new Response($qrCode->get(), 200, array('Content-Type' => $qrCode->getContentType()));
    }
	
	public function test(){
		$qrCode = new \Endroid\QrCode\QrCode();
		
		//$value ="nihao";
		
		$setVersion = $qrCode -> setVersion(5);//37*37
		//设置版本号，QR码符号共有40种规格的矩阵，从21x21（版本1），到177x177（版本40），每一版本符号比前一版本 每边增加4个模块。

		$setErrorCorrection = $qrCode -> setErrorCorrection(2);//容错级别,2的容错率:30%
		//容错级别：0：15%，1：7%，2：30%，3：25%

		$setModuleSize = $qrCode -> setModuleSize(2);//设置QR码模块大小

		$setImageType = $qrCode -> setImageType('png');//设置二维码保存类型

		$logo = 'uploads/accountPictrue/logo1.jpg';//logo图片
		$setLogo = $qrCode -> setLogo($logo);//二维码中间的图片

		$setLogoSize = $qrCode -> setLogoSize(360);//设置logo大小

		$value = 'https://www.dongtianjr.com'; //二维码内容
		$setText = $qrCode -> setText($value);//设置文字以隐藏QR码。

		$setSize = $qrCode -> setSize(1024);//二维码生成后的大小

		$setPadding = $qrCode -> setPadding(48);//设置二维码的边框宽度，默认16
		
		$setDrawQuietZone = $qrCode -> setDrawQuietZone(true);//设置模块间距

		$setDrawBorder = $qrCode -> setDrawBorder(true);//给二维码加边框。。。
		$text = 'XX销售，XX公司！一二';
		$setLabel = $qrCode -> setLabel($text);//在生成的图片下面加上文字

		$setLabelFontSize = $qrCode -> setLabelFontSize(39);//生成的文字大小、

		$lablePath = 'uploads/qr/qr.TTF';
		$setLabelFontPath = $qrCode -> setLabelFontPath($lablePath);//设置标签字体

		$color_foreground = ['r' => 108, 'g' => 182, 'b' => 229, 'a' => 0];
		$setForegroundColor = $qrCode -> setForegroundColor($color_foreground);//生成的二维码的颜色

		$color_background = ['r' => 213, 'g' => 241, 'b' => 251, 'a' => 0];
		$setBackgroundColor = $qrCode -> setBackgroundColor($color_background);//生成的图片背景颜色

		$flieName = 'liukelk.jpg';//二维码的名字

		$qrCode -> save($flieName);//生成二维码
		
		}
		
		
		public function uu(){
			
			//Loader::import('phpqrcode.phpqrcode');
			Vendor('phpqrcode.phpqrcode');
			//$qrCode = new \QRcode::png();
			$data = "http://www.baidu.com";
            // 纠错级别：L、M、Q、H
            $level = 'L';
            // 点的大小：1到10,用于手机端4就可以了
            $size = 4;
            // 下面注释了把二维码图片保存到本地的代码,如果要保存图片,用$fileName替换第二个参数false
           // $path = "images/";
            // 生成的文件名
           // $fileName = $path.$size.'.png';
           // new \QRcode->png($data, false, $level, $size);
		}
		
				/**
		 * 生成二维码
		 * @param  string  $url  url连接
		 * @param  integer $size 尺寸 纯数字
		 */
		public function qrcode(){
			qrcode($url="http://www.baidu.com",$size=4);
		}


	


	
	
}
