<?php defined('interMarket') or exit('Access Invalid!');?>
<?php if($_GET['model'] != 'pointcart'){?>
    <!--头部logo-->
    <div class="logo_ container">
        <div class="left_logo fl hidden-xs hidden-sm">
            <a href="<?php echo SHOP_SITE_URL;?>">
                <img class="inline_b" src="<?php echo UPLOAD_SITE_URL.DS.ATTACH_COMMON.DS.$output['setting_config']['site_logo']; ?>"/>
            </a>


            <div class="inline_b margin-left-15">
                <div class="blue_theme fsFourteen weight">Questions? Comments?</div>
                <div class="tel_"><?php echo $output['setting_config']['hao_phone']; ?></div>
            </div>
            <div class="inline_b margin-left-15">
                <div class="blue_theme fsFourteen weight">All ltems</div>
                <div class="car_">Free Delivery Nationwide</div>
            </div>
        </div>
        <div class="fr">

            <form action="<?php echo SHOP_SITE_URL;?>" method="get" class="search-form fl inline_b" id="top_search_form">
                <div class="search_ ">
                    <input name="keyword" id="keyword" type="text" class="input-text"
                           value="<?php echo $_GET['keyword'];?>"
                           placeholder="Please enter the name of the product"
                         />
                    <input name="model" id="search_act" value="search" type="hidden">
                    <input type="submit" id="ser_btn" value="<?php echo $lang['nc_common_search'];?>"
                           / >
                </div>
            </form>
            <div class="fl car_num hidden-xs relative">
                <div class="num_box">
                    Cart
                    <div class="num">
                        <?php if($output['cart_goods_num']){echo $output['cart_goods_num'];}else{echo 0;};?>
                    </div>
                </div>
                <div class="shop_list">
                    <div class="msg">
                        <div class="fl"><span> <?php if($output['cart_goods_num']){echo $output['cart_goods_num'];}else{echo 0;};?> </span> items</div>
                        <div class="fr">
                            <a href="<?php echo SHOP_SITE_URL;?>/index.php?model=cart" class="blue_theme">View Cart</a>
                        </div>
                    </div>
                    <div class="text-center">
                        <?php if($output['cart_goods_num']>0){ ?>
                        <p class="money">SubTotal: <span class="red"><?php echo cookie('cart_all_price');?></span></p>
                        <a href="<?php echo SHOP_SITE_URL.DS?>index.php?model=cart" class="checkout">Secure Checkout</a>
                        <?php }else{ ?>
                            <p class="tip">Your cart is empty</p>
                            <p class="money">SubTotal: <span class="red">$0.00</span></p>
                            <a href="<?php echo SHOP_SITE_URL.DS?>index.php?model=cart" class="checkout">Secure Checkout</a>
                        <?php }?>
                    </div>
                </div>
            </div>
            <div class="fl on_sale hidden-xs" onclick="window.location.href='/index.php?model=promotion&fun=index';return false">
                On Sale
            </div>
        </div>
    </div>
    <!--头部logo结束-->






 <?php } ?>