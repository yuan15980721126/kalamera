<?php defined('interMarket') or exit('Access Invalid!');?>

    <!--中间内容-->
    <div class="wall_bg clearfix">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="login_shadow_box">
                        <div class="login_title login_grey_bg padding-15">Returning Customer</div>


                        <form class="form_control" id="login_validate" method="post" action="<?php echo urlLogin('login', 'index');?>">
                            <?php Security::getToken();?>
                            <input type="hidden" name="form_submit" value="ok" />
                            <input name="nchash" type="hidden" value="<?php echo getNchash();?>" />
                            <p class="label_txt">
                                Email Address <span class="red">*</span>
                            </p>
                            <input type="text" id="user_name" name="user_name" >
                            <p class="label_txt">
                                Password <span class="red">*</span>
                            </p>
                            <input type="password" id="password"  name="password" >
                            <div class="padding_15-0 clearfix">
                                <div class="fl">
                                    <input type="checkbox" class="remember" name="remember" id="remember" <?php if($_COOKIE['remember'] == 1){?> value="1" checked <?php }else{($_COOKIE['remember'] == "")?> value="1" <?php }?>/>Remember me
                                </div>
                                <div class="fr">
                                    <a href="<?php echo urlLogin('login', 'forget_password');?>" class="grey">Forgot your password ?</a>
                                </div>
                            </div>
                            <input type="submit" value="Sign in" class="sign-in">
                            <input type="hidden" value="<?php if(!strstr($_GET['ref_url'],'repassword')){ ?><?php echo $_GET['ref_url']?><?php } ?>" name="ref_url">
                            <!--   <div class="other_login">
                                <p class="or">OR</p>
                                <ul>
                                    <li><a href="<?php echo LOGIN_SITE_URL . '/index.php?model=connect_fb' ?>">Continue with Facebook</a></li>
                                   <li><a href="">Continue with Linkedin</a></li>
                                    <li><a href="">Continue with Google</a></li>
                                    <li><a href="">Continue with Twitter</a></li>
                                </ul>
                            </div>>-->
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="padding-50 create_account_box">
                        <div class="login_title ">Create an Account</div>
                        <ul class="create_list">
                            <li>Easily track and manage your orders</li>
                            <li>Save all of your order history and set up returns</li>
                            <li>Quickly checkout</li>
                            <li>Create a Favorites List of your favorite products</li>
                            <li>Review the products you purchased</li>
                        </ul>
                        <a href="<?php echo urlLogin('login', 'register', array('ref_url' => $_GET['ref_url']));?>" class="create_account">
                            Create Account
                        </a>
                    </div>
                </div>
            </div>
        </div>+
    </div>
    <!--中间内容结束-->

    <script>
        // 表单验证
        // $(document).ready(function() {
        //     $("#login_validate").validate();
        // });
    </script>
    <!--script结束-->









<script>
$(function(){

	//初始化Input的灰色提示信息  
	// $('input[tipMsg]').inputTipText({pwd:'password'});
	//登录方式切换
	// $('.nc-login-mode').tabulous({
	// 	 effect: 'flip'//动画反转效果
	// });
	var div_form = '#default';
	$(".nc-login-mode .tabs-nav li a").click(function(){
        if($(this).attr("href") !== div_form){
            div_form = $(this).attr('href');
            $(""+div_form).find(".makecode").trigger("click");
        }
    });
	
	$("#login_validate").validate({
        // errorPlacement: function(error, element){
        //     // var error_td = element.parent('div');
        //     // error_td.append(error);
        //
        //     $(element).removeClass("error");
        //     $('#error_tip').show();
        //     $('#error_tip').text(error[0].innerText);
        //
        // },
        success: function(label) {
            // $('#error_tip').hide();
            // label.parents('dl:first').removeClass('error').find('label').remove();
        },
    	submitHandler:function(form){
    	    ajaxpost('login_validate', '', '', 'onerror');
    	},
        onkeyup: false,
		rules: {
			user_name : "required",
			password : "required",
			<?php if(C('captcha_status_login') == '1') { ?>
            captcha : {
                required : true,
                remote   : {
                    url : 'index.php?model=seccode&fun=check&nchash=<?php echo getNchash();?>',
                    type: 'get',
                    data:{
                        captcha : function(){
                            return $('#captcha').val();
                        }
                    },
                    complete: function(data) {
                        if(data.responseText == 'false') {
                        	document.getElementById('codeimage').src='index.php?model=seccode&fun=makecode&type=50,120&nchash=<?php echo getNchash();?>&t=' + Math.random();
                        }
                    }
                }
            }
			<?php } ?>
		},
		messages: {
			user_name: "<i class='icon-exclamation-sign'></i>请输入已注册的用户名或手机号",
			password: "<i class='icon-exclamation-sign'></i><?php echo $lang['login_index_input_password'];?>",
			<?php if(C('captcha_status_login') == '1') { ?>
            captcha : {
                required : '<i class="icon-remove-circle" title="<?php echo $lang['login_index_input_checkcode'];?>"></i>',
				remote	 : '<i class="icon-remove-circle" title="<?php echo $lang['login_index_input_checkcode'];?>"></i>'
            }
			<?php } ?>
		}
	});

    // 勾选自动登录显示隐藏文字
    $('input[name="auto_login"]').click(function(){
        if ($(this).attr('checked')){
            $(this).attr('checked', true).next().show();
        } else {
            $(this).attr('checked', false).next().hide();
        }
    });
});
</script>
<?php if (C('sms_login') == 1){?>
<script type="text/javascript" src="<?php echo LOGIN_RESOURCE_SITE_URL;?>/js/connect_sms.js" charset="utf-8"></script>
<script>
$(function(){
	$("#post_form").validate({
        errorPlacement: function(error, element){
            var error_td = element.parent('div');
            error_td.append(error);
            element.parents('dl:first').addClass('error');
        },
        success: function(label) {
            label.parents('dl:first').removeClass('error').find('label').remove();
        },
    	submitHandler:function(form){
    	    ajaxpost('post_form', '', '', 'onerror');
    	},
        onkeyup: false,
		rules: {
			phone: {
                required : true,
                mobile : true
            },
			captcha : {
                required : true,
                minlength: 4,
                remote   : {
                    url : 'index.php?model=seccode&fun=check&nchash=<?php echo getNchash();?>',
                    type: 'get',
                    data:{
                        captcha : function(){
                            return $('#image_captcha').val();
                        }
                    },
                    complete: function(data) {
                        if(data.responseText == 'false') {
                        	document.getElementById('sms_codeimage').src='index.php?model=seccode&fun=makecode&type=50,120&nchash=<?php echo getNchash();?>&t=' + Math.random();
                        }
                    }
                }
            },
			sms_captcha: {
                required : function(element) {
                    return $("#image_captcha").val().length == 4;
                },
                minlength: 6
            }
		},
		messages: {
			phone: {
                required : '<i class="icon-exclamation-sign"></i>请输入正确的手机号',
                mobile : '<i class="icon-exclamation-sign"></i>请输入正确的手机号'
            },
			captcha : {
                required : '<i class="icon-remove-circle" title="请输入正确的验证码"></i>',
                minlength: '<i class="icon-remove-circle" title="请输入正确的验证码"></i>',
				remote	 : '<i class="icon-remove-circle" title="请输入正确的验证码"></i>'
            },
			sms_captcha: {
                required : '<i class="icon-exclamation-sign"></i>请输入六位短信验证码',
                minlength: '<i class="icon-exclamation-sign"></i>请输入六位短信验证码'
            }
		}
	});
});
</script>
<?php } ?>