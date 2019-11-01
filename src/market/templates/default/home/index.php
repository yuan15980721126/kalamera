<?php defined('interMarket') or exit('Access Invalid!');?>

<!--banner-->
<div class="index_banner clearfix">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="owl-carousel" id="banner"><!--banner广告管理-->
                    <?php if(!empty($output['banner']) && is_array($output['banner'])){?>
                        <?php foreach($output['banner'] as $key=>$val){?>
                            <div>
                                <a href="<?php echo $val['url']?>">
                                    <img src="<?php echo UPLOAD_SITE_URL.'/'.ATTACH_ADV.'/'.$val['pic'];?>" />
                                </a>
                            </div>
                        <?php }?>
                    <?php }?>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6 relative padding-right-7_5 md-padding-right-5"><!--首页管理（门口设计）-->
                        <a href="<?php echo $output['code_1']['code_info']['url']?>">
                            <img src="<?php echo UPLOAD_SITE_URL.'/'.$output['code_1']['code_info']['pic'];?>" alt=""/>
                            <div class="index_mask_tt"><?php echo $output['code_1']['code_info']['title'];?></div>
                        </a>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 relative padding-left-7_5 md-padding-left-5"><!--首页管理（门口设计）-->
                        <a href="<?php echo $output['code_2']['code_info']['url']?>">
                            <img src="<?php echo UPLOAD_SITE_URL.'/'.$output['code_2']['code_info']['pic'];?>" alt=""/>
                            <div class="index_mask_tt"><?php echo $output['code_2']['code_info']['title'];?></div>
                        </a>
                    </div>
                </div>

            </div>
            <div class="col-md-3 ">
                <div class="row">
                    <div class="clearfix md-inline">
                        <div class="pc-padding-left-0 col-md-12 col-sm-12 col-xs-12 md-padding-top-10 md-padding-right-5"><!--首页管理（门口设计）-->
                            <a href="<?php echo $output['code_3']['code_info']['url']?>">
                                <img src="<?php echo UPLOAD_SITE_URL.'/'.$output['code_3']['code_info']['pic'];?>" alt=""/>
                                <div class="index_mask_tt"><?php echo $output['code_3']['code_info']['title'];?></div>
                            </a>
                        </div>
                    </div>
                    <div class="clearfix pc-padding-top-23 md-inline">
                        <div class="pc-padding-left-0 col-md-12 col-sm-12 col-xs-12 md-padding-top-10 md-padding-left-5"><!--首页管理（门口设计）-->
                            <a href="<?php echo $output['code_4']['code_info']['url']?>">
                                <img src="<?php echo UPLOAD_SITE_URL.'/'.$output['code_4']['code_info']['pic'];?>" alt=""/>
                                <div class="index_mask_tt"><?php echo $output['code_4']['code_info']['title'];?></div>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--banner结束-->

<!--中间内容-->
<div class="container">
    <div class="row row_padding">
        <div class="col-md-4">
            <div class="index_product_t">Products</div>
           Ice bar has a wine cabinet with professional storage temperature design, but also with the refrigerator can store
            <div class="more_btn">
                <a href="<?php echo urlShop('search', 'index');?>">View more<em class="biao"></em></a>
            </div>
        </div>
        <div class="col-md-8">
            <div class="img_full">
                <?php if(!empty($output['middle_adv']) && is_array($output['middle_adv'])){?>
                    <?php foreach($output['middle_adv'] as $key=>$val){?>
                        <div>
                            <a href="<?php echo $val['url']?>">
                                <img src="<?php echo UPLOAD_SITE_URL.'/'.ATTACH_ADV.'/'.$val['pic'];?>" />
                            </a>
                        </div>
                    <?php }?>
                <?php }?>
            </div>
        </div>
    </div>

        <div class="row index_product_list">
        <?php foreach($output['code_sale_list']['code_info'] as $key=>$val){?>
        <?php if($val['recommend']['name'] != '今日推荐'){?>
                <?php if(!empty($val['goods_list']) && is_array($val['goods_list'])){?>
                    <?php foreach($val['goods_list'] as $k=>$v){?>
                        <div class="col-md-3">
                            <div class="item">
                                <div class="ct">
                                    <div class="img_show">
                                        <a href="<?php echo SHOP_SITE_URL."/index.php?model=goods&goods_id=".$v['goods_id'];?>" target="_blank">
                                        <img src="<?php echo strpos($v['goods_pic'],'http')===0 ? $v['goods_pic']:UPLOAD_SITE_URL."/".$v['goods_pic'];?>" />
                                        </a>
                                    </div>
                                    <div class="txt">
                                        <a href="<?php echo SHOP_SITE_URL."/index.php?model=goods&goods_id=".$v['goods_id'];?>" target="_blank" class="dot-ellipsis dot-height-60">
                                            <?php echo $v['goods_name'];?>
                                        </a>
                                    </div>
                                    <div class="price">
                                        $<span><?php echo $v['goods_price'];?></span>
                                    </div>
                                    <div class="clearfix">
                                        <a href="javascript:collect_goods('<?php echo $v['goods_id']; ?>','count','goods_collect');">

                                        <div class="favor fl">
                                            <span class="favor_btn"></span>
                                            Favorite
                                        </div>
                                        </a>
                                        <div class="fr level raty" data-score="<?php echo $output['code_goods_star'][$v['goods_id']] ?>"></div>
                                    </div>
                                    <a class="add" href="javascript:void(0)"  nctype="add_cart" data-gid="<?php echo $v['goods_id'];?>">Add To Cart</a>
                                </div>
                            </div>
                        </div>
                    <?php }?>
                <?php }?>
            <?php }?>
        <?php }?>

    </div>
</div>
<!--中间结束-->
<script type="text/javascript" src="--><?php //echo RESOURCE_SITE_URL?><!--/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL; ?>/js/jquery.raty/jquery.raty.min.js"></script>
<!--<script type="text/javascript" src="--><?php //echo RESOURCE_SITE_URL?><!--/js/jquery-ui.min.js"></script>-->
<!--<script type="text/javascript" src="--><?php //echo RESOURCE_SITE_URL;?><!--/js/common.js"></script>-->
<!--<script src="--><?php //echo RESOURCE_SITE_URL;?><!--/js/dialog/dialog.js" id="dialog_js" charset="utf-8"></script>-->

<script type="text/javascript">

$(function(){
    $('.raty').raty({
        score: function() {
            return $(this).attr('data-score');
        },
        readOnly: true,
        path: "<?php echo RESOURCE_SITE_URL;?>/js/jquery.raty/img",
    });

});
</script>





