$(function (){
	
	$(".ent_r").height($(".ent_r").width());
			$(".b_range").height(($(".b_range").width()*34)/100);
	$(".Sgod>div:first-child").height($("#shop_list input").width());
	$(".head_rad").height($("#shop_list input").width());
	$(".head_cha").height($(".head_cha").width());
	$(".b_range>div").css("line-height",$(".b_range>div").height()+"px");
		$(".mes_cha").height($(".head_cha").width());
	$(window).on("resize",function(){
		$(".head_cha").height($(".head_cha").width());
		$(".mes_cha").height($(".head_cha").width());
		$(".ent_r").height($(".ent_r").width());
		$(".b_range").height(($(".b_range").width()*34)/100)
		$(".head_rad").height($("#shop_list input").width());
	$(".Sgod>div:first-child").height($("#shop_list input").width())
	$(".b_range>div").css("line-height",$(".b_range>div").height()+"px");
	})
	
	
	
    if (getQueryString('key') != '') {
        var key = getQueryString('key');
        var username = getQueryString('username');
        addCookie('key', key);
        addCookie('username', username);
    } else {
        var key = getCookie('key');
    }
    var html = '<div class="nctouch-footer-wrap posr">'
        +'<div class="nav-text">';
    if(key){
        html += '<a href="'+WapSiteUrl+'/tmpl/member/member.html">我的商城</a>'
            + '<a id="logoutbtn" href="javascript:void(0);">注销</a>'
            + '<a href="'+WapSiteUrl+'/tmpl/member/member_feedback.html">反馈</a>'
	    + '<a href="' + WapSiteUrl + '/tmpl/article_list.html?ac_id=2">帮助</a>';
            
    } 
        html += '' + "</div></div>";
	var fnav = '<div id="footnav" class="footnav clearfix"><ul>'
		+'<li><a href="'+WapSiteUrl+'"><i class="home"></i><p>首页</p></a></li>'
		+'<li><a href="'+WapSiteUrl+'/tmpl/product_first_categroy.html"><i class="categroy"></i><p>分类</p></a></li>'
		+'<li><a href="'+WapSiteUrl+'/tmpl/search.html"><i class="search"></i><p>搜索</p></a></li>'
		+'<li><a href="'+WapSiteUrl+'/tmpl/cart_list.html"><i class="cart"></i><p>购物车</p></a></li>'
		+'<li><a href="'+WapSiteUrl+'/tmpl/member/member.html"><i class="member"></i><p>我的商城</p></a></li></ul>'
		+'</div>';
	$("#footer").html(html+fnav);
    var key = getCookie('key');
	$('#logoutbtn').click(function(){
		var username = getCookie('username');
		var key = getCookie('key');
		var client = 'wap';
		$.ajax({
			type:'get',
			url:ApiUrl+'/index.php?model=logout',
			data:{username:username,key:key,client:client},
			success:function(result){
				if(result){
					delCookie('username');
					delCookie('key');
					location.href = WapSiteUrl;
				}
			}
		});
	});
	

	var level = getQueryString('type');
	if(level){
		$.ajax({
				type:'post',
				url:ApiUrl+'/index.php?model=member_security&fun=level',
				dataType:'json',
				data:{key:key},
				success:function(result){
					// console.log(result);
					var data = result.datas;
					if(result.code==200){
						//渲染模板
						
		            	var html = template.render('level', data);
	              		$("#My_lv").html(html);
					}
					
				}
		});
	}
	// $("#Zpay_style div").eq(1).click(function(){
	// 	$("#Zpay_style").hide();
	// 	$("#che_style").show();
		
	// });


	$("#pay_center").on("click","#change_pay",function(){
		$("#Zpay_style").hide();
		$("#che_style").show();
	})


	
	
	
	$("#pay_center").on("click","#pay_image div",function(){
		$("#pay_image div").removeClass("che_cur");
		$(this).addClass("che_cur");
		$("#paycode").val($(this).attr('payment_code'));
	})
	
	
	$("#tab_head >div").on("click",function(){
		
		$("#tab_head >div").find("span").removeClass("curr");
		$(this).find("span").addClass("curr")
		var index=$(this).index();
		$("#tab_con >div").hide();
		$("#tab_con >div").eq(index).show();
		
		$(".zc_h").hide();
		$(".zc_h").eq(index).show();
		
		$(".find_style").hide();
		$(".find_style").eq(index).show();
		
	})
	
	$("#head_sorting>li>div").click(function(){
		$(this).next().toggle();
	})
	
		var munb=1;
	$("#De_down").click(function(){
		if(munb==1){
			return false;
		}
		munb--
		$("#De_html").html(munb);
	})
	
	
	$("#De_add").click(function(){
		
		munb++
		$("#De_html").html(munb);
		
		
	})
	
	
	$("#_range div").click(function(){
		$("#_range div").removeClass("boder_cur");
		$(this).addClass("boder_cur");
		
		
	})
	
	
	$(".nctouch-tag-nav li").click(function(){
		
		var index=$(this).index();
		// console.log(index)
		$("#P_comment>ul").hide();
		$("#P_comment>ul").eq(index).show();
		
		
		
	})
	
	
	$(".head_rad").click(function(){
		
		$(this).find("input").prop("checked",!$(this).find("input").prop("checked"));
		if($(this).find("input").prop("checked")){
			$(this).addClass("bgch");
			$(".Sgod>div").addClass("bgch");
			
			
		}else{
			$(this).removeClass("bgch");
			$(".Sgod>div").removeClass("bgch");
		};
				
		
		
	});
	var xj=[];
	$(".Sgod>div:first-child").click(function(){
		$(this).find("input").prop("checked",!$(this).find("input").prop("checked"));
			if($(this).find("input").prop("checked")){
			$(this).addClass("bgch");
			
			
		}else{
			$(this).removeClass("bgch");
		};
				
					var Myflage=true;
				$.each($(".Sgod>div:first-child"), function(v,i){
					
					if(!$(this).hasClass("bgch")){
						Myflage=false;
					}
					
					if(Myflage){
						$(".head_rad").addClass("bgch");
						$(".head_rad").find("input").prop("checked",true);
					}else{
						$(".head_rad").removeClass("bgch");
						$(".head_rad").find("input").prop("checked",false);
					}
					
					
				});
	});
	
	
	
	$(".ent_r").click(function(){
		$(this).find("input").prop("checked",!$(this).find("input").prop("checked"));
			if($(this).find("input").prop("checked")){
			$(this).addClass("bgch");
			
			
		}else{
			$(this).removeClass("bgch");
		};
		
		
	})
	
				var totalall=0
	$.each($(".Sgod_down"),function(i,v){

				$(this).on("click",function(){

				var count=$(".Sgod_nub").eq(i).html();  
				count++;
				$(".Sgod_nub").eq(i).html(count);
				xj[i]=0;
				xj[i]=$(".Sgod_nub").eq(i).html()*$(".dan_p").eq(i).html();		
				$.each($(".Sgod>div:first-child"), function(z,x) {
					if($(".Sgod>div:first-child").eq(z).hasClass("bgch")){
						totalall+=xj[z]
					}
				});
				$("#all_pic").html(totalall.toFixed(2));
				});
				

				
		});
	
	$.each($(".Sgod_add"),function(i,v){
				$(this).on("click",function(){
				var count=$(".Sgod_nub").eq(i).html();  
				if(count==1){
					return false;
				}
				count--;
				$(".Sgod_nub").eq(i).html(count);
					
					
						$.each($(".Sgod>div:first-child"), function(z,x) {
					if($(".Sgod>div:first-child").eq(z).hasClass("bgch")){
						totalall+=$(".dan_p").eq(z).html()*$(".Sgod_nub").eq(z).html();
					}
				});
				$("#all_pic").html(totalall.toFixed(2));
					
					
					
					
					
					
					
					

				});
		});
	
	
	$(".head_cha").click(function(){
		var _self = this;
		$(this).find("input").prop("checked",!$(this).find("input").prop("checked"));
		if($(this).find("input").prop("checked")){
			$(this).addClass("chk");
			$(".mes_cha").addClass("chk");
			
			
		}else{
			$(this).removeClass("chk");
			$(".mes_cha").removeClass("chk");
		};
		$('.checkitem').each(function(){
            if (!this.disabled)
            {
                $(this).attr('checked', _self.checked);
            }
        });
	});
	
	$("#all_meglist").click(function(){
		
		$(".head_cha").find("input").prop("checked",!$(".head_cha").find("input").prop("checked"));
		if($(".head_cha").find("input").prop("checked")){
			$(".head_cha").addClass("chk");
			$(".mes_cha").addClass("chk");
			$(".checkitem").prop("checked",true)
			
		}else{
			$(".head_cha").removeClass("chk");
			$(".mes_cha").removeClass("chk");
		};
	});
		
	$("#messageList").on("click",".mes_cli",function(){
		
		$(this).find(".mes_tip").toggle();
		$(this).find(".mes_bot").toggleClass("showmeg");
	})
	
	
	$("#messageList").on("click",".mes_cha",function(){

		$(this).find("input").prop("checked",!$(this).find("input").prop("checked"));
			if($(this).find("input").prop("checked")){
			$(this).addClass("chk");
			
		}else{
			$(this).removeClass("chk");
		};
		var Myflage=true;
		$.each($(".mes_cha"), function(v,i){
					
			if(!$(this).hasClass("chk")){
				Myflage=false;
			}
					
			if(Myflage){
				$(".head_cha").addClass("chk");
				$(".head_cha").find("input").prop("checked",true);
			}else{
				$(".head_cha").removeClass("chk");
				$(".head_cha").find("input").prop("checked",false);
			};
		});		

	})
	
	
	
	
	$("#tab_head>div").click(function(){
		$("#tab_head>div").find("span").removeClass("Ncur");
		$("#tab_head>div").find("i").removeClass("Ncur");
		$(this).find("span").addClass("Ncur");
		$(this).find("i").addClass("Ncur");
	});
	$("#tab_head>div").eq(0).click(function(){
		$(".mail_m").show();
		$(".phone_m").hide();
	});
	$("#tab_head>div").eq(1).click(function(){
		$(".mail_m").hide();
		$(".phone_m").show();
	});
	
	$("#filtrate_ul li").click(function(){
		$(".order-list").hide();
		$(".order-list").eq($(this).index()).show();
		
		
	});
	 $('#filtrate_ul').find('a').click(function(){
        $('#filtrate_ul').find('li').removeClass('selected');
        $(this).parent().addClass('selected').siblings().removeClass("selected");
    });
	
	$("#star_i div").click(function(){
		$("#star_i div").removeClass("l_xx");
		$(this).addClass("l_xx");
		$(this).prevAll().addClass("l_xx");
		
		
	});
	
	
	$("#add_xx").click(function(){
		
		$("#ze_lod").show();
		
	});
	
	$("#ca_lo").click(function(){
		$("#ze_lod").hide();
		
	});
	
	
	
	$.each($(".juan_xq"), function(i,v) {
		
		$(this).click(function(){
			$(this).toggleClass("downxq");
			if($(this).hasClass("downxq")){
				$(".xq_fa").eq(i).show();
			}else{
				$(".xq_fa").eq(i).hide();
			};
			
			
			
		});
		
	});
	
	
	$("#you_c").click(function(){

		$("#youx .dan_j input").prop("checked",$(this).prop("checked"));
	})
	
	
	
	$("#youx .dan_j input").click(function(){
		var flag=false;
		$("#you_c").prop("checked",true);
		
		$.each($("#youx .dan_j input"),function(){
			
			if($(this).prop("checked")==false){
				
				flag=true;
			};
			
		});
		if(flag){
			$("#you_c").prop("checked",false);
		};
	})
	
	$("#wu_c").click(function(){
		$("#expi .dan_j input").prop("checked",$(this).prop("checked"));
	})
	
	
	
	$("#expi .dan_j input").click(function(){
		var flag=false;
		$("#wu_c").prop("checked",true);
		
		$.each($("#expi .dan_j input"),function(){
			
			if($(this).prop("checked")==false){
				
				flag=true;
			};
			
		});
		if(flag){
			$("#wu_c").prop("checked",false);
		};
	})
	
	
	

	
	$.each($("#favo_head span"), function(i,v) {
		
		$(this).click(function(){
			$("#favo_head span").removeClass("cu");
			$("#favo_head span").eq(i).addClass("cu");
			
			$(".fav_ra").hide();
			$(".fav_ra").eq(i).show();
			
			
			$(".all_juan").hide();
			$(".all_juan").eq(i).show();
			
			
		})
		
	
		
		
		
		
	});
	
			var stepindex=0;
			 var dsq;
		function ydsa(){
			 dsq=setInterval(function(){
		if(stepindex>=$("#Pan_btn a").length-1){
			stepindex=-1;
		}
		stepindex++;
		
		$("#Pan_btn a").removeClass("currentA");
		$("#Pan_btn a").eq(stepindex).addClass("currentA");
		
		$(".Panic_row").hide();
		$(".Panic_row").eq(stepindex).show();
		
		
	},3000)
	
		}
	
	 ydsa()
	$("#Pan_btn a").click(function(){
		clearInterval(dsq);
		stepindex=$(this).index();
		$("#Pan_btn a").removeClass("currentA");
		$(this).addClass("currentA");
		
		$(".Panic_row").hide();
		$(".Panic_row").eq(stepindex).show();
		
		
		setTimeout(function(){
			
			ydsa()
		},3000)
		
	})
	
	
	
	
	
});