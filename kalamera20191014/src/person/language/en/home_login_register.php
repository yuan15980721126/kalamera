<?php
defined('interMarket') or exit('Access Invalid!');
/**
 *  登录-公共语言
 */

/**
 * 登录-注册
 */
$lang['login_register_input_username'] = "username cannot be empty ";
$lang['login_register_username_range'] = "username must be between 6-20 characters ";
$lang['login_register_username_lettersonly']= "can contain_". ", "-", cannot be pure number ";
$lang['login_register_username_exists'] = "this username already exists ";
$lang['login_register_input_password'] = "password cannot be empty ";
$lang['login_register_password_range'] = "password length should be between 6-20 characters ";
$lang['login_register_input_password_again']= "you must confirm your password again ";
$lang['login_register_password_not_same'] = "two different passwords ";
$lang['login_register_input_email'] = "E-mail cannot be empty ";
$lang['login_register_invalid_email'] = "this is not a valid E-mail address ";
$lang['login_register_email_exists'] = "this E-mail exists ";
$lang['login_register_input_text_in_image'] = "please enter verification code ";
$lang['login_register_code_wrong'] = "verification code incorrect ";
$lang['login_register_must_agree'] = "please check service protocol ";
$lang['login_register_join_us'] = "user registration ";
$lang['login_register_input_info'] = "fill in the user registration information";
$lang['login_register_username'] = "username ";
$lang['login_register_username_to_login'] = "please use 6-20 Chinese, English, Numbers and" - "symbol ";
$lang['login_register_pwd'] = "set password ";
$lang['login_register_password_to_login'] = "your login password ";
$lang['login_register_password_to_login'] = "6-20 upper and lower case letters, symbols or Numbers ";
$lang['login_register_ensure_password'] = "confirm password ";
$lang['login_register_input_password_again']= "please enter password again ";
$lang['login_register_email'] = "mailbox ";
$lang['login_register_input_valid_email'] = "enter a common mailbox to verify and retrieve password ";
$lang['login_register_code'] = "verification code ";
$lang['login_register_click_to_change_code']= "change one ";
$lang['login_register_input_code'] = "input verification code ";
$lang['login_register_agreed'] = "to read and agree ";
$lang['login_register_agreement'] = "service agreement ";
$lang['login_register_regist_now'] = "register now ";
$lang['login_register_enter_now'] = "confirm submit ";
$lang['login_register_connect_now'] = "bind account ";
$lang['login_register_after_regist'] = "after registration you can ";
$lang['login_register_buy_info'] = "buy goods pay order ";
$lang['login_register_collect_info'] = "store ";
$lang['login_register_honest_info'] = "secure transaction integrity, secure";
$lang['login_register_talk_info'] = "member level enjoys privileges ";
$lang['login_register_openstore_info'] = "get shopping ";
$lang['login_register_sns_info'] = "comment share off site ";


$lang['login_register_already_have_account']= "if you are a user of the website ";
$lang['login_register_login_now_1'] = "I have already registered, now";
$lang['login_register_login_now_2'] = "login ";
$lang['login_register_login_now_3'] = "or ";
$lang['login_register_login_forget'] = "retrieve password?";
/**
 * 登录-用户保存
 */
$lang['login_usersave_login_usersave_username_isnull'] = "username cannot be null ";
$lang['login_usersave_password_isnull'] = "password cannot be empty ";
$lang['login_usersave_password_not_the_same'] = "password not the same as confirm password, please re-enter ";
$lang['login_usersave_wrong_format_email'] = "email format is incorrect, please fill in again ";
$lang['login_usersave_code_isnull'] = "verification code can't be empty";
$lang['login_usersave_wrong_code'] = "verification code error ";
$lang['login_usersave_you_must_agree'] = "you must agree to terms of service to register ";
$lang['login_usersave_your_username_exists'] = "the username you filled already exists, please select another username ";
$lang['login_usersave_your_email_exists'] = "the mailbox you filled already exists, please select other mailbox ";
$lang['login_usersave_regist_success'] = "registration";
$lang['login_usersave_regist_success_ajax'] = 'welcome to site_name';
$lang['login_usersave_regist_fail'] = "registration failed ";
/**
 * 密码找回
 */
$lang['login_index_find_password'] = 'forgot password';
$lang['login_password_you_account'] = 'login account';
$lang['login_password_you_email'] = 'email';
$lang['login_password_change_code'] = 'cant see, change one ';
$lang['login_password_submit'] = 'submit retrieve ';
$lang['login_password_input_email'] = 'email cannot be empty ';
$lang['login_password_wrong_email'] = 'wrong email';
/**
 * 找回处理
 */
$lang['login_password_enter_find'] = 'About to enter the password recovery page';
$lang['login_password_input_username'] = 'please enter your login name';
$lang['login_password_username_not_exists'] = 'login name does not exist ';
$lang['login_password_input_email'] = 'Please enter your mailbox address ';
$lang['login_password_email_not_exists'] = 'mailbox address error ';
$lang['login_password_email_fail'] = 'email timeout, please reapply ';
$lang['login_password_email_success'] = 'mail has been sent, please check ';
?>