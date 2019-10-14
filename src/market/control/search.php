<?php
/**
 * 商品列表
 *
 
 
 
 
 */



defined('interMarket') or exit('Access Invalid!');

class searchControl extends BaseHomeControl {


    //每页显示商品数
    const PAGESIZE = 16;

    //模型对象
    private $_model_search;

    public function indexOp() {
        Language::read('home_goods_class_index');
        $this->_model_search = Model('search');
        //显示左侧分类
        //默认分类，从而显示相应的属性和品牌

        $default_classid = intval($_GET['cate_id']);
        if (intval($_GET['cate_id']) > 0) {
            $goods_class_array = $this->_model_search->getLeftCategory(array($_GET['cate_id']));
        } elseif ($_GET['keyword'] != '') {
            if (cookie('his_sh') == '') {
                $his_sh_list = array();
            } else {
                $his_sh_list = explode('~', cookie('his_sh'));
            }
            if (strlen($_GET['keyword']) <= 30 && !in_array($_GET['keyword'],$his_sh_list)) {
                if (array_unshift($his_sh_list, $_GET['keyword']) > 8) {
                    array_pop($his_sh_list);
                }
            }
            setNcCookie('his_sh', implode('~', $his_sh_list),2592000);
            //从TAG中查找分类
            $goods_class_array = $this->_model_search->getTagCategory($_GET['keyword']);
            //取出第一个分类作为默认分类，从而显示相应的属性和品牌
            $default_classid = $goods_class_array[0];

            $goods_class_array = $this->_model_search->getLeftCategory($goods_class_array, 1);;
        }
//        echo "<pre>";
//        print_r($goods_class_array);
        //子分类，从而显示相应的属性和品牌
        $child_classid = $_GET['a_id'];

       
        // print_r($default_classid);
       
        //if(isset($child_classid)){
        //    $check_child = $goods_class_array[$default_classid]['class2'][$child_classid];
        //    foreach ($goods_class_array as $key => $value) {
        //        foreach ($value['class2'] as $k => $v) {
        //            $goods_class_array[$key]['class2'][$k]['a_id'] = $child_classid;
        //        }
        //
        //    }
        //
        //}
        //// print_r($check_child);
        //if(!isset($goods_class_array[$default_classid])){
        //    if(!empty($goods_class_array)){
        //        foreach ($goods_class_array as $key => $value) {
        //            if(is_array($value['class2'][$default_classid])){
        //                // print_r($value);
        //                $check_child = $value['class2'][$default_classid];
        //                $check_child['href'] = urlShop('search', 'index', array('cate_id' => $check_child['gc_parent_id'],'a_id' => $child_classid));
        //                // break;
        //            }
        //        }
        //    }
        //}
        //if(!isset($goods_class_array[$default_classid]) && $check_child !== NULL){
        //    // var_dump($check_child);
        //    Tpl::output('check_child', $check_child);
        //}

        // print_r($goods_class_array);
        // print_r($is_default_classid);
        Tpl::output('goods_class_array', $goods_class_array);
        Tpl::output('default_classid', $default_classid);
        
        
        Tpl::output('child_classid', $child_classid);

        //全文searchsearch参数
        $indexer_searcharr = $_GET;

        //search消费者保障服务
        $search_ci_arr = array();
        $search_ci_str = '';
        if ($_GET['ci'] && $_GET['ci'] != 0 && is_string($_GET['ci'])) {
            //处理参数
            $search_ci= $_GET['ci'];
            $search_ci_arr = explode('_',$search_ci);
            $search_ci_str = $search_ci.'_';
            $indexer_searcharr['search_ci_arr'] = $search_ci_arr;
        }
        //优先从全文索引库里查找
        list($goods_list,$indexer_count) = $this->_model_search->indexerSearch($indexer_searcharr,self::PAGESIZE);
        // echo "<pre>";
        //  print_r($goods_class_array);
        
        //获得经过属性过滤的商品信息
//        if(isset($goods_class_array[$default_classid]) && $goods_class_array[$default_classid]['gc_parent_id'] == 0){
//            $top_class = urlShop('search', 'index', array('cate_id' => $goods_class_array[$default_classid]['gc_id']));
//            if(is_array($goods_class_array[$default_classid]['class2'])){
//                foreach ($goods_class_array[$default_classid]['class2'] as $key => $value) {
//                    list($goods_param, $brand_array, $initial_array, $attr_array, $checked_brand, $checked_attr) = $this->_model_search->getAttr($_GET, $value['gc_id']);
//                    break;
//                     // print_r($brand_array);
//                }
//            }
//        }else{
//            // print_r($goods_class_array);
//            if(!empty($goods_class_array)){
//                foreach ($goods_class_array as $key => $value) {
//                    if(is_array($value['class2'][$default_classid])){
//                        $top_class = urlShop('search', 'index', array('cate_id' => $value['gc_id']));
//                        foreach ($value['class2'] as $k => $v) {
//                            list($goods_param, $brand_array, $initial_array, $attr_array, $checked_brand, $checked_attr) = $this->_model_search->getAttr($_GET, $v['gc_id']);
//                        }
//                    }
//                }
//            }
//        }
        // echo "<pre>";
        // $goodsattrindex_list = Model('goods_attr_index')->getGoodsAttrIndexList($where, 'goods_id');
        // print_r($goodsattrindex_list);
        // print_r($brand_array);
        // print_r($initial_array);
        // print_r($attr_array);
        // print_r($checked_brand);
        // print_r($checked_attr);

         list($goods_param, $brand_array, $initial_array, $attr_array, $checked_brand, $checked_attr) = $this->_model_search->getAttr($_GET, $default_classid);
//        Tpl::output('top_class', $top_class);
        Tpl::output('brand_array', $brand_array);
        Tpl::output('initial_array', $initial_array);
        Tpl::output('attr_array', $attr_array);
        Tpl::output('checked_brand', $checked_brand);
        Tpl::output('checked_attr', $checked_attr);

        //查询消费者保障服务
        $contract_item = array();
        if (C('contract_allow') == 1) {
            $contract_item = Model('contract')->getContractItemByCache();
        }
        Tpl::output('contract_item',$contract_item);

        $model_goods = Model('goods');
        if (!is_null($goods_list)) {
            //全文search 
            pagecmd('setEachNum',self::PAGESIZE);
            pagecmd('setTotalNum',$indexer_count);

        } else {
            //查库search

            //处理排序
            // $order = 'is_own_shop desc,goods_id desc';
            $order = 'sort asc';
            if (in_array($_GET['key'],array('1','2','3'))) {
                $sequence = $_GET['order'] == '1' ? 'asc' : 'desc';
                $order = str_replace(array('1','2','3'), array('goods_salenum','goods_click','goods_promotion_price'), $_GET['key']);
                $order .= ' '.$sequence; 
            }

            // 字段
            $fields = "goods_id,goods_commonid,goods_name,goods_jingle,gc_id,store_id,store_name,goods_price,goods_promotion_price,goods_promotion_type,goods_marketprice,goods_storage,goods_image,goods_freight,goods_salenum,brand_id,color_id,gc_id_3,gc_id_1,gc_id_2,goods_verify,goods_state,is_own_shop,evaluation_good_star,evaluation_count,is_virtual,is_fcode,is_presell,is_book,book_down_time,have_gift,areaid_1,sort";
            //构造消费者保障服务字段
            if ($contract_item) {
                foreach ($contract_item as $citem_key=>$citem_val) {
                    $fields .= ",contract_{$citem_key}";
                }
            }
            
            $goods_class = Model('goods_class')->getGoodsClassForCacheModel();
            $condition = array();
            if (isset($goods_param['class'])) {
                $condition['gc_id_'.$goods_param['class']['depth']] = $goods_param['class']['gc_id'];
            }
            if (intval($_GET['b_id']) > 0) {
                $condition['brand_id'] = intval($_GET['b_id']);
            }
            if ($_GET['keyword'] != '') {
                $condition['goods_name|goods_jingle'] = array('like', '%' . $_GET['keyword'] . '%');
            }
            if (intval($_GET['area_id']) > 0) {
                $condition['areaid_1'] = intval($_GET['area_id']);
            }
            if ($_GET['type'] == 1) {
                $condition['is_own_shop'] = 1;
            }
            if ($_GET['gift'] == 1) {
                $condition['have_gift'] = 1;
            }
            //消费者保障服务
            if ($contract_item && $search_ci_arr) {
                foreach ($search_ci_arr as $ci_val) {
                    $condition["contract_{$ci_val}"] = 1;
                }
            }

            if (isset($goods_param['goodsid_array'])){
                $condition['goods_id'] = array('in', $goods_param['goodsid_array']);
            }
            if ($goods_class[$default_classid]['show_type'] == 1) {
                $goods_list = $model_goods->getGoodsListByColorDistinct($condition, $fields, $order, self::PAGESIZE);
            } else {
                if (C('dbdriver') == 'oracle') {
                    $oracle_fields = array();
                    $fields = explode(',', $fields);
                    foreach ($fields as $val) {
                        $oracle_fields[] = 'min('.$val.') '.$val;
                    }
                    $fields = implode(',', $oracle_fields);
                }
                $count = $model_goods->getGoodsOnlineCount($condition,"distinct goods_commonid");
                $goods_list = $model_goods->getGoodsOnlineList($condition, $fields, self::PAGESIZE, $order, 0, 'goods_commonid', false, $count);
            }
        }


        Tpl::output('search_ci_str', $search_ci_str);
        Tpl::output('search_ci_arr', $search_ci_arr);
        Tpl::output('show_page1', $model_goods->showpage(4));
        // echo "<pre>";
        // print_r($model_goods->showpage(4));
        Tpl::output('show_page', $model_goods->showpage(5));
        Tpl::output('totalnum', $model_goods->gettotalnum());
        Tpl::output('talpage', $model_goods->gettotalpage());
        // echo $model_goods->gettotalnum();
//         print_r($goods_list);
        if (!empty($goods_list)) {
            if (is_null($indexer_count)) {
                //查库search
                $commonid_array = array(); // 商品公共id数组
                $storeid_array = array();       // 店铺id数组
                foreach ($goods_list as $value) {
                    $commonid_array[] = $value['goods_commonid'];
                    $storeid_array[] = $value['store_id'];
                }
                $commonid_array = array_unique($commonid_array);
                $storeid_array = array_unique($storeid_array);
                // 商品多图
                $goodsimage_more = $model_goods->getGoodsImageList(array('goods_commonid' => array('in', $commonid_array)), '*', 'is_default desc,goods_image_id asc');
                // 店铺
                $store_list = Model('store')->getStoreMemberIDList($storeid_array);
                //处理商品消费者保障服务信息
                $goods_list = $model_goods->getGoodsContract($goods_list, $contract_item);
            }

            //search的关键字
            $search_keyword = $_GET['keyword'];
            foreach ($goods_list as $key => $value) {
                if (is_null($indexer_count)) {
                    // 商品多图
                    
                    if ($goods_class[$default_classid]['show_type'] == 1) {
                        foreach ($goodsimage_more as $v) {
                            if ($value['goods_commonid'] == $v['goods_commonid'] && $value['store_id'] == $v['store_id'] && $value['color_id'] == $v['color_id']) {
                                $goods_list[$key]['image'][] = $v['goods_image'];
                            }
                        }
                    } else {
                        foreach ($goodsimage_more as $v) {
                            if ($value['goods_commonid'] == $v['goods_commonid'] && $value['store_id'] == $v['store_id'] && $v['is_default'] == 1) {
                                $goods_list[$key]['image'][] = $v['goods_image'];
                            }
                        }
                    }
                    // 店铺的开店会员编号
                    $store_id = $value['store_id'];
                    $goods_list[$key]['member_id'] = $store_list[$store_id]['member_id'];
                    $goods_list[$key]['store_domain'] = $store_list[$store_id]['store_domain'];                    
                }

                //将关键字置红
                if ($search_keyword){
                    $goods_list[$key]['goods_name_highlight'] = str_replace($search_keyword,'<font style="color:#f00;">'.$search_keyword.'</font>',$value['goods_name']);
                } else {
                    $goods_list[$key]['goods_name_highlight'] = $value['goods_name'];
                }

                // 验证预定商品是否到期
                if ($value['is_book'] == 1) {
                    if ( $value['book_down_time'] < TIMESTAMP ) {
                        QueueClient::push('updateGoodsPromotionPriceByGoodsId', $value['goods_id']);
                        $goods_list[$key]['is_book'] = 0;
                    }
                }
            }
        }
        //echo "<pre>";
        $goods_model = Model('goods');
        foreach ($goods_list as $key => $value) {
            $goods_list[$key]['goods_evaluate_info'] = Model('evaluate_goods')->getEvaluateGoodsInfoByGoodsID($value['goods_id']);
            $goods_info = $goods_model->getGoodsInfoAndPromotionById(intval($value["goods_id"]));
            if(!empty($goods_info['xianshi_info'])){
                $goods_list[$key]['promotion_type'] = 'xianshi';
                $goods_list[$key]['goods_promotion_price'] = $goods_info['xianshi_info']['xianshi_price'];
            }
            if(!empty($goods_info['groupbuy_info'])){
                $goods_list[$key]['promotion_type'] = 'groupbuy';
                $goods_list[$key]['goods_promotion_price'] = $goods_info['groupbuy_info']['groupbuy_price'];
            }
            //print_r($goods_info);
            //满即送
            //$mansong_info = ($goods_info['is_virtual'] == 1) ? array() : Model('p_mansong')->getMansongInfoByStoreID($goods_info['store_id']);


        }


//        echo '<pre>';
//        print_r($goods_list);


		$goods_num= $model_goods->getGoodsCommonCount($condition);
        Tpl::output('goods_term_num',  count($goods_list));
		Tpl::output('goods_num',  $goods_num);
        Tpl::output('goods_list', $goods_list);
        if ($_GET['keyword'] != ''){
            Tpl::output('show_keyword',  $_GET['keyword']);
        } else {
            Tpl::output('show_keyword',  $goods_param['class']['gc_name']);
        }

        $model_goods_class = Model('goods_class');

        // SEO
        if ($_GET['keyword'] == '') {
            $seo_class_name = $goods_param['class']['gc_name'];
            if (is_numeric($_GET['cate_id']) && empty($_GET['keyword'])) {
                $seo_info = $model_goods_class->getKeyWords(intval($_GET['cate_id']));
                if (empty($seo_info[1])) {
                    $seo_info[1] = C('site_name') . ' - ' . $seo_class_name;
                }
                Model('seo')->type($seo_info)->param(array('name' => $seo_class_name))->show();
            }
        } elseif ($_GET['keyword'] != '') {
            Tpl::output('html_title', (empty($_GET['keyword']) ? '' : $_GET['keyword'] . ' - ') . C('site_name') . L('nc_common_search'));
        }

        // 当前位置导航
        $nav_link_list = $model_goods_class->getGoodsClassNav(intval($_GET['cate_id']));
        Tpl::output('nav_link_list', $nav_link_list );
         //echo "<pre>";
         //print_r($nav_link_list);

        // 得到自定义导航信息
        $nav_id = intval($_GET['nav_id']) ? intval($_GET['nav_id']) : 0;
        Tpl::output('index_sign', $nav_id);


        // 地区
        $province_array = Model('area')->getTopLevelAreas();
        Tpl::output('province_array', $province_array);

        //loadfunc('search');
		//分类热销
        
		//$hot_goods_list = $model_goods->getGoodsOnlineList($condition, '*', 0, 'goods_salenum desc', 5);
		//Tpl::output('hot_goods_list',$hot_goods_list);
		 // echo "<pre>";
   //      print_r($hot_goods_list);
		 //热销排行
        //$model_store = Model('store');
        //$hot_sales = $model_store->getHotSalesList(1, 5);
        //Tpl::output('hot_sales', $hot_sales);

        //推荐商品

        //$goods_commend_list = Model('goods')->getGoodsCommendList(1, 6);
        //Tpl::output('goods_commend',$goods_commend_list);

        // 浏览过的商品
        //$viewed_goods = Model('goods_browse')->getViewedGoodsList($_SESSION['member_id'],20);
        //Tpl::output('viewed_goods',$viewed_goods);
        Tpl::showpage('search');
    }


