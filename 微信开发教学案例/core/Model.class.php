<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/6
 * Time: 19:25
 */
class Model
{
    protected $db;
    public function __construct()
    {
        require_once "./public/database/Mydb.class.php";
        $config=include "./public/database/config.php";
        $this->db=Mydb::mydb($config);
    }
    public function daily($op)
    {
        $opDaily=new Opdaily();
        session_start();
        $emp=$_SESSION['user'];
        date_default_timezone_set("PRC");
        $s=date('Y-m-d H:i:s',time());
        $opDaily->docop($emp[0]['uid'],$s,$op);
    }
    protected function allrow($table,$user)
    {
        $sql="select COUNT(*) count from {$table} where uid='{$user}';";
        $data=$this->db->getData($sql);
        return $data[0]['count'];
    }

}