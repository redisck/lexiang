<?php
 $arr = array(
    'name'=>'张三'，
    ‘age’=>'26',
    'sex'=>'男'
)
$str = var_export($arr,TRUE);
file_put_contents($filename,$str);