$(function (){
    if (getQueryString('key') != '') {
        var key = getQueryString('key');
        var username = getQueryString('username');
        addCookie('key', key);
        addCookie('username', username);
    } else {
        var key = getCookie('key');
    }
    var html = '<div class="nctouch-footer-wrap posr">'
        +'<div class="nav-text">';
    if(key){
        html += '<a href="'+WapSiteUrl+'/tmpl/member/member.html">我的商城</a>'
            + '<a id="logoutbtn" href="javascript:void(0);">注销</a>'
            + '<a href="'+WapSiteUrl+'/tmpl/member/member_feedback.html">反馈</a>'
	    + '<a href="' + WapSiteUrl + '/tmpl/article_list.html?ac_id=2">帮助</a>';
       var islogin = 'member.html';
    } else {
        html += '<a href="'+WapSiteUrl+'/tmpl/member/login.html">登录</a>'
            + '<a href="'+WapSiteUrl+'/tmpl/member/register.html">注册</a>'
            + '<a href="'+WapSiteUrl+'/tmpl/member/login.html">反馈</a>'
	    + '<a href="' + WapSiteUrl + '/tmpl/article_list.html?ac_id=2">帮助</a>';
	    var islogin = 'login.html';
    }
	html += '<a href="javascript:void(0);" class="gotop">返回顶部</a>' + "</div>" + '<!--<div class="copyright">' + 'Copyright&nbsp;&copy;&nbsp;2005-2016 <a href="javascript:void(0);">https://vinocave.com</a>' + "</div>--></div>";
	var fnav = '<div id="footnav" class="footnav clearfix"><ul>'
		+'<li><a href="'+WapSiteUrl+'"><i class="home"></i><p>首页</p></a></li>'
		+'<li><a href="'+WapSiteUrl+'/tmpl/product_first_categroy.html"><i class="categroy"></i><p>分类</p></a></li>'
		+'<li><a href="'+WapSiteUrl+'/tmpl/search.html"><i class="search"></i><p>搜索</p></a></li>'
		+'<li><a href="'+WapSiteUrl+'/tmpl/cart_list.html"><i class="cart"></i><p>购物车</p></a></li>'
		+'<li><a href="'+WapSiteUrl+'/tmpl/member/'+islogin+'"><i class="member"></i><p>我的商城</p></a></li></ul>'
		+'</div>';
	$("#footer").html(html+fnav);
    var key = getCookie('key');
    	$(".scroller-body").on("click","#logoutbtn",function(){
    		// alert(1)
    	})


	$('#logoutbtn').click(function(){
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
	});
	var _hmt = _hmt || [];
	(function() {
		var hm = document.createElement("script");
		hm.src = "https://hm.baidu.com/hm.js?5470d2800c38494df4668fbca7596a53";
		var s = document.getElementsByTagName("script")[0]; 
		s.parentNode.insertBefore(hm, s);
	})();

});