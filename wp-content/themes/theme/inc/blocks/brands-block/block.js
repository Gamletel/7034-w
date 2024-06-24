jQuery(document).ready(function($){

    const brandsSwiper = new Swiper('#brands-block .swiper',{
        breakpoints:{
            320:{
                slidesPerView: 2,
                spaceBetween: 15,
            },
            576:{
                slidesPerView: 3,
                spaceBetween: 15,
            },
            769:{
                slidesPerView: 4,
                spaceBetween: 15,
            },
            992:{
                slidesPerView: 5,
                spaceBetween: 30,
            },
        },
        navigation:{
            prevEl: '#brands-block .swiper-btn-prev',
            nextEl: '#brands-block .swiper-btn-next',
        },
        pagination:{
            el: '#brands-block .swiper-pagination',
        }
    })

});