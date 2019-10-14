<?php
/**
 * 前台登录 退出操作
 *
 */



defined('interMarket') or exit('Access Invalid!');

class loginControl extends BaseLoginControl {

    public function __construct(){
        parent::__construct();
    }

    /**
     * 登录操作
     *
     */
    public function indexOp(){
        Language::read("home_login_index,home_login_register");
        $lang   = Language::getLangContent();
        $model_member   = Model('member');
        //检查登录状态
        $model_member->checkloginMember();
        if ($_GET['inajax'] == 1 && C('captcha_status_login') == '1'){
            $script = "document.getElementById('codeimage').src='index.php?model=seccode&fun=makecode&nchash=".getNchash()."&t=' + Math.random();";
        }
        $result = chksubmit(false,C('captcha_status_login'),'num');
        // $result = chksubmit(false,true,'num');
        $remember = $_POST['remember'];
        
        $model_setting = Model('setting');

        $list_setting = $model_setting->getListSetting();
//         echo "<pre>";
//             print_R($_POST);die;
        Tpl::output('list_setting',$list_setting);
        if ($result !== false){
            if ($result === -11){
                showDialog($lang['login_index_login_illegal'],'','error',$script);
            }elseif ($result === -12){
                showDialog($lang['login_index_wrong_checkcode'],'','error',$script);
            }
	    
            $login_info = array();
            $login_info['user_name'] = $_POST['user_name'];
            $login_info['password'] = $_POST['password'];
            $member_info = $model_member->login($login_info);

            if($remember == 1){
                setcookie('user_name',$login_info['user_name'],time()+3600);
                setcookie('remember',$remember,time()+3600);
            }else{
                setcookie('user_name',$login_info['user_name'],time()-3600);
                setcookie('remember',$remember,time()-3600);
            }

            if(isset($member_info['error'])) {
                showDialog($member_info['error'],'','error',$script);
            }

            // 自动登录
            $member_info['auto_login'] = $_POST['auto_login'];
            $model_member->createSession($member_info, true);
            if ($_GET['inajax'] == 1){
                showDialog('',$_REQUEST['ref_url'] == '' ? 'reload' : $_REQUEST['ref_url'],'js');
            } else {
                //print_R($_REQUEST);die;
                //$ref_url = request_uri();
                //echo $ref_url;die;
                redirect($_REQUEST['ref_url']);
            }
        }else{

            //登录表单页面
            $_pic = @unserialize(C('login_pic'));
            if ($_pic[0] != ''){
                Tpl::output('lpic',UPLOAD_SITE_URL_HTTPS.'/'.ATTACH_LOGIN.'/'.$_pic[array_rand($_pic)]);
            }else{
                Tpl::output('lpic',UPLOAD_SITE_URL_HTTPS.'/'.ATTACH_LOGIN.'/'.rand(1,4).'.jpg');
            }

            if(empty($_REQUEST['ref_url'])) {
                $ref_url = getReferer();
                if (!preg_match('/model=login&fun=logout/', $ref_url)) {
                    $_REQUEST['ref_url'] = $ref_url;
                }
            }
            Tpl::output('html_title',C('site_name').' - '.$lang['login_index_login']);
            if ($_REQUEST['inajax'] == 1){
                Tpl::showpage('login_inajax','null_layout');
            }else{
                Tpl::showpage('login');
            }
        }
    }

    /**
     * 退出操作
     *
     * @param int $id 记录ID
     * @return array $rs_row 返回数组形式的查询结果
     */
    public function logoutOp(){
        Language::read("home_login_index");
        $lang   = Language::getLangContent();
        // 清理COOKIE
        setNcCookie('msgnewnum'.$_SESSION['member_id'],'',-3600);
        setNcCookie('auto_login', '', -3600);
        setNcCookie('cart_goods_num','',-3600);
        session_unset();
        session_destroy();
        if(empty($_GET['ref_url'])){
            $ref_url = getReferer();
        }else {
            $ref_url = $_GET['ref_url'];
        }
        redirect(LOGIN_SITE_URL . '/index.php?model=login&ref_url='.urlencode($ref_url));
    }

    /**
     * 会员注册页面
     *
     * @param
     * @return
     */
    public function registerOp() {
        Language::read("home_login_register");
        $lang   = Language::getLangContent();
        $model_member   = Model('member');
        $model_member->checkloginMember();
        if(isset($_GET['way']) && $_GET['way'] == 'fast' ){
            Tpl::output('register_way','fast');
        }else{
            Tpl::output('register_way','putong');
        }
        Tpl::output('html_title',C('site_name').' - '.$lang['login_register_join_us']);
        Tpl::showpage('register');
    }

