$(function(){
	
		$(".push_discuss").on("click",function(){
			$("#assess_table").show();
							
		})
	
		$("#table_close").on("click",function(){
			
			$("#assess_table").hide();
			
		})
	
	
	$("#score li").on("click",function(){
		$("#score li").removeClass("addstart");
		$(this).addClass("addstart");
		$(this).prevAll().addClass("addstart");
	});
	
	
	
	
	
	
	
})
