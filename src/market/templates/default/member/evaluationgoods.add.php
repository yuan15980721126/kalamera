<?php defined('interMarket') or exit('Access Invalid!');?>

<div class="order_nav evaluate_  clearfix">
    <div class="fl" style="margin-top: 13px;margin-left: 10px;">
        <div class="order_li orderli_active" id="order_li1">
            <a href="<?php echo urlShop('member_evaluate','goodsadd');?>">
                To be evaluated
<!--                [ --><?php //echo $output['not_num'];?><!--]-->
            </a>
        </div>
        <div class="order_li" id="order_li2">
            <a href="<?php echo urlShop('member_evaluate','list',array('type'=>'already')
            );?>">Evaluate
<!--                [--><?php //echo $output['goodsevalcount'];?><!--]-->
            </a>
        </div>
    </div>
</div>
<div class="info_tab dis_b">
    <div class="evaluation_pop pc_wrap_padding">
        <?php if (is_array($output['order_goods']) && !empty($output['order_goods'])) { ?>
            <?php foreach ((array)$output['order_goods'] as $k=>$goods){?>
        <form id="evalform<?php echo $goods['rec_id'];?>" method="post" action="index.php?model=member_evaluate&fun=<?php echo $_GET['fun'];?>&order_id=<?php echo $goods['order_id'];?>">
            <input type="hidden" name="form_submit" value="ok" />
            <input type="hidden" name="order_id" value="<?php echo $goods['order_id'];?>" />



            <div class="item clearfix">
                <span class="font-14">
                    <a href="index.php?model=goods&goods_id=<?php echo $goods['goods_id'];?>" target="_blank" title="<?php echo $goods['goods_name'];?>">
                        <?php echo $goods['goods_name'];?>
                    </a>
                </span><br>


                <div class="raty vm level padding-t-10 block" style="padding-bottom: 10px;    margin-left: 120px;">
                    <b>*</b> 评分：
                    <input nctype="score" name="goods[<?php if ($_GET['fun'] != 'add_vr') { echo $goods['rec_id'];} else { echo $goods['goods_id'];}?>][score]" type="hidden">

                </div>
                <div class="inline_b">
                    <div class="imgb">
                        <a href="index.php?model=goods&goods_id=<?php echo $goods['goods_id']; ?>" target="_blank">
                            <img src="<?php echo $goods['goods_image_url']; ?>"/>
                        </a>
                    </div>
                </div>
                <div class="inline_b fr text_area">
                    <textarea class="textareaform<?php echo $goods['rec_id'];?>" name="goods[<?php if ($_GET['fun'] != 'add_vr') { echo $goods['rec_id'];} else { echo $goods['goods_id'];}?>][comment]" placeholder="Please enter the content to be evaluated。"></textarea>

                    <?php if ($_GET['fun'] != 'add_vr') {?>
                            <input type="file" style="display: none" hidefocus="true" size="1" class="input-file" name="file" id="file<?php echo $goods['rec_id'];?>" multiple>
                            <label class="upload_btn" for="file<?php echo $goods['rec_id'];?>">Upload image</label>
                    <?php }?>
                    <div class="small_box">
                        <div class="img_box" nctype="ul_evaluate_image<?php echo $goods['rec_id'];?>" data-count='0'>
                        </div>
                        <div class="img_num"> <span class="imgnum">0</span>/5 </div>
                        <input class="evaluate_submit btn_submit<?php echo $goods['rec_id'];?>" data-recid="<?php echo $goods['rec_id'];?>" type="button"  value="Submit"/>

                    </div>
<!--                    <div class="upload_btn">Upload image</div>-->
<!--                    <div class="small_box">-->
<!--                        <div class="img_box">-->
<!--                            <img src="images/pro_sc.jpg">-->
<!--                            <div class="img_close">✖</div>-->
<!--                        </div>-->
<!--                        <div class="img_box">-->
<!--                            <img src="images/pro_sc.jpg">-->
<!--                            <div class="img_close">✖</div>-->
<!--                        </div>-->
<!--                        <div class="img_box">-->
<!--                            <img src="images/pro_sc.jpg">-->
<!--                            <div class="img_close">✖</div>-->
<!--                        </div>-->
<!--                        <div class="img_num"> 3/5 </div>-->
<!--                    </div>-->
<!--                    <input type="submit" class="evaluate_submit" value="Submit">-->
                </div>
            </div>
        </form>
            <?php }?>
        <?php }else{?>
            <div class="info_tab dis_b text-center min_height_450">
                <div style="padding:191px 0;">
                    <p style="font-size: 16px;font-weight: 700;margin:0 20px 15px 20px;">You have no products to be evaluated.</p>
                    <a class="go_right" href="<?php echo BASE_SITE_URL; ?>">Go shopping</a>
                </div>
            </div>
        <?php } ?>



    </div>
</div>

















<!---->
<!---->
<!---->
<!--<div class="bg">-->
<!--    <div class="border_t"></div>-->
<!--    --><?php //require_once template('layout/cur_local');?>
<!--    <div class="container">-->
<!--        <div class="row">-->
<!---->
<!--            <div class="col-md-10 col-sm-9 pad_l_0">-->
<!--                <div class="order_nav clearfix">-->
<!--                    <div class="fl" style="margin-top: 13px;margin-left: 10px;">-->
<!--                        <div class="order_li --><?php //if($_GET['op'] == 'goodsadd'){?><!--orderli_active--><?php //}?><!--">-->
<!--                            <a href="--><?php //echo urlShop('member_evaluate','goodsadd');?><!--">待评价 [ --><?php //echo $output['not_num'];?><!--]</a>-->
<!--                        </div>-->
<!---->
<!--                        <div class="order_li --><?php //if($_GET['state_type'] == 'state_success'){?><!--orderli_active--><?php //}?><!--">-->
<!--                            <a href="--><?php //echo urlShop('member_evaluate','list',array('type'=>'already')
//                            );?><!--">已评价 [--><?php //echo $output['goodsevalcount'];?><!--]</a>-->
<!--                        </div>-->
<!---->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="pl_box" id="pl_box1">-->
<!---->
<!--                    --><?php //if (is_array($output['order_goods']) && !empty($output['order_goods'])) { ?>
<!--                    --><?php //foreach ((array)$output['order_goods'] as $k=>$goods){?>
<!--                            <form id="evalform--><?php //echo $goods['rec_id'];?><!--" method="post" action="index.php?model=member_evaluate&fun=--><?php //echo $_GET['op'];?><!--&order_id=--><?php //echo $goods['order_id'];?><!--">-->
<!--                                <input type="hidden" name="form_submit" value="ok" />-->
<!--                                <input type="hidden" name="order_id" value="--><?php //echo $goods['order_id'];?><!--" />-->
<!--                    <div class="pl_li">-->
<!--                        <a href="index.php?model=goods&goods_id=--><?php //echo $goods['goods_id']; ?><!--" target="_blank">-->
<!--                            <img src="--><?php //echo $goods['goods_image_url']; ?><!--"/>-->
<!--                        </a>-->
<!--                        <div class="inline_b">-->
<!--                            <h6>-->
<!--                                <a href="index.php?model=goods&goods_id=--><?php //echo $goods['goods_id'];?><!--" target="_blank" title="--><?php //echo $goods['goods_name'];?><!--">--><?php //echo $goods['goods_name'];?>
<!--                                </a>-->
<!--                            </h6>-->
<!--                            <div class="raty vm" style="width: 200px;!important;">-->
<!--                                <b>*</b> 评分：-->
<!--                                <input nctype="score" name="goods[--><?php //if ($_GET['fun'] != 'add_vr') { echo $goods['rec_id'];} else { echo $goods['goods_id'];}?><!--][score]" type="hidden">-->
<!---->
<!--                            </div>-->
<!--                            <textarea class="textareaform--><?php //echo $goods['rec_id'];?><!--" name="goods[--><?php //if ($_GET['fun'] != 'add_vr') { echo $goods['rec_id'];} else { echo $goods['goods_id'];}?><!--][comment]" cols="100" class="w450 mt10 mb10 h40" placeholder="请输入要评价的内容，不要超过150个字符。"></textarea>-->
<!--                            --><?php //if ($_GET['fun'] != 'add_vr') {?>
<!--                                <div class="upload_pic">-->
<!--                                    <input type="file" style="display: none" hidefocus="true" size="1" class="input-file" name="file" id="file--><?php //echo $goods['rec_id'];?><!--" multiple>-->
<!--                                    <label class="upload_btn" for="file--><?php //echo $goods['rec_id'];?><!--">上传图片</label>-->
<!--                                </div>-->
<!--                            --><?php //}?>
<!--                            <div class="small_box">-->
<!--                                <div class="img_box" nctype="ul_evaluate_image--><?php //echo $goods['rec_id'];?><!--" data-count='0'>-->
<!--                                </div>-->
<!--                                <div class="img_num"> <span class="imgnum">0</span>/5 </div>-->
<!--                            </div>-->
<!--                            <input class="pl_btn btn_submit--><?php //echo $goods['rec_id'];?><!--" data-recid="--><?php //echo $goods['rec_id'];?><!--" type="button"  value="提交评论"/>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    </form>-->
<!--                        --><?php //}?>
<!--                    --><?php //}else{?>
<!--                        <div class="info_tab">-->
<!--                            <div class="infotab_b infotab_b2">-->
<!--                                <div class="img_box"><img src="--><?php //echo RESOURCE_SITE_URL;?><!--/images/evaluation.jpg" /></div>-->
<!--                                <div class="info_txt">-->
<!--                                    您目前没有需要评价的订单<br />-->
<!--                                    <b>有机时代e商城，是您放心的选择！</b><br />-->
<!--                                    <a href="--><?php //echo BASE_SITE_URL;?><!--">去购物 <em>&gt;</em> </a>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    --><?php //} ?>
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->




<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.raty/jquery.raty.min.js"></script>
<?php if ($_GET['fun'] != 'add_vr') {?>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/fileupload/jquery.iframe-transport.js" charset="utf-8"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/fileupload/jquery.ui.widget.js" charset="utf-8"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/fileupload/jquery.fileupload.js" charset="utf-8"></script>
<?php }?>
<script type="text/javascript">
$(function(){
    $('.raty').raty({
        width:200,
        path: "<?php echo RESOURCE_SITE_URL;?>/js/jquery.raty/img",
        click: function(score) {
            $(this).find('[nctype="score"]').val(score);
        }
    });

    $('.raty-x2').raty({
        path: "<?php echo RESOURCE_SITE_URL;?>/js/jquery.raty/img",
        starOff: 'star-off-x2.png',
        starOn: 'star-on-x2.png',
        width: 150,
        click: function(score) {
            $(this).find('[nctype="score"]').val(score);
        }
    });



    <?php if ($_GET['fun'] != 'add_vr') {?>
    <?php if(!empty($output['order_goods'])){?>
    <?php foreach($output['order_goods'] as $goods){?>
    <?php $param_id = $_GET['fun'] != 'add_vr' ? $goods['rec_id'] : $goods['goods_id'];?>
    // 图片上传
    $('.btn_submit<?php echo $param_id;?>').on('click', function() {
        var textarea =$('.textareaform<?php echo $param_id;?>').val();
        if(!textarea){
            alert('Please fill in the evaluation content');
            return false;
        }
        var recid  = $(this).attr('data-recid');
        // alert('evalform'+recid)
        ajaxpost('evalform'+recid, '', '', 'onerror')
    });
    $('#file<?php echo $param_id;?>').fileupload({
        dataType: 'json',
        url: '<?php echo urlShop('sns_album', 'swfupload');?>',
        formData: '',
        add: function (e,data) {
            var $count = parseInt($('div[nctype="ul_evaluate_image<?php echo $param_id;?>"]').attr('data-count'));

            if ($count >= 5) {
                return false;
            }
            $('div[nctype="ul_evaluate_image<?php echo $param_id;?>"]').attr('data-count', $count +1);
            $('div[nctype="ul_evaluate_image<?php echo $param_id;?>"]').siblings('.img_num').children('.imgnum').html($count +1);

            data.formData = {category_id:<?php echo $output['ac_id'];?>};
            data.submit();
        },
        done: function (e,data) {
            // console.log(data);
            if(data.result.state == 'true') {
                $('<div class="img_box" nctype="image_item">' +
                        '<img src="' + data.result.file_url + '">' +
                        '<input type="hidden" nctype="input_image" name="goods[<?php echo $param_id;?>][evaluate_image][]" value=" ' + data.result.file_name + ' " >' +
                        '<div class="del img_close"  nctype="del" data-file-id="' + data.result.file_id + '">✖</div>' +
                    '</div>').appendTo('div[nctype="ul_evaluate_image<?php echo $param_id;?>"]');
            } else {
                showError(data.result.message);
            }
        }
    });
    <?php }?>
    <?php }?>
    $('div[nctype^="ul_evaluate_image"]').on('click', '[nctype="del"]', function() {
        album_pic_del($(this).attr('data-file-id'));
        var $item_li = $(this).parent('.img_box');
        var $item_ul = $(this).parent().parent('.img_box').siblings('.img_num').children('.imgnum');
        var num_tips = $(this).parent().parent('.img_box').attr('data-count');

        $(this).parent().parent('.img_box').attr('data-count', num_tips -1)

        $item_li.find('[nctype="input_image"]').val('');
        $item_li.remove();
        // console.log(num_tips);
        // console.log($item_ul);
        $item_ul.html(num_tips -1);
    });

    var album_pic_del = function(file_id) {
        var del_url = "<?php echo urlShop('sns_album', 'album_pic_del');?>";
        del_url += '&id=' + file_id;
        $.get(del_url);
    }
    <?php }?>
});
</script> 
