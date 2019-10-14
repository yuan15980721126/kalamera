
/**
 * 删除购物车
 * @param cart_id
 */
function drop_cart_item(cart_id){
    var jjgId = $('#cart_id' + cart_id).attr('data-jjg') || -1;
    var parent_tr = $('#cart_item_' + cart_id).parent();
    var amount_span = $('#cart_totals');
    showDialog('Do you confirm deletion?', 'confirm', '', function(){
        $.getJSON('index.php?model=cart&fun=del&cart_id=' + cart_id, function(result){
            if(result.state){
                //Delete the success
                if(result.quantity == 0){//判断购物车是否为空
                    window.location.reload();    //刷新
                } else {
                    // $('tr[nc_group="'+cart_id+'"]').remove();//移除本商品或本套装
                    // if (parent_tr.children('tr').length == 2) {//只剩下店铺名头和店铺合计尾，则全部移除
                    //     parent_tr.remove();
                    // }
                    window.location.reload(); 
                    calc_cart_price();
                }
            }else{
                alert(result.msg);
            }
        });
    });
}

/**
 * 更改购物车数量
 * @param cart_id
 * @param input
 */
function change_quantity(cart_id, input){
    var jjgId = $('#cart_id' + cart_id).attr('data-jjg') || -1;
    var subtotal = $('#item' + cart_id + '_subtotal');
    var repair_price = $('#item' + cart_id + '_repair_price');

// console.log(goods_id)
    //暂存为局部变量，否则如果用户输入过快有可能造成前后值不一致的问题
    var _value = input.value;
    $.getJSON('index.php?model=cart&fun=update&cart_id=' + cart_id + '&quantity=' + _value, function(result){
        $(input).attr('changed', _value);
        if(result.state == 'true'){
            $('#item' + cart_id + '_price').html(parseFloat(result.goods_price).toFixed(2));
            subtotal.html(parseFloat(result.subtotal).toFixed(2));
            repair_price.html(parseFloat(result.repair_price).toFixed(2));

            $('#cart_id'+cart_id).val(cart_id+'|'+_value);
            $(input).val(result.goods_num);

            var bl_id = $(input).attr('bl_id');
            $('em[ncType="blnum'+bl_id+'"]').html(result.goods_num);
            $('em[ncType="bltotal'+bl_id+'"]').each(function(){
            	$(this).html((parseFloat($(this).attr('price'))*result.goods_num).toFixed(2));
            });
        }

        if(result.state == 'invalid'){
          subtotal.html(0.00);
          repair_price.html(0.00);
          $('#cart_id'+cart_id).remove();
          $('tr[nc_group="'+cart_id+'"]').addClass('item_disabled');
          $(input).parent().next().html('');
          $(input).parent().removeClass('ws0').html('已下架');
          showDialog(result.msg, 'error','','','','','','','','',3);
        }

        if(result.state == 'shortage'){
          $('#item' + cart_id + '_price').html(parseFloat(result.goods_price).toFixed(2));
          $('#cart_id'+cart_id).val(cart_id+'|'+result.goods_num);
          $(input).val(result.goods_num);
          subtotal.html(parseFloat(result.subtotal).toFixed(2));
          repair_price.html(parseFloat(result.repair_price).toFixed(2));
          showDialog(result.msg, 'error','','','','','','','','',3);
        }

        if(result.state == '') {
            //更新失败
            showDialog(result.msg, 'error','','','','','','','','',2);
            $(input).val($(input).attr('changed'));
        }
        calc_cart_price();
    });
}

/**
 * 购物车减少商品数量
 * @param cart_id
 */
function decrease_quantity(cart_id){
    var item = $('#input_item_' + cart_id);
    var orig = Number(item.val());
    if(orig > 1){
        item.val(orig - 1);
        item.keyup();
    }
}

/**
 * 购物车增加商品数量
 * @param cart_id
 */
function add_quantity(cart_id){
    var item = $('#input_item_' + cart_id);
    var orig = Number(item.val());
    item.val(orig + 1);
    item.keyup();
}

//计算总运费和每个店铺小计
function calcOrder() {
    var goodsTotal = allTotal = goodsCount = repair_price = 0;
    var cart = $('div[nc_type="ncCartGoods"]');
    var store_id = cart.attr('store_id');
    var current = $('#current').val();
    if(store_id == 1){
        cart.find('.buy_list').each(function(){
            goods_id = $(this).attr('id');
            goodsCount += $(this).attr('num')*1;

            if ($(this).attr('goods_total') > 0) {
                allTotal = goodsTotal += parseFloat($(this).attr('goods_total'));
            }

        });
        $('#goodsTotal').html(allTotal.toFixed(2));
        if ($('#eachStoreManSong_'+store_id).length > 0) {
            allTotal += parseFloat($('#eachStoreManSong_'+store_id).html());
        }


        if ($('#eachStoreVoucher_'+store_id).length > 0 && $('#eachStoreVoucher_'+store_id).html() !=='-0.00' ) {
            var voucher_fav_type = $('#voucher_fav_type').val();

            if(voucher_fav_type == 1){
                allTotal += parseFloat($('#eachStoreVoucher_'+store_id).html());
            }else{

                // allTotal = parseFloat(allTotal*$('#eachStoreVoucher_'+store_id).html());



                allTotal += parseFloat($('#eachStoreVoucher_'+store_id).html());
                console.log(allTotal)
            }


        }

        $('.repair_prices').each(function () {
            repair_price +=  parseFloat($(this).val())
        });
        $('#repair_price_'+store_id).html(repair_price);
        if ($('#eachStoreFreight_'+store_id).length > 0) {
            allTotal += parseFloat($('#eachStoreFreight_'+store_id).html());
        }
        if ($('#repair_price_'+store_id).length > 0) {
            allTotal += parseFloat($('#repair_price_'+store_id).html());
        }

        if ($('#tax_price_'+store_id).length > 0) {
            allTotal += parseFloat($('#tax_price_'+store_id).html());
        }

        // $('#goodsCount').html(goodsCount);
        $('span[nctype="eachStoreTotal"]').html('$'+goodsTotal.toFixed(2));


        // if ($('#orderRpt').length > 0) {
        //     iniRpt(allTotal.toFixed(2));
        //     $('#orderRpt').html('-0.00');
        // }

        $('#orderTotal').html(allTotal.toFixed(2));
        //console.log(allTotal.toFixed(2))
        $('#submitOrder').on('click',function(){submitNext()}).removeAttr('disabled');
    }
}
/**
 * 购物车商品统计
 */
