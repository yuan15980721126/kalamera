<?php defined('interMarket') or exit('Access Invalid!');?>

<!--新闻列表-->
<div class="container">
    <?php if(!empty($output['article']) and is_array($output['article'])){?>
    <?php foreach ($output['article'] as $article) {?>
    <div class="news_item clearfix">
        <div class="row">
            <div class="col-md-3">
                <a <?php if($article['article_url']!=''){?>target="_blank"<?php }?> href="<?php if($article['article_url']!='')echo $article['article_url'];else echo urlMember('article', 'show', array('article_id'=>$article['article_id']));?>">
                <img src=" <?php echo $article['pic'];?>" alt="">
                </a>
            </div>
            <div class="col-md-9">
                <div class="article_box">
                    <div class="arti_tit ">
                        <a class="dot-ellipsis dot-height-50"  <?php if($article['article_url']!=''){?>target="_blank"<?php }?> href="<?php if($article['article_url']!='')echo $article['article_url'];else echo urlMember('article', 'show', array('article_id'=>$article['article_id']));?>">
                            <?php echo $article['article_title'];?>
                        </a>
                    </div>
                    <p class="article_txt dot-ellipsis dot-height-70">
                        <?php echo strip_tags($article['article_content']); ?>
                        </p>
                    <div class="artibox_b clearfix">
                        <span>
                            <img src="/skins/default/img/icon_time.png"><span class="inline">
                                <?php echo date('Y-m-d',$article['article_time']);?>&nbsp;
                            </span>
                        </span>
<!--                        <span> <img src="images/icon_hits.png"><span class="inline">125</span></span>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
        <?php }?>
    <?php }else{?>
    <div><?php echo $lang['article_article_not_found'];?></div>
    <?php }?>


</div>
<!--新闻列表结束-->
<!--页面跳转-->
<div class="container">
    <div class="page">
        <?php echo $output['show_page'];?>
    </div>
</div>
<!--页面跳转结束-->
<!--中间内容结束-->

