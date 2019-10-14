<?php
/**
 * 前台分类
 *
 *
 *
 
 
 
 
 */



defined('interMarket') or exit('Access Invalid!');

class categoryControl extends BaseHomeControl {
    /**
     * 全部分类列表
     */
    public function indexOp(){
        $model_class = Model('goods_class');
        $goods_class = $model_class->getTreeClassList(1);//第一级商品分类



        $goods_class = $model_class->get_all_category();
        $show_goods_class = $goods_class;//商品分类
//        echo '<pre>';
//        print_r($show_goods_class);


        Tpl::output('goods_class', $show_goods_class );
        $nav_link_list = array(
            array(
                'title'=>'Products',
                'link'=>urlShop('category', 'index')
            ),

        );



        Tpl::output('nav_link_list', $nav_link_list );

        Tpl::output('html_title',C('site_name').' - '.Language::get('category_index_goods_class'));
        Tpl::showpage('category');
    }

    /**
     * 单个分类列表
     */
    public function oneOp(){
        Language::read('home_category_index');
        $parent_id = $_GET['cate_id'];
        $lang   = Language::getLangContent();

        $model_class = Model('goods_class');
        $goods_class = $model_class->getChildClass($parent_id);

        // echo "<pre>";
        
        foreach ($goods_class as $key => $value) {
            if($value['gc_parent_id'] == 0){
                $top = $value;
            }
        }
        //导航
        $nav_link = array(
            '0'=>array('title'=>$lang['homepage'],'link'=>SHOP_SITE_URL),
            '1'=>array('title'=>'商品分类 >'.$top['gc_name'])
        );

        
        // print_R($top);
        if($parent_id == $top['gc_id']){
            $where = $top['gc_name'].'分类广告';
        }
        $model = Model();
        $condition['ap_name'] = array('like','%'.$where.'%');
        $ap_list =$model->table('adv_position')->order('sort asc')->where($condition)->select();
        // echo "<pre>";
        // print_r($ap_list);
    
        Tpl::output('ap_list',$ap_list);
        Tpl::output('nav_link_list',$nav_link);
        // print_r($nav_link);
        Tpl::output('html_title',C('site_name').' - '.Language::get('category_index_goods_class'));
        Tpl::showpage('category');
    }
}
