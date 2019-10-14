<?php
defined('interMarket') or exit('Access Invalid!');
/**
 * 共有语言
 */

/**
 * 收货人信息
 */
$lang['member_address_receiver_name'] = 'recipient ';
$lang['member_address_location'] = 'location';
$lang['member_address_address'] = 'street address';
$lang['member_address_zipcode'] = 'zipcode';
$lang['member_address_phone'] = 'phone';
$lang['member_address_mobile'] = 'mobile';
$lang['member_address_edit_address'] = 'edit address';
$lang['member_address_no_address'] = 'you did not add the shipping address';
$lang['member_address_input_name'] = 'please fill in your real name';
$lang['member_address_please_choose'] = 'please select ';
$lang['member_address_not_repeat'] = 'do not repeat the locale ';
$lang['member_address_phone_num'] = 'phone number ';
$lang['member_address_area_num'] = 'area code ';
$lang['member_address_sub_phone'] = 'extension ';
$lang['member_address_phone'] = 'phone';
$lang['member_address_input_receiver'] = 'please fill in the receivers name ';
$lang['member_address_choose_location'] = 'please select the location';
$lang['member_address_input_address'] = 'please fill in the detailed address';
$lang['member_address_zip_code'] = 'zip code consists of 6 digits ';
$lang['member_address_phone_and_mobile']= 'landline and mobile phone, please fill in at least one item.';
$lang['member_address_phone_rule'] =
$lang['member_address_wrong_mobile'] = 'wrong phone number ';

/**
 * 设置发货地址
 */
$lang['store_daddress_wrong_argument'] = 'argument is incorrect ';
$lang['store_daddress_receiver_null'] = 'shipper cannot be null';
$lang['store_daddress_wrong_area'] = 'district selected incorrectly ';
$lang['store_daddress_area_null'] = 'the locale information cannot be empty ';
$lang['store_daddress_address_null'] = 'detailed address cannot be empty ';
$lang['store_daddress_modify_fail'] = 'failed to modify address ';
$lang['store_daddress_add_fail'] = 'new address failed ';
$lang['store_daddress_del_fail'] = 'failed to delete address ';
$lang['store_daddress_del_succ'] = 'Delete the success';
$lang['store_daddress_new_address'] = 'new address';
$lang['store_daddress_deliver_address'] = 'delivery address';
$lang['store_daddress_default'] = 'default';
$lang['store_daddress_receiver_name'] = 'contact ';
$lang['store_daddress_location'] = 'where ';
$lang['store_daddress_address'] = 'street address';
$lang['store_daddress_zipcode'] = 'zipcode';
$lang['store_daddress_phone'] = 'phone';
$lang['store_daddress_mobile'] = 'mobile';
$lang['store_daddress_company'] = 'company';
$lang['store_daddress_content'] = 'note ';
$lang['store_daddress_edit_address'] = 'edit address';
$lang['store_daddress_no_address'] = 'you did not add shipping address';
$lang['store_daddress_input_name'] = 'please fill in your real name';
$lang['store_daddress_please_choose'] = 'please select ';
$lang['store_daddress_not_repeat'] = 'do not repeat the locale ';
$lang['store_daddress_phone_num'] = 'phone ';
$lang['store_daddress_area_num'] = 'area code ';
$lang['store_daddress_sub_phone'] = 'extension ';
$lang['store_daddress_mobile_num'] = 'mobile number ';
$lang['store_daddress_input_receiver'] = 'please fill in the contact name ';
$lang['store_daddress_choose_location'] = 'please select the location';
$lang['store_daddress_input_address'] = 'please fill in the street address';
$lang['store_daddress_zip_code'] = 'zip code consists of 6 digits ';
$lang['store_daddress_phone'] = 'phone';
$lang['store_daddress_phone_rule'] = 'phone Numbers consist of Numbers, plus, minus, Spaces, and parentheses, and cannot be less than 6 digits. ';
$lang['store_daddress_wrong_mobile'] = 'wrong phone number ';

/**
 * 设置物流公司
 */
$lang['store_deliver_express_title'] = 'logistics company ';
/**
 * 发货
 */
$lang['store_deliver_order_state_send'] = 'delivered ';
$lang['store_deliver_order_state_receive'] = 'receive';
//$lang [' store_deliver_modfiy_address] = 'modify receiving information;
$lang['store_deliver_select_daddress'] = 'select delivery address';
$lang['store_deliver_select_ather_daddress']= 'select other delivery addresses ';
$lang['store_deliver_daddress_list'] = '地址库 ';
$lang['store_deliver_default_express'] = '默认物流公司 ';
$lang['store_deliver_buyer_name'] = 'buyer ';
$lang['store_deliver_buyer_address'] = 'delivery address';
$lang['store_deliver_shipping_amount'] = 'freight ';
$lang['store_deliver_modify_info'] = 'edit delivery ';
$lang['store_deliver_first_step'] = 'first step';
$lang['store_deliver_second_step'] = 'second step';
$lang['store_deliver_third_step'] = 'third step';
$lang['store_deliver_confirm_trade'] = 'confirm shipping information and trade details ';
$lang['store_deliver_forget'] = 'delivery memo ';
$lang['store_deliver_forget_tips'] = 'you can enter some delivery memo information (only visible to the seller) ';
$lang['store_deliver_buyer_adress'] = 'consignee information ';
$lang['store_deliver_confirm_daddress'] = 'confirm shipping information ';
$lang['store_deliver_my_daddress'] = 'my delivery information ';
$lang['store_deliver_none_set'] = 'the delivery address has not been set yet, please enter the delivery setting > address library to add ';
$lang['store_deliver_add_daddress'] = 'add delivery address';
$lang['store_deliver_express_select'] = 'select logistics service ';
$lang['store_deliver_express_note']	 = 'You can add or modify common freight logistics by "shipping Settings -> default logistics company".Free shipping can switch the [no logistics and transportation services] TAB below and operate。';$lang['store_deliver_express_zx'] = 'contact the logistics company ';
$lang['store_deliver_express_wx'] = 'no logistics service required ';
$lang['store_deliver_company_name'] = 'company name';
$lang['store_deliver_shipping_code'] = 'logistics tracking number ';
$lang['store_deliver_bforget'] = 'forget';
$lang['store_deliver_shipping_code_tips'] = 'fill in the logistics tracking number correctly to ensure that the tracking information is correct ';
$lang['store_deliver_no_deliver_tips'] = 'if the goods in the order do not need to be delivered by logistics, you can directly click confirm ';
$lang['store_deliver_shipping_code_pl'] = 'please fill in the logistics tracking number ';
$lang['store_deliver_bforget_pl'] = 'please fill in the reminder ';

/**
 * 选择发货地址
 */
$lang['store_deliver_man']			= 'The consignor,';
$lang['store_deliver_daddress']		= 'The delivery address';
$lang['store_deliver_telphone']		= 'The phone';

/**
 * search动态物流
 */
$lang['member_show_expre_my_fdback']		= 'I leave a message';
$lang['member_show_expre_type']				= 'Delivery method: contact by yourself';
$lang['member_show_expre_company']			= 'Logistics company';
$lang['member_show_receive_info']			= 'Receiving information';
$lang['member_show_deliver_info']			= 'The delivery information';