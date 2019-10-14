<?php
/**
 * 购买流程
 
 
 
 
 */



defined('interMarket') or exit('Access Invalid!');
class buyControl extends BaseBuyControl {

    public function __construct() {
        parent::__construct();
        Language::read('home_cart_index');
        if (!$_SESSION['member_id']){
            redirect(urlLogin('login', 'index', array('ref_url' => request_uri())));
        }
        //验证该会员是否禁止购买
        if(!$_SESSION['is_buy']){
            showMessage(Language::get('cart_buy_noallow'),'','html','error');
        }
        Tpl::output('hidden_rtoolbar_cart', 1);
    }

    /**
     * 实物商品 购物车、直接购买第一步:选择收获地址和配送方式
     */
    public function buy_step1Op() {

        //虚拟商品购买分流
        $this->_buy_branch($_POST);

        //得到购买数据
        $logic_buy = Logic('buy');
        // echo "<pre>";
        // print_R($this->member_info);
        $result = $logic_buy->buyStep1($_POST['cart_id'], $_POST['ifcart'], $_SESSION['member_id'], $_SESSION['store_id'], $_POST['jjg'],$this->member_info['orderdiscount'],$this->member_info['level'],$_POST['ifchain']);
        if (!$result['state']) {
            showMessage($result['msg'], '', 'html', 'error');
        } else {
            $result = $result['data'];
        }
        // var_dump($_SESSION['store_id']);
        // 加价购
        Tpl::output('jjgValidSkus', $result['jjgValidSkus']);
        Tpl::output('jjgStoreCosts', $result['jjgStoreCosts']);


        // $model_setting = Model('setting');
        // $list_setting = $model_setting->getListSetting();
        // $list_setting['member_discount'] = $list_setting['member_discount']?unserialize($list_setting['member_discount']):array();
//         echo "<pre>";
//         print_R($result);
        // foreach ($list_setting['member_discount'] as $key => $val) {//获取会员折扣
        //     if($val['level'] == $this->member_info['level']){
        //         if(!empty($val['discount'])){
        //             $discount = $val['discount'];
        //             break; 
        //         }
        //     }
        // }
        // if(isset($discount)){
        //     foreach ($result['store_cart_list'] as $key => $val) {
        //         foreach ($val as $k => $v) {
        //             if(($v['groupbuy_info'] == '' && $v['xianshi_info'] == '') && !isset($v['jjgRank'])){
        //                 $result['store_cart_list'][$key][$k]['user_discount']  = $discount;
        //                 $result['store_cart_list'][$key][$k]['user_discountdesc']  = $discount/10;
        //                 $zhe = $v['goods_total']* ($discount/100);
        //                 $result['store_cart_list'][$key][$k]['goods_total_discount']  = round($zhe,2);
        //                 $count_goods_total+=$result['store_cart_list'][$key][$k]['goods_total_discount'];
        //                 $store_id = $v['store_id'];
        //             }else{
        //                 $count_goods_total+=$v['goods_total'];
        //             }
        //         }
        //     }
        // }
        // $result['count_goods_total'][$store_id] = $count_goods_total;//参与会员折扣后的价格

        
        //商品金额计算(分别对每个商品/优惠套装小计、每个店铺小计)
//         echo "<pre>";
//         print_R($result);
        Tpl::output('store_cart_list', $result['store_cart_list']);
        Tpl::output('store_goods_total', $result['store_goods_total']);//原先商品价格
        // Tpl::output('count_goods_total', $result['count_goods_total']);//参与会员折扣后的价格
        foreach ($result['store_cart_list'][1] as $k => $v) {
            $total_num += $v['goods_num'];
        }
        Tpl::output('total_num', $total_num);
        //  echo $total_num ;
        //  
       
        
        // print_R($list_setting['member_discount']);

        //取得店铺优惠 - 满即送(赠品列表，店铺满送规则列表)
        Tpl::output('store_premiums_list', $result['store_premiums_list']);
        Tpl::output('store_mansong_rule_list', $result['store_mansong_rule_list']);

        //返回店铺可用的代金券
        Tpl::output('store_voucher_list', $result['store_voucher_list']);

        //返回平台可用红包
        Tpl::output('rpt_list_json', json_encode($result['rpt_list']));

        //输出符合满X元包邮条件的店铺ID及包邮设置信息
        Tpl::output('cancel_calc_sid_list', $result['cancel_calc_sid_list']);

        //将商品ID、数量、运费模板、运费序列化，加密，输出到模板，选择地区AJAX计算运费时作为参数使用
        Tpl::output('freight_hash', $result['freight_list']);

        //输出用户默认收货地址
        // echo "<pre>";
        // print_R($result);
        
        
        $address_list = $this->load_addrOp('1',0);
//echo '<pre>';
//         print_R($result['address_info']);
        Tpl::output('address_list', $address_list);
        if (!$_POST['ifchain']) {
            Tpl::output('address_info', $result['address_info']);            
        }

        //输出有货到付款时，在线支付和货到付款及每种支付下商品数量和详细列表
        Tpl::output('pay_goods_list', $result['pay_goods_list']);
        Tpl::output('ifshow_offpay', $result['ifshow_offpay']);
        Tpl::output('deny_edit_payment', $result['deny_edit_payment']);

        //输出是否有门店自提支付
        Tpl::output('ifshow_chainpay', $result['ifshow_chainpay']);
        Tpl::output('chain_store_id', $result['chain_store_id']);

        //不提供增值税发票时抛出true(模板使用)
        Tpl::output('vat_deny', $result['vat_deny']);

        //增值税发票哈希值(php验证使用)
        Tpl::output('vat_hash', $result['vat_hash']);

        //输出默认使用的发票信息
        Tpl::output('inv_info', $result['inv_info']);

        //删除购物车无效商品
        $logic_buy->delCart($_POST['ifcart'], $_SESSION['member_id'], $_POST['invalid_cart']);

        //标识购买流程执行步骤
        Tpl::output('buy_step','step2');

        Tpl::output('ifcart', $_POST['ifcart']);

        Tpl::output('ifchain', $_POST['ifchain']);

        //输出会员折扣
        Tpl::output('zk_list',$result['zk_list']);

        //店铺信息
        $store_list = Model('store')->getStoreMemberIDList(array_keys($result['store_cart_list']),'store_id,member_id,store_domain,is_own_shop');
        Tpl::output('store_list',$store_list);

        $current_goods_info = current($result['store_cart_list']);
        Tpl::output('current_goods_info',$current_goods_info[0]);

        Tpl::showpage('buy_step1');
    }

