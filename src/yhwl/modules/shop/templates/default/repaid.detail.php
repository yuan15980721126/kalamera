<?php defined('interMarket') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title"><a class="back" href="index.php?model=store&fun=store_joinin" title="返回<?php echo $lang['pending'];?>列表"><i class="fa fa-arrow-circle-o-left"></i></a>
      <div class="subject">
        <h3><?php echo $lang['nc_store_jiameng'];?> - 查看会员“<?php echo $output['joinin_detail']['member_name'];?>”的留言信息</h3>
        <!-- <h5><?php echo $lang['nc_store_manage_subhead'];?></h5> -->
      </div>
    </div>
  </div>
  <form id="form_store_verify" action="index.php?model=repaid&fun=store_joinin_verify" method="post">
  <table border="0" cellpadding="0" cellspacing="0" class="store-joinin">
    <thead>
      <tr>
        <!-- <th colspan="20">公司及联系人信息</th> -->
        <th colspan="20">联系人信息</th> 
      </tr>
    </thead>
    <tbody>
      <!-- <tr>
        <th class="w150">公司名称：</th>
        <td colspan="20"><?php echo $output['joinin_detail']['company_name'];?></td>
      </tr>
      <tr>
        <th>公司所在地：</th>
        <td><?php echo $output['joinin_detail']['company_address'];?></td>
        <th>公司详细地址：</th>
        <td colspan="20"><?php echo $output['joinin_detail']['company_address_detail'];?></td>
      </tr>
      <tr>
        <th>公司电话：</th>
        <td><?php echo $output['joinin_detail']['company_phone'];?></td>
        <th>员工总数：</th>
        <td><?php echo $output['joinin_detail']['company_employee_count'];?>&nbsp;人</td>
        <th>注册资金：</th>
        <td><?php echo $output['joinin_detail']['company_registered_capital'];?>&nbsp;万元 </td>
      </tr>
      <tr>
        <th>联系人姓名：</th>
        <td><?php echo $output['joinin_detail']['contacts_name'];?></td>
        <th>联系人电话：</th>
        <td><?php echo $output['joinin_detail']['contacts_phone'];?></td>
        <th>电子邮箱：</th>
        <td><?php echo $output['joinin_detail']['contacts_email'];?></td>
      </tr> -->
      <tr>
        <th class="w150">产品名称：</th>
        <td><?php echo $output['joinin_detail']['goods_name'];?></td>
      </tr>
      <tr>
        <th class="w150">故障型号：</th>
        <td><?php echo $output['joinin_detail']['goods_class'];?></td>
      </tr>
      <tr>
        <th class="w150">购买日期：</th>
        <td><?php echo $output['joinin_detail']['buy_time'];?></td>
      </tr>
      <tr>
        <th class="w150">订单编号：</th>
        <td><?php echo $output['joinin_detail']['order_sn'];?></td>
      </tr>

      <tr>
        <th class="w150">问题描述：</th>
        <td><?php echo $output['joinin_detail']['description'];?></td>
      </tr>
      <tr>
        <th class="w150">联系人姓名：</th>
        <td><?php echo $output['joinin_detail']['contacts_name'];?></td>
      </tr>
      
      <tr>
        <th class="w150">联系人电话：</th>
        <td><?php echo $output['joinin_detail']['contacts_phone'];?></td>
      </tr>
      <tr>
        <th class="w150">电子邮箱：</th>
        <td><?php echo $output['joinin_detail']['contacts_email'];?></td>
      </tr>
      <tr>
        <th class="w150">所在地区：</th>
        <td><?php echo $output['joinin_detail']['member_areainfo'];?></td>
      </tr>
      <tr>
        <th class="w150">详细地址：</th>
        <td><?php echo $output['joinin_detail']['address'];?></td>
      </tr>
      <tr>
        <th class="w150">申请时间：</th>
        <td><?php echo $output['joinin_detail']['add_time'];?></td>
      </tr>
      <input name="member_id" type="hidden" value="<?php echo $output['joinin_detail']['member_id'];?>" />
      <input id="verify_type" name="verify_type" type="hidden" />
      <input type="hidden" value="10" name="paying_amount" />
      <input type="hidden" value="<?php echo $output['joinin_detail']['id'];?>" name="cid" />
    </tbody>
  </table>
 <!--  <table border="0" cellpadding="0" cellspacing="0" class="store-joinin">
    <thead>
      <tr>
        <th colspan="20">营业执照信息（副本）</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th class="w150">营业执照号：</th>
        <td><?php echo $output['joinin_detail']['business_licence_number'];?></td>
      </tr>
      <tr>
        <th>营业执照所在地：</th>
        <td><?php echo $output['joinin_detail']['business_licence_address'];?></td>
      </tr>
      <tr>
        <th>营业执照有效期：</th>
        <td><?php echo $output['joinin_detail']['business_licence_start'];?> - <?php echo $output['joinin_detail']['business_licence_end'];?></td>
      </tr>
      <tr>
        <th>法定经营范围：</th>
        <td colspan="20"><?php echo $output['joinin_detail']['business_sphere'];?></td>
      </tr>
      <tr>
        <th>营业执照<br />
          电子版：</th>
        <td colspan="20"><a nctype="nyroModal"  href="<?php echo getStoreJoininImageUrl($output['joinin_detail']['business_licence_number_elc']);?>"> <img src="<?php echo getStoreJoininImageUrl($output['joinin_detail']['business_licence_number_elc']);?>" alt="" /> </a></td>
      </tr>
    </tbody>
  </table>
  <table border="0" cellpadding="0" cellspacing="0" class="store-joinin">
    <thead>
      <tr>
        <th colspan="20">组织机构代码证</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th>组织机构代码：</th>
        <td colspan="20"><?php echo $output['joinin_detail']['organization_code'];?></td>
      </tr>
      <tr>
        <th>组织机构代码证<br/>
          电子版：</th>
        <td colspan="20"><a nctype="nyroModal"  href="<?php echo getStoreJoininImageUrl($output['joinin_detail']['organization_code_electronic']);?>"> <img src="<?php echo getStoreJoininImageUrl($output['joinin_detail']['organization_code_electronic']);?>" alt="" /> </a></td>
      </tr>
    </tbody>
  </table>
  <table border="0" cellpadding="0" cellspacing="0" class="store-joinin">
    <thead>
      <tr>
        <th colspan="20">一般纳税人证明：</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th>一般纳税人证明：</th>
        <td colspan="20"><a nctype="nyroModal"  href="<?php echo getStoreJoininImageUrl($output['joinin_detail']['general_taxpayer']);?>"> <img src="<?php echo getStoreJoininImageUrl($output['joinin_detail']['general_taxpayer']);?>" alt="" /> </a></td>
      </tr>
    </tbody>
  </table>
  <table border="0" cellpadding="0" cellspacing="0" class="store-joinin">
    <thead>
      <tr>
        <th colspan="20">开户银行信息：</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th class="w150">银行开户名：</th>
        <td><?php echo $output['joinin_detail']['bank_account_name'];?></td>
      </tr>
      <tr>
        <th>公司银行账号：</th>
        <td><?php echo $output['joinin_detail']['bank_account_number'];?></td>
      </tr>
      <tr>
        <th>开户银行支行名称：</th>
        <td><?php echo $output['joinin_detail']['bank_name'];?></td>
      </tr>
      <tr>
        <th>支行联行号：</th>
        <td><?php echo $output['joinin_detail']['bank_code'];?></td>
      </tr>
      <tr>
        <th>开户银行所在地：</th>
        <td colspan="20"><?php echo $output['joinin_detail']['bank_address'];?></td>
      </tr>
      <tr>
        <th>开户银行许可证<br/>
          电子版：</th>
        <td colspan="20"><a nctype="nyroModal"  href="<?php echo getStoreJoininImageUrl($output['joinin_detail']['bank_licence_electronic']);?>"> <img src="<?php echo getStoreJoininImageUrl($output['joinin_detail']['bank_licence_electronic']);?>" alt="" /> </a></td>
      </tr>
    </tbody>
  </table>
  <table border="0" cellpadding="0" cellspacing="0" class="store-joinin">
    <thead>
      <tr>
        <th colspan="20">结算账号信息：</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th class="w150">银行开户名：</th>
        <td><?php echo $output['joinin_detail']['settlement_bank_account_name'];?></td>
      </tr>
      <tr>
        <th>公司银行账号：</th>
        <td><?php echo $output['joinin_detail']['settlement_bank_account_number'];?></td>
      </tr>
      <tr>
        <th>开户银行支行名称：</th>
        <td><?php echo $output['joinin_detail']['settlement_bank_name'];?></td>
      </tr>
      <tr>
        <th>支行联行号：</th>
        <td><?php echo $output['joinin_detail']['settlement_bank_code'];?></td>
      </tr>
      <tr>
        <th>开户银行所在地：</th>
        <td><?php echo $output['joinin_detail']['settlement_bank_address'];?></td>
      </tr>
    </tbody>
  </table>
  <table border="0" cellpadding="0" cellspacing="0" class="store-joinin">
    <thead>
      <tr>
        <th colspan="20">税务登记证</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th class="w150">税务登记证号：</th>
        <td><?php echo $output['joinin_detail']['tax_registration_certificate'];?></td>
      </tr>
      <tr>
        <th>纳税人识别号：</th>
        <td><?php echo $output['joinin_detail']['taxpayer_id'];?></td>
      </tr>
      <tr>
        <th>税务登记证号<br />
          电子版：</th>
        <td><a nctype="nyroModal"  href="<?php echo getStoreJoininImageUrl($output['joinin_detail']['tax_registration_certif_elc']);?>"> <img src="<?php echo getStoreJoininImageUrl($output['joinin_detail']['tax_registration_certif_elc']);?>" alt="" /> </a></td>
      </tr>
    </tbody>
  </table>
  
    <input id="verify_type" name="verify_type" type="hidden" />
    <input name="member_id" type="hidden" value="<?php echo $output['joinin_detail']['member_id'];?>" />
    <table border="0" cellpadding="0" cellspacing="0" class="store-joinin">
      <thead>
        <tr>
          <th colspan="20">店铺经营信息</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th class="w150">商家账号：</th>
          <td><?php echo $output['joinin_detail']['seller_name'];?></td>
        </tr>
        <tr>
          <th class="w150">店铺名称：</th>
          <td><?php echo $output['joinin_detail']['store_name'];?></td>
        </tr>
        <tr>
          <th>店铺等级：</th>
          <td><?php echo $output['joinin_detail']['sg_name'];?>（开店费用：<?php echo $output['joinin_detail']['sg_price'];?> 元/年）</td>
        </tr>
        <tr>
          <th class="w150">开店时长：</th>
          <td><?php echo $output['joinin_detail']['joinin_year'];?> 年</td>
        </tr>
        <tr>
          <th>店铺分类：</th>
          <td><?php echo $output['joinin_detail']['sc_name'];?>（开店保证金：<?php echo $output['joinin_detail']['sc_bail'];?> 元）</td>
        </tr>
        <tr>
          <th>应付总金额：</th>
          <td><?php if(intval($output['joinin_detail']['joinin_state']) === 10) {?>
            <input type="text" value="<?php echo $output['joinin_detail']['paying_amount'];?>" name="paying_amount" />
            元
            <?php } else { ?>
            <?php echo $output['joinin_detail']['paying_amount'];?> 元
            <?php } ?></td>
        </tr>
        <tr>
          <th>经营类目：</th>
          <td colspan="2"><table border="0" cellpadding="0" cellspacing="0" id="table_category" class="type">
              <thead>
                <tr>
                  <th>分类1</th>
                  <th>分类2</th>
                  <th>分类3</th>
                  <th>比例</th>
                </tr>
              </thead>
              <tbody>
                <?php $store_class_names = unserialize($output['joinin_detail']['store_class_names']);?>
                <?php if(!empty($store_class_names) && is_array($store_class_names)) {?>
                <?php $store_class_commis_rates = explode(',', $output['joinin_detail']['store_class_commis_rates']);?>
                <?php for($i=0, $length = count($store_class_names); $i < $length; $i++) {?>
                <?php list($class1, $class2, $class3) = explode(',', $store_class_names[$i]);?>
                <tr>
                  <td><?php echo $class1;?></td>
                  <td><?php echo $class2;?></td>
                  <td><?php echo $class3;?></td>
                  <td><?php if(intval($output['joinin_detail']['joinin_state']) === 10) {?>
                    <input type="text" nctype="commis_rate" value="<?php echo $store_class_commis_rates[$i];?>" name="commis_rate[]" class="w100" />
                    %
                    <?php } else { ?>
                    <?php echo $store_class_commis_rates[$i];?> %
                    <?php } ?></td>
                </tr>
                <?php } ?>
                <?php } ?>
              </tbody>
            </table></td>
        </tr>
        <?php if(in_array(intval($output['joinin_detail']['joinin_state']), array(STORE_JOIN_STATE_PAY, STORE_JOIN_STATE_FINAL))) {?>
        <tr>
          <th>付款凭证：</th>
          <td><a nctype="nyroModal"  href="<?php echo getStoreJoininImageUrl($output['joinin_detail']['paying_money_certificate']);?>"> <img src="<?php echo getStoreJoininImageUrl($output['joinin_detail']['paying_money_certificate']);?>" alt="" /> </a></td>
        </tr>
        <tr>
          <th>付款凭证说明：</th>
          <td><?php echo $output['joinin_detail']['paying_money_certif_exp'];?></td>
        </tr>
        <?php } ?>
        <?php if(in_array(intval($output['joinin_detail']['joinin_state']), array(STORE_JOIN_STATE_NEW, STORE_JOIN_STATE_PAY))) { ?>
        <tr>
          <th>审核意见：</th>
          <td colspan="2"><textarea id="joinin_message" name="joinin_message"></textarea></td>
        </tr>
        <?php } ?>
      </tbody>
    </table> -->
    <?php if(in_array(intval($output['joinin_detail']['state']), array(1,2))) { ?>
    <div id="validation_message" style="color:red;display:none;"></div>
    <div class="bottom"><a id="btn_pass" class="ncap-btn-big ncap-btn-green mr10" href="JavaScript:void(0);">通过</a><a id="btn_fail" class="ncap-btn-big ncap-btn-red" href="JavaScript:void(0);">拒绝</a> </div>
    <?php }else if(intval($output['joinin_detail']['state']) == 3){ ?>
    <div class="bottom"><a id="btn_pass" class="ncap-btn-big ncap-btn-green mr10" href="JavaScript:void(0);">通过</a> </div>
     <?php }?>
  </form>
