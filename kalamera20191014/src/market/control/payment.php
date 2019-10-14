<?php
/**
 * 支付入口
 *
 *
 
 
 
 
 */



defined('interMarket') or exit('Access Invalid!');

class paymentControl extends BaseHomeControl{

    public function __construct() {
        Language::read('common,home_layout');
    }

    /**
     * 实物商品订单
     */
    public function real_orderOp(){
        $pay_sn = $_REQUEST['pay_sn'];
        $payment_code = $_REQUEST['payment_code'];
        $url = 'index.php?model=member_order';

        if(!preg_match('/^\d{18}$/',$pay_sn)){
            showMessage('Parameter error','','html','error');
        }

        //取订单列表
        $logic_payment = Logic('payment');
        $order_pay_info = $logic_payment->getRealOrderInfo($pay_sn, $_SESSION['member_id']);
        //echo '<pre>';
        //print_R($order_pay_info);die;
        if(!$order_pay_info['state']) {
            showMessage($order_pay_info['msg'], $url, 'html', 'error');
        }

        //站内余额支付
        $order_list = $this->_pd_pay($order_pay_info['data']['order_list'],$_POST);

        //计算本次需要在线支付（分别是含站内支付、纯第三方支付接口支付）的订单总金额
        $pay_amount = 0;
        $api_pay_amount = 0;
        $pay_order_id_list = array();
        if (!empty($order_list)) {
            foreach ($order_list as $order_info) {
                if ($order_info['order_state'] == ORDER_STATE_NEW) {
                    $api_pay_amount += $order_info['order_amount'] - $order_info['pd_amount'] - $order_info['rcb_amount'];
                    $pay_order_id_list[] = $order_info['order_id'];
                }
                $pay_amount += $order_info['order_amount'];
            }
        }
        if (empty($api_pay_amount)) {
            redirect(SHOP_SITE_URL.'/index.php?model=buy&fun=pay_ok&pay_sn='.$order_pay_info['data']['pay_sn'].'&pay_amount='.ncPriceFormat($pay_amount));
        }

        /* 
         * update: 新增更新字段payment_code -- by siuloong 20190426 
         * 
         */
        $result = Model('order')->editOrder(array('api_pay_time'=>TIMESTAMP, 'payment_code' => $payment_code),array('order_id'=>array('in',$pay_order_id_list)));
        if(!$result) {
            showMessage('更新订单信息发生错误，请重新支付', $url, 'html', 'error');
        }

        $result = $logic_payment->getPaymentInfo($payment_code);
        
        if(!$result['state']) {
            showMessage($result['msg'], $url, 'html', 'error');
        }
        $payment_info = $result['data'];

        $order_pay_info['data']['api_pay_amount'] = ncPriceFormat($api_pay_amount);

        //如果是开始支付尾款，则把支付单表重置了未支付状态，因为支付接口通知时需要判断这个状态
        if ($order_pay_info['data']['if_buyer_repay']) {
            $update = Model('order')->editOrderPay(array('api_pay_state'=>0),array('pay_id'=>$order_pay_info['data']['pay_id']));
            if (!$update) {
                showMessage('订单支付失败', $url, 'html', 'error');
            }
            $order_pay_info['data']['api_pay_state'] = 0;
        }

        //转到第三方API支付
        $this->_api_pay($order_pay_info['data'], $payment_info);            
    }

