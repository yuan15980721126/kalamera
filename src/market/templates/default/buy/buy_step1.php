<?php defined('interMarket') or exit('Access Invalid!'); ?>

<script type="text/javascript">
    //是否允许表单提交
    var SUBMIT_FORM = true;
    //记录无货的店铺ID数组
    var no_send_tpl_ids = [];
    //当前可用的红包
    var rpt_list_json = $.parseJSON('<?php echo $output['rpt_list_json'];?>');
    //记录选中的门店自提ID，查询库存需要
    var chain_id = '';
    var chain_store_id = '<?php echo $output['chain_store_id'];?>';
    //哪 些商品ID不可以门店自提
    var no_chain_goods_ids = [];

    //如果商品详细页选择了门店后，保存选择的信息
    <?php if ($_POST['chain_id'] && $_POST['area_id'] && $_POST['area_name']) {?>
    var ref_chain_id = "<?php echo $_POST['chain_id']?>";
    var ref_area_id = "<?php echo $_POST['area_id']?>";
    var ref_area_name = "<?php echo $_POST['area_name']?>";
    var ref_area_id_2 = "<?php echo $_POST['area_id_2']?>";
    <?php } ?>

    function iniRpt(order_total) {
        var _tmp, _hide_flag = true;
        $('#rpt').empty();
        $('#rpt').append('<option value="|0.00">-选择使用平台红包-</option>');
        for (i = 0; i < rpt_list_json.length; i++) {
            _tmp = parseFloat(rpt_list_json[i]['rpacket_limit']);
            order_total = parseFloat(order_total);
            if (order_total > 0 && order_total >= _tmp.toFixed(2)) {
                $('#rpt').append("<option value='" + rpt_list_json[i]['rpacket_t_id'] + '|' + rpt_list_json[i]['rpacket_price'] + "'>" + rpt_list_json[i]['desc'] + "</option>")
                _hide_flag = false;
            }
        }
        if (_hide_flag) {
            $('#rpt_panel').hide();
        } else {
            $('#rpt_panel').show();
        }
    }

    $(function () {
        <?php if ($output['address_info']['chain_id']) { ?>
        showProductChain(<?php echo $output['address_info']['city_id'] ? $output['address_info']['city_id'] : $output['address_info']['area_id']?>);
        <?php } ?>
        $('select[nctype="voucher"]').on('change', function () {
            var type = $("select[nctype='voucher'] option:selected").data('type');
            $('#voucher_fav_type').val(type);
            if ($(this).val() == '') {
                $('#eachStoreVoucher_' + items[1]).html('-0.00');
            } else {
                var items = $(this).val().split('|');
                // console.log(type)
                if (type == 1) {
                    //立减金额
                    var vouvher_price = '-' + number_format(items[2], 2);
                } else if (type == 2) {
                    //折扣换算
                    var vouvher_price = (items[2] / 100);
                    // var vouvher_price =  '*' + number_format();
                } else {
                    var vouvher_price = '-' + number_format(items[2], 2);
                }
                // console.log(vouvher_price)
                $('#eachStoreVoucher_' + items[1]).html(vouvher_price);
                // $('#eachStoreVoucher_' + items[1]).html('-' + number_format(items[2], 2));

            }
            calcOrder();
        });

        $('#rpt').on('change', function () {
            if (typeof allTotal == 'undefined') {
                alert('The system is busy. Please try again later');
                return false
            }
            if ($(this).val() == '') {
                $('#orderRpt').html('-0.00');
                $('#orderTotal').html(allTotal.toFixed(2));
            } else {
                var items = $(this).val().split('|');
                $('#orderRpt').html('-' + number_format(items[1], 2));
                var paytotal = allTotal - parseFloat(items[1]);
                if (paytotal < 0) paytotal = 0;
                $('#orderTotal').html(paytotal.toFixed(2));
            }
        });

        if (rpt_list_json.length == 0) {
            $('#rpt_panel').remove();
        }
    });

    function disableOtherEdit(showText) {
        $('a[nc_type="buy_edit"]').each(function () {
            if ($(this).css('display') != 'none') {
                $(this).after('<font color="#B0B0B0">' + showText + '</font>');
                $(this).hide();
            }
        });
        disableSubmitOrder();
    }

    function ableOtherEdit() {
        $('a[nc_type="buy_edit"]').show().next('font').remove();
        ableSubmitOrder();

    }

    function ableSubmitOrder() {
        $('#submitOrder').on('click', function () {
            submitNext()
        }).addClass('ok');
    }

    function disableSubmitOrder() {
        $('#submitOrder').unbind('click').removeClass('ok');
    }

    function submitNext() {
        var payment_code = $('input[name="payment_code"]:checked').val();
        if (!SUBMIT_FORM) return;

        if ($('input[name="cart_id[]"]').size() == 0) {
            showDialog('The goods purchased are invalid', 'error', '', '', '', '', '', '', '', '', 2);
            return;
        }
        if ($('#address_id').val() == '') {
            showDialog('Please set up the receiving address first', 'error', '', '', '', '', '', '', '', '', 2);
            return;
        }
        SUBMIT_FORM = false;
        $('#order_form').submit();
    }

