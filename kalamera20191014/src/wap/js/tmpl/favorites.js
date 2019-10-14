$(function(){
	var key = getCookie('key');
	if(!key){
		location.href = 'login.html';
	}
	//渲染list
	var load_class = new ncScrollLoad();
	load_class.loadInit({
		'url':ApiUrl + '/index.php?model=member_favorites&fun=favorites_list',
		'getparam':{'key':key},
		'tmplid':'sfavorites_list',
		'containerobj':$("#favorites_list"),
		'iIntervalId':true,
		'data':{WapSiteUrl:WapSiteUrl}
	});

	$("#favorites_list").on('click',"[nc_type='fav_del']",function(){
		var goods_id = $(this).attr('data_id');
		if (goods_id <= 0) {
			$.sDialog({skin: "red", content: '删除失败', okBtn: false, cancelBtn: false});
		}
		if(dropFavoriteGoods(goods_id)){
			$("#favitem_"+goods_id).remove();
			if (!$.trim($("#favorites_list").html())) {
				location.href = WapSiteUrl+'/tmpl/member/favorites.html';
			}
		}
	});
	
	
	$("#favorites_list").on("click","li",function(){
			$(this).toggleClass("cur_");		
	});
	$("#all_cur").click(function(){
		$("#favorites_list li").addClass("cur_");
	});
	
	$("#delfav").click(function(){

		// var fav_id = $("#fav_id").val();

	   var flag=false;
       var items = '';
        $.each($(".goods-item"),function(){
            if($(this).hasClass("cur_")){
                flag=true;
                var val = $(this).attr("id");
                // console.log(val)
                var sub = val.substr(8);    
                items += sub + ',';
            }
        })
        // items = items.substr(8);
        

        if(!flag){
            $.sDialog({
                skin:"red",
                content:'请选择需要操作的记录',
                okBtn:false,
                cancelBtn:false
            });
            return false;
        }


        if(confirm("确定要全部删除收藏吗？")){
    	    // var return_val = false;
            // console.log(items)
            // return false;
    	    $.ajax({
    	        type: 'post',
    	        url: ApiUrl + '/index.php?model=member_favorites&fun=favorites_del',
    	        data: {key: key, fav_id: items},
    	        dataType: 'json',
    	        async: false,
    	        success: function(result) {
    	            if (result.code == 200) {
    	                $.sDialog({skin: "green", content: "已取消收藏！", okBtn: false, cancelBtn: false});
                        
                        setInterval("window.location.reload()",2000);

    	                // return_val = true;
    	            } else {
    	                $.sDialog({skin: "red", content: result.datas.error, okBtn: false, cancelBtn: false});
    	            }
    	        }
    	    });
        }
	    // return return_val;
	});
	//加入购物车
	$("#favorites_list").on('click',"[nc_type='add_cart']",function(){
              
              		// var goods_id = $("#fav_id").val();
              		var goods_id = $(this).attr('data_id');
					if (goods_id <= 0) {
						$.sDialog({skin: "red", content: '加入购物车失败', okBtn: false, cancelBtn: false});
					}
                    var flag=  confirm("是否确认加入购物车");
                    var key = getCookie('key');//登录标记
                    console.log(goods_id);
                    // var quantity = parseInt($(".buy-num").text());

                    if(flag){
                    //     if(!key){
                    //          var goods_info = decodeURIComponent(getCookie('goods_cart'));
                    //          if (goods_info == null) {
                    //              goods_info = '';
                    //          }
                    //          if(goods_id<1){
                    //              show_tip();
                    //              return false;
                    //          }
                             
                    //          var cart_count = 0;
                    //          if(!goods_info){
                    //              goods_info = goods_id+','+quantity;
                    //              cart_count = 1;
                    //          }else{
                    //              var goodsarr = goods_info.split('|');
                    //              for (var i=0; i<goodsarr.length; i++) {
                    //                  var arr = goodsarr[i].split(',');
                    //                  if(contains(arr,goods_id)){
                    //                      show_tip();
                    //                      return false;
                    //                  }
                    //              }
                    //              goods_info+='|'+goods_id+','+quantity;
                    //              cart_count = goodsarr.length;
                    //          }

                    //          // 加入cookie
                    //          addCookie('goods_cart',goods_info);
                    //          // 更新cookie中商品数量
                    //          addCookie('cart_count',cart_count);
                    //          show_tip();
                    //          getCartCount();
                    //          $('#cart_count,#cart_count1').html('<sup>'+cart_count+'</sup>');
                    //          return false;
                    //     }else{
                            $.ajax({
                               url:ApiUrl+"/index.php?model=member_cart&fun=cart_add",
                               data:{key:key,goods_id:goods_id,quantity:1},
                               type:"post",
                               success:function (result){
                                  var rData = $.parseJSON(result);
                                  if(checkLogin(rData.login)){
                                    if(!rData.datas.error){
                                        show_tip();
                                        // 更新购物车中商品数量
                                        delCookie('cart_count');
                                        getCartCount();
                                        $('#cart_count,#cart_count1').html('<sup>'+getCookie('cart_count')+'</sup>');
                                    }else{
                                      $.sDialog({
                                        skin:"red",
                                        content:rData.datas.error,
                                        okBtn:false,
                                        cancelBtn:false
                                      });
                                    }
                                  }
                               }
                            })
                    //     }
   
                    }



                });
});