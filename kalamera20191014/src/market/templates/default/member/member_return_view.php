<?php defined('interMarket') or exit('Access Invalid!');?>


<!--中间内容-->
<div class="page_form clearfix">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <div>
                        <div class="order_nav title clearfix">
                            Return management
                        </div>
                        <div class="info_tab dis_b text-center">
                            <div class="inner_ct">
                                <div class="shoplist clearfix">
                                    <?php if (is_array($output['goods_list']) && !empty($output['goods_list'])) { ?>
                                    <?php foreach ($output['goods_list'] as $key => $val) { ?>
                                    <div class="item">
                                        <div class="imgb">
                                            <a target="_blank" href="<?php echo urlShop('goods','index',array('goods_id'=> $val['goods_id'])); ?>">
                                                <img src="<?php echo thumb($val,60); ?>" onMouseOver="toolTip('<img src=<?php echo thumb($val,240); ?>>')" onMouseOut="toolTip()" />
                                            </a>
                                        </div>
                                        <p class="txt">
                                            <a target="_blank" href="<?php echo urlShop('goods','index',array('goods_id'=> $val['goods_id'])); ?>" class="dot-ellipsis dot-height-40 is-truncated" style="overflow-wrap: break-word;">
                                                <?php echo $val['goods_name']; ?>
                                            </a>
                                            <br><strong>Return number : </strong><?php echo $output['return']['refund_sn']; ?><br>
                                            <strong>Refund amount : </strong><?php echo $output['return']['refund_amount']; ?><br>
                                            <strong>Application time : </strong><?php echo date("Y-m-d H:i:s",$output['return']['add_time']);?><br>
                                            <?php if ($output['return']['seller_state'] == 2 && $output['return']['return_type'] == 1) { ?>
                                            （Businessmen discard goods, that is, they do not need to return the goods back to the direct refund。）
                                            <?php } ?>
                                        </p>
                                        <div class="price_box">
                                            <p class="padding-left-7_5"><span class="lb">Status : </span><span class="red_pri"><?php echo $output['state_array'][$output['return']['seller_state']]; ?></span></p>
                                        </div>
                                    </div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="order_nav title clearfix">
                            My application for refund

                        </div>
                        <div class="info_tab dis_b text-center">
                            <div class="inner_ct">
                                <div class="shoplist clearfix">
                                    <p class="txt">
                                        <br><strong>Reasons for refund : </strong><?php echo $output['return']['reason_info']; ?> <br>
                                        <strong>Refund amount : </strong><?php echo $output['return']['refund_amount']; ?><br>
                                        <strong>Quantity returned : </strong><?php echo $output['return']['return_type']==2 ? $output['return']['goods_num']:'nothing'; ?><br>
                                        <strong>Return and refund instructions : </strong><?php echo $output['return']['buyer_message']; ?><br>
                                        <strong>Voucher upload : </strong>
                                        <?php if (is_array($output['pic_list']) && !empty($output['pic_list'])) { ?>
                                            <?php foreach ($output['pic_list'] as $key => $val) { ?>
                                                <?php if(!empty($val)){ ?>
                                                    <p>
                                                            <img class="show_image" src="<?php echo UPLOAD_SITE_URL.'/'.ATTACH_PATH.'/refund/'.$val;?>" style="max-width: 80px;max-height: 80px;margin-bottom: 20px;">
                                                    </p>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>

                                        <br>
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="order_nav title clearfix">
                        Progress status
                    </div>
                    <div class="logistics_" style="margin-top: 0">
                        <div class="addr_l border_none padding-t-30">
                            <div>
                                <p><?php echo date("Y-m-d H:i:s",$output['return']['add_time']);?></p>
                                <p>Buyer Apply for Return</p>
                            </div>
                            <?php if($output['return']['seller_time'] > 0 ){?>
                                <div>
                                    <p><?php echo date("Y-m-d H:i:s",$output['return']['seller_time']);?></p>
                                    <p>Businessmen Processing Return Applications</p>
                                </div>
                            <?php }?>
                            <?php if($output['return']['ship_time'] > 0){?>
                                <div>
                                    <p><?php echo date("Y-m-d H:i:s",$output['return']['ship_time']);?></p>
                                    <p>Buyer Returns to Merchant</p>
                                </div>
                            <?php }?>
                            <?php if($output['return']['admin_time'] > 0 ){?>
                                <div>
                                    <p><?php echo date("Y-m-d H:i:s",$output['return']['admin_time']);?></p>
                                    <p>Confirmation of receipt, platform audit</p>
                                </div>
                            <?php }?>
                        </div>
                    </div>

                    <div>
                        <div class="order_nav title clearfix">
                            Businessmen Return and Refund Processing
                        </div>
                        <div class="info_tab dis_b text-center">
                            <div class="inner_ct">
                                <div class="shoplist clearfix">
                                    <p class="txt">
                                        <br><strong>Audit status : </strong>
                                        <?php echo $output['state_array'][$output['return']['seller_state']]; ?>
                                        <?php if ($output['return']['seller_state'] == 2 && $output['return']['return_type'] == 1) { ?>
                                            （Businessmen discard goods, that is, they do not need to return the goods back to the direct refund 。）
                                        <?php } ?>
                                        <br>

                                        <?php if ($output['return']['seller_time'] > 0) { ?>
                                        <strong>Reasons for the seller's disagreement : </strong>
                                            <?php echo $output['return']['seller_message']; ?><br>
                                         <?php } ?>
                                    <br>
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>



                    <?php if($output['return']['seller_state'] == 2 && $output['return']['return_type'] == 2 && $output['return']['goods_state'] == 1 && $output['ship'] == 1) { ?>
                        <?php require template('member/member_return_ship');?>
                    <?php } else { ?>
                        <?php if ($output['return']['express_id'] > 0 && !empty($output['return']['invoice_no'])) { ?>
                            <div>
                                <div class="order_nav title clearfix">
                                    My Return Delivery Information
                                </div>
                                <div class="info_tab dis_b text-center">
                                    <div class="inner_ct">
                                        <div class="shoplist clearfix">
                                            <p class="txt">
                                                <br><strong>Logistics information : </strong>
                                                <?php echo $output['return_e_name'].' , '.$output['return']['invoice_no']; ?>
                                                <br>
                                            </p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                        <?php if ($output['return']['seller_state'] == 2 && $output['return']['refund_state'] >= 2) { ?>
                            <div>
                                <div class="order_nav title clearfix">
                                    Refund Audit of Mall
                                </div>
                                <div class="info_tab dis_b text-center">
                                    <div class="inner_ct">
                                        <div class="shoplist clearfix">
                                            <p class="txt">
                                                <br><strong>Platform validation : </strong>
                                                <?php echo $output['admin_array'][$output['return']['refund_state']]; ?>
                                                <br>
                                                <strong> Platform notes : </strong>
                                                <?php echo $output['return']['admin_message']; ?>


                                            </p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>


                        <?php if ($output['return']['admin_time'] > 0) { ?>


                            <?php if ($output['detail_array']['refund_state'] == 2) { ?>
                                <div>
                                    <div class="order_nav title clearfix">
                                        Refund details
                                    </div>
                                    <div class="info_tab dis_b text-center">
                                        <div class="inner_ct">
                                            <div class="shoplist clearfix">
                                                <p class="txt">
                                                    <br><strong>Payment method : </strong>
                                                    <?php echo orderPaymentName($output['detail_array']['refund_code']);?>
                                                    <br>
                                                    <strong>Online refund amount: </strong>
                                                    <?php echo ncPriceFormat($output['detail_array']['pay_amount']); ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.nyroModal/custom.min.js" ></script>
<link href="<?php echo RESOURCE_SITE_URL;?>/js/jquery.nyroModal/styles/nyroModal.css" rel="stylesheet" type="text/css" id="cssfile2" />
<script>
$(document).ready(function(){
   $('a[nctype="nyroModal"]').nyroModal();
});
</script>