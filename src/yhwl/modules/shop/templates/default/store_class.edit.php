<?php defined('interMarket') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title"><a class="back" href="index.php?model=store_class" title="返回列表"><i class="fa fa-arrow-circle-o-left"></i></a>
      <div class="subject">
        <h3><?php echo $lang['store_class'];?></h3>
        <h5><?php echo $lang['store_class_subhead'];?></h5>
      </div>
    </div>
  </div>
  <form id="store_class_form" method="post">
    <input type="hidden" name="form_submit" value="ok" />
    <input type="hidden" name="sc_id" value="<?php echo $output['class_array']['sc_id'];?>" />
    <input type="hidden" name="sc_parent_id" value="<?php echo $output['class_array']['sc_parent_id'];?>" />
    <div class="ncap-form-default">
      <dl class="row">
        <dt class="tit">
          <label class="sc_name"><em>*</em><?php echo $lang['store_class_name'];?></label>
        </dt>
        <dd class="opt">
          <input type="text" value="<?php echo $output['class_array']['sc_name'];?>" name="sc_name" id="sc_name" class="input-txt">
          <span class="err"></span>
          <p class="notic"></p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">
          <label for="sc_name"><em>*</em><?php echo $lang['store_class_bail'];?></label>
        </dt>
        <dd class="opt">
          <input type="text" value="<?php echo $output['class_array']['sc_bail'];?>" name="sc_bail" id="sc_bail" class="input-txt">
          <span class="err"></span>
          <p class="notic"></p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">
          <label for="sc_sort"><?php echo $lang['nc_sort'];?></label>
        </dt>
        <dd class="opt">
          <input type="text" value="<?php echo $output['class_array']['sc_sort'];?>" name="sc_sort" id="sc_sort" class="input-txt">
          <span class="err"></span>
          <p class="notic"><?php echo $lang['update_sort'];?></p>
        </dd>
      </dl>
      <div class="bot"><a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-green" id="submitBtn"><?php echo $lang['nc_submit'];?></a></div>
    </div>
  </form>
</div>
<script>
//按钮先执行验证再提交表单
$(function(){$("#submitBtn").click(function(){
    if($("#store_class_form").valid()){
     $("#store_class_form").submit();
	}
	});
});
//
$(document).ready(function(){
	$('#store_class_form').validate({
        errorPlacement: function(error, element){
			var error_td = element.parent('dd').children('span.err');
            error_td.append(error);
        },

        rules : {
            sc_name : {
                required : true,
                remote   : {
                url :'index.php?model=store_class&fun=ajax_check_name',
                type:'get',
                data:{
                    sc_name : function(){
                        return $('#sc_name').val();
                    },
                    sc_id : '<?php echo $output['class_array']['sc_id'];?>'
                  }
                }
            },
            sc_sort : {
                number   : true
            }
        },
        messages : {
            sc_name : {
                required : '<i class="fa fa-exclamation-circle"></i><?php echo $lang['store_class_name_no_null'];?>',
                remote   : '<i class="fa fa-exclamation-circle"></i><?php echo $lang['store_class_name_is_there'];?>'
            },
            sc_sort  : {
                number   : '<i class="fa fa-exclamation-circle"></i><?php echo $lang['store_class_sort_only_number'];?>'
            }
        }
    });
});
</script>