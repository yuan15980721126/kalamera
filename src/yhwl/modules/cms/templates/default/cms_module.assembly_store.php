<?php defined('interMarket') or exit('Access Invalid!');?>
<!-- 店铺　-->
<div class="cms-module-assembly-store">
    <div class="title-bar">
        <h3 id="<?php echo $block_name;?>_store_title" nctype="object_module_edit"><?php echo "<?php echo \$module_content['".$block_name."_store_title'];?>";?></h3>
        <?php echo "<?php if(\$output['edit_flag']) {?>";?>
        <div class="cms-index-module-handle"><a nctype="btn_module_title_edit" href="JavaScript:void(0);" class="tip-r" title="<?php echo $lang['cms_index_module_title_edit'];?>"><?php echo $lang['cms_index_module_title_edit'];?></a></div>
        <?php echo "<?php } ?>";?>
    </div>
    <div class="content-box">
        <ul id="<?php echo $block_name;?>_store_content" nctype="object_module_edit">
            <?php echo "<?php echo html_entity_decode(\$module_content['".$block_name."_store_content']);?>";?>
        </ul>
        <?php echo "<?php if(\$output['edit_flag']) { ?>";?>
        <div class="cms-index-module-handle"><a nctype="btn_module_store_edit" href="JavaScript:void(0);" class="tip-l" title="<?php echo $lang['cms_index_module_store_edit'];?>"><?php echo $lang['cms_index_module_store_edit'];?></a></div>
        <?php echo "<?php } ?>";?>
    </div>
</div>

