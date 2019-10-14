<?php
defined('interMarket') or exit('Access Invalid!');

class contactControl extends BaseHomeControl {

    public function indexOp() {
        // 当前位置导航

        $nav_link_list = array(
            array(
                'title'=>'Contact us',
                'link'=>urlShop('contact', 'index')
            ),
            //array(
            //    'title'=>'Account Details'
            //)
        );

        Tpl::output('nav_link_list', $nav_link_list );
        Tpl::showpage('contact');
    }
    public function supportOp() {
        // 当前位置导航

        $nav_link_list = array(
            array(
                'title'=>'Support',
                'link'=>urlShop('contact', 'support')
            ),
            //array(
            //    'title'=>'Account Details'
            //)
        );

        Tpl::output('nav_link_list', $nav_link_list );
        Tpl::showpage('support');
    }
}