    /**
     * 虚拟商品购买
     */
    public function vr_orderOp(){
        $order_sn = $_POST['order_sn'];
        $payment_code = $_POST['payment_code'];
        $url = 'index.php?model=member_vr_order';
    
        if(!preg_match('/^\d{18}$/',$order_sn)){
            showMessage('Parameter error','','html','error');
        }

        //计算所需支付金额等支付单信息
        $result = Logic('payment')->getVrOrderInfo($order_sn, $_SESSION['member_id']);
        if(!$result['state']) {
            showMessage($result['msg'], $url, 'html', 'error');
        }

        //站内余额支付
        $order_info = $this->_pd_vr_pay($result['data'],$_POST);
        if ($order_info['order_state'] == ORDER_STATE_PAY) {
            //发送兑换码到手机
            $param = array('order_id'=>$order_info['order_id'],'buyer_id'=>$order_info['buyer_id'],'buyer_phone'=>$order_info['buyer_phone'],'goods_name'=>$order_info['goods_name']);
            QueueClient::push('sendVrCode', $param);
        }
        
        //计算本次需要在线支付金额
        $api_pay_amount = 0;
        if ($order_info['order_state'] == ORDER_STATE_NEW) {
            $api_pay_amount = floatval(ncPriceFormat($order_info['order_amount'] - $order_info['pd_amount'] - $order_info['rcb_amount']));
        }

        //如果所需支付金额为0，转到支付成功页
        if (empty($api_pay_amount)) {
            redirect('index.php?model=buy_virtual&fun=pay_ok&order_sn='.$order_info['order_sn'].'&order_id='.$order_info['order_id'].'&order_amount='.ncPriceFormat($order_info['order_amount']));
        }

        $result = Model('vr_order')->editOrder(array('api_pay_time'=>TIMESTAMP),array('order_id'=>$order_info['order_id']));
        if(!$result) {
            showMessage('更新订单信息发生错误，请重新支付', $url, 'html', 'error');
        }

        $result = Logic('payment')->getPaymentInfo($payment_code);
        if(!$result['state']) {
            showMessage($result['msg'], $url, 'html', 'error');
        }
        $payment_info = $result['data'];

        $order_info['api_pay_amount'] = ncPriceFormat($api_pay_amount);

        //转到第三方API支付
        $this->_api_pay($order_info, $payment_info);
    }

    /**
     * 预存款充值
     */
    public function pd_orderOp(){
        $pdr_sn = $_POST['pdr_sn'];
        $payment_code = $_POST['payment_code'];
        $url = urlMember('predeposit');
    
        if(!preg_match('/^\d{18}$/',$pdr_sn)){
            showMessage('Parameter error',$url,'html','error');
        }
    
        $logic_payment = Logic('payment');
        $result = $logic_payment->getPaymentInfo($payment_code);
        if(!$result['state']) {
            showMessage($result['msg'], $url, 'html', 'error');
        }
        $payment_info = $result['data'];
    
        $result = $logic_payment->getPdOrderInfo($pdr_sn,$_SESSION['member_id']);
        if(!$result['state']) {
            showMessage($result['msg'], $url, 'html', 'error');
        }
        if ($result['data']['pdr_payment_state'] || empty($result['data']['api_pay_amount'])) {
            showMessage('该充值单不需要支付', $url, 'html', 'error');
        }
    
        //转到第三方API支付
        $this->_api_pay($result['data'], $payment_info);
    }

    /**
     * 站内余额支付(充值卡、预存款支付) 实物订单
     *
     */
    private function _pd_pay($order_list, $post) {
        if (empty($post['password'])) {
            return $order_list;
        }
        $model_member = Model('member');
        $buyer_info = $model_member->getMemberInfoByID($_SESSION['member_id']);
        if ($buyer_info['member_paypwd'] == '' || $buyer_info['member_paypwd'] != md5($post['password'])) {
            return $order_list;
        }

        if ($buyer_info['available_rc_balance'] == 0) {
            $post['rcb_pay'] = null;
        }
        if ($buyer_info['available_predeposit'] == 0) {
            $post['pd_pay'] = null;
        }
        if (floatval($order_list[0]['rcb_amount']) > 0 || floatval($order_list[0]['pd_amount']) > 0) {
            return $order_list;
        }

        try {
            $model_member->beginTransaction();
            $logic_buy_1 = Logic('buy_1');
            //使用充值卡支付
            if (!empty($post['rcb_pay'])) {
                $order_list = $logic_buy_1->rcbPay($order_list, $post, $buyer_info);
            }

            //使用预存款支付
            if (!empty($post['pd_pay'])) {
                $order_list = $logic_buy_1->pdPay($order_list, $post, $buyer_info);
            }

            //特殊订单站内支付处理
            $logic_buy_1->extendInPay($order_list);

            $model_member->commit();
        } catch (Exception $e) {
            $model_member->rollback();
            showMessage($e->getMessage(), '', 'html', 'error');
        }

        return $order_list;
    }

