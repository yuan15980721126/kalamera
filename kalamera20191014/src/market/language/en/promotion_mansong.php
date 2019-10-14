<?php
defined('interMarket') or exit('Access Invalid!');

$lang['promotion_unavailable'] = 'product promotion function is not activated ';
$lang['promotion_mansong'] = 'promotion_mansong';
$lang['promotion_active_list'] = 'active list';
$lang['promotion_quota_list'] = 'package list';
$lang['promotion_join_active'] = 'add activity ';
$lang['promotion_buy_product'] = 'buy package ';
$lang['promotion_goods_manage'] = 'commodity management ';
$lang['promotion_add_goods'] = 'add goods';

$lang['state_new'] = 'new application ';
$lang['state_verify'] = 'verified ';
$lang['state_cancel'] = 'canceled ';
$lang['state_verify_fail'] = 'audit failed ';
$lang['mansong_quota_state_activity'] = 'normal ';
$lang['mansong_quota_state_cancel'] = 'cancel';
$lang['mansong_quota_state_expire'] = 'expire';
$lang['mansong_state_unpublished'] = 'unpublished';
$lang['mansong_state_published'] = 'published';
$lang['mansong_state_cancel'] = 'canceled ';
$lang['all_state'] = 'all states ';

$lang['mansong_quota_start_time'] = 'start time';
$lang['mansong_quota_end_time'] = 'end time';
$lang['mansong_quota_times_limit'] = 'activity limit';
$lang['mansong_quota_times_published'] = 'published activity times ';
$lang['mansong_quota_times_publish'] = 'number of remaining activities ';
$lang['mansong_quota_goods_limit'] = 'commodity limit';
$lang['mansong_name'] = 'event name';
$lang['mansong_status'] = 'active state ';
$lang['mansong_active_content'] = 'active content';
$lang['mansong_apply_date'] = 'package application time ';
$lang['mansong_apply_quantity'] = 'quantity of application (month)';
$lang['apply_date'] = 'apply time ';
$lang['apply_quantity'] = 'quantity of application';
$lang['apply_quantity_unit'] = '(apply_quantity_unit)';
$lang['mansong_discount'] = 'discount';
$lang['mansong_buy_limit'] = 'buy limit';

