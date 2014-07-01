if ($(window).width() > 480) {
    $(document).ready(function () {
        // cache the window object
        $window = $(window);

        $('section[data-type="background"]').each(function () {
            // declare the variable to affect the defined data-type
            var $scroll = $(this);

            $(window).scroll(function () {
                // also, negative value because we're scrolling upwards
                var yPos = -($window.scrollTop() / $scroll.data('speed'));

                // background position
                var coords = '50% ' + yPos + 'px';

                // move the background
                $scroll.css({ backgroundPosition: coords });
            }); // end window scroll
        });  // end section function
    }); // close out script
}(jQuery)
;