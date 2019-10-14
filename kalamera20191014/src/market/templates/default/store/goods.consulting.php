<?php defined('interMarket') or exit('Access Invalid!');?>
<script type="text/javascript">
$(function(){
    $('#consult').find('.demo').ajaxContent({
        event:'click', //mouseover
        loaderType:"img",
        loadingMsg:"<?php echo SHOP_TEMPLATES_URL;?>/images/transparent.gif",
        target:'#consult'
    });

    $('#consulting_tab').find('a').ajaxContent({
        event:'click',
        loaderType:'img',
        loadingMsg:'<?php echo SHOP_TEMPLATES_URL;?>/images/transparent.gif',
        target:'#consulting_demo'
    });
    $(".consult_tab_head li").on("click",function(){
        var index=$(this).index();
        // console.log($(".consult_content li ").eq(index));   
        $(".consult_tab_head li a").removeClass("concl");
        $(".consult_tab_head li a").eq(index).addClass("concl");
   
        $(".consult_content .li_show").removeClass("consult_show");
        $(".consult_content .li_show").eq(index).addClass("consult_show");
        // console.log($(".consult_content li").eq(index))

    });
    // $(".consult_content li").addClass("consult_show");
});
</script>

<div id="consult_tab">
    <div class="consult_tab_head">
        <ul>
            <li><a  data-type="all" class="concl" href="javascript:;">全部咨询</a></li>
            <?php if (!empty($output['consult_type'])) {?>
            <?php foreach ($output['consult_type'] as $val) {?>
                <li><a data-type="<?php echo $val['ct_id'];?>" href="javascript:;"><?php echo $val['ct_name'];?></a></li>
            <?php }?>
            <?php }?>
        </ul>
        <a href="#quiz"></a> 
    </div>
<div class="consult_content">
    <ul>
        <?php if(!empty($output['consult_list'])) { ?>
        <li class="consult_show li_show">
            <div id="reply_list">
                <?php foreach($output['consult_list'] as $k=>$v){ ?>
                <div class="qaa">
                    <div class="que">
                        <?php if($v['isanonymous'] == 1){?>
                        <div><?php echo str_cut($v['member_name'],2).'***';if($v['member_id']== '0') echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$lang['nc_guest'];?></div>
                        <?php }else{?>
                        <div><a href="javascript:;" data-param="{'id':<?php echo $v['member_id'];?>}" nctype="mcard"><?php echo str_cut($v['member_name'],8);if($v['member_id']== '0') echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$lang['nc_guest'];?></a></div>
                        <?php }?>
                        
                        <div><?php echo nl2br($v['consult_content']);?></div>
                        <div><?php echo date("Y-m-d H:i:s",$v['consult_addtime']);?></div>
                    </div>
                    <?php if($v['consult_reply']!=""){?>
                    <div class="ans">
                        <div>客服回复</div>
                        <div><?php echo nl2br($v['consult_reply']);?></div>
                        <div><?php echo date("Y-m-d H:i:s",$v['consult_reply_time']);?></div>
                    </div>
                    <?php }?>
                </div>
                <?php }?>
                <div class="pagination">
                    <?php echo $output['show_page'];?>
                </div>  
            </div>
        
        
        
        <?php } else { ?>
        <li class="consult_show">
        <div class="ncs-norecord"><?php echo $lang['goods_index_no_reply'];?></div>
        <?php }?>
    
        
        </li>
    

        <?php for ($i=1; $i <= 4 ; $i++) { ?>
            
            <?php if(!empty($output['consult_list_'.$i])) { ?>
            <li class="li_show">
            <div id="reply_list">
                <?php foreach($output['consult_list_'.$i] as $k=>$v){ ?>
                <div class="qaa">
                    <div class="que">
                        <?php if($v['isanonymous'] == 1){?>
                        <div><?php echo str_cut($v['member_name'],2).'***';if($v['member_id']== '0') echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$lang['nc_guest'];?></div>
                        <?php }else{?>
                        <div><a href="javascript:;" data-param="{'id':<?php echo $v['member_id'];?>}" nctype="mcard"><?php echo str_cut($v['member_name'],8);if($v['member_id']== '0') echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$lang['nc_guest'];?></a></div>
                        <?php }?>
                        
                        <div><?php echo nl2br($v['consult_content']);?></div>
                        <div><?php echo date("Y-m-d H:i:s",$v['consult_addtime']);?></div>
                    </div>
                    <?php if($v['consult_reply']!=""){?>
                    <div class="ans">
                        <div>客服回复</div>
                        <div><?php echo nl2br($v['consult_reply']);?></div>
                        <div><?php echo date("Y-m-d H:i:s",$v['consult_reply_time']);?></div>
                    </div>
                    <?php }?>
                </div>
                <?php }?>

                 <div class="pagination">
                    <?php echo $output['show_page_'.$i];?>
                </div> 
            </div>
        
        
        
            <?php } else { ?>
            <li class="li_show">
                <div class="ncs-norecord"><?php echo $lang['goods_index_no_reply'];?></div>
            <?php }?>
        

  
            </li>
    <?php }?>
            

          
    
    </ul>
