<?php if(isset($output['sales_promotion'])){ ?>
<!--    <div class="banner">-->
<!--        <img class="close_" src="/skins/default/img/On-sale.jpg" alt="" >-->
<!--    </div>-->
    <?php if(!empty($output['middle_adv']) && is_array($output['middle_adv'])){?>
        <?php foreach($output['middle_adv'] as $key=>$val){?>
            <div class="banner">
                <a href="<?php echo $val['url']?>">
                    <img src="<?php echo UPLOAD_SITE_URL.'/'.ATTACH_ADV.'/'.$val['pic'];?>" />
                </a>
            </div>
        <?php }?>
    <?php }?>
<?php } ?>
<div class="container">

    <?php if (!empty($output['nav_link_list']) && is_array($output['nav_link_list'])) { ?>
        <span class="location_ location_home"> >
            <?php foreach ($output['nav_link_list'] as $nav_link) { ?>

                <?php if (!empty($nav_link['link'])) { ?>

                    <?php echo $nav_link['title']; ?> >

                <?php } else { ?>
                    <a href="<?php echo $nav_link['link']; ?>"><?php echo $nav_link['title']; ?></a>
                <?php } ?>

            <?php } ?>
        </span>
    <?php } ?>

</div>

