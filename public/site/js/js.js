var myFunction = function(){
    var top = (window.pageYOffset);
    if(top > 69)
    {
        $('.navbar-default-custom').addClass('navbar-fixed-top');
        $('#showcase').css('margin-top','70px');
    }else{
        $('.navbar-default-custom').removeClass('navbar-fixed-top');
        $('#showcase').css('margin-top','');
    }
};


var mySwiper = new Swiper ('.swiper-container', {
    pagination: '.swiper-pagination',
    slidesPerView: 4,
    paginationClickable: true,
    spaceBetween: 10,
    direction: 'vertical',

    nextButton: '.swiper-button-next',
    prevButton: '.swiper-button-prev'  
});



$(document).ready(function(){
    $(".owl-carousel").owlCarousel({
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                nav:false
            },
            600:{
                items:3,
                nav:true,
                loop:true
            },
                1000:{
                items:5,
                nav:true,
                loop:true
            }
        }
    });

    /* jqzoom product */
    $('.jqzoom').jqzoom();
    var options = {  
        zoomType: 'standard',  
        lens:false,  
        zoomWidth:10,
        zoomHeight:10
    };
    $('.jqzoom').jqzoom(options); 


    $("#change-pass").click(function(){
        if($(this).is(":checked")){
            $(".form-pass-change").css("display","block");
        }else{
            $(".form-pass-change").css("display","none");
        }
    });

});



