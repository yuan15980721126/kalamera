$(function(){
    var key = getCookie('key');
        if(!key){
            location.href = 'login.html';
        }

    var id = getQueryString('id');
    $.ajax({
        type:'get',
        url:ApiUrl+'/index.php?model=pointprod&fun=pinfo',
        dataType:'json',
        data:{key:key,id:id},
        success:function(result){
            // console.log(result);
            var data = result.datas;
            if(result.code==200){
                        //渲染模板
                        
                    var html = template.render('inquiry_list', data);
                    $("#My_orlist").html(html);

                    $('#body_img').html(result.datas.prodinfo.pgoods_body);
                        
            }
                    
        }
    });
    var nub=1;
    $("#My_orlist").on("click","#De_down",function(){
        if(nub==1){
                return false;
        };
            nub--;
        $("#De_html").html(nub);
            
            
    });
    
    $("#My_orlist").on("click","#De_add",function(){
            nub++;
        $("#De_html").html(nub);
        
    })
       
    //积分商品加入购物车
    $("#My_orlist").on("click","#once_dui",function(){
   
        var storagenum = parseInt($("#storagenum").val());//库存数量
        var limitnum = parseInt($("#limitnum").val());//限制兑换数量
        var quantity = parseInt($("#De_html").html());//兑换数量
        //验证数量是否合法
        var checkresult = true;
        var msg = '';
        if(!quantity >=1 ){//如果兑换数量小于1则重新设置兑换数量为1
            quantity = 1;
        }
        if(limitnum > 0 && quantity > limitnum){
            checkresult = false;
            msg = '兑换数量不能大于限兑数量';
        }
        if(storagenum > 0 && quantity > storagenum){
            checkresult = false;
            msg = '兑换数量不能大于剩余数量';
        }
        if(checkresult == false){
            // $.sDialog({
            //     skin:"block",
            //     content:msg,
            //     okBtn:false,
            //     cancelBtn:false
            // });
            errorTipsShow('<p>' + msg + '</p>');
            return false;
        }else{
            $.ajax({
                type:'get',
                url:ApiUrl+'/index.php?model=pointcart&fun=add&pgid='+id+'&quantity='+quantity+'&key='+key,
                dataType:'json',
                beforeSend: function () {
                    // 禁用按钮防止重复提交
                    $("#once_dui").prop( "disabled",true );
                },
                success:function(result){
                    // console.log(result);
                    var data = result.datas;
                    if(!result.datas.error){
                                //渲染模板
                                
                           location.href = WapSiteUrl+'/tmpl/member/Poin_order.html';
                                
                    }else{
                        errorTipsShow('<p>' + result.datas.error + '</p>');
                        // $.sDialog({
                        //     skin:"block",
                        //     content:result.datas.error,
                        //     okBtn:false,
                        //     cancelBtn:false
                        // });
                    }
                            
                },
                complete: function () {
                    $("#once_dui").prop("disabled",false);
                },
            });
            
        }
    });


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
    
});













//     $.animationLeft({
//         valve : '#search_adv',
//         wrapper : '.nctouch-full-mask',
//         scroll : '#list-items-scroll'
//     });
//     $("#header").on('click', '.header-inp', function(){
//         location.href = WapSiteUrl + '/tmpl/search.html?keyword=' + keyword;
//     });
//     if (keyword != '') {
//     	$('#keyword').html(keyword);
//     }

//     // 商品展示形式
//     $('#show_style').click(function(){
//         if ($('#product_list').hasClass('grid')) {
//             $(this).find('span').removeClass('browse-grid').addClass('browse-list');
//             $('#product_list').removeClass('grid').addClass('list');
//         } else {
//             $(this).find('span').addClass('browse-grid').removeClass('browse-list');
//             $('#product_list').addClass('grid').removeClass('list');
//         }
//     });

//     // 排序显示隐藏
//     $('#sort_default').click(function(){
//         if ($('#sort_inner').hasClass('hide')) {
//             $('#sort_inner').removeClass('hide');
//         } else {
//             $('#sort_inner').addClass('hide');
//         }
//     });
//     $('#nav_ul').find('a').click(function(){
//         $(this).addClass('current').parent().siblings().find('a').removeClass('current');
//         if (!$('#sort_inner').hasClass('hide') && $(this).parent().index() > 0) {
//             $('#sort_inner').addClass('hide');
//         }
//     });
//     $('#sort_inner').find('a').click(function(){
//         $('#sort_inner').addClass('hide').find('a').removeClass('cur');
//         var text = $(this).addClass('cur').text();
//         $('#sort_default').html(text + '<i></i>');
//     });

//     $('#product_list').on('click', '.goods-store a',function(){
//         var $this = $(this);
//         var store_id = $(this).attr('data-id');
//         var store_name = $(this).text();
//         $.getJSON(ApiUrl + '/index.php?model=store&fun=store_credit', {store_id:store_id}, function(result){
//             var html = '<dl>'
//                 + '<dt><a href="store.html?store_id=' + store_id + '">' + store_name + '<span class="arrow-r"></span></a></dt>'
//                 + '<dd class="' + result.datas.store_credit.store_desccredit.percent_class + '">描述相符：<em>' + result.datas.store_credit.store_desccredit.credit + '</em><i></i></dd>'
//                 + '<dd class="' + result.datas.store_credit.store_servicecredit.percent_class + '">服务态度：<em>' + result.datas.store_credit.store_servicecredit.credit + '</em><i></i></dd>'
//                 + '<dd class="' + result.datas.store_credit.store_deliverycredit.percent_class + '">发货速度：<em>' + result.datas.store_credit.store_deliverycredit.credit + '</em><i></i></dd>'
//                 + '</dl>';
//             //渲染页面
            
