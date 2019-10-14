<?php
/**
 * 自定义公共方法
 *
 * 公共方法
 * @author siuloong
 */

 /**
  * 测试打印输出
  * @author siuloong 20190426
  */
if (!function_exists('dd')) {
    function dd($var) {
        echo '<pre>';
        print_r($var);
        exit;
    }
}
