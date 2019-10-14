<?php defined('interMarket') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <div class="subject">
        <h3><?php echo $lang['nc_goods_repair'];?></h3>
        <h5><?php echo $lang['jrepair_subhead'];?></h5>
      </div>
      <?php //<?php echo $output['top_link'];?>
      <ul class="tab-base nc-row">
      <li><a class="current" href="index.php?model=store&amp;fun=store_joinin"><span>商品报修申请</span></a></li>
      </ul>
    </div>
  </div>
  <div class="explanation" id="explanation">
    <div class="title" id="checkZoom"><i class="fa fa-lightbulb-o"></i>
      <h4 title="<?php echo $lang['nc_prompts_title'];?>"><?php echo $lang['nc_prompts'];?></h4>
      <span id="explanationZoom" title="<?php echo $lang['nc_prompts_span'];?>"></span> </div>
    <ul>
      <li><?php echo $lang['repaid_help1'];?></li>
    </ul>
  </div>
  <div id="flexigrid"></div>
</div>
<script type="text/javascript">
$(function(){
    $("#flexigrid").flexigrid({
        url: 'index.php?model=repaid&fun=get_joinin_xml',
        colModel : [
            // {display: '操作', name : 'operation', width : 60, sortable : false, align: 'center', className: 'handle-s'},
            // {display: '会员ID', name : 'member_id', width : 40, sortable : true, align: 'center'},
            // {display: '会员账号', name : 'member_name', width : 80, sortable : false, align: 'left'},
            // {display: '店铺等级', name : 'sg_id', width : 80, sortable : true, align: 'left'},
            // {display: '待付款金额(元)', name : 'paying_amount', width : 120, sortable : false, align: 'left'},            
            // {display: '申请状态', name : 'joinin_state', width: 60, sortable : true, align : 'center'},
            // {display: '开店时长', name : 'joinin_year', width: 60, sortable : true, align : 'center'},                        
            // {display: '联系人姓名', name : 'contacts_name', width : 80, sortable : false, align: 'left'},
            // {display: '联系人电话', name : 'contacts_phone', width : 100, sortable : false, align: 'left'},
            // {display: '联系人邮箱', name : 'contacts_email', width : 100, sortable : false, align: 'left'},
            // {display: '公司名称', name : 'company_name', width : 80, sortable : false, align: 'left'},
            // {display: '公司地址', name : 'company_province_id', width : 300, sortable : false, align: 'left'},
            // {display: '公司电话', name : 'company_phone', width : 150, sortable : false, align : 'left'},
            // {display: '员工总数', name : 'company_employee_count', width : 80, sortable : false, align : 'left'},
            // {display: '注册资金', name : 'company_registered_capital', width : 80, sortable : false, align : 'left'}

            {display: '操作', name : 'operation', width : 150, sortable : false, align: 'center', className: 'handle'},
            {display: '申请用户ID', name : 'member_id', width : 120, sortable : true, align: 'center'},
            {display: '申请用户名', name : 'member_name', width : 120, sortable : true, align: 'center'},
            {display: '状态', name : 'state', width : 120, sortable : true, align: 'center'},
            {display: '产品名称', name : 'goods_name', width : 150, sortable : false, align: 'center'},
            {display: '产品型号', name : 'goods_class', width : 120, sortable : true, align: 'left'},
            {display: '订单号', name : 'order_sn', width : 120, sortable : true, align: 'left'},
            {display: '问题描述', name : 'description', width : 120, sortable : true, align: 'left'},

            {display: '申请姓名', name : 'contacts_name', width : 150, sortable : false, align: 'center'},
            {display: '申请手机', name : 'contacts_phone', width : 120, sortable : false, align: 'left'},
            {display: '申请邮箱', name : 'contacts_email', width : 150, sortable : true, align: 'left'},   
            {display: '联系地址', name : 'member_areainfo', width : 150, sortable : false, align: 'left'},           
            {display: '申请时间', name : 'add_time', width: 150, sortable : false, align : 'center'},        
            ],
            buttons : [
                {display: '<i class="fa fa-trash"></i>批量删除', name : 'delete', bclass : 'del', title : '将选定行数据批量删除', onpress : fg_operate }
            ],
        searchitems : [
            // {display: '会员ID', name : 'member_id', isdefault: true},
            // {display: '会员账号', name : 'member_name'},
            // {display: '店铺等级', name : 'sg_id'}

             {display: '申请姓名', name : 'contacts_name', isdefault: true},
            {display: '申请手机', name : 'contacts_phone'},
            ],
        sortname: "joinin_state",
        sortorder: "asc",
        // title: '开店申请列表'
        title: '留言列表'
    });
});

function test(name, bDiv) {
    if (name == 'excel') {
        confirm('Delete ' + $('.trSelected', bDiv).length + ' items?')
    } else if (name == 'Add') {
        alert('Add New Item');
    }
}
function fg_operate(name, grid) {
        if (name == 'delete') {
            if($('.trSelected',grid).length>0){
                var itemlist = new Array();
        $('.trSelected',grid).each(function(){
          itemlist.push($(this).attr('data-id'));
        });
                fg_cancel(itemlist);
            } else {
                return false;
            }
        }
}


function fg_cancel(id) {
  // console.log(id);
  if (typeof id == 'number') {
      var id = new Array(id.toString());
  };
  if(confirm('取消后将不能恢复，确认取消这 ' + id.length + ' 项吗？')){
    id = id.join(',');
  } else {
        return false;
}
  $.ajax({
        type: "GET",
        dataType: "json",
        url: "index.php?model=repaid&fun=delete",
        data: "id="+id,
        success: function(data){
            if (data.state){
                $("#flexigrid").flexReload();
            } else {
              alert(data.msg);
            }
        }
    });
}
</script> 
