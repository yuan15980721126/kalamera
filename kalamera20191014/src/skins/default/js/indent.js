$(function(){
	
		$("#b_top").load("../commonhead2.html")
		
		
		$("#z_bottom").load("../bottom.html")
	
	
			$.each($("#info_table li"), function(i,v) {
				if(($(this).index+1)%3==0){
					
					$(this).css("margin-right",0);
				};
				
				
				
				
			});
			$(".biaos").hover(function(){
			$(this).next().show();
		},function(){
			$(this).next().hide();
		})
		
		
			$("#pay_style div").click(function(){
				$("#pay_style div").removeClass("ckeck_pay");
				$(this).addClass("ckeck_pay");
			});
			

			function showindent(){
				if($("#add_inv").prop("checked")==true){
					$("#indent_biao").show();					
				}else{
					$("#indent_biao").hide();
				}
			};

			// $.each($("#info_table li"),function(i,v){
				
			// 	if($(this).hasClass("info_current")){
					
			// 		$(".i_address").eq(i).html("默认地址")
			// 	}
			// })
			$(".ncc-candidate-items").on("click","li",function(){
				$(".ncc-candidate-items li").removeClass("ncc-selected-item");
				$(this).addClass("ncc-selected-item");
				$(".ncc-candidate-items input").prop("checked",false);
				$(this).find("input").prop("checked",true);
					
				showindent();
			})
			
			// $("#info_table").on("click",".i_address",function(){
			// 	$("#info_table li").removeClass("info_current");
			// 		$(this).parent().parent().addClass("info_current")

			// 		$(".i_address").html("设为默认地址")
			// 	if($(this).parent().parent().hasClass("info_current")){
			// 		$(this).html("默认地址")
			// 	};
			// })
			
			
			
			$.each($(".i_address"),function(i,v){
				

				$(this).click(function(){
					var address_id = ($(this).attr('id')).substring(6);
					var node = $(this);
					$.post('index.php?model=buy&fun=edit_default',{address_id:address_id},function(data){
			            if (data.state){
			                // var parent = '#li_'+data.data.address_id;
			                // console.log(node);
			                $("#info_table li").removeClass("info_current");
							$(node).parent().parent().addClass("info_current");

							$(".i_address").html("设为默认地址");
							$("#address_id").val(address_id);
							if($(node).parent().parent().hasClass("info_current")){
								$(".i_address").eq(i).html("默认地址")
							};
			            }else{
			            	alert('默认地址设置失败');
			            }
		            },'json');
					
				})
			});
			
			$("#kai input").click(function(){
				if($("#put").prop("checked")==true){
					$("#fa_type").show();
					$("#fa_nei").show();
					$("#name_d").show();
					
					
				}else{
					$("#name_d").hide();
					$("#fa_type").hide();
					$("#fa_nei").hide();
					
				}
				if($("#ger").prop("checked")==true){
						$("#name_d").hide();
				}else{
					$("#name_d").show();
				}
				
			})
			
			
			
			$("#save_fa").click(function(){
						var tait="";
						var nei=""
				$.each($("#fa_type input"), function() {
					if($(this).prop("checked")==true){
						tait=$(this).val();
					}
				});				
				nei=$("#fa_content").val();
				var stringz="";
				
				stringz='<li class="inv_item"><input content="" id="" nc_type="inv" type="radio" name="inv" value="34"><span for="inv_34">&nbsp;&nbsp;普通发票 '+tait+nei+'</span><a href="javascript:void(0);" class="del">[ 删除 ]</a> </li>'
					$(".ncc-candidate-items").prepend(stringz);
			})
			
			
			
			$("#select_f input").click(function(){
				$("#select_f input").prop("checked",false);
				$(this).prop("checked",true);

				
			});
			
				$.each($(".add_show"),function(i,v){
						
				$(this).click(function(){
					$(".dis_tab").eq(i).toggle();
				});
				}
			);
			
			
			
			
			
			
			
			// $("#info_table").on("click",".i_amend",function(){
			// 	$("#save_harvest").show();
			// });
			
			
			
			
			
		
			// $("#add_close").click(function(){
			// 	$("#save_harvest").hide();
				
			// });
			
			
			$("#addtable").click(function(){
				$("#add_harvest").show();
			});
			
			$("#save_close").click(function(){
				
				$("#add_harvest").hide();
			});
			
			
			$("#add_indent").click(function(){
				
				var name=$("#naem_in").val();
				var address=$("#address_indent").val();
				var pheon=$("#phone_indent").val();
				var biancode=$("#bian_indent").val();
				var newIndemt='<li><div class="info_name">'+name+'</div><div class="info_address">'+address+'</div><div class="info_phone">'+pheon+'</div><div class="info_email">'+biancode+'</div><div class="table_btn"><a class="i_address" href="javascript:;">设为默认设置</a><a class="i_amend" href="javascript:;">修改</a><a class="i_del" href="javascript:;">删除</a></div></li>'
				$("#info_table ul").append(newIndemt);
				$("#add_harvest").hide();
			});
			
			
			
	
})