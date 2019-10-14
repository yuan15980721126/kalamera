<?php defined('interMarket') or exit('Access Invalid!');
require_once BASE_PATH . '/api/payment/amazonpay/config.php';
$amazonpay_config = unserialize($output['payment_list']['amazonpay']['payment_config'])?:$amazonpay_config;
$amznpay_widgets_js_url = getWidgetsJsURL($amazonpay_config);

?>

<script type='text/javascript' src="<?php echo $amznpay_widgets_js_url?>"></script>

<!--中间内容-->
<div class="clearfix login_grey_bg">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-margin">
                    <form action="<?php echo urlShop('payment', 'real_order'); ?>" method="POST" id="buy_form"
                          class="form_control">
                        <input type="hidden" name="pay_sn" value="<?php echo $output['pay_info']['pay_sn']; ?>">
                        <input type="hidden" id="payment_code" name="payment_code" value="">
                        <input type="hidden" value="" name="password_callback" id="password_callback">
                        <div class="login_title first-hr">
                            Payment
                        </div>
                        <div class="progress_box">
                            <span class="progress_"><span style="width: 100%;"></span></span>
                            <div class="fl blue_theme">Cart</div>
                            <div class="shipping_addr">Shipping Address</div>
                            <div class="fr blue_theme">Payment</div>
                        </div>
                        <div class="addr_wrap">
                            <br>
                            <div class="font-14">
                                <?php foreach ($output['order_list'] as $key => $order_info) { ?>

                                    <span class="sec_t">Order number : </span><?php echo $order_info['order_sn']; ?>
                                    <br>
                                    <p class="padding-top-10">
                                        <span class="sec_t">Payment amount : </span>
                                        <span class="total_p red_pri" style="font-size: 20px;font-weight: 700;">
                                            $<?php echo $order_info['order_amount']; ?>
                                        </span>
                                    </p>
                                <?php } ?>

                            </div>
                            <div class="payment_b">
                                <div class="choose">
                                    <ul>
                                        <?php foreach ($output['payment_list'] as $val) { ?>
                                            <?php if ($val['payment_state'] == '1') { ?>
                                                <li payment_code="<?php echo $val['payment_code']; ?>" <?php if ($_GET['payment_code'] == $val['payment_code']) { ?> class="using"<?php } ?>>
                                                    <?php if ($val['payment_code'] == 'paypal') { ?>
                                                        <img src="/skins/default/img/paypal.png" alt="">
                                                    <?php } else { ?>
                                                        <img src="/skins/default/img/amazonpay.png" alt="">
                                                    <?php } ?>
                                                </li>
                                            <?php } ?>
                                        <?php } ?>
                                    </ul>
                                </div>

                                <div class="paypal_b pay_item">
                                    <p class="paypal_txt">
                                        Clicking below will transfer you to PayPal. After you approve the use of PayPal,
                                        you will be returned to Livingdirect to review and complete your purchase.
                                        <br><strong>PayPal orders can only be shipped to your PayPal verified
                                            address.</strong>
                                    </p>
                                    <div class="text-center" style="margin:50px auto 80px auto;">
                                        <div class="border_grey pay_border_b">
                                            <img src="/skins/default/img/paypal.png" alt="">
                                        </div>
                                    </div>
                                    <div class="text-center">

                                        <input id="next_button" type="button" value="Continue to Payment"
                                               class="continue-pay">
                                    </div>
                                </div>
                                <div class="amazon_b pay_item">
                                    <p class="paypal_txt">
                                        Clicking below will prompt you to log in to your Amazon account. Afterwards you
                                        will have an opportunity to review and submit your order.
                                    </p>
                                    <div class="text-center" style="margin:50px auto 80px auto;">
                                        <div class="border_grey pay_border_b">
                                            <img src="/skins/default/img/amazonpay.png" alt="">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <div id="AmazonPayButton"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--中间内容结束-->


<script type="text/javascript">
    var pay_amount_online = <?php echo $output['pay']['pay_amount_online'];?>;
    var member_rcb = <?php echo $output['pay']['member_rcb'];?>;
    var member_pd = <?php echo $output['pay']['member_pd'];?>;
    var pay_diff_amount = <?php echo $output['pay']['pay_amount_online'] ? $output['pay']['pay_amount_online'] : $output['pay']['payd_diff_amount'];?>;
    $(function () {
        //tab切换
        $('.payment_b .choose ul li').each(function () {
            $(this).click(function () {
                $(this).addClass('white_bg');
                $(this).siblings().removeClass('white_bg');

                var code = $(this).attr('payment_code');
                console.log(code)
                $('.payment_b .pay_item').hide();
                if ($(this).index() == 0) {
                    $('.payment_b .paypal_b').show();
                }
                if ($(this).index() == 1) {
                    $('.payment_b .amazon_b').show();
                }
                $('#payment_code').val(code);
            })
        })

        //credit / debit card点击选择

        $('.ncc-payment-list > li').on('click', function () {
            $('.ncc-payment-list > li').removeClass('using');
            if ($('#payment_code').val() != $(this).attr('payment_code')) {
                $('#payment_code').val($(this).attr('payment_code'));
                $(this).addClass('using');
            } else {
                $('#payment_code').val('');
            }
        });
        $('#next_button').on('click', function () {
            if ($('#payment_code').val() == '') {
                showDialog('Please choose an online payment method', 'error', '', '', '', '', '', '', '', 2);
                return;
            }
            $(this).button('loading');
            $('#buy_form').submit();
        });


    });
</script>

<script type="text/javascript">
    // amazon pay
    var payment_code = 'amazonpay';
    var seller_id = '<?php echo $amazonpay_config['merchant_id'] ?>';
    //var currency_code = '<?php echo $amazonpay_config['currency_code'] ?>';
    var pay_url = '<?php echo urlShop('payment', 'real_order'); ?>';
    var pay_sn = '<?php echo $output['pay_info']['pay_sn']; ?>';

    OffAmazonPayments.Button("AmazonPayButton", seller_id, {
        type: "hostedPayment",
        hostedParametersProvider: function(done) {
            $.getJSON(pay_url, { //ExpressSignature.php
                //    amount: 0.01,
                //     currencyCode: currency_code,
                //    sellerOrderId: pay_sn,
                //    sellerNote: $("#itemname").text() + ' QTY: ' + $("#QuantitySelect option:selected").val(),
                scope: 'payments:billing_address',
                pay_sn: pay_sn,
                payment_code: payment_code
            }, function(data) {
                done(data);
            })
        },
        onError: function(errorCode) {
            console.log(errorCode.getErrorCode() + " " + errorCode.getErrorMessage());
        }
    });
</script>