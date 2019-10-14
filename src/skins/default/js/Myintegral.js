		
			$(function(){
				
				
				$("#change_op").on("change",function(){
						var index=$(this).val();
						$("#cont_thead li").hide();
						$("#cont_thead li").eq(index).show();
				});
			})
















