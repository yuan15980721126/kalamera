	function get_sms_captcha(type){
        if($("#phone").val().length == 11 && $("#image_captcha").val().length == 4){
            var ajaxurl = 'index.php?model=connect_sms&fun=get_captcha&nchash=1&type='+type;
            ajaxurl += '&captcha='+$('#image_captcha').val()+'&phone='+$('#phone').val();
			$.ajax({
				type: "GET",
				url: ajaxurl,
				async: false,
				success: function(rs){
                    if(rs == 'true') {
                    	$("#sms_text").html('短信动态码已发出');
                    } else {
                        showError(rs);
                    }
			    }
			});
    	}
	}
	function check_captcha(type,way=''){
        if($("#phone").val().length == 11 ){
            if(way == 1){
                if($("#captcha").val().length != 4){
                    $("#captcha_tip").text('请输入验证码');
                    $("#captcha_tip").show();
                    return false;
                }
            }
            var ajaxurl = 'index.php?model=connect_sms&fun=get_captcha&type='+type;
            // ajaxurl += '&sms_captcha='+$('#sms_captcha').val()+'&phone='+$('#phone').val();
            ajaxurl += '&status=1'+'&phone='+$('#phone').val();
			$.ajax({
				type: "GET",
				url: ajaxurl,
				async: false,
				success: function(rs){
            	    if(rs == 'true') {
                        if(way == 1){
                            $("#sms_text").html('短信已发出');
                        }else{
                            alert('验证码发送成功');
                        }
                        

            	        // $.getScript('index.php?model=connect_sms&fun=register'+'&phone='+$('#phone').val());
            	        // $("#register_sms_form").show();
            	        // $("#post_form").hide();
            	    } else {
            	        showError(rs);
            	    }
			    }
			});
    	}
	}