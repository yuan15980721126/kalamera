<?php
defined('interMarket') or exit('Access Invalid!');

$lang['promotion_unavailable'] = '商品促销功能尚未开启';

$lang['promotion_xianshi'] = '限时折扣';

$lang['promotion_active_list'] 	= '活动列表';
$lang['promotion_quota_list'] 	= '套餐列表';
$lang['promotion_join_active'] 	= '添加活动';
$lang['promotion_buy_product'] 	= '购买套餐';
$lang['promotion_goods_manage'] = '商品管理';
$lang['promotion_add_goods'] 	= '添加商品';


$lang['state_new'] = '新申请';
$lang['state_verify'] = '已审核';
$lang['state_cancel'] = '已取消';
$lang['state_verify_fail'] = '审核失败';
$lang['xianshi_state_unpublished'] = '未发布';
$lang['xianshi_state_published'] = '已发布';
$lang['xianshi_state_cancel'] = '已取消';
$lang['all_state'] = '全部状态';


$lang['xianshi_quota_start_time'] = '开始时间';
$lang['xianshi_quota_end_time'] = '结束时间';
$lang['xianshi_quota_times_limit'] = '活动次数限制';
$lang['xianshi_quota_times_published'] = '已发布活动次数';
$lang['xianshi_quota_times_publish'] = '剩余活动次数';
$lang['xianshi_quota_goods_limit'] = '商品限制';
$lang['xianshi_name'] = '活动名称';
$lang['xianshi_apply_date'] = '套餐申请时间';
$lang['xianshi_apply_quantity'] = '申请数量（月）';
$lang['apply_date'] = '申请时间';
$lang['apply_quantity'] = '申请数量';
$lang['apply_quantity_unit'] = '（包月）';
$lang['xianshi_discount'] = '折扣';
$lang['xianshi_buy_limit'] = '购买限制';

$lang['start_time'] = 'start time';
$lang['end_time'] = 'end time';
$lang['xianshi_list'] = 'time-limited discount ';
$lang['mansong_list'] = 'song_list';
$lang['xianshi_add'] = 'add activity ';
$lang['xianshi_index'] = 'active list ';
$lang['xianshi_quota'] = 'packages list ';
$lang['xianshi_apply'] = 'list of applications ';
$lang['xianshi_manage'] = 'activity management ';
$lang['xianshi_quota_add'] = 'buy package ';
$lang['xianshi_quota_add_quantity'] = 'xianshi_quota_add_quantity';
$lang['xianshi_quota_add_confirm'] = 'Confirm purchase?You will have to pay altogether';
$lang['goods_add'] = 'add item ';
$lang['choose_goods'] = 'choose active goods';
$lang['goods_name'] = 'commodity name';
$lang['goods_store_price'] = 'goods price';
$lang['xianshi_goods_selected'] = 'selected goods ';
$lang['xianshi_publish'] = 'publish activity ';
$lang['ensure_publish'] = 'publish activity?';
$lang['xianshi_no_goods'] = 'you have not selected active goods';
$lang['xianshi_goods_exist'] = 'xianshi_goods_exist';

