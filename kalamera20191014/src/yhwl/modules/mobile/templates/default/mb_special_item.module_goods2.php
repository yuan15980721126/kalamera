<?php defined('interMarket') or exit('Access Invalid!');?>
<style type="text/css">
.mb-item-edit-content {
background: #EFFAFE url(<?php echo ADMIN_TEMPLATES_URL;
?>/images/cms_edit_bg_line.png) repeat-y scroll 0 0;
}
</style>
<?php if($item_edit_flag) { ?>
<!-- 操作说明 -->
<div class="explanation" id="explanation">
  <div class="title" id="checkZoom"><i class="fa fa-lightbulb-o"></i>
    <h4 title="<?php echo $lang['nc_prompts_title'];?>"><?php echo $lang['nc_prompts'];?></h4>
    <span id="explanationZoom" title="<?php echo $lang['nc_prompts_span'];?>"></span> </div>
  <ul>
    <li>从右侧筛选按钮，点击添加按钮完成添加</li><?php echo $output['item_info']['item_id'];?>">
    <li>鼠标移动到已有商品上，会出现删除按钮可以对商品进行删除</li>
    <li>操作完成后点击保存编辑按钮进行保存</li>
  </ul>
</div>
<?php } ?>
<div class="index_block goods-list">
  <?php if($item_edit_flag) { ?>
  <h3>商品版块</h3>
  <?php } ?>
  <div class="title">
    <?php if($item_edit_flag) { ?>
    <h5>标题：</h5>
    <input id="home1_title" type="text" class="txt w200" name="item_data[title]" value="<?php echo $item_data['title'];?>">
    <?php if($output['item_info']['item_type'] == 'goods2' ) { ?>
    <h5>开始时间：</h5>
    <dl class="row" name="limittime_div">
        <dt class="tit">
          <label> <?php echo $lang['admin_pointprod_starttime']; ?> </label>
        </dt>
        <dd class="opt">
          <input type="text" name="item_data[starttime]"  id="starttime" class="input-txt" style="width:100px;" value="<?php echo $item_data['starttime'];?>"/>
          <?php echo $lang['admin_pointprod_time_day']; ?>
         <!--  <select id="starthour" name="starthour" style="margin-left: 8px; _margin-left: 4px; width:50px;">
            <?php foreach ($output['hourarr'] as $item){ ?>
            <option value="<?php echo $item; ?>"><?php echo $item; ?></option>
            <?php }?>
          </select> -->
          <?php echo $lang['admin_pointprod_time_hour']; ?>
          <p class="notic"></p>
        </dd>
    </dl>
    <h5>结束时间：</h5>
    <dl class="row" name="limittime_div">
        <dt class="tit">
          <label> <?php echo $lang['admin_pointprod_starttime']; ?> </label>
        </dt>
        <dd class="opt">
          <input type="text" name="item_data[endtime]" id="endtime" class="input-txt" style="width:100px;" value="<?php echo $item_data['endtime'];?>" />
          <?php echo $lang['admin_pointprod_time_day']; ?>
         <!--  <select id="starthour" name="starthour" style="margin-left: 8px; _margin-left: 4px; width:50px;">
            <?php foreach ($output['hourarr'] as $item){ ?>
            <option value="<?php echo $item; ?>"><?php echo $item; ?></option>
            <?php }?>
          </select> -->
          <?php echo $lang['admin_pointprod_time_hour']; ?>
          <p class="notic"></p>
        </dd>
    </dl>
    <?php } ?>
    <?php } else { ?>
    <span><?php echo $item_data['title'];?></span>
    <?php } ?>
  </div>
  <div nctype="item_content" class="content">
    <?php if($item_edit_flag) { ?>
    <h5>内容：</h5>
    <?php } ?>
    <?php if(!empty($item_data['item']) && is_array($item_data['item'])) {?>
    <?php foreach($item_data['item'] as $item_value) {?>
    <div nctype="item_image" class="item">
      <div class="goods-pic"><img nctype="goods_image" src="<?php echo cthumb($item_value['goods_image']);?>" alt=""></div>
      <div class="goods-name" nctype="goods_name"><?php echo $item_value['goods_name'];?></div>
      <div class="goods-price" nctype="goods_price">￥<?php echo $item_value['goods_promotion_price'];?></div>
      <?php if($item_edit_flag) { ?>
      <input nctype="goods_id" name="item_data[item][]" type="hidden" value="<?php echo $item_value['goods_id'];?>">
      <a nctype="btn_del_item_image" href="javascript:;"><i class="fa fa-trash-o
"></i>删除</a>
      <?php } ?>
    </div>
    <?php } ?>
    <?php } ?>
  </div>
