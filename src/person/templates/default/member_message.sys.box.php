<?php defined('interMarket') or exit('Access Invalid!');?>

<link rel="stylesheet" href="/skins/default/css/NewsCore.css" />
<script type="text/javascript" src="/skins/default/js/NewCore.js"></script>
<div id="main">
<!--右侧-->
    <div id="mian_right">
        <div id="mian_tab">
            <div id="New_Core">
                <div id="head_tab">
                    <div id="new_tab">
                         <?php if(is_array($output['member_menu']) and !empty($output['member_menu'])) {
                          foreach ($output['member_menu'] as $key => $val) {
                            $classname = '';
                            if($val['menu_key'] == $output['menu_key']) {
                              $classname = 'cur';
                            }
                            if ($val['menu_key'] == 'message'){
                              #echo '<li class="'.$classname.'"><a href="'.$val['menu_url'].'">'.$val['menu_name'].'(<span style="color: red;">'.$output['newcommon'].'</span>)</a></li>';
                            }elseif ($val['menu_key'] == 'system'){
                              // echo '<li class="'.$classname.'"><a href="'.$val['menu_url'].'">'.$val['menu_name'].'(<span style="color: red;">'.$output['newsystem'].'</span>)</a></li>';
                              // echo '<div class="'.$classname.'"><a href="'.$val['menu_url'].'">'.$val['menu_name'].'</a></div>';
                              echo '<div class="'.$classname.'"><a href="'.$val['menu_url'].'">'.$val['menu_name'].'(<span style="color: red;">'.$output['newsystem'].'</span>)</a></div>';
                            }elseif ($val['menu_key'] == 'close' || $val['menu_key'] == 'setting'  || $val['menu_key'] == 'private'){
                              
                              #echo '<li class="'.$classname.'"><a href="'.$val['menu_url'].'">'.$val['menu_name'].'(<span style="color: red;">'.$output['newpersonal'].'</span>)</a></li>';
                              echo '<div class="'.$classname.'"><a href="'.$val['menu_url'].'">'.$val['menu_name'].'(<span style="color: red;">'.$output['newpersonal'].'</span>)</a></div>';
                            }else{
                              echo '<div class="'.$classname.'"><a href="'.$val['menu_url'].'">'.$val['menu_name'].'(<span style="color: red;">'.$output['newarticle'].'</span>)</a></div>';
                              // echo '<li class="'.$classname.'"><a href="'.$val['menu_url'].'">'.$val['menu_name'].'</a></li>';
                              // echo '<div class="'.$classname.'"><a href="'.$val['menu_url'].'">'.$val['menu_name'].'</a></div>';
                            }
                          }
                        }?>
                        <!-- <div class="cur">系统通知</div>
                        <div>商城公告</div> -->
                    </div>
                    <div id="head_select">
                    <!-- <select>
                        <option value="">全部</option>
                    </select> -->
                     </div>
                                                
                </div>
                <div id="New_content">
                    <ul>

                        <li style="display: block;" class="xt_tip">

                            <div style="width:38px;height: 22px;line-height: 22px;margin: 40px 0 15px 0;"></div>
   


                            <?php if (!empty($output['message_array'])) { ?>
                            
                            <div class="New_all">
                            <?php foreach($output['message_array'] as $k => $v){ ?>
                                <div class="New_info">
                                    <div class="New_date">
                                        <div class="new_year"><?php echo @date("Y-m",$v['article_time']); ?></div>
                                        <div class="new_day"><?php echo @date("d",$v['article_time']); ?></div>
                                    </div>
                                    <div class="new_tip">
                                        <div class="xt_new">
                                            <div class="check_info " data-cid="<?php echo $v['message_id']; ?>">
                                                <img src="/skins/default/img/vipcore/ckg_03.png" />

                                            </div>
                                            <div>系统公告 </div>
                                            <div style="line-height: 16px;background:none;">
                                                ： <a <?php if($v['article_url']!=''){?>target="_blank"<?php }?> href="<?php if($v['article_url']!='')echo $v['article_url'];else echo urlMember('article', 'show', array('article_id'=>$v['article_id']));?>"><?php echo $v['article_title']?></a>
        
                                            </div>
                                            <div>
                                                <?php echo @date("H:i",$v['article_time']); ?>
                                            </div>
                                            <?php if ($output['drop_type'] == 'msg_list'){?>
                                            <div class="del_mes"  title="删除" data-type="<?php echo MEMBER_SITE_URL;?>/index.php?model=member_message&fun=dropbatchmsg&drop_type=<?php echo $output['drop_type']; ?>&message_id=<?php echo $v['message_id']; ?>"></div>
                                            <?php }?>
                                            <?php if ($output['drop_type'] == 'msg_system' || $output['drop_type'] == 'msg_seller'){?>
                                            <div class="del_mes" data-type="<?php echo MEMBER_SITE_URL;?>/index.php?model=member_message&fun=dropbatchmsg&drop_type=<?php echo $output['drop_type']; ?>&message_id=<?php echo $v['message_id']; ?>" title="删除"></div>
                                            <?php }?>

                                        </div>
                                        <div class="new_wz">
                             
                                        </div>
                                    </div>
                                </div>      
                                                            
                                                            
                             <?php }?>                                     
                            </div>
                                 
                            <?php } else { ?>
                              <tr>
                                <td colspan="20" class="norecord"><div class="warning-option"><i>&nbsp;</i><span><?php echo $lang['no_record'];?></span></div></td>
                              </tr>
                            <?php } ?>

                        </li>
                    </ul>
                </div>
                                        
                                        
                                        
                                        
                                        
            </div>
        </div>
                                
            <div class="pagination"><?php echo $output['show_page']; ?></div>
                                
    </div>
</div>
             <!--    </div>
            </div>  
            </div> -->










<!-- <div class="wrap">-->
<?php //require_once template('layout/member_message.submenu');?>
  <!-- <table class="ncm-default-table">
    <thead>
      <tr>
        <th class="w30"></th>
        <th class="tl">标题</th>
        <th>发布时间</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($output['message_array'])) { ?>
      <?php foreach($output['message_array'] as $k => $v){ ?>
      <tr class="bd-line">
        <td class="tc"></td>
        <td class="link2 tl">
        <a <?php if($v['article_url']!=''){?>target="_blank"<?php }?> href="<?php if($v['article_url']!='')echo $v['article_url'];else echo urlMember('article', 'show', array('article_id'=>$v['article_id']));?>"><?php echo $v['article_title']?></a>
        </td>
        <td><?php echo date("Y-m-d H:i:s",$v['article_time']); ?></td>
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
 -->