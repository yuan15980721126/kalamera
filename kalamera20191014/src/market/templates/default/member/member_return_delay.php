<div class="eject_con">
  <form id="post_form" method="post" action="index.php?model=member_return&fun=delay&return_id=<?php echo $output['return']['refund_id']; ?>" onsubmit="ajaxpost('post_form','','','onerror')">
    <input type="hidden" name="form_submit" value="ok" />
    <div style="padding: 20px 40px;"> Businessmen choose goods that have not been shipped, please contact logistics for confirmation, after submission will be re-timed, businessmen can reconfirm the receip。
    </div>
    <div class="bottom">
      <label class="submit-border">
        <input type="submit" class="submit" id="confirm_button" value="<?php echo $lang['nc_ok'];?>" />
      </label><a class="ncbtn ml5" href="javascript:DialogManager.close('return_delay');">cancel</a>
    </div>
  </form>
</div>
