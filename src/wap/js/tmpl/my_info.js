$(function(){
    if (getQueryString('key') != '') {
        var key = getQueryString('key');
        var username = getQueryString('username');
        addCookie('key', key);
        addCookie('username', username);
    } else {
        var key = getCookie('key');
    }
    if(!key){
        window.location.href = WapSiteUrl+'/tmpl/member/login.html';
    }



    var calendar = new LCalendar();
    calendar.init({
        'trigger': '#demo1', //标签id
        'type': 'date', //date 调出日期选择 datetime 调出日期时间选择 time 调出时间选择 ym 调出年月选择,
        'minDate': '1900-1-1', //最小日期
        'maxDate': new Date().getFullYear() + '-' + (new Date().getMonth() + 1) + '-' + new Date().getDate() //最大日期
    });
    // var calendardatetime = new LCalendar();
    // calendardatetime.init({
    //     'trigger': '#demo2',
    //     'type': 'datetime'
    // });
    // var calendartime = new LCalendar();
    // calendartime.init({
    //     'trigger': '#demo3',
    //     'type': 'time'
    // });
    // var calendarym = new LCalendar();
    // calendarym.init({
    //     'trigger': '#demo4',
    //     'type': 'ym',
    //     'minDate': '1900-1',
    //     'maxDate': new Date().getFullYear() + '-' + (new Date().getMonth() + 1)
    // });

	// var currYear = (new Date()).getFullYear(); 
 //            var opt={};
 //            opt.date = {preset : 'date'};
 //            opt.datetime = {preset : 'datetime'};
 //            opt.time = {preset : 'time'};
 //            opt.default = {
 //                theme: 'android-ics light', //皮肤样式
 //                display: 'modal', //显示方式 
 //                mode: 'scroller', //日期选择模式
 //                dateFormat: 'yyyy-mm-dd',
 //                lang: 'zh',
 //                showNow: true,
 //                nowText: "今天",
 //                startYear: currYear - 100, //开始年份
 //                endYear: currYear + 10, //结束年份
 //                headerText: function (valueText) { //自定义弹出框头部格式  
 //                    array = valueText.split('/');  
 //                    console.log(array[0] );
 //                     $("#birthsday").val(array[0]);
 //                    // return array[0] + "年" + array[1] + "月";  
 //                }  
 //            };

            // $("#appDate").mobiscroll($.extend(opt['date'], opt['default']));
            // var optDateTime = $.extend(opt['datetime'], opt['default']);
            // var optTime = $.extend(opt['time'], opt['default']);
            // $("#appDateTime").mobiscroll(optDateTime).datetime(optDateTime);
            // $("#appTime").mobiscroll(optTime).time(optTime);
        $.ajax({
            type:'post',
            url:ApiUrl+"/index.php?model=member_index",
            data:{key:key},
            dataType:'json',
            success:function(result){
                // console.log(result.datas);
                checkLogin(result.login);
                if(result.datas.member_info.level_name == 'V1'){
                    var level = '普通会员';
                }else if(result.datas.member_info.level_name == 'V2'){
                    var level = '黄金会员';
                }else if(result.datas.member_info.level_name == 'V3'){
                    var level = '白金会员';
                }else{
                    var level = '钻石会员';
                }
                if(result.datas.member_info.member_sex == '1'){
                    var sex = '男';
                }else if(result.datas.member_info.member_sex == '2'){
                    var sex = '女';
                }else{
                    var sex = '保密';
                }
                $("#demo1").val(result.datas.member_info.member_birthday);
                var avatar = '<img src="' + result.datas.member_info.avatar + '"/>';
                $("#img_tx").html(avatar);
                $("#member_truename").val(result.datas.member_info.member_truename);
                $("#member_areainfo").val(result.datas.member_info.member_areainfo);
                $("#member_zipcode").val(result.datas.member_info.member_zipcode);

                $("#member_sex").find('option[value="'+result.datas.member_info.member_sex+'"]').attr("selected",true);
                $("#member_email").val(result.datas.member_info.member_email);
                $("#member_mobile").val(result.datas.member_info.member_mobile);
               
               

                $('#area_info').val(result.datas.member_info.member_areainfo).attr({'data-areaid':result.datas.member_info.member_areaid, 'data-areaid2':result.datas.member_info.member_cityid});
            }
        });
	
    $('#submit').click(function(){
        // var datas = $('#formpost').serialize();
        // console.log(datas);
        // return false;
        var member_truename = $('#member_truename').val();
        var birthday = $('#birthday').val();
        var member_sex = $('#member_sex').val();
        // var member_areainfo = $('#member_areainfo').val();
        var member_zipcode = $('#member_zipcode').val();
        var member_email = $('#member_email').val();
        var member_mobile = $('#member_mobile').val();
        var city_id = $('#area_info').attr('data-areaid2');
        var area_id = $('#area_info').attr('data-areaid');
        var provinceid = $('#provinceid').val();
        var region = $('#region').val();

        if(member_zipcode.length > 0){
            if(isNaN(member_zipcode) || member_zipcode.length != 6){
                errorTipsShow('<p>邮政编码格式错误</p>');
                return false;
            }
        }
        if(member_email.length > 0){
            if(!checkEmail(member_email)){
                errorTipsShow('<p>邮箱格式错误</p>');
                return false;
            }
        }
        if(member_mobile.length > 0){
            if(!checkMobile(member_mobile)){
                errorTipsShow('<p>手机格式错误</p>');
                return false;
            }
        }

        $.ajax({
                type:'post',
                url:ApiUrl+"/index.php?model=member_index&fun=member",
                data: {
                    key: key,
                    member_truename: member_truename,
                    birthday: birthday,
                    city_id: city_id,
                    area_id: area_id,
                    member_sex: member_sex,
                    member_zipcode:member_zipcode,
                    member_email:member_email,
                    member_mobile: member_mobile,
                    provinceid:provinceid,
                    region:region,
                    form_submit:'ok'
                },
                dataType:'json',
                
                beforeSend: function () {
                    // 禁用按钮防止重复提交
                    $("#submit").prop( "disabled",true );
                },
                success:function(result){
                    // console.log(result);
                    // return false;
                    if(result.code == 200){
                        // $.sDialog({
                        //     skin:"block",
                        //     content:'Save successfully',
                        //     okBtn:false,
                        //     cancelBtn:false
                        // });
                        errorTipsShow('<p>修改成功</p>');
                        setTimeout("location.href = WapSiteUrl+'/tmpl/member/member.html'",3000);
                    }else{
                        errorTipsShow('<p>' + result.datas.error + '</p>');
                    }
                },
                complete: function () {
                    $("#submit").prop("disabled",false);
                },
                // complete: function(){ 
                //     $('#nextform').attr('onclick','javascript:void();');
                // }
        });
    });
    // 选择地区
    $('#se_di').on('click', '#area_info', function(){
        $.areaSelected({
            success : function(data){
                $('#area_info').val(data.area_info).attr({'data-areaid':data.area_id, 'data-areaid2':(data.area_id_2 == 0 ? data.area_id_1 : data.area_id_2)});
            }
        });
    });


    function checkEmail(str){
      var re = /^(\w-*\.*)+@(\w-?)+(\.\w{2,})+$/
      if(re.test(str)){
        return true;
      }else{
        return false;
      }
    }   
    function checkMobile(str) {
      var re = /^1\d{10}$/
      if (re.test(str)) {
        return true;
      } else {
        return false;
      }
    }

});