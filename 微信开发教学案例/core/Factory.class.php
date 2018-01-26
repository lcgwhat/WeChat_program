<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/6
 * Time: 20:11
 */
class Factory
{
    static $obj;
    //单例工场
    public  static function createfactory()
    {
        if(self::$obj==null)
        {
            self::$obj=new Factory();
        }
        return self::$obj;
    }
    private function __construct()
    {
        require_once "core/Model.class.php";
        require_once "core/Control.class.php";
        require_once "./public/page/Page.class.php";
        require_once "./public/opDaily/Opdaily.class.php";
        require_once "./public/wechat/Wechat.class.php";
        //将普通函数转化为自动引用
        spl_autoload_register([__CLASS__,'control']);
        spl_autoload_register([__CLASS__,'model']);
    }
    public function control($classname)
    {
        $file="./control/".$classname.".class.php";
        if(file_exists($file))
        {
            require_once $file;
        }
    }
    public function model($classname)
    {
        $file="./model/".$classname.".class.php";
        if(file_exists($file))
        {
            require_once $file;
        }
    }
    public function run()
    {
        $c=isset($_GET['c'])?$_GET['c']:'Main';
        $b=isset($_GET['b'])?$_GET['b']:'show';
       $control=$c."Con";
        if(class_exists($control))
        {
            $con=new $control();
            $con->doaction($b);
        }
        else
        {
           include "view/nofound.php";
        }

    }
}