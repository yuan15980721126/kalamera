<?php defined('interMarket') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title"><a class="back" href="index.php?model=mb_feedback&fun=index" title="返回列表"><i class="fa fa-arrow-circle-o-left"></i></a>
      <div class="subject">
        <h3><?php echo $lang['feedback_tips']?></h3>

      </div>
    </div>
  </div>
  <!-- 操作说明 -->

  <form id="user_form" enctype="multipart/form-data" method="post">
    <input type="hidden" name="form_submit" value="ok" />
    <input type="hidden" name="member_id" value="<?php echo $output['member_array']['member_id'];?>" />
    <input type="hidden" name="old_member_avatar" value="<?php echo $output['member_array']['member_avatar'];?>" />
    <input type="hidden" name="member_name" value="<?php echo $output['member_array']['member_name'];?>" />
    <input type="hidden" name="inform_allow" value="<?php echo $output['member_array']['inform_allow'];?>" />
    <input type="hidden" name="isbuy" value="<?php echo $output['member_array']['is_buy'];?>" />
    <input type="hidden" name="allowtalk" value="<?php echo $output['member_array']['is_allowtalk'];?>" />
    <div class="ncap-form-default">
      <dl class="row">
        <dt class="tit">
          <label><?php echo $lang['feedback_feedback_type']?></label>
        </dt>
        <dd class="opt">
          <?php if($output['common_info']['feedback_type'] == 1){?>留言<?php }else{?>联系管理员<?php }?>
      </dl>
        <?php if($output['common_info']['feedback_type'] == 1){?>
            <dl class="row">
                <dt class="tit">
                    <label><?php echo $lang['feedback_member_name']?></label>
                </dt>
                <dd class="opt">
                    <input type="text" class="input-txt" value="<?php echo $output['common_info']['member_name'];?>" readonly />
                </dd>
            </dl>
        <dl class="row">
            <dt class="tit">
                <label><?php echo $lang['feedback_truename']?></label>
            </dt>
            <dd class="opt">
                <input type="text" class="input-txt" value="<?php echo $output['common_info']['true_name'];?>" readonly />
            </dd>
        </dl>
        <dl class="row">
            <dt class="tit">
                <label><?php echo $lang['feedback_email']?></label>
            </dt>
            <dd class="opt">
                <input type="text" class="input-txt" value="<?php echo $output['common_info']['email'];?>" readonly />
            </dd>
        </dl>
            <dl class="row">
                <dt class="tit">
                    <label><?php echo $lang['feedback_mobile']?></label>
                </dt>
                <dd class="opt">
                    <input type="text" class="input-txt" value="<?php echo $output['common_info']['mobile'];?>" readonly />
                </dd>
            </dl>
        <?php }else{?>
            <dl class="row">
                <dt class="tit">
                    <label><?php echo $lang['feedback_title']?></label>
                </dt>
                <dd class="opt">
                    <input type="text" class="input-txt" value="<?php echo $output['common_info']['title'];?>" readonly />
                </dd>
            </dl>


        <?php }?>
        <dl class="row">
            <dt class="tit">
                <label><?php echo $lang['feedback_content']?></label>
            </dt>
            <dd class="opt">
                <input type="text" class="input-txt" value="<?php echo $output['common_info']['content'];?>" readonly />
            </dd>
        </dl>
        <dl class="row">
            <dt class="tit">
                <label><?php echo $lang['feedback_ftime']?></label>
            </dt>
            <dd class="opt">
                <input type="text" class="input-txt" value="<?php echo $output['common_info']['ftime'];?>" readonly />
            </dd>
        </dl>
        <dl class="row">
            <dt class="tit">
                <label><?php echo $lang['feedback_feedback_reply']?></label>
            </dt>
            <dd class="opt">
                <input type="text" class="input-txt" value="<?php echo $output['common_info']['feedback_reply'];?>" readonly />
            </dd>
        </dl>
        <dl class="row">
            <dt class="tit">
                <label><?php echo $lang['feedback_reply_time']?></label>
            </dt>
            <dd class="opt">
                <input type="text" class="input-txt" value="<?php echo $output['common_info']['feedback_reply_time'];?>" readonly />
            </dd>
        </dl>



      <div class="bot">

      </div>
    </div>
  </form>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/ajaxfileupload/ajaxfileupload.js"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.Jcrop/jquery.Jcrop.js"></script>
