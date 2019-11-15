<?php
// +----------------------------------------------------------------------
// | Perfect Is Shit
// +----------------------------------------------------------------------
// | paypal支付DEMO
// +----------------------------------------------------------------------
// | Author: alexander <gt199899@gmail.com>
// +----------------------------------------------------------------------
// | Datetime: 2016-07-28 10:56:40
// +----------------------------------------------------------------------
// | Copyright: Perfect Is Shit
// +----------------------------------------------------------------------


use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\CreditCard;
use PayPal\Api\FundingInstrument;
use PayPal\Api\CreditCardToken;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\ShippingAddress;
use PayPal\Exception\PayPalConnectionException;


class paypal{
    /**
     * 支付接口配置信息
     *
     * @var array
     */
    private $payment_info;
     /**
     * 订单信息
     *
     * @var array
     */
    private $order_info;

    public function __construct($payment_info = array(),$order_info = array()){
        $this->payment_info = $payment_info;
        $this->order_info = $order_info;
    }
    public function get_payurl($patment_info){
        require_once('common.php');

        $payer = new Payer();
        if($patment_info['payment_code'] == 'credit_card'){
            $card = new CreditCard();
            $card->setType(strtolower($patment_info['card_info']['creditCardType']))
                ->setNumber($patment_info['card_info']['creditCardNumber'])
                ->setExpireMonth($patment_info['card_info']['expDateMonth'])
                ->setExpireYear($patment_info['card_info']['expDateYear'])
                ->setCvv2($patment_info['card_info']['cvv2'])
                ->setFirstName($patment_info['card_info']['first_name'])
                ->setLastName($patment_info['card_info']['last_name']);
            $fi = new FundingInstrument();
            $fi->setCreditCard($card);
            $payer->setPaymentMethod($patment_info['payment_code'])
                  ->setFundingInstruments(array($fi));
        }else{
            $payer->setPaymentMethod($patment_info['payment_code']);
        }

        // ### Itemized information
        $items = array();
        echo '<pre>';


        $voucher_price = $this->order_info['shipping']['voucher_price'];
        $voucher_type= $this->order_info['shipping']['voucher_type'];

        $goods_list = $this->order_info['goods_list'];
        $goods_count = count($goods_list);

        $goods_num = 0;
        foreach ($goods_list as $k => $g) {
            $goods_num +=$g['goods_num'];
        }
//        print_R($goods_list);
        print_R($voucher_type);
        foreach ($goods_list as $k => $g) {
            $goods_repair = $g['goods_repair'] ? unserialize($g['goods_repair']) : '';
            if(!empty($goods_repair) && is_array($goods_repair)){//获取每件商品的单独保修价格
                $original_price = $goods_repair['original_price'];
            }
            $goods_price = $g['goods_price'];
            if($voucher_type ==1 && !empty($voucher_price)){//优惠券立减商品直接立减
//                $goods_price = ($g['goods_price'] - ($voucher_price / $goods_num));//优惠金额/商品数量
//                print_R($goods_price);echo '<br>';




            }
            if($voucher_type == 2  && !empty($voucher_price)){//优惠券折扣换算则第一个商品直接立减
                $goods_price = ncPriceFormat($g['goods_price'] * ($voucher_price/100));
            }
            $item[$k] = new Item();
            $item[$k]->setName($g['goods_name'])
                ->setCurrency('USD')
                ->setQuantity($g['goods_num'])
                ->setSku(mb_substr($g['goods_name'],0,60))
                ->setPrice($goods_price+$original_price);//最后价格再加上单独保修价格
            $items[] = $item[$k];

        }
//        print_R($item);
//        die;
        Log::record('paypal商品详情'.json_encode($items),Log::ERR);
        $itemList = new ItemList();
        $itemList->setItems($items);

        // 自定义用户收货地址，避免用户在paypal上账单的收货地址和销售方收货地址有出入
        // 这里定义了收货地址，用户在支付过程中就不能更改收货地址，否则，用户可以自己更改收货地址
//        $reciver_info = unserialize($this->order_info['shipping']['reciver_info']);
//        $address = new ShippingAddress();
//        $reciver_info['city'] = $this->order_info['shipping']['area_name']; // --siuloong
//        $reciver_info['state'] = $this->order_info['shipping']['area_code'];    // --siuloong
//        echo '<pre>';
//        print_R($reciver_info);die;
//        $address->setRecipientName($this->order_info['shipping']['reciver_name'])
//                ->setLine1($reciver_info['address'])
//                ->setCity($reciver_info['city'])
//                ->setState($reciver_info['state'])
//                ->setPhone($reciver_info['mob_phone'])
//                ->setPostalCode($reciver_info['zipcode'])
//                ->setCountryCode('US');
//        Log::record('paypal$reciver_info'.json_encode($reciver_info),Log::ERR);
//        Log::record('paypal$this->order_info'.json_encode($this->order_info),Log::ERR);
//        Log::record('paypal地址信息'.json_encode($address),Log::ERR);

//        $itemList->setShippingAddress($address);


        // ### Additional payment details
        $details = new Details();
        $details->setShipping($this->order_info['order_list'][0]['shipping_fee'])
            ->setTax($this->order_info['order_list'][0]['tax_payment'])
            ->setSubtotal($this->order_info['order_list'][0]['goods_amount']+20)
            ->setShippingDiscount(20);
        // ### Amount
    //        echo '<pre>';
    //        print_R($this->order_info['order_list']);die;
        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($this->order_info['order_list'][0]['order_amount'])
            ->setDetails($details);
        Log::record('Amount'.json_encode($this->order_info['order_list'][0]),Log::ERR);
        // ### Transaction
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());


        // ### Redirect urls
        $baseUrl = getBaseUrl();
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("$baseUrl/index.php?model=payment&fun=paypal_return&success=true")
            ->setCancelUrl("$baseUrl/index.php?model=payment&fun=paypal_return&success=false");

        // ### Payment
        Log::record('paypalsetReturnUrl'.json_encode($baseUrl),Log::ERR);
        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));
        Log::record('paypal支付参数'.json_encode($apiContext),Log::ERR);

        //$payment->create($apiContext);
        try {
            $payment->create($apiContext);
            Log::record('paypal支付错误信息11'.json_encode($payment),Log::ERR);

            echo $payment;

            echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";
        }
        catch (PayPalConnectionException $ex) {
            // This will print the detailed information on the exception.
            //REALLY HELPFUL FOR DEBUGGING
            //Log::record('paypalsetReturnUrl'.json_encode(PaypalError($ex)),Log::ERR);
            //echo PaypalError($ex);
            echo $ex->getData();
            Log::record('paypal支付错误信息'.json_encode($ex->getData()),Log::ERR);

            exit;
        }
        Log::record('paypal_sn'.json_encode($payment->getId()),Log::ERR);
        Log::record('pay_url'.json_encode($payment->getApprovalLink()),Log::ERR);

        $payment_info['paypal_sn'] = $payment->getId();
        $payment_info['pay_url'] = $payment->getApprovalLink();
        //return json_decode($payment,true);
        return $payment_info;
    }
}