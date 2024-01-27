$(document).ready(function () {

    $(window).scroll(function () {
        $('.navbar').toggleClass('scrolMenu', $(this).scrollTop() > 88);
    });


    $("#call_zakaz").submit(function (e) {

        e.preventDefault();
        $("#call_zakaz").attr("aria-disabled", true).addClass("disabled");
        return true;

    });

    if (screen.width < 960) {
        $("#deleteMM").toggleClass("dropdown");
    }


});