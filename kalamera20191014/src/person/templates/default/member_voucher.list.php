<?php defined('interMarket') or exit('Access Invalid!');?>
<link rel="stylesheet" href="/skins/default/css/MyCoupon.css" type="text/css"/>

<div class="tabmenu">
    <?php include template('layout/submenu');?>
  </div>
  <form id="voucher_list_form" method="get">
    <table class="ncm-search-table">
      <input type="hidden" id='act' name='act' value='member_voucher' />
      <input type="hidden" id='op' name='op' value='voucher_list' />
      <tr>
        <td>&nbsp;</td>
        <td class="w100 tr"><select name="select_detail_state">
            <option value="0" <?php if (!$_GET['select_detail_state'] == '0'){echo 'selected=true';}?>> <?php echo $lang['voucher_voucher_state']; ?> </option>
            <?php if (!empty($output['voucherstate_arr'])){?>
            <?php foreach ($output['voucherstate_arr'] as $k=>$v){?>
            <option value="<?php echo $k;?>" <?php if ($_GET['select_detail_state'] == $k){echo 'selected=true';}?>> <?php echo $v;?> </option>
            <?php }?>
            <?php }?>
          </select></td>
        <td class="w70 tc"><label class="submit-border">
            <input type="submit" class="submit" value="<?php echo $lang['nc_search'];?>" />
          </label></td>
      </tr>
    </table>
  </form>
