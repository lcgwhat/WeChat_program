<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/5
 * Time: 23:55
 */
class Personmodel extends Model
{
    function getallrow($table,$uid)
    {
        $data=$this->allrow($table,$uid);
        return $data;
    }
    function limitData($uid,$start,$count)
    {
        $sql="select * from tbl_title where uid='{$uid}' LIMIT {$start},{$count};";
        $data=$this->db->getData($sql);
        $this->daily($sql);
        return $data;

    }
}