    /**
     * 生成订单
     *
     */
    public function buy_step2Op() {
        $logic_buy = logic('buy');
//         echo "<pre>";
//         print_R($_POST);die;
        $result = $logic_buy->buyStep2($_POST, $_SESSION['member_id'], $_SESSION['member_name'], $_SESSION['member_email'],$this->member_info['orderdiscount'],$this->member_info['level']);
        if(!$result['state']) {
            showMessage($result['msg'], 'index.php?model=cart', 'html', 'error');
        }

        //转向到商城支付页面
        redirect('index.php?model=buy&fun=pay&pay_sn='.$result['data']['pay_sn'].'&payid='.$_POST['payment_codeid']);
    }

    /**
     * 下单时支付页面
     */
    public function payOp() {
        $pay_sn = $_GET['pay_sn'];
        if (!preg_match('/^\d{18}$/',$pay_sn)){
            showMessage(Language::get('cart_order_pay_not_exists'),'index.php?model=member_order','html','error');
        }

        //查询支付单信息
        $model_order= Model('order');
//        $state = $model_order->test();
        // echo "<pre>";
        //print_R($state);
//        $model_area = Model('area');
//         foreach ($state as $val){
//             $data = array();
//             $data['area_name'] = $val['STATE_NAME'];
//             $data['area_parent_id'] = 0;
//             $data['area_sort'] = 0;
//             $data['area_deep'] = 1;
//             $data['area_region'] = $val['STATE_NAME'];
//             $data['area_code'] = $val['STATE_CODE'];
//             $data['lang'] = 2;
//
//             //print_R($data);
//             //
//             //$result = $model_area->addArea($data);
//             //
//             //print_R($result);
//
//         }

        $pay_info = $model_order->getOrderPayInfo(array('pay_sn'=>$pay_sn,'buyer_id'=>$_SESSION['member_id']),true);
        if(empty($pay_info)){
            showMessage(Language::get('cart_order_pay_not_exists'),'index.php?model=member_order','html','error');
        }
        Tpl::output('pay_info',$pay_info);
        Tpl::output('payment_codeid',$_GET['payid']);
        //取子订单列表
        $condition = array();
        $condition['pay_sn'] = $pay_sn;
        $condition['order_state'] = array('in',array(ORDER_STATE_NEW,ORDER_STATE_PAY));
        $order_list = $model_order->getOrderList($condition,'','*','','',array(),true);
        if (empty($order_list)) {
            showMessage('未找到需要支付的订单','index.php?model=member_order','html','error');
        }

        //取特殊类订单信息
        $this->_getOrderExtendList($order_list);
        //处理预订单重复支付问题
        if ($order_list[0]['if_buyer_repay'] && $order_list[0]['pay_sn1'] == '') {
            $pay_sn_new = Logic('buy_1')->makePaySn($_SESSION['member_id']);
            $order_pay = array();
            $order_pay['pay_sn'] = $pay_sn_new;
            $order_pay['buyer_id'] = $_SESSION['member_id'];
            $order_pay_id = $model_order->addOrderPay($order_pay);
            if (!$order_pay_id) {
                showMessage('支付失败','index.php?model=member_order','html','error');
            }
            $update = $model_order->editOrder(array('pay_sn'=>$pay_sn_new,'pay_sn1'=>$pay_sn),array('order_id'=>$order_list[0]['order_id'],'order_type'=>2));
            if (!$update) {
                showMessage('支付失败','index.php?model=member_order','html','error');
            } else {
                redirect('index.php?model=buy&fun=pay&pay_sn='.$pay_sn_new);exit;
            }
        }

        //定义输出数组
        $pay = array();
        //支付提示主信息
        $pay['order_remind'] = '';
        //重新计算支付金额
        $pay['pay_amount_online'] = 0;
        $pay['pay_amount_offline'] = 0;
        //订单总支付金额(不包含货到付款)
        $pay['pay_amount'] = 0;
        //充值卡支付金额(之前支付中止，余额被锁定)
        $pay['payd_rcb_amount'] = 0;
        //预存款支付金额(之前支付中止，余额被锁定)
        $pay['payd_pd_amount'] = 0;
        //还需在线支付金额(之前支付中止，余额被锁定)
        $pay['payd_diff_amount'] = 0;
        //账户可用金额
        $pay['member_pd'] = 0;
        $pay['member_rcb'] = 0;

        $logic_order = Logic('order');

        //计算相关支付金额
        foreach ($order_list as $key => $order_info) {
            if (!in_array($order_info['payment_code'],array('offline','chain'))) {
                if ($order_info['order_state'] == ORDER_STATE_NEW) {
                    $pay['pay_amount_online'] += $order_info['order_amount'];
                    $pay['payd_rcb_amount'] += $order_info['rcb_amount'];
                    $pay['payd_pd_amount'] += $order_info['pd_amount'];
                    $pay['payd_diff_amount'] += $order_info['order_amount'] - $order_info['rcb_amount'] - $order_info['pd_amount'];
                }
                $pay['pay_amount'] += $order_info['order_amount'];
            } else {
                $pay['pay_amount_offline'] += $order_info['order_amount'];
            }
            //显示支付方式
            if ($order_info['payment_code'] == 'offline') {
                $order_list[$key]['payment_type'] = '货到付款';
            } elseif ($order_info['payment_code'] == 'chain') {
                $order_list[$key]['payment_type'] = '门店支付';
            } else {
                $order_list[$key]['payment_type'] = '在线支付';
            }
        }
        if ($order_info['chain_id'] && $order_info['payment_code'] == 'chain') {
            $order_list[0]['order_remind'] = '下单成功，请在'.CHAIN_ORDER_PAYPUT_DAY.'日内前往门店提货，逾期订单将自动取消。';
            $flag_chain = 1;
        }

        Tpl::output('order_list',$order_list);

        //如果线上线下支付金额都为0，转到支付成功页
        if (empty($pay['pay_amount_online']) && empty($pay['pay_amount_offline'])) {
            redirect('index.php?model=buy&fun=pay_ok&pay_sn='.$pay_sn.'&is_chain='.$flag_chain.'&pay_amount='.ncPriceFormat($order_info['order_amount']));
        }

        //是否显示站内余额操作(如果以前没有使用站内余额支付过且非货到付款)
        $pay['if_show_pdrcb_select'] = ($pay['pay_amount_offline'] == 0 && $pay['payd_rcb_amount'] == 0 && $pay['payd_pd_amount'] == 0);

        //输出订单描述
        if (empty($pay['pay_amount_online'])) {
            $pay['order_remind'] = '下单成功，我们会尽快为您发货，请保持电话畅通。';
        } elseif (empty($pay['pay_amount_offline'])) {
            $pay['order_remind'] = '请您在'.(ORDER_AUTO_CANCEL_TIME*60).'分钟内完成支付，逾期订单将自动取消。 ';
        } else {
            $pay['order_remind'] = '部分商品需要在线支付，请您在'.(ORDER_AUTO_CANCEL_TIME*60).'分钟内完成支付，逾期订单将自动取消。';
        }
        if (!empty($order_list[0]['order_remind'])) {
            $pay['order_remind'] = $order_list[0]['order_remind'];
        }

        if ($pay['pay_amount_online'] > 0) {
            //显示支付接口列表
            $model_payment = Model('payment');
            $condition = array();
            $payment_list = $model_payment->getPaymentOpenList($condition);
            if (!empty($payment_list)) {
                unset($payment_list['predeposit']);
                unset($payment_list['offline']);
            }
            if (empty($payment_list)) {
                showMessage('暂未找到合适的支付方式','index.php?model=member_order','html','error');
            }
            // echo "<pre>";
            // print_R($payment_list);
            Tpl::output('payment_list',$payment_list);
        }
        if ($pay['if_show_pdrcb_select']) {
            //显示预存款、支付密码、充值卡
            $available_predeposit = $available_rc_balance = 0;
            $buyer_info = Model('member')->getMemberInfoByID($_SESSION['member_id']);
            if (floatval($buyer_info['available_predeposit']) > 0) {
                $pay['member_pd'] = $buyer_info['available_predeposit'];
            }
            if (floatval($buyer_info['available_rc_balance']) > 0) {
                $pay['member_rcb'] = $buyer_info['available_rc_balance'];
            }
            $pay['member_paypwd'] = $buyer_info['member_paypwd'] ? true : false;
        }

        Tpl::output('pay',$pay);

        //标识 购买流程执行第几步
        Tpl::output('buy_step','step3');
        Tpl::showpage('buy_step2');
    }

