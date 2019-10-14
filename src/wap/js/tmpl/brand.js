//v3-b11
$(function(){
	var article_id = getQueryString('article_id')
	
	if (article_id=='') {
    	window.location.href = WapSiteUrl + '/index.html';
    	return;
	}
	else {
		$.ajax({
			url:ApiUrl+"/index.php?model=article&fun=article_show",
			type:'get',
			data:{article_id:article_id},
			jsonp:'callback',
			dataType:'jsonp',
			success:function(result){
				console.log(result);
				var data = result.datas;
				data.WapSiteUrl = WapSiteUrl;
				// var html = template.render('brand', data);				
				$("#content_image").html(result.datas.article_content);
			}
		});
	}	
});