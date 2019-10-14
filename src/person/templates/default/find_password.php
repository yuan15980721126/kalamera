<?php defined('interMarket') or exit('Access Invalid!');?>

    <!--中间内容-->
    <div class="wall_bg clearfix">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="login_shadow_box">
                        <div class="login_title login_grey_bg padding-15">Forgot your password?</div>
                        <form action="<?php echo urlLogin('login', 'find_password');?>"  method="POST" class="form_control" id="forget_validate">
                            <?php Security::getToken();?>
                            <input type="hidden" name="form_submit" value="ok" />
                            <input name="nchash" type="hidden" value="<?php echo getNchash();?>" />
                            <p class="txt">
                                Enter your email address and we will send you a confirmation email to reset your password.
                            </p>

                            <p class="label_txt">
                                Email Address <span class="red">*</span>
                            </p>
                            <input type="text" name="email" class="required">

                            <p class="label_txt">
                                Verification Code<span class="red">*</span>
                            </p>
                            <input type="hidden" value="<?php echo $output['ref_url']?>" name="ref_url">

                            <input type="text" name="captcha"  maxlength="4" id="captcha" size="10"  />

                            <p class="label_txt">
                                <img src="index.php?model=seccode&fun=makecode&type=50,120&nchash=<?php echo getNchash();?>" title="<?php echo $lang['login_index_change_checkcode'];?>" name="codeimage" id="codeimage">
                                <a class="makecode" href="javascript:void(0);" class="ml5" onclick="javascript:document.getElementById('codeimage').src='index.php?model=seccode&fun=makecode&type=50,120&nchash=<?php echo getNchash();?>&t=' + Math.random();">You can't see clearly. Change one.

                                </a>

                            </p>

                            <ul class="ul-li-float-inline" style="margin-top: 20px;">
                                <li>
                                    <input type="submit" value="Reset My Password" class="sign-in">
                                </li>
                                <li class="back_to_login">
                                    <a href="<?php echo urlLogin('login', 'index', array('ref_url' => $_GET['ref_url']));?>"  class="to_login">Back to Login</a>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--中间内容结束-->

    <script>
        // 表单验证
        //
        $('#forget_validate').validate({
            onkeyup: false,
            rules : {
                // username : {
                //     required : true
                // },
                email : {
                    required : true,
                    email : true
                },
                captcha : {
                    required : true,
                    minlength: 4,
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
            },
            messages : {
                // username : {
                //     required : 'User name cannot be empty'
                // },
                 email  : {
                     required : '<i class="icon-exclamation-sign"></i>E-mail cannot be empty',
                     email : '<i class="icon-exclamation-sign"></i>E-mail format error'
                 },
                captcha : {
                    required : 'Verification code cannot be empty',
                    minlength : 'Verification code error',
                    remote   : 'Verification'
                }
            }
        });
    </script>






