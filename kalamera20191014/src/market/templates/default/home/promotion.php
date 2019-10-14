<?php defined('interMarket') or exit('Access Invalid!');?>
<style type="text/css">
#box { background: #FFF; width: 238px; height: 410px; margin: -390px 0 0 0; display: block; border: solid 4px #D93600; position: absolute; z-index: 999; opacity: .5 }
#infscr-loading { display: none; }
</style>
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/layout.css" rel="stylesheet" type="text/css">

<div class="container padding_15-0">
<div class="col-md-9">

    <div class="row index_product_list" id="detail_goods">

        <?php require(BASE_TPL_PATH.'/home/promotion.item.php');?>



    </div>
    <div class="page margin-top-0">
        <?php echo $output['show_page']; ?>
    </div>
</div>
</div>







<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.raty/jquery.raty.min.js"></script> 
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.masonry.js" type="text/javascript"></script> 
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.infinitescroll.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/fly/jquery.fly.min.js" charset="utf-8"></script> 
<!--[if lt IE 10]>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/fly/requestAnimationFrame.js" charset="utf-8"></script>
<![endif]-->
<script>
var $container = $('#promotionGoods');
$container.masonry({
    columnWidth: 305,
    itemSelector: '.item'
});
$(function(){
	$container.infinitescroll({  
        navSelector : '#page-more',
        nextSelector : '#page-more a',
        itemSelector : '.item',
        loading: {
        	selector:'#page-nav',
            img: '<?php echo SHOP_TEMPLATES_URL;?>/images/loading.gif',
            msgText:'努力加载中...',
            maxPage : <?php echo $output['total_page'];?>,
            finishedMsg : '没有记录了',
            finished : function() {
            	$('.raty').raty({
                    path: "<?php echo RESOURCE_SITE_URL;?>/js/jquery.raty/img",
                    readOnly: true,
                    width: 100,
                    score: function() {
                      return $(this).attr('data-score');
                    }
                });
            }
        }
    },function(newElements){
		var $newElems = $(newElements);
		$container.masonry('appended', $newElems, true);
	});

	$('.raty').raty({
        path: "<?php echo RESOURCE_SITE_URL;?>/js/jquery.raty/img",
        readOnly: true,
        width: 100,
        score: function() {
          return $(this).attr('data-score');
        }
    });
    // 加入购物车
    $(window).resize(function() {
        $('#promotionGoods').on('click', 'a[nctype="add_cart"]', function() {
            // flyToCart($(this));
        });
    });
    $('#promotionGoods').on('click', 'a[nctype="add_cart"]', function() {
        // flyToCart($(this));
    });
     function flyToCart($this) {
        var rtoolbar_offset_left = $("#rtoolbar_cart").offset().left;
        var rtoolbar_offset_top = $("#rtoolbar_cart").offset().top-$(document).scrollTop();
        var img = $this.parents('.scope:first').find('img:first').attr('src');
        var data_gid = $this.attr('data-gid');
        var flyer = $('<img class="u-flyer" src="'+img+'" style="z-index:999">');
        flyer.fly({
            start: {
                left: $this.offset().left,
                top: $this.offset().top-$(document).scrollTop()-450
            },
            end: {
                left: rtoolbar_offset_left,
                top: rtoolbar_offset_top,
                width: 0,
                height: 0
            },
            onEnd: function(){
                addcart(data_gid,1,'');
                flyer.remove();
            }
        });
     }
});
</script> 