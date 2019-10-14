<?php defined('interMarket') or exit('Access Invalid!');?>
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/home_point.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="/skins/default/css/StoreInfo.css" />
<script src="/skins/default/js/StoreInfo.js"></script>
<script type="text/javascript" src="<?php echo SHOP_RESOURCE_SITE_URL;?>/js/pgoods_cart.js" charset="utf-8"></script>

<div class="productinfo">
<div class="info">
    <div class="info_l">
        <div class="info_img"><img title="鼠标滚轮向上或向下滚动，能放大或缩小图片哦~" src="<?php echo $output['prodinfo']['pgoods_image_max']; ?>" class="cloudzoom" data-cloudzoom="zoomImage: '<?php echo $output['prodinfo']['pgoods_image_max']; ?>'"> </div> 
            <!-- <div class="info_imglist">
            <div id="lil">
                <a href="javascript:;"></a>
            </div>
            <div class="change">
                <ul>
                    <li><a href="javascript:;" >
                    <img title="鼠标滚轮向上或向下滚动，能放大或缩小图片哦~" class='cloudzoom-gallery' src="<?php echo $value['0'] ?>" data-cloudzoom="useZoom: '.cloudzoom', image: '<?php echo $prodinfo['pgoods_image_small'] ?>', zoomImage: '<?php echo $value['2'] ?>' " ></a>
                    </li>
                    <li><a href="javascript:;" >
                    <img title="鼠标滚轮向上或向下滚动，能放大或缩小图片哦~" class='cloudzoom-gallery' src="<?php echo $value['0'] ?>" data-cloudzoom="useZoom: '.cloudzoom', image: '<?php echo $prodinfo['pgoods_image_small'] ?>', zoomImage: '<?php echo $value['2'] ?>' " ></a>
                    </li>
                </ul>
            </div>
            <div id="lir">
                <a href="javascript:;"></a>
            </div> -->
    </div>
    
    <div class="info_r">
        <div class="prd_name">
            <p><?php echo $output['prodinfo']['pgoods_name'];?></p>
        </div>
        <div class="price">
            <p>积分&nbsp;:&nbsp;&nbsp;<span><?php echo $output['prodinfo']['pgoods_points']; ?><?php echo $lang['points_unit']; ?></span>
            </p>
            <p>价格&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;<span><del><strong><?php echo $lang['currency'].ncPriceFormat($output['prodinfo']['pgoods_price']); ?></strong></del></span></p>
            <?php if ($output['prodinfo']['pgoods_limitmgrade']){ ?>
            <p id="need_lv">所需级别&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;<span><?php echo $output['prodinfo']['pgoods_limitgradename'].'专享'; ?></span></p>
            <?php }else{?>
            <p id="need_lv">所需级别&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;<span>所有会员</span></p>
            <?php } ?>
            <?php if ($output['prodinfo']['pgoods_islimittime'] == 1){ ?>
            <p><?php echo $lang['pointprod_info_goods_limittime'].$lang['nc_colon']; ?>&nbsp;:&nbsp;&nbsp;
                <span>
                <?php if ($output['prodinfo']['pgoods_starttime'] && $output['prodinfo']['pgoods_endtime']){
                    echo @date('Y-m-d H:i:s',$output['prodinfo']['pgoods_starttime']).'&nbsp;'.$lang['pointprod_info_goods_limittime_to'].'&nbsp;'.@date('Y-m-d H:i:s',$output['prodinfo']['pgoods_endtime']);
                }?>
                </span>
            </p>
            <?php if ($output['prodinfo']['ex_state'] == 'going'){?>
            <p><span class="countdown"><?php echo $lang['pointprod_info_goods_lasttime']; ?>&nbsp;&nbsp;<i id="dhpd"><?php echo $output['prodinfo']['timediff']['diff_day']; ?></i> <?php echo $lang['pointprod_info_goods_lasttime_day']; ?> <i id="dhph"><?php echo $output['prodinfo']['timediff']['diff_hour']; ?></i> <?php echo $lang['pointprod_info_goods_lasttime_hour']; ?> <i id="dhpm"><?php echo $output['prodinfo']['timediff']['diff_mins']; ?></i> <?php echo $lang['pointprod_info_goods_lasttime_mins']; ?> <i id="dhps"><?php echo $output['prodinfo']['timediff']['diff_secs']; ?></i> <?php echo $lang['pointprod_info_goods_lasttime_secs']; ?></dd>
            </p>
            <?php } ?>
            <?php } ?>
        
        </div>
        <div>
            <ul>
                <li class="number">
                    <div>数量：</div>
                    <div class="range">
                        <div id="r_down"></div>
                        <div id="r_nub">1</div>
                        <div id="r_add"></div>
                        <!-- <span><?php echo $lang['pointprod_info_goods_lastnum'].$lang['nc_colon']; ?><?php echo $output['prodinfo']['pgoods_storage']; ?>
                        ）</span> -->
                        <input type="hidden" id="storagenum" value="<?php echo $output['prodinfo']['pgoods_storage']; ?>"/>
                       
                    </div>
                </li>
                <li class="number"><span>限量兑换：</span>
                 <?php if ($output['prodinfo']['pgoods_islimit'] == 1){?>
                        <div>
                          
                          <span><?php echo $lang['pointprod_info_goods_limitnum_tip1']; ?><?php echo $output['prodinfo']['pgoods_limitnum']; ?><?php echo $lang['pointprod_pointprod_unit']; ?>
                            <input type="hidden" id="limitnum" value="<?php echo $output['prodinfo']['pgoods_limitnum']; ?>"/>
                          </span>
                        </div>
                        <?php } else {?>
                        <input type="hidden" id="limitnum" value=""/>
                        <?php } ?>
                </li>
                <li class="server">
                    <span>服务承诺</span>
                    <div>
                        <a href="javascript:;"></a>
                        <a href="javascript:;"></a>
                        <a href="javascript:;"></a>
                    </div>
                </li>
            </ul>
            <!-- <div class="title">热门礼品</div>
                <div class="content">
                  <?php if (is_array($output['recommend_pointsprod']) && count($output['recommend_pointsprod'])>0){?>
                  <ul class="recommend">
                    <?php foreach ($output['recommend_pointsprod'] as $k=>$v){?>
                    <li>
                      <div class="gift-pic"><a target="_blank" href="<?php echo urlShop('pointprod', 'pinfo', array('id' => $v['pgoods_id']));?>" title="<?php echo $v['pgoods_name']; ?>"> <img src="<?php echo $v['pgoods_image'] ?>" alt="<?php echo $v['pgoods_name']; ?>" /> </a></div>
                      <div class="gift-name"><a href="<?php echo urlShop('pointprod', 'pinfo', array('id' => $v['pgoods_id']));?>" target="_blank" tile="<?php echo $v['pgoods_name']; ?>"><?php echo $v['pgoods_name']; ?></a></div>
                      <div class="pgoods-points"><?php echo $v['pgoods_points']; ?><?php echo $lang['points_unit']; ?><?php if (intval($v['pgoods_limitmgrade']) > 0){ ?>
                        <span><?php echo $v['pgoods_limitgradename']; ?>专享</span>
                        <?php } ?></div>
                    </li>
                    <?php } ?>
                  </ul>
                  <?php }else{?>
                  <div class="norecord"><?php echo $lang['pointprod_list_null'];?></div>
                  <?php }?>
                </div>
            </div>
            <div class="content">
              <dl>
                <dt><?php echo $lang['pointprod_info_goods_serial'].$lang['nc_colon']; ?></dt>
                <dd><?php echo $output['prodinfo']['pgoods_serial']; ?></dd>
              </dl>
              <dl>
                <dt>添加时间：</dt>
                <dd><?php echo @date('Y-m-d',$output['prodinfo']['pgoods_add_time']);?></dd>
              </dl>
              <dl>
                <dt>浏览人次：</dt>
                <dd><?php echo $output['prodinfo']['pgoods_view'];?></dd>
              </dl>
            </div>
            <?php if ($output['orderprod_list'] && is_array($output['orderprod_list'])){ ?>
            <ul class="ncp-exchangeNote">
                <h4>兑换记录</h4>
                <?php foreach ($output['orderprod_list'] as $v){ ?>
                <li>
                    <div class="user-avatar"><img src="<?php echo $v['member_avatar'];?>" /></div>
                    <div class="user-name"><?php echo str_cut($v['point_buyername'],'4').'***'; ?></div>
                    <div class="user-log"><?php echo date('Y-m-d',$v['point_addtime']);?> <?php echo $lang['pointprod_info_goods_alreadyexchange']; ?><strong><?php echo $v['point_goodsnum'];?></strong>件</div>
                </li>
                <?php } ?>
            </ul>
            <?php } ?>-->

            <div id="no_return">一旦兑换，积分会立即扣除并不再退回</div>

            <?php if ($output['prodinfo']['ex_state'] == 'willbe'){ ?>
            <a id="notbuy" class="no-buynow"><?php echo $lang['pointprod_willbe']; ?></a>
            <?php }elseif ($output['prodinfo']['ex_state'] == 'end') {?>
            <a id="notbuy" class="no-buynow"><?php echo $lang['pointprod_exchange_end']; ?></a>
            <?php }else{?>
            <a id="btn_once" class="buynow" onclick="return add_to_cart();" style="cursor:pointer;"><i class="ico"></i>立即兑换</a>
            <?php }?>
        </div>
     </div>
