<?php
/**
 * Facebook登录
 *
 * @author siuloong 20190510
 */


defined('interMarket') or exit('Access Invalid!');
require BASE_ROOT_PATH . '/lib/facebookarchive/facebook-php-sdk/src/facebook.php';

class connect_fbControl extends BaseLoginControl{
    public function __construct(){
        parent::__construct();
        Language::read("home_login_register,home_login_index");
        Tpl::output('hidden_login', 1);
    }
    /**
     * Facebook登录
     */
    public function indexOp(){
        /**
         * 判断Facebook登陆功能是否开启
         */
        if (C('facebook_isuse') != 1){
            showMessage('The function is not open yet', 'index.php','html','error');//'系统未开启
        }
        $facebook = new Facebook(array(
            'appId'  => C('facebook_appid'),
            'secret' => C('facebook_secret'),
        ));
        
        // Get User ID
        $user = $facebook->getUser();

        if ($user) { //已经登陆
            redirect('/');
        } else { //跳转facebook登陆
            $ref = getReferer();
            $redirect_uri = LOGIN_SITE_URL . '/index.php?model=connect_fb&fun=callback&ref=' . urlencode($ref);
            $loginUrl = $facebook->getLoginUrl(array(
                'redirect_uri' => $redirect_uri
            ));
            redirect($loginUrl);
        }
        
    }

    /**
     * 登陆回调
     *
     * @return void
     */
    public function callbackOp()
    {
        $facebook = new Facebook(array(
            'appId'  => C('facebook_appid'),
            'secret' => C('facebook_secret'),
        ));
        
        // Get User ID
        $user = $facebook->getUser();
        if ($user) {
            try {
                // Proceed knowing you have a logged in user who's authenticated.
                $user_info = $facebook->api('/me');
                if(!empty($user_info['user_id'])) {// test  参数名user_id待确认 by siuloong
                    $fb_userid = $user_info['user_id']; // test

                    $model_member = Model('member');
                    $member = $model_member->getMemberInfo(array('facebook_userid'=> $fb_userid));
                    if(!empty($member)) {//会员信息存在时自动登录
                        $model_member->createSession($member);
                        showDialog('Login successful',url('member_order', 'index'),'succ');
                    }
                    if(!empty($_SESSION['member_id'])) {//已登录时绑定
                        $member_id = $_SESSION['member_id'];
                        $member = array();
                        $member['facebook_userid'] = $fb_userid;
                        $member['facebook_userinfo'] = $user_info;
                        $model_member->editMember(array('member_id'=> $member_id), $member);
                        showDialog('Account binding successful', url('member_order', 'index'),'succ');
                    } else {//自动注册会员并登录
                        $rs = $this->register($user_info);
                        
                        if($rs) {
                            showDialog('Login successful',url('member_order', 'index'),'succ');
                        }
                    }
                }
            } catch (FacebookApiException $e) {
                error_log($e);
                $user = null;
            }
        }
        $ref_uri = urldecode($_GET['ref']);
        redirect($ref_uri);

    }

    /**
     * 注册
     */
    public function register($user_info){
        if(!empty($user_info['user_id'])) {
            $fb_userid = $user_info['user_id'];
            $logic_connect_api = Logic('connect_api');
            $rs = $logic_connect_api->facebookRegister($user_info, 'www');
            return $rs;
        }
    }
}