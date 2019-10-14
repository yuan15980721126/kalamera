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

    $.ajax({
        type:'get',
        url:ApiUrl+"/index.php?model=member_account&fun=get_paypwd_info",
        data:{key:key},
        dataType:'json',
        success:function(result){
            if(result.code == 200){
            	if(!result.datas.state){
            		errorTipsShow('<p>请先设置支付密码</p>');
            		setTimeout("location.href = WapSiteUrl+'/tmpl/member/member_paypwd_step1.html'",2000);
            	}
            }
        }
    });

    $.sValid.init({
        rules:{
            password: {
            	required:true,
            	minlength:6,
            	maxlength:20
            },
            captcha: {
            	required:true,
            	minlength:4
            }
        },
        messages:{
        	password: {
            	required : "请填写支付密码",
            	minlength : "请正确填写支付密码",
            	maxlength : "请正确填写支付密码"
            },
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

    $('#nextform').click(function(){
        if (!$(this).parent().hasClass('ok')) {
            return false;
        }
        if($.sValid()){
            var password = $.trim($("#password").val());
            var captcha = $.trim($("#captcha").val());
            var codekey = $.trim($("#codekey").val());
            var shuffle = $.trim($("#shuffle").val());
            $.ajax({
                type:'post',
                url:ApiUrl+"/index.php?model=member_account&fun=check_paypwd",
                data:{key:key,password:password,captcha:captcha,codekey:shuffle},
                dataType:'json',
                success:function(result){
                    if(result.code == 200){
                    	location.href = WapSiteUrl+'/tmpl/member/member_mobile_bind.html';
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
});
