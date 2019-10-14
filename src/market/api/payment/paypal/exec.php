<?php
// +----------------------------------------------------------------------
// | Perfect Is Shit
// +----------------------------------------------------------------------
// | 执行支付DEMO
// +----------------------------------------------------------------------
// | Author: alexander <gt199899@gmail.com>
// +----------------------------------------------------------------------
// | Datetime: 2016-07-28 11:53:10
// +----------------------------------------------------------------------
// | Copyright: Perfect Is Shit
// +----------------------------------------------------------------------

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ExecutePayment;
use PayPal\Api\ItemList;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class checkPaypal{
    /**
     * paypa单号
     */
    private $paypal_sn;

    /**
     * 订单信息
     */
    private $order_info;

    public function __construct($paypal_sn,$order_info){
        $this->paypal_sn = $paypal_sn;
        $this->order_info = $order_info;
    }

    public function check(){
        //  echo '<pre>';
        // print_r($_GET);exit;
        // ### Approval Status
        if (isset($_GET['success']) && $_GET['success'] == 'true') {
            set_time_limit(3600);
            require_once('common.php');
            // Get the payment Object by passing paymentId
            $paymentId = $_GET['paymentId'];
            $payment = Payment::get($paymentId, $apiContext);

            Log::record('paypal订单信息'.json_encode($payment),Log::ERR);
            // ### Payment Execute
            $execution = new PaymentExecution();
            $execution->setPayerId($_GET['PayerID']);


// echo '<pre>';
//         print_r($this->order_info['extend_order_goods']);exit;
             $items = array();

            foreach ($this->order_info['extend_order_goods'] as $k => $g) {
                $item[$k] = new Item();
                $item[$k]->setName($g['goods_name'])
                    ->setCurrency('USD')
                    ->setQuantity($g['goods_num'])
                    ->setSku(mb_substr($g['goods_name'],0,60))
                    ->setPrice($g['goods_price']);
                $items[] = $item[$k];
            }
    //        echo '<pre>';
    //        print_R($items);die;
            // Log::record('paypal商品详情'.json_encode($items),Log::ERR);
            $itemList = new ItemList();
            //$itemList->setItems(array($item1, $item2));
            $itemList->setItems($items);




            // ### Optional Changes to Amount
            $transaction = new Transaction();
            $amount = new Amount();
            $details = new Details();

            $details->setShipping($this->order_info['shipping_fee'])
                ->setTax($this->order_info['tax_payment'])
                ->setSubtotal($this->order_info['goods_amount']-$this->order_info['tax_payment']);

            $amount->setCurrency('USD');
            $amount->setTotal($this->order_info['order_amount']);
            $amount->setDetails($details);
            // $transaction->setAmount($amount);

            $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());

            // Add the above transaction object inside our Execution object.
            $execution->addTransaction($transaction);

            try {
                // Execute the payment
                $result = $payment->execute($execution, $apiContext);
                Log::record('paypal订单检查返回信息'.json_encode($result),Log::ERR);
                $return['msg'] = "success";
                return $return;
            } catch (Exception $ex) {
                $return['msg'] = $ex;
                Log::record('paypal订单检查错误返回信息'.json_encode($return),Log::ERR);
                return $return;
            }
        } else {
            $return['msg'] =  "User Cancelled the Approval";
            return $return;
        }
    }
}
