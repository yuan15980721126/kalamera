$(function(){
	var key = getCookie('key');
	if(!key){
		window.location.href = WapSiteUrl+'/tmpl/member/login.html';
	}
    $.getJSON(ApiUrl + '/index.php?model=member_order&fun=order_info',{key:key,order_id:getQueryString('order_id')}, function(result) {
        // console.log(result);
    	result.datas.order_info.WapSiteUrl = WapSiteUrl;
    	$('#order-info-container').html(template.render('order-info-tmpl',result.datas.order_info));

        // 取消
        $(".cancel-order").click(cancelOrder);
        // 收货
        $(".sure-order").click(sureOrder);
        // 评价
        $(".evaluation-order").click(evaluationOrder);
        // 追评
        $('.evaluation-again-order').click(evaluationAgainOrder);
        // 全部退款
        $('.all_refund_order').click(allRefundOrder);
        // 部分退款
        $('.goods-refund').click(goodsRefund);
        // 退货
        $('.goods-return').click(goodsReturn);

        $('.viewdelivery-order').click(viewOrderDelivery);
        $.ajax({
            type: 'post',
            url: ApiUrl + "/index.php?model=member_order&fun=get_current_deliver",
            data:{key:key,order_id:getQueryString("order_id")},
            dataType:'json',
            success:function(result) {
                //检测是否登录了
                checkLogin(result.login);

                var data = result && result.datas;
                if (data.deliver_info) {
                    $("#delivery_content").html(data.deliver_info.context);
                    $("#delivery_time").html(data.deliver_info.time);               	
                }
            }
        });
    });
    
    
    //取消订单
    function cancelOrder(){
        var order_id = $(this).attr("order_id");

        $.sDialog({
            content: '确定取消订单？',
            okFn: function() { cancelOrderId(order_id); }
        });
    }

    function cancelOrderId(order_id) {
        $.ajax({
            type:"post",
            url:ApiUrl+"/index.php?model=member_order&fun=order_cancel",
            data:{order_id:order_id,key:key},
            dataType:"json",
            success:function(result){
                if(result.datas && result.datas == 1){
                	window.location.reload();
                }
            }
        });
    }

    //确认订单
    function sureOrder(){
        var order_id = $(this).attr("order_id");

        $.sDialog({
            content: '确定收到了货物吗？',
            okFn: function() { sureOrderId(order_id); }
        });
    }

    function sureOrderId(order_id) {
        $.ajax({
            type:"post",
            url:ApiUrl+"/index.php?model=member_order&fun=order_receive",
            data:{order_id:order_id,key:key},
            dataType:"json",
            success:function(result){
                if(result.datas && result.datas == 1){
                    window.location.reload();
                }
            }
        });
    }
    // 评价
    function evaluationOrder() {
        var orderId = $(this).attr('order_id');
        location.href = WapSiteUrl + '/tmpl/member/member_evaluation.html?order_id=' + orderId;
        
    }
    // 追加评价
    function evaluationAgainOrder() {
        var orderId = $(this).attr('order_id');
        location.href = WapSiteUrl + '/tmpl/member/member_evaluation_again.html?order_id=' + orderId;
    }
    // 全部退款
    function allRefundOrder() {
        var orderId = $(this).attr('order_id');
        location.href = WapSiteUrl + '/tmpl/member/refund_all.html?order_id=' + orderId;
    }
    // 查看物流
    function viewOrderDelivery() {
        var orderId = $(this).attr('order_id');
        location.href = WapSiteUrl + '/tmpl/member/order_delivery.html?order_id=' + orderId;
    }
    // 退款
    function goodsRefund() {
        var orderId = $(this).attr('order_id');
        var orderGoodsId = $(this).attr('order_goods_id');
        location.href = WapSiteUrl + '/tmpl/member/refund.html?order_id=' + orderId +'&order_goods_id=' + orderGoodsId;
    }
    // 退货
    function goodsReturn() {
        var orderId = $(this).attr('order_id');
        var orderGoodsId = $(this).attr('order_goods_id');
        location.href = WapSiteUrl + '/tmpl/member/return.html?order_id=' + orderId +'&order_goods_id=' + orderGoodsId;
    }
    
	if($(".order-state").html()=="待付款"){
		$("#order-info-container #pay_or_ag").html(1)		
		
	}
    
    $('#order-info-container').on('click','.agan_buy', function(){
        var reid = $(this).data('cid');
        // console.log();reid.indexOf(","));
        var name = $(this).data('yuanname');
        var yuanlai = name.split(",");
        // for (var i = 0; i <= yuanlai.length-1; i++) {
        //     zaicicart(ss[i]);
        // };
        if(isNaN(reid)){
            var ss = reid.split(",");
            for (var i = 0; i <= ss.length-1; i++) {
                zaicicart(ss[i],yuanlai[i]);
            };
            
        }else{
            var ss = reid;
            zaicicart(ss);
        }
    });

    //再次购买
    function zaicicart(id,name){
        $.ajax({
            url:ApiUrl+"/index.php?model=member_cart&fun=cart_add",
            data:{key:key,goods_id:id,quantity:1},
            type:"post",
            success:function (result){
                var rData = $.parseJSON(result);
                if(checkLogin(rData.login)){
                    if(!rData.datas.error){
                        // show_tip();
                        // 更新购物车中商品数量
                        delCookie('cart_count');
                        getCartCount();
                        // errorTipsShow('<p>加入购物车成功</p>');
                        $('#cart_count,#cart_count1').html('<sup>'+getCookie('cart_count')+'</sup>');
                        $.sDialog({
                            skin:"red",
                            content:'加入购物车成功',
                            okBtn:false,
                            cancelBtn:false
                        });
                    }else{
                        // errorTipsShow('<p>'+rData.datas.error+'</p>');
                        $.sDialog({
                            skin:"red",
                            content:name+rData.datas.error,
                            okBtn:false,
                            cancelBtn:false
                        });
                    }
                }
            }
        })
    }
    
    
    
    
    
    
});