    /**
     * 特殊订单支付最后一步界面展示（目前只有预定）
     * @param unknown $order_list
     */
    private function _getOrderExtendList(& $order_list) {
        //预定订单
        if ($order_list[0]['order_type'] == 2) {
            $order_info = $order_list[0];
            $result = Logic('order_book')->getOrderBookInfo($order_info);
            if (!$result['data']['if_buyer_pay']) {
                showMessage('未找到需要支付的订单','index.php?model=member_order','html','error');
            }
            $order_list[0] = $result['data'];
            $order_list[0]['order_amount'] = $order_list[0]['pay_amount'];
            $order_list[0]['order_state'] = ORDER_STATE_NEW;
            if ($order_list[0]['if_buyer_repay']) {
                $order_list[0]['order_remind'] = '请您在 '.date('Y-m-d H:i',$order_list[0]['book_list'][1]['book_end_time']+1).' 之前完成支付，否则订单会被自动取消。';
            }
        }
    }

    /**
     * 预存款充值下单时支付页面
     */
    public function pd_payOp() {
        $pay_sn = $_GET['pay_sn'];
        if (!preg_match('/^\d{18}$/',$pay_sn)){
            showMessage(Language::get('para_error'),urlMember('predeposit'),'html','error');
        }

        //查询支付单信息
        $model_order= Model('predeposit');
        $pd_info = $model_order->getPdRechargeInfo(array('pdr_sn'=>$pay_sn,'pdr_member_id'=>$_SESSION['member_id']));
        if(empty($pd_info)){
            showMessage(Language::get('para_error'),'','html','error');
        }
        if (intval($pd_info['pdr_payment_state'])) {
            showMessage('您的订单已经支付，请勿重复支付',urlMember('predeposit'),'html','error');
        }
        Tpl::output('pdr_info',$pd_info);

        //显示支付接口列表
        $model_payment = Model('payment');
        $condition = array();
        $condition['payment_code'] = array('not in',array('offline','predeposit','wxpay'));
        $condition['payment_state'] = 1;
        $payment_list = $model_payment->getPaymentList($condition);
        if (empty($payment_list)) {
            showMessage('暂未找到合适的支付方式',urlMember('predeposit'),'html','error');
        }
        Tpl::output('payment_list',$payment_list);

        //标识 购买流程执行第几步
        Tpl::output('buy_step','step3');
        Tpl::showpage('predeposit_pay');
    }