</div>
<?php if($item_edit_flag) { ?>
<div class="search-goods">
  <h3>选择商品添加</h3>
  <h5>商品关键字：</h5>
  <input id="txt_goods_name" type="text" class="txt w200" name="">
  <a id="btn_mb_special_goods_search" class="ncap-btn" href="javascript:;" style="vertical-align: top; margin-left: 5px;">搜索</a>
  <div id="mb_special_goods_list"></div>
</div>
<?php } ?>
<script id="item_goods_template" type="text/html">
    <div nctype="item_image" class="item">
        <div class="goods-pic"><img nctype="image" src="<%=goods_image%>" alt=""></div>
        <div class="goods-name" nctype="goods_name"><%=goods_name%></div>
        <div class="goods-price" nctype="goods_price"><%=goods_price%></div>
        <input nctype="goods_id" name="item_data[item][]" type="hidden" value="<%=goods_id%>">
        <a nctype="btn_del_item_image" href="javascript:;">删除</a>
    </div>
</script> 
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.ajaxContent.pack.js" type="text/javascript"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/fileupload/jquery.iframe-transport.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/fileupload/jquery.ui.widget.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/fileupload/jquery.fileupload.js" charset="utf-8"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#btn_mb_special_goods_search').on('click', function() {
            var url = '<?php echo urlAdminMobile('mb_special', 'goods_groupbuy_list');?>';
            var keyword = $('#txt_goods_name').val();
            if(keyword) {
                $('#mb_special_goods_list').load(url + '&' + $.param({keyword: keyword}));
            }
        });

        $('#mb_special_goods_list').on('click', '[nctype="btn_add_goods"]', function() {
            var item = {};
            item.goods_id = $(this).attr('data-goods-id');
            item.goods_name = $(this).attr('data-goods-name');
            item.goods_price = $(this).attr('data-goods-price');
            item.goods_image = $(this).attr('data-goods-image');
            var html = template.render('item_goods_template', item);
            $('[nctype="item_content"]').append(html);
        });
    });
    function showlimit(){
        //var islimit = $('input[name=islimit][checked]').val();
        var islimit = $(":radio[name=islimit]:checked").val();
        if(islimit == '1'){
            $("#limitnum_div").show();
            $("#limitnum").val('');
        }else{
            $("#limitnum_div").hide();
            $("#limitnum").val('1');//为了减少提交表单的验证，所以添加一个虚假值
        }
    }
    function showlimittime(){
        var islimit = $(":radio[name=islimittime]:checked").val();
        // if(islimit == '1'){
        //     $("[name=limittime_div]").show();
        //     $("#starttime").val('');
        //     $("#endtime").val('');
        // }else{
        //     $("[name=limittime_div]").hide();
        //     $("#starttime").val('<?php echo @date('Y-m-d',time()); ?>');
        //     $("#endtime").val('<?php echo @date('Y-m-d',time()); ?>');
        // }
    }
$(function(){
    showlimittime();
    $('#starttime').datepicker({dateFormat: 'yy-mm-dd'});
    $('#endtime').datepicker({dateFormat: 'yy-mm-dd'});
});
</script> 
