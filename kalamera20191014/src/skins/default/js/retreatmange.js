$(function(){
	
	
	
	
	$("#change_status").on("change",function(){
		$("#ret_list li").removeClass("current");
		$("#ret_list li").eq($(this).val()).addClass("current");
		
		
		
		
		
		
	})
	
	
	
})