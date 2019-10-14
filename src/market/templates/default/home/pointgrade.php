<?php defined('interMarket') or exit('Access Invalid!');?>
<link rel="stylesheet" href="/skins/default/css/mygrade.css" />
<?php include template('layout/common_layout');?>
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/home_point.css" rel="stylesheet" type="text/css">
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/member.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/member.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/ToolTip.js"></script>
<script>
//sidebar-menu
$(document).ready(function() {
    $.each($(".side-menu > a"), function() {
        $(this).click(function() {
            var ulNode = $(this).next("ul");
            if (ulNode.css('display') == 'block') {
              $.cookie(COOKIE_PRE+'Mmenu_'+$(this).attr('key'),1);
            } else {
              $.cookie(COOKIE_PRE+'Mmenu_'+$(this).attr('key'),null);
            }
      ulNode.slideToggle();
        if ($(this).hasClass('shrink')) {
          $(this).removeClass('shrink');
        } else {
          $(this).addClass('shrink');
        }
        });
    });
  $.each($(".side-menu-quick > a"), function() {
        $(this).click(function() {
            var ulNode = $(this).next("ul");
      ulNode.slideToggle();
        if ($(this).hasClass('shrink')) {
          $(this).removeClass('shrink');
        } else {
          $(this).addClass('shrink');
        }
        });
    });
});

</script>


<div id="vip_core">
    <div id="core">
        <div id="vip_head">
            <ul>
                <li>您当前的位置是：</li>
                <li><a href="javascript:;">首页</a></li>
                <li>></li>
                <li><a href="javascript">会员中心</a></li>
                <li>></li>
                <li><a href="javascript">我的级别</a></li>
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

                <div id="grade_info">
                  <div>
                    您的会员级别是：<span>  
                    <?php echo $output['member_info']['level_desc'];?>
                      </span>(当前经验值：<?php echo $output['member_info']['member_exppoints'];?>)&nbsp;&nbsp;&nbsp;
                      <!-- <a href="<?php echo urlShop('pointgrade','exppointlog');?>" target="_blank" style="color: #d32726;">经验值明细</a> -->                 
                  </div>
                  <div>
                      <span> <?php echo $output['member_info']['level_desc'];?></span>
                      <?php if ($output['member_info']['less_exppoints'] > 0){?>
                        还差<em><?php echo $output['member_info']['less_exppoints'];?></em>经验值即可升级成为
                        <?php $upgrade_name = $output['member_info']['upgrade_name'];
                            if($upgrade_name=='V1'){
                                echo '铜牌会员';
                            }else if($upgrade_name=='V2'){
                                echo '金牌会员';
                            }else {
                                echo '已达到最高会员级别，继续加油保持这份荣誉哦！';
                        }?>
                      <?php }else{?>
                          已达到最高会员级别，继续加油保持这份荣誉哦！
                      <?php }?>
                               
                  </div>
                </div>
                
                
                <div id="grade_table">
                  <div id="table_title">
                  会员等级表
                  </div>  
                  
                  <div id="tab_boder">
                  <div id="t_head">
                      <div class="col_nub_">编号</div>
                      <div class="col_name">等级名称</div>
                      <div class="col_lv">折扣率</div>
                      <div>需要经验值</div>
                  </div>
                  <div t_body>
                     <?php foreach ($output['member_grade'] as $v){ ?>
                  
                  
                    <div class="t_row">
                        <div class="col_nub_"><?php echo $v['level']+1; ?></div>
                        <div class="col_name"><?php echo $v['level_desc']; ?></div>
                        <div class="col_lv"><?php echo $v['orderdiscount']; ?>%</div>
                        <div><?php echo $v['exppoints']; ?></div>
                    </div>
                  
                    
                  <?php } ?>
                  
                  
                  </div>
                  
                    
                  </div>
                <div class="ncp-grade-layout mt20">
                    <div class="title" style="height: 53px;">
                      <h3>经验值结构</h3>
                    </div>
                    <dl>
                      <dt><i class="icon-01"></i>
                        <p>如何计算经验值</p>
                      </dt>
                      <dd style="font-size: 18px;">
                        <?php if ($output['ruleexplain_arr']){ ?>
                        <ul>
                          <?php foreach ($output['ruleexplain_arr'] as $v){ ?>
                          <li><?php echo $v; ?></li>
                          <?php } ?>
                        </ul>
                        <?php } ?>
                      </dd>
                    </dl>
                </div>
                <div class="ncp-grade-layout">
                    <div class="title" style="height: 53px;">
                      <h3>有效购物金额</h3>
                    </div>
                    <dl>
                      <dt><i class="icon-02"></i>
                        <p>有效范围</p>
                      </dt>
                      <dd style="font-size: 18px;">
                        <?php if ($output['ruleexplain_arr']['exp_order']){ ?>
                        <ul>
                          <li>实物交易订单的在<strong>【确认完成】</strong>后，该笔订单金额计入有效购物金额；在您收货后，请到<strong>【实物交易订单】</strong>中，点击<strong>【确认收货】</strong>，经验值会更快地发放；</li>
                          <li>虚拟兑换订单的在<strong>【已完成】</strong>后，该笔订单金额计入有效购物金额；</li>
                        </ul>
                        <?php } ?>
                      </dd>
                    </dl>
                </div>
                
                </div>
                
              
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
 
