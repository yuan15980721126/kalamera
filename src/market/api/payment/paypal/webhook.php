<?php
class Webhook {

    public $apiContext;

    public function __construct() {
        require_once('common.php');
        $this->apiContext = $apiContext;
    }

    public function notify(){
        Log::record('paypal webhook: start', Log::ERR);
        $bodyReceived = file_get_contents('php://input'); // 获取通知的全部内容
        Log::record('paypal webhook: ' . json_encode($bodyReceived), Log::ERR);
        $output = '';
        try {
            $output = \PayPal\Api\WebhookEvent::validateAndGetReceivedEvent($bodyReceived, $this->apiContext);
        } catch (\InvalidArgumentException $ex) {
            // This catch is based on the bug fix required for proper validation for PHP. Please read the note below for more details.
            // If you receive an InvalidArgumentException, please return back with HTTP 503, to resend the webhooks. Returning HTTP Status code [is shown here](http://php.net/manual/en/function.http-response-code.php). However, for most application, the below code should work just fine.
            http_response_code(503);
        } catch (Exception $ex) {
            exit(1);
        }
        if($output){
            $result = array();
            $callbackArr = json_decode($bodyReceived, true);
            switch($callbackArr['event_type']) {
                case 'PAYMENT.SALE.COMPLETED':      // 判断是否支付完成
                    $result = $this->eventPaymentSaleComoleted($callbackArr); // 获取支付完成的信息
                    break;
            }
            return $result;
        } else {
            exit;
        }
    }
    
    /**
     * 支付成功事件
     *
     * @param [type] $callbackArr
     * @return void
     */
    public function eventPaymentSaleComoleted($callbackArr){
        $paymentId = $callbackArr['resource']['parent_payment'];
        try {
            $payment = \PayPal\Api\Payment::get($paymentId, $this->apiContext);
        } catch (Exception $ex) {
            exit(1);
        }
        /*
        $transactions = $payment->getTransactions();
        $relatedResources = $transactions[0]->getRelatedResources();
        $sale = $relatedResources[0]->getSale();
        $saleId = $sale->getId();
        $invoiceNumber = $transactions[0]->invoice_number;
        
        $result = array(
            'out_trade_no' => $invoiceNumber,
            'total_fee' => $callbackArr['resource']['amount']['total'],
            'api_trade_no' => $saleId,
        );
        */
        $result = array(
            'event_type' => 'PAYMENT.SALE.COMPLETED',
            'payment_id' => $paymentId
        );
        return $result;
    }


}