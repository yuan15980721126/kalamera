<?php
/**
 * 验证码
 *
 
 
 
 
 */



defined('interMarket') or exit('Access Invalid!');

class seccodeControl{
    public function __construct(){
    }
	
	/**
     * 产生验证码
     *
     */
    public function makecodekeyOp(){

		output_data(array('codekey' => getNchash()));
	}

    /**
     * 产生验证码
     *
     */
    public function makecodeOp(){
        $refererhost = parse_url($_SERVER['HTTP_REFERER']);
        $refererhost['host'] .= !empty($refererhost['port']) ? (':'.$refererhost['port']) : '';
        // var_dump($_GET);
        $seccode = makeSeccode($_GET['nchash']);

        @header("Expires: -1");
        @header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0", FALSE);
        @header("Pragma: no-cache");

       	$code = new seccode();
		$code->code = $seccode;
		$code->width = 120;
		$code->height = 50;
		$code->background = 2;
		$code->adulterate = 30;
		$code->scatter = 0;
		$code->color = 5;
		$code->size = 2;
		$code->shadow = 1;
		$code->animator = 0;
		$code->datapath =  BASE_DATA_PATH.'/resource/seccode/';
        $shuffle = md5($_GET['t']);
        $re = Model('apiseccode')->addApiSeccode($shuffle,$code->code);
		$code->display();
    }

    /**
     * AJAX验证
     *
     */
    public function checkOp($nchash,$captcha,$status=''){
        if($status){
            if (checkSeccode($nchash,$captcha)){
                return true;
            }else{
                return false;
            }
        }else{
            if (checkSeccode($_GET['nchash'],$_GET['captcha'])){
                exit('true');
            }else{
                exit('false');
            }
        }
    }
}
