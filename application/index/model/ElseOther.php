<?php

namespace app\index\model;

use think\Model;


class Elseother extends \think\Model
{
     protected $table = 'hm_else_other';
    

      public function getAllUserDatas()
    {
       $more_datas = $this->select();
       if(empty($more_datas)){
       		return false;
       }


        return ($more_datas); 

    }

}
