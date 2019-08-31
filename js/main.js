function get_data(data) {
    var a = $.ajax(data["url"], {

        async: false,

        method: "POST",

        data: data["formData"],

        processData: false,

        contentType: false,

        xhrFields: {
            // 'Access-Control-Allow-Credentials: true'.
            withCredentials: false
        },
        headers: {
            "Access-Control-Allow-Origin": true
        },
        success: function (response) {
            data["success"]();
        },
        error: function (response) {
            data["fail"]();
        }
    });

    return JSON.parse(a.responseText);
}
function make_result_card(data) {
    return `
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">` + data["titre"] + `</h5>
            <p class="card-text">
                <p class="class">CLASS :(` + data["category"] + `)</p>
                <p class="pub">Publisher:` + data["publisher"] + ` | ISSN: ` + data["issn"] + `, ESSN : ` + data["essn"] + `</p>
            </p>
            <a href="` + data["url"] + `"
                class="card-link">Magazine home page</a>
        </div>
    </div>`;
}
$(document).ready(function () {
    let searchParams = new URLSearchParams(window.location.search)
    let q = searchParams.get('q');
    let formData = new FormData();
    formData.append('query', q);
    formData.append('action', "r");
    var t0 = performance.now();
    let r = get_data({
        "url": "http://127.0.0.1/TheSearch/api.php",
        "formData": formData,
        "success": function () {},
        "fail": function () {}
    });
    var t1 = performance.now();
    let s = "";
    for (let index = 0; index < r["data"].length; index++) {
        s += make_result_card(r["data"][index]);
    }
    $("input#search-input").val(q);
    
    $(".countntime").html( "About " + r["count"] + " results (" + Number( (t1 - t0)/1000 ).toFixed(3) + " seconds)");

    $(".search_resutls").html(s);


    "use strict";
    var window_width = $(window).width(),
        window_height = window.innerHeight,
        header_height = $(".default-header").height(),
        header_height_static = $(".site-header.static").outerHeight(),
        fitscreen = window_height - header_height;

    $(".fullscreen").css("height", window_height)
    $(".fitscreen").css("height", fitscreen);

    new WOW().init();
    if (document.getElementById("default-select")) {
        $('select').niceSelect();
    };

    $('.img-pop-up').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true
        }
    });
    $('.play-btn').magnificPopup({
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });
    $('#back-top a').on("click", function () {
        $('body,html').animate({
            scrollTop: 0
        }, 1000);
        return false;
    });
    $('.counter').counterUp({
        delay: 10,
        time: 1000
    });
    $('.nav-menu').superfish({
        animation: {
            opacity: 'show'
        },
        speed: 400
    });
    if ($('#nav-menu-container').length) {
        var $mobile_nav = $('#nav-menu-container').clone().prop({
            id: 'mobile-nav'
        });
        $mobile_nav.find('> ul').attr({
            'class': '',
            'id': ''
        });
        $('body').append($mobile_nav);
        $('body').prepend('<button type="button" id="mobile-nav-toggle"><i class="lnr lnr-menu"></i></button>');
        $('body').append('<div id="mobile-body-overly"></div>');
        $('#mobile-nav').find('.menu-has-children').prepend('<i class="lnr lnr-chevron-down"></i>');
        $(document).on('click', '.menu-has-children i', function (e) {
            $(this).next().toggleClass('menu-item-active');
            $(this).nextAll('ul').eq(0).slideToggle();
            $(this).toggleClass("lnr-chevron-up lnr-chevron-down");
        });
        $(document).on('click', '#mobile-nav-toggle', function (e) {
            $('body').toggleClass('mobile-nav-active');
            $('#mobile-nav-toggle i').toggleClass('lnr-cross lnr-menu');
            $('#mobile-body-overly').toggle();
        });
        $(document).click(function (e) {
            var container = $("#mobile-nav, #mobile-nav-toggle");
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                if ($('body').hasClass('mobile-nav-active')) {
                    $('body').removeClass('mobile-nav-active');
                    $('#mobile-nav-toggle i').toggleClass('lnr-cross lnr-menu');
                    $('#mobile-body-overly').fadeOut();
                }
            }
        });
    } else if ($("#mobile-nav, #mobile-nav-toggle").length) {
        $("#mobile-nav, #mobile-nav-toggle").hide();
    }
    $('.nav-menu a, #mobile-nav a, .scrollto').on('click', function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            if (target.length) {
                var top_space = 0;
                if ($('#header').length) {
                    top_space = $('#header').outerHeight();
                    if (!$('#header').hasClass('header-fixed')) {
                        top_space = top_space;
                    }
                }
                $('html, body').animate({
                    scrollTop: target.offset().top - top_space
                }, 1500, 'easeInOutExpo');
                if ($('body').hasClass('mobile-nav-active')) {
                    $('body').removeClass('mobile-nav-active');
                    $('#mobile-nav-toggle i').toggleClass('lnr-times lnr-bars');
                    $('#mobile-body-overly').fadeOut();
                }
                return false;
            }
        }
    });
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('#header').addClass('header-scrolled');
            $('#back-top').fadeIn(500);
        } else {
            $('#header').removeClass('header-scrolled');
            $('#back-top').fadeOut(500);
        }
    });
    $(window).scroll(function () {
        if ($(this).scrollTop() > 10) {
            $('#back-top').fadeIn(500);
        } else {
            $('#back-top').fadeOut(500);
        }
    });
    if ($('.testi-slider').length) {
        $('.testi-slider').owlCarousel({
            loop: true,
            margin: 30,
            items: 1,
            nav: false,
            autoplay: 2500,
            smartSpeed: 1500,
            dots: true,
            responsiveClass: true,
            thumbs: true,
            thumbsPrerendered: true,
            navText: ["<i class='lnr lnr-arrow-left'></i>", "<i class='lnr lnr-arrow-right'></i>"]
        })
    }
    if (document.getElementById("map")) {
        google.maps.event.addDomListener(window, 'load', init);

        function init() {
            var mapOptions = {
                zoom: 11,
                center: new google.maps.LatLng(40.6700, -73.9400),
                styles: [{
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#e9e9e9"
                    }, {
                        "lightness": 17
                    }]
                }, {
                    "featureType": "landscape",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#f5f5f5"
                    }, {
                        "lightness": 20
                    }]
                }, {
                    "featureType": "road.highway",
                    "elementType": "geometry.fill",
                    "stylers": [{
                        "color": "#ffffff"
                    }, {
                        "lightness": 17
                    }]
                }, {
                    "featureType": "road.highway",
                    "elementType": "geometry.stroke",
                    "stylers": [{
                        "color": "#ffffff"
                    }, {
                        "lightness": 29
                    }, {
                        "weight": 0.2
                    }]
                }, {
                    "featureType": "road.arterial",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#ffffff"
                    }, {
                        "lightness": 18
                    }]
                }, {
                    "featureType": "road.local",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#ffffff"
                    }, {
                        "lightness": 16
                    }]
                }, {
                    "featureType": "poi",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#f5f5f5"
                    }, {
                        "lightness": 21
                    }]
                }, {
                    "featureType": "poi.park",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#dedede"
                    }, {
                        "lightness": 21
                    }]
                }, {
                    "elementType": "labels.text.stroke",
                    "stylers": [{
                        "visibility": "on"
                    }, {
                        "color": "#ffffff"
                    }, {
                        "lightness": 16
                    }]
                }, {
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "saturation": 36
                    }, {
                        "color": "#333333"
                    }, {
                        "lightness": 40
                    }]
                }, {
                    "elementType": "labels.icon",
                    "stylers": [{
                        "visibility": "off"
                    }]
                }, {
                    "featureType": "transit",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#f2f2f2"
                    }, {
                        "lightness": 19
                    }]
                }, {
                    "featureType": "administrative",
                    "elementType": "geometry.fill",
                    "stylers": [{
                        "color": "#fefefe"
                    }, {
                        "lightness": 20
                    }]
                }, {
                    "featureType": "administrative",
                    "elementType": "geometry.stroke",
                    "stylers": [{
                        "color": "#fefefe"
                    }, {
                        "lightness": 17
                    }, {
                        "weight": 1.2
                    }]
                }]
            };
            var mapElement = document.getElementById('map');
            var map = new google.maps.Map(mapElement, mapOptions);
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(40.6700, -73.9400),
                map: map,
                title: 'Snazzy!'
            });
        }
    }
    $('#mc_embed_signup').find('form').ajaxChimp();
});