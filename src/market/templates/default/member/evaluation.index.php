<?php defined('interMarket') or exit('Access Invalid!'); ?>

<div class="order_nav evaluate_  clearfix">
    <div class="fl" style="margin-top: 13px;margin-left: 10px;">
        <div class="order_li " id="order_li1">
            <a href="<?php echo urlShop('member_evaluate', 'goodsadd'); ?>">
                To be evaluated
                <!--                [ --><?php //echo $output['not_num'];?><!--]-->
            </a>
        </div>
        <div class="order_li orderli_active" id="order_li2">
            <a href="<?php echo urlShop('member_evaluate', 'list', array('type' => 'already')
            ); ?>">Evaluate
                <!--                [--><?php //echo $output['goodsevalcount'];?><!--]-->
            </a>
        </div>
    </div>

</div>
<div class="info_tab dis_b">
    <div class="evaluation_pop pc_wrap_padding evaluate_done_list">
        <?php if (is_array($output['goodsevallist']) && !empty($output['goodsevallist'])) { ?>
            <?php foreach ((array)$output['goodsevallist'] as $k => $v) { ?>
                <div class="item clearfix">
                    <div class="inline_b">
                        <div class="imgb">
                            <a target="_blank"
                               href="<?php echo urlShop('goods', 'index', array('goods_id' => $v['geval_goodsid'])); ?>">
                                <img src="<?php echo cthumb($v['geval_goodsimage'], 240); ?>">
                            </a>
                        </div>
                    </div>
                    <div class="inline_b fr text_area">
                <span class="font-14">
                    <a target="_blank"
                       href="<?php echo urlShop('goods', 'index', array('goods_id' => $v['geval_goodsid'])); ?>">
                        <?php echo $v['geval_goodsname'] ?>
                    </a>
                </span><br>
                        <div class="level block" style="padding-top:5px;">
                            评分：
                            <em class="raty" data-score="<?php echo $v['geval_scores']; ?>"></em>
                        </div>

                        <p><?php echo $v['geval_content']; ?></p>
                        <p class="grey" style="margin-top: 5px;">
                            [ <?php echo @date('Y-m-d H:i:s', $v['geval_addtime']); ?>]</p>

                        <?php if (!empty($v['geval_image'])){ ?>
                        <div class="evaluate_imgs">
                            <div class="imgitem">
                                <?php $image_array = explode(',', $v['geval_image']); ?>
                                <?php foreach ($image_array as $value) { ?>
                                    <div class="img_b">
                                        <a nctype="nyroModal" href="<?php echo snsThumb($value, 1024); ?>"> <img
                                                    src="<?php echo snsThumb($value); ?>"> </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                </div>


            <?php } ?>


        <?php } else { ?>
            <div class="info_tab dis_b text-center min_height_450">
                <div style="padding:191px 0;">
                    <p style="font-size: 16px;font-weight: 700;margin:0 20px 15px 20px;">You have no comments.</p>
                    <a class="go_right" href="<?php echo BASE_SITE_URL; ?>">Go shopping</a>
                </div>
            </div>
        <?php } ?>


    </div>
</div>

</div>

<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL; ?>/js/jquery.nyroModal/custom.min.js"
        charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL; ?>/js/jquery.poshytip.min.js"
        charset="utf-8"></script>
<link href="<?php echo RESOURCE_SITE_URL; ?>/js/jquery.nyroModal/styles/nyroModal.css" rel="stylesheet" type="text/css"
      id="cssfile2"/>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL; ?>/js/jquery.raty/jquery.raty.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.raty').raty({
            path: "<?php echo RESOURCE_SITE_URL;?>/js/jquery.raty/img",
            readOnly: true,
            score: function () {
                return $(this).attr('data-score');
            }
        });

        $('a[nctype="nyroModal"]').nyroModal();
    });
</script> 
