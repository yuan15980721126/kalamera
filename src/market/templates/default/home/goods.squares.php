<?php defined('interMarket') or exit('Access Invalid!');?>
<?php if(!empty($output['goods_list']) && is_array($output['goods_list'])){?>
     <?php foreach($output['goods_list'] as $value){?>
<div class="col-md-4">
    <div class="item">
        <div class="ct">
            <div class="img_show">
                <a href="<?php echo SHOP_SITE_URL."/index.php?model=goods&goods_id=".$value['goods_id'];?>" >
                <img src="<?php echo cthumb($value['goods_image'], 240,$value['store_id']);?>" title="<?php echo $value['goods_name'];?>" alt="<?php echo $value['goods_name'];?>" />
                </a>
            </div>
            <div class="txt">
                <a href="<?php echo SHOP_SITE_URL."/index.php?model=goods&goods_id=".$value['goods_id'];?>" class="dot-ellipsis dot-height-60">
                    <?php echo $value['goods_name'];?>
                </a>
            </div>
            <div class="price">
                $<span><?php echo $value['goods_promotion_price'];?></span>
            </div>
            <div class="clearfix">
                <a href="javascript:collect_goods('<?php echo $value['goods_id']; ?>','count','goods_collect');">
                    <div class="favor fl"><span class="favor_btn"></span>Favorite</div>
                </a>
                <div class="fr raty level " data-score="<?php echo $value['evaluation_good_star'] ?>"></div>
            </div>
            <a class="add" href="javascript:void(0)"  nctype="add_cart" data-gid="<?php echo $value['goods_id'];?>">Add To Cart</a>

        </div>
    </div>
</div>
    <?php }?>
<?php }else{?>
    <div id="no_results" class="no-results"><i></i><?php echo $lang['index_no_record'];?></div>
<?php }?>





<form id="buynow_form" method="post" action="<?php echo SHOP_SITE_URL;?>/index.php" target="_blank">
  <input id="act" name="model" type="hidden" value="buy" />
  <input id="op" name="fun" type="hidden" value="buy_step1" />
  <input id="goods_id" name="cart_id[]" type="hidden"/>
</form>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.raty/jquery.raty.min.js"></script> 
<script type="text/javascript">
    $(document).ready(function(){
         $('a[nctype="add_cart"]').click(function() {
            var $this = $(this);
            var data_gid = $this.attr('data-gid');
            var goods_repair = $('#goods_repair').val();
            addcart(data_gid,1,'',goods_repair);

        });
        $('.raty').raty({
            path: "<?php echo RESOURCE_SITE_URL;?>/js/jquery.raty/img",
            readOnly: true,
            width: 100,
            score: function() {
              return $(this).attr('data-score');
            }
        });
      	//初始化对比按钮
    	//###initCompare();
    });
</script> 
