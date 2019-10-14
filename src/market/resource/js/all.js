	
		
 



	$(function(){
		
			// $("#b_top").load("../commonhead2.html");
			// 	$("#z_bottom").load("../bottom.html");
				var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        paginationClickable: true,
        prevButton:'.swiper-button-prev',
		nextButton:'.swiper-button-next',
		loop : true,
		autoplay:4000
    });
    
    $(".myd").hover(function(){$(".hidden").show()},function(){
					
					$(".hidden").hide();
					
					
				});
				
				$(".mbo").hover(function(){$(".phonema").show()},function(){
					
					$(".phonema").hide();
					
					
				});
				
			
			
					$("#allshop").hover(function(){$(".shop_hidden").show()},function(){
					
					$(".shop_hidden").hide();
					
					
				});
			
			
			$(".fx").hover(function(){$(".fx_hidden").show()},function(){
					
					$(".fx_hidden").hide();
					
					
				});
    
    
				
		$(".left_nav>ul>li>a:first").on("mouseover",function(){
				$(".ger").show()	
		})
		$(".left_nav>ul>li>a:first-child").on("mouseout",function(){
				$(".ger").hide()	
		})
		
		
				var num=0;
				
	var numtime;
	
	
	function set_a(){
		numtime=setInterval(function(){
			num++;
	if(num>$(".clock_head_r>div").length-1){
						num=0;
	};	
				$(".clock_head_r>div").removeClass("listcurrent");
				$(".clock_head_r>div").eq(num).addClass("listcurrent");
				
				$(".content_list>ul").removeClass("show_cont");
				$(".content_list>ul").eq(num).addClass("show_cont");
		
		
			},3000);
		
	
		
		
	};
	set_a();
	
				
				
		$(".afterdow").on("click",function(){
			 clearInterval(numtime);
					num++;
					if(num>$(".clock_head_r>div").length-1){
						num=0;
					};
				$(".clock_head_r>div").removeClass("listcurrent");
				$(".clock_head_r>div").eq(num).addClass("listcurrent");
				
				$(".content_list>ul").removeClass("show_cont");
				$(".content_list>ul").eq(num).addClass("show_cont");
				
				setTimeout(function(){
					set_a();
				},3000);
				
				
				
	});
	
				$(".beforeup").on("click",function(){
					 clearInterval(numtime);
					num--;
					if(num<0){
						num=$(".clock_head_r>div").length-1;
					};
				$(".clock_head_r>div").removeClass("listcurrent");
				$(".clock_head_r>div").eq(num).addClass("listcurrent");
				
				$(".content_list>ul").removeClass("show_cont");
				$(".content_list>ul").eq(num).addClass("show_cont");
				setTimeout(function(){
					set_a();
				},3000);
	});
	
		
	
	$(".clock_head_r>div").on("click",function(){
			 clearInterval(numtime);
			num=$(this).index();
				$(".clock_head_r>div").removeClass("listcurrent");
				$(".clock_head_r>div").eq(num).addClass("listcurrent");
				$(".content_list>ul").removeClass("show_cont");
				$(".content_list>ul").eq(num).addClass("show_cont");	
				
				setTimeout(function(){
					set_a();
				},3000);
			
				
	});
	
	
			var notIndex=0;
			var notIime;
			function notfun(){
				notIime=setInterval(function(){
				notIndex++;
			if(notIndex>$(".notice_li").length-1){
				notIndex=0;
			};
			
			
			
			$(".notice_li").removeClass("current");
		$(".notice_li").eq(notIndex).addClass("current");
			$(".today>ul>li").removeClass("today_show");
		$(".today>ul>li").eq(notIndex).addClass("today_show");
			},3000)
				
				
			};
		notfun();
			
	$(".notice_li").on("click",function(){
		clearInterval(notIime);
		$(".notice_li").removeClass("current");
		$(this).addClass("current");
		var notIndex=$(this).index();
		$(".today>ul>li").removeClass("today_show");
		$(".today>ul>li").eq(notIndex).addClass("today_show");
		setTimeout(function(){
			notfun();
		},3000)
		
		
		
	});
	
	$(".floor_title_r a").click(function(){
		
		$.cookie("gj",$(this).data("gj"));
		
	});
	
	
	
	
	
	
	
	
	$(".notice_tab").on("click",function(){
			$(".notice_tab").removeClass("current");
			$(this).addClass("current");
			var index=$(this).index();
			
			$(".notice_bottom_content>div").removeClass("notice_show");
			$(".notice_bottom_content>div").eq(index).addClass("notice_show");
		
	});
	
	$(".help__tab>ul>li").on("click",function(){
		
		$(".help__tab>ul>li>a").removeClass("help__tab_current");
		$(this).find("a").addClass("help__tab_current");
		
		var index=$(this).index();
		$(".select_product>ul").hide();
		$(".select_product>ul").eq(index).show();
		
	});
	
	
