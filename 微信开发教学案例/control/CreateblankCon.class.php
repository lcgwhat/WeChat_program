<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/30
 * Time: 21:13
 */
class CreateblankCon extends Control
{
//    public function doaction($a)
//    {
//       if($a=='show')
//       {
//           $this->showView('./view/createblank.html');
//       }
//    }

    function __construct()
    {

    }

    function show()
    {
        $this->showView('./view/createblank.html');
    }
}