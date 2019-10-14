var key = getCookie('key');
var password,rcb_pay,pd_pay,payment_code;
 // 现在支付方式
 function toPay(pay_sn,act,op,paycode='') {
    // alert('11111111111');
     $.ajax({
         type:'post',
         url:ApiUrl+'/index.php?model='+act+'&fun='+op,
         data:{
             key:key,
             pay_sn:pay_sn
             },
         dataType:'json',
         // error: function(result){
         //    alert(JSON.stringify(result));
             
         // },
         success: function(result){
             checkLogin(result.login);
             if (result.datas.error) {
                 $.sDialog({
                     skin:"red",
                     content:result.datas.error,
                     okBtn:false,
                     cancelBtn:false
                 });
                 return false;
             }
             
             // 从下到上动态显示隐藏内容
             // $.animationUp({valve:'',scroll:''});
             
             // // 需要支付金额
             // $('#onlineTotal').html(result.datas.pay_info.pay_amount);
             
             // 是否设置支付密码
             if (!result.datas.pay_info.member_paypwd) {
                 $('#wrapperPaymentPassword').find('.input-box-help').show();
             }
             
             // 支付密码标记
             var _use_password = false;
             if (parseFloat(result.datas.pay_info.payed_amount) <= 0) {
                 if (parseFloat(result.datas.pay_info.member_available_pd) == 0 && parseFloat(result.datas.pay_info.member_available_rcb) == 0) {
                     $('#internalPay').hide();
                 } else {
                     $('#internalPay').show();
                     // 充值卡
                     if (parseFloat(result.datas.pay_info.member_available_rcb) != 0) {
                         $('#wrapperUseRCBpay').show();
                         $('#availableRcBalance').html(parseFloat(result.datas.pay_info.member_available_rcb).toFixed(2));
                     } else {
                         $('#wrapperUseRCBpay').hide();
                     }
                     
                     // 预存款
                     if (parseFloat(result.datas.pay_info.member_available_pd) != 0) {
                         $('#wrapperUsePDpy').show();
                         $('#availablePredeposit').html(parseFloat(result.datas.pay_info.member_available_pd).toFixed(2));
                     } else {
                         $('#wrapperUsePDpy').hide();
                     }
                 }
             } else {
                 $('#internalPay').hide();
             }
             
             password = '';
             $('#paymentPassword').on('change', function(){
                 password = $(this).val();
             });
            
             rcb_pay = 0;
             $('#useRCBpay').click(function(){
                 if ($(this).prop('checked')) {
                     _use_password = true;
                     $('#wrapperPaymentPassword').show();
                     rcb_pay = 1;
                 } else {
                     if (pd_pay == 1) {
                         _use_password = true;
                         $('#wrapperPaymentPassword').show();
                     } else {
                         _use_password = false;
                         $('#wrapperPaymentPassword').hide();
                     }
                     rcb_pay = 0;
                 }
             });

             pd_pay = 0;
             $('#usePDpy').click(function(){
                 if ($(this).prop('checked')) {
                     _use_password = true;
                     $('#wrapperPaymentPassword').show();
                     pd_pay = 1;
                 } else {
                     if (rcb_pay == 1) {
                         _use_password = true;
                         $('#wrapperPaymentPassword').show();
                     } else {
                         _use_password = false;
                         $('#wrapperPaymentPassword').hide();
                     }
                     pd_pay = 0;
                 }
             });

             payment_code = '';
             if (!$.isEmptyObject(result.datas.pay_info.payment_list)) {
                 var readytoWXPay = false;
                 var readytoAliPay = false;
                 var m = navigator.userAgent.match(/MicroMessenger\/(\d+)\./);
                 if (parseInt(m && m[1] || 0) >= 5) {
                     // 微信内浏览器
                     readytoWXPay = true;
                 } else {
                     readytoAliPay = true;
                 }
                 for (var i=0; i<result.datas.pay_info.payment_list.length; i++) {
                    var _payment_code = result.datas.pay_info.payment_list[i].payment_code;
                    if (_payment_code == 'alipay' && readytoAliPay) {
                            // $('#'+ _payment_code).parents('label').show();
                        $('#payment-online').show();
                        $('#pay_sel a').attr('data-wcg');
                        if (payment_code == '') {
                            payment_code = _payment_code;
                            // $('#alipay_way').addClass('che_cur');
                            // $('#'+_payment_code).attr('checked', true).parents('label').addClass('checked');
                        }
                     }
                     if (_payment_code == 'wxpay_jsapi' && readytoWXPay) {
                         // $('#'+ _payment_code).parents('label').show();
                         $('#payment-offline').show();
                         if (payment_code == '') {
                             payment_code = _payment_code;
                             // $('#wxpay_way').addClass('che_cur');
                             // $('#'+_payment_code).attr('checked', true).parents('label').addClass('checked');
                         }
                     }
                 }
             }

             console.log(paycode,act);

             if(paycode != ''){
                goToPayment(pay_sn,act == 'member_buy' ? 'pay_new' : 'vr_pay_new',paycode);
             }
             
             $('#alipay').click(function(){
                 payment_code = 'alipay';
             });
             
             $('#wxpay_jsapi').click(function(){
                 payment_code = 'wxpay_jsapi';
             });

             $('#toPay').click(function(){
                 if (payment_code == '') {
                     $.sDialog({
                         skin:"red",
                         content:'请选择支付方式',
                         okBtn:false,
                         cancelBtn:false
                     });
                     return false;
                 }
                 if (_use_password) {
                     // 验证支付密码是否填写
                     if (password == '') {
                         $.sDialog({
                             skin:"red",
                             content:'请填写支付密码',
                             okBtn:false,
                             cancelBtn:false
                         });
                         return false;
                     }
                     // 验证支付密码是否正确
                     $.ajax({
                         type:'post',
                         url:ApiUrl+'/index.php?model=member_buy&fun=check_pd_pwd',
                         dataType:'json',
                         data:{key:key,password:password},
                         success:function(result){
                             if (result.datas.error) {
                                 $.sDialog({
                                     skin:"red",
                                     content:result.datas.error,
                                     okBtn:false,
                                     cancelBtn:false
                                 });
                                 return false;
                             }
                             goToPayment(pay_sn,act == 'member_buy' ? 'pay_new' : 'vr_pay_new');
                         }
                     });
                 } else {
                	 goToPayment(pay_sn,act == 'member_buy' ? 'pay_new' : 'vr_pay_new');
                 }
             });
         }
     });
 }

 function goToPayment(pay_sn,op,pay_code) {
    if(pay_code != ''){
        payment_code = pay_code;
    }
     location.href = ApiUrl+'/index.php?model=member_payment&fun='+op+'&key=' + key + '&pay_sn=' + pay_sn + '&password=' + password + '&rcb_pay=' + rcb_pay + '&pd_pay=' + pd_pay + '&payment_code=' + payment_code;
 }
