<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/home_cart.css" rel="stylesheet" type="text/css">
<style type="text/css">
.head-search-layout,
.head-user-menu,
.public-nav-layout,
.head-app { display: none !important; }
</style>
<link rel="stylesheet" href="/skins/default/css/indent.css" />

<script type="text/javascript" src="/skins/default/js/indent.js"></script>

<div id="indent">
            <div id="indent_content">
                <div id="indent_head">
                    <div class="indent_title">
                        确认订单信息
                    </div>
                <div id="progress">
                    <ul>
                        <li id="mycar">
                            <div>
                            </div>
                            </li>
                            <li class="pr">
                                <div></div>
                            </li>
                            <li id="affirm">
                                <div></div>
                            </li>
                            <li class="pr">
                                <div></div>
                            </li>
                            <li id="success">
                                <div></div>
                            </li>
                    </ul>
                    <div>
                        <span><?php echo $lang['pointcart_ensure_order'];?></span>
                        <span><?php echo $lang['pointcart_ensure_info'];?></span>
                        <span><?php echo $lang['pointcart_exchange_finish'];?></span>
                    </div>
                    
                </div>
           <div></div>
</div>




<div id="select">

    <!--编辑地址--> 

    <div id="save_harvest">

    </div>  


    <!--新增收货地址-->
    
        <div id="add_harvest">
    </div>

    



    

<form method="post" id="porder_form" name="porder_form" action="index.php?model=pointcart&fun=step2">
    <div class="select_head">选择收货信息</div>
    <div id="info_table">


<?php if(!empty($output['address_list'])) {?>
        <ul id="address_list">
        <?php foreach ($output['address_list'] as $k => $v) {?>
            <li <?php if($v['is_default'] == 1){?>class="info_current"<?php } ?> id="li_<?php echo $v['address_id'];?>">
                <div class="info_name"><?php echo $v['true_name'];?></div>
                <div class="info_address">
                    <?php echo $v['area_info']?><?php echo $v['address'];?>
                </div>
                <div class="info_phone">
                    <?php echo $v['mob_phone'];?>
                </div>
               <div class="info_email">
                     <?php echo $v['zipcode'];?>
                </div>
                <div class="table_btn">
                    <a class="i_address" id="moren_<?php echo $v['address_id'];?>" href="javascript:;" >默认地址</a>
                    <a class="i_amend" href="javascript:;" onclick="edit_address(<?php echo $v['address_id']?>,'save')">修改</a>
                    <a class="i_del" href="javascript:;" onclick="delAddr(<?php echo $v['address_id']?>);">删除</a>
                </div>
                <input type="hidden" value="<?php echo $v['address_id']?>" name="city_id" class="daddress_id" />
                <input type="hidden" value="<?php echo $v['member_id']?>" name="area_id" class="dmember_id" />
            </li>
                
        <?php } ?>


                            
        </ul>
    <?php } ?>
        <input type="hidden" name="city_id" id="_area_2" />
        <input type="hidden" name="area_id" id="_area" />
        <input value="<?php echo $output['address_info']['address_id'];?>" name="address_id" id="address_id" type="hidden">
    </div>
    <a href="javascript:;" id="addtable" onclick="edit_address('add')"></a>