    /**
     * 支付成功页面
     */
    public function pay_okOp() {
        $pay_sn = $_GET['pay_sn'];
        if (!preg_match('/^\d{18}$/',$pay_sn)){
            showMessage(Language::get('cart_order_pay_not_exists'),'index.php?model=member_order','html','error');
        }

        //查询支付单信息
        $model_order= Model('order');
        $pay_info = $model_order->getOrderPayInfo(array('pay_sn'=>$pay_sn,'buyer_id'=>$_SESSION['member_id']));
        if(empty($pay_info)){
            showMessage(Language::get('cart_order_pay_not_exists'),'index.php?model=member_order','html','error');
        }
        Tpl::output('pay_info',$pay_info);

        Tpl::output('buy_step','step4');
        Tpl::showpage('buy_step3');
    }

    /**
     * 加载买家收货地址
     *
     */
    public function load_addrOp($status=0,$default=0) {



        $model_addr = Model('address');
         //print_R($status);
        //如果传入ID，先删除再查询
        if (!empty($_GET['id']) && intval($_GET['id']) > 0) {
            $rs = $model_addr->delAddress(array('address_id'=>intval($_GET['id']),'member_id'=>$_SESSION['member_id']));
            if($_GET['status'] ==3 ){
                if ($rs){
                    exit(json_encode(array('state'=>success,'msg'=>'地址Delete the success')));
                }else {
                    exit(json_encode(array('state'=>faild,'msg'=>'地址Delete failed')));
                }
            }
        }
        $condition = array();
        $condition['member_id'] = $_SESSION['member_id'];
        if(!$default || !$_GET['is_default']){
            $condition['is_default'] = 0;
        }
        if (!C('delivery_isuse')) {
            $condition['dlyp_id'] = 0;
            $order = 'dlyp_id asc,address_id desc';
        }
        //print_R($condition);
        $list = $model_addr->getAddressList($condition,$order);
        if($status ==1 ){
            return $list;
        }
        // $menu_list = $this->_getMenuList();
        // Tpl::output('menu_list',$menu_list);
        // echo "<pre>";
        // print_r($list);
        
        Tpl::output('address_list',$list);
        // if (!empty($_GET['id']) && intval($_GET['id']) > 0) {
        //     Tpl::showpage('buy_address.load','null_layout');
        // }
        Tpl::showpage('buy_address.load','null_layout');
    }


    /**
     * 加载买家收货地址
     *
     */
    public function loadone_addrOp() {
        $model_addr = Model('address');
        //如果传入ID，先删除再查询
      
        $condition = array();
        $condition['member_id'] = $_SESSION['member_id'];
        if(!empty($_POST['address_id'])){
            $condition['address_id'] = $_POST['address_id'];
        }
        if(!empty($_POST['order'])){
            $order = $_POST['order'];
        }

        // if (!C('delivery_isuse')) {
        //     $condition['dlyp_id'] = 0;
        //     $order = 'dlyp_id asc,address_id desc';
        // }
        $list = $model_addr->getAddressList($condition,$order);
        // if($status ==1 ){
        //     return $list;
        // }
        // $menu_list = $this->_getMenuList();
        // Tpl::output('menu_list',$menu_list);
         echo "<pre>";
         print_r($list);
        if (!empty($list)){
            exit(json_encode(array('state'=>success,'list'=>$list[0])));
        }else {
            exit(json_encode(array('state'=>faild,'msg'=>'默认地址修改失败')));
        }
        // Tpl::output('address_list',$list);
        // if (!empty($_GET['id']) && intval($_GET['id']) > 0) {
        //     Tpl::showpage('buy_address.load','null_layout');
        // }
        // Tpl::showpage('buy_address.load','null_layout');
    }
    /**
     * 载入门店自提点
     */
    public function load_chainOp() {
        $list = Model('chain')->getChainList(array('area_id'=>intval($_GET['area_id']),'store_id'=>intval($_GET['store_id'])),
                'chain_id,chain_name,area_info,chain_address');
        echo $_GET['callback'].'('.json_encode($list).')';
    }

