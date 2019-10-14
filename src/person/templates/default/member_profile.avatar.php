<?php defined('interMarket') or exit('Access Invalid!');?>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.Jcrop/jquery.Jcrop.js"></script>
<link href="<?php echo RESOURCE_SITE_URL;?>/js/jquery.Jcrop/jquery.Jcrop.min.css" rel="stylesheet" type="text/css" id="cssfile2" />
<link href="<?php echo MEMBER_TEMPLATES_URL;?>/css/member.css" rel="stylesheet" type="text/css">
<style>
    input[type="submit"], input.submit, a.submit {
        font-size: 12px;
        line-height: 30px;
        font-weight: bold;
        color: #FFF;
        background-color: #48CFAE;
        display: block;
        height: 30px;
        padding: 0 20px;
        border-radius: 3px;
        border: none 0;
        cursor: pointer;
    }
    input[type="submit"]:hover, input.submit:hover, a.submit:hover {
        text-decoration: none;
        color: #FFF;
        background-color: #36BC9B;
    }
    #labelpic {
        width: 160px;
        height: 28px;
        border: none;
        color: #fff;
        background: #77af1e;
        border-radius: 3px;
        display: block;
        margin-top: 20px;
        text-align: center;
        padding-top: 5px;
    }
</style>
<div class="bg">
    <div class="border_t"></div>
    <?php //require_once template('layout/cur_local');?>
    <div class="container">
        <div class="row">
<!--            <div class="col-md-2 col-sm-3">-->
<!--                --><?php ////require_once template('layout/member_sidebar');?>
<!--            </div>-->
            <div class="col-md-10 col-sm-9 pad_l_0">
                <div class="order_nav clearfix">
                    <div class="fl" style="margin-top: 13px;margin-left: 10px;">
                        <div class=" ">
                            Membership information
                        </div>
                    </div>
                </div>
                <?php if ($output['newfile'] == ''){?>
                <div class="touxiang">
                    <form action="<?php echo MEMBER_SITE_URL;?>/index.php?model=member_information&fun=upload" enctype="multipart/form-data" id="form_avaster" method="post">
                        <input type="hidden" name="form_submit" value="ok" />
                        <div class="inline_b">
                            Current Avatar ：<br/>
                            <img src="<?php echo getMemberAvatar($output['member_avatar']).'?'.microtime(); ?>" alt="" nc_type="avatar" />
                            <input type="file" hidefocus="true" size="1" class="input-file" name="pic" id="pic" file_id="0" multiple="" maxlength="0"/ style="display:none;">
                            <label id="labelpic" for="pic">Change the Avatar</label>
                            <!--                        <p>-->
                            <!--                            <i class="icon-upload-alt"></i>图片上传-->
                            <!--                        </p>-->
                            <input id="submit_button" style="display:none" type="button" value="&nbsp;" onClick="submit_form($(this))" />
                            </a>
                        </div>
                        <div class="inline_b">
                            <p>
                                <?php echo $lang['nc_member_avatar_hint'];?>
                            </p>
                        </div>

                </div>





            </div>
            <?php }else{?>
                <form action="<?php echo MEMBER_SITE_URL;?>/index.php?model=member_information&fun=cut" id="form_cut" method="post">
                    <input type="hidden" name="form_submit" value="ok" />
                    <input type="hidden" id="x1" name="x1" />
                    <input type="hidden" id="x2" name="x2" />
                    <input type="hidden" id="w" name="w" />
                    <input type="hidden" id="y1" name="y1" />
                    <input type="hidden" id="y2" name="y2" />
                    <input type="hidden" id="h" name="h" />
                    <input type="hidden" id="newfile" name="newfile" value="<?php echo $output['newfile'];?>" />
                    <div class="pic-cut-120">
                        <div class="work-title">Work area</div>
                        <div class="work-layer">
                            <p><img id="nccropbox" src="<?php echo UPLOAD_SITE_URL.DS.ATTACH_AVATAR.DS.$output['newfile'].'?'.microtime(); ?>"/></p>
                        </div>
                        <div class="thumb-title">Cutting Preview</div>
                        <div class="thumb-layer">
                            <p><img id="preview" src="<?php echo UPLOAD_SITE_URL.DS.ATTACH_AVATAR.DS.$output['newfile'].'?'.microtime();?>"/></p>
                        </div>
                        <div class="cut-help">
                            <h4>Operational assistance</h4>
                            <p>Please zoom in, zoom in and move the selection box, select the area to be cut, and the ratio of width to height is fixed. The effect of cutting is shown in the right preview map. It will take effect after saving and submitting.
                            </p>
                        </div>
                        <div class="cut-btn">
                            <input type="button" id="ncsubmit" class="submit" value="submit" />
                        </div>
                    </div>
                </form>

            <?php }?>
        </div>
    </div>
</div>
</div>




<script type="text/javascript">
    $(function(){
        <?php if ($output['newfile'] != ''){?>
        function showPreview(coords)
        {
            if (parseInt(coords.w) > 0){
                var rx = 120 / coords.w;
                var ry = 120 / coords.h;
                $('#preview').css({
                    width: Math.round(rx * <?php echo $output['width'];?>) + 'px',
                    height: Math.round(ry * <?php echo $output['height'];?>) + 'px',
                    marginLeft: '-' + Math.round(rx * coords.x) + 'px',
                    marginTop: '-' + Math.round(ry * coords.y) + 'px'
                });
            }
            $('#x1').val(coords.x);
            $('#y1').val(coords.y);
            $('#x2').val(coords.x2);
            $('#y2').val(coords.y2);
            $('#w').val(coords.w);
            $('#h').val(coords.h);
        }
        $('#nccropbox').Jcrop({
            aspectRatio:1,
            setSelect: [ 0, 0, 120, 120 ],
            minSize:[50, 50],
            allowSelect:0,
            onChange: showPreview,
            onSelect: showPreview
        });
        $('#ncsubmit').click(function() {
            var x1 = $('#x1').val();
            var y1 = $('#y1').val();
            var x2 = $('#x2').val();
            var y2 = $('#y2').val();
            var w = $('#w').val();
            var h = $('#h').val();
            if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h==""){
                alert("您必须先选定一个区域");
                return false;
            }else{
                $('#form_cut').submit();
            }
        });
        <?php }else{?>
        $('#pic').change(function(){
            var filepath=$(this).val();
            var extStart=filepath.lastIndexOf(".");
            var ext=filepath.substring(extStart,filepath.length).toUpperCase();
            if(ext!=".PNG"&&ext!=".GIF"&&ext!=".JPG"&&ext!=".JPEG"){
                alert("文件类型错误，请选择图片文件（png|gif|jpg|jpeg）");
                $(this).attr('value','');
                return false;
            }
            if ($(this).val() == '') return false;
            $("#form_avaster").submit();
        });
        <?php }?>
    });
</script>