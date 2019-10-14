<?php
/**
 * 支付宝服务器异步通知页面
 *
 * 
 

 
 */
$_GET['model']	= 'notify_refund';
$_GET['fun']		= 'alipay';
$_GET['refund']		= 'vr';//虚拟订单退款
require_once(dirname(__FILE__).'/../../../index.php');
?>