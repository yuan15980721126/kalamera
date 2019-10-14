$(function(){
	
//	$("#mian_left").load("vipcommon.html");
	
	
	$("#table_nav>ul>li").on("click",function(){
		
		   $("#table_nav>ul>li").removeClass("current");
		   $(this).addClass("current");
		   var index=$(this).index();
		   $("#temp_li>li").removeClass("temp_show");
		   $("#temp_li>li").eq(index).addClass("temp_show");
	});
	
		$("#change_st").on("change",function(){
			var index= $(this).val();
			$(".gfb>ul").removeClass("current");
			$(".gfb>ul").eq(index).addClass("current");
		})
		
	$("#indent_nav>li").on("click",function(){
			var index= $(this).index();
			$(".gfb>ul").removeClass("current");
			$(".gfb>ul").eq(index).addClass("current");
	})
		
	
})

