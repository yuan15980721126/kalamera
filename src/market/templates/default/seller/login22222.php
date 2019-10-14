<?php defined('interMarket') or exit('Access Invalid!');?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL?>/css/base.css" />
		<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL?>/css/login.css" />
		<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.js" ></script>
		<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/login.js"></script>
		<script language="JavaScript" type="text/javascript">
// window.onload = function() {
//     tips = new Array(2);
//     tips[0] = document.getElementById("loginBG01");
//     tips[1] = document.getElementById("loginBG02");
//     index = Math.floor(Math.random() * tips.length);
//     tips[index].style.display = "block";
// };
$(document).ready(function() {
		//更换验证码
		function change_seccode() {
				$('#codeimage').attr('src', 'index.php?model=seccode&fun=makecode&nchash=<?php echo $output['nchash'];?>&t=' + Math.random());
				$('#captcha').select();
		}

		$('[nctype="btn_change_seccode"]').on('click', function() {
				change_seccode();
		});

		//登陆表单验证
		$("#form_login").validate({
				errorPlacement:function(error, element) {
						element.prev(".repuired").append(error);
				},
				onkeyup: false,
				rules:{
						seller_name:{
								required:true
						},
						password:{
								required:true
						},
						// captcha:{
						//     required:true,
						//     remote:{
						//         url:"index.php?model=seccode&fun=check&nchash=<?php echo $output['nchash'];?>",
						//         type:"get",
						//         data:{
						//             captcha:function() {
						//                 return $("#captcha").val();
						//             }
						//         },
						//         complete: function(data) {
						//             if(data.responseText == 'false') {
						//                 change_seccode();
						//             }
						//         }
						//     }
						// }
				},
				messages:{
						seller_name:{
								required:"<i class='icon-exclamation-sign'></i>用户名不能为空"
						},
						password:{
								required:"<i class='icon-exclamation-sign'></i>密码不能为空"
						},
						// captcha:{
						//     required:"<i class='icon-exclamation-sign'></i>验证码不能为空",
						//     remote:"<i class='icon-frown'></i>验证码错误"
						// }
				}
		});
	//Hide Show verification code
		$("#hide").click(function(){
				$(".code").fadeOut("slow");
		});
		$("#captcha").focus(function(){
				$(".code").fadeIn("fast");
		});

});
</script>
		
	</head>
	<body>
						
			<div id="Enrool_top">
				<div id="top_c">
					<div>
						<img src="<?php echo SHOP_TEMPLATES_URL?>/images/Enroll/zct_02.jpg" />
					</div>
					
					<div>
						您好，欢迎光临维诺卡夫官方商城！
					</div>
				</div>
			</div>    
			
			
			
			
			
			
			<div id="login">
				<div id="login_image">
					<img src="<?php echo SHOP_TEMPLATES_URL?>/images/Enroll/login_03.jpg" />
				</div>
				
				<div id="login_form">
					<div id="login_head">
						<div class="font_colro">账户登录</div>
						<div>扫码登录</div>
					</div>

					<div id="login_content">
					 
						<ul>
							<li >
								<div id="login_body">
								<div class="boder_text">
									<div></div>
									<div>
										<input type="text" name="seller_name" placeholder="邮箱/用户名/已验证手机" />
									</div>
									
								</div>
								
								

								<div class="boder_text">
									<div id="passwode_image"></div>
									<div>
										<input type="password" name="password" placeholder="密码" />
									</div>
									
								</div>
								
								
								<div class="re_password"><input type="checkbox" id="remember" /><label for="remember">记住用户名</label></div>
								
								
								<!-- <input type="submit" id="login-submit" value="登&nbsp;录"></div> -->
								<div id="login_btn">登&nbsp;录</div>
								
								
								<div id="bo">
									<a href="RpasswordS1.html">忘记密码</a>
									<a href="PlainEnroll.html">立即注册</a>
								</div>
								
									
								</div>
								<div id="login_bottom">
									<div>使用合作网站账号登录：</div>
									<div>
										<a href="#">
											<img src="<?php echo SHOP_TEMPLATES_URL?>/images/Enroll/qqlogin_14.jpg" />
										</a>
									</div>
									
								</div>  
							</li>
							
							
							
							
							<li id="sm_login" style="display: none;">
								
								<div>
									<img src="<?php echo SHOP_TEMPLATES_URL?>/images/Enroll/rewcode_03.jpg" />
								</div>
								<div>微信扫一扫</div>
								<div><a href="PlainEnroll.html">免费注册</a></div>
								
							</li>
							
							
							
							
							
							
							
						</ul>
						
						
				 
					</div>
					
					
					
					
					
					
				</div>
				
				
				
				
				
				
				
			</div>
			
		<div id="z_bottom"></div>
		
		
		
		<?php include template('bottom');?>
	</body>
</html>
