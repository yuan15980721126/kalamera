<?php defined('interMarket') or exit('Access Invalid!'); ?>
<!doctype html>
<html lang="en">
<head>
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
    <meta property="fb:app_id" content="122770891679735">
    <?php if($output['store_ga']) { echo $output['store_ga']; } ?>

    <?php
    if ($output['og']['url'])
    {
        echo '<meta property="og:url" content="', $output['og']['url'], '">';
    }
    if ($output['og']['type'])
    {
        echo '<meta property="og:type" content="', $output['og']['type'], '">';
    }
    if ($output['og']['title'])
    {
        echo '<meta property="og:title" content="', $output['og']['title'], '">';
    }
    if ($output['og']['description'])
    {
        echo '<meta property="og:description" content="', $output['og']['description'], '">';
    }
    if ($output['og']['image'])
    {
        echo '<meta property="og:image" content="', $output['og']['image'], '">';
    }
    if ($output['meta_keywords'])
    {
        echo '<meta name="keywords" content="',$output['meta_keywords'],'">';
    }
    if ($output['meta_content'])
    {
        echo '<meta name="content" content="', $output['meta_content'], '">';
    }
    ?>
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

<script type="text/javascript">
var PRICE_FORMAT = '<?php echo $lang['currency'];?>%s';
$(function(){
	//首页左侧分类菜单
	$(".category ul.menu").find("li").each(
		function() {
			$(this).hover(
				function() {
				    var cat_id = $(this).attr("cat_id");
					var menu = $(this).find("div[cat_menu_id='"+cat_id+"']");
					menu.show();
					$(this).addClass("hover");					
					var menu_height = menu.height();
					if (menu_height < 60) menu.height(80);
					menu_height = menu.height();
					var li_top = $(this).position().top;
					$(menu).css("top",-li_top + 37);
				},
				function() {
					$(this).removeClass("hover");
				    var cat_id = $(this).attr("cat_id");
					$(this).find("div[cat_menu_id='"+cat_id+"']").hide();
				}
			);
		}
	);
	$(".head-user-menu dl").hover(function() {
		$(this).addClass("hover");
	},
	function() {
		$(this).removeClass("hover");
	});
	$('.head-user-menu .my-cart').mouseover(function(){// 运行加载购物车
		load_cart_information();
		$(this).unbind('mouseover');
	});
    <?php if (C('fullindexer.open')) { ?>
	// input ajax tips
	$('#keyword').focus(function(){
		if ($(this).val() == $(this).attr('title')) {
			$(this).val('').removeClass('tips');
		}
	}).blur(function(){
		if ($(this).val() == '' || $(this).val() == $(this).attr('title')) {
			$(this).addClass('tips').val($(this).attr('title'));
		}
	}).blur().autocomplete({
        source: function (request, response) {
            $.getJSON('<?php echo SHOP_SITE_URL;?>/index.php?model=search&fun=auto_complete', request, function (data, status, xhr) {
                $('#top_search_box > ul').unwrap();
                response(data);
                if (status == 'success') {
                 $('body > ul:last').wrap("<div id='top_search_box'></div>").css({'zIndex':'1000','width':'362px'});
                }
            });
       },
		select: function(ev,ui) {
			$('#keyword').val(ui.item.label);
			$('#top_search_form').submit();
		}
	});
	<?php } ?>

	//$('#ser_btn').click(function(){
	//    if ($('#keyword').val() == '') {
	//	    if ($('#keyword').attr('data-value') == '') {
	//		    return false
	//		} else {
	//			window.location.href="<?php //echo SHOP_SITE_URL?>///index.php?model=search&fun=index&keyword="+$('#keyword').attr('data-value');
	//		    return false;
	//		}
	//    }
	//});
	$(".head-search-bar").hover(null,
	function() {
		$('#search-tip').hide();
	});

	$('#search-his-del').on('click',function(){$.cookie('<?php echo C('cookie_pre')?>his_sh',null,{path:'/'});$('#search-his-list').empty();});
});
</script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-144565806-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-144565806-1');
    </script>
</head>
<body>
<div id="append_parent"></div><!-- showDialog.js需要的节点 不能删除 -->
<!-- PublicTopLayout Begin -->
<?php require_once template('layout/layout_top');?>
<!-- PublicTopLayout End -->

<!-- PublicHeadLayout Begin -->
<?php require_once template('layout/layout_search');?>
<!-- PublicHeadLayout End -->

<!-- publicNavLayout Begin -->
<?php require_once template('layout/layout_nav');?>
<!-- publicNavLayout End -->
