/**menu**/
$(document).ready(function(){
    var touch 	= $('#resp-menu');
    var menu 	= $('.menu');

    $(touch).on('click', function(e) {
        e.preventDefault();
        menu.slideToggle();
    });

    $(window).resize(function(){
        var w = $(window).width();
        if(w > 767 && menu.is(':hidden')) {
            menu.removeAttr('style');
        }
    });

});
/******************************************************/
$("#mycarousel").carousel(
    {
        wrap: false,
    });

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


/***accordian***/
function toggleIcon(e) {
    $(e.target)
        .prev('.panel-heading')
        .find(".more-less")
        .toggleClass('fa-chevron-down fa-chevron-up');
}
$('.panel-group').on('hidden.bs.collapse', toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);


/***************tooltip************************/
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});

/***************changgefontawesome*************/
function myFunction(x) {
    x.classList.toggle("fa-chevron-down");
    x.classList.toggle("fa-chevron-left");
}

/***pagination****/
$('.pagination-inner a').on('click', function() {
    $(this).siblings().removeClass('pagination-active');
    $(this).addClass('pagination-active');
})










