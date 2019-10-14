<?php defined('interMarket') or exit('Access Invalid!');?>

<link rel="stylesheet" href="/skins/default/css/mygrade.css" />
<?php include template('layout/common_layout');?>
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/home_point.css" rel="stylesheet" type="text/css">
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/member.css" rel="stylesheet" type="text/css">
<link href="/skins/default/css/Myintegral.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/member.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/ToolTip.js"></script>
<script>

</script>

 <style>  
    .caozuo,.tl{
        font: 14px "微软雅黑";
        line-height: 83px;
        color: #494949!important;
    }  
 
    .goods-time{
      font: 14px/83px "微软雅黑";
    color: #333333!important;
    }
    .goods-price{
        font: 18px "宋体";
      line-height: 83px;
      color: #d00100!important;
    }

</style>
<div id="vip_core">
    <div id="core">
        <div id="vip_head">
            <ul>
                <li>您当前的位置是：</li>
                <li><a href="javascript:;">首页</a></li>
                <li>></li>
                <li><a href="javascript">会员中心</a></li>
                <li>></li>
                <li><a href="javascript">等级经验值</a></li>
            </ul>
        </div>
        <div id="main">
            <!--左侧-->   
            <div id="mian_left">
              <ul id="sidebarMenu" class="">
                <?php if (!empty($output['menu_list'])) {?>
                <?php foreach ($output['menu_list'] as $key => $value) {?>
                <li class=""><a href="javascript:void(0)" key="<?php echo $key;?>" <?php if (cookie('Mmenu_'.$key) == 1) echo 'class="shrink"';?>></a>
                  <div class="m_title">
                    <div></div><div><?php echo $value['name'];?></div>
                  </div>
                  <?php if (!empty($value['child'])) {?>
                  <ul class="m_body" <?php if (cookie('Mmenu_'.$key) == 1) echo 'style="display:none"';?>>
                    <?php foreach ($value['child'] as $key => $val) {?>
                    <li <?php if ($key == $output['model']) {?>class="selected"<?php }?>><a href="<?php echo $val['url'];?>"><?php echo $val['name'];?></a></li>
                    <?php }?>
                  </ul>
                  <?php }?>
                </li>
                <?php }?>
                <?php }?>
              </ul>
            </div>
            <!--右侧-->
            <div id="mian_right">
              <div id="mian_tab">
              <div id="grade">
               <!--  <div id="grade_head">
                  我目前的等级信息
                </div> -->
                    <div class="tabmenu">
                        <ul class="tab pngFix">
                          <?php if(is_array($output['member_menu']) and !empty($output['member_menu'])) { 
                              foreach ($output['member_menu'] as $key => $val) {
                                if($val['menu_key'] == $output['menu_key']) {
                                  echo '<li class="active"><a '.(isset($val['target'])?"target=".$val['target']:"").' href="'.$val['menu_url'].'">'.$val['menu_name'].'</a></li>';
                                } else {
                                  echo '<li class="normal"><a '.(isset($val['target'])?"target=".$val['target']:"").' href="'.$val['menu_url'].'">'.$val['menu_name'].'</a></li>';
                                }
                              }
                                }
                                ?>
                                
                        </ul>
                    </div>
                    <table class="ncm-default-table">
                    <thead>
                      <tr>
                      <th class="w200">添加时间</th>
                            <th class="w100">获得经验</th>
                            <th class="w200">操作阶段</th>
                            <th class="tl">描述</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php  if (count($output['list_log'])>0) { ?>
                      <?php foreach($output['list_log'] as $val) { ?>
                      <tr class="bd-line">
                        <td class="goods-time"><?php echo @date('Y-m-d',$val['exp_addtime']);?></td>
                        <td class="goods-price"><?php echo ($val['pl_points'] > 0 ? '+' : '').$val['exp_points']; ?></td>
                        <td class="caozuo">
                       <?php 
                            switch ($val['exp_stage']){
                                case 'login':
                                    echo '会员登录';
                                    break;
                                case 'comments':
                                    echo '商品评论';
                                    break;
                                case 'order':
                                    echo '订单消费';
                                    break;
                            }
                          ?>
                          </td>
                        <td class="tl"><?php echo $val['exp_desc'];?></td>
                      </tr>
                      <?php } ?>
                      <?php } else { ?>
                      <tr>
                        <td colspan="20" class="norecord"><div class="warning-option"><i>&nbsp;</i><span><?php echo $lang['no_record']; ?></span></div></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                      <?php  if (count($output['list_log'])>0) { ?>
                      <tr>
                        <td colspan="20"><div class="pagination"><?php echo $output['show_page']; ?></div></td>
                      </tr>
                      <?php } ?>
                    </tfoot>
                  </table>
                
                </div>
                
              
              </div>
              
              </div>
            </div>
        </div>
    
</div>


</body>
</html>
























<!-- 
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/home_point.css" rel="stylesheet" type="text/css">
<link href="<?php echo MEMBER_TEMPLATES_URL;?>/css/member.css" rel="stylesheet" type="text/css">
<link href="/skins/default/css/Myintegral.css" rel="stylesheet" type="text/css">






<div class="ncp-container">
  <div class="ncp-base-layout">
    <div class="ncp-member-left">
      <?php include_once BASE_TPL_PATH.'/home/pointshop.minfo.php'; ?>
    </div>
    <div class="ncp-member-right">
      <table class="ncp-table-style">
        <thead>
          <tr>
            <th class="w200">添加时间</th>
            <th class="w100">获得经验</th>
            <th class="w200">操作阶段</th>
            <th class="tl">描述</th>
          </tr>
        </thead>
        <tbody>
          <?php  if (count($output['list_log'])>0) { ?>
          <?php foreach($output['list_log'] as $val) { ?>
          <tr class="">
            <td class=""><?php echo @date('Y-m-d',$val['exp_addtime']);?></td>
            <td class=""><?php echo ($val['exp_points'] > 0 ? '' : '-').$val['exp_points']; ?></td>
            <td><?php 
        	              	switch ($val['exp_stage']){
        	              		case 'login':
        	              			echo '会员登录';
        	              			break;
        	              		case 'comments':
        	              			echo '商品评论';
        	              			break;
        	              		case 'order':
        	              			echo '订单消费';
        	              			break;
        	              	}
        	              ?></td>
            <td class="tl"><?php echo $val['exp_desc'];?></td>
          </tr>
          <?php } ?>
          <?php } else { ?>
          <tr>
            <td colspan="20" class="norecord"><div class="warning-option"><i>&nbsp;</i><span><?php echo $lang['no_record']; ?></span></div></td>
          </tr>
          <?php } ?>
        </tbody>
        <tfoot>
          <?php  if (count($output['list_log'])>0) { ?>
          <tr>
            <td colspan="20"><div class="pagination"><?php echo $output['show_page']; ?></div></td>
          </tr>
          <?php } ?>
        </tfoot>
      </table>
    </div>
  </div>
</div> -->
