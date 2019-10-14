<?php
/**
 * 前台商品
 *
 *
 *
 *
 

 
 */



defined('interMarket') or exit('Access Invalid!');

class goodsControl extends BaseGoodsControl {
    public function __construct() {
        parent::__construct ();
        Language::read('store_goods_index');
    }

    /**
     * 全部商品
     */
    public function allOp() {
        $type = intval($_GET['type']);
        $model_goods = Model('goods');
        $condition = array();
        // $condition['store_id'] = $_SESSION['store_id'];
        // $condition['goods_name'] = array('like', '%'.$_GET['goods_name'].'%');
        $goods_list = $model_goods->getGeneralGoodsOnlineList($condition, '*', 10);
        // $goods_list = $model_goods->getGeneralGoodsOnlineList();
        // echo "<pre>";
        // print_R($menu_list);
        Tpl::showpage('all','null_layout');
    }
    /**
     * 单个商品信息页
     */
    public function indexOp() {
        $goods_id = intval($_GET['goods_id']);

        // 商品详细信息
        $model_goods = Model('goods');
        $goods_detail = $model_goods->getGoodsDetail($goods_id);
        $goods_info = $goods_detail['goods_info'];
        if (empty($goods_info)) {
            showMessage(L('goods_index_no_goods'), '', 'html', 'error');
        }
//          echo "<pre>";
//
//         print_R($goods_info);
        $this->getStoreInfo($goods_info['store_id'], $goods_info);

        // 看了又看（同分类本店随机商品）
        $size = $goods_info['is_own_shop'] ? 6 : 4;
        $goods_rand_list = $model_goods->getGoodsGcStoreRandList($goods_info['gc_id_1'], $goods_info['store_id'], $goods_info['goods_id'], $size);

        $goods_info['goods_quality'] = htmlspecialchars_decode(htmlspecialchars_decode($goods_info['goods_quality']));
        $goods_info['goods_guarantee'] = htmlspecialchars_decode(htmlspecialchars_decode($goods_info['goods_guarantee']));
        $goods_info['goods_spec_desc'] = htmlspecialchars_decode(htmlspecialchars_decode($goods_info['goods_spec_desc']));
        $goods_info['goods_tixing'] = htmlspecialchars_decode(htmlspecialchars_decode($goods_info['goods_tixing']));

        $goods_common = Model('goods')->getGoodsCommonInfoByID($goods_info['goods_commonid'], 'goods_files');
        $goods_info['goods_files'] = unserialize($goods_common['goods_files']);
        $goods_info['goods_repair'] = unserialize($goods_common['goods_repair']);

         //echo "<pre>";
         //print_R($goods_info);die;
        Tpl::output('goods_rand_list', $goods_rand_list);

        // 获得猜你喜欢
        $goodslist = Model('goods_browse')->getGuessLikeGoods($_SESSION['member_id'], 20);
        // echo "<pre>";echo $_SESSION['member_id'];
        // print_R($goodslist);
        if(!empty($goodslist)){
            Tpl::output('goodslist',$goodslist);
        }

        //售后政策
        $model_article_class    = Model('article_class');
        $model_article  = Model('article');
        $condition  = array();
        $condition['ac_id'] = '10';
        $condition['article_show'] = '1';
        $condition['field'] = 'article.article_id,article.ac_id,article.article_url,article_class.ac_code,article.article_position,article.article_title,article.article_time,article.article_content,article_class.ac_name,article_class.ac_parent_id';
        $condition['order'] = 'article_sort asc,article_time desc';
        $condition['limit'] = '300';
        $service_list  = $model_article->getJoinList($condition);
        // Tpl::output('service_list', $service_list);


        // $sub_class_list = $model_article_class->getClassList($condition);
        // if(empty($sub_class_list) || !is_array($sub_class_list)){
        //     $condition['ac_parent_id']  = $article_class['ac_parent_id'];
        //     $sub_class_list = $article_class_model->getClassList($condition);
        // }
        // Tpl::output('sub_class_list',$sub_class_list);
        //  echo "<pre>";
        // print_R($service_list);

        //热销排行
        $model_store = Model('store');
        $hot_sales = $model_store->getHotSalesList($store_info['store_id'], 5);
        Tpl::output('hot_sales', $hot_sales);
        
        Tpl::output('spec_list', $goods_detail['spec_list']);
        Tpl::output('spec_image', $goods_detail['spec_image']);
        Tpl::output('goods_image', $goods_detail['goods_image']);
        Tpl::output('mansong_info', $goods_detail['mansong_info']);
        Tpl::output('gift_array', $goods_detail['gift_array']);

        // 浏览过的商品
        $viewed_goods = Model('goods_browse')->getViewedGoodsList($_SESSION['member_id'], 20);
        Tpl::output('viewed_goods', $viewed_goods);
        // echo "<pre>";

        // print_R($viewed_goods);
        // 生成缓存的键值
        $hash_key = $goods_info['goods_id'];
        $_cache = rcache($hash_key, 'product');
        if (empty($_cache)) {
            // 查询SNS中该商品的信息
            $snsgoodsinfo = Model('sns_goods')->getSNSGoodsInfo(array('snsgoods_goodsid' => $goods_info['goods_id']), 'snsgoods_likenum,snsgoods_sharenum');
            $_cache = array();
            $_cache['likenum'] = $snsgoodsinfo['snsgoods_likenum'];
            $_cache['sharenum'] = $snsgoodsinfo['snsgoods_sharenum'];
            // 缓存商品信息
            wcache($hash_key, $_cache, 'product');
        }
        $goods_info = array_merge($goods_info, $_cache);

        $inform_switch = true;
        // 检测商品是否下架,检查是否为店主本人
        if ($goods_info['goods_state'] != 1 || $goods_info['goods_verify'] != 1 || $goods_info['store_id'] == $_SESSION['store_id']) {
            $inform_switch = false;
        }
        Tpl::output('inform_switch',$inform_switch );

        // 如果使用运费模板
        if ($goods_info['transport_id'] > 0) {
            // 取得三种运送方式默认运费
            $model_transport = Model('transport');
            $transport = $model_transport->getExtendList(array('transport_id' => $goods_info['transport_id']));
            if (!empty($transport) && is_array($transport)) {
                foreach ($transport as $v) {
                    $goods_info[$v['type'] . "_price"] = $v['sprice'];
                }
            }
        }
        // 验证预定商品是否到期
        if ($goods_info['is_book'] == 1) {
            if ( $goods_info['book_down_time'] < TIMESTAMP ) {
                QueueClient::push('updateGoodsPromotionPriceByGoodsId', $goods_info['goods_id']);
                $goods_info['is_book'] = 0;
            } else {
                $remain_time = intval($goods_info['book_down_time'])- TIMESTAMP; //剩余的时间
                $remain_day = floor($remain_time/(60*60*24)); //剩余的天数
                $remain_hour = floor(($remain_time - $remain_day*60*60*24)/(60*60)); //剩余的小时数
                $remain_minute = floor(($remain_time - $remain_day*60*60*24 - $remain_hour*60*60)/60); //剩余的分钟数
                Tpl::output('remain', array('day' => $remain_day, 'hour' => $remain_hour, 'minute' => $remain_minute));
            }
        }
        //处理商品消费者保障服务信息
        $goods_list = $model_goods->getGoodsContract(array(0=>$goods_info));
        $goods_info = $goods_list[0];
        // echo "<pre>";
        // print_R($service_list);
        $class = array(1,2,3);
        if (in_array($goods_info['gc_id_1'], $class)){//新增分类售后政策
            if(!empty($service_list)){
                foreach ($service_list as $k => $v) {
                    if(strstr($v['article_title'],'葡萄酒售后政策') && $goods_info['gc_id_1'] == 1){
                        $service = $service_list[$k];
                        break;
                    }else if(strstr($v['article_title'],'恒温酒柜售后政策') && $goods_info['gc_id_1'] == 2){
                        $service = $service_list[$k];
                        break;
                    }else if(strstr($v['article_title'],'酒具售后政策') && $goods_info['gc_id_1'] == 3){
                        $service = $service_list[$k];
                        break;
                    }
                }
            }
        //     echo "<pre>";
        // print_R($service);
            $arr[0] = $service;
            Tpl::output('service_list', $arr);
        }else{
            Tpl::output('service_list', $service_list);
        }
        
        
        Tpl::output('goods', $goods_info);
        $model_plate = Model('store_plate');
        // 顶部关联版式
        if ($goods_info['plateid_top'] > 0) {
            $plate_top = $model_plate->getStorePlateInfoByID($goods_info['plateid_top']);
            Tpl::output('plate_top', $plate_top);
        }
        // 底部关联版式
        if ($goods_info['plateid_bottom'] > 0) {
            $plate_bottom = $model_plate->getStorePlateInfoByID($goods_info['plateid_bottom']);
            Tpl::output('plate_bottom', $plate_bottom);
        }
        Tpl::output('store_id', $goods_info['store_id']);
        
        //推荐商品
        $goods_commend_list = $model_goods->getGoodsCommendList($goods_info['store_id'], 6);
        Tpl::output('goods_commend',$goods_commend_list);
        //  echo "<pre>";
        

         //购物车还买了
        $cart_commend_list = $model_goods->getGoodsCommendList($goods_info['store_id'], 4);
        Tpl::output('cart_commend',$cart_commend_list);

        // print_R($goods_commend_list);
        // 当前位置导航
        $nav_link_list = Model('goods_class')->getGoodsClassNav($goods_info['gc_id'], 0);
        $nav_link_list[] = array('title' => $goods_info['goods_name']);
         //echo "<pre>";
         //print_R($nav_link_list);
        Tpl::output('nav_link_list', $nav_link_list);

        //评价信息
        $goods_evaluate_info = Model('evaluate_goods')->getEvaluateGoodsInfoByGoodsID($goods_id);
        // echo "<pre>";
        // print_R($goods_evaluate_info);
        Tpl::output('goods_evaluate_info', $goods_evaluate_info);

        $seo_param = array();
        $seo_param['name'] = $goods_info['goods_name'];
        $seo_param['key'] = $goods_info['goods_keywords'];
        $seo_param['description'] = $goods_info['goods_description'];
        Model('seo')->type('product')->param($seo_param)->show();


        $og = array();
        $og['url'] = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
        $og['title'] = $goods_info['goods_name'] . ' - kalamera';
        $og['description'] = $goods_info['goods_body'];

        if (!empty($goods_detail['goods_image']))
        {
            $times = 0;
            foreach ($goods_detail['goods_image'] as $value)
            {
                if (!$times)
                {
                    $og['image'] = pcthumb($value);
                    break;
                }
            }
        }

//        $og['description'] = preg_replace('/<img\b[^>]*>/', '', $og['description']);
//        $og['description'] = $og['description'] ? $og['description'] : $goods_info['goods_name'];

        if($og['description'] != strip_tags($og['description'])){
            $og['description'] = $goods_info['goods_name'];
        }


        Tpl::showpage('goods');
    }
    /**
     * 记录浏览历史
     */
    public function addbrowseOp(){
        $goods_id = intval($_GET['gid']);
        if (!$_SESSION['member_id']) {
            Model('goods_browse')->addViewedGoodsToCookie($goods_id);
        }
        QueueClient::push('addViewedGoods', array('goods_id'=>$goods_id,'member_id'=>$_SESSION['member_id'],'store_id'=>$_SESSION['store_id']));
        exit();
    }

