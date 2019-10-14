<?php
/**
 * 商品报修
 *
 
 
 
 
 */
defined('interMarket') or exit('Access Invalid!');

class member_repaidControl extends BaseHomeControl {

    private $joinin_detail = NULL;
	public function __construct() {
		parent::__construct();

		// Tpl::setLayout('store_joinin_layout');

  //       $this->checkLogin();

  //       $model_seller = Model('seller');
  //       $seller_info = $model_seller->getSellerInfo(array('member_id' => $_SESSION['member_id']));
		// if(!empty($seller_info)) {
  //           @header('location: index.php?model=seller_login');
		// }

  //       if($_GET['fun'] != 'check_seller_name_exist' && $_GET['fun'] != 'checkname') {
  //           $this->check_joinin_state();
  //       }
  //       $phone_array = explode(',',C('site_phone'));
  //       Tpl::output('phone_array',$phone_array);
  //       $model_help = Model('help');
  //       $condition = array();
  //       $condition['type_id'] = '99';//默认显示入驻流程;
  //       $list = $model_help->getShowStoreHelpList($condition);
  //       Tpl::output('list',$list);//左侧帮助类型及帮助
  //       Tpl::output('show_sign','joinin');
  //       Tpl::output('html_title',C('site_name').' - '.'商家入驻');
  //       Tpl::output('article_list','');//底部不显示文章分类
	}

  
	public function indexOp() {
        $this->step0Op();
	}

    public function step0Op() {
        //导航
        $nav_link = array(
            0=>array(
                'title'=>Language::get('homepage'),
                'link'=>SHOP_SITE_URL,
            ),
            1=>array(
                'title'=>'商品报修'
            )
        );
        Tpl::output('nav_link_list',$nav_link);
        // $condition['store_id'] = 1;
        // $goods_list = Model('goods')->getGoodsList($condition, 'goods_id,goods_commonid,goods_name,spec_name');
        // // foreach ($goods_list as $key => $value) {
        // //     $goods_list[$key]['spec_name'] = unserialize($value['spec_name']);
        // // }
        // // echo "<pre>";
        // // print_R($goods_list);
        // Tpl::output('goods_list', $goods_list);

        //产品类型
        $model = Model();

        // echo "<pre>";
        // $on = 'goods_class.gc_id=goods.gc_id_1 AND goods_class.gc_id=2 AND goods_class.gc_parent_id=0';
        // $data1= $model->table('goods_class,goods')->field('goods.goods_id,goods.goods_name,goods.gc_id_1')->join('inner')->on($on)->select();
        $data1= $model->table('goods_class')->field('gc_id,gc_name,gc_parent_id')->where('gc_parent_id = 2')->select();
        Tpl::output('goodsall', $data1);
        // print_R($data1);
        $on = 'type.type_id=attribute.type_id AND type.type_id=6';
        $data= $model->table('type,attribute')->join('inner')->on($on)->select();
        Tpl::output('fenlei', $data);
        // print_R($data);
         //会员信息
       



        $model_document = Model('document');
        $document_info = $model_document->getOneByCode('open_store');
        Tpl::output('agreement', $document_info['doc_content']);
        Tpl::output('step', 'step1');
        Tpl::output('sub_step', 'step0');
        Tpl::showpage('goods_repair');
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
        if(isset($_GET['state'])){
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
            array('menu_key'=>'complain_accuser_list','menu_name'=>'商品报修','menu_url'=>'index.php?model=member_repaid&fun=my_repaid')
        );
        Tpl::output('member_menu',$menu_array);
        Tpl::output('menu_key',$menu_key);
    }
    /**
     * search商品
     **/
    public function search_goodsOp() {
        $model_goods = Model('goods');
        

        $condition['store_id'] = 1;
        // $condition['goods_name'] = array('like', '%'.$_POST['data'].'%');
        $goods_list = Model('goods')->getGoodsList($condition, 'goods_id,goods_commonid,goods_name,spec_name');
        // $goods = $model_goods->getGeneralGoodsCommonList($condition, 'goods_commonid',1);
        // if(!empty($goods)){
        //     $goods_list = Model('goods')->getGoodsList($condition, 'goods_id,goods_commonid,goods_name,spec_name');
        //     print_R($goods_list);
        // }else{
        //     exit(json_encode(array('state'=>false,'code'=>'10','msg'=>'无search结果')));
        // }
        // print_R($goods_list);
        // 
         // $goodscommon_info['spec_name'] = unserialize($goodscommon_info['spec_name']);
        if(!empty($goods_list)){
            exit(json_encode(array('state'=>true,'list'=>$goods_list)));
        }else{
            exit(json_encode(array('state'=>false,'msg'=>'12','msg'=>'该产品无类型')));
        }
        
        
    }