</script>


<!--中间内容-->
<div class="clearfix login_grey_bg">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-margin">
                    <form method="post" class=" form_control" id="order_form" name="order_form"
                          action="index.php?model=buy&fun=buy_step2">

                        <div class="login_title first-hr">
                            Shipping Address
                        </div>
                        <div class="progress_box">
                            <span class="progress_"><span style="width: 50%;"></span></span>
                            <div class="fl blue_theme">Cart</div>
                            <div class="shipping_addr">Shipping Address</div>
                            <div class="fr">Payment</div>
                        </div>
                        <div class="addr_wrap">
                            <div class=" pan-wrap row" id="orders">
                                <div class="black_wrap col-md-4 pan_address">
                                    <div class="lc-title"> BILLING ADDRESS</div>
                                    <div class="addr_list">
                                        <div class="show_addr">
                                            <?php if (!empty($output['address_info']) && is_array($output['address_info'])) { ?>
                                            <div class="item" style="display:block;"
                                                 id="li_<?php echo $output['address_info']['address_id']; ?>">
                                                <div>
                                                    <input type="radio" class="hide addr" nc_type="addr" name="addr"
                                                           id="addr_<?php echo $output['address_info']['address_id']; ?>"
                                                           value="<?php echo $output['address_info']['address_id']; ?>"
                                                           address="<?php echo $output['address_info']['area_info'] . '&nbsp;&nbsp;' . $output['address_info']['address']; ?>"
                                                           true_name="<?php echo $output['address_info']['true_name']; ?>"
                                                           city_id="<?php echo $output['address_info']['city_id'] ?>"
                                                           area_id="<?php echo $output['address_info']['area_id']; ?>"
                                                           phone="<?php echo $output['address_info']['mob_phone'] ? $output['address_info']['mob_phone'] : $output['address_info']['tel_phone']; ?>"
                                                           zipcode="<?php echo $output['address_info']['zipcode']; ?>" <?php echo $output['address_info']['is_default'] == '1' ? 'checked' : null; ?> >
                                                </div>
                                                <div class="addr_brief" id="addr_list">
                                                    <div class="addr dot_on inline_b desc">
                                                        <?php if (strpos($output['address_info']['true_name'], "-")) { ?>
                                                            <?php echo substr($output['address_info']['true_name'], 0, strpos($output['address_info']['true_name'], "-")); ?>
                                                            <?php echo substr($output['address_info']['true_name'], strripos($output['address_info']['true_name'], "-") + 1); ?>
                                                        <?php } else { ?>
                                                            <?php echo $output['address_info']['true_name']; ?>
                                                        <?php } ?>

                                                        <br>
                                                        <?php echo $output['address_info']['address'] ?> <br>
                                                        <?php echo $output['address_info']['area_info'] ?> <br>
                                                        <?php echo $output['address_info']['mob_phone'] ? $output['address_info']['mob_phone'] : $output['address_info']['tel_phone']; ?>
                                                        <br>
                                                        <b class="defaults">Default address</b>
                                                    </div>
                                                </div>
                                                <div class="inline_b btn_box">
                                                                              <span class=""
                                                                                    onclick="defaultAddr(<?php echo $output['address_info']['address_id'] ?>,<?php echo $output['address_info']['city_id'] ?>,<?php echo $output['address_info']['area_id']; ?>)">
                                                                                        Set default address</span>


                                                    <span class="edit_btn edit_addr_btn" href="javascript:void(0);"
                                                          class="btn-bluejeans"
                                                          dialog_id="my_address_edit" dialog_width="550"
                                                          dialog_title="Edit Address"
                                                          nc_type="dialog"
                                                          uri="<?php echo MEMBER_SITE_URL; ?>/index.php?model=member_address&fun=address&type=edit&layout=order&id=<?php echo $output['address_info']['address_id']; ?>">
                    Edit
                </span>
                                                    <span class="delete_btn"
                                                          onclick="if(confirm('Are you sure you want to delete it ?')){delAddr(<?php echo $output['address_info']['address_id'] ?>)}else{return false;};">Delete</span>

                                                </div>
                                                <div class="addr_edit load_edit">

                                                </div>
                                            </div>
                                        </div>
                                        <?php } else { ?>


                                            <tr>
                                                <td colspan="20" class="norecord">
                                                    <div class="warning-option"><i
                                                                class="icon-warning-sign"></i><span><?php echo $lang['no_record']; ?></span>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>

                                        <!--                                    加载更多地址-->
                                        <div class="hide_addr">
                                        </div>
                                    </div>
                                    <div class="more_addr_btn more_down">
                                        <span class="txt">More addresses</span><br>
                                        <span class="arrow"></span>
                                    </div>
                                    <div class="grey_border">
                                        <div class="add_t grey_dot border"><p class="margin-0 pointer inline_b">+ Add
                                                New
                                                Shipping Address</p></div>
                                        <div class="add_shipping_addr" id="add_addr_box">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 pan_paytype">
                                    <div class="lc-title"> PAYMENT METHOD</div>
                                    <div class="lc-type">
                                        <?php foreach ($output['payment_list'] as $val) { ?>
                                            <?php if ($val['payment_state'] == '1') { ?>
                                                <div class="lc-item">
                                                    <input id="<?php echo $val['payment_code']; ?>" type="radio"
                                                           class=""
                                                           value="<?php echo $val['payment_code']; ?>"
                                                           name="payment_code"
                                                           <?php if ($val['payment_code'] == 'paypal') { ?>checked="checked"<?php } ?>>
                                                    <label for="<?php echo $val['payment_code']; ?>">
                                                        <?php if ($val['payment_code'] == 'paypal') { ?>
                                                            <img src="/skins/default/img/paypal.png" alt="">
                                                        <?php } else { ?>
                                                            <img src="/skins/default/img/amazonpay.png" alt="">
                                                        <?php } ?>
                                                    </label>
                                                </div>


                                            <?php } ?>
                                        <?php } ?>


                                    </div>

                                </div>
                                <div class="col-md-4 pan_info">
                                    <?php if (!empty($output['store_cart_list'])){ ?>
                                    <?php foreach ($output['store_cart_list'] as $store_id => $cart_list) { ?>
                                    <div class="shoplist clearfix" nc_type="ncCartGoods"
                                         store_id="<?php echo $cart_list[0]['store_id']; ?>">
                                        <div class="lc-title"> PAYMENT METHOD</div>
                                        <table class="table" class="shoplist clearfix">
                                            <?php if (!empty($cart_list)) {
                                                $total_repair = 0; ?>
                                                <thead>
                                                <tr>
                                                    <th>Model</th>
                                                    <th>Qty</th>
                                                    <th>Total</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php foreach ($cart_list as $g) { ?>
                                                    <?php if ($g['state'] && $g['storage_state']) { ?>
                                                        <input type="hidden"
                                                               value="<?php echo $g['cart_id'] . '|' . $g['goods_num']; ?>"
                                                               store_id="<?php echo $store_id ?>" name="cart_id[]">
                                                        <input type="hidden"
                                                               value="<?php echo $g['goods_id'] . '|' . $g['goods_num']; ?>"
                                                               store_id="<?php echo $store_id ?>" name="goods_id[]">
                                                    <?php } ?>
                                                    <tr class="item buy_list" id="<?php echo $g['goods_id']; ?>"
                                                        num="<?php echo $g['goods_num']; ?>"
                                                        goods_total="<?php echo $g['goods_total']; ?>">

                                                        <td>
                                                            <a href="<?php echo urlShop('goods', 'index', array('goods_id' => $g['goods_id'])); ?>"
                                                               target="_blank">
                                                                <?php echo $g['goods_serial']; ?>
                                                            </a>
                                                        </td>
                                                        <input type="hidden" class="repair_prices"
                                                               value="<?php echo $g['goods_repair']['repair_price']; ?>">
                                                        <td><?php echo $g['goods_num']; ?></td>
                                                        <td>$<?php echo $g['goods_total']; ?></td>
                                                        <input type="hidden" class="goods_repair_total"
                                                               value="<?php echo $g['goods_repair_total']; ?>">
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            <?php } ?>
                                        </table>


                                        <div class="lc-youhui">
                                            <!-- E voucher list -->
                                            <p class="list_t">Coupon List</p>
                                            <p class="t coupons_desc">Available coupons</p>

                                            <div class="yhqbox">
                                                <div class="yhq">

                                                    <select nctype="voucher" name="voucher[<?php echo $store_id; ?>]"
                                                            class="select">
                                                        <option value="<?php echo $voucher['voucher_t_id']; ?>|<?php echo $store_id; ?>|0.00"
                                                                data-type="0">
                                                            -Choose to use coupons -
                                                        </option>
                                                        <?php foreach ($output['store_voucher_list'][$store_id] as $voucher) { ?>
                                                            <option value="<?php echo $voucher['voucher_t_id']; ?>|<?php echo $store_id; ?>|<?php echo $voucher['voucher_price']; ?>|<?php echo $voucher['voucher_t_price_type']; ?>"
                                                                    data-type="<?php echo $voucher['voucher_t_price_type']; ?>"><?php echo $voucher['desc']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <div class="sum">
                                                        <em id="eachStoreVoucher_<?php echo $store_id; ?>"
                                                            class="subtract hide">-0.00</em>
                                                        <input type="hidden" id="voucher_fav_type" value=""/>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- E voucher list -->

                                            <div class="item buy_list total_box">
                                                <div class="price_box">
                                                    <p class="padding-left-7_5">
                                                        <b id="goodsCount"><?php echo $output['total_num']; ?></b><br>
                                                        <span class="total_p" id="goodsService"></span><br>
                                                        <span class="total_p" id="goodsTotal"></span><br>
                                                        <!--                                                --<br>-->
                                                        <span class="total_p"><b nc_type="eachStoreFreight"
                                                                                 id="eachStoreFreight_<?php echo $store_id; ?>">0.00</b></span>
                                                        <!--                                                <br>-->
                                                        <br>
                                                        <span class="total_p">
                                                        <b nc_type="tax_price" id="tax_price_<?php echo $store_id; ?>">
                                                           0.00
                                                        </b>
                                                    </span><br>
                                                        <br>
                                                    </p>
                                                </div>
                                                <div class="price_box">
                                                    <p>
                                                        Number :<br>
                                                        Warranty Service :<br>
                                                        Subtotal :<br>
                                                        <!--                                                Discount :<br>-->
                                                        Shipping :<br>
                                                        <!--                                                Warranty Price :<br>-->
                                                        Estimated Tax :<br>
                                                    </p>
                                                </div>
                                            </div>


                                            <div class="item buy_list total_box" style="border: none;">
                                                <div class="price_box">
                                                    <p class="padding-left-7_5">
                                                        <span class="total_p" style="font-size: 20px;"><b
                                                                    id="orderTotal"></b></span>


                                                    </p>
                                                </div>
                                                <div class="price_box">
                                                    <p style="font-weight: 700;font-size: 18px;">
                                                        Grand Total:
                                                    </p>
                                                </div>
                                                <div class="text-center">
                                                    <input type="button" id="submitOrder" value="Continue to Payment"
                                                           class="continue-pay">
                                                </div>
                                            </div>

                                            <?php } ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- S fcode -->
                            <?php //if ($output['current_goods_info']['is_fcode']) { ?>
                            <!--    --><?php //include template('buy/buy_fcode'); ?>
                            <?php //} ?>


                            <!-- <div class="ncc-main">
                          <div class="ncc-title">
                            <h3><?php echo $lang['cart_index_ensure_info']; ?></h3>
                            <h5>请仔细核对填写收货、发票等信息，以确保物流快递及时准确投递。</h5>
                          </div> -->
                            <?php //include template('buy/buy_address'); ?>
                            <?php //include template('buy/buy_payment'); ?>


                            <?php //if ($output['current_goods_info']['is_book']) { ?>
                            <!--    --><?php //include template('buy/buy_book_goods'); ?>
                            <?php //} else { ?>
                            <!--    --><?php //include template('buy/buy_goods_list'); ?>
                            <?php //} ?>

                            <!--    <input value="buy" type="hidden" name="model">-->
                            <!--    <input value="buy_step2" type="hidden" name="fun">-->

                            <input type="hidden" id="current" name="current" value="<?php echo $output['current']; ?>"/>
                            <input type="hidden" name="express" value=""/>
                            <!-- 来源于购物车标志 -->
                            <input value="<?php echo $output['ifcart']; ?>" type="hidden" name="ifcart">

                            <!-- offline/online -->
                            <input value="online" name="pay_name" id="pay_name" type="hidden">

                            <!-- 是否保存增值税发票判断标志 -->
                            <input value="<?php echo $output['vat_hash']; ?>" name="vat_hash" type="hidden">

                            <!-- 收货地址ID -->
                            <input value="<?php echo $output['address_info']['address_id']; ?>" name="address_id"
                                   id="address_id" type="hidden">

                            <!-- 城市ID(运费) -->
                            <input value="" name="buy_city_id" id="buy_city_id" type="hidden">

                            <!-- 自提门店 -->
                            <input value="" name="chain[id]" id="input_chain_id" type="hidden">
                            <input value="" name="chain[buyer_name]" id="input_chain_buyer_name" type="hidden">
                            <input value="" name="chain[tel_phone]" id="input_chain_tel_phone" type="hidden">
                            <input value="" name="chain[mob_phone]" id="input_chain_mob_phone" type="hidden">

                            <!-- 记录所选地区是否支持货到付款 第一个前端JS判断 第二个后端PHP判断 -->
                            <input value="" id="allow_offpay" name="allow_offpay" type="hidden">
                            <input value="" id="allow_offpay_batch" name="allow_offpay_batch" type="hidden">
                            <input value="" id="offpay_hash" name="offpay_hash" type="hidden">
                            <input value="" id="offpay_hash_batch" name="offpay_hash_batch" type="hidden">

                            <!-- 默认使用的发票 -->
                            <input value="<?php echo $output['inv_info']['inv_id']; ?>" name="invoice_id"
                                   id="invoice_id"
                                   type="hidden">
                            <input value="<?php echo getReferer(); ?>" name="ref_url" type="hidden">
                            <!-- </div> -->

                            <!-- 税金额 -->
                            <input value="" id="offpay_tax" name="offpay_tax" type="hidden">
                            <input value="" id="offpay_tax_payment" name="offpay_tax_payment" type="hidden">

                            <!-- 优惠金额 -->
                            <input value="0.00" id="discount_payment" name="discount_payment" type="hidden">


                    </form>

                    <div class="inner_ct">
                        <a class="fl go_ahead" href="<?php echo urlShop('cart', 'index'); ?>">Return to cart</a>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!--中间内容结束-->





<script type="text/javascript">


    $(function () {
        //加载收货地址列表
        $('#edit_reciver').click(function () {
            $(this).hide();
            disableOtherEdit('For modification, please save consignee information first');
            var url = SITEURL + '/index.php?model=buy&fun=load_addr';
            $('#addr_list').load(url);
        });
        calcOrder();
        <?php if (!empty($output['address_info']['address_id'])) {?>
        showShippingPrice(<?php echo $output['address_info']['city_id'];?>,<?php echo $output['address_info']['area_id'];?>);
        <?php } else {?>
        $('#edit_reciver').click();
        $('#submitOrder').addClass('disabled');
        <?php }?>

    })
    var r = 0;
    $('.more_addr_btn').click(function () {//加载更多地址
        r += 180;
        if ($(this).hasClass('more_down')) {//下滑查看更多地址
            var url = SITEURL + '/index.php?model=buy&fun=load_addr&status=1&default=0';
            $('.hide_addr').load(url);//请求加载其他地址接口

            $(this).removeClass('more_down');
            $(this).find('.arrow').css('transform', 'rotate(' + r + 'deg)');
            $(this).find('.txt').text('Collapse');
        } else {//收起更多地址
            $(".warning-option").remove();
            $('.hide_addr .item').slideUp();
            var city_id = $('input[name="addr"]:checked').attr('city_id');
            var area_id = $('input[name="addr"]:checked').attr('area_id');

            showShippingPrice(city_id, area_id);//重新计算运费

            $(this).addClass('more_down');
            $(this).find('.arrow').css('transform', 'rotate(' + r + 'deg)');
            $(this).find('.txt').text('More addresses');
        }
    })

    //地址选取
    $('.addr_list .addr_brief').each(function () {
        $(this).click(function () {
            $('.addr_list .item .addr').removeClass('dot_on');
            $('.addr_list .item .addr').addClass('grey_dot');
            $(this).find('.addr').addClass('dot_on');
        })
    })

    //添加地址toggle
    $('.add_t p').click(function () {
        $('.add_shipping_addr').slideToggle();
        if ($(this).parent('.add_t').hasClass('dot_on')) {

            $(this).parent('.add_t').removeClass('dot_on')
        } else {
            $('#add_addr_box').load(SITEURL + '/index.php?model=buy&fun=add_addr');
            $('#add_addr_box').show();
            $(this).parent('.add_t').addClass('dot_on')
        }
    })


    function delAddr(id) {
        $.get(SITEURL + '/index.php?model=buy&fun=load_addr', {'id': id, 'status': '3'}, function (data) {
            if (data.state == 'success') {
                var child = '#li_' + id;
                console.log(child);
                $(child).remove();
            } else {
                showDialog('系统出现异常', 'error', '', '', '', '', '', '', '', '', 2);
            }

        }, 'json');

    }

    function edit_address(address_id, type, obj) {//修改地址
        if (obj.hasClass('cancel_btn')) {
            obj.text('Cancel');
            obj.removeClass('cancel_btn')
        } else {
            obj.text('Eidt');
            obj.addClass('cancel_btn')
        }
        obj.parent('.btn_box').siblings('.addr_edit').slideToggle();
        if (type == 'save') {
            var edit = obj.parent().siblings('.addr_edit')
            var sib = obj.parent().parent().siblings('.item') //同级地址框
            // console.log(sib)
            sib.find('.load_edit').hide();//点击隐藏同级其他地址框
            sib.find('.edit_btn').text('Eidt');
            edit.load(SITEURL + '/index.php?model=buy&fun=edit_addr&type=' + type + '&address_id=' + address_id);
        }
    }

    function defaultAddr(address_id, city_id, area_id) {//设置默认地址
        $.ajax({
            type: 'post',
            url: SITEURL + '/index.php?model=buy&fun=edit_default',
            data: {address_id: address_id},
            dataType: 'json',
            async: false,
            success: function (data) {
                // console.log(data)
                if (data.state) {
                    location.reload();
                    //不收回下拉栏直接刷新
                    // window.location.reload();
                    // $('#addr_' + address_id).prop('checked', true);
                    // $('#li_' + address_id).find('.grey_dot ');
                    // $('.defaults').remove();
                    // $('#li_' + address_id).find('.desc ').append('<b class="defaults">Default address</b>')
                    //
                    //
                    // if ($('input[nc_type="addr"]:checked').val() == '0' || $('input[nc_type="addr"]:checked').val() == '-1') {
                    //     submitAddAddr();
                    // } else {
                    //     if ($('input[nc_type="addr"]:checked').size() == 0) {
                    //         return false;
                    //     }
                    //     showShippingPrice(city_id, area_id);
                    //     hideAddrList(address_id, city_id, area_id, data.info.firstName, data.info.lastName, data.info.area_info, data.info.address, data.info.mob_phone, data.info.zipcode);
                    // }
                } else {
                    alert('Default address settings failed');
                }
            },

        });
    }

    //隐藏收货地址列表
    function hideAddrList(addr_id, city_id, area_id, firstName, lastName, area_info, address, phone, zipcode, is_default) {
        location.reload();//直接刷新页面
        return true;

        var r = 0;
        r += 180;
        $('.hide_addr .item').slideUp();
        $('.more_addr_btn').addClass('more_down');

        $('.more_addr_btn .arrow').css('transform', 'rotate(' + r + 'deg)');
        $('.more_addr_btn').find('.txt').text('More addresses');
        $('#edit_reciver').show();
        if (typeof(addr_id) == "undefined") {
            $("#address_id").val(addr_id);
        }

        var html = ''
        if ($(".warning-option").length > 0) {
            $(".warning-option").remove();
        }

        html += '<div class="show_addr">'
        html += '<div class="item" style="display:block;" id="li_' + addr_id + '">'
        html += '<div><input type="radio" class="hide addr" nc_type="addr" name="addr" id="addr_' + addr_id + '" value="' + addr_id + '" address="' + address + '" true_name="' + firstName + '&nbsp;&nbsp;' + lastName + '" city_id="1290" area_id="1462" phone="' + phone + '" zipcode="' + zipcode + '" checked=""></div>'
        html += '<div class="addr_brief"><div class="addr dot_on inline_b desc">'
        html += firstName + '&nbsp;&nbsp;' + lastName + '<br>'
        html += area_info + '<br>'
        html += address + '<br>'
        html += phone + '<br>'
        html += '<b class="defaults">Default address</b>'
        html += '</div></div>'
        html += ' <div class="inline_b btn_box">'
        html += '<span class="" onclick="defaultAddr('+addr_id+','+city_id+','+area_id+')"> Set default address</span>'
        html += '<span class="edit_btn edit_addr_btn" href="javascript:void(0);" dialog_id="my_address_editss" dialog_width="550" dialog_title="Edit Address"' +
            ' nc_type="dialog" uri="http://www.kalamera.cn/person/index.php?model=member_address&fun=address&type=edit&layout=order&id='+addr_id+'"> Edit </span>'

        html += '<span class="delete_btn" onclick="if(confirm('+"'Are you sure you want to delete it ?'"+')){delAddr('+addr_id+')}else{return false;};">Delete</span>'

        html += '</div>'

        html += '<div class="hide_addr"></div>'



        // console.log(is_default);

        if (is_default == 1) {

            $(".addr_list").html(html);
        }
        ableOtherEdit();
        $('#edit_payment').click();
    }

    //异步显示每个店铺运费 city_id计算运费area_id计算是否支持货到付款
    function showShippingPrice(city_id, area_id, freight_hash) {
        $('#buy_city_id').val('');
        $.post(SITEURL + '/index.php?model=buy&fun=change_addr', {
            'freight_hash': "<?php echo $output['freight_hash'];?>",
            city_id: city_id,
            'area_id': area_id
        }, function (data) {
            // console.log(data)
            if (data.state == 'success') {
                $('#buy_city_id').val(city_id ? city_id : area_id);
                $('#allow_offpay').val(data.allow_offpay);
                if (data.allow_offpay_batch) {
                    var arr = new Array();
                    $.each(data.allow_offpay_batch, function (k, v) {
                        arr.push('' + k + ':' + (v ? 1 : 0));
                    });
                    $('#allow_offpay_batch').val(arr.join(";"));
                }
                $('#offpay_hash').val(data.offpay_hash);
                $('#offpay_hash_batch').val(data.offpay_hash_batch);
                var content = data.content;
                var tpl_ids = data.no_send_tpl_ids;
                no_send_tpl_ids = [];
                no_chain_goods_ids = [];
                if (content.length == 0) {
                    $('#eachStoreFreight_1').html('0.00');
                }
                for (var i in content) {

                    if (content[i] !== false) {
                        $('#eachStoreFreight_' + i).html(number_format(content[i], 2));
                    } else {
                        no_send_store_ids[i] = true;
                    }
                }
                for (var i in tpl_ids) {
                    no_send_tpl_ids[tpl_ids[i]] = true;
                }

                var repair_price = 0;
                $.each($(".repair_prices"), function (i, v) {
                    repair_price += parseFloat($(this).val())
                    //查找保修商品价格
                });
                $('#goodsService').html(repair_price);
                if (data.tax) {
                    $('#offpay_tax').val(data.tax)//税百分比
                    var taxs = data.tax / 100
                    var total = $('#goodsTotal').html();

                    new_total = total * (taxs)//税金额
                    // console.log(new_total)
                    $('#tax_price_1').html(new_total.toFixed(2));

                    $('#offpay_tax_payment').val(new_total.toFixed(2))
                } else {
                    $('#offpay_tax').val(data.tax)
                    $('#offpay_tax_payment').val(data.tax)
                    $('#tax_price_1').html('0.00');
                }
                calcOrder();
            } else {
                showDialog('Systematic abnormalities', 'error', '', '', '', '', '', '', '', '', 2);
            }

        }, 'json');
    }

    $('*[nc_type="dialog"]').click(function(){
        var id = $(this).attr('dialog_id');
        var title = $(this).attr('dialog_title') ? $(this).attr('dialog_title') : '';
        var url = $(this).attr('uri');
        var width = $(this).attr('dialog_width');
        CUR_DIALOG = ajax_form(id, title, url, width,0);
        return false;
    });

</script>



