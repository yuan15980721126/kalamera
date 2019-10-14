<?php
defined('interMarket') or exit('Access Invalid!');
$lang['voucher_unavailable'] = 'coupon function is not available';
$lang['voucher_applystate_new'] = 'to be verified ';
$lang['voucher_applystate_verify'] = 'verified ';
$lang['voucher_applystate_cancel'] = 'canceled ';
$lang['voucher_quotastate_activity'] = 'normal ';
$lang['voucher_quotastate_cancel'] = 'cancel';
$lang['voucher_quotastate_expire'] = 'end ';
$lang['voucher_templatestate_usable'] = 'usable';
$lang['voucher_templatestate_disabled']= 'disabled';
$lang['voucher_quotalist']= 'set list';
$lang['voucher_applyquota']= 'apply the quota';
$lang['voucher_applyadd']= 'buy plan ';
$lang['voucher_templateadd']= 'new coupon ';
$lang['voucher_templateedit']= 'edit coupon ';
$lang['voucher_templateinfo']= 'coupon details ';
/**
 * 套餐申请
 */
$lang['voucher_apply_num_error']= 'the number cannot be empty and must be an integer between 1 and 12 ';
$lang['voucher_apply_goldnotenough']= "%s is notenough for this transaction, please recharge ";
$lang['voucher_apply_fail']= 'failed package application ';
$lang['voucher_apply_succ']= 'package application successful, please wait for verification ';
$lang['voucher_apply_date']= 'date of application ';
$lang['voucher_apply_num'] = 'number of requests ';
$lang['voucher_apply_addnum'] = 'number of packages purchased ';
$lang['voucher_apply_add_tip1'] = 'buy in months (30 days) for a maximum of 12 months at a time';
$lang['voucher_apply_add_tip2'] = 'you need to pay % s yuan per month';
$lang['voucher_apply_add_tip3'] = 'launch % s most times a month';
$lang['voucher_apply_add_tip4'] = 'set time starts after approval ';
$lang['voucher_apply_add_confirm1'] = 'you need to pay in total ';
$lang['voucher_apply_add_confirm2'] = 'yuan, do you confirm to buy?';
$lang['voucher_apply_goldlog'] = 'coupon purchase activity %s months, unit price %s gold, total cost %s gold ';
$lang['voucher_apply_buy_succ'] = 'package purchased successfully ';

/**
 * 套餐
 */
$lang['voucher_quota_startdate'] = 'start time ';
$lang['voucher_quota_enddate'] = 'end time ';
$lang['voucher_quota_timeslimit'] = 'active timeslimit';
$lang['voucher_quota_publishedtimes'] = 'number of published activities ';
$lang['voucher_quota_residuetimes'] = 'number of residual activities ';
/**
 * 优惠券模板
 */
$lang['voucher_template_quotanull'] = 'no current package available, please apply for the package ';
$lang['voucher_template_noresidual'] = "the activity in the current package is already full of %s activity information and cannot be published anymore ";
$lang['voucher_template_pricelisterror'] = 'platform coupon face value setting problem, please contact customer service ';
$lang['voucher_template_title_error'] = "template name cannot be empty and cannot be greater than 50 characters ";
$lang['voucher_template_total_error'] = "can't be empty and must be an integer greater than 1 ";
$lang['voucher_template_price_error'] = "template denomination cannot be empty and must be an integer, and denomination cannot be greater than the limit ";
$lang['voucher_template_limit_error'] = "template limit cannot be empty and must be numeric ";
$lang['voucher_template_describe_error'] = "template description cannot be empty and cannot be greater than 200 characters ";
$lang['voucher_template_title'] = 'coupon name ';
$lang['voucher_template_enddate'] = 'period of validity ';
$lang['voucher_template_enddate_tip'] = 'the period of validity should be within the validity period of the package, and the period of validity of the package in use is ';
$lang['voucher_template_price'] = 'denomination ';
$lang['voucher_template_total'] = 'voucher_template_total';
$lang['voucher_template_eachlimit'] = 'per person ';
$lang['voucher_template_eachlimit_item']= 'unlimited ';
$lang['voucher_template_eachlimit_unit'] = ' picce';
$lang['voucher_template_orderpricelimit'] = 'amount of consumption ';
$lang['voucher_template_describe'] = 'coupon description ';
$lang['voucher_template_styleimg'] = 'select coupon skin ';
$lang['voucher_template_styleimg_text'] = 'store coupon ';
$lang['voucher_template_image'] = 'coupon picture ';
$lang['voucher_template_image_tip'] = 'this image will be displayed in the coupon module in the credits center. The recommended size is 160*160px.';
$lang['voucher_template_list_tip1'] = "1. After manually setting the coupon invalid, the user will not be able to receive the coupon, but the coupon already received can still be used ";
$lang['voucher_template_list_tip2'] = "2, coupon template and coupon automatically become invalid ";
$lang['voucher_template_backlist'] = "return list ";
$lang['voucher_template_giveoutnum']= 'given ';
$lang['voucher_template_usednum'] = 'used ';
/**
 * 优惠券
 */
$lang['voucher_voucher_state'] = "state ";
$lang['voucher_voucher_state_unused'] = "unused ";
$lang['voucher_voucher_state_used'] = "used ";
$lang['voucher_voucher_state_expire'] = "expired ";
$lang['voucher_voucher_price'] = "amount ";
$lang['voucher_voucher_storename'] = "store ";
$lang['voucher_voucher_indate'] = "period of validity ";
$lang['voucher_voucher_usecondition'] = "condition of use ";
$lang['voucher_voucher_usecondition_desc'] = "order full ";
$lang['voucher_voucher_vieworder'] = "vieworder ";
$lang['voucher_voucher_readytouse'] = "use now ";
$lang['voucher_voucher_code'] = "code ";
$lang['voucher_list'] = "my coupon ";
?>
