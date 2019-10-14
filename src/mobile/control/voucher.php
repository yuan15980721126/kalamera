<?php
/**
 * 店铺
 *
 
 
 
 
 */



defined('interMarket') or exit('Access Invalid!');
class voucherControl extends mobileHomeControl{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * 代金券列表
     */
    public function voucher_tpl_listOp(){
        $param = $_REQUEST;

        $model_voucher = Model('voucher');
        $templatestate_arr = $model_voucher->getTemplateState();
        $voucher_gettype_array = $model_voucher->getVoucherGettypeArray();

        $where = array();
        $where['voucher_t_state'] = $templatestate_arr['usable'][0];
        $store_id = intval($param['store_id']);
        if ($store_id > 0){
            $where['voucher_t_store_id'] = $store_id;
        }
        $where['voucher_t_gettype'] = array('in',array($voucher_gettype_array['points']['sign'],$voucher_gettype_array['free']['sign']));
        if ($param['gettype'] && in_array($param['gettype'], array('points','free'))) {
            $where['voucher_t_gettype'] = $voucher_gettype_array[$param['gettype']]['sign'];
        }
        $order = 'voucher_t_id asc';
        $voucher_list = $model_voucher->getVoucherTemplateList($where, '*', 20, 0, $order);
        if ($voucher_list) {
            foreach($voucher_list as $k=>$v){
                $v['voucher_t_end_date_text'] = $v['voucher_t_end_date']?@date('Y年m月d日',$v['voucher_t_end_date']):'';
                $voucher_list[$k] = $v;
            }
        }
        $member_id = $this->getMemberIdIfExists();
        $my_list = $model_voucher->getMemberVoucherList($member_id, $param['voucher_state'], $this->page, 'voucher_state asc,voucher_id desc');
        // echo "<pre>";
        // print_R($my_list);

        // print_R($voucher_list);

        if(!empty($my_list)){
            foreach ($my_list as $key => $val) {
                $arr[$key] = $val['voucher_t_id'];
            }
        }
     
        foreach ($voucher_list as $key => $val) {
            if(!empty($arr)){
                if (in_array($val['voucher_t_id'], $arr)){
                    $voucher_list[$key]['voucher_state'] = 1;
                }else{
                    $voucher_list[$key]['voucher_state'] = 0;
                } 
            }else{
                $voucher_list[$key]['voucher_state'] = 0;
            }
        }
        
        // print_R($voucher_list);
        $page_count = $model_voucher->gettotalpage();
        // output_data(array('voucher_list' => $voucher_list));
        output_data(array('voucher_list' => $voucher_list), mobile_page($page_count));
    }
}
