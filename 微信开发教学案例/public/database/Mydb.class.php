<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/1
 * Time: 19:47
 */
class Mydb
{
    private $host;
    private $user;   //用户名
    private  $password; //密码
    private  $dbname;  //库名
    private  $port;    //端口号
    private $link;      //数据库连接资源
    private $result;  //结果返回
    static $db;
    public static function mydb($config)
    {
        if(self::$db==null)
        {
            self::$db=new Mydb($config);
        }
        return self::$db;
    }
    private function __construct($config)
    {
        $this->host=$config['host'];
        $this->password=$config['password'];
        $this->user=$config['user'];
        $this->dbname=$config['dbname'];
        $this->port=$config['port'];
        $this->link=@mysqli_connect($this->host,$this->user,$this->password,$this->dbname,$this->port);
        if(!$this->link)
        {
           echo "数据库连接失败<br>";
            echo "错误为：".mysqli_connect_error()."<br>";
            echo "错误代码：".mysqli_connect_errno()."<br>";
           exit();
        }
        mysqli_query($this->link,"SET NAMES 'utf8'");
    }
    public function __destruct()
    {
       @mysqli_free_result($this->result);
        mysqli_close($this->link);
    }
    public function dealDb($sql)
    {
       $this->result= mysqli_query($this->link,$sql);
        return $this->result;
    }
    public function getData($sql)
    {
        $data1=[];
        $this->result = mysqli_query($this->link,$sql);
        if($this->result!=false)
        {
            while($row=mysqli_fetch_assoc($this->result))
            {
                $data1[]=$row;
            }
        }
        return $data1;
    }
}