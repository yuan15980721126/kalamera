<?php defined('interMarket') or exit('Access Invalid!');?>
<style type="text/css">
.ncm-container .left-layout { border-color: transparent; }
#u_infp a{ font-size:12px; }
</style>
<div class="order_nav title clearfix">
    <span class="management_title">Account Details</span>
</div>
<div class="info_tab dis_b ">
    <div class="admin_box border_none">
        <form method="post" id="profile_form" action="<?php echo MEMBER_SITE_URL;?>/index.php?model=member_information&fun=member">
            <table class="tab_admin" border="0">
                <tbody>
                <tr>
                    <th>My head is :</th>
                    <td>
                        <div class="inline_b_b portrait_detail">
                            <img src="<?php echo getMemberAvatar($_SESSION['avatar'] ? $_SESSION['avatar'] : $output['member_avatar']).'?'.microtime(); ?>" />

                        </div>
                        <div class="margin_l_10 file_btn_box inline_b_b">
                            <a href="<?php echo urlMember('member_information','avatar');?>">
                                <span class="file_btn">Upload the picture</span>
                            </a>

                        </div>
                    </td>
                </tr>
                    <input type="hidden" name="form_submit" value="ok" />
                    <input type="hidden" name="old_member_avatar" value="<?php echo $output['member_info']['member_avatar']; ?>" />
                    <input type="hidden" name="area_ids" id="area_ids" value="" />
                <tr>
                    <th>Email :</th>
                    <td><input class="email" type="text" name="member_email" value="<?php echo $output['member_info']['member_email']; ?>" /></td>

                </tr>
                <tr>
                    <th>First Name :</th>
                    <td>
                        <input class="name" type="text" minlength="2" maxlength="15" name="firstName" id="firstName" value="<?php echo substr($output['member_info']['member_truename'],0,strpos($output['member_info']['member_truename'],"-")); ?>" />
                    </td>

                </tr>
                <tr>
                    <th>Last Name :</th>
                    <td><input class="name" type="text" minlength="2" maxlength="15" name="lastName" id="lastName" value="<?php echo substr($output['member_info']['member_truename'],strripos($output['member_info']['member_truename'],"-")+1); ?>" /></td>

                </tr>
                <tr>
                    <th>Mobile phone :</th>
                    <td>
                        <input class="email" type="text" name="member_mobile" value="<?php echo $output['member_info']['member_mobile']; ?>" />
                    </td>

                </tr>
                <tr>
                    <th>User's gender :</th>
                    <td class="user_gender switch_blue">
                        <input type="hidden" name="member_sex" id="" value="<?php echo $output['member_info']['member_sex'] ; ?>" class="user_gender_val">
                        <span><em <?php if ($output['member_info']['member_sex'] == 1) { ?>style="display: block;"<?php } ?>></em>male</span>
                        <span><em <?php if ($output['member_info']['member_sex'] == 2) { ?>style="display: block;"<?php } ?>></em>female</span>
                        <span><em <?php if ($output['member_info']['member_sex'] == 3) { ?>style="display: block;"<?php } ?>></em>A secret</span>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td><input type="submit" class="submit_btn_blue" name="" id="" value="Preserve"></td>
                </tr>

                </tbody>
            </table>
        </form>
        </form>
    </div>
</div>



<script>
    // 点击span触发文件上传按钮
    $(document).ready(function(){
        $('.file_btn_box .file_btn').click(function(){
            $('.file_btn_box input[type=file]').click();
        });
    });
    //user_gender选择
    $('.user_gender span').each(function () {
        $(this).click(function () {
            $(this).find('em').show();
            $(this).siblings('span').find('em').hide();
            console.log($(this).index())
            if($(this).index()==1){
                $('.user_gender .user_gender_val').val('1');
            }
            if($(this).index()==2){
                $('.user_gender .user_gender_val').val('2');
            }
            if($(this).index()==3){
                $('.user_gender .user_gender_val').val('3');
            }
        })
    })
</script>
<!--script结束-->


