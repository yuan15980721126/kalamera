<?php defined('interMarket') or exit('Access Invalid!');?>

<div id="my_store">
  <div id="m_collect">
    <div id="collect_title">
      <div>我的收藏</div>
      <div><a href="/index.php?model=member_favorite_goods&fun=index">更多</a></div>
    </div>
    <?php if(!empty($output['favorites_list']) && is_array($output['favorites_list'])){ ?>
    <div id="collect_goods">
      <div id="goods_bao">
      <ul>
        <?php foreach($output['favorites_list'] as $key=>$favorites){?>
        <li>
          <a href="<?php echo urlShop('goods','index',array('goods_id'=>$favorites['goods_id']));?>" target="_blank">
            <div>
              <img alt="" src="<?php echo thumb($favorites, 98);?>" style="height: 98px;">
            </div>										
            <div>
              &yen;<?php echo ncPriceFormat($favorites['goods_promotion_price']);?>
              <!-- <a href="<?php echo urlShop('show_store', 'index', array('store_id' => $favorites['store_id']), $favorites['store_domain']);?>" title="<?php echo $favorites['store_name'];?>" ><?php echo $favorites['store_name'];?></a>-->
            </div>
          </a>
        </li>
        <?php } ?>
      </ul>
      </div>
      <div id="upbtn"></div>
      <div id="downbtn"></div>
    </div>
    <?php } else { ?>
      <div class="null-tip">
        <h4>您还没有收藏商品</h4>
        <h5>收藏的商品将显示最新的促销活动和降价情况</h5>
      </div>
    <?php } ?>
  </div>	
  
  <div id="footprint">
    <div id="collect_title" class="jcarousel-skin-tango">
      <div>我的足迹</div>
      <div><a href="/index.php?model=member_goodsbrowse&fun=list">更多</a></div>
    </div>
    <div id="footprint_content">
      <?php if (!empty($output['viewed_goods']) && is_array($output['viewed_goods'])) { ?>
        <div id="browseMarkList" class="jcarousel-skin-tango">
          <?php foreach($output['viewed_goods'] as $goods_id => $goods_info) { ?>
          <div>
            <div>
              <a href="<?php echo $goods_info['url'];?>" target="_blank">
                <img alt="" src="<?php echo $goods_info['goods_image'];?>" style="height: 80px;">
              </a>
            </div>										
            <div>
              <a href="<?php echo $goods_info['url'];?>" title="<?php echo $goods_info['goods_name'];?>" target="_blank">
                <?php echo $goods_info['goods_name'];?>
              </a>
            </div>
            <a href="<?php echo $goods_info['url'];?>">进入详细</a>
          </div>
          <?php } ?>
        </div>
      <?php } else { ?>
        <span class="null-tip">
            <h4>您的商品浏览记录为空</h4>
            <h5>赶紧去商城看看促销活动吧</h5>
        </span>
      <?php } ?>
    </div>
  </div>	
</div>

<script>
//信息轮换
    $.getScript("<?php echo RESOURCE_SITE_URL;?>/js/jcarousel/jquery.jcarousel.min.js", function(){
    	$('#browseMarkList').jcarousel({visible: 3,itemFallbackDimension: 300});
    });
    var lengthall= <?php echo count($output['favorites_list']) ;?>;
     var indexallc=lengthall-1;
    //  设置滚动nav的宽度
    // $("#goods_bao ul").width($("#goods_bao>li").width()*$("#goods_bao>li").length);
    //      左
    $("#goods_bao ul").width($("#goods_bao li").outerWidth(true)*$("#goods_bao li").length);
            var steps=0;
        $("#downbtn").on("click",function(){
            console.log(indexallc);
            if(steps>$("#goods_bao li").length-indexallc){
                return false;
            }
            steps++;
            $("#goods_bao ul").animate({left:-($("#goods_bao li").outerWidth(true)*steps)},700)

        })
  
    
    //    右
        $("#upbtn").on("click",function(){
            if(steps==0){
                return false;
            }
            steps--;
            $("#goods_bao ul").animate({left:-($("#goods_bao li").outerWidth(true)*steps)},700)
        })


</script>