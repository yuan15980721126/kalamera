var key = getCookie('key');
// buy_stop2使用变量


// change_address 使用变量
var freight_hash,city_id,area_id
// 其他变量
var area_info;
var goods_id = getQueryString("goods_id");
$(function() {
   

    
    $('#btn_Qu').on('click', '.btn', function(){
        var goods_content = $('#goods_content').val();
        $.ajax({
             url:ApiUrl+"/index.php?model=goods&fun=save_consult",
             type:"post",
             data:{goods_id:goods_id,key:key,goods_content:goods_content,consult_type_id:1},
             dataType:"json",
             success:function(result){
                // console.log(result);
                var data = result.datas;
                if(!data.error){
                  window.location.href = WapSiteUrl+'/tmpl/product_detail.html?goods_id=' + goods_id;
                }else{
                     $.sDialog({
                        skin:"red",
                        content:result.datas.error,
                        okBtn:false,
                        cancelBtn:false
                    });
                }
            }
        });
    });


});
