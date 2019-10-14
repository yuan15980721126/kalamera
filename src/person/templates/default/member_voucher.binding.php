<?php defined('interMarket') or exit('Access Invalid!');?>
<link rel="stylesheet" href="/skins/default/css/Mycollect.css" />
<link rel="stylesheet" href="/skins/default/css/productinfo.css" />
<style type="text/css">
    #alert{
        width: 427px!important;
        height: 177px!important;
    }
</style>
<div class="wrap">
  <div class="tabmenu">
    <?php include template('layout/submenu');?>
  </div>

  <div class="alert alert-success">
    <h4>操作提示：</h4>
    <ul>
      <li>1.可以领取优惠券或者请输入已获得的优惠券卡密领取优惠券</li>
      <li>2.领取优惠券后可以在购买商品下单时选择符合使用条件的优惠券抵扣订单金额</li>
    </ul>
  </div>
<div id="main">
           
                        
    <!--右侧-->
    <div id="mian_right">
        <div id="mian_tab">
            <div id="My_collect">
                <?php if(!empty($output['voucher_template']) && is_array($output['voucher_template'])){ $i = 0; ?>
                <div id="collect_goods">
                    <ul>
                    <?php foreach($output['voucher_template'] as $key=>$val){$i++;?>
                        <li style="height:330px;" id="<?php echo $val['voucher_t_id'];?>">
                            <div class="goods-thum">
                                <img src="<?php echo $val['voucher_t_customimg'];?>"  style="width:202px;height:208px;"/>
                            </div>
                            <div class="goods_info">
                                <p class="voucher_price"><?php echo $lang['currency'];?><em><?php echo $val['voucher_t_price'];?></em></p>
                                <p class="voucher_desc">
                                  <?php if ($val['voucher_t_limit'] > 0){?>
                                  购物满<?php echo $val['voucher_t_limit'];?>元可用
                                  <?php } else { ?>
                                  无限额代金券
                                  <?php } ?>
                                </p>
                                <p class="voucher_time">
                                  有效期至<?php echo @date('Y-m-d',$val['voucher_t_end_date']);?>
                                </p>
                                <p class="voucher_num">
                                <?php echo $val['voucher_t_giveout'];?>人兑换
                                <?php if ($val['voucher_t_mgradelimit'] > 0){ ?>
                                    <?php echo $val['voucher_t_mgradelimittext'];?>
                                <?php } ?>
                                </p>
                                <p class="">
                                <div class="button"><a href="javascript:void(0);" class="getvoucherbtn" classdata-param='{"tid":"<?php echo $val['voucher_t_id'];?>"}' class="ncbtn ncbtn-grapefruit"  data-gid="<?php echo $val['voucher_t_id'];?>">确认领取</a></div>
                                </p>
                            </div>
                            

                        </li>
                    <?php }?>
                    </ul>
                </div>  
                 <?php }else{?>
  <div class="warning-option"><i>&nbsp;</i><span><?php echo $lang['no_record'];?></span></div>
  <?php }?>
                                <div class="pagination"><?php echo $output['show_page'];?></div>
                            
                        </div>
        </div>
</div> 



    <!-- S 加入购物车弹出提示框 -->

                <div id="alert" style="display:none;">
                    <div class="alert_head">
                        <a href="javascript:;" id="close"></a>              
                    </div>
                    <div class="suc">领取成功</div>
                    <div class="a_btn">
                        
                        <a href="javascript:void(0);" onClick="$('#alert').css({'display':'none'});">继续购物</a>
                        <a href="member/index.php?model=member_voucher&fun=index">我的优惠券</a>
                    </div>
                    
                </div>





 
  <div class="ncm-default-form">
    <form method="post" id="bind_form" action="<?php echo MEMBER_SITE_URL;?>/index.php?model=member_voucher&fun=voucher_binding">
      <input type="hidden" name="form_submit" value="ok" />
      <input name="nchash" type="hidden" value="<?php echo getNchash();?>" />
      <dl style="overflow: visible;">
        <dt><i class="required">*</i>请输入优惠券卡密：</dt>
        <dd>
            <div class="parentCls">
                <input type="text" class="inputElem text w160" value="" name="pwd_code" id="pwd_code" autocomplete="off" autofocus="autofocus" maxlength="20"/>
            </div>
            <span class="error_span"></span>
        </dd>
      </dl>
      <dl>
        <dt><i class="required">*</i>验证码：</dt>
        <dd>
            <input type="text" name="captcha" class="text" id="captcha" maxlength="4" size="10" autocomplete="off" />
            <img src="index.php?model=seccode&fun=makecode&nchash=<?php echo getNchash();?>" name="codeimage" border="0" id="codeimage" class="ml5 vm"><a href="javascript:void(0)" class="ml5 blue" onclick="javascript:document.getElementById('codeimage').src='index.php?model=seccode&fun=makecode&nchash=<?php echo getNchash();?>&t=' + Math.random();">看不清？换张图</a>
            <span class="error_span"></span>
        </dd>
      </dl>
      <dl class="bottom">
        <dt>&nbsp;</dt>
        <dd>
          <label class="submit-border">
            <input type="button" class="submit" id="submitbtn" value="确认，进入下一步" style="background-color:#c1b497;
