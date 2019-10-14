<?php defined('interMarket') or exit('Access Invalid!'); ?>
<style type="text/css">
    #is_default {
        width: 12px;
        height: 12px;
    }

    .save_address {
        background: #ff7800;
        color: #fff;
        width: 100px;
        height: 34px;
        border: none;
        border-radius: 3px;
    }

    #reset {
        background: #cccccc;
        color: #fff;
        width: 50px;
        height: 34px;
        border: none;
        border-radius: 3px;
    }

    #addr_form label.error {
        position: static;
    !important;
        color: red;
    }
</style>




<form method="POST" id="address_form_<?php echo $output['address_info']['address_id'];?>" action="index.php">
    <div class="padding-t-15">
        <span class="sec_t inline_b padding-right-7_5">Edit Shipping Address</span>
        <span class="inline_b"><span class="red">*</span> Fields are required</span>
    </div>
    <input type="hidden" value="buy" name="model">
    <input type="hidden" value="edit_addr" name="fun">
    <input type="hidden" name="form_submit" value="ok"/>
    <ul class="ul_two_col">
        <li>
            <p class="label_txt">
                First name <span class="red">*</span>
            </p>
            <input type="hidden"  name="address_id" id="address_id1" value="<?php echo $output['address_info']['address_id'];?>"/>

            <?php if(strpos($output['address_info']['true_name'], "-")) {?>
            <input class="name info_firstName" type="text"  name="firstName" id="firstName"
                   value="<?php echo substr($output['address_info']['true_name'], 0, strpos($output['address_info']['true_name'], "-")); ?>"/>
            <?php }else{?>
                <input class="name info_firstName" type="text"  name="firstName" id="firstName"
                       value="<?php echo $output['address_info']['true_name']; ?>"/>
            <?php }?>
        </li>
        <li>
            <p class="label_txt">
                Last name <span class="red">*</span>
            </p>
            <?php if(strpos($output['address_info']['true_name'], "-")) {?>
            <input class="name info_lastName" type="text" name="lastName" id="lastName"
                   value="<?php echo substr($output['address_info']['true_name'], strripos($output['address_info']['true_name'], "-") + 1); ?>"/>
            <?php }else{?>
                <input class="name info_lastName" type="text" name="lastName" id="lastName"
                       value=""/>
            <?php }?>
        </li>
    </ul>
    <p class="label_txt">
        Company Name
    </p>
    <input type="text" name="company" class="info_company" value="<?php echo $output['address_info']['company']; ?>">
    <p class="label_txt">
        Street Address <span class="red">*</span>
    </p>
    <input class="text info_address" type="text" name="address"
           value="<?php echo $output['address_info']['address']; ?>"/>
    <p class="label_txt">
        Apartment,suite,etc:
    </p>
    <input type="text" class="info_apartment" name="apartment" value="<?php echo $output['address_info']['apartment']; ?>">

<!--    <p class="label_txt">-->
<!--        City <span class="red">*</span>-->
<!--    </p>-->
<!--    <input type="text" class="info_city" name="city" class="required info_city">-->
    <p class="label_txt">
        ZIP code <span class="red">*</span>
    </p>
    <input type="text" name="zipcode" class="required info_zipcode" value="<?php echo $output['address_info']['zipcode']; ?>">

    <p class="label_txt">
        Location : <span
                class="red">*</span>
    </p>
    <ul class="ul_three_col">
        <li>
            <input type="hidden" name="region" id="region"
                value="<?php echo $output['address_info']['area_info']; ?>">
            <input type="hidden" name="area_id" class="js_area_1" value="<?php echo $output['address_info']['area_id']; ?>" id="_area"  />
            <input type="hidden" name="city_id" class="js_area_3" value="<?php echo $output['address_info']['city_id']; ?>" id="_area_2" />
        </li>
    </ul>
    <p class="label_txt">
        Phone Number <span class="red">*</span> Needed for delivery
        purposes
    </p>
    <input type="text" class="required info_mob_phone" name="mob_phone" value="<?php echo $output['address_info']['mob_phone']; ?>"/>

    <p class="label_txt">
        <input type="checkbox"
               class="preferred-addr" <?php if ($output['address_info']['is_default']) echo 'checked'; ?>
               name="is_default" id="is_default" value="1">Set as my preferred shipping address
    </p>
    <div class="text-center padding-t-25 border-black-t">
        <input type="button"   id="save_address_<?php echo $output['address_info']['address_id'];?>" value="Save save_address" class="save"/>
    </div>
</form>


