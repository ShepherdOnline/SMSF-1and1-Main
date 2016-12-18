(function ($) {
    $(document).ready(function () {
        var thisOpen = false;
        $('.contact-form .form-control').each(function () {
            if ($(this).val().length > 0) {
                thisOpen = true;
                $('.g-recaptcha').css('display', 'block').delay(1000).css('opacity', '1');
                return false;
            }
        });
        if (thisOpen == false && (typeof $('.contact-form textarea').val() != 'undefined') && ($('.contact-form textarea').val().length > 0)) {
            thisOpen = true;
            $('.g-recaptcha').css('display', 'block').delay(1000).css('opacity', '1');
        }
        $('.contact-form input, .contact-form textarea').focus(function () {
            if (!$('.g-recaptcha').hasClass('recaptcha-display')) {
                $('.g-recaptcha').css('display', 'block').delay(1000).css('opacity', '1');
            }
        });
    });
})(jQuery);