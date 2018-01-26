<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/14
 * Time: 9:56
 */
class Opdaily
{

    public function __construct()
    {

    }
    public function docop($who,$time,$opname)
    {
        $file=fopen('log.txt','a');
        $str="操作者：".$who.",操作内容：".$opname."，操作时间：".$time;
        fwrite($file,$str."\n");
        fclose($file);
    }
}