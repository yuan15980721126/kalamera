<?php
/**
 * 合作伙伴管理
 *
 *
 *
 *
 * @好商城提供技术支持 授权请购买shopnc授权
 * @license    http://www.33hao.com
 * @link       交流群号：138182377
 */



defined('interMarket') or exit('Access Invalid!');
class mb_feedbackControl extends SystemControl{
    public function __construct(){
        parent::__construct();
        Language::read('mobile');
    }

    public function indexOp() {
        $this->flistOp();
    }
    /**
     * 意见反馈
     */
    public function flistOp(){
        $model_mb_feedback = Model('mb_feedback');
        $list = $model_mb_feedback->getMbFeedbackList(array(), 10);

        Tpl::output('list', $list);
        Tpl::output('page', $model_mb_feedback->showpage());
        Tpl::setDirquna('system');
        Tpl::showpage('mb_feedback.index');
    }

    /**
     * 输出XML数据
     */
    public function get_xmlOp() {
        $model_mb_feedback = Model('mb_feedback');
        Language::read('member_store_consult_index');
        $lang   = Language::getLangContent();
        $condition = array();
        if ($_POST['query'] != '') {
            $condition[$_POST['qtype']] = array('like', '%' . $_POST['query'] . '%');
        }
        $order = '';
        $param = array('id', 'content', 'title', 'ftime', 'member_name', 'member_id','true_name','email','phone');
        if (in_array($_POST['sortname'], $param) && in_array($_POST['sortorder'], array('asc', 'desc'))) {
            $order = $_POST['sortname'] . ' ' . $_POST['sortorder'];
        }
        $page = $_POST['rp'];
        $inform_list = $model_mb_feedback->getMbFeedbackList($condition, $page, $order);

        $data = array();
        $data['now_page'] = $model_mb_feedback->shownowpage();
        $data['total_num'] = $model_mb_feedback->gettotalnum();
        foreach ($inform_list as $value) {
            $param = array();
            $param['operation'] = "<a class='btn red' href=\"javascript:void(0);\" onclick=\"fg_del('".$value['id']."')\"><i class='fa fa-trash-o'></i>删除</a>";
            $param['operation'] .= "<a class='btn green' href='index.php?model=mb_feedback&fun=reply_info&id=".$value['id']."'><i class='fa fa-list-alt'></i>查看</a>";
            //$param['id'] = $value['id'];
            switch ($value['feedback_type']) {
                case '1':
                    $feedback_type = '游客留言';
                    break;
                case '2':
                    $feedback_type = '用户咨询';
                    break;
                case '3':
                    $feedback_type = '订阅';
                    break;
                default:
                    $feedback_type = '类型出错';
                    break;
            }
            $param['feedback_type'] = $feedback_type;
            //$param['title'] = $value['title'];
            $param['content'] = $value['content'];
            $param['ftime'] = date('Y-m-d H:i:s', $value['ftime']);
            $param['true_name'] = $value['true_name'];
            $param['email'] = $value['email'] ? $value['email'] : '';
            $param['mobile'] = $value['mobile'] ? $value['mobile'] : '';
            $param['member_name'] = $value['member_name'];
            //$param['member_id'] = $value['member_id'];
            $param['feedback_reply'] = $value['feedback_reply'];
            $param['feedback_reply_time'] = $value['feedback_reply_time'] ? date('Y-m-d H:i:s', $value['feedback_reply_time']) : '';
            if($value['feedback_type'] == 3){
                $param['consult'] = "<a class='btn red' href='javascript:void(0);' onclick=\"fg_edit('" . $value['id'] . "')\"><i class='fa fa-reply-all'></i>回复</a>";
            }else{
                if($value['feedback_reply'] == ''){
                    $param['consult'] = "<a class='btn red' href='javascript:void(0);' onclick=\"fg_edit('" . $value['id'] . "')\"><i class='fa fa-reply-all'></i>回复</a>";
                }else{
                    $param['consult'] = "<a class='btn blue' href='javascript:void(0);' onclick=\"fg_edit('" . $value['id'] . "')\"><i class='fa fa-pencil-square-o'></i>编辑</a>";
                }
            }

            $data['list'][$value['id']] = $param;
        }
        echo Tpl::flexigridXML($data);exit();
    }

    /**
     * 删除
     */
    public function delOp(){
        $ids = explode(',', $_GET['id']);
        if (count($ids) == 0){
            exit(json_encode(array('state'=>false,'msg'=>L('wrong_argument'))));
        }
        $model_mb_feedback = Model('mb_feedback');
        $result = $model_mb_feedback->delMbFeedback($ids);
        if ($result){
            exit(json_encode(array('state'=>true,'msg'=>'删除成功')));
        }else {
            exit(json_encode(array('state'=>false,'msg'=>'删除失败')));
        }
    }

    /**
     * 编辑回复
     */
    public function reply_editOp() {
        if (chksubmit()) {
            $id = intval($_POST['id']);
            if ($id <= 0) {
                showDialog(L('nc_common_op_fail'), 'reload');
            }
            $update = array();
            $update['feedback_reply'] = trim($_POST['feedback_reply']);
            $where = array();
            $where['id'] = $id;
            Model('mb_feedback')->editMbFeedback($where,$update);
            $common_info = Model('mb_feedback')->getMbFeedbackInfo(['id'=>$_POST['id']]);
            if($common_info['feedback_type'] == 1 || $common_info['feedback_type'] == 3){
                if($common_info['email'] == ''){
                    showDialog('该游客邮件格式错误','reload');
                }
                emailSend($common_info['email'] ,$_POST['feedback_reply'],'有机商城回复信息','json');
            }
            showDialog(L('nc_common_op_succ'), '', 'succ', '$("#flexigrid").flexReload();CUR_DIALOG.close()');
        }
        $common_info = Model('mb_feedback')->getMbFeedbackInfo(['id'=>$_GET['id']]);
        //print_R($common_info);
        Tpl::output('common_info', $common_info);

        Tpl::setDirquna('system');
        Tpl::showpage('message.close_reply', 'null_layout');
    }

    /**
     * 会员修改
     */
    public function reply_infoOp(){
        Language::read('feedback');
        $lang   = Language::getLangContent();
        $id = intval($_GET['id']);
        if ($id <= 0) {
            showDialog(L('nc_common_op_fail'), 'reload');
        }
        $model_member = Model('member');
        $common_info = Model('mb_feedback')->getMbFeedbackInfo(['id'=>$_GET['id']]);
        $common_info['ftime'] = $common_info['ftime'] ? date('Y-m-d H:i:s', $common_info['ftime']) : '';
        $common_info['feedback_reply_time'] = $common_info['feedback_reply_time'] ? date('Y-m-d H:i:s', $common_info['ftime']) : '';
        //print_R($common_info);
        Tpl::output('common_info', $common_info);

        Tpl::setDirquna('system');
        Tpl::showpage('message.info');
    }
}
