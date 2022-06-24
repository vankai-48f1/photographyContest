(function ($) {
    $('.submission__list').slick({
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
    })
})(jQuery)