    /**
     * 选择不同地区时，异步处理并返回每个店铺总运费以及本地区是否能使用货到付款
     * 如果店铺统一设置了满免运费规则，则运费模板无效
     * 如果店铺未设置满免规则，且使用运费模板，按运费模板计算，如果其中有商品使用相同的运费模板，则两种商品数量相加后再应用该运费模板计算（即作为一种商品算运费）
     * 如果未找到运费模板，按免运费处理
     * 如果没有使用运费模板，商品运费按快递价格计算，运费不随购买数量增加
     */
    public function change_addrOp() {
        $logic_buy = Logic('buy');
        if (empty($_POST['city_id'])) {
            $_POST['city_id'] = $_POST['area_id'];
        }

        $data = $logic_buy->changeAddr($_POST['freight_hash'], $_POST['city_id'], $_POST['area_id'], $_SESSION['member_id']);

        if(!empty($data)) {
            exit(json_encode($data));
        } else {
            exit('error');
        }
    }

    //根据门店自提站ID计算商品库存
    public function change_chainOp() {
        $logic_buy = Logic('buy');
        $data = $logic_buy->changeChain($_POST['chain_id'],$_POST['product']);
        if(!empty($data)) {
            exit(json_encode($data));
        } else {
            exit('error');
        }
    }

    /**
      * 默认地址修改
      *
      */
    public function edit_defaultOp(){
        $model_addr = Model('address');
            
        if($_POST['address_id']){
            $data = array();

            $res['is_default'] = 0;
            $condition = array();
            $condition['is_default'] = 1;
            $condition['member_id'] = $_SESSION['member_id'];
            $edit_id = $model_addr->editAddress($res,$condition);


            $data['is_default'] = 1;
            $condition = array();
            $condition['address_id'] = $_POST['address_id'];
            $condition['member_id'] = $_SESSION['member_id'];
            $edit_id2 = $model_addr->editAddress($data,$condition);
            $result = $model_addr->getDefaultAddressInfo(array('member_id' => $_SESSION['member_id']));

            $result['firstName'] = substr($result['true_name'], 0, strpos($result['true_name'], "-"));
            $result['lastName'] = substr($result['true_name'], strripos($result['true_name'], "-") + 1);

            //if ($edit_id2){
            //    exit(json_encode(array('state'=>true,'addr_id'=>$result)));
            //}else {
            //    exit(json_encode(array('state'=>false,'msg'=>'默认地址修改失败')));
            //}
            if ($edit_id2) {
                exit(json_encode(array('state' => true, 'info' => $result)));
            } else {
                exit(json_encode(array('state' => false, 'msg' => '默认地址修改失败')));
            }
        }
            
    }


