<?php defined('interMarket') or exit('Access Invalid!');?>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/i18n/zh-CN.js" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/themes/ui-lightness/jquery.ui.css"  />

<link href="/skins/default/css/base.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="/skins/default/css/Servicing.css" type="text/css"/>
<link rel="stylesheet" href="/skins/default/css/servicecommon.css" type="text/css"/>  
<link rel="stylesheet" type="text/css" href="/skins/default/css/information.css"  />


<div id="MemberReg">    


    <div id="mbr">
        <div id="mbr_left"></div>
                
            <div class="mbr_right">
                <div id="Serviving">
                    <div id="Serv_head">
                        报修服务
                    </div>
                        
                    <div id="Serv_content">
                        <div id="_info">
                            <div id="product_info">
                                <div>
                                    产品信息
                                </div>
                                <div id="product_type">
                                    <div class="pro_nub">
                                        <div>产品型号</div>
                                            <div>
                                                <select></select>
                                            </div>
                                        </div>
                                        <div class="pro_gu">
                                            <div>故障型号</div>
                                            <div>
                                                <select></select>
                                            </div>
                                            
                                        </div>
                                        <div class="buy_date">
                                            <div>购买日期</div>
                                            <div>
                                                <input type="text" />
                                            </div>
                                        </div>
                                    </div>
                                    <div id="indent_number">
                                        <div>订单编号</div>
                                            <div>
                                                <input type="text" />
                                            </div>
                                    </div>
                                    
                                    
                                    <div id="product_des">
                                        <div>服务描述</div>
                                        <div>
                                            <textarea></textarea>
                                        </div>
                                        
                                        
                                    </div>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                </div>
                                
                                
                                
                                
                                
                                <!--个人信息-->
                                
                                
                                <div id="information">
                                    <div>
                                        个人信息
                                    </div>
                                    <div id="user_info">
                                        <div class="user_name">
                                            <div>用户姓名</div>
                                            <div>
                                                <input type="text" />
                                            </div>
                                            
                                        </div>
                                        
                                        
                                        <div class="user_phone">
                                            <div>联系电话</div>
                                            <div>
                                                <input type="text" />
                                            </div>
                                            
                                        </div>
                                        
                                        
                                        
                                        <div class="user_email">
                                            <div>电子邮箱</div>
                                            <div>
                                                <input type="text" />
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div id="address_">
                                        <div>所在地址</div> 
                                        <div id="zjy">
                                <div id="curret_address"><?php echo $output['address_info']['area_info'];?></div>
                                <div id="huan">编辑地址</div>
                            </div>                                    
                                        <div>
                                            <input type="hidden" name="city_id" class="_area_2" value="<?php echo $output['address_info']['city_id'];?>"/>
                                            <input type="hidden" name="area_id" class="_area" value="<?php echo $output['address_info']['area_id'];?>"/>
                                            <div id="sqs" style="display:none";>
                                                <input name="region" type="hidden" id="region" >
                                                <input type="hidden" name="city_id" id="_area_2" />
                                                <input type="hidden" name="area_id" id="_area" />
                                            </div>
                                      
                                            
                                        </div>
                                    </div>
                                    
                                    <!--详细地址-->
                                    
                                    
                                    <div id="detailed">
                                        <span>详细通讯地区</span> 
                                        <input type="text" />                               
                                    </div>
                                     
                                     
                                     <!--验证码-->
                                     
                                     <div id="validate">
                                        <div>验证码</div>
                                        <div>
                                            <input type="text" placeholder="验证码"  class="in_ma txtVerification" id="Txtidcode" />
                                        </div>
                                        <span id="idcode"></span>                                       
                                        
                                     </div>
                                     
                                     
                                     
                                     <div>
                                        
                                        <div id="sub_">提交</div>
                                        <div id="reset_">重置</div>
                                        
                                     </div>
                                    
                                    
                                    
                                </div>
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                            </div>
                            
                            
                            
                            
                            
                        </div>
                        
                        
                        
                    </div>
                    
                    
                    
                    
                    
                    
                </div>
                
                
                
                
                
                
                
            













        
        </div>  


</div>