<?php if($output['consult_able']) { ?>
            <div id="quiz">
                <div class="quiz_title">
                    <span>提问：<?php echo $output['goods']['goods_name']; ?></span>
                </div>
                <div class="quiz_content">
                    <?php if (!$_SESSION['is_login']) {?>
                    <div><span>登录后才可发表咨询</span><a href="/member/index.php?model=login&fun=index">立即登录</a></div>
                    <?php } ?>
                    <form method="post" class="message2" action="index.php?model=goods&fun=save_consult">
                    <?php Security::getToken();?>
                    <input type="hidden" name="form_submit" value="ok" />
                    <input name="nchash" type="hidden" value="<?php echo getNchash();?>" />
                    <?php if($output['type_name']==''){?>
                    <input type="hidden" name="goods_id" value="<?php echo $_GET['goods_id']; ?>"/>
                    <?php }?>
                        <div id="radio">
                            <?php if (!empty($output['consult_type'])) {?>
                            <div>咨询类型：&nbsp;:</div>
                            <?php $checked = true;foreach ($output['consult_type'] as $val) {?>
                                <div>
                                <input type="radio" <?php if ($checked) {?>checked="checked"<?php }?> nctype="ctype<?php echo $val['ct_id'];?>" name="consult_type_id" class="radio" value="<?php echo $val['ct_id'];?>" />
                                <?php echo $val['ct_name'];?></div>
                            <?php $checked = false;}?>
                        </div>
                        <?php $checked = true;foreach ($output['consult_type'] as $val) {?>
                        <div class="ncs-consult-type-intro" <?php if (!$checked) {?>style="display:none;"<?php }?> nctype="ctype<?php echo $val['ct_id'];?>"> <?php echo $val['ct_introduce'];?> </div>
                        <?php $checked = false;}?>
                        <?php }?>
                        <div id="area">
                            <div>咨询内容:</div>
                            <div><textarea name="goods_content" id="2textfield3"></textarea><span id="consultcharcount"></span></div>
                            <?php if($output['setting_config']['captcha_status_goodsqa'] == '1') { ?>
                            <div id="sub" title="<?php echo $lang['goods_index_publish_consult'];?>">
                                <div>
                                    <input type="text" name="captcha" id="captcha2" placeholder="<?php echo $lang['goods_index_checkcode'];?>" />
                                    <a href="javascript:void(0)" onclick="javascript:document.getElementById('codeimage').src='index.php?model=seccode&fun=makecode&nchash=<?php echo getNchash();?>&t=' + Math.random();"><img src="index.php?model=seccode&fun=makecode&nchash=<?php echo getNchash();?>" name="codeimage" border="0" id="codeimage2" onclick="this.src='index.php?model=seccode&fun=makecode&nchash=<?php echo getNchash();?>&t=' + Math.random()"/></a>
                                </div>
                                <div>
                                    <input type="button" nctype="consult_submit2" value="提交问题" / >
                                </div>
                            </div>
                            <?php } ?>
                            <div nctype="error_msg"></div>
                        <div>

                        
                    </form>
                </div>
            </div>
            <?php }?>
</div>

