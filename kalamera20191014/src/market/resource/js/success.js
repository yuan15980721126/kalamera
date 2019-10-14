$(function(){
	$("#b_top").load("../commonhead2.html");
				$("#z_bottom").load("../bottom.html");
	$("#wx").hover(function(){
			
			$(this).css({border:"2px solid #d00100",width:"182px",height:"34px"})
			
	},function(){
		
		
		$(this).css({border:"1px solid #e3e3e3",width:"184px",height:"36px"})
		
	})
	$("#zfb").hover(function(){
			
			$(this).css({border:"2px solid #d00100",width:"182px",height:"34px"})
			
	},function(){
		
		
		$(this).css({border:"1px solid #e3e3e3",width:"184px",height:"36px"})
		
	});
	$("#shade").width($("body").width());
	$("#shade").height(210+document.getElementById("d_success").clientHeight+470);
	$("#once_pay").on("click",function(){
		
		$("#shade").fadeIn();
	})
	
	$("#wx").on("click",function(){
		$("#p_image").prop("src","../img/success/32_05.jpg")
	})
	$("#zfb").on("click",function(){
		$("#p_image").prop("src","../img/success/3_03_03.jpg")
	});
	
	
	$("#close").on("click",function(){
		
		$("#shade").fadeOut();
	});
	
	
	
})