</div>

<div id="goods_des">
    <div id="goods_head">
        <div>商品描述</div>
        <div></div>
    </div>
    <div id="goods_content">
         <!-- <a id="tabGoodsIntro" href="#content"><?php echo $lang['pointprod_info_goods_description']; ?></a>  -->
         <?php echo $output['prodinfo']['pgoods_body']; ?>
    </div>
</div>
        
        

</div>
</div>
</div>
</div>
<script type="text/javascript" src="<?php echo SHOP_RESOURCE_SITE_URL;?>/js/home.js" id="dialog_js" charset="utf-8"></script>
<script id="bdshare_js" data="type=tools" ></script>
<script id="bdshell_js"></script>
<script>document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?t=" + new Date().getHours();</script>
<script>
var nub=1;
$("#r_down").on("click",function(){
    if(nub==1){
        return false;
    };
    nub--;
    $("#r_nub").html(nub);
            
            
});
    
$("#r_add").on("click",function(){
    nub++;
    $("#r_nub").html(nub);
        
})
 function copy_url()
 {
	 var txt = $("#shareurl").val();
	 if(window.clipboardData)
	    {
	        // the IE-manier
	        window.clipboardData.clearData();
	        window.clipboardData.setData("Text", txt);
	        alert("<?php echo $lang['pointprod_info_goods_urlcopy_succcess'];?>");
	    }
	    else if(navigator.userAgent.indexOf("Opera") != -1)
	    {
	        window.location = txt;
	        alert("<?php echo $lang['pointprod_info_goods_urlcopy_succcess'];?>");
	    }
	    else if (window.netscape)
	    {
	        // dit is belangrijk maar staat nergens duidelijk vermeld:
	        // you have to sign the code to enable this, or see notes below
	        try {
	            netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
	        } catch (e) {
	            alert("<?php echo $lang['pointprod_info_goods_urlcopy_fail'];?>!\n<?php echo $lang['pointprod_info_goods_urlcopy_fail1'];?>\'about:config\'<?php echo $lang['pointprod_info_goods_urlcopy_fail2'];?>\n<?php echo $lang['pointprod_info_goods_urlcopy_fail3'];?>\'signed.applets.codebase_principal_support\'<?php echo $lang['pointprod_info_goods_urlcopy_fail4'];?>\'true\'");
	            return false;
	        }
	        // maak een interface naar het clipboard
	        var clip = Components.classes['@mozilla.org/widget/clipboard;1'].createInstance(Components.interfaces.nsIClipboard);
	        if (!clip){return;}
	        // alert(clip);
	        // maak een transferable
	        var trans = Components.classes['@mozilla.org/widget/transferable;1'].createInstance(Components.interfaces.nsITransferable);
	        if (!trans){return;}
	        // specificeer wat voor soort data we op willen halen; text in dit geval
	        trans.addDataFlavor('text/unicode');
	        // om de data uit de transferable te halen hebben we 2 nieuwe objecten
	        // nodig om het in op te slaan
	        var str = new Object();
	        var len = new Object();
	        str = Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);
	        var copytext = txt;
	        str.data = copytext;
	        trans.setTransferData("text/unicode",str,copytext.length*2);
	        var clipid = Components.interfaces.nsIClipboard;
	        if (!clip){return false;}
	        clip.setData(trans,null,clipid.kGlobalClipboard);
	        alert("<?php echo $lang['pointprod_info_goods_urlcopy_succcess'];?>");
	    }
 }