<link href="<?php echo RESOURCE_SITE_URL;?>/js/jquery.Jcrop/jquery.Jcrop.min.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?php echo ADMIN_RESOURCE_URL;?>/js/jquery.nyroModal.js"></script>

<script type="text/javascript">
//裁剪图片后返回接收函数
function call_back(picname){
	$('#member_avatar').val(picname);
	$('#view_img').attr('src','<?php echo UPLOAD_SITE_URL.'/'.ATTACH_AVATAR;?>/'+picname+'?'+Math.random())
	   .attr('onmouseover','toolTip("<img src=<?php echo UPLOAD_SITE_URL.'/'.ATTACH_AVATAR;?>/'+picname+'?'+Math.random()+'>")');
}
$(function(){
	$('input[class="type-file-file"]').change(uploadChange);
	function uploadChange(){
		var filepath=$(this).val();
		var extStart=filepath.lastIndexOf(".");
		var ext=filepath.substring(extStart,filepath.length).toUpperCase();
		if(ext!=".PNG"&&ext!=".GIF"&&ext!=".JPG"&&ext!=".JPEG"){
			alert("file type error");
			$(this).attr('value','');
			return false;
		}
		if ($(this).val() == '') return false;
		ajaxFileUpload();
	}
	function ajaxFileUpload()
	{
		$.ajaxFileUpload
		(
			{
				url : '<?php echo ADMIN_SITE_URL?>/index.php?model=common&fun=pic_upload&form_submit=ok&uploadpath=<?php echo ATTACH_AVATAR;?>',
				secureuri:false,
				fileElementId:'_pic',
				dataType: 'json',
				success: function (data, status)
				{
					if (data.status == 1){
						ajax_form('cutpic','<?php echo $lang['nc_cut'];?>','<?php echo ADMIN_SITE_URL?>/index.php?model=common&fun=pic_cut&type=member&x=120&y=120&resize=1&ratio=1&filename=<?php echo UPLOAD_SITE_URL.'/'.ATTACH_AVATAR;?>/avatar_<?php echo $_GET['member_id'];?>.jpg&url='+data.url,690);
					}else{
						alert(data.msg);
					}
					$('input[class="type-file-file"]').bind('change',uploadChange);
				},
				error: function (data, status, e)
				{
					alert('上传失败');$('input[class="type-file-file"]').bind('change',uploadChange);
				}
			}
		)
	};
// 点击查看图片
	$('.nyroModal').nyroModal();
	
$("#submitBtn").click(function(){
    if($("#user_form").valid()){
     $("#user_form").submit();
	}
	});
    $('#user_form').validate({
        errorPlacement: function(error, element){
			var error_td = element.parent('dd').children('span.err');
            error_td.append(error);
        },
        rules : {
            member_passwd: {
                maxlength: 20,
                minlength: 6
            },
    //         member_email   : {
    //             required : true,
    //             email : true,
				// remote   : {
    //                 url :'index.php?model=member&fun=ajax&branch=check_email',
    //                 type:'get',
    //                 data:{
    //                     user_name : function(){
    //                         return $('#member_email').val();
    //                     },
    //                     member_id : '<?php echo $output['member_array']['member_id'];?>'
    //                 }
    //             }
    //         }
        },
        messages : {
            member_passwd : {
                maxlength: '<i class="fa fa-exclamation-circle"></i><?php echo $lang['member_edit_password_tip']?>',
                minlength: '<i class="fa fa-exclamation-circle"></i><?php echo $lang['member_edit_password_tip']?>'
            },
    //         member_email  : {
    //             required : '<i class="fa fa-exclamation-circle"></i><?php echo $lang['member_edit_email_null']?>',
    //             email   : '<i class="fa fa-exclamation-circle"></i><?php echo $lang['member_edit_valid_email']?>',
				// remote : '<i class="fa fa-exclamation-circle"></i><?php echo $lang['member_edit_email_exists']?>'
    //         }
        }
    });
});
</script> 
