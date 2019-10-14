<?php defined('interMarket') or exit('Access Invalid!');?>
<link rel="stylesheet" href="/skins/default/css/Mycollect.css" />
<!--<link rel="stylesheet" href="/skins/default/css/productinfo.css" />-->
<style type="text/css">
#box { background: #F30; width: 16px; height: 16px; margin-left: 150px; display: block; border-radius: 100%; position: absolute; z-index: 999; opacity: .5 }
#ex_li li {
    float: left!important;
    width: 82px!important;
    margin: 0 12px!important;
    border: none!important;
}
</style>
<div class="wrap">
  <div class="tabmenu">
    <?php include template('layout/submenu');?>
  </div>
  <?php if(!empty($output['favorites_list'])) { ?>
<!--  <div id="favoritesGoods">-->
    <?php require(BASE_TPL_PATH.'/member/favorites_goods_picshowlist.item.php');?>
<!--  </div>-->
  <?php } else {?>

      <div class="info_tab dis_b text-center min_height_450">
          <div style="padding:191px 0;">
              <p style="font-size: 16px;font-weight: 700;margin:0 20px 15px 20px;">You haven't collected anything.</p>
              <a class="go_right" href="<?php echo BASE_SITE_URL;?>">Go shopping</a>
          </div>
      </div>
<!--  <div class="warning-option"><i>&nbsp;</i><span>--><?php //echo $lang['no_record'];?><!--</span></div>-->
  <?php }?>
  <div class="tc mt20 mb20">
    <div class="pagination" id="page-nav"></div>
  </div>
  <!-- 猜你喜欢 -->
  <div id="guesslike_div" style="width:980px;"></div>
</div>
<form id="buynow_form" method="post" action="<?php echo SHOP_SITE_URL;?>/index.php" target="_blank">
  <input id="act" name="model" type="hidden" value="buy" />
  <input id="op" name="fun" type="hidden" value="buy_step1" />
  <input id="goods_id" name="cart_id[]" type="hidden"/>
</form>
<div id="page-more"><a href="index.php?model=member_favorite_goods&fun=fglist&curpage=2"></a></div>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.infinitescroll.js" type="text/javascript"></script> 
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.thumb.min.js"></script> 
<script src="<?php echo RESOURCE_SITE_URL;?>/js/sns.js"></script> 
<script src="<?php echo RESOURCE_SITE_URL;?>/js/fly/jquery.fly.min.js"></script> 
<!--[if lt IE 10]>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/fly/requestAnimationFrame.js" charset="utf-8"></script>
<![endif]-->
<script>
$(function(){
    $('#favoritesGoods').infinitescroll({
        navSelector : '#page-more',
        nextSelector : '#page-more a',
        itemSelector : '.favorite-goods-list',
        loading: {
        	selector:'#page-nav',
            img: '<?php echo SHOP_TEMPLATES_URL;?>/images/loading.gif',
            msgText:'努力加载中...',
            maxPage : <?php echo $output['total_page'];?>,
            finishedMsg : '没有记录了',
            finished : function() {
            	$('.favorite-goods-thumb img').jqthumb({
            		width: 150,
            		height: 150,
            		after: function(imgObj){
            			imgObj.css('opacity', 0).attr('title',$(this).attr('alt')).animate({opacity: 1}, 2000);
            		}
            	});
            }
        }
    });

    
	$('.favorite-goods-thumb img').jqthumb({
		width: 150,
		height: 150,
		after: function(imgObj){
			imgObj.css('opacity', 0).attr('title',$(this).attr('alt')).animate({opacity: 1}, 2000);
		}
	});

	//猜你喜欢
	$('#guesslike_div').load('<?php echo urlShop('search', 'get_guesslike', array()); ?>', function(){
        $(this).show();
    });

    // 领取代金券
    $("#favoritesGoods").on('click', 'a[data-tid]', function(){
        var _tid = $(this).attr('data-tid');
        ajaxget('index.php?model=voucher&fun=getvouchersave&jump=0&tid=' + _tid);
    });

    // 加入购物车
    $(window).resize(function() {
        $('#favoritesGoods').on('click','a[nctype="add_cart"]', function() {
            // flyToCart($(this));
        });
    });
    $('#favoritesGoods').on('click','a[nctype="add_cart"]', function() {
        // flyToCart($(this));
    });
     function flyToCart($this) {
         var rtoolbar_offset_left = $("#rtoolbar_cart").offset().left;
         var rtoolbar_offset_top = $("#rtoolbar_cart").offset().top-$(document).scrollTop();
  		var img = $this.parents('li').find('img').attr('src');
  		var data_gid = $this.attr('data-gid');
  		var flyer = $('<img class="u-flyer" src="'+img+'" style="z-index:999">');
  		flyer.fly({
  			start: {
  				left: $this.offset().left,
  				top: $this.offset().top-$(document).scrollTop()
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

    // 立即购买
    $('a[nctype="buy_now"]').click(function(){
        var data_gid = $(this).attr('data-gid');
        $("#goods_id").val(data_gid+'|1');
        $("#buynow_form").submit();
    });
});
 
</script> 
