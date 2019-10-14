$(function() {

    var headerClone = $('#header').clone();
    $(window).scroll(function(){
        if ($(window).scrollTop() <= $('#main-container1').height()) {
            headerClone = $('#header').clone();
            $('#header').remove();
            headerClone.addClass('transparent').removeClass('');
            headerClone.prependTo('.nctouch-home-top');
        } else {
            headerClone = $('#header').clone();
            $('#header').remove();
            headerClone.addClass('').removeClass('transparent');
            headerClone.prependTo('body');
        }
    });
    /*
    author *******赵佳宇*******
    */
    $.ajax({
        url: ApiUrl + "/index.php?model=index",
        type: 'get',
        dataType: 'json',
        success: function(result) {
            var data = result.datas;
            var html = '';
            
            $.each(data, function(k, v) {
                
                $.each(v, function(kk, vv) {
                    // console.log(kk);
                    switch (kk) {
                        case 'adv_list':
                        case 'home3':
                            $.each(vv.item, function(k3, v3) {
                                vv.item[k3].url = buildUrl(v3.type, v3.data);
                            });
                            break;

                        case 'home1':
                            vv.url = buildUrl(vv.type, vv.data);
                            break;

                        case 'home2':
                        case 'home4':
                            vv.square_url = buildUrl(vv.square_type, vv.square_data);
                            vv.rectangle1_url = buildUrl(vv.rectangle1_type, vv.rectangle1_data);
                            vv.rectangle2_url = buildUrl(vv.rectangle2_type, vv.rectangle2_data);
                            break;
                    }
                    if(kk == 'goods2'){
                        runTime(vv.now,vv.start,vv.end);
                    }
                    // console.log(vv);
                    //动态时间
                    // runTime(data.now_time,data.start_time,data.end_time);
                    // $('#sce_ext').html(date_cn[data.act_type_ext]);
                    // $('#limit').html(date_cn[data.limit_amount]);
                    
                    // if (data.now_time < data.start_time && data.now_time < data.end_time) {
                    //     var totime = "距离开始还有：<span id='t_hour'></span>:<span id='t_min'></span>:<span id='t_sec'></span>";
                    // } else {
                    //     var totime = "剩余时间：<span id='t_hour'></span>:<span id='t_min'></span>:<span id='t_sec'></span>";
                    //     $('.rule-wrap').show();
                    // }
                    // if(totime !== ''){
                    //     $('.sec-time').html(totime);
                    // }
                    if (k == 0) {
                        $("#main-container1").html(template.render(kk, vv));
                    } else {
                        html += template.render(kk, vv);
                    }
                    return false;
                });
            });

            $("#main-container2").html(html);

            $('.adv_list').each(function() {
                if ($(this).find('.item').length < 2) {
                    return;
                }

                Swipe(this, {
                    startSlide: 2,
                    speed: 400,
                    auto: 3000,
                    continuous: true,
                    disableScroll: false,
                    stopPropagation: false,
                    callback: function(index, elem) {},
                    transitionEnd: function(index, elem) {}
                });
            });

        }
    });
	//их└ч
	var uid = window.location.href.split("#V5");
	var  fragment = uid[1];
	if(fragment){
		if (fragment.indexOf("V5") == 0) {
				addCookie("uid", "0");
			}else {
				addCookie("uid", fragment);
		}
	}

  
    /*动态时间函数*/
    function runTime (now,start,end) {
        now = parseInt(now);
        start = parseInt(start);
        end = parseInt(end);
        if (now < start && now < end) {
            t = start; // 未开始
        } else if (now > start && now < end) {
            t = end; // 进行中
        } else if (now > start && now > end) {
            return false; // 已结束
        } else if (now === start || now === end) {
            location.reload(); // 刷新页面
            return false;
        }
        differ = Math.abs(now - t);
        hour = zero(Math.floor(differ / 3600));
        min  = zero(Math.floor(differ % 3600 / 60));
        sec  = zero(Math.floor(differ % 60));

        $('#t_hour').html(hour);
        $('#t_min').html(min);
        $('#t_sec').html(sec);
        now++;
        window.setTimeout(function () {
            runTime(now, start, end);
        }, 1000);
    }

    function zero(n) {
        n = Math.abs(parseInt(n, 10));
        if (n <= 9) {
            n = "0" + n;
        }
        return String(n);
    }
});