    /**
     * 站内余额支付(充值卡、预存款支付) 虚拟订单
     *
     */
    private function _pd_vr_pay($order_info, $post) {
        if (empty($post['password'])) {
            return $order_info;
        }
        $model_member = Model('member');
        $buyer_info = $model_member->getMemberInfoByID($_SESSION['member_id']);
        if ($buyer_info['member_paypwd'] == '' || $buyer_info['member_paypwd'] != md5($post['password'])) {
            return $order_info;
        }

        if ($buyer_info['available_rc_balance'] == 0) {
            $post['rcb_pay'] = null;
        }
        if ($buyer_info['available_predeposit'] == 0) {
            $post['pd_pay'] = null;
        }
        if (floatval($order_info['rcb_amount']) > 0 || floatval($order_info['pd_amount']) > 0) {
            return $order_info;
        }

        try {
            $model_member->beginTransaction();
            $logic_buy = Logic('buy_virtual');
            //使用充值卡支付
            if (!empty($post['rcb_pay'])) {
                $order_info = $logic_buy->rcbPay($order_info, $post, $buyer_info);
            }

            //使用预存款支付
            if (!empty($post['pd_pay'])) {
                $order_info = $logic_buy->pdPay($order_info, $post, $buyer_info);
            }

            $model_member->commit();
        } catch (Exception $e) {
            $model_member->rollback();
            showMessage($e->getMessage(), '', 'html', 'error');
        }

        return $order_info;
    }

    /**
     * 第三方在线支付接口
     *
     */
    private function _api_pay($order_info, $payment_info) {
        Log::record('支付信息'.json_encode($payment_info),Log::ERR);
        if(in_array($payment_info['payment_code'], array('paypal','credit_card'))){
            $payment_api = new paypal($payment_info,$order_info);
        }
        if($payment_info['payment_code'] == 'chinabank') {
            $payment_api->submit();exit(0);
        } elseif ($payment_info['payment_code'] == 'wxpay') {
            if (!extension_loaded('curl')) {
                showMessage('系统curl扩展未加载，请检查系统配置', '', 'html', 'error');
            }
            Tpl::setDir('buy');
            Tpl::setLayout('buy_layout');
            if (array_key_exists('order_list', $order_info)) {
                Tpl::output('order_list',$order_info['order_list']);
                Tpl::output('args','buyer_id='.$_SESSION['member_id'].'&pay_id='.$order_info['pay_id']);
            } else {
                Tpl::output('order_list',array($order_info));
                Tpl::output('args','buyer_id='.$_SESSION['member_id'].'&pay_id='.$order_info['order_id']);
            }
            Tpl::output('api_pay_amount',$order_info['api_pay_amount']);


            $qrcode_url = $payment_api->get_payurl();
            Log::record("code_url__".json_encode($qrcode_url));
            Tpl::output('pay_url',$qrcode_url);
            //Tpl::output('pay_url',base64_encode(encrypt($payment_api->get_payurl(),MD5_KEY)));
            Tpl::output('nav_list', rkcache('nav',true));

            Tpl::output('html_title', '微信扫码支付');
            Tpl::output('body_title', '微信扫码支付');
            Tpl::setLayout('member_layout');
            Tpl::showpage('payment.wxpay');exit(0);
        }elseif(in_array($payment_info['payment_code'], array('paypal','credit_card'))) {
            $paypal_info = $payment_api->get_payurl($payment_info);
            if($paypal_info['paypal_sn']){
                //update: 数据库无 paypal_sn 字段，将paypal_sn修改为trade_no字段 -- by siuloong 20190426
                Model('order')->editOrder(array('trade_no'=>$paypal_info['paypal_sn']),array('pay_sn'=>$order_info['pay_sn']));
                if($paypal_info['pay_url']){
                    @header("Location: ".$paypal_info['pay_url']);
                }else{
                    redirect(SHOP_SITE_URL.'/index.php?model=payment&fun=paypal_return&success=true&paymentId='.$paypal_info['paypal_sn']);
                }
            }else{
                showMessage('Error of payment information','','html','error');
            }
        } elseif ($payment_info['payment_code'] == 'amazonpay') {
            // AmazonPay  by siuloong
            include_once BASE_PATH . '/api/payment/amazonpay/amazonpay.php';
            $amazonPay = new Amazonpay($payment_info['payment_config']);
            $params = $amazonPay->getHostedParameters($order_info);
            echo $params;
        }else{
            @header("Location: ".$payment_api->get_payurl());
        }
        exit();
        //showMessage('Error of payment method','','html','error');
    }


