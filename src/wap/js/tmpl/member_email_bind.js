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

	// $('#mobile').on('blur',function(){
	// 	if ($(this).val() != '' && ! /^-?(?:\d+|\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$/.test($(this).val())) {
	// 		$(this).val(/\d+/.exec($(this).val()));
	// 	}
	// });
    $('#email').on('blur',function(){
        if ($(this).val() != '' && ! /([\w\-]+\@[\w\-]+\.[\w\-]+)/.test($(this).val())) {
            $(this).val(/\d+/.exec($(this).val()));
        }
    });
    // $.ajax({
    //     type:'get',
    //     url:ApiUrl+"/index.php?model=member_account&fun=get_mobile_info",
    //     data:{key:key},
    //     dataType:'json',
    //     success:function(result){
    //         if(result.datas.state){
				// $('#mobile').val(result.datas.mobile);
    //         }
    //     }
    // });

    $.sValid.init({
        rules:{
            captcha: {
            	required:true,
            	minlength:4
            },
        	email: {
                required:true,
                email:true
        	}
        },
        messages:{
            captcha: {
            	required : "请填写图形验证码",
            	minlength : "图形验证码不正确"
            },
            email: {
            	required : "请填写邮箱号",
                email : "邮箱不正确"
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

    $('#send').click(function(){
        if($.sValid()){
            var email = $.trim($("#email").val());
            var captcha = $.trim($("#captcha").val());
            var codekey = $.trim($("#codekey").val());
            var shuffle = $.trim($("#shuffle").val());
            $.ajax({
                type:'post',
                url:ApiUrl+"/index.php?model=member_security&fun=bind_email_step1",
                data:{key:key,email:email,captcha:captcha,codekey:shuffle},
                dataType:'json',
                beforeSend:function(){ //触发ajax请求开始时执行
                    $('#send').hide();
                    // $('#send').removeAttr('onclick');
                },
                success:function(result){
                    console.log(result);
                    if(result.code == 200){
                    	$('#send').hide();
                    	$('#auth_code').removeAttr('readonly');
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
    $('#nextform').click(function(){
        if (!$(this).parent().hasClass('ok')) {
            return false;
        }
        var auth_code = $.trim($("#auth_code").val());
        if (auth_code) {
            $.ajax({
                type:'post',
                url:ApiUrl+"/index.php?model=member_security&fun=bind_email_step2",
                data:{key:key,auth_code:auth_code},
                dataType:'json',
                beforeSend:function(){ //触发ajax请求开始时执行
                    $('#nextform').removeAttr('onclick');
                },
                success:function(result){
                    if(result.code == 200){
                        $.sDialog({
                            skin:"block",
                            content:'绑定成功',
                            okBtn:false,
                            cancelBtn:false
                        });
                    	setTimeout("location.href = WapSiteUrl+'/tmpl/member/member_account.html'",2000);
                    }else{
                        errorTipsShow('<p>' + result.datas.error + '</p>');
                    }
                },
                complete: function(){ 
                    $('#nextform').attr('onclick','javascript:void();');
                }
            });
        }
    });
});