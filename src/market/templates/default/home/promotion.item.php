<?php defined('interMarket') or exit('Access Invalid!');?>
<?php if(!empty($output['goods_list']) && is_array($output['goods_list'])){?>
<?php foreach($output['goods_list'] as $goods_info) { ?>

        <div class="col-md-4">
            <div class="item">
                <div class="ct">
                    <div class="img_show">
                        <a title="<?php echo $goods_info['goods_name'];?>" target="_blank" href="<?php echo $goods_info['goods_url'];?>" >
                            <img src="<?php echo $goods_info['image_url_240'];?>" />
                        </a>
                    </div>
                    <div class="txt">
                        <a title="<?php echo $goods_info['goods_name'];?>" target="_blank" href="<?php echo $goods_info['goods_url'];?>" class="dot-ellipsis dot-height-60">
                            <?php echo $goods_info['goods_name'];?>
                        </a>
                    </div>
                    <div class="price">
                        <span class="not_money">
                        List Price: $<?php echo $goods_info['goods_price'];?>                    </span>
                            <span><?php echo ncPriceFormatForList($goods_info['xianshi_price']);?></span>
                    </div>
                    <div class="clearfix">
                        <a href="javascript:collect_goods('<?php echo $goods_info['goods_id']; ?>','count','goods_collect');">

                            <div class="favor fl"><span class="favor_btn"></span>Favorite</div>
                        </a>
                        <div class="fr level">
                            <span class="on"></span>
                            <span class="on"></span>
                            <span class="on"></span>
                            <span class="on"></span>
                            <span></span>
                        </div>
                    </div>
                    <a class="add" href="javascript:void(0)"  nctype="add_cart" data-gid="<?php echo $goods_info['goods_id'];?>">Add To Cart</a>

                </div>
            </div>
        </div>


<?php } ?>
<?php }else{?>
    <div id="no_results" class="no-results"><i></i><?php echo $lang['index_no_record'];?></div>
<?php }?>