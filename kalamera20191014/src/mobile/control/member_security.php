<?php
/**
 * 账户安全
 *
 *
 *
 
 
 
 
 */



defined('interMarket') or exit('Access Invalid!');

class member_securityControl extends mobileHomeControl {
    private $no_login;
    public function __construct() {
        parent::__construct();
        $model_mb_user_token = Model('mb_user_token');
        $key = $_POST['key'];
        if(empty($key)) {
            $key = $_GET['key'];
        }
        if(isset($key)){
            $mb_user_token_info = $model_mb_user_token->getMbUserTokenInfoByToken($key);
            if(empty($mb_user_token_info)) {
                output_error('请登录', array('login' => '0'));
            }
            $model_member = Model('member');
            $this->member_info = $model_member->getMemberInfoByID($mb_user_token_info['member_id']);
            if ($this->member_info){
                $member_gradeinfo = $model_member->getOneMemberGrade(intval($this->member_info['member_exppoints']),true);
                $this->member_info = array_merge($this->member_info,$member_gradeinfo);
                $this->member_info['security_level'] = $model_member->getMemberSecurityLevel($this->member_info);
            }
        }else{
            $this->no_login = true;
        }



        // var_dump($no_login);
        
    }

    /**
     * 会员等级
     */
    public function levelOp() {


        $model_member = Model('member');


        $condition = array();

        // $condition['member_id'] = array('neq',$this->member_info['member_id']);
        // $member_info = $model_member->getMemberInfo(array('member_id'=>$this->member_info['member_id']));

       
        // $member_info['security_level'] = Model('member')->getMemberSecurityLevel($member_info);

        // $model_member = Model('member');
        //  //查询会员等级
        //   $membergrade_arr = $model_member->getMemberGradeArr();
         // echo "<pre>";
        // print_R($membergrade_arr);
        // print_R($this->member_info);

        $level = $this->member_info['level'];
        if($level == 0){
            $this->member_info['level_desc'] = '注册会员';
        }else if($level == 1){
            $this->member_info['level_desc'] = '铜卡会员';
        }else if($level == 2){
            $this->member_info['level_desc'] =  '银卡会员';
        }else if($level == 3){
            $this->member_info['level_desc'] =  '金卡会员';
        }else if($level == 4){
            $this->member_info['level_desc'] =  '钻石会员';
        }
        $mem = $this->member_info;


        $model_setting = Model('setting');
        $list_setting = $model_setting->getListSetting();
        $list_setting['member_grade'] = $list_setting['member_grade']?unserialize($list_setting['member_grade']):array();
        foreach ($list_setting['member_grade'] as $key => $value) {
            //$value['upgrade_name'] = $value['level_name'];
            $value['level_desc'] = '注册会员';
            if($level == 0){
                $value['level_desc'] = '注册会员';
            }else if($level == 1){
                $value['level_desc'] = '铜卡会员';
            }else if($level == 2){
                $value['level_desc'] =  '银卡会员';
            }else if($level == 3){
                $value['level_desc'] =  '金卡会员';
            }else if($level == 4){
                $value['level_desc'] =  '钻石会员';
            }
            $list_setting['member_grade'][$key] = $value;
        }
          //print_R($list_setting['member_grade']);die;
        // foreach ($membergrade_arr as $key => $value) {
        //     if($mem['member_exppoints']){}
        //     if($mem['level'] == 3){
            
        //         $mem['next_point'] = '最高';
        //     }else{
        //         if($key <3 && $mem['level'] == $value['level']){
        //             $mem['next_point'] = $membergrade_arr[$key+1]['exppoints'] - $mem['member_exppoints'];
        //         }
        //     }
        // }
        // print_R($mem);
        output_data(array('data'=>$mem,'grade'=>$list_setting['member_grade']));
    }


     /**
     * 检测会员邮箱是否绑定
     * 更改绑定邮箱 第一步 - 得到已经绑定的邮箱号
     * 修改密码 第一步 - 得到已经绑定的邮箱号
     * 修改支付密码 第一步 - 得到已经绑定的邮箱号
     */
    public function get_email_infoOp() {
        $data = array();
        $data['state'] = $this->member_info['member_email_bind'] ? true : false;
        $data['email'] = $data['state'] ? encryptShow($this->member_info['member_email'],2,4) : $this->member_info['member_email'];
        $data['email_info'] = $this->member_info['member_email'];
        output_data($data);
    }


   
    /**
     * 初次绑定邮箱第一步
     */
    public function bind_email_step1Op() {
        if (!$_POST['email'] || !preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$_POST['email'])) {
            output_error('请正确输入邮箱');
        }
        if (!preg_match('/^\w{4}$/', $_POST['captcha']) || !Model('apiseccode')->checkApiSeccode($_POST["codekey"],$_POST['captcha'])) {
            output_error('验证码错误');
        }

