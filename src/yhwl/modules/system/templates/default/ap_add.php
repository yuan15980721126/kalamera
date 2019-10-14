<?php defined('interMarket') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title"><a class="back" href="index.php?model=adv&fun=ap_manage" title="返回列表"><i class="fa fa-arrow-circle-o-left"></i></a>
      <div class="subject">
        <h3><?php echo $lang['adv_index_manage'];?> - <?php echo $lang['ap_add'];?></h3>
        <h5><?php echo $lang['adv_index_manage_subhead'];?></h5>
      </div>
    </div>
  </div>
  <form id="link_form" enctype="multipart/form-data" method="post">
    <input type="hidden" name="form_submit" value="ok" />
    <div class="ncap-form-default">
      <dl class="row">
        <dt class="tit">
          <label for="ap_name"><em>*</em><?php echo $lang['ap_name'];?></label>
        </dt>
        <dd class="opt">
          <input type="text" name="ap_name" id="ap_name" class="input-txt">
          <span class="err"></span>
          <p class="notic"></p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">
          <label><?php echo $lang['ap_class'];?></label>
        </dt>
        <dd class="opt">
          <select name="ap_class" id="ap_class">
            <option value="0"><?php echo $lang['adv_pic'];?></option>
            <option value="1"><?php echo $lang['adv_word'];?></option>
            <option value="3">Flash</option>
          </select>
          <p class="notic"><?php echo $lang['ap_select_showstyle'];?></p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit"><?php echo $lang['ap_is_use'];?></dt>
        <dd class="opt">
          <ul>
            <li>
              <input name="is_use" type="radio" value="1" checked="checked">
              <label><?php echo $lang['ap_use_s'];?></label>
            </li>
            <li>
              <input type="radio" name="is_use" value="0">
              <label><?php echo $lang['ap_not_use_s'];?></label>
            </li>
          </ul>
          <p class="notic"></p>
        </dd>
      </dl>
      <dl class="row" id="ap_display">
        <dt class="tit"><?php echo $lang['ap_show_style'];?></dt>
        <dd class="opt">
          <ul class="nofloat">
            <li>
              <input type="radio" name="ap_display" value="1">
              <label><?php echo $lang['ap_allow_mul_adv'];?></label>
            </li>
            <li>
              <input type="radio" name="ap_display" value="2" checked="checked">
              <label><?php echo $lang['ap_allow_one_adv'];?></label>
            </li>
          </ul>
          <p class="vatop tips"></p>
        </dd>
      </dl>
      <dl class="row" id="ap_width_media">
        <dt class="tit">
          <label for="ap_width_media_input"><em>*</em><?php echo $lang['ap_width_l'];?></label>
        </dt>
        <dd class="opt">
          <input type="text" value="" name="ap_width_media"  class="input-txt" id="ap_width_media_input">
          <span class="err"></span>
          <p class="notic"><?php echo $lang['adv_pix'];?></p>
        </dd>
      </dl>
      <dl class="row" id="ap_width_word">
        <dt class="tit">
          <label for="ap_width_word_input"><em>*</em><?php echo $lang['ap_word_num'];?></label>
        </dt>
        <dd class="opt">
          <input type="text" value="" name="ap_width_word"  class="input-txt" id="ap_width_word_input">
          <span class="err"></span>
          <p class="notic"><?php echo $lang['adv_byte'];?></p>
        </dd>
      </dl>
      <dl class="row" id="ap_height">
        <dt class="tit">
          <label for="ap_height_input"><em>*</em><?php echo $lang['ap_height_l'];?></label>
        </dt>
        <dd class="opt">
          <input type="text" value="" name="ap_height" class="input-txt" id="ap_height_input">
          <span class="err"></span>
          <p class="notic"><?php echo $lang['adv_pix'];?></p>
        </dd>
      </dl> 
      <dl class="row" id="ap_url">
        <dt class="tit">
          <label for="ap_url_input"><em>*</em><?php echo $lang['ap_height_url'];?></label>
        </dt>
        <dd class="opt">
          <input type="text" value="" name="ap_url" class="input-txt" id="ap_url_input">
          <span class="err"></span>
<!--           <p class="notic"><?php echo $lang['adv_pix'];?></p> -->
        </dd>
      </dl> 
      <dl class="row" id="ap_sort">
        <dt class="tit">
          <label for="ap_sort_input"><em>*</em><?php echo $lang['ap_sort'];?></label>
        </dt>
        <dd class="opt">
          <input type="text" value="" name="ap_sort" class="input-txt" id="ap_sort_input">
          <span class="err"></span>
          <p class="notic">数字范围为0~255，数字越小越靠前</p>
        </dd>
      </dl> 
      <dl class="row" id="default_pic">
        <dt class="tit">
          <label for="change_default_pic"><em>*</em><?php echo $lang['ap_default_pic']; ?></label>
        </dt>
        <dd class="opt ">
        <div class="type-file-box">
          <div class="input-file-show"><span class="type-file-box">
            <input type="file" class="type-file-file" id="change_default_pic" name="default_pic" size="30" hidefocus="true"  nc_type="change_default_pic" title="点击按钮选择文件并提交表单后上传生效">
            </span></div></div>
          <span class="err"></span>
          <p class="notic"><?php echo $lang['ap_show_defaultpic_when_nothing']; ?>,<?php echo $lang['adv_edit_support'];?>gif,jpg,jpeg,png</p>
        </dd>
      </dl>
      <dl class="row" id="default_word">
        <dt class="tit">
          <label for="default_word"><em>*</em><?php echo $lang['ap_default_word']; ?></label>
        </dt>
        <dd class="opt">
          <input type="text" id="default_word" value="" name="default_word" class="input-txt">
          <span class="err"></span>
          <p class="notic"><?php echo $lang['ap_show_defaultword_when_nothing']; ?></p>
        </dd>
      </dl>
      <div class="bot"><a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-green" id="submitBtn"><?php echo $lang['nc_submit'];?></a></div>
    </div>
  </form>