    /**
     * 添加新的收货地址
     *
     */
    public function add_addrOp()
    {
        $model_addr = Model('address');
        if (chksubmit()) {
            $count = $model_addr->getAddressCount(array('member_id' => $_SESSION['member_id']));
            if ($count >= 20) {
                exit(json_encode(array('state' => false, 'msg' => '最多允许添加20个有效地址')));
            }

            if ($count == 0) {//无地址时添加第一个地址为默认地址
                $_POST['is_default'] = 1;
            }

            $obj_validate = new Validate();
            $obj_validate->validateparam = array(
                array("input"=>$_POST["firstName"],"require"=>"true","message"=>'firstName Can not be empty'),
                array("input"=>$_POST["lastName"],"require"=>"true","message"=>'lastName Can not be empty'),
                array("input"=>$_POST["company"],"require"=>"true","message"=>'Please enter the company name'),
                array("input"=>$_POST["address"],"require"=>"true","message"=>'Please enter street address'),
                array("input"=>$_POST["apartment"],"require"=>"true","message"=>'Please enter the name of the apartment'),
                array("input"=>$_POST["mob_phone"],"require"=>"true","message"=>'Please enter your telephone number'),
                array("input"=>$_POST["area_id"],"require"=>"true","validator"=>"Number","message"=>$lang['member_address_wrong_area']),
                array("input"=>$_POST["city_id"],"require"=>"true","validator"=>"Number","message"=>$lang['member_address_wrong_area']),
                array("input"=>$_POST["region"],"require"=>"true","message"=>$lang['member_address_area_null']),
                //array("input"=>$_POST['tel_phone'].$_POST['mob_phone'],'require'=>'true','message'=>$lang['member_address_phone_and_mobile']),
                array("input"=>$_POST['zipcode'],'require'=>'true','message'=>'Postal code cannot be empty')
            );
            $error = $obj_validate->validate();
            if ($error != '') {
                $error = strtoupper(CHARSET) == 'GBK' ? Language::getUTF8($error) : $error;
                exit(json_encode(array('state' => false, 'msg' => $error)));
            }
            $data = array();


            $data['member_id'] = $_SESSION['member_id'];
            $data['true_name']    = htmlspecialchars(strip_tags($_POST['firstName'])) .'---'. htmlspecialchars(strip_tags($_POST['lastName']));
            $data['company'] = $_POST['company'];
            $data['apartment'] = $_POST['apartment'];
            $data['area_id'] = intval($_POST['area_id']);
            $data['city_id'] = intval($_POST['city_id']);
            $data['area_info'] = $_POST['region'];
            $data['address'] = $_POST['address'];
            $data['tel_phone'] = $_POST['tel_phone'];
            $data['mob_phone'] = $_POST['mob_phone'];
            $data['zipcode'] = $_POST['zipcode'];
            $data['is_default'] = $_POST['is_default'] ? 1 : 0;

//             print_R($_POST);die;
            if ($_POST['is_default']) {
                $res['is_default'] = 0;
                $rls = $model_addr->editAddress($res, array('member_id'=>$_SESSION['member_id'],'is_default'=>'1'));
            }

            $insert_id = $model_addr->addAddress($data);
            if ($insert_id) {
                $news = $model_addr->getAddressInfo(array('member_id'=>$_SESSION['member_id'],'is_default' => 1));
                $data['address_id'] = $news['address_id'];
                $data['firstName'] = htmlspecialchars(strip_tags($_POST['firstName']));
                $data['lastName'] = htmlspecialchars(strip_tags($_POST['lastName']));
                exit(json_encode(array('state'=>true,'addr_id'=>$_POST['address_id'],'data'=>$data)));
            } else {
                exit(json_encode(array('state' => false, 'msg' => 'Add failed')));
            }
        } else {
            Tpl::showpage('buy_address.add', 'null_layout');
        }
    }


    /**
      * 修改收货地址
      *
      */
     public function edit_addrOp(){
        Language::read('member_address');
        $lang   = Language::getLangContent();
        $model_addr = Model('address');
        $address_class = Model('address');
        if (chksubmit()){
            $count = $model_addr->getAddressCount(array('member_id'=>$_SESSION['member_id']));
           
             /**
             * 验证表单信息
             */
//             echo "<pre>";
//             print_R($count);
//             die;
            if($count == 1){//地址只有一个时，设置默认地址
                $_POST['is_default'] = 1;
            }
            if($_POST['region'] == ''){
                $ststus = 'false';
            }else{
                $ststus = 'true';
            }
            $obj_validate = new Validate();
            $obj_validate->validateparam = array(
                array("input"=>$_POST["firstName"],"require"=>"true","message"=>'firstName Can not be empty'),
                array("input"=>$_POST["lastName"],"require"=>"true","message"=>'lastName Can not be empty'),
                array("input"=>$_POST["company"],"require"=>"true","message"=>'Please enter the company name'),
                array("input"=>$_POST["address"],"require"=>"true","message"=>'Please enter street address'),
                array("input"=>$_POST["apartment"],"require"=>"true","message"=>'Please enter the name of the apartment'),
                array("input"=>$_POST["mob_phone"],"require"=>"true","message"=>'Please enter your telephone number'),
                array("input"=>$_POST["area_id"],"require"=>"true","validator"=>"Number","message"=>$lang['member_address_wrong_area']),
                array("input"=>$_POST["city_id"],"require"=>"true","validator"=>"Number","message"=>$lang['member_address_wrong_area']),
                array("input"=>$_POST["region"],"require"=>"true","message"=>$lang['member_address_area_null']),
                //array("input"=>$_POST['tel_phone'].$_POST['mob_phone'],'require'=>'true','message'=>$lang['member_address_phone_and_mobile']),
                array("input"=>$_POST['zipcode'],'require'=>'true','message'=>'Postal code cannot be empty')
            );
            $error = $obj_validate->validate();
            // print_R($error);
            if ($error != ''){
                $error = strtoupper(CHARSET) == 'GBK' ? Language::getUTF8($error) : $error;
                exit(json_encode(array('state'=>false,'msg'=>$error)));
            }
            // echo "<pre>";
            // print_R($_POST);
            $data = array();
            if(isset($_POST['region'])){
                $data['area_info'] = $_POST['region'];
            }else{
                $info = $address_class->getAddressInfo(array('address_id' => intval($_POST['address_id']),'member_id'=>$_SESSION['member_id']));
            }
            $data['member_id'] = $_SESSION['member_id'];
            $data['true_name']    = htmlspecialchars(strip_tags($_POST['firstName'])) .'---'. htmlspecialchars(strip_tags($_POST['lastName']));

            $data['company'] = $_POST['company'];
            $data['apartment'] = $_POST['apartment'];

            $data['area_id'] = intval($_POST['area_id']);
            $data['city_id'] = intval($_POST['city_id']);
            $data['area_info'] = $_POST['region'];
            $data['address'] = $_POST['address'];
            $data['tel_phone'] = $_POST['tel_phone'];
            $data['mob_phone'] = $_POST['mob_phone'];
            $data['is_default'] = $_POST['is_default'] ? 1 : 0;
            $data['zipcode'] = $_POST['zipcode'];


             //print_R($data);die;
            if ($data['is_default']) {
                $res['is_default'] = 0;
                $rls = $address_class->editAddress($res, array('member_id'=>$_SESSION['member_id'],'is_default'=>'1'));
            }

            $rs = $address_class->editAddress($data, array('address_id' => intval($_POST['address_id']),'member_id'=>$_SESSION['member_id']));
            // print_R($_POST);
            // print_R($data);
            if(!isset($_POST['region'])){
                $data['area_info'] = $info['area_info'];
            }
//            echo "<pre>";
//                print_R($data);die;
            if ($rs){
                $news = $address_class->getAddressInfo(array('member_id'=>$_SESSION['member_id'],'is_default' => 1));

                $data['address_id'] = $news['address_id'];
                $data['firstName'] = substr($data['true_name'], 0, strpos($data['true_name'], "-"));
                $data['lastName'] = substr($data['true_name'], strripos($data['true_name'], "-") + 1);
//                print_R($data);die;
                exit(json_encode(array('state'=>true,'addr_id'=>$_POST['address_id'],'data'=>$data)));
                // showDialog('新密码已经发送至您的邮箱，请尽快登录并更改密码！','','succ','',2);
            }else{
                exit(json_encode(array('state'=>false,'msg'=>'地址修改失败')));
            }
            
        } else {
            if($_GET['type'] == 'save'){
                $condition = array();
                $condition['member_id'] = $_SESSION['member_id'];
                $condition['address_id'] = $_GET['address_id'];
                // if (!C('delivery_isuse')) {
                //     $condition['dlyp_id'] = 0;
                //     $order = 'dlyp_id asc,address_id desc';
                // }
                $list = $model_addr->getAddressList($condition);
//                echo "<pre>";
//                print_R($list);
                Tpl::output('address_type','save');
                Tpl::output('address_info',$list[0]);

            }else if($_GET['type'] == 'add'){

            }
            //Tpl::showpage('buy_address.add','null_layout');
            Tpl::showpage('buy_address.edit','null_layout');
        }
     }
     /**
      * 添加新的门店自提点
      *
      */
     public function add_chainOp(){
         Tpl::showpage('buy_address.add_chain','null_layout');
     }

