$(function(){
    var key = getCookie('key');
    //渲染list
    var load_class = new ncScrollLoad();


    $("#filtrate_ul").css("left","-200px")
    
    load_class.loadInit({
        url:ApiUrl + '/index.php?model=member_return&fun=get_return_list',
        getparam:{key :key },
        tmplid:'return-list-tmpl',
        containerobj:$("#return-list"),
        iIntervalId:true,
        data:{WapSiteUrl:WapSiteUrl},
        callback:function(){
            $('.delay-btn').click(function(){
                return_id = $(this).attr('return_id');
                $.getJSON(ApiUrl+'/index.php?model=member_return&fun=delay_form', {key:key,return_id:return_id}, function(result){
                    checkLogin(result.login);
                    $.sDialog({
                        skin:"red",
                        content:'发货 <span id="delayDay">'+result.datas.return_delay+'</span> 天后，当商家选择未收到则要进行延迟时间操作；<br> 如果超过 <span id="confirmDay">'+result.datas.return_confirm+'</span> 天不处理按弃货处理，直接由管理员确认退款。',
                        okFn:function(){
                            $.ajax({
                                type:'post',
                                url:ApiUrl+'/index.php?model=member_return&fun=delay_post',
                                data:{key:key,return_id:return_id},
                                dataType:'json',
                                success:function(result){
                                    checkLogin(result.login);
                                    if (result.datas.error) {
                                        $.sDialog({
                                            skin:"red",
                                            content:result.datas.error,
                                            okBtn:false,
                                            cancelBtn:false
                                        });
                                        return false;
                                    }
                                    window.location.href = WapSiteUrl + '/tmpl/member/member_return.html';
                                }
                            });
                        },
                        cancelFn:function(){
                            window.location.href = WapSiteUrl + '/tmpl/member/member_return.html';
                        }
                    });
                    return false;
                });
            });
        }
    });
     var start_;
    var end_

    $("#filtrate_ul").on("touchstart",function(event){
        start_=event.touches[0].clientX;
        // console.log(event.touches[0].clientX)
    })

    $("#filtrate_ul").on("touchend",function(event){
            end_=event.changedTouches[0].clientX
        // console.log(event.changedTouches[0].clientX)
        if(end_-start_>10){

        $("#filtrate_ul").css("left","0");

        }

    })
    $('#fixed_nav').waypoint(function() {
            $('#fixed_nav').toggleClass('fixed');
        }, {
            offset: '50'
        });

    $('#filtrate_ul').find('a').click(function(){
        $('#filtrate_ul').find('li').removeClass('selected');
        $(this).parent().addClass('selected').siblings().removeClass("selected");
        reset = true;
        window.scrollTo(0,0);
        initPage();
    });

    
    $('#return-list').on('click','#agan_buy', function(){
       var reid = $(this).data('cid');
        // console.log();reid.indexOf(","));
        if(isNaN(reid)){
            var ss = reid.split(",");
            for (var i = 0; i <= ss.length-1; i++) {
                zaicicart(ss[i]);
            };
            
        }else{
            var ss = reid;
            zaicicart(ss);
        }
    });

    //再次购买
    function zaicicart(id){
        $.ajax({
            url:ApiUrl+"/index.php?model=member_cart&fun=cart_add",
            data:{key:key,goods_id:id,quantity:1},
            type:"post",
            success:function (result){
                var rData = $.parseJSON(result);
                if(checkLogin(rData.login)){
                    if(!rData.datas.error){
                        // show_tip();
                        // 更新购物车中商品数量
                        delCookie('cart_count');
                        getCartCount();
                        // errorTipsShow('<p>加入购物车成功</p>');
                        $('#cart_count,#cart_count1').html('<sup>'+getCookie('cart_count')+'</sup>');
                        $.sDialog({
                                    skin:"red",
                                    content:'加入购物车成功',
                                    okBtn:false,
                                    cancelBtn:false
                                });
                    }else{
                        // errorTipsShow('<p>'+rData.datas.error+'</p>');
                        $.sDialog({
                            skin:"red",
                            content:rData.datas.error,
                            okBtn:false,
                            cancelBtn:false
                        });
                    }
                }
            }
        })
    }
  
});