	public function step1Op() {
        Tpl::output('step', 'step2');
        Tpl::output('sub_step', 'step1');
        Tpl::showpage('store_joininc_apply');
    }
    public function step2Op() {
        $model_member   = Model('member');
        //检查登录状态
        // echo "string111";die;
        // $model_member->checkloginMember();
        if(!$_SESSION['member_id']){
            exit(json_encode(array('state'=>false,'msg'=>'未登录')));
        }
        // if ($_GET['inajax'] == 1 && C('captcha_status_login') == '1'){
        //     $script = "document.getElementById('codeimage').src='index.php?model=seccode&fun=makecode&nchash=".getNchash()."&t=' + Math.random();";
        // }
        // echo "string";die;
        
        // $result = chksubmit(false,C('captcha_status_login'),'num');
        // print_R($this->member_info);die;
        if (!checkSeccode($_POST['nchash'],$_POST['captcha'])){
            setNcCookie('seccode'.$_POST['nchash'],'',-3600);
            exit(json_encode(array('state'=>false,'msg'=>'验证码错误')));
        }
        setNcCookie('seccode'.$_POST['nchash'],'',-3600);
        $this->member_info = $model_member->getMemberInfo(array('member_id'=>$_SESSION['member_id']));

        $model_store_joinin = Model('repaid');
        if(!empty($_POST)) {
            $condition = array();
            // $condition['member_id'] = $_SESSION['member_id'];
            // $is = $model_store_joinin->isExist($condition);
            // if($is){
            //     // showMessage('你已提交加盟申请！勿重复提交');
            //     exit(json_encode(array('state'=>false,'msg'=>'你已提交加盟申请！勿重复提交')));
            // }
            $param = array();
            $param['member_id'] = $this->member_info['member_id'];
            $param['member_name'] = $this->member_info['member_name'];

            $param['goods_name'] = $_POST['goodsname'];
            $param['goods_class'] = $_POST['guz_xinghao'];
            $param['buy_time'] = strtotime($_POST['buytime']);
            $param['order_sn'] = $_POST['order_sn'];
            $param['description'] = htmlspecialchars($_POST['desc']); 
          
           
            $param['contacts_name'] = $_POST['true_name'];
            $param['contacts_phone'] = $_POST['mobile'];
            $param['contacts_email'] = $_POST['email'];
            $param['member_areaid'] = intval($_POST['area_id']);
            $param['member_cityid'] = intval($_POST['city_id']);
            // $param['member_provinceid'] = $_POST['email'];
            $param['member_areainfo'] = $_POST['region'];
            $param['address'] = $_POST['address1'];

            $param['state'] = 1;
            $param['add_time'] = time();
            // $param['jiameng_message'] =  htmlspecialchars($_POST['message']); 
            // $param['business_licence_number'] = $_POST['business_licence_number'];
            // $param['business_sphere'] = $_POST['business_sphere'];
            // $param['business_licence_number_elc'] = $this->upload_image('business_licence_number_elc');
            // $param['general_taxpayer'] = $this->upload_image('general_taxpayer');
            // print_R($param);
            // print_R($_POST);die;
            $this->step2_save_valid($param);

            // print_R($param);
            // $joinin_info = $model_store_joinin->getOne(array('member_id' => $this->member_info['member_id']));
            // if(empty($joinin_info)) {
                // $param['member_id'] = $this->member_info['member_id'];   
            $add = $model_store_joinin->save($param);

          
            // } else {
            //     $model_store_joinin->modify($param, array('member_id'=>$this->member_info['member_id']));
            // }
            if($add){
                exit(json_encode(array('state'=>success)));
            }else{
                exit(json_encode(array('state'=>false,'msg'=>'系统错误')));
            }
        }
      


    }
    private function step2_save_valid($param) {
        $obj_validate = new Validate();
        $obj_validate->validateparam = array(
            // array("input"=>$param['company_name'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"50","message"=>"Shop name不能为空且必须小于50个字"),
            // array("input"=>$param['company_address'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"50","message"=>"所在地不能为空且必须小于50个字"),
            // array("input"=>$param['company_address_detail'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"50","message"=>"详细地址不能为空且必须小于50个字"),
            // array("input"=>$param['contacts_name'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"20","message"=>"联系人姓名不能为空且必须小于20个字"),
            // array("input"=>$param['contacts_phone'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"20","message"=>"联系人电话不能为空"),
            // array("input"=>$param['contacts_email'], "require"=>"true","validator"=>"email","message"=>"电子邮箱不能为空"),
            // array("input"=>$param['business_licence_number'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"20","message"=>"身份证号不能为空且必须小于20个字"),
            // array("input"=>$param['business_sphere'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"500","message"=>"姓名不能为空且必须小于50个字"),
            // array("input"=>$param['business_licence_number_elc'], "require"=>"true","message"=>"身份证扫描件不能为空"),

            array("input"=>$param['goods_name'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"50","message"=>"产品名称不能为空"),
            array("input"=>$param['goods_class'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"50","message"=>"产品型号不能为空"),

            array("input"=>$param['contacts_name'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"20","message"=>"联系人姓名不能为空且必须小于20个字"),
            array("input"=>$param['contacts_phone'], "require"=>"true","validator"=>"mobile","min"=>"1","max"=>"20","message"=>"联系人电话不能为空"),
            array("input"=>$param['contacts_email'], "require"=>"true","validator"=>"email","message"=>"电子邮箱不能为空"),
            array("input"=>$param['member_areaid'],"require"=>"true","validator"=>"Number","message"=>$lang['member_address_wrong_area']),
            array("input"=>$param['member_cityid'],"require"=>"true","validator"=>"Number","message"=>$lang['member_address_wrong_area']),
            array("input"=>$param['member_areainfo'],"require"=>"true","message"=>$lang['member_address_area_null']),
            array("input"=>$param['address'],"require"=>"true","message"=>'详细地址不能为空'),
            array("input"=>$param['description'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"500","message"=>"描述不能为空且必须小于500个字"),
        );
        $error = $obj_validate->validate();
        if ($error != ''){
            // showMessage($error);
            exit(json_encode(array('state'=>false,'msg'=>$error)));
        }
    }
    public function step3Op() {
        if(!empty($_POST)) {
            $param = array();

            $param['settlement_bank_account_name'] = $_POST['settlement_bank_account_name'];
            $param['settlement_bank_account_number'] = $_POST['settlement_bank_account_number'];

            $this->step3_save_valid($param);

            $model_store_joinin = Model('store_joinin');
            $model_store_joinin ->modify($param, array('member_id'=>$_SESSION['member_id']));
        }

        //商品分类
        $gc	= Model('goods_class');
        $gc_list	= $gc->getGoodsClassListByParentId(0);
        Tpl::output('gc_list',$gc_list);

		//店铺等级
		$grade_list = rkcache('store_grade',true);
		//附加功能
		if(!empty($grade_list) && is_array($grade_list)){
			foreach($grade_list as $key=>$grade){
				$sg_function = explode('|',$grade['sg_function']);
				if (!empty($sg_function[0]) && is_array($sg_function)){
					foreach ($sg_function as $key1=>$value){
						if ($value == 'editor_multimedia'){
							$grade_list[$key]['function_str'] .= '富文本编辑器';
						}
					}
				}else {
					$grade_list[$key]['function_str'] = '无';
				}
			}
		}
		Tpl::output('grade_list', $grade_list);

		 //店铺分类
        $model_store = Model('store_class');
        $store_class = $model_store->getStoreClassList(array(),'',false);
        Tpl::output('store_class', $store_class);

        Tpl::output('step', '3');
        Tpl::output('sub_step', 'step3');
        Tpl::showpage('store_joininc_apply');
        exit;

    }



    public function step4Op() {
        $store_class_ids = array();
        $store_class_names = array();
        if(!empty($_POST['store_class_ids'])) {
            foreach ($_POST['store_class_ids'] as $value) {
                $store_class_ids[] = $value;
            }
        }
        if(!empty($_POST['store_class_names'])) {
            foreach ($_POST['store_class_names'] as $value) {
                $store_class_names[] = $value;
            }
        }
        //取最小级分类最新分佣比例
        $sc_ids = array();
        foreach ($store_class_ids as $v) {
            $v = explode(',',trim($v,','));
            if (!empty($v) && is_array($v)) {
                $sc_ids[] = end($v);
            }
        }
        if (!empty($sc_ids)) {
            $store_class_commis_rates = array();
            $goods_class_list = Model('goods_class')->getGoodsClassListByIds($sc_ids);
            if (!empty($goods_class_list) && is_array($goods_class_list)) {
                $sc_ids = array();
                foreach ($goods_class_list as $v) {
                    $store_class_commis_rates[] = $v['commis_rate'];
                }
            }
        }
        $param = array();
        $param['seller_name'] = $_POST['seller_name'];
        $param['store_name'] = $_POST['store_name'];
        $param['store_class_ids'] = serialize($store_class_ids);
        $param['store_class_names'] = serialize($store_class_names);
        $param['joinin_year'] = intval($_POST['joinin_year']);
        $param['joinin_state'] = STORE_JOIN_STATE_NEW;
        $param['store_class_commis_rates'] = implode(',', $store_class_commis_rates);

        //取店铺等级信息
        $grade_list = rkcache('store_grade',true);
        if (!empty($grade_list[$_POST['sg_id']])) {
            $param['sg_id'] = $_POST['sg_id'];
            $param['sg_name'] = $grade_list[$_POST['sg_id']]['sg_name'];
            $param['sg_info'] = serialize(array('sg_price' => $grade_list[$_POST['sg_id']]['sg_price']));
        }

        //取最新店铺分类信息
        $store_class_info = Model('store_class')->getStoreClassInfo(array('sc_id'=>intval($_POST['sc_id'])));
        if ($store_class_info) {
            $param['sc_id'] = $store_class_info['sc_id'];
            $param['sc_name'] = $store_class_info['sc_name'];
            $param['sc_bail'] = $store_class_info['sc_bail'];
        }

        //店铺应付款
        $param['paying_amount'] = floatval($grade_list[$_POST['sg_id']]['sg_price'])*$param['joinin_year']+floatval($param['sc_bail']);
        $this->step4_save_valid($param);

        $model_store_joinin = Model('store_joinin');
        $model_store_joinin->modify($param, array('member_id'=>$_SESSION['member_id']));

        @header('location: index.php?model=store_joininc');

    }

  
     public function payOp() {
        if (!empty($this->joinin_detail['sg_info'])) {
            $store_grade_info = Model('store_grade')->getOneGrade($this->joinin_detail['sg_id']);
            $this->joinin_detail['sg_price'] = $store_grade_info['sg_price'];
        } else {
            $this->joinin_detail['sg_info'] = @unserialize($this->joinin_detail['sg_info']);
            if (is_array($this->joinin_detail['sg_info'])) {
                $this->joinin_detail['sg_price'] = $this->joinin_detail['sg_info']['sg_price'];
            }
        }
        Tpl::output('joinin_detail', $this->joinin_detail);
        Tpl::output('step', '4');
        Tpl::output('sub_step', 'pay');
        Tpl::showpage('store_joinin_apply');
        exit;
    }

    public function pay_saveOp() {
        $param = array();
        $param['paying_money_certificate'] = $this->upload_image('paying_money_certificate');
        $param['paying_money_certif_exp'] = $_POST['paying_money_certif_exp'];
        $param['joinin_state'] = STORE_JOIN_STATE_PAY;

        if(empty($param['paying_money_certificate'])) {
            showMessage('Please upload the payment voucher','','','error');
        }

        $model_store_joinin = Model('store_joinin');
        $model_store_joinin->modify($param, array('member_id'=>$_SESSION['member_id']));

        @header('location: index.php?model=store_joinin');
    }


    private function step4() {
        $model_store_joinin = Model('store_joinin');
        $joinin_detail = $model_store_joinin->getOne(array('member_id'=>$_SESSION['member_id']));
        $joinin_detail['store_class_ids'] = unserialize($joinin_detail['store_class_ids']);
        $joinin_detail['store_class_names'] = unserialize($joinin_detail['store_class_names']);
        $joinin_detail['store_class_commis_rates'] = explode(',', $joinin_detail['store_class_commis_rates']);
        $joinin_detail['sg_info'] = unserialize($joinin_detail['sg_info']);
        Tpl::output('joinin_detail',$joinin_detail);
    }

    private function show_join_message($message, $btn_next = FALSE, $step = 'step2') {
        Tpl::output('joinin_message', $message);
        Tpl::output('btn_next', $btn_next);
        Tpl::output('step', $step);
        Tpl::output('sub_step', 'step4');
        Tpl::showpage('store_joininc_apply');
 	exit;
    }

    private function upload_image($file) {
        $pic_name = '';
        $upload = new UploadFile();
        $uploaddir = ATTACH_PATH.DS.'store_joinin'.DS;
        $upload->set('default_dir',$uploaddir);
        $upload->set('allow_type',array('jpg','jpeg','gif','png'));
        if (!empty($_FILES[$file]['name'])){
            $result = $upload->upfile($file);
            if ($result){
                $pic_name = $upload->file_name;
                $upload->file_name = '';
            }
        }
        return $pic_name;
    }

	/**
	 * 检查Shop name是否存在
	 *
	 * @param 
	 * @return 
	 */
	public function checknameOp() {
		/**
		 * 实例化卖家模型
		 */
		$model_store	= Model('store');
		$store_name = $_GET['store_name'];
		$store_info = $model_store->getStoreInfo(array('store_name'=>$store_name));
		if(!empty($store_info['store_name']) && $store_info['member_id'] != $_SESSION['member_id']) {
			echo 'false';
		} else {
			echo 'true';
		}
	}
}
