X<?php
// +----------------------------------------------------------------------
// | Perfect Is Shit
// +----------------------------------------------------------------------
// | 公共文件
// +----------------------------------------------------------------------
// | Author: alexander <gt199899@gmail.com>
// +----------------------------------------------------------------------
// | Datetime: 2016-07-28 11:55:30
// +----------------------------------------------------------------------
// | Copyright: ShowMore
// +----------------------------------------------------------------------
require_once('autoload.php');

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

// 下面为申请app获得的clientId和clientSecret，必填项，否则无法生成token。
//$clientId = $patment_info['payment_config']['ClientID'];
//$clientSecret = $patment_info['payment_config']['ClientSecret'];
//更改支付clientId，clientSecret获取方式 -- by siuloong 20190426
$payment_info = Model('payment')->getPaymentOpenInfo(array('payment_code' => 'paypal'));
$payment_config = unserialize($payment_info['payment_config']);
$clientId = $payment_config['ClientID'];
$clientSecret = $payment_config['ClientSecret'];
Log::record('paypal支付参数223'.json_encode($payment_config),Log::ERR);

$apiContext = new ApiContext(
    new OAuthTokenCredential(
        $clientId,
        $clientSecret
    )
);
$apiContext->setConfig(
    array(
        'mode' => 'live',
//       'log.LogEnabled' => true,
//       'log.FileName' => 'PayPal.log',
//       'log.LogLevel' => 'FINE', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
//       'cache.enabled' => true,
        // 'http.CURLOPT_CONNECTTIMEOUT' => 30
        // 'http.headers.PayPal-Partner-Attribution-Id' => '123123123'
        //'log.AdapterFactory' => '\PayPal\Log\DefaultLogFactory' // Factory class implementing \PayPal\Log\PayPalLogFactory
    )
);


// 浏览器友好的变量输出
function dump($var, $echo=true, $label=null, $strict=true) {
    $label = ($label === null) ? '' : rtrim($label) . ' ';
    if (!$strict) {
        if (ini_get('html_errors')) {
            $output = print_r($var, true);
            $output = "<pre>" . $label . htmlspecialchars($output, ENT_QUOTES) . "</pre>";
        } else {
            $output = $label . print_r($var, true);
        }
    } else {
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        if (!extension_loaded('xdebug')) {
            $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
            $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
        }
    }
    if ($echo) {
        echo($output);
        return null;
    }else
        return $output;
}

/**
 * ### getBaseUrl function
 * // utility function that returns base url for
 * // determining return/cancel urls
 *
 * @return string
 */
function getBaseUrl()
{
    if (PHP_SAPI == 'cli') {
        $trace=debug_backtrace();
        $relativePath = substr(dirname($trace[0]['file']), strlen(dirname(dirname(__FILE__))));
        echo "Warning: This sample may require a server to handle return URL. Cannot execute in command line. Defaulting URL to http://localhost$relativePath \n";
        return "http://localhost" . $relativePath;
    }
    $protocol = 'http';
    if ($_SERVER['SERVER_PORT'] == 443 || (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on')) {
        $protocol .= 's';
    }
    $host = $_SERVER['HTTP_HOST'];
    $request = $_SERVER['PHP_SELF'];
    return dirname($protocol . '://' . $host . $request);
}