//             $this.next().html(html).show();
//         });
//     }).on('click', '.sotre-creidt-layout', function(){
//         $(this).hide();
//     });

//     // get_list();
//     $(window).scroll(function(){
//         if(($(window).scrollTop() + $(window).height() > $(document).height()-1)){
//             get_list();
//         }
//     });
//     // search_adv();
// });

// function get_list() {
//     $('.loading').remove();
//     if (!hasmore) {
//         return false;
//     }
//     hasmore = false;
//     param = {};
//     param.page = page;
//     param.curpage = curpage;
//     if (gc_id != '') {
//         param.gc_id = gc_id;
//     } else if (keyword != '') {
//         param.keyword = keyword;
//     } else if (b_id != '') {
//         param.b_id = b_id;
//     }
//     if (key != '') {
//         param.key = key;
//     }
//     if (order != '') {
//         param.order = order;
//     }

//     $.getJSON(ApiUrl + '/index.php?model=goods&fun=goods_list' + window.location.search.replace('?','&'), param, function(result){
//     	if(!result) {
//     		result = [];
//     		result.datas = [];
//     		result.datas.goods_list = [];
//     	}
//         $('.loading').remove();
//         // curpage++;
//         // var html = template.render('home_body', result);
//         $("#product_list .goods-secrch-list").append(html);
//         console.log(result)
//         if(result.datas.goods_list.length >0){
//             $("#head_cookie").html(result.datas.goods_list[0].gc_name);
//         }

//         hasmore = result.hasmore;
//     });
// }

// function search_adv() {
//     $.getJSON(ApiUrl + '/index.php?model=index&fun=search_adv', function(result) {
//     	var data = result.datas;
//     	$('#list-items-scroll').html(template.render('search_items',data));
//     	if (area_id) {
//     		$('#area_id').val(area_id);
//     	}
//     	if (price_from) {
//     		$('#price_from').val(price_from);
//     	}
//     	if (price_to) {
//     		$('#price_to').val(price_to);
//     	}
//     	if (own_shop) {
//     		$('#own_shop').addClass('current');
//     	}
//     	if (gift) {
//     		$('#gift').addClass('current');
//     	}
//     	if (groupbuy) {
//     		$('#groupbuy').addClass('current');
//     	}
//     	if (xianshi) {
//     		$('#xianshi').addClass('current');
//     	}
//     	if (virtual) {
//     		$('#virtual').addClass('current');
//     	}
//     	if (ci) {
//     		var ci_arr = ci.split('_');
//     		for(var i in ci_arr) {
//     			$('a[name="ci"]').each(function(){
//     				if ($(this).attr('value') == ci_arr[i]) {
//     					$(this).addClass('current');
//     				}
//     			});
//     		}
//     	}
//     	$('#search_submit').click(function(){
//     		var queryString = '?keyword=' + keyword, ci = '';
//     		queryString += '&area_id=' + $('#area_id').val();
//     		if ($('#price_from').val() != '') {
//     			queryString += '&price_from=' + $('#price_from').val();
//     		}
//     		if ($('#price_to').val() != '') {
//     			queryString += '&price_to=' + $('#price_to').val();
//     		}
//     		if ($('#own_shop')[0].className == 'current') {
//     			queryString += '&own_shop=1';
//     		}
//     		if ($('#gift')[0].className == 'current') {
//     			queryString += '&gift=1';
//     		}
// 			if ($('#groupbuy')[0].className == 'current') {
// 				queryString += '&groupbuy=1';
// 			}
// 			if ($('#xianshi')[0].className == 'current') {
// 				queryString += '&xianshi=1';
// 			}
// 			if ($('#virtual')[0].className == 'current') {
// 				queryString += '&virtual=1';
// 			}
//     		$('a[name="ci"]').each(function(){
//     			if ($(this)[0].className == 'current') {
//     				ci += $(this).attr('value') + '_';
//     			}
//     		});
//     		if (ci != '') {
//     			queryString += '&ci=' + ci;
//     		}
//     		window.location.href = WapSiteUrl + '/tmpl/product_list.html' + queryString;
//     	});
//     	$('a[nctype="items"]').click(function(){
//     		var myDate = new Date();
//     		if(myDate.getTime() - searchTimes > 300) {
//     			$(this).toggleClass('current');
//     			searchTimes = myDate.getTime();
//     		}
//     	});
//     	$('input[nctype="price"]').on('blur',function(){
//     		if ($(this).val() != '' && ! /^-?(?:\d+|\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$/.test($(this).val())) {
//     			$(this).val('');
//     		}
//     	});
//     	$('#reset').click(function(){
//     		$('a[nctype="items"]').removeClass('current');
//     		$('input[nctype="price"]').val('');
//     		$('#area_id').val('');
//     	});
//     });
// }

// function init_get_list(o, k) {
//     order = o;
//     key = k;
//     curpage = 1;
//     hasmore = true;
//     $("#product_list .goods-secrch-list").html('');
//     $('#footer').removeClass('posa');
//     get_list();
// };



  
  
  
  