<script type="text/javascript">
    var address_id = '<?php echo $output["address_info"]["address_id"];?>'
    $(document).ready(function () {
        //var address_id = '<?php //echo $output["address_info"]["address_id"];?>//'
        $("#region").nc_region();
        $('#address_form_'+address_id).validate({
            rules: {
                firstName : {
                    required : true,
                    minlength: 3,
                    maxlength: 50
                },
                lastName : {
                    required : true,
                    minlength: 3,
                    maxlength: 50
                },
                company: {
                    required: true
                },
                address: {
                    required: true,
                },
                apartment: {
                    required: true,
                },
                mob_phone: {
                    required: check_phone,
                    minlength: 10,
                    maxlength: 10,
                },
                region: {
                    checklast: true
                },
                zipcode: {
                    required: true,
                }
            },
            messages: {
                firstName  : {
                    required : '<i class="icon-exclamation-sign"></i>First Name cannot be empty',
                    minlength: '<i class="icon-exclamation-sign"></i>First Name length should be between 3 and 50 characters',
                    maxlength: '<i class="icon-exclamation-sign"></i>First Name length should be between 3 and 50 characters'
                },
                lastName  : {
                    required : '<i class="icon-exclamation-sign"></i>last Name cannot be empty',
                    minlength: '<i class="icon-exclamation-sign"></i>last Name length should be between 3 and 50 characters',
                    maxlength: '<i class="icon-exclamation-sign"></i>last Name length should be between 3 and 50 characters'
                },
                company: {
                    required: 'Please enter the company name' ,
                },
                address: {
                    required: 'Please enter street address',
                },
                apartment: {
                    required: 'Please enter the name of the apartment',
                },
                mob_phone: {
                    required: 'Please enter your telephone number',
                    minlength: 'Incorrect mobile phone number',
                    maxlength: 'Incorrect mobile phone number'
                },
                region : {
                    checklast : 'Please select the area completely'
                },

                zipcode: {
                    required: 'Postal code cannot be empty',
                }
            },
            groups: {
                phone: 'mob_phone'
            }
        });
    });
    function check_phone() {
        return ($('input[name="tel_phone"]').val() == '' && $('input[name="mob_phone"]').val() == '');
    }

    $('#huan').click(function () {
        $('#zjy').hide();
        $('#sqs').show();
        $('._area_2').remove();
        $('._area').remove();
    })
    $("#add_close").on("click", function () {

        $("#save_harvest").hide();

    })

    function checkPhone() {
        return ($('input[name="mob_phone"]').val() == '' && $('input[name="tel_phone"]').val() == '');
    }



    $('#save_address_'+address_id).on('click', function () {
        if ($("#sqs").is(":hidden")) {
            $("#sqs").remove();
            var status = 1;
        }else{
            var status = 0;
        }
        var li_id = $('#address_id1').val();
        var cityid = $('#_area_2').val()
        var areaid = $('#_area').val()

        submitAddAddr(li_id, status,cityid,areaid);
    })

    function submitAddAddr(li_id, status,cityid='',areaid='') {
        // $('#input_chain_id').val('');chain_id = '';
        var address_id = '<?php echo $output["address_info"]["address_id"];?>'
        if ($('#address_form_'+address_id).valid()) {


            $('#buy_city_id').val($('#region').fetch('area_id_2'));
            var datas = $('#address_form_'+address_id).serialize();

            $('#address_form_'+address_id).remove();
            // return false;

            $.post('index.php', datas, function (data) {
                if (data.state) {
                    console.log(data);
                    var parent = '#li_' + li_id;

                    var true_name = data.data.true_name;
                    var firstName = data.data.firstName;
                    var lastName = data.data.lastName;
                    var apartment = data.data.apartment;
                    var company = data.data.company;
                    var is_default = data.data.is_default;

                    var info_address = data.data.address;
                    var info_area_info = data.data.area_info;
                    var info_phone = data.data.mob_phone;
                    var addr_id = data.data.address_id;
                    var city_id = data.data.city_id;
                    var area_id = data.data.area_id;
                    var zipcode = data.data.zipcode;


                    // console.log(parent);
                    // console.log($(parent).find('.cancel_btn'));
                    $('#slideToggle_'+li_id).slideToggle();
                    $(parent).find('.edit_btn').addClass('cancel_btn')
                    $(parent).find('.edit_btn').text('Eidt');

                    var new_address =  $(parent).find('.desc')
                    new_address.empty();

                    if (data.data.is_default == '1') {
                        $('.address_li').removeClass('addli_active');

                        $(this).addClass('addli_active').find('input[nc_type="addr"]').prop('checked', true);
                        if ($(this).attr('id') == 'new') {
                            $('#add_addr_box').load(SITEURL + '/index.php?model=buy&fun=add_addr');
                            $('#hide_addr_list').hide();
                        } else {
                            $('#add_addr_box').html('');
                            $('#hide_addr_list').show();
                        }

                    } else {
                        // $(parent).removeClass('info_current');
                    }


                    $("#save_harvest").hide();
                    // var area_id_2_val = $('#_area_2').val();
                    // var area_id_val = $('#_area').val();
                    // if (status == 1) {
                    //     var area_id_2_val = $('._area_2').val();
                    //     var area_id_val = $('._area').val();
                    // } else {
                    //     var area_id_2_val = $('#region_add').fetch('area_id_2');
                    //     var area_id_val = $('#region_add').fetch('area_id');
                    // }
                    // console.log($('#_area_2').val());

                    showShippingPrice(cityid, areaid);

                    hideAddrList(addr_id, city_id, area_id, firstName, lastName, info_area_info, info_address,info_phone, zipcode,is_default);

                } else {
                    alert(data.msg);
                }
            }, 'json');
        } else {
            return false;
        }
    }

</script>