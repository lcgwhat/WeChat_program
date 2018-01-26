<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/10
 * Time: 14:25
 */
define(TOKEN,'lcg');
define(APPID,'wx6abb8eec565d5134');
define(APPSER,'31d908343aec9fd0223136566cd4e2a9');
class WechatCon extends Control
{
    function __construct()
    {

        $this->wechatApi=new wechatApi();
    }
    /*
        微信接入
     */
    function wechatInterface()
    {
        
        /*
            这个文件都是用来接收微信发送过来的请求，当微信发送过来的请求中带有echoStr时，表示微信服务器还没信任校验我们的服务器，所以我们要介入算法配置

            如果发送过来的请求中没有参数，那表示校验通过了，那就可以接收粉丝的消息了
         */
        $echoStr=isset($_GET['echostr'])?$_GET['echostr']:'';
        if(empty($echoStr))
        {
             $this->response();
        }
        else
        {
             $this->wechatApi->valid();
        }
    }
    /*
        验证成功后，捕捉粉丝的消息，并且回复
    */
    public function response(){
        /*
            选接收粉丝发送来的消息
            $GLOBALS['HTTP_RAW_POST_DATA'] php获取请求数据的XML
         */
        $fengmess=$GLOBALS['HTTP_RAW_POST_DATA'];
        /*
            php内置 libxml 扩展，能够将XML转化成数组形式
         */
        file_put_contents('fens_mess.txt',$fengmess,FILE_APPEND);
        libxml_disable_entity_loader(true);
        $postObj=simplexml_load_string($fengmess,'SimpleXMLElement',LIBXML_NOCDATA);
        if($postObj->MsgType=='event' && $postObj->Event=='CLICK')
        {
           if($postObj->EventKey=='V1001_TODAY_MUSIC') 
           {
            echo '
            <xml>
            <ToUserName><![CDATA['.$postObj->FromUserName.']]></ToUserName>
            <FromUserName><![CDATA['.$postObj->ToUserName.']]></FromUserName>
            <CreateTime>'.time().'</CreateTime>
            <MsgType><![CDATA[text]]></MsgType>
            <Content><![CDATA[这是电击]]></Content>
            </xml>
            ';
           }
           /*
            图片回复
             */
            elseif($postObj->EventKey=='V1001_GOOD')
            {
                /*
                     步骤1、微信素材接口，前置工作，还要获取access_token
                 * */
               $ACCESS_TOKEN=$this->getACCESS_token();

                /*
                     这里需要使用curl中的一个文件夹，进行文件的远程传输
                 */
                $imgSrc=realpath('./view/img/bacg.jpg');
                /*
                    new curlFile（传入图片的绝对路径，也就是从服务器的根目录开始）
                 */
                
                $imgObj=new CURLFile($imgSrc);
                
                $data=array('img'=>$imgObj);
                
                $method='POST';
                $url="https://api.weixin.qq.com/cgi-bin/media/upload?access_token=".$ACCESS_TOKEN."&type=image";

                $media_idJson=$this->curl($data,$url,$method);
                
                $media_idArr=json_decode($media_idJson,true);

                
                 $XmlMsg= "
                        <xml>
                        <ToUserName><![CDATA[".$postObj->FromUserName."]]></ToUserName>
                        <FromUserName><![CDATA[".$postObj->ToUserName."]]></FromUserName>
                        <CreateTime>".time()."</CreateTime>
                        <MsgType><![CDATA[image]]></MsgType>
                        <Image>
                        <MediaId><![CDATA[".$media_idArr['media_id']."]]></MediaId>
                        </Image>
                        </xml>";
                echo  $XmlMsg;
                        
               
            }
        }
        /*
         文本回复（图灵接入）
        */
        else
        {
            $url="http://www.tuling123.com/openapi/api?key=c635166ccb4943bd830154f5be912a63&info=".$postObj->Content;
            $method='GET';
            $data=[];
            $resjson=$this->curl($data,$url,$method);
            $resarr=json_decode($resjson,true);
            $tulinMsg=$resarr['text'];

            echo '
        <xml>
        <ToUserName><![CDATA['.$postObj->FromUserName.']]></ToUserName>
        <FromUserName><![CDATA['.$postObj->ToUserName.']]></FromUserName>
        <CreateTime>'.time().'</CreateTime>
        <MsgType><![CDATA[text]]></MsgType>
        <Content><![CDATA['.$tulinMsg.']]></Content>
        </xml>
        ';
        }

    }
        /*
         群发消息
         */
    public function sendALLmess()
    {
        $ACCESS_TOKEN=$this->getACCESS_token();
        $OpenIdArr=['o8N_O0-BAj6IrbHwDHVUD_DA8saU','o8N_O0zuft60wj_C27ne6sKRnYKM'];
        $url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$ACCESS_TOKEN;
        $method="POST";
        foreach($OpenIdArr as $key=>$value)
        {
            $data='{

                "touser":"'.$value.'",

                "template_id":"zGv_kyr-PrYXIgGidZALSeQ-wE8J-ZRJBLkvXiGEZjw",
                "url":"http://www.baidu.com",

                "topcolor":"#FF0000",
                "data":{
                 }
             }';
            $res=$this->curl($data,$url,$method);
            var_dump($res);
        }


    }
    public function addmenu()
    {
        $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".APPID."&secret=".APPSER;
        $data=[];
        $method='get';
        $access_tokenjson=$this->curl($data,$url,$method);
        $access_tokenarr=json_decode($access_tokenjson,true);
        $access_token=$access_tokenarr['access_token'];
        $url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
        $method='post';
               $data='{
     "button":[
     {
          "type":"pic_weixin",
          "name":"相册",
          "key":"V1001_TODAY_MUSIC"
      },
      {
          "type":"location_select",
          "name":"定位",
          "key":"V1001_TODAY_SAO"
      },
      {
           "name":"菜单",
           "sub_button":[
           {
               "type":"view",
               "name":"问卷星1",
               "url":"http://106.14.214.55/demo2"
            },

            {
               "type":"click",
               "name":"图片回复",
               "key":"V1001_GOOD"
            }]
       }]
 }';
        $res=$this->curl($data,$url,$method);
        var_dump($res);
    }
    private function getACCESS_token()
    {
        $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".APPID."&secret=".APPSER;
        $data=[];
        $method='get';
        $access_tokenjson=$this->curl($data,$url,$method);
        $access_tokenarr=json_decode($access_tokenjson,true);
        $access_token=$access_tokenarr['access_token'];
        return $access_token;
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