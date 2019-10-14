<?php if(isset($output['no_common_sub'])){?>
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
<?php }else{?>
<div class="order_nav title clearfix">
    <?php if(is_array($output['member_menu']) and !empty($output['member_menu'])) {
        foreach ($output['member_menu'] as $key => $val) {
            if($val['menu_key'] == $output['menu_key']) {
                echo '<a '.(isset($val['target'])?"target=".$val['target']:"").' href="'.$val['menu_url'].'"><span class="management_title">'.$val['menu_name'].'</span></a>';
            } else {
                echo '<a '.(isset($val['target'])?"target=".$val['target']:"").' href="'.$val['menu_url'].'"><span class="management_title">'.$val['menu_name'].'</span></a>';
            }
        }
    }
    ?>
</div>
<?php }?>