    /**
     * 通知处理(支付宝异步通知和网银在线自动对账)
     *
     */
    public function notifyOp(){
        switch ($_GET['payment_code']) {
            case 'alipay':
                $success = 'success'; $fail = 'fail'; break;
            case 'chinabank':
                $success = 'ok'; $fail = 'error'; break;
            default:
                exit();
        }

        $order_type = $_POST['extra_common_param'];
        $out_trade_no = $_POST['out_trade_no'];
        $trade_no = $_POST['trade_no'];

        //参数判断
        if(!preg_match('/^\d{18}$/',$out_trade_no)) exit($fail);

        $model_pd = Model('predeposit');
        $logic_payment = Logic('payment');

        if ($order_type == 'real_order') {

            $result = $logic_payment->getRealOrderInfo($out_trade_no);
            if (intval($result['data']['api_pay_state'])) {
                exit($success);
            }
            $order_list = $result['data']['order_list'];
            $api_pay_amount = 0;
            if (!empty($order_list)) {
                foreach ($order_list as $order_info) {
                    $api_pay_amount += $order_info['order_amount'] - $order_info['pd_amount'] - $order_info['rcb_amount'];
                }
            }
        } elseif ($order_type == 'vr_order'){

            $result = $logic_payment->getVrOrderInfo($out_trade_no);

            //订单存在被系统自动取消的可能性
            if (!in_array($result['data']['order_state'],array(ORDER_STATE_NEW,ORDER_STATE_CANCEL))) {
                exit($success);
            }
            $api_pay_amount = $result['data']['order_amount'] - $result['data']['pd_amount'] - $result['data']['rcb_amount'];

        } elseif ($order_type == 'pd_order') {
    
            $result = $logic_payment->getPdOrderInfo($out_trade_no);
            if ($result['data']['pdr_payment_state'] == 1) {
                exit($success);
            }
            $api_pay_amount = $result['data']['pdr_amount'];

        } else {
            exit();
        }
        $order_pay_info = $result['data'];

        //取得支付方式
        $result = $logic_payment->getPaymentInfo($_GET['payment_code']);
        if (!$result['state']) {
            exit($fail);
        }
        $payment_info = $result['data'];

        //创建支付接口对象
        $payment_api    = new $payment_info['payment_code']($payment_info,$order_pay_info);

        //对进入的参数进行远程数据判断
        $verify = $payment_api->notify_verify();
        if (!$verify) {
            exit($fail);
        }

        //购买商品
        if ($order_type == 'real_order') {
            $result = $logic_payment->updateRealOrder($out_trade_no, $payment_info['payment_code'], $order_list, $trade_no);
        } elseif($order_type == 'vr_order'){
            $result = $logic_payment->updateVrOrder($out_trade_no, $payment_info['payment_code'], $order_pay_info, $trade_no);
        } elseif ($order_type == 'pd_order') {
            $result = $logic_payment->updatePdOrder($out_trade_no,$trade_no,$payment_info,$order_pay_info);
        }
        if ($result['state']) {
            //记录消费日志
            if ($order_type == 'real_order') {
                $log_buyer_id = $order_list[0]['buyer_id'];
                $log_buyer_name = $order_list[0]['buyer_name'];
                $log_desc = '实物订单使用'.orderPaymentName($payment_info['payment_code']).'成功支付，支付单号：'.$out_trade_no;
            } else if ($order_type == 'vr_order') {
                $log_buyer_id = $order_pay_info['buyer_id'];
                $log_buyer_name = $order_pay_info['buyer_name'];
                $log_desc = '虚拟订单使用'.orderPaymentName($payment_info['payment_code']).'成功支付，支付单号：'.$out_trade_no;
            } else if ($order_type == 'pd_order') {
                $log_buyer_id = $order_pay_info['buyer_id'];
                $log_buyer_name = $order_pay_info['buyer_name'];
                $log_desc = '预存款充值成功，使用'.orderPaymentName($payment_info['payment_code']).'成功支付，充值单号：'.$out_trade_no;
            }
            QueueClient::push('addConsume', array('member_id'=>$log_buyer_id,'member_name'=>$log_buyer_name,
            'consume_amount'=>ncPriceFormat($api_pay_amount),'consume_time'=>TIMESTAMP,'consume_remark'=>$log_desc));
        }

        exit($result['state'] ? $success : $fail);
    }

