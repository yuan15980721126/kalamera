$(function () {
    //$("#b_top").load("../commonhead2.html");
    //$("#z_bottom").load("../bottom.html");


    $(".myd").hover(function () {
        $(".hidden").show()
    }, function () {

        $(".hidden").hide();


    });

    $(".mbo").hover(function () {
        $(".phonema").show()
    }, function () {

        $(".phonema").hide();


    });


    $("#allshop").hover(function () {
        $(".shop_hidden").show()
    }, function () {

        $(".shop_hidden").hide();


    });


    $(".fullSlide").hover(function () {
            $(this).find(".prev,.next").stop(true, true).fadeTo("show", 0.5)
        },
        function () {
            $(this).find(".prev,.next").fadeOut()
        });


    $(".fx").hover(function () {
        $(".fx_hidden").show()
    }, function () {

        $(".fx_hidden").hide();


    });


    function imgReload() {

        var imgHeight = 0;

        var wtmp = $("body").width();

        $("#b06 ul li").each(function () {

            $(this).css({width: wtmp + "px"});

        });

        $(".sliderimg").each(function () {

            $(this).css({width: wtmp + "px"});

            imgHeight = $(this).height();

        });

    }


    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        paginationClickable: true,
        prevButton: '.swiper-button-prev',
        nextButton: '.swiper-button-next',
        loop: true,
        autoplay: 4000
    });

    $("#nav1").hover(function () {
        $(this).find("img").prop("src", "/skins/default/img/qwe_03.jpg");


    }, function () {
        $(this).find("img").prop("src", "/skins/default/img/nav1_34.jpg");

    });

    $("#nav2").hover(function () {
        $(this).find("img").prop("src", "/skins/default/img/qe2_05.jpg");


    }, function () {
        $(this).find("img").prop("src", "/skins/default/img/nav2_36.jpg");

    });


    $("#nav3").hover(function () {
        $(this).find("img").prop("src", "/skins/default/img/qe3_07.jpg");


    }, function () {
        $(this).find("img").prop("src", "/skins/default/img/nav3_38.jpg");

    });


    $("#nav4").hover(function () {
        $(this).find("img").prop("src", "/skins/default/img/qe4_09.jpg");


    }, function () {
        $(this).find("img").prop("src", "/skins/default/img/nav4_40.jpg");

    });
    $("#nav5").hover(function () {
        $(this).find("img").prop("src", "/skins/default/img/qe5_15.jpg");


    }, function () {
        $(this).find("img").prop("src", "/skins/default/img/nav6_46.jpg");

    });
    $("#nav6").hover(function () {
        $(this).find("img").prop("src", "/skins/default/img/qe6_16.jpg");


    }, function () {
        $(this).find("img").prop("src", "/skins/default/img/nav5_46.jpg");

    });
    $("#nav7").hover(function () {
        $(this).find("img").prop("src", "/skins/default/img/qe7_17.jpg");


    }, function () {
        $(this).find("img").prop("src", "/skins/default/img/nav6_47.jpg");

    });
    $("#nav8").hover(function () {
        $(this).find("img").prop("src", "/skins/default/img/qe8_18.jpg");


    }, function () {
        $(this).find("img").prop("src", "/skins/default/img/nav8_48.jpg");

    });


})








