



	$(function(){
		
		//$("#b_top").load("../commonhead2.html");
				//$("#z_bottom").load("../bottom.html");
		
		
					function total(){
				var total=0;
		$.each($(".nub span"),function(i,v){
		
		total+=parseInt($(this).html());
	});

		$("#total").html(total.toFixed(2));
			};

	

			total();
		
		
		
		
//			底部tab栏
		$(".nav_title>ul>li").on("click",function(){
					$(".nav_title>ul>li").removeClass("t_current");
					$(this).addClass("t_current");
			
					var index=$(this).index();
			$("#nav_content .nav_tab").removeClass("current");
			$("#nav_content .nav_tab").eq(index).addClass("current");
		});

		
		
		
		
		
		
		$(".allcheck").on("click",function(){
			$(".allcheck").prop("checked",$(this).prop("checked"));
			$(".check").prop("checked",$(this).prop("checked"));
				if($(".allcheck").prop("checked")==false){
					$(".r_count").html(1)					
				};

				
				
			$.each($(".r_count"),function(i,v){
				$(".nub span").eq(i).html((parseFloat($(".dan span").eq(i).html())* parseFloat($(".r_count").eq(i).html())).toFixed(2))				
				
				
			});

			total();
	});

		
		
		
		
		
		
		//		购物车物品数量加减
		
		
		

		$.each($(".r_add"),function(i,v){
				$(this).on("click",function(){
				var count=$(".r_count").eq(i).html();  
				count++;
				$(".r_count").eq(i).html(count);

			console.log($(".dan span").eq(i).html())
			console.log($(".r_count").eq(i).html())
			var counts= $(".dan span").eq(i).html()*$(".r_count").eq(i).html();
			counts=counts.toFixed(2)
			$(".nub span").eq(i).html(counts);
				if($(".check").eq(i).prop("checked")){
			total();
				};

				});

		});

		
		$.each($(".r_down"),function(i,v){
				$(this).on("click",function(){
					var count=$(".r_count").eq(i).html(); 
				count--;
				if(count<1){
					count=1;
					
				};
				$(".r_count").eq(i).html(count);
				
					if($(".check").eq(i).prop("checked")){
			console.log($(".dan span").eq(i).html())
			console.log($(".r_count").eq(i).html())
			var counts= $(".dan span").eq(i).html()*$(".r_count").eq(i).html();
			counts=counts.toFixed(2)
			$(".nub span").eq(i).html(counts);
			total();
					
				};

				});

		});

		
		
			
			$.each($(".check"),function(z,c){
		$(this).on("click",function(){
				var flags=true;
		$.each($(".check"),function(i,v){
			
			if($(this).prop("checked")==false){
				flags=false;
			};

			
		});

				$(".allcheck").prop("checked",flags);

			
			if($(this).prop("checked")){
			var count= $(".dan span").eq(z).html()*$(".r_count").eq(z).html();
			count=count.toFixed(2);
			$(".nub span").eq(z).html(count);
					total();
				}else{
					$(".r_count").eq(z).html(1)
					var count= $(".dan span").eq(z).html()*$(".r_count").eq(z).html();
					count=count.toFixed(2);
					$(".nub span").eq(z).html(count);
					total();
					
				};

		});

		});

			
	
	$(".a_btn>a:first-child").click(function(){
		alert(1)
		$("#alert").hide();
	});


})












