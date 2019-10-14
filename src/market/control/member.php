 <?php
/**
 * 会员中心——账户概览
 *
 *
 *
 
 
 
 
 */



defined('interMarket') or exit('Access Invalid!');

class memberControl extends BaseMemberControl{

    /**
     * 我的商城
     */
    public function homeOp() {
        $nav_link_list = array(
            array(
                'title'=>'My Account',
                'link'=>urlShop('member', 'home')
            ),
            array(
                'title'=>'Account Details'
            )
        );



        Tpl::output('nav_link_list', $nav_link_list );
        Tpl::showpage('member_home');
    }

    public function ajax_load_member_infoOp() {

        $member_info = $this->member_info;
        $member_info['security_level'] = Model('member')->getMemberSecurityLevel($member_info);

        //代金券数量
        $member_info['voucher_count'] = Model('voucher')->getCurrentAvailableVoucherCount($_SESSION['member_id']);
        
        //订单数量
        $model_order = Model('order');
        $member_info['order_count'] = $model_order->getOrderCountByID('buyer',$_SESSION['member_id'],'TradeCount');
        $this->showReceivedNewNum();
        
        Tpl::output('home_member_info',$member_info);
        // echo "<pre>";
        // print_R($member_info);
        Tpl::showpage('member_home.member_info','null_layout');
    }

    /**
     * 统计未读消息
     */
     private function showReceivedNewNum() {
        //查询新接收到普通的消息
        $newcommon = $this->receivedCommonNewNum();
        Tpl::output('newcommon',$newcommon);

         //查询新接收到系统的消息
        $newsystem = $this->receivedSystemNewNum();
        Tpl::output('newsystem',$newsystem);
        //查询新接收到卖家的消息
        $newpersonal = $this->receivedPersonalNewNum();
        Tpl::output('newpersonal',$newpersonal);
    }

    /**
     * 统计系统站内信未读条数
     *
     * @return int
     */
    private function receivedSystemNewNum(){
        $message_model = Model('message');
        $condition_arr = array();
        $condition_arr['message_type'] = '1';//系统消息
        $condition_arr['to_member_id'] = $_SESSION['member_id'];
        // $condition_arr['no_del_member_id'] = $_SESSION['member_id'];
        // $condition_arr['no_read_member_id'] = $_SESSION['member_id'];

        // $condition_arr['read_member_id'] = $_SESSION['member_id'];
        $condition_arr['del_member_id'] = $_SESSION['member_id'];
        $countnum = $message_model->countMessage($condition_arr);
        return $countnum;
    }

    /**
     * 统计收到站内信未读条数
     *
     * @return int
     */
    private function receivedCommonNewNum(){
        $model_message  = Model('message');
        $countnum = $model_message->countMessage(array('message_type'=>'2','to_member_id_common'=>$_SESSION['member_id'],'no_message_state'=>'2','message_open_common'=>'0'));
        return $countnum;
    }

    /**
     * 统计私信未读条数
     *
     * @return int
     */
    private function receivedPersonalNewNum(){
        $model_message = Model('message');
        $countnum = $model_message->countMessage(array('message_type'=>'0','to_member_id_common'=>$_SESSION['member_id'],'no_message_state'=>'2','message_open_common'=>'0'));
        return $countnum;
    }


    public function ajax_load_order_infoOp() {
        $model_order = Model('order');

        //交易提醒 - 显示数量
        $member_info['order_nopay_count'] = $model_order->getOrderCountByID('buyer',$_SESSION['member_id'],'NewCount');
        $member_info['order_noreceipt_count'] = $model_order->getOrderCountByID('buyer',$_SESSION['member_id'],'SendCount');
        $member_info['order_noeval_count'] = $model_order->getOrderCountByID('buyer',$_SESSION['member_id'],'EvalCount');
        Tpl::output('home_member_info',$member_info);

        //交易提醒 - 显示订单列表
        $condition = array();
        $condition['buyer_id'] = $_SESSION['member_id'];
        $condition['order_state'] = array('in',array(ORDER_STATE_NEW,ORDER_STATE_PAY,ORDER_STATE_SEND,ORDER_STATE_SUCCESS));
        $order_list = $model_order->getNormalOrderList($condition,'','*','order_id desc',3,array('order_goods'));

        foreach ($order_list as $order_id => $order) {
            //显示物流跟踪
            $order_list[$order_id]['if_deliver'] = $model_order->getOrderOperateState('deliver',$order);
            //显示评价
            $order_list[$order_id]['if_evaluation'] = $model_order->getOrderOperateState('evaluation',$order);
            //显示支付
            $order_list[$order_id]['if_payment'] = $model_order->getOrderOperateState('payment',$order);
            //显示收货
            $order_list[$order_id]['if_receive'] = $model_order->getOrderOperateState('receive',$order);
        }

        Tpl::output('order_list',$order_list);
        // echo "<pre>";
        // print_R($order_list);
        //取出购物车信息
        $model_cart = Model('cart');
        $cart_list  = $model_cart->listCart('db',array('buyer_id'=>$_SESSION['member_id']),3);
        Tpl::output('cart_list',$cart_list);
        Tpl::showpage('member_home.order_info','null_layout');
    }

