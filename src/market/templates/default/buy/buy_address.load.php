<?php defined('interMarket') or exit('Access Invalid!'); ?>
<?php if (!empty($output['address_list']) && is_array($output['address_list'])) { ?>
    <?php foreach ($output['address_list'] as $key => $address) { ?>
        <div class="item" id="li_<?php echo $address['address_id']; ?>"  >
            <div>
                <input type="radio" class="hide addr" nc_type="addr" name="addr"
                       id="addr_<?php echo $address['address_id']; ?>"
                       value="<?php echo $address['address_id']; ?>"
                       address="<?php echo $address['area_info'] . '&nbsp;&nbsp;' . $address['address']; ?>"
                       true_name="<?php echo $address['true_name']; ?>"
                       city_id="<?php echo $address['city_id'] ?>"
                       area_id="<?php echo $address['area_id']; ?>"
                       phone="<?php echo $address['mob_phone'] ? $address['mob_phone'] : $address['tel_phone']; ?>"
                       zipcode="<?php echo $address['zipcode']; ?>" <?php echo $address['is_default'] == '1' ? 'checked' : null; ?> >
            </div>
            <div class="addr_brief">
                <div class="addr grey_dot inline_b desc" onclick="defaultAddr(<?php echo $address['address_id'] ?>,<?php echo $address['city_id'] ?>,<?php echo $address['area_id']; ?>)">
                    <?php if(strpos($address['true_name'], "-")) {?>
                    <?php echo substr($address['true_name'], 0, strpos($address['true_name'], "-")); ?>
                    <?php echo substr($address['true_name'], strripos($address['true_name'], "-") + 1); ?>
                    <?php }else{?>
                        <?php echo $address['true_name'];?>
                    <?php }?>
                    <br>
                    <?php echo $address['address'] ?> <br>
                    <?php echo $address['area_info'] ?> <br>
                    <?php echo $address['mob_phone'] ?><br>
                </div>
            </div>

            <div class="inline_b btn_box">
                <span class="" onclick="defaultAddr(<?php echo $address['address_id'] ?>,<?php echo $address['city_id'] ?>,<?php echo $address['area_id']; ?>)">
                    Set default address</span>



                <a class="edit_btn edit_addr_btn" href="javascript:void(0);" class="btn-bluejeans"
                   dialog_id="my_address_edit" dialog_width="550" dialog_title="Edit Address"
                   nc_type="dialog"
                   uri="<?php echo MEMBER_SITE_URL; ?>/index.php?model=member_address&fun=address&type=edit&layout=order&id=<?php echo $address['address_id']; ?>"><i
                            class="icon-edit">Edit</i>
                </a>

                <span class="delete_btn"
                      onclick="if(confirm('Are you sure you want to delete it ?')){delAddr(<?php echo $address['address_id'] ?>)}else{return false;};">Delete</span>
            </div>
            <div class="addr_edit load_edit" id="slideToggle_<?php echo $address['address_id']; ?>">

            </div>
        </div>
    <?php } ?>
<?php } else { ?>
    <tr>
        <td colspan="20" class="norecord">
            <div class="warning-option"><i
                        class="icon-warning-sign"></i><span><?php echo $lang['no_record']; ?></span>
            </div>
        </td>
    </tr>
<?php } ?>






    <script type="text/javascript">
        function delAddr(id){
            // $('#addr_list').load(SITEURL+'/index.php?model=buy&fun=load_addr&ifchain=<?php echo $_GET['ifchain'];?>&id='+id);

                $.get(SITEURL + '/index.php?model=buy&fun=load_addr', {'id':id,'status':'3'}, function(data){
                    if(data.state == 'success') {
                        var child = '#li_'+id;
                        console.log(child);
                        $(child).remove();
                    } else {
                        showDialog('系统出现异常', 'error','','','','','','','','',2);
                    }

                },'json');

        }

        $(function () {
            $('*[nc_type="dialog"]').click(function(){
                var id = $(this).attr('dialog_id');
                var title = $(this).attr('dialog_title') ? $(this).attr('dialog_title') : '';
                var url = $(this).attr('uri');
                var width = $(this).attr('dialog_width');
                CUR_DIALOG = ajax_form(id, title, url, width,0);
                return false;
            });
            $('.hide_addr .item').slideDown();
            function addAddr() {
                $('#add_addr_box').load(SITEURL + '/index.php?model=buy&fun=add_addr');
            }

            $('input[nc_type="addr"]').on('click', function () {
                $('#input_chain_id').val('');
                chain_id = '';
                if ($(this).val() == '0') {
                    $('.address_item').removeClass('ncc-selected-item');
                    $('#add_addr_box').load(SITEURL + '/index.php?model=buy&fun=add_addr');
                } else {
                    if ($(this).val() == '-1') {
                        $('.address_item').removeClass('ncc-selected-item');
                        $('#add_addr_box').load(SITEURL + '/index.php?model=buy&fun=add_chain');
                    } else {
                        $('.address_item').removeClass('ncc-selected-item');
                        $(this).parent().addClass('ncc-selected-item');
                        $('#add_addr_box').html('');
                    }
                }
            });
            $('#hide_addr_list').on('click', function () {
                if ($('input[nc_type="addr"]:checked').val() == '0' || $('input[nc_type="addr"]:checked').val() == '-1') {
                    submitAddAddr();
                } else {
                    if ($('input[nc_type="addr"]:checked').size() == 0) {
                        return false;
                    }
                    var city_id = $('input[name="addr"]:checked').attr('city_id');
                    var area_id = $('input[name="addr"]:checked').attr('area_id');
                    var addr_id = $('input[name="addr"]:checked').val();
                    var true_name = $('input[name="addr"]:checked').attr('true_name');
                    var address = $('input[name="addr"]:checked').attr('address');
                    var phone = $('input[name="addr"]:checked').attr('phone');
                    // console.log(city_id,area_id);
                    window.load()
                    if (chain_id != '') {
                        showProductChain(city_id ? city_id : area_id);
                    } else {
                        showShippingPrice(city_id, area_id);
                    }
                    // hideAddrList(addr_id,true_name,address,phone);
                }
            });
            if ($('input[nc_type="addr"]').size() == 1) {
                $('#add_addr').attr('checked', true);
                addAddr();
            }
            <?php if ($_GET['ifchain']) { ?>
            $('#add_chain').click();
            <?php } ?>
        });


        $(document).ready(function () {
            $("#region").nc_region();
            $('#addr_form').validate({
                errorPlacement: function (error, element) {
                    var error_td = element.parent('dd');
                    // console.log(error);
                    var text = error[0].innerText;
                    // if(element.attr( "id" ) == 'captcha'){
                    //     console.log(text);
                    //     $('#captcha_tip').text(text);
                    //      $('#captcha_tip').show();
                    // }
                    var msg = $(element).parent().next();
                    msg.text(text);
                    msg.show();
                    window.t = $(element)
                    // $( element ).closest( "form" ).find( "div tips[for='" + element.attr( "id" ) + "']" ).append( error );
                    // error_td.append(error);
                    // element.parents('dl:first').addClass('error');

                    // $(element).removeClass("error");
                    // $('#error_tip').show();
                    // $('#error_tip').text(error[0].innerText);  ;
                },
                rules: {
                    true_name: {
                        required: true
                    },
                    region: {
                        checklast: true
                    },
                    address: {
                        required: true
                    },
                    mob_phone: {
                        required: checkPhone,
                        minlength: 11,
                        maxlength: 11,
                        digits: true
                    },
                    tel_phone: {
                        required: checkPhone,
                        minlength: 6,
                        maxlength: 20
                    },
                    zipcode: {
                        required: true,
                        minlength: 6,
                    }
                },
                messages: {
                    true_name: {
                        required: '<i class="icon-exclamation-sign"></i><?php echo $lang['cart_step1_input_receiver'];?>'
                    },
                    region: {
                        checklast: '<i class="icon-exclamation-sign"></i>请将地区选择完整'
                    },
                    address: {
                        required: '<i class="icon-exclamation-sign"></i><?php echo $lang['cart_step1_input_address'];?>'
                    },
                    mob_phone: {
                        required: '<i class="icon-exclamation-sign"></i><?php echo $lang['cart_step1_telphoneormobile'];?>',
                        minlength: '<i class="icon-exclamation-sign"></i><?php echo $lang['cart_step1_mobile_num_error'];?>',
                        maxlength: '<i class="icon-exclamation-sign"></i><?php echo $lang['cart_step1_mobile_num_error'];?>',
                        digits: '<i class="icon-exclamation-sign"></i><?php echo $lang['cart_step1_mobile_num_error'];?>'
                    },
                    tel_phone: {
                        required: '<i class="icon-exclamation-sign"></i><?php echo $lang['cart_step1_telphoneormobile'];?>',
                        minlength: '<i class="icon-exclamation-sign"></i><?php echo $lang['member_address_phone_rule'];?>',
                        maxlength: '<i class="icon-exclamation-sign"></i><?php echo $lang['member_address_phone_rule'];?>'
                    },
                    zipcode: {
                        required: '<i class="icon-exclamation-sign"></i>邮政编码不能为空',
                        minlength: '<i class="icon-exclamation-sign"></i>邮政编码不正确',
                    }
                },
                groups: {
                    phone: 'mob_phone tel_phone'
                }
            });
        });

        function checkPhone() {
            return ($('input[name="mob_phone"]').val() == '' && $('input[name="tel_phone"]').val() == '');
        }

        //异步显示每个店铺运费 city_id计算运费area_id计算是否支持货到付款
        //function showShippingPrice(city_id, area_id) {
        //    $('#buy_city_id').val('');
        //    $.post(SITEURL + '/index.php?model=buy&fun=change_addr', {
        //        'freight_hash': '<?php //echo $output['freight_hash'];?>//',
        //        city_id: city_id,
        //        'area_id': area_id
        //    }, function (data) {
        //        if (data.state == 'success') {
        //            $('#buy_city_id').val(city_id ? city_id : area_id);
        //            $('#allow_offpay').val(data.allow_offpay);
        //            if (data.allow_offpay_batch) {
        //                var arr = new Array();
        //                $.each(data.allow_offpay_batch, function (k, v) {
        //                    arr.push('' + k + ':' + (v ? 1 : 0));
        //                });
        //                $('#allow_offpay_batch').val(arr.join(";"));
        //            }
        //            $('#offpay_hash').val(data.offpay_hash);
        //            $('#offpay_hash_batch').val(data.offpay_hash_batch);
        //            var content = data.content;
        //            var tpl_ids = data.no_send_tpl_ids;
        //            no_send_tpl_ids = [];
        //            no_chain_goods_ids = [];
        //            for (var i in content) {
        //                if (content[i] !== false) {
        //                    $('#eachStoreFreight_' + i).html(number_format(content[i], 2));
        //                } else {
        //                    no_send_store_ids[i] = true;
        //                }
        //            }
        //            for (var i in tpl_ids) {
        //                no_send_tpl_ids[tpl_ids[i]] = true;
        //            }
        //            calcOrder();
        //        } else {
        //            showDialog('系统出现异常', 'error', '', '', '', '', '', '', '', '', 2);
        //        }
        //
        //    }, 'json');
        //}

        //根据门店自提站ID计算商品是否有库存（有库存即支持自提）
        function showProductChain(city_id) {
            $('#buy_city_id').val('');
            var product = [];
            $('input[name="goods_id[]"]').each(function () {
                product.push($(this).val());
            });
            $.post(SITEURL + '/index.php?model=buy&fun=change_chain', {
                chain_id: chain_id,
                product: product.join('-')
            }, function (data) {
                if (data.state == 'success') {
                    $('#buy_city_id').val(city_id);
                    $('em[nc_type="eachStoreFreight"]').html('0.00');
                    no_send_tpl_ids = [];
                    no_chain_goods_ids = [];
                    if (data.product.length > 0) {
                        for (var i in data.product) {
                            no_chain_goods_ids[data.product[i]] = true;
                        }
                    }
                    calcOrder();
                } else {
                    showDialog('系统出现异常', 'error', '', '', '', '', '', '', '', '', 2);
                }
            }, 'json');
        }

        $(function () {
            <?php if (!empty($output['address_info']['address_id'])) {?>
            showShippingPrice(<?php echo $output['address_info']['city_id'];?>,<?php echo $output['address_info']['area_id'];?>);
            <?php } else {?>
            $('#edit_reciver').click();
            <?php }?>
        });

        function submitAddAddr() {
            $('#input_chain_id').val('');
            chain_id = '';
            if ($('#addr_form').valid()) {
                $('#buy_city_id').val($('#region').fetch('area_id_2'));
                var datas = $('#addr_form').serialize();
                $.post('index.php', datas, function (data) {
                    if (data.state) {
                        var true_name = $.trim($("#true_name").val());
                        var tel_phone = $.trim($("#tel_phone").val());
                        var mob_phone = $.trim($("#mob_phone").val());
                        var area_info = $.trim($("#region").val());
                        var address = $.trim($("#address").val());
                        showShippingPrice($('#region').fetch('area_id_2'), $('#region').fetch('area_id'));
                        // hideAddrList(data.addr_id,true_name,area_info+'&nbsp;&nbsp;'+address,(mob_phone != '' ? mob_phone : tel_phone));
                    } else {
                        alert(data.msg);
                    }
                }, 'json');
            } else {
                return false;
            }
        }
    </script>