    /**
     * 获得推荐商品
     */
    public function get_booth_goodsOp() {
        $gc_id = $_GET['cate_id'];
        if ($gc_id <= 0) {
            return false;
        }
        // 获取分类id及其所有子集分类id
        $goods_class = Model('goods_class')->getGoodsClassForCacheModel();
        if (empty($goods_class[$gc_id])) {
            return false;
        }
        $child = (!empty($goods_class[$gc_id]['child'])) ? explode(',', $goods_class[$gc_id]['child']) : array();
        $childchild = (!empty($goods_class[$gc_id]['childchild'])) ? explode(',', $goods_class[$gc_id]['childchild']) : array();
        $gcid_array = array_merge(array($gc_id), $child, $childchild);
        // 查询添加到推荐展位中的商品id
        $boothgoods_list = Model('p_booth')->getBoothGoodsList(array('gc_id' => array('in', $gcid_array)), 'goods_id', 0, 5, 'rand()');
        if (empty($boothgoods_list)) {
            return false;
        }

        $goodsid_array = array();
        foreach ($boothgoods_list as $val) {
            $goodsid_array[] = $val['goods_id'];
        }

        $fieldstr = "goods_id,goods_commonid,goods_name,goods_jingle,store_id,store_name,goods_price,goods_promotion_price,goods_promotion_type,goods_marketprice,goods_storage,goods_image,goods_freight,goods_salenum,color_id,evaluation_count";
        $goods_list = Model('goods')->getGoodsOnlineList(array('goods_id' => array('in', $goodsid_array)), $fieldstr);
        if (empty($goods_list)) {
            return false;
        }
        return $goods_list;
        Tpl::output('goods_list', $goods_list);
        Tpl::showpage('goods.booth', 'null_layout');
    }

