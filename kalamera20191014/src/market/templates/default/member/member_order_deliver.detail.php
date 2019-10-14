<?php defined('interMarket') or exit('Access Invalid!');?>

<!--中间内容-->
<div class="page_form clearfix">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <div class="login_title padding-top-10" style="margin-bottom: 20px;">Logistics</div>
                    <div class="pro_detail_item">
                        <div>
                            <p>Number : </p>
                            <p class="red_pri">
                                <?php echo count($output['order_info']['extend_order_goods']);?>
                            </p>
                        </div>
                        <div>


                            <p>Order product : </p>
                            <p>

                                <?php if(is_array($output['order_info']['extend_order_goods']) and !empty($output['order_info']['extend_order_goods'])) {?>
                                    <?php foreach($output['order_info']['extend_order_goods'] as $key => $val) { ?>
                                        <a href="<?php echo urlShop('goods', 'index', array('goods_id'=>$val['goods_id'])); ?>"> <?php echo $val['goods_name']; ?></a> <br>
                                    <?php }?>
                                <?php }?>


                                &nbsp;<a href="<?php echo urlShop('member_order','show_order',['order_id'=>$output['order_info']['order_id']]);?>" class="blue_theme">[ Order details ]</a>
                            </p>
                        </div>
                        <div>
                            <p>Shipping Status : </p>
                            <p class="red_pri">
                                <?php echo $output['order_info']['state_desc']; ?>
                            </p>
                        </div>
                        <div>
                            <p>Express company  : </p>
                            <p>
                                <?php echo $output['e_name'];?>
                            </p>
                            <input type="hidden" id="e_name" value="<?php echo $output['e_name'];?>">
                        </div>
                        <div>
                            <p>Single number  : </p>
                            <p>
                                <?php echo $output['order_info']['shipping_code']; ?>
                            </p>
                        </div>
                    </div>
                    <div class="logistics_">
                        <div class="addr_l">
                            <p class="addr_img">Shipping address :</p>
                            <p>
                                <?php echo $output['order_info']['extend_order_common']['reciver_name']?><br>
                                <?php echo $output['order_info']['extend_order_common']['reciver_info']['address'];?><br>
                                <?php echo $output['order_info']['extend_order_common']['reciver_info']['phone'];?><br>
                            </p>
                        </div>
                        <div class="addr_l border_none padding-t-30" id="express_list">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--中间内容结束-->









<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.poshytip.min.js" charset="utf-8"></script> 
<script>
$(function(){
	//Ajax提示
	$('.tip').poshytip({
		className: 'tip-yellowsimple',
		showTimeout: 1,
		alignTo: 'target',
		alignX: 'center',
		alignY: 'bottom',
		offsetX: 5,
		offsetY: 0,
		allowTipHover: false
	});
      //var_send = '<br/><?php echo date("Y-m-d H:i:s",$output['order_info']['extend_order_common']['shipping_time']); ?>&nbsp;&nbsp;<?php echo $lang['member_show_seller_has_send'];?>';
	var e_name = $('#e_name').val();
	if(e_name == 'Other'){
        $('#express_list').html("No details of logistics");
    }else {
        $.getJSON('index.php?model=member_order&fun=get_express&e_code=<?php echo $output['e_code']?>&shipping_code=<?php echo $output['order_info']['shipping_code']?>&t=<?php echo random(7);?>', function (data) {
            // console.log(data)
            if (data) {
                var html = '';
                var length = data.length;
                for (i = 0; i < length; i++) {
                    html += "<div>";
                    html += "<p>" + data[i]['time'] + "</p>";
                    html += "<p>" + data[i]['context'] + "</p>";
                    html += "</div>";
                    //html+="<div class='han "+ (i == 0 ? 'han_active' : '') +"'><div class='wuliu_l'>"+data[i]['time']+"</div><div class='wuliu_c'><img class='img1' src='<?php //echo RESOURCE_SITE_URL;?>///images/wuliu2.png' /><img class='img2' src='<?php //echo RESOURCE_SITE_URL;?>///images/wuliu.png' /></div><div class='wuliu_r'>【运输中】 "+data[i]['context']+"</div></div>";
                }
                $('#express_list').html(html);

                // $('#express_list').html(data).next().css('display','');
            } else {
                $('#express_list').html("No details of logistics");
            }
        });
    }
});
</script>