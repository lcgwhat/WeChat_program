<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/29
 * Time: 23:01
 */
class LoginCon extends Control
{
    function __construct()
    {
        $model=new Loginmodel();
    }
    function curl($data,$url,$method)
    {
        $curl=curl_init(); //$.ajax()
        curl_setopt($curl,CURLOPT_URL,$url);//$.ajax的url参数
        curl_setopt($curl,CURLOPT_POSTFIELDS,$data);   //$.ajax的data参数
        curl_setopt($curl,CURLOPT_CUSTOMREQUEST,$method);//$.ajax的type参数
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true); //将服务器返回的数据原样输出
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,false);
        $returnData=curl_exec($curl); //执行
        curl_close($curl);
        return $returnData;

    }
    function show()
    {
        $this->showView('./view/login.html');
    }
    function applogin()
    {
        $userID= isset($_POST['userID'])?$_POST['userID']:'';
        $psd=isset($_POST['psd'])?$_POST['psd']:'';
        $userID=strip_tags($userID);
        $psd=strip_tags($psd);
        $psd=md5($psd);
        if($userID==''||$psd=='')
        {
            echo -1;
        }
        else
        {
            $model=new Loginmodel();
            $data=$model->login($userID,$psd);
            if(empty($data))
            {
                echo 0;
            }
            else
            {
                session_start();
                $_SESSION['user']=$data;
                echo 1;
            }
        }
    }
         function login(){
        $userID= isset($_POST['userID'])?$_POST['userID']:'';
        $psd=isset($_POST['psd'])?$_POST['psd']:'';
        $userID=strip_tags($userID);
        $psd=strip_tags($psd);
        $psd=md5($psd);
        if($userID==''||$psd=='')
        {
            echo "<script>alert('输入不能为空');window.location.href='index.php?c=login&b=show'</script>";
        }
        else
        {
            $model=new Loginmodel();
            $data=$model->login($userID,$psd);
            if(empty($data))
            {
                echo"<script>alert('账号或密码不正确')</script>";
                $this->showView('./view/login.html');
            }
            else
            {
                session_start();
                $_SESSION['user']=$data;
                echo "<script>alert('登入成功');window.location.href='index.php?c=Login&b=showm'</script>";
            }
        }
    }

    function showm()
    {
        $this->showView('./view/person.html');
//        echo "<script>window.location.href='index.php?c=main&b=show</script>";
    }
    function loginout()
    {
        unset($_SESSION['user']);
        $this->showView('./view/main.html');
        echo"<script>alert('退出成功')</script>";
    }
    function apploginout()
    {
        unset($_SESSION['user']);
        echo 1;
    }
}