    /**
     * 支付接口返回
     *
     */
    public function returnOp(){
        $order_type = $_GET['extra_common_param'];
        if ($order_type == 'real_order') {
            $act = 'member_order';
        } elseif($order_type == 'vr_order') {
            $act = 'member_vr_order';
        } elseif($order_type == 'pd_order') {
            $act = 'predeposit';
        } else {
            exit();
        }

        $out_trade_no = $_GET['out_trade_no'];
        $trade_no = $_GET['trade_no'];
        $url = SHOP_SITE_URL.'/index.php?model='.$act;

        //对外部交易编号进行非空判断
        if(!preg_match('/^\d{18}$/',$out_trade_no)) {
            showMessage('Parameter error',$url,'','html','error');
        }

        $logic_payment = Logic('payment');

        if ($order_type == 'real_order') {

            $result = $logic_payment->getRealOrderInfo($out_trade_no);
            if(!$result['state']) {
                showMessage($result['msg'], $url, 'html', 'error');
            }
            if ($result['data']['api_pay_state']) {
                $payment_state = 'success';
            }
            $order_list = $result['data']['order_list'];

            //支付成功页面展示在线支付了多少金额
            $result['data']['api_pay_amount'] = 0;
            if (!empty($order_list)) {
                foreach ($order_list as $order_info) {
                    $result['data']['api_pay_amount'] += $order_info['order_amount'] - $order_info['pd_amount'] - $order_info['rcb_amount'];
                }
            }

        }elseif ($order_type == 'vr_order') {

            $result = $logic_payment->getVrOrderInfo($out_trade_no);
            if(!$result['state']) {
                showMessage($result['msg'], $url, 'html', 'error');
            }

            if (!in_array($result['data']['order_state'],array(ORDER_STATE_NEW))) {
                $payment_state = 'success';
            }

            //支付成功页面展示在线支付了多少金额
            $result['data']['api_pay_amount'] = $result['data']['order_amount'] - $result['data']['pd_amount'] - $result['data']['rcb_amount'];

        } elseif ($order_type == 'pd_order') {

            $result = $logic_payment->getPdOrderInfo($out_trade_no);
            if(!$result['state']) {
                showMessage($result['msg'], $url, 'html', 'error');
            }
            if ($result['data']['pdr_payment_state'] == 1) {
                $payment_state = 'success';
            }
            $result['data']['api_pay_amount'] = $result['data']['pdr_amount'];
        }
        $order_pay_info = $result['data'];
        $api_pay_amount = $result['data']['api_pay_amount'];

        if ($payment_state != 'success') {
            //取得支付方式
            $result = $logic_payment->getPaymentInfo($_GET['payment_code']);
            if (!$result['state']) {
                showMessage($result['msg'],$url,'html','error');
            }
            $payment_info = $result['data'];

            //创建支付接口对象
            $payment_api    = new $payment_info['payment_code']($payment_info,$order_pay_info);

            //返回参数判断
            $verify = $payment_api->return_verify();
            if(!$verify) {
                showMessage('支付数据验证失败',$url,'html','error');
            }

            //取得支付结果
            $pay_result = $payment_api->getPayResult($_GET);
            if (!$pay_result) {
                showMessage('非常抱歉，您的订单支付没有成功，请您后尝试',$url,'html','error');
            }

            //更改订单支付状态
            if ($order_type == 'real_order') {
                $result = $logic_payment->updateRealOrder($out_trade_no, $payment_info['payment_code'], $order_list, $trade_no);
            } else if ($order_type == 'vr_order') {
                $result = $logic_payment->updateVrOrder($out_trade_no, $payment_info['payment_code'], $order_pay_info, $trade_no);
            } else if ($order_type == 'pd_order') {
                $result = $logic_payment->updatePdOrder($out_trade_no, $trade_no, $payment_info, $order_pay_info);
            }
            if (!$result['state']) {
                showMessage('支付状态更新失败',$url,'html','error');
            } else {
                //记录消费日志
                if ($order_type == 'real_order') {
                    $log_buyer_id = $order_list[0]['buyer_id'];
                    $log_buyer_name = $order_list[0]['buyer_name'];
                    $log_desc = '实物订单使用'.orderPaymentName($payment_info['payment_code']).'成功支付，支付单号：'.$out_trade_no;
                } else if ($order_type == 'vr_order') {
                    $log_buyer_id = $order_pay_info['buyer_id'];
                    $log_buyer_name = $order_pay_info['buyer_name'];
                    $log_desc = '虚拟订单使用'.orderPaymentName($payment_info['payment_code']).'成功支付，支付单号：'.$out_trade_no;                    
                } else if ($order_type == 'pd_order') {
                    $log_buyer_id = $order_pay_info['buyer_id'];
                    $log_buyer_name = $order_pay_info['buyer_name'];
                    $log_desc = '预存款充值成功，使用'.orderPaymentName($payment_info['payment_code']).'成功支付，充值单号：'.$out_trade_no;                   
                }
                QueueClient::push('addConsume', array('member_id'=>$log_buyer_id,'member_name'=>$log_buyer_name,
                'consume_amount'=>ncPriceFormat($api_pay_amount),'consume_time'=>TIMESTAMP,'consume_remark'=>$log_desc));
            }
        }

        //支付成功后跳转
        if ($order_type == 'real_order') {
            $pay_ok_url = SHOP_SITE_URL.'/index.php?model=buy&fun=pay_ok&pay_sn='.$out_trade_no.'&pay_amount='.ncPriceFormat($api_pay_amount);
        } elseif ($order_type == 'vr_order') {
            $pay_ok_url = SHOP_SITE_URL.'/index.php?model=buy_virtual&fun=pay_ok&order_sn='.$out_trade_no.'&order_id='.$order_pay_info['order_id'].'&order_amount='.ncPriceFormat($api_pay_amount);
        } elseif ($order_type == 'pd_order') {
            $pay_ok_url = urlMember('predeposit');
        }
        if ($payment_info['payment_code'] == 'tenpay') {
            showMessage('',$pay_ok_url,'tenpay');
        } else {
            redirect($pay_ok_url);
        }
    }


