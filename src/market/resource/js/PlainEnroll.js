$(function(){
		
				$("#z_bottom").load("../bottom.html");
				
				
			$("#Euser_name").on("input",function(){
				if($("#Euser_name").val().trim().length<4||$("#Euser_name").val().trim().length>20){
								$("#Euser_name_w").show();
				}else{
					
					$("#Euser_name_w").hide();
				}
			})
			
			$("#Euser_password").on("input",function(){
				if($("#Euser_password").val().trim().length<6||$("#Euser_password").val().trim().length>20){
								$("#Euser_password_w").show();
				}else{
					
					$("#Euser_password_w").hide();
				}
			})
				
			$("#agin_password").on("input",function(){
				
				if($("#agin_password").val()!=$("#Euser_password").val()){
					
					$("#agin_password_w").show();
				}else{
					
					$("#agin_password_w").hide();
				}
				
			})	
				
			$("#Euser_email").on("input",function(){
				
				if($(this).val().trim().length<=0){
					
					$("#Euser_email_w").show();
					
				}else{
					$("#Euser_email_w").hide();
				}
			})
			
			
			
			$("#Euser_email").on("input",function(){
				
				if($(this).val().trim().length<=0){
					
					$("#Euser_email_w").show();
					
				}else{
					$("#Euser_email_w").hide();
				};
			});
			
			
			$("#Euser_phone").on("input",function(){
				
				if($(this).val().trim().length<=0){
					
					$("#Euser_phone_w").show();
					
				}else{
					$("#Euser_phone_w").hide();
				};
			});
			
			
			
			
			
			
			$("#agreement>div:first-child").on("click",function(){
				
				
				$(this).toggleClass("check_Stus");
				
				
				
				
				
			});
				
				
				
	})
