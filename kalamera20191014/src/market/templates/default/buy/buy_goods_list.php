<?php defined('interMarket') or exit('Access Invalid!');?>


<div id="goods_info">
   <!--  <div class="goods_head">
        商品信息
    </div> -->
    <?php if (!empty($output['store_mansong_rule_list'][1])) {?>
          <div class="ncc-store-sale ms"> <span>满即送</span><?php echo $output['store_mansong_rule_list'][1]['desc'];?> </div>
    <?php } ?>

    <div id="goods_form">
        <div id="thead">
            <div class="goods_name">商品信息</div>
            <!-- <div class="integral">积分</div> -->
            <div class="cost"><?php echo $lang['cart_index_price'].'('.$lang['currency_zh'].')';?></div>
            <!-- <div class="discounts">优惠</div> -->
            <div class="nub"><?php echo $lang['cart_index_amount'];?></div>
            <div class="count"><?php echo $lang['cart_index_sum'].'('.$lang['currency_zh'].')';?></div>
        </div>

    <div id="jjg-valid-skus-tpl" style="display:none;">
      <tr class="bundling-list">
        <td class="tree td-border-left"><input name="jjg[]" type="hidden" value="%jjgId%|%jjgLevel%|%id%" /></td>
        <td><a class="ncc-goods-thumb" href="%url%" target="_blank"> <img alt="%name%" data-src="%imgUrl%" /> </a></td>
        <td class="tl"><dl class="ncc-goods-info">
            <dt> <a href="%url%" target="_blank">%name%</a> </dt>
            <dd class="ncc-goods-gift"><span>已选换购</span></dd>
          </dl></td>
        <td><em class="goods-price">%jjgPrice%</em></td>
        <td>1</td>
        <td class="td-border-right"><em nc_type="eachGoodsTotal" class="goods-subtotal"> %jjgPrice% </em></td>
      </tr>
    </div>

    
        <div id="tbody">
        <?php foreach($output['store_cart_list'] as $store_id => $cart_list) {?>
            <?php foreach($cart_list as $cart_info) {?>


            <?php if ($cart_info['state'] && $cart_info['storage_state']) {?>
              <input type="hidden" value="<?php echo $cart_info['cart_id'].'|'.$cart_info['goods_num'];?>" store_id="<?php echo $store_id?>" name="cart_id[]">
              <input type="hidden" value="<?php echo $cart_info['goods_id'].'|'.$cart_info['goods_num'];?>" store_id="<?php echo $store_id?>" name="goods_id[]">
            <?php } ?>

            <div class="t_row">
                <div class="goods_name">
                    <div>
                        <a href="<?php echo urlShop('goods','index',array('goods_id'=>$cart_info['goods_id']));?>" target="_blank" class="thumb" title="<?php echo $cart_info['goods_name']; ?> * $cart_info['goods_num']; ?>"><img src="<?php echo cthumb($cart_info['goods_image'],60,$cart_info['store_id']);?>" alt="<?php echo $cart_info['goods_name']; ?>"/></a> 
                    </div>
                    <!-- <div>
                        <?php echo $cart_info['goods_name']; ?>
                    </div> -->
                    <div>
                        <?php echo $cart_info['goods_name']; ?>
                    </div>
                    <?php if (!empty($cart_info['xianshi_info'])) {?>
                    <div>
                        <dl class="ncc-goods-sale">
                            <dt class="biaos">商家促销</dt>
                            <dd>
                                <p>活动名称：限时折扣</p>
                                <p>满<strong><?php echo $cart_info['xianshi_info']['lower_limit'];?></strong>件，单价直降<em>￥<?php echo $cart_info['xianshi_info']['down_price']; ?></em></p>
                            </dd>
                        </dl>
                    </div>
                    <?php } ?>
                    <?php if ($cart_info['ifgroupbuy']) {?>
                    <div>
                        <dl class="ncc-goods-sale">
                            <dt class="biaos">商家促销</i></dt>
                            <dd>
                              <p>活动名称：抢购</p>
                              <?php if ($cart_info['upper_limit']) {?>
                              <p>最多限购：<strong><?php echo $cart_info['upper_limit']; ?></strong>件 </p>
                              <?php } ?>
                            </dd>
                        </dl>
                    </div>
                    <?php } ?>
                    <?php if ($cart_info['jjgRank'] > 0) {?>
                    <div>
                        <dl class="ncc-goods-sale">
                            <dt class="biaos">商家促销<i class="icon-angle-down"></i></dt>
                            <dd>
                              <p>活动名称：加价购</p>
                              <p>活动满金额，加价购买更多优惠商品。</p>
                            </dd>
                        </dl>
                    </div>
                    <?php } ?>

                    <?php if ($cart_info['user_discount'] > 0 && $cart_info['user_discount'] != '100') {?>
                    <div>
                        <dl class="ncc-goods-sale">
                            <dt class="biaos">会员折扣</dt>
                            <dd>
                              <p>享<?php echo $cart_info['user_discountdesc']; ?>折优惠</p>
                              <!-- <p>活动满金额，加价购买更多优惠商品。</p> -->
                            </dd>
                        </dl>
                    </div>
                    <?php } ?>
                   

                </div>
              
                <div class="cost">&yen;<?php echo $cart_info['goods_price'];?><?php if($cart_info['goods_total_discount']){echo 'x '.$cart_info['user_discountdesc'];}  ?></div>
            
                <?php /*?>
                <?php if ((!empty($cart_info['xianshi_info']) || $cart_info['ifgroupbuy'] || $cart_info['jjgRank'] > 0)){?>
                    <?php if (!empty($cart_info['xianshi_info'])) {?> 
                    <div class="discounts">
                        限时折扣
                    </div>
                    <?php } ?>
                    
                    <?php if ($cart_info['ifgroupbuy']) {?>
                    <div class="discounts">
                        <?php if ($cart_info['upper_limit']) {?>
                        最多限购：<?php echo $cart_info['upper_limit']; ?>件 
                        <?php } ?>
                    </div>
                    <?php } ?>

                    <?php if ($cart_info['jjgRank'] > 0) {?>
                        <div class="discounts">
                            <div class="biaos">加价购</div>
                        </div>
                    <?php } ?>

                <?php }else{ ?>
                    <div class="discounts">
                        <div>无</div>
                    </div>
                <?php } ?>

                <?php */?>
                <?php if ($cart_info['state'] && $cart_info['storage_state']) {?>
                    <div class="discounts" style="color: #F00;display:none">
                        <em cart_id="<?php echo $cart_info['cart_id']; ?>" goods_id="<?php echo $cart_info['goods_id'];?>" nc_type="eachGoodsTotal<?php echo $store_id?>" tpl_id="<?php echo $cart_info['transport_id']?>" class="goods-subtotal"><?php echo $cart_info['goods_total']; ?></em> <span id="no_send_tpl_<?php echo $cart_info['transport_id']?>" style="color: #F00;display:none">无货</span>
                    </div>

                <?php } elseif (!$cart_info['storage_state']) {?>
                    <div class="discounts" style="color: #F00;display:none">
                        <div class="biaos">库存不足</div>
                    </div>
                <?php } elseif (!$cart_info['state']) {?>
                    <div class="discounts" style="color: #F00;display:none">
                        <div class="biaos">无效</div>
                    </div>
                <?php }else{ ?>
                    <div class="discounts" style="color: #F00;display:none">
                        <div>无</div>
                    </div>
                <?php } ?>
                <div class="nub"><?php echo $cart_info['state'] ? $cart_info['goods_num'] : ''; ?></div>

                <div class="count"><?php if ($cart_info['state'] && $cart_info['storage_state']) {?>
                <em cart_id="<?php echo $cart_info['cart_id']; ?>" goods_id="<?php echo $cart_info['goods_id'];?>" nc_type="eachGoodsTotal<?php echo $store_id?>" tpl_id="<?php echo $cart_info['transport_id']?>" class="goods-subtotal"><?php if($cart_info['goods_total_discount']){echo $cart_info['goods_total_discount'];}else{echo $cart_info['goods_total'];} ?></em> 
                
               <!--  <span id="no_send_tpl_<?php echo $cart_info['transport_id']?>" style="color: #F00;display:none">无货</span>
                <?php } elseif (!$cart_info['storage_state']) {?>
                  <span style="color: #F00;">库存不足</span>
                  <?php } elseif (!$cart_info['state']) {?>
                  <span style="color: #F00;">无效</span>
                  <?php }?></td> -->

                 </div>

                                 
            </div>
            <?php if (!empty($cart_info['gift_list'])) { ?>
            <div class="t_row">
                <?php foreach ($cart_info['gift_list'] as $goods_info) { ?>
                <div class="goods_name">
                    <div>
                        <a href="<?php echo urlShop('goods','index',array('goods_id'=>$goods_info['gift_goodsid']));?>" target="_blank" class="thumb" title="赠品：<?php echo $goods_info['gift_goodsname']; ?> * <?php echo $goods_info['gift_amount'] * $cart_info['goods_num']; ?>"><img src="<?php echo cthumb($goods_info['gift_goodsimage'],60,$store_id);?>" alt="<?php echo $goods_info['gift_goodsname']; ?>"/></a>
                    </div>
                    <div> <?php echo $goods_info['gift_goodsname']; ?></div>

                    <div class="biaos">赠品</div>
                    </div>
                                 
                </div>
                <?php } ?> 
            </div>
            </div>
            <?php } ?>
        <?php } ?>
        </div> 

        
    <?php } ?>
    





        <div id="tfooter">
            <div id="footer_info">
                <?php if ($output['store_mansong_rule_list'][$store_id]['discount'] > 0) {?>
                <div>
                  <span>店铺优惠：</span>
                  <span class="rule"><?php echo $output['store_mansong_rule_list'][$store_id]['desc'];?></span>
                  <span class="sum"><em id="eachStoreManSong_<?php echo $store_id;?>" class="subtract">-<?php echo $output['store_mansong_rule_list'][$store_id]['discount'];?></em></span>
                </div>
                <?php } ?>
                <div><span><?php echo $output['total_num'];?></span> 件商品</div>
                    <div>
                        <span>商品总金额：</span>
                        <span id="eachStoreGoodsTotal_<?php echo $store_id;?>"><?php echo $output['store_goods_total'][$store_id];?></span>
                    </div>
                    <div>
                        <span>配送费：</span>
                        <span class="rule">
                            <?php if (!empty($output['cancel_calc_sid_list'][$store_id])) {?>
                            <?php echo $output['cancel_calc_sid_list'][$store_id]['desc'];?>
                            <?php } ?>
                        </span>
                        <span class="sum"><em nc_type="eachStoreFreight" id="eachStoreFreight_<?php echo $store_id;?>">0.00</em></span>

                    </div>
                    <div>
                        <span>合计：</span>
                        <span >
                            <em store_id="<?php echo $store_id;?>" nc_type="eachStoreTotal"></em>
                           <!--  <em><?php echo $output['store_goods_total'][$store_id];?>
                            </em> --> 
                        </span>
                    </div>
                </div>
            </div>
            <div id="pho">


                        <!-- S voucher list -->
                        <?php if (!empty($output['store_voucher_list'][$store_id]) && is_array($output['store_voucher_list'][$store_id])) {?>
                        <div class="user_dis">
                            <div class="d_head">
                                <div class="add_show"></div>
                                <div>使用优惠券</div>
                            </div>
                            <div class="dis_tab" id="lab1">
                                <div>
                                    <div>以下是此订单可用的优惠券。 您可以<span>查看所有优惠券</span>了解使用限制。</div>
                                    <div class="rad">
                                    <select nctype="voucher" name="voucher[<?php echo $store_id;?>]" class="select">
                                      <option value="<?php echo $voucher['voucher_t_id'];?>|<?php echo $store_id;?>|0.00">-选择使用店铺代金券-</option>
                                      <?php foreach ($output['store_voucher_list'][$store_id] as $voucher) {?>
                                      <option value="<?php echo $voucher['voucher_t_id'];?>|<?php echo $store_id;?>|<?php echo $voucher['voucher_price'];?>"><?php echo $voucher['desc'];?></option>
                                      <?php } ?>
                                    </select>
                                    <div class="sum"><em id="eachStoreVoucher_<?php echo $store_id;?>" class="subtract">-0.00</em></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- E voucher list -->
                        <?php } ?>
                          
                        
                        <!--添加订单备注-->
                        <div class="user_dis">
                            <div class="d_head">
                                <div class="add_show"></div>
                                    <div>添加订单备注</div>
                            </div>
                            <div class="dis_tab">
                                <div>
                                    <div class="serach">
                                        <input type="text" placeholder="限150字" name="pay_message[<?php echo $store_id;?>]" class="ncc-msg-textarea" placeholder="选填：对本次交易的说明（建议填写已经和商家达成一致的说明）" title="选填：对本次交易的说明（建议填写已经和商家达成一致的说明）"  maxlength="150"/>
                                    </div>
                                    <div class="dis_text">
                                        提示：请勿填写有关支付、收货信息。
                                    </div>
                                    
                                    
                                    
                                </div>
                            </div>
                        </div>



                        <?php include template('buy/buy_invoice');?>
                    



                        <a id="return_car" href="index.php?model=cart" ><i class="icon-angle-left"></i><?php echo $lang['cart_step1_back_to_cart'];?></a>
                    </div>
                        
                        
                        
                        
                        
                        <div id="z_footer">
                            <div>
                                <div>
                                    <div>应付总额 :</div>
                                    <span><em id="orderTotal">....</font></em><?php echo $lang['currency_zh'];?></span>
                                </div>
                                <div id="tj_btn">提交订单</div>


                            
                            </div>
                            
                        </div>

    </div>
                    
                    
                    
                    
                </div>
                
                
                
                
            </div>
                
                    
            
            
            
            
        </div>






