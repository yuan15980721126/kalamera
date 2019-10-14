$(function(){
    var key = getCookie('key');
    if (key) {
        window.location.href = WapSiteUrl+'/tmpl/member/member.html';
        return;
    }
    loadSeccode();
    $("#refreshcode").bind('click',function(){
        loadSeccode();
    });
    $.getJSON(ApiUrl + '/index.php?model=connect&fun=get_state&t=connect_sms_reg', function(result){
        if (result.datas != '0') {
            $('.register-tab').show();
        }
    });
    
	$.sValid.init({//注册验证
        rules:{
        	username:"required",
            userpwd : {
                required : true,
                minlength: 6,
                maxlength: 20
            },         
            password_confirm : {
                required : true,
                equalTo  : '#userpwd'
            },
            email:{
            	required:true,
            	email:true
            },
            mobile:{
                required:true,
                mobile:true
            },
            captcha: {
                required:true,
                minlength:4
            },
            agree:{
                required: true,
            }
        },
        messages:{
            username:"用户名必须填写！",
            userpwd  : {
                required : '密码必填!',
                minlength: '密码长度不得小于6位',
                maxlength: '密码长度不得大于20位'
            },
            password_confirm : {
                required : '请再次输入密码',
                equalTo  : '两次输入的密码不一致'
            },
            email:{
            	required:"邮件必填!",
            	email:"邮件格式不正确"
            },
            mobile:{
                required:"请填写手机号！",
                mobile:"手机号码不正确"
            },
            captcha: {
                required : "请填写图形验证码",
                minlength : "图形验证码不正确"
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
	
	$('#registerbtn').click(function(){
        if (!$(this).parent().hasClass('ok')) {
            return false;
        }
		var username = $("input[name=username]").val();
		var pwd = $("input[name=pwd]").val();
		var password_confirm = $("input[name=password_confirm]").val();
		var email = $("input[name=email]").val();
        var mobile = $("input[name=mobile]").val();
		var client = 'wap';
        var captcha = $("input[name=captcha]").val();
		var codekey = $("#codekey").val();
        var shuffle = $.trim($("#shuffle").val());
		if($.sValid()){
			$.ajax({
				type:'post',
				url:ApiUrl+"/index.php?model=login&fun=register",	
				data:{username:username,password:pwd,password_confirm:password_confirm,email:email,mobile:mobile,client:client,captcha:captcha,codekey:shuffle},
				dataType:'json',
				success:function(result){
					if(!result.datas.error){
						if(typeof(result.datas.key)=='undefined'){
							return false;
						}else{
                            // 更新cookie购物车
                            updateCookieCart(result.datas.key);
							addCookie('username',result.datas.username);
							addCookie('key',result.datas.key);
							location.href = WapSiteUrl+'/tmpl/member/member.html';
						}
		                errorTipsHide();
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
	
	
	
	
	
	$("#tab_head>div").click(function(){
		$("#tab_head>div").find("span").removeClass("Ncur");
		$("#tab_head>div").find("i").removeClass("Ncur");
		$(this).find("span").addClass("Ncur");
		$(this).find("i").addClass("Ncur");
	});
	$("#tab_head>div").eq(0).click(function(){
		$("#ks_reg").show();
		$("#ptreg").hide();
		
	});
	$("#tab_head>div").eq(1).click(function(){
		$("#ks_reg").hide();
		$("#ptreg").show();
		
		
	});
	
	
});