</div>
<script type="text/javascript" src="<?php echo ADMIN_RESOURCE_URL;?>/js/jquery.nyroModal.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.poshytip.min.js" charset="utf-8"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('a[nctype="nyroModal"]').nyroModal();

        $('#btn_fail').on('click', function() {
            // if($('#joinin_message').val() == '') {
            //     $('#validation_message').text('请输入审核意见');
            //     $('#validation_message').show();
            //     return false;
            // } else {
            //     $('#validation_message').hide();
            // }
            if(confirm('确认拒绝申请？')) {
                $('#verify_type').val('fail');
                $('#form_store_verify').submit();
            }
        });
        $('#btn_pass').on('click', function() {
            var valid = true;
            // $('[nctype="commis_rate"]').each(function(commis_rate) {
            //     rate = $(this).val();
            //     if(rate == '') {
            //         valid = false;
            //         return false;
            //     }

            //     var rate = Number($(this).val());
            //     if(isNaN(rate) || rate < 0 || rate >= 100) {
            //         valid = false;
            //         return false;
            //     }
            // });
            if(valid) {
                $('#validation_message').hide();
                if(confirm('确认通过申请？')) {
                    $('#verify_type').val('pass');
                    $('#form_store_verify').submit();
                }
            } else {
                $('#validation_message').text('请正确填写分佣比例');
                $('#validation_message').show();
            }
        });
    });
</script>