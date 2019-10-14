<?php
/**
 * 商品报修
 *
 
 
 
 
 */
defined('interMarket') or exit('Access Invalid!');

class my_repaidControl extends BaseMemberControl {

    private $joinin_detail = NULL;
	public function __construct() {
		parent::__construct();
	}

  
	public function indexOp() {
        $this->my_repaidOp();
	}


    /**
     * 查看报修进度
     **/
    public function my_repaidOp() {

        $condition = array();

        if ($_POST['query'] != '') {
            $condition[$_POST['qtype']] = array('like', '%' . $_POST['query'] . '%');
        }
        // $condition['state'] = 1;
        $order = '';
        $model_store_joinin = Model('repaid');
        if($_GET['state']){
            $condition['state'] = $_GET['state'];
        }
        

        $repair = $model_store_joinin->getList($condition, 10, $order);
        
        
        $model_good = Model('goods');
        $attribute = Model('attribute');
        foreach ($repair as $key => $value) {
            $condition = array();
            $condition['goods_id'] = $value['goods_name'];
            $_name = $model_good->getGoodsInfo($condition,'goods_id,goods_name,goods_image');
            $repair[$key]['goods_id'] = $_name['goods_id'];
            $repair[$key]['goods_name'] = $_name['goods_name'];
            $repair[$key]['goods_image'] = $_name['goods_image'];


            $condition = array();

            $condition['attr_id'] = $value['goods_class'];
            $_val = $attribute->getAttributeList($condition,'attr_value');
            $repair[$key]['goods_class'] = $_val[0]['attr_value'];
            $repair[$key]['add_time'] = date('Y-m-d H:i:s',$value['add_time']);
        }
        // echo "<pre>";
        // print_R($page);
        Tpl::output('list', $repair);
        Tpl::output('show_page', $model_store_joinin->showpage());
 
        Tpl::showpage('my_repaid');
    }



     /**
     * 用户中心右边，小导航
     *
     * @param string    $menu_type  导航类型
     * @param string    $menu_key   当前导航的menu_key
     * @param array     $array      附加菜单
     * @return
     */
    private function profile_menu($menu_key='') {
        $menu_array = array(
            array('menu_key'=>'complain_accuser_list','menu_name'=>'商品报修','menu_url'=>'index.php?model=my_repaid&fun=my_repaid')
        );
        Tpl::output('member_menu',$menu_array);
        Tpl::output('menu_key',$menu_key);
    }
    


}