    /**
     * 加载买家发票列表，最多显示10条
     *
     */
    public function load_invOp() {
        $logic_buy = Logic('buy');

        $condition = array();
        if ($logic_buy->buyDecrypt($_GET['vat_hash'], $_SESSION['member_id']) == 'allow_vat') {
        } else {
            Tpl::output('vat_deny',true);
            $condition['inv_state'] = 1;
        }
        $condition['member_id'] = $_SESSION['member_id'];

        $model_inv = Model('invoice');
        //如果传入ID，先删除再查询
        if (intval($_GET['del_id']) > 0) {
            $rs =$model_inv->delInv(array('inv_id'=>intval($_GET['del_id']),'member_id'=>$_SESSION['member_id']));
            if($_GET['status'] == 1){
                if ($rs) {
                    exit(json_encode(array('state'=>'success','id'=>$_GET['del_id'])));
                } else {
                    exit(json_encode(array('state'=>'fail','msg'=>Language::get('nc_common_save_fail','UTF-8'))));
                }
            }
        }
        $list = $model_inv->getInvList($condition,10);
        if (!empty($list)) {
            foreach ($list as $key => $value) {
               if ($value['inv_state'] == 1) {
                   $list[$key]['content'] = '普通发票'.' '.$value['inv_title'].' '.$value['inv_content'];
               } else {
                   $list[$key]['content'] = '增值税发票'.' '.$value['inv_company'].' '.$value['inv_code'].' '.$value['inv_reg_addr'];
               }
            }
        }
        Tpl::output('inv_list',$list);
        Tpl::showpage('buy_invoice.load','null_layout');
    }

     /**
      * 新增发票信息
      *
      */
     public function add_invOp(){
        $model_inv = Model('invoice');
        if (chksubmit()){
            //如果是增值税发票验证表单信息
            if ($_POST['invoice_type'] == 2) {
                if (empty($_POST['inv_company']) || empty($_POST['inv_code']) || empty($_POST['inv_reg_addr'])) {
                    exit(json_encode(array('state'=>false,'msg'=>Language::get('nc_common_save_fail','UTF-8'))));
                }
            }
            $data = array();
            if ($_POST['invoice_type'] == 1) {
                $data['inv_state'] = 1;
                $data['inv_title'] = $_POST['inv_title_select'] == 'person' ? '个人' : $_POST['inv_title'];
                $data['inv_content'] = $_POST['inv_content'];
            } else {
                $data['inv_state'] = 2;
                $data['inv_company'] = $_POST['inv_company'];
                $data['inv_code'] = $_POST['inv_code'];
                $data['inv_reg_addr'] = $_POST['inv_reg_addr'];
                $data['inv_reg_phone'] = $_POST['inv_reg_phone'];
                $data['inv_reg_bname'] = $_POST['inv_reg_bname'];
                $data['inv_reg_baccount'] = $_POST['inv_reg_baccount'];
                $data['inv_rec_name'] = $_POST['inv_rec_name'];
                $data['inv_rec_mobphone'] = $_POST['inv_rec_mobphone'];
                $data['inv_rec_province'] = $_POST['vregion'];
                $data['inv_goto_addr'] = $_POST['inv_goto_addr'];
            }
            $data['member_id'] = $_SESSION['member_id'];
            //转码
            $data = strtoupper(CHARSET) == 'GBK' ? Language::getGBK($data) : $data;
            $insert_id = $model_inv->addInv($data);
            if ($insert_id) {
                exit(json_encode(array('state'=>'success','id'=>$insert_id,'data'=>$data)));
            } else {
                exit(json_encode(array('state'=>'fail','msg'=>Language::get('nc_common_save_fail','UTF-8'))));
            }
        } else {
            Tpl::showpage('buy_address.add','null_layout');
        }
     }