<script type="text/javascript" src="/skins/default/js/jquery.page.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.validation.min.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.charCount.js"></script>
<script>
$(function(){
    // $('.raty').raty({
    //     path: "<?php echo RESOURCE_SITE_URL;?>/js/jquery.raty/img",
    //     readOnly: true,
    //     score: function() {
    //       return $(this).attr('data-score');
    //     }
    // });
    <?php if($output['consult_able']) { ?>
   
    $('input[nctype="consult_submit2"]').click(function(){
        <?php if ($_SESSION['is_login'] !== '1'){?>
            login_dialog();
        <?php }else{?>
        // $('.message').submit();
        var formhash = $("input[name='formhash']").val();
            var goods_content = $('#2textfield3').val();
            var captcha =$('#captcha2').val();
            var nchash='<?php echo getNchash();?>';
            var goods_id='<?php echo $_GET['goods_id'];?>';
            var consult_type_id=$("input[name='consult_type_id']:checked").val();
            // console.log(goods_content);
            // console.log(captcha);
            // console.log(consult_type_id);
            // return false;
            $.ajax({
                type: 'post',
                url: "index.php?model=goods&fun=save_consult",
                dataType: 'json',
                data: {formhash:formhash,goods_content:goods_content,goods_id:goods_id,captcha:captcha,form_submit:'ok',nchash:nchash,consult_type_id:consult_type_id},
                
                beforeSend: function () {
                    // 禁用按钮防止重复提交
                    $('input[nctype="consult_submit"]').prop( "disabled",true );
                },
                success: function(result) {
                    
                    // console.log(result);
                    if (result.state == 'success') {
                        // errorTipsShow("<p>加盟申请提交成功，正在跳转...</p>");
                         alert('提交咨询成功');
                        
                        // setTimeout("location.href = SiteUrl+'/shop'",3000);
                        setTimeout(function(){
                            window.location.reload();
                        }, 2000);
                         return false;
                    } else {                    //     if(result.msg == '未登录'){
                            // setTimeout(function(){
                            //     window.location.href = MemberUrl + '/index.php?model=login&fun=index';
                            // }, 3000);
                            // setTimeout("location.href = SiteUrl+'/member/index.php?model=login&fun=index'",3000);
                            
                        
                        alert(result.msg);
                        document.getElementById('codeimage2').src='index.php?model=seccode&fun=makecode&type=50,120&nchash=<?php echo getNchash();?>&t=' + Math.random();
                        return false;
                    }
                },
                complete: function () {
                    $('input[nctype="consult_submit"]').prop("disabled",false);
                },
            });
        <?php }?>
    });
    
    $('.message2').validate({
        errorPlacement: function(error, element){
            $('div[nctype="error_msg"]').append(error);
        },
        // submitHandler:function(form){
            // ajaxpost('message', '', '', 'onerror');
            // var data = $('.message').serializeArray();
            // console.log(data);
            
        // },
        onkeyup: false,
        rules : {
            goods_content : {
                required : true,
                maxlength : 120
            }
            <?php if(C('captcha_status_goodsqa') == '1') { ?>
                ,captcha: {
                    required : true,
                    remote   : {
                        url : 'index.php?model=seccode&fun=check&nchash=<?php echo getNchash();?>',
                        type:'get',
                        data:{
                            captcha : function(){
                                return $('#captcha2').val();
                            }
                        },
                        complete: function(data) {
                            if(data.responseText == 'false') {
                                document.getElementById('codeimage2').src='index.php?model=seccode&fun=makecode&nchash=<?php echo getNchash();?>&t=' + Math.random();
                            }
                        }
                    }
                }
            <?php }?>
        },
        messages : {
            goods_content : {
                required : '<?php echo $lang['goods_index_cosult_not_null'];?>',
                maxlength: '<?php echo $lang['goods_index_max_120'];?>'
            }
            <?php if($output['setting_config']['captcha_status_goodsqa'] == '1') { ?>
                ,captcha: {
                    required : '<?php echo $lang['goods_index_captcha_no_noll'];?>',
                    remote   : '<?php echo $lang['goods_index_captcha_error'];?>'
                }
            <?php }?>
        }
    });

    // textarea 字符个数动态计算

    $("#2textfield3").charCount({
        allowed: 120,
        warning: 10,
        counterContainerID:'consultcharcount',
        firstCounterText:'<?php echo $lang['goods_index_textarea_note_one'];?>',
        endCounterText:'<?php echo $lang['goods_index_textarea_note_two'];?>',
        errorCounterText:'<?php echo $lang['goods_index_textarea_note_three'];?>'
    });
    <?php }?>

    $('input[type="radio"]').click(function(){
        $('div[nctype^="ctype"]').hide();
        $('div[nctype="' + $(this).attr('nctype') + '"]').show();
    });
    //Hide Show verification code
    $("#hide").click(function(){
        $(".code").fadeOut("slow");
    });
    $("#captcha1").focus(function(){
        $(".code").fadeIn("fast");
    }); 

    // $(".consult_content").createPage({
    //     pageCount:6,
    //     current:1,
    //     backFn:function(p){
    //         console.log(p);
    //     }
    // });
});
</script>