    /**
     * 会员添加操作
     *
     * @param
     * @return
     */
    public function usersaveOp() {
        //重复注册验证
        if (process::islock('reg')){
            showDialog(Language::get('nc_common_op_repeat'));
        }
        Language::read("home_login_register");
        $lang   = Language::getLangContent();
        $model_member   = Model('member');
        $model_member->checkloginMember();
        $result = chksubmit(0,C('captcha_status_register'),'num');
        if ($result){
            if ($result === -11){
                showDialog($lang['invalid_request'],'','error');
            }elseif ($result === -12){
                showDialog($lang['login_usersave_wrong_code'],'','error');
            }
        } else {
            showDialog($lang['invalid_request'],'','error');
        }
        $register_info = array();
        $register_info['username'] = $_POST['user_name'];
        $register_info['firstName'] = htmlspecialchars(strip_tags($_POST['firstName']));
        $register_info['lastName'] = htmlspecialchars(strip_tags($_POST['lastName']));

        $register_info['password'] = $_POST['password'];
        $register_info['password_confirm'] = $_POST['password_confirm'];
        $register_info['email'] = $_POST['user_name'];
        $register_info['phone'] = $_POST['phone'];
		//添加奖励积分ID BY
		$register_info['inviter_id'] = intval(base64_decode($_COOKIE['uid']))/1;
        $member_info = $model_member->register($register_info);
        if(!isset($member_info['error'])) {
            $model_member->createSession($member_info,true);
            process::addprocess('reg');

            $_POST['ref_url']   = (strstr($_POST['ref_url'],'logout')=== false && !empty($_POST['ref_url']) ? $_POST['ref_url'] : urlShop('member', 'home'));
            if ($_GET['inajax'] == 1){
                showDialog('',$_POST['ref_url'] == '' ? 'reload' : $_POST['ref_url'],'js');
            } else {
                redirect($_POST['ref_url']);
            }
        } else {
            showDialog($member_info['error']);
        }
    }
    /**
     * 会员名称检测
     *
     * @param
     * @return
     */
    public function check_memberOp() {
        /**
        * 实例化模型
        */
        $model_member   = Model('member');
        
        $check_member_name  = $model_member->getMemberInfo(array('member_name'=>$_GET['user_name']));
        if(is_array($check_member_name) && count($check_member_name)>0) {
            echo 'false';
        } else {
            echo 'true';
        }
    }

     /**
     * 手机号码检测
     *
     * @param
     * @return
     */
    public function check_mobile_reOp() {
        /**
        * 实例化模型
        */
        $model_member   = Model('member');

        $check_member_mobile = $model_member->getMemberInfo(array('member_mobile'=> $_GET['phone']));//检查手机号是否已被注册
        if(is_array($check_member_mobile) && count($check_member_mobile)>0) {
            echo 'false';
        } else {
            echo 'true';
        }
    }

    /**
     * 电子邮箱检测
     *
     * @param
     * @return
     */
    public function check_emailOp() {
        $model_member = Model('member');
        $check_member_email = $model_member->getMemberInfo(array('member_email'=>$_GET['email']));
        if(is_array($check_member_email) && count($check_member_email)>0) {
            echo 'false';
        } else {
            echo 'true';
        }
    }

