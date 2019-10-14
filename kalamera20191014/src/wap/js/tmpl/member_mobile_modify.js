$(function() {
    var key = getCookie('key');
    if (!key) {
        window.location.href = WapSiteUrl+'/tmpl/member/login.html';
        return;
    }

    //加载验证码
    loadSeccode();
    $("#refreshcode").bind('click',function(){
        loadSeccode();
    });

    $('#member_email_ye').click(function(){
        location.href = WapSiteUrl+'/tmpl/member/Set_mail1.html';
    });
    $.ajax({
        type:'get',
        url:ApiUrl+"/index.php?model=member_account&fun=get_mobile_info",
        data:{key:key},
        dataType:'json',
        success:function(result){
            if(result.code == 200){
            	if (result.datas.state) {
            		$('#mobile').html(result.datas.mobile);
            	} else {
            		location.href = WapSiteUrl+'/tmpl/member/member_mobile_bind.html';
            	}
            }
        }
    });

    
    $('#send').click(function(){
        $.sValid.init({
            rules:{
                captcha: {
                    required:true,
                    minlength:4
                }
            },
            messages:{
                captcha: {
                    required : "请填写图形验证码",
                    minlength : "图形验证码不正确"
                }
            },
            callback:function (eId,eMsg,eRules){
                if(eId.length >0){
                    var errorHtml = "";
                    $.map(eMsg,function (idx,item){
                        errorHtml += "<p>"+idx+"</p>";
                    });
                    errorTipsShow(errorHtml);
                }else{
                    errorTipsHide();
                }
            }
        });
        if($.sValid()){
            var captcha = $.trim($("#captcha").val());
            var codekey = $.trim($("#codekey").val());
            var shuffle = $.trim($("#shuffle").val());
            // console.log(shuffle);
            $.ajax({
                type:'post',
                url:ApiUrl+"/index.php?model=member_account&fun=modify_mobile_step2",
                data:{key:key,captcha:captcha,codekey:shuffle},
                dataType:'json',
                success:function(result){
                    if(result.code == 200){
                        // alert('fsd');return false;
                    	$('#send').hide();
                        $('.code-countdown').show().find('em').html(result.datas.sms_time);
                        $.sDialog({
                            skin:"block",
                            content:'短信验证码已发出',
                            okBtn:false,
                            cancelBtn:false
                        });
                        var times_Countdown = setInterval(function(){
                            var em = $('.code-countdown').find('em');
                            var t = parseInt(em.html() - 1);
                            if (t == 0) {
                            	$('#send').show();
                                $('.code-countdown').hide();
                                clearInterval(times_Countdown);
                                var shuffle = get_math('codekey');
                                $("#codeimage").attr('src',ApiUrl+'/index.php?model=seccode&fun=makecode&k='+$("#codekey").val()+'&t=' +shuffle);
                                $('#shuffle').val(shuffle);
                            } else {
                                em.html(t);
                            }
                        },1000);
                    }else{
                        errorTipsShow('<p>' + result.datas.error + '</p>');
                        var shuffle = get_math('codekey');
                        $("#codeimage").attr('src',ApiUrl+'/index.php?model=seccode&fun=makecode&k='+$("#codekey").val()+'&t=' + shuffle);
                        $('#captcha').val('');
                        $('#shuffle').val(shuffle);
                    }
                }
            });
        }
    });

    $('#nextform').click(function(){
        if (!$(this).parent().hasClass('ok')) {
            return false;
        }
        $.sValid.init({
            rules:{
                captcha: {
                    required:true,
                    minlength:4
                },
                auth_code: {
                    required:true,
                    minlength:6
                }
            },
            messages:{
                captcha: {
                    required : "请填写图形验证码",
                    minlength : "图形验证码不正确"
                },
                auth_code: {
                    required:"请填写短信验证码",
                    minlength:"短信验证码不正确"
                }
            },
    
            callback:function (eId,eMsg,eRules){
                if(eId.length >0){
                    var errorHtml = "";
                    $.map(eMsg,function (idx,item){
                        errorHtml += "<p>"+idx+"</p>";
                    });
                    errorTipsShow(errorHtml);
                }else{
                    errorTipsHide();
                }
            }
        });
        var auth_code = $.trim($("#auth_code").val());
        if (auth_code) {
            $.ajax({
                type:'post',
                url:ApiUrl+"/index.php?model=member_account&fun=modify_password_step3",
                data:{key:key,auth_code:auth_code},
                dataType:'json',
                success:function(result){
                    if(result.code == 200){
                        $.sDialog({
                            skin:"block",
                            content:'解绑成功',
                            okBtn:false,
                            cancelBtn:false
                        });
                    	setTimeout("location.href = WapSiteUrl+'/tmpl/member/member_mobile_bind.html'",2000);
                    }else{
                        errorTipsShow('<p>' + result.datas.error + '</p>');
                    }
                }
            });
        }
    });
});
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