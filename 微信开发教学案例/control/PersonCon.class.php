<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/30
 * Time: 18:17
 */
class PersonCon extends Control
{

    function test()
    {
        // $ACCESS_TOKEN=$this->getACCESS_token();

        /*
             这里需要使用curl中的一个文件夹，进行文件的远程传输
         */
        $imgSrc=realpath('./view/img/360.png');
        /*
            new curlFile（传入图片的绝对路径，也就是从服务器的根目录开始）
         */

        $imgObj=new CURLFile($imgSrc,'image/jpeg','test_name');
        $a=gettype($imgObj);
        $data=array('img' => $imgObj);

        //file_put_contents('debug.txt',$data);exit;
        var_dump($data);
    }
     function show()
    {
        $this->showView('./view/person.html');
    }
     function nowuser()
    {
        session_start();
        $nowuser=$_SESSION['user'];
        echo json_encode($nowuser);
    }
    function exam()
    {
        session_start();

        if(isset($_SESSION['user']))
        {
            $nowuser=$_SESSION['user'];
            $uid=$nowuser[0]['uid'];
            $model=new Personmodel();
            $allrow=$model->getallrow('tbl_title',$uid);
            $page=new Page(4,$allrow,'');
            $alldata=$model->limitData($uid,$page->getstart(),$page->getPageCount());
            echo json_encode([$alldata,$page->allpage()]);
        }
        else
        {
            echo "<script>alert('error');</script>";
            $this->showView('./view/main.php');
        }
    }
}