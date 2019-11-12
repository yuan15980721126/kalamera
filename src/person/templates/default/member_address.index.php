<?php defined('interMarket') or exit('Access Invalid!'); ?>


<div class="order_nav title clearfix">
    <span class="management_title">Address</span>
</div>
<div class="info_tab dis_b addr_manage">
    <div class="black_wrap">
        <span class="sec_t padding-b-10 inline_b">Address management</span>
        &nbsp;<?php echo count($output['address_list']); ?>/10
        <div class="addr_list">
            <div class="show_addr">
                <?php if (!empty($output['address_list'])) { ?>
                    <?php foreach ($output['address_list'] as $a) { ?>
                        <div class="item show">
                            <div class="addr_brief">
                                <div class="addr inline_b">
                                    <?php echo str_replace('---', '   ',$a['true_name']); ?><br>
                                    <?php echo $a['address'] . ' ' . $a['area_info']; ?><br>
                                    <?php echo $a['mob_phone'] ? $a['mob_phone'] : $a['tel_phone']; ?><br>
                                    <?php if ($a['is_default']) { ?>
                                        <b>Default address</b>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="inline_b btn_box">
                                <a class="edit_btn edit_addr_btn" href="javascript:void(0);"
                                   onclick="ajax_get_confirm('Is it set to the default address?', '<?php echo MEMBER_SITE_URL;?>/index.php?model=member_address&fun=address&type=default&id=<?php echo $a['address_id'];?>');">
                                    Set default address
                                </a>
                                <a class="edit_btn edit_addr_btn" href="javascript:void(0);" class="btn-bluejeans"
                                   dialog_id="my_address_edit" dialog_width="550" dialog_title="Edit Address"
                                   nc_type="dialog"
                                   uri="<?php echo MEMBER_SITE_URL; ?>/index.php?model=member_address&fun=address&type=edit&id=<?php echo $a['address_id']; ?>"><i
                                            class="icon-edit">Edit</i>
                                </a>
                                    <a class="delete_btn" href="javascript:void(0);"
                                       onclick="ajax_get_confirm('Are you sure you want to delete it? ','<?php echo MEMBER_SITE_URL; ?>/index.php?model=member_address&fun=address&type=del&id=<?php echo $a['address_id']; ?>');">
                                        Delete
                                    </a>

                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div class="info_tab dis_b addr_manage">
    <form class="form_control manage_shipping_addr" id="address_addform"
          action="<?php echo urlMember('member_address', 'address'); ?>" method="post">
        <div class="black_wrap">
            <div class="add_t"><p class="margin-0 inline_b">+ Add New Shipping Address</p></div>
            <div class="padding-t-15">
                <span class="sec_t inline_b padding-right-7_5">Add Shipping Address</span>
                <span class="inline_b"><span class="red">*</span> Fields are required</span>
            </div>

            <input type="hidden" name="form_submit" value="ok">
            <input type="hidden" name="id" id="address_id" value="">
            <ul class="ul_two_col">
                <li>
                    <p class="label_txt">
                        First name <span class="red">*</span>
                    </p>
                    <input type="text" name="firstName" class="required" aria-required="true">
                </li>
                <li>
                    <p class="label_txt">
                        Last name <span class="red">*</span>
                    </p>
                    <input type="text" name="lastName" class="required" aria-required="true">
                </li>
            </ul>
            <p class="label_txt">
                Company Name
            </p>
            <input type="text" name="company">
            <p class="label_txt">
                Street Address <span class="red">*</span>
            </p>
            <input type="text" name="address" class="required">
            <p class="label_txt">
                Apartment,suite,etc:
            </p>
            <input type="text" name="apartment">
<!--            <p class="label_txt">-->
<!--                City <span class="red">*</span>-->
<!--            </p>-->
<!--            <input type="text" name="city" class="required" aria-required="true">-->

            <p class="label_txt">
                ZIP code <span class="red">*</span>
            </p>
            <input type="text" name="zipcode"  value="<?php echo $output['address_info']['zipcode']; ?>">

            <p class="label_txt">
                <?php echo $lang['member_address_location'] . $lang['nc_colon']; ?> <span
                        class="red">*</span>
            </p>
            <ul class="ul_three_col">
                <li>
                    <input type="hidden" name="region" id="region2"
                        value="<?php echo $output['address_info']['area_info']; ?>">
                    <input type="hidden" name="area_id" class="js_area_1" id="_area" />
                    <input type="hidden" name="city_id" class="js_area_3" id="_area_2" >
                </li>
            </ul>
            <p class="label_txt">
                Phone Number <span class="red">*</span> Needed for delivery purposes
            </p>
            <input type="text" name="mob_phone" class="required" aria-required="true">
            <p class="label_txt">
                <input type="checkbox" class="preferred-addr" name="is_default" id="is_default" >Set as my preferred shipping address
            </p>
            <div class="text-center padding-t-25 border-black-t">
                <input type="submit" value="Save" class="save">
            </div>
        </div>

    </form>
</div>
</div>

<!--弹窗-->
<div class="popUp">
    <div class="popMask"></div>
    <!--删除地址弹窗-->
    <div class="maskitem delete_addr_pop  delete_addr_">
        <p class="sec_t" style="font-size:20px;text-align: left;margin-bottom: 15px;">Delete address</p>
        <img class="close_" src="images/close_.png" alt="">
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
</div>
<!--弹窗结束-->


<?php if (C('delivery_isuse')) { ?>
    <script src="<?php echo RESOURCE_SITE_URL; ?>/js/jquery.ajaxContent.pack.js" type="text/javascript"></script>
<?php } ?>

<script>
    $(document).ready(function () {
        $("#region2").nc_region();
        $('#address_addform').validate({
            // submitHandler:function(form){
            // ajaxpost('address_form', '', '', 'onerror');
            // },
            // errorLabelContainer: $('#warning'),
            // invalidHandler: function(form, validator) {
            //    var errors = validator.numberOfInvalids();
            //    if(errors)
            //    {
            //        $('#warning').show();
            //    }
            //    else
            //    {
            //        $('#warning').hide();
            //    }
            // },
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
</script>
