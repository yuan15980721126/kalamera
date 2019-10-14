$(function(){
	
	
	//$("#z_bottom").load("../bottom.html");
	
	
	$("#login_head>div").click(function(){
		
		$("#login_head>div").removeClass("font_colro");
		$(this).addClass("font_colro");
		
		var index=$(this).index();
		
		$("#login_content li").hide();
		$("#login_content li").eq(index).show();		
		
		
		
	})
	
	
})