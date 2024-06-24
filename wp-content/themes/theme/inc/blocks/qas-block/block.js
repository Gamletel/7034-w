jQuery(document).ready(function($){

    const qas = $('#qas-block .qa');
    qas.click(function () {
        let answer = $(this).find('.answer');

        $(this).toggleClass('active').siblings().removeClass('active');
        answer.slideToggle();
    })

    const hiddenQas = $('#qas-block .qa.was-hidden');
    const qasLoadmore = $('#qas-block .loadmore');
    qasLoadmore.click(function () {
        hiddenQas.each(function () {
            $(this).toggle();
        })
    })

});