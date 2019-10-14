<?php defined('interMarket') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <div class="subject">
        <h3><?php echo $lang['account_syn'];?></h3>
        <h5><?php echo $lang['account_syn_subhead'];?></h5>
      </div>
      <?php echo $output['top_link'];?> </div>
  </div>
  <div class="explanation" id="explanation">
    <div class="title" id="checkZoom"><i class="fa fa-lightbulb-o"></i>
      <h4 title="<?php echo $lang['nc_prompts_title'];?>"><?php echo $lang['nc_prompts'];?></h4>
      <span id="explanationZoom" title="<?php echo $lang['nc_prompts_span'];?>"></span> </div>
    <ul>
      <li>启用前需在 Facebook 开发者平台注册创建网站应用并获得相应的AppID和AppSecret。</li>
    </ul>
  </div>
  <form method="post" name="settingForm">
    <input type="hidden" name="form_submit" value="ok" />
    <div class="ncap-form-default">
      <dl class="row">
        <dt class="tit">
          <label>是否启用Facebook登录功能</label>
        </dt>
        <dd class="opt">
          <div class="onoff">
            <label for="facebook_isuse_1" class="cb-enable <?php if($output['list_setting']['facebook_isuse'] == '1'){ ?>selected<?php } ?>" title="<?php echo $lang['open'];?>"><span><?php echo $lang['open'];?></span></label>
            <label for="facebook_isuse_0" class="cb-disable <?php if($output['list_setting']['facebook_isuse'] == '0'){ ?>selected<?php } ?>" title="<?php echo $lang['close'];?>"><span><?php echo $lang['close'];?></span></label>
            <input type="radio" id="facebook_isuse_1" name="facebook_isuse" value="1" <?php echo $output['list_setting']['facebook_isuse']==1?'checked=checked':''; ?>>
            <input type="radio" id="facebook_isuse_0" name="facebook_isuse" value="0" <?php echo $output['list_setting']['facebook_isuse']==0?'checked=checked':''; ?>>
          </div>
          <p class="notic">启用后支持使用Facebook帐号来登录</p>
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">
          <label for="facebook_appid">应用标识</label>
        </dt>
        <dd class="opt">
          <input id="facebook_appid" name="facebook_appid" value="<?php echo $output['list_setting']['facebook_appid'];?>" class="input-txt" type="text">
          <!--
          <p class="notic"><a class="ncap-btn" target="_blank" href="https://open.facebook.qq.com/">立即在线申请</a></p>
          -->
        </dd>
      </dl>
      <dl class="row">
        <dt class="tit">
          <label for="facebook_appkey">应用密钥</label>
        </dt>
        <dd class="opt">
          <input id="facebook_appkey" name="facebook_secret" value="<?php echo $output['list_setting']['facebook_secret'];?>" class="input-txt" type="text">
          <p class="notic">&nbsp;</p>
        </dd>
      </dl>
      <div class="bot"><a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-green" onclick="document.settingForm.submit()"><?php echo $lang['nc_submit'];?></a></div>
    </div>
  </form>
</div>
