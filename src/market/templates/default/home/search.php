<?php defined('interMarket') or exit('Access Invalid!');?>
<script src="<?php echo SHOP_RESOURCE_SITE_URL.'/js/search_goods.js';?>"></script>
<script src="/skins/default/js/prdsu.js"></script>

<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/layout.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="/skins/default/css/productsummary.css" />
<style type="text/css">
body { _behavior: url(<?php echo SHOP_TEMPLATES_URL;
?>/css/csshover.htc);
}
</style>





<!--当前位置结束-->
<div class="container padding_15-0">
    <div class="col-md-3">
        <ul class="bar_list">
            <li>
                <p class="t">Product Categories</p>
                <ul class="pro_sort">
                    <?php foreach ($output['show_goods_class'] as $key => $val) {?>
                    <li>
                        <a cat_id="<?php echo $val['gc_id']; ?>"  <?php if($_GET['cate_id'] ==  $val['gc_id']){?> class="active"<?php }?>
                           href="<?php echo urlShop('search', 'index', array('cate_id' => $val['gc_id'])); ?>">
                            <?php echo $val['gc_name']; ?>
                        </a>
                    </li>

                    <?php }?>

                </ul>
            </li>
            <li>
                <p class="t">Have Questions?</p>
                <div class="bar_ct text-center">
                    <div class="service"><img src="/skins/default/img/service.png" alt=""></div>
                    <span class="font-14">Talk to a Product Expert Call:</span>
                    <p class="big_font padding-top-10"><?php echo $output['list_setting']['site_phone'];?></p>
                </div>
            </li>
        </ul>
    </div>
    <div class="col-md-9">
        <div class="sort_bar">
            <div class="fl">
                Sort By:
                <select name="" id="sort_select" class="sort_select" onchange="sort_change(this.options[this.options.selectedIndex].value)">
                    <option value="1"  <?php if($_GET['key'] == '1'){?>selected='selected'<?php }?>>Best Selling</option>
                    <option value="2" <?php if($_GET['key'] == '3' && $_GET['order'] == '2' ){?>selected='selected'<?php }?>>price up</option>
                    <option value="3" <?php  if($_GET['key'] == '3' && $_GET['order'] == '1' ){?>selected='selected'<?php }?>>price down</option>
                </select>
            </div>
            <div class="fr">
                View as:
                <a href="javascript:;" class="block_link active"></a>
<!--                <a href="javascript:;" class="flow_link"></a>-->
            </div>
        </div>
        <div class="row index_product_list" id="detail_goods">
            <?php require_once (BASE_TPL_PATH.'/home/goods.squares.php');?>
        </div>
        <div class="page margin-top-0">
            <?php echo $output['show_page']; ?>
        </div>
    </div>
</div>
<!--中间内容结束-->








<script src="<?php echo RESOURCE_SITE_URL;?>/js/waypoints.js"></script> 
<script src="<?php echo SHOP_RESOURCE_SITE_URL;?>/js/search_category_menu.js"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/fly/jquery.fly.min.js" charset="utf-8"></script> 
<!--[if lt IE 10]>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/fly/requestAnimationFrame.js" charset="utf-8"></script>
<![endif]-->
<script type="text/javascript">
var defaultSmallGoodsImage = '<?php echo defaultGoodsImage(240);?>';
var defaultTinyGoodsImage = '<?php echo defaultGoodsImage(60);?>';
var cate_id = '<?php echo $_GET['cate_id'];?>';
function sort_change(val){
    // alert(4141)
    if(val == 1){
        window.location.href = 'index.php?model=search&fun=index&fun=index&cate_id='+cate_id+'&key=1&order=2';
    }else if(val == 2){
        window.location.href = 'index.php?model=search&fun=index&fun=index&cate_id='+cate_id+'&key=3&order=2';
    }else{
        window.location.href = 'index.php?model=search&fun=index&fun=index&cate_id='+cate_id+'&key=3&order=1';
    }
}
$(function(){

    $('#files').tree({
        expanded: 'li:lt(2)'
    });
	//品牌索引过长滚条
    //浮动导航  waypoints.js
    $('#main-nav-holder').waypoint(function(event, direction) {
        $(this).parent().toggleClass('sticky', direction === "down");
        event.stopPropagation();
    });
	// 单行显示更多
	$('span[nc_type="show"]').click(function(){
		s = $(this).parents('dd').prev().find('li[nc_type="none"]');
		if(s.css('display') == 'none'){
			s.show();
			$(this).html('<i class="icon-angle-up"></i><?php echo $lang['goods_class_index_retract'];?>');
		}else{
			s.hide();
			$(this).html('<i class="icon-angle-down"></i><?php echo $lang['goods_class_index_more'];?>');
		}
	});

	<?php if(isset($_GET['area_id']) && intval($_GET['area_id']) > 0){?>
  // 选择地区后的地区显示
  $('[nc_type="area_name"]').html('<?php echo $output['province_array'][intval($_GET['area_id'])]; ?>');
	<?php }?>

	<?php if(isset($_GET['cate_id']) && intval($_GET['cate_id']) > 0){?>
	// 推荐商品异步显示
    $('div[nctype="booth_goods"]').load('<?php echo urlShop('search', 'get_booth_goods', array('cate_id' => $_GET['cate_id']))?>', function(){
        $(this).show();
    });
	<?php }?>
	//浏览历史处滚条

	//猜你喜欢
	$('#guesslike_div').load('<?php echo urlShop('search', 'get_guesslike', array()); ?>', function(){
        $(this).show();
    });

	//商品分类推荐
	$('#gc_goods_recommend_div').load('<?php echo urlShop('search', 'get_gc_goods_recommend', array('cate_id'=>$output['default_classid'])); ?>');
});
</script> 
