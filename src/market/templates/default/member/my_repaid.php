<?php defined('interMarket') or exit('Access Invalid!');?>

<div class="wrap">
  <div class="tabmenu">
    <?php include template('layout/submenu');?>
  </div>
  <form method="get" action="index.php">
    <table class="ncm-search-table">
      <input type="hidden" name='act' value='my_repaid' />
      <tr>
        <td>&nbsp;</td>
        <td class="w100 tr"><select name="state">
            <option value="0" <?php if (empty($_GET['state'])){echo 'selected=true';}?>> 选择状态</option>
            <option value="1" <?php if ($_GET['state'] == '1'){echo 'selected=true';}?>> 审核中 </option>
            <option value="2" <?php if ($_GET['state'] == '2'){echo 'selected=true';}?>> 已审核 </option>
            <option value="3" <?php if ($_GET['state'] == '3'){echo 'selected=true';}?>> 审核失败 </option>
          </select></td>
        <td class="w70 tc"><label class="submit-border">
            <input type="submit" class="submit" value="<?php echo $lang['nc_search'];?>" />
          </label></td>
      </tr>
    </table>
  </form>
  <table class="ncm-default-table">
    <thead>
      <tr>
        <th class="w10"></th>

        <th class="w200" style="width:160px">商品名称</th>
        <th class="w200">商品型号</th>
        <th class="w150">问题描述</th>
        <th class="w110">申请时间</th>
        <th class="w110">状态</th>
         
      </tr>
    </thead>
    <tbody>
      <?php  if (count($output['list'])>0) { ?>
      <?php foreach($output['list'] as $val) {
        $goods_id = $val['goods_id'];
        $goods = $val;
        $goods_name = $val['goods_name'];
        ?>
      <tr class="bd-line">
        <td></td>
        <td class="w50" style="width:80px"><div class="pic-thumb"><a target="_blank" href="<?php echo urlShop('goods','index',array('goods_id'=> $goods_id)); ?>">
            <img src="<?php echo thumb($goods,60); ?>" onMouseOver="toolTip('<img src=<?php echo thumb($goods,240); ?>>')" onMouseOut="toolTip()" /></a></div><dl class="goods-name">
            <dt><a target="_blank" href="<?php echo urlShop('goods','index',array('goods_id'=> $goods_id)); ?>"><?php echo $goods_name; ?></a></dt>
          </dl></td>
        <td><?php echo $val['goods_class'];?></td>
        <td><?php echo str_cut($val['description'],20);?></td>
        <td class="goods-time"><?php echo $val['add_time'];?></td>
        <td><?php
				if(intval($val['state'])===1) echo '审核中';
				if(intval($val['state'])===2) echo '已审核';
				if(intval($val['state'])===3) echo '审核失败';
				?>
        </td>
       
      </tr>
      <?php }?>
      <?php } else { ?>
      <tr>
        <td colspan="20" class="norecord"><div class="warning-option"><i></i><span><?php echo $lang['no_record'];?></span></div></td>
      </tr>
      <?php } ?>
    </tbody>
    <tfoot>
      <?php  if (count($output['list'])>0) { ?>
      <tr>
        <td colspan="20"><div class="pagination"><?php echo $output['show_page'];?></div></td>
      </tr>
      <?php } ?>
    </tfoot>
  </table>
</div>
