<?php defined('interMarket') or exit('Access Invalid!');?>

<div class="wrap">
  <?php require_once template('layout/member_message.submenu');?>
  <div class="ncm-default-form">
    <?php if(!empty($output['message_list'])) { ?>
    <?php foreach ($output['message_list'] as $k=>$v){?>
    <dl>
      <dt>
        <?php if ($output['drop_type'] == 'msg_seller'){?>
        <?php echo $v['from_member_name']; ?> <?php echo $lang['home_message_speak']; }elseif ($output['drop_type'] == 'msg_system') {
        	echo $v['from_member_name'];
        	} else {
        		echo $v['from_member_name'].$lang['home_message_speak'];} ?><?php echo $lang['nc_colon'];?></dt>
      <dd>
        <p><?php echo nl2br(parsesmiles($v['message_body'])); ?></p>
        <p class="hint">(<?php echo date("Y-m-d H:i",$v['message_time']); ?>)</p>
      </dd>
    </dl>
    <?php } ?>
    <?php } ?>
    <?php if($_GET['drop_type'] == 'msg_list' && $output['isallowsend']){?>
    <form id="replyform" method="post" action="<?php echo MEMBER_SITE_URL;?>/index.php?model=member_message&fun=savereply">
      <input type="hidden" name="form_submit" value="ok" />
      <input type="hidden" name="message_id" value="<?php echo $output['message_id']; ?>" />
      <dl class="bottom">
        <dt><?php echo $lang['home_message_reply'].$lang['nc_colon'];?></dt>
        <dd>
          <p>
            <textarea name="msg_content" rows="3" class="textarea w500"></textarea>
          </p>
          <p> </p>
        </dd>
      </dl>
      <dl class="bottom">
      <dt>&nbsp;</dt>
      <dd>
        <label class="submit-border">
          <input type="submit" class="submit" value="<?php echo $lang['home_message_submit'];?>" />
        </label></dd>
      </dl>
    </form>
    <script type="text/javascript">
    $(function(){
    	  $('#replyform').validate({
    	        errorPlacement: function(error, element){
    	            $(element).parent().next('p').html(error);
    	        },
    	        rules : {
    	        	msg_content : {
    	                required   : true
    	            }
    	        },
    	        messages : {
    	            msg_content : {
    	                required   : '<?php echo $lang['home_message_reply_content_null'];?>.'
    	            }
    	        }
    	    });
    });
    </script>
    <?php }?>
  </div>
</div>
