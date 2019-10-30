<?php defined('interMarket') or exit('Access Invalid!'); ?>
<?php if ($_GET['model'] != 'pointcart') { ?>
    <!--PC导航-->
    <div class="nav black_bg hidden-xs hidden-sm">
        <div class="container">
            <div class="row">
                <ul class="first_nav">
                    <li>
                        <a href="<?php echo BASE_SITE_URL; ?>/index.php" <?php if ($output['index_sign'] == 'index' && $output['index_sign'] != '0') {
                            echo 'class="current alis"';
                        } else {
                            echo 'class="alis"';
                        } ?>>
                            HOME
                        </a>
                    </li>
                    <?php if (!empty($output['nav_list']) && is_array($output['nav_list'])) { ?>
                        <?php foreach ($output['nav_list'] as $key => $nav) { ?>
                            <?php if ($nav['nav_location'] == '1') { ?>
                                <li>
                                    <a <?php
                                    if ($nav['nav_new_open']) {
                                        echo ' target="_blank"';
                                    }
                                    ?> href="<?php echo $nav['nav_url']; ?>"><?php echo $nav['nav_title']; ?> </a>
                                    <?php if ($key == 0) { ?>
                                        <div class="second_nav">
                                            <div>
                                                <?php require template('layout/home_goods_class'); ?> <!--PC商品导航和手机端导航分开-->
                                            </div>
                                        </div>
                                    <?php } ?>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <!--PC导航结束-->
    <!--移动端-->
    <div id="yd" class="clearfix hidden-md hidden-lg" style="position: relative;background:#000;">
        <div id="yd_logo" class="fl">
            <a href="<?php echo SHOP_SITE_URL; ?>">
                <img src="<?php echo UPLOAD_SITE_URL . DS . ATTACH_COMMON . DS . $output['setting_config']['site_logo']; ?>"/>
            </a>
        </div>
        <div class="cli_nav fr">
        </div>

        <div id="nav_list">
            <div class="tel_nav">
                <a href="<?php echo BASE_SITE_URL; ?>/index.php" <?php if ($output['index_sign'] == 'index' && $output['index_sign'] != '0') {
                    echo 'class="current alis"';
                } else {
                    echo 'class="alis"';
                } ?>>
                    HOME
                </a>
            </div>
            <?php if (!empty($output['nav_list']) && is_array($output['nav_list'])) { ?>
                <?php foreach ($output['nav_list'] as $key => $nav) { ?>
                    <?php if ($nav['nav_location'] == '1') { ?>
                        <div class="tel_nav">
                            <a <?php
                            if ($nav['nav_new_open']) {
                                echo ' target="_blank"';
                            }
                            ?> href="<?php echo $nav['nav_url']; ?>"><?php echo $nav['nav_title']; ?> </a>
                            <?php if ($key == 0) { ?>
                                <div class="tel_probox">
                                    <div class="tel_allpro nav_amiddle">
                                        <?php require template('layout/mobile_goods_class'); ?> <!--PC商品导航和手机端导航分开-->
                                    </div>
                                </div>

                            <?php } ?>
                        </div>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
    <!--移动端结束-->
    </header>

<?php } ?>
<!--回到顶部-->
<div class="top toTop" style="color: #000">
    <a href="javascript:void(0);"></a>
</div>

