<?php defined('interMarket') or exit('Access Invalid!'); ?>
<!doctype html>
<html>
<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $output['html_title']; ?></title>
    <link href="/skins/default/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="/skins/default/css/my.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="/skins/default/css/index.css"/>
    <link rel="stylesheet" type="text/css" href="/skins/default/css/base.css"/>
    <link rel="stylesheet" type="text/css" href="/skins/default/css/midea.css"/>
    <link rel="stylesheet" type="text/css" href="/skins/default/css/tool.css"/>
    <link href="/skins/default/css/owl.carousel.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="/skins/default/css/lightbox.css"/>
    <link rel="stylesheet" type="text/css" href="/skins/default/css/top.css"/>

    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
    <title><?php echo $output['html_title']; ?></title>
    <meta name="keywords" content="<?php echo $output['seo_keywords']; ?>"/>
    <meta name="description" content="<?php echo $output['seo_description']; ?>"/>

    <style type="text/css">
        body {
            _behavior: url(<?php echo SHOP_TEMPLATES_URL;
?>/css/csshover.htc);
        }

        .nc-appbar-tabs a.compare {
            display: none !important;
        }
    </style>
<!--    <link href="--><?php //echo SHOP_TEMPLATES_URL; ?><!--/css/home_cart.css" rel="stylesheet" type="text/css">-->
<!---->
<!--    --><?php //if ($output['buy_step'] == 'step1') { ?>
<!--        <link rel="stylesheet" href="/skins/default/css/shopcar.css"/>-->
<!--    --><?php //} else if ($output['buy_step'] == 'step2') { ?>
<!--        <link rel="stylesheet" href="/skins/default/css/indent.css"/>-->
<!--    --><?php //} else if ($output['buy_step'] == 'step3') { ?>
<!--        <link rel="stylesheet" href="/skins/default/css/success.css"/>-->
<!--    --><?php //} ?>
<!--    <link href="/skins/default/css/all.css" rel="stylesheet" type="text/css">-->
    <link href="<?php echo RESOURCE_SITE_URL; ?>/js/perfect-scrollbar.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo SHOP_RESOURCE_SITE_URL; ?>/font/font-awesome/css/font-awesome.min.css" rel="stylesheet"/>
    <!--[if IE 7]>
    <link rel="stylesheet" href="<?php echo SHOP_RESOURCE_SITE_URL;?>/font/font-awesome/css/font-awesome-ie7.min.css">
    <![endif]-->
    <script>
        var SITEURL = "<?php echo SHOP_SITE_URL; ?>";

        var COOKIE_PRE = '<?php echo COOKIE_PRE;?>';
        var _CHARSET = '<?php echo strtolower(CHARSET);?>';
        var SITEURL = '<?php echo SHOP_SITE_URL;?>';
        var MEMBER_SITE_URL = '<?php echo MEMBER_SITE_URL;?>';
        var RESOURCE_SITE_URL = '<?php echo RESOURCE_SITE_URL;?>';
        var RESOURCE_SITE_URL = '<?php echo RESOURCE_SITE_URL;?>';
        var SHOP_TEMPLATES_URL = '<?php echo SHOP_TEMPLATES_URL;?>';
        var PRICE_FORMAT = '<?php echo $lang['currency'];?>%s';
        Number.prototype.toFixed = function (d) {
            var s = this + "";
            if (!d) d = 0;
            if (s.indexOf(".") == -1) s += ".";
            s += new Array(d + 1).join("0");
            if (new RegExp("^(-|\\+)?(\\d+(\\.\\d{0," + (d + 1) + "})?)\\d*$").test(s)) {
                var s = "0" + RegExp.$2, pm = RegExp.$1, a = RegExp.$3.length, b = true;
                if (a == d + 2) {
                    a = s.match(/\d/g);
                    if (parseInt(a[a.length - 1]) > 4) {
                        for (var i = a.length - 2; i >= 0; i--) {
                            a[i] = parseInt(a[i]) + 1;
                            if (a[i] == 10) {
                                a[i] = 0;
                                b = i != 1;
                            } else break;
                        }
                    }
                    s = a.join("").replace(new RegExp("(\\d+)(\\d{" + d + "})\\d$"), "$1.$2");
                }
                if (b) s = s.substr(1);
                return (pm + s).replace(/\.$/, "");
            }
            return this + "";
        };
    </script>
    <script src="<?php echo RESOURCE_SITE_URL; ?>/js/jquery.js"></script>
    <script src="<?php echo RESOURCE_SITE_URL; ?>/js/common.js"></script>
    <script src="<?php echo RESOURCE_SITE_URL; ?>/js/jquery-ui/jquery.ui.js"></script>
    <script src="<?php echo RESOURCE_SITE_URL; ?>/js/jquery.validation.min.js"></script>
    <script src="<?php echo RESOURCE_SITE_URL; ?>/js/jquery.poshytip.min.js"></script>
    <script type="text/javascript" src="<?php echo RESOURCE_SITE_URL; ?>/js/perfect-scrollbar.min.js"></script>
    <script type="text/javascript" src="<?php echo RESOURCE_SITE_URL; ?>/js/jquery.mousewheel.js"></script>
    <script type="text/javascript" src="<?php echo RESOURCE_SITE_URL; ?>/js/dialog/dialog.js" id="dialog_js"
            charset="utf-8"></script>

    <?php if ($output['buy_step'] == 'step1') { ?>
        <script type="text/javascript" src="/skins/default/js/shopcar.js"></script>
    <?php }else if ($output['buy_step'] == 'step2'){ ?>
        <script type="text/javascript" src="/skins/default/js/indent.js"></script>
    <?php }else if ($output['buy_step'] == 'step3'){ ?>
<!--        <script type="text/javascript" src="/skins/default/js/success.js"></script>-->
    <?php } ?>
    <script type="text/javascript" src="/skins/default/js/public.js"></script>


    <?php if ($_GET['model'] != 'buy_virtual') { ?>
        <script src="<?php echo SHOP_RESOURCE_SITE_URL; ?>/js/goods_cart.js"></script>
    <?php } else { ?>
        <script src="<?php echo SHOP_RESOURCE_SITE_URL; ?>/js/buy_virtual.js"></script>
    <?php } ?>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?php echo RESOURCE_SITE_URL;?>/js/html5shiv.js"></script>
    <script src="<?php echo RESOURCE_SITE_URL;?>/js/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="<?php echo RESOURCE_SITE_URL; ?>/js/member.js"></script>

</head>
<body>
<div id="append_parent"></div>
<!-- PublicTopLayout Begin -->
<?php require_once template('layout/layout_top');?>
<!-- PublicTopLayout End -->

<!-- PublicHeadLayout Begin -->
<?php require_once template('layout/layout_search');?>
<!-- PublicHeadLayout End -->

<!-- publicNavLayout Begin -->
<?php require_once template('layout/layout_nav');?>
<!-- publicNavLayout End -->




<?php require_once($tpl_file); ?>

<?php require_once template('layout/footer');?>
</body>
</html>
