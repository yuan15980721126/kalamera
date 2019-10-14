<?php
/**
 * 队列
 *
 *
 * 计划任务触发 by
 */

$_SERVER['argv'][1] = $_GET['model'];
@$_SERVER['argv'][2] = $_GET['fun'];
if (empty($_SERVER['argv'][1])) exit('Access Invalid!');

define('APP_ID','crontab');
define('BASE_PATH',str_replace('\\','/',dirname(__FILE__)));
define('TRANS_MASTER',true);
require __DIR__ . '/../congratulate.php';

if (PHP_SAPI == 'cli') {
     $_GET['model'] = $_SERVER['argv'][1];
     $_GET['fun'] = empty($_SERVER['argv'][2]) ? 'index' : $_SERVER['argv'][2];
}
if (!@include(BASE_PATH.'/control/control.php')) exit('control.php isn\'t exists!');

Base::run();
?>