        $model_member = Model('member');


        $condition = array();
        $condition['member_email'] = $_POST['email'];
        $condition['member_id'] = array('neq',$this->member_info['member_id']);
        $member_info = $model_member->getMemberInfo($condition,'member_id');
        // print_r($this->member_info);die;
        if ($member_info) {
            output_error('该邮箱已被使用');
        }
        //发送频率验证
        $member_common_info = $model_member->getMemberCommonInfo(array('member_id'=>$this->member_info['member_id']));

        
        // if (!empty($member_common_info['send_email_time']) && TIMESTAMP - $member_common_info['send_email_time'] < 58) {
        //     // showDialog('请60秒以后再次发送邮件');
        //     output_error('请60秒以后再次发送邮件');
        // }
        if (!empty($member_common_info['send_email_time'])) {
            if (date('Ymd',$member_common_info['send_email_time']) != date('Ymd',TIMESTAMP)) {
                $data = array();
                $data['send_acode_times'] = 0;
                $update = $model_member->editMemberCommon($data,array('member_id'=>$this->member_info['member_id']));
            } else {
                if (TIMESTAMP - $member_common_info['send_email_time'] < DEFAULT_CONNECT_SMS_TIME) {
                    output_error('请60秒以后再发');
                } else {
                    if ($member_common_info['send_acode_times'] >= 15) {
                        output_error('今天验证码已超15条，无法发送');
                    }
                }
            }
        }
        


       


        $verify_code = rand(100,999).rand(100,999);
        // $uid = base64_encode(encrypt($this->member_info['member_id'].' '.$this->member_info["member_email"]));
        // $verify_url = urlMember('login', 'bind_email', array('uid' => $uid, 'hash' => md5($seed)));

        $model_tpl = Model('mail_templates');
        $tpl_info = $model_tpl->getTplInfo(array('code'=>'authenticate'));
        $param = array();
        $param['send_time'] = date('Y-m-d H:i',TIMESTAMP);
        $param['site_name'] = C('site_name');
        $param['user_name'] = $this->member_info['member_name'];
        $param['verify_code'] = $verify_code;
        // $param['verify_url'] = $verify_url;
        $subject    = ncReplaceText($tpl_info['title'],$param);
        $message    = ncReplaceText($tpl_info['content'],$param);

