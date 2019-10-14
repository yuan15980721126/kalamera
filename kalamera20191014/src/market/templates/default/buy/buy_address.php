<?php defined('interMarket') or exit('Access Invalid!');?>

<div id="select">

    <!--编辑地址--> 
    <form method="POST" id="addr_form1" action="index.php">
    <input type="hidden" value="buy" name="model">
    <input type="hidden" value="edit_add" name="fun">
    <input type="hidden" name="form_submit" value="ok"/>
    <div id="save_harvest">

    </div>  


    <!--新增收货地址-->
    
        <div id="add_harvest">
    </div>

    



    


    <div class="select_head">选择收货信息</div>
    <div id="info_table">
   <!--  <form method="POST" id="addr_form" action="index.php">
    <input type="hidden" value="buy" name="model">
    <input type="hidden" value="add_addr" name="fun">
    <input type="hidden" name="form_submit" value="ok"/> -->
    <?php if(!empty($output['address_list'])) {?>
        <ul id="address_list">
        <?php foreach ($output['address_list'] as $k => $v) {?>
            <li <?php if($v['is_default'] == 1){?>class="info_current"<?php } ?> id="li_<?php echo $v['address_id'];?>">
                <div class="info_name"><?php echo $v['true_name'];?></div>
                <div class="info_address">
                    <?php echo $v['area_info']?><?php echo $v['address'];?>
                </div>
                <div class="info_phone">
                    <?php echo $v['mob_phone'];?>
                </div>
                <div class="info_email">
                     <?php echo $v['zipcode'];?>
                </div> 
                <div class="table_btn">
                    <a class="i_address" id="moren_<?php echo $v['address_id'];?>" href="javascript:;" >默认地址</a>
                    <a class="i_amend" href="javascript:;" onclick="edit_address(<?php echo $v['address_id']?>,'save')">修改</a>
                    <a class="i_del" href="javascript:;" onclick="delAddr(<?php echo $v['address_id']?>);">删除</a>
                </div>
                <input type="hidden" value="<?php echo $v['address_id']?>" name="city_id" class="daddress_id" />
                <input type="hidden" value="<?php echo $v['member_id']?>" name="area_id" class="dmember_id" />
            </li>
                
        <?php } ?>


                            
        </ul>
    <?php } ?>
        <input type="hidden" name="city_id" id="_area_2" />
        <input type="hidden" name="area_id" id="_area" />
    </div>
    <a href="javascript:;" id="addtable" onclick="edit_address('add')"></a>
</div>

























<!-- <div class="ncc-receipt-info">
  <div class="ncc-receipt-info-title">
    <h3>收货人信息</h3>
    <a href="javascript:void(0)" nc_type="buy_edit" id="edit_reciver">[修改]</a></div>
  <div id="addr_list" class="ncc-candidate-items">
    <ul>
      <li><span class="true-name"><?php echo $output['address_info']['true_name'];?></span><span class="address"><?php echo $output['address_info']['area_info'],$output['address_info']['address'];?></span><span class="phone"><i class="icon-mobile-phone"></i><?php echo $output['address_info']['mob_phone'] ? $output['address_info']['mob_phone'] : $output['address_info']['tel_phone'];?></span></li>
    </ul>
  </div>
</div> -->
<script type="text/javascript">
$('#huan').click(function(){
    $('#zjy').hide();
    $('#sqs').show();
    $('._area_2').remove();
    $('._area').remove();
})
function delAddr(id){
    // $('#addr_list').load(SITEURL+'/index.php?model=buy&fun=load_addr&ifchain=<?php echo $_GET['ifchain'];?>&id='+id);
    if(confirm("是否确认删除")){
        $.get(SITEURL + '/index.php?model=buy&fun=load_addr', {'id':id,'status':'3'}, function(data){
            if(data.state == 'success') {
                var child = '#li_'+id;
                // console.log(data);
                $('#address_list').children(child).remove();
            } else {
                showDialog('系统出现异常', 'error','','','','','','','','',2);
            }

        },'json');
    }
}
function edit_address(address_id, type,obj) {
    if(obj.hasClass('cancel_btn')){
        obj.text('Cancel');
        obj.removeClass('cancel_btn')
    }else{
        obj.text('Eidt');
        obj.addClass('cancel_btn')
    }
    obj.parent('.btn_box').siblings('.addr_edit').slideToggle();
    if (type == 'save') {
        var edit = obj.parent().siblings('.addr_edit')
        // console.log(obj.parent().siblings('.addr_edit'))

        edit.load(SITEURL + '/index.php?model=buy&fun=edit_addr&type=' + type + '&address_id=' + address_id);
        // $(".addr_edit").show();
    } else {
        $('#add_harvest').load(SITEURL + '/index.php?model=buy&fun=add_addr');
        $("#add_harvest").show();
    }
}
// function edit_address(address_id,type) {
//
//     if(type == 'save'){
//         $('#save_harvest').load(SITEURL+'/index.php?model=buy&fun=edit_addr&type='+type+'&address_id='+address_id);
//         $("#save_harvest").show();
//     }else{
//         $('#add_harvest').load(SITEURL+'/index.php?model=buy&fun=add_addr');
//         $("#add_harvest").show();
//     }
//
// }

        


