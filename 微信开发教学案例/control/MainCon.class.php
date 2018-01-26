<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/29
 * Time: 18:52
 */
define(APPID,'wx6abb8eec565d5134');
define(APPSER,'31d908343aec9fd0223136566cd4e2a9');
class MainCon extends Control
{

    function show()
    {
        $code=isset($_GET['code'])?$_GET['code']:'';
        //url 里有code，表示有微信回调操作
        if(!empty($code))
        {
            $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".APPID."&secret=".APPSER
."&code=".$code."&grant_type=authorization_code";
            $method='GET';
            $data=[];
            $ACCESS_tokenJson=$this->curl($data,$url,$method);

           if(!empty($ACCESS_tokenJson))
           {
               $ACCESS_tokenArr=json_decode($ACCESS_tokenJson,true);

               $url="https://api.weixin.qq.com/sns/userinfo?access_token=".$ACCESS_tokenArr['access_token']."&openid=".$ACCESS_tokenArr['openid']."&lang=zh_CN";
               $method="GET";
               $data=[];
                
               $userInfo=$this->curl($data,$url,$method);
               var_dump($userInfo);
              var_dump($url);exit;
           }
        }
        $this->showView('./view/main.html');
    }
    private function curl($data,$url,$method)
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
}