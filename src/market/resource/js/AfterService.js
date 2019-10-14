		





	$(function(){
		
		
			$("#change_stu").on("change",function(){
				$("#re_tbody li").hide();
				$("#re_tbody li").eq($(this).val()).show();
			})
			
			
			
			$("#service_tab div").on("click",function(){
				$("#service_tab div").removeClass("current_tab");
				$(this).addClass("current_tab");
					
				$("#service_content>ul>li").hide();
				$("#service_content>ul>li").eq($(this).index()).show();
				
				
				
				
			})
			
			
		
	})