//加载收货地址列表
$('#edit_reciver').on('click',function(){
    $(this).hide();
    disableOtherEdit('如需修改，请先保存收货人信息 ');
    $(this).parent().parent().addClass('current_box');
    var url = SITEURL+'/index.php?model=buy&fun=load_addr';
    <?php if ($output['ifshow_chainpay']) { ?>
    url += '&ifchain=1';
    <?php } ?>
    $('#addr_list').load(url);
});
//异步显示每个店铺运费 city_id计算运费area_id计算是否支持货到付款
//function showShippingPrice(city_id,area_id) {
//	$('#buy_city_id').val('');
//    // console.log(city_id,area_id);
//    $.post(SITEURL + '/index.php?model=buy&fun=change_addr', {'freight_hash':'<?php //echo $output['freight_hash'];?>//',city_id:city_id,'area_id':area_id}, function(data){
//    	if(data.state == 'success') {
//            console.log(data);
//    	    $('#buy_city_id').val(city_id ? city_id : area_id);
//    	    $('#allow_offpay').val(data.allow_offpay);
//            if (data.allow_offpay_batch) {
//                var arr = new Array();
//                $.each(data.allow_offpay_batch, function(k, v) {
//                    arr.push('' + k + ':' + (v ? 1 : 0));
//                });
//                $('#allow_offpay_batch').val(arr.join(";"));
//            }
//    	    $('#offpay_hash').val(data.offpay_hash);
//    	    $('#offpay_hash_batch').val(data.offpay_hash_batch);
//    	    var content = data.content;var tpl_ids = data.no_send_tpl_ids;
//    	    no_send_tpl_ids = [];no_chain_goods_ids = [];
//            for(var i in content){
//                if (content[i] !== false) {
//                    // console.log(number_format(content[i],2));
//             	   $('#eachStoreFreight_'+i).html(number_format(content[i],2));
//                } else {
//                	no_send_store_ids[i] = true;
//                }
//            }
//            for(var i in tpl_ids){
//            	no_send_tpl_ids[tpl_ids[i]] = true;
//            }
//            calcOrder();
//    	} else {
//    		showDialog('系统出现异常', 'error','','','','','','','','',2);
//    	}
//
//    },'json');
//}

//根据门店自提站ID计算商品是否有库存（有库存即支持自提）
function showProductChain(city_id) {
	$('#buy_city_id').val('');
    var product = [];
	$('input[name="goods_id[]"]').each(function(){
		product.push($(this).val());
	});
	$.post(SITEURL+'/index.php?model=buy&fun=change_chain',{chain_id:chain_id,product:product.join('-')},function(data){
		if (data.state == 'success') {
			$('#buy_city_id').val(city_id);
			$('em[nc_type="eachStoreFreight"]').html('0.00');
			no_send_tpl_ids = [];no_chain_goods_ids = [];
			if (data.product.length > 0) {
	            for (var i in data.product) {
	            	no_chain_goods_ids[data.product[i]] = true;
	            }
			}
			calcOrder();
		} else {
			showDialog('系统出现异常', 'error','','','','','','','','',2);
		}
	},'json');
}
$(function(){
    <?php if (!empty($output['address_info']['address_id'])) {?>
    showShippingPrice(<?php echo $output['address_info']['city_id'];?>,<?php echo $output['address_info']['area_id'];?>);
    <?php } else {?>
    $('#edit_reciver').click();
    <?php }?>
});

