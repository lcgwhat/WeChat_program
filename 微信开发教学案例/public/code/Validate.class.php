<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/20
 * Time: 10:15
 */
class Validate
{
    private $charset = 'abcdefghijklmnobjrskuvwsiz23456789';
    private $code;//
    private $codelenth=4;
    private $width;
    private $height;
    private $img;
    private $fontsize = 33;
    private $fontcolor;
    public function __construct($width=156,$height=40)
    {
        $this->width=$width;
        $this->height=$height;
        //$this->codelenth=$codelenth;
    }

    private  function createCode()  //生成随机码
    {
       $_len = strlen($this->charset)-1;
        for($i=0;$i<$this->codelenth;$i++)
        {
            $this->code.=$this->charset[mt_rand(0,$_len)];
        }
    }
    private function createBg()  //生成背景
    {
        $this->img= imagecreatetruecolor($this->width,$this->height);
        $color = imagecolorallocate($this->img,mt_rand(157,255),mt_rand(157,255),mt_rand(157,255));
        imagefilledrectangle($this->img,0,$this->height,$this->width,0,$color);
    }
    private function createFont()  //生成文字
    {
        $_x = $this->width / $this->codelenth;
        for($i=0;$i<$this->codelenth;$i++)
        {
            imagecolorallocate($this->img,mt_rand(0,156),mt_rand(0,156),mt_rand(0,156));
            imagettftext($this->img,$this->fontsize,mt_rand(-30,30),$_x*$i+mt_rand(3,7),$this->height/1.4,$this->fontcolor,'ziti.ttf',$this->code[$i]);
        }
    }
    private function createLine()
    {
        //线条
        for($i=0;$i<6;$i++)
        {
            $color=imagecolorallocate($this->img,mt_rand(0,156),mt_rand(0,156),mt_rand(0,156));
            imageline($this->img,mt_rand(0,$this->width),mt_rand(0,$this->height),mt_rand(0,$this->width),mt_rand(0,$this->height),$color);

        }
        //雪花
        for($i=0;$i<100;$i++)
        {
            $color= imagecolorallocate($this->img,mt_rand(200,250),mt_rand(200,250),mt_rand(200,250));
            imagestring($this->img,mt_rand(1,5),mt_rand(0,$this->width),mt_rand(0,$this->height),'*',$color);
        }
    }
    //输出
    private function  outPut()
    {
         header('Content-type:image/png');
        imagepng($this->img);
        imagedestroy($this->img);
    }
    //对外生成
    public function doimg()
    {
        $this->createBg();
        $this->createCode();
        $this->createLine();
        $this->createFont();
        $this->outPut();
    }
    //获取验证码
    public function getCode()
    {

        return strtolower($this->code);
    }
}
