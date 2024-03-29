<?php
/**
 * 微商城推荐商品模型
 *
 *
 *
 
 
 
 
 */
defined('interMarket') or exit('Access Invalid!');
class micro_goodsModel extends Model{

    const TABLE_NAME = 'micro_goods';
    const PK = 'commend_id';

    public function __construct(){
        parent::__construct('micro_goods');
    }

    /**
     * 读取推荐商品列表
     *
     */
    public function getList($condition,$page=null,$order='',$field='*',$limit=''){
        $result = $this->table(self::TABLE_NAME)->field($field)->where($condition)->page($page)->order($order)->limit($limit)->select();
        return $result;
    }

    /**
     * 读取推荐商品列表和用户信息
     *
     */
    public function getListWithUserInfo($condition,$page=null,$order='',$field='*',$limit=''){
        $on = 'micro_goods.commend_member_id = member.member_id';
        $result = $this->table('micro_goods,member')->field($field)->join('left')->on($on)->where($condition)->page($page)->order($order)->limit($limit)->select();
        return $result;
    }


    /**
     * 根据编号获取单个内容
     *
     */
    public function getOne($param){
        $result = $this->table(self::TABLE_NAME)->where($param)->find();
        return $result;
    }

    /**
     * 根据编号获取单个内容
     *
     */
    public function getOneWithUserInfo($param){
        $on = 'micro_goods.commend_member_id = member.member_id';
        $result = $this->table('micro_goods,member')->join('left')->on($on)->where($param)->find();
        return $result;
    }

    /*
     *  判断是否存在
     *  @param array $condition
     *
     */
    public function isExist($param) {
        $result = $this->getOne($param);
        if(empty($result)) {
            return FALSE;
        }
        else {
            return TRUE;
        }
    }

    /*
     * 增加
     * @param array $param
     * @return bool
     */
    public function save($param){
        return $this->table(self::TABLE_NAME)->insert($param);
    }

    /*
     * 更新
     * @param array $update_array
     * @param array $where_array
     * @return bool
     */
    public function modify($update_array, $where_array){
        return $this->table(self::TABLE_NAME)->where($where_array)->update($update_array);
    }

    /*
     * 删除
     * @param array $param
     * @return bool
     */
    public function drop($param){
        return $this->table(self::TABLE_NAME)->where($param)->delete();
    }

}
