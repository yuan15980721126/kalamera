$(function(){
		$("#allshop a").on("click",function(){
			$.cookie("gj",$(this).data("gj"))
		})
	
		var myd=document.getElementsByClassName("myd")[0];
		if(myd) {
			myd.onmouseover=function(){
				document.getElementsByClassName("hidden")[0].style.display="block";
			};
			myd.onmouseout=function(){
				document.getElementsByClassName("hidden")[0].style.display="none";
			};
		}
//			
//		$(".myd").hover(function(){
//			$(".hidden").show();
//		},function(){
//			$(".hidden").hide();
//		});
		
			

	var mbo = document.getElementsByClassName("mbo")[0];
	if(mbo){
		mbo.onmouseover=function(){
			document.getElementsByClassName("phonema")[0].style.display="block";
		};
		mbo.onmouseout=function(){
			document.getElementsByClassName("phonema")[0].style.display="none";
		};
	}

	var allshop = document.getElementById("allshop");
	
	if(allshop){
		allshop.onmouseover=function(){
			document.getElementsByClassName("shop_hidden")[0].style.display="block";
		};
		allshop.onmouseout=function(){
			document.getElementsByClassName("shop_hidden")[0].style.display="none";
		};
	}
	
		

	var fx=document.getElementsByClassName("fx")[0];

	if(fx) {
		fx.onmouseover=function(){
			document.getElementsByClassName("fx_hidden")[0].style.display="block";
		};
	
		fx.onmouseout=function(){
			document.getElementsByClassName("fx_hidden")[0].style.display="none";
		};
	}

	$("#p_ge").on("mouseover",function(){
				$(".ger").show();	
		})
		$("#p_ge").on("mouseout",function(){
				$(".ger").hide();	
		})
	
	

		$(".my_coll").hover(function(){
				$(".my_c").show();
			$(this).css("background-color","#c1b497")
				
		},function(){
			$(".my_c").hide();
			$(this).css("background-color","#25211e")
		})
		


		$("#lx_gy").hover(function(){
				$(".lx_c").show();
			$(this).css("background-color","#c1b497")
				
		},function(){
			$(".lx_c").hide();
			$(this).css("background-color","#25211e")
		})
		



		$("#zd").hover(function(){
				$(".zd_c").show();
			$(this).css("background-color","#c1b497")
				
		},function(){
			$(".zd_c").hide();
			$(this).css("background-color","#25211e")
		})
		

		
		$("#zd").hover(function(){
				$(".zd_c").show();
			$(this).css("background-color","#c1b497")
				
		},function(){
			$(".zd_c").hide();
			$(this).css("background-color","#25211e")
		})
			$("#h_jin").hover(function(){
				$("#h_mo").show();
			$(this).css("background-color","#c1b497")
				
		},function(){
			$("#h_mo").hide();
			$(this).css("background-color","#25211e")
		})
		

	
})
