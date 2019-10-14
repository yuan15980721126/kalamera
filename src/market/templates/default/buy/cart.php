<?php defined('interMarket') or exit('Access Invalid!'); ?>


<!--中间内容-->
<div class="grey_container">
    <div class="container">
        <div class="row">
            <?php if ($output['store_cart_list']){ ?>
            <form action="<?php echo urlShop('buy', 'buy_step1'); ?>" method="POST" id="form_buy" name="form_buy">
                <input type="hidden" value="1" name="ifcart">
                <input type="hidden" value="" name="ifchain" id="ifchain">
                <div class="col-md-12">
                    <div class="inner_ct">
                        <p class="title">Shopping Cart ( <b id="goods_count"></b> items )
                        </p>
                        <div class="shoplist clearfix" nc_type="table_cart">
                            <?php foreach ($output['store_cart_list'] as $g) { ?>
                                <div id="goods_<?php echo $g['cart_id']; ?>" class="item"
                                     data-value="<?php echo $g['cart_id']; ?>">


<!--                                    <p class="imgb">-->
<!--                                        <input class="cart_check" type="checkbox"  data-value="-->
<!--                                    --><?php //echo $g['cart_id']; ?><!--" checked nc_type="eachGoodsCheckBox" value="-->
<!--                                    --><?php //echo $g['cart_id'].'|'.$g['goods_num'];?><!--" data_store_id="-->
<!--                                    --><?php //echo $g['store_id'];?><!--" id="cart_id-->
<!--                                    --><?php //echo $g['cart_id'];?><!--" name="cart_id[]"/>-->
<!--                                    </p>-->
                                    <input class="cart_check" type="hidden"  data-value="
                                    <?php echo $g['cart_id']; ?>" checked nc_type="eachGoodsCheckBox" value="
                                    <?php echo $g['cart_id'].'|'.$g['goods_num'];?>" data_store_id="
                                    <?php echo $g['store_id'];?>" id="cart_id
                                    <?php echo $g['cart_id'];?>" name="cart_id[]"/>

                                    <div class="imgb">
                                        <a href="<?php echo urlShop('goods', 'index', array('goods_id' => $g['goods_id'])); ?>"
                                           target="_blank">
                                            <img src="<?php echo cthumb($g['goods_image'], 60, $store_id); ?>"/>
                                        </a>
                                    </div>
                                    <p class="txt">
                                        <a href="<?php echo urlShop('goods', 'index', array('goods_id' => $g['goods_id'])); ?>"
                                           target="_blank" class="dot-ellipsis dot-height-40">
                                            <?php echo $g['goods_name']; ?>
                                        </a><br>
                                    </p>
                                    <p class="txt">
                                        <a href="" >
                                            Warranty Service
                                        </a><br>
                                            <input type="hidden" value="<?php echo $g['goods_repair']['repair_price']; ?>" class="repair_price">
                                            <input type="hidden" id="item<?php echo $g['cart_id']; ?>_goods_id" value="<?php echo $g['goods_id']; ?>" >

                                        <?php echo $g['goods_repair']['description']; ?>
                                        （$ <b id="item<?php echo $g['cart_id']; ?>_repair_price" class="repair"><?php echo $g['goods_repair']['repair_price']; ?></b>
                                        ）
                                    </p>
                                    <div class="price_box">
                                        <p class="padding-left-7_5">
                                            <span class="lb">Price:</span>
                                            $<?php echo $g['goods_price']; ?>
                                        </p>
                                        <p class="count">
                                            <span class="dec fl"
                                                  onclick="decrease_quantity(<?php echo $g['cart_id']; ?>)">-</span>
                                            <input class="num" type="text" value="<?php echo $g['goods_num']; ?>"
                                                   id="input_item_<?php echo $g['cart_id']; ?>"
                                                   changed="<?php echo $g['goods_num']; ?>"
                                                   onkeyup="change_quantity(<?php echo $g['cart_id']; ?>, this);"/>

                                            <span class="add fr"
                                                  onclick="add_quantity(<?php echo $g['cart_id']; ?>);">+</span>
                                        </p>
                                        <p class="padding-left-7_5">
                                            <span class="lb">Total:</span>
                                            <b>$</b><b id="item<?php echo $g['cart_id']; ?>_subtotal"
                                                       class="subtotal"><?php echo $g['goods_total']; ?></b>

                                            <!--                                    <span class="total_p">$-->
                                            <?php //echo $g['goods_total']; ?><!--</span>-->
                                        </p>
                                    </div>
                                    <a href="javascript:void(0)" class="remove"
                                       onclick="drop_cart_item(<?php echo $g['cart_id']; ?>)"
                                       rel="<?php echo $g['cart_id']; ?>">Remove</a>
                                </div>
                            <?php } ?>

                        </div>
                        <div class="grand_total">
                            <div class="grand_label">Grand Total:</div>
                            <div class="price" id="orderTotal">

                            </div>
                        </div>
                        <div class="pays_way">
                            <a id="next_submit" href="javascript:void(0)">Secure Checkout</a>
                            <!--                        <a href=""></a>-->
                            <!--                        <a href=""></a>-->
                        </div>
                        <div class="ahead">
                            <input id="drop_all" type="button" value="Empty" class="fr empty">
                            <a href="<?php echo BASE_SITE_URL; ?>" class="go_ahead">Continue shopping</a>
                        </div>
                    </div>
                </div>
                <!--            <div class="col-md-3">-->
                <!--                <div class="inner_ct">-->
                <!--                    <p class="title">Settlement</p>-->
                <!--                    <form action="">-->
                <!--                        <div class="apply_item">-->
                <!--                            Get Shipping Prices:-->
                <!--                            <input type="text" placeholder="Zip code">-->
                <!--                            <input type="button" value="Apply">-->
                <!--                        </div>-->
                <!--                    </form>-->
                <!--                    <form action="">-->
                <!--                        <div class="apply_item">-->
                <!--                            Do you have a Coupon Code?-->
                <!--                            <input type="text" placeholder="Example code5">-->
                <!--                            <input type="button" value="Apply">-->
                <!--                        </div>-->
                <!--                    </form>-->
                <!--                    <table class="subTable">-->
                <!--                        <tbody>-->
                <!--                        <tr>-->
                <!--                            <td>Subtotal :</td>-->
                <!--                            <td><span class="price">$2,417.00</span></td>-->
                <!--                        </tr>-->
                <!--                        <tr>-->
                <!--                            <td>Discount :</td>-->
                <!--                            <td>--</td>-->
                <!--                        </tr>-->
                <!--                        <tr>-->
                <!--                            <td>Shipping :</td>-->
                <!--                            <td>FREE</td>-->
                <!--                        </tr>-->
                <!--                        <tr>-->
                <!--                            <td>Estimated Tax :</td>-->
                <!--                            <td>--</td>-->
                <!--                        </tr>-->
                <!--                        </tbody>-->
                <!--                    </table>-->

                <!--                    <div class="grand_total">-->
                <!--                        <div class="grand_label">Grand Total:</div>-->
                <!--                        <div class="price"  id="orderTotal">-->
                <!---->
                <!--                        </div>-->
                <!--                    </div>-->
                <!--                    <div class="pays_way">-->
                <!--                        <a id="next_submit" href="javascript:void(0)">Secure Checkout</a>-->
                <!--                        <a href=""></a>-->
                <!--                        <a href=""></a>-->
                <!--                    </div>-->
                <!--                </div>-->
            </form>
        </div>

        <?php } else { ?>
            <div class="inner_ct">
                <p class="title">Shopping Cart ( 0 items )</p>
                <div class="text-center">
                    <img style="margin-top: 100px;" src="/skins/default/img/shop_zero.png" alt="">
                    <p class="empty_tip">Your shopping cart is currently empty.</p>
                    <p>Have questions? We're here to help. Call us <?php echo $output['list_setting']['site_phone']; ?>
                        or <a href="" class="blue_theme">Live Chat</a>.</p>
                    <a href="<?php echo BASE_SITE_URL; ?>" class="go_shop hover_white">go shopping</a>
                </div>
            </div>
            <!-- 空车E -->
        <?php } ?>
    </div>