    /**
     * 商品评论
     */
    public function commentsOp() {
        $goods_id = intval($_GET['goods_id']);
        $this->_get_comments($goods_id, $_GET['type'], 5);
        Tpl::showpage('goods.comments','null_layout');
    }

    /**
     * 商品评价详细页
     */
    public function comments_listOp() {
        $goods_id = intval($_GET['goods_id']);

        // 商品详细信息
        $model_goods = Model('goods');
        $goods_info = $model_goods->getGoodsInfoByID($goods_id, '*');
        // 验证商品是否存在
        if (empty($goods_info)) {
            showMessage(L('goods_index_no_goods'), '', 'html', 'error');
        }
        Tpl::output('goods', $goods_info);

        $this->getStoreInfo($goods_info['store_id']);

        // 当前位置导航
        $nav_link_list = Model('goods_class')->getGoodsClassNav($goods_info['gc_id'], 0);
        $nav_link_list[] = array('title' => $goods_info['goods_name'], 'link' => urlShop('goods', 'index', array('goods_id' => $goods_id)));
        $nav_link_list[] = array('title' => '商品评价');
        Tpl::output('nav_link_list', $nav_link_list );

        //评价信息
        $goods_evaluate_info = Model('evaluate_goods')->getEvaluateGoodsInfoByGoodsID($goods_id);
        Tpl::output('goods_evaluate_info', $goods_evaluate_info);

        $seo_param = array ();

        $seo_param['name'] = $goods_info['goods_name'];
        $seo_param['key'] = $goods_info['goods_keywords'];
        $seo_param['description'] = $goods_info['goods_description'];
        Model('seo')->type('product')->param($seo_param)->show();

        $this->_get_comments($goods_id, $_GET['type'], 20);

        Tpl::showpage('goods.comments_list');
    }

