<?php defined('interMarket') or exit('Access Invalid!');?>

<div class="wrap">
<?php require_once template('layout/member_message.submenu');?>
  <table class="ncm-default-table">
    <thead>
      <tr>
        <th class="w30"></th>
        <th class="w100 tl"><?php echo $lang['home_message_recipient'];?></th>
        <th class="tl"><?php echo $lang['home_message_content'];?></th>
        <th class="w300"><?php echo $lang['home_message_last_update'];?></th>
        <th class="w110"><?php echo $lang['home_message_command'];?></th>
      </tr>
      <?php if (!empty($output['message_array'])) { ?>
      <tr>
        <td colspan="20"><input type="checkbox" id="all" class="checkall"/>
          <label for="all"><?php echo $lang['home_message_select_all'];?></label>
          <a href="javascript:void(0)" class="ncbtn-mini" uri="<?php echo MEMBER_SITE_URL;?>/index.php?model=member_message&fun=dropcommonmsg&drop_type=<?php echo $output['drop_type']; ?>" name="message_id" confirm="<?php echo $lang['home_message_delete_confirm'];?>?" nc_type="batchbutton"><i class="icon-trash"></i><?php echo $lang['home_message_delete'];?></a></td>
      </tr>
      <?php } ?>
    </thead>
    <tbody>
      <?php if (!empty($output['message_array'])) { ?>
      <?php foreach($output['message_array'] as $k => $v){ ?>
      <tr class="bd-line">
        <td><input type="checkbox" class="checkitem" value="<?php echo $v['message_id']; ?>"/></td>
        <td class="tl"><?php echo $v['to_member_name']; ?></td>
        <td class="tl"><?php echo parsesmiles($v['message_body']); ?></td>
        <td><?php echo @date("Y-m-d H:i:s",$v['message_time']); ?></td>
        <td class="ncm-table-handle"><span><a href="javascript:void(0)" onclick="ajax_get_confirm('<?php echo $lang['home_message_delete_confirm'];?>?', '<?php echo MEMBER_SITE_URL;?>/index.php?model=member_message&fun=dropcommonmsg&drop_type=<?php echo $output['drop_type']; ?>&message_id=<?php echo $v['message_id']; ?>');" class="btn-grapefruit"><i class="icon-trash"></i>
          <p><?php echo $lang['home_message_delete'];?></p>
          </a></span></td>
      </tr>
      <?php } ?>
      <?php } else { ?>
      <tr>
        <td colspan="20" class="norecord"><div class="warning-option"><i>&nbsp;</i><span><?php echo $lang['no_record'];?></span></div></td>
      </tr>
      <?php } ?>
    </tbody>
    <tfoot>
      <?php if (!empty($output['message_array'])) { ?>
      <tr>
      <td colspan="20"><div class="pagination"><?php echo $output['show_page']; ?></div></td>
    </tr>
    <?php } ?>
      </tfoot>

  </table>
</div>
