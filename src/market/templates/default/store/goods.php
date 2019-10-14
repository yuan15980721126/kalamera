<?php defined('interMarket') or exit('Access Invalid!'); ?>
<link href="<?php echo SHOP_TEMPLATES_URL; ?>/css/home_goods.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="/skins/default/css/productinfo.css"/>
<script type="text/javascript" src="/skins/default/js/productinfo.js"></script>


<script type="text/javascript" src="<?php echo SHOP_RESOURCE_SITE_URL; ?>/js/mz-packed.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL; ?>/js/perfect-scrollbar.min.js"></script>
<style type="text/css">

</style>


<!--产品详情-->
<div id="detail">
    <div class="container">
        <div class="row">
            <div class="detail_con clearfix">
                <div class="col-md-5">
                    <div class="pro_img">
                        <img title="Zoom in or out by scrolling the wheel of your mouse~" src="<?php echo $output["goods_image"]["0"]["2"] ?>"
                             class="cloudzoom"
                             data-cloudzoom="zoomImage: '<?php echo $output["goods_image"]["0"]["3"] ?>'" width="100%">
                    </div>
                    <div class="pro_tog clearfix flex">
                        <div class="col-xs-1 right_">
                            <div class="arrow_w" id="left_ lil">
                                <a href="javascript:;">
                                    <img id="left_" src="/skins/default/img/ld_03.png" class="absolute_center"/>
                                </a>
                            </div>
                        </div>
                        <?php foreach ($output["goods_image"] as $key => $value) { ?>
                            <div class="col-xs-2 tu_">
                                <img title="Zoom in or out by scrolling the wheel of your mouse~" class='cloudzoom-gallery'
                                     src="<?php echo $value['0'] ?>"
                                     data-cloudzoom="useZoom: '.cloudzoom', image: '<?php echo $value['1'] ?>', zoomImage: '<?php echo $value['2'] ?>' "
                                     data-src="<?php echo $value['2'] ?>">
                            </div>
                        <?php } ?>
                        <div class="col-xs-1 right_">
                            <div class="arrow_w" id="right_ lir">
                                <a href="javascript:;">
                                    <img id="right_" src="/skins/default/img/r_d_13.png" class="absolute_center"/>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="info_footer">
                            <span class="sc pro_share">
									<strong>SHARE：</strong>
                                    <a href="javascript:void(0);" onclick="linkedin_share('<?='http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ?>','<?=$output['goods']['goods_name'].'-kalamera' ?>');"></a>
                                    <a href="javascript:void(0);" onclick="twitter_share('<?='http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ?>','<?=$output['goods']['goods_name'].'-kalamera' ?>');"></a>
                                    <a href="javascript:void(0);" onclick="google_share('<?='http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ?>','<?=$output['goods']['goods_name'].'-kalamera' ?>');"></a>
                                    <a href="javascript:void(0);" onclick="fbs_share('<?='http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ?>','<?=$output['goods']['goods_name'].'-kalamera' ?>');"></a>
                            </span>
                    </div>
                </div>


                <div class="col-md-7" id="pro_info">
                    <div class="pro_tit dot-ellipsis dot-height-40">
                        <?php echo $output['goods']['goods_name']; ?>
                    </div>
                    <span class="not_money">
                        List Price: <?php echo $lang['currency'] . ncPriceFormat($output['goods']['goods_marketprice']); ?>
                    </span>
                    <div class="show_money">
                        <span class="money">
                            <?php //echo $lang['currency'] . ncPriceFormat($output['goods']['goods_price']); ?>

                         <?php if (isset($output['goods']['promotion_price']) && !empty($output['goods']['promotion_price'])) {?>
                            <?php echo $lang['currency'] . ncPriceFormat($output['goods']['promotion_price']); ?>
                             <input id="goods_price" name="goods_price" type="hidden" value="<?php echo ncPriceFormat($output['goods']['promotion_price']); ?>"/>

                         <?php } else {?>
                                <?php echo $lang['currency'] . ncPriceFormat($output['goods']['goods_price']); ?>
                             <input id="goods_price" name="goods_price" type="hidden" value="<?php echo ncPriceFormat($output['goods']['goods_price']); ?>"/>

                         <?php }?>

                        </span>
                        <div class="level margin-b-2 padding-left-5 hide" data-type="" >
                            <span class="on"></span>
                            <span class="on"></span>
                            <span class="on"></span>
                            <span class="on"></span>
                            <span></span>
                        </div>
                        <div class="level margin-b-2 padding-left-5 raty" data-score="<?php echo $output['goods']['evaluation_good_star']?>" ></div>
                        <span class="blue_theme  padding-left-5"><?php echo $output['goods']['goods_commend']?> Reviews</span>
                    </div>
                    <!--                    <span class="block red_pri ">You Save: 33%</span>-->
                    <p class="padding-top-10">
                        <?php if (is_array($output['goods']['spec_name'])) { ?>
                        <?php foreach ($output['goods']['spec_name'] as $key => $val) { ?>
                        <?php if (is_array($output['goods']['spec_value'][$key]) and !empty($output['goods']['spec_value'][$key])) { ?>
                    <li class="rule">

                        <div class="rule_name">规格</div>
                        <?php foreach ($output['goods']['spec_value'][$key] as $k => $v) { ?>
                            <?php if ($key == 1) { ?>
                                <a href="javascript:void(0);">
                                    <div class="rulecli <?php if (isset($output['goods']['goods_spec'][$k])) {
                                        echo 'cut';
                                    } ?>" data-param="{valid:<?php echo $k; ?>}" title="<?php echo $v; ?>"><img
                                                src="<?php echo $output['spec_image'][$k]; ?>"/><?php echo $v; ?></div>
                                </a>
                            <?php } else { ?>
                                <a href="<?php if (isset($output['goods']['desc_id'])) {
                                    echo urlShop('goods', 'index', array('goods_id' => $output['goods']['desc_id'][$k]));
                                } ?>">
                                    <div class="rulecli <?php if (isset($output['goods']['goods_spec'][$k])) {
                                        echo 'cut';
                                    } ?>" data-param="{valid:<?php echo $k; ?>}"><?php echo $v; ?></div>
                                </a>
                            <?php } ?>


                        <?php } ?>
                    </li>
                    <?php } ?>
                    <?php } ?>
                    <?php } ?>

                    <?php if (is_array($output['goods']['goods_repair'])) { ?>
                            <li class="rule">
                                <div class="rule_name">Warranty Extension</div>
                                <?php foreach ($output['goods']['goods_repair'] as $file){?>
                                        <a href="javascript:void(0);" class="repairs"  data-description="<?php echo $file['description']?>" data-param="<?php echo $file['percent']?>">
                                            <div>
                                                <p class="descript" ><?php echo $file['description']?>(<b class="repair_price"><?php echo $file['percent']?></b>)</p>
                                            </div>
                                        </a>
                                <?php } ?>
                            </li>
                        <input id="goods_repair_percent" name="goods_repair_percent" type="hidden" value=""/>
                        <input id="goods_repair_description" name="goods_repair_description" type="hidden" value=""/>
                    <?php } ?>





                    <!--        <strong class="font-14">Model:KRC-90BV</strong>-->
                    </p>
                    <p><strong class="font-14">Availability:Free Shipping</strong></p>
                    <p class="inventory">（<b>In stock <span nctype="goods_stock"><?php echo $output['goods']['goods_storage']; ?></span>  piece</b>）</p>

                    <div class="price_b">
                        <p class="count inline_b" style="margin-top: -7px">
                            <span class="dec fl" nctype="decrease">-</span>
                            <input type="text" value="1" id="quantity" class="num">
                            <span class="add fr" nctype="increase">+</span></p>

                        <div nctype="add_cart" data-gid="<?php echo $output['goods']['goods_id']; ?>"
                             class="add_to_cart margin-left-15">
                            Add To Cart
                        </div>

                        <div class="favor_b margin-left-15">
                            <a href="javascript:collect_goods('<?php echo $output['goods']['goods_id']; ?>','count','goods_collect');">

                                <span>Favorite</span>
                            </a>
                        </div>
                    </div>
                    <div class="talk_expert">
                        <p class="font_big_blod">Talk with an Expert :</p>
                        <ul>
                            <li>LIVE CHAT</li>
                            <li>CALL : <?php echo $output['list_setting']['site_phone']; ?></li>
                            <li><?php echo $output['list_setting']['site_email']; ?></li>
                        </ul>
                    </div>
                    <div style="font-size: 13px;line-height:20px">
                        <p class="font_big_blod padding-top-10">KEY FEATURES</p>
                        <?php echo $output['goods']["goods_quality"]; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="guarantee">
            <p class="title_">Highlights:</p>
            <?php echo $output['goods']["goods_guarantee"]; ?>
        </div>
        <ul class="detail_l">
            <li>
                <p class="t">Products Details</p>
                <div class="click dec"></div>
                <div class="de_ct pro_details">
                    <?php echo $output['goods']['goods_body']; ?>
                </div>
            </li>
            <li>
                <p class="t">Specification</p>
                <div class="click add"></div>
                <div class="de_ct">
                    <?php echo $output['goods']['goods_spec_desc']; ?>
                </div>
            </li>
            <li>
                <p class="t">Reminder</p>
                <div class="click add"></div>
                <div class="de_ct">
                    <?php echo $output['goods']['goods_tixing']; ?>
                </div>
            </li>
            <li>
                <p class="t">File download</p>
                <div class="click add"></div>
                <div class="de_ct">
                    <div class="row">
                        <!--

                        <div class="col-md-3">
                            <div class="de_four_item">
                                <div><img src="/skins/default/img/detail4_img.png" alt=""></div>
                                <div>
                                    <p class="descript">File name text test,File name text test File name text test,File
                                        name text test </p>
                                    <p class="down_load">Download</p>
                                </div>
                            </div>
                        </div>
                                -->

                        <?php foreach ($output['goods']['goods_files'] as $file):?>
                        <div class="col-md-3">
                            <div class="de_four_item">
                                <div><img src="/skins/default/img/file.png" alt=""></div>
                                <div>
                                    <p class="descript"><?php echo $file['description']?> </p>
                                    <a target="_blank" href="?model=goods&fun=down&name=<?php echo $file['name'];?>" ><p class="down_load">Download</p></a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </li>
            <li>
                <p class="t">Reviews</p>
                <div class="click add"></div>
                <div class="de_ct">
                    <div class="pdditems" id="goodseval">
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>


