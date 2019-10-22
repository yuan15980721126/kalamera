<?php defined('interMarket') or exit('Access Invalid!');?>

<div class="order_nav evaluate_  clearfix">
    <div class="fl" style="margin-top: 13px;margin-left: 10px;">
        <div class="order_li orderli_active" id="order_li1">
            <a href="<?php echo urlMember('member_voucher','voucher_list');?>">
                My Coupon
            </a>
        </div>
        <div class="order_li" id="order_li2">
            <a href="<?php echo urlMember('member_voucher','voucher_binding');?>">
                Collect coupons
            </a>
        </div>
    </div>
    <div class="form fr">
        <form id="voucher_list_form" method="get" >
            <input type="hidden" id='act' name='act' value='member_voucher' />
            <input type="hidden" id='op' name='op' value='voucher_list' />
            <select name="select_detail_state" class="sear_select">
                <option value="0" <?php if (!$_GET['select_detail_state'] == '0'){echo 'selected=true';}?>> <?php echo $lang['voucher_voucher_state']; ?> </option>
                <?php if (!empty($output['voucherstate_arr'])){?>
                    <?php foreach ($output['voucherstate_arr'] as $k=>$v){?>
                        <option value="<?php echo $k;?>" <?php if ($_GET['select_detail_state'] == $k){echo 'selected=true';}?>> <?php echo $v;?> </option>
                    <?php }?>
                <?php }?>
            </select>
            <input class="sear_btn" type="submit" value="<?php echo $lang['nc_search'];?>" >
        </form>
    </div>
</div>
<?php if (count($output['list'])>0) { ?>
    <div class="info_tab dis_b clearfix">
<table class="table table-hover coupon_table">
    <tbody>
    <tr>
        <th>NO.</th>
        <th>Name</th>
        <th><?php echo $lang['voucher_voucher_indate'];?></th>
        <th><?php echo $lang['voucher_voucher_state'];?></th>
        <th><?php echo $lang['nc_handle'];?></th>
    </tr>

        <?php foreach($output['list'] as $val) { ?>
        <tr>
            <td><?php echo $val['voucher_id'];?></td>
            <td> <a href="javascript:void(0);"><img src="<?php echo $val['voucher_t_customimg'];?>" onMouseOver="toolTip('<img src=<?php echo $val['voucher_t_customimg'];?>>')" onMouseOut="toolTip()" style="width:60px;height:57px;  "/></a>
                <?php echo $val['voucher_title'];?>
                <?php echo $lang['voucher_voucher_usecondition_desc'].$val['voucher_limit'].'dollar';?>
            </td>
            <td><?php echo $val['voucher_price'];?></td>
            <td>
                <p><?php echo date("Y-m-d",$val['voucher_start_date']);?> start</p>
                <p><?php echo date("Y-m-d",$val['voucher_end_date']);?> end</p>
            </td>
            <td>
                <?php if ($val['voucher_state'] == '1'){?>
                    <a href="<?php echo urlShop('index', 'index');?>" class="btn-mint">
                        <!-- <i class="icon-shopping-cart"></i> -->
                        <p>Immediate use</p></a>
                <?php } elseif ($val['voucher_state'] == '2'){?>
                    <a href="<?php echo urlShop('member_order', 'show_order', array('order_id' => $val['voucher_order_id']))?>"><p><?php echo $lang['voucher_voucher_vieworder'];?></p></a>
                <?php } else{?>
                    <a href="<?php echo urlMember('member_voucher', 'voucher_binding');?>" class="btn-mint">
                        <p>Collect coupons</p></a>
                <?php }?>
            </td>


        </tr>
        <?php }?>


    </tbody>
</table>
    <div class="page margin-top-25"><?php echo $output['show_page'];?></div>
    </div>
<?php } else { ?>
    <div class="info_tab dis_b text-center min_height_450">
        <div style="padding:191px 0;">
            <p style="font-size: 16px;font-weight: 700;margin:0 20px 15px 20px;">You do not have a coupon associated with this account  .</p>
            <a class="go_right" href="<?php echo BASE_SITE_URL; ?>">Go shopping</a>
        </div>
    </div>
<?php } ?>

