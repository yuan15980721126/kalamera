<?php defined('interMarket') or exit('Access Invalid!'); ?>
<?php if (!empty($output['show_goods_class']) && is_array($output['show_goods_class'])) {
    $i = 0; ?>
    <?php foreach ($output['show_goods_class'] as $key => $val) {
        $i++; ?>

        <a cat_id="<?php echo $val['gc_id']; ?>"
           href="<?php echo urlShop('search', 'index', array('cate_id' => $val['gc_id'])); ?>">
            <?php echo $val['gc_name']; ?>
        </a>
        <div>
            <?php if (!empty($val['class2']) && is_array($val['class2'])) { ?>
                <?php foreach ($val['class2'] as $k => $v) { ?>
               <a href="<?php echo urlShop('search', 'index', array('cate_id' => $v['gc_id'])); ?>">
                        <?php echo $v['gc_name']; ?>
                    </a>
                <?php } ?>
            <?php } ?>
        </div>
    <?php } ?>
<?php } ?>