$lang['xianshi_price'] = 'number of gold COINS needed for buying time-limited discount ';
$lang['xianshi_explain1'] = '1, click the buy and renew buttons to buy or renew the xianshi_explain1';
$lang['xianshi_explain2'] = '2. Click the add activity button to add limited-time discount activities and click the manage button to manage the goods in limited-time discount activities ';
$lang['xianshi_explain3'] = '3, click the delete button to delete time-limited discount activities ';
$lang['xianshi_manage_goods_explain1'] = '1, time slots of time-limited discount commodities cannot be overlain ';
$lang['xianshi_manage_goods_explain2'] = '2, click on the add item button to search and add the active item, click on the delete button to delete the item ';
$lang['xianshi_price_explain1'] = 'purchasing unit is month (30 days), you can publish limited time discount activities within the purchasing cycle ';
$lang['xianshi_price_explain2'] = 'monthly (30 days) ';
$lang['xianshi_add_explain1'] = 'you can also create %s activities for this issue ';
$lang['xianshi_add_start_time_explain'] = 'starting time cannot be empty and no earlier than %s';
$lang['xianshi_add_end_time_explain'] = 'ending time cannot be empty and cannot be later than %s';
$lang['xianshi_discount_explain'] = 'discount must be between 0.1 and 9.9 ';
$lang['xianshi_buy_limit_explain'] = 'buy limit must be positive integer ';
$lang['time_error'] = 'time_error';
$lang['param_error'] = 'Parameter error';
$lang['greater_than_start_time'] = 'end time must be greater than start time';
$lang['xianshi_price_error'] = 'cannot be empty and must be a positive integer ';
$lang['xianshi_name_explain'] = 'activity name will be displayed in the list of time-limited discount activities, which is convenient for business management and use, and can be entered up to 25 characters.';
$lang['xianshi_title_explain'] = 'activity title is an alias operation for time-limited discount activities, please use phrases such as "new goods discount" and "month end discount"; maximum 10 characters are allowed;<br/> is not required.';
$lang['xianshi_explain_explain'] = 'activity description is a supplement to the time-limited discount activities and is displayed on the product details page - offer information location;<br/> non-mandatory, up to 30 characters.';
$lang['xianshi_name_error'] = 'activity name cannot be empty ';
$lang['xianshi_quota_quantity_error'] = 'the number cannot be empty and must be an integer between 1 and 12 ';
$lang['xianshi_quota_add_success'] = 'time limited discount package bought successfully ';
$lang['xianshi_quota_add_fail'] = 'time limited discount package purchasing application fails ';
$lang['xianshi_quota_add_fail_nogold'] = 'time limited discount package purchasing application failed; you dont have enough gold COINS ';
$lang['xianshi_quota_current_error'] = 'no current time discount package available, please buy the package first ';
$lang['xianshi_quota_current_error1'] = 'you have not applied to buy a limited-time discount package or the package has expired <br/> please buy a new limited-time discount package.';
$lang['xianshi_quota_current_error2'] = 'you have bought a time-limited discount package ';
$lang['xianshi_quota_current_error3'] = 'you cant publish new activities on your current package ';
$lang['xianshi_add_success'] = 'limited time discount activity added successfully, please select the goods to join the activity and publish the activity ';
$lang['xianshi_active_status'] = 'active state ';
$lang['xianshi_add_fail'] = 'limited-time discount activity adds failure ';
$lang['xianshi_goods_none'] = 'you have not added active goods ';
$lang['xianshi_goods_add_success'] = 'temporary discount activity goods added successfully ';
$lang['xianshi_goods_add_fail'] = 'limited-time discount activity goods add failure ';
$lang['xianshi_goods_delete_success'] = 'timed discount activity goods Delete the success';
$lang['xianshi_goods_delete_fail'] = 'time-limited discount activity goods Delete failed';
$lang['xianshi_goods_cancel_fail'] = 'time-limited discount activity goods cancel failure ';
$lang['xianshi_goods_limit_error'] = 'active goods limit is exceeded ';
$lang['xianshi_goods_is_exist'] = 'this goods has participated in this period of time limited discount, please select other goods ';
$lang['xianshi_publish_success'] = 'time limited discount activity published successfully ';
$lang['xianshi_publish_fail'] = 'timed discount activity publish failure ';
$lang['xianshi_cancel_success'] = 'time-limited discount activity cancelled successfully ';
$lang['xianshi_cancel_fail'] = 'time limited discount activity cancels failure ';

$lang['setting_save_success'] = 'setting saved successfully ';
$lang['setting_save_fail'] = 'setting save failed ';

$lang['text_month'] = 'month';
$lang['text_gold'] = 'gold';
$lang['text_jian'] = 'item ';
$lang['text_ci'] = 'second ';
$lang['text_goods'] = 'goods';
$lang['text_normal'] = 'normal';
$lang['text_invalidation'] = 'invalidation';
$lang['text_default'] = 'default';
$lang['text_add'] = 'add';
$lang['xianshi_apply_verify_success_glog_desc'] = 'buy time-limited discount activity %s month, unit price %s gold COINS, total cost %s gold COINS ';
