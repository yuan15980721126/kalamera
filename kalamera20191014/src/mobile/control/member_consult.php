<?php
/**
 * 买家商品咨询
 *
 *
 *
 
 
 
 
 */



defined('interMarket') or exit('Access Invalid!');
class member_consultControl extends mobileHomeControl {
    public function __construct() {
        parent::__construct();
        // Language::read('member_store_consult_index');
    }

    /**
     * 商品咨询首页
     */
    public function indexOp(){
        $this->my_consultOp();
    }

    /**
     * 查询买家商品咨询
     */
    public function my_consultOp(){
        //实例化商品咨询模型
        $consult    = Model('consult');
        $page   = new Page();
        $page->setEachNum(10);
        $page->setStyle('admin');
        $list_consult   = array();
        $search_array   = array();
        if ($member_id = $this->getMemberIdIfExists()) {


            if($_GET['type'] != ''){
                if($_GET['type'] == 'to_reply'){
                    if (C('dbdriver') == 'mysqli') {
                        $search_array['consult_reply']  = '';
                    } else {
                        $search_array['consult_reply']  = array('exp', 'consult_reply IS NULL');
                    }
                }
                if($_GET['type'] == 'replied'){
                    if (C('dbdriver') == 'mysqli') {
                        $search_array['consult_reply']  = array('neq', '');
                    } else {
                        $search_array['consult_reply']  = array('exp', 'consult_reply IS NOT NULL');
                    }
                }
            }
            $search_array['member_id']  = $member_id;
            $list_consult   = $consult->getConsultList($search_array,$page);
            // Tpl::output('show_page',$page->show());
            // Tpl::output('list_consult',$list_consult);
            // echo "<pre>";
            
            $model_goods = Model('goods');

            foreach ($list_consult as $key => $value) {

                $fields = 'goods_id,store_id,goods_name,goods_image,goods_price,goods_promotion_price';
                // $goods = $model_goods->getGoodsInfoByID($goods_id,$fields);
                $goods =$model_goods->getGoodsDetail($value['goods_id']);
                
                // cthumb($goods['goods_image'], 60);
                 // print_R($goods);
                $list_consult[$key]['goods_image'] =$goods['goods_image'][0][0];
                $list_consult[$key]['consult_reply_time'] = date('Y-m-d H:i:s',$value['consult_reply_time']);
                $list_consult[$key]['consult_addtime'] = date('Y-m-d H:i:s',$value['consult_addtime']);
               
            }
            $arr = array('consult'=>$list_consult);
        }else{
            $arr = array('consult'=>'');
        }
        output_data($arr);
        // output_error('预订商品不支持手机端显示');
        // $_GET['type']   = empty($_GET['type'])?'consult_list':$_GET['type'];
        // self::profile_menu('my_consult',$_GET['type']);
        // Tpl::showpage('member_my_consult');
    }
   
}
