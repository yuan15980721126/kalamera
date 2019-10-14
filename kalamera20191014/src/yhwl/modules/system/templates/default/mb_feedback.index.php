<?php defined('interMarket') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <div class="subject">
        <h3><?php echo $lang['feedback_message_title'];?></h3>
        <h5><?php echo $lang['feedback_message_title_subhead'];?></h5>
      </div>
    </div>
  </div>
  <div class="explanation" id="explanation">
    <div class="title" id="checkZoom"><i class="fa fa-lightbulb-o"></i>
      <h4 title="<?php echo $lang['nc_prompts_title'];?>"><?php echo $lang['nc_prompts'];?></h4>
      <span id="explanationZoom" title="<?php echo $lang['nc_prompts_span'];?>"></span>
    </div>
    <ul>
      <li>来自用户的邮件订阅</li>
    </ul>
  </div>
  <div id="flexigrid"></div>
</div>

<script type="text/javascript">
$(function(){
    $("#flexigrid").flexigrid({
        url: 'index.php?model=mb_feedback&fun=get_xml',
        colModel : [
            {display: '操作', name : 'operation', width : 120, sortable : false, align: 'left', className: 'handle-s'},
            // {display: '留言ID', name : 'id', width : 80, sortable : true, align: 'center'},
            {display: '留言类型', name : 'feedback_type', width : 150, sortable : true, align: 'center'},
            // {display: '留言标题', name : 'title', width : 100, sortable : true, align: 'left'},
            {display: '留言内容', name : 'content', width : 200, sortable : true, align: 'left'},
            {display: '留言时间', name : 'ftime', width : 150, sortable : true, align: 'center'},
            {display: '留言姓名', name : 'true_name', width : 120, sortable : true, align: 'center'},
            {display: '留言邮箱', name : 'email', width : 120, sortable : true, align: 'center'},
            {display: '留言手机号', name : 'mobile', width : 120, sortable : true, align: 'center'},
            {display: '留言会员名称', name : 'member_name', width : 120, sortable : true, align: 'left'},
            // {display: '留言人会员ID', name : 'member_id', width : 80, sortable : true, align: 'left'},
            {display: '回复内容', name : 'feedback_reply', width : 120, sortable : true, align: 'left'},
            {display: '回复时间', name : 'feedback_reply_time', width : 120, sortable : true, align: 'left'},
            {display: '操作回复', name : 'consult', width : 150, sortable : true, align: 'left'}
            ],
        buttons : [
            {display: '<i class="fa fa-trash"></i>批量删除', name : 'del', bclass : 'del', title : '将选定行数据批量删除', onpress : fg_operation }
           ],
        searchitems : [
            {display: '留言内容', name : 'content'},
            {display: '留言会员名称', name : 'member_name'},
            {display: '留言人会员ID', name : 'member_id'}
            ],
        sortname: "id",
        sortorder: "desc",
        title: '留言反馈列表'
    });
});

function fg_operation(name, bDiv) {
    if (name == 'del') {
        if ($('.trSelected', bDiv).length == 0) {
            showError('请选择要操作的数据项！');
        }
        var itemids = new Array();
        $('.trSelected', bDiv).each(function(i){
            itemids[i] = $(this).attr('data-id');
        });

        fg_del(itemids);
    }
}

function fg_del(ids) {
    if (typeof ids == 'number' || typeof ids == 'string') {
        var ids = new Array(ids.toString());
    };
    // console.log(typeof ids)
    // return false;
    id = ids.join(',');
    if(confirm('删除后将不能恢复，确认删除这项吗？')){
        $.getJSON('index.php?model=mb_feedback&fun=del', {id:id}, function(data){
            if (data.state) {
                $("#flexigrid").flexReload();
            } else {
                showError(data.msg)
            }
        });
    }
}
//商品下架
function fg_edit(ids) {
    _uri = "index.php?model=mb_feedback&fun=reply_edit&id=" + ids;
    CUR_DIALOG = ajax_form('reply_edit', '回复留言(游客留言将以发送邮件形式告知)', _uri, 640);
}

</script> 
