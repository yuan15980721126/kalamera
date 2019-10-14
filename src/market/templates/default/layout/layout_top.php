<?php defined('interMarket') or exit('Access Invalid!');?>
<script>
	function AddFavorite(title, url) {
		try {
			window.external.addFavorite(url, title);
		}
		catch (e) {
			try {
				window.sidebar.addPanel(title, url, "");
			}
			catch (e) {
				alert("抱歉，您所使用的浏览器无法完成此操作。\n\n加入收藏失败，请使用Ctrl+D进行添加");
			}
		}
	}
</script>

<!--头部开始-->
<header>
    <!--顶部登录注册-->
    <div id="top_">
        <div class="top_con container">
            <div class="fl top_l">
                Welcome to Kalamera !
            </div>
            <div class="fr top_r">
                <?php if (!$_SESSION['is_login']) {?>
                    <a href="<?php echo urlLogin('login','index');?>" class="inline_b login_btn pointer">Login</a>
                    |
                    <a href="<?php echo urlLogin('login', 'register', array('ref_url' => $_GET['ref_url']));?>" class="inline_b pointer">Register</a>
                <?php } else { ?>
                    <span>
						[&nbsp;<a href="<?php echo urlMember('member_information','index');?>">Member Center</a>&nbsp;&nbsp; | &nbsp;&nbsp;
						<a href="<?php echo urlLogin('login','logout');?>">Logout</a>&nbsp;]
					</span>
                    <span>
                        <a href="<?php echo SHOP_SITE_URL;?>/index.php?model=member_order">Order inquiry
                        </a>
                    </span>
                <?php } ?>

            </div>
        </div>
    </div>
    <!--顶部登录注册结束-->








