<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/6
 * Time: 19:44
 */
abstract class Control
{
    //abstract function doaction($a);

    final public function doaction($a){
        if(method_exists($this,$a))
        {
            $this->$a();
        }
        else{
            $this->showView('./application/views/nofound.php',"方法错误");
        }
    }
    public function showView($url,$data=null)
    {
        include $url;
    }

}