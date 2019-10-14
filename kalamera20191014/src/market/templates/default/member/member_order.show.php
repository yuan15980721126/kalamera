<?php defined('interMarket') or exit('Access Invalid!');?>


<!--中间内容-->
<div class="page_form clearfix">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <div class="login_title padding-top-10" style="margin-bottom: 20px;">Order details</div>
                    <div class="info_tab dis_b" id="order_box1">
                        <div class="order_list">
                            <div class="order_num">
                                <div class="order_code">
                                    <b>Order number : </b><?php echo $output['order_info']['order_sn']; ?>
                                </div>
                                <div class="order_time">
                                    <b>Orrder time : </b> <?php echo date("Y-m-d",$output['order_info']['add_time']); ?>
                                </div>
                                <div class="order_time">
                                    <b>Status : </b> <span class="red_pri"><?php echo $output['order_info']['state_desc'];?></span>
                                </div>
                            </div>
                            <div class="shipping_addr_b">
                                <p class="sec_t">Shipping address :</p>
                                <div class="txt">
                                    <?php echo str_replace('---','  ',$output['order_info']['extend_order_common']['reciver_name']);?><br>
                                    <?php echo @$output['order_info']['extend_order_common']['reciver_info']['address'];?><br>

                                    tel : <?php echo @$output['order_info']['extend_order_common']['reciver_info']['phone'];?><br>
                                    zipcode : <?php echo @$output['order_info']['extend_order_common']['reciver_info']['zipcode'];?>
                                </div>
                            </div>
                            <div class="order_li">
                                <div class="orderli_l">
                                    <?php foreach($output['order_info']['goods_list'] as $k => $goods) {?>
                                    <div class="box">
                                        <div class="inline_b">
                                            <div class="imgb">
                                                <a href="<?php echo $goods['goods_url']; ?>" target="_blank"><img src="<?php echo $goods['image_60_url']; ?>" /></a>
                                            </div>
                                        </div>
                                        <div class="inline_b order_txt">
                                            <p class="un_wrap">
                                                <a href="<?php echo $goods['goods_url']; ?>" target="_blank"><?php echo $goods['goods_name']; ?></a>
                                            </p>

                                            <?php if ($goods['goods_spec']) { ?>
                                                <p><?php echo $goods['goods_spec'];?></p>
                                            <?php }?>
                                            <?php echo $goods['goods_num']; ?> item &nbsp;&nbsp;
                                            <strong>Total: <span class="red_pri">$<?php echo $goods['goods_price']; ?></span></strong><br>
<!--                                            <span class="red_pri">Unpaid</span>-->
                                            <?php if($goods['goods_repair']['percent'] !='' && $goods['goods_repair']['repair_price'] !='0.00'){ ?>
                                                <p>Warranty Price :
                                                    <?php echo $goods['goods_repair']['description']; ?>（$<?php echo $goods['goods_repair']['repair_price']; ?>）
                                                </p>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <?php }?>

                                </div>
                                <div class="orderli_r">
                                    <div class="jiner">
<!--                                        <p class="font_big_blod">Amount of goods :</p>-->
<!--                                        <div class="amount">$--><?php //echo $output['order_info']['goods_amount']; ?><!--</div>-->
                                        <p class="font_big_blod">Tax:</p>
                                        <div class="amount">$<?php echo $output['order_info']['tax_payment']; ?></div>
                                        <p class="font_big_blod">Number:</p>
                                        <div class="amount"><?php echo $output['order_info']['goods_count'];?></div>
                                        <p class="font_big_blod">Freight :</p>
                                        <div class="amount"><?php echo $output['order_info']['shipping_fee'];?></div>

                                        <p class="font_big_blod">Aggregate amount :</p>
                                        <div class="amount"><?php echo $output['order_info']['order_amount'];?></div>

                                        <?php $pinfo = $output['order_info']['extend_order_common']['promotion_info'];?>
                                        <?php if(!empty($pinfo)){ ?>
                                            <p class="font_big_blod">Coupon:</p>
                                                <?php $pinfo = unserialize($pinfo);?>
                                                <?php if($pinfo == false){ ?>
                                                    <div class="amount">
                                                    <?php echo $output['order_info']['extend_order_common']['promotion_info'];?>
                                                    </div>
                                                <?php }elseif (is_array($pinfo)){ ?>
                                                    <?php foreach ($pinfo as $v) {?>
                                                        <?php echo $v[0];?>：
                                                        <span><?php echo $v[1];?></span>
                                                    <?php }?>
                                                <?php }?>
                                        <?php } ?>
                                    </div>
                                    <?php if ($output['order_info']['if_buyer_cancel']) { ?>
                                        <div class="anniu hide">
                                            <li>
                                                <a href="javascript:void(0)" style="color:#F30; text-decoration:underline;" nc_type="dialog" dialog_width="480" dialog_title="<?php echo $lang['member_order_cancel_order'];?>" dialog_id="buyer_order_cancel_order" uri="index.php?model=member_order&fun=change_state&state_type=order_cancel&order_id=<?php echo $output['order_info']['order_id']; ?>"  id="order_action_cancel"><?php echo $lang['member_order_cancel_order'];?></a>
                                            </li>
                                        </div>


                                    <?php } ?>

                                    <?php if($output['order_info']['if_deliver']){?>
                                    <div class="anniu">
                                        <li>
                                            <a href="<?php echo urlShop('member_order','search_deliver',['order_id'=>$output['order_info']['order_id'],'order_sn'=>$output['order_info']['order_sn']]);?>">Logistics</a>
                                        </li>
                                    </div>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--中间内容结束-->













<script type="text/javascript">
$(function(){
    $('#show_shipping').on('hover',function(){
    	$.getJSON('index.php?model=member_order&fun=get_express&e_code=<?php echo $output['order_info']['express_info']['e_code']?>&shipping_code=<?php echo $output['order_info']['shipping_code']?>&t=<?php echo random(7);?>',function(data){
    		if(data){
    			data = data.join('<br/>');
    			$('#shipping_ul').html('<li>'+data+'</li>');
    			$('#show_shipping').unbind('hover');
    		}else{
    			$('#shipping_ul').html(var_send);
    			$('#show_shipping').unbind('hover');
    		}
    	});
    });
});
</script> 
