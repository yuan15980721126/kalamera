<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();

//包含配置信息
$data = rkcache("setting", true);
//判读站外分析是否开启
if($data['share_isuse'] != 1 || $data['share_sinaweibo_isuse'] != 1){
	echo "<script>alert('系统未开启该功能');</script>";
	echo "<script>window.close();</script>";	
	exit;
}
define( "WB_AKEY" ,  trim($data['share_sinaweibo_appid']));
define( "WB_SKEY" ,  trim($data['share_sinaweibo_appkey']));
define( "WB_CALLBACK_URL" , MEMBER_SITE_URL.DS.'index.php?model=member_sharemanage&fun=share_sinaweibo');