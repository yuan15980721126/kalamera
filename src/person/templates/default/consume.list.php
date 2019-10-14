<?php defined('interMarket') or exit('Access Invalid!');?>
<link rel="stylesheet" href="/skins/default/css/consume.css" />
<div class="wrap">
  <div class="tabmenu">
    <?php include template('layout/submenu'); ?>
    </div>
    <div id="consume_table">
        <div id="t_headl">
            <div>记录时间</div>
            <div style="width: 165px;">金额</div>
            <div>备注</div>
        </div>
        <div id="t_body">
            <?php  if (!empty($output['consume_list'])) { ?>
      <?php foreach($output['consume_list'] as $val) { ?>
            <div class="t_row">
                <div><?php echo date('Y-m-d H:i:s', $val['consume_time']);?></div>
                <div><span><?php echo '&yen;'.ncPriceFormat($val['consume_amount'])?></span></div>
                <div><?php echo $val['consume_remark'];?></div>

            </div>
            <?php } ?>
      <?php } else {?>
      <tr>
        <td colspan="20" class="norecord"><div class="warning-option"><i>&nbsp;</i><span><?php echo $lang['no_record'];?></span></div></td>
      </tr>
      <?php } ?>
        </div>
       <tfoot>
      <?php  if (count($output['consume_list'])>0) { ?>
      <tr>
        <td colspan="20"><div class="pagination"> <?php echo $output['show_page']; ?></div></td>
      </tr>
      <?php } ?>
    </tfoot>             
    </div>
<!--   <table class="ncm-default-table">
    <thead>
      <tr>
        <th class="w10"></th>
        <th class="w150 tl">记录时间</th>
        <th class="w150 tl">金额</th>
        <th class="tl">备注</th>
      </tr>
    </thead>
    <tbody>
      <?php  if (!empty($output['consume_list'])) { ?>
      <?php foreach($output['consume_list'] as $val) { ?>
      <tr class="bd-line">
        <td></td>
        <td class="w150 tl"><?php echo date('Y-m-d H:i:s', $val['consume_time']);?></td>
        <td class="w150 tl"><?php echo '&yen;'.ncPriceFormat($val['consume_amount'])?></td>
        <td class="tl"><?php echo $val['consume_remark'];?></td>
      </tr>
      <?php } ?>
      <?php } else {?>
      <tr>
        <td colspan="20" class="norecord"><div class="warning-option"><i>&nbsp;</i><span><?php echo $lang['no_record'];?></span></div></td>
      </tr>
      <?php } ?>
    </tbody>
    <tfoot>
      <?php  if (count($output['consume_list'])>0) { ?>
      <tr>
        <td colspan="20"><div class="pagination"> <?php echo $output['show_page']; ?></div></td>
      </tr>
      <?php } ?>
    </tfoot>
  </table> -->
</div>
