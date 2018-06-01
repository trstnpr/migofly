// $('#under_construction').modal('show');

// START Navbar Transitions
// $(function () {
//     $(document).scroll(function () {
//         var $nav = $('.navbar');

//         $nav.toggleClass(
//             'scrolled',
//             $(this).scrollTop() > $nav.height()
//         );
//     });
// });
// END Navbar Transitions

// START Full Load Render
window.onload = function () {
    $('body').show();
}
// END Full Load Render

// START Tooltip
$('[data-toggle="tooltip"]').tooltip(); 
// END Tooltip

// START Attribute for background images
$('.data-img').each(function() {
    var attr = $(this).attr('data-bg');
    if (typeof attr !== typeof undefined && attr !== false) {
        $(this).css('background-image', 'url('+attr+')');
    }
});
// END Attribute for background images

// START Contact Us
$('.form-contact').on('submit', function(e) {
    e.preventDefault();

    var contact_form = $(this);
    var contact_action = contact_form.data('action');
    var contact_trigger = $('.btn-send');
    
    $.ajax({
        url: contact_action,
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            contact_trigger.html('Sending ...');
        },
        error: function(data){
            if(data.readyState == 4){
                errors = JSON.parse(data.responseText);
            }
        },
        success: function(data) {
            var msg = JSON.parse(data);
            if(msg.result == 'success'){
                alertify.success(msg.message);
                contact_trigger.html('Send&nbsp;&nbsp;<i class="fa fa-paper-plane">');
                contact_form[0].reset();
                grecaptcha.reset();
                location.reload();
            } else {
                alertify.error(msg.message);
                contact_trigger.html('Send&nbsp;&nbsp;<i class="fa fa-paper-plane">');
                contact_form[0].reset();
                grecaptcha.reset();
            }
        }
    });

});
// END Contact Us

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