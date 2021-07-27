var gotoslide = function(slide){
  //console.log("click on slick dot ", slide);
   setSlideContent(notch, menus['wheel-menu'].linear_nav[slide].object_id)
    $( '.slideshow' ).slickGoTo(parseInt(slide));
}

jQuery('.slick-dots li button').on('click', function (e) {
   e.stopPropagation(); // use this
  //console.log("slick dot clicked")
});

function setSlideShow(menu){
  jQuery('.slideshow').slick({
  //	autoplay: true,
    dots: false,
    arrows: true,
    infinite: true,
    speed: 1000,
    fade: true,
    cssEase:  'linear',
    focusoOnSelect: true,
    //nextArrow: '<i class="slick-arrow slick-next"></i>',
    //prevArrow: '<i class="slick-arrow slick-prev"></i>',
  });

   //console.log("set slideshow")
}
function setSlide(slide,id){
  /*
  these carousel slides are created here, but their content is populated dynamically
  because it was unreliable populating the content in a loop
  see setSlideContent in app.js
  */
  slide = '\n<div><div id="slide'+id+'" data-id="'+id+'" class="slide-wrap">'
  slide += '\n\t<h2></h2>'
  slide += '\n\t<div class="img-wrap"></div>'
  slide += '\n\t<section><div class="content"></div></section>'
  slide +='\n</div></div>\n';
  return slide
}

function setSlides(m){
  var id="0"
  var content = ''
  var title = ''
  var slides = ''
//console.log("Begin Render Slides",m,"|")
 
  if(posts == undefined){
    //console.log("No Posts Data Yet",  posts)
    window.setTimeout(setSlides(m), 100);//without this, we cannot relay that the post data is available yet
  } else {
  
  for(i=0;menus[m].linear_nav[i];i++){
    //console.log("slides", menus[m].linear_nav[i])
     id = menus[m].linear_nav[i].object_id.toString()
  
      slides += setSlide(i,id)
   
  }
 //console.log("slides rendered",slides)

  jQuery('#'+m+'-content').html(slides);
 
  }
}

var $carousel = jQuery('.slideshow');
jQuery(document).on('keydown', function(e) {
    if(e.keyCode == 37) {
        $carousel.slick('slickPrev');
    }
    if(e.keyCode == 39) {
        $carousel.slick('slickNext');
    }
});

jQuery('a[data-slide]').click(function(e) {
       // console.log("click on slick dot ", slide);
  e.preventDefault();
  var slide = jQuery(this).data('slide');
  //console.log("click on slick dot ", slide);
  setSlideContent(notch, menus['wheel-menu'].linear_nav[slide].object_id)
  //$carousel.slick('slickGoTo', slideno);

});