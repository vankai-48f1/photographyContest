(function ($) {
    $('.submission__list-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        dots: false,
        responsive: [
            {
                breakpoint: 900,
                settings: {
                    // arrows: false,
                    slidesToShow: 2,
                    // dots: true
                }
            },
            {
                breakpoint: 576,
                settings: {
                    autoplay: true,
                    slidesToShow: 1
                }
            }
        ]
    });

    $('.btn-login-close').on('click', function () {
        $('.homepage-login-ctn').addClass('login-hidden')
    })


    // slide submission image
    $('.submission-detail__slider-single').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: false,
        adaptiveHeight: true,
        infinite: false,
        useTransform: true,
        speed: 400,
        cssEase: 'cubic-bezier(0.77, 0, 0.18, 1)',
        asNavFor: '.submission-detail__slider-nav'
    });

    $('.submission-detail__slider-nav').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.submission-detail__slider-single',
        dots: false,
        arrows: true,
        focusOnSelect: true,
        responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
            }
        }, {
            breakpoint: 640,
            settings: {
                slidesToShow: 2,
            }
        }]
    });

    // $('.submission-detail__slider-nav')
    //     .on('init', function (event, slick) {
    //         $('.submission-detail__slider-nav .slick-slide.slick-current').addClass('is-active');
    //     })
    //     .slick({
    //         slidesToShow: 4,
    //         slidesToScroll: 4,
    //         dots: false,
    //         arrows: false,
    //         focusOnSelect: false,
    //         infinite: false,
    //         responsive: [{
    //             breakpoint: 1024,
    //             settings: {
    //                 slidesToShow: 3,
    //                 slidesToScroll: 3,
    //             }
    //         }, {
    //             breakpoint: 640,
    //             settings: {
    //                 slidesToShow: 2,
    //                 slidesToScroll: 2,
    //             }
    //         }]
    //     });

    // $('.submission-detail__slider-single').on('afterChange', function (event, slick, currentSlide) {
    //     $('.submission-detail__slider-nav').slick('slickGoTo', currentSlide);
    //     var currrentNavSlideElem = '.submission-detail__slider-nav .slick-slide[data-slick-index="' + currentSlide + '"]';
    //     $('.submission-detail__slider-nav .slick-slide.is-active').removeClass('is-active');
    //     $(currrentNavSlideElem).addClass('is-active');
    // });

    // $('.submission-detail__slider-nav').on('click', '.slick-slide', function (event) {
    //     event.preventDefault();
    //     var goToSingleSlide = $(this).data('slick-index');

    //     $('.submission-detail__slider-single').slick('slickGoTo', goToSingleSlide);
    // });
})(jQuery)