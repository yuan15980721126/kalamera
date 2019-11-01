<?php defined('interMarket') or exit('Access Invalid!'); ?>


<!--底部-->
<div class="footer_html">
    <!--底部-->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="foot clearfix">
                    <div class="col-md-12">

                        <img style="padding-bottom: 20px;"
                             src="<?php echo UPLOAD_SITE_URL . DS . ATTACH_COMMON . DS . $output['setting_config']['site_logo']; ?>"
                             alt="">
                    </div>
                    <div class="col-md-4">

                        <ul class="option">
                            <?php if (is_array($output['option_list']) && !empty($output['option_list'])) { ?>
                            <?php foreach ($output['option_list'] as $k => $article_class) { ?>
                            <?php if (!empty($article_class)) { ?>
                                <li>
                                    <a href="<?php echo urlMember('article', 'show', array('article_id'=>$article_class['article_id'])); ?>">
                                        <?php echo $article_class['article_title']; ?>
                                    </a>
                                </li>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        </ul>

                    </div>

                    <?php if (is_array($output['bottom_list']) && !empty($output['bottom_list'])) { ?>
                        <?php foreach ($output['bottom_list'] as $k => $article_class) { ?>
                            <?php if (!empty($article_class)) { ?>
                                <div class="col-md-4">
                                    <p class="foot_ct_1"><?php echo $article_class['article_content']; ?>
                                    </p>
                                    <div class="row">
                                    <ul class="pay_logo">
                                        <li class="col-md-4" ><img alt="" src="/data/upload/shop/editor/20190815151325_22597.jpg"></li>
                                        <li  class="col-md-4"><img alt="" src="/data/upload/shop/editor/20190815151325_22597.jpg"></li>
                                        <li class="col-md-4"><img alt="" src="/data/upload/shop/editor/20190815151325_22597.jpg"></li>
                                        <li class="col-md-4"><img alt="" src="/data/upload/shop/editor/20190815151325_22597.jpg"></li>
                                        <li class="col-md-4"><img alt="" src="/data/upload/shop/editor/20190815151325_22597.jpg"></li>
                                        <li class="col-md-4"><img alt="" src="/data/upload/shop/editor/20190815151325_22597.jpg"></li>
                                    </ul>
                                    </div>
                                </div>

                            <?php } ?>
                        <?php } ?>
                    <?php } ?>

                    <div class="col-md-4">
                        <p class="foot_tt">Sign Up for Our Newsletter</p>
                        <div class="foot_ct">
                            Get latest news & update from Kalamera
                        </div>
                        <form action="" method="post" id="message_form">
                        <div class="input_con">
                            <input type="text" id="email" name="email" placeholder="Enter Your Email Address"
                                   class="in_txt">
                            <input type="button" id="subscribe_add" class="in_sub" value="Subscribe">
                        </div>
                        </form>
                        <div class="foot_share pro_share">
                            Follow Us:
                            <a target="_blank" href="https://www.facebook.com/kamamerainc" ></a>
                            <a target="_blank" href="javascript:void(0);"></a>
                            <a target="_blank" href="https://twitter.com/Kalamerainc1" ></a>
                            <a target="_blank" href="javascript:void(0);" ></a>
                        </div>
                    </div>
                </div>
                <div class="sponsor_list">
                    <?php if (!empty($output['position_list']) && is_array($output['position_list'])) { ?>
                        <?php foreach ($output['position_list'] as $value) { ?>
                            <div>
                                <a href="<?php if ($value['url']) {
                                    echo $value['url'];
                                } else {
                                    echo 'javascript:void(0);';
                                } ?>">
                                    <img src="<?php echo $value['pic']; ?>" alt="">
                                </a>
                            </div>
                        <?php } ?>
                    <?php } ?>

                </div>
            </div>
        </div>
    </footer>
    <div id="bottom">
        <?php echo html_entity_decode($output['setting_config']['statistics_code'], ENT_QUOTES); ?>
    </div>
    <!--底部结束-->
</div>
<!--底部结束-->
<!--弹窗-->
<div class="popUp">
    <div class="popMask"></div>
    <div class="maskitem add_cart_success">
        <img class="close_" src="/skins/default/img/close_.png" alt="">
        <img src="/skins/default/img/shop_cart.png" alt="">
        <p class="padding-top-10">You have added an item to your cart</p>

        <a href="javascript:void(0);" class="go_to"
           onClick="location.href='<?php echo SHOP_SITE_URL . DS ?>index.php?model=cart'">View cart >></a>
    </div>
    <div class="maskitem collection_success">
        <img class="close_" src="/skins/default/img/close_.png" alt="">
        <img src="/skins/default/img/favor_heart.png" alt="">
        <p class="padding-top-10">My Favorites</p>
        <p class="font_big_blod">Successful collection</p>
        <a href="<?php echo SHOP_SITE_URL; ?>/index.php?model=member_favorite_goods&fun=index" class="go_to">View All
            >></a>
    </div>
    <div class="maskitem login_to_cart">
        <img class="close_" src="/skins/default/img/close_.png" alt="">
        <img src="/skins/default/img/shop_cart_.png" alt="">
        <p class="padding-top-10">LOGIN OR SIGN UP TO SAVE A LIST OF</p>
        <p class="font_big_blod">Your shopping cart</p>
        <a href="<?php echo urlLogin('login', 'index', array('ref_url' => getRefUrl())); ?>" class="go_to">Login</a>
        <span class="pop_or">OR</span>
        <a href="<?php echo urlLogin('login', 'register', array('ref_url' => request_uri())); ?>"
           class="go_to">Register</a>
    </div>
    <div class="maskitem login_to_favor">
        <img class="close_" src="/skins/default/img/close_.png" alt="">
        <img src="/skins/default/img/favor_heart.png" alt="">
        <p class="padding-top-10">LOGIN OR SIGN UP TO SAVE A LIST OF</p>
        <p class="font_big_blod">Your Favorites</p>
        <a class="go_to" href="<?php echo urlLogin('login', 'index', array('ref_url' => request_uri())); ?>">Login</a>

        <span class="pop_or">OR</span>
        <a href="<?php echo urlLogin('login', 'register', array('ref_url' => request_uri())); ?>"
           class="go_to">Register</a>
    </div>
</div>
<!--弹窗结束-->


<!--script-->
<script src="<?php echo RESOURCE_SITE_URL; ?>/js/combine.js"></script>
<script src="<?php echo RESOURCE_SITE_URL; ?>/js/top.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo RESOURCE_SITE_URL; ?>/js/lightbox.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL; ?>/js/owl.carousel.js"></script>
<script src="<?php echo RESOURCE_SITE_URL; ?>/js/call.js"></script>
<script src="<?php echo RESOURCE_SITE_URL; ?>/js/jquery.dotdotdot.min.js"></script>
<script type="text/javascript">
    call();
</script>
<script>
    // 点击关闭按钮X隐藏弹框
    $('.close_').click(function () {
        $('.popUp>div').hide();
    })
    // 点击mask隐藏弹框
    $('.popUp .popMask').click(function () {
        $('.popUp>div').hide();
    })
    // 回到顶部
    $(function () {
        $(window).scroll(function () {
            if ($(window).scrollTop() >= 300) {
                $('.toTop a').fadeIn(600);
            } else {
                $('.toTop a').fadeOut(600);
            }
        });
        $('.toTop a').hover(function () {
            $(this).addClass('hover');
        }, function () {
            $(this).removeClass('hover');
        });
        $('.top a').click(function () {
            $("html,body").animate({
                scrollTop: 0
            }, 500);
        });
    });
    $(function(){
        var memberid =  "<?php echo $_SESSION['member_id'];?>";
        var Url = "<?php echo urlShop('index', 'subscribe');?>";
        $('#subscribe_add').click(function(){
            if($("#message_form").valid()){
                var email = $('#email').val();
                $.ajax({
                    type: 'post',
                    url:  Url,
                    dataType: 'json',
                    data: {
                        email:email,
                    },

                    beforeSend: function () {
                        // 禁用按钮防止重复提交
                        // $("#send").prop( "disabled",true );
                    },
                    success: function(result) {
                        if (result.state) {
                            alert('Subscription Successful, Skipping');
                            setTimeout(function(){
                                window.location.reload();
                            }, 2000);
                        } else {
                            alert(result.msg);
                        }
                    },
                    complete: function () {
                    },
                });
            }
        });

        $("#message_form").validate({
            errorPlacement: function(error, element){
                alert(error[0].innerText)
            },
            onkeyup: false,
            rules: {
                email: {
                    required:true,
                    email:true
                },
            },
            messages: {
                email: {
                    required : 'Please enter your mailbox',
                    email: 'The mailbox format is incorrect',
                }
            }
        });
    });
</script>
<!--script结束-->


