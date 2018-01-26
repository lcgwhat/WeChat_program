<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/4
 * Time: 18:46
 */
session_start();
require_once "Validate.class.php";
$img=new Validate();
$img->doimg();
$code=$img->getCode();


$_SESSION['code']=$code;