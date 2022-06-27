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
        infinite: false,
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

    (function () {
        const second = 1000,
            minute = second * 60,
            hour = minute * 60,
            day = hour * 24;

        //end
        let dayEnd = '06/28/2022';

        const countDown = new Date(dayEnd).getTime(),
            x = setInterval(function () {

                const now = new Date().getTime(),
                    distance = countDown - now;

                document.getElementById("days").innerText = Math.floor(distance / (day)),
                    document.getElementById("hours").innerText = Math.floor((distance % (day)) / (hour)),
                    document.getElementById("minutes").innerText = Math.floor((distance % (hour)) / (minute)),
                    document.getElementById("seconds").innerText = Math.floor((distance % (minute)) / second);

                //do something later when date is reached
                if (distance < 0) {
                    document.querySelector(".countdown__group").style.display = "none";
                    document.querySelector(".countdown__end-time-ct").style.display = "block";
                    clearInterval(x);
                }
                //seconds
            }, 0)
    }());
})(jQuery)