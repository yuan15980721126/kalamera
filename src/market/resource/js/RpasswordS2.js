
		$(function(){
			
			$("#style_head div").click(function(){
				
				
				$("#style_head div").removeClass("curtab");
				$(this).addClass("curtab");
				
				var index= $(this).index();
				$("#style_content li").hide();
				$("#style_content li").eq(index).show();
				
				
				
				
				
			})
			
			
			
			
			
			
			
			
			
			
			
			
			
			
		})



