    /**
     * AJAX验证支付密码
     */
    public function check_pd_pwdOp(){
        if (empty($_GET['password'])) exit('0');
        $buyer_info = Model('member')->getMemberInfoByID($_SESSION['member_id'],'member_paypwd');
        echo ($buyer_info['member_paypwd'] != '' && $buyer_info['member_paypwd'] === md5($_GET['password'])) ? '1' : '0';
    }

    /**
     * F码验证
     */
    public function check_fcodeOp() {
        $result = logic('buy')->checkFcode($_GET['goods_id'], $_GET['fcode']);
        echo $result['state'] ? '1' : '0';
        exit;
    }

    /**
     * 得到所购买的id和数量
     *
     */
    private function _parseItems($cart_id) {
        //存放所购商品ID和数量组成的键值对
        $buy_items = array();
        if (is_array($cart_id)) {
            foreach ($cart_id as $value) {
                if (preg_match_all('/^(\d{1,10})\|(\d{1,6})$/', $value, $match)) {
                    $buy_items[$match[1][0]] = $match[2][0];
                }
            }
        }
        return $buy_items;
    }

    /**
     * 购买分流
     */
    private function _buy_branch($post) {
        if (!$post['ifcart']) {
            //取得购买商品信息
            $buy_items = $this->_parseItems($post['cart_id']);
            $goods_id = key($buy_items);
            $quantity = current($buy_items);

            $goods_info = Model('goods')->getGoodsOnlineInfoAndPromotionById($goods_id);
            if ($goods_info['is_virtual']) {
                redirect('index.php?model=buy_virtual&fun=buy_step1&goods_id='.$goods_id.'&quantity='.$quantity);
            }
        }
    }
    /**
     * 左侧导航
     * 菜单数组中child的下标要和其链接的act对应。否则面包屑不能正常显示
     * @return array
     */
    private function _getMenuList() {
        import('libraries.menuHelper');
        return getMemmberMenus();
        $menu_list = array(
            'trade' => array('name' => '交易中心', 'child' => array(
                'member_order'      => array('name' => '所有订单', 'url' => urlShop('member_order', 'index')),
                #'member_vr_order'   => array('name' => '虚拟兑码订单', 'url' => urlShop('member_vr_order', 'index')),
                'member_evaluate'   => array('name' => '交易评价/晒单', 'url' => urlShop('member_evaluate', 'list')),
                #'member_appoint'    => array('name' => '预约/到货通知', 'url' => urlShop('member_appoint', 'list'))
            )),
            'follow' => array('name' => '关注中心', 'child' => array(
                'member_favorite_goods' => array('name' => '商品收藏', 'url' => urlShop('member_favorite_goods', 'index')),
                #'member_favorite_store' => array('name' => '店铺收藏', 'url' => urlShop('member_favorite_store', 'index')),
                'member_goodsbrowse'   => array('name' => '我的足迹', 'url' => urlShop('member_goodsbrowse', 'list'))
            )),
            'client' => array('name' => '客户服务', 'child' => array(
                'member_refund'     => array('name' => '退款及退货', 'url' => urlShop('member_refund', 'index')),
                'member_complain'   => array('name' => '交易投诉', 'url' => urlShop('member_complain', 'index')),
                'member_consult'    => array('name' => '商品咨询', 'url' => urlShop('member_consult', 'my_consult')),
                'member_inform'     => array('name' => '违规举报', 'url' => urlShop('member_inform', 'index')),
                #'member_mallconsult'=> array('name' => '平台客服', 'url' => urlShop('member_mallconsult', 'index'))
            )),
            'info' => array('name' => '会员资料', 'child' => array(
                'member_information'=> array('name' => '账户信息', 'url'=>urlMember('member_information', 'member')),
                'member_address'    => array('name' => '收货地址', 'url'=>urlMember('member_address', 'address'))
            )),
            'property' => array('name' => '财产中心', 'child' => array(
                'predeposit'        => array('name' => '账户余额', 'url'=>urlMember('predeposit', 'pd_log_list')),
                'member_voucher'    => array('name' => '我的代金券', 'url'=>urlMember('member_voucher', 'index')),
                #'member_redpacket'  => array('name' => '我的红包', 'url'=>urlMember('member_redpacket', 'index'))
            )),
        );
        return $menu_list;
    }
}
