	$(function(){
		
				$("#b_top").load("../commonhead.html");
				$("#z_bottom").load("../bottom.html");
		
		
		
		var a=function(){
				var parent=$(this).parent();
					parent.remove();
		};
		
		
		
		
		
		
		var wen=$.cookie("gj");		
		
					var divcs=$("<div></div>");
					divcs.addClass("select_");
					var span1s=$("<span></span>").html("分类：");
					span1s.appendTo(divcs);
					var span2s=$("<span></span>").html(wen);
					span2s.appendTo(divcs);
					var delas=$("<a></a>").prop("href","javascript:;");
					delas.appendTo(divcs);
					delas.click(a)
					divcs.appendTo($("#select_all"));
				$("#t_fei").html(divcs);
		


			
		
			$("#fen_type a").click(function(){
				var divc=$("<div></div>");
					divc.addClass("select_");
					var span1=$("<span></span>").html("分类：");
					span1.appendTo(divc);
					var span2=$("<span></span>").html($(this).html());
					span2.appendTo(divc);
					var dela=$("<a></a>").prop("href","javascript:;");
					dela.appendTo(divc);
					dela.click(a)
					divc.appendTo($("#select_all"));
				$("#t_fei").html(divc);
			});
		
		
			$("#lei_type a").click(function(){
				var divc=$("<div></div>");
					divc.addClass("select_");
					var span1=$("<span></span>").html("类型：");
					span1.appendTo(divc);
					var span2=$("<span></span>").html($(this).html());
					span2.appendTo(divc);
					var dela=$("<a></a>").prop("href","javascript:;");
					dela.click(a)
					dela.appendTo(divc);
					divc.appendTo($("#select_all"));
				$("#t_lei").html(divc);
			});
		
		
		$("#kind_of a").click(function(){
				var divc=$("<div></div>");
					divc.addClass("select_");
					var span1=$("<span></span>").html("葡萄酒品种：");
					span1.appendTo(divc);
					var span2=$("<span></span>").html($(this).html());
					span2.appendTo(divc);
					var dela=$("<a></a>").prop("href","javascript:;");
					dela.click(a)
					dela.appendTo(divc);
					divc.appendTo($("#select_all"));
				$("#t_kind").html(divc);
			});
		
			
		
		$("#price_type a").click(function(){
				var divc=$("<div></div>");
					divc.addClass("select_");
					var span1=$("<span></span>").html("价格：");
					span1.appendTo(divc);
					var span2=$("<span></span>").html($(this).html());
					span2.appendTo(divc);
					var dela=$("<a></a>").prop("href","javascript:;");
					dela.click(a)
					dela.appendTo(divc);
					divc.appendTo($("#select_all"));
				$("#t_price").html(divc);
			});
		
		
		
		
		
				
		
		
		
		
		
		
		
		
		
		$("#clear_all").click(function(){
					$("#t_fei").html("");	
					$("#t_lei").html("");	
					$("#t_kind").html("");	
					$("#t_price").html("");	
			
			
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
	




