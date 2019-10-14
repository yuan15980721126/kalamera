<?php
/**
 * 意见反馈
 *
 *

 */

defined('interMarket') or exit('Access Invalid!');

class mb_feedbackModel extends Model{
    public function __construct(){
        parent::__construct('mb_feedback');
    }

    /**
     * 列表
     *
     * @param array $condition 查询条件
     * @param int $page 分页数
     * @param string $order 排序
     * @return array
     */
    public function getMbFeedbackList($condition, $page = null, $order = 'id desc'){
        $list = $this->where($condition)->page($page)->order($order)->select();
        return $list;
    }

    /**
     * 新增
     *
     * @param array $param 参数内容
     * @return bool 布尔类型的返回结果
     */
    public function addMbFeedback($param){
        return $this->insert($param);
    }

    /**
     * 删除
     *
     * @param int $id 记录ID
     * @return bool 布尔类型的返回结果
     */
    public function delMbFeedback($id){
        $condition = array('id' => array('in', $id));
        return $this->where($condition)->delete();
    }

    /**
     * 取得留言反馈详细信息
     * @param int $goods_commonid
     * @return array
     */
    public function getMbFeedbackInfo($condition) {
        return $this->where($condition)->find();
    }
    /**
     * 取得留言数量信息
     *
     * @param array $condition
     * @param string $field
     * @return int
     */
    public function getMbFeedbackCount($condition) {
        return $this->where($condition)->count();
    }

    /**
     * 回复留言反馈
     *
     * @param unknown_type $input
     */
    public function editMbFeedback($condition, $update){
        $update['feedback_reply_time'] = TIMESTAMP;
        return $this->where($condition)->update($update);
    }
}
