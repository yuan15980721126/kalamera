<?php defined('interMarket') or exit('Access Invalid!'); ?>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL; ?>/js/jquery.nyroModal/custom.min.js"
        charset="utf-8"></script>
<link href="<?php echo RESOURCE_SITE_URL; ?>/js/jquery.nyroModal/styles/nyroModal.css" rel="stylesheet" type="text/css"
      id="cssfile2"/>
<script src="<?php echo RESOURCE_SITE_URL; ?>/js/jquery.ajaxContent.pack.js" type="text/javascript"></script>
<?php if (!empty($output['goodsevallist']) && is_array($output['goodsevallist'])) { ?>
    <div class="pdditem">
        <div class="cmtsb">
            <div class="plq">
                <?php foreach ($output['goodsevallist'] as $k => $v) { ?>
                    <div class="han">
                        <div class="pl_peo">
                            <div class="img_box"><img
                                        src="<?php echo getMemberAvatarForID($v['geval_frommemberid']); ?>"/></div>
                            <div class="peo_xx">
                    <span class="name_">
                        <?php if ($v['geval_isanonymous'] == 1) { ?>
                            <?php echo str_cut($v['geval_frommembername'], 2) . '***'; ?>
                        <?php } else { ?>
                            <?php echo $v['geval_frommembername']; ?>
                        <?php } ?>
                    </span>
                                <div class="level">
                                    <?php for ($i = 1; $i <= $v['geval_scores']; $i++) { ?>
                                        <span class="on"></span>
                                    <?php } ?>
                                </div>
                                <span class="time_"><?php echo @date('Y-m-d', $v['geval_addtime']); ?></span>
                            </div>
                        </div>
                        <div class="pl_con">
                            <?php echo $v['geval_content']; ?>
                            <?php if (!empty($v['geval_image'])) { ?>
                                <div class="img_quyu">
                                    <?php $image_array = explode(',', $v['geval_image']); ?>
                                    <?php foreach ($image_array as $value) { ?>
                                        <a href="<?php echo snsThumb($value, 1024); ?>" data-lightbox="roadtrip">
                                            <div class="img_box img-responsive">
                                                <img src="<?php echo snsThumb($value); ?>"/>
                                                <div class="mask"></div>
                                            </div>
                                        </a>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                <?php } ?>
                <div class="page" style="margin-bottom: 0">
                    <?php echo $output['show_page']; ?>
                </div>
            </div>
        </div>
    </div>


    </div>

<?php } else { ?>
    <div class="ncs-norecord"><?php echo $lang['no_record']; ?></div>
<?php } ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('.raty').raty({
            path: "<?php echo RESOURCE_SITE_URL;?>/js/jquery.raty/img",
            readOnly: true,
            score: function () {
                return $(this).attr('data-score');
            }
        });

        $('a[nctype="nyroModal"]').nyroModal();

        $('#comment_info').find('.demo').ajaxContent({
            event: 'click', //mouseover
            loaderType: "img",
            loadingMsg: "<?php echo SHOP_TEMPLATES_URL;?>/images/transparent.gif",
            target: '#comment_info'
        });
    });
</script> 
