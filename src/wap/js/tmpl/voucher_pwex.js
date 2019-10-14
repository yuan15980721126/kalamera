$(function() {
    var key = getCookie('key');
    if (!key) {
        window.location.href = WapSiteUrl+'/tmpl/member/login.html';
        return;
    }

    //渲染list
    var load_class = new ncScrollLoad();
    load_class.loadInit({
        'url':ApiUrl + '/index.php?model=voucher&fun=voucher_tpl_list',
        'getparam':{'key':key,store_id: 1, gettype: 'free'},
        'tmplid':'voucher-list-tmpl',
        'containerobj':$("#voucher-list"),
        'iIntervalId':true,
        //       'callback':showSpacing,
        'data':{WapSiteUrl:WapSiteUrl}


       
    });
    //替换特定标签
    //$("#header").html($("#header").html().replace(/\{WapSiteUrl\}/g,WapSiteUrl));

    //加载验证码
    loadSeccode();
    $("#refreshcode").bind('click',function(){
        loadSeccode();
    });

    $.sValid.init({
        rules:{
            pwd_code:"required",
            captcha:"required"
        },
        messages:{
            pwd_code:"请填写代金券卡密",
            captcha:"请填写验证码"
        },
        callback:function (eId,eMsg,eRules){
            if(eId.length >0){
                var errorHtml = "";
                $.map(eMsg,function (idx,item){
                    errorHtml += "<p>"+idx+"</p>";
                });
                errorTipsShow(errorHtml);
            }else{
                errorTipsHide();
            }
        }
    });

    $('#saveform').click(function(){
        if (!$(this).parent().hasClass('ok')) {
            return false;
        }
        if($.sValid()){
            var pwd_code = $.trim($("#pwd_code").val());
            var captcha = $.trim($("#captcha").val());
            var codekey = $.trim($("#codekey").val());
            var shuffle = $('#shuffle').val();
            $.ajax({
                type:'post',
                url:ApiUrl+"/index.php?model=member_voucher&fun=voucher_pwex",
                data:{key:key,pwd_code:pwd_code,captcha:captcha,codekey:shuffle},
                dataType:'json',
                success:function(result){
                    if(result.code == 200){
                        location.href = WapSiteUrl+'/tmpl/member/voucher_list.html';
                    }else{
                        loadSeccode();
                        errorTipsShow('<p>' + result.datas.error + '</p>');
                    }
                }
            });
        }
    });


  
    $("#voucher-list").on("click",".juan_bot",function(){
            $(this).toggleClass("infoup");
            $(this).parent().parent().parent().next().toggle();
    });
});
