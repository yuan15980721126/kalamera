$(function(){
    // 商品文件ajax上传
    $('.jsUploadFileBtn').find('input[type="file"]').unbind().bind('change', function(){
        var id = $(this).attr('id');
        ajaxFileUploadFile(id);
    });
    //凸显鼠标触及区域、其余区域半透明显示
    $(".container > div").jfade({
        start_opacity:"1",
        high_opacity:"1",
        low_opacity:".5",
        timing:"200"
    });
    //浮动导航  waypoints.js
    $("#uploadHelp").waypoint(function(event, direction) {
        $(this).parent().toggleClass('sticky', direction === "down");
        event.stopPropagation();
    }); 
    // 关闭相册
    $('a[nctype="close_album"]').click(function(){
        $(this).hide();
        $(this).prev().show();
        $(this).parent().next().html('');
    });
    // 绑定点击事件
    $('div[nctype^="file"]').each(function(){
        if ($(this).prev().find('input[type="hidden"]').val() != '') {
            selectDefaultImage($(this));
        }
    });
});

// 文件上传ajax
function ajaxFileUploadFile(id, o) {
    $('img[nctype="' + id + '"]').attr('src', SHOP_TEMPLATES_URL + "/images/loading.gif");

    $.ajaxFileUpload({
        url : SITEURL + '/index.php?model=store_goods_add&fun=file_upload',
        secureuri : false,
        fileElementId : id,
        dataType : 'json',
        data : {name : id},
        success : function (data, status) {
            if (typeof(data.error) != 'undefined') {
                alert(data.error);
                $('img[nctype="' + id + '"]').attr('src',DEFAULT_GOODS_IMAGE);
            } else {
                $('input[nctype="' + id + '"]').val(data.name);
                $('img[nctype="' + id + '"]').attr('src', data.thumb_name);
            }
            $.getScript(SHOP_RESOURCE_SITE_URL+ '/js/store_goods_add.step3_2.js');
        },
        error : function (data, status, e) {
            alert(e);
            $.getScript(SHOP_RESOURCE_SITE_URL+ '/js/store_goods_add.step3_2.js');
        }
    });
    return false;

}