</div>
</div>
<!--中间内容结束-->


<script type="text/javascript">
    $(function () {
        $('a[nc_type="chain"]').on('click', function () {
            var chains = [], store_id = $(this).attr('data_store_id');
            $('input[name="cart_id[]"]').each(function () {
                if ($(this).attr('data_store_id') != store_id) {
                    $(this).attr('checked', false);
                } else {
                    if ($(this).prop('checked') && $(this).attr('data_chain') == '1') {
                        chains.push($(this).val());
                    } else {
                        $(this).attr('checked', false);
                    }
                }
            });
            if (chains.length > 0) {
                $('#ifchain').val('1');
                $('#form_buy').submit();
            } else {
                alert('请先选择支持门店自提的商品');
                $('#ifchain').val('');
            }
        });
        //猜你喜欢
        $('#guesslike_div').load('<?php echo urlShop('search', 'get_guesslike', array()); ?>', function () {
            $(this).show();
        });
        // 领取代金券
        $('div[nctype="get_voucher"]').on('click', 'a[data-tid]', function () {
            var _tid = $(this).attr('data-tid');
            ajaxget('index.php?model=voucher&fun=getvouchersave&jump=0&tid=' + _tid);
        });
        //
        $('#jjg-choose-container-inner').perfectScrollbar({suppressScrollX: true});
    });

    // 加价购
    window.jjgCallback = (function (jjgDetails) {



        // 各个活动的头部
        var headers = {};

        // 各个活动的头部
        var footers = {};

        // 页面上被删掉的活动
        var missings = {};

        // 最后一次操作各个活动的已选商品总金额
        var costs = {};

        // 最后一次操作各个活动的限换购数
        var maxes = {};

        // 获取指定活动当前已选商品总金额 并缓存结果
        var jjgCost = function (id) {
            if (missings[id]) {
                costs[id] = 0;
                return 0;
            }

            var $items = $(":checkbox[data-jjg=" + id + "]");
            if ($items.length < 1) {
                missings[id] = true;
                costs[id] = 0;
                return 0;
            }

            var c = 0;
            $items.filter(':checked').parents('tr.shop-list').find("em[nc_type='eachGoodsTotal']").each(function () {
                c += parseFloat(this.innerHTML) || 0;
            });
            costs[id] = c;
            return c;
        };

        // 活动头部TPL
        var jjgHeaderTpl = $('#jjg-header-wrapper').html();
        var jjgFooterTpl = $('#jjg-footer-wrapper').html();

        // 根据金额设置指定活动的头部
        var jjgHeader = function (id, selectedCost) {
            if (missings[id] && headers[id]) {
                headers[id].remove();
                footers[id].remove();
                return;
            }

            var found = false;
            var r = {
                id: id,
                storeId: jjgDetails.cou[id].info.store_id,
                mincost: jjgDetails.cou[id].firstLevel.mincost,
                plus: jjgDetails.cou[id].firstLevel.plus
            };
            r.m0 = r.mincost;
            r.p0 = r.plus;

            if (selectedCost >= r.mincost) {
                found = true;
                $.each(jjgDetails.cou[id].levels || {}, function (k, v) {
                    if (selectedCost < v.mincost) {
                        return false;
                    }
                    r.mincost = v.mincost;
                    r.plus = v.plus;
                });
            }

            if (headers[id]) {
                headers[id].find('[data-jjg-header-mincost]').html(r.mincost);
                headers[id].find('[data-jjg-header-plus]').html(r.plus);
            } else {
                var s = jjgHeaderTpl.replace(/%(\w+)%/g, function (m, $1) {
                    return r[$1];
                });
                var $tr = $(s);
                var $tr2 = $(jjgFooterTpl);
                $(":checkbox[data-jjg='" + id + "']:first").parents('tr.shop-list').before($tr);
                $(":checkbox[data-jjg='" + id + "']:last").parents('tr.shop-list').after($tr2);

                headers[id] = $tr;
                footers[id] = $tr2;
            }

            headers[id].removeClass('jjg-xor-outer-' + !found).addClass('jjg-xor-outer-' + found);

            return found;
        };

        // 设置指定活动的头部
        var jjgSet = function (id) {
            hideChoices();

            // 已选活动商品变化则需要重新换购
            var selectedCouSkus = {};
            $("[data-chosen-item='" + id + "']").each(function () {
                var sku = $(this).attr('data-chosen-item-sku');
                selectedCouSkus[sku] = true;
            });

            $("[data-chosen-item='" + id + "']").remove();

            var c = jjgCost(id);
            var found = jjgHeader(id, c);

            // 重新换购已换购商品
            if (found) {
                var lastLevelFound = 0;
                // 遍历寻找当前已选活动商品金额可以选择的换购
                $.each(jjgDetails.cou[id].levels, function (k, v) {
                    // 不满足条件则跳出循环
                    if (v.mincost > costs[id]) {
                        return false;
                    }

                    // 更新当前活动规则的最大换购数
                    maxes[id] = v.maxcou;
                    lastLevelFound = k;
                });

                if (!lastLevelFound) {
                    return;
                }

                // 可选换购商品
                var availableCouSkus = jjgDetails.cou[id].levelSkus[lastLevelFound] || {};
                // 最大限制换购数
                var m = maxes[id] || 0;

                // 遍历已换购商品
                $.each(selectedCouSkus, function (kk, vv) {
                    if (!availableCouSkus[kk]) {
                        return;
                    }
                    if (m > 0 && $("[data-chosen-item='" + id + "']").length >= m) {
                        return false;
                    }

                    // 重新换购已换购商品
                    choiceRealTriggered(id, lastLevelFound, kk, true);
                });
            }
        }

        // 当前激活换购选择的活动ID 0为未激活任何活动换购选择
        var jjgCurrentId = 0;

        // 隐藏共用的换购选择框
        var hideChoices = function () {
            jjgCurrentId = 0;
            $('#jjg-choose-container').css({
                top: -1000,
                left: -1000
            });
        };

        // 绑定换购选择框关闭按钮事件
        $('#jjg-choose-container-close').click(hideChoices);

        // 换购条目TPL
        var itemTpl = $('#jjg-choose-item-wrapper').html();

        // 绑定未来各个活动头部中的“换购商品”按钮的点击事件
        $('[data-jjg-toggle]').live('click', function () {
            var id = $(this).attr('data-jjg-toggle');

            // 如果当前活动已激活选择换购 则隐藏换购选择框
            if (id == jjgCurrentId) {
                hideChoices();
                return;
            }

            // 设置当前激活选择的活动
            jjgCurrentId = id;

            // 设置选择框位置
            var o = $(this).offset();
            o.top += $(this).height();
            $('#jjg-choose-container').css({
                top: o.top + 3,
                left: o.left
            });

            // 清空选择框
            var $table = $('#jjg-choose-container tbody').empty();

            var lastLevelFound = 0;
            // 遍历寻找当前已选活动商品金额可以选择的换购
            $.each(jjgDetails.cou[id].levels, function (k, v) {
                // 不满足条件则跳出循环
                if (v.mincost > costs[id]) {
                    return false;
                }

                // 更新当前活动规则的最大换购数
                maxes[id] = v.maxcou;
                lastLevelFound = k;
            });

            // 遍历插入规则中的可选换购商品
            $.each(jjgDetails.cou[id].levelSkus[lastLevelFound] || {}, function (kk, vv) {
                var r = $.extend({
                    jjg_id: id,
                    jjg_level: lastLevelFound,
                    jjg_price: vv.price
                }, jjgDetails.items[kk]);

                var s = itemTpl.replace(/%(\w+)%/g, function (m, $1) {
                    return r[$1];
                });

                var $s = $(s);
                $s.find('img').each(function () {
                    this.src = $(this).attr('data-src');
                });

                $table.append($s);
            });

            // 设置已选换购商品为选中 并且触发选中事件
            $("[data-chosen-item='" + id + "']").each(function () {
                var sku = $(this).attr('data-chosen-item-sku');
                $table.find("[data-jjg-leveled-sku='" + sku + "']").each(function () {
                    // 如果当前换购不可选 则跳出循环 正常不会有这种情况出现
                    if (this.disabled) {
                        return false;
                    }
                    this.checked = true;
                    choiceTriggered(this);
                });
            });
        });

        // 已选择换购条目TPL
        var chosenItemTpl = $('#jjg-chosen-item-wrapper').html();

        // 换购条目复选框被点击需要触发的操作
        var choiceTriggered = function (element) {
            var id = $(element).attr('data-jjg-leveled');
            var level = $(element).attr('data-jjg-leveled-level');
            var sku = $(element).attr('data-jjg-leveled-sku');
            var elementChecked = element.checked;
            choiceRealTriggered(id, level, sku, elementChecked);
        };

        var choiceRealTriggered = function (id, level, sku, elementChecked) {
            var m = maxes[id];

            if (m > 0) {
                var $leveled = $(":checkbox[data-jjg-leveled='" + id + "']");
                if ($leveled.filter(':checked').length >= m) {
                    $leveled.not(':checked').attr('disabled', true);
                } else {
                    $leveled.removeAttr('disabled');
                }
            }

            $("[data-chosen-item='" + id + "'][data-chosen-item-sku='" + sku + "']").remove();
            if (elementChecked) {
                var r = $.extend({
                    jjg_id: id,
                    jjg_level: level,
                    jjg_price: jjgDetails.cou[id].levelSkus[level][sku].price
                }, jjgDetails.items[sku]);
                var s = chosenItemTpl.replace(/%(\w+)%/g, function (mat, $1) {
                    return r[$1];
                });

                var $s = $(s);
                $s.find('img').each(function () {
                    this.src = $(this).attr('data-src');
                });

                footers[id].before($s);
            }

            // 执行外部函数 重新计算总价
            if (window.jjgRecalculator) {
                window.jjgRecalculator();
            }
        };

        // 绑定未来换购复选框点击事件
        $(':checkbox[data-jjg-leveled]').live('click', function () {
            choiceTriggered(this);
        });

        // 导出函数 外部使用
        return function (jjgId) {
            if (jjgId < 0) {
                return;
            }

            if (jjgId > 0) {
                jjgSet(jjgId);
                return;
            }

            $.each(jjgDetails.cou || {}, function (k, v) {
                jjgSet(k);
            });
        };

    })(<?php echo json_encode((array)$output['jjgDetails']); ?>);

</script> 