<div id="main">
   <!--右侧-->
    <div id="mian_right">
        <div id="mian_tab">
         <!--我的优惠劵-->
            <div id="coupon">
                <!-- <div id="coupon_head">
                    <div class="current">有效优惠券( 2 )</div>
                    <div>无效优惠券(2)</div>
                </div> -->
                <div id="coupon_content">
                    <ul>
                        <?php  if (count($output['list'])>0) { ?>
                        <?php foreach($output['list'] as $val) { ?>
                        <!--有效优惠劵-->
                        <li class="pon_show">
                            <div class="cpn_tablle">
                                <div class="cpn_head">
                                    <div>编号</div>
                                    <div>名称</div>
                                    <div>面额（元）</div>
                                    <!-- <div>使用规则</div> -->
                                    <div><?php echo $lang['voucher_voucher_indate'];?></div>
                                    <div><?php echo $lang['voucher_voucher_state'];?></div>
                                    <div><?php echo $lang['nc_handle'];?></div>
                                </div>
                                <div class="cpn_body">
                                    <div class="cpn_row">
                                        <div><?php echo $val['voucher_id'];?></div>

                                        <div class="coupon_type">
                                            <div><a href="javascript:void(0);"><img src="<?php echo $val['voucher_t_customimg'];?>" onMouseOver="toolTip('<img src=<?php echo $val['voucher_t_customimg'];?>>')" onMouseOut="toolTip()" style="width:60px;height:57px;  "/></a></div>
                                            <div class="voucher_t t_first"><?php echo $val['voucher_title'];?></div>
                                             <div class="voucher_t"><?php echo $lang['voucher_voucher_usecondition_desc'].$val['voucher_limit'].$lang['currency_zh'];?></div>
                                        </div>
                                        <div><?php echo $val['voucher_price'];?></div>
                                       
                                        <div>
                                            <p><?php echo date("Y-m-d",$val['voucher_start_date']);?> 开始</p>
                                            <p><?php echo date("Y-m-d",$val['voucher_end_date']);?> 截止</p>
                                        </div>
                                        <div>
                                            <?php echo $val['voucher_state_text'];?>
                                        </div>
                                         <div>
                                            
                                            <?php if ($val['voucher_state'] == '1'){?>
                                           <a href="<?php echo urlShop('index', 'index');?>" class="btn-mint">
                                           <!-- <i class="icon-shopping-cart"></i> -->
                                           <p>立即使用</p></a>
                                            <?php } elseif ($val['voucher_state'] == '2'){?>
                                          <a href="<?php echo urlShop('member_order', 'show_order', array('order_id' => $val['voucher_order_id']))?>"><p><?php echo $lang['voucher_voucher_vieworder'];?></p></a>
                                          <?php } else{?>
                                          <a href="<?php echo urlMember('member_voucher', 'voucher_binding');?>" class="btn-mint">
                                           <p>重新领券</p></a>
                                          <?php }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php }?>

                        <?php } else { ?>
                            <tr>
                                <td colspan="20" class="norecord"><div class="warning-option"><i>&nbsp;</i><span><?php echo $lang['no_record'];?></span></div></td>
                            </tr>
                        <?php } ?>

                    </ul>
                    </div>
                    <div class="pagination"><?php echo $output['show_page'];?></div>
                </div>  
            </div>
        </div>
    </div>  

        






















 <!-- <div class="wrap">
 <div class="tabmenu">
    <?php include template('layout/submenu');?>
  </div>
  <form id="voucher_list_form" method="get">
    <table class="ncm-search-table">
      <input type="hidden" id='act' name='act' value='member_voucher' />
      <input type="hidden" id='op' name='op' value='voucher_list' />
      <tr>
        <td>&nbsp;</td>
        <td class="w100 tr"><select name="select_detail_state">
            <option value="0" <?php if (!$_GET['select_detail_state'] == '0'){echo 'selected=true';}?>> <?php echo $lang['voucher_voucher_state']; ?> </option>
            <?php if (!empty($output['voucherstate_arr'])){?>
            <?php foreach ($output['voucherstate_arr'] as $k=>$v){?>
            <option value="<?php echo $k;?>" <?php if ($_GET['select_detail_state'] == $k){echo 'selected=true';}?>> <?php echo $v;?> </option>
            <?php }?>
            <?php }?>
          </select></td>
        <td class="w70 tc"><label class="submit-border">
            <input type="submit" class="submit" value="<?php echo $lang['nc_search'];?>" />
          </label></td>
      </tr>
    </table>
  </form> 
  <table class="ncm-default-table">
    <thead>
      <tr>
        <th class="w10"></th>
        <th class="w70"></th>
        <th class="tl">优惠券编码</th>
        <th class="w80">面额（元）</th>
        <th class="w200"><?php echo $lang['voucher_voucher_indate'];?></th>
        <th class="w100"><?php echo $lang['voucher_voucher_state'];?></th>
        <th class="w70"><?php echo $lang['nc_handle'];?></th>
      </tr>
    </thead>
    <tbody>
      <?php  if (count($output['list'])>0) { ?>
      <?php foreach($output['list'] as $val) { ?>
      <tr class="bd-line">
        <td></td>
        <td><div class="ncm-goods-thumb"><a href="javascript:void(0);"><img src="<?php echo $val['voucher_t_customimg'];?>" onMouseOver="toolTip('<img src=<?php echo $val['voucher_t_customimg'];?>>')" onMouseOut="toolTip()" /></a></div></td>
        <td class="tl"><dl class="goods-name">
            <dt><?php echo $val['voucher_code'];?></dt>
            <dd><a href="<?php echo urlShop('show_store', 'index', array('store_id'=>$val['store_id']));?>" title="<?php echo $lang['voucher_voucher_storename'];?>"><?php echo $val['store_name'];?></a>（<?php echo $lang['voucher_voucher_usecondition'];?>：<?php echo $lang['voucher_voucher_usecondition_desc'].$val['voucher_limit'].$lang['currency_zh'];?>）</dd>
          </dl></td>
        <td class="goods-price"><?php echo $val['voucher_price'];?></td>
        <td class="goods-time"><?php echo date("Y-m-d",$val['voucher_start_date']).'~'.date("Y-m-d",$val['voucher_end_date']);?></td>
        <td><?php echo $val['voucher_state_text'];?></td>
        <?php if ($val['voucher_state'] == '1'){?>
        <td class="ncm-table-handle"><span><a href="<?php echo urlShop('show_store', 'index', array('store_id'=>$val['store_id']));?>" class="btn-mint"><i class="icon-shopping-cart"></i><p>使用</p></a></span></td>
        <?php } elseif ($val['voucher_state'] == '2'){?>
        <td class=""><span><a href="<?php echo urlShop('member_order', 'show_order', array('order_id' => $val['voucher_order_id']))?>"><p><?php echo $lang['voucher_voucher_vieworder'];?></p></a><span></td>
        <?php }?>
      </tr>
      <?php }?>
      <?php } else { ?>
      <tr>
        <td colspan="20" class="norecord"><div class="warning-option"><i>&nbsp;</i><span><?php echo $lang['no_record'];?></span></div></td>
      </tr>
      <?php } ?>
    </tbody>
    <?php  if (count($output['list'])>0) { ?>
    <tfoot>
      <tr>
        <td colspan="20"><div class="pagination"><?php echo $output['show_page'];?></div></td>
      </tr>
    </tfoot>
    <?php } ?>
  </table>
</div>
-->