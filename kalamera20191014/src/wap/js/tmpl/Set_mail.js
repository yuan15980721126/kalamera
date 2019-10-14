$(function (){
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
	

    $('#member_mobile_ye').click(function(){
        location.href = WapSiteUrl+'/tmpl/member/member_mobile_modify.html';
    });

        $.ajax({
            type:'get',
            url:ApiUrl+"/index.php?model=member_security&fun=get_email_info",
            data:{key:key},
            dataType:'json',
            success:function(result){
                console.log(result);
                if(result.code == 200){
                    if (result.datas.state) {
                        $('#mail_ed').html(result.datas.email);
                        $('#email_info').val(result.datas.email_info);
                    } else {
                        location.href = WapSiteUrl+'/tmpl/member/member_email_bind.html';
                    }
                }
            }
        });
    //加载验证码
    // loadSeccode();
    $("#send").click(function(){
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
            $.ajax({
                type:'post',
                url:ApiUrl+"/index.php?model=member_security&fun=modify_email_step2",
                data:{key:key,captcha:captcha,codekey:shuffle},
                dataType:'json',
                // beforeSend:function(){ //触发ajax请求开始时执行
                //     $('#send').hide();
                //     // $('#send').removeAttr('onclick');
                // },
                success:function(result){
                    if(result.code == 200){
                        // alert('fsd');return false;
                        $('#send').hide();
                        $('.code-countdown').show().find('em').html(result.datas.sms_time);
                        $.sDialog({
                            skin:"block",
                            content:'邮箱验证码已发出',
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

    $('#Email_nextform').click(function(){

        var email = $('#email_info').val();
        var auth_code = $('#auth_code').val();
        $.ajax({
            type:'post',
            url:ApiUrl+"/index.php?model=member_security&fun=modify_password_step3",
            data:{key:key,auth_code:auth_code},
            dataType:'json',
            beforeSend:function(){ //触发ajax请求开始时执行
                $('#Email_nextform').removeAttr('onclick');
            },
            success:function(result){
                if(result.code == 200){
                    $.sDialog({
                        skin:"block",
                        content:'验证成功',
                        okBtn:false,
                        cancelBtn:false
                    });
                    
                    setTimeout("location.href = WapSiteUrl+'/tmpl/member/member_email_bind.html'",2000);
                }else{
                    errorTipsShow('<p>' + result.datas.error + '</p>');
                }
            },
            complete: function(){ 
                $('#Email_nextform').attr('onclick','javascript:void();');
            }
        });
    })
});