    /*
     *paypal返回验证
     */
    public function paypal_returnOp(){
        Log::record('paypal请求返回参数'.json_encode($_GET),Log::ERR);
        // echo '<pre>';
        // print_r($_GET);exit;
        if ($_GET['paymentId']) {
            // update: 将订单查询条件paypal_sn改为trade_no -- by siuloong 20190426
            $trade_no = $_GET['paymentId'];
            $order_info = Model('order')->getOrderInfo(array('trade_no'=>$trade_no),array('order_common','order_goods'));
           
            require_once(dirname(__FILE__).'/../api/payment/paypal/exec.php');
            $paypal = new checkPaypal($_GET['paymentId'],$order_info);
            $result = $paypal->check();
 // print_r($result);exit;
            Log::record('paypal订单检查返回最后结果信息'.json_encode($result),Log::ERR);
            if($result['msg'] == 'success'){
                $logic_payment = Logic('payment');
                $result = $logic_payment->updateRealOrder($order_info['pay_sn'],'paypal', array($order_info), $trade_no);
                $pay_ok_url = SHOP_SITE_URL.'/index.php?model=buy&fun=pay_ok&pay_sn='.$order_info['pay_sn'].'&pay_amount='.ncPriceFormat($order_info['order_amount']);
                redirect($pay_ok_url);
            }else{
                showMessage($result['msg'],urlShop('member_order', 'index'),'html','error');
            }
        }else{
            redirect('/');
        }
    }