    private function _get_comments($goods_id, $type, $page) {
        $condition = array();
        $condition['geval_goodsid'] = $goods_id;
        switch ($type) {
            case '1':
                $condition['geval_scores'] = array('in', '5,4');
                Tpl::output('type', '1');
                break;
            case '2':
                $condition['geval_scores'] = array('in', '3,2');
                Tpl::output('type', '2');
                break;
            case '3':
                $condition['geval_scores'] = array('in', '1');
                Tpl::output('type', '3');
                break;
            case '4':
                $condition['geval_image|geval_image_again'] = array('neq', '');
                break;
        }
        //print_r($condition);
        //查询商品评分信息
        $model_evaluate_goods = Model("evaluate_goods");
        $goodsevallist = $model_evaluate_goods->getEvaluateGoodsList($condition, $page);
        Tpl::output('goodsevallist',$goodsevallist);
         //echo "<pre>";
         //print_r($goodsevallist);
        Tpl::output('show_page',$model_evaluate_goods->showpage('5'));
    }

    /**
     * 销售记录
     */
    public function salelogOp() {
        $goods_id    = intval($_GET['goods_id']);
        if ($_GET['vr']) {
            $model_order = Model('vr_order');
            $sales = $model_order->getOrderAndOrderGoodsSalesRecordList(array('goods_id'=>$goods_id), '*', 10);
        } else {
            $model_order = Model('order');
             $sales = $model_order->getOrderAndOrderGoodsSalesRecordList(array('order_goods.goods_id'=>$goods_id), 'order_goods.*, orders.buyer_name, orders.add_time', 10);
        }
        Tpl::output('show_page',$model_order->showpage());
        Tpl::output('sales',$sales);

        Tpl::output('order_type', array(1=>'原价', 2=>'抢购', 3=>'折扣', 4=>'套装', 5=>'赠品', 8=>'原价', 9=>'换购'));
        Tpl::output('order_vr_type', array(0=>'原价', 1=>'抢购'));
        Tpl::showpage('goods.salelog','null_layout');
    }

