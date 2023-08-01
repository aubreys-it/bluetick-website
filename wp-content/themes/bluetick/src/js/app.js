(function ($, undefined) { 
    "use strict";
    var win;
    var ww;
    var wh;
    var st;
    var $document = $(document);
    var $site_header = $(".site-header");
    var $content_wrapper = $(".content-wrapper");
    var $body = $("body");
    var hh;
    var bedroom_filter = 0;
    var previous_bedroom_filter;
    
    $(window).load(function () {

        "use strict";    

        /// hide preloader

        TweenMax.to($("#preloader #preloader-status"), .3, {
            css: {
                opacity: 0
            },
            ease: Linear.easeNone,
            onComplete: function () {
                
            }
        });

        TweenLite.to($("#preloader"), .3, {
            css: {
                opacity: 0
            },
            ease: Linear.easeNone,
            delay: .3,
            onComplete: function () {
                (this.target).hide();
                
            }
        });
         
    });

    $(document).ready(function () {

        win = $(window);
        ww = win.width();
        wh = win.height();
        st = win.scrollTop();

        jQuery('.home-slider').slick({
         dots : true,
         arrows: true,
         slidesToShow: 1,
         slidesToScroll: 1,
         speed: 800,
         infinite: true,
         autoplay: true,
         pauseOnFocus: false,
         pauseOnHover: false,
         prevArrow: $('.gallery-prev'),
         nextArrow: $('.gallery-next'),
        }); 

        $(window).resize();
    });

    
    $(window).resize(function () {

        win = $(window);
        ww = win.width();
        wh = win.height();
        st = win.scrollTop();
        hh = jQuery('.site-header').height();
        
    });   

})(jQuery); 


