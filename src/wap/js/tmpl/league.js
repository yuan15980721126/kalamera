//v3-b11
$(function(){
	var ac_id = getQueryString('ac_id')
	var key = getCookie('key');
	if(!key){
		window.location.href = WapSiteUrl + '/tmpl/member/login.html';
    	return;
	}
	if (ac_id=='') {
    	window.location.href = WapSiteUrl + '/index.html';
    	return;
	}else {
		$.ajax({
			url:ApiUrl+"/index.php?model=article&fun=article_show",
			type:'get',
			data:{article_id:ac_id},
			jsonp:'callback',
			dataType:'jsonp',
			success:function(result){
				var data = result.datas;
				data.WapSiteUrl = WapSiteUrl;
				$("#jiammeng").html(result.datas.article_content);
			}
		});
	}



	 loadSeccode();
    $("#refreshcode").bind('click',function(){
        loadSeccode();
    });	
	$.sValid.init({
		rules:{
            true_name:"required",
        	email: {
                required:true,
                email:true
            },
            mobile:{
                required:true,
                mobile:true
            },
            message:"required",
            captcha: {
                required:true,
                minlength:4
            },
           
            
        },
        messages:{
            true_name:"姓名必填！",
          	email: {
                required : "请填写邮箱号",
                email : "邮箱不正确"
            },
            mobile:{
                required:"请填写手机号！",
                mobile:"手机号码不正确"
            },
            message:"请输入留言意向内容",
            captcha: {
                required : "请填写图形验证码",
                minlength : "图形验证码不正确"
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
                errorTipsHide();
			}
		}  
	});
	$('#tijiao').click(function() {
		// alert('dsadas');
		// return false;
		if($.sValid()){
            var true_name = $('#true_name').val();
            var mobile = $('#mobile').val();
            var email = $('#email').val();
            var captcha = $('#captcha').val();
            var shuffle = $('#shuffle').val();
            var codekey = $('#codekey').val();
            // var city_id = $('#area_info').attr('data-areaid2');
            // var area_id = $('#area_info').attr('data-areaid');
            var message = $('#message').val();
            // var is_default = $('#is_default').attr("checked") ? 1 : 0;

			$.ajax({
				type: 'post',
				url: ApiUrl + "/index.php?model=store_joininc&fun=step2",
				dataType: 'json',
				data: {
					key: key,
					true_name: true_name,
					mobile: mobile,
					// city_id: city_id,
					// area_id: area_id,
					email: email,
					captcha: captcha,
					codekey: shuffle,
					message:message,
				},
				
				beforeSend: function () {
                    // 禁用按钮防止重复提交
                    $("#tijiao").prop( "disabled",true );
                },
				success: function(result) {
					
					// console.log(result);
					if (result.code == 200) {
						errorTipsShow("<p>加盟申请提交成功，正在跳转...</p>");
             			setTimeout("location.href = WapSiteUrl+'/index.html'",3000);
					} else {
						errorTipsShow('<p>' + result.datas.error + '</p>');
					}
				}
				,
				complete: function () {
                    $("#tijiao").prop("disabled",false);
                },
			});
		}
	});

});