    /**
     * 产品咨询
     */
    public function consultingOp() {
        $goods_id = intval($_GET['goods_id']);
        if($goods_id <= 0){
            showMessage(Language::get('wrong_argument'),'','html','error');
        }

        //得到商品咨询信息
        $model_consult = Model('consult');
        $where = array();
        $where['goods_id'] = $goods_id;
        if (intval($_GET['ctid']) > 0) {
            $where['ct_id'] = intval($_GET['ctid']);
            Tpl::output('ct_id', intval($_GET['ctid']));
        }
        $consult_list = $model_consult->getConsultList($where,'*','0','10');
        
        Tpl::output('consult_list',$consult_list);
        Tpl::output('show_page',$model_consult->showpage('5'));
        // echo "<pre>";
        // print_r($consult_list);
        // 咨询类型
        $consult_type = rkcache('consult_type', true);
        Tpl::output('consult_type', $consult_type);
        // echo "<pre>";
        // print_r($consult_type);
        Tpl::output('consult_able',$this->checkConsultAble());



        //产品咨询分类信息
        // Tpl::output('hidden_nctoolbar', 1);
        // $goods_id    = intval($_GET['goods_id']);
        // if($goods_id <= 0){
        //     showMessage(Language::get('wrong_argument'),'','html','error');
        // }

        // // 商品详细信息
        // $model_goods = Model('goods');
        // $goods_info = $model_goods->getGoodsInfoByID($goods_id, '*');
        // // 验证商品是否存在
        // if (empty($goods_info)) {
        //     showMessage(L('goods_index_no_goods'), '', 'html', 'error');
        // }
        // Tpl::output('goods', $goods_info);

        // $this->getStoreInfo($goods_info['store_id']);

        // 当前位置导航
        $nav_link_list = Model('goods_class')->getGoodsClassNav($goods_info['gc_id'], 0);
        $nav_link_list[] = array('title' => $goods_info['goods_name'], 'link' => urlShop('goods', 'index', array('goods_id' => $goods_id)));
        $nav_link_list[] = array('title' => '商品咨询');
        Tpl::output('nav_link_list', $nav_link_list);

        //得到商品咨询信息
        // $model_consult = Model('consult');
        $where = array();
        $where['goods_id'] = $goods_id;
        for ($i=1; $i <= 4 ; $i++) { 
            $where['ct_id']  = $i;
            Tpl::output('ct_id', $i);
        
            $consult_list = $model_consult->getConsultList($where, '*',0,10);
        //      echo "<pre>";
        // print_r($consult_list);die;
            Tpl::output('tid', $i);//分类id
            Tpl::output('consult_list_'.$i,$consult_list);
            Tpl::output('show_page_'.$i, $model_consult->showpage('5'));

            $consult_type = rkcache('consult_type_'.$i, true);
            Tpl::output('consult_type_'.$i, $consult_type);

            $seo_param = array ();
            $seo_param['name'] = $goods_info['goods_name'];
            $seo_param['key'] = $goods_info['goods_keywords'];
            $seo_param['description'] = $goods_info['goods_description'];
            Model('seo')->type('product')->param($seo_param)->show();

            Tpl::output('consult_able_'.$i,$this->checkConsultAble($goods_info['store_id']));
        }

        // if($_GET['ajaxtype'] == 1){
        
        //     $page = $_GET['curpage'];

        //     $count = 5;
        //     $limited_count = count($consult_list);
        //     $nums = $page * $count;
        //     $offset = ($page - 1) * $count;
        //     if ($limited_count > $nums) {
        //         $more = true;
        //     } else {
        //         $more = false;
        //     }
        //     $return  = array(
        //         'page'=>$_GET['curpage'],
        //         'list'=>$consult_list,
        //         'more'=>$more,

        //     );
        //     exit(json_encode(array('state'=>success,'list'=>$return)));

        // }
        // echo "<pre>";
        // print_r($consult_list_1);
        // if (intval($_GET['ctid']) > 0) {
        //     $where['ct_id']  = intval($_GET['ctid']);
        // }
        
        // return $consult_list_1;
        // 咨询类型
        
        Tpl::showpage('goods.consulting', 'null_layout');
    }