<div class="ncp-container">
  <div class="ncp-base-layout">
    <div class="ncp-member-left">
      <?php include_once BASE_TPL_PATH.'/home/pointshop.minfo.php'; ?>
    </div>
    <div class="ncp-member-right">
      <div class="ncp-grade">
        <div class="title">
          <h3>我的升级进度</h3>
        </div>
        <div class="ncp-gradeall-bar">
          <?php if ($output['membergrade_arr']){ ?>
          <?php foreach ($output['membergrade_arr'] as $k=>$v){ ?>
          <div class="itemlevel exp-lv<?php echo $v['level'];?>" >
            <?php if ($v['is_cur']){?>
            <div class="bar" title='<?php echo $v['is_cur']?"经验值：{$output['member_info']['member_exppoints']}":'';?>'><i></i> <span class="arrow"></span>
              <div class="tips">
                <p class="p1"> 我的当前等级： <strong><?php echo $v['level_name'];?></strong> 当前经验值： <em><?php echo $output['member_info']['member_exppoints'];?></em> </p>
                <p class="p2">
                  <?php if ($k >= count($output['membergrade_arr'])-1){?>
                  已达到最高会员级别，继续加油保持这份荣誉哦！
                  <?php } else {?>
                  在有效期前再累积 <strong><?php echo $output['membergrade_arr'][$k+1]['exppoints']-$output['member_info']['member_exppoints'];?></strong> 经验值即可升级 <em><?php echo $output['membergrade_arr'][$k+1]['level_name'];?></em>
                  <?php } ?>
                </p>
              </div>
            </div>
            <?php }?>
            <div class="gradelabel"> <strong><?php echo $v['level_name'];?></strong> <i>(<?php echo $v['exppoints'];?>)</i> </div>
          </div>
          <?php } ?>
          <?php } else { ?>
          暂无等级
          <?php }?>
        </div>
      </div>
    </div>
  </div>
  <div class="ncp-grade-layout mt20">
    <div class="title">
      <h3>经验值结构</h3>
    </div>
    <dl>
      <dt><i class="icon-01"></i>
        <p>如何计算经验值</p>
      </dt>
      <dd>
        <?php if ($output['ruleexplain_arr']){ ?>
        <ul>
          <?php foreach ($output['ruleexplain_arr'] as $v){ ?>
          <li><?php echo $v; ?></li>
          <?php } ?>
        </ul>
        <?php } ?>
      </dd>
    </dl>
  </div>
  <div class="ncp-grade-layout">
    <div class="title">
      <h3>有效购物金额</h3>
    </div>
    <dl>
      <dt><i class="icon-02"></i>
        <p>有效范围</p>
      </dt>
      <dd>
        <?php if ($output['ruleexplain_arr']['exp_order']){ ?>
        <ul>
          <li>实物交易订单的在<strong>【确认完成】</strong>后，该笔订单金额计入有效购物金额；在您收货后，请到<strong>【实物交易订单】</strong>中，点击<strong>【确认收货】</strong>，经验值会更快地发放；</li>
          <li>虚拟兑换订单的在<strong>【已完成】</strong>后，该笔订单金额计入有效购物金额；</li>
        </ul>
        <?php } ?>
      </dd>
    </dl>
  </div>
</div>
</div> -->
<script type="text/javascript" src="<?php echo SHOP_RESOURCE_SITE_URL;?>/js/home.js" id="dialog_js" charset="utf-8"></script> 
