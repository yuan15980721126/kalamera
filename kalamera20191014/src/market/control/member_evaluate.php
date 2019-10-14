<?php
/**
 * 会员中心——买家评价
 
 
 

 */



defined('interMarket') or exit('Access Invalid!');
class member_evaluateControl extends BaseMemberControl{
    public function __construct(){
        parent::__construct() ;
        Language::read('member_layout,member_evaluate');
        Tpl::output('pj_act','member_evaluate');
    }

    /**
     * 订单添加评价
     */
    public function addOp(){
        $order_id = intval($_GET['order_id']);
        $return = Logic('member_evaluate')->validation($order_id, $_SESSION['member_id']);
        if (!$return['state']) {
            showMessage($return['msg'],'index.php?model=member_order','html','error');
        }
        extract($return['data']);
        //判断是否提交
        if (chksubmit()){
            $return = Logic('member_evaluate')->save($_POST, $order_info, $store_info, $order_goods, $this->member_info['member_id'], $this->member_info['member_name']);
            if (!$return['state']) {
                showDialog($return['msg'],'reload','error');
            } else {
                showDialog(Language::get('member_evaluation_evaluat_success'),'index.php?model=member_order', 'succ');
            }
        } else {
            //处理积分、经验值计算说明文字
            $ruleexplain = '';
            $exppoints_rule = C("exppoints_rule")?unserialize(C("exppoints_rule")):array();
            $exppoints_rule['exp_comments'] = intval($exppoints_rule['exp_comments']);
            $points_comments = intval(C('points_comments'));
            if ($exppoints_rule['exp_comments'] > 0 || $points_comments > 0){
                $ruleexplain .= '评价完成将获得';
                if ($exppoints_rule['exp_comments'] > 0){
                    $ruleexplain .= (' “'.$exppoints_rule['exp_comments'].'经验值”');
                }
                if ($points_comments > 0){
                    $ruleexplain .= (' “'.$points_comments.'积分”');
                }
                $ruleexplain .= '。';
            }
            Tpl::output('ruleexplain', $ruleexplain);
    
            $model_sns_alumb = Model('sns_album');
            $ac_id = $model_sns_alumb->getSnsAlbumClassDefault($_SESSION['member_id']);


            Tpl::output('ac_id', $ac_id);
            
            //不显示左菜单
            Tpl::output('left_show','order_view');
            Tpl::output('order_info',$order_info);
            Tpl::output('order_goods',$order_goods);
            Tpl::output('store_info',$store_info);
            Tpl::showpage('evaluation.add');
        }
    }

