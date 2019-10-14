<?php
/**
 * 会员折扣管理
 *
 *
 

 
 */



defined('interMarket') or exit('Access Invalid!');
class member_discountControl extends SystemControl{
    const EXPORT_SIZE = 5000;
    public function __construct(){
        parent::__construct();
    }


    /**
     * 会员折扣管理
     */
    public function indexOp(){
        $model_setting = Model('setting');
        $list_setting = $model_setting->getListSetting();
        $list_setting['member_discount'] = $list_setting['member_discount']?unserialize($list_setting['member_discount']):array();
        if (chksubmit()){
            $update_arr = array();
            if($_POST['mg']){
                $mg_arr = array();
                $i = 0;
                foreach($_POST['mg'] as $k=>$v){
                    $mg_arr[$i]['level'] = $i;
                    $mg_arr[$i]['level_name'] = 'V'.$i;
                    //所需经验值
                    $mg_arr[$i]['discount'] = intval($v['discount']);
                    //下单折扣
                    //$mg_arr[$i]['orderdiscount'] = floatval($v['orderdiscount']);
                    $mg_arr[$i]['orderdiscount'] = 0;
                    $i++;
                }
                $update_arr['member_discount'] = serialize($mg_arr);
            } else {
                $update_arr['member_discount'] = '';
            }
            $result = true;
            if ($update_arr){
                $result = $model_setting->updateSetting($update_arr);
            }
            if ($result){
                $this->log(L('nc_edit,nc_member_discount'),1);
                showDialog(L('nc_common_save_succ'),'reload','succ');
            } else {
                $this->log(L('nc_edit,nc_member_discount'),0);
                showDialog(L('nc_common_save_fail'));
            }
        } else {
            Tpl::output('list_setting',$list_setting);
            Tpl::setDirquna('shop');
            Tpl::showpage('member_discount.grade');
        }
    }






    
    /**
     * 设置会员折扣规则
     */
    public function expsettingOp(){
        $model_setting = Model('setting');
        if (chksubmit()){
            $exp_arr = array();
            $exp_arr['exp_login'] = intval($_POST['exp_login'])?$_POST['exp_login']:0;
            $exp_arr['exp_comments'] = intval($_POST['exp_comments'])?$_POST['exp_comments']:0;
            $exp_arr['exp_orderrate'] = intval($_POST['exp_orderrate'])?$_POST['exp_orderrate']:0;
            $exp_arr['exp_ordermax'] = intval($_POST['exp_ordermax'])?$_POST['exp_ordermax']:0;
            $result = $model_setting->updateSetting(array('exppoints_rule'=>serialize($exp_arr)));
            if ($result === true){
                $this->log(L('nc_edit,nc_exppoints_manage,nc_exppoints_setting'),1);
                showMessage(L('nc_common_save_succ'));
            }else {
                showMessage(L('nc_common_save_fail'));
            }
        }
        $list_setting = $model_setting->getListSetting();
        // echo "<pre>";
        // print_R($list_setting);
        $list_setting['exppoints_rule'] = $list_setting['exppoints_rule']?unserialize($list_setting['exppoints_rule']):array();
        Tpl::output('list_setting',$list_setting);
		Tpl::setDirquna('shop');
        Tpl::showpage('member_discount.setting');
    }
    /**
     * 积分日志列表
     */
  //   public function indexOp(){
		// Tpl::setDirquna('shop');
  //       Tpl::showpage('member_exp.log');
  //   }

    /**
     * 输出XML数据
     */
    public function get_xmlOp() {
        $model_exppoints = Model('exppoints');
        $condition = array();
        if ($_POST['query'] != '') {
            $condition[$_POST['qtype']] = array('like', '%' . $_POST['query'] . '%');
        }
        $order = '';
        $param = array('exp_id','exp_memberid','exp_membername','exp_points','exp_addtime');
        if (in_array($_POST['sortname'], $param) && in_array($_POST['sortorder'], array('asc', 'desc'))) {
            $order = $_POST['sortname'] . ' ' . $_POST['sortorder'];
        }
        $page = $_POST['rp'];
        $list_log = $model_exppoints->getExppointsLogList($condition, '*', $page, 0, $order);

        $stage_arr = $model_exppoints->getStage();

        $data = array();
        $data['now_page'] = $model_exppoints->shownowpage();
        $data['total_num'] = $model_exppoints->gettotalnum();
        foreach ($list_log as $value) {
            $param = array();
            $param['operation'] = "--";
            $param['exp_id'] = $value['exp_id'];
            $param['exp_memberid'] = $value['exp_memberid'];
            $param['exp_membername'] = $value['exp_membername'];
            $param['exp_points'] = $value['exp_points'];
            $param['exp_addtime'] = date('Y-m-d H:i:s', $value['exp_addtime']);
            $param['exp_stage'] = $stage_arr[$value['exp_stage']];
            $param['exp_desc'] = $value['exp_desc'];
            $data['list'][$value['exp_id']] = $param;
        }
        echo Tpl::flexigridXML($data);exit();
    }


    
}