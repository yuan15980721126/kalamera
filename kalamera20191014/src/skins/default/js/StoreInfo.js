$(function(){
	
	//$("#b_top").load("../commonhead.html");
				//$("#z_bottom").load("../bottom.html");
	
	
		var fg=0;

		$.each($(".changea"),function(i,v){
			$(this).on("click",function(){
			$(".changea").removeClass("current");
			$(this).addClass("current");
		      fg=i;
			})
		})
		
		$("#lir>a").on("click",function(){
				fg++;
				
				if(fg>=$(".changea").length){
				fg=0;
			}
			$(".changea").removeClass("current");
			$(".changea").eq(fg).addClass("current");
			
		})
	
		$("#lil>a").on("click",function(){
				fg--;
				
				if(fg<0){
				fg=$(".changea").length-1;
			}
			$(".changea").removeClass("current");
			$(".changea").eq(fg).addClass("current");
			
		})
	
	
	
	
	var nub=1;
	$("#r_down").on("click",function(){
		if(nub==1){
				return false;
		};
			nub--;
	$("#r_nub").html(nub);
			
			
	});
	
	$("#r_add").on("click",function(){
			nub++;
	$("#r_nub").html(nub);
		
	})

	
})
