<?php defined('interMarket') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <div class="subject">
        <h3>会员折扣</h3>
        <h5>商城注册会员的折扣设定</h5>
      </div>
      <ul class="tab-base nc-row">
        <!-- <li><a href="<?php echo urlAdminShop('member_exp', 'index');?>" >经验值明细</a></li>
        <li><a href="<?php echo urlAdminShop('member_exp', 'expsetting');?>">会员折扣规则设置</a></li> -->
        <li><a href="JavaScript:void(0);" class="current">会员折扣设定</a></li>
      </ul>
    </div>
  </div>
  
  <!-- 操作说明 -->
  <div class="explanation" id="explanation">
    <div class="title" id="checkZoom"><i class="fa fa-lightbulb-o"></i>
      <h4 title="<?php echo $lang['nc_prompts_title'];?>"><?php echo $lang['nc_prompts'];?></h4>
      <span id="explanationZoom" title="<?php echo $lang['nc_prompts_span'];?>"></span> </div>
    <ul>
      <li>“会员折扣设置”提交后，当会员符合某个级别后下单后会自动计算该折扣率</li>
      <li>除了活动商品以外的所有商品都可以打折</li>
     <!--  <li>&nbsp;&nbsp;&nbsp;&nbsp;四、下单折扣应为0~100之间的数字，下单折扣设置后，相应级别会员下单时将享受该折扣的金额优惠，如果不想设置折扣则将该值设置为0；</li> -->
    </ul>
  </div>
  <form method="post" id="mg_form" name="mg_form" enctype="multipart/form-data">
    <input type="hidden" name="form_submit" value="ok" />
    <div class="ncap-form-default" id="mg_tbody">
      <div class="title">
        <h3>会员折扣设置：</h3>
      </div>
      <dl class="row" id="row_0">
        <dt class="tit">会员等级<strong>V0</strong></dt>
        <dd class="opt">
          折扣为 <input type="text" name="mg[0][discount]" value="<?php echo $output['list_setting']['member_discount'][0]['discount'];?>" class="w60" /> %
          <!-- &nbsp;&nbsp;&nbsp;&nbsp;下单折扣 <input type="text" name="mg[0][orderdiscount]" value="<?php echo $output['list_setting']['member_discount'][0]['orderdiscount'];?>" class="w60" nc_type="verify" data-param='{"name":"下单折扣","type":"orderdiscount"}'/> % -->
        </dd>
      </dl>
      <dl class="row" id="row_1">
        <dt class="tit">会员等级<strong>V1</strong></dt>
        <dd class="opt">
          折扣为 <input type="text" name="mg[1][discount]" value="<?php echo $output['list_setting']['member_discount'][1]['discount'];?>" class="w60" nc_type="verify" data-param='{"name":"折扣","type":"discount"}'/> %
          <!-- &nbsp;&nbsp;&nbsp;&nbsp;下单折扣 <input type="text" name="mg[1][orderdiscount]" value="<?php echo $output['list_setting']['member_discount'][1]['orderdiscount'];?>" class="w60" nc_type="verify" data-param='{"name":"下单折扣","type":"orderdiscount"}'/> % -->
        </dd>
      </dl>
      <dl class="row" id="row_2">
        <dt class="tit">会员等级<strong>V2</strong></dt>
        <dd class="opt">
          折扣为 <input type="text" name="mg[2][discount]" value="<?php echo $output['list_setting']['member_discount'][2]['discount'];?>" class="w60" nc_type="verify" data-param='{"name":"折扣","type":"discount"}'/> %
          <!-- &nbsp;&nbsp;&nbsp;&nbsp;下单折扣 <input type="text" name="mg[2][orderdiscount]" value="<?php echo $output['list_setting']['member_discount'][2]['orderdiscount'];?>" class="w60" nc_type="verify" data-param='{"name":"下单折扣","type":"orderdiscount"}'/> % -->
        </dd>
      </dl>
      <dl class="row" id="row_3">
        <dt class="tit">会员等级<strong>V3</strong></dt>
        <dd class="opt">
          折扣为 <input type="text" name="mg[3][discount]" value="<?php echo $output['list_setting']['member_discount'][3]['discount'];?>" class="w60" nc_type="verify" data-param='{"name":"折扣","type":"discount"}'/>%
          <!-- &nbsp;&nbsp;&nbsp;&nbsp;下单折扣 <input type="text" name="mg[3][orderdiscount]" value="<?php echo $output['list_setting']['member_discount'][3]['orderdiscount'];?>" class="w60" nc_type="verify" data-param='{"name":"下单折扣","type":"orderdiscount"}'/> % -->
        </dd>
      </dl>
      <div class="bot"><a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-green" id="submitBtn"><?php echo $lang['nc_submit'];?></a></div>
    </div>
  </form>
</div>
<script type="text/javascript">
$(function(){
	$('#submitBtn').click(function(){
		var result = true;
		var error = new Array();
		$("#mg_tbody").find("[nc_type='verify']").each(function(){
			if(result){
				data = $(this).val();
				if(!data){
					result = false;
					//error.push('请将信息填写完整');
					error = '请将信息填写完整';
				}
				//验证类型
				if(result){
					var data_str = $(this).attr('data-param');
				    if(data_str){
				    	eval( "data_str = "+data_str);
				    	switch(data_str.type){
				    	   case 'discount':
				    		   result = (data = parseInt(data)) > 0?true:false;
				    		   error = (result == false)?(data_str.name + '应为整数'):'';
                               break;
                           //case 'orderdiscount':
                           //    result = (parseFloat(data) >= 0 && parseInt(data) <= 100)?true:false;
                           //   error = (result == false)?(data_str.name + '应为0~100之间的数字'):'';
                           //    break;
				    	}
				    }
				}
			}
		});
		if(result){
			$('#mg_form').submit();
		} else {
			showDialog(error);
		}
    });
})
</script>