$(function(){
	
		$("#b_top").load("../commonhead2.html")
		
		
		$("#z_bottom").load("../bottom.html")
	
	
			$.each($("#info_table li"), function(i,v) {
				if(($(this).index+1)%3==0){
					
					$(this).css("margin-right",0);
				};
				
				
				
				
			});
	
		
		
			$("#pay_style div").click(function(){
				$("#pay_style div").removeClass("ckeck_pay");
				$(this).addClass("ckeck_pay");
				
				
				
			});
			
		
		
	
	
})