</div>









    <div id="goods_info">
        <div class="goods_head">
            <?php echo $lang['pointcart_step1_goods_info'];?>
        </div>
        <div id="goods_form">
            <div id="thead">
                <div class="goods_name"><?php echo $lang['pointcart_step1_goods_info'];?></div>
                <div class="integral"><?php echo $lang['pointcart_step1_goods_num'];?></div>
                <div class="cost"><?php echo $lang['pointcart_step1_goods_point'];?></div>
                <div class="count">小计</div>
            </div>
            <div id="tbody">
                <?php
                    if(is_array($output['pointprod_arr']['pointprod_list']) and count($output['pointprod_arr']['pointprod_list'])>0) {
                    foreach($output['pointprod_arr']['pointprod_list'] as $val) {
                ?>
                <div class="t_row">
                    <div class="goods_name">
                        <div>
                            <a href="<?php echo urlShop('pointprod', 'pinfo', array('id' => $val['pgoods_id']));?>" class="ncc-goods-thumb" target="_blank"><img src="<?php echo $val['pgoods_image_small']; ?>" alt="<?php echo $val['pgoods_name']; ?>"/></a>
                        </div>
                        <div>
                           <a target="_blank" href="<?php echo urlShop('pointprod', 'pinfo', array('id' => $val['pgoods_id']));?>"><?php echo $val['pgoods_name']; ?></a>
                        </div>
                        <div>
           
                        </div>
                                    
                    </div>
                    <div class="integral">
                        <?php echo $val['quantity']; ?>
                    </div>
                    <div class="cost"><?php echo $val['onepoints']; ?></div>
                            
                    <div class="count"><?php echo $val['onepoints']; ?></div>
                                
                </div>
                <?php } }?>
            </div>
            
                        
                        
            <div id="tfooter">
                <div id="footer_info">
                    <div><span><?php echo count($output['pointprod_arr']['pointprod_list']); ?></span> 件商品</div>
                    <div>
                        <span>所需总积分：</span>
                        <span><?php echo $output['pointprod_arr']['pgoods_pointall']; ?></span>
                    </div>
                              <!--   <div>
                                    <span>配送费：</span>
                                    <span>&yen;0.00</span>
                                </div> -->
                    <div>
                        <span>合计：</span>
                        <span><?php echo $output['pointprod_arr']['pgoods_pointall']; ?></span>
                        </div>
                                
                    </div>
                </div>
                        
                        
                        
                        
                        <!--添加订单备注-->
                <div class="user_dis">
                    <div class="d_head">
                        <div class="add_show"></div>
                            <div>添加订单备注</div>
                        </div>
                        <div class="dis_tab">
                            <div>
                                <div class="serach">
                                    <textarea class="ncc-msg-textarea" value="<?php echo $lang['pointcart_step1_message_advice'];?>" placeholder="选填：对本次交易的说明（建议填写已经和商家达成一致的说明）"onclick="pcart_messageclear(this);" title="选填：对本次交易的说明（建议填写已经和商家达成一致的说明）"  maxlength="150"></textarea>
                                </div>
                                <div class="dis_text">
                                        提示：请勿填写有关支付、收货信息。
                                </div>
                                    
                            </div>
                        </div>
                    </div>

                </div>
                        
                        
                <a id="return_car" href="index.php?model=pointcart">返回购物车</a>
                        
                <div id="z_footer">
                    <div>
                        <div>
                            <div>总积分 :</div>
                            <span><?php echo $output['pointprod_arr']['pgoods_pointall']; ?></span>
                        </div>
                            <!-- <div id="tj_btn">提交订单</div> -->
                        <a id="submitpointorder" href="javascript:void(0);" class="ncc-next-submit ok"><?php echo $lang['pointcart_step1_submit'];?></a>
                    </div>
                            
                </div>
                        
                        
            </div>
                    
                    
                    
                    
        </div>
                
                
                
                
         </div>
                
                    
            
            
            
            
      
    











<!-- 
<div class="wrapper pr">
  
  <div class="ncc-main">-->
    
      
      <!-- 留言start -->
      <!-- <div class="ncc-receipt-info">
        <div class="ncc-receipt-info-title">
          <h3><?php echo $lang['pointcart_step1_chooseprod'];?></h3>
        </div> -->
        
        <!-- 已经选择礼品start -->
        
        <!-- <table class="ncc-table-style">
          <thead>
            <tr>
              <th class="w20"></th>
              <th class="tl" colspan="2"><?php echo $lang['pointcart_step1_goods_info'];?></th>
              <th class="w120"><?php echo $lang['pointcart_step1_goods_num'];?></th>
              <th class="w120"><?php echo $lang['pointcart_step1_goods_point'];?></th>
            </tr>
          </thead>
          <tbody>
            <?php
	  			if(is_array($output['pointprod_arr']['pointprod_list']) and count($output['pointprod_arr']['pointprod_list'])>0) {
				foreach($output['pointprod_arr']['pointprod_list'] as $val) {
			?>
            <tr class="shop-list ">
              <td></td>
              <td class="w100"><a href="<?php echo urlShop('pointprod', 'pinfo', array('id' => $val['pgoods_id']));?>" class="ncc-goods-thumb" target="_blank"><img src="<?php echo $val['pgoods_image_small']; ?>" alt="<?php echo $val['pgoods_name']; ?>"/></a></td>
              <td class="tl"><dl class="ncc-goods-info">
                  <dt><a target="_blank" href="<?php echo urlShop('pointprod', 'pinfo', array('id' => $val['pgoods_id']));?>"><?php echo $val['pgoods_name']; ?></a></dt>
                </dl></td>
              <td><?php echo $val['quantity']; ?></td>
              <td><em class="goods-subtotal"><?php echo $val['onepoints']; ?></em></td>
            </tr>
            <?php } }?>
            <tr>
              <td colspan="20" class="tl"><label><?php echo $lang['pointcart_step1_message'].$lang['nc_colon'];?>
                  <textarea class="ncc-msg-textarea" value="<?php echo $lang['pointcart_step1_message_advice'];?>" placeholder="选填：对本次交易的说明（建议填写已经和商家达成一致的说明）"onclick="pcart_messageclear(this);" title="选填：对本次交易的说明（建议填写已经和商家达成一致的说明）"  maxlength="150"></textarea>
                </label></td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="20"><a href="index.php?model=pointcart" class="ncc-prev-btn"><i class="icon-angle-left"></i><?php echo $lang['pointcart_step1_return_list'];?></a>
                <div class="ncc-all-account"><?php echo $lang['pointcart_cart_allpoints'];?><em><?php echo $output['pointprod_arr']['pgoods_pointall']; ?></em><?php echo $lang['points_unit']; ?></div>
                <a id="submitpointorder" href="javascript:void(0);" class="ncc-next-submit ok"><?php echo $lang['pointcart_step1_submit'];?></a></td>
            </tr>
          </tfoot>
        </table> --> 
        <!-- 已经选择礼品end --> 
      <!--</div>
    </form>
  </div>
