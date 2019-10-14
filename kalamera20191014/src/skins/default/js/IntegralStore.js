	$(function(){
				$.each($("#goods_list li"), function() {
					if(($(this).index()+1)%4==0){
					$(this).css("margin-right",0)
			}
				
			});
			
				//$("#b_top").load("../commonhead.html");
				//$("#z_bottom").load("../bottom.html");
				
	})
	