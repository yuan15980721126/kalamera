<?php defined('interMarket') or exit('Access Invalid!');?>

<!--当前位置结束-->
<div class="container padding_25_0">
    <div class="col-md-4">
        <div class="contact">
            <div class="txt">
                <p class="first_t">Kalamera Inc.</p>
                <div class="padding-top-10">
                    <strong>Phone :</strong><span><?php echo $output['list_setting']['site_phone'];?></span>
                </div>
                <div class="padding-top-10">
                    <strong>E-MAIL :</strong><span><?php echo $output['list_setting']['site_email'];?></span>
                </div>
                <div class="padding-top-10">
                    <strong>ADDRESS :</strong><span><?php echo $output['list_setting']['site_address'];?></span>
                </div>
                <p class="first_t padding-t-30">Online message</p>
            </div>
            <form action="/index.php?model=store_joininc&fun=step2" class="form_control" id="contact_form" method="post">
                <?php Security::getToken();?>
                <input type="hidden" name="form_submit" value="ok" />
                <input name="nchash" type="hidden" value="<?php echo getNchash();?>" />
                <input type="text" name="true_name"  placeholder="Name *">
                <input type="text" name="email" placeholder="Email *">
                <input type="text" name="phone"  id="phone" placeholder="Phone *">
                <textarea name="message" id="message" class="txtArea " placeholder="Message *"></textarea>
                <input type="text" id="captcha" name="captcha" maxlength="4" size="10" class="inp" autocomplete="off" placeholder="Verification Code" >
                <a class="makecode" href="javascript:void(0)" onclick="javascript:document.getElementById('codeimage').src='index.php?model=seccode&fun=makecode&type=50,120&nchash=<?php echo getNchash();?>&t=' + Math.random();">
                    <img src="index.php?model=seccode&fun=makecode&type=50,120&nchash=<?php echo getNchash();?>" name="codeimage"id="codeimage">
                </a>
                <input type="hidden" name="type" value="contact" />
                <input type="submit" value="Submit" class="send blue_theme_bg" style="display: block;">
            </form>
        </div>
    </div>
    <div class="col-md-8 about">
<!--        <div class="about_map">-->
<!--            <form class="hide" action="http://www.longfapower.com/phoenix/admin/map/google" target="gMapShowIframe_UwpAKUWMDYfN" method="POST" name="gMapForm_UwpAKUWMDYfN">-->
<!--                <input type="hidden" name="gMapApiKey" value="AIzaSyBBapqwY2TesDgCcedS2SKukX3s10q5Dzc" />-->
<!--                <input type="hidden" name="settingId" value="UwpAKUWMDYfN" />-->
<!--                <input type="hidden" name="gMapLng" value="113.2410006094" />-->
<!--                <input type="hidden" name="gMapLat" value="22.7236184132" />-->
<!--                <input type="hidden" name="gMapType" value="0" />-->
<!--                <input type="hidden" name="trans_gMapPosName" value="香港九龙么地道62号永安广场高层地下36-37A号铺 （港铁尖沙咀站/尖东店P1出口直达永安广场，地面上一层扶手电梯旁）" />-->
<!--            </form>-->
<!--            <iframe class="map" id="gMapShowIframe_UwpAKUWMDYfN" name="gMapShowIframe_UwpAKUWMDYfN" frameborder="0" about="_blank"></iframe>-->
<!--        </div>-->
    </div>
</div>
<!--中间内容结束-->

<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
<script type="text/javascript">
    call();
</script>
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
            message:"required",
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
            message:"Please enter the message content",
            captcha: {
                required : 'Please enter the validation code',
                minlength: 'Verification code incorrect',
                // remote:'验证码不正确',
            }
        }
    });
    // 表单验证

</script>
<!--地图-->
<!--<script src="http://www.google.cn/maps/api/js?key=AIzaSyBSzQjUOVAoSvO3Zg3GnlFRGCGOl3j6LOQ&callback=initMap"></script>-->
<script>
    $(function() { document.forms['gMapForm_UwpAKUWMDYfN'].submit(); });
    $(function() {
        if($(window).width() < 768) {
            $('#subnav1').css('background-position', '70% center');
        }
    });
</script>
<!--地图结束-->
<!--script结束-->