<script type="text/javascript">
$(document).ready(function(){
    $('#huan').click(function(){
    $('#zjy').hide();
    $('#sqs').show();
    $('._area_2').remove();
    $('._area').remove();
})
    $("#region").nc_region();
    $('#addr_form1').validate({
        // errorPlacement: function(error, element){
        //     // var error_td = element.parent('dd');
        //     console.log(error[0].innerText);
        //     // var text = error[0].innerText;
        //     // var msg = $( element ).parent().next();
        //     // msg.text(text);
        //     // msg.show();
        //     // window.t=$( element )
            
        // },
        // success:function(label) {
        //     $("#save_harvest").hide();
        //    return false;

        // },
        // submitHandler: function(form) { //验证成功时调用
        //      console.log(label);
        //     $("#save_harvest").hide();
        // },
        rules : {
            true_name1 : {
                required : true
            },
            region : {
                checklast: true
            },
            address1 : {
                required : true
            },
            mob_phone1 : {
                required : checkPhone,
                minlength : 11,
                maxlength : 11,
                digits : true
            }
    //         tel_phone1 : {
    //             required : checkPhone,
    //             minlength : 6,
                // maxlength : 20
    //         }
        },
        messages : {
            true_name1 : {
                required : '<i class="icon-exclamation-sign"></i><?php echo $lang['cart_step1_input_receiver'];?>'
            },
            region : {
                checklast: '<i class="icon-exclamation-sign"></i>请将地区选择完整'
            },
            address1 : {
                required : '<i class="icon-exclamation-sign"></i><?php echo $lang['cart_step1_input_address'];?>'
            },
            mob_phone1: {
                required : '<i class="icon-exclamation-sign"></i>手机号码不能为空',
                minlength: '<i class="icon-exclamation-sign"></i><?php echo $lang['cart_step1_mobile_num_error'];?>',
                maxlength: '<i class="icon-exclamation-sign"></i><?php echo $lang['cart_step1_mobile_num_error'];?>',
                digits : '<i class="icon-exclamation-sign"></i><?php echo $lang['cart_step1_mobile_num_error'];?>'
            }
    //         tel_phone : {
    //             required : '<i class="icon-exclamation-sign"></i><?php echo $lang['cart_step1_telphoneormobile'];?>',
    //             minlength: '<i class="icon-exclamation-sign"></i><?php echo $lang['member_address_phone_rule'];?>',
                // maxlength: '<i class="icon-exclamation-sign"></i><?php echo $lang['member_address_phone_rule'];?>'
    //         }
        },
        groups : {
            phone:'mob_phone tel_phone'
        }
    });
    $("#region2").nc_region();
    $('#addr_form2').validate({
        // errorPlacement: function(error, element){
        //     // var error_td = element.parent('dd');
        //     console.log(error[0].innerText);
        //     // var text = error[0].innerText;
        //     // var msg = $( element ).parent().next();
        //     // msg.text(text);
        //     // msg.show();
        //     // window.t=$( element )
            
        // },
        // success:function(label) {
        //     $("#save_harvest").hide();
        //    return false;

        // },
        // submitHandler: function(form) { //验证成功时调用
        //      console.log(label);
        //     $("#save_harvest").hide();
        // },
        rules : {
            true_name2 : {
                required : true
            },
            region2 : {
                checklast: true
            },
            address2 : {
                required : true
            },
            mob_phone2 : {
                required : checkPhone2,
                minlength : 11,
                maxlength : 11,
                digits : true
            }
    //         tel_phone1 : {
    //             required : checkPhone,
    //             minlength : 6,
                // maxlength : 20
    //         }
        },
        messages : {
            true_name2 : {
                required : '<i class="icon-exclamation-sign"></i><?php echo $lang['cart_step1_input_receiver'];?>'
            },
            region2 : {
                checklast: '<i class="icon-exclamation-sign"></i>请将地区选择完整'
            },
            address2 : {
                required : '<i class="icon-exclamation-sign"></i><?php echo $lang['cart_step1_input_address'];?>'
            },
            mob_phone2: {
                required : '<i class="icon-exclamation-sign"></i>手机号码不能为空',
                minlength: '<i class="icon-exclamation-sign"></i><?php echo $lang['cart_step1_mobile_num_error'];?>',
                maxlength: '<i class="icon-exclamation-sign"></i><?php echo $lang['cart_step1_mobile_num_error'];?>',
                digits : '<i class="icon-exclamation-sign"></i><?php echo $lang['cart_step1_mobile_num_error'];?>'
            }
    //         tel_phone : {
    //             required : '<i class="icon-exclamation-sign"></i><?php echo $lang['cart_step1_telphoneormobile'];?>',
    //             minlength: '<i class="icon-exclamation-sign"></i><?php echo $lang['member_address_phone_rule'];?>',
                // maxlength: '<i class="icon-exclamation-sign"></i><?php echo $lang['member_address_phone_rule'];?>'
    //         }
        },
        groups : {
            phone:'mob_phone tel_phone'
        }
    });
});
</script>