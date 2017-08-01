<?php
	
namespace app\index\validate;

use think\Validate;

class User extends Validate
{
    protected $rule = [
        'title'  =>  'require|max:25',
		'vice_heading' =>  'require',
    ];
	
	 protected $message  =   [
        'title.require' => '文章标题必须填写',
        'title.max' => '文章标题长度不得大于25位',
        'vice_heading.require' => '请填写文章副标题',
		'title.unique' => '标题不得重复',

    ];

}