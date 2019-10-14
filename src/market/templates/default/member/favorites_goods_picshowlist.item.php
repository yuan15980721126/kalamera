<?php defined('interMarket') or exit('Access Invalid!'); ?>


<div class="info_tab dis_b clearfix">

    <?php if (!empty($output['favorites_list']) && is_array($output['favorites_list'])){
    $i = 0; ?>
    <div id="view_goods" class="clearfix index_product_list">
        <?php foreach ($output['favorites_list'] as $key => $favorites) {
        $i++; ?>
        <div class="col-md-4 class="<?php if (!isset($favorites['goods']) || !$favorites['goods']['state']) { ?> disable<?php } ?>"">
            <div class="item">
                <div class="ct">
                    <a href="index.php?model=goods&goods_id=<?php echo $favorites['goods']['goods_id']; ?>"  target="_blank" title="<?php echo $favorites['goods']['goods_name']; ?>">
                        <div class="img_show">
                            <img  src="<?php echo thumb($favorites['goods'], 240); ?>" alt="">
                        </div>
                    </a>
                    <div class="txt">
                    <a href="index.php?model=goods&goods_id=<?php echo $favorites['goods']['goods_id']; ?>" class="dot-ellipsis dot-height-60 is-truncated" style="overflow-wrap: break-word;" target="_blank" title="<?php echo $favorites['goods']['goods_name']; ?>">
                    <?php echo $favorites['goods']['goods_name']; ?>
                    </a>

                    </div>
                    <div class="price text-center">
                      <?php if (!isset($favorites['goods']) || !$favorites['goods']['state']) { ?>
                                        <span class="lose"><em></em>商品已失效</span>
                                    <?php } else { ?>
                                         $<span>
                                            <?php if ($favorites['goods']['goods_promotion_price'] < $favorites['log_price']) { ?>
                                                <?php echo ncPriceFormat($favorites['goods']['goods_promotion_price']); ?>
                                            <?php } else { ?>

                                              <?php echo ncPriceFormat($favorites['goods']['goods_promotion_price']); ?>
                                            <?php } ?>
                                        </span>
                                    <?php } ?>
                    </div>
                    <a class="add" onclick="ajax_get_confirm('Are you sure you want to delete it?', 'index.php?model=member_favorite_goods&fun=delfavorites&type=goods&fav_id=<?php echo $favorites['fav_id']; ?>');">Delete</a>

                </div>
            </div>
        </div>
        <?php } ?>

    </div>
    <?php } ?>
    <div class="col-md-12">
        <div class="page margin-top-25">
            <?php echo $output['show_page']; ?>

        </div>
    </div>
</div>




    <script type="text/javascript">
        $(function () {

            <?php if (isset($favorites['goods']) || $favorites['goods']['state']) {?>
            // 加入购物车
            $('div[nctype="addcart_submit"]').click(function () {
                // if (typeof(allow_buy) != 'undefined' && allow_buy === false) return ;
                var goods_id = $(this).data('gid');
                addcart(goods_id, 1, 'addcart_callback');
            });

            <?php }?>

            $('#close').click(function () {
                $('#alert').hide();
            })
            $('#ser_btn').click(function () {
                $('#collform').submit();
            })


        });

        /* 加入购物车后的效果函数 */
        function addcart_callback(data) {
            $('#bold_num').html(data.num);
            $('#bold_mly').html(price_format(data.amount));
            $('#alert').fadeIn('fast');
        }

    </script>