"/>
          </label>
        </dd>
      </dl>
    </form>
  </div>
</div>

<script src="<?php echo RESOURCE_SITE_URL;?>/js/input_max.js"></script>
<script type="text/javascript">
//input内容放大
$(function(){
    new TextMagnifier({
        inputElem: '.inputElem',
        align: 'top',
        splitType :[5,5,5,5]
    });
});
// var submiting = false;
$(function(){

    
    $("#close").click(function(){
        $('#alert').hide();
    });
    $(".getvoucherbtn").click(function(){
        // alert('dfdsfsd');
        var id = $(this).data('gid');
        // var url = "<?php echo urlShop('voucher','getvouchersave');?>";
        var url = "index.php?model=member_voucher&fun=getvouchersave";
        // console.log(url);
        // ajaxget(url+'&tid='+id);
        // 
        $.getJSON(url, {'tid':id}, function(data){
            if (data.state)
            {
                // $('#alert').show();
                alert('领取成功');
                // showDialog(data.msg, 'succ','','','','','','','','',2);
                // if(jstype == 'count'){
                //     $('[nctype="'+jsobj+'"]').each(function(){
                //         $(this).html(parseInt($(this).text())+1);
                //     });
                // }
                // if(jstype == 'succ'){
                //     $('[nctype="'+jsobj+'"]').each(function(){
                //         $(this).html("收藏成功");
                //     });
                // }
            }else{
                alert(data.msg);
                // $('#alert').show();
                // $('#alert .suc').html('领取失败');
                // $('#alert .a_btn').html(data.msg,);
                // showDialog(data.msg, 'notice');
            }
        });
        // ajaxget('index.php?model=voucher&fun=getvouchersave&tid='+id);
    });
	$('.submit').on('click',function(){
        // if (submiting) {
        //     return false;
        // }
		if (!$('#bind_form').valid()){
			document.getElementById('codeimage').src='index.php?model=seccode&fun=makecode&nchash=<?php echo getNchash();?>&t=' + Math.random();
		} else {
            // submiting = true;
            // ajaxpost('bind_form', '', '', 'onerror',$(this));
            var datas=$('#bind_form').serialize();
            var url = '<?php echo MEMBER_SITE_URL;?>/index.php?model=member_voucher&fun=voucher_binding';
            $.post(url,datas,function(data){
                if (data.state){
                   alert('领取成功'); 
                   setTimeout(function(){
                        window.location.href = '<?php echo MEMBER_SITE_URL;?>/index.php?model=member_voucher&fun=voucher_list';
                    }, 2000);
                }else{
                    alert(data.msg);
                    document.getElementById('codeimage').src='index.php?model=seccode&fun=makecode&nchash=<?php echo getNchash();?>&t=' + Math.random();
                }
            },'json');
		}
	});

    $('#bind_form').validate({
        errorPlacement: function(error, element){
            element.closest('dd').find('.error_span').append(error);
        },
        rules : {
        	pwd_code : {
                required : true
            },
            captcha : {
                required : true,
                minlength: 4,
                remote   : {
                    url : 'index.php?model=seccode&fun=check&nchash=<?php echo getNchash();?>',
                    type: 'get',
                    async: false,
                    data:{
                        captcha : function(){
                            return $('#captcha').val();
                        }
                    }
                }
            }
        },
        messages : {
            pwd_code : {
                required : '<i class="icon-exclamation-sign"></i>请输入优惠券卡密'
            },
            captcha : {
                required : '<i class="icon-exclamation-sign"></i>请正确输入图形验证码',
                minlength: '<i class="icon-exclamation-sign"></i>请正确输入图形验证码',
				remote	 : '<i class="icon-exclamation-sign"></i>请正确输入图形验证码'
            }
        }
    });
});
</script> 
