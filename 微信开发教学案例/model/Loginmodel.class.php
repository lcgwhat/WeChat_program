<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/5
 * Time: 22:12
 */
class Loginmodel extends Model
{
    function login($uid,$psd)
    {
        $sql="select * from tbl_user where uid='{$uid}' and pwd='{$psd}';";
        $data=$this->db->getData($sql);
        return $data;
    }
}