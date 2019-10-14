<div class="container">
    <?php if (!empty($output['nav_link_list']) && is_array($output['nav_link_list'])) { ?>
        <span class="location_ location_home"> >
            <?php foreach ($output['nav_link_list'] as $nav_link) { ?>

                <?php if (!empty($nav_link['link'])) { ?>

                    <?php echo $nav_link['title']; ?> >

                <?php } else { ?>
                    <a href="<?php echo $nav_link['link']; ?>"><?php echo $nav_link['title']; ?></a>
                <?php } ?>

            <?php } ?>
        </span>
    <?php } ?>

</div>

