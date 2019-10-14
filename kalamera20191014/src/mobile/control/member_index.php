<?php
/**
 * 我的商城
 *
 
 
 
 
 */



defined('interMarket') or exit('Access Invalid!');

class member_indexControl extends mobileMemberControl {

    public function __construct(){
        parent::__construct();
    }

    /**
     * 我的商城
     */
    public function indexOp() {
        $member_info = array();
        $member_info['user_name'] = $this->member_info['member_name'];
        $member_info['avatar'] = getMemberAvatarForID($this->member_info['member_id']);

        $member_gradeinfo = Model('member')->getOneMemberGrade(intval($this->member_info['member_exppoints']));
        $member_info['level_name'] = $member_gradeinfo['level_name'];
        $member_info['favorites_store'] = Model('favorites')->getStoreFavoritesCountByMemberId($this->member_info['member_id']);
        $member_info['favorites_goods'] = Model('favorites')->getGoodsFavoritesCountByMemberId($this->member_info['member_id']);

        // 交易提醒
        $model_order = Model('order');
        $member_info['order_nopay_count'] = $model_order->getOrderCountByID('buyer', $this->member_info['member_id'], 'NewCount');
        $member_info['order_noreceipt_count'] = $model_order->getOrderCountByID('buyer', $this->member_info['member_id'], 'SendCount');
        $member_info['order_notakes_count'] = $model_order->getOrderCountByID('buyer', $this->member_info['member_id'], 'TakesCount');
        $member_info['order_noeval_count'] = $model_order->getOrderCountByID('buyer', $this->member_info['member_id'], 'EvalCount');
        
        // 售前退款
        $condition = array();
        $condition['buyer_id'] = $this->member_info['member_id'];
        $condition['refund_state'] = array('lt', 3);
        $member_info['return'] = Model('refund_return')->getRefundReturnCount($condition);

        //消息总数
        $message_model = Model('message');
        $condition_arr = array();
        $condition_arr['message_type'] = 1;//系统消息
        $condition_arr['to_member_id'] = $this->member_info['member_id'];
        // $condition_arr['no_del_member_id'] = $this->member_info['member_id'];
        // $condition_arr['no_read_member_id'] = $this->member_info['member_id'];
        // $condition_arr['read_member_id'] = $_SESSION['member_id'];
        $condition_arr['del_member_id'] = $_SESSION['member_id'];

        $countnum1 = $message_model->countMessage($condition_arr);


        $countnum2 = $message_model->countMessage(array('message_type'=>'2','to_member_id_common'=>$_SESSION['member_id'],'no_message_state'=>'2','message_open_common'=>'0'));
        
        $member_info['countnum'] = $countnum1+$countnum2;
        $info = Model('member')->getMemberInfoByID($this->member_info['member_id']);
        // print_R($info);
        $member_info['member_areaid'] = $info['member_areaid'];
        $member_info['member_cityid'] = $info['member_cityid'];
        $member_info['member_points'] = $info['member_points'];
        $member_info['member_truename'] = $info['member_truename'];
        $member_info['member_areainfo'] = $info['member_areainfo'];
        $member_info['member_email'] = $info['member_email'];
        $member_info['member_sex'] = $info['member_sex'];
        $member_info['member_mobile'] = $info['member_mobile'];
        $member_info['member_zipcode'] = $info['member_zipcode'];
        $member_info['member_birthday'] = $info['member_birthday'];
        output_data(array('member_info' => $member_info));
    }
    
