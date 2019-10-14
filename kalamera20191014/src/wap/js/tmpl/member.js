$(function(){
    if (getQueryString('key') != '') {
        var key = getQueryString('key');
        var username = getQueryString('username');
        addCookie('key', key);
        addCookie('username', username);
    } else {
        var key = getCookie('key');
    }
	if(key){
        $.ajax({
            type:'post',
            url:ApiUrl+"/index.php?model=member_index",
            data:{key:key},
            dataType:'json',
            //jsonp:'callback',
            success:function(result){
                // console.log(result.datas);
                checkLogin(result.login);
                if(result.datas.member_info.level_name == 'V0'){
                    var level = '普通会员';
                }else if(result.datas.member_info.level_name == 'V1'){
                    var level = '黄金会员';
                }else if(result.datas.member_info.level_name == 'V2'){
                    var level = '白金会员';
                }else if(result.datas.member_info.level_name == 'V3'){
                    var level = '钻石会员';
                }
                if(result.datas.member_info.member_mobile){
                    var mob = result.datas.member_info.member_mobile;
                }else{
                    var mob = '';
                }
                var html = '<div class="member-info">'
                    + '<div class="user-avatar"> <img src="' + result.datas.member_info.avatar + '"/> </div>'
                    + ' <div>  <div class="user-name"> <span>'+result.datas.member_info.user_name+'</span><em class="user_lv">' + level + '</em> </div><div class="user_phone">'+mob+'</div></div>'
                    + '</div>'
                    +'<a href="member_account.html" id="set_btn"> <i class="set"></i> </a>'
                    + '<div class="member-collect"><span><a href="favorites.html"><em>' + result.datas.member_info.favorites_goods + '</em>'
                    + '<p>商品收藏</p>'
                    + '</a> </span><span><a href="chat_list.html"><em>' +result.datas.member_info.countnum + '</em>'
                    + '<p>消息</p>'
                    + '</a> </span><span><a href="pointslog_list.html"><em>' +result.datas.member_info.member_points + '</em>'
                    + '<p>可用积分</p>'
                    + '</a> </span></div>';
                //渲染页面
                
                $(".member-top").html(html);
                
                var html = '<li><a href="order_list.html?data-state=state_new">'+ (result.datas.member_info.order_nopay_count > 0 ? '<em></em>' : '') +'<i class="cc-01"></i><p>待付款</p></a></li>'
                    + '<li><a href="order_list.html?data-state=state_send">' + (result.datas.member_info.order_noreceipt_count > 0 ? '<em></em>' : '') + '<i class="cc-02"></i><p>待收货</p></a></li>'
                    + '<li><a href="order_list.html?data-state=state_znotakes">' + (result.datas.member_info.order_notakes_count > 0 ? '<em></em>' : '') + '<i class="cc-03"></i><p>To be shipped</p></a></li>'
                    + '<li><a href="order_list.html?data-state=state_noeval">' + (result.datas.member_info.order_noeval_count > 0 ? '<em></em>' : '') + '<i class="cc-04"></i><p>待评价</p></a></li>'
                    + '<li><a href="member_return.html">' + (result.datas.member_info.order_tui_count > 0 ? '<em></em>' : '') + '<i class="cc-05"></i><p>退款/退货</p></a></li>';
                //渲染页面
                
                $("#order_ul").html(html);
                
                var html = '<li><a href="predepositlog_list.html"><i class="cc-06"></i><p>预存款</p></a></li>'
                    + '<li><a href="rechargecardlog_list.html"><i class="cc-07"></i><p>充值卡</p></a></li>'
                    + '<li><a href="voucher_list.html"><i class="cc-08"></i><p>代金券</p></a></li>'
                    + '<li><a href="redpacket_list.html"><i class="cc-09"></i><p>红包</p></a></li>'
                    + '<li><a href="pointslog_list.html"><i class="cc-10"></i><p>积分</p></a></li>';
                $('#asset_ul').html(html);
                return false;
            }
        });
	} else {
        location.href = WapSiteUrl+'/tmpl/member/login.html';
        return false;
	    var html = '<div class="member-info">'
	        + '<a href="login.html" class="default-avatar" style="display:block;"></a>'
	        + '<a href="login.html" class="to-login">点击登录</a>'
	        + '</div>'
	        + '<div class="member-collect"><span><a href="login.html"><i class="favorite-goods"></i>'
	        + '<p>商品收藏</p>'
	        + '</a> </span><span><a href="login.html"><i class="favorite-store"></i>'
	        + '<p>消息</p>'
	        + '</a> </span><span><a href="login.html"><i class="goods-browse"></i>'
	        + '<p>可用积分</p>'
	        + '</a> </span></div>';
	    //渲染页面
	    $(".member-top").html(html);
	    
        var html = '<li><a href="login.html"><i class="cc-01"></i><p>待付款</p></a></li>'
        + '<li><a href="login.html"><i class="cc-02"></i><p>待收货</p></a></li>'
        + '<li><a href="login.html"><i class="cc-03"></i><p>To be shipped</p></a></li>'
        + '<li><a href="login.html"><i class="cc-04"></i><p>待评价</p></a></li>'
        + '<li><a href="login.html"><i class="cc-05"></i><p>退款/退货</p></a></li>';
        //渲染页面
        $("#order_ul").html(html);
	 var html = '<li><a href="predepositlog_list.html"><i class="cc-06"></i><p>预存款</p></a></li>' + '<li><a href="rechargecardlog_list.html"><i class="cc-07"></i><p>充值卡</p></a></li>' + '<li><a href="voucher_list.html"><i class="cc-08"></i><p>代金券</p></a></li>' + '<li><a href="redpacket_list.html"><i class="cc-09"></i><p>红包</p></a></li>' + '<li><a href="pointslog_list.html"><i class="cc-10"></i><p>积分</p></a></li>';
        $("#asset_ul").html(html);
        
       $(".member-info").css("left","50%").css("transform","translate(-50%,-50%)")
        
        
        return false;
        
	}

	  //滚动header固定到顶部
	  $.scrollTransparent();
        $("body").on("click","#tui_btn",function(){
            var username = getCookie('username');
            var key = getCookie('key');
            var client = 'wap';
            $.ajax({
                type:'get',
                url:ApiUrl+'/index.php?model=logout',
                data:{username:username,key:key,client:client},
                success:function(result){
                    if(result){
                        delCookie('username');
                        delCookie('key');
                        location.href = WapSiteUrl;
                    }
                }
            });
        })

});