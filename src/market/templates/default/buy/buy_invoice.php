<?php defined('interMarket') or exit('Access Invalid!');?>


<div class="user_dis">
    <div class="d_head">
        <div class="add_show" id="edit_invoice"></div>
        <div>发票信息<span>(温馨提示：发票的开票金额不包括使用优惠券支付部分)</span></div>
    </div>
    <div class="dis_tab" id="invoice_tab">
        
    </div>
    </div>
                        
                        
                        
                        
                        
</div>





<!-- <div class="ncc-receipt-info"><div class="ncc-receipt-info-title">
  <h3>发票信息</h3>
  <a href="javascript:void(0)" nc_type="buy_edit" id="edit_invoice2">[修改]</a></div>
  <div id="invoice_list" class="ncc-candidate-items">
    <ul>
      <li><?php echo $output['inv_info']['content'];?></li>
    </ul>
  </div>
</div> -->
<script type="text/javascript">
//隐藏发票列表
// function hideInvList(content) {
//     $('#edit_invoice').show();
// 	$("#invoice_list").html('<ul><li>'+content+'</li></ul>');
// 	$('.current_box').removeClass('current_box');
// 	ableOtherEdit();
// 	//重新定位到顶部
// 	$("html, body").animate({ scrollTop: 0 }, 0);
// }
//加载发票列表
$('#edit_invoice').on('click',function(){
    // $(this).hide();
    
    // disableOtherEdit('如需修改，请先保存发票信息');
    // $(this).parent().parent().addClass('current_box');
    $('#invoice_tab').load(SITEURL+'/index.php?model=buy&fun=load_inv&vat_hash=<?php echo $output['vat_hash'];?>');
    // $(".dis_tab").eq(i).toggle();
});


//隐藏发票列表
function hideInvList(content) {
    // $('.d_head').show();
  $("#invoice_list").html('<ul><li>'+content+'</li></ul>');
  // $('.current_box').removeClass('current_box');
  ableOtherEdit();
  //重新定位到顶部
  // $("html, body").animate({ scrollTop: 0 }, 0);
}
//加载发票列表
// $('.d_head').on('click',function(){
//     $(this).hide();
//     disableOtherEdit('如需修改，请先保存发票信息');
//     // $(this).parent().parent().addClass('current_box');
//     $('#fa_info').load(SITEURL+'/index.php?model=buy&fun=load_inv&vat_hash=<?php echo $output['vat_hash'];?>');
// });

</script>