    /**
     * 二维码显示(微信扫码支付)
     */
    public function qrcodeOp() {
        $data = base64_decode($_GET['data']);
        $data = decrypt($data,MD5_KEY,30);
        require_once BASE_RESOURCE_PATH.'/phpqrcode/phpqrcode.php';
        QRcode::png($data);
    }

    /**
     * 接收微信请求，接收productid和用户的openid等参数，执行（【统一下单API】返回prepay_id交易会话标识
     */
    public function wxpay_returnOp() {
        $result = Logic('payment')->getPaymentInfo('wxpay');
        if (!$result['state']) {
            Log::record('wxpay not found','RUN');			
        }
        new wxpay($result['data'],array());
        require_once BASE_PATH.'/api/payment/wxpay/native_notify.php';
    }

    /**
     * 支付成功，更新订单状态
     */
    public function wxpay_notifyOp() {
        $result = Logic('payment')->getPaymentInfo('wxpay');
        if (!$result['state']) {
            Log::record('wxpay not found','RUN');
        }
        new wxpay($result['data'],array());
        require_once BASE_PATH.'/api/payment/wxpay/notify.php';
    }

    public function query_stateOp() {
        if ($_GET['pay_id'] && intval($_GET['pay_id']) > 0) {
            $info = Model('order')->getOrderPayInfo(array('pay_id'=>intval($_GET['pay_id']),'buyer_id'=>intval($_GET['buyer_id'])));
            exit(json_encode(array('state'=>($info['api_pay_state'] == '1'),'pay_sn'=>$info['pay_sn'],'type'=>'r')));
        } elseif (intval($_GET['order_id']) > 0) {
            $info = Model('vr_order')->getOrderInfo(array('order_id'=>intval($_GET['order_id']),'buyer_id'=>intval($_GET['buyer_id'])));
            exit(json_encode(array('state'=>($info['order_state'] == '20'),'pay_sn'=>$info['order_sn'],'type'=>'v')));
        }
    }

