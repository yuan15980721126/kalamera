<?php
/**
 * 优惠券

 */


defined('interMarket') or exit('Access Invalid!');

class member_voucherControl extends BaseMemberControl
{

    public function __construct()
    {
        parent::__construct();
        Language::read('member_layout,member_voucher');
        // 判断系统是否开启优惠券功能
        if (intval(C('voucher_allow')) !== 1) {
            showMessage('系统未开启优惠券功能', urlShop('member', 'home'), 'html', 'error');
        }
    }

    /*
     * 默认显示优惠券模版列表
     */
    public function indexOp()
    {
        $this->voucher_listOp();
    }

    /*
     * 获取优惠券模版详细信息
     */
    public function voucher_listOp()
    {
        $model = Model('voucher');
        $list = $model->getMemberVoucherList($_SESSION['member_id'], $_GET['select_detail_state'], 10, 'voucher_active_date desc');
        
        // 取已经使用过并且未有voucher_order_id的优惠券的订单ID
        $used_voucher_code = array();
        $voucher_order = array();
        if (! empty($list)) {
            foreach ($list as $v) {
                if ($v['voucher_state'] == 2 && empty($v['voucher_order_id'])) {
                    $used_voucher_code[] = $v['voucher_code'];
                }
            }
        }
        if (! empty($used_voucher_code)) {
            $order_list = Model('order')->getOrderCommonList(array(
                'voucher_code' => array(
                    'in',
                    $used_voucher_code
                )
            ), 'order_id,voucher_code');
            if (! empty($order_list)) {
                foreach ($order_list as $v) {
                    $voucher_order[$v['voucher_code']] = $v['order_id'];
                    $model->editVoucher(array(
                        'voucher_order_id' => $v['order_id']
                    ), array(
                        'voucher_code' => $v['voucher_code']
                    ));
                }
            }
        }
        
        // 清空缓存
        dcache($_SESSION['member_id'], 'm_voucher');

        $nav_link_list = array(
            array(
                'title'=>'My Account',
                'link'=>urlShop('member', 'home')
            ),
            array(
                'title'=>'Coupon'
            )
        );
        Tpl::output('nav_link_list', $nav_link_list );

        // echo "<pre>";
        // print_R($list);
        Tpl::output('list', $list);
        Tpl::output('voucherstate_arr', $model->getVoucherStateArray());
        Tpl::output('show_page', $model->showpage(2));
        $this->profile_menu('voucher_list');
        Tpl::showpage('member_voucher.list');
    }

