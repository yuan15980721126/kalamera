<?php
defined('interMarket') or exit('Access Invalid!');
/**
 * 预存款功能公用
 */
$lang[' pret_no_record '] = 'no qualifying record';
$lang['predeposit_unavailable'] = 'the system has not opened the pre-deposit function ';
$lang['predeposit_parameter_error'] = 'parameter error';
$lang['predeposit_record_error'] = 'record information error';
$lang['predeposit_userrecord_error'] = 'member information error';
$lang[' pret_payment '] = 'mode of payment';
$lang['predeposit_addtime'] = 'create time';
$lang['predeposit_apptime'] = 'application time';
$lang['predeposit_checktime'] = 'audit time';
$lang['predeposit_paytime'] = 'payment time';
$lang['predeposit_addtime_to'] = 'to';
$lang['predeposit_trade_no'] = 'transaction number ';
$lang['predeposit_adminremark'] = 'administrator remark';
$lang['predeposit_recordstate'] = 'recordstate';
$lang['predeposit_paystate'] = 'state';
$lang['predeposit_backlist'] = 'return list';
$lang['predeposit_pricetype'] = 'deposit type';
$lang['predeposit_pricetype_available'] = 'available amount ';
$lang['predeposit_pricetype_freeze'] = 'frozen amount ';
$lang[' pret_price '] = 'amount ';
$lang['predeposit_payment_error'] = 'payment mode error';
/**
 * 充值功能公用
 */
$lang['predeposit_rechargesn'] = 'depositing order number ';
$lang['predeposit_rechargewaitpaying'] = 'unpaid ';
$lang['predeposit_rechargepaysuccess'] = 'paid ';
$lang['predeposit_rechargestate_auditing'] = 'auditing';
$lang['predeposit_rechargestate_completed'] = 'completed';
$lang['predeposit_rechargestate_closed'] = 'closed';
$lang['predeposit_recharge_price'] = 'recharge amount ';
$lang['predeposit_recharge_huikuanname'] = 'the depositors name';
$lang['predeposit_recharge_huikuanbank'] = 'depositing bank';
$lang['predeposit_recharge_huikuandate'] = 'transfer date';
$lang['predeposit_recharge_memberremark'] = 'memberremark';
$lang['predeposit_recharge_success'] = 'recharge successful ';
$lang['predeposit_recharge_fail'] = 'recharge failure ';
$lang['predeposit_recharge_pay'] = '1 & NBSP;Pay ';
$lang['predeposit_recharge_view'] = 'deposit_recharge_view';
$lang['predeposit_recharge_paydesc'] = 'depositing order ';
$lang['predeposit_recharge_pay_offline'] = 'to be confirmed ';
/**
 * 充值添加
 */
$lang['predeposit_recharge_add_pricenull_error'] = 'please add the depositing amount ';
$lang['predeposit_recharge_add_pricemin_error'] = 'number with recharge value greater than or equal to 0.01 ';
/**
 * 充值信息删除
 */
$lang['predeposit_recharge_del_success'] = 'deposit_recharge_del_success';
$lang['predeposit_recharge_del_fail'] = 'deposit_recharge_del_fail';
/**
 * 提现功能公用
 */
$lang['predeposit_cashsn'] = 'filing number ';
$lang['predeposit_cashmanage'] = 'cash management ';
$lang['predeposit_cashwaitpaying'] = 'waiting for payment ';
$lang['predeposit_cashpaysuccess'] = 'paid successfully ';
$lang['predeposit_cashstate_auditing'] = 'auditing';
$lang['predeposit_cashstate_completed'] = 'completed';
$lang['predeposit_cashstate_closed'] = 'closed';
$lang[' pret_cash_price '] = 'cash amount ';
$lang['predeposit_cash_shoukuanname'] = 'depositor name';
$lang['predeposit_cash_shoukuanbank'] = 'receiving bank';
$lang['predeposit_cash_shoukuanaccount'] = 'collection account';
$lang['predeposit_cash_shoukuanname_tip'] = 'it is strongly recommended to give priority to 4 state-owned Banks (bank of China, China construction bank, industrial and commercial bank of China and agricultural bank of China)<br/>';
$lang['predeposit_cash_shoukuanaccount_tip'] = 'bank account or virtual account (alipay, tenpay, etc.)';
$lang['predeposit_cash_shoukuanauser_tip'] = 'the name of the depositor ';
$lang['predeposit_cash_shortprice_error'] = 'insufficient deposit ';
$lang['predeposit_cash_price_tip'] = 'currently available amount ';
$lang['predeposit_cash_availablereducedesc'] = 'member applying for cash to reduce the amount of advance deposit ';
$lang['predeposit_cash_freezeadddesc'] = 'member request for cash increased amount of frozen deposit ';
$lang['predeposit_cash_availableadddesc'] = 'member deletes cash to increase advance deposit amount ';
$lang['predeposit_cash_freezereducedesc'] = 'member deletes cash to reduce frozen deposit amount ';

/**
 * 提现添加
 */
$lang['predeposit_cash_add_shoukuannamenull_error'] = 'please fill in the payees name ';
$lang['predeposit_cash_add_shoukuanbanknull_error'] = 'please fill in the receiving bank ';
$lang['predeposit_cash_add_pricemin_error'] = 'the depositing amount was greater than or equal to 0.01 ';
$lang['predeposit_cash_add_enough_error'] = 'account remaining sum is insufficient';
$lang['predeposit_cash_add_pricenull_error'] = 'please fill in the withdrawal amount ';
$lang['predeposit_cash_add_shoukuanaccountnull_error'] = 'please fill in the receiving account ';
$lang['predeposit_cash_add_success'] = 'your cash request has been successfully submitted. Please wait for the system to process ';
$lang['predeposit_cash_add_fail'] = 'withdrawal information add failure';
/**
 * 提现信息删除
 */
$lang[' pret_cash_del_success '] = 'deposit_cash_success ';
$lang['predeposit_cash_del_fail'] = 'deposit_cash_fail ';
/**
 * 支付接口
 */
$lang['predeposit_payment_pay_fail'] = 'recharge failure ';
$lang['predeposit_payment_pay_success'] = 'recharged, on way to my order ';
$lang['predepositrechargedesc'] = 'recharge ';
/**
 * 出入明细 
 */
$lang['predeposit_log_stage'] = 'type ';
$lang['predeposit_log_stage_recharge'] = 'recharge';
$lang['predeposit_log_stage_cash'] = 'withdraw ';
$lang['predeposit_log_stage_order'] = 'consumption ';
$lang['predeposit_log_stage_artificial']= 'manual modification ';
$lang['predeposit_log_stage_system'] = 'system';
$lang['predeposit_log_stage_income'] = 'income';
$lang['predeposit_log_desc'] = 'change description ';
?>