    /**
     * 产品咨询
     */
    public function consulting_listOp() {
        Tpl::output('hidden_nctoolbar', 1);
        $goods_id    = intval($_GET['goods_id']);
        if($goods_id <= 0){
            showMessage(Language::get('wrong_argument'),'','html','error');
        }

        // 商品详细信息
        $model_goods = Model('goods');
        $goods_info = $model_goods->getGoodsInfoByID($goods_id, '*');
        // 验证商品是否存在
        if (empty($goods_info)) {
            showMessage(L('goods_index_no_goods'), '', 'html', 'error');
        }
        Tpl::output('goods', $goods_info);

        $this->getStoreInfo($goods_info['store_id']);

        // 当前位置导航
        $nav_link_list = Model('goods_class')->getGoodsClassNav($goods_info['gc_id'], 0);
        $nav_link_list[] = array('title' => $goods_info['goods_name'], 'link' => urlShop('goods', 'index', array('goods_id' => $goods_id)));
        $nav_link_list[] = array('title' => '商品咨询');
        Tpl::output('nav_link_list', $nav_link_list);

        //得到商品咨询信息
        $model_consult = Model('consult');
        $where = array();
        $where['goods_id'] = $goods_id;
        if (intval($_GET['ctid']) > 0) {
            $where['ct_id']  = intval($_GET['ctid']);
        }
        $consult_list = $model_consult->getConsultList($where, '*', 0, 20);
        Tpl::output('consult_list',$consult_list);
        Tpl::output('show_page', $model_consult->showpage());

        // 咨询类型
        $consult_type = rkcache('consult_type', true);
        Tpl::output('consult_type', $consult_type);

        $seo_param = array ();
        $seo_param['name'] = $goods_info['goods_name'];
        $seo_param['key'] = $goods_info['goods_keywords'];
        $seo_param['description'] = $goods_info['goods_description'];
        Model('seo')->type('product')->param($seo_param)->show();

        Tpl::output('consult_able',$this->checkConsultAble($goods_info['store_id']));
        Tpl::showpage('goods.consulting_list');
    }

