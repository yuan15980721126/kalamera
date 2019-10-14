<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/home_cart.css" rel="stylesheet" type="text/css">
<style type="text/css">
.head-search-layout,
.head-user-menu,
.public-nav-layout,
.head-app { display: none !important; }
</style>
<link rel="stylesheet" href="/skins/default/css/success.css" />
<div id="d_success">
            <div id="suc_content">
                <div id="indent_head">
                    <div class="indent_title">
                        确认订单信息
                    </div>
<!-- <div id="indent"> -->

            <!-- <div id="indent_content">
                <div id="indent_head">
                    <div class="indent_title">
                        确认订单信息
                    </div> -->
                <div id="progress">
                    <ul>
                        <li id="mycar">
                            <div>
                            </div>
                            </li>
                            <li class="pr">
                                <div></div>
                            </li>
                            <li id="affirm">
                                <div></div>
                            </li>
                            <li class="pr">
                                <div></div>
                            </li>
                            <li id="success">
                                <div></div>
                            </li>
                    </ul>
                    <div>
                        <span><?php echo $lang['pointcart_ensure_order'];?></span>
                        <span><?php echo $lang['pointcart_ensure_info'];?></span>
                        <span><?php echo $lang['pointcart_exchange_finish'];?></span>
                    </div>
                    
                </div>
           <div></div>
</div>
        <div id="suc_tip">
                    <div class="tip_title"><?php echo $lang['pointcart_exchange_finish'];?></div>
                    <div>
                        <div >兑换订单已提交完成，祝您购物愉快</div>
                    </div>
                    
                    <div id="bot_tip">
                        <div><span>订单编号：</span> <?php echo $output['order_info']['point_ordersn']; ?></div>
                        <div><?php echo $lang['pointcart_step2_order_allpoints'].$lang['nc_colon'];?><span><?php echo $output['order_info']['point_allpoint']; ?></span></div>
                        <div></div>&nbsp;&nbsp;&nbsp;
                        <a class="ncbtn-mini ncbtn-mint mr15" href="<?php echo SHOP_SITE_URL?>"><i class="icon-shopping-cart"></i>继续购物</a> 
                        <a class="ncbtn-mini ncbtn-aqua" href="<?php echo MEMBER_SITE_URL;?>/index.php?model=member_pointorder&fun=order_info&order_id=<?php echo $output['order_info']['point_orderid'];?>"><i class="icon-file-text-alt"></i><?php echo $lang['pointcart_step2_view_order'];?></a>
                    </div>
                     <div class="duihuan">
                        <div class="zixn">可通过用户中心<a href="<?php echo MEMBER_SITE_URL;?>/index.php?model=member_pointorder&fun=orderlist">积分兑换记录</a>查看兑换单状态。 </div>
                    </div>

        </div>
    </div>
</div>







<!-- <div class="wrapper pr">

  <div class="ncc-main">
    <div class="ncc-title">
      <h3><?php echo $lang['pointcart_exchange_finish'];?></h3>
      <h5>兑换订单已提交完成，祝您购物愉快</h5>
    </div>
    <div class="ncc-receipt-info mb30">
      <div class="ncc-finish-a"><i></i><?php echo $lang['pointcart_step2_order_created'];?> <span class="all-points"><?php echo $lang['pointcart_step2_order_allpoints'].$lang['nc_colon'];?><em><?php echo $output['order_info']['point_allpoint']; ?></em></span> </div>
      <div class="ncc-finish-b">可通过用户中心<a href="<?php echo MEMBER_SITE_URL;?>/index.php?model=member_pointorder&fun=orderlist">积分兑换记录</a>查看兑换单状态。 </div>
      <div class="ncc-finish-c mb30"> <a class="ncbtn-mini ncbtn-mint mr15" href="<?php echo SHOP_SITE_URL?>"><i class="icon-shopping-cart"></i>继续购物</a> <a class="ncbtn-mini ncbtn-aqua" href="<?php echo MEMBER_SITE_URL;?>/index.php?model=member_pointorder&fun=order_info&order_id=<?php echo $output['order_info']['point_orderid'];?>"><i class="icon-file-text-alt"></i><?php echo $lang['pointcart_step2_view_order'];?></a></div>
    </div>
  </div>
</div>
 -->