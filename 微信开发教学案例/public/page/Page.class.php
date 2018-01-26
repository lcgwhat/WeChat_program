<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/2
 * Time: 21:28
 */
class Page
{
    private $count;  //显示几条数据
    private $pageAll;  //总页数
    private $allRow;  //总条数
    private $nowPage;  //当前页
    private $startPage;  //开始条数
    private $url;    //链接地址
    private $previou;  //上一页链接地址
    private $next;  //下一页链接地址

    //构造函数 获取每页的总条数 初始化数据
    public function __construct($count,$allRow,$url)
    {
        $this->url=$url;
        $this->count=$count;
        $this->allRow=$allRow;
        $this->pageAll=ceil($this->allRow/$this->count);
        $this->nowPage=isset($_GET['nowpage'])?$_GET['nowpage']:1;
        $this->startPage=($this->nowPage-1)*$this->count;
        $this->previou=$this->nowPage-1;
        $this->next=$this->nowPage+1;
        if($this->previou==0)
        {
            $this->previou=1;
        }
        if($this->next>$this->pageAll)
        {
            $this->next=$this->pageAll;
        }
    }
    //接口 获取开始条数
    public function getstart()
    {
        return $this->startPage;
    }
    //要显示几条数据
    public function getPageCount()
    {
        return $this->count;
    }
    //页码
    public function getNum()
    {
        if($this->previou==0)
        {
            $this->previou=1;
        }
        if($this->next>$this->pageAll)
        {
            $this->next=$this->pageAll;
        }
        $str="总共有{$this->pageAll}页 当前是第{$this->nowPage}页";
        $str.="<a href='{$this->url}&nowpage={$this->previou}'>上一页</a>";
        for($i=1;$i<=$this->pageAll;$i++)
        {
            $str.="<a href='{$this->url}&nowpage={$i}'>$i</a>";
        }
        $str.="<a href='{$this->url}&nowpage={$this->next}'>下一页</a>";
        return $str;
    }
   public function allpage()
   {
       return [
           'previou'=>$this->previou,//上一页
           'next'=>$this->next,  //下一页
           'nowpage'=>$this->nowPage, //当前页
           'allpage'=>$this->pageAll,  //总页数
           'allrow'=>$this->allRow
       ];
   }
}