        $email  = new Email();
        $result = $email->send_sys_email($this->member_info["member_email"],$subject,$message);
        if ($result) {
            $data = array();
            $data['auth_code'] = $verify_code;
            // $data['send_acode_time'] = TIMESTAMP;
            $data['send_email_time'] = TIMESTAMP;
            $data['send_acode_times'] = array('exp','send_acode_times+1');
            $data['auth_code_check_times'] = 0;

            $update = $model_member->editMemberCommon($data,array('member_id'=>$this->member_info['member_id']));
            if (!$update) {
                output_error('系统发生错误');
            }
            $data = array();
            $data['member_email'] = $_POST['email'];
            $update = $model_member->editMember(array('member_id'=>$this->member_info['member_id']),$data);
            if (!$update) {
                output_error('系统发生错误');
            }
            // var_dump($result);
            output_data(array('sms_time'=>DEFAULT_CONNECT_SMS_TIME));

        }else{
            output_error('验证码发送失败');
        }
    }

    /**
     * 初次绑定手机第二步 - 验证短信码
     */
    public function bind_email_step2Op() {
        if (!$_POST['auth_code'] || !preg_match('/^\d{6}$/',$_POST['auth_code'])) {
            output_error('请正确输入邮箱验证码');
        }
        $model_member = Model('member');
        $member_common_info = $model_member->getMemberCommonInfo(array('member_id'=>$this->member_info['member_id']));
        if (empty($member_common_info) || !is_array($member_common_info)) {
            output_error('验证失败');
        }
        if (TIMESTAMP - $member_common_info['send_email_time'] > 1800) {
            output_error('验证码已失效，请重新获取');
        }
        if ($member_common_info['auth_code_check_times'] > 3) {
            output_error('输入错误次数过多，请重新获取');
        }
        if ($member_common_info['auth_code'] != $_POST['auth_code']) {
            $data = array();
            $update_data['auth_code_check_times'] = array('exp','auth_code_check_times+1');
            $update = $model_member->editMemberCommon($update_data,array('member_id'=>$this->member_info['member_id']));
            if (!$update) {
                output_error('系统发生错误');
            }
            output_error('验证失败');
        }

        $data = array();
        $data['auth_code'] = '';
        $data['send_email_time'] = 0;
        $data['auth_code_check_times'] = 0;
        $update = $model_member->editMemberCommon($data,array('member_id'=>$this->member_info['member_id']));
        if (!$update) {
            output_error('系统发生错误');
        }
        $update = $model_member->editMember(array('member_id'=>$this->member_info['member_id']),array('member_email_bind'=>1));
        if (!$update) {
            output_error('系统发生错误');
        }
        output_data('1');
    }
    /**
     * 更改绑定邮箱 第二步 - 向已经绑定的邮箱发送验证码
     */
    public function modify_email_step2Op() {
        $this->_send_bind_email_msg();
    }

    /**
     * 更改密码 第二步 - 向已经绑定的邮箱发送验证码
     */
    public function modify_password_step2Op() {
        $this->_send_bind_email_msg();
    }

    /**
     * 更改支付密码第二步 - 向已经绑定的邮箱发送验证码
     */
    public function modify_paypwd_step2Op() {
        $this->_send_bind_email_msg();
    }


    private function _send_bind_email_msg() {
        // var_dump($this->no_login);
        if (!preg_match('/^\w{4}$/', $_POST['captcha']) || !Model('apiseccode')->checkApiSeccode($_POST["codekey"],$_POST['captcha'])) {
            output_error('验证码错误');
        }


        $model_member = Model('member');
        if($this->no_login){
            $condition = array();
            $condition['member_email'] = $_POST['email'];
            $this->member_info = $model_member->getMemberInfo($condition);
            // var_dump($this->member_info);
        }else{
            if (!$this->member_info['member_email_bind'] || !$this->member_info['member_email']) {
                output_error('您还未绑定邮箱');
            }
        }
        
        // if ($error != ''){
        //     // showValidateError($error);
        //     output_error($error);
        // }

        

        //发送频率验证
        $member_common_info = $model_member->getMemberCommonInfo(array('member_id'=>$this->member_info['member_id']));
        
        $verify_code = rand(100,999).rand(100,999);
        if (empty($member_common_info)) {
            $data = array();
            $data['member_id'] = $this->member_info['member_id'];
            $data['auth_code'] = $verify_code;
                // $data['send_acode_time'] = TIMESTAMP;
            $data['send_acode_time'] = TIMESTAMP;
            $data['send_acode_times'] = array('exp','send_acode_times+1');
            $rss = $model_member->addMemberCommon($data);
            if (!$rss) {
                output_error('系统发生错误');
            }
        }
        if (!empty($member_common_info['send_email_time'])) {
            if (date('Ymd',$member_common_info['send_email_time']) != date('Ymd',TIMESTAMP)) {
                $data = array();
                $data['send_acode_times'] = 0;
                $update = $model_member->editMemberCommon($data,array('member_id'=>$this->member_info['member_id']));
                if (!$update) {
                    output_error('系统发生错误');
                }
            } else {
                if (TIMESTAMP - $member_common_info['send_email_time'] < DEFAULT_CONNECT_SMS_TIME) {
                    output_error('请60秒以后再发');
                } else {
                    if ($member_common_info['send_acode_times'] >= 15) {
                        output_error('今天短信已超15条，无法发送');
                    }
                }
            }
        }

       

        
        // $data = array();
        // $data['member_email'] = $_POST['email'];
        // $data['member_email_bind'] = 0;
        // $update = $model_member->editMember(array('member_id'=>$this->member_info['member_id']),$data);
        // if (!$update) {
        //     output_error('系统发生错误，如有疑问请与管理员联系');
        // }

        
        



        // $seed = random(6);
        $data = array();
        $data['auth_code'] = $verify_code;
        // $data['send_acode_time'] = TIMESTAMP;
        $data['send_email_time'] = TIMESTAMP;
        $data['send_acode_times'] = array('exp','send_acode_times+1');
        $data['auth_code_check_times'] = 0;


        $update = $model_member->editMemberCommon($data,array('member_id'=>$this->member_info['member_id']));

        if (!$update) {
            output_error('系统发生错误，如有疑问请与管理员联系');
        }
        // $uid = base64_encode(encrypt($this->member_info['member_id'].' '.$this->member_info["member_email"]));
        // $verify_url = urlMember('login', 'bind_email', array('uid' => $uid, 'hash' => md5($seed)));

        $model_tpl = Model('mail_templates');
        $tpl_info = $model_tpl->getTplInfo(array('code'=>'authenticate'));
        $param = array();
        $param['send_time'] = date('Y-m-d H:i',TIMESTAMP);
        $param['site_name']	= C('site_name');
        $param['user_name'] = $this->member_info['member_name'];
        $param['verify_code'] = $verify_code;
        // $param['verify_url'] = $verify_url;
        $subject	= ncReplaceText($tpl_info['title'],$param);
        $message	= ncReplaceText($tpl_info['content'],$param);

        $email	= new Email();
	    $result	= $email->send_sys_email($this->member_info["member_email"],$subject,$message);
	    // showDialog('验证邮件已经发送至您的邮箱，请于24小时内登录邮箱并完成验证！如果您始终未收到邮件，请于60秒后重新发送','index.php?model=member_security&fun=index','succ','',10);
        output_data(array('sms_time'=>DEFAULT_CONNECT_SMS_TIME));

    }



    /**
     * 更改绑定邮箱 第三步 - 验证短信码
     */
    public function modify_email_step3Op() {
        if (!$_POST['auth_code'] || !preg_match('/^\d{6}$/',$_POST['auth_code'])) {
            output_error('请正确输入邮箱验证码');
        }
        $model_member = Model('member');
        $member_common_info = $model_member->getMemberCommonInfo(array('member_id'=>$this->member_info['member_id']));
        if (empty($member_common_info) || !is_array($member_common_info)) {
            output_error('验证失败');
        }
        if (TIMESTAMP - $member_common_info['send_email_time'] > 1800) {
            output_error('验证码已失效，请重新获取');
        }
        if ($member_common_info['auth_code_check_times'] > 3) {
            output_error('输入错误次数过多，请重新获取');
        }
        if ($member_common_info['auth_code'] != $_POST['auth_code']) {
            $data = array();
            $update_data['auth_code_check_times'] = array('exp','auth_code_check_times+1');
            $update = $model_member->editMemberCommon($update_data,array('member_id'=>$this->member_info['member_id']));
            if (!$update) {
                output_error('系统发生错误');
            }
            output_error('验证失败');
        }

        $data = array();
        $data['auth_code'] = '';
        $data['send_email_time'] = 0;
        $data['auth_code_check_times'] = 0;
        $update = $model_member->editMemberCommon($data,array('member_id'=>$this->member_info['member_id']));
        if (!$update) {
            output_error('系统发生错误');
        }
        $data = array();
        $data['member_email'] = '';
        $data['member_email_bind'] = 0;
        $update = $model_member->editMember(array('member_id'=>$this->member_info['member_id']),$data);
        if (!$update) {
            output_error('系统发生错误');
        }
        output_data('1');
    }

    /**
     * 更改密码 第三步 - 验证短信码
     */
    public function modify_password_step3Op() {
        $this->_modify_pwd_check_vcode();
    }

    /**
     * 更改支付密码 第三步 - 验证短信码
     */
    public function modify_paypwd_step3Op() {
        $this->_modify_pwd_check_vcode();
    }

    public function _modify_pwd_check_vcode() {
        if ($_GET['type'] == 1){
            if (!preg_match('/^\w{4}$/', $_POST['captcha']) || !Model('apiseccode')->checkApiSeccode($_POST["codekey"],$_POST['captcha'],false)) {
                output_error('验证码错误');
            }
        }
        
        if (!$_POST['auth_code'] || !preg_match('/^\d{6}$/',$_POST['auth_code'])) {
            output_error('请正确输入邮箱验证码');
        }
        $model_member = Model('member');

        if($this->no_login){
            $condition = array();
            $condition['member_email'] = $_POST['email'];
            $this->member_info = $model_member->getMemberInfo($condition);
            // var_dump($this->member_info);
        }

        $member_common_info = $model_member->getMemberCommonInfo(array('member_id'=>$this->member_info['member_id']));
        if (empty($member_common_info) || !is_array($member_common_info)) {
            output_error('验证失败');
        }
        if (TIMESTAMP - $member_common_info['send_email_time'] > 1800) {
            output_error('验证码已失效，请重新获取');
        }
        if ($member_common_info['auth_code_check_times'] > 3) {
            output_error('输入错误次数过多，请重新获取');
        }
        if ($member_common_info['auth_code'] != $_POST['auth_code']) {
            $data = array();
            $update_data['auth_code_check_times'] = array('exp','auth_code_check_times+1');
            $update = $model_member->editMemberCommon($update_data,array('member_id'=>$this->member_info['member_id']));
            if (!$update) {
                output_error('系统发生错误');
            }
            output_error('验证失败');
        }

        $data = array();
        $data['auth_code'] = '';
        $data['send_email_time'] = 0;
        $data['auth_code_check_times'] = 0;
        $update = $model_member->editMemberCommon($data,array('member_id'=>$this->member_info['member_id']));
        if (!$update) {
            output_error('系统发生错误');
        }

        //更改密码授权
        $update = $model_member->editMemberCommon(array('auth_modify_pwd_time'=>TIMESTAMP),array('member_id'=>$this->member_info['member_id']));
        if (!$update) {
            output_error('系统发生错误');
        }

        output_data('1');
    }



     /**
     * 邮箱绑定验证 绑定邮箱第三步 - 验证验证码
     */
    public function bind_email_step3Op() {

        $model_member = Model('member');
        $member_info = $model_member->getMemberInfo(array('member_id'=>$this->member_info['member_id']),'member_email');
       // if ($member_info['member_email'] != $_POST['email']) {
       //     output_error('验证失败');
       // }

       $member_common_info = $model_member->getMemberCommonInfo(array('member_id'=>$this->member_info['member_id']));
       if (empty($member_common_info) || !is_array($member_common_info)) {
           output_error('验证失败');
       }
       if ( TIMESTAMP - $member_common_info['send_email_time'] > 1800) {
           output_error('验证码已失效，请重新获取验证码');
       }

        if ($member_common_info['auth_code_check_times'] > 3) {
            output_error('输入错误次数过多，请重新获取');
        }
        if ($member_common_info['auth_code'] != $_POST['auth_code']) {
            $data = array();
            $update_data['auth_code_check_times'] = array('exp','auth_code_check_times+1');
            $update = $model_member->editMemberCommon($update_data,array('member_id'=>$this->member_info['member_id']));
            if (!$update) {
                output_error('系统发生错误');
            }
            output_error('验证失败');
        }
       // $update = $model_member->editMember(array('member_id'=>$this->member_info['member_id']),array('member_email_bind'=>1));
       // if (!$update) {
       //      output_error('系统发生错误，如有疑问请与管理员联系');
       // }

       $data = array();
       $data['auth_code'] = '';
       $data['send_email_time'] = 0;
       $update = $model_member->editMemberCommon($data,array('member_id'=>$this->member_info['member_id']));
       if (!$update) {

           output_error('系统发生错误，如有疑问请与管理员联系');
       }
       output_data('1');

    }

    public function find_passwordOp() {
        // if (!preg_match('/^\w{4}$/', $_POST['captcha']) || !Model('apiseccode')->checkApiSeccode($_POST["codekey"],$_POST['captcha'],false)) {
        //     output_error('验证码错误');
        // }
        $model_member = Model('member');
        $condition = array();
        $condition['member_email'] = $_POST['email'];
        // $condition['member_id'] = array('neq',$this->member_info['member_id']);
        $member_info = $model_member->getMemberInfo($condition);//检查邮箱号是否已被注册
        // print_r($this->member_info);die;
        if($this->no_login){
            $this->member_info = $member_info;
        }
        if (!empty($member_info)) {
            
        
            $password = trim($_POST['password']);
            $client = $_POST['client'];
            $new_password = md5($password);
            $model_member->editMember(array('member_id'=> $this->member_info['member_id']),array('member_passwd'=> $new_password));
            $member_id = $member_info['member_id'];
            $member_name = $member_info['member_name'];
             // print_R($member_info);
            $logic_connect_api = Logic('connect_api');
            $token = $logic_connect_api->getUserToken($member_info, $client);
            if($token) {
                $state_data['key'] = $token;
                $state_data['username'] = $member_name;
                $state_data['userid'] = $member_id;
             

                output_data($state_data);
            } else {
                output_error('会员Login failed');
            }
        }
        
    }


}
