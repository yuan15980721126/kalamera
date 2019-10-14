<?php
/**
 * 默认展示页面
 *
 *
 *
 

 
 */


defined('interMarket') or exit('Access Invalid!');
class indexControl extends BaseHomeControl{
    public function indexOp(){
        Language::read('home_index_index');
        Tpl::output('index_sign','index');

	    //把加密的用户id写入cookie  by 3 3h ao.co m 已换另一个方式，临时去掉此方法
	    $uid = intval(base64_decode($_COOKIE['uid']));
        //抢购专区
        Language::read('member_groupbuy');
        $model_groupbuy = Model('groupbuy');
        $group_list = $model_groupbuy->getGroupbuyCommendedList(15);
        // $group_arr = array('5','10','15');
        // Tpl::output('group_arr', $group_arr);
        
		
		//专题获取
        // echo "<pre>";
        // print_R($group_list);
        foreach ($group_list as $key => $value) {
            if($key <= 4){
                $group_listone[] = $value;
            }else if($key > 4 && $key <= 9){
                $group_listtwo[] = $value;
            }else if($key > 9 && $key <= 14){
                $group_listthree[] = $value;
            }
        }
        Tpl::output('group_listone', $group_listone);
        Tpl::output('group_listtwo', $group_listtwo);
        Tpl::output('group_listthree', $group_listthree);


        $model_special = Model('cms_special');
        $special_list = $model_special->getShopindexList($conition);
        Tpl::output('special_list', $special_list);
	
        //友情链接
        $model_link = Model('link');
        $link_list = $model_link->getLinkList($condition,$page);
        if (is_array($link_list)){
            foreach ($link_list as $k => $v){
                if (!empty($v['link_pic'])){
                    $link_list[$k]['link_pic'] = UPLOAD_SITE_URL.'/'.ATTACH_PATH.'/common/'.DS.$v['link_pic'];
                }
            }
        }
	    Tpl::output('$link_list',$link_list);
		
        //限时折扣
        $model_xianshi_goods = Model('p_xianshi_goods');
        $xianshi_item = $model_xianshi_goods->getXianshiGoodsCommendList(6);

        Tpl::output('xianshi_item', $xianshi_item);
		
		//直达楼层信息
		 if (C('hao_lc') != '') {
            $lc_list = @unserialize(C('hao_lc'));
        }
        // print_R($group_list);
        Tpl::output('lc_list',is_array($lc_list) ? $lc_list : array());
		
		//首页推荐词链接
		 if (C('hao_rc') != '') {
            $rc_list = @unserialize(C('hao_rc'));
        }
        Tpl::output('rc_list',is_array($rc_list) ? $rc_list : array());

        //推荐品牌
        $brand_r_list = Model('brand')->getBrandPassedList(array('brand_recommend'=>1) ,'brand_id,brand_name,brand_pic,brand_xbgpic,brand_tjstore', 0, 'brand_sort asc, brand_id desc', 16);
        Tpl::output('brand_r',$brand_r_list);


       
      // //分类列表
         $param['table'] = 'article';
         $param['where'] = "";
         $param['limit'] = $condition['limit'];
         $param['order'] = (empty($condition['order'])?'article_sort asc,article_id desc':$condition['order']);
         $result = Db::select($param,$page);



        $model_web_config = Model('web_config');

        $map['web_id'] = array('in','1,2,3,4');//楼层信息
        $code_list = $model_web_config->getCodeList($map);
        //echo "<pre>";

        if(is_array($code_list) && !empty($code_list)) {
            foreach ($code_list as $key => $val) {//将变量输出到页面
                if($val['show_name'] == '活动图片' ){//首页管理只取活动图片信息
                    $var_name = $val['var_name'];
                    $code_info = $val['code_info'];
                    $code_type = $val['code_type'];
                    $val['code_info'] = $model_web_config->get_array($code_info,$code_type);
                    //     echo "<pre>";
                    //     echo 'code_'.$val['web_id'];
                    //    print_R($val);
                    Tpl::output('code_'.$val['web_id'],$val);
                }

            }
        }

        //首页轮播图

        Tpl::output('banner',loadadvlist(1047));

        //中部广告
        Tpl::output('middle_adv',loadadvlist(1063));


        $web_id = '121';//首页商品推荐
        $code_list = $model_web_config->getCodeList(array('web_id'=> $web_id));
        if(is_array($code_list) && !empty($code_list)) {
            $model_class = Model('goods_class');
            $goods_class = $model_class->getTreeClassList(1);//帮你挑出
            Tpl::output('goods_class',$goods_class);
            $goods_ids = array();
            $goods = array();
            foreach ($code_list as $key => $val) {//将变量输出到页面
                $var_name = $val['var_name'];
                $code_info = $val['code_info'];
                $code_type = $val['code_type'];
                $val['code_info'] = $model_web_config->get_array($code_info,$code_type);
                foreach ($val['code_info'] as $value) {
                    if ($value['goods_list']) {
                        if ($goods_ids) {
                            $goods_ids = array_merge($goods_ids, array_keys($value['goods_list']));
                        } else {
                            $goods_ids = array_keys($value['goods_list']);
                        }
                    }
                }
                //echo "<pre>";
                //     echo 'code_'.$var_name;
                //print_R($val);
                Tpl::output('code_'.$var_name,$val);
            }
                
            $condition = array('goods_id' => array('in', $goods_ids));
            $goods_list = Model('goods')->getGoodsList($condition, 'goods_id, evaluation_good_star');

            $goods_star = array();
            foreach ($goods_list as $goods) {
                $goods_star[$goods['goods_id']] = $goods['evaluation_good_star'];
            }
            Tpl::output('code_goods_star', $goods_star);
        }
//         echo "<pre>";
//         print_R($article_list);

        //首页底部公告信息
		$model_article = Model('article');


		//评价信息
        $goods_evaluate_info = Model('evaluate_goods')->getEvaluateGoodsList(8);
        Tpl::output('goods_evaluate_info', $goods_evaluate_info);


        Model('seo')->type('index')->show();
        Tpl::showpage('index');
    }

