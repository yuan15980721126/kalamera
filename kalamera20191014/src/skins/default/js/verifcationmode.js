$(function(){

	$("#modify_head>div").on("click",function(){

								$("#modify_head>div").removeClass("d_cureent");
								$(this).addClass("d_cureent");
								var index=$(this).index();
							$(".bound_adderss").hide();
							$(".bound_adderss").eq(index).show();							
	
							$(".ver_mod").hide();	
								$(".ver_mod").eq(index).show();		
								
								
})
	
	
	$("#next_step").on("click",function(){
				if($("#modify_head>div:first-child").hasClass("d_cureent")){
							location.href="newemailphone.html";
				}else{
							location.href="newemail.html";
				}
				
	
	
	})
})
