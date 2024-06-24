jQuery(document).ready(function ($) {

    const servicesSwiper = new Swiper('#services-block .swiper', {
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 30,
            },
            992: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
        },
        pagination:{
            el: '#services-block .swiper-pagination',
        },
        navigation:{
            prevEl: '#services-block .swiper-btn-prev',
            nextEl: '#services-block .swiper-btn-next',
        }
    })

});