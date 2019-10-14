
$(function(){
	$("#add_aadress").on("click",function(){
			
			$("#add_harvest").show();
			
		})
		

		$("#save_close").on("click",function(){
			
			$("#add_harvest").hide();
			
		})
		$.each($("#info_table li"),function(i,v){
				
				if($(this).hasClass("info_current")){
					
					$(".i_address").eq(i).html("默认地址")
				}
			})
			


			
			
			
			$(".i_address").click(function(){
				
				$("#info_table li").removeClass("info_current");
				$(this).parent().parent().addClass("info_current")
				
				$.each($("#info_table li"),function(i,v){
					$(".i_address").html("设为默认地址")
				if($(this).hasClass("info_current")){
					$(".i_address").eq(i).html("默认地址")
				}
			})
			
				
			})
	
	
	$(".i_amend").click(function(){
		$("#save_harvest").show();
	})
	$("#add_close").on("click",function(){
			
			$("#save_harvest").hide();
			
	})
	
	
})
		
		