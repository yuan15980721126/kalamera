<?php defined('interMarket') or exit('Access Invalid!');?>


<!--中间内容-->
<div class="page_form clearfix">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <div class="login_title padding-top-10">Product Registration</div>
                    <form action="/index.php?model=store_joininc&fun=step2" class="form_control" id="contact_form" method="post">
                        <?php Security::getToken();?>
                        <input type="hidden" name="form_submit" value="ok" />
                        <input name="nchash" type="hidden" value="<?php echo getNchash();?>" />
                        <p class="label_txt">
                            You can register your order even you purchased from other retailers for better and direct service. We will use this information provided on this form to you only concerning Kalamera products or news. We will not sell, rent or share your personal information.

                            <br>
                            All fields with an <span class="red">*</span> are required.
                        </p>
                        <br>
                        <h4>Contact info:</h4>
                        <ul class="ul_three_col">
                            <li>
                                <p class="label_txt">
                                    First name  <span class="red">*</span>
                                </p>
                                <input type="text" name="true_name" class="required">
                            </li>
                            <li>
                                <p class="label_txt">
                                    Last name  <span class="red">*</span>
                                </p>
                                <input type="text" name="last_name" class="required">
                            </li>
                            <li>
                                <p class="label_txt">
                                    Phone <span class="red">*</span>
                                </p>
                                <input type="text" name="phone" class="required">
                            </li>
                            <li>
                                <p class="label_txt">
                                    Email address <span class="red">*</span>
                                </p>
                                <input type="text" name="email" class="required">
                            </li>
                            <li>
                                <p class="label_txt">
                                    City <span class="red">*</span>
                                </p>
                                <input type="text" name="city" class="required">
                            </li>
                            <li>
                                <p class="label_txt">
                                    ZIP Code or Postal Code <span class="red">*</span>
                                </p>
                                <input type="text" name="code" class="required">
                            </li>
                        </ul>

                        <p class="label_txt">
                            State or Province <span class="red">*</span>
                        </p>
                        <input type="text" name="province" class="required">

                        <p class="label_txt">
                            Address <span class="red">*</span>
                        </p>
                        <input type="text" name="address" class="required">
                        <br />
                        <h4 class="" style="margin-top:30px">Order info:</h4>
                        <p class="label_txt">
                            1.Do you have an order number?  <span class="red">*</span>
                        </p>
                        <input type="text" name="info1" class="required">

                        <p class="label_txt">
                            2.Where did you purchase from?
                        </p>
                        <input type="text" name="info2" class="">

                        <p class="label_txt">
                            3.What is the model number?
                        </p>
                        <input type="text" name="info3" class="">
                        <p class="label_txt">
                            4.When did you purchase the item?
                        </p>
                        <input type="text" name="info4" class="">


                        <p class="label_txt">
                            Message
                        </p>
                        <textarea name="message" class="txtArea" id=""></textarea>

                        <p class="label_txt">
                            Verification Code <span class="red">*</span>
                        </p>
                        <a class="makecode" href="javascript:void(0)" onclick="javascript:document.getElementById('codeimage').src='index.php?model=seccode&fun=makecode&type=50,120&nchash=<?php echo getNchash();?>&t=' + Math.random();">
                            <img src="index.php?model=seccode&fun=makecode&type=50,120&nchash=<?php echo getNchash();?>" name="codeimage"id="codeimage">
                        </a>
                        <input type="text" id="captcha" name="captcha" maxlength="4" size="10" class="inp" autocomplete="off" placeholder="Verification Code" >

                        <div class="text-center margin-top-25">
                            <input type="hidden" name="type" value="support" />
                            <input type="submit" value="SEND" class="send"/>
                            <input type="reset" value="CLEAR" class="reset">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--中间内容结束-->


<script>
    $("#contact_form").validate({
        onkeyup: false,
        rules: {
            true_name:"required",
            email: {
                required:true,
                email:true
            },
            phone:{
                required:true,
            },
            address:"required",
            // message:"required",
            captcha : {
                required : true,
                minlength: 4,
                // remote   : {
                //     url : 'index.php?model=seccode&fun=check&nchash=<?php echo getNchash();?>',
                //     type: 'post',
                //     data:{
                //         captcha : function(){
                //             return $('#captcha').val();
                //         }
                //     },
                //     dataType: 'json',
                //     complete: function(data) {
                //         if(data.responseText == 'false') {
                //             document.getElementById('codeimage').src='index.php?model=seccode&fun=makecode&type=50,120&nchash=<?php echo getNchash();?>&t=' + Math.random();
                //         }
                //     }
                // }
            },
        },
        messages: {
            true_name:"Please fill in your name！",
            email: {
                required : "Please fill in the mailbox number",
                email : "Incorrect mailbox"
            },
            phone:{
                required: "Please fill in your cell phone number！",
            },
            address:"Please enter your address",
            // message:"Please enter the message content",
            captcha: {
                required : 'Please enter the validation code',
                minlength: 'Verification code incorrect',
                // remote:'验证码不正确',
            }
        }
    });
    // 表单验证

</script>






