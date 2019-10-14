<?php
/**
 * 微信管理
 *
 *
 *
 
 
 
 
 */
defined('interMarket') or exit('Access Invalid!');
class wxconfigModel extends Model{
    public function __construct() {
        parent::__construct('wechat_config');
    }
}