//	设置滚动nav的宽度
$("#move_img").width($("#move_img>li").width()*$("#move_img>li").length);
//			左
 	$("#move_img").width($("#move_img>li").width()*$("#move_img>li").length);
		$("#point_r").on("mousedown",function(){
					$("#move_img").animate({left:-($("#move_img>li").width()*$("#move_img>li").length-$("#move_img>li").width()*6)},"slow")
			
			
			$("#point_r").on("mouseup",function(){
				$("#move_img").stop(true,false)
				
			})
			
			
		})
		
//		右



		$("#point_l").on("mousedown",function(){
					$("#move_img").animate({left:0},"slow")
			
			
			$("#point_l").on("mouseup",function(){
				$("#move_img").stop(true,false)
				
			})
			
			
		})




		
		
		
		
		
//		一楼切换功能
					var one_nub=0;
					var oneTime;
					function oneTimeFun(){
					oneTime=setInterval(function(){
							one_nub++;
						if(one_nub>$(".one_floor .flag_n>li").length-1){
							one_nub=0;
						};
						$(".one_floor .flag_n>li").removeClass("fl_current");
							$(".one_floor .flag_n>li").eq(one_nub).addClass("fl_current");	
							
							
						},3000);
					};
					
					oneTimeFun();
					
	$(".one_floor .flag_n>li").on("click",function(){
					clearInterval(oneTime);
								one_nub++;
						if(one_nub>$(".one_floor .flag_n>li").length-1){
							one_nub=0;
						};
				
					$(".one_floor .flag_n>li").removeClass("fl_current");
					$(this).addClass("fl_current");
					
					$(".r1_nav>div").hide();
					$(".r1_nav>div").eq(one_nub).show();	
						oneTimeFun();
						
					
					
		
	})
	
	//		二楼切换功能
	
	
	
					var one_nub2=0;
					var twoTime;
					function twoTimeFun(){
					twoTime=setInterval(function(){
							one_nub2++;
						if(one_nub2>$(".two_floor .flag_n>li").length-1){
							one_nub2=0;
						};
						$(".two_floor .flag_n>li").removeClass("fl_current");
							$(".two_floor .flag_n>li").eq(one_nub2).addClass("fl_current");	
							
							
						},3000);
					};
					
					twoTimeFun();
	

	$(".two_floor .flag_n>li").on("click",function(){
		clearInterval(twoTime);
							one_nub2++;
						if(one_nub2>$(".one_floor .flag_n>li").length-1){
							one_nub2=0;
						};
				
					$(".two_floor .flag_n>li").removeClass("fl_current");
					$(this).addClass("fl_current");
					
					$(".r2_nav>div").hide();
					$(".r2_nav>div").eq(one_nub2).show();	
						twoTimeFun();
		
	})
	
	//		三楼切换功能

	$(".three_floor .flag_n>li").on("click",function(){
					$(".three_floor .flag_n>li").removeClass("fl_current");
					$(this).addClass("fl_current");
		
	})
	





					var one_nub3=0;
					var threeTime;
					function threeTimeFun(){
					threeTime=setInterval(function(){
							one_nub3++;
						if(one_nub3>$(".two_floor .flag_n>li").length-1){
							one_nub3=0;
						};
						$(".three_floor .flag_n>li").removeClass("fl_current");
							$(".three_floor .flag_n>li").eq(one_nub3).addClass("fl_current");	
							
							
						},3000);
					};
					
					threeTimeFun();
	

	$(".three_floor .flag_n>li").on("click",function(){
						clearInterval(threeTime);
							one_nub3++;
						if(one_nub3>$(".one_floor .flag_n>li").length-1){
							one_nub3=0;
						};
				
					$(".three_floor .flag_n>li").removeClass("fl_current");
					$(this).addClass("fl_current");
					
					$(".r3_nav>div").hide();
					$(".r3_nav>div").eq(one_nub3).show();	
						threeTimeFun();
		
	})
	














	})
	
	
				
	
	
	








