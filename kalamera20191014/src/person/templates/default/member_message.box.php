<?php defined('interMarket') or exit('Access Invalid!');?>
<link rel="stylesheet" href="/skins/default/css/NewsCore.css" />
<script type="text/javascript" src="/skins/default/js/NewCore.js"></script>
<div id="main">
    <!--右侧-->
    <div id="mian_right">
        <div id="mian_tab">
            <div id="New_Core">
                <div id="head_tab">
                    <div id="new_tab">
                         <?php if(is_array($output['member_menu']) and !empty($output['member_menu'])) {
                          foreach ($output['member_menu'] as $key => $val) {
                            $classname = '';
                            if($val['menu_key'] == $output['menu_key']) {
                              $classname = 'cur';
                            }
                            if ($val['menu_key'] == 'message'){
                              // echo '<li class="'.$classname.'"><a href="'.$val['menu_url'].'">'.$val['menu_name'].'(<span style="color: red;">'.$output['newcommon'].'</span>)</a></li>';
                              // echo '<div class="'.$classname.'"><a href="'.$val['menu_url'].'">'.$val['menu_name'].'(<span style="color: red;">'.$output['newarticle'].'</span>)</a></div>';
                            }elseif ($val['menu_key'] == 'system'){
                              // echo '<li class="'.$classname.'"><a href="'.$val['menu_url'].'">'.$val['menu_name'].'(<span style="color: red;">'.$output['newsystem'].'</span>)</a></li>';
                              echo '<div class="'.$classname.'"><a href="'.$val['menu_url'].'">'.$val['menu_name'].'(<span style="color: red;">'.$output['newsystem'].'</span>)</a></div>';
                            }elseif ($val['menu_key'] == 'close' || $val['menu_key'] == 'setting'  || $val['menu_key'] == 'private'){
                              #echo '<li class="'.$classname.'"><a href="'.$val['menu_url'].'">'.$val['menu_name'].'(<span style="color: red;">'.$output['newpersonal'].'</span>)</a></li>';
                            }else{
                              echo '<div class="'.$classname.'"><a href="'.$val['menu_url'].'">'.$val['menu_name'].'(<span style="color: red;">'.$output['newarticle'].'</span>)</a></div>';
                              // echo '<li class="'.$classname.'"><a href="'.$val['menu_url'].'">'.$val['menu_name'].'</a></li>';
                              // echo '<div class="'.$classname.'"><a href="'.$val['menu_url'].'">'.$val['menu_name'].'</a></div>';
                            }
                          }
                        }?>
                        <!-- <div class="cur">系统通知</div>
                        <div>商城公告</div> -->
                    </div>
                    <div id="head_select">
                    <!-- <select>
                        <option value="">全部</option>
                    </select> -->
                    </div>
                                                
                </div>
                <div id="New_content">
                    <ul>

                        <li style="display: block;" class="xt_tip">
                        <?php if (!empty($output['message_array'])) { ?>
                            <div class="all_ck"><?php echo $lang['home_message_select_all'];?></div>
                           <!--  <div class="del_">批量删除</div> -->
                            <?php if ($output['drop_type'] == 'msg_list'){?>
                              <div class="del_" id="del_all" data-type="<?php echo MEMBER_SITE_URL;?>/index.php?model=member_message&fun=dropcommonmsg&drop_type=<?php echo $output['drop_type']; ?>"><a href="javascript:void(0)"    nc_type="batchbutton">批量删除</a></div>
                              <?php }?>
                              <?php if ($output['drop_type'] == 'msg_system' || $output['drop_type'] == 'msg_seller'){?>
                              <div class="del_" id="del_all" data-type="<?php echo MEMBER_SITE_URL;?>/index.php?model=member_message&fun=dropbatchmsg&drop_type=<?php echo $output['drop_type']; ?>"><a href="javascript:void(0)"    name="message_id"  nc_type="batchbutton">批量删除</a></div>
                            <?php }?>
                        <?php }?>


                            <?php if (!empty($output['message_array'])) { ?>
                            
                            <div class="New_all">
                            <?php foreach($output['message_array'] as $k => $v){ ?>
                                <div class="New_info">
                                    <div class="New_date">
                                        <div class="new_year"><?php echo @date("Y-m",$v['message_update_time']); ?></div>
                                        <div class="new_day"><?php echo @date("d",$v['message_update_time']); ?></div>
                                    </div>
                                    <div class="new_tip">
                                        <div class="xt_new">
                                            <div class="check_info " data-cid="<?php echo $v['message_id']; ?>">
                                                <img src="/skins/default/img/vipcore/ckg_03.png" />

                                            </div>
                                            <div><?php echo $v['from_member_name']; ?>  </div>
                                            <div>
                                                ：<?php echo parsesmiles($v['message_body']); ?>
                                            </div>
                                            <div>
                                                <?php echo @date("H:i",$v['message_update_time']); ?>
                                            </div>
                                            <?php if ($output['drop_type'] == 'msg_list'){?>
                                            <div class="del_mes"  title="删除" data-type="<?php echo MEMBER_SITE_URL;?>/index.php?model=member_message&fun=dropbatchmsg&drop_type=<?php echo $output['drop_type']; ?>&message_id=<?php echo $v['message_id']; ?>"></div>
                                            <?php }?>
                                            <?php if ($output['drop_type'] == 'msg_system' || $output['drop_type'] == 'msg_seller'){?>
                                            <div class="del_mes" data-type="<?php echo MEMBER_SITE_URL;?>/index.php?model=member_message&fun=dropbatchmsg&drop_type=<?php echo $output['drop_type']; ?>&message_id=<?php echo $v['message_id']; ?>" title="删除"></div>
                                            <?php }?>

                                        </div>
                                        <div class="new_wz">
                                            <?php if ($output['drop_type'] == 'msg_list'){?>
                                              <!-- <span class="chakan"><a href="index.php?model=member_message&fun=showmsgcommon&drop_type=<?php echo $output['drop_type']; ?>&message_id=<?php echo $v['message_id']; ?><?php if($v['message_parent_id']>0) echo '#'.$v['message_id']; ?>" class="btn-bluejeans"><i class="icon-edit"></i>
                                              <p><?php echo $lang['home_message_view_detail'];?></p>
                                              </a>
                                              </span>  -->
                                            <?php }?>
                          <?php if ($output['drop_type'] == 'msg_system' || $output['drop_type'] == 'msg_seller'){?>
                          <!-- <span class="chakan">
                                <a href="index.php?model=member_message&fun=showmsgbatch&drop_type=<?php echo $output['drop_type']; ?>&message_id=<?php echo $v['message_id']; ?><?php if($v['message_parent_id']>0) echo '#'.$v['message_id']; ?>" class="btn-aqua">
                                <p><?php echo $lang['home_message_view_detail'];?></p>
                                </a>
                          </span> -->
                          <?php }?>
                                        </div>
                                    </div>
                                </div>      
                                                            
                                                            
                             <?php }?>                                     
                            </div>
                                 
                            <?php } else { ?>
                              <tr>
                                <td colspan="20" class="norecord"><div class="warning-option"><i>&nbsp;</i><span><?php echo $lang['no_record'];?></span></div></td>
                              </tr>
                            <?php } ?>

                        </li>
                    </ul>
                </div>
            </div>
        </div>
                                
        <div class="pagination"><?php echo $output['show_page']; ?></div>
                                
    </div>
