<?php
/**
 * 收货地址
 */



defined('interMarket') or exit('Access Invalid!');

class member_addressControl extends BaseMemberControl{
    /**
     * 会员地址
     *
     * @param
     * @return
     */
    public function addressOp() {

        Language::read('member_address');
        $lang   = Language::getLangContent();

        $address_class = Model('address');

        /**
         * 判断操作类型
         */
        if($_GET['type'] == 'default'){
            //修改默认地址
            if($_GET['id']){
                $address_class->editAddress(array('is_default'=>0), array('member_id'=>$_SESSION['member_id']));
                $address_class->editAddress(array('is_default'=>1), array('address_id' => intval($_GET['id']),'member_id'=>$_SESSION['member_id']));
                showDialog('Successful operation','reload','success');
            }
            showDialog('operation failed','reload','error');
        }

        //delete
        if($_GET['type'] == 'del'){
            $del_id = isset($_GET['id']) ? intval(trim($_GET['id'])) : 0 ;
            if ($del_id > 0){
                $rs = $address_class->delAddress(array('address_id'=>$del_id,'member_id'=>$_SESSION['member_id']));
                if ($rs){
                    showDialog('Delete successful','reload','success');
                }else {
                    showDialog('Failed to delete address','reload','error');
                }
            }
        }


        /**
         * 判断页面类型
         */
        if ($_GET['type'] == 'edit'){
            /**
             * 新增/编辑地址页面
             */
            if (intval($_GET['id']) > 0){
                /**
                 * 得到地址信息
                 */
                $address_info = $address_class->getOneAddress(intval($_GET['id']));
                if ($address_info['member_id'] != $_SESSION['member_id']){
                    showMessage($lang['member_address_wrong_argument'],'index.php?model=member_address&fun=address','html','error');
                }
                /**
                 * 输出地址信息
                 */
                Tpl::output('address_info',$address_info);
            }
            /**
             * 增加/修改页面输出
             */
            Tpl::output('type',$_GET['type']);
            if ($_GET['layout'] == 'order'){
                Tpl::showpage('order_address.edit','null_layout');
            }else{
                Tpl::showpage('member_address.edit','null_layout');
            }

            exit();
        }
        /**
         * 判断操作类型
         */
        if (chksubmit()){
            if ($_POST['city_id'] == '') {
                $_POST['city_id'] = $_POST['area_id'];
            }
            /**
             * 验证表单信息
             */
            $obj_validate = new Validate();
            $obj_validate->validateparam = array(
                array("input"=>$_POST["firstName"],"require"=>"true","message"=>'firstName Can not be empty'),
                array("input"=>$_POST["lastName"],"require"=>"true","message"=>'lastName Can not be empty'),
                array("input"=>$_POST["company"],"require"=>"true","message"=>'Please enter the company name'),
                array("input"=>$_POST["address"],"require"=>"true","message"=>'Please enter street address'),
                array("input"=>$_POST["apartment"],"require"=>"true","message"=>'Please enter the name of the apartment'),
                array("input"=>$_POST["mob_phone"],"require"=>"true","message"=>'Please enter your telephone number'),
                array("input"=>$_POST["area_id"],"require"=>"true","validator"=>"Number","message"=>$lang['member_address_wrong_area']),
                array("input"=>$_POST["city_id"],"require"=>"true","validator"=>"Number","message"=>$lang['member_address_wrong_area']),
                array("input"=>$_POST["region"],"require"=>"true","message"=>$lang['member_address_area_null']),
                //array("input"=>$_POST['tel_phone'].$_POST['mob_phone'],'require'=>'true','message'=>$lang['member_address_phone_and_mobile']),
                array("input"=>$_POST['zipcode'],'require'=>'true','message'=>'Postal code cannot be empty')
            );
            $error = $obj_validate->validate();
            if ($error != ''){
                showValidateError($error);
            }
            $data = array();
            $data['member_id'] = $_SESSION['member_id'];
            $data['true_name']    = htmlspecialchars(strip_tags($_POST['firstName'])) .'---'. htmlspecialchars(strip_tags($_POST['lastName']));

            $data['company'] = $_POST['company'];
            $data['apartment'] = $_POST['apartment'];

            $data['area_id'] = intval($_POST['area_id']);
            $data['city_id'] = intval($_POST['city_id']);
            $data['area_info'] = $_POST['region'];
            $data['address'] = $_POST['address'];
            $data['tel_phone'] = $_POST['tel_phone'];
            $data['mob_phone'] = $_POST['mob_phone'];
            $data['is_default'] = $_POST['is_default'] ? 1 : 0;
            $data['zipcode'] = $_POST['zipcode'];

            // BEGIN 保存 city ，state字段 by siuloong 20190506
            $area_city = Model('area')->getAreaInfo(array('area_id' => $data['city_id']));
            $data['city'] = $area_city['area_name'];
            $area_area = Model('area')->getAreaInfo(array('area_id' => $data['area_id']));
            $data['state'] = $area_area['area_code'];
            // END
            
            if ($_POST['is_default']) {
                $address_class->editAddress(array('is_default'=>0),array('member_id'=>$_SESSION['member_id'],'is_default'=>1));
            }

            if (intval($_POST['id']) > 0){
                $rs = $address_class->editAddress($data, array('address_id' => intval($_POST['id']),'member_id'=>$_SESSION['member_id']));
                if (!$rs){
                    showDialog($lang['member_address_modify_fail'],'','error');
                }
            }else {
                $count = $address_class->getAddressCount(array('member_id'=>$_SESSION['member_id']));
                if ($count >= 10) {
                    showDialog('Added up to 10 valid addresses','','error');
                }
                $rs = $address_class->addAddress($data);
                if (!$rs){
                    showDialog('Failure to add new address','','error');
                }
            }
            showDialog('Successful operation','reload','js');
        }
        $del_id = isset($_GET['id']) ? intval(trim($_GET['id'])) : 0 ;
        if ($del_id > 0){
            $rs = $address_class->delAddress(array('address_id'=>$del_id,'member_id'=>$_SESSION['member_id']));
            if ($rs){
                showDialog('Delete successful','index.php?model=member_address&fun=address','js');
            }else {
                showDialog('Failed to delete address','','error');
            }
        }
        $address_list = $address_class->getAddressList(array('member_id'=>$_SESSION['member_id']), 'is_default desc');

        $nav_link = array(
            array(
                'title'=>'My Account',
                'link'=>BASE_SITE_URL
            ),
            array(
                'title'=>'Addresses'
            )
        );
        Tpl::output('nav_link_list',$nav_link);
        Tpl::output('address_list',$address_list);
        Tpl::showpage('member_address.index');
    }

