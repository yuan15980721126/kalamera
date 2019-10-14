var key = getCookie('key');

// buy_stop2使用变量
var ifcart = getQueryString('ifcart');
if(ifcart==1){
    var cart_id = getQueryString('cart_id');
}else{
    var cart_id = getQueryString("goods_id")+'|'+getQueryString("buynum");
}
var pay_name = 'online';
var invoice_id = 0;
var address_id,vat_hash,offpay_hash,offpay_hash_batch,voucher,pd_pay,password,fcode='',rcb_pay,rpt,payment_code;
var message = {};
// change_address 使用变量
var freight_hash,city_id,area_id
// 其他变量
var area_info;
var goods_id;
$(function() {
    // 地址列表
    $('#list-address-valve').click(function(){
        $.ajax({
            type:'post',
            url:ApiUrl+"/index.php?model=member_address&fun=address_list", 
            data:{key:key},
            dataType:'json',
            async:false,
            success:function(result){
                // console.log(result);
                checkLogin(result.login);
                if(result.datas.address_list==null){
                    return false;
                }
                var data = result.datas;
                data.address_id = address_id;
                data.freight_hash = freight_hash;
                var html = template.render('list-address-add-list-script', data);
                $("#list-address-add-list-ul").html(html);
            }
        });
    });
    $.animationLeft({
        valve : '#list-address-valve',
        wrapper : '#list-address-wrapper',
        scroll : '#list-address-scroll'
    });
    
    // 地区选择
    $('#list-address-add-list-ul').on('click', 'li', function(){
        $(this).addClass('selected').siblings().removeClass('selected');
        eval('address_info = ' + $(this).attr('data-param'));
        _init(address_info.address_id);
        $('#list-address-wrapper').find('.header-l > a').click();
    });
    
    // 地址新增
    $.animationLeft({
        valve : '#new-address-valve',
        wrapper : '#new-address-wrapper',
        scroll : ''
    });
    
    $("#list-address-scroll").on("click",".bj_btn",function(){
        var address_id1 = ($(this).attr('id')).substring(5);
        $.ajax({
                type:'post',
                url:ApiUrl+"/index.php?model=member_address&fun=address_info",  
                data:{key:key,address_id:address_id1},
                dataType:'json',
                success:function(result){
                    if (!result.datas.error) {
                       $('#edit_vtrue_name').val(result.datas.address_info.true_name);
                       $('#edit_vmob_phone').val(result.datas.address_info.mob_phone);
                       $('#edit_varea_info').val(result.datas.address_info.area_info).attr({'data-areaid':result.datas.address_info.area_id, 'data-areaid2':result.datas.address_info.city_id});
                       $('#edit_vaddress').val(result.datas.address_info.address);
                       $('#address_id2').val(result.datas.address_info.address_id);
                        var _checked = result.datas.address_info.is_default == '1' ? true : false;
                        $('#is_default').prop('checked',_checked);
                        if (_checked) {
                            $('#is_default').parents('label').addClass('checked');
                        }
                    }
                }
            });
    	$.animationLeft({
            valve : $(this),
            wrapper : '#edit-address-wrapper',
            scroll : ''
        });
    	
        
        
    	
    })
    
    $("#list-address-scroll").on("click",".xz_btn",function(){
        var address_id2 = ($(this).attr('id')).substring(6);
        var node = $(this);
        // var city_id = $('#areacity_id').val();
        // var area_id = $('#areaarea_id').val();
        // var freight_hash = $('#freight_list').val();
        // $.ajax({
        //         type:'post',
        //         url:ApiUrl+"/index.php?model=member_buy&fun=change_address",  
        //         data:{key:key,city_id:city_id,area_id:area_id,freight_hash:freight_hash},
        //         dataType:'json',
        //         success:function(result){
        //             console.log(result);
        //             var data_area = '';
        //             if (!result.datas.error) {
        //                 if (result.datas.content.length != 0) {
        //                     for (var k in result.datas.content) {
        //                         data_area =  result.datas.content[k];
        //                     }
        //                 }
        //             }
        //             // .toFixed(2)
        //             console.log(data_area);
        //             insertHtmlAddress(result.datas.address_info, result.datas.address_api);
        //                 // window.location.href = WapSiteUrl + "/tmpl/order/buy_step1.html?ifcart=1&cart_id="+cart_id;
        //                 // param.address_id = result.datas.address_id;
        //                 // _init(param.address_id);
        //                 // $('#new-address-wrapper,#list-address-wrapper').find('.header-l > a').click();
        //             // }
        //         }
        //     });
        $.ajax({
            type:'post',
            url:ApiUrl+"/index.php?model=member_address&fun=address_edit", 
            data:{key:key,address_id:address_id2,is_default:1,default_is:1},
            dataType:'json',
            async:false,
            success:function(result){
                
                // checkLogin(result.login);
                if(result.datas != 1){
                    return false;
                }
                $('.sub_tip').find("sub").remove();
                // console.log(node.parent());
                node.parent().parent().find(".sub_tip").append("<sub>默认</sub>");
                _init(address_id2);
                
            }
        });
        
        
    })
//  编辑修改地址
	
    
    // 支付方式
    $.animationLeft({
        valve : '#select-payment-valve',
        wrapper : '#select-payment-wrapper',
        scroll : ''
    });
    // 地区选择
    $('#new-address-wrapper').on('click', '#varea_info', function(){
        $.areaSelected({
            success : function(data){
                city_id = data.area_id_2 == 0 ? data.area_id_1 : data.area_id_2;
                area_id = data.area_id;
                area_info = data.area_info;
                $('#varea_info').val(data.area_info).attr({'data-areaid':data.area_id, 'data-areaid2':(data.area_id_2 == 0 ? data.area_id_1 : data.area_id_2)});
            }
        });
    });

	 $('#edit-address-wrapper').on('click', '#edit_varea_info', function(){
        $.areaSelected({
            success : function(data){
                city_id = data.area_id_2 == 0 ? data.area_id_1 : data.area_id_2;
                area_id = data.area_id;
                area_info = data.area_info;
                $('#edit_varea_info').val(data.area_info).attr({'data-areaid':data.area_id, 'data-areaid2':(data.area_id_2 == 0 ? data.area_id_1 : data.area_id_2)});
            }
        });
    });



    // 发票
    $.animationLeft({
        valve : '#invoice-valve',
        wrapper : '#invoice-wrapper',
        scroll : ''
    });
    
    
       $.animationLeft({
        valve : '#user_juan',
        wrapper : '#juan-wrapper',
        scroll : ''
    });
    
    
    
    template.helper('isEmpty', function(o) {
        var b = true;
        $.each(o, function(k, v) {
            b = false;
            return false;
        });
        return b;
    });
    
    template.helper('pf', function(o) {
        return parseFloat(o) || 0;
    });

    template.helper('p2f', function(o) {
        return (parseFloat(o) || 0).toFixed(2);
    });

    var _init = function (address_id) {
        var totals = 0;
        // 购买第一步 提交
        $.ajax({//提交订单信息
            type:'post',
            url:ApiUrl+'/index.php?model=member_buy&fun=buy_step1',
            dataType:'json',
            data:{key:key,cart_id:cart_id,ifcart:ifcart,address_id:address_id},
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
                // console.log(result);
                // 商品数据
                result.datas.WapSiteUrl = WapSiteUrl;
                var html = template.render('goods_list', result.datas);
                $("#deposit").html(html);
                if (fcode == '') {

                    // F码商品
                    for (var k in result.datas.store_cart_list) {
                        if (result.datas.store_cart_list[k].goods_list[0].is_fcode == '1') {
                            $('#container-fcode').removeClass('hide');
                            goods_id = result.datas.store_cart_list[k].goods_list[0].goods_id;
                            break;
                        }
                        //优惠券信息
                        if(result.datas.store_cart_list[k].store_voucher_list.length !=0){
                            
                            $('#user_juan').show();
                            var html="";


                            for (var b in  result.datas.store_cart_list[k].store_voucher_list) {  
                                voucher = '';
                                voucher_temp = [];   
                                var item=   result.datas.store_cart_list[k].store_voucher_list[b]
                                voucher_temp.push([item.voucher_t_id + '|' + k + '|' + item.voucher_price]);
                                        // console.log(voucher_temp)  
                                voucher = voucher_temp.join(',');
                                // console.log(voucher); 
                                html += ' <div><input type="radio" class="coupon checkvou"  value='+voucher+' name="juan"><label for=juan'+item.voucher_id+'><span>'+item.voucher_desc+'<em>'+item.desc+'</em></span></label><input type="hidden" value='+item.voucher_desc+' id=yhjuan'+item.voucher_t_id+'></div>';
                                $('#juan_kind').html(html);
                            };
                        }
                        //活动优惠
                      
                        var list_goods = result.datas.store_cart_list[k].goods_list;
                        var total1 =0;
                        for (var b in  result.datas.store_cart_list[k].goods_list) {  
                            var list_goods = result.datas.store_cart_list[k].goods_list[b];
                           // console.log(total1);
                            if(list_goods.groupbuy_info ){//抢购
                                goods_price1 = parseFloat(list_goods.groupbuy_info.goods_price);
                                
                                groupbuy_price1 = parseFloat(list_goods.groupbuy_info.groupbuy_price);
                                // total1 = goods_price1-groupbuy_price1;
                                
                                $('#activity').show();
                            }else if(list_goods.xianshi_info){//限时折扣
                                goods_price1 = parseFloat(list_goods.xianshi_info.goods_price);
                                xianshi_price1 = parseFloat(list_goods.xianshi_info.xianshi_price);
                                total1 += (goods_price1-xianshi_price1);
                                $('#activity').show();
                            }else if(list_goods.sole_info){//手机专享
                                goods_price1 = parseFloat(list_goods.sole_info.goods_price);
                                sole_price1 = parseFloat(list_goods.sole_info.sole_price);
                                total1 += (goods_price1-sole_price1);
                                $('#activity').show();
                            }
                        }
                        // console.log(goods_price1);

                        
                        // console.log(total1);
                        
                    }
                    if(total1){
                        activity_total = total1.toFixed(2);
                        $('#total_yh').html(total1);
                    }
                
                }
                
                
                // 验证F码
                $('#container-fcode').find('.submit').click(function(){
                    fcode = $('#fcode').val();
                    if (fcode == '') {
                        $.sDialog({
                            skin:"red",
                            content:'请填写F码',
                            okBtn:false,
                            cancelBtn:false
                        });
                        return false;
                    }
                    $.ajax({//提交订单信息
                        type:'post',
                        url:ApiUrl+'/index.php?model=member_buy&fun=check_fcode',
                        dataType:'json',
                        data:{key:key,goods_id:goods_id,fcode:fcode},
                        success:function(result){
                            if (result.datas.error) {
                                $.sDialog({
                                    skin:"red",
                                    content:result.datas.error,
                                    okBtn:false,
                                    cancelBtn:false
                                });
                                return false;
                            }

                            $.sDialog({
                                autoTime:'500',
                                skin:"green",
                                content:'验证成功',
                                okBtn:false,
                                cancelBtn:false
                            });
                            $('#container-fcode').addClass('hide');
                        }
                    });
                });

                // 默认地区相关
                if ($.isEmptyObject(result.datas.address_info)) {
                    $.sDialog({
                        skin:"block",
                        content:'请添加地址',
                        okFn: function() {
                            $('#new-address-valve').click();
                        },
                        cancelFn: function() {
                            history.go(-1);
                        }
                    });
                    return false;
                }
                if (typeof(result.datas.inv_info.inv_id) != 'undefined') {
                invoice_id = result.datas.inv_info.inv_id;
                }
                // 发票
                $('#invContent').html(result.datas.inv_info.content);
                vat_hash = result.datas.vat_hash;
                
                freight_hash = result.datas.freight_hash;
                // 输入地址数据
                insertHtmlAddress(result.datas.address_info, result.datas.address_api);
                
                // 代金券
                // voucher = '';
                // voucher_temp = [];
                // for (var k in result.datas.store_cart_list) {
                //     voucher_temp.push([result.datas.store_cart_list[k].store_voucher_info.voucher_t_id + '|' + k + '|' + result.datas.store_cart_list[k].store_voucher_info.voucher_price]);
                // }
                // voucher = voucher_temp.join(',');
                // console.log(voucher);
                for (var k in result.datas.store_final_total_list) {
                    // 总价
                    $('#storeTotal' + k).html(result.datas.store_final_total_list[k]);
                    totals += parseFloat(result.datas.store_final_total_list[k]);
                    // 留言
                    message[k] = '';
                    $('#storeMessage' + k).on('change', function(){
                        message[k] = $(this).val();
                    });
                    Total_id = 'storeTotal' + k;
                    quanju_key = k;
                }

                // 红包
                rcb_pay = 0;
                rpt = '';
                var rptPrice = 0;
                if (!$.isEmptyObject(result.datas.rpt_info)) {
                    $('#rptVessel').show();
                    var rpt_info = ((parseFloat(result.datas.rpt_info.rpacket_limit) > 0) ? '满' + parseFloat(result.datas.rpt_info.rpacket_limit).toFixed(2) + '元，': '') + '优惠' + parseFloat(result.datas.rpt_info.rpacket_price).toFixed(2) + '元'
                    $('#rptInfo').html(rpt_info);
                    rcb_pay = 1;
                } else {
                    $('#rptVessel').hide();
                }
                

                
                // password = '';

                // $('#useRPT').click(function(){
                //     if ($(this).prop('checked')) {
                //         rpt = result.datas.rpt_info.rpacket_t_id+ '|' +parseFloat(result.datas.rpt_info.rpacket_price);
                //         rptPrice = parseFloat(result.datas.rpt_info.rpacket_price);
                //         var total_price = totals - rptPrice;
                //     } else {
                //         rpt = '';
                //         var total_price = totals;
                //     }
                //     if (total_price <= 0) {
                //         total_price = 0;
                //     }
                //     $('#totalPrice,#onlineTotal').html(total_price.toFixed(2));
                // });

                // 计算总价
                var total_price = totals - rptPrice;
                if (total_price <= 0) {
                    total_price = 0;
                }
                $('#totalPrice,#onlineTotal').html(total_price.toFixed(2));
                $('#yuanlai_total').val(total_price.toFixed(2));
            }
        });
    }
    
    rcb_pay = 0;
    pd_pay = 0;
    // 初始化
    _init();

    // 插入地址数据到html
    var insertHtmlAddress = function (address_info, address_api) {
        address_id = address_info.address_id;
        $('#true_name').html(address_info.true_name);
        $('#mob_phone').html(address_info.mob_phone);
        $('#address').html(address_info.area_info + address_info.address);
        area_id = address_info.area_id;
        city_id = address_info.city_id;
        
        if (address_api.content) {
            for (var k in address_api.content) {
                $('#storeFreight' + k).html(parseFloat(address_api.content[k]).toFixed(2));
            }
        }
        offpay_hash = address_api.offpay_hash;
        offpay_hash_batch = address_api.offpay_hash_batch;
        if (address_api.allow_offpay == 1) {
            $('#payment-offline').show();
        }
        if (!$.isEmptyObject(address_api.no_send_tpl_ids)) {
            $('#ToBuyStep2').parent().removeClass('ok');
            for (var i=0; i<address_api.no_send_tpl_ids.length; i++) {
                $('.transportId' + address_api.no_send_tpl_ids[i]).show();
            }
        } else {
            $('#ToBuyStep2').parent().addClass('ok');
        }
    }
    
    // 支付方式选择
    // 在线支付
    $('#payment-online').click(function(){
        pay_name = 'online';
//      $('#select-payment-wrapper').find('.header-l > a').click();
        $('#select-payment-valve').find('span:last-child').html('支付宝手机支付');
        $(this).addClass('sel').siblings().removeClass('sel');
    });
    // 货到付款
    $('#payment-offline').click(function(){
        pay_name = 'online';
//      $('#select-payment-wrapper').find('.header-l > a').click();
        $('#select-payment-valve').find('span:last-child').html('微信手机支付');
        $(this).addClass('sel').siblings().removeClass('sel');
    });
    
    
//  配送方式
        $('#ptj').click(function(){
        pay_name = 'online';
        $('#select-payment-valve').find('span:first-child').html('葡萄酒专用快递');
        $(this).addClass('sel').siblings().removeClass('sel');
    });
        
        
          $('#jj').click(function(){
        pay_name = 'online';
        $('#select-payment-valve').find('span:first-child').html('酒具专用快递');
        $(this).addClass('sel').siblings().removeClass('sel');
    }); 
        
            $('#jg').click(function(){
        pay_name = 'online';
        $('#select-payment-valve').find('span:first-child').html('酒柜专用物流');
        $(this).addClass('sel').siblings().removeClass('sel');
    }); 
    
    
    $(".ent_st").click(function(){
        $('#select-payment-wrapper').find('.header-l > a').click();
    });
     $("#paytype").click(function(){
            // wxpay_jsapi

           $.each( $(".Apay_style"),function(){
                if ($(this).hasClass("sel")){


                    $("#wxpay_jsapi").val($(this).data("wcg"));
                };



           })


        
    });

        var myf=true;
       
    $("#juan_btn").click(function(){
    	if(myf){
            $('#select-payment-wrapper').find('.header-l > a').click();
            $.each($("#juan_kind input"),function(){
                if($(this).prop("checked")==true){
                    voucher = $(this).val();
                    var arr=voucher.split('|'); 
                    var first = arr[0];
                    var last = parseFloat(arr[arr.length-1]);
                    var coupon_desc = $('#yhjuan'+first).val();
                    var total_yh = $('#total_yh').html();


                    var storeTotal2 = parseFloat($('#'+Total_id).html());//商品合计
                    var totalPrice2 = parseFloat($('#totalPrice').html());//合计金额
                    
                    var storeTotal33 = storeTotal2 - last;
                    var totalPrice33 = totalPrice2 - last;
                    $('#'+Total_id).html(storeTotal33.toFixed(2));
                    
                    // console.log(storeTotal2);
                    $('#totalPrice,#onlineTotal').html(totalPrice33.toFixed(2));
                   // console.log(Total_id);
                    // var total = parseFloat(total_yh - last).toFixed(2);
                    // $('#total_yh').html(total);
                    
                    var html ='';
                    html+= '<dt>优惠券</dt><dd>节省<em id="storeVoucher'+quanju_key+'">'+last+'</em>元</dd>';

                    $('#Voucher_quan').html(html);
                    
                    
                    $('#Voucher_quan').show();
                    $('#j_Content').html(coupon_desc);
                    
                }
            })
        }
         myf=false;
    });

        $("#juan_kind").on("click",".checkvou",function(){
            myf=true;
            var q12=parseFloat($('#totalPrice').html());
            var q2=$("#storeTotal1").html();
            $("#totalPrice").html($("#yuanlai_total").val());
            $("#storeTotal1").html($("#yuanlai_total").val());

        })
     

    
    //事件委派
    $("#juan_kind").on("click",".coupon",function(){
        $('#coupon_num').html('1');
        var zuhe = $(this).val();
        var arr=zuhe.split('|'); 
        var figure = arr[arr.length-1];

       
   
        $('#coupon_figure').html(parseFloat(figure).toFixed(2));
        
    })
    // $.each($("#juan_kind input[name='juan']"),function(){
    //     $(this).on("click",function(){
    //          // voucher = $(this).val();
    //          alert('dsf');
    //     });
    //         // if($(this).prop("checked")==true){
    //         //     voucher = $(this).val();alert('dsf');
    //         //     var couponval = $(this).val();
                

    //         //     // parseFloat(o) || 0).toFixed(2);
    //         //     console.log($(this).val())
    //         // }
    // })
 
    

    


    $('#add_address_form').find('.btn').click(function(){
        $.sValid.init({
            rules:{
                vtrue_name:"required",
                vmob_phone:{
                    required:true,
                    mobile:true
                },
                varea_info:"required",
                vaddress:"required",
                vzipcode: {
                    required:true,
                    minlength:6
                },
            },
            messages:{
                vtrue_name:"姓名必填！",
                vmob_phone:{
                    required:"手机号必填！",
                    mobile : "手机号码不正确"
                },
                varea_info:"地区必填！",
                vaddress:"街道必填！",
                vzipcode: {
                    required : "请填写邮政编码",
                    minlength : "邮政编码不正确"
                },
            },
            callback:function (eId,eMsg,eRules){
                if(eId.length >0){
                    var errorHtml = "";
                    $.map(eMsg,function (idx,item){
                        errorHtml += "<p>"+idx+"</p>";
                    });
                    errorTipsShow(errorHtml);
                }else{
                    errorTipsHide();
                }
            }  

        });

        if($.sValid()){
             var param = {};
            // var key = key;
            var true_name = $('#vtrue_name').val();
            var mob_phone = $('#vmob_phone').val();
            var address = $('#vaddress').val();
            var city_id = $("#varea_info").data("areaid2");
            var area_id = $("#varea_info").data("areaid");
            // param.city_id = city_id;
            // param.area_id = area_id;
            var area_info = $('#varea_info').val();
            var is_default = $('#is_default2').attr("checked") ? 1 : 0;
            var vzipcode = $('#vzipcode').val();

            $.ajax({
                type:'post',
                url:ApiUrl+"/index.php?model=member_address&fun=address_add",  
                data:{key:key,true_name:true_name,area_info:area_info,address:address,mob_phone:mob_phone,is_default:is_default,city_id:city_id,area_id:area_id,zipcode:vzipcode},
                dataType:'json',
                success:function(result){
                    if (!result.datas.error) {
                        window.location.href = WapSiteUrl + "/tmpl/order/buy_step1.html?ifcart=1&cart_id="+cart_id;
                        // param.address_id = result.datas.address_id;
                        // _init(param.address_id);
                        // $('#new-address-wrapper,#list-address-wrapper').find('.header-l > a').click();
                    }
                }
            });
        }
    });
    
    
    
    
     
    
    $('#edit-address-wrapper').find('#baoc').click(function(){
        
        $.sValid.init({
            rules:{
                edit_vtrue_name:"required",
                edit_vmob_phone:{
                    required:true,
                    mobile:true
                },
                edit_varea_info:"required",
                edit_vaddress:"required",
                edit_zipcode: {
                    required:true,
                    minlength:6
                }
            },
            messages:{
                edit_vtrue_name:"姓名必填！",
                edit_vmob_phone:{
                    required:"手机号必填！",
                    mobile : "手机号码不正确"
                },
                edit_varea_info:"地区必填！",
                edit_vaddress:"街道必填！",
                edit_zipcode: {
                    required : "请填写邮政编码",
                    minlength : "邮政编码不正确"
                }
            },
            callback:function (eId,eMsg,eRules){
                if(eId.length >0){
                    var errorHtml = "";
                    $.map(eMsg,function (idx,item){
                        errorHtml += "<p>"+idx+"</p>";
                    });
                    errorTipsShow(errorHtml);
                }else{
                    errorTipsHide();
                }
            }  
        });
        
        if($.sValid()){
            var true_name = $('#edit_vtrue_name').val();
            // var tel_phone = $('#edit_vmob_phone').val();
            var mob_phone = $('#edit_vmob_phone').val();
            var address = $('#edit_vaddress').val();
            var city_id = $("#edit_varea_info").data("areaid2");
            var area_id = $("#edit_varea_info").data("areaid");
            var area_info = $('#edit_varea_info').val();
            var is_default = $('#is_default').attr("checked") ? 1 : 0;
            var address_id = $('#address_id2').val();
            var edit_zipcode = $('#edit_zipcode').val();

            $.ajax({
                type:'post',
                url:ApiUrl+"/index.php?model=member_address&fun=address_edit",  
                data:{key:key,address_id:address_id,true_name:true_name,area_info:area_info,address:address,mob_phone:mob_phone,is_default:is_default,city_id:city_id,area_id:area_id,zipcode:edit_zipcode},
                dataType:'json',
                success:function(result){
                    // console.log(result);
                    if (!result.datas.error) {
                        if(is_default == 1){
                            _init();
                        }
                        window.location.href = WapSiteUrl + "/tmpl/order/buy_step1.html?ifcart=1&cart_id="+cart_id;
                        // param.address_id = result.datas.address_id;
                        // _init(param.address_id);
                        // $('#new-address-wrapper,#list-address-wrapper').find('.header-l > a').click();
                    }
                }
            });
        }
    });


    

    
    

    // 发票选择
    $('#invoice-noneed').click(function(){
        $(this).addClass('sel').siblings().removeClass('sel');
        $('#invoice_add,#invoice-list').hide();
        invoice_id = 0;
    });
    $('#invoice-need').click(function(){
        $(this).addClass('sel').siblings().removeClass('sel');
        $('#invoice-list').show();
        $.ajax({//获取发票内容
            type:'post',
            url:ApiUrl+'/index.php?model=member_invoice&fun=invoice_content_list',
            data:{key:key},
            dataType:'json',
            success:function(result){
                checkLogin(result.login);
                var data = result.datas;
                var html = '';
                $.each(data.invoice_content_list,function(k,v){
                    html+='<option value="'+v+'">'+v+'</option>';
                });
                $('#inc_content').append(html);
            }
        });
        //获取发票列表
        $.ajax({
            type:'post',
            url:ApiUrl+'/index.php?model=member_invoice&fun=invoice_list',
            data:{key:key},
            dataType:'json',
            success:function(result){
                checkLogin(result.login);
                var html = template.render('invoice-list-script', result.datas);
                $('#invoice-list').html(html)
                if (result.datas.invoice_list.length > 0) {
                    invoice_id = result.datas.invoice_list[0].inv_id;
                }
                $('.del-invoice').click(function(){
                    var $this = $(this);
                    var inv_id = $(this).attr('inv_id');
                    $.ajax({
                        type:'post',
                        url:ApiUrl+'/index.php?model=member_invoice&fun=invoice_del',
                        data:{key:key,inv_id:inv_id},
                        success:function(result){
                            if(result){
                                $this.parents('label').remove();
                            }
                            return false;
                        }
                    });
                });
            }
        });
    })
    // 发票类型选择
    $('input[name="inv_title_select"]').click(function(){
        if ($(this).val() == 'person') {
            $('#inv-title-li').hide();
        } else {
            $('#inv-title-li').show();
        }
    });
    $('#invoice-div').on('click', '#invoiceNew', function(){
        invoice_id = 0;
        $('#invoice_add,#invoice-list').show();
    });
    $('#invoice-list').on('click', 'label', function(){
        invoice_id = $(this).find('input').val();
    });
    // 发票添加
    $('#invoice-div').find('.btn-l').click(function(){
        if ($('#invoice-need').hasClass('sel')) {
            if (invoice_id == 0) {
                var param = {};
                param.key = key;
                param.inv_title_select = $('input[name="inv_title_select"]:checked').val();
                param.inv_title = $("input[name=inv_title]").val();
                param.inv_content = $('select[name=inv_content]').val();
                $.ajax({
                    type:'post',
                    url:ApiUrl+'/index.php?model=member_invoice&fun=invoice_add',
                    data:param,
                    dataType:'json',
                    success:function(result){
                        if(result.datas.inv_id>0){
                            invoice_id = result.datas.inv_id;
                        }
                    }
                });
                $('#invContent').html(param.inv_title + ' ' + param.inv_content);
            } else {
                $('#invContent').html($('#inv_'+invoice_id).html());
            }
        } else {
            $('#invContent').html('不需要发票');
        }
        $('#invoice-wrapper').find('.header-l > a').click();
    });


		$("#juan_btn").click(function(){
			
			$("#juan-wrapper").find('.header-l > a').click();
		})
    
    // 支付

    $('#ToBuyStep2').click(function(){
        // console.log(voucher);return false;
        var msg = '';
        for (var k in message) {
            msg += k + '|' + message[k] + ',';
        }
        payment_code = $('#wxpay_jsapi').val();
        $.ajax({
            type:'post',
            url:ApiUrl+'/index.php?model=member_buy&fun=buy_step2',
            data:{
                key:key,
                ifcart:ifcart,
                cart_id:cart_id,
                address_id:address_id,
                vat_hash:vat_hash,
                offpay_hash:offpay_hash,
                offpay_hash_batch:offpay_hash_batch,
                pay_name:pay_name,
                invoice_id:invoice_id,
                voucher:voucher,
                pd_pay:pd_pay,
                // payment_code:payment_code,
                password:password,
                fcode:fcode,
                rcb_pay:rcb_pay,
                rpt:rpt,
                pay_message:msg
                },
            dataType:'json',
            success: function(result){
                // console.log(result);return false;
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
                //渲染模板
              var html = template.render('PayCenter', result.datas);
              $("#PayCenter").html(html);
                if (result.datas.payment_code == 'offline') {
                    window.location.href = WapSiteUrl + '/tmpl/member/order_list.html';
                } else {
                    delCookie('cart_count');
                    window.location.href = WapSiteUrl+'/tmpl/member/PayCenter.html?paycoid='+payment_code +'&pay_sn='+result.datas.pay_sn+'&order_id='+result.datas.order_id;
                    // window.location.href = WapSiteUrl+'/tmpl/member/PayCenter.html?pay_id=' + result.datas.pay_id +'&paycoid='+payment_code +'&pay_sn='+result.datas.pay_sn+'&order_id='+result.datas.order_id;
                    // toPay(result.datas.pay_sn,'member_buy','pay');
                }
            }
        });
    });
    
    
    $("#list-address-add-list-ul").off("click");
    
    
    
    
    
    
});