var calc_cart_price = (function() {

    var realCalculate = function() {
        //每个店铺商品价格小计
        obj = $('div[nc_type="table_cart"]');
        if(obj.children('div').length==0) return;
        //购物车已选择商品的总价格
        var allTotal = gnum  = 0;
        obj.find('.item').each(function(){
            //购物车每个店铺已选择商品的总价格
            var eachTotal = 0;
            eachTotal = $(this).find('.subtotal').html();
            // eachrmbTotal = $(this).find('.rmb_subtotal').val();
            // if($(this).find('input[type="checkbox"]').prop('checked')){
                allTotal += parseFloat(eachTotal);
                gnum+=$(this).find('.num').val()*1;
            // }
        });
        var repair_price  = 0;
        $('.repair').each(function () {

            repair_price +=  parseFloat($(this).html())
            // var goods_price =  $('#goods_price').val()
            // console.log(repairs_persen)

            // total = price_format(goods_price*repairs_persen)
            // var repair_price = $(this).find(".repair_price");
            // repair_price.html(total)

        });
        // console.log(repair_price)

        if(repair_price){
            allTotal += parseFloat(repair_price);
        }
        console.log(allTotal)
        $('#orderTotal').html('$'+number_format(allTotal,2));
        $('#goods_count').html(gnum);
    };

    window.jjgRecalculator = realCalculate;

    return function(jjgId) {
        // jjg callback
        if (window.jjgCallback) {
            window.jjgCallback(jjgId);
        }
        realCalculate();
    }
})();

$(function(){
    calc_cart_price(0);
    $('#selectAll').on('click',function(){
        if ($(this).attr('checked')) {
            $('input[type="checkbox"]').attr('checked',true);
            $('input[type="checkbox"]:disabled').attr('checked',false);
            if ($('input[nc_type="eachGoodsCheckBox"]:checked').size() > 0) {
            	$('#next_submit').on('click',function(){$('#form_buy').submit();}).addClass('ok');	
            }
        } else {
            $('input[type="checkbox"]').attr('checked',false);
            $('#next_submit').unbind('click').removeClass('ok');
        }
        calc_cart_price(0);
    });
    $('input[nc_type="eachGoodsCheckBox"]').on('click',function(){
        var jjgId = $(this).attr('data-jjg') || -1;
        if (!$(this).attr('checked')) {
            $('#selectAll').attr('checked',false);
            if ($('input[nc_type="eachGoodsCheckBox"]:checked').size() == 0) {
            	$('#next_submit').unbind('click').removeClass('ok');
            }
        } else {
            // 如果都选中 则全选复选框是选中的
            var b = true;
            $('input[nc_type="eachGoodsCheckBox"]').not(this).not(':disabled').each(function() {
                if (!this.checked) {
                    b = false;
                    return false;
                }
            });
            if (b) {
                $('#selectAll').attr('checked', true);
            }
            $('#next_submit').on('click',function(){$('#form_buy').submit();}).addClass('ok');
        }
        calc_cart_price(jjgId);
    });

    $('#next_submit').on('click',function(){
        $('#form_buy').submit()
    }).addClass('ok');
//    $('#next_submit').on('click',function(){
//        if ($(document).find('input[nc_type="eachGoodsCheckBox"]:checked').size() == 0) {
//            showDialog('请选中要结算的商品', 'eror','','','','','','','','',2);
//            return false;
//        }else {
//            $('#form_buy').submit();
//        }
//    });

    // if ($('input[nc_type="eachGoodsCheckBox"]:checked').size() == 0) {
    // 	$('#next_submit').unbind('click');
    // } else {
    // 	$('#next_submit').on('click',function(){$('#form_buy').submit()}).addClass('ok');
    // }


    $('#drop_all').click(function(){
        var cart_id = '';
        $('.item').each(function(){
            var id = $(this).data('value')
            cart_id+= id+',';
        });
        showDialog('Confirm to empty the shopping cart?', 'confirm', '', function(){
            $.ajax({
                type:'get',
                url:SITEURL+'/index.php?model=cart&fun=del_all',
                data:{cart_ids:cart_id},
                dataType:'json',
                success:function(result){
                    console.log(result)
                    if(result.state){
                        //Delete the success
                        if(result.quantity == 0){//判断购物车是否为空
                            window.location.reload();    //刷新
                        }
                    }else{
                        alert(result.msg);
                    }
                }
            });
        });
    });
    // //增加
    // $('a[nctype="increase"]').click(function(){
    //     alert(4545)
    //     var num = parseInt($('#quantity').val());
    //     var max = parseInt($('[nctype="goods_stock"]').text());
    //     if(num < max) $('#quantity').val(num+1);
    // });
    // //减少
    // $('a[nctype="decrease"]').click(function(){
    //     num = parseInt($('#quantity').val());
    //     if(num > 1) $('#quantity').val(num-1);
    // });

});