function GetRTime2() //积分礼品兑换倒计时
{
   var rtimer=null;
   var startTime = new Date();
   var EndTime = <?php echo intval($output['prodinfo']['pgoods_endtime'])*1000;?>;
   var NowTime = new Date();
   var nMS =EndTime - NowTime.getTime();
   if(nMS>0)
   {
       var nD=Math.floor(nMS/(1000*60*60*24));
       var nH=Math.floor(nMS/(1000*60*60)) % 24;
       var nM=Math.floor(nMS/(1000*60)) % 60;
       var nS=Math.floor(nMS/1000) % 60;
       document.getElementById("dhpd").innerHTML=pendingzero(nD);
       document.getElementById("dhph").innerHTML=pendingzero(nH);
       document.getElementById("dhpm").innerHTML=pendingzero(nM);
       document.getElementById("dhps").innerHTML=pendingzero(nS);
       if(nS==0&&nH==0&&nM==0)
       {
          // document.getElementById("returntime").style.display='none';
           clearTimeout(rtimer2);
           window.location.href=window.location.href;
           return;
       }
       rtimer2=setTimeout("GetRTime2()",1000);
   }
}
GetRTime2();
function pendingzero(str)
{
   var result=str+"";
   if(str<10)
   {
       result="0"+str;
   }
   return result;
}
//加入购物车
function add_to_cart()
{
	var storagenum = parseInt($("#storagenum").val());//库存数量
	var limitnum = parseInt($("#limitnum").val());//限制兑换数量
	var quantity = parseInt($("#r_nub").html());//兑换数量
	//验证数量是否合法
	var checkresult = true;
	var msg = '';
	if(!quantity >=1 ){//如果兑换数量小于1则重新设置兑换数量为1
		quantity = 1;
	}
	if(limitnum > 0 && quantity > limitnum){
		checkresult = false;
		msg = '<?php echo $lang['pointprod_info_goods_exnummaxlimit_error']; ?>';
	}
	if(storagenum > 0 && quantity > storagenum){
		checkresult = false;
		msg = '<?php echo $lang['pointprod_info_goods_exnummaxlast_error']; ?>';
	}
	if(checkresult == false){
		alert(msg);
		return false;
	}else{
		$.getJSON('<?php echo SHOP_SITE_URL; ?>/index.php?model=pointcart&fun=add&pgid=<?php echo $output['prodinfo']['pgoods_id']; ?>&quantity='+quantity, function(result){
	        if(result.done){
	        	window.location.href = '<?php echo SHOP_SITE_URL; ?>/index.php?model=pointcart';
	        } else {
		        if(result.url){
		        	showDialog(result.msg, 'confirm', '', function(){
		        		window.location.href = result.url;
				    });
				} else {
					showDialog(result.msg);
			    }
	        }
	    });
	}
}
</script>
