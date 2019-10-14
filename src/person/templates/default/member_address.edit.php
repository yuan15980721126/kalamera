<?php defined('interMarket') or exit('Access Invalid!'); ?>
<div id="warning"></div>
<div class="popUp eject_con">
    <div class="popMask" style="display: block;"></div>
    <!--删除地址弹窗-->
    <div class="maskitem delete_addr_pop  delete_addr_">
        <p class="sec_t" style="font-size:20px;text-align: left;margin-bottom: 15px;">Delete address</p>
        <img class="close_" src="/skins/default/img/close_.png" alt="">
        <div class="addr_item">
            James Cameron<br>
            guanzhoujiedaohaiyanhengjie<br>
            New York, NY 10041<br>
            158-753-6653<br>
        </div>
        <a href="javascript:;" class="go_to">delete</a>
        &nbsp;&nbsp;&nbsp;
        <a href="javascript:;" class="go_to">Cancel</a>
    </div>
    <!--修改地址弹框-->
    <div class="maskitem delete_addr_pop  edit_addr_ order_pop" style="display: block;">
        <img class="close_" src="/skins/default/img/close_.png" onclick="DialogManager.close('my_address_edit')" alt="">
        <div class="info_tab dis_b addr_manage pop_max_height border_none">
            <form method="post" class="form_control text-left" action="<?php echo MEMBER_SITE_URL; ?>/index.php?model=member_address&fun=address" id="address_form">
                <input type="hidden" name="form_submit" value="ok"/>
                <input type="hidden" name="id" value="<?php echo $output['address_info']['address_id']; ?>"/>
                <div class="black_wrap">
                    <div>
                        <span class="sec_t inline_b padding-right-7_5">Edit Shipping Address</span>
                        <span class="inline_b"><span class="red">*</span> Fields are required</span>
                    </div>
                    <ul class="ul_two_col">
                        <li>
                            <p class="label_txt">
                                First name <span class="red">*</span>
                            </p>
                            <input class="name" type="text" name="firstName" id="firstName"
                                   value="<?php echo substr($output['address_info']['true_name'], 0, strpos($output['address_info']['true_name'], "-")); ?>"/>

                        </li>
                        <li>
                            <p class="label_txt">
                                Last name <span class="red">*</span>
                            </p>
                            <input class="name" type="text" name="lastName" id="lastName"
                                   value="<?php echo substr($output['address_info']['true_name'], strripos($output['address_info']['true_name'], "-") + 1); ?>"/>

                        </li>
                    </ul>
                    <p class="label_txt">
                        Company Name
                    </p>
                    <input type="text" name="company" value="<?php echo $output['address_info']['company']; ?>">
                    <p class="label_txt">
                        Street Address <span class="red">*</span>
                    </p>
                    <input class="text" type="text" name="address"
                           value="<?php echo $output['address_info']['address']; ?>"/>
                    <p class="label_txt">
                        Apartment,suite,etc:
                    </p>
                    <input type="text" name="apartment" value="<?php echo $output['address_info']['apartment']; ?>">
    <!--                    <p class="label_txt">-->
    <!--                        City <span class="red">*</span>-->
    <!--                    </p>-->
    <!--                    <input type="text" name="city" class="required">-->
                    <p class="label_txt">
                        ZIP code <span class="red">*</span>
                    </p>
                    <input type="text" name="zipcode"  value="<?php echo $output['address_info']['zipcode']; ?>">
                    <p class="label_txt">
                        Location : <span
                                class="red">*</span>
                    </p>
                    <ul class="ul_three_col">
                        <li>
                            <input type="hidden" name="region" id="region"
                                value="<?php echo $output['address_info']['area_info']; ?>">
                            <input type="hidden" name="area_id" class="js_area_1" value="<?php echo $output['address_info']['area_id']; ?>" id="_area" >
                            <input type="hidden" name="city_id" class="js_area_3" value="<?php echo $output['address_info']['city_id']; ?>" id="_area_2" >
                        </li>

                    </ul>
                    <p class="label_txt">
                        Phone Number <span class="red">*</span> Needed for delivery purposes
                    </p>
                    <input type="text" name="mob_phone" value="<?php echo $output['address_info']['mob_phone']; ?>"/>

                    <p class="label_txt">

                        <input type="checkbox"
                               class="preferred-addr" <?php if ($output['address_info']['is_default']) echo 'checked'; ?>
                               name="is_default" id="is_default" value="1">Set as my preferred shipping address
                    </p>
                    <div class="text-center padding-t-25 border-black-t">
                        <input type="submit" value="Save" class="go_to">
                        &nbsp;&nbsp;
                        <a class="ncbtn ml5 go_to" href="javascript:DialogManager.close('my_address_edit');">Cancel</a></div>
                </div>
        </div>

        </form>
    </div>
</div>
</div>


<script type="text/javascript">
    var SITEURL = "<?php echo SHOP_SITE_URL; ?>";
    $(document).ready(function () {
        $("#region").nc_region();
        $('#address_form').validate({
            rules: {
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
                company: {
                    required: true
                },
                address: {
                    required: true,
                },
                apartment: {
                    required: true,
                },
                mob_phone: {
                    required: check_phone,
                    minlength: 10,
                    maxlength: 10,
                },
                region: {
                    checklast: true
                },
                zipcode: {
                    required: true,
                }
            },
            messages: {
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
                company: {
                    required: 'Please enter the company name' ,
                },
                address: {
                    required: 'Please enter street address',
                },
                apartment: {
                    required: 'Please enter the name of the apartment',
                },
                mob_phone: {
                    required: 'Please enter your telephone number',
                    minlength: 'Incorrect mobile phone number',
                    maxlength: 'Incorrect mobile phone number'
                },
                region : {
                    checklast : 'Please select the area completely'
                },

                zipcode: {
                    required: 'Postal code cannot be empty',
                }
            },
            groups: {
                phone: 'mob_phone'
            }
        });
        $('#zt').on('click', function () {
            DialogManager.close('my_address_edit');
            ajax_form('daisou', '使用代收货（自提）', '<?php echo MEMBER_SITE_URL;?>/index.php?model=member_address&fun=delivery_add', '900', 0);
        });
    });

    function check_phone() {
        return ($('input[name="tel_phone"]').val() == '' && $('input[name="mob_phone"]').val() == '');
    }

    // 点击关闭按钮X隐藏弹框
    $('.close_').click(function () {
        $('.popUp>div').hide();
    })
</script>