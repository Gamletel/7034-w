jQuery(document).ready(function($){

    const gallerySwiper = new Swiper('#gallery-block .swiper', {
        slidesPerView: 2,
        breakpoints:{
            320:{
                spaceBetween: 15,
            },
            769:{
                spaceBetween: 30,
            }
        },
        navigation:{
            prevEl: '#gallery-block .swiper-btn-prev',
            nextEl: '#gallery-block .swiper-btn-next',
        },
        pagination:{
            el: '#gallery-block .swiper-pagination',
        },
    })

});