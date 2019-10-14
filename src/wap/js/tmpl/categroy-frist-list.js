$(function() {
    var myScroll;
    $("#header").on('click', '.header-inp', function(){
        location.href = WapSiteUrl + '/tmpl/search.html';
    });
    
    
    $.getJSON(ApiUrl+"/index.php?model=goods_class", function(result){
		var data = result.datas;
		data.WapSiteUrl = WapSiteUrl;
		var html = template.render('category-one', data);
		$("#head_sorting").html(html);
	});
	
	get_brand_recommend();
	$("#head_sorting").on("click",".brand",function(){
		 $(this).next().slideToggle();
		get_brand_recommend();
	})
	
	$('#head_sorting').on('click','.category', function(){
//		console.log($(this).next())
         var _this=$(this); 
         $(this).next().slideToggle();
	    $(this).parent().addClass('selected').siblings().removeClass("selected");
	    var gc_id = $(this).attr('date-id');
	    $.getJSON(ApiUrl + '/index.php?model=goods_class&fun=get_child_all', {gc_id:gc_id}, function(result){
	        var data = result.datas;
            data.WapSiteUrl = WapSiteUrl;
            var html = template.render('category-two', data);
            var inne="";
            for(var i=0;i<data.class_list.length;i++ ){
            	inne+='<li><a href="'+data.WapSiteUrl+'/tmpl/product_list.html?gc_id='+data.class_list[i].gc_id+'">'+data.class_list[i].gc_name+'</a></li>';
            };
            
            
             _this.next().html(inne);
            $('.pre-loading').hide();
	    });
	});

    $('#categroy-cnt').on('click','.brand', function(){
        $('.pre-loading').show();
        get_brand_recommend();
    });
    
});

function get_brand_recommend() {
    $('.category-item').removeClass('selected');
    $('.brand').parent().addClass('selected');
    $.getJSON(ApiUrl + '/index.php?model=brand&fun=recommend_list', function(result){
        var data = result.datas;
        data.WapSiteUrl = WapSiteUrl;
        var html = template.render('brand-one', data);
        $("#p_list").html(html);
        $('.pre-loading').hide();
    });
}








