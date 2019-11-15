 <div class="order_nav  clearfix">
    <div class="form fr">
        <form method="get" action="index.php" target="_self">
            <input type="hidden" name="model" value="member_order" />
            <input type="hidden" name= "recycle" value="<?php echo $_GET['recycle'];?>" />
            <input class="sear_txt" type="text" name="keyword" value="<?php echo $output['keyword'];?>" placeholder="Enter the order number">
            <input class="sear_btn" type="submit" value="Search">
        </form>
    </div>
    <div class="fl" style="margin-top: 13px;margin-left: 10px;">

        <div class="order_li <?php if ($_GET['state_type'] == '') { ?>orderli_active<?php } ?>">
            <a href="<?php echo urlShop('member_order', 'index'); ?>">
                All
            </a>
        </div>
        <div class="order_li <?php if ($_GET['state_type'] == 'state_new') { ?>orderli_active<?php } ?>">
            <a href="<?php echo urlShop('member_order', 'index', ['state_type' => 'state_new']); ?>">
                Unpaid
                <!--                [--><?php //echo $output['order_tip']['order_nopay_count'];?><!--]-->
            </a>
        </div>
        <div class="order_li <?php if ($_GET['state_type'] == 'state_pay') { ?>orderli_active<?php } ?>">
            <a href="<?php echo urlShop('member_order', 'index', ['state_type' => 'state_pay']); ?>">
                To beshipped
                <!--                [--><?php //echo $output['order_tip']['order_pay_count'];?><!--]-->
            </a>
        </div>
        <div class="order_li <?php if ($_GET['state_type'] == 'state_success') { ?>orderli_active<?php } ?>">
            <a href="<?php echo urlShop('member_order', 'index', ['state_type' => 'state_success']); ?>">
                Assessment<br>
                <!--                [--><?php //echo $output['order_tip']['order_state_success'];?><!--]-->
            </a>
        </div>
    </div>
</div>

<?php if (!empty($output['order_group_list'])) { ?>

    <div class="info_tab dis_b" id="order_box1">
        <?php foreach ($output['order_group_list'] as $group) { ?>
            <?php foreach ($group['order_list'] as $order) { ?>
                <div class="order_list">
                    <div class="order_num">
                        <div class="order_code">
                            <b>Order number：</b> <?php echo $order['order_sn']; ?>
                        </div>
                        <div class="order_time">
                            <b>Orrder time：</b> <?php echo date('Y-m-d | H:i:s', $order['add_time']); ?>
                        </div>
                        <div class="order_time">
                            <b>Order status ：</b> <font
                                    class="text-danger"><?php echo $order['state_desc']; ?></font>
                        </div>
                    </div>


                    <div class="order_li">
                        <div class="orderli_l">
                            <?php if (is_array($order['goods_list'])) { ?>
                                <?php foreach ($order['goods_list'] as $key => $g) { ?>
                                    <div class="box">
                                        <div class="inline_b">
                                            <div class="imgb">
                                                <a target="_blank"
                                                   href="<?php echo urlShop('goods', 'index', ['goods_id' => $g['goods_id']]); ?>">
                                                    <img src="<?php echo $g['image_60_url']; ?>"/>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="inline_b order_txt">
                                            <p style="line-height: 20px;padding-bottom: 5px">
                                                <a target="_blank"
                                                   href="<?php echo urlShop('goods', 'index', ['goods_id' => $g['goods_id']]); ?>"
                                                   class="dot-ellipsis dot-height-55">
                                                    <?php echo $g['goods_name']; ?>
                                                </a>
                                            </p>
                                            <?php echo $g['goods_num']; ?>item &nbsp;&nbsp;<strong>Total: <span
                                                        class="red_pri">$<?php echo $g['goods_price']; ?></span></strong><br>
                                            <!--                            <span class="red_pri">Unpaid</span>-->
                                            <?php if($g['goods_repair']['percent'] !='' && $g['goods_repair']['repair_price'] !='0.00'){ ?>
                                                <p>Warranty Price :
                                                    <?php echo $g['goods_repair']['description']; ?>（$<?php echo $g['goods_repair']['repair_price']; ?>）
                                                </p>
                                            <?php } ?>
                                            <!-- 退款 -->
                                            <?php if ($g['refund'] == 1) { ?>
                                                <div class="inline_b">
                                                    <a href="index.php?model=member_refund&fun=add_refund&order_id=<?php echo $g['order_id']; ?>&goods_id=<?php echo $g['rec_id']; ?>">
                                                <span>
                                                Refund/Return
                                                </span>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                            <?php if (is_array($g['refund_all']) && !empty($g['refund_all'])) { ?>
                                                <div class="inline_b">
                                                    <a target="_blank"
                                                       href="index.php?model=member_refund&fun=view&refund_id=<?php echo $g['refund_all']['refund_id']; ?>">
                                                <span>
                                                    View refund
                                                </span>
                                                    </a>
                                                </div>
                                            <?php } else if ($g['extend_refund']['refund_type'] == 1) { ?>
                                                <div class="inline_b">
                                                    <a target="_blank"
                                                       href="index.php?model=member_refund&fun=view&refund_id=<?php echo $g['extend_refund']['refund_id']; ?>">
                                                <span>
                                                 View refund
                                                </span>
                                                    </a>
                                                </div>
                                            <?php } else if ($g['extend_refund']['refund_type'] == 2) { ?>
                                                <div class="inline_b">
                                                    <a target="_blank"
                                                       href="index.php?model=member_return&fun=view&return_id=<?php echo $g['extend_refund']['refund_id']; ?>">
                                                <span>
                                                 View refund
                                                </span>
                                                    </a>
                                                </div>
                                            <?php } ?>


                                        </div>
                                    </div>

                                <?php } ?>
                            <?php } ?>
                        </div>
                        <div class="orderli_r">
                            <div class="jiner">
                                <p class="font_big_blod">Grand Total:</p>
                                <div class="amount">$<?php echo $order['order_amount']; ?></div>

                                (<span class="font_big_blod">Tax :$<?php echo $order['tax_payment'];?></span><br>

                                <span class="font_big_blod">Freight :$<?php echo $order['shipping_fee'];?></span>)
                            </div>
                            <div class="anniu">
                                <li>
                                    <a href="<?php echo urlShop('member_order', 'show_order', ['order_id' => $order['order_id']]); ?>"
                                       target="_blank">Order details</a>
                                </li>
                                <?php if ($order['if_deliver']) { ?>
                                    <li>
                                        <a href="http://www.pilotdelivers.com/quicktrack.aspx?Pro=<?php echo $order['shipping_code'];?>" target="_blank">
                                            Track package
                                        </a>
                                    </li>
                                <?php } ?>
                                <?php if ($order['if_receive']) { //收货?>
                                    <li>
                                        <a href="javascript:void(0)"
                                           onclick="ajax_get_confirm('You are sure that the goods have been received?', '<?php echo urlShop('member_order', 'change_state', ['state_type' => 'order_receive', 'order_id' => $order['order_id'], 'form_submit' => 'ok']); ?>');">Confirm
                                            receipt</a></li>
                                <?php } ?>
                                <?php if ($group['pay_amount'] > 0) { //支付?>
                                    <li>
                                        <a href="<?php echo urlShop('buy', 'pay', ['pay_sn' => $order['pay_sn'],'pay_type' => '2']); ?>">
                                            Complete payment
                                        </a>
                                    </li>
                                <?php } ?>
                                <?php if ($order['if_buyer_cancel']) { //取消?>
                                    <li>
                                        <a href="javascript:void(0)" onclick="ajax_get_confirm('Are you sure you want to cancel the order?', '<?php echo urlShop('member_order', 'change_state', ['state_type' => 'order_cancel', 'order_id' => $order['order_id'], 'form_submit' => 'ok']); ?>');">
                                            Cancel order
                                        </a>
                                    </li>
                                <?php } ?>
                                <?php if ($order['if_evaluation']) { ?>
                                    <li>
                                        <a href="<?php echo urlShop('member_evaluate', 'goodsadd', ['order_id' => $order['order_id']]); ?>">commented</a>
                                    </li>
                                <?php } ?>


                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
    <div class="page margin-top-0">
        <?php echo $output['show_page']; ?>
    </div>
<?php } else { ?>
    <div class="info_tab dis_b text-center min_height_450">
        <div style="padding:191px 0;">
            <p style="font-size: 16px;font-weight: 700;margin:0 20px 15px 20px;">You have no orders associated with this
                account.</p>
            <a class="go_right" href="<?php echo BASE_SITE_URL; ?>">Go shopping</a>
        </div>
    </div>
<?php } ?>


<script charset="utf-8" type="text/javascript"
        src="<?php echo RESOURCE_SITE_URL; ?>/js/jquery-ui/i18n/zh-CN.js"></script>
<script charset="utf-8" type="text/javascript" src="<?php echo RESOURCE_SITE_URL; ?>/js/sns.js"></script>
<script type="text/javascript">
    $(function () {
        $('#query_start_date').datepicker({dateFormat: 'yy-mm-dd'});
        $('#query_end_date').datepicker({dateFormat: 'yy-mm-dd'});
    });
</script> 
