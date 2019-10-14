$(function(){
    // 发送手机验证码
    var key = getCookie('key');
    if (!key) {
        window.location.href = WapSiteUrl+'/tmpl/member/login.html';
        return;
    }
    function init()
    {

        initServiceId();

    }
    $.ajax({
            type:'get',
            url:ApiUrl+'/index.php?model=member_complain&fun=index',
            dataType:'json',
            data:{key:key},
            success:function(result){
                // console.log(result);
                var data = result.datas;
                if(result.code==200){
                    //渲染模板
                    
                    var html = template.render('lodge_list', data);
                    $("#lodge").html(html);
                }
                
            }
    });
    

    $('#lodge').on('change', '#ServiceId', function(){
 
        var id=$("#ServiceId").val();

        // console.log(id);
        $.ajax({
                type:'get',
                url:ApiUrl+'/index.php?model=member_complain&fun=index',
                dataType:'json',
                data:{key:key,select_complain_state:id},
                success:function(result){
                    console.log(result);
                    var data = result.datas;
                    if(result.code==200){
                        //渲染模板
                        if(data){
                            var html = template.render('lodge_list', data);
                            $("#lodge").html(html);
                        }else{
                            $("#lodge").html('');
                        }
                    }
                    
                }
        });
    });

    
   
    $("#lodge").on("click","#add_lod",function(){
       $("#ze_lod").show();
    })
    // function initServiceId()  
    // {  
    //     var optionsServiceId ="<option value =''></option>";  
    //     data.nType = 'view';  
    //     data.name ='GROUP';  
    //     var serviceId =new Array();  
    //     var serviceName = new Array();  
    //     $.getJSON("/rpt12345/jsp/service/queryData.jsp",data,function(result){  
    //         for(var i=0;i<result.length;i++){  
    //             serviceName=result[i].SERVICENAME;  
    //             serviceId =result[i].SERVICEID;  
    //             optionsServiceId ="<option value=\'"+serviceId+"' >"+serviceName+"</option>";  
    //             $("#"+"<span style="color:#ff0000;">ServiceId</span>").append(optionsServiceId);  
    //         }  
    //     });  
    // }  

    // function getService(){
    //     var serviceId =document.getElementById("ServiceId");
    //     $("#ServiceId").change(function(){ //下拉框改变时取得值
    //         data.ServiceID=document.getElementById('ServiceId').value;

    //         data.nType="view";

    //         response_bar();
    //         response_pie1();
    //         response_pie2();
    //         response_pie3();

    //     });

    // }
    // var mobile = getQueryString("mobile");
    // var email = getQueryString("email");
    // var sec_val = getQueryString("captcha");
    // var sec_key = getQueryString("codekey");
    // // var captcha = getQueryString("captcha");
    //  //加载验证码
    // loadSeccode();
    // $("#refreshcode").bind('click',function(){
    //     loadSeccode();
    // });
    // $('.code-again').hide();
    // $('.code-countdown').show().find('em').html(60);
    //     var times_Countdown = setInterval(function(){
    //     var em = $('.code-countdown').find('em');
    //     var t = parseInt(em.html() - 1);
    //     if (t == 0) {
    //         $('.code-again').show();
    //         $('.code-countdown').hide();
    //         clearInterval(times_Countdown);
    //     } else {
    //         em.html(t); 
    //     }
    // },1000);
    // if(mobile){
    //     $('#usermobile').html(mobile);
    //     // send_sms(mobile, sec_val, sec_key);
    //     $('#again').click(function(){
    //         sec_val = $('#captcha').val();
    //         sec_key = $('#shuffle').val();
    //         send_sms(mobile, sec_val, sec_key);
    //     });
        
    //     $('#find_password_code').click(function(){
    //         if (!$(this).parent().hasClass('ok')) {
    //             return false;
    //         }
    //         var captcha = $('#mobilecode').val();
    //         if (captcha.length == 0) {
    //             errorTipsShow('<p>请填写验证码<p>');
    //         }
    //         check_sms_captcha(mobile, captcha);
    //         return false;
            
    //     });

       
    // }else if(email){
    //     $('#useremail').html(email);
    //     $('#efind_password_code').click(function(){

    //         var auth_code = $('#emailcode').val();
    //         var captcha = $('#captcha').val();
    //         var shuffle = $("#shuffle").val();
           
    //         $.ajax({
    //             type:'post',
    //             url:ApiUrl+"/index.php?model=member_security&fun=modify_password_step3&type=1",
    //             data:{key:key,auth_code:auth_code,captcha:captcha,codekey:shuffle},
    //             dataType:'json',
    //             // beforeSend:function(){ //触发ajax请求开始时执行
    //             //     $('#Email_nextform').removeAttr('onclick');
    //             // },
    //             success:function(result){

    //                 if(result.code == 200){
    //                     $.sDialog({
    //                         skin:"block",
    //                         content:'验证成功',
    //                         okBtn:false,
    //                         cancelBtn:false
    //                     });
                        
    //                     setTimeout(location.href = WapSiteUrl+"/tmpl/member/find_password_password.html?email="+$('#useremail').html()+"&captcha="+captcha+"&codekey="+sec_key,3000);
    //                 }else{
    //                     errorTipsShow('<p>' + result.datas.error + '</p>');
    //                 }
    //             },
    //             // complete: function(){ 
    //             //     $('#Email_nextform').attr('onclick','javascript:void();');
    //             // }
    //         });
    //     });
       
    //     $("#again").click(function(){
    //         $.sValid.init({
    //             rules:{
    //                 captcha: {
    //                     required:true,
    //                     minlength:4
    //                 }
    //             },
    //             messages:{
    //                 captcha: {
    //                     required : "请填写图形验证码",
    //                     minlength : "图形验证码不正确"
    //                 }
    //             },
    //             callback:function (eId,eMsg,eRules){
    //                 if(eId.length >0){
    //                     var errorHtml = "";
    //                     $.map(eMsg,function (idx,item){
    //                         errorHtml += "<p>"+idx+"</p>";
    //                     });
    //                     errorTipsShow(errorHtml);
    //                 }else{
    //                     errorTipsHide();
    //                 }
    //             }
    //         });
    //         if($.sValid()){
    //             var captcha = $.trim($("#captcha").val());
    //             var codekey = $.trim($("#codekey").val());
    //             var shuffle = $.trim($("#shuffle").val());
    //             $.ajax({
    //                 type:'post',
    //                 url:ApiUrl+"/index.php?model=member_security&fun=modify_email_step2",
    //                 data:{key:key,captcha:captcha,codekey:shuffle},
    //                 dataType:'json',
    //                 // beforeSend:function(){ //触发ajax请求开始时执行
    //                 //     $('#send').hide();
    //                 //     // $('#send').removeAttr('onclick');
    //                 // },
    //                 success:function(result){
    //                     if(result.code == 200){
    //                         // alert('fsd');return false;
    //                         $('#again').hide();
    //                         $('.code-countdown').show().find('em').html(result.datas.sms_time);
    //                         $.sDialog({
    //                             skin:"block",
    //                             content:'邮箱验证码已发出',
    //                             okBtn:false,
    //                             cancelBtn:false
    //                         });
    //                         var times_Countdown = setInterval(function(){
    //                             var em = $('.code-countdown').find('em');
    //                             var t = parseInt(em.html() - 1);
    //                             if (t == 0) {
    //                                 $('#again').show();
    //                                 $('.code-countdown').hide();
    //                                 clearInterval(times_Countdown);
    //                                 loadSeccode();
    //                             } else {
    //                                 em.html(t);
    //                             }
    //                         },1000);
    //                     }else{
    //                         loadSeccode();
    //                         errorTipsShow('<p>' + result.datas.error + '</p>');
    //                         $('#captcha').val('');
    //                     }
    //                 }
    //             });
    //         }
    //     });
    // }
});
// 发送手机验证码
function send_sms(mobile, sec_val, sec_key) {
    $.getJSON(ApiUrl+'/index.php?model=connect&fun=get_sms_captcha', {type:3,phone:mobile,sec_val:sec_val,sec_key:sec_key}, function(result){
        if(!result.datas.error){
            $.sDialog({
                skin:"green",
                content:'发送成功',
                okBtn:false,
                cancelBtn:false
            });
            $('.code-again').hide();
            $('.code-countdown').show().find('em').html(result.datas.sms_time);
            var times_Countdown = setInterval(function(){
                var em = $('.code-countdown').find('em');
                var t = parseInt(em.html() - 1);
                if (t == 0) {
                    $('.code-again').show();
                    $('.code-countdown').hide();
                    clearInterval(times_Countdown);
                } else {
                    em.html(t);
                }
            },1000);
        }else{
            loadSeccode();
            errorTipsShow('<p>' + result.datas.error + '<p>');
            setTimeout("history.go(-1);",2000);
        }
    });
}

function check_sms_captcha(mobile, captcha) {
    $.getJSON(ApiUrl + '/index.php?model=connect&fun=check_sms_captcha', {type:3,phone:mobile,captcha:captcha }, function(result){
        if (!result.datas.error) {
            window.location.href = 'find_password_password.html?mobile=' + mobile + '&captcha=' + captcha;
        } else {
            loadSeccode();
            errorTipsShow('<p>' + result.datas.error + '<p>');
        }
    });
}