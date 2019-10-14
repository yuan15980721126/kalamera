<?php
/**
 * 支付宝通知地址
 *
 * 
 
 
 
 
 */
error_reporting(7);
$_GET['model']	= 'payment';
$_GET['fun']		= 'notify';
$_GET['payment_code'] = 'alipay';
require_once(dirname(__FILE__).'/../../../index.php');
?>