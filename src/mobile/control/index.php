<?php
/**
 * 手机端首页控制
 * 
 
 
 
 
 *
 */



defined('interMarket') or exit('Access Invalid!');
class indexControl extends mobileHomeControl{

    public function __construct() {
        parent::__construct();
    } 

    /**
     * 首页
     */
    public function indexOp() {
        $model_mb_special = Model('mb_special');
        $data = rkcache('mobile_specialindex', true);
        if (!$data) {
            $data = $model_mb_special->getMbSpecialIndex();
            //echo "<pre>";
            //print_R($data);
            if (!empty($data)) {
                foreach ($data as $k => $v) {
                    if (is_array($v)) {
                        foreach ($v as $k1 => $v1) {
                            if ($k1 == 'goods2') {
                                // print_R($v1);
                                $start = strtotime($v1['starttime']);
                                $end = strtotime($v1['endtime']);
                                $now = time();
                                $data[$k]['goods2']['start'] = $start;
                                $data[$k]['goods2']['end'] = $end;
                                $data[$k]['goods2']['now'] = $now;
                            }
                        }

                    }
                }
            }
            // 写入缓存
            wkcache('mobile_specialindex', $data);
        }
        // print_R($data);
        $this->_output_special($data, $_GET['type']);
    }

    /**
     * 专题
     */
    public function specialOp() {
        $model_mb_special = Model('mb_special');
        $info = $model_mb_special->getMbSpecialInfoByID($_GET['special_id']);
        $list = $model_mb_special->getMbSpecialItemUsableListByID($_GET['special_id']);
        $data = array_merge($info, array('list' => $list));
        $this->_output_special($data, $_GET['type'], $_GET['special_id']);
    }

    /**
     * 输出专题
     */
    private function _output_special($data, $type = 'json', $special_id = 0) {
        $model_special = Model('mb_special');
        if($_GET['type'] == 'html') {
            $html_path = $model_special->getMbSpecialHtmlPath($special_id);
            if(!is_file($html_path)) {
                ob_start();
                Tpl::output('list', $data);
                Tpl::showpage('mb_special');
                file_put_contents($html_path, ob_get_clean());
            }
            header('Location: ' . $model_special->getMbSpecialHtmlUrl($special_id));
            die;
        } else {
            output_data($data);
        }
    }

    /**
     * android客户端版本号
     */
    public function apk_versionOp() {
        $version = C('mobile_apk_version');
        $url = C('mobile_apk');
        if(empty($version)) {
           $version = '';
        }
        if(empty($url)) {
            $url = '';
        }

        output_data(array('version' => $version, 'url' => $url));
    }

    /**
     * 默认搜索词列表
     */
    public function search_key_listOp() {
        $list = @explode(',',C('hot_search'));
        if (!$list || !is_array($list)) { 
            $list = array();
        }
        if ($_COOKIE['hisSearch'] != '') {
            $his_search_list = explode('~', $_COOKIE['hisSearch']);
        }
        if (!$his_search_list || !is_array($his_search_list)) {
            $his_search_list = array();
        }
        output_data(array('list'=>$list,'his_list'=>$his_search_list));
    }

    /**
     * 热门搜索列表
     */
    public function search_hot_infoOp() {
        if (C('rec_search') != '') {
            $rec_search_list = @unserialize(C('rec_search'));
        }
        $rec_search_list = is_array($rec_search_list) ? $rec_search_list : array();
        $result = $rec_search_list[array_rand($rec_search_list)];
        output_data(array('hot_info'=>$result ? $result : array()));
    }

    /**
     * 高级搜索
     */
    public function search_advOp() {
        $area_list = Model('area')->getAreaList(array('area_deep'=>1),'area_id,area_name');
        if (C('contract_allow') == 1) {
            $contract_list = Model('contract')->getContractItemByCache();
            $_tmp = array();$i = 0;
            foreach ($contract_list as $k => $v) {
                $_tmp[$i]['id'] = $v['cti_id'];
                $_tmp[$i]['name'] = $v['cti_name'];
                $i++;
            }
        }
        output_data(array('area_list'=>$area_list ? $area_list : array(),'contract_list'=>$_tmp));
    }

}