    //json输出商品分类
    public function josn_classOp() {
        /**
         * 实例化商品分类模型
         */
        $model_class        = Model('goods_class');
        $goods_class        = $model_class->getGoodsClassListByParentId(intval($_GET['gc_id']));
        $array              = array();
        if(is_array($goods_class) and count($goods_class)>0) {
            foreach ($goods_class as $val) {
                $array[$val['gc_id']] = array('gc_id'=>$val['gc_id'],'gc_name'=>htmlspecialchars($val['gc_name']),'gc_parent_id'=>$val['gc_parent_id'],'commis_rate'=>$val['commis_rate'],'gc_sort'=>$val['gc_sort']);
            }
        }
        /**
         * 转码
         */
        if (strtoupper(CHARSET) == 'GBK'){
            $array = Language::getUTF8(array_values($array));//网站GBK使用编码时,转换为UTF-8,防止json输出汉字问题
        } else {
            $array = array_values($array);
        }
        echo $_GET['callback'].'('.json_encode($array).')';
    }

    /**
     * json输出地址数组 原data/resource/js/area_array.js
     */
    public function json_areaOp()
    {
        $_GET['src'] = $_GET['src'] != 'db' ? 'cache' : 'db';
        echo $_GET['callback'].'('.json_encode(Model('area')->getAreaArrayForJson($_GET['src'])).')';
    }

    /**
     * 根据ID返回所有父级地区名称
     */
    public function json_area_showOp()
    {
        $area_info['text'] = Model('area')->getTopAreaName(intval($_GET['area_id']));
        echo $_GET['callback'].'('.json_encode($area_info).')';
    }