    /**
     * 我的资产
     */
    public function my_assetOp() {
        $param = $_GET;
        if($param['type'] ==1){
            $member_info = array();
            $member_info['point'] = $this->member_info['member_points'];
            $member_info['predepoit'] = $this->member_info['available_predeposit'];
            $member_info['available_rc_balance'] = $this->member_info['available_rc_balance'];
            $member_info['redpacket'] = Model('redpacket')->getCurrentAvailableRedpacketCount($this->member_info['member_id']);
            $member_info['voucher'] = Model('voucher')->getCurrentAvailableVoucherCount($this->member_info['member_id']);


            $condition = array();
            $points_model = Model('points_log');
            $condition['pl_memberid'] = $this->member_info['member_id'];
            $condition['pl_stage'] = 'order';
            $order_count = $points_model->where($condition)->sum('pl_points');

            $condition = array();
            $condition['pl_memberid'] = $this->member_info['member_id'];
            $condition['pl_stage'] = 'login';
            $qindao_count = $points_model->where($condition)->sum('pl_points');
            // var_dump($order_count);
            // $order_count = $points_model->getPointsInfo($where);

            $member_info['order_count'] = $order_count;
            $member_info['qindao_count'] = $qindao_count;
            // output_data(array('order_count' => $order_count,'qindao_count' => $qindao_count));
            // print_r($member_info['voucher']);
        }else{
            $fields_arr = array('point','predepoit','available_rc_balance','redpacket','voucher');
            $fields_str = trim($param['fields']);
            if ($fields_str) {
                $fields_arr = explode(',',$fields_str);
            }
            // echo "<pre>";
            // print_R($this->member_info['member_id']);
            $member_info = array();
            if (in_array('point',$fields_arr)) {
                $member_info['point'] = $this->member_info['member_points'];
            }
            if (in_array('predepoit',$fields_arr)) {
                $member_info['predepoit'] = $this->member_info['available_predeposit'];
            }
            if (in_array('available_rc_balance',$fields_arr)) {
                $member_info['available_rc_balance'] = $this->member_info['available_rc_balance'];
            }
            if (in_array('redpacket',$fields_arr)) {
                $member_info['redpacket'] = Model('redpacket')->getCurrentAvailableRedpacketCount($this->member_info['member_id']);
            }
            if (in_array('voucher',$fields_arr)) {
                $member_info['voucher'] = Model('voucher')->getCurrentAvailableVoucherCount($this->member_info['member_id']);
                // print_r($member_info['voucher']);
            }
        }
        output_data($member_info);
    }

    /**
     * 我的资料【用户中心】
     *
     * @param
     * @return
     */

    public function memberOp() {

        Language::read('member_home_member');
        $lang   = Language::getLangContent();

        $model_member   = Model('member');
         // print_r($_POST);
         // die;
        if (chksubmit()){

            $member_array   = array();
            $member_array['member_truename']    = htmlspecialchars(strip_tags($_POST['member_truename']));
            $member_array['member_sex']         = intval($_POST['member_sex']);
            $member_array['member_qq']          = $_POST['member_qq'];
            $member_array['member_ww']          = $_POST['member_ww'];
            // $area_ids = explode(' ',$_POST['area_ids']);
            // $member_array['member_areaid']      = intval($area_ids[2]);
            // $member_array['member_cityid']      = intval($area_ids[1]);
            // $member_array['member_provinceid']  = intval($area_ids[0]);
            
            $member_array['member_mobile']      = $_POST['member_mobile'];
            $member_array['member_email']      = $_POST['member_email'];
            $member_array['member_zipcode']      = intval($_POST['member_zipcode']);
            $member_array['member_areaid']      = intval($_POST['area_id']);
            $member_array['member_cityid']      = intval($_POST['city_id']);
            $member_array['member_provinceid']  = intval($_POST['provinceid']);

            if(!empty($member_array['member_mobile'])){
                $member_array['member_mobile_bind'] = 1;
            }
            if(!empty($member_array['member_email'])){
                $member_array['member_email_bind'] = 1;
            }
            $region = trim($_POST['region']);
            if(mb_strlen($region) >9){
                $member_array['member_areainfo']    = $region.' 公开';
            }
            
            if (strlen($_POST['birthday']) == 10){
                $member_array['member_birthday']    = $_POST['birthday'];
            }
            $member_array['member_privacy']     = serialize($_POST['privacy']);
            $update = $model_member->editMember(array('member_id'=>$this->member_info['member_id']),$member_array);

            // $message = $update? $lang['nc_common_save_succ'] : $lang['nc_common_save_fail'];
            // showDialog($message,'reload',$update ? 'succ' : 'error');
            if($update){
                output_data(1);
            }else{
                output_error($message);
            }
            


            
        }

        // if($this->member_info['member_privacy'] != ''){
        //     $this->member_info['member_privacy'] = unserialize($this->member_info['member_privacy']);
        // } else {
        //     $this->member_info['member_privacy'] = array();
        // }

        
       
    }
}