    private function checkConsultAble( $store_id = 0) {
        //检查是否为店主本身
        $store_self = false;
        if(!empty($_SESSION['store_id'])) {
            if (($store_id == 0 && intval($_GET['store_id']) == $_SESSION['store_id']) || ($store_id != 0 && $store_id == $_SESSION['store_id'])) {
                $store_self = true;
            }
        }
        //查询会员信息
        $member_info    = array();
        $member_model = Model('member');
        if(!empty($_SESSION['member_id'])) $member_info = $member_model->getMemberInfoByID($_SESSION['member_id'],'is_allowtalk');
        //检查是否可以评论
        $consult_able = true;
        if((!C('guest_comment') && !$_SESSION['member_id'] ) || $store_self == true || ($_SESSION['member_id']>0 && $member_info['is_allowtalk'] == 0)){
            $consult_able = false;
        }
        return $consult_able;
    }

    /**
     * 商品咨询添加
     */
    public function save_consultOp(){
        //检查是否可以评论
        if(!C('guest_comment') && !$_SESSION['member_id']){
            exit(json_encode(array('state'=>faild,'msg'=>L('goods_index_goods_noallow'))));
            // showDialog(L('goods_index_goods_noallow'));
        }
        $goods_id    = intval($_POST['goods_id']);
        if($goods_id <= 0){
            exit(json_encode(array('state'=>faild,'msg'=>L('wrong_argument'))));
            // showDialog(L('wrong_argument'));
        }
        //咨询内容的非空验证
        if(trim($_POST['goods_content'])== ""){
            exit(json_encode(array('state'=>faild,'msg'=>L('goods_index_input_consult'))));
            // showDialog(L('goods_index_input_consult'));
        }
        //表单验证
        $result = chksubmit(true,C('captcha_status_goodsqa'),'num');
        if (!$result){
            exit(json_encode(array('state'=>faild,'msg'=>L('invalid_request'))));
            // showDialog(L('invalid_request'));
        } elseif ($result === -11){
            exit(json_encode(array('state'=>faild,'msg'=>L('invalid_request'))));
            // showDialog(L('invalid_request'));
        }elseif ($result === -12){
            exit(json_encode(array('state'=>faild,'msg'=>L('wrong_checkcode'))));
            // showDialog(L('wrong_checkcode'));
        }
        // if (process::islock('commit')){
        //     exit(json_encode(array('state'=>faild,'msg'=>L('nc_common_op_repeat'))));
        //     showDialog(L('nc_common_op_repeat'));
        // }else{
        //     process::addprocess('commit');
        // }
        if($_SESSION['member_id']){
            //查询会员信息
            $member_model = Model('member');
            $member_info = $member_model->getMemberInfo(array('member_id'=>$_SESSION['member_id']));
            if(empty($member_info) || $member_info['is_allowtalk'] == 0){
                exit(json_encode(array('state'=>faild,'msg'=>L('goods_index_goods_noallow'))));
                // showDialog(L('goods_index_goods_noallow'));
            }
        }
        //判断商品编号的存在性和合法性
        $goods = Model('goods');
        $goods_info = $goods->getGoodsInfoByID($goods_id, 'goods_name,store_id');
        if(empty($goods_info)){
            exit(json_encode(array('state'=>faild,'msg'=>L('goods_index_goods_not_exists'))));
            // showDialog(L('goods_index_goods_not_exists'));
        }
        //判断是否是店主本人
        if($_SESSION['store_id'] && $goods_info['store_id'] == $_SESSION['store_id']) {
            exit(json_encode(array('state'=>faild,'msg'=>L('goods_index_consult_store_error'))));
            // showDialog(L('goods_index_consult_store_error'));
        }
        //检查店铺状态
        $store_model = Model('store');
        $store_info = $store_model->getStoreInfoByID($goods_info['store_id']);
        if($store_info['store_state'] == '0' || intval($store_info['store_state']) == '2' || (intval($store_info['store_end_time']) != 0 && $store_info['store_end_time'] <= time())){
            exit(json_encode(array('state'=>faild,'msg'=>L('goods_index_goods_store_closed'))));
            // showDialog(L('goods_index_goods_store_closed'));
        }
        //接收数据并保存
        $input  = array();
        $input['goods_id']          = $goods_id;
        $input['goods_name']        = $goods_info['goods_name'];
        $input['member_id']         = intval($_SESSION['member_id']) > 0?$_SESSION['member_id']:0;
        $input['member_name']       = $_SESSION['member_name']?$_SESSION['member_name']:'';
        $input['store_id']          = $store_info['store_id'];
        $input['store_name']        = $store_info['store_name'];
        $input['ct_id']             = intval($_POST['consult_type_id']);
        $input['consult_addtime']   = TIMESTAMP;
        if (strtoupper(CHARSET) == 'GBK') {
            $input['consult_content']   = Language::getGBK($_POST['goods_content']);
        }else{
            $input['consult_content']   = $_POST['goods_content'];
        }
        $input['isanonymous']       = $_POST['hide_name']=='hide'?1:0;
        $consult_model  = Model('consult');
        if($consult_model->addConsult($input)){
            exit(json_encode(array('state'=>success)));
            // showDialog(L('goods_index_consult_success'), 'reload', 'succ');
        }else{
            exit(json_encode(array('state'=>faild,'msg'=>L('goods_index_consult_fail'))));
            // showDialog(L('goods_index_consult_fail'));
        }
    }

