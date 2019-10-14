


	

$(function(){
			
				$("#b_top").load("../commonhead.html");
				$("#z_bottom").load("../bottom.html");
	
	
		var index;
	var a_tab=document.getElementsByClassName("a_tab");
	
		for ( var i=0; i<a_tab.length;i++) {
			a_tab[i].index=i
			a_tab[i].onclick=function(){
				
				index=this.index
			}
			
		}
	
	$(".title_tab>ul>li>a").on("click",function(){
			
			$(".a_tab").removeClass("tab_current");
			$(this).addClass("tab_current");
			
			$(".tab_content>ul>li").removeClass("tab_show");
			$(".tab_content>ul>li").eq(index).addClass("tab_show");
			
			
	});
	
	
	
	$("#add").on("click",function(){
		$("#alert").show();
	});
	
	$("#close").on("click",function(){
		$("#alert").hide();
	});
	
	
	$(".rule>a>div").on("click",function(){
		
		$(".rule>a>div").removeClass("cut");
		$(this).addClass("cut")		
		
	});
	var cn=2
	$("#addnb").on("click",function(){
		cn++
		$("#shu").html(cn);
	});
	
		$("#downnb").on("click",function(){
		cn--
		if(cn<1){
			cn=1;
		};
		
		$("#shu").html(cn);
	});
	
	
	
			var fg=0;

		$.each($(".changea"),function(i,v){
			$(this).on("click",function(){
			$(".changea").removeClass("current");
			$(this).addClass("current");
		      fg=i;
			})
		});
		
		$("#lir>a").on("click",function(){
				fg++;
				
				if(fg>=$(".changea").length){
				fg=0;
			}
			$(".changea").removeClass("current");
			$(".changea").eq(fg).addClass("current");
			
		});
		
		$("#lil>a").on("click",function(){
				fg--;
				
				if(fg<0){
				fg=$(".changea").length-1;
			}
			$(".changea").removeClass("current");
			$(".changea").eq(fg).addClass("current");
			
		});
	
	
	
		$(".consult_tab_head li").on("click",function(){
			
			var index=$(this).index();
			
			$(".consult_tab_head li a").removeClass("concl");
			$(".consult_tab_head li a").eq(index).addClass("concl");
			
			$(".consult_content li").removeClass("consult_show");
			$(".consult_content li ").eq(index).addClass("consult_show");
		});
		
	
	
	$("#comment_tab li").on("click",function(){
		$("#comment_tab li").find("a").removeClass("comment_current");
		$(this).find("a").addClass("comment_current");
		
		var index=$(this).index();
		//console.log(index)
		$("#comment_info>ul>li").hide();
		$("#comment_info>ul>li").eq(index).show();
		
		
		
	});
	
		$(".a_btn>a:first-child").click(function(){
		$("#alert").hide();
	});


	$("#buy").click(function(){
		$("#buy_al").show();
	});
$("#close_login").click(function(){
		$("#buy_al").hide();
	});

});