<div class="container detail_lick">
    <p class="second_t">People who viewed items you browsed also viewed</p>
    <div class="row index_product_list" id="view_goods">

        <?php foreach ((array) $output['goods_rand_list'] as $g) { ?>


            <div class="col-md-2">
                <div class="item">
                    <div class="ct">
                        <div class="img_show">
                            <a href="<?php echo urlShop('goods', 'index', array('goods_id' => $g['goods_id'], )); ?>" target="_blank" title="<?php echo $goods_commend['goods_jingle'];?>"><img src="<?php echo cthumb($g['goods_image'], 240); ?>"/></a>
                        </div>
                        <div class="txt">
                            <a href="" class="dot-ellipsis dot-height-60 is-truncated" style="overflow-wrap: break-word;">
                                <a href="<?php echo urlShop('goods', 'index', array('goods_id' => $g['goods_id'], )); ?>" target="_blank" title="<?php echo $g['goods_name']; ?>"><?php echo $g['goods_name']; ?><em><?php echo $g['goods_jingle'];?></em></a>                        </div>
                    </div>
                </div>
            </div>
        <?php }?>


    </div>
</div>
<!--产品详情结束-->
<!--中间内容结束-->




<form id="buynow_form" method="post" action="<?php echo SHOP_SITE_URL; ?>/index.php">
    <input id="act" name="model" type="hidden" value="buy"/>
    <input id="op" name="fun" type="hidden" value="buy_step1"/>
    <input id="cart_id" name="cart_id[]" type="hidden"/>
