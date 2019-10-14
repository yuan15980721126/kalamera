<?php defined('interMarket') or exit('Access Invalid!');?>
<style>
   .art_con p {
        margin: 5px 0;
       display: block;
       margin-block-start: 1em;
       margin-block-end: 1em;
       margin-inline-start: 0px;
       margin-inline-end: 0px;
    }
   .art_con h1,.art_con h2,.art_con h3,.art_con h4,.art_con h5{
       font-weight: bold;

   }
   .art_con >p >span{
       font-size: 16px;
   }
   .art_con ul{
       display: block;
       list-style-type: disc;
       margin-block-start: 1em;
       margin-block-end: 1em;
       margin-inline-start: 0px;
       margin-inline-end: 0px;
       padding-inline-start: 40px;
   }
   .art_con ul, li {
       /*list-style-type:disc;*/

   }
   .art_con li{
       display: list-item;
       text-align: -webkit-match-parent;
   }
</style>

<!--中间内容-->
<div class="container">
    <div class="art_show">
        <div class="art_tit"><?php echo $output['article']['article_title'];?></div>
        <div class="center">
            <div class="artibox_b">
                <span> <img src="/skins/default/img/icon_time.png"><span class="inline"><?php echo date('Y-m-d H:i',$output['article']['article_time']);?></span></span>
<!--                <span> <img src="/skins/default/img/icon_hits.png"><span class="inline">125</span></span>-->
                <span class="detail_share ">
                    <img src="/skins/default/img/icon_share.png">
                     <span class="pro_share">
                    <span class="inline ">
                        Share:</span>
                    <a href="javascript:void(0);" onclick="linkedin_share('<?='http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ?>','<?=$output['goods']['goods_name'].'-kalamera' ?>');"></a>
                         <a href="javascript:void(0);" onclick="twitter_share('<?='http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ?>','<?=$output['goods']['goods_name'].'-kalamera' ?>');"></a>
                         <a href="javascript:void(0);" onclick="google_share('<?='http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ?>','<?=$output['goods']['goods_name'].'-kalamera' ?>');"></a>
                         <a href="javascript:void(0);" onclick="fbs_share('<?='http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ?>','<?=$output['goods']['goods_name'].'-kalamera' ?>');"></a>
                    </span>
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="art_con">
                    <?php echo $output['article']['article_content'];?>
                </div>
                <div class="huanye">
                    <p>
                    <?php if(!empty($output['pre_article']) and is_array($output['pre_article'])){?>
                        <a class="prev"<?php if($output['pre_article']['article_url']!=''){?>target="_blank"<?php }?> href="<?php if($output['pre_article']['article_url']!='')echo $output['pre_article']['article_url'];else echo urlMember('article', 'show', array('article_id'=>$output['pre_article']['article_id']));?>"><?php echo $output['pre_article']['article_title'];?></a> <time><?php echo date('Y-m-d H:i',$output['pre_article']['article_time']);?></time>
                    <?php }else{?>
                        <a class="prev"></a>
                        <?php echo $lang['article_article_not_found'];?>
                    <?php }?>
                    </p>
                    <p>
                        <?php if(!empty($output['next_article']) and is_array($output['next_article'])){?>
                            <a class="next"<?php if($output['next_article']['article_url']!=''){?>target="_blank"<?php }?> href="<?php if($output['next_article']['article_url']!='')echo $output['next_article']['article_url'];else echo urlMember('article', 'show', array('article_id'=>$output['next_article']['article_id']));?>"><?php echo $output['next_article']['article_title'];?></a> <time><?php echo date('Y-m-d H:i',$output['next_article']['article_time']);?></time>
                        <?php }else{?>
                            <a class="next"></a>
                            <?php echo $lang['article_article_not_found'];?>
                        <?php }?>
                    </p>

                </div>
            </div>
            <div class="col-md-3">
                <div class="index_product_list">
                    <div class="item">
                        <div class="ct">
                            <div class="slidebar_tt">Latest posts</div>
                            <ul class="latest_posts">
                                <?php if(is_array($output['new_article_list']) and !empty($output['new_article_list'])){?>
                                    <?php foreach ($output['new_article_list'] as $k=>$v){?>
                                        <li>
                                            <img src=" <?php echo $v['pic'];?>" alt="">
                                            <div class="txt">
                                                <a <?php if($v['article_url']!=''){?>target="_blank"<?php }?> href="<?php if($v['article_url']!='')echo $v['article_url'];else echo urlMember('article', 'show', array('article_id'=>$v['article_id']));?>"  class="dot-ellipsis dot-height-34"><?php echo $v['article_title']?></a>
                                                <span><?php echo date('Y-m-d H:i',$v['article_time']);?></span>
                                            </div>
                                        </li>
                                    <?php }?>
                                <?php }else{?>
                                    <li><?php echo $lang['article_article_no_new_article'];?></li>
                                <?php }?>

                            </ul>
                        </div>
                    </div>

                    <div class="item">
                        <div class="ct">
                            <div class="slidebar_tt">Hot Products</div>
                            <div class="hot_circle_ct">
                                <?php if(is_array($output['hot_sales']) and !empty($output['hot_sales'])){?>
                                <?php foreach ($output['hot_sales'] as $k=>$v){?>
                                <div class="hot_circle_item">
                                    <div class="img_show">
                                        <img src="<?php echo thumb($v, 240);?>" alt="<?php echo $v['goods_name'];?>" />
                                    </div>
                                    <div class="txt dot-ellipsis dot-height-40">
                                        <a href="<?php echo urlShop('goods', 'index', array('goods_id' => $v['goods_id']));?>" title="<?php echo $v['goods_jingle'];?>">

                                        <?php echo $v['goods_name'];?>
                                        </a>
                                    </div>

                                    <div class="clearfix">
                                        <div class="price fl">
                                            $<span><?php echo $v['goods_promotion_price'];?></span>
                                        </div>
                                        <div class="fr level margin-top-10">
                                            <span class="on"></span>
                                            <span class="on"></span>
                                            <span class="on"></span>
                                            <span class="on"></span>
                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                                    <?php }?>
                                <?php }else{?>
                                    <li><?php echo $lang['article_article_no_new_article'];?></li>
                                <?php }?>

                            </div>
                            <div class="hot_nav"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!--中间内容结束-->



<script>
$(function(){


});
</script>