function submitAddAddr(){
    // $('#input_chain_id').val('');chain_id = '';
    if ($('#addr_form1').valid()){
        // $('#buy_city_id').val($('#region').fetch('area_id_2'));
        var datas=$('#addr_form1').serialize();
        $.post('index.php',datas,function(data){
            if (data.state){
                var true_name = $.trim($("#true_name").val());
                var tel_phone = $.trim($("#tel_phone").val());
                var mob_phone = $.trim($("#mob_phone").val());
                var area_info = $.trim($("#region").val());
                var address = $.trim($("#address").val());
                showShippingPrice($('#region').fetch('area_id_2'),$('#region').fetch('area_id'));
                hideAddrList(data.addr_id,true_name,area_info+'&nbsp;&nbsp;'+address,(mob_phone != '' ? mob_phone : tel_phone));
            }else{
                alert(data.msg);
            }
        },'json');
    }else{
        return false;
    }
}
$('#save_address').on('click',function(){
        // if ($('input[nc_type="addr"]:checked').val() == '0' || $('input[nc_type="addr"]:checked').val() == '-1'){
            submitAddAddr();
        // } else {
            // if ($('input[nc_type="addr"]:checked').size() == 0) {
            //     return false;
            // }
            var city_id = $('input[name="addr"]:checked').attr('city_id');
            var area_id = $('input[name="addr"]:checked').attr('area_id');
            var addr_id = $('input[name="addr"]:checked').val();
            var true_name = $('input[name="addr"]:checked').attr('true_name');
            var address = $('input[name="addr"]:checked').attr('address');
            var phone = $('input[name="addr"]:checked').attr('phone');
            // console.log(city_id,area_id);
            // window.load()
            if (chain_id != '') {
                showProductChain(city_id ? city_id : area_id);
            } else {
                showShippingPrice(city_id,area_id);
            }
            // hideAddrList(addr_id,true_name,address,phone);
        // }
    });

$(document).ready(function(){
    $("#region").nc_region();
    $("#region1").nc_region();
    $('#addr_form').validate({
        errorPlacement: function(error, element){
            var error_td = element.parent('dd');
            // console.log(error);
            var text = error[0].innerText;
            // if(element.attr( "id" ) == 'captcha'){
            //     console.log(text);
            //     $('#captcha_tip').text(text);
            //      $('#captcha_tip').show();
            // }
            var msg = $( element ).parent().next();
            msg.text(text);
            msg.show();
            window.t=$( element )
            // $( element ).closest( "form" ).find( "div tips[for='" + element.attr( "id" ) + "']" ).append( error );
            // error_td.append(error);
            // element.parents('dl:first').addClass('error');

            // $(element).removeClass("error");
            // $('#error_tip').show();
            // $('#error_tip').text(error[0].innerText);  ;  
        },
        rules : {
            true_name : {
                required : true
            },
            region : {
                checklast: true
            },
            address : {
                required : true
            },
            mob_phone : {
                required : checkPhone,
                minlength : 11,
                maxlength : 11,
                digits : true
            },
            tel_phone : {
                required : checkPhone,
                minlength : 6,
                maxlength : 20
            }
        },
        messages : {
            true_name : {
                required : '<i class="icon-exclamation-sign"></i><?php echo $lang['cart_step1_input_receiver'];?>'
            },
            region : {
                checklast: '<i class="icon-exclamation-sign"></i>请将地区选择完整'
            },
            address : {
                required : '<i class="icon-exclamation-sign"></i><?php echo $lang['cart_step1_input_address'];?>'
            },
            mob_phone : {
                required : '<i class="icon-exclamation-sign"></i><?php echo $lang['cart_step1_telphoneormobile'];?>',
                minlength: '<i class="icon-exclamation-sign"></i><?php echo $lang['cart_step1_mobile_num_error'];?>',
                maxlength: '<i class="icon-exclamation-sign"></i><?php echo $lang['cart_step1_mobile_num_error'];?>',
                digits : '<i class="icon-exclamation-sign"></i><?php echo $lang['cart_step1_mobile_num_error'];?>'
            },
            tel_phone : {
                required : '<i class="icon-exclamation-sign"></i><?php echo $lang['cart_step1_telphoneormobile'];?>',
                minlength: '<i class="icon-exclamation-sign"></i><?php echo $lang['member_address_phone_rule'];?>',
                maxlength: '<i class="icon-exclamation-sign"></i><?php echo $lang['member_address_phone_rule'];?>'
            }
        },
        groups : {
            phone:'mob_phone tel_phone'
        }
    });
    
});
function checkPhone(){
    return ($('input[name="mob_phone"]').val() == '' && $('input[name="tel_phone"]').val() == '');
}
</script>