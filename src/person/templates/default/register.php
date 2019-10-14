<?php defined('interMarket') or exit('Access Invalid!');?>

<!--中间内容-->
<div class="wall_bg clearfix">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="login_shadow_box">
                    <div class="login_title login_grey_bg padding-15">Create an Account</div>
                    <form class='form_control ' id="register_validate" method="post" class="nc-login-form" action="<?php echo urlLogin('login', 'usersave');?>">
                            <?php Security::getToken();?>
                        <p class="label_txt">
                            Creating an account lets you easily track and return purchases, save time with expedited checkout, create lists of favorite products, keep track of your projects, and more.
                        </p><p class="label_txt">
                            Email Address <span class="red">*</span>
                        </p>
                        <input type="text" id="user_name" name="user_name" />
                        <ul class="ul-li-float-inline">
                            <li>
                                <p class="label_txt">
                                    First Name <span class="red">*</span>
                                </p>
                                <input type="text" name="firstName" >
                            </li>
                            <li>
                                <p class="label_txt">
                                    Last Name <span class="red">*</span>
                                </p>
                                <input type="text" name="lastName" >
                            </li>
                        </ul>
                        <p class="label_txt">
                            Password <span class="red">*</span>  Minimum of 6 characters
                        </p>
                        <input type="password" id="password" name="password" >
                        <p class="label_txt">
                            Confirm Password <span class="red">*</span>  Minimum of 6 characters
                        </p>
                        <input type="password" name="password_confirm" >
                        <div class="text-center">
                            <input type="hidden" name="form_submit" value="ok" />
                            <input type="submit" value="Create Account" class="create_account_btn"/>
                            <a href="<?php echo urlLogin('login', 'login');?>" class="to_login">Already have an account?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--中间内容结束-->


<?php if (C('sms_password') == 1){?>
<script type="text/javascript" src="<?php echo LOGIN_RESOURCE_SITE_URL;?>/js/connect_sms.js" charset="utf-8"></script> 
<?php } ?>
<script>
$(function(){
	jQuery.validator.addMethod("letters_name", function(value, element) {
		return this.optional(element) || (/^[A-Za-z0-9\u4e00-\u9fa5_-]+$/i.test(value) && !/^\d+$/.test(value));
	}, "Letters only please");
	//初始化Input的灰色提示信息  
	// $('input[tipMsg]').inputTipT ext({pwd:'password,password_confirm'});
	//注册方式切换
	// $('.nc-register-mode').tabulous({
	// 	 //动画缩放渐变效果effect: 'scale'
	// 	 effect: 'slideLeft'//动画左侧滑入效果
	// 	//动画下方滑入效果 effect: 'scaleUp'
	// 	//动画反转效果 effect: 'flip'
	// });
	var div_form = '#default';
	// $(".nc-register-mode .tabs-nav li a").click(function(){
 //        if($(this).attr("href") !== div_form){
 //            div_form = $(this).attr('href');
 //            $(""+div_form).find(".makecode").trigger("click");
 //    	}
	// });
	
//注册表单验证

    $("#register_validate").validate({
        // errorPlacement: function(error, element){
            // var error_td = element.parent('dd');
            // // console.log(element.attr( "id" ));
            // var text = error[0].innerText;
            // var msg = $( element ).parent().next();
            // // console.log(text);
            // msg.text(text);
            // msg.show();
            // window.t=$( element )

        // },
        
    	// submitHandler:function(form){ 
     //        // console.log(error);
    	//     ajaxpost('post_form2', '', '', 'onerror');
    	// },
        onkeyup: false,
        rules : {
            // phone: {
            //     required : true,
            //     mobile : true,
            //     remote   : {
            //         url : 'index.php?model=login&fun=check_mobile_re',
            //         type: 'get',
            //         data:{
            //             phone : function(){
            //                 return $('#phone').val();
            //             }
            //         }
            //     }
            // },
            user_name : {
                required: true,
                email: true,
                remote   : {
                    url :'index.php?model=login&fun=check_member&column=ok',
                    type:'get',
                    data:{
                        user_name : function(){
                            return $('#user_name').val();
                        }
                    }
                }
            },
            firstName : {
                required : true,
                minlength: 3,
                maxlength: 50
            },
            lastName : {
                required : true,
                minlength: 3,
                maxlength: 50
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
            
			<?php if(C('captcha_status_register') == '1') { ?>
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
                        	document.getElementById('codeimage2').src='index.php?model=seccode&fun=makecode&type=50,120&nchash=<?php echo getNchash();?>&t=' + Math.random();
                        }
                    }
                }
            },
			<?php } ?>
        },
        messages : {
             user_name : {
                 required : '<i class="icon-exclamation-sign"></i>Mailbox cannot be empty',
                 email : '<i class="icon-exclamation-sign"></i>The mailbox format is incorrect',
				 remote	 : '<i class="icon-exclamation-sign"></i>The user already exists',
             },
            firstName  : {
                required : '<i class="icon-exclamation-sign"></i>First Name cannot be empty',
                minlength: '<i class="icon-exclamation-sign"></i>First Name length should be between 3 and 50 characters',
                maxlength: '<i class="icon-exclamation-sign"></i>First Name length should be between 3 and 50 characters'
            },
            lastName  : {
                required : '<i class="icon-exclamation-sign"></i>last Name cannot be empty',
                minlength: '<i class="icon-exclamation-sign"></i>last Name length should be between 3 and 50 characters',
                maxlength: '<i class="icon-exclamation-sign"></i>last Name length should be between 3 and 50 characters'
            },
            password  : {
                required : '<i class="icon-exclamation-sign"></i>Password cannot be empty',
                minlength: '<i class="icon-exclamation-sign"></i>Password length should be between 6 and 20 characters',
				maxlength: '<i class="icon-exclamation-sign"></i>Password length should be between 6 and 20 characters'
            },
            password_confirm : {
                required : '<i class="icon-exclamation-sign"></i>Please enter your password again',
                equalTo  : '<i class="icon-exclamation-sign"></i>Two inconsistent passwords'
            },

			<?php if(C('captcha_status_register') == '1') { ?>
            captcha : {
                required : '<i class="icon-remove-circle"></i>Please enter the validation code',
				remote	 : '<i class="icon-remove-circle"></i>Verification code incorrect'
            },
			<?php } ?>

        }
    });

    




});
</script>

