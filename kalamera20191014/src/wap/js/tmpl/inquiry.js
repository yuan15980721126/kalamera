$(function(){
	var key = getCookie('key');
	if(!key){
		location.href = 'login.html';
	}
	//渲染list
	$.ajax({
            type:'post',
            url:ApiUrl+'/index.php?model=member_consult&fun=index',
            dataType:'json',
            data:{key:key},
            success:function(result){
                console.log(result);
                var data = result.datas;
                if(result.code==200){
                    //渲染模板
                    
                    var html = template.render('inquiry_list', data);
                    $("#inquiry").html(html);
                    
                }
                
            }
    });
});