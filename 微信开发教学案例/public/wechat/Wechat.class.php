<?php






class wechatApi{
	/*
		做验证操作
	*/
	public function valid(){
		/*
			获取微信发送过来的 echostr，随机字符串
		*/
		/*
			为了监控一下微信是不是有进来和我做校验，我用文件函数，做一下写入文件操作

			如果微信真的有发请求过来，一定会触发我的写入文件代码，生成一个文件出来
		*/
		$echoStr = $_GET['echostr'];
		
		if($this->checkSignature()){
			file_put_contents('wechat.txt','微信进来了');
			ob_clean();
			echo $echoStr;
		}else{
			file_put_contents('wechat.txt','微信失败');
		}
	}

	/*
		验证算法
	*/
	public function checkSignature(){

		if(!defined("TOKEN")){
			throw new Exception("TOKEN is not defined!");
		}
		/*
			获取微信发送过来的校验结果，也就是微信官方已经做好的饭团
		*/
		$signature = $_GET['signature'];
		/*
			获取微信发送过来的材料之一，时间戳
		*/
		$timestamp = $_GET['timestamp'];
		/*
			获取微信发送过来的材料之一，随机数
		*/
		$nonce = $_GET['nonce'];
		/*
			双方都定义好的暗号
		*/
		$token = TOKEN; //Token常量值
		
		//字典排序
		$tmpArr = array($token,$timestamp,$nonce);
		
		sort($tmpArr,SORT_STRING);
		/*
			将新排序后的数组再分割成字符串
		*/
		$tmpStr = implode($tmpArr);
		/*
			sha1 加密
		*/
		$tmpStr = sha1($tmpStr);
		if($tmpStr == $signature){
			return true;
		}
		else{
			return false;
		}
	}
	/*
		验证成功后，捕捉粉丝的消息，并且回复
	*/
	public function response(){
    	$fengmess=$GLOBALS['HTTP_RAW_POST_DATA'];
    	file_put_contents('fens_mess.txt',$fengmess,FILE_APPEND);
    	/*
    	
    	 、接收到的消息的消息时XML
    		
    	 */
    	libxml_disable_entity_loader(true);
    	$postObj=simplexml_load_string($fengmess,'SimpleXMLElement',LIBXML_NOCDATA);
    	echo '
    	<xml>
    	<ToUserName><![CDATA['.$postObj->FromUserName.']]></ToUserName>
		<FromUserName><![CDATA['.$postObj->ToUserName.']]></FromUserName>
		<CreateTime>'.time().'</CreateTime>
		<MsgType><![CDATA[text]]></MsgType>
		<Content><![CDATA[你好]]></Content>
		</xml>
    	';
	}

}