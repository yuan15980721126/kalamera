$(function(){
	
	if($("#email_1").hasClass("_safe")){
		$("#email_2").html('<span class="hui">您已绑定的邮箱:</span>	<span class="black">3*****4@qq.com</span>');
		$("#email_3").html("修改")
	}else if($("#email_1").hasClass("_dan")){
		$("#email_2").html('<span class="hui">轻松找回密码，验证身份。</span>');
		$("#email_3").html("绑定")
	}
	
	
	if($("#mbphone_1").hasClass("_safe")){
		$("#mbphone_2").html('<span class="hui">您已绑定的手机号码: </span><span class="black">135****851 </span><span class="hui">若一丢失或停用，请立即更换，</span><span class="red">避免账户被盗</span>');
		$("#mbphone_3").html("修改")
	}else if($("#mbphone_1").hasClass("_dan")){
		$("#mbphone_2").html('<span class="hui">轻松找回密码，验证身份。</span>');
		$("#mbphone_3").html("绑定")
	}
	
	if($("#pay_1").hasClass("_safe")){
		$("#pay_2").html('<span class="red">支付密码关系到您的财产安全，建议您定期更换密码。</span>');
		$("#pay_3").html("修改")
	}else if($("#pay_1").hasClass("_dan")){
		$("#pay_2").html('<span class="red">支付密码关系到您的财产安全，建议您定期更换密码。</span>');
		$("#pay_3").html("绑定")
	}
	
	
	
	

	$("#email_3").click(function(){
		if($(this).html()=="绑定"){
			location.href="setemail.html"
		}else{
			location.href="verificationmode.html"
		}
	})
	$("#mbphone_3").click(function(){
		if($(this).html()=="绑定"){
			location.href="Setphone.html"
		}else{
			location.href="Ghphone.html"
		}
	})
	
	$("#pay_3").click(function(){
		if($(this).html()=="绑定"){
			location.href="Bpay.html"
		}else{
			location.href="Ghpay.html"
		}
	})
	
	
	
})
