<?php defined('interMarket') or exit('Access Invalid!');?>

<link rel="stylesheet" href="/skins/default/css/Mycollect.css" />
<div class="order_nav evaluate_  clearfix">
    <div class="fl" style="margin-top: 13px;margin-left: 10px;">
        <div class="order_li " id="order_li1">
            <a href="<?php echo urlMember('member_voucher','voucher_list');?>">
                My Coupon
            </a>
        </div>
        <div class="order_li orderli_active" id="order_li2">
            <a href="<?php echo urlMember('member_voucher','voucher_binding');?>">
                Collect coupons
            </a>
        </div>
    </div>

</div>

<div class="alert alert-success">
    <h4>Operation hint ：</h4>
    <ul>
        <li>1.You can get the coupon or enter the serial number of the coupon you have obtained to get the coupon</li>
        <li>
            2.After receiving the coupons, you can select the coupons that meet the use conditions to deduct the order amount when you place an order for the purchased goods.</li>
    </ul>
</div>

<div class="ncm-default-form">
    <form method="post" id="bind_form" action="<?php echo MEMBER_SITE_URL;?>/index.php?model=member_voucher&fun=voucher_binding">
        <input type="hidden" name="form_submit" value="ok" />
        <input name="nchash" type="hidden" value="<?php echo getNchash();?>" />

        <div class="form-group">
            <label for="exampleInputEmail1">Please enter the coupon serial number</label>
            <input type="text"  class="form-control" value="" name="pwd_code" id="pwd_code" autocomplete="off"/>
            <span class="error_span"></span>

        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Verification Code </label>
            <input type="text"  class="form-control" value="" name="captcha" id="captcha" maxlength="4" size="10" autocomplete="off"/>

            <br><img src="index.php?model=seccode&fun=makecode&type=30,92&nchash=<?php echo getNchash();?>" name="codeimage" border="0" id="codeimage" class="ml5 vm">
            <a href="javascript:void(0)" class="ml5 blue" onclick="javascript:document.getElementById('codeimage').src='index.php?model=seccode&fun=makecode&type=30,92&nchash=<?php echo getNchash();?>&t=' + Math.random();">I can't see ?another picture</a>
            <span class="error_span"></span>
        </div>
        <button type="button" class="btn btn-default" id="submitbtn" class="btn btn-default">Submit</button>


    </form>
</div>





<script src="<?php echo RESOURCE_SITE_URL;?>/js/input_max.js"></script>
<script type="text/javascript">
//input内容放大
$(function(){
    new TextMagnifier({
        inputElem: '.inputElem',
        align: 'top',
        splitType :[5,5,5,5]
    });
});
var submiting = false;
$(function(){
    $('#submitbtn').on('click',function(){
        if (submiting) {
            return false;
        }
        if (!$('#bind_form').valid()){
            document.getElementById('codeimage').src='index.php?model=seccode&fun=makecode&type=30,92&nchash=<?php echo getNchash();?>&t=' + Math.random();
        } else {
            submiting = true;
            ajaxpost('bind_form', '', '', 'onerror',$(this));
        }
    });

    $('#bind_form').validate({
        // errorPlacement: function(error, element){
        //     element.closest('form-group').find('.error_span').append(error);
        // },
        rules : {
        	pwd_code : {
                required : true
            },
            captcha : {
                required : true,
                minlength: 4,
                remote   : {
                    url : 'index.php?model=seccode&fun=check&nchash=<?php echo getNchash();?>',
                    type: 'get',
                    async: false,
                    data:{
                        captcha : function(){
                            return $('#captcha').val();
                        }
                    }
                }
            }
        },
        messages : {
            pwd_code : {
                required : '<i class="icon-exclamation-sign"></i>Please enter the coupon serial number'
            },
            captcha : {
                required : '<i class="icon-exclamation-sign"></i>Please input the graphic verification code correctly',
                minlength: '<i class="icon-exclamation-sign"></i>Please input the graphic verification code correctly',
				remote	 : '<i class="icon-exclamation-sign"></i>Please input the graphic verification code correctly'
            }
        }
    });
});
</script> 
