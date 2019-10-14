function call() {
    //文章详情页hot轮播
    $('.hot_circle_ct').owlCarousel({
        items: 1,
        loop: true,
        lazyLoad: true,
        slideBy: 1,
        nav: true,
        navText: ['', ''],
        merge: true,
        video: true,
        dots: true,
        autoPlay: 1000,
        videoPlay: true,
        autoPlayHoverPause: true
    })
	//	首页合作伙伴
	$('#sw1').owlCarousel({
		items: 1,
		loop: true,
		lazyLoad: true,
		slideBy: 1,
		nav: true,
		navText: ['', ''],
		merge: true,
		video: true,
		dots: false,
		autoPlay: 1000,
		videoPlay: false,
		autoPlayHoverPause: true,
		responsive: {
			320: {
				items: 3
			},
			678: {
				items: 6
			},
			960: {
				items: 8
			},
			1200: {
				items: 10
			},
		},
	})
	setTimeout(function() { $("#sw1").trigger('play.owl', 3000); }, 3000);
	//	首页banner
	$('#banner').owlCarousel({
		items: 1,
		loop: true,
		lazyLoad: true,
		slideBy: 1,
		nav: false,
		navText: ['', ''],
		merge: true,
		video: true,
		dots: true,
		autoPlay: 1000,
		videoPlay: false,
		autoPlayHoverPause: true,
		responsive: {},
	})
	setTimeout(function() { $("#banner").trigger('play.owl', 5000); }, 5000);
	//产品详情页bar显示隐藏
    $('.detail_l .click').each(function () {
        $(this).click(function () {
            if($(this).hasClass('add')){
                $(this).removeClass('add');
                $(this).addClass('dec');
                $(this).siblings('.de_ct').slideDown();
            }else{
                $(this).removeClass('dec');
                $(this).addClass('add');
                $(this).siblings('.de_ct').slideUp();
            }
        })
    })
	//	购物车推荐产品
	$('.product_box').owlCarousel({
		items: 4,
		loop: true,
		lazyLoad: true,
		slideBy: 1,
		nav: true,
		navText: ['<', '>'],
		merge: true,
		dots: false,
		video: true,
		autoPlay: 1000,
		videoPlay: false,
		autoplaySpeed: 1200,
		autoPlayHoverPause: true,
		responsive: {
			320: {
				items: 2
			},
			678: {
				items: 3
			},
			960: {
				items: 4
			},
			1200: {
				items: 4
			},
		},
	})
	setTimeout(function() { $(".pro_box").trigger('play.owl', 3000); }, 3000);

	//	首页品牌故事
	$(function() {
		$('.item_a span').click(function() {
			$('.item_a span').removeClass('cur');
			$(this).addClass('cur');
			$('.toggle_item').hide();
			$('.toggle_item').eq($(this).index()).show();
		})
		$(".show_b").css("display", "block");
		$(".xq").css({ 'color': '#ff4400', 'border-bottom': '3px solid #ff4400' });
		$(".xq").click(function() {
			$(this).css({ 'color': '#ff4400', 'border-bottom': '3px solid #ff4400' });
			$(".pl").css({ 'color': '#333', 'border-bottom': '3px solid #fff' });
			$(".show_b").css("display", "block");
			$(".plq").css("display", "none");
		})
		$(".pl").click(function() {
			$(this).css({ 'color': '#ff4400', 'border-bottom': '3px solid #ff4400' });
			$(".xq").css({ 'color': '#333', 'border-bottom': '3px solid #fff' });
			$(".show_b").css("display", "none");
			$(".plq").css("display", "block");
		})
	})
	//	产品详情页
	$(function() {
		var nub = 1;
		$('.down_').click(function() {
			nub++
			$('.nub').html(nub)
		})

		$('.add_').click(function() {
			if(nub == 1) {
				return false;
			}

			nub--
			$('.nub').html(nub)
		})
		$('#big_img').css('height', $('#big_img').css('width'))
		var index_ = 0;
		$(window).resize(function() {
			$('#big_img').css('height', $('#big_img').css('width'))
		})
		$('.tu_').click(function() {
			index_ = $(this).index() - 1
			$('.tu_').find('img').removeClass('cur');
			$('.tu_').find('img').eq(index_).addClass('cur')
			console.log($('.tu_').find('img').eq(index_).attr('src'))
			$('.pro_img img').attr('src', $('.tu_').find('img').eq(index_).attr('src'))
		})
		$('#right_').click(function() {
			index_++;
			if(index_ >= $('.tu_').length) {
				index_ = 0
			}
			$('.tu_').find('img').removeClass('cur');
			$('.tu_').find('img').eq(index_).addClass('cur')
			$('.pro_img img').attr('src', $('.tu_').find('img').eq(index_).attr('src'))
		})
		$('#left_').click(function() {
			index_--;
			if(index_ < 0) {
				index_ = $('.tu_').length - 1
			}
			$('.tu_').find('img').removeClass('cur');
			$('.tu_').find('img').eq(index_).addClass('cur')
			$('.pro_img img').attr('src', $('.tu_').find('img').eq(index_).attr('src'))
		})
	})
	//	移动端导航按钮
	$(function() {
		$('.cli_nav').click(function() {
			$("#nav_list").slideToggle();
		})
		$('.tel_nav').click(function() {
			$(this).children(".tel_probox").slideToggle();
		})
	})
	//	登录注册
	$(function() {
		$('.close_dlzc').click(function() {
			$('.dlzc_mask').fadeOut();
		})
		$('.reigs').click(function() {
			$('#regis').fadeIn();
		})
		$('.login').click(function() {
			$('#login').fadeIn();
		})
		$('.reigs_btn').click(function() {
			$('#regis').fadeIn();
			$('#login').fadeOut();
		})
		$('.login_btn').click(function() {
			$('#login').fadeIn();
			$('#regis').fadeOut();
			$('#new_pass').fadeOut();
		})
		$('.pass_foget span').click(function() {
			$('#new_pass').fadeIn();
			$('#regis').fadeOut();
			$('#login').fadeOut();
		})
	})
//  购物车推荐产品切换
    $(function(){
    	$('#car_li1').click(function(){
    		$('.car_li').removeClass("carli_active");
    		$(this).addClass("carli_active");
    		$('.pro_box').css("display","none");
    		$('#pro_box1').css("display","block");
    	})
    	$('#car_li2').click(function(){
    		$('.car_li').removeClass("carli_active");
    		$(this).addClass("carli_active");
    		$('.pro_box').css("display","none");
    		$('#pro_box2').css("display","block");
    	})
    	$('#car_li3').click(function(){
    		$('.car_li').removeClass("carli_active");
    		$(this).addClass("carli_active");
    		$('.pro_box').css("display","none");
    		$('#pro_box3').css("display","block");
    	})
    })
    //购物车地址编辑
    $(function(){
    	$('.address_btn').click(function(){
    		$('.address_mask').fadeIn();
    	})
    	$('.address_btn2').click(function(){
    		$('.address_mask').fadeIn();
    	})
    	$('.add_close').click(function(){
    		$('.address_mask').fadeOut();
    	})
    })
//  订单中心按钮切换
    $(function(){
    	$('.order_nav .order_li').click(function(){
    		$('.info_tab').removeClass('dis_b');
    		$('.order_li').removeClass('orderli_active');
    		$(this).addClass("orderli_active");
    	})
    })

    //生产及周期弹窗
    $('.sendDate a').click(function () {
        $('.opBox').show();
    })
    $('.sendDtip a').click(function () {
        $('.opBox').hide();
    })
//关联产品鼠标停放
    $('.rtp a').mouseover(function(){
        $(this).parent("li").css("border-color","#ff4400");
    });
    $('.rtp a').mouseout(function(){
        $(this).parent("li").css("border-color","#dedede");
    });
//产品详情点击
    $('.insnav').find('ul li a').eq(0).addClass('insnav_a');
    $('.prodetail').show();
    $('.insnav').find('ul').find('li a').each(function() {
        $(this).on('click', function() {
            $(this).parent("li").siblings().find('a').removeClass('insnav_a');
            $(this).addClass('insnav_a');
            if ($(this).parent("li").index()==0) {
                $('.changect').hide();
                $('body').find('.prodetail').show();
            };
            if ($(this).parent("li").index()==1) {
                $('.changect').hide();
                $('body').find('.useinst').show();
            };
            if ($(this).parent("li").index()==2) {
                $('.changect').hide();
                $('body').find('.procom').show();
            };
            if ($(this).parent("li").index()==3) {
                $('.changect').hide();
                $('body').find('.send_return').show();
            };
        });
    });

//活性成分滚动
    $('#actshow').owlCarousel({
        nav:true,
        navText	:['',''],
        items: 4,
        loop: true,
        margin: 10,
        lazyLoad: true,
        merge: true,
        video: true,
        dots:false,
        navigation:true,
        responsive:{
            300:{
                items:1
            },
            560:{
                items:2
            },
            960:{
                items:3
            },
            1200:{
                items:4
            }
        }
    });

// 共建E-Mall多选框
    //多选框初始为false
	$('.multipick').find('li').each(function () {
        	$(this).find('input:checkbox').attr('checked', false);
        }
	)
    $('.multipick').find('li span').click(function () {
    		if($(this).hasClass('redCheck')){
    			$(this).removeClass('redCheck');
                $(this).parent('li').find('input').attr('checked', false);
			}else{
                $(this).addClass('redCheck');
                $(this).parent('li').find('input').attr('checked', true);
			}
    });

	//地址选取初始
    $('.send_addr form').click(function(){
        $(this).parent().find('.addr_select').slideToggle();
    });
	$('.addr_close').click(function () {
        $(this).parents('.addr_select').hide();
    });

    $('.list li').eq(0).addClass('addr_list_active');
    $('.province').show();

    // 点击切换地址tab
    $('.addr_select').find('.list li').each(function(){
            $(this).click(function() {
                $(this).addClass('addr_list_active');
                $(this).siblings('li').removeClass('addr_list_active');
                if($(this).data('name') == 'province') {
                    $(this).parents('.list').siblings('.select_list').css('display','none');
                    $(this).parents('.list').siblings('.province').css('display','block');
                } else if ($(this).data('name') == 'city') {
                    $(this).parents('.list').siblings('.select_list').css('display','none');
                    $(this).parents('.list').siblings('.city').css('display','block');
                } else {
                    $(this).parents('.list').siblings('.select_list').css('display','none');
                    $(this).parents('.list').siblings('.area').css('display','block');
				}
        });
    });

    // 省份
    $('.province li').each(function(){
        $(this).click(function() {
        	//提示隐藏和置空
        	$('.addr_label').hide();
            $('.addr_tip').html('');
            //跳转到市
            $('.list li').eq(0).removeClass('addr_list_active');
            $('.province').hide();
            $('.list li').eq(1).addClass('addr_list_active');
            $('.city').show();
            //span显示省份
            var provice_value = $(this).html();
            $(this).parents('.send_addr').find('form').children('span').each(function(){
                if($(this).data('count') == 'province') {
                    $(this).html(provice_value);
                    $(this).show();
                }
                if($(this).data('count') == 'city') {
                    $(this).html('');
                }
                if($(this).data('count') == 'area') {
                    $(this).html('');
                }
            });
            // 把省份值赋给input
            $(".addrCity").val("");
            var inputVal=$(this).parents('.send_addr').find('form').children('span').eq(0).html();
            var inputValue=inputVal;
            $('.addrCity').attr("value",inputValue);
        });
    });
    // 城市
    $('.city li').each(function(){
        $(this).click(function(){
        	//判断省份是否已选
        	if($('.send_addr').find('form').children('span').eq(0).html()!='') {
        		//提示置空
                $('.addr_tip').html('');
                // 跳转到区
                $('.list li').eq(1).removeClass('addr_list_active');
                $('.city').hide();
                $('.list li').eq(2).addClass('addr_list_active');
                $('.area').show();
                //span显示省和城市
                var city_value = $(this).html();
                $(this).parents('.send_addr').find('form').children('span').each(function () {
                    if ($(this).data('count') == 'city') {
                        $(this).html(city_value);
                        $(this).show();
                    }
                    if ($(this).data('count') == 'area') {
                        $(this).html('');
                    }
                });
                // 把省和市值赋给input
                $(".addrCity").val("");
                var inputVal = $(this).parents('.send_addr').find('form').children('span').eq(0).html();
                var inputVal2 = $(this).parents('.send_addr').find('form').children('span').eq(1).html();
                inputValue = inputVal + inputVal2;
                $('.addrCity').attr("value", inputValue);
            }else{
        		$('.addr_tip').html('*请确保已选择省份');
			}
        });
    });
    // 地区
    $('.area li').each(function() {
        $(this).click(function(){
        	//判断省份或城市是否都不为空
        	if(($('.send_addr').find('form').children('span').eq(0).html()=='')||($('.send_addr').find('form').children('span').eq(1).html()=='')){
                $('.addr_tip').html('*请确保已选择省份和城市');
        }else{
        		//提示置空
                $('.addr_tip').html('');
                //区选择后初始到省并隐藏地址选择框
                $('.list li').eq(2).removeClass('addr_list_active');
                $('.area').hide();
                $('.addr_select').hide();
                $('.list li').eq(0).addClass('addr_list_active');
                $('.province').show();
                //span显示省、市、区
                var area_value = $(this).html();
                $(this).parents('.send_addr').find('form').children('span').each(function(){
                    if($(this).data('count') == 'area') {
                        $(this).html(area_value);
                        $(this).show();
                    }
                });
                // 把省市区的值赋给input
                $(".addrCity").val("");
                var inputVal=$(this).parents('.send_addr').find('form').children('span').eq(0).html();
                var inputVal2=$(this).parents('.send_addr').find('form').children('span').eq(1).html();
                var inputVal3=$(this).parents('.send_addr').find('form').children('span').eq(2).html();
                inputValue=inputVal+inputVal2+inputVal3;
                $('.addrCity').attr("value",inputValue);
        	}
        });
    });

    // var jd = false;
    // var cur = {
    //     x:0,
    //     y:0
    // }
    // var nx,ny,dx,dy,x,y ;
    // function down(){
    //     jd = true;
    //     var touch ;
    //     if(event.touches){
    //         touch = event.touches[0];
    //     }else {
    //         touch = event;
    //     }
    //     cur.x = touch.clientX;
    //     cur.y = touch.clientY;
    //     dx = bzy.offsetLeft;
    //     dy = bzy.offsetTop;
    //     console.log('按下');
    //     console.log('按下'+jd);
    // }
    // function move(){
    //     var bodyw=document.documentElement.clientWidth;
    //     var bodyh=document.documentElement.clientHeight;
    //     var overx=bodyw-bzy.offsetWidth;
    //     var overy=bodyh-bzy.offsetHeight;
    //     bzy.style.cursor='move';
    //     if(jd){
    //         var touch ;
    //         if(event.touches){
    //             touch = event.touches[0];
    //         }else {
    //             touch = event;
    //         }
    //         nx = touch.clientX - cur.x;
    //         ny = touch.clientY - cur.y;
    //         x = dx+nx;
    //         y = dy+ny;
    //
    //         //控制块在屏幕内
    //         if((x<0)&&(y<0)){
    //             x=0;y=0;
    //         }
    //         if((x>overx)&&(y<0)){
    //             x=overx;y=0;
    //         }
    //         if((x<0)&&(y>overy)){
    //             x=0;y=overy;
    //         }
    //         if((x>overx)&&(y>overy)){
    //             x=overx;y=overy;
    //         }
    //         if(x<0){
    //             x=0;
    //         }
    //         if(y<0){
    //             y=0;
    //         }
    //         if(x>overx){
    //             x=overx;
    //         }
    //         if(y>overy){
    //             y=overy;
    //         }
    //         bzy.style.left = x + "px";
    //         bzy.style.top = y + "px";
    //
    //         //阻止页面的滑动默认事件
    //         document.addEventListener("touchmove",function(){
    //             event.preventDefault();
    //         },false);
    //
    //     }
    // }
    //鼠标释放时候的函数
    // function end(){
    //     jd = false;
    //     document.addEventListener('touchmove', function () {
    //         event.returnValue = true;
    //     }, false);
    //     console.log('起来');
    //     console.log('起来'+jd);
    // }
    //
    // var bzy = document.getElementById("bzy");
    // var body = document.getElementsByTagName("body")[0];
    // console.log(body);
    //
    // bzy.addEventListener("mousedown",function(){
    //     down();
    // },false);
    // bzy.addEventListener("touchstart",function(){
    //     down();
    // },false);
    // bzy.addEventListener("mousemove",function(){
    //     move();
    // },false);
    // bzy.addEventListener("touchmove",function(){
    //     move();
    // },false);
    // body.addEventListener("mouseup",function(){
    //     end();
    // },false);
    // bzy.addEventListener("touchend",function(){
    //     end();
    // },false);

    $("#actshow").mousedown(function () {
        $("#pstimg").css('z-index','5');
    })
}
