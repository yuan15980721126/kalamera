<?php defined('interMarket') or exit('Access Invalid!');?>

<!--中间内容-->
<div class="page_form clearfix where_buy">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="login_title padding-top-10 margin-b-5">Kalamera Inc.</div>
                <p class="label_txt" style="padding-bottom: 20px;font-size: 13px;">
                    Kalamera Inc is built to supply quality wine and beverage refrigerator for our customers. As an official shop, Kalamera will take of shipping and service, and satisfaction is guaranteed.
            </div>
            <?php if(!empty($output['position_list']) && is_array($output['position_list'])){?>
                <?php foreach($output['position_list'] as $value){?>

                    <div class="col-md-6">
                        <a href="<?php if($value['url']){echo $value['url'];}else{echo 'javascript:;';}?>">
                        <div class="sp_img" style="background-image: url(<?php echo $value['pic'];?>)"></div>
                        </a>
                        <div class="sp_txt dot-ellipsis dot-height-60">
                            <?php echo $value['title'];?>
                        </div>
                    </div>

                <?php }?>
            <?php }?>





        </div>
    </div>
</div>
<!--中间内容结束-->