    public function ajax_load_goods_infoOp() {
        //商品收藏
        $favorites_model = Model('favorites');
        $favorites_list = $favorites_model->getGoodsFavoritesList(array('member_id'=>$_SESSION['member_id']), '*', 10);
        if (!empty($favorites_list) && is_array($favorites_list)){
            $favorites_id = array();//收藏的商品编号
            foreach ($favorites_list as $key=>$fav){
                $favorites_id[] = $fav['fav_id'];
            }
            $goods_model = Model('goods');
            $field = 'goods_id,goods_name,store_id,goods_image,goods_promotion_price';
            $goods_list = $goods_model->getGoodsList(array('goods_id' => array('in', $favorites_id)), $field);
            // echo "<pre>";
            // print_R($goods_list);
            Tpl::output('favorites_list',$goods_list);
        }

         //我的足迹
         $goods_list = Model('goods_browse')->getViewedGoodsList($_SESSION['member_id'],20);
         $viewed_goods = array();
         if(is_array($goods_list) && !empty($goods_list)) {
             foreach ($goods_list as $key => $val) {
                 $goods_id = $val['goods_id'];
                 $val['url'] = urlShop('goods', 'index', array('goods_id' => $goods_id));
                 $val['goods_image'] = thumb($val, 98);
                 $viewed_goods[$goods_id] = $val;
             }
         }
         Tpl::output('viewed_goods',$viewed_goods);

        //店铺收藏
        $favorites_list = $favorites_model->getStoreFavoritesList(array('member_id'=>$_SESSION['member_id']), '*', 6);
        if (!empty($favorites_list) && is_array($favorites_list)){
            $favorites_id = array();//收藏的店铺编号
            foreach ($favorites_list as $key=>$fav){
                $favorites_id[] = $fav['fav_id'];
            }
            $store_model = Model('store');
            $store_list = $store_model->getStoreList(array('store_id'=>array('in', $favorites_id)));
            Tpl::output('favorites_store_list',$store_list);
        }

        $goods_count_new = array();
        if (!empty($favorites_id)) {
            foreach ($favorites_id as $v){
                $count = Model('goods')->getGoodsCommonOnlineCount(array('store_id' => $v));
                $goods_count_new[$v] = $count;
            }
        }
        Tpl::output('goods_count',$goods_count_new);
        Tpl::showpage('member_home.goods_info','null_layout');
    }

    public function ajax_load_sns_infoOp() {
        //我的足迹
        $goods_list = Model('goods_browse')->getViewedGoodsList($_SESSION['member_id'],20);
        $viewed_goods = array();
        if(is_array($goods_list) && !empty($goods_list)) {
            foreach ($goods_list as $key => $val) {
                $goods_id = $val['goods_id'];
                $val['url'] = urlShop('goods', 'index', array('goods_id' => $goods_id));
                $val['goods_image'] = thumb($val, 240);
                $viewed_goods[$goods_id] = $val;
            }
        }
        Tpl::output('viewed_goods',$viewed_goods);

        //我的圈子
        $model = Model();
        $circlemember_array = $model->table('circle_member')->where(array('member_id'=>$_SESSION['member_id']))->select();
        if(!empty($circlemember_array)) {
            $circlemember_array = array_under_reset($circlemember_array, 'circle_id');
            $circleid_array = array_keys($circlemember_array);
            $circle_list = $model->table('circle')->where(array('circle_id'=>array('in', $circleid_array)))->limit(6)->select();
            Tpl::output('circle_list', $circle_list);
        }

        //好友动态
        $model_fd = Model('sns_friend');
        $fields = 'member.member_id,member.member_name,member.member_avatar';
        $follow_list = $model_fd->listFriend(array('limit'=>15,'friend_frommid'=>"{$_SESSION['member_id']}"),$fields,'','detail');
        $member_ids = array();$follow_list_new = array();
        if (is_array($follow_list)) {
            foreach ($follow_list as $v) {
                $follow_list_new[$v['member_id']] = $v;
                $member_ids[] = $v['member_id'];
            }
        }
        $tracelog_model = Model('sns_tracelog');
        //条件
        $condition = array();
        $condition['trace_memberid'] = array('in',$member_ids);
        $condition['trace_privacy'] = 0;
        $condition['trace_state'] = 0;
        $tracelist = Model()->table('sns_tracelog')->where($condition)->field('count(*) as ccount,trace_memberid')->group('trace_memberid')->limit(5)->select();
        $tracelist_new = array();$follow_list = array();
        if (!empty($tracelist)){
            foreach ($tracelist as $k=>$v){
                $tracelist_new[$v['trace_memberid']] = $v['ccount'];
                $follow_list[] = $follow_list_new[$v['trace_memberid']];
            }
        }
        Tpl::output('tracelist',$tracelist_new);
        Tpl::output('follow_list',$follow_list);
        Tpl::showpage('member_home.sns_info','null_layout');
    }
}
