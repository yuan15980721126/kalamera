	$(function(){
		
				$("#b_top").load("../commonhead.html");
				$("#z_bottom").load("../bottom.html");
		
		
		
		var a=function(){
				var parent=$(this).parent();
					parent.remove();
		};
		
		
		
		
		
		
		var wen=$.cookie("gj");		
		
		
		
		// if(wen){
		// 			var divcs=$("<div></div>");
		// 			divcs.addClass("select_");
		// 			var span1s=$("<span></span>").html("分类：");
		// 			span1s.appendTo(divcs);
		// 			span1s.addClass("bja")
		// 			var span2s=$("<span></span>").html(wen);
		// 			span2s.appendTo(divcs);
		// 			var delas=$("<a></a>").prop("href","javascript:;");
		// 			delas.appendTo(divcs);
		// 			delas.click(a)
		// 			divcs.appendTo($("#select_all"));
		// 			$("#t_fei").html(divcs);
		// }
		
		
		


			$(".type a").click(function(){
				$(".type a").css("color","black");
				$(this).css("color","red");
				
			})
			
		
		
			$(".ty_li a").click(function(){
			
			var title=$(this).parent().parent().find(".ty_title").html();
			var title2=title+"：";
			var _this=this
			var wen=$(this).html();
			var flag=true
			$.each($(".bja"), function(i,v) {
					if($(this).html()==title2){
//						console.log(_this.html())
						$(this).next().html(wen);
						flag=false
					}
			});		
			if(flag){
				var divc=$("<div></div>");
					divc.addClass("select_");
					var span1=$("<span></span>").html(title+"：");
					span1.addClass("bja")
					span1.appendTo(divc);
					var span2=$("<span></span>").html($(this).html());
					span2.appendTo(divc);
					var dela=$("<a></a>").prop("href","javascript:;");
					dela.click(a)
					dela.appendTo(divc);
					divc.appendTo($("#select_all"));
			}
					
			
			
		});
				
		
		
		
		
		
		
		
		
		
		$("#clear_all").click(function(){
			$("#select_all").html("")
			
			
		});
		
		
		$(".info_title li").click(function(){
			$(".info_title li").find("a").removeClass("p_currnet");
			$(this).find("a").addClass("p_currnet");
			
			
			$(".prd").hide();
			$(".prd").eq($(this).index()).show();
			
			
		});
		
		
		
		
				var pagenub=1;
		$(".pageinfo_btn div:first-child").click(function(){
			if(pagenub==1){
				return false;
				
			};
			pagenub--;
			
			$(".pageinfo span").html(pagenub);
		});
		
		
			$(".pageinfo_btn div:last-child").click(function(){
			pagenub++;
			$(".pageinfo span").html(pagenub);
		});
		
		
		
		
		
	
	})
	




