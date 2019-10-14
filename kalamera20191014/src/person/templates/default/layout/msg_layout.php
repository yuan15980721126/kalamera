<?php defined('interMarket') or exit('Access Invalid!');?>
<!doctype html>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;?>">
    <title><?php echo $output['html_title'];?></title>
    <meta name="keywords" content="<?php echo $output['seo_keywords']; ?>" />
    <meta name="description" content="<?php echo $output['seo_description']; ?>" />
    <?php echo html_entity_decode($output['setting_config']['qq_appcode'],ENT_QUOTES); ?><?php echo html_entity_decode($output['setting_config']['sina_appcode'],ENT_QUOTES); ?><?php echo html_entity_decode($output['setting_config']['share_qqzone_appcode'],ENT_QUOTES); ?><?php echo html_entity_decode($output['setting_config']['share_sinaweibo_appcode'],ENT_QUOTES); ?>
    <style type="text/css">
        body { _behavior: url(<?php echo LOGIN_TEMPLATES_URL;
?>/css/csshover.htc);
        }
        #error_tip{

            /*position: absolute;*/
            top: 40px;
            color:red;

        }
    </style>
    <link href="/skins/default/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="/skins/default/css/my.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="/skins/default/css/index.css"/>
    <link rel="stylesheet" type="text/css" href="/skins/default/css/base.css"/>
    <link rel="stylesheet" type="text/css" href="/skins/default/css/midea.css"/>
    <link rel="stylesheet" type="text/css" href="/skins/default/css/tool.css"/>
    <link href="/skins/default/css/owl.carousel.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="/skins/default/css/lightbox.css"/>
    <link rel="stylesheet" type="text/css" href="/skins/default/css/top.css"/>





    <!--<link href="/skins/default/css/base.css" rel="stylesheet" type="text/css">-->
    <!--<link href="--><?php //echo LOGIN_TEMPLATES_URL;?><!--/css/home_header.css" rel="stylesheet" type="text/css">-->
    <!--<link href="--><?php //echo LOGIN_TEMPLATES_URL;?><!--/css/home_login.css" rel="stylesheet" type="text/css">-->


    <?php if ($_GET['fun'] == 'register') {?>
        <!--<link href="/skins/default/css/PlanEnroll.css" rel="stylesheet" type="text/css">-->
    <?php }else{?>
        <!--<link href="/skins/default/css/login.css" rel="stylesheet" type="text/css">-->
    <?php }?>
    <!--<link href="--><?php //echo LOGIN_RESOURCE_SITE_URL;?><!--/font/font-awesome/css/font-awesome.min.css" rel="stylesheet" />-->
    <!--[if IE 7]>
    <link rel="stylesheet" href="<?php echo LOGIN_RESOURCE_SITE_URL;?>/font/font-awesome/css/font-awesome-ie7.min.css">
    <![endif]-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?php echo RESOURCE_SITE_URL_HTTPS;?>/js/html5shiv.js"></script>
    <script src="<?php echo RESOURCE_SITE_URL_HTTPS;?>/js/respond.min.js"></script>
    <![endif]-->
    <script>
        var COOKIE_PRE = '<?php echo COOKIE_PRE;?>';var _CHARSET = '<?php echo strtolower(CHARSET);?>';var SITEURL = '<?php echo SHOP_SITE_URL;?>';var SHOP_SITE_URL = '<?php echo SHOP_SITE_URL;?>';var RESOURCE_SITE_URL = '<?php echo RESOURCE_SITE_URL;?>';var RESOURCE_SITE_URL = '<?php echo RESOURCE_SITE_URL;?>';var SHOP_TEMPLATES_URL = '<?php echo SHOP_TEMPLATES_URL;?>';
    </script>
    <script src="<?php echo RESOURCE_SITE_URL_HTTPS;?>/js/jquery.js"></script>
    <script src="<?php echo RESOURCE_SITE_URL_HTTPS;?>/js/jquery-ui/jquery.ui.js"></script>
    <script src="<?php echo RESOURCE_SITE_URL_HTTPS;?>/js/common.js"></script>
    <script src="<?php echo RESOURCE_SITE_URL_HTTPS;?>/js/jquery.validation.min.js"></script>
    <script src="<?php echo RESOURCE_SITE_URL_HTTPS;?>/js/dialog/dialog.js" id="dialog_js"></script>
    <script src="<?php echo LOGIN_RESOURCE_SITE_URL?>/js/taglibs.js"></script>
    <script src="<?php echo LOGIN_RESOURCE_SITE_URL?>/js/tabulous.js"></script>

    <script src="/skins/default/js/login.js"></script>
<style type="text/css">
body, .header-wrap { background-color: #FAFAFA;}
.wrapper { width: 1200px;}
#faq { display: none;}
.msg { font: 100 36px/48px arial,"microsoft yahei"; color: #555; background-color: #FFF; text-align: center; width: 100%; border: solid 1px #E6E6E6; margin-bottom: 10px; padding: 120px 0;}
.msg i { font-size: 48px; vertical-align: middle; margin-right: 10px;}
</style>
<script>var COOKIE_PRE = '<?php echo COOKIE_PRE;?>';var _CHARSET = '<?php echo strtolower(CHARSET);?>';var SITEURL = '<?php echo MEMBER_SITE_URL;?>';var MEMBER_RESOURCE_SITE_URL = '<?php echo MEMBER_RESOURCE_SITE_URL;?>';var RESOURCE_SITE_URL = '<?php echo RESOURCE_SITE_URL;?>';var MEMBER_TEMPLATES_URL = '<?php echo MEMBER_TEMPLATES_URL;?>';</script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/common.js"></script>
<script type="text/javascript">
$(function(){
	$("#details").children('ul').children('li').click(function(){
		$(this).parent().children('li').removeClass("current");
		$(this).addClass("current");
		$('#search_act').attr("value",$(this).attr("act"));
	});
	var search_act = $("#details").find("li[class='current']").attr("act");
	$('#search_act').attr("value",search_act);
	$("#keyword").blur();
});
</script>
</head>
<body>
<?php require_once template('layout/layout_top');?>
<?php require_once template('layout/layout_search');?>
<?php require_once template('layout/layout_nav');?>

<div class="msg">
      <?php if($output['msg_type'] == 'error'){ ?>
      <i class="icon-info-sign" style="color: #39C;"></i>
        <?php }else { ?>
      <i class="icon-ok-sign" style=" color: #099;"></i>
        <?php } ?>
        <?php require_once($tpl_file);?>
</div>
<script type="text/javascript">
<?php if (!empty($output['url'])){
?>
window.setTimeout("javascript:location.href='<?php echo $output['url'];?>'", <?php echo $time;?>);
<?php
}else{
?>
window.setTimeout("javascript:history.back()", <?php echo $time;?>);
<?php
}?>
</script>
<?php
require_once template('layout/footer');
?>

