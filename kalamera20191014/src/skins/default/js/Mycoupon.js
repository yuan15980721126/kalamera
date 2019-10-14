$(function(){
	
	$("#coupon_head div").on("click",function(){
		$("#coupon_head div").removeClass("current");
			$(this).addClass("current");
			var index=$(this).index();
			$("#coupon_content li").hide();	
			$("#coupon_content li").eq(index).show();
		
	})
	
	
	
	
})
