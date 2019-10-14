<?php defined('interMarket') or exit('Access Invalid!'); ?>
<?php include template('layout/common_layout'); ?>
<link href="<?php echo SHOP_TEMPLATES_URL; ?>/css/member.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL; ?>/js/member.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL; ?>/js/ToolTip.js"></script>
<script>
    //sidebar-menu
    $(document).ready(function () {
        $.each($(".side-menu > a"), function () {
            $(this).click(function () {
                var ulNode = $(this).next("ul");
                if (ulNode.css('display') == 'block') {
                    $.cookie(COOKIE_PRE + 'Mmenu_' + $(this).attr('key'), 1);
                } else {
                    $.cookie(COOKIE_PRE + 'Mmenu_' + $(this).attr('key'), null);
                }
                ulNode.slideToggle();
                if ($(this).hasClass('shrink')) {
                    $(this).removeClass('shrink');
                } else {
                    $(this).addClass('shrink');
                }
            });
        });
        $.each($(".side-menu-quick > a"), function () {
            $(this).click(function () {
                var ulNode = $(this).next("ul");
                ulNode.slideToggle();
                if ($(this).hasClass('shrink')) {
                    $(this).removeClass('shrink');
                } else {
                    $(this).addClass('shrink');
                }
            });
        });
    });

</script>

<?php include template('layout/cur_local');?>
<!--当前位置结束-->
<div class="container padding_15-0">
    <div class="col-md-3">
        <ul class="bar_list">
            <li>
                <div class="portrait_b">
                    <div class="img_ inline_b"><img src="/skins/default/img/portrait.png" alt=""></div>
                    <span class="inline_b"><?php echo preg_replace('/(\d{3})\d{4}(\d{4})/', "$1****$2", $output['member_info']['member_name']);?></span>
                </div>
                <ul class="center_list">
                    <?php if (!empty($output['menu_list'])) { ?>
                        <?php foreach ($output['menu_list'] as $key => $value) { ?>
                            <li class="">
                                <a href="<?php echo $value['url']; ?>">

                                    <?php echo $value['name']; ?>
                                </a>
                                    <?php if (!empty($value['child'])) { ?>
                                        <ul class="m_body" <?php if (cookie('Mmenu_' . $key) == 1) echo 'style="display:none"'; ?>>
                                            <?php foreach ($value['child'] as $key => $val) { ?>
                                                <li <?php if ($key == $output['model']) { ?>class="selected"<?php } ?>>
                                                    <a href="<?php echo $val['url']; ?>"><?php echo $val['name']; ?></a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    <?php } ?>
                            </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </li>
        </ul>
    </div>
    <div class="col-md-9">
        <?php require_once($tpl_file); ?>

    </div>
</div>

<?php require_once template('layout/footer'); ?>



</body>
</html>