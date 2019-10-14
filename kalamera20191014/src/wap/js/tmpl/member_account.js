$(function() {
    var key = getCookie('key');
    if (!key) {
        window.location.href = WapSiteUrl+'/tmpl/member/login.html';
        return;
    }
  
    $.ajax({
        type:'get',
        url:ApiUrl+"/index.php?model=member_account&fun=get_mobile_info",
        data:{key:key},
        dataType:'json',
        success:function(result){
            if(result.code == 200){
            	if (result.datas.state) {
            		$('#mobile_link').attr('href','member_mobile_modify.html');
            		$('#mobile_value').html(result.datas.mobile);
            	}
            }else{
            }
        }
    });

    $.ajax({
        type:'get',
        url:ApiUrl+"/index.php?model=member_security&fun=get_email_info",
        data:{key:key},
        dataType:'json',
        success:function(result){
            console.log(result);
            if(result.code == 200){
                if (result.datas.state) {
                    $('#mailpwd_tips').html(result.datas.email);
                } else {
                   
                }
            }
        }
    });
    $.ajax({
        type:'get',
        url:ApiUrl+"/index.php?model=member_account&fun=get_paypwd_info",
        data:{key:key},
        dataType:'json',
        success:function(result){
            if(result.code == 200){
            	if (!result.datas.state) {
            		$('#paypwd_tips').html('未设置');
            	}
            }else{
            }
        }
    });
});