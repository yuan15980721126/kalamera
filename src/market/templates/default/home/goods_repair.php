<?php defined('interMarket') or exit('Access Invalid!');?>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/i18n/zh-CN.js" charset="utf-8"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui-timepicker-addon/jquery-ui-timepicker-addon.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/themes/ui-lightness/jquery.ui.css"  />

<link href="/skins/default/css/base.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="/skins/default/css/Servicing.css" type="text/css"/>
<link rel="stylesheet" href="/skins/default/css/servicecommon.css" type="text/css"/>  
<link rel="stylesheet" type="text/css" href="/skins/default/css/information.css"  />
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui-timepicker-addon/jquery-ui-timepicker-addon.min.css"  />


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
                        <form id="login_form" class="nc-login-form" method="post" action=""> 
                            <?php Security::getToken();?>
                            <input type="hidden" name="form_submit" value="ok" />
                            <input name="nchash" type="hidden" value="<?php echo getNchash();?>" />
                            <div id="product_info">
                                <div>
                                    产品信息
                                </div>
                                <div id="product_type" class="clearfix">
                                    <div class="pro_nub re">
                                        <div>产品名称</div>
                                            <div>
                                                 <!-- <input id="xinghao" name="xinghao" type="text" class="text w130"/></em> -->
                                                <?php if(!empty($output['goodsall'])){?>
                                                <select name="goodsname" id="goodsname" >
                                                    <option value=""> 请选择</option>
                                                    <?php foreach ($output['goodsall'] as $k => $v) {?>
                                                        <option value="<?php echo $v['gc_id']?>"> <?php echo $v['gc_name']?></option>
                                                    <?php }?>
                                                </select>
                                                <?php }?>

                                            </div>
                                            <div class="tip_error"></div>
                                        </div>
                                        <div class="pro_gu re">
                                            <div>故障型号</div>
                                            <div>
                                               
                                               <?php if(!empty($output['fenlei'])){?>
                                                <select name="guz_xinghao" id="guz_xinghao" >
                                                    <option value=""> 请选择</option>
                                                    <?php foreach ($output['fenlei'] as $k => $v) {?>
                                                        <option value="<?php echo $v['attr_id']?>"> <?php echo $v['attr_value']?></option>
                                                    <?php }?>
                                                </select>
                                                <?php }?>
                                              <!-- <input type="hidden" id="isxing"> -->
                                            </div>
                                            <div class="tip_error"></div>
                                            
                                        </div>
                                        <div class="buy_date re">
                                            <div>购买日期</div>
                                            <div>
                                                <input id="buytime" name="buytime" type="text" class="text w130"/><em class="add-on"><i class="icon-calendar"></i></em>
                                            </div>
                                            <div class="tip_error"></div>
                                        </div>
                                    </div>
                                    <div id="indent_number" class="clearfix re">
                                        <div>订单编号</div>
                                            <div>
                                                <input type="text" name="order_sn" id="order_sn"/>
                                            </div>
                                            <div class="tip_error"></div>
                                    </div>
                                    
                                    
                                    <div id="product_des" class="jimar re">
                                        <div>服务描述</div>
                                        <div>
                                            <textarea name="desc" id="desc"></textarea>
                                        </div>
                                        <div class="tip_error area_err">dsdfasdas</div>
                                        
                                    </div>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                </div>
                                
                                
                                
                                
                                
                                <!--个人信息-->
                                
                                
                                <div id="information">
                                    <div>
                                        个人信息
                                    </div>
                                    <div id="user_info" style="border:none;">
                                        <div class="user_name re" >
                                            <div>用户姓名</div>
                                            <div>
                                                <input type="text" name="true_name" id="true_name"/>
                                            </div>
                                            <div class="tip_error"></div>
                                        </div>
                                        
                                        
                                        <div class="user_phone re">
                                            <div>联系电话</div>
                                            <div>
                                                <input type="text" name="mobile" id="mobile"/>
                                            </div>
                                            <div class="tip_error"></div>
                                        </div>
                                        
                                        
                                        
                                        <div class="user_email re" >
                                            <div>电子邮箱</div>
                                            <div>
                                                <input type="text" name="email1" id="email1"/>
                                            </div>
                                            <div class="tip_error"></div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div id="address_" class="re">
                                        <div>所在地址</div> 
                                        <div id="zjy">
                                <!-- <div id="curret_address"><?php echo $output['address_info']['area_info'];?></div>
                                <div id="huan">编辑地址</div> -->
                            </div>                                    
                                        <div>
                                            <!-- <input type="hidden" name="city_id" class="_area_2" value="<?php echo $output['address_info']['city_id'];?>"/>
                                            <input type="hidden" name="area_id" class="_area" value="<?php echo $output['address_info']['area_id'];?>"/> -->
                                            <div id="sqs" >
                                                <input name="region" type="hidden" id="region" >
                                                <input type="hidden" name="city_id" id="_area_2" />
                                                <input type="hidden" name="area_id" id="_area" />
                                            </div>
                                            <div class="tip_error"></div>
                                            
                                        </div>
                                    </div>
                                    
                                    <!--详细地址-->
                                    
                                    
                                    <div id="detailed" class="re">
                                        <span>详细通讯地区</span> 
                                        <input type="text" name="address1" id="address1"/>     
                                        <div class="tip_error"></div>                          
                                    </div>
                                     
                                     
                                     <!--验证码-->
                                     
                                     <div id="validate" class="re">
                                        <div>验证码</div>
                                        <div>
                                             <input type="text" id="captcha" id="captcha" name="captcha" maxlength="4" size="10" class="inp" autocomplete="off" placeholder="输入图形验证码" >
                                            <span class="input-del code"></span>
                                            <a class="makecode" href="javascript:void(0)" onclick="javascript:document.getElementById('codeimage').src='index.php?model=seccode&fun=makecode&type=50,120&nchash=<?php echo getNchash();?>&t=' + Math.random();">
                                                <img src="index.php?model=seccode&fun=makecode&type=50,120&nchash=<?php echo getNchash();?>" name="codeimage"id="codeimage">
                                            </a>
                                        </div>
                                        <div class="tip_error"></div>
                                                                          
                                        
                                     </div>
                                     
                                     
                                     
                                     <div>
                                        
                                        <!-- <div id="sub_">提交</div> -->
                                        <input type="button" id="tijiao" value="提交">
                                        <!-- <div id="reset_">重置</div> -->
                                        <input type="reset" id="reset_" value="重置">
                                        
                                     </div>
                                    
                                    
                                    
                                </div>
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                                        
                            
                            
                            
                         </form>  
                         </div>
 
                        </div>
                        
                        
                        
                    </div>
                    
                    
                    
                    
                    
                    
                </div>
                
                
                
                
                
                
                
            













        
        </div>  


