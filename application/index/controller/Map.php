<?php
namespace app\index\controller;
use \think\View;
class Map extends Base
{
    public function index()
    {
		$view = new View();
		return view('index');
	
	}
}