    public function auto_completeOp() {
        if ($_GET['term'] == '' && cookie('his_sh') != '') {
            $corrected = explode('~', cookie('his_sh'));
            if ($corrected != '' && count($corrected) !== 0) {
                $data = array();
                foreach ($corrected as $word)
                {
                    $row['id'] = $word;
                    $row['label'] = $word;
                    $row['value'] = $word;
                    $data[] = $row;
                }
                exit(json_encode($data));
            }
            return;
        }
        if (!C('fullindexer.open')) return;
        try {
            require(BASE_DATA_PATH.'/api/xs/lib/XS.php');
            $obj_doc = new XSDocument();
            $obj_xs = new XS(C('fullindexer.appname'));
            $obj_index = $obj_xs->index;
            $obj_search = $obj_xs->search;
            $obj_search->setCharset(CHARSET);
            $corrected = $obj_search->getExpandedQuery($_GET['term']);
            if (count($corrected) !== 0) {
                $data = array();
                foreach ($corrected as $word)
                {
                    $row['id'] = $word;
                    $row['label'] = $word;
                    $row['value'] = $word;
                    $data[] = $row;
                }
                exit(json_encode($data));
            }
        } catch (XSException $e) {
            if (is_object($obj_index)) {
                $obj_index->flushIndex();
            }
//             Log::record('search\auto_complete'.$e->getMessage(),Log::RUN);
        }
    }

