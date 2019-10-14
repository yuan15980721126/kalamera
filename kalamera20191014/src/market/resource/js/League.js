$(function(){
	
	
	
	$("#League_head div").on("click",function(){
		
		$("#League_head div").removeClass("add_bg");
		$(this).addClass("add_bg");
		var index=$(this).index();
		$("#League_tab li").hide();
		$("#League_tab li").eq(index).show();
	})
	
		$(".user_name").on("input",function(){
			if($(this).val().trim().length>0){
					$(".user_name_wen").hide();
					
			}else{
				$(".user_name_wen").show();
				
			}
			
			
		})
	
	
	
	
		$(".user_email").on("input",function(){
			if($(this).val().trim().length>0){
					$(".user_email_wen").hide();
					
			}else{
				$(".user_email_wen").show();
				
			}
			
			
		})
		
		
			$(".user_phone").on("input",function(){
			if($(this).val().trim().length>0){
					$(".user_phone_wen").hide();
					
			}else{
				$(".user_phone_wen").show();
				
			}
			
			
		})
		
		
		
		
		
	
	
		$(".in_ma").on("input",function(){
			if($(this).val().trim().length>0){
					$("#ma>div:first-child").hide();
					
			}else{
				$("#ma>div:first-child").show();
				
			}
			
			
		})
	
	
	
	
	
	
})