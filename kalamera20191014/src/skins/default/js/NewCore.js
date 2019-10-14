$(function(){
	
	
			$("#new_tab>div").on("click",function(){
				
				$("#new_tab>div").removeClass("cur");
				$(this).addClass("cur");
				
				
				$("#New_content li").hide();
				$("#New_content li").eq($(this).index()).show();
				
				
				
				
			})
		
		
		
			$(".check_info").on("click",function(){
				
				$(this).toggleClass("ckbg")	;
				
				
				
			});
			
			
			
			
			$(".xt_tip .all_ck").on("click",function(){
					$(".xt_tip .check_info").addClass("ckbg");	

			})
	
			
			
			
			$(".sc_tip .all_ck").on("click",function(){
				
					$(".sc_tip .check_info").addClass("ckbg");				
			})
	
	// var flag=false;
 //            $.each($(".mes_cha"),function(){
 //                if($(this).hasClass("chk")){
 //                    flag=true;
 //                }
 //            })

 //            if(!flag){
 //                $.sDialog({
 //                    skin:"red",
 //                    content:'请选择需要操作的记录',
 //                    okBtn:false,
 //                    cancelBtn:false
 //                });
 //                // console.log(1)

 //                return false;
 //            }	
})