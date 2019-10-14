<?php defined('interMarket') or exit('Access Invalid!');?>
<!--中间内容-->
<div class="grey_container">
        <div class="container">
            <div class="row">
                <div class="inner_ct">
                    <div class="text-center">
                        <img style="margin-top: 100px;" src="resource/images/pay_success.png" alt="">
                        <p class="empty_tip">Payment successful</p>
                        <div class="font-14 two_middle">
                            <p class="inline_b"><span class="sec_t"><!--Order-->Payment order : </span><?php echo $_GET['pay_sn']?></p>
                            <p class="inline_b">
                                <span class="sec_t">Payment amount : </span><span class="total_p red_pri" style="font-size: 20px;font-weight: 700;">$<?php echo $_GET['pay_amount'];?></span>
                            </p>
                        </div>
                        <div class="two_middle">
                            <a href="<?php echo SHOP_SITE_URL?>/index.php?model=member_order"" class="go_shop hover_white">Check order</a>
                            <a href="<?php echo SHOP_SITE_URL?>" class="go_shop hover_white">Go shopping</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--中间内容结束-->