</div>







<script type="text/javascript">
$(document).ready(function(){
    var SiteUrl = "https://"+window.location.host+"/market";
    var MemberUrl = "https://"+window.location.host+"/person";

    jQuery.validator.methods.greaterThanDate = function(value, element, param) {
        var date1 = new Date(Date.parse(param.replace(/-/g, "/")));
        var date2 = new Date(Date.parse(value.replace(/-/g, "/")));
        return date1 < date2;
    };
    jQuery.validator.methods.lessThanDate = function(value, element, param) {
        var date1 = new Date(Date.parse(param.replace(/-/g, "/")));
        var date2 = new Date(Date.parse(value.replace(/-/g, "/")));
        return date1 > date2;
    };
    jQuery.validator.methods.greaterThanStartDate = function(value, element) {
        var start_date = $("#start_time").val();
        var date1 = new Date(Date.parse(start_date.replace(/-/g, "/")));
        var date2 = new Date(Date.parse(value.replace(/-/g, "/")));
        return date1 < date2;
    };


    // $("#xinghao").mouseout(function(){
    //     console.log($(this).val());
    //     var data = $(this).val();
    //     if(data){
    //         $.ajax({
    //             type:'post',
    //             url:SiteUrl+"/index.php?model=member_repair&fun=search_goods", 
    //             data:{data:data},
    //             dataType:'json',
    //             async:false,
    //             success:function(result){
    //                 console.log(result);
    //                 var list = result.list;
    //                 var selObj = $("#guz_xinghao");
    //                 if(result.state){
    //                     $("#isxing").val('noxing');
    //                     var value="value";
    //                     var text="text";
                        
    //                     for(var i=0;i<list.length;i++){
    //                         selObj.append("<option value='"+list[i].goods_commonid+"'>"+list[i].goods_name+"</option>");
    //                     }
                        
    //                 }else{
    //                     if(result.code == 10){
    //                         $("#isxing").val('empty');
    //                     }else if(result.code == 12){
    //                         $("#isxing").val('noxing');
    //                     }
                        
    //                     selObj.find("option").remove(); 
    //                 }
                    // checkLogin(result.login);
                    // if(result.datas.address_list==null){
                    //     return false;
                    // }
                    // var data = result.datas;
                    // data.address_id = address_id;
                    // data.freight_hash = freight_hash;
                    // var html = template.render('list-address-add-list-script', data);
                    // $("#list-address-add-list-ul").html(html);
    //             }
    //         });
    //     }
    // })
    $('#huan').click(function(){
    $('#zjy').hide();
    $('#sqs').show();
    $('._area_2').remove();
    $('._area').remove();
})

    $('#buytime').datetimepicker({
        controlType: 'select'
    });
    $("#region").nc_region();



    $('#tijiao').click(function(){
        // console.log(SiteUrl);
        if($("#login_form").valid()){

            // var datas=$('#login_form').serialize();
            var formhash = $('input[name="formhash"]').val();
            var nchash = $('input[name="nchash"]').val();
            
            var goodsname = $('#goodsname').val();
            var guz_xinghao = $('#guz_xinghao').val();
            var buytime = $('#buytime').val();
            var order_sn = $('#order_sn').val();
            var desc = $('#desc').val();
            var true_name = $('#true_name').val();
            var mobile = $('#mobile').val();

            var email1 = $('#email1').val();
            var address1 = $('#address1').val();
            var region = $('#region').val();


            
            var city_id = $('#_area_2').val();
            var area_id = $('#_area').val();
            
            var captcha = $('#captcha').val();
          
            
            $.ajax({
                type: 'post',
                url: SiteUrl + "/index.php?model=member_repaid&fun=step2",
                dataType: 'json',
                data: {
                    form_submit:'ok',
                    formhash:formhash,
                    nchash:nchash,
                    goodsname:goodsname,
                    guz_xinghao:guz_xinghao,
                    buytime:buytime,
                    order_sn:order_sn,
                    desc:desc,
                    region:region,
                    
                    true_name: true_name,
                    mobile: mobile,
                    email: email1,
                    address1:address1,
                    city_id:city_id,
                    area_id:area_id,
                    captcha: captcha,
                },
                
                beforeSend: function () {
                    // 禁用按钮防止重复提交
                    $("#tijiao").prop( "disabled",true );
                },
                success: function(result) {
                    
                    // console.log(result);
                    if (result.state) {
                        // errorTipsShow("<p>加盟申请提交成功，正在跳转...</p>");
                         alert('商品报修提交成功，正在跳转');
                        // setTimeout("location.href = SiteUrl+'/shop'",3000);
                        setTimeout(function(){
                            window.location.href = SiteUrl ;
                        }, 3000);
                    } else {
                        if(result.msg == '未登录'){
                            setTimeout(function(){
                                window.location.href = MemberUrl + '/index.php?model=login&fun=index';
                            }, 3000);
                            // setTimeout("location.href = SiteUrl+'/member/index.php?model=login&fun=index'",3000);
                            return false;
                        }
                        alert(result.msg);
                        document.getElementById('codeimage').src='index.php?model=seccode&fun=makecode&type=50,120&nchash=<?php echo getNchash();?>&t=' + Math.random();
                    }
                },
                complete: function () {
                    $("#tijiao").prop("disabled",false);
                },
            });
        }
        //  else{
        //     document.getElementById('codeimage').src='index.php?model=seccode&fun=makecode&type=50,120&nchash=<?php echo getNchash();?>&t=' + Math.random();
        //     return false;
        // }
    });
    $('#login_form').validate({
        errorPlacement: function(error, element){
            // var error_td = element.parent('dd');
            
            var con = element.parent().parent().find('.tip_error')
            var text = error[0].innerText;
            // console.log(text);
            con.show().html(text);
            // // var error_td = element.parent('div');
            // // console.log(error_td);
            // error_td.after(error);
            // element.parents('dl:first').addClass('error');
            // var text = error[0].innerText;
            // var msg = $( element ).parent().next();
            // msg.text(text);
            // msg.show();
            // window.t=$( element )
            
        },
        success:function(label,element) {
            // console.log($(element).parent().parent().find('.tip_error'));
            $(element).removeClass('error');
            var con = $(element).parent().parent().find('.tip_error');
            con.hide();

        },
        // submitHandler: function(form) { //验证成功时调用
        //      console.log(label);
        //     $("#save_harvest").hide();
        // },
        rules : {
            goodsname:{
                required : true,
            },
            guz_xinghao:{
                required : true,
            },
            buytime:{
                required : true,
            },
            order_sn:{
                required : true,
            },
            desc:{
                required : true,
            },
            true_name : {
                required : true
            },
            mobile:{
                required : true,
                mobile:true,
            },
            
            email1:{
                required : true,
                email:true,
            },
            region : {
                checklast: true
            },
            address1 : {
                required : true
            },
            captcha : {
                required : true,
            },
        },
        messages : {
            goodsname : {
                required : '请选择产品'
            },
            guz_xinghao : {
                required : '请选择产品型号'
            },
            buytime : {
                required : '请输入购买时间'
            },
            order_sn : {
                required : '请输入订单号',
            },
            desc : {
                required : '请输入描述'
            },
            true_name : {
                required : '请输入联系人姓名'
            },
            mobile : {
                required : '请输入联系人手机号',
                mobile : '手机号码不正确',
            },
            email1:{
                required : '请输入联系人邮箱',
                email:'邮箱地址不正确',
            },
            region : {
                checklast: '请将地区选择完整'
            },
            address1 : {
                required : '请输入联系人详细地址'
            },
            captcha : {
                required : '请输入验证码'
            },
             
        },
        groups : {
            phone:'mob_phone tel_phone'
        }
    });
    
    
});
</script>