    /**
     * 忘记密码页面
     */
    public function forget_passwordOp(){
        /**
         * 读取语言包
         */
        Language::read('home_login_register');
        $_pic = @unserialize(C('login_pic'));
        if ($_pic[0] != ''){
            Tpl::output('lpic',UPLOAD_SITE_URL_HTTPS.'/'.ATTACH_LOGIN.'/'.$_pic[array_rand($_pic)]);
        }else{
            Tpl::output('lpic',UPLOAD_SITE_URL_HTTPS.'/'.ATTACH_LOGIN.'/'.rand(1,4).'.jpg');
        }
        if(!empty($_POST['repasswordway']) && $_POST['repasswordway']=='repassword_one'){
            $lang   = Language::getLangContent();
//            print_R($_POST);
            $result = chksubmit(true,true,'num');
            if ($result !== false){
                if ($result === -11){
                    // showDialog('非法提交','','error');
                    exit(json_encode(array('state'=>false,'msg'=>'非法提交')));
                }elseif ($result === -12){
                    // showDialog('验证码错误','','error');
                    exit(json_encode(array('state'=>false,'msg'=>'验证码错误')));
                }
            }

            if(empty($_POST['username'])){
                // showDialog($lang['login_password_input_username'],'','error');
                exit(json_encode(array('state'=>false,'msg'=>$lang['login_password_input_username'])));
            }

            if (process::islock('forget')) {
                // showDialog($lang['nc_common_op_repeat'],'','error');
                exit(json_encode(array('state'=>false,'msg'=>$lang['nc_common_op_repeat'])));
            }

            $member_model   = Model('member');
            $member = $member_model->getMemberInfo(array('member_name'=>$_POST['username']));
            // if(empty($member) or !is_array($member)){
            //     process::addprocess('forget');
            //     showDialog($lang['login_password_username_not_exists'],'','error');
            // }else{
                $member['member_mobile'] = substr($member['member_mobile'], 0, 3).'****'.substr($member['member_mobile'], 7);
            //     Tpl::output('member',$member);
            // }
            
            // echo "<pre>";
            // print_r($member);
            // Tpl::output('member',$member);
            // Tpl::output('repasswordway',"repassword_two");
            if(empty($member) or !is_array($member)){
                exit(json_encode(array('state'=>false,'msg'=>'该用户名不存在')));
            }else {
            //     Tpl::output('repasswordway',"repassword_two");
            // Tpl::showpage('find_password');
                // foreach ($member as $k => $v) {
                //     $code .= $k.'='.$v.'&';
                // }
                // $url = rtrim($code,'&');
                // // echo $code;
                // $code = urlencode($url);
                exit(json_encode(array('state'=>true,'repasswordway'=>'repassword_two','data'=>$member)));
            }
        }
        Tpl::output('html_title',C('site_name').' - '.Language::get('login_index_find_password'));
        if(!empty($_GET['repasswordway'])){
            $result = chksubmit(true,false,'num');
            // if (!$result){
            //     showMessage('非法提交',SHOP_SITE_URL,'html','error');
            // }            
            if ($result !== false){
                if ($result === -11){
                    // showDialog('非法提交','','error');
                    showMessage('Illegal to submit',SHOP_SITE_URL,'html','error'); //非法提交
                }
            }
            if($_GET['repasswordway']=='repassword_two'){
                $member_model   = Model('member');
                $member = $member_model->getMemberInfo(array('member_name'=>$_POST['username']));
                $member['member_mobile_yin'] = substr($member['member_mobile'], 0, 3).'****'.substr($member['member_mobile'], 7);
                Tpl::output('member',$member);
                Tpl::output('repasswordway',"repassword_two");

                Tpl::showpage('find_password');
            }
            if($_GET['repasswordway']=='repassword_three'){
                $member_model   = Model('member');
                $member = $member_model->getMemberInfo(array('member_name'=>$_POST['username']));
                Tpl::output('member',$member);
                Tpl::output('repasswordway',"repassword_three");
                
                Tpl::showpage('find_password');
            }
            if($_GET['repasswordway']=='repassword_four'){
                $url = urlMember('login', 'index');
                Tpl::output('url',$url);
                Tpl::output('repasswordway',"repassword_four");
                
                Tpl::showpage('find_password');
            }
        }
        Tpl::showpage('find_password');
    }
    

    /**
     * 找回密码验证手机验证码
     */
    public function check_mobileOp(){
            if(C('sms_password') != 1) {
                // showDialog('系统没有开启手机找回密码功能','','error');
                exit(json_encode(array('state'=>false,'msg'=>'系统没有开启手机找回密码功能')));
            }
            $phone = $_POST['phone'];
            $captcha = $_POST['sms_captcha'];
            $logic_connect_api = Logic('connect_api');
            $state_data = $logic_connect_api->checkSmsCaptcha($phone, $captcha, 3);
            if($state_data['state'] == false) {//半小时内进行验证为有效
                // showDialog('验证码错误或已过期，重新输入','','error');
                exit(json_encode(array('state'=>false,'msg'=>'验证码错误或已过期，重新输入')));
            }
            $model_member = Model('member');
            $member = $model_member->getMemberInfo(array('member_mobile'=> $phone));//检查手机号是否已被注册
            if(!empty($member)) {
                exit(json_encode(array('state'=>true,'repasswordway'=>'repassword_three','data'=>$member)));
                // $new_password = md5($_POST['password']);
                // $model_member->editMember(array('member_id'=> $member['member_id']),array('member_passwd'=> $new_password));
                // $model_member->createSession($member);//自动登录
                // showDialog('Passwd updated successfully',urlMember('member_information', 'member'),'succ');
            }
    }

