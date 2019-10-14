<?php defined('interMarket') or exit('Access Invalid!');?>
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/home_cart.css" rel="stylesheet" type="text/css">
<style type="text/css">
.head-search-layout,
.head-user-menu,
.public-nav-layout,
.head-app { display: none !important; }
.bshare-custom  {z-index: 1000;}
</style>
<link rel="stylesheet" href="/skins/default/css/shopcar.css" />
<script type="text/javascript" src="<?php echo SHOP_RESOURCE_SITE_URL;?>/js/pgoods_cart.js" charset="utf-8"></script>



<div id="shopcar">
    <div id="car">
      <?php if (is_array($output['cart_array']) && count($output['cart_array'])>0){ ?>
        <div id="head">
            <div><?php echo $lang['pointcart_cart_chooseprod_title']; ?>
                 <h5>查看兑换清单，增加减少礼品数量，进入下一步操作。</h5>
            </div>
            <div id="progress">
                <ul>
                    <li id="mycar">
                        <div>
                        </div>
                        <i></i>
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
        </div>
    
            <div id="table" class="new_table">
                <div id="table_head">
                    <ul class="table_row">
                       
                        <li><?php echo $lang['pointcart_goodsname']; ?> </li>
                        <li><?php echo $lang['pointcart_exchangepoint']; ?> </li>
                        <li><?php echo $lang['pointcart_exchangenum']; ?> </li>
                        <li><?php echo $lang['pointcart_pointoneall']; ?> </li>
                        <li><?php echo $lang['pointcart_cart_handle']; ?> </li>
                    </ul>
                </div>
                <div id="table_body">
                    <?php foreach ($output['cart_array'] as $k=>$v){ ?>
                    <ul id="pcart_item_<?php echo $v['pcart_id']; ?>" class="table_row">
                    
                        <li class="pro_info">
                            <div>
                                <a href="<?php echo urlShop('pointprod', 'pinfo', array('id' => $v['pgoods_id']));?>" target="_blank" class="ncc-goods-thumb"><img src="<?php echo $v['pgoods_image_small']; ?>" alt="<?php echo $v['pgoods_name']; ?>"/></a>
                            </div>
                            <div><a href="<?php echo urlShop('pointprod', 'pinfo', array('id' => $v['pgoods_id']));?>" target="_blank"><?php echo $v['pgoods_name']; ?></a></div>
                        </li>

                        <li><?php echo $v['pgoods_points']; ?></li>
                        
                        <li class="range">
                            <div>
                                <a href="javascript:;" class="r_down" onclick="pcart_decrease_quantity(<?php echo $v['pcart_id']; ?>);" title="<?php echo $lang['pointcart_cart_reduse'];?>">-</a>
                             <input id="input_item_<?php echo $v['pcart_id']; ?>" value="<?php echo $v['pgoods_choosenum']; ?>" changed="<?php echo $v['pgoods_choosenum']; ?>" onkeyup="pcart_change_quantity('<?php echo $v['pcart_id']; ?>', this);" class="" type="text" style="text-align:center;"/>

                           <!--      <div id="input_item_<?php echo $v['pcart_id']; ?>" class="r_count"><?php echo $v['pgoods_choosenum']; ?></div> -->
                                <a href="javascript:;" class="r_add" onclick="pcart_add_quantity(<?php echo $v['pcart_id']; ?>);" title="<?php echo $lang['pointcart_cart_increase'];?>">+</a>
                            </div>
                        </li>
                        <li class="nub"><em id="item_<?php echo $v['pcart_id']; ?>_subtotal" class="goods-subtotal"><?php echo $v['pgoods_pointone']; ?></em></li>
                        <li class="del">
                            <a class="del" href="javascript:void(0)" onclick="drop_pcart_item(<?php echo $v['pcart_id']; ?>);"><?php echo $lang['pointcart_cart_del']; ?></a>
                        </li>
                    </ul>
  
                <?php } ?>
                </div>
                <div id="table_bottom">
                    
                    
                    <div id="b_r">
                        <div class="cost">
                            <span><?php echo $lang['pointcart_cart_allpoints']; ?>&nbsp;:&nbsp;</span>
                            <span id="pcart_amount"><?php echo $output['pgoods_pointall']; ?></span><?php echo $lang['points_unit']; ?>
                        </div>
                    
                        <a id="result" href="index.php?model=pointcart&fun=step1" class="ncc-next-submit ok"><?php echo $lang['pointcart_cart_submit']; ?></a>
                        
                        
                    </div>
                    
                    
                </div>

            

        </div>
            

    </div>

  <?php } else { ?>
  <div class="ncc-null-shopping"><i class="ico-gift"></i>
    <h4><?php echo $lang['pointcart_cart_null'];?></h4>
    <p><a href="index.php?model=pointprod" class="ncbtn-mini mr10"><i class="icon-reply-all"></i><?php echo $lang['pointcart_cart_exchangenow'];?></a> <a href="<?php echo MEMBER_SITE_URL;?>/index.php?model=member_pointorder" class="ncbtn-mini"><i class="icon-file-text"></i><?php echo $lang['pointcart_cart_exchanged_list'];?></a></p>
  </div>
  <?php } ?>    





