<?php defined('interMarket') or exit('Access Invalid!');?>
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/themes/ui-lightness/jquery.ui.css"  />

<div class="wrap">
  <div class="tabmenu">
    <?php include template('layout/submenu');?>
  </div>
  <form method="get" action="index.php" target="_self">
    <table class="ncm-search-table">
      <input type="hidden" name="model" value="member_vr_order" />
      <tr>
        <td>&nbsp;</td>
        <th><?php echo $lang['member_order_state'];?></th>
        <td class="w100"><select name="state_type">
            <option value="" ><?php echo $lang['member_order_all'];?></option>
            <option value="state_new" <?php if($_GET['state_type']=='state_new'){ echo 'selected';}?> >待付款</option>
            <option value="state_pay" <?php if($_GET['state_type']=='state_pay'){ echo 'selected';}?> >已付款</option>
            <option value="state_success" <?php if($_GET['state_type']=='state_success'){ echo 'selected';}?> >已完成</option>
            <option value="state_cancel" <?php if($_GET['state_type']=='state_cancel'){ echo 'selected';}?> >已取消</option>
          </select></td>
        <th><?php echo $lang['member_order_time'];?></th>
        <td class="w240"><input type="text" class="text w70" name="query_start_date" id="query_start_date" value="<?php echo $_GET['query_start_date']; ?>"/><label class="add-on"><i class="icon-calendar"></i></label>&nbsp;&#8211;&nbsp;<input type="text" class="text w70" name="query_end_date" id="query_end_date" value="<?php echo $_GET['query_end_date']; ?>"/><label class="add-on"><i class="icon-calendar"></i></label></td>
        <td class="w240 tr"><input type="text" class="text w200" placeholder="输入商品标题或订单号进行search" name="keyword" value="<?php echo $_GET['keyword']; ?>"></td>
        <td class="w70 tc"><label class="submit-border">
            <input type="submit" class="submit" value="<?php echo $lang['nc_search'];?>"/>
          </label></td>
      </tr>
    </table>
  </form>
  <table class="ncm-default-table order">
    <thead>
      <tr>
        <th class="w10"></th>
        <th colspan="2">商品</th>
        <th class="w100">单价 (元)</th>
        <th class="w40">数量</th>
        <th class="w100">售后</th>
        <th class="w120">订单金额</th>
        <th class="w100">交易状态</th>
        <th class="w120">交易操作</th>
      </tr>
    </thead>
    <tbody>
      <?php if(!empty($output['order_list'])){ ?>
      <?php foreach($output['order_list'] as $order_info) { ?>
      <tr>
		<td class="sep-row" colspan="19"></td>
	  </tr>
      <tr>
        <th colspan="20"><span class="ml10">订单号：<?php echo $order_info['order_sn'];?>
        &nbsp;<?php if ($order_info['order_from'] == 2){?><i class="icon-mobile-phone"></i><?php }?></span><span>下单时间：<?php echo date("Y-m-d H:i",$order_info['add_time']);?></span><span><a href="<?php echo urlShop('show_store','index',array('store_id'=>$order_info['store_id']));?>" title="<?php echo $order_info['store_name'];?>"><?php echo $order_info['store_name'];?></a></span>

        <!-- QQ -->
          <span member_id="<?php echo $order_info['extend_store']['member_id'];?>">
          <?php if(!empty($order_info['extend_store']['store_qq'])){?>
          <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $order_info['extend_store']['store_qq'];?>&site=qq&menu=yes" title="QQ: <?php echo $order_info['extend_store']['store_qq'];?>"><img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo $order_info['extend_store']['store_qq'];?>:52" style=" vertical-align: middle;"/></a>
          <?php }?>

          <!-- wang wang -->
          <?php if(!empty($order_info['extend_store']['store_ww'])){?>
          <a target="_blank" href="http://amos.im.alisoft.com/msg.aw?v=2&uid=<?php echo $order_info['extend_store']['store_ww'];?>&site=cntaobao&s=2&charset=<?php echo CHARSET;?>"  class="vm" ><img border="0" src="http://amos.im.alisoft.com/online.aw?v=2&uid=<?php echo $order_info['extend_store']['store_ww'];?>&site=cntaobao&s=2&charset=<?php echo CHARSET;?>" alt="Wang Wang"  style=" vertical-align: middle;"/></a>
          <?php }?>
          </span>

          <!-- share -->
          <?php if($order_info['if_share']){ ?>
          <a href="javascript:void(0)" class="share-goods" nc_type="sharegoods" data-param='{"gid":"<?php echo $order_info['goods_id'];?>"}'><i class="icon-share"></i><?php echo $lang['member_order_snsshare'];?></a>
          <?php } ?>
          </th>
      </tr>
      <tr>
        <td class="bdl"></td>
        <td class="w70"><div class="ncm-goods-thumb"><a href="<?php echo urlShop('goods','index',array('goods_id'=>$order_info['goods_id']));?>" target="_blank" onMouseOver="toolTip('<img src=<?php echo thumb($order_info, 240);?>>')" onMouseOut="toolTip()"/><img src="<?php echo thumb($order_info, 60);?>"/></a></div></td>
        <td class="tl"><dl class="goods-name">
            <dt><a href="<?php echo urlShop('goods','index',array('goods_id'=>$order_info['goods_id']));?>" target="_blank" title="<?php echo $order_info['goods_name'];?>"><?php echo $order_info['goods_name'];?></a><span class="rec"><a target="_blank" href="<?php echo urlShop('vr_snapshot', 'index', array('order_id' => $order_info['order_id']));?>">[交易快照]</a></span></dt>
          <?php if (!empty($order_info['goods_spec'])) { ?>
          <dd><?php echo $order_info['goods_spec'];?></dd>
          <?php } ?>
            <dd>
            <?php if ($order_info['order_promotion_type'] == 1) { ?>
            <span class="sale-type">抢购</span>
            <?php } ?>
            有效期：<?php echo date("Y-m-d",$order_info['vr_indate']);?></dd>
            <!-- S消费者保障服务 -->
            <dd>
              <?php if($order_info["contractlist"]){?>
                <?php foreach($order_info["contractlist"] as $gcitem_v){?>
                  <span <?php if($gcitem_v['cti_descurl']){ ?>onclick="window.open('<?php echo $gcitem_v['cti_descurl'];?>');" style="cursor: pointer;"<?php }?> title="<?php echo $gcitem_v['cti_name']; ?>">
                      <img src="<?php echo $gcitem_v['cti_icon_url_60'];?>" style="width: 20px; height: 20px;"/>
                      </span>
                <?php }?>
              <?php }?>
            </dd>
            <!-- E消费者保障服务 -->
          </dl></td>
        <td><?php echo ncPriceFormat($order_info['goods_price']);?></td>
        <td><?php echo $order_info['goods_num'];?></td>
        <td> <?php if($order_info['if_refund']){ ?>
          <a href="index.php?model=member_vr_refund&fun=add_refund&order_id=<?php echo $order_info['order_id']; ?>">退款</a>
          <?php } ?></td>
        <td class="bdl"><strong><?php echo $order_info['order_amount'];?></strong><p title="<?php echo $lang['member_order_pay_method'].$lang['nc_colon'];?><?php echo $order_info['payment_name']; ?>"><?php echo $order_info['payment_name']; ?></p></td>
        <td class="bdl"><p><?php echo $order_info['state_desc'];?></p>
          <p><a href="index.php?model=member_vr_order&fun=show_order&order_id=<?php echo $order_info['order_id'];?>">订单详情</a></p></td>
        <td class="bdl bdr">

		  <?php if($order_info['if_pay']){ ?>
          <p><a class="ncbtn ncbtn-bittersweet" href="index.php?model=buy_virtual&fun=pay&order_id=<?php echo $order_info['order_id']; ?>"><i class="icon-shield"></i>订单支付</a></p>
          <?php } ?>

          <!--取消订单-->
          <?php if ($order_info['if_cancel']) {?>
          <p class="mt5"><a href="javascript:void(0)" class="ncbtn ncbtn-grapefruit" nc_type="dialog" dialog_width="480" dialog_title="取消订单" dialog_id="buyer_order_cancel_order" uri="index.php?model=member_vr_order&fun=change_state&state_type=order_cancel&order_id=<?php echo $order_info['order_id'];?>"  id="order<?php echo $order_info['order_id'];?>_action_cancel"><i class="icon-ban-circle"></i>取消订单</a></p>
		  <?php } ?>

          <!-- 评价 -->
          <?php if ($order_info['if_evaluation']) { ?>
          <p><a class="ncbtn ncbtn-aqua" href="index.php?model=member_evaluate&fun=add_vr&order_id=<?php echo $order_info['order_id']; ?>"><i class="icon-thumbs-up-alt"></i><?php echo $lang['member_order_want_evaluate'];?></a></p>
          <?php } ?>
          <?php if ($order_info['evaluation_state'] == 1) echo '已评价'; ?>
		  </td>
      </tr>
      <?php }?>
      <?php } else { ?>
      <tr>
        <td colspan="20" class="norecord"><div class="warning-option"><i></i><span><?php echo $lang['no_record'];?></span></div></td>
      </tr>
      <?php } ?>
    </tbody>
    <tfoot>
      <?php  if (!empty($output['order_list'])>0) { ?>
      <tr>
        <td colspan="20"><div class="pagination"><?php echo $output['show_page'];?></div></td>
      </tr>
      <?php } ?>
    </tfoot>
  </table>
</div>
<script charset="utf-8" type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/i18n/zh-CN.js" ></script>
<script charset="utf-8" type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/sns.js" ></script>
<script type="text/javascript">
$(function(){
    $('#query_start_date').datepicker({dateFormat: 'yy-mm-dd'});
    $('#query_end_date').datepicker({dateFormat: 'yy-mm-dd'});
});
</script>