<script>
function submitNext(){
	if (!SUBMIT_FORM) return;

	if ($('input[name="cart_id[]"]').size() == 0) {
		showDialog('所购商品无效', 'error','','','','','','','','',2);
		return;
	}
    if ($('#address_id').val() == ''){
		showDialog('<?php echo $lang['cart_step1_please_set_address'];?>', 'error','','','','','','','','',2);
		return;
	}
	if ($('#buy_city_id').val() == '') {
		showDialog('正在计算运费,请稍后！', 'error','','','','','','','','',2);
		return;
	}
	if ($('input[name="fcode"]').size() == 1 && $('#fcode_callback').val() != '1') {
		showDialog('请输入并使用F码！', 'error','','','','','','','','',2);
		return;
	}
	if (no_send_tpl_ids.length > 0 || no_chain_goods_ids.length > 0) {
		showDialog('有部分商品配送范围无法覆盖您选择的地址，请更换其它商品！', 'error','','','','','','','','',4);
		return;
	}
	SUBMIT_FORM = false;
 	$('#order_form').submit();
}

//计算总运费和每个店铺小计
function calcOrder() {
    allTotal = 0;
    $('em[nc_type="eachStoreTotal"]').each(function(){
        store_id = $(this).attr('store_id');
        var eachTotal = 0;
        $('em[nc_type="eachGoodsTotal'+store_id+'"]').each(function(){
        	if (no_send_tpl_ids[$(this).attr('tpl_id')]) {
     		    $(this).next().show();
     		    $('#cart_item_'+$(this).attr('cart_id')).addClass('item_disabled');
     		} else {
         		if (no_chain_goods_ids[$(this).attr('goods_id')]){
         		    $(this).next().show();
         		    $('#cart_item_'+$(this).attr('cart_id')).addClass('item_disabled');
             	} else {
         		    $(this).next().hide();
           		    $('#cart_item_'+$(this).attr('cart_id')).removeClass('item_disabled');
                }
     		}
        });

        if ($('#eachStoreGoodsTotal_'+store_id).length > 0) {
        	eachTotal += parseFloat($('#eachStoreGoodsTotal_'+store_id).html());
	    }
        if ($('#eachStoreManSong_'+store_id).length > 0) {
        	eachTotal += parseFloat($('#eachStoreManSong_'+store_id).html());
	    }
        if ($('#eachStoreVoucher_'+store_id).length > 0) {
        	eachTotal += parseFloat($('#eachStoreVoucher_'+store_id).html());
        }
        if ($('#eachStoreFreight_'+store_id).length > 0) {
        	eachTotal += parseFloat($('#eachStoreFreight_'+store_id).html());
	    }
        $('.repair_prices').each(function () {
            repair_price +=  parseFloat($(this).val())
        });
        $('#repair_price_'+store_id).html(repair_price)
        if ($('#repair_price_'+store_id).length > 0) {
            eachTotal += parseFloat($('#repair_price_'+store_id).html());
        }

        if ($('#tax_price_'+store_id).length > 0) {
            eachTotal += parseFloat($('#tax_price_'+store_id).html());
        }
        // console.log(eachTotal);
        allTotal += eachTotal;
        $(this).html(eachTotal.toFixed(2));
    });
    
    if ($('#orderRpt').length > 0) {
    	iniRpt(allTotal.toFixed(2));
    	$('#orderRpt').html('-0.00');
    }
     // console.log(allTotal);
    $('#orderTotal').html(allTotal.toFixed(2));
    $('#tj_btn').on('click',function(){submitNext()}).addClass('ok');
}
$(function() {
    var tpl = $('#jjg-valid-skus-tpl').html();
    var jjgValidSkus = <?php echo json_encode($output['jjgValidSkus']); ?>;

    $footers = {};
    $('[data-jjg]').each(function() {
        var id = $(this).attr('data-jjg');
        if (!$footers[id]) {
            var $footer = $('<tr><td colspan="20"></td></tr>');
            $footers[id] = $footer;
            $("tr[data-jjg='"+id+"']:last").after($footer);
        }
    });

    $.each(jjgValidSkus || {}, function(k, v) {
        $.each(v || {}, function(kk, vv) {
            var s = tpl.replace(/%(\w+)%/g, function($m, $1) {
                return vv[$1];
            });
            var $s = $(s);
            $s.find('img[data-src]').each(function() {
                this.src = $(this).attr('data-src');
            });
            $footers[k].before($s);
        });
    });
});

</script> 
