<?php
/**
 * 我的地址
 *
 
 
 
 
 */



defined('interMarket') or exit('Access Invalid!');

class member_addressControl extends mobileMemberControl {

    public function __construct() {
        parent::__construct();
        $this->model_address = Model('address');
    }

    /**
     * 地址列表
     */
    public function address_listOp() {
        $address_list = $this->model_address->getAddressList(array('member_id'=>$this->member_info['member_id']),'is_default desc,address_id desc');
        $address_list = array_slice($address_list,0,10);
        // echo "<pre>";
        // print_R($member_info);
        output_data(array('address_list' => $address_list));
    }

    /**
     * 地址详细信息
     */
    public function address_infoOp() {
        $address_id = intval($_POST['address_id']);

        $condition = array();
        $condition['address_id'] = $address_id;
        $address_info = $this->model_address->getAddressInfo($condition);
        if(!empty($address_id) && $address_info['member_id'] == $this->member_info['member_id']) {
            output_data(array('address_info' => $address_info));
        } else {
            output_error('地址不存在');
        }
    }

    /**
     * 删除地址
     */
    public function address_delOp() {
        $address_id = intval($_POST['address_id']);

        $condition = array();
        $condition['address_id'] = $address_id;
        $condition['member_id'] = $this->member_info['member_id'];
        $this->model_address->delAddress($condition);
        output_data('1');
    }

    /**
     * 新增地址
     */
    public function address_addOp() {
        $address_info = $this->_address_valid();
        // if ($_POST['is_default']) {
        //     $this->model_address->editAddress(array('is_default'=>0),array('member_id'=>$this->member_info['member_id'],'is_default'=>1));
        // }
        $result = $this->model_address->addAddress($address_info);
        if($result) {
            output_data(array('address_id' => $result));
        } else {
            output_error('Save failed');
        }
    }

    /**
     * 编辑地址
     */
    public function address_editOp() {
        $address_id = intval($_POST['address_id']);
        $default_is = $_POST['default_is'];
        //验证地址是否为本人
        $address_info = $this->model_address->getOneAddress($address_id);
        
        if ($address_info['member_id'] != $this->member_info['member_id']) {
            output_error('参数错误');
        }
        $address_info = array();
        if(!isset($default_is)){
            $address_info = $this->_address_valid();
        }else{
            $address_info['is_default']= 1;
            if ($_POST['is_default']) {
                $this->model_address->editAddress(array('is_default'=>0),array('member_id'=>$this->member_info['member_id'],'is_default'=>1));
            }
        }
        // print_R($address_info);die;
        
        $result = $this->model_address->editAddress($address_info, array('address_id'=>$address_id,'member_id'=>$this->member_info['member_id']));
        if($result) {
            output_data('1');
        } else {
            output_error('Save failed');
        }
    }

    /**
     * 验证地址数据
     */
    private function _address_valid() {
        $address_count = Model('address')->where(array('member_id'=>$this->member_info['member_id']))->count();
    
        if($address_count > 10){
            output_error('收货地址最多为10个');
        }
        $obj_validate = new Validate();
        $obj_validate->validateparam = array(
            array("input"=>$_POST["true_name"],"require"=>"true","message"=>'姓名不能为空'),
            array("input"=>$_POST["area_info"],"require"=>"true","message"=>'地区不能为空'),
            array("input"=>$_POST["address"],"require"=>"true","message"=>'地址不能为空'),
            array("input"=>$_POST["zipcode"],"require"=>"true","message"=>'邮政编码不能为空'),
            // array("input"=>$_POST['tel_phone'].$_POST['mob_phone'],'require'=>'true','message'=>'联系方式不能为空'),
            array("input"=>$_POST['mob_phone'],'require'=>'true','message'=>'手机号码不能为空')
        );
        $error = $obj_validate->validate();
        if ($error != ''){
            output_error($error);
        }

        $data = array();
        $data['member_id'] = $this->member_info['member_id'];
        $data['true_name'] = $_POST['true_name'];
        $data['area_id'] = intval($_POST['area_id']);
        $data['city_id'] = intval($_POST['city_id']);
        $data['area_info'] = $_POST['area_info'];
        $data['address'] = $_POST['address'];
        $data['tel_phone'] = $_POST['tel_phone'];
        $data['mob_phone'] = $_POST['mob_phone'];
        $data['is_default'] = $_POST['is_default'] ? 1 : 0;
        $data['zipcode'] = $_POST['zipcode'];
        // print_R($data);die;
        if ($_POST['is_default']) {
            $this->model_address->editAddress(array('is_default'=>0),array('member_id'=>$this->member_info['member_id'],'is_default'=>1));
        }
        return $data;
    }

}
