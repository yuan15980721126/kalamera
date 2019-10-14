$(function(){
    var key = getCookie('key');
    if(!key){
        location.href = 'login.html';
    }
    template.helper('isEmpty', function(o) {
        for (var i in o) {
            return false;
        }
        return true;
    });

 $.ajax({
     type: 'post',
     url: ApiUrl+'/index.php?model=member_message&fun=systemmsg',
     data: {key:key},
     dataType:'json',
     success: function(result){
     	// console.log(result);
        checkLogin(result.login);
        var data = result.datas;
         // console.log(data);
         //渲染模板
        var html = template.render('messageListScript', data);              
        $("#messageList").html(html);
       
         
        $('.del_mes').click(function(){

            var mes_id = $(this).attr('id');
            var message_id = mes_id.substring(4);
            // console.log(mes_id);
            $.ajax({
                 type: 'get',
                 url: ApiUrl+'/index.php?model=member_message&fun=dropcommonmsg',
                 data: {key:key,message_id:message_id,drop_type:'sns_msg'},
                 dataType:'json',
                 success: function(result){
                        // console.log(result);
                        if (result.code == 200) {
                            location.reload();
                        } else {
                            $.sDialog({
                                skin:"red",
                                content:result.datas.error,
                                okBtn:false,
                                cancelBtn:false
                            });
                            return false;
                        }
                     
                 }
              
                    
            })
        });



        $('#del_all').click(function(){

            var flag=false;
            $.each($(".mes_cha"),function(){
                if($(this).hasClass("chk")){
                    flag=true;
                }
            })

            if(!flag){
                $.sDialog({
                    skin:"red",
                    content:'请选择需要操作的记录',
                    okBtn:false,
                    cancelBtn:false
                });
                // console.log(1)

                return false;
            }


            if(confirm("确定要全部删除消息吗？")){
                // var mes_id = $(this).attr('id');
                // var message_id = mes_id.substring(4);
                var items = '';
                $.each($(".mes_cha"),function(){
                    if($(this).hasClass("chk")){
                        var val = $(this).children(".checkitem").val();
                        // console.log(va)
                        items += val + ',';
                    }
                });
                items = items.substr(0, (items.length - 1));
                // console.log(items); return false;
                $.ajax({
                     type: 'get',
                     url: ApiUrl+'/index.php?model=member_message&fun=dropbatchmsg',
                     data: {key:key,message_id:items,drop_type:'msg_system'},
                     dataType:'json',
                     success: function(result){
                            // console.log(result);
                            if (result.code == 200) {
                                location.reload();
                            } else {
                                $.sDialog({
                                    skin:"red",
                                    content:result.datas.error,
                                    okBtn:false,
                                    cancelBtn:false
                                });
                                return false;
                            }
                         
                     }
                  
                        
                })
            }
        });
     }
 });


/* 全选 */


// $("#messageList").on("click",".del_mes",function(){
    

//     var mes_id = $(this).attr('id');
//     var message_id = mes_id.substring(4);
//     console.log(mes_id);
//     $.ajax({
//      type: 'get',
//      url: ApiUrl+'/index.php?model=member_message&fun=dropcommonmsg',
//      data: {key:key,message_id:message_id,drop_type:'sns_msg'},
//      dataType:'json',
//      success: function(result){
//          checkLogin(result.login);
//          var data = result.datas;
//          console.log(data);
//          //渲染模板
        
   
         
//          $('.msg-list-del').click(function(){
//              var t_id = $(this).attr('t_id');
//              $.ajax({
//                  type: 'post',
//                  url: ApiUrl+'/index.php?model=member_chat&fun=del_msg',
//                  data: {key:key,t_id:t_id},
//                  dataType:'json',
//                  success: function(result){
//                      if (result.code == 200) {
//                          location.reload();
//                      } else {
//                          $.sDialog({
//                              skin:"red",
//                              content:result.datas.error,
//                              okBtn:false,
//                              cancelBtn:false
//                          });
//                          return false;
//                      }
//                  }
//              });
//          });
//      }
  
        
    // })
});