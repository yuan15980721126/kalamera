<?php defined('interMarket') or exit('Access Invalid!');?>

      <div class="tabmenu">
        <ul class="tab">
        <?php if(is_array($output['member_menu']) and !empty($output['member_menu'])) {
          foreach ($output['member_menu'] as $key => $val) {
            $classname = 'normal';
            if($val['menu_key'] == $output['menu_key']) {
              $classname = 'active';
            }
            if ($val['menu_key'] == 'message'){
              #echo '<li class="'.$classname.'"><a href="'.$val['menu_url'].'">'.$val['menu_name'].'(<span style="color: red;">'.$output['newcommon'].'</span>)</a></li>';
            }elseif ($val['menu_key'] == 'system'){
              echo '<li class="'.$classname.'"><a href="'.$val['menu_url'].'">'.$val['menu_name'].'(<span style="color: red;">'.$output['newsystem'].'</span>)</a></li>';
            }elseif ($val['menu_key'] == 'close' || $val['menu_key'] == 'setting'  || $val['menu_key'] == 'private'){
              #echo '<li class="'.$classname.'"><a href="'.$val['menu_url'].'">'.$val['menu_name'].'(<span style="color: red;">'.$output['newpersonal'].'</span>)</a></li>';
            }else{
              echo '<li class="'.$classname.'"><a href="'.$val['menu_url'].'">'.$val['menu_name'].'</a></li>';
            }
          }
        }?>
        </ul>
        <?php if ($output['isallowsend']){?>
        <!--
          <a href="index.php?model=member_message&fun=sendmsg" class="ncbtn ncbtn-bittersweet" title="<?php echo $lang['home_message_send_message'];?>"><i class="icon-envelope-alt"></i><?php echo $lang['home_message_send_message'];?></a>
        -->
        <?php }?>
      </div>
      
      