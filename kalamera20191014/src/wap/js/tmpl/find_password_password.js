$(function(){

    var key = getCookie('key');
    if (key) {
        // window.location.href = WapSiteUrl+'/tmpl/member/login.html';
        // return;
        $('#top_right').hide();
    }
    var mobile = getQueryString("mobile");
    var email = getQueryString("email");
    var captcha = getQueryString("captcha");
    var codekey = getQueryString("codekey");
    // 显示密码
    $('#checkbox').click(function(){
        if ($(this).prop('checked')) {
            $('#password').attr('type', 'text');
        } else {
            $('#password').attr('type', 'password');
        }
    });
    
    $.sValid.init({//注册验证
        rules:{
            password : {
                required : true,
                minlength: 6,
                maxlength: 20
            },
            password_confirm : {
                required : true,
                equalTo  : '#password'
            }
        },
        messages:{
            password  : {
                required : '密码必填!',
                minlength: '密码长度不得小于6位',
                maxlength: '密码长度不得大于20位'
            },
            password_confirm : {
                required : '请再次输入密码',
                equalTo  : '两次输入的密码不一致'
            },
        },
        callback:function (eId,eMsg,eRules){
            if(eId.length >0){
                var errorHtml = "";
                $.map(eMsg,function (idx,item){
                    errorHtml += "<p>"+idx+"</p>";
                });
                errorTipsShow(errorHtml);
            }else{
                errorTipsHide()
            }
        }  
    });
    
    $('#completebtn').click(function(){
        if (!$(this).parent().hasClass('ok')) {
            return false;
        }
        var password = $("#password").val();
        if(mobile){
            var url = ApiUrl+"/index.php?model=connect&fun=find_password";
            var data = {phone:mobile, captcha:captcha, password:password, client:'wap'};
        }else{
            var url = ApiUrl+"/index.php?model=member_security&fun=find_password";
            var data = {key:key,email:email, codekey:codekey,captcha:captcha, password:password, client:'wap'};
        }
        
        if($.sValid()){
            $.ajax({
                type:'post',
                url:url,  
                data:data,
                dataType:'json',
                success:function(result){
                    console.log(result);
                    if(!result.datas.error){
                        addCookie('username',result.datas.username);
                        addCookie('key',result.datas.key);
            			errorTipsShow("<p>重设密码成功，正在跳转...</p>");
            			setTimeout("location.href = WapSiteUrl+'/tmpl/member/member.html'",3000);
                    }else{
                        errorTipsShow("<p>"+result.datas.error+"</p>");
                    }
                }
            });         
        }
    });
});