    /**
     * 异步显示优惠套装/推荐组合
     */
    public function get_bundlingOp() {
        $goods_id = intval($_GET['goods_id']);
        if ($goods_id <= 0) {
            exit();
        }
        $model_goods = Model('goods');
        $goods_info = $model_goods->getGoodsOnlineInfoByID($goods_id);
        if (empty($goods_info)) {
            exit();
        }

        // 优惠套装
        $array = Model('p_bundling')->getBundlingCacheByGoodsId($goods_id);
        if (!empty($array)) {
            Tpl::output('bundling_array', unserialize($array['bundling_array']));
            Tpl::output('b_goods_array', unserialize($array['b_goods_array']));
        }

        // 推荐组合
        if (!empty($goods_info) && $model_goods->checkIsGeneral($goods_info)) {
            $array = Model('p_combo_goods')->getComboGoodsCacheByGoodsId($goods_id);
            Tpl::output('goods_info', $goods_info);
            Tpl::output('gcombo_list', unserialize($array['gcombo_list']));
        }

        Tpl::showpage('goods_bundling', 'null_layout');
    }

    /**
     * 商品详细页运费显示
     *
     * @return unknown
     */
    public function calcOp(){
        if (!is_numeric($_GET['area_id']) || !is_numeric($_GET['tid'])) return false;
        $freight_total = Model('transport')->calc_transport(intval($_GET['tid']),intval($_GET['area_id']));
        if ($freight_total > 0) {
            if ($_GET['myf'] > 0) {
                if ($freight_total >= $_GET['myf']) {
                    $freight_total = '免运费';
                } else {
                    $freight_total = '运费：'.$freight_total.' 元，店铺满 '.$_GET['myf'].' 元 免运费';
                }
            } else {
                $freight_total = '运费：'.$freight_total.' 元';
            }
        } else {
            if ($freight_total !== false) {
                $freight_total = '免运费';
            }
        }
        echo $_GET['callback'].'('.json_encode(array('total'=>$freight_total)).')';
    }

    /**
     * 到货通知
     */
    public function arrival_noticeOp() {
        if (!$_SESSION['is_login'] ){
            showMessage(L('wrong_argument'), '', '', 'error');
        }
        $member_info = Model('member')->getMemberInfoByID($_SESSION['member_id'], 'member_email,member_mobile');
        Tpl::output('member_info', $member_info);

        Tpl::showpage('arrival_notice.submit', 'null_layout');
    }