    /**
     * 商品添加评价
     */
    public function goodsaddOp(){

        $model_order = Model('order');
        $condition['buyer_id'] = $_SESSION['member_id'];
        $condition['order_state'] = ORDER_STATE_SUCCESS;
        if($_GET['order_id']){
            $condition['order_id'] = $_GET['order_id'];
        }
        $order_list = $model_order->getOrderList($condition, 20, '*', 'order_id desc','', array('order_common','order_goods','store'));

        $order_group_list = array();
        $evaluate_goods = array();
        if(count($order_list) > 0) {
            foreach ($order_list as $order_id => $order_info) {
                if (count($order_info['extend_order_goods']) > 0) {
                    foreach ($order_info['extend_order_goods'] as $order_info) {
                        $evaluate_goods[] = $order_info;
                    }
                }
            }
        }
        $model_evaluate_goods = Model("evaluate_goods");
        //echo '<pre>';
        foreach ($evaluate_goods as $order_id => $order_info) {
            $return = Logic('member_evaluate')->validation($order_info['order_id'], $_SESSION['member_id']);
            if (!$return['state']) {
                showMessage($return['msg'],'index.php?model=member_order','html','error');
            }

            foreach ($return['data']['order_goods'] as  $order_goods) {

                if($order_goods['goods_id'] == $order_info['goods_id']){
                    $evaluate_goods[$order_id]['goods_image_url'] = $order_goods['goods_image_url'];
                }
            }

            extract($return['data']);

        }

        //获取订单商品

        //die;
        $order_goods = $evaluate_goods;

        foreach ($order_goods as  $key=> $val) {
            if(is_array($_POST['goods'])) { print_R($_POST['goods']);
                reset($_POST['goods']);
                if ($val['rec_id'] == key($_POST['goods'])) {
                    $order_goods = $val;
                    break;
                }
            }
            //print_R($order_goods);
            $condition = array();
            $condition['geval_orderid'] = $val['order_id'];
            $condition['geval_goodsid'] = $val['goods_id'];
            $condition['geval_storeid'] = $val['store_id'];
            //
            $evaluate_info = $model_evaluate_goods->getEvaluateInfo($condition);

            if(count($evaluate_info)>0){
                unset($evaluate_goods[$key]);
            }
        }
        //print_R($evaluate_goods);
        //判断是否提交
        if (chksubmit()){
            //print_R($_POST);
            $condition = array();
            $condition['order_id'] = $_POST['order_id'];
            $ordergoods_list = $model_order->getOrderGoodsList($condition);
            $order_info = $model_order->getOrderInfo($condition);
            if(count($ordergoods_list)>0){
                foreach ($ordergoods_list as $goods_id){
                    $order[] = $goods_id['goods_id'];
                }
                $_POST['order_goods'] = $order;
            }
            $return = Logic('member_evaluate')->saveone($_POST, $order_info, $store_info, $order_goods, $this->member_info['member_id'], $this->member_info['member_name']);
            //print_R($return);die;
            if (!$return['state']) {

                showDialog($return['msg'],'reload','error');
            } else {
                showDialog(Language::get('member_evaluation_evaluat_success'),'index.php?model=member_order', 'succ');
            }
        } else {
            //处理积分、经验值计算说明文字
            $ruleexplain = '';
            $exppoints_rule = C("exppoints_rule")?unserialize(C("exppoints_rule")):array();
            $exppoints_rule['exp_comments'] = intval($exppoints_rule['exp_comments']);
            $points_comments = intval(C('points_comments'));
            if ($exppoints_rule['exp_comments'] > 0 || $points_comments > 0){
                $ruleexplain .= '评价完成将获得';
                if ($exppoints_rule['exp_comments'] > 0){
                    $ruleexplain .= (' “'.$exppoints_rule['exp_comments'].'经验值”');
                }
                if ($points_comments > 0){
                    $ruleexplain .= (' “'.$points_comments.'积分”');
                }
                $ruleexplain .= '。';
            }
            Tpl::output('ruleexplain', $ruleexplain);

            $model_sns_alumb = Model('sns_album');
            $ac_id = $model_sns_alumb->getSnsAlbumClassDefault($_SESSION['member_id']);
            Tpl::output('ac_id', $ac_id);


            $model_evaluate_goods = Model('evaluate_goods');

            $condition = array();
            $condition['geval_frommemberid'] = $_SESSION['member_id'];
            $goodsevalcount = $model_evaluate_goods->getEvaluateGoodsCount($condition);
            //不显示左菜单
            Tpl::output('left_show','order_view');
            Tpl::output('order_info',$order_info);
            Tpl::output('order_goods',$evaluate_goods);
            Tpl::output('goodsevalcount',$goodsevalcount);
            Tpl::output('not_num',count($evaluate_goods));
            Tpl::output('store_info',$store_info);
            $nav_link = array(
                array(
                    'title'=>'My Account',
                    'link'=>BASE_SITE_URL
                ),
                array(
                    'title'=>'To be evaluated'
                )
            );
            Tpl::output('nav_link_list',$nav_link);

            Tpl::showpage('evaluationgoods.add');
        }
    }

    /**
     * 订单添加评价
     */
    public function add_againOp(){
        $order_id = intval($_GET['order_id']);
        $return = Logic('member_evaluate')->validationAgain($order_id, $_SESSION['member_id']);
        if (!$return['state']) {
            showMessage($return['msg'],'index.php?model=member_order','html','error');
        }
        extract($return['data']);
    
        //判断是否提交
        if (chksubmit()){
            $return = Logic('member_evaluate')->saveAgain($_POST, $order_info, $evaluate_goods);
            if (!$return['state']) {
                showDialog($return['msg'],'reload','error');
            } else {
                showDialog(Language::get('member_evaluation_evaluat_success'),'index.php?model=member_order', 'succ');
            }
        } else {
            $model_sns_alumb = Model('sns_album');
            $ac_id = $model_sns_alumb->getSnsAlbumClassDefault($_SESSION['member_id']);
            Tpl::output('ac_id', $ac_id);
        
            //不显示左菜单
            Tpl::output('left_show','order_view');
            Tpl::output('order_info',$order_info);
            Tpl::output('evaluate_goods',$evaluate_goods);
            Tpl::output('store_info',$store_info);
            Tpl::showpage('evaluation.add_again');
        }
    }

