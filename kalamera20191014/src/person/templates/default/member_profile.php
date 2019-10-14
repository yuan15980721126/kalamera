<?php defined('interMarket') or exit('Access Invalid!'); ?>


<?php defined('interMarket') or exit('Access Invalid!'); ?>
<style type="text/css">
    .ncm-container .left-layout {
        border-color: transparent;
    }

    #u_infp a {
        font-size: 12px;
    }
</style>
<div class="order_nav title clearfix">
    <span class="management_title">Account Details</span>
</div>
<div class="info_tab dis_b ">
    <div class="admin_box border_none">
        <form method="post" id="profile_form"
              action="<?php echo MEMBER_SITE_URL; ?>/index.php?model=member_information&fun=member">
            <table class="tab_admin" border="0">
                <tbody>
                <tr>
                    <th>UserName :</th>
                    <td>
                        <?php echo $output['member_info']['member_name']; ?>
                    </td>

                </tr>
                <tr>
                    <th>My head is :</th>
                    <td>
                        <div class="inline_b_b portrait_detail">
                            <img src="<?php echo getMemberAvatar($_SESSION['avatar'] ? $_SESSION['avatar'] : $output['member_avatar']) . '?' . microtime(); ?>"/>

                        </div>

                        <div class="margin_l_10 file_btn_box inline_b_b">
                            <a href="<?php echo urlMember('member_information', 'avatar'); ?>">
                                <span class="file_btn">Upload the picture</span>
                            </a>

                        </div>
                    </td>
                </tr>
                <input type="hidden" name="form_submit" value="ok"/>
                <input type="hidden" name="old_member_avatar"
                       value="<?php echo $output['member_info']['member_avatar']; ?>"/>
                <input type="hidden" name="area_ids" id="area_ids" value=""/>
                <tr>
                    <th>Email :</th>
                    <td><input class="email" type="text" name="member_email"
                               value="<?php echo $output['member_info']['member_email']; ?>"/></td>

                </tr>
                <tr>
                    <th>First Name :</th>
                    <td>
                        <?php if(strpos($output['member_info']['member_truename'], "-")) {?>
                            <input class="name" type="text" minlength="2" maxlength="15" name="firstName" id="firstName"
                                   value="<?php echo substr($output['member_info']['member_truename'], 0, strpos($output['member_info']['member_truename'], "-")); ?>"/>
                        <?php }else{?>
                            <input class="name " type="text"  name="lastName" id="lastName"
                                   value=""/>
                        <?php }?>

                    </td>

                </tr>
                <tr>
                    <th>Last Name :</th>



                    <td>
                        <?php if(strpos($output['member_info']['member_truename'], "-")) {?>
                            <input class="name" type="text" minlength="2" maxlength="15" name="lastName" id="lastName"
                                   value="<?php echo substr($output['member_info']['member_truename'], strripos($output['member_info']['member_truename'], "-") + 1); ?>"/>
                        <?php }else{?>
                            <input class="name " type="text"  name="lastName" id="lastName"
                                   value=""/>
                        <?php }?>


                    </td>

                </tr>
                <tr>
                    <th>Mobile phone :</th>
                    <td>
                        <input class="member_mobile" type="text" name="member_mobile"
                               value="<?php echo $output['member_info']['member_mobile']; ?>"/>
                    </td>

                </tr>
                <tr>
                    <th>User's gender :</th>
                    <td class="user_gender switch_blue">
                        <input type="hidden" name="member_sex" id=""
                               value="<?php echo $output['member_info']['member_sex']; ?>" class="user_gender_val">
                        <span><em class="sex_1"
                                <?php if ($output['member_info']['member_sex'] == 1) { ?>style="display: block;"<?php } ?>></em>male</span>
                        <span><em class="sex_2"
                                <?php if ($output['member_info']['member_sex'] == 2) { ?>style="display: block;"<?php } ?>></em>female</span>
                        <span><em class="sex_3"
                                <?php if ($output['member_info']['member_sex'] == 3) { ?>style="display: block;"<?php } ?>></em>A secret</span>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td><input type="submit" class="submit_btn_blue" name="" id="" value="Save"></td>
                </tr>

                </tbody>
            </table>
        </form>
        </form>
    </div>
</div>


<script>
    // 点击span触发文件上传按钮
    $(document).ready(function () {
        $('.file_btn_box .file_btn').click(function () {
            $('.file_btn_box input[type=file]').click();
        });
        $("#region").nc_region({
            show_deep: 3,
            btn_style_html: 'style="background-color: #F5F5F5; width: 60px; height: 32px; border: solid 1px #E7E7E7; cursor: pointer"'
        });
        $('#birthday').datepicker({dateFormat: 'yy-mm-dd'});
        $('#profile_form').validate({

            // submitHandler:function(form){
            // $('#area_ids').val($('#region').fetch('area_ids'));
            // 	ajaxpost('profile_form', '', '', 'onerror')
            // },
            rules: {
                member_email: {
                    required: true,
                    email: true
                },
                firstName: {
                    required: true,
                    minlength: 3,
                    maxlength: 50
                },
                lastName: {
                    required: true,
                    minlength: 3,
                    maxlength: 50
                },
                member_mobile: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                },
            },
            messages: {
                member_email: {
                    required: "Please fill in the mailbox number",
                    email: "Incorrect mailbox"
                },
                firstName: {
                    required: '<i class="icon-exclamation-sign"></i>First Name cannot be empty',
                    minlength: '<i class="icon-exclamation-sign"></i>First Name length should be between 3 and 50 characters',
                    maxlength: '<i class="icon-exclamation-sign"></i>First Name length should be between 3 and 50 characters'
                },
                lastName: {
                    required: '<i class="icon-exclamation-sign"></i>last Name cannot be empty',
                    minlength: '<i class="icon-exclamation-sign"></i>last Name length should be between 3 and 50 characters',
                    maxlength: '<i class="icon-exclamation-sign"></i>last Name length should be between 3 and 50 characters'
                },
                member_mobile: {
                    required: 'Please enter your telephone number',
                    minlength: 'Incorrect mobile phone number',
                    maxlength: 'Incorrect mobile phone number'
                },
            },
        });
    });
    function check_phone(){
        return ($('input[name="tel_phone"]').val() == '' && $('input[name="member_mobile"]').val() == '');
    }
    //user_gender选择
    $('.user_gender span').each(function () {console.log($(this).index())
        $(this).click(function () {
            $(this).find('em').show();
            $(this).siblings('span').find('em').hide();
            console.log($(this).index())
            if ($(this).index() == 1) {
                $('.user_gender .user_gender_val').val('1');
            }
            if ($(this).index() == 2) {
                $('.user_gender .user_gender_val').val('2');
            }
            if ($(this).index() == 3) {
                $('.user_gender .user_gender_val').val('3');
            }
        })
    })
</script>
<!--script结束-->