    /**
     * 找回密码验邮箱证验证码
     */
    public function check_email_findOp(){

            $model_member = Model('member');

            $member = $model_member->getMemberInfo(array('member_name'=>$_POST['username']));
            $member_common_info = $model_member->getMemberCommonInfo(array('member_id'=>$member['member_id']));
            if (empty($member_common_info) || !is_array($member_common_info)) {
                exit(json_encode(array('state'=>false,'msg'=>'验证失败')));
            }
            if (TIMESTAMP - $member_common_info['send_email_time'] > 1800) {
                exit(json_encode(array('state'=>false,'msg'=>'验证码已失效，请重新获取验证码')));
                // showMessage('验证码已失效，请重新获取验证码','','html','error');
            }
            if ($member_common_info['auth_code'] != $_POST['auth_code']) {
                exit(json_encode(array('state'=>false,'msg'=>'验证失败')));
                // showMessage('验证失败','','html','error');
            }
            $data = array();
            $data['auth_code'] = '';
            $data['send_email_time'] = 0;
            $update = $model_member->editMemberCommon($data,array('member_id'=>$member['member_id']));
            if (!$update) {
                exit(json_encode(array('state'=>false,'msg'=>'系统发生错误，如有疑问请与管理员联系')));
            }
            exit(json_encode(array('state'=>true,'msg'=>'验证通过')));
               
    }

    /**
     * 找回密码的发邮件处理
     */
    public function find_passwordOp(){

        Language::read('home_login_register');
        $lang   = Language::getLangContent();

        $result = chksubmit(true,true,'num');
        if ($result !== false){
            if ($result === -11){
                showDialog('非法提交','','error');
            }elseif ($result === -12){
                showDialog('验证码错误','','error');
            }
        }

        //if(empty($_POST['username'])){
        //    showDialog($lang['login_password_input_username'],'','error');
        //}

        if (process::islock('forget')) {
            showDialog($lang['nc_common_op_repeat'],'','error');
        }
        if(empty($_POST['email'])){
            showDialog($lang['login_password_input_email'],'','error');
        }

        $member_model   = Model('member');
        $member = $member_model->getMemberInfo(array('member_name'=>$_POST['email']));
        if(empty($member) or !is_array($member)){
            process::addprocess('forget');
            showDialog($lang['login_password_username_not_exists'],'','error');
        }



        //if(strtoupper($_POST['email'])!=strtoupper($member['member_email'])){
        //    process::addprocess('forget');
        //    showDialog($lang['login_password_email_not_exists'],'','error');
        //}
        process::clear('forget');
        //产生密码
        $new_password   = random(15);
        if(!($member_model->editMember(array('member_id'=>$member['member_id']),array('member_passwd'=>md5($new_password))))){
            showDialog($lang['login_password_email_fail'],'','error');
        }

        $model_tpl = Model('mail_templates');
        $tpl_info = $model_tpl->getTplInfo(array('code'=>'reset_pwd'));
        $param = array();
        $param['site_name'] = C('site_name');
        $param['user_name'] = $_POST['username'];
        $param['new_password'] = $new_password;
        $param['site_url'] = SHOP_SITE_URL;
        $subject    = ncReplaceText($tpl_info['title'],$param);
        $message    = ncReplaceText($tpl_info['content'],$param);

        $email	= new Email();
        $result	= $email->send_sys_email($_POST["email"],$subject,$message);
        showDialog('The new password has been sent to your mailbox. Please login and change your password as soon as possible！','index.php?model=login&fun=index','succ','',5);
    }

    /**
     * 邮箱绑定验证
     */
    public function bind_emailOp() {
       $model_member = Model('member');
       $uid = @base64_decode($_GET['uid']);
       $uid = decrypt($uid,'');
       list($member_id,$member_email) = explode(' ', $uid);

       if (!is_numeric($member_id)) {
           showMessage('Verification failed',SHOP_SITE_URL,'html','error'); //验证失败
       }

       $member_info = $model_member->getMemberInfo(array('member_id'=>$member_id),'member_email');
       if ($member_info['member_email'] != $member_email) {
           showMessage('Verification failed',SHOP_SITE_URL,'html','error');
       }

       $member_common_info = $model_member->getMemberCommonInfo(array('member_id'=>$member_id));
       if (empty($member_common_info) || !is_array($member_common_info)) {
           showMessage('Verification failed',SHOP_SITE_URL,'html','error');
       }
       if (md5($member_common_info['auth_code']) != $_GET['hash'] || TIMESTAMP - $member_common_info['send_email_time'] > 24*3600) {
           showMessage('Verification failed',SHOP_SITE_URL,'html','error');
       }

       $update = $model_member->editMember(array('member_id'=>$member_id),array('member_email_bind'=>1));
       if (!$update) {
           showMessage('System error, please contact the administrator',SHOP_SITE_URL,'html','error');//系统发生错误，如有疑问请与管理员联系
       }

       $data = array();
       $data['auth_code'] = '';
       $data['send_email_time'] = 0;
       $update = $model_member->editMemberCommon($data,array('member_id'=>$_SESSION['member_id']));
       if (!$update) {
           showDialog('System error, please contact the administrator');//系统发生错误，如有疑问请与管理员联系
       }
       showMessage('Email setting successful','index.php?model=member_security&fun=index'); //邮箱设置成功

    }
}