    /**
     * paypay支付webhook通知
     * @author siuloong 20190428
     * @return void
     */
    public function paypal_notifyOp() {
        require_once(dirname(__FILE__).'/../api/payment/paypal/webhook.php');
        $webhook = new Webhook();
        $rs = $webhook->notify();
        if ($rs) {
            if ($rs['event_type'] == 'PAYMENT.SALE.COMPLETED') {
                $trade_no = $rs['payment_id'];
                $order_info = Model('order')->getOrderInfo(array('trade_no'=>$trade_no));
                $logic_payment = Logic('payment');
                $result = $logic_payment->updateRealOrder($order_info['pay_sn'],'paypal', array($order_info), $trade_no);
            }
        }
        return $rs;
    }

    
    /*
     * AmazonPay 支付后回调
     * 
     * @author siuloong
     */
    public function amzn_returnOp()
    {
        include_once BASE_PATH . '/api/payment/amazonpay/amazonpay.php';
        Log::record('AmazonPay请求返回参数'.json_encode($_GET),Log::ERR);
        //unset($_GET['model']);
        //unset($_GET['fun']);

        $payment_type = 'amazonpay';
        if (isset($_GET['resultCode'])) {

            if ($_GET['resultCode'] == 'Success') {
                $pay_sn = $_GET['sellerOrderId'];
                $trade_no = $_GET['orderReferenceId'];
                $order_info = Model('order')->getOrderInfo(array('pay_sn'=>$pay_sn));
                //取得支付方式
                $logic_payment = Logic('payment');
                $result = $logic_payment->getPaymentInfo($payment_type);
                if(!$result['state']) {
                    showMessage($result['msg'], $url, 'html', 'error');
                }
                $payment_config = $result['data']['payment_config'];
    
                $payment = new Amazonpay($payment_config);
                $check = $payment->validateSignature($_GET);

                if ($check) {
                    $logic_payment = Logic('payment');
                    $result = $logic_payment->updateRealOrder($order_info['pay_sn'], $payment_type, array($order_info), $trade_no);
                    $pay_ok_url = SHOP_SITE_URL . '/index.php?model=buy&fun=pay_ok&order_sn=' . $order_info['order_sn'] . '&pay_sn=' . $order_info['pay_sn'] . '&pay_amount=' . ncPriceFormat($order_info['order_amount']);
                    redirect($pay_ok_url);
                } else {
                    redirect('/');
                }
                
            } else {
                showMessage('Payment failure' ,urlShop('member_order', 'index'),'html','error');
            }
        } else{
            redirect('/');
        }
    }

    /**
     * AmazonPay 取消支付回调
     *
     * @return void
     * @author siuloong
     */
    public function amzn_cancelOp()
    {
        /*
        Array
        (
            [resultCode] => Failure
            [failureCode] => BuyerAbandoned
            [sellerId] => AM84O5ZPW82BJ
        )
        */
        /*
        $resultCode = $_GET['resultCode'];
        $failureCode = $_GET['failureCode'];
        $resultCode = $_GET['sellerId'];
        */
        showMessage('The payment has been cancelled' ,urlShop('member_order', 'index'),'html','error');
    }
    
    /*
     * AmazonPay 异步通知
     * 
     * @author siuloong
     */
    public function amzn_notifyOp()
    {
        include_once BASE_PATH . '/api/payment/amazonpay/amazonpay.php';
        Log::record('AmazonPay异步请求返回参数'.json_encode($_GET),Log::ERR);
        unset($_GET['model']);
        unset($_GET['fun']);

        $payment_type = 'amazonpay';


        //todo 
        //by siuloong 20190510 =========================
        //暂时未知AmazonPay异步支付返回结构，以下类同步
        if (isset($_GET['resultCode'])) {

            if ($_GET['resultCode'] == 'Success') {
                $pay_sn = $_GET['sellerOrderId'];
                $trade_no = $_GET['orderReferenceId'];
                $order_info = Model('order')->getOrderInfo(array('pay_sn'=>$pay_sn));
                //取得支付方式
                $logic_payment = Logic('payment');
                $result = $logic_payment->getPaymentInfo($payment_type);
                if(!$result['state']) {
                    showMessage($result['msg'], $url, 'html', 'error');
                }
                $payment_config = $result['data']['payment_config'];
    
                $payment = new Amazonpay($payment_config);
                $check = $payment->validateSignature($_GET);

                if ($check) {
                    $logic_payment = Logic('payment');
                    $result = $logic_payment->updateRealOrder($order_info['pay_sn'], $payment_type, array($order_info), $trade_no);
                    $pay_ok_url = SHOP_SITE_URL . '/index.php?model=buy&fun=pay_ok&order_sn=' . $order_info['order_sn'] . '&pay_sn=' . $order_info['pay_sn'] . '&pay_amount=' . ncPriceFormat($order_info['order_amount']);
                    redirect($pay_ok_url);
                } else {
                    redirect('/');
                }
                
            } else {
                showMessage('Payment failure' ,urlShop('member_order', 'index'),'html','error');
            }
        } else{
            redirect('/');
        }
    }

}