</div>
                </div>
            </div>  
            </div>






























<!-- <div class="wrap">-->
  <?php //require_once template('layout/member_message.submenu');?>
  <!-- <table class="ncm-default-table">
    <thead>
      <tr>
        <th class="w30"></th>
        <th class="w100 tl"><?php
                if ($output['drop_type'] == 'msg_seller'){
                	echo $lang['home_message_storename'];
                }else {
                	echo $lang['home_message_sender'];
                }?></th>
        <th class="tl"><?php echo $lang['home_message_content'];?></th>
        <th class="w300"><?php echo $lang['home_message_last_update'];?></th>
        <th class="w110"><?php echo $lang['home_message_command'];?></th>
      </tr>
      <?php if (!empty($output['message_array'])) { ?>
      <tr>
        <td colspan="20"><input type="checkbox" id="all" class="checkall"/>
        <label for="all"><?php echo $lang['home_message_select_all'];?></label>
          <?php if ($output['drop_type'] == 'msg_list'){?>
          <a href="javascript:void(0)" class="ncbtn-mini" uri="<?php echo MEMBER_SITE_URL;?>/index.php?model=member_message&fun=dropcommonmsg&drop_type=<?php echo $output['drop_type']; ?>" name="message_id" confirm="<?php echo $lang['home_message_delete_confirm'];?>?" nc_type="batchbutton"><i class="icon-trash"></i><?php echo $lang['home_message_delete'];?></a>
          <?php }?>
          <?php if ($output['drop_type'] == 'msg_system' || $output['drop_type'] == 'msg_seller'){?>
          <a href="javascript:void(0)" class="ncbtn-mini" uri="<?php echo MEMBER_SITE_URL;?>/index.php?model=member_message&fun=dropbatchmsg&drop_type=<?php echo $output['drop_type']; ?>" name="message_id" confirm="<?php echo $lang['home_message_delete_confirm'];?>?" nc_type="batchbutton"><?php echo $lang['home_message_delete'];?></a>
          <?php }?>
          <?php }?></td>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($output['message_array'])) { ?>
      <?php foreach($output['message_array'] as $k => $v){ ?>
      <tr class="bd-line">
        <td class="tc"><input type="checkbox" class="checkitem" value="<?php echo $v['message_id']; ?>"/></td>
        <td class="tl"><?php echo $v['from_member_name']; ?></td>
        <td class="link2<?php if($v['message_open'] == 0){?> font_bold<?php }?> tl"><?php echo parsesmiles($v['message_body']); ?></td>
        <td><?php echo @date("Y-m-d H:i:s",$v['message_update_time']); ?></td>
        <td class="ncm-table-handle"><?php if ($output['drop_type'] == 'msg_list'){?>
          <span><a href="index.php?model=member_message&fun=showmsgcommon&drop_type=<?php echo $output['drop_type']; ?>&message_id=<?php echo $v['message_id']; ?><?php if($v['message_parent_id']>0) echo '#'.$v['message_id']; ?>" class="btn-bluejeans"><i class="icon-edit"></i>
          <p><?php echo $lang['home_message_view_detail'];?></p>
          </a></span> <span><a href="javascript:void(0)" onclick="ajax_get_confirm('<?php echo $lang['home_message_delete_confirm'];?>?', '<?php echo MEMBER_SITE_URL;?>/index.php?model=member_message&fun=dropcommonmsg&drop_type=<?php echo $output['drop_type']; ?>&message_id=<?php echo $v['message_id']; ?>');" class="btn-grapefruit"><i class="icon-trash"></i>
          <p><?php echo $lang['home_message_delete'];?></p>
          </a></span>
          <?php }?>
          <?php if ($output['drop_type'] == 'msg_system' || $output['drop_type'] == 'msg_seller'){?>
          <span><a href="index.php?model=member_message&fun=showmsgbatch&drop_type=<?php echo $output['drop_type']; ?>&message_id=<?php echo $v['message_id']; ?><?php if($v['message_parent_id']>0) echo '#'.$v['message_id']; ?>" class="btn-aqua"><i class="icon-eye-open"></i>
          <p><?php echo $lang['home_message_view_detail'];?></p>
          </a></span><span><a href="javascript:void(0)" onclick="ajax_get_confirm('<?php echo $lang['home_message_delete_confirm'];?>?', '<?php echo MEMBER_SITE_URL;?>/index.php?model=member_message&fun=dropbatchmsg&drop_type=<?php echo $output['drop_type']; ?>&message_id=<?php echo $v['message_id']; ?>');" class="btn-grapefruit"><i class="icon-trash"></i>
          <p><?php echo $lang['home_message_delete'];?></p>
          </a></span>
          <?php }?></td>
      </tr>
      <?php } ?>
      <?php } else { ?>
      <tr>
        <td colspan="20" class="norecord"><div class="warning-option"><i>&nbsp;</i><span><?php echo $lang['no_record'];?></span></div></td>
      </tr>
      <?php } ?>
    </tbody>
    <tfoot>
      <?php if (!empty($output['message_array'])) { ?>      
      <tr>
        <td colspan="20"><div class="pagination"><?php echo $output['show_page']; ?></div></td>
      </tr>
      <?php } ?>
    </tfoot>
  </table>