    /**
     * 通过卡密绑定优惠券
     */
    public function voucher_bindingOp()
    {
        if (chksubmit(false, true)) {
            $obj_validate = new Validate();
            $obj_validate->validateparam = array(
                array(
                    "input" => $_POST["pwd_code"],
                    "require" => "true",
                    "message" => 'Please enter the coupon serial number'
                )
            );
            $error = $obj_validate->validate();
            if ($error != '') {
//                exit(json_encode(array('state'=>false,'msg'=>$error)));
                showDialog($error,'','error','submiting = false');
            }
            // 查询优惠券
            $model_voucher = Model('voucher');
            $where = array();
            $where['voucher_pwd'] = md5($_POST["pwd_code"]);
            $voucher_info = $model_voucher->getVoucherInfo($where);
            if (! $voucher_info) {
//                exit(json_encode(array('state'=>false,'msg'=>'优惠券卡密错误')));
                showDialog('Coupon serial number error','','error');
            }
            if (intval($_SESSION['store_id']) == $voucher_info['voucher_store_id']) {
//                exit(json_encode(array('state'=>false,'msg'=>'不能领取自己店铺的优惠券')));
                showDialog('Can not get coupons from your own store','','error','submiting = false');
            }
            if ($voucher_info['voucher_owner_id'] > 0) {
//                exit(json_encode(array('state'=>false,'msg'=>'该优惠券卡密已被使用，不可重复领取')));
                showDialog('The coupon serial number has been used and cannot be retrieved repeatedly','','error','submiting = false');
            }
            $where = array();
            $where['voucher_id'] = $voucher_info['voucher_id'];
            $update_arr = array();
            $update_arr['voucher_owner_id'] = $_SESSION['member_id'];
            $update_arr['voucher_owner_name'] = $_SESSION['member_name'];
            $update_arr['voucher_active_date'] = time();
            $result = $model_voucher->editVoucher($update_arr, $where, $_SESSION['member_id']);
            if ($result) {
                // 更新优惠券模板
                $update_arr = array();
                $update_arr['voucher_t_giveout'] = array(
                    'exp',
                    'voucher_t_giveout+1'
                );
                $model_voucher->editVoucherTemplate(array(
                    'voucher_t_id' => $voucher_info['voucher_t_id']
                ), $update_arr);
//                exit(json_encode(array('state'=>true,'msg'=>'优惠券领取成功')));
                showDialog('Coupon received successfully', 'index.php?model=member_voucher&fun=voucher_list', 'succ');
            } else {
//                exit(json_encode(array('state'=>false,'msg'=>'优惠券领取失败')));
                showDialog('Coupon collection failed','','error','submiting = false');
            }
        }


        $condition = array();
        $condition['voucher_t_gettype'] = 3;
        $condition['voucher_t_state'] = 1;
        $condition['voucher_t_end_date'] = array('gt', time());
        $condition['voucher_t_mgradelimit'] = array('elt', $this->member_info['level']);
        $condition['voucher_t_store_id'] = 1;
        $voucher_template = Model('voucher')->getVoucherTemplateList($condition,'','',8);
        
        foreach ($voucher_template as $k => $v) {
            $voucher_template[$k]['voucher_t_customimg'] = $v['voucher_t_customimg'];
        }
        // $voucher_template = array_under_reset($voucher_template, 'voucher_t_store_id', 2);
        // echo "<pre>";
        // print_R($voucher_template);
        // $voucher_template='';
        Tpl::output('voucher_template', $voucher_template);
        Tpl::output('show_page', Model('voucher')->showpage());
        $this->profile_menu('voucher_binding');
        Tpl::showpage('member_voucher.binding');
    }

    /**
     * 用户中心右边，小导航
     *
     * @param string $menu_type
     *            导航类型
     * @param string $menu_key
     *            当前导航的menu_key
     * @param array $array
     *            附加菜单
     * @return
     *
     */
    private function profile_menu($menu_key = '')
    {
        $menu_array = array(
            1 => array(
                'menu_key' => 'voucher_list',
                'menu_name' => Language::get('nc_myvoucher'),
                'menu_url' => 'index.php?model=member_voucher&fun=voucher_list'
            ),
            2 => array(
                'menu_key' => 'voucher_binding',
                'menu_name' => '领取优惠券',
                'menu_url' => 'index.php?model=member_voucher&fun=voucher_binding'
            )
        );
        Tpl::output('member_menu', $menu_array);
        Tpl::output('menu_key', $menu_key);
    }
    /**
     * 领取免费代金券
     */
   public function getvouchersaveOp() {
        $t_id = intval($_GET['tid']);
        if($t_id <= 0){
            // showDialog('代金券信息错误','','error');
            exit(json_encode(array('state'=>false,'msg'=>'代金券信息错误')));
        }
        $model_voucher = Model('voucher');
        //验证是否可领取代金券
        $data = $model_voucher->getCanChangeTemplateInfo($t_id, intval($_SESSION['member_id']), intval($_SESSION['store_id']));
        if ($data['state'] == false){
            // showDialog($data['msg'], '', 'error');
            exit(json_encode(array('state'=>false,'msg'=>$data['msg'])));
        }
        try {
            $model_voucher->beginTransaction();
            //添加代金券信息
            $data = $model_voucher->exchangeVoucher($data['info'], $_SESSION['member_id'], $_SESSION['member_name']);
            if ($data['state'] == false) {
                throw new Exception($data['msg']);
            }
            $model_voucher->commit();
            exit(json_encode(array('state'=>true,'msg'=>'代金券领取成功')));
            // showDialog('代金券领取成功', ($_GET['jump'] === '0') ? '':urlMember('member_voucher', 'voucher_list'), 'succ');
        } catch (Exception $e) {
            $model_voucher->rollback();
            // showDialog($e->getMessage(), '', 'error');
            exit(json_encode(array('state'=>false,'msg'=>$e->getMessage())));
        }
        
    }
}