    //判断是否登录
    public function loginOp(){
        echo ($_SESSION['is_login'] == '1')? '1':'0';
    }

    /**
     * 头部最近浏览的商品
     */
    public function viewed_infoOp(){
        $info = array();
        if ($_SESSION['is_login'] == '1') {
            $member_id = $_SESSION['member_id'];
            $info['m_id'] = $member_id;
            if (C('voucher_allow') == 1) {
                $time_to = time();//当前日期
                $info['voucher'] = Model()->table('voucher')->where(array('voucher_owner_id'=> $member_id,'voucher_state'=> 1,
                'voucher_start_date'=> array('elt',$time_to),'voucher_end_date'=> array('egt',$time_to)))->count();
            }
            $time_to = strtotime(date('Y-m-d'));//当前日期
            $time_from = date('Y-m-d',($time_to-60*60*24*7));//7天前
            $info['consult'] = Model()->table('consult')->where(array('member_id'=> $member_id,
            'consult_reply_time'=> array(array('gt',strtotime($time_from)),array('lt',$time_to+60*60*24),'and')))->count();
        }
        $goods_list = Model('goods_browse')->getViewedGoodsList($_SESSION['member_id'],5);
        if(is_array($goods_list) && !empty($goods_list)) {
            $viewed_goods = array();
            foreach ($goods_list as $key => $val) {
                $goods_id = $val['goods_id'];
                $val['url'] = urlShop('goods', 'index', array('goods_id' => $goods_id));
                $val['goods_image'] = thumb($val, 60);
                $viewed_goods[$goods_id] = $val;
            }
            $info['viewed_goods'] = $viewed_goods;
        }
        if (strtoupper(CHARSET) == 'GBK'){
            $info = Language::getUTF8($info);
        }
        echo json_encode($info);
    }
    /**
     * 查询每月的周数组
     */
    public function getweekofmonthOp(){
        import('function.datehelper');
        $year = $_GET['y'];
        $month = $_GET['m'];
        $week_arr = getMonthWeekArr($year, $month);
        echo json_encode($week_arr);
        die;
    }


    /**
     * 底部邮箱反馈
     */
    public function subscribeOp() {

        $lang   = Language::getLangContent();
        $configs = $GLOBALS['setting_config'];
        $model_mb_feedback = Model('mb_feedback');
        $feedback_type = 3;
        $model_member   = Model('member');

        $email = trim($_POST['email']);

        $obj_validate = new Validate();

        $client_type = isMobile() ? 1 : 2;
        $param = array();
        $obj_validate->validateparam = array(
            array(
                "input" => $email,
                "require" => "true",
                "validator" => "email",
                "message" => "E-mail format incorrect"
            ),
        );
        $error = $obj_validate->validate();
        if ($error != ''){
            exit(json_encode(array('state'=>false,'msg'=>$error)));
        }

        $common_info = Model('mb_feedback')->getMbFeedbackInfo(['email'=>$email,'feedback_type'=>3]);
        if($common_info){
            exit(json_encode(array('state'=>false,'msg'=>'The mailbox has been subscribed')));
        }



        $param['email'] = $email;
        //    $param['mobile'] = $_POST['mobile'];
        //}else{
        //    $param['member_id'] = $this->member_info['member_id'];
        //    $param['member_name'] = $this->member_info['member_name'];
        //    $param['title'] = $_POST['title'];
        //}

        $param['type'] = $client_type;
        $param['feedback_type'] = $feedback_type;
        $param['ftime'] = TIMESTAMP;

        $param['content'] = '游客订阅邮件';


        $result = $model_mb_feedback->addMbFeedback($param);

        if($result) {
            //$res= emailSend($configs['site_email'],$email,'有机商城订阅邮件');
            //if($res){
            //
            //}
            exit(json_encode(array('state'=>true)));
        } else {
            exit(json_encode(array('state'=>false,'msg'=>'Save failed')));
        }
    }
}
