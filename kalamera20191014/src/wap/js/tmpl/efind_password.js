$(function(){
    var key = getCookie('key');
    if (key) {
        // window.location.href = WapSiteUrl+'/tmpl/member/login.html';
        // return;
        $('#top_right').hide();
        $.ajax({
            type:'get',
            url:ApiUrl+"/index.php?model=member_security&fun=get_email_info",
            data:{key:key},
            dataType:'json',
            success:function(result){
                console.log(result);
                if(result.code == 200){
                    if (result.datas.state) {
                        $('#email').val(result.datas.email).attr("readonly","readonly");
                        $('#email_info').val(result.datas.email_info);

                    } else {
                        location.href = WapSiteUrl+'/tmpl/member/member_email_bind.html';
                    }
                }
            }
        });
    }else{
        $('#email_info').remove();
    }
    //加载验证码
    loadSeccode();
    $("#refreshcode").bind('click',function(){
        loadSeccode();
    });
    // $('#email').on('blur',function(){
    //     if ($(this).val() != '' && ! /([\w\-]+\@[\w\-]+\.[\w\-]+)/.test($(this).val())) {
    //         $(this).val(/\d+/.exec($(this).val()));
    //     }
    // });
    
    $.sValid.init({//注册验证
        rules:{
            captcha: {
                required:true,
                minlength:4
            }
            // email: {
            //     required:true,
            //     email:true
            // }
        },
        messages:{
            captcha: {
                required : "请填写图形验证码",
                minlength : "图形验证码不正确"
            }
            // email: {
            //     required : "请填写邮箱号",
            //     email : "邮箱不正确"
            // }
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
    
	$('#find_password_btn').click(function(){
        if (!$(this).parent().hasClass('ok')) {
            return false;
        }
	    if ($.sValid()) {
	        if (key) {
                var email = $.trim($("#email_info").val());
            }else{
                var email = $('#email').val();
            }

            var captcha = $.trim($("#captcha").val());
            var codekey = $.trim($("#codekey").val());
            var shuffle = $.trim($("#shuffle").val());
            // return false;
            $.ajax({
                type:'post',
                url:ApiUrl+"/index.php?model=member_security&fun=modify_paypwd_step2",
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
                        setTimeout(location.href = WapSiteUrl+"/tmpl/member/Efind_password_code.html?email="+email+"&captcha="+captcha+"&codekey="+$.trim($("#shuffle").val()),2000)      

                    }else{
                        errorTipsShow('<p>' + result.datas.error + '</p>');
                        var shuffle = get_math('codekey');
                        $("#codeimage").attr('src',ApiUrl+'/index.php?model=seccode&fun=makecode&k='+$("#codekey").val()+'&t=' + shuffle);
                        $('#captcha').val('');
                        $('#shuffle').val(shuffle);
                    }
                }
            });
	    } else {
	        return false;
	    }
	});
});