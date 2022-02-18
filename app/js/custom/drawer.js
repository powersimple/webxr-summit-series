jQuery("#menu").click(function () {
    openDrawer()
  
});

jQuery("#menuclose").click(function () {
    jQuery(".appswitchdropdown").hide();
    jQuery(".sidedrawer").animate({
        left: -250,
        opacity: 1
    }, 300);
    jQuery("body").animate({
        marginLeft: 0,
    }, 300);
    jQuery("#menu").show();
    jQuery(this).hide();
});

jQuery(".appswitch").click(function () {
    jQuery(".appswitchdropdown").toggle();
});
jQuery(".page").hover(function () {
    jQuery(".appswitchdropdown").hide();
});
jQuery(".appconversation").click(function () {
    jQuery("#nav, .page, .sidedrawer,.appswitchdropdown").hide();
    jQuery(".convo").show();
    jQuery("body").css({
        marginLeft: 0,
    }, 500);
});

jQuery(".convo").click(function () {
    jQuery("#nav, .page, .sidedrawer,.appswitchdropdown").show();
    jQuery(".convo, .trendscontent ").hide();
    jQuery("body").css({
        marginLeft: 250,
    }, 500);
});

jQuery(".appstudio").click(function () {
    jQuery(".spark, .sparkcontent, .sparklist").hide();
    jQuery(".studio, .studiolist").show();
    jQuery('#logo').css('background-position', '0px 0px');
    jQuery('.appswitch').css('background-position', '0px 0px');
});



jQuery(".collapse").click(function () {
    jQuery(".collapse").hide();
    jQuery(".expand").show();
    jQuery('.sidedrawer').css('width', '60px');
    jQuery(".sparklist div, .appswitch").css({
        width: 50,
    }, 500);

    jQuery("body").animate({
        marginLeft: 60,
    }, 500);


});

jQuery(function () {
    jQuery("#accordion").accordion({
        autoHeight: true,
        heightStyle: "content" 
    });
});


jQuery(function () {
    jQuery("#nomineeAccordion").accordion({
        autoHeight: true,
        heightStyle: "content" 
    });
});

function openDrawer(){
    jQuery(".sidedrawer").animate({
        left: 0,
        opacity: 1,
        
    }, 500);
    jQuery("body").animate({
        
    }, 500);
    jQuery("#menuclose").show();
    jQuery(this).hide();
}