</div> -->
<script type="text/javascript">
  $(function(){
    

    $('.del_mes').click(function(){
        if(confirm("确定要删除这条消息吗？")){
            var url=$(this).data('type');
            $.ajax({
                     type: 'get',
                     url: url,
                    data: {type:'json'},
                     dataType:'json',
                     success: function(result){
                            console.log(result);
                            if (result.state) {
                                location.reload();
                            } else {
                                // $.sDialog({
                                //     skin:"red",
                                //     content:result.datas.error,
                                //     okBtn:false,
                                //     cancelBtn:false
                                // });
                                 alert(result.msg);
                                return false;
                            }
                         
                     }
                  
                        
            })
        }
    });
    $('#del_all').click(function(){

            var flag=false;
            $.each($(".xt_tip .check_info"),function(){
                if($(this).hasClass("ckbg")){
                    flag=true;
                }
            })

            if(!flag){
                alert('请选择需要操作的记录');
                // $.sDialog({
                //     skin:"red",
                //     content:'请选择需要操作的记录',
                //     okBtn:false,
                //     cancelBtn:false
                // });
                // console.log(1)

                return false;
            }
            if(confirm("确定要全部删除消息吗？")){
                var items = '';
                 var url = '';
                $.each($(".xt_tip .check_info"),function(){
                    if($(this).hasClass("ckbg")){
                        // var val = $(this).children(".checkitem").val();

                        var val = $(this).data('cid');
                        // console.log(va)
                        items += val + ',';
                    }
                });
                items = items.substr(0, (items.length - 1));
                
                var url=$(this).data('type');
                


                // form = $("<form></form>");
                //         form.attr('action',url);
                //         form.attr('method','get'); 

                //         // input1 = $("<input type='hidden' name='member_id' />");  
                //         // input1.attr('value',data.data.member_id);
                //         input2 = $("<input type='hidden' name='message_id' />"); 
                //         input2.attr('value',items);   
                //         // input3 = $("<input type='hidden' name='email' />"); 
                //         // input3.attr('value',data.data.member_email);    
                //         // str = $("#bar").html();
                //         // input = $("<input type='text'>").val(str).attr('name','bar');
                //         // form.append(input1);
                //         form.append(input2);
                //         // form.append(input3);
                //         form.appendTo("body");
                // //         console.log(form);

                // // return false;
                //         form.submit();  

                $.ajax({
                     type: 'get',
                     url: url,
                     data: {message_id:items,type:'json'},
                     dataType:'json',
                     success: function(result){
                            console.log(result);
                            if (result.state) {
                                location.reload();
                            } else {
                                // $.sDialog({
                                //     skin:"red",
                                //     content:result.datas.error,
                                //     okBtn:false,
                                //     cancelBtn:false
                                // });
                                 alert(result.datas.error);
                                return false;
                            }
                         
                     }
                  
                        
                })
            }
    });


});
 /* 加入购物车后的效果函数 */
function addcart_callback(data){
    $('#bold_num').html(data.num);
    $('#bold_mly').html(price_format(data.amount));
    $('#alert').fadeIn('fast');
}

</script>