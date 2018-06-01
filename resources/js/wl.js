/*Nav Bar*/
function checkScroll(){
    var startY = $('.navbar').height(); //The point where the navbar changes in px

    if($(window).scrollTop() > startY){
        $('.navbar').addClass("scrolled");
    }else{
        $('.navbar').removeClass("scrolled");
    }
}
if($('.navbar').length > 0){
    $(window).on("scroll load resize", function(){
        checkScroll();
    });
}/*Change Color*/

$('.smooth-scroll').click(function () {
    var aTag = $(this).attr('href');
    $('html,body').animate({
        scrollTop: $(aTag).offset().top
    }, 600);

    return false;
});