</div>
<script type="text/javascript">
$(function(){
	$("#ap_width_word").hide();
	$("#default_word").hide();
	$("#ap_class").change(function(){
	if($("#ap_class").val() == '1'){
		$("#ap_height").hide();
		$("#ap_width_media").hide();
		$("#default_pic").hide();
		$("#default_word").show();
		$("#ap_width_word").show();
		$("#ap_display").show();
	}else if($("#ap_class").val() == '0'||$("#ap_class").val() == '3'){
		$("#ap_height").show();
		$("#ap_width_media").show();
		$("#default_pic").show();
		$("#default_word").hide();
		$("#ap_width_word").hide();
		$("#ap_display").show();
	}
  });
});
</script> 
<script>
//按钮先执行验证再提交表单
$(function(){$("#submitBtn").click(function(){
    if($("#link_form").valid()){
     $("#link_form").submit();
	}
	});
var textButton="<input type='text' name='textfield' id='textfield1' class='type-file-text' /><input type='button' name='button' id='button1' value='选择上传...' class='type-file-button' />"
    $(textButton).insertBefore("#change_default_pic");
    $("#change_default_pic").change(function(){
	$("#textfield1").val($("#change_default_pic").val());
    });
});
//
$(document).ready(function(){

	$('#link_form').validate({
        errorPlacement: function(error, element){
			var error_td = element.parents('dl').find('span.err');
            error_td.append(error);
        },
        rules : {
        	ap_name : {
                required : true
            },
			ap_width_media:{
				required :function(){return $("#ap_class").val()!=1;},
				digits	 :true,
				min:1
			},
			ap_height:{
				required :function(){return $("#ap_class").val()!=1;},
				digits	 :true,
				min:1
			},
            ap_url:{
                url : true,                  
            },
            ap_sort:{
                digits : true,
                max:255,                  
            },
			ap_width_word :{
				required :function(){return $("#ap_class").val()==1;},
				digits	 :true,
				min:1
			},
			default_word  :{
				required :function(){return $("#ap_class").val()==1;}
			},
			default_pic:{
				required :function(){ if($("#ap_class").val() == '0'||$("#ap_class").val() == '3'){return true;}else{return false}},
				accept : 'png|jpe?g|gif'
			}
        },
        messages : {
            url: "Please enter a valid URLfsdfdsf.", 

        	ap_name : {
                required : '<i class="fa fa-exclamation-circle"></i><?php echo $lang['ap_can_not_null']; ?>'
            },
            ap_width_media	:{
            	required   : '<i class="fa fa-exclamation-circle"></i><?php echo $lang['ap_input_digits_pixel']; ?>',
            	digits	:'<i class="fa fa-exclamation-circle"></i><?php echo $lang['ap_input_digits_pixel'];?>',
            	min	:'<i class="fa fa-exclamation-circle"></i><?php echo $lang['ap_input_digits_pixel'];?>'
            },
            ap_height	:{
            	required   : '<i class="fa fa-exclamation-circle"></i><?php echo $lang['ap_input_digits_pixel']; ?>',
            	digits	:'<i class="fa fa-exclamation-circle"></i><?php echo $lang['ap_input_digits_pixel'];?>',
            	min	:'<i class="fa fa-exclamation-circle"></i><?php echo $lang['ap_input_digits_pixel'];?>'
            },
            ap_url   :{
                required   : '<i class="fa fa-exclamation-circle"></i>必须输入正确格式的网址',
            },
            ap_sort   :{
                digits   : '<i class="fa fa-exclamation-circle"></i>必须输入整数',
            },
            ap_width_word	:{
            	required   : '<i class="fa fa-exclamation-circle"></i><?php echo $lang['ap_input_digits_pixel']; ?>',
            	digits	:'<i class="fa fa-exclamation-circle"></i><?php echo $lang['ap_input_digits_pixel'];?>',
            	min	:'<i class="fa fa-exclamation-circle"></i><?php echo $lang['ap_input_digits_pixel'];?>'
            },
            default_word	:{
            	required   : '<i class="fa fa-exclamation-circle"></i><?php echo $lang['ap_default_word_can_not_null']; ?>'
            },
            default_pic: {
        		required : '<i class="fa fa-exclamation-circle"></i><?php echo $lang['default_pic_can_not_null'];?>',
				accept   : '<i class="fa fa-exclamation-circle"></i>图片格式错误'
			}
        }
    });
    jQuery.extend(jQuery.validator.messages, {  
      //       required: "必选字段",  
      // remote: "请修正该字段",  
      
      url: "请输入合法的网址",  
      // date: "请输入合法的日期",  
      // dateISO: "请输入合法的日期 (ISO).",  
      // number: "请输入合法的数字",  
      // digits: "只能输入整数",  
      // creditcard: "请输入合法的信用卡号",  
      // equalTo: "请再次输入相同的值",  
      // accept: "请输入拥有合法后缀名的字符串",  
      // maxlength: jQuery.validator.format("请输入一个长度最多是 {0} 的字符串"),  
      // minlength: jQuery.validator.format("请输入一个长度最少是 {0} 的字符串"),  
      // rangelength: jQuery.validator.format("请输入一个长度介于 {0} 和 {1} 之间的字符串"),  
      // range: jQuery.validator.format("请输入一个介于 {0} 和 {1} 之间的值"),  
      max: jQuery.validator.format("请输入一个最大不超过 255 的值"),  
      // min: jQuery.validator.format("请输入一个最小为 {0} 的值")  
    }); 
});
</script>