    /**
     * 虚拟商品评价
     */
    public function add_vrOp(){
        $order_id = intval($_GET['order_id']);
        $return = Logic('member_evaluate')->validationVr($order_id, $_SESSION['member_id']);
        if (!$return['state']) {
            showMessage($return['msg'],'index.php?model=member_vr_order','html','error');
        }
        extract($return['data']);
        //判断是否为页面
        if (!$_POST){
            $order_goods[] = $order_info;
            //处理积分、经验值计算说明文字
            $ruleexplain = '';
            $exppoints_rule = C("exppoints_rule")?unserialize(C("exppoints_rule")):array();
            $exppoints_rule['exp_comments'] = intval($exppoints_rule['exp_comments']);
            $points_comments = intval(C('points_comments'));
            if ($exppoints_rule['exp_comments'] > 0 || $points_comments > 0){
                $ruleexplain .= '评价完成将获得';
                if ($exppoints_rule['exp_comments'] > 0){
                    $ruleexplain .= (' “'.$exppoints_rule['exp_comments'].'经验值”');
                }
                if ($points_comments > 0){
                    $ruleexplain .= (' “'.$points_comments.'积分”');
                }
                $ruleexplain .= '。';
            }
            Tpl::output('ruleexplain', $ruleexplain);

            //不显示左菜单
            Tpl::output('left_show','order_view');
            Tpl::output('order_info',$order_info);
            Tpl::output('order_goods',$order_goods);
            Tpl::output('store_info',$store_info);
            Tpl::showpage('evaluation.add');
        }else {
            $return = Logic('member_evaluate')->saveVr($_POST, $order_info, $store_info, $_SESSION['member_id'], $_SESSION['member_name']);
            if (!$return['state']) {
                showDialog($return['msg'],'reload','error');
            } else {
                showDialog(Language::get('member_evaluation_evaluat_success'),'index.php?model=member_vr_order', 'succ');
            }
        }
    }

    /**
     * 评价列表
     */
    public function listOp(){
        $type = $_GET['type'];
        $model_evaluate_goods = Model('evaluate_goods');

        $condition = array();


        $condition['geval_frommemberid'] = $_SESSION['member_id'];
        $goodsevallist = $model_evaluate_goods->getEvaluateGoodsList($condition, 10);
        $goodsevalcount = $model_evaluate_goods->getEvaluateGoodsCount($condition);




        Tpl::output('type',$type);
        Tpl::output('goodsevallist',$goodsevallist);
        Tpl::output('goodsevalcount',$goodsevalcount);

        Tpl::output('show_page',$model_evaluate_goods->showpage());

        $model_order = Model('order');
        $condition = array();
        $condition['buyer_id'] = $_SESSION['member_id'];
        $condition['order_state'] = ORDER_STATE_SUCCESS;
        $order_list = $model_order->getOrderList($condition, 20, '*', 'order_id desc','', array('order_common','order_goods','store'));
        $order_group_list = array();
        $evaluate_goods = array();
        if(count($order_list) > 0) {
            foreach ($order_list as $order_id => $order_info) {
                if (count($order_info['extend_order_goods']) > 0) {
                    foreach ($order_info['extend_order_goods'] as $order_info) {
                        $evaluate_goods[] = $order_info;
                    }
                }
            }
        }


        $nav_link = array(
            array(
                'title'=>'My Account',
                'link'=>BASE_SITE_URL
            ),
            array(
                'title'=>'Evaluate'
            )
        );



        Tpl::output('nav_link_list', $nav_link );
        Tpl::output('not_num',count($evaluate_goods));

        Tpl::showpage('evaluation.index');
    }

}
