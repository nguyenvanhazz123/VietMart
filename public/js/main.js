/*--------------------------------------------------
Template Name: Truemart;
Description: Responsive Html5 Ecommerce Template;
Template URI:;
Author Name: HasTech;
Author URI:;
Version: 1.0;

NOTE: main.js, All custom script and plugin activation script in this file. 
-----------------------------------------------------

    JS INDEX
    ================================================
    1. Newsletter Popup
    2. Mobile Menu Activation
    3. Tooltip Activation
    4.1 Vertical-Menu Activation
    4.2 Category menu Activation
    4.3 Checkout Page Activation
    5. NivoSlider Activation
    6. Hot Deal Product Activation
    7. Brand Banner Activation
    8. Electronics Product Activation
    9. Best Seller Product Activation
    10. Like Product Activation
    11. Second Hot Deal Product Activation
    12. Side Product Activation
    13. Thumbnail Product activation
    14. Countdown Js Activation
    15. ScrollUp Activation
    16. Sticky-Menu Activation
    17. Nice Select Activation
    18. Price Slider Activation
    
================================================*/

(function ($) {
    "use Strict";
    /*--------------------------
    1. Newsletter Popup
    ---------------------------*/
    setTimeout(function () {
        $('.popup_wrapper').css({
            "opacity": "1",
            "visibility": "visible"
        });
        $('.popup_off').on('click', function () {
            $(".popup_wrapper").fadeOut(500);
        })
    },700000);

    /*----------------------------
    2. Mobile Menu Activation
    -----------------------------*/
    jQuery('.mobile-menu nav').meanmenu({
        meanScreenWidth: "991",
    });

    /*----------------------------
    3. Tooltip Activation
    ------------------------------ */
    $('.pro-actions a,.quick_view').tooltip({
        animated: 'fade',
        placement: 'top',
        container: 'body'
    });

    /*----------------------------
    4.1 Vertical-Menu Activation
    -----------------------------*/
    $('.categorie-title,.mobile-categorei-menu').on('click', function () {
        $('.vertical-menu-list,.mobile-categorei-menu-list').slideToggle();
    });

    /*------------------------------
     4.2 Category menu Activation
    ------------------------------*/
    $('#cate-toggle li.has-sub>a,#cate-mobile-toggle li.has-sub>a,#shop-cate-toggle li.has-sub>a').on('click', function () {
        $(this).removeAttr('href');
        var element = $(this).parent('li');
        if (element.hasClass('open')) {
            element.removeClass('open');
            element.find('li').removeClass('open');
            element.find('ul').slideUp();
        } else {
            element.addClass('open');
            element.children('ul').slideDown();
            element.siblings('li').children('ul').slideUp();
            element.siblings('li').removeClass('open');
            element.siblings('li').find('li').removeClass('open');
            element.siblings('li').find('ul').slideUp();
        }
    });
    $('#cate-toggle>ul>li.has-sub>a').append('<span class="holder"></span>');

    /*----------------------------
    4.3 Checkout Page Activation
    -----------------------------*/
    $('#showlogin').on('click', function () {
        $('#checkout-login').slideToggle();
    });
    $('#showcoupon').on('click', function () {
        $('#checkout_coupon').slideToggle();
    });
    $('#cbox').on('click', function () {
        $('#cbox_info').slideToggle();
    });
    $('#ship-box').on('click', function () {
        $('#ship-box-info').slideToggle();
    });

    /*----------------------------
    5. NivoSlider Activation
    -----------------------------*/
    $('#slider').nivoSlider({
        effect: 'random',
        animSpeed: 300,
        pauseTime: 5000,
        directionNav: true,
        manualAdvance: true,
        controlNavThumbs: false,
        pauseOnHover: true,
        controlNav: false,
        prevText: "<i class='lnr lnr-arrow-left'></i>",
        nextText: "<i class='lnr lnr-arrow-right'></i>"
    });

    /*----------------------------------------------------
    6. Hot Deal Product Activation
    -----------------------------------------------------*/
    $('.hot-deal-active').owlCarousel({
        loop: false,
        nav: true,
        dots: false,
        smartSpeed: 1500,
        navText: ["<i class='lnr lnr-arrow-left'></i>", "<i class='lnr lnr-arrow-right'></i>"],
        margin: 10,
        responsive: {
            0: {
                items: 1,
                autoplay: true,
                smartSpeed: 500
            },
            480: {
                items: 2
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            },
            1200: {
                items: 5
            }
        }
    })
    $('.hot-deal-active3').owlCarousel({
        loop: false,
        nav: true,
        dots: false,
        smartSpeed: 1500,
        navText: ["<i class='lnr lnr-arrow-left'></i>", "<i class='lnr lnr-arrow-right'></i>"],
        margin: 10,
        responsive: {
            0: {
                items: 1,
                autoplay: true,
                smartSpeed: 500
            },
            480: {
                items: 1
            },
            768: {
                items: 1
            },
            992: {
                items: 1
            },
            1200: {
                items: 1
            }
        }
    })

    /*----------------------------------------------------
    7. Brand Banner Activation
    -----------------------------------------------------*/
    $('.brand-banner').owlCarousel({
        loop: true,
        nav: true,
        autoplay: true,
        dots: false,
        navText: ["<i class='lnr lnr-arrow-left'></i>", "<i class='lnr lnr-arrow-right'></i>"],
        smartSpeed: 1200,
        margin: 0,
        responsive: {
            0: {
                items: 1,
                autoplay: true,
                smartSpeed: 500
            },
            380: {
                items: 2
            },
            768: {
                items: 3
            },
            1000: {
                items: 3
            }
        }
    })
    $('.brand-banner-sidebar').owlCarousel({
        loop: true,
        nav: false,
        autoplay: true,
        dots: false,
        navText: ["<i class='lnr lnr-arrow-left'></i>", "<i class='lnr lnr-arrow-right'></i>"],
        smartSpeed: 1200,
        margin: 0,
        responsive: {
            0: {
                items: 1,
                autoplay: true,
                smartSpeed: 500
            },
            380: {
                items: 2
            },
            768: {
                items: 2
            },
            1000: {
                items: 2
            }
        }
    })
    
    /*----------------------------------------------------
    8. Electronics Product Activation
    -----------------------------------------------------*/
    $('.electronics-pro-active')
        .on('changed.owl.carousel initialized.owl.carousel', function (event) {
            $(event.target)
                .find('.owl-item').removeClass('last')
                .eq(event.item.index + event.page.size - 1).addClass('last');
        }).owlCarousel({
            loop: false,
            nav: true,
            dots: false,
            smartSpeed: 1000,
            navText: ["<i class='lnr lnr-arrow-left'></i>", "<i class='lnr lnr-arrow-right'></i>"],
            margin: 10,
            responsive: {
                0: {
                    items: 1,
                    autoplay: true,
                    smartSpeed: 500
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                },
                1200: {
                    items: 3
                }
            }
        })

    $('.electronics-pro-active2')
        .on('changed.owl.carousel initialized.owl.carousel', function (event) {
            $(event.target)
                .find('.owl-item').removeClass('last')
                .eq(event.item.index + event.page.size - 1).addClass('last');
        }).owlCarousel({
            loop: false,
            nav: true,
            dots: false,
            smartSpeed: 1000,
            navText: ["<i class='lnr lnr-arrow-left'></i>", "<i class='lnr lnr-arrow-right'></i>"],
            margin: 10,
            responsive: {
                0: {
                    items: 1,
                    autoplay: true,
                    smartSpeed: 500
                },
                768: {
                    items: 2
                },
                992: {
                    items: 2
                },
                1200: {
                    items: 3
                }
            }
        })
    
    /*----------------------------------------------------
    9. Best Seller Product Activation
    -----------------------------------------------------*/
    $('.best-seller-pro-active').owlCarousel({
        loop: false,
        nav: true,
        dots: false,
        smartSpeed: 1500,
        navText: ["<i class='lnr lnr-arrow-left'></i>", "<i class='lnr lnr-arrow-right'></i>"],
        margin: 10,
        responsive: {
            0: {
                items: 1,
                autoplay: true,
                smartSpeed: 500
            },
            450: {
                items: 2
            },
            768: {
                items: 3
            },
            992: {
                items: 4
            },
            1200: {
                items: 5
            }
        }
    })
    $('.trending-pro-active').owlCarousel({
        loop: false,
        nav: false,
        dots: true,
        smartSpeed: 1500,
        navText: ["<i class='lnr lnr-arrow-left'></i>", "<i class='lnr lnr-arrow-right'></i>"],
        margin: 10,
        responsive: {
            0: {
                items: 1,
                autoplay: true,
                smartSpeed: 500
            },
            450: {
                items: 2
            },
            768: {
                items: 3
            },
            992: {
                items: 4
            },
            1200: {
                items: 5
            }
        }
    })
    
    /*----------------------------------------------------
    10. Like Product Activation
    -----------------------------------------------------*/
    $('.like-pro-active').owlCarousel({
        loop: false,
        nav: false,
        dots: true,
        smartSpeed: 1500,
        navText: ["<i class='lnr lnr-arrow-left'></i>", "<i class='lnr lnr-arrow-right'></i>"],
        margin: 10,
        responsive: {
            0: {
                items: 1,
                autoplay: true,
                smartSpeed: 500
            },
            450: {
                items: 2
            },
            768: {
                items: 3
            },
            992: {
                items: 4
            },
            1200: {
                items: 5
            }
        }
    })

    /*----------------------------------------------------
    11. Second Hot Deal Product Activation
    -----------------------------------------------------*/
    $('.second-hot-deal-active').on('changed.owl.carousel initialized.owl.carousel', function (event) {
        $(event.target)
            .find('.owl-item').removeClass('last')
            .eq(event.item.index + event.page.size - 1).addClass('last');
    }).owlCarousel({
        loop: false,
        nav: true,
        dots: false,
        smartSpeed: 1500,
        navText: ["<i class='lnr lnr-arrow-left'></i>", "<i class='lnr lnr-arrow-right'></i>"],
        margin: 0,
        responsive: {
            0: {
                items: 1,
                autoplay: true,
                smartSpeed: 500
            },
            768: {
                items: 1
            },
            992: {
                items: 2
            },
            1200: {
                items: 2
            }
        }
    })

    /*----------------------------------------------------
    12. Side Product Activation
    -----------------------------------------------------*/
    $('.side-product-active').owlCarousel({
        loop: false,
        nav: false,
        dots: false,
        smartSpeed: 1500,
        navText: ["<i class='lnr lnr-arrow-left'></i>", "<i class='lnr lnr-arrow-right'></i>"],
        margin: 0,
        responsive: {
            0: {
                items: 1,
                autoplay: true,
                smartSpeed: 500
            },
            450: {
                items: 1
            },
            768: {
                items: 1
            },
            1200: {
                items: 1
            }
        }
    })
        
    /*----------------------------------------------------
    12. New Product Tow For Home-2 Activation
    -----------------------------------------------------*/
    $('.latest-blog-active').owlCarousel({
        loop: false,
        nav: false,
        dots: true,
        smartSpeed: 1500,
        navText: ["<i class='lnr lnr-arrow-left'></i>", "<i class='lnr lnr-arrow-right'></i>"],
        margin: 20,
        responsive: {
            0: {
                items: 1,
                autoplay: true,
                smartSpeed: 500
            },
            450: {
                items: 1
            },
            768: {
                items: 1
            },
            992: {
                items: 2
            },
            1200: {
                items: 2
            }
        }
    })

    /*-------------------------------------
    13. Thumbnail Product activation
    --------------------------------------*/
    $('.thumb-menu').owlCarousel({
        loop: false,
        navText: ["<i class='lnr lnr-arrow-left'></i>", "<i class='lnr lnr-arrow-right'></i>"],
        margin: 15,
        smartSpeed: 1000,
        nav: true,
        dots: false,
        responsive: {
            0: {
                items: 3,
                autoplay: true,
                smartSpeed: 500
            },
            768: {
                items: 3
            },
            1000: {
                items: 3
            }
        }
    })
    $('.thumb-menu a').on('click', function () {
        $('.thumb-menu a').removeClass('active');
    })
    
    /*----------------------------
    14. Countdown Js Activation
    -----------------------------*/
    $('[data-countdown]').each(function () {
        var $this = $(this),
            finalDate = $(this).data('countdown');
        $this.countdown(finalDate, function (event) {
            $this.html(event.strftime('<div class="count"><p>%D</p> <span>Days</span></div><div class="count"><p>%H</p> <span>Hours</span></div><div class="count"><p>%M</p> <span>Mins</span></div><div class="count"> <p>%S</p> <span>Secs</span></div>'));
        });
    });

    /*----------------------------
    15. ScrollUp Activation
    -----------------------------*/
    $.scrollUp({
        scrollName: 'scrollUp', // Element ID
        topDistance: '550', // Distance from top before showing element (px)
        topSpeed: 1000, // Speed back to top (ms)
        animation: 'fade', // Fade, slide, none
        scrollSpeed: 900,
        animationInSpeed: 1000, // Animation in speed (ms)
        animationOutSpeed: 1000, // Animation out speed (ms)
        scrollText: '<i class="fa fa-angle-double-up" aria-hidden="true"></i>', // Text for element
        activeOverlay: false // Set CSS color to display scrollUp active point, e.g '#00FFFF'
    });

    /*----------------------------
    16. Sticky-Menu Activation
    ------------------------------ */
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.header-sticky').addClass("sticky");
        } else {
            $('.header-sticky').removeClass("sticky");
        }
    });
    
    /*----------------------------
    17. Nice Select Activation
    ------------------------------ */
    $('select').niceSelect();
    
    /*----------------------------
    18. Price Slider Activation
    -----------------------------*/
    const form = document.getElementById('price-filter-form');
    const minPriceInput = document.getElementById('min-price');
    const maxPriceInput = document.getElementById('max-price');
    
    $("#slider-range").slider({
        range: true,
        min: 0,
        max: 1000000,
        values: [0, 1000000],
        slide: function(event, ui) {
            const minPrice = ui.values[0];
            const maxPrice = ui.values[1];
            $("#amount").val(minPrice + "đ" + " - " + maxPrice + "đ");
            minPriceInput.value = minPrice;
            maxPriceInput.value = maxPrice;
        }
    });

    form.addEventListener('submit', function(event) {

        event.preventDefault();
        // Lấy giá trị min_price và max_price từ form
        var minPrice = minPriceInput.value;
        var maxPrice = maxPriceInput.value;

        // Cập nhật URL với giá trị min_price và max_price mới
        var newURL = updateQueryStringParameter(window.location.href, 'min_price', minPrice);
        newURL = updateQueryStringParameter(newURL, 'max_price', maxPrice);

        var segmentId = getUrlParameter('segment');
        var orderby = getUrlParameter('order_by');
        var keyword = getUrlParameter('keyword');

        if (segmentId) {
            newURL = updateQueryStringParameter(newURL, 'segment', segmentId);
        }
        if (orderby) {
            newURL = updateQueryStringParameter(newURL, 'order_by', orderby);
        }
        if (keyword) {
            newURL = updateQueryStringParameter(newURL, 'keyword', keyword);
        }

        // Sử dụng API History để thay đổi URL trên thanh địa chỉ mà không làm mới trang
        history.pushState(null, '', newURL);
        console.log(newURL);
        // Gửi yêu cầu Ajax để tải sản phẩm theo các giá trị min_price và max_price mới
        loadProductsByCategoryAndSort(getUrlParameter('segment'), getUrlParameter('order_by'), minPrice, maxPrice, getUrlParameter('keyword'));
    });
    
    $( "#amount" ).val($( "#slider-range" ).slider( "values", 0 ) + "đ" +
      " - " + $( "#slider-range" ).slider( "values", 1 ) + "đ" );

    function loadProductsByCategoryAndSort(segmentId, sortOption, minPrice, maxPrice, keyword) {
        var url = industryListURL;
        var filters = {};
        if (segmentId) {
            filters.segment = segmentId;
        }
        if (sortOption) {
            filters.orderby = sortOption;
        }
        if (minPrice) {
            filters.min_price = minPrice;
        }
        if (maxPrice) {
            filters.max_price = maxPrice;
        }
        if (keyword) {
            filters.keyword = keyword;
        }

        $.ajax({
            url: url,
            type: "GET",
            data: filters,
            dataType: 'json',
            success: function (data) {
                // Cập nhật container danh sách sản phẩm với nội dung mới
                $('#product-list-container').html(data);
            },
            error: function (xhr, status, error) {
                // Xử lý lỗi nếu cần thiết
            }
        });
    }
     // Hàm cập nhật tham số trong URL
     function updateQueryStringParameter(url, key, value) {
        var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
        var separator = url.indexOf('?') !== -1 ? "&" : "?";
        if (url.match(re)) {
            return url.replace(re, '$1' + key + "=" + value + '$2');
        } else {
            return url + separator + key + "=" + value;
        }
    }

    // Hàm lấy giá trị tham số từ URL
    function getUrlParameter(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        var results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    }
    /*--------------------------
         banner colse Popup
    ---------------------------*/
        $('.popup_off_banner').on('click', function () {
            $(".popup_banner").fadeOut(500);
        })

})(jQuery);
