<?php
defined('interMarket') or exit('Access Invalid!');

/**
 * core简体语言包
 */
$lang['please_check_your_url_arg'] = 'Please check the parameter information entered in your URL address bar!! Error code:';

$lang['error_info'] = 'System information';
$lang['error_notice_operate'] = 'The system is abnormal, and we apologize for the inconvenience brought to you. Please contact the customer service for help';
$lang['company_name'] = '';

//$lang['order_state_cancel'] = '已取消';
//$lang['order_state_new'] = '待付款';
//$lang['order_state_pay'] = 'To be shipped';
//$lang['order_state_send'] = '待收货';
//$lang['order_state_success'] = '交易完成';
//$lang['order_state_eval'] = '已评价';

$lang['please_check_your_system_chmod'] = 'system configuration information cache file cannot be written. Please check if file and folder permissions are correct!';
$lang['please_check_your_system_chmod_area'] = 'locale cache file cannot be written. Please check if file and folder permissions are correct!';
$lang['please_check_your_cache_type'] = 'this method does not exist. Please check if the cache category is correct!';
$lang['please_check_your_system_chmod_goods'] = 'goods category cache file cannot be written. Please check if file and folder permissions are correct!';
$lang['please_check_your_system_chmod_ad'] = 'advertisement information cache file cannot be written. Please check if file and folder permissions are correct!';
$lang['please_check_your_system_chmod_adv'] = 'advertisement space information cache file cannot be written. Please check if file and folder permissions are correct!';
$lang['please_check_your_system_chmod_goods_class'] = 'please check if file and folder permissions are correct!';

$lang['first_page'] = 'First';
$lang['last_page'] = 'Last';
$lang['pre_page'] = 'Prev';
$lang['next_page'] = 'Next';

$lang['cant_find_temporary_files'] = 'Cannot find temporary file, please confirm whether temporary folder exists writable';
$lang['upload_file_size_none'] = 'Do not upload empty files';
$lang['upload_file_size_cant_over'] = 'Upload file size cannot exceed';
$lang['upload_file_fail'] = 'File upload failed: no copy permission';
$lang['upload_file_size_over'] = 'File size exceeded system Settings';
$lang['upload_file_is_not_complete'] = 'The file is only partially uploaded';
$lang['upload_file_is_not_uploaded'] = 'No files were uploaded';
$lang['upload_dir_chmod'] = 'Cannot find temporary folder';
$lang['upload_file_write_fail'] = 'File write failed';
$lang['upload_file_mkdir'] = 'create directory (';
$lang['upload_file_mkdir_fail'] = ') be defeated';
$lang['upload_file_dir'] = 'Directory('; //目录
$lang['upload_file_dir_cant_touch_file'] = ') cannot create file, please modify permissions before uploading';//目录不能创建文件，请修改权限后再进行上传

$lang['upload_image_px'] = 'px';//像素
$lang['image_allow_ext_is'] = 'This type of file is not allowed to upload. The allowed file type is:';
$lang['upload_image_is_not_image'] = 'Illegal image file';
$lang['upload_image_mime_error'] = 'Image file type invalid';
$lang['upload_file_attack'] = 'Illegal file upload';

$lang['transport_type_py']	= 'snail mail';
$lang['transport_type_kd']	= 'express';