    /**
     * 添加自提点型收货地址
     */
    public function delivery_addOp() {
        if (chksubmit()) {
            $info = Model('delivery_point')->getDeliveryPointOpenInfo(array('dlyp_id'=>intval($_POST['dlyp_id'])));
            if (empty($info)) {
                showDialog('该自提点不存在','','error');
            }
            $data = array();
            $data['member_id'] = $_SESSION['member_id'];
            $data['true_name'] = $_POST['true_name'];
            $data['area_id'] = $info['dlyp_area_3'];
            $data['city_id'] = $info['dlyp_area_2'];
            $data['area_info'] = $info['dlyp_area_info'];
            $data['address'] = $info['dlyp_address'];
            $data['tel_phone'] = $_POST['tel_phone'];
            $data['mob_phone'] = $_POST['mob_phone'];
            $data['dlyp_id'] = $info['dlyp_id'];
            $data['is_default'] = 0;
            if (intval($_POST['address_id'])) {
                $result = Model('address')->editAddress($data, array('address_id' => intval($_POST['address_id'])));
            } else {
                $count = Model('address')->getAddressCount(array('member_id'=>$_SESSION['member_id']));
                if ($count >= 20) {
                    showDialog('最多允许添加20个有效地址','','error');
                }
                $result = Model('address')->addAddress($data);
            }
            if (!$result){
                showDialog('Save failed','','error');
            }
            showDialog('Save successfully','reload','js');
        } else {
            if (intval($_GET['id']) > 0) {
                $model_addr = Model('address');
                $condition = array('address_id'=>intval($_GET['id']),'member_id'=>$_SESSION['member_id']);
                $address_info = $model_addr->getAddressInfo($condition);
                //取出省级ID
                $area_info = Model('area')->getAreaInfo(array('area_id'=>$address_info['city_id']));
                $address_info['province_id'] = $area_info['area_parent_id'];
                Tpl::output('address_info',$address_info);
            }
            Tpl::showpage('member_address.delivery_add','null_layout');
        }
    }

    /**
     * 展示自提点列表
     */
    public function delivery_listOp() {
        $model_delivery = Model('delivery_point');
        $condition = array();
        $condition['dlyp_area'] = intval($_GET['area_id']);
        $list = $model_delivery->getDeliveryPointOpenList($condition,5);
        Tpl::output('show_page',$model_delivery->showpage());
        Tpl::output('list',$list);
        Tpl::showpage('member_address.delivery_list','null_layout');
    }

    /**
     * 用户中心右边，小导航
     *
     * @param string    $menu_type  导航类型
     * @param string    $menu_key   当前导航的menu_key
     * @return
     */
    private function profile_menu($menu_type,$menu_key='') {
        /**
         * 读取语言包
         */
        Language::read('member_layout');
        $menu_array = array();
        switch ($menu_type) {
            case 'address':
                $menu_array = array(
                1=>array('menu_key'=>'address','menu_name'=>'地址列表',   'menu_url'=>'index.php?model=member_adderss&fun=address'));
                break;
        }
        Tpl::output('member_menu',$menu_array);
        Tpl::output('menu_key',$menu_key);
    }
}
