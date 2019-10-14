<?php
/**
 * cms专题
 *
 *
 
 
 
 
 */



defined('interMarket') or exit('Access Invalid!');
class specialControl extends BaseHomeControl{

    public function __construct() {
        parent::__construct();
        Tpl::output('index_sign','special');
    }

    public function indexOp() {
        $this->special_listOp();
    }

    /**
     * 专题列表
     */
    public function special_listOp() {
        $conition = array();
        $conition['special_state'] = 2;
        $model_special = Model('cms_special');
        $special_list = $model_special->getShopList($conition, 10, 'special_id desc');
        Tpl::output('show_page', $model_special->showpage(2));
        Tpl::output('special_list', $special_list);

        //分类导航
        $nav_link = array(
            0=>array(
                'title'=>Language::get('homepage'),
                'link'=>SHOP_SITE_URL
            ),
            1=>array(
                'title'=>'专题'
            )
        );
        Tpl::output('nav_link_list', $nav_link);

        Tpl::showpage('special_list');
    }

    /**
     * 专题详细页
     */
    public function special_detailOp() {
		$special_id = intval($_GET['special_id']);
        $model_special = Model('cms_special');
        $special_detail = $model_special->getonlyOne($_GET['special_id']);
        $special_file = getCMSSpecialHtml($special_id);
		$seo_param = array();
        $seo_param['name'] = $special_detail['special_title'];
        $seo_param['key'] = $special_detail['special_stitle'];
        $seo_param['description'] = $special_detail['special_stitle'];
		 Model('seo')->type('product')->param($seo_param)->show();
        if($special_file) {
            Tpl::output('special_file', $special_file);
            Tpl::output('index_sign', 'special');
            Tpl::showpage('special_detail');
        } else {
            showMessage('The Special doesn\'t exist', '', '', 'error');
        }

    }

    /**
     * wheretobuy
     */
    public function showOp() {
        $nav_link_list = array(
            array(
                'title'=>'Where to buy',
                'link'=>urlShop('special', 'show')
            ),
            //array(
            //    'title'=>'Account Details'
            //)
        );



        Tpl::output('nav_link_list', $nav_link_list );
        Tpl::showpage('special_show');

    }





}
