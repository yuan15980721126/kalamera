<?php
/**
 * 积分中心我的成长进度
 
 
 
 
 */


defined('interMarket') or exit('Access Invalid!');
class pointgradeControl extends BasePointShopControl {
    public function __construct() {
        parent::__construct();
        //验证是否登录
        if ($_SESSION['is_login'] != '1'){
            showDialog(L('no_login'),urlLogin('login'), 'error');
        }
    }
    public function indexOp(){
        //查询会员及其附属信息
        $result = parent::pointshopMInfo(true);
        $member_info = $result['member_info'];
        unset($result);

        $model_member = Model('member');
        //获得会员升级进度
        $membergrade_arr = $model_member->getMemberGradeArr(true, $member_info['member_exppoints'],$member_info['level']);
        Tpl::output('membergrade_arr', $membergrade_arr);
            // echo "<pre>";
            // print_R($membergrade_arr);
        //处理经验值计算说明文字
        $exppoints_rule = C("exppoints_rule")?unserialize(C("exppoints_rule")):array();
        $ruleexplain_arr = array();
        $exppoints_rule['exp_orderrate'] = floatval($exppoints_rule['exp_orderrate']);
        if ($exppoints_rule['exp_orderrate'] > 0){
            $ruleexplain_arr['exp_order'] = "经验值以有效购物金额作为计算标准，有效购物金额{$exppoints_rule['exp_orderrate']}元=1经验值；";
            $exp_ordermax = intval($exppoints_rule['exp_ordermax']);
            if ($exp_ordermax > 0){
                $ruleexplain_arr['exp_order'] .= "单个订单最多获得{$exppoints_rule['exp_ordermax']}经验值；";
            }
        }
        $exppoints_rule['exp_login'] = intval($exppoints_rule['exp_login']);
        if ($exppoints_rule['exp_login'] > 0){
            $ruleexplain_arr['exp_login'] = "会员每天第一次登录获得{$exppoints_rule['exp_login']}经验值；";
        }
        $exppoints_rule['exp_comments'] = intval($exppoints_rule['exp_comments']);
        if ($exppoints_rule['exp_comments'] > 0){
            $ruleexplain_arr['exp_comments'] = "进行一次订单商品评价将获得{$exppoints_rule['exp_comments']}经验值；";
        }
        Tpl::output('ruleexplain_arr', $ruleexplain_arr);

        //分类导航
        $nav_link = array(
                0=>array('title'=>L('homepage'),'link'=>SHOP_SITE_URL),
                1=>array('title'=>L('nc_pointprod'),'link'=>urlShop('pointshop','index')),
                2=>array('title'=>'我的成长进度')
        );
        $model_setting = Model('setting');
        $list_setting = $model_setting->getListSetting();
        $list_setting['member_grade'] = $list_setting['member_grade']?unserialize($list_setting['member_grade']):array();
        foreach ($list_setting['member_grade'] as $key => $value) {
            $level = $value['level'];
            if($level == 0){
                $value['level_desc'] = '注册会员';
            }else if($level == 1){
                $value['level_desc'] = '铜卡会员';
            }else if($level == 2){
                $value['level_desc'] =  '银卡会员';
            }else if($level == 3){
                $value['level_desc'] =  '金卡会员';
            }else if($level == 4){
                $value['level_desc'] =  '钻石会员';
            }
            $list_setting['member_grade'][$key] = $value;
        }
        //信息输出
        self::profile_menu('points');
        
        Tpl::output('member_grade', $list_setting['member_grade']);
        Tpl::output('nav_link_list', $nav_link);
        Tpl::showpage('pointgrade');
    }
    /**
     * 经验明细列表
     */
    public function exppointlogOp(){
        //查询会员及其附属信息
        $result = parent::pointshopMInfo();

        //查询积分日志列表
        $model_exppoints = Model('exppoints');
        $where = array();
        $where['exp_memberid'] = $_SESSION['member_id'];
        $list_log = $model_exppoints->getExppointsLogList($where, '*', 20, 0, 'exp_id desc');
        //信息输出
        Tpl::output('stage_arr',$model_exppoints->getStage());
        Tpl::output('show_page', $model_exppoints->showpage(5));
        Tpl::output('list_log',$list_log);
        //分类导航
        $nav_link = array(
                0=>array('title'=>L('homepage'),'link'=>SHOP_SITE_URL),
                1=>array('title'=>L('nc_pointprod'),'link'=>urlShop('pointshop','index')),
                2=>array('title'=>'经验值明细')
        );
        //信息输出
        self::profile_menu('exppointlog');
        Tpl::output('nav_link_list', $nav_link);
        Tpl::showpage('point_exppointslog');
    }
    /**
     * 用户中心右边，小导航
     *
     * @param string    $menu_type  导航类型
     * @param string    $menu_key   当前导航的menu_key
     * @param array     $array      附加菜单
     * @return
     */
    private function profile_menu($menu_key='',$array=array()) {
        $menu_array = array(
            1=>array('menu_key'=>'points',  'menu_name'=>'等级信息',    'menu_url'=>'index.php?model=pointgrade&fun=index'),
            2=>array('menu_key'=>'exppointlog','menu_name'=>'经验值明细',    'menu_url'=>'index.php?model=pointgrade&fun=exppointlog')
        );
        if(!empty($array)) {
            $menu_array[] = $array;
        }
        // echo "<pre>";
        //     print_R($menu_array);
        Tpl::output('member_menu',$menu_array);
        Tpl::output('menu_key',$menu_key);
    }
}
