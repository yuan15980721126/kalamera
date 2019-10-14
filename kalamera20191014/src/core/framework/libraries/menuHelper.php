<?php

function getMemmberMenus() {
    $menu_list = array(
        'member_order'      => array('name' => 'Order history', 'url' => urlShop('member_order', 'index')),
        'member_refund'     => array('name' => 'Return management', 'url' => urlShop('member_return', 'index')),
        'member_evaluate'   => array('name' => 'Write a review', 'url' => urlShop('member_evaluate','goodsadd')),
        'member_information'=> array('name' => 'Account Details', 'url'=>urlMember('member_information', 'index')),
        'member_security'   => array('name' => 'Account security', 'url'=>urlMember('member_security','modify_pwd')),
        'member_address'    => array('name' => 'Addresses', 'url'=>urlMember('member_address', 'address')),
        'member_favorite_goods' => array('name' => 'Favorites', 'url' => urlShop('member_favorite_goods', 'index')),
    );

//    $menu_list = array(
//        'trade' => array('name' => '交易中心', 'child' => array(
//            'member_order'      => array('name' => '所有订单', 'url' => urlShop('member_order', 'index')),
//            #'member_vr_order'   => array('name' => '虚拟兑码订单', 'url' => urlShop('member_vr_order', 'index')),
//            'member_evaluate'   => array('name' => '交易评价/晒单', 'url' => urlShop('member_evaluate', 'list')),
//            #'member_appoint'    => array('name' => '预约/到货通知', 'url' => urlShop('member_appoint', 'list'))
//        )),
//        'follow' => array('name' => '关注中心', 'child' => array(
//            'member_favorite_goods' => array('name' => '商品收藏', 'url' => urlShop('member_favorite_goods', 'index')),
//            #'member_favorite_store' => array('name' => '店铺收藏', 'url' => urlShop('member_favorite_store', 'index')),
//            'member_goodsbrowse'   => array('name' => '我的足迹', 'url' => urlShop('member_goodsbrowse', 'list'))
//        )),
//        'client' => array('name' => '客户服务', 'child' => array(
//            'member_refund'     => array('name' => '退款及退货', 'url' => urlShop('member_refund', 'index')),
//            'member_complain'   => array('name' => '交易投诉', 'url' => urlShop('member_complain', 'index')),
//            'member_consult'    => array('name' => '商品咨询', 'url' => urlShop('member_consult', 'my_consult')),
//            // 'member_inform'     => array('name' => '违规举报', 'url' => urlShop('member_inform', 'index')),
//            'member_repair'     => array('name' => '商品报修', 'url' => urlShop('my_repaid','index')),
//            #'member_mallconsult'=> array('name' => '平台客服', 'url' => urlShop('member_mallconsult', 'index'))
//        )),
//        'info' => array('name' => '会员资料', 'child' => array(
//            'member_information'=> array('name' => '账户信息', 'url'=>urlMember('member_information', 'member')),
//            'member_address'    => array('name' => '收货地址', 'url'=>urlMember('member_address', 'address'))
//        )),
//        'property' => array('name' => '财产中心', 'child' => array(
//            'predeposit'        => array('name' => '账户余额', 'url'=>urlMember('predeposit', 'pd_log_list')),
//            'member_voucher'    => array('name' => '我的代金券', 'url'=>urlMember('member_voucher', 'index')),
//            #'member_redpacket'  => array('name' => '我的红包', 'url'=>urlMember('member_redpacket', 'index'))
//        )),
//
//        'info' => array('name' => '会员资料', 'child' => array(
//            'member_information'=> array('name' => '账户信息', 'url'=>urlMember('member_information', 'member')),
//            'member_security'   => array('name' => '账户安全', 'url'=>urlMember('member_security', 'index')),
//            'member_grade'   => array('name' => '我的级别', 'url'=>urlShop('pointgrade', 'index')),
//            'member_address'    => array('name' => '收货地址', 'url'=>urlMember('member_address', 'address')),
//            'member_message'    => array('name' => '我的消息', 'url'=>urlMember('member_message', 'systemmsg')),
//            //'member_snsfriend'  => array('name' => '我的好友', 'url'=>urlMember('member_snsfriend', 'find')),
//            //'member_bind'       => array('name' => '第三方账号登录', 'url'=>urlMember('member_bind', 'qqbind')),
//            //'member_sharemanage'=> array('name' => '分享绑定', 'url'=>urlMember('member_sharemanage', 'index'))
//        )),
//        'property' => array('name' => '财产中心', 'child' => array(
//            'consume'           => array('name' => '消费记录', 'url'=>urlMember('consume')),
////             'predeposit'        => array('name' => '账户余额', 'url'=>urlMember('predeposit', 'pd_log_list')),
//            'member_points'     => array('name' => '我的积分', 'url'=>urlMember('member_points', 'index')),
//            'member_voucher'    => array('name' => '我的优惠券', 'url'=>urlMember('member_voucher', 'index')),
//            // 'member_redpacket'  => array('name' => '我的红包', 'url'=>urlMember('member_redpacket', 'index'))
//
//        ))
//    );
    return $menu_list;
}