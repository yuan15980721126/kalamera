$(function(){
	
		
//			
//		$(".myd").hover(function(){
//			$(".hidden").show();
//		},function(){
//			$(".hidden").hide();
//		});


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
	
	
})
