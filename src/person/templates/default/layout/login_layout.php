<?php defined('interMarket') or exit('Access Invalid!');?>
<!doctype html>
<html lang="en">
<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $output['html_title'];?></title>
    <link href="/skins/default/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="/skins/default/css/my.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="/skins/default/css/index.css"/>
    <link rel="stylesheet" type="text/css" href="/skins/default/css/base.css"/>
    <link rel="stylesheet" type="text/css" href="/skins/default/css/midea.css"/>
    <link rel="stylesheet" type="text/css" href="/skins/default/css/tool.css"/>
    <link href="/skins/default/css/owl.carousel.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="/skins/default/css/lightbox.css"/>
    <link rel="stylesheet" type="text/css" href="/skins/default/css/top.css"/>
    <!--    <link rel="stylesheet" type="text/css" href="--><?php //echo SHOP_RESOURCE_SITE_URL;?><!--/js/dialog/dialog.css" />-->




    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;?>">
    <title><?php echo $output['html_title'];?></title>
    <meta name="keywords" content="<?php echo $output['seo_keywords']; ?>" />
    <meta name="description" content="<?php echo $output['seo_description']; ?>" />
    <script type="text/javascript">
        var SITEURL = '<?php echo SHOP_SITE_URL;?>';
        var SHOP_SITE_URL = '<?php echo SHOP_SITE_URL;?>';
        var LOGIN_SITE_URL = '<?php echo LOGIN_SITE_URL;?>';
        var MEMBER_SITE_URL = '<?php echo MEMBER_SITE_URL;?>';
        var RESOURCE_SITE_URL = '<?php echo RESOURCE_SITE_URL;?>';

        //登录开关状态
        var connect_qq = "<?php echo C('qq_isuse');?>";
        var connect_sn = "<?php echo C('sina_isuse');?>";
        var connect_wx = "<?php echo C('weixin_isuse');?>";
    </script>

    <!--    <script type="text/javascript" src="--><?php //echo RESOURCE_SITE_URL;?><!--/js/jquery-1.12.2.js"></script>-->
    <script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.js"></script>
    <script src="<?php echo RESOURCE_SITE_URL;?>/js/common.js" charset="utf-8"></script>
    <script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
    <script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.validation.min.js"></script>
    <script src="<?php echo RESOURCE_SITE_URL;?>/js/dialog/dialog.js" id="dialog_js" charset="utf-8"></script>
    <script type="text/javascript" src="/skins/default/js/jquery.cookie.js"></script>
    <script type="text/javascript"  src="/skins/default/js/public.js"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-144565806-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-144565806-1');
    </script>
</head>
<body>
<?php require_once template('layout/layout_top');?>
<?php require_once template('layout/layout_search');?>
<?php require_once template('layout/layout_nav');?>
<div id="append_parent"></div>

<div id="ajaxwaitid"></div>
<?php require_once($tpl_file);?>
<?php require_once template('layout/footer');?>
</body>
</html>
