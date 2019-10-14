<?php defined('interMarket') or exit('Access Invalid!');?>




<!--当前位置结束-->
<div class="order_nav title clearfix">
    <span class="management_title">Return management</span>
</div>
<div class="info_tab dis_b text-center">

    <div class="inner_ct">
        <div class="shoplist clearfix">
            <?php if (is_array($output['return_list']) && !empty($output['return_list'])) { ?>
            <?php foreach ($output['return_list'] as $key => $val) { ?>
            <div class="item">
                <div class="imgb">
                    <a href="<?php echo urlShop('goods','index',array('goods_id'=> $val['goods_id']));?>" target="_blank">
                        <img src="<?php echo thumb($val,60);?>" onMouseOver="toolTip('<img src=<?php echo thumb($val,60);?>>')" onMouseOut="toolTip()"/>
                    </a>
                </div>
                <p class="txt">

                    <a href="<?php echo urlShop('goods','index',array('goods_id'=> $val['goods_id']));?>" class="dot-ellipsis dot-height-40 is-truncated" style="overflow-wrap: break-word;">
                        <?php echo $val['goods_name']; ?>
                    </a>
                    <br><strong>Order number : </strong><?php echo $val['refund_sn']; ?><br>
                    <strong>Application time : </strong><?php echo date("Y-m-d H:i:s",$val['add_time']);?><br>
                </p>
                <div class="price_box">
                    <p class="padding-left-7_5"><span class="lb">Status : </span>
                        <span class="red_pri"><?php echo $output['state_array'][$val['seller_state']]; ?></span>
                    </p>
                </div>
                <?php if($val['seller_state'] == 2 && $val['return_type'] == 2 && $val['goods_state'] == 1) { ?>
                    <p>
                        <a href="<?php echo urlShop('member_return','ship',array('return_id'=> $val['refund_id']));?>" class="deatil">Return goods</a>
                    </p>
                <?php } else { ?>
                    <a href="<?php echo urlShop('member_return','view',array('return_id'=> $val['refund_id']));?>" class="deatil">deatil</a>
                <?php } ?>
                <?php if($val['seller_state'] == 2 && $val['return_type'] == 2 && $val['goods_state'] == 3) { ?>
                    <p>
                        <a href="javascript:void(0)" class="ncbtn ncbtn-bittersweet" nc_type="dialog" dialog_title="delay time" dialog_id="return_delay" dialog_width="480"
                          uri="<?php echo urlShop('member_return','delay',array('return_id'=> $val['refund_id']));?>"> delayed </a></p>
                <?php } ?>

            </div>
                <?php } ?>
                <div class="page margin-top-25"><?php echo $output['show_page'];?></div>

            <?php } else { ?>

                <div class="info_tab dis_b text-center min_height_450">
                    <div style="padding:191px 0;">
                        <p style="font-size: 16px;font-weight: 700;margin:0 20px 15px 20px;">There are no returns associated with this account.</p>
                        <a class="go_right" href="<?php echo BASE_SITE_URL;?>">Go shopping</a>
                    </div>
                </div>
            <?php } ?>


        </div>
    </div>
</div>




<script type="text/javascript">
	$(function(){
	    $('#add_time_from').datepicker({dateFormat: 'yy-mm-dd'});
	    $('#add_time_to').datepicker({dateFormat: 'yy-mm-dd'});
	});
</script>