    /**
     * 到货通知表单
     */
    public function arrival_notice_submitOp() {
        $type = intval($_POST['type']) == 2 ? 2 : 1;
        $goods_id = intval($_POST['goods_id']);
        if ($goods_id <= 0) {
            showDialog(L('wrong_argument'), 'reload');
        }
        // 验证商品数是否充足
        $goods_info = Model('goods')->getGoodsInfoByID($goods_id, 'goods_id,goods_name,goods_storage,goods_state,store_id');
        if (empty($goods_info) || ($goods_info['goods_storage'] > 0 && $goods_info['goods_state'] == 1)) {
            showDialog(L('wrong_argument'), 'reload');
        }

        $model_arrivalnotice = Model('arrival_notice');
        // 验证会员是否已经添加到货通知
        $where = array();
        $where['goods_id'] = $goods_info['goods_id'];
        $where['member_id'] = $_SESSION['member_id'];
        $where['an_type'] = $type;
        $notice_info = $model_arrivalnotice->getArrivalNoticeInfo($where);
        if (!empty($notice_info)) {
            if ($type == 1) {
                showDialog('您已经添加过通知提醒，请不要重复添加', 'reload');
            } else {
                showDialog('您已经预约过了，请不要重复预约', 'reload');
            }
        }

        $insert = array();
        $insert['goods_id'] = $goods_info['goods_id'];
        $insert['goods_name'] = $goods_info['goods_name'];
        $insert['member_id'] = $_SESSION['member_id'];
        $insert['store_id'] = $goods_info['store_id'];
        $insert['an_mobile'] = $_POST['mobile'];
        $insert['an_email'] = $_POST['email'];
        $insert['an_type'] = $type;
        $model_arrivalnotice->addArrivalNotice($insert);

        $title = $type == 1 ? '到货通知' : '立即预约';
        $js = "ajax_form('arrival_notice', '". $title ."', '" . urlShop('goods', 'arrival_notice_succ', array('type' => $type)) . "', 480);";
        showDialog('','','js',$js);
    }

    /**
     * 到货通知添加成功
     */
    public function arrival_notice_succOp() {
        // 可能喜欢的商品
        $goods_list = Model('goods_browse')->getGuessLikeGoods($_SESSION['member_id'], 4);
        Tpl::output('goods_list', $goods_list);
        Tpl::showpage('arrival_notice.message', 'null_layout');
    }
    
    /**
     * 显示门店
     */
    public function show_chainOp() {
        $model_chain = Model('chain');
        $model_chain_stock = Model('chain_stock');
        $goods_id = $_GET['goods_id'];
        $stock_list = $model_chain_stock->getChainStockList(array('goods_id' => $goods_id, 'stock' => array('gt', 0)), 'chain_id');
        if (!empty($stock_list)) {
            $chainid_array = array();
            foreach ($stock_list as $val) {
                $chainid_array[] = $val['chain_id'];
            }
            $chain_array = $model_chain->getChainList(array('chain_id' => array('in', $chainid_array)));
            $chain_list = array();
            if (!empty($chain_array)) {
                foreach ($chain_array as $val) {
                    $chain_list[$val['area_id']][] = $val;
                }
            }
            
            Tpl::output('chain_list', json_encode($chain_list));
        }
        Tpl::showpage('goods.show_chain', 'null_layout');
    }

    public function downOp() {
        $file_name = $_GET['name'];
        $file_arr = explode('_', $file_name);
        $store_id = $file_arr[0];    
        $file_dir = BASE_UPLOAD_PATH."/shop/store/goods_files/{$store_id}/";        //下载文件存放目录
        //检查文件是否存在
        if (! file_exists ( $file_dir . $file_name )) {

            showMessage('File not found', '', '', 'error');
        
        } else {    
        
            //以只读和二进制模式打开文件   
        
            $file = fopen ( $file_dir . $file_name, "rb" ); 
        
         
        
            //告诉浏览器这是一个文件流格式的文件    
        
            Header ( "Content-type: application/octet-stream" ); 
        
            //请求范围的度量单位  
        
            Header ( "Accept-Ranges: bytes" );  
        
            //Content-Length是指定包含于请求或响应中数据的字节长度    
        
            Header ( "Accept-Length: " . filesize ( $file_dir . $file_name ) );  
        
            //用来告诉浏览器，文件是可以当做附件被下载，下载后的文件名称为$file_name该变量的值。
        
            Header ( "Content-Disposition: attachment; filename=" . $file_name );    
        
         
        
            //读取文件内容并直接输出到浏览器    
        
            echo fread ( $file, filesize ( $file_dir . $file_name ) );    
        
            fclose ( $file );    
        
            exit ();    
        }    
    }

}
