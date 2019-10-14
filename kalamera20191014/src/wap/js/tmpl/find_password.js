$(function(){
    var key = getCookie('key');
    if (key) {
        // window.location.href = WapSiteUrl+'/tmpl/member/login.html';
        // return;
        $('#top_right').hide();
        $.ajax({
            type:'get',
            url:ApiUrl+"/index.php?model=member_account&fun=get_mobile_info",
            data:{key:key},
            dataType:'json',
            success:function(result){
                if(result.code == 200){
                    if (result.datas.state) {
                        // $('#mobile_link').attr('href','member_mobile_modify.html');
                        
                        $('#mobile_info').val(result.datas.mobile_info);
                        $('#usermobile').val(result.datas.mobile).attr("readonly","readonly");

                    }
                }else{
                }
            }
        });
    }else{
        $('#mobile_info').remove();
    }
    //加载验证码
    loadSeccode();
    $("#refreshcode").bind('click',function(){
        loadSeccode();
    });
    
 
    $.sValid.init({//注册验证
        rules:{
            usermobile:{
                required:true,
                mobile:true
            },
            captcha: {
                required:true,
                minlength:4
            }
        },
        messages:{
            usermobile:{
                required:"请填写手机号！",
                mobile:"手机号码不正确"
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
    
	$('#find_password_btn').click(function(){
        if (!$(this).parent().hasClass('ok')) {
            return false;
        }
	    if ($.sValid()) {
            if (key) {
                var mobile = $('#mobile_info').val();
            }else{
                var mobile = $('#usermobile').val();
            }
            
            var sec_val = $('#captcha').val();
            var sec_key = $('#shuffle').val();

            send_sms(mobile, sec_val, sec_key);
	    } else {
	        return false;
	    }
	});
});
// 发送手机验证码
function send_sms(mobile, sec_val, sec_key) {
    $.getJSON(ApiUrl+'/index.php?model=connect&fun=get_sms_captcha', {type:3,phone:mobile,sec_val:sec_val,sec_key:sec_key}, function(result){
        if(!result.datas.error){
            $.sDialog({
                skin:"green",
                content:'发送成功',
                okBtn:false,
                cancelBtn:false
            });
            // $(this).attr('href', 'find_password_code.html?mobile=' + $('#mobile_info').val() + '&captcha=' + $('#captcha').val() + '&codekey=' + $('#shuffle').val());
            setTimeout(location.href = WapSiteUrl+"/tmpl/member/find_password_code.html?mobile="+mobile+"&captcha="+sec_val+"&codekey="+sec_key,3000)   
        }else{
            loadSeccode();
            errorTipsShow('<p>' + result.datas.error + '</p>');
            $('#captcha').val('');
        }
    });
}