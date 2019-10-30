<?php defined('interMarket') or exit('Access Invalid!'); ?>
<?php if (!empty($output['show_goods_class']) && is_array($output['show_goods_class'])) {
    $i = 0; ?>
    <?php foreach ($output['show_goods_class'] as $key => $val) {
        $i++; ?>
        <div class="second_menu" data-cid="<?php echo $val['gc_id']; ?>">
            <a cat_id="<?php echo $val['gc_id']; ?>"
               href="<?php echo urlShop('search', 'index', array('cate_id' => $val['gc_id'])); ?>"
               data-cid="<?php echo $val['gc_id']; ?>" class="second_nav_menu">
                <?php echo $val['gc_name']; ?>
            </a>
            <?php if (!empty($val['class2']) && is_array($val['class2'])) { ?>
                <div class="three_nav three_menu_<?php echo $val['gc_id']; ?>" data-cid="<?php echo $val['gc_id']; ?>">
                    <?php foreach ($val['class2'] as $k => $v) { ?>
                        <div>
                            <a href="<?php echo urlShop('search', 'index', array('cate_id' => $v['gc_id'])); ?>">
                                <?php echo $v['gc_name']; ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
<?php } ?>

