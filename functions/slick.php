<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">


<style>
      </style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script>
$(document).ready(function() {

function setupHeroSlider() {
    var $slider = $('.hero-slideshow');
    var viewportWidth = $(window).width();
    
    // Check if slick has been initialized, and unslick it
    if ($slider.hasClass('slick-initialized')) {
        $slider.slick('unslick');
    }

    var slideHTML = '';
    hero_slides.forEach(function (slide) {
        var imageUrl =
            viewportWidth > 1600
                ? slide.full
                : viewportWidth > 1200
                ? slide.xl
                : viewportWidth > 1024
                ? slide.lg
                : viewportWidth > 768
                ? slide.md_lg
                : viewportWidth > 576
                ? slide.md_lg
                : slide.md_lg;

        slideHTML +=
            '<div class="slide-container">' +
            '<div class="slide" style="background-image: url(' + imageUrl + ');">' +
            '<div class="slide-content">' +
            '<h2>' + slide.title + '</h2>' +
            '<p class="caption">' + slide.caption + '</p>' +
            '<p>' + slide.description + '</p>' +
            
            '</div>' +
            '</div>' +
            '</div>';
    });

    $slider.html(slideHTML);  // Setting the HTML of the slider

    // Waiting a bit before initializing slick
    setTimeout(function(){
        $slider.slick({
            dots: true,
            arrows: true,
            autoplay: true,
            autoplaySpeed: 5000,
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            adaptiveHeight: true,
            arrows: true,
          
            prevArrow: '<button type="button" class="slick-prev">&larr;</button>',
            nextArrow: '<button type="button" class="slick-next">&rarr;</button>',
        });
    }, 100);
}

// Call the function right away
setupHeroSlider();
function debounce(func, wait, immediate) {
    var timeout;
    return function() {
        var context = this, args = arguments;
        var later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
};

var resized = debounce(function() {
    setupHeroSlider();
}, 250);

$(window).on('resize', resized);
// On resize, run the function again
$(window).on('resize', function() {
    if ($slider.hasClass('slick-initialized')) {
        $slider.slick('unslick');
    }
    setupHeroSlider();
});

});


  </script>
