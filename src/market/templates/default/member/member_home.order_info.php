<?php defined('interMarket') or exit('Access Invalid!');?>

<!--全部订单-->
									
<div id="all_table">
  <div id="table_nav">
    <ul>
      <li class="current">全部订单</li>
      <li>待支付</li>
      <li>待收货</li>
    </ul>
  </div>
  
  <div >
    <ul id="temp_li">
      <!-- 这里需要循环把几个状态的订单列表(start)  -->
      <li class="temp_show">
        <div id="tab_row">

          <?php foreach($output['order_list'] as $k => $order_info) { ?>
          <!--代付款-->
          <div class="tb_row">
            <div class="goods_img">
              <div>
                <a target="_blank" href="<?php echo urlShop('member_order','show_order',array('order_id'=>$order_info['order_id'])); ?>">
                  <img src="<?php echo thumb($order_info['extend_order_goods'][0],60); ?>" />
                </a>
                <em style='display:none'>
                  <?php echo count($order_info['extend_order_goods'])>1 ? count($order_info['extend_order_goods']) : null;?>
                </em>
              </div>
            </div>
            <div class="goods_infos">
              <!--<div style='display:none;'>订单已提交，等待付款</div>-->
              <div>订单号：<?php echo $order_info['order_sn']; ?></div>
              <div><?php echo date('Y-m-d H:i:s',$order_info['add_time']);?></div>
            </div>
            <div class="goods_status"><?php echo orderState($order_info);?></div>
            <div class="cost">&yen;<?php echo $order_info['order_amount'];?></div>

            <?php if ($order_info['if_payment']) {?>
              <div class="comment"></div>
              <div class="lastge pay">
                <div>
                  <a href="index.php?model=member_order&fun=show_order&order_id=<?php echo $order_info['order_id'];?>" target="_blank" class="ncbtn ncbtn-mint">
                    查看详情
                  </a>
                </div>
                <div class="wait_pay">
                  <a href="index.php?model=buy&fun=pay&pay_sn=<?php echo $order_info['pay_sn'];?>" target="_blank" class="ncbtn ncbtn-bittersweet">
                    立即支付
                  </a>
                </div>
              </div>
            <?php } ?>
            <?php if ($order_info['if_receive']) { ?>
              <div class="comment"></div>
              <div class="lastge pay">
                <div>
                  <a href="index.php?model=member_order&fun=show_order&order_id=<?php echo $order_info['order_id'];?>" target="_blank" class="ncbtn ncbtn-mint">
                    查看详情
                  </a>
                </div>
                <div class="wait_pay">
                  <a href="<?php echo urlShop('member_order','show_order',array('order_id'=>$order_info['order_id'])); ?>" target="_blank" class="ncbtn ncbtn-mint">
                    确认收货
                  </a>
                </div>
              </div>
            <?php } ?>
            <?php if ($order_info['if_evaluation']) { ?>
              <div class="comment">
                <a href="index.php?model=member_evaluate&fun=add&order_id=<?php echo $order_info['order_id']; ?>" target="_blank" class="ncbtn ncbtn-mint">
                  评价
                </a>
              </div>
              <div class="lastge handle">
                <div><a href="indentinfo.html">再次购买</a></div>
                <div>
                  <a href="index.php?model=member_order&fun=show_order&order_id=<?php echo $order_info['order_id'];?>" target="_blank" class="ncbtn ncbtn-mint">
                    查看详情
                  </a>
                </div>
                <div><a href="exchange.html">申请退货</a></div>
              </div>
            <?php } ?>
            <?php if (!$order_info['if_payment'] && !$order_info['if_receive'] && !$order_info['if_evaluation']) {?>
              <div class="comment"></div>
              <div class="lastge pay">
                <div class="wait_pay">
                  <a href="index.php?model=member_order&fun=show_order&order_id=<?php echo $order_info['order_id'];?>" target="_blank" class="ncbtn ncbtn-mint">
                    查看订单
                  </a>
                </div>
              </div>
            <?php } ?>

            <div class="all_order hidden">
              <a href="/shop/index.php?model=member_order">查看所有订单</a>
            </div>
            
          </div>
          <?php } ?>
          <?php if (empty($output['order_list'])) { ?>
          <div class="tb_row null-tip">
              <h4>您好久没在商城购物了</h4>
              <h5>交易提醒可帮助您了解订单状态和物流情况</h5>
          </div>
          <?php } ?>
        
      </li>
      <!-- 这里需要循环把几个状态的订单列表(end)  -->
    </ul>
  </div>
</div>