</div> -->
<script type="text/javascript">
function delAddr(id){
    // $('#addr_list').load(SITEURL+'/index.php?model=buy&fun=load_addr&ifchain=<?php echo $_GET['ifchain'];?>&id='+id);
    if(confirm("是否确认删除")){
        $.get(SITEURL + '/index.php?model=buy&fun=load_addr', {'id':id,'status':'3'}, function(data){
            if(data.state == 'success') {
                var child = '#li_'+id;
                // console.log(data);
                $('#address_list').children(child).remove();
            } else {
                showDialog('系统出现异常', 'error','','','','','','','','',2);
            }

        },'json');
    }
}
function edit_address(address_id,type) {
   
    if(type == 'save'){
        $('#save_harvest').load(SITEURL+'/index.php?model=buy&fun=edit_addr&status=point&type='+type+'&address_id='+address_id);
        $("#save_harvest").show();
    }else{
        $('#add_harvest').load(SITEURL+'/index.php?model=buy&fun=add_addr&status=point');
        $("#add_harvest").show();
    }
        
}
    function submitAddAddr(){
    // $('#input_chain_id').val('');chain_id = '';
        if ($('#addr_form1').valid()){
            // $('#buy_city_id').val($('#region').fetch('area_id_2'));
            var datas=$('#addr_form1').serialize();
            $.post('index.php',datas,function(data){
                if (data.state){
                    var true_name = $.trim($("#true_name").val());
                    var tel_phone = $.trim($("#tel_phone").val());
                    var mob_phone = $.trim($("#mob_phone").val());
                    var area_info = $.trim($("#region").val());
                    var address = $.trim($("#address").val());
                    // showShippingPrice($('#region').fetch('area_id_2'),$('#region').fetch('area_id'));
                    hideAddrList(data.addr_id,true_name,area_info+'&nbsp;&nbsp;'+address,(mob_phone != '' ? mob_phone : tel_phone));
                }else{
                    alert(data.msg);
                }
            },'json');
        }else{
            return false;
        }
    }
    $('#save_address').on('click',function(){
        // if ($('input[nc_type="addr"]:checked').val() == '0' || $('input[nc_type="addr"]:checked').val() == '-1'){
            submitAddAddr();
        // } else {
            // if ($('input[nc_type="addr"]:checked').size() == 0) {
            //     return false;
            // }
            var city_id = $('input[name="addr"]:checked').attr('city_id');
            var area_id = $('input[name="addr"]:checked').attr('area_id');
            var addr_id = $('input[name="addr"]:checked').val();
            var true_name = $('input[name="addr"]:checked').attr('true_name');
            var address = $('input[name="addr"]:checked').attr('address');
            var phone = $('input[name="addr"]:checked').attr('phone');
            // console.log(city_id,area_id);
            // window.load()
            
    });

	function pcart_messageclear(tt){
		if (!tt.name)
		{
			tt.value = '';
			tt.name = 'pcart_message';
		}
	}

	$("#submitpointorder").click(function(){
		var chooseaddress = parseInt($("#address_id").val());
        // console.log(chooseaddress);
		if(!chooseaddress || chooseaddress <= 0){
			showDialog('请选择收货人地址');
		} else {
			$('#porder_form').submit();
		}
	});
</script> 
