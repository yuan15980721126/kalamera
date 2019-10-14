var order_id,order_goods_id,goods_pay_price,goods_num;
$(function(){
	var key = getCookie('key');
	if(!key){
		window.location.href = WapSiteUrl+'/tmpl/member/login.html';
	}
    $.getJSON(ApiUrl + '/index.php?model=member_refund&fun=refund_form',{key:key,order_id:getQueryString('order_id'),order_goods_id:getQueryString('order_goods_id')}, function(result) {
    	console.log(result);
        result.datas.WapSiteUrl = WapSiteUrl;
        $('#order-info-container').html(template.render('order-info-tmpl',result.datas));
        
        order_id = result.datas.order.order_id;
        order_goods_id = result.datas.goods.order_goods_id;
        
        // 退款原因
	    var _option = '';
	    for (var k in result.datas.reason_list) {
	        _option += '<option value="' + result.datas.reason_list[k].reason_id + '">' + result.datas.reason_list[k].reason_info + '</option>'
	    }
	    $('#refundReason').append(_option);
	    
	    var rehtml="";
	     for (var k in result.datas.reason_list) {
	        rehtml +='<div><div>'+result.datas.reason_list[k].reason_info +'</div><div><input type="radio" name="res_style"  data-reason="'+result.datas.reason_list[k].reason_info +'" value="'+result.datas.reason_list[k].reason_id +'"  /></div></div>'
	    }
	    
	    $("#reson_ .cont_s").html(rehtml);
	    
	    
	    // 可退金额
	    goods_pay_price = result.datas.goods.goods_pay_price;
	    $('input[name="refund_amount"]').val(goods_pay_price);
	    $('#returnAble').html('￥'+goods_pay_price);
	    
	    // 可退数量
	    goods_num = result.datas.goods.goods_num;
	    $('input[name="goods_num"]').val(goods_num);
        $('#goodsNum').html('最多' + goods_num + '件');
	    
	    // 图片上传
        $('input[name="refund_pic"]').ajaxUploadImage({
            url : ApiUrl + "/index.php?model=member_refund&fun=upload_pic",
            data:{key:key},
            start :  function(element){
                element.parent().after('<div class="upload-loading"><i></i></div>');
                element.parent().siblings('.pic-thumb').remove();
            },
            success : function(element, result){
                checkLogin(result.login);
                if (result.datas.error) {
                    element.parent().siblings('.upload-loading').remove();
                    $.sDialog({
                        skin:"red",
                        content:'图片尺寸过大！',
                        okBtn:false,
                        cancelBtn:false
                    });
                    return false;
                }
                element.parent().after('<div class="pic-thumb"><img src="'+result.datas.pic+'"/></div>');
                element.parent().siblings('.upload-loading').remove();
                element.parents('a').next().val(result.datas.file_name);
            }
        });
        $('.btn-l').click(function(){
            var _form_param = $('form').serializeArray();
            var param = {};
            param.key = key;
            param.order_id = order_id;
            param.order_goods_id = order_goods_id;
            param.refund_type = 2;
            for (var i=0; i<_form_param.length; i++) {
                param[_form_param[i].name] = _form_param[i].value;
            }
            if(param.reason_id == ''){
                 $.sDialog({
                     skin:"red",
                     content:'退货原因不能为空',
                     okBtn:false,
                     cancelBtn:false
                 });
                 return false;
            }
         if (isNaN(parseFloat(param.refund_amount)) || parseFloat(param.refund_amount) > parseFloat(goods_pay_price) || parseFloat(param.refund_amount) == 0) {
             $.sDialog({
                 skin:"red",
                 content:'退款金额不能为空，或不能超过可退金额',
                 okBtn:false,
                 cancelBtn:false
             });
             return false;
         }
            if (param.buyer_message.length == 0) {
                $.sDialog({
                    skin:"red",
                    content:'请填写退款说明',
                    okBtn:false,
                    cancelBtn:false
                });
                return false;
            }
//          if (isNaN(param.goods_num) || parseInt(param.goods_num) == 0 || parseInt(param.goods_num) > parseInt(goods_num)) {
//              $.sDialog({
//                  skin:"red",
//                  content:'退货数据不能为空，或不能超过可退数量',
//                  okBtn:false,
//                  cancelBtn:false
//              });
//              return false;
//          }
            // 退货申请提交
            $.ajax({
                type:'post',
                url:ApiUrl+'/index.php?model=member_refund&fun=refund_post',
                data:param,
                dataType:'json',
                async:false,
                success:function(result){
                    checkLogin(result.login);
                    if (result.datas.error) {
                        $.sDialog({
                            skin:"red",
                            content:result.datas.error,
                            okBtn:false,
                            cancelBtn:false
                        });
                        return false;
                    }
                    window.location.href = WapSiteUrl + '/tmpl/member/member_return.html';
                }
            });
        });
    });
    
    
    
    $("#sq_type").click(function(){
    	$("#lx").show();
	   });
    $("#tui_sq").click(function(){
    	var get_;
		$.each($("#lx input[name='tui_type']"), function() {
			var _this=$(this);
			if($(this).prop("checked")==true){
				// get_=_this.val();
                get_=_this.data("val");
			}
		});    	
    	

    	$("#in_type").val(get_);
    	$("#lx").hide();
    });
    
    
    
    
//  $("#in_ly").click(function(){
//  	$("#fs").show();
//  });
//  
//  $(".tui_ly").click(function(){
//  	var get_;
//		$("#in_ly input[name='tui_style']")
//		$.each($("input[name='tui_style']"), function() {
//			if($(this).prop("checked",true)){
//				get_=$(this).val();
//			}
//		});    	
//  	
//
//  	$("#in_type").val(get_);
//  	$("#lx").hide();
//  });
    
     $("#tui_c").click(function(){
    	$("#fs").show();
	   });
    $("#tui_ly").click(function(){
    	var get_;
		$.each($("#fs input[name='tui_style']"), function(){
			
			
			var _this=$(this);
			if($(this).prop("checked")==true){
				get_=_this.val();
			}
		});    	
    	
		if(get_==undefined){
			get_=""
			
		}
    	$("#in_ly").val(get_);
    	$("#fs").hide();
    });
    
});


  $("#reson_btn").click(function(){
    	$("#reson_").show();
	   });
    $("#tui_reson").click(function(){
    	var get_;
		$.each($("#reson_ input[name='res_style']"), function(){
			
			
			var _this=$(this);
			if($(this).prop("checked")==true){
                // get_=_this.data("reason");
				get_=_this.val();
			}
		});    	
    	
		if(get_==undefined){
			get_=""
			
		}
    	$("#reson_in").val(get_);
    	$("#reson_").hide();
    });
    

    $("#jine_in").click(function(){
    	$("#jine_").show();
	   });
    $("#tui_reson").click(function(){
    	var get_,put_;
		$.each($("#reson_ input[name='res_style']"), function(){
			
			
			var _this=$(this);
			if($(this).prop("checked")==true){
				put_=_this.val();
                get_=_this.data("reason");
			}
		});    	
    	
		if(get_==undefined){
			get_=""
			
		}
        $("#reason_id").val(put_);
    	$("#reson_in").val(get_);
    	$("#reson_").hide();
    });
















