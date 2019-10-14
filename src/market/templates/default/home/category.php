<?php defined('interMarket') or exit('Access Invalid!');?>
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/layout.css" rel="stylesheet" type="text/css">



<link rel="stylesheet" href="/skins/default/css/brand.css" />


<script src="/skins/default/js/brand.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.masonry.js" type="text/javascript"></script>
<!--当前位置结束-->
<div class="container pro_category">
    <?php foreach($output['goods_class'] as $k => $v){ ?>

    <div class="col-md-6">
        <div class="img_full">
            <a href="<?php echo urlShop('search', 'index', array('cate_id' => $v['gc_id'])); ?>">
             <img src="<?php echo $v['cn_pic'];?>" alt="">
            </a>
        </div>
        <p class="to_list">
            <a href="<?php echo urlShop('search', 'index', array('cate_id' => $v['gc_id'])); ?>">
            <?php echo $v['gc_name'];?>
            </a>
        </p>
    </div>
    <?php }?>



</div>
<!--中间内容结束-->
<script>
$(function(){
	$("#categoryList").masonry({
		itemSelector : '.classes'
	});
});
</script> 
