<?php
/**
 * 我的代金券
 *
 *
 
 
 
 
 */



defined('interMarket') or exit('Access Invalid!');

class member_pointsControl extends mobileMemberControl {

    public function __construct() {
        parent::__construct();
    }
    /**
     * 积分日志列表
     */
    public function pointslogOp(){
        $where = array();
        $where['pl_memberid'] = $this->member_info['member_id'];
        //查询积分日志列表
        $points_model = Model('points');
        $log_list = $points_model->getPointsLogList($where, '*', 0, $this->page);

        
        $page_count = $points_model->gettotalpage();

    
        output_data(array('log_list' => $log_list), mobile_page($page_count));
    }

    /**
     * 积分类型统计列表
     */
    // public function pointsumOp(){
    //     $condition = array();
    //     $points_model = Model('points_log');
    //     $condition['pl_memberid'] = $this->member_info['member_id'];
    //     $condition['pl_stage'] = 'order';
    //     $order_count = $points_model->where($condition)->sum('pl_points');

    //     $condition = array();
    //     $condition['pl_memberid'] = $this->member_info['member_id'];
    //     $condition['pl_stage'] = 'login';
    //     $qindao_count = $points_model->where($condition)->sum('pl_points');
    //     // var_dump($order_count);
    //     // $order_count = $points_model->getPointsInfo($where);
    //     output_data(array('order_count' => $order_count,'qindao_count' => $qindao_count));
    // }

}
