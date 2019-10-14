<?php defined('interMarket') or exit('Access Invalid!'); ?>
<div class="order_nav title clearfix">
    <span class="">Account security</span>
</div>
<div class="info_tab dis_b">
    <div class="admin_box min_height_450 border_none">
        <div class="text-center">
            <span class="big-title margin-b-20 inline_b">Change the password</span>
        </div>
        <form method="post" id="password_form" name="password_form"
              action="<?php echo MEMBER_SITE_URL; ?>/index.php?model=member_security&fun=modify_pwd">
            <input type="hidden" name="form_submit" value="ok"/>
            <table class="tab_admin account_security" border="0">
                <tbody>
                <tr>
                    <th>Original password :</th>
                    <td>
                        <input type="password" name="current_password" id="current_password" placeholder="Please enter the original password"/><br/>

                    </td>
                </tr>
                <tr>
                    <th>New password :</th>
                    <td>
                        <input type="password" maxlength="40" class="new_password" name="new_password"
                               id="new_password" placeholder="Please enter a new password"/>
                    </td>
                </tr>
                <tr>
                    <th>Confirm password :</th>
                    <td>
                        <input type="password" name="confirm_password" id="confirm_password"
                               placeholder="Please enter the new password again"/><br/>

                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td><input type="submit" class="submit_btn_blue" name="" id="" value="Save Settings"></td>
                </tr>
                </tbody>
            </table>

        </form>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        $("#password_form").validate({
            rules: {
                current_password: {
                    required: true
                },
                new_password: {
                    required: true,
                    minlength: 6,
                    maxlength: 20
                },
                confirm_password: {
                    required: true,
                    equalTo: '#new_password'
                }
            },
            messages: {
                current_password: {
                    required: 'Please enter the original password'
                },
                new_password: {
                    required: 'Please enter a new password',
                    minlength: 'Minimum password length 6',
                    maxlength: 'Maximum password length is 20'
                },
                confirm_password: {
                    required: 'Please enter the new password again',
                    equalTo: 'The passwords entered twice are different',
                },

            },
        });
    });
</script> 
