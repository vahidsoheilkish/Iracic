
$(document).ready(function () {


});

$(document).on("click", "#tab-button > .col", function () {
    $("#tab-button >.col").removeClass("active");
    $(this).addClass("active");
    //$("#tab-content >.col-12").removeClass("active");
    //var elm = "#" + $(this).attr("for");
    //$(elm).addClass("active");

    //$("#tab-content >.col-12").removeClass("active");
    $("#tab-content >.col-12").slideUp(250);
    var elm = "#" + $(this).attr("for");
    $(elm).fadeIn(500);
});


