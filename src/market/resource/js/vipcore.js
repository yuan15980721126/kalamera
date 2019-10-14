$(function(){
			$("#table_nav>ul>li").on("click",function(){
				
				$("#table_nav>ul>li").removeClass("current");
				$(this).addClass("current");
				var index=$(this).index();
				$("#temp_li>li").removeClass("temp_show");
				$("#temp_li>li").eq(index).addClass("temp_show");
				
				
			})
		
		
		
	
	
	
	
})