    /**
     * 获得猜你喜欢
     */
    public function get_guesslikeOp(){
        $goodslist = Model('goods_browse')->getGuessLikeGoods($_SESSION['member_id'], 20);
        if(!empty($goodslist)){
            Tpl::output('goodslist',$goodslist);
            Tpl::showpage('goods_guesslike','null_layout');
        }
    }

    /**
     * 商品分类推荐
     */
    public function get_gc_goods_recommendOp(){
        $rec_gc_id = intval($_GET['cate_id']);
        //只有最后一级才有推荐商品
        $class_info = Model('goods_class')->getGoodsClassListByParentId($rec_gc_id);
        if (!empty($class_info)) {
            return ;
        }
        $goods_list = array();
        if ($rec_gc_id > 0) {
            $rec_list = Model('goods_recommend')->getGoodsRecommendList(array('rec_gc_id'=>$rec_gc_id),'','','*','','rec_goods_id');
            if (!empty($rec_list)) {
                $goods_list = Model('goods')->getGoodsOnlineList(array('goods_id'=>array('in',array_keys($rec_list))));
                if (!empty($goods_list)) {
                    Tpl::output('goods_list',$goods_list);
                    Tpl::showpage('goods_recommend','null_layout');
                }
            }
        }
    }




    /**
     * 分类导入
     */
    public function goods_class_importOp(){
       //  $lang   = Language::getLangContent();
       //  $model_class = Model('goods_class');
       //  //导入
       //  echo "<pre>";
       //  // print_R($_FILES);
       //      setlocale(LC_ALL,'zh_CN.GBK');
       //   setlocale(LC_ALL,array('zh_CN.gbk','zh_CN.gb2312','zh_CN.gb18030'));
       //   @eregi("WIN",PHP_OS) ? setlocale(LC_ALL, '') : setlocale(LC_ALL,'zh_CN.GBK');
       
       //      //得到导入文件后缀名
       //      $csv_array = explode('.',$_FILES['csv']['name']);
       //      $file_type = end($csv_array);
            
       //      if (!empty($_FILES['csv']) && !empty($_FILES['csv']['name']) && $file_type == 'csv'){
       //          $fp = fopen($_FILES['csv']['tmp_name'],'rb');
       //          // print_R($fp);
               
       //          if ($fp)
			    // {
                   
			    //     while($line_data = fgetcsv($fp))
			    //     {
			    //     	// $line_data = eval('return '.iconv('gbk','utf-8',var_export($line_data,true)).';');
			    //         $line_list[] = $line_data;
			    //     }
			    // }
			   
			    // unset($line_list[0],$line_list[1]);
			    // unset($line_list[0]);

       //          $combinedArray = array();
                // foreach ($line_list as $key => $val) {
                //     if(!empty($line_list) && is_array($line_list)){
                //         if (!empty($val[0]) && in_array($val[0],$product_sn)){
                //             exit('列表中 product_sn 有重复！');
                //         }elseif(empty($val[0])){
                //             exit('列表中 product_sn 有为空的行！');
                //         }elseif(!empty($val[0])){
                //             $product_sn[] = trim($val[0]);
                //         }
                //     }
                // }

			    // print_R($line_list);
                // die;
                // foreach ($line_list as $key => $v) {//订单数据
                //     $data = array();


                //     $data['order_sn'] = $v[0];
                //     $data['buyer_name'] = $v[1];
                //     $model = Model('member');
                //     $member = $model->where(array('member_name'=>$v[1]))->find();
                //     $data['buyer_id'] = $member['member_id'];

                //     $data['order_sn'] = $v[0];
                //     $data['buyer_name'] = $v[1];
                //     $model = Model('member');
                //     $member = $model->where(array('member_name'=>$v[1]))->find();
                //     $data['buyer_id'] = $member['member_id'];
                //     $data['buyer_email'] = $member['member_email'];
                //     $data['buyer_phone'] = $member['member_mobile'];
                // }
                // die;
                // $model = Model('member');
			    // foreach ($line_list as $key => $v) {//会员数据
       //              $member_id = $model->where(array('member_name'=>trim($v[1])))->find();
       //              if($member_id){
       //                  // print_R($member_id);
       //                  echo $member_id['member_name'];
       //                  echo "<br>";
       //                  continue;
       //              }else{

    			//     	$data = array();
    			//     	$data['member_name'] = $v[1];
    			//     	$data['member_truename'] = $v[2];
    			//     	$data['member_points'] =$v[3];
    			//     	$data['member_mobile'] = $v[4];
    			//     	if($v[4] !=''){
    			//     		$data['member_mobile_bind'] =1;
    			//     	}
    			//     	$data['member_areainfo'] = $v[5];
    			//     	$data['member_email'] = $v[6];
    			//     	if($v[6] !=''){
    			//     		$data['member_email_bind'] =1;
    			//          }

    			//     	$data['member_birthday'] = $v[7];
    			//     	if($v[8] =='保密'){
    			//     		$data['member_sex'] =0;
    			//     	}else if($v[8] =='男'){
    			//     		$data['member_sex'] =1;
    			//     	}else if($v[8] =='女'){
    			//     		$data['member_sex'] =2;
    			//     	}
    			//     	$data['member_time'] = strtotime($v[9]);
    			//     	$data['member_login_ip'] = '127.0.0.1';

    			//     	$data['inform_allow'] = '1';
    			//     	$data['is_buy'] = '1';
    			//     	$data['is_allowtalk'] = '1';
    			//     	$data['member_state'] = '1';
    			//     	$model = Model('member');
    			//     	$model->insert($data);
       //              }
			    // }
			    // fclose($fp);
			    // foreach ($line_list as $key => $v) {//会员密码数据
			    // 	// $model = Model('member');
       //              $condition['member_passwd'] = array('eq','');
       //              $member_id = $model->where($condition)->find();
       //              if($member_id){
       //                  // print_R($member_id);
       //                  // echo "<br>";
       //                  // continue;
       //                  $data = array();
       //                  $data['member_passwd'] = md5(trim($v[2]));
       //                  if($v[1] != ''){
       //                      $member_id = $model->where(array('member_name'=>trim($v[1])))->find();
       //                      $model->where(array('member_id'=>$member_id['member_id']))->update($data);
       //                  }else if($v[0] != ''){
       //                      $member_id = $model->where(array('member_mobile'=>trim($v[0])))->find();
       //                      $model->where(array('member_id'=>$member_id['member_id']))->update($data);
       //                  }
       //              }
			    // }
			   // die;
			    // foreach ($line_list as $key => $v) {//订单数据
			    // 	$data = array();
			    // 	$data['order_sn'] = $v[0];
			    // 	$data['buyer_name'] = $v[1];
			    // 	$model = Model('member');
			    // 	$member = $model->where(array('member_name'=>$v[1]))->find();
			    // 	$data['buyer_id'] = $member['member_id'];
			    // 	$data['buyer_email'] = $member['member_email'];
			    // 	$data['buyer_phone'] = $member['member_mobile'];

			    // 	$data['add_time'] = strtotime($v[3]);
			    // 	if($v[9] == '微信支付'){
			    // 		$data['payment_code'] = 'wxpay';
			    // 	}else{
			    // 		$data['payment_code'] = 'alipay';
			    // 	}

			    // 	$data['payment_time'] = strtotime($v[3])+100;
			    // 	$data['finnshed_time'] = strtotime($v[3])+100;
			    // 	$data['order_state'] = 40;
			    	

			    	
			    // 	$data['order_type'] = 1;
			    // 	$data['goods_amount'] = $v[7];
			    // 	$data['order_amount'] = $v[8];

			    	
			    // 	$data['store_id'] = 1;
			    
			    // 	$data['store_name'] = '维诺卡夫';

			    // 	$model = Model('orders');
			    // 	$model->insert($data);




       //              $res1 = array();

       //              $res1['store_id'] = 1;
       //              $res1['shipping_time'] = strtotime($v[3])+500;
                    
       //              $res1['reciver_name'] = $v[10];
       //              $res1['reciver_info'] = serialize(array('mob_phone'=>$v[14],'address'=>$v[11])); 
       //              $res1['order_message'] = $v[12];
       //              if(strstr($v[13],"酒柜")){
       //                  $res1['shipping_express_id'] = '49';
       //              }else if(strstr($v[13],"圆通")){
       //                  $res1['shipping_express_id'] = '40';
       //              } else if(strstr($v[13],"顺丰")){
       //                  $res1['shipping_express_id'] = '29';
       //              }else if(strstr($v[13],"优速")){
       //                  $res1['shipping_express_id'] = '43';
       //              }else if(strstr($v[13],"新邦")){
       //                  $res1['shipping_express_id'] = '36';
       //              }else if(strstr($v[13],"申通")){
       //                  $res1['shipping_express_id'] = '28';
       //              }else{
       //                  $res1['shipping_express_id'] = '48';
       //              }
       //              $model22 = Model('order_common');
       //              $model22->insert($res1);
			    // }
			    // foreach ($line_list as $key => $v) {//会员密码数据
			    // 	$data = array();
			    // 	$model = Model('orders');
			    // 	$orders = $model->where(array('order_sn'=>$v[0]))->find();

			    // 	$goods = Model('goods');
			    // 	$good = $goods->where(array('goods_commonid'=>$v[1]))->find();


			    	
			    // 	$goods_common = Model('goods_common');
			    // 	$common = $goods_common->where(array('goods_commonid'=>$v[1]))->find();

			    // 	$order_goods = Model('order_goods');
			    // 	$order_good = $order_goods->where(array('order_id'=>$orders['order_id'],'goods_commonid'=>$good['goods_id']))->find();
			    // 	if($order_good){
			    // 		$res['goods_num'] = $order_good['goods_num']+1;
			    // 		$order_goods->where(array('order_id'=>$orders['order_id'],'goods_commonid'=>$good['goods_id']))->update($res);
			    // 		$res1['goods_pay_price'] = $order_good['goods_pay_price']+$order_good['goods_pay_price'];
			    // 		$order_goods->where(array('order_id'=>$orders['order_id'],'goods_commonid'=>$good['goods_id']))->update($res1);
			    // 	}else{

			    // 		$data['order_id'] = $orders['order_id'];
				   //  	$data['goods_id'] = $v[1];

			    // 		$data['goods_name'] = $good['goods_name'];
				   //  	$data['goods_price'] = $good['goods_promotion_price'];
				   //  	$data['goods_num'] = 1;
				    	
				   //  	$data['goods_image'] = $common['goods_image'];
				   //  	$data['goods_pay_price'] = $good['goods_promotion_price'];



				   //  	$data['store_id'] = 1;
				   //  	$data['buyer_id'] = $orders['buyer_id'];
				   //  	$data['goods_type'] = 1;
				   //  	$data['commis_rate'] = 200;
				   //  	$data['gc_id'] = $good['gc_id'];
				   //  	$data['goods_spec'] = unserialize($good['goods_spec']);

				    	
				    	

				   //  	$order_good = $order_goods->insert($data);

			    // 	}
			    //  }
             // }
			    	
			    	
			    	
			   //  	if($v[0] != ''){
						
						// $model->where(array('goods_commonid'=>$member_id['member_id']))->update($data);
			   //  	}else{
						// $member_id = $model->where(array('member_name'=>$v[1]))->find();
						// $model->where(array('member_id'=>$member_id['member_id']))->update($data);
			   //  	}
			    // }
			    	
			    // $key_array = array(
		     //        0=>'order_sn',
		     //        1=>'buyer_name',
		     //        2=>'add_time',
		     //        3=>'order_type',
		     //        4=>'goods_amount',
		     //        5=>'order_amount',
		     //        6=>'payment_code',
		     //        7=>'product_spec',
		     //        8=>'product_brand',
		     //        9=>'product_unit2',
		     //        10=>'product_bulk',
		     //        11=>'product_shop_price',
		     //        12=>'product_status',
		     //        13=>'chandi',// 产地
		     //        14=>'region',
		     //        15=>'product_thumb',
		     //    );
			    // $combinedArray = array();
			    // if(!empty($line_list) && is_array($line_list)){
			    //     foreach($line_list as $val){
			    //         $combinedArray[] = array_combine($key_array, $val);
			    //     }
			    //     unset($line_list, $val);
			    // }

			    // print_R($combinedArray);
			    // if (!empty($combinedArray)){

			    //     $product_sn = array();

			    //     foreach ($combinedArray AS $val){
			    //         if (!empty($val['product_sn']) && in_array($val['product_sn'],$product_sn)){
			    //             die('列表中 product_sn 有重复！');
			    //         }elseif(empty($val['product_sn'])){
			    //             die('列表中 product_sn 有为空的行！');
			    //         }elseif(!empty($val['product_sn'])){
			    //             $product_sn[] = trim($val['product_sn']);
			    //         }
			    //     }
			    // }
			    // die;
       //          while (!feof($fp)) {
       //              $data = trim(fgets($fp, 4096));
       //              switch (strtoupper($_POST['charset'])){
       //                  case 'UTF-8':
       //                      if (strtoupper(CHARSET) !== 'UTF-8'){
       //                          $data = iconv('UTF-8',strtoupper(CHARSET),$data);
       //                      }
       //                      break;
       //                  case 'GBK':
       //                      if (strtoupper(CHARSET) !== 'GBK'){
       //                          $data = iconv('GBK',strtoupper(CHARSET),$data);
       //                      }
       //                      break;
       //              }
                    
       //              print_R($data);die;
       //              if (!empty($data)){
       //                  $data   = str_replace('"','',$data);
       //                  //逗号去除
       //                  $tmp_array = array();
       //                  $tmp_array = explode(',',$data);
       //                  if($tmp_array[0] == 'sort_order')continue;
       //                  //第一位是序号，后面的是内容，最后一位名称
       //                  $tmp_deep = 'parent_id_'.(count($tmp_array)-1);

       //                  $insert_array = array();
       //                  $insert_array['gc_sort'] = $tmp_array[0];
       //                  $insert_array['gc_parent_id'] = $$tmp_deep;
       //                  $insert_array['gc_name'] = $tmp_array[count($tmp_array)-1];
       //                  $gc_id = $model_class->addGoodsClass($insert_array);
       //                  //赋值这个深度父ID
       //                  $tmp = 'parent_id_'.count($tmp_array);
       //                  $$tmp = $gc_id;
       //              }
       //          }
                // $this->log(L('goods_class_index_import,goods_class_index_class'),1);
            //     showMessage($lang['nc_common_op_succ'],'index.php?model=goods_class&fun=goods_class');
            // }else {
            //     // $this->log(L('goods_class_index_import,goods_class_index_class'),0);
            //     showMessage($lang['goods_class_import_csv_null']);
            // }
        
        // Tpl::output('top_link',$this->sublink($this->links,'goods_class_import'));
						
		// Tpl::setDirquna('shop');
  //       Tpl::showpage('goods_class.import');
    }
}