<?php

namespace app\index\model;

use think\Model;

class Weblog extends Model
{
    //
	
	 protected $name = 'hm_web_log';

    public function user()
    {
        return $this->hasOne('AdminUser', "id", "uid")->setAlias(["id" => "uuid"]);
    }

    public function map()
    {
        return $this->hasOne('NodeMap', "map", "map")->setAlias(["id" => "map_id"]);
    }
}