$lang['start_time'] = 'start time';
$lang['end_time'] = 'end time';
$lang['xianshi_list'] = 'time-limited discount ';
$lang['mansong_list'] = 'song_list';
$lang['mansong_add'] = 'add activity ';
$lang['mansong_quota'] = 'quota list ';
$lang['mansong_apply'] = 'application list ';
$lang['mansong_detail'] = 'activity detail';
$lang['mansong_quota_add'] = 'buy package ';
$lang['mansong_quota_add_quantity'] = 'quantity purchased in package ';
$lang['mansong_quota_add_confirm'] = 'confirm purchase?You need to pay in total ';
$lang['goods_add'] = 'add item ';
$lang['choose_goods'] = 'choose goods';
$lang['goods_name'] = 'commodity name';
$lang['goods_store_price'] = 'goods price';
$lang['mansong_goods_selected'] = 'selected item ';
$lang['mansong_publish'] = 'publish activity ';
$lang['ensure_publish'] = 'publish activity?';
$lang['level_price'] = 'full order ';
$lang['level_discount'] = 'immediate cash reduction ';
$lang['gift_name'] = 'send gift ';
$lang['mansong_price'] = 'amount required for free upon purchase ';
$lang['mansong_price_explain1'] = 'the purchasing unit is month (30 days) and the maximum number of months should be 12. After the purchasing, you can publish the free on demand activities, but only one activity can be conducted at the same time ';
$lang['mansong_price_explain2'] = 'you need to pay monthly ';
$lang['mansong_price_explain3'] = 'package time from 0pm the day after approval ';
$lang['mansong_add_explain1'] = 'all the commodities in the store should be included in the liftoff activity and the time should not overlap with the existing activities ';
$lang['mansong_add_explain2'] = 'maximum 3 price levels can be set for each liftoff activity. Click the new level button to add the new level. The price level should be from low to high ';
$lang['mansong_add_explain3'] = 'each level can offer two promotion methods including cash discount and gift offer, at least one should be chosen ';
$lang['mansong_add_start_time_explain'] = 'start time cannot be empty and cannot be earlier than %s';
$lang['mansong_add_end_time_explain'] = 'end time cannot be empty and cannot be later than %s';
$lang['mansong_discount_explain'] = 'discount must be between 0.1 and 9.9 ';
$lang['mansong_buy_limit_explain'] = 'purchase limit must be positive integer ';
$lang['time_error'] = 'time_error';
$lang['param_error'] = 'Parameter error';
$lang['greater_than_start_time'] = 'end time must be greater than start time';
$lang['mansong_price_error'] = 'cannot be empty and must be a positive integer ';
$lang['mansong_name_explain'] = 'activity name is up to 25 characters ';
$lang['mansong_name_error'] = 'activity name cannot be empty ';
$lang[' mansong_witness '] = 'event remark of 100 characters maximum ';
$lang['mansong_quota_quantity_error'] = 'the quantity cannot be empty and must be an integer between 1 and 12 ';
$lang['mansong_quota_add_success'] = 'purchase success';
$lang['mansong_quota_add_fail'] = 'failed purchase application for instant package ';
$lang['mansong_quota_current_error'] = 'you have not purchased the "buy now" promotion package or the promotion is closed.<br/> please buy the package activity first and then check the activity list.';
$lang['mansong_quota_current_error1'] = 'your current instant package is used up, please wait for the next package or buy a new one ';
$lang['mansong_quota_current_error2'] = 'you have purchased the combos ';
$lang['mansong_add_success'] = 'add success';
$lang['mansong_add_fail'] = 'fail to add activity on full send ';
$lang['mansong_goods_none'] = 'you have not added the active item ';
$lang['mansong_goods_add_success'] = 'add success';
$lang['mansong_goods_add_fail'] = 'fail to add live merchandise ';
$lang['mansong_goods_delete_success'] = 'Delete the success';
$lang['mansong_goods_delete_fail'] = 'full and send activity goods Delete failed';
$lang['mansong_goods_cancel_success'] = 'cancel successfully ';
$lang['mansong_goods_cancel_fail'] = 'cancel_fail';
$lang['mansong_goods_limit_error'] = 'limit on number of active items ';
$lang['mansong_goods_is_exist'] = 'this commodity has participated in this expiry date, please choose other commodities ';
$lang['mansong_publish_success'] = 'publish successfully ';
$lang['mansong_publish_fail'] = 'publish failed on full activity ';
$lang['mansong_cancel_success'] = 'cancel successfully ';
$lang['mansong_cancel_fail'] = 'cancelable activity fails ';
$lang['mansong_level_price_error'] = 'consumption must be positive integer ';
$lang['mansong_level_discount_null'] = 'discount amount cannot be empty ';
$lang['mansong_level_discount_error'] = 'the discount amount must be a positive integer ';
$lang['mansong_level_gift_error'] = 'the name of the gift cannot be empty ';
$lang['mansong_level_rule_select_error'] = 'please select at least one promotion ';
$lang['mansong_level_error'] = 'high level sales must be greater than low level ';

$lang['setting_save_success'] = 'Save successfully';
$lang['setting_save_fail'] = 'Save failed';
$lang['mansong_explain1'] = 'commodities offered in limited time discount and rush rush can be offered in bulk at the same time ';

$lang['text_month'] = 'month';
$lang['text_gold'] = 'gold';
$lang['text_jian'] = 'item ';
$lang['text_ci'] = 'second ';
$lang['text_goods'] = 'goods';
$lang['text_normal'] = 'normal';
$lang['text_invalidation'] = 'invalidation';
$lang['text_default'] = 'default';
$lang['text_add'] = 'add';
$lang['text_back'] = 'return ';
$lang['text_level'] = 'level';
$lang['text_level_condition'] = 'full consumption ';
$lang['text_reduce'] = 'reduce';
$lang['text_yuan'] = 'yuan';
$lang['text_cash'] = 'cash';
$lang['text_give'] = 'give';
$lang['text_gift'] = 'gift';
$lang['text_link'] = 'link';
$lang['link_explain'] = 'the gift link must be the full url with http:// ';
$lang['text_new_level'] = 'new level';
$lang['text_remark'] = 'remark';
$lang['text_not_join'] = 'not joined ';
$lang['mansong_apply_verify_success_glog_desc'] = 'buy full free activity %s month, unit price %s $, total cost %s $';