</form>
<script src="<?php echo SHOP_RESOURCE_SITE_URL; ?>/js/goods_cart.js"></script>

<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL; ?>/js/jquery.charCount.js"></script>
<script src="<?php echo RESOURCE_SITE_URL; ?>/js/jquery.ajaxContent.pack.js" type="text/javascript"></script>
<script src="<?php echo RESOURCE_SITE_URL; ?>/js/sns.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo RESOURCE_SITE_URL; ?>/js/jquery.F_slider.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL; ?>/js/waypoints.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL; ?>/js/jquery.raty/jquery.raty.min.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL; ?>/js/jquery.nyroModal/custom.min.js"
        charset="utf-8"></script>
<link href="<?php echo RESOURCE_SITE_URL; ?>/js/jquery.nyroModal/styles/nyroModal.css" rel="stylesheet" type="text/css"
      id="cssfile2"/>
<script type="text/javascript">
    /** 辅助浏览 **/

    //产品图片
    jQuery(function ($) {
        // 放大镜效果 产品图片
        CloudZoom.quickStart();

        // 图片切换效果
        // $(".controller li").first().addClass('current');
        // $('.controller').find('li').mouseover(function(){
        // $(this).first().addClass("current").siblings().removeClass("current");
        // });
        $(".change li a").first().addClass('current');
        $('.change').find('li').mouseover(function () {
            console.log($(this));
            $(this).children("a:first").addClass("current").siblings().children("a:first").removeClass("current");
        });
    });

    //收藏分享处下拉操作
    jQuery.divselect = function (divselectid, inputselectid) {
        var inputselect = $(inputselectid);
        $(divselectid).mouseover(function () {
            var ul = $(divselectid + " ul");
            ul.slideDown("fast");
            if (ul.css("display") == "none") {
                ul.slideDown("fast");
            }
        });
        $(divselectid).live('mouseleave', function () {
            $(divselectid + " ul").hide();
        });
    };
    //登录开关状态
    var connect_qq = "<?php echo C('qq_isuse');?>";
    var connect_sn = "<?php echo C('sina_isuse');?>";
    var connect_wx = "<?php echo C('weixin_isuse');?>";
    $(function () {
        //赠品处滚条
        $("#comment").removeClass("comment");
        $('#ncsGoodsGift').perfectScrollbar({suppressScrollX: true});
        <?php if ($output['goods']['goods_state'] == 1 && $output['goods']['goods_storage'] > 0 ) {?>
        // 加入购物车
        $('a[nctype="addcart_submit"]').click(function () {
            if (typeof(allow_buy) != 'undefined' && allow_buy === false) return;
            addcart(<?php echo $output['goods']['goods_id'];?>, checkQuantity(), 'addcart_callback');
        });
        <?php if (!($output['goods']['is_virtual'] == 1 && $output['goods']['virtual_indate'] < TIMESTAMP)) {?>
        // 立即购买
        $('a[nctype="buynow_submit"]').click(function () {
            if (typeof(allow_buy) != 'undefined' && allow_buy === false) return;
            buynow(<?php echo $output['goods']['goods_id']?>, checkQuantity());
        });
        <?php }?>
        <?php }?>
        // 到货通知
        <?php if ($output['goods']['goods_storage'] == 0 || $output['goods']['goods_state'] == 0) {?>
        $('a[nctype="arrival_notice"]').click(function () {
            <?php if ($_SESSION['is_login'] !== '1'){?>
            login_dialog();
            <?php }else{?>
            ajax_form('arrival_notice', '到货通知', '<?php echo urlShop('goods', 'arrival_notice', array('goods_id' => $output['goods']['goods_id']));?>', 350);
            <?php }?>
        });
        <?php }?>
        //浮动导航  waypoints.js
        $('#main-nav').waypoint(function (event, direction) {
            $(this).parent().parent().parent().toggleClass('sticky', direction === "down");
            event.stopPropagation();
        });

        // 分享收藏下拉操作
        $.divselect("#handle-l");
        $.divselect("#handle-r");

        // 规格选择
        $('dl[nctype="nc-spec"]').find('a').each(function () {
            $(this).click(function () {
                if ($(this).hasClass('hovered')) {
                    return false;
                }
                $(this).parents('ul:first').find('a').removeClass('hovered');
                $(this).addClass('hovered');
                checkSpec();
            });
        });
        // 规格选择
        $('.repairs').each(function () {
            var repairs_persen =  $(this).attr('data-param')/100
            var goods_price =  $('#goods_price').val()
            // console.log(repairs_persen)
            // console.log(goods_price)
            total = price_format(goods_price*repairs_persen)
            var repair_price = $(this).find(".repair_price");
            repair_price.html(total)

        });

        // 保修政策选择
        $('.repairs').click(function () {
            var repairs_description =  $(this).attr('data-description')
            var repairs_persen=  $(this).attr('data-param')
            $('#goods_repair_percent').val(repairs_persen)
            $('#goods_repair_description').val(repairs_description)
        });
    });

    function checkSpec() {
        var spec_param = <?php echo $output['spec_list'];?>;
        var spec = new Array();
        $('ul[nctyle="ul_sign"]').find('.hovered').each(function () {
            var data_str = '';
            eval('data_str =' + $(this).attr('data-param'));
            spec.push(data_str.valid);
        });
        spec1 = spec.sort(function (a, b) {
            return a - b;
        });
        var spec_sign = spec1.join('|');
        $.each(spec_param, function (i, n) {
            if (n.sign == spec_sign) {
                window.location.href = n.url;
            }
        });
    }

    // 验证购买数量
    function checkQuantity() {
        var quantity = parseInt($("#shu").html());
        if (quantity < 1) {
            alert("<?php echo $lang['goods_index_pleaseaddnum'];?>");
            $("#shu").html('1');
            return false;
        }
        // console.log(quantity);
        max = parseInt($('[nctype="goods_stock"]').text());
        <?php if ($output['goods']['is_virtual'] == 1 && $output['goods']['virtual_limit'] > 0) {?>
        max = <?php echo $output['goods']['virtual_limit'];?>;
        if (quantity > max) {
            alert('最多限购' + max + '件');
            return false;
        }
        <?php } ?>
        <?php if (!empty($output['goods']['upper_limit'])) {?>
        max = <?php echo $output['goods']['upper_limit'];?>;
        if (quantity > max) {
            alert('最多限购' + max + '件');
            return false;
        }
        <?php } ?>
        if (quantity > max) {
            alert("<?php echo $lang['goods_index_add_too_much'];?>");
            return false;
        }
        return quantity;
    }

    // 立即购买js
    function buynow(goods_id, quantity, chain_id, area_id, area_name, area_id_2) {
        <?php if ($_SESSION['is_login'] !== '1'){?>
        login_dialog();
        <?php }else{?>
        if (!quantity) {
            return;
        }

        $("#cart_id").val(goods_id + '|' + quantity);
        if (typeof chain_id == 'number') {
            $('#buynow_form').append('<input type="hidden" name="ifchain" value="1"><input type="hidden" name="chain_id" value="' + chain_id + '"><input type="hidden" name="area_id" value="' + area_id + '"><input type="hidden" name="area_name" value="' + area_name + '"><input type="hidden" name="area_id_2" value="' + area_id_2 + '">');
        }
        $("#buynow_form").submit();
        <?php }?>
    }

    $(function () {
        //选择地区查看运费
        $('#transport_pannel>a').click(function () {
            var id = $(this).attr('nctype');
            if (id == 'undefined') return false;
            var _self = this, tpl_id = '<?php echo $output['goods']['transport_id'];?>';
            var url = 'index.php?model=goods&fun=calc&rand=' + Math.random();
            $('#transport_price').css('display', 'none');
            $('#loading_price').css('display', '');
            $.getJSON(url, {'id': id, 'tid': tpl_id}, function (data) {
                if (data == null) return false;
                if (data != 'undefined') {
                    $('#nc_kd').html('运费<?php echo $lang['nc_colon'];?><em>' + data + '</em><?php echo $lang['goods_index_yuan'];?>');
                } else {
                    '<?php echo $lang['goods_index_trans_for_seller'];?>';
                }
                $('#transport_price').css('display', '');
                $('#loading_price').css('display', 'none');
                $('#ncrecive').html($(_self).html());
            });
        });
        $("#nc-bundling").load('index.php?model=goods&fun=get_bundling&goods_id=<?php echo $output['goods']['goods_id'];?>', function () {
            if ($(this).html() != '') {
                $(this).show();
            }
        });
        <?php if ($output['goods']['is_virtual'] == 1) {?>
        $("#ncStoreMap").load('index.php?model=show_map&fun=index&w=600&h=400&store_id=<?php echo $output['goods']['store_id'];?>', function () {
            if ($(this).html() != '') {
                $(this).show();
            }
        });
        <?php } ?>
        $("#salelog_demo").load('index.php?model=goods&fun=salelog&goods_id=<?php echo $output['goods']['goods_id'];?>&store_id=<?php echo $output['goods']['store_id'];?>&vr=<?php echo $output['goods']['is_virtual'];?>', function () {
            // Membership card
            $(this).find('[nctype="mcard"]').membershipCard({type: 'shop'});
        });
        $("#consulting_demo").load('index.php?model=goods&fun=consulting&goods_id=<?php echo $output['goods']['goods_id'];?>&store_id=<?php echo $output['goods']['store_id'];?>', function () {
            // Membership card
            $(this).find('[nctype="mcard"]').membershipCard({type: 'shop'});
        });
        $("#consult").load('index.php?model=goods&fun=consulting&goods_id=<?php echo $output['goods']['goods_id'];?>&store_id=<?php echo $output['goods']['store_id'];?>', function () {
            // Membership card
            // $(this).find('[nctype="mcard"]').membershipCard({type:'shop'});
        });

        /** goods.php **/
        // 商品内容部分折叠收起侧边栏控制
        $('#fold').click(function () {
            $('.ncs-goods-layout').toggleClass('expanded');
        });
        // 商品内容介绍Tab样式切换控制
        $('#categorymenu').find("li").click(function () {
            $('#categorymenu').find("li").removeClass('current');
            $(this).addClass('current');
        });
        // 商品详情默认情况下显示全部
        $('#tabGoodsIntro').click(function () {
            $('.bd').css('display', '');
            $('.hd').css('display', '');
        });
        // 点击地图隐藏其他以及其标题栏
        $('#tabStoreMap').click(function () {
            $('.bd').css('display', 'none');
            $('#ncStoreMap').css('display', '');
            $('.hd').css('display', 'none');
        });
        // 点击评价隐藏其他以及其标题栏
        $('#tabGoodsRate').click(function () {
            $('.bd').css('display', 'none');
            $('#ncGoodsRate').css('display', '');
            $('.hd').css('display', 'none');
        });
        // 点击成交隐藏其他以及其标题
        $('#tabGoodsTraded').click(function () {
            $('.bd').css('display', 'none');
            $('#ncGoodsTraded').css('display', '');
            $('.hd').css('display', 'none');
        });
        // 点击咨询隐藏其他以及其标题
        $('#tabGuestbook').click(function () {
            $('.bd').css('display', 'none');
            $('#ncGuestbook').css('display', '');
            $('.hd').css('display', 'none');
        });
        //商品排行Tab切换
        $(".ncs-top-tab > li > a").mouseover(function (e) {
            if (e.target == this) {
                var tabs = $(this).parent().parent().children("li");
                var panels = $(this).parent().parent().parent().children(".ncs-top-panel");
                var index = $.inArray(this, $(this).parent().parent().find("a"));
                if (panels.eq(index)[0]) {
                    tabs.removeClass("current ").eq(index).addClass("current ");
                    panels.addClass("hide").eq(index).removeClass("hide");
                }
            }
        });
        //信用评价动态评分打分人次Tab切换
        $(".ncs-rate-tab > li > a").mouseover(function (e) {
            if (e.target == this) {
                var tabs = $(this).parent().parent().children("li");
                var panels = $(this).parent().parent().parent().children(".ncs-rate-panel");
                var index = $.inArray(this, $(this).parent().parent().find("a"));
                if (panels.eq(index)[0]) {
                    tabs.removeClass("current ").eq(index).addClass("current ");
                    panels.addClass("hide").eq(index).removeClass("hide");
                }
            }
        });

//触及显示缩略图
        $('.goods-pic > .thumb').hover(
            function () {
                $(this).next().css('display', 'block');
            },
            function () {
                $(this).next().css('display', 'none');
            }
        );

        /* 商品购买数量增减js */
        // 增加
        $('span[nctype="increase"]').click(function () {
            num = parseInt($('#quantity').val());
            <?php if ($output['goods']['is_virtual'] == 1 && $output['goods']['virtual_limit'] > 0) {?>
            max = <?php echo $output['goods']['virtual_limit'];?>;
            if (num >= max) {
                alert('最多限购' + max + '件');
                return false;
            }
            <?php } ?>
            <?php if (!empty($output['goods']['upper_limit'])) {?>
            max = <?php echo $output['goods']['upper_limit'];?>;
            if (num >= max) {
                alert('最多限购' + max + '件');
                return false;
            }
            <?php } ?>
            max = parseInt($('[nctype="goods_stock"]').text());
            if (num < max) {
                $('#quantity').val(num + 1);
            }
        });
        //减少
        $('span[nctype="decrease"]').click(function () {
            num = parseInt($('#quantity').val());
            if (num > 1) {
                $('#quantity').val(num - 1);
            }
        });

        //评价列表
        // $('#comment_tab').on('click', 'li', function() {
        //     $('#comment_tab li').removeClass('current');
        //     $(this).addClass('current');
        //     load_goodseval($(this).attr('data-type'));
        // });
        $("#comment_tab li").on("click", function () {
            $("#comment_tab li").find("a").removeClass("comment_current");
            $(this).find("a").addClass("comment_current");

            var index = $(this).index();

            $("#comment_info>ul>li").hide();
            $("#comment_info>ul>li").eq(index).show();
            load_goodseval($(this).attr('data-type'));
        })
        load_goodseval('all');

        function load_goodseval(type) {
            var url = '<?php echo urlShop('goods', 'comments', array('goods_id' => $output['goods']['goods_id']));?>';
            url += '&type=' + type;
            $("#goodseval").load(url, function () {
                $(this).find('[nctype="mcard"]').membershipCard({type: 'shop'});
            });
        }

        //记录浏览历史
        $.get("index.php?model=goods&fun=addbrowse", {gid:<?php echo $output['goods']['goods_id'];?>});
        //初始化对比按钮
        //###initCompare();

        $('[nctype="show_chain"]').click(function () {
            _goods_id = $(this).attr('data-goodsid');
            ajax_form('show_chain', '查看门店', 'index.php?model=goods&fun=show_chain&goods_id=' + _goods_id, 640);
        });

        <?php if ($output['goods']['jjg_explain']) { ?>
        $('.couRuleScrollbar').perfectScrollbar({suppressScrollX: true});
        <?php }?>

        // 满即送、加价购显示隐藏
        $('[nctype="show-rule"]').click(function () {
            $(this).parent().find('[nctype="rule-content"]').show();
        });
        $('[nctype="hide-rule"]').click(function () {
            $(this).parents('[nctype="rule-content"]:first').hide()
        });

        $('.ncs-buy').bind({
            mouseover: function () {
                $(".ncs-point").show();
            },
            mouseout: function () {
                $(".ncs-point").hide();
            }
        });

    });

    /* 加入购物车后的效果函数 */
    function addcart_callback(data) {
        $('#bold_num').html(data.num);
        $('#bold_mly').html(price_format(data.amount));
        $('#alert').fadeIn('fast');
    }

    <?php if($output['goods']['goods_state'] == 1 && $output['goods']['goods_verify'] == 1 && $output['goods']['is_virtual'] == 0 && $output['goods']['goods_storage'] > 0){ ?>
    var $cur_area_list, $cur_tab, next_tab_id = 0, cur_select_area = [], calc_area_id = '', calced_area = [],
        cur_select_area_ids = [];
    $(document).ready(function () {
        $("#ncs-freight-selector").hover(function () {
            //如果店铺没有设置默认显示区域，马上异步请求
            <?php if (!$output['store_info']['deliver_region']) { ?>
            if (typeof nc_a === "undefined") {
                $.getJSON(SITEURL + "/index.php?model=index&fun=json_area&callback=?", function (data) {
                    nc_a = data;
                    $cur_tab = $('#ncs-stock').find('li[data-index="0"]');
                    // _loadArea(0);
                });
            }
            <?php } ?>
            $(this).addClass("hover");
            $(this).on('mouseleave', function () {
                $(this).removeClass("hover");
            });
        });

        $('ul[class="area-list"]').on('click', 'a', function () {
            $('#ncs-freight-selector').unbind('mouseleave');
            var tab_id = parseInt($(this).parents('div[data-widget="tab-content"]:first').attr('data-area'));
            if (tab_id == 0) {
                cur_select_area = [];
                cur_select_area_ids = []
            }
            ;
            if (tab_id == 1 && cur_select_area.length > 1) {
                cur_select_area.pop();
                cur_select_area_ids.pop();
                if (cur_select_area.length > 1) {
                    cur_select_area.pop();
                    cur_select_area_ids.pop();
                }
            }
            next_tab_id = tab_id + 1;
            var area_id = $(this).attr('data-value');
            $cur_tab = $('#ncs-stock').find('li[data-index="' + tab_id + '"]');
            $cur_tab.find('em').html($(this).html());
            $cur_tab.find('i').html(' ∨');
            if (tab_id < 2) {
                calc_area_id = area_id;
                cur_select_area.push($(this).html());
                cur_select_area_ids.push(area_id);
                $cur_tab.find('a').removeClass('hover');
                $cur_tab.nextAll().remove();
                if (typeof nc_a === "undefined") {
                    $.getJSON(SITEURL + "/index.php?model=index&fun=json_area&callback=?", function (data) {
                        nc_a = data;
                        // _loadArea(area_id);
                    });
                } else {
                    // _loadArea(area_id);
                }
            } else {
                //点击第三级，不需要显示子分类
                if (cur_select_area.length == 3) {
                    cur_select_area.pop();
                    cur_select_area_ids.pop();
                }
                cur_select_area.push($(this).html());
                cur_select_area_ids.push(area_id);
                $('#ncs-freight-selector > div[class="text"] > div').html(cur_select_area.join(''));
                $('#ncs-freight-selector').removeClass("hover");
                _calc();
            }
            $('#ncs-stock').find('li[data-widget="tab-item"]').on('click', 'a', function () {
                var tab_id = parseInt($(this).parent().attr('data-index'));
                if (tab_id < 2) {
                    $(this).parent().nextAll().remove();
                    $(this).addClass('hover');
                    $('#ncs-stock').find('div[data-widget="tab-content"]').each(function () {
                        if ($(this).attr("data-area") == tab_id) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                }
            });
        });

        function _loadArea(area_id) {
            if (nc_a[area_id] && nc_a[area_id].length > 0) {
                $('#ncs-stock').find('div[data-widget="tab-content"]').each(function () {
                    if ($(this).attr("data-area") == next_tab_id) {
                        $(this).show();
                        $cur_area_list = $(this).find('ul');
                        $cur_area_list.html('');
                    } else {
                        $(this).hide();
                    }
                });
                var areas = [];
                areas = nc_a[area_id];
                for (i = 0; i < areas.length; i++) {
                    if (areas[i][1].length > 8) {
                        $cur_area_list.append("<li class='longer-area'><a data-value='" + areas[i][0] + "' href='#none'>" + areas[i][1] + "</a></li>");
                    } else {
                        $cur_area_list.append("<li><a data-value='" + areas[i][0] + "' href='#none'>" + areas[i][1] + "</a></li>");
                    }
                }
                if (area_id > 0) {
                    $cur_tab.after('<li data-index="' + (next_tab_id) + '" data-widget="tab-item"><a class="hover" href="#none" ><em>请选择</em><i> ∨</i></a></li>');
                }
            } else {
                //点击第一二级时，已经到了最后一级
                $cur_tab.find('a').addClass('hover');
                $('#ncs-freight-selector > div[class="text"] > div').html(cur_select_area);
                $('#ncs-freight-selector').removeClass("hover");
                _calc();
            }
        }

        //计算运费，是否配送
        function _calc() {
            $.cookie('dregion', cur_select_area_ids.join(' ') + '|' + cur_select_area.join(' '), {expires: 30});
            <?php if (!$output['goods']['transport_id']) { ?>
            return;
            <?php } ?>
            var _args = "&tid=<?php echo $output['goods']['transport_id']?>&area_id=" + calc_area_id;
            if (typeof calced_area[calc_area_id] == 'undefined') {
                //需要请求配送区域设置
                $.getJSON(SITEURL + "/index.php?model=goods&fun=calc&" + _args + "&myf=<?php echo $output['store_info']['store_free_price']?>&callback=?", function (data) {
                    allow_buy = data.total ? true : false;
                    calced_area[calc_area_id] = data.total;
                    if (data.total === false) {
                        $('#ncs-freight-prompt > strong').html('无货').next().remove();
                        $('a[nctype="buynow_submit"]').addClass('no-buynow');
                        $('a[nctype="addcart_submit"]').addClass('no-buynow');
                    } else {
                        $('#ncs-freight-prompt > strong').html('有货 ').next().remove();
                        $('#ncs-freight-prompt > strong').after('<span>' + data.total + '</span>');
                        $('a[nctype="buynow_submit"]').removeClass('no-buynow');
                        $('a[nctype="addcart_submit"]').removeClass('no-buynow');
                    }
                });
            } else {
                if (calced_area[calc_area_id] === false) {
                    $('#ncs-freight-prompt > strong').html('无货').next().remove();
                    $('a[nctype="buynow_submit"]').addClass('no-buynow');
                    $('a[nctype="addcart_submit"]').addClass('no-buynow');
                } else {
                    $('#ncs-freight-prompt > strong').html('有货 ').next().remove();
                    $('#ncs-freight-prompt > strong').after('<span>' + calced_area[calc_area_id] + '</span>');
                    $('a[nctype="buynow_submit"]').removeClass('no-buynow');
                    $('a[nctype="addcart_submit"]').removeClass('no-buynow');
                }
            }
        }

        //如果店铺设置默认显示配送区域
        <?php if ($output['store_info']['deliver_region']) { ?>
        if (typeof nc_a === "undefined") {
            $.getJSON(SITEURL + "/index.php?model=index&fun=json_area&callback=?", function (data) {
                nc_a = data;
                $cur_tab = $('#ncs-stock').find('li[data-index="0"]');
                // _loadArea(0);
                $('ul[class="area-list"]').find('a[data-value="<?php echo $output['store_info']['deliver_region_ids'][0]?>"]').click();
                <?php if ($output['store_info']['deliver_region_ids'][1]) { ?>
                $('ul[class="area-list"]').find('a[data-value="<?php echo $output['store_info']['deliver_region_ids'][1]?>"]').click();
                <?php } ?>
                <?php if ($output['store_info']['deliver_region_ids'][2]) { ?>
                $('ul[class="area-list"]').find('a[data-value="<?php echo $output['store_info']['deliver_region_ids'][2]?>"]').click();
                <?php } ?>
            });
        }
        <?php } ?>
    });
    <?php }?>

    $('.raty').raty({
        score: function() {
            return $(this).attr('data-score');
        },
        readOnly: true,
        path: "<?php echo RESOURCE_SITE_URL;?>/js/jquery.raty/img",
    });
</script> 
