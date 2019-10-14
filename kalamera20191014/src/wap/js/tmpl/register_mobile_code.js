$(function(){
    var key = getCookie('key');
    if (key) {
        window.location.href = WapSiteUrl+'/tmpl/member/member.html';
        return;
    }
    //加载验证码
    loadSeccode();
    $("#refreshcode").click(function(){
        loadSeccode();
    });
    // // 发送手机验证码
    // var mobile = getQueryString("mobile");
    // var sec_val = getQueryString("captcha");
    // var sec_key = getQueryString("codekey");
    // $('#usermobile').html(mobile);
    // send_sms(mobile, sec_val, sec_key);
    $('#again').click(function(){
        var mobile = $('#mobile').val();
        sec_val = $('#captcha').val();
        sec_key = $('#shuffle').val();
        send_sms(mobile, sec_val, sec_key);
    });
    


    $.sValid.init({//注册验证
        rules:{
            mobile: {
                required : true,
                mobile : true,
                // remote   : {
                //     url : ApiUrl+'index.php?model=login&fun=check_mobile_re',
                //     type: 'get',
                //     data:{
                //         phone : function(){
                //             return $('#mobile').val();
                //         }
                //     }
                // }
            },
            password : {
                required : true,
                minlength: 6,
                maxlength: 20
            },         
            password_confirm : {
                required : true,
                equalTo  : '#password'
            },
            captcha: {
                required:true,
                minlength:4
            },
            auth_code: {
                required:true,
                minlength:6
            },
            agree:{
                required: true,
            }
        },
        messages:{
            mobile: {
                required : '输入正确的手机号',
                mobile : '输入正确的手机号',
                // remote   : '该手机号已被注册'
            },
            password  : {
                required : '密码必填!',
                minlength: '密码长度不得小于6位',
                maxlength: '密码长度不得大于20位'
            },
            password_confirm : {
                required : '请再次输入密码',
                equalTo  : '两次输入的密码不一致'
            },
            captcha: {
                required : "请填写图形验证码",
                minlength : "图形验证码不正确"
            },
            auth_code: {
                required : "请输入六位短信验证码",
                minlength : "请输入六位短信验证码"
            },
            agree:{
                required: "请勾选用户协议",
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
    
    // $('#register_mobile_password').click(function(){
    //     if (!$(this).parent().hasClass('ok')) {
    //         return false;
    //     }
    //     var captcha = $('#captcha').val();
    //     if (captcha.length == 0) {
    //         errorTipsShow('<p>请填写验证码<p>');
    //     }

    //     check_sms_captcha(mobile, captcha);
    //     return false;
        
    // });

    $('#registerbtn').click(function(){
        
        if (!$(this).parent().hasClass('ok')) {
            return false;
        }
        var auth_code = $('#auth_code').val();
        var mobile = $('#mobile').val();
        if (auth_code.length == 0) {
            errorTipsShow('<p>请填写验证码<p>');
        }

        // var captcha = $("input[name=captcha]").val();
        
        // if(!check_captcha(shuffle, captcha)){
        //     errorTipsShow('<p>图形验证码错误<p>');
        //     return false;
        // };
           
        if($.sValid()){
            var mobile = $('#mobile').val();
            var password = $("input[name=password]").val();

          
           
            var client = 'wap';
            var captcha = $("input[name=captcha]").val();
            var codekey = $("#codekey").val();
            var shuffle = $.trim($("#shuffle").val());


            $.ajax({
                type:'post',
                url:ApiUrl+"/index.php?model=connect&fun=sms_register",  
                data:{phone:mobile, captcha:auth_code,password:password, client:'wap',sec_key:shuffle,sec_val:captcha},
                dataType:'json',
                success:function(result){
                    if(!result.datas.error){
                        addCookie('username',result.datas.username);
                        addCookie('key',result.datas.key);
                        location.href = WapSiteUrl + '/tmpl/member/member.html';
                    }else{
                        errorTipsShow("<p>"+result.datas.error+"</p>");
                        loadSeccode();
                        $('#captcha').val('');
                    }
                }
            });
        }else{
            loadSeccode();
            $('#captcha').val('');
        }
    });
});
// 发送手机验证码
function send_sms(mobile, sec_val, sec_key) {
    $.getJSON(ApiUrl+'/index.php?model=connect&fun=get_sms_captcha', {type:1,phone:mobile,sec_val:sec_val,sec_key:sec_key}, function(result){
        if(!result.datas.error){
            $.sDialog({
                skin:"green",
                content:'发送成功',
                okBtn:false,
                cancelBtn:false
            });
            $('.code-again').hide();
            $('.code-countdown').show().find('em').html(result.datas.sms_time);
            var times_Countdown = setInterval(function(){
                var em = $('.code-countdown').find('em');
                var t = parseInt(em.html() - 1);
                if (t == 0) {
                    $('.code-again').show();
                    $('.code-countdown').hide();
                    clearInterval(times_Countdown);
                } else {
                    em.html(t);
                }
            },1000);
        }else{
            loadSeccode();
            errorTipsShow('<p>' + result.datas.error + '<p>');
        }
    });
}
// 检查手机验证码
function check_sms_captcha(mobile, captcha) {
    $.getJSON(ApiUrl + '/index.php?model=connect&fun=check_sms_captcha', {type:1,phone:mobile,captcha:captcha }, function(result){
        if (!result.datas.error) {
            return true;
        } else {
            loadSeccode();
            errorTipsShow('<p>' + result.datas.error + '<p>');
            return false;
        }
    });
}

// 检查手机验证码
function check_captcha(sec_key,sec_val) {
    $.ajax({
        type:'post',
        url:ApiUrl+"/index.php?model=connect&fun=check_captcha",  
        data:{sec_key:sec_key,sec_val:sec_val},
        dataType:'json',
        success:function(result){
            if(!result.datas.error){
                return true;
            }else{
                return false;
            }
        }
    });
}