<?php defined('interMarket') or exit('Access Invalid!'); ?>


<!--中间内容-->
<div class="page_form clearfix">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <div class="login_title padding-top-10" style="margin-bottom: 20px;">Application for return</div>
                    <table class="apply_table">
                        <tbody>
                        <tr>
                            <td>Return goods :</td>
                            <td>
                                <div class="evaluation_pop">
                                    <?php if (is_array($output['goods_list']) && !empty($output['goods_list'])) { ?>
                                        <?php foreach ($output['goods_list'] as $key => $val) { ?>
                                            <div class="item clearfix">
                                                <div class="inline_b">
                                                    <div class="imgb">
                                                        <a target="_blank"
                                                           href="<?php echo urlShop('goods', 'index', array('goods_id' => $val['goods_id'])); ?>">
                                                            <img src="<?php echo thumb($val); ?>"
                                                                 onMouseOver="toolTip('<img src=<?php echo thumb($val, 240); ?>>')"
                                                                 onMouseOut="toolTip()"/></a>
                                                    </div>
                                                </div>
                                                <div class="inline_b text_area">
                                                    <strong>Number : </strong><?php echo $val['goods_num']; ?><br>
                                                    <a target="_blank"
                                                       href="<?php echo urlShop('goods', 'index', array('goods_id' => $val['goods_id'])); ?>"><?php echo $val['goods_name']; ?></a><br>
                                                    <strong>Total: &nbsp;<span
                                                                class="red_pri">$<?php echo ncPriceFormat($val['goods_price']); ?></span></strong><br>
                                                    <span><?php echo orderGoodsEnType($val['goods_type']); ?></span>
                                                </div>
                                            </div>


                                        <?php } ?>
                                    <?php } ?>

                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>freight :</td>
                            <td class="apply_type">
                                <?php echo $output['order']['shipping_fee'] > 0 ? ncPriceFormat($output['order']['shipping_fee']) : 'Free shipping'; ?>
                            </td>
                        </tr>


                        <tr>
                            <td>Total orders :</td>
                            <td class="apply_type">
                                <strong><?php echo $lang['currency']; ?><?php echo ncPriceFormat($output['order']['order_amount']); ?>
                                    <?php if ($output['order']['refund_amount'] > 0) { ?>
                                        (<?php echo 'refund' . $lang['nc_colon'] . $lang['currency'] . $output['order']['refund_amount']; ?>)
                                    <?php } ?>
                                </strong>
                            </td>
                        </tr>

                        <tr>
                            <td>Order number :</td>
                            <td class="apply_type">
                                <a target="_blank"
                                   href="index.php?model=member_order&fun=show_order&order_id=<?php echo $output['order']['order_id']; ?>"><?php echo $output['order']['order_sn']; ?></a>

                            </td>
                        </tr>


                        <?php if ($output['order']['payment_code'] != 'offline' && !in_array($output['order']['order_state'], array(ORDER_STATE_CANCEL, ORDER_STATE_NEW))) { ?>
                            <tr>
                                <th>Payment number :</th>
                                <td>
                                    <?php echo $output['order']['pay_sn']; ?>
                                </td>
                            </tr>
                        <?php } ?>


                        <tr>
                            <th>Payment method :</th>
                            <td>
                                <?php echo $output['order']['payment_name']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Order time :</th>
                            <td>
                                <?php echo date("Y-m-d H:i:s", $output['order']['add_time']); ?>
                            </td>
                        </tr>
                        <?php if ($output['order']['payment_time'] > 0) { ?>
                            <tr>
                                <th>Payment time :</th>
                                <td>
                                    <?php echo date("Y-m-d H:i:s", $output['order']['payment_time']); ?>
                                </td>
                            </tr>
                        <?php } ?>



                        <?php if ($output['order_common']['shipping_time'] > 0) { ?>
                            <tr>
                                <th>Delivery time :</th>
                                <td>
                                    <?php echo date("Y-m-d H:i:s", $output['order_common']['shipping_time']); ?>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php if ($output['order']['finnshed_time'] > 0) { ?>
                            <tr>
                                <th>Completion time :</th>
                                <td>
                                    <?php echo date("Y-m-d H:i:s", $output['order']['finnshed_time']); ?>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php if (!empty($output['order']['shipping_code'])) { ?>
                            <tr>
                                <th>Logistics number ：</th>
                                <td>
                                    <a target="_blank"
                                       href="index.php?model=member_order&fun=search_deliver&order_id=<?php echo $output['order']['order_id']; ?>"><?php echo $output['order']['shipping_code']; ?></a>
                                    <a href="javascript:void(0);" class="a"><?php echo $output['e_name']; ?></a>
                                </td>
                            </tr>
                        <?php } ?>

                        </tbody>
                    </table>
                </div>
                <div class="col-md-8">
                    <div class="">
                        <div class="login_title padding-top-10" style="margin-bottom: 20px;">Application for return
                        </div>
                        <form id="post_form2" enctype="multipart/form-data" method="post"
                              action="index.php?model=member_refund&fun=add_refund&order_id=<?php echo $output['order']['order_id']; ?>&goods_id=<?php echo $output['goods']['rec_id']; ?>">
                            <table class="apply_table reason_table">
                                <tbody>

                                <input type="hidden" name="form_submit" value="ok"/>
                                <input type="hidden" name="refund_type" value="2"/>
                                <tr>
                                    <th>Application type :</th>
                                    <td>
                                        <select class="select " name="reason_id">
                                            <option value="">Please choose the reason for refund</option>
                                            <?php if (is_array($output['reason_list']) && !empty($output['reason_list'])) { ?>
                                                <?php foreach ($output['reason_list'] as $key => $val) { ?>
                                                    <option value="<?php echo $val['reason_id']; ?>"><?php echo $val['reason_info']; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                            <option value="0">other</option>
                                        </select>
                                        <span class="error"></span>
                                    </td>
                                    <input type="hidden" name="refund_amount"
                                           value="<?php echo $output['goods']['goods_pay_price']; ?>"/>
                                    <input type="hidden" name="goods_num"
                                           value="<?php echo $output['goods']['goods_num']; ?>"/>
                                </tr>

                                <tr>
                                    <th>Description</th>
                                    <td>
                                    <textarea name="buyer_message" rows="3" class="textarea w400"
                                              placeholder="Here is a description of the specific problems you encounter. Your description will help the customer service personnel to process your application more quickly"></textarea>
                                        <br/>
                                        <span class="error"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td>
                                        <input name="refund_pic1" id="refund_pic1" type="file"
                                               onchange="getPhoto(this,1)"
                                               style="display: none;"/>
                                        <span class="error"></span>
                                        <label for="refund_pic1" class="upload_btn">
                                            <img src="" id="refund_img1" alt="" style="display: none;width: 100%;">
                                        </label>


                                        <input name="refund_pic2" id="refund_pic2" type="file"
                                               onchange="getPhoto(this,2)"
                                               style="display: none;"/>
                                        <span class="error"></span>
                                        <label for="refund_pic2" class="upload_btn">
                                            <img src="" id="refund_img2" alt="" style="display: none;width: 100%;">
                                        </label>


                                        <input name="refund_pic3" id="refund_pic3" type="file"
                                               onchange="getPhoto(this,3)"
                                               style="display: none;"/>
                                        <span class="error"></span>
                                        <label for="refund_pic3" class="upload_btn">
                                            <img src="" id="refund_img3" alt="" style="display: none;width: 100%;">
                                        </label>

                                    </td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td>
                                        <input type="submit" value="Submit application">
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--中间内容结束-->


<script type="text/javascript">
    var imgurl = "";

    function getPhoto(node, dataid) {
        var imgURL = "";
        try {
            var file = null;
            if (node.files && node.files[0]) {
                file = node.files[0];
            } else if (node.files && node.files.item(0)) {
                file = node.files.item(0);
            }
            //Firefox 因安全性问题已无法直接通过input[file].value 获取完整的文件路径
            try {
                imgURL = file.getAsDataURL();
            } catch (e) {
                imgRUL = window.URL.createObjectURL(file);
            }
        } catch (e) {
            if (node.files && node.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    imgURL = e.target.result;
                };
                reader.readAsDataURL(node.files[0]);
            }
        }
        creatImg(imgRUL, 'refund_img' + dataid);
        return imgURL;
    }

    function creatImg(imgRUL, node) {
        // var textHtml = "<img src='"+imgRUL+"'width='414px' height='600px'/>";
        $('#' + node).attr('src', imgRUL).show();
    }

    $(function () {
        $('#post_form2').validate({
            // errorPlacement: function (error, element) {
            //     var id = element.context.name;
            //     console.log(error);
            //     if (id == 'refund_pic1' || id == 'refund_pic2' || id == 'refund_pic3') {
            //         alert(error[0].innerText)
            //     } else {
            //         error.appendTo(element.next('span.error'));
            //     }
            //
            // },
            // submitHandler: function (form) {
            //     ajaxpost('post_form2', '', '', 'onerror')
            // },
            rules: {
                reason_id: {
                    required: true
                },

                buyer_message: {
                    required: true
                },
                refund_pic1: {
                    accept: 'jpg|jpeg|gif|png'
                },
                refund_pic2: {
                    accept: 'jpg|jpeg|gif|png'
                },
                refund_pic3: {
                    accept: 'jpg|jpeg|gif|png'
                }
            },
            messages: {
                reason_id: {
                    required: '<i class="icon-exclamation-sign"></i>Please choose the reason for refund'
                },
                buyer_message: {
                    required: '<i class="icon-exclamation-sign"></i>Please fill in the refund instructions'
                },
                refund_pic1: {
                    accept: '<i class="icon-exclamation-sign"></i>Pictures must be in jpg/jpeg/gif/png format'
                },
                refund_pic2: {
                    accept: '<i class="icon-exclamation-sign"></i>Pictures must be in jpg/jpeg/gif/png format'
                },
                refund_pic3: {
                    accept: '<i class="icon-exclamation-sign"></i>Pictures must be in jpg/jpeg/gif/png format'
                }
            }
        });

    });
</script>
