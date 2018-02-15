$(function () {

    animations();
    fullScreenContainer();
    sliders();
    utils();
    sliding();
    $('.form_datetime').datetimepicker({
        useCurrent: false
    });
    
    $('#start_date_hours').datetimepicker();
    $('#end_date_hours').datetimepicker({
        useCurrent: false //Important! See issue #1075
    });
    $("#start_date_hours").on("dp.change", function (e) {
        $('#end_date_hours').data("DateTimePicker").minDate(e.date);
    });
    $("#end_date_hours").on("dp.change", function (e) {
        $('#start_date_hours').data("DateTimePicker").maxDate(e.date);
    });
});
$(window).load(function () {
    windowWidth = $(window).width();
    $(this).alignElementsSameHeight();

});
$(window).resize(function () {

    newWindowWidth = $(window).width();

    if (windowWidth !== newWindowWidth) {
        setTimeout(function () {
            $(this).alignElementsSameHeight();
            fullScreenContainer();
            waypointsRefresh();
        }, 205);
        windowWidth = newWindowWidth;
    }

});


/* =========================================
 * sliders 
 *  =======================================*/

function sliders() {
    if ($('.owl-carousel').length) {

        $(".testimonials").owlCarousel({
            items: 4,
            itemsDesktopSmall: [1170, 3],
            itemsTablet: [970, 2],
            itemsMobile: [750, 1]
        });
    }

}


/* =========================================
 *  animations
 *  =======================================*/

function animations() {
    if (Modernizr.csstransitions) {
        delayTime = 0;
        $('[data-animate]').css({opacity: '0'});
        $('[data-animate]').waypoint(function (direction) {
            delayTime += 150;
            $(this).delay(delayTime).queue(function (next) {
                $(this).toggleClass('animated');
                $(this).toggleClass($(this).data('animate'));
                delayTime = 0;
                next();
                //$(this).removeClass('animated');
                //$(this).toggleClass($(this).data('animate'));
            });
        },
                {
                    offset: '95%',
                    triggerOnce: true
                });
        $('[data-animate-hover]').hover(function () {
            $(this).css({opacity: 1});
            $(this).addClass('animated');
            $(this).removeClass($(this).data('animate'));
            $(this).addClass($(this).data('animate-hover'));
        }, function () {
            $(this).removeClass('animated');
            $(this).removeClass($(this).data('animate-hover'));
        });
    }

}

/* =========================================
 * sliding 
 *  =======================================*/

function sliding() {
    $('.scrollTo, #navigation a').click(function (event) {
        // this is been commented out that we can make the links
        // work on the home page nav bar
        //event.preventDefault();
        var full_url = this.href;
        var parts = full_url.split("#");
        var trgt = parts[1];

        $('body').scrollTo($('#' + trgt), 800, {offset: -80});

    });
}

/* =========================================
 * full screen intro 
 *  =======================================*/

function fullScreenContainer() {

    var screenWidth = $(window).width() + "px";
    var screenHeight = '';
    if ($(window).width() > 1000) {
        screenHeight = $(window).height() + "px";
    }
    else {
        screenHeight = "auto";
    }


    $("#intro, #intro .item").css({
        width: screenWidth,
        height: screenHeight
    });
}


/* =========================================
 *  UTILS
 *  =======================================*/

function utils() {

    /* tooltips */

    $('[data-toggle="tooltip"]').tooltip();

    /* external links in new window*/

    $('.external').on('click', function (e) {

        e.preventDefault();
        window.open($(this).attr("href"));
    });
    /* animated scrolling */

}

$.fn.alignElementsSameHeight = function () {
    $('.same-height-row').each(function () {

        var maxHeight = 0;
        var children = $(this).find('.same-height');
        children.height('auto');
        if ($(window).width() > 768) {
            children.each(function () {
                if ($(this).innerHeight() > maxHeight) {
                    maxHeight = $(this).innerHeight();
                }
            });
            children.innerHeight(maxHeight);
        }

        maxHeight = 0;
        children = $(this).find('.same-height-always');
        children.height('auto');
        children.each(function () {
            if ($(this).height() > maxHeight) {
                maxHeight = $(this).innerHeight();
            }
        });
        children.innerHeight(maxHeight);
    });
}

/* refresh scrollspy */
function scrollSpyRefresh() {
    setTimeout(function () {
        $('body').scrollspy('refresh');
    }, 1000);
}

/* refresh waypoints */
function waypointsRefresh() {
    setTimeout(function () {
        $.waypoints('refresh');
    }, 1000);
}
