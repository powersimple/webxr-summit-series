var     last_orientation = '',
        o = getOrientation()



jQuery(document).ready(function() {

    openDrawer()
    $("body").css("margin-left:0px !important") //RUDE HACK
    reposition_screen()
    setCountdown()
});

function setCountdown(){
  
    $('#polyscountdown').countdown('2023/03/05 17:00:00 ', function(event) {
        $(this).html(event.strftime('The show starts in %D Days %Hh %Mm'));
      });
    /*  $('#nominationcountdown').countdown('2023/01/01', function(event) {
        $(this).html(event.strftime('%D Days %Hh %Mm to the Nomination Deadline'));
      });*/
}
$( window ).scroll(function() {
    pinFooter()

})
function pinFooter(){
    return false;
}
function getOrientation(){
    
    
    o ={}
    o._w = jQuery(window).width()
    o._h = jQuery(window).height()



    if (o._w > o._h) {
        o.increment = 'vh'
        o.oriented = 'landscape'
            // orientation_last = 'horizontal'
    } else {
        o.increment = 'vw'
        o.oriented = 'portrait'
            //orientation_last = 'vertical'
    }
   
    if(last_orientation != o.oriented){
        last_orientation = o.oriented
        console.log("orientation chaaaged to",last_orientation)
    }

    o.aspect = o._w / o._h
    
    console.log("o",o,screen.orientation)
    
    return o
}


$(window).resize(function() {
   
    reposition_screen()

});

function reposition_screen() {
 //   console.clear();
    o = getOrientation();
    if(o.oriented == 'landscape'){
        $("#main").toggleClass("landscape")
    } 
    

    $('footer').css('bottom','0px')
  
    
}





(function() {
    'use strict';
    // this function is strict...
}());
var menu = {},
    this_item = {}



function getVideo() {

    if (pages[active_id] != undefined) {
        if(pages[active_id].post_media != undefined){
            var featured_video = pages[active_id].post_media.featured_video
            if (featured_video.length > 0) {
                for (i = 0; i < featured_video.length; i++) {
                    setVideoPath(pages[active_id].post_media.featured_video[0].full_path);
                }
            }
        }

    }

}


var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
    return false;
};


function setVideoPath(video_path) {
   // console.log('set video', video_path)
    jQuery("#bg-video" + ' video source').attr("src", video_path);
}
var maxHeight = $(window).height() - $('#nomination-ballot').offset();
$('#nomination-ballot').css({ "max-height" :maxHeight})

var hide_social_icons = getUrlParameter('hide-social-icons')
var event_class = ''
function initSite() {
   // console.log("megamenu");
    megaMenu()
   // sponsorFooter()


    getVideo();

    var menu_name = getUrlParameter('event_menu')
    
  //console.log('url',window.location.pathname,getUrlParameter('event_menu'))
    if(window.location.pathname == '/event/webxr-business-summit/'){
        menu_name = 'bizsummit21'
        event_class = 'business_summit'
    } else if (window.location.pathname == '/event/webxr-design-summit/'){

        menu_name = 'designsummit21'
        event_class = 'design_summit'

    } else if (window.location.pathname == '/event/webxr-developer-summit/'){
        event_class = 'developer_summit'

        menu_name = 'devsummit21'
    } else if (window.location.pathname == '/event/webxr-education-summit/'){
        menu_name = 'edsummit22'
        event_class = 'education_summit'
        console.log(event_class)

    } else if (window.location.pathname == '/event/webxr-brand-summit/'){
        menu_name = 'brandsummit22'
        event_class = 'brand_summit'

    } else if (window.location.pathname == '/event/webxr-production-summit/'){
        menu_name = 'prodsummit22'
        event_class = 'production_summit'
      //  console.log("prod")
    } else if (window.location.pathname == '/event/wolvic-assembling-the-pack/'){
        menu_name = 'wolviclaunch'
        event_class = 'wolvic-launch'
        //console.log("wolvic")
    
} else if (window.location.pathname == '/event/the-2nd-polys-webxr-awards/2021-virtual-red-carpet/'){
    menu_name = 'virtual-red-carpet-2'
    event_class = 'virtual-red-carpet-2'
   // console.log("virtual-red-carpet-2")
}  

    if(menu_name != false){
     //   console.log("app/menuname menu",menu_name,menus[menu_name])
        var run_of_show = runOfShow(menus[menu_name]);
       console.log("Run of Show",menu_name,menus[menu_name])
        //displayRunOfShow(run_of_show)
        var ros_list = getUrlParameter('ros-list')

        if(ros_list != false){
            
            displayRunOfShowList(run_of_show)
        }

        var monolith_view = getUrlParameter('monolith-view')
        var cards = getUrlParameter('cards')
        
        if(monolith_view){
            hide_social_icons = 1
            displayRunOfShowMonolith(run_of_show)
        } else if(cards){
            displayRunOfShowCards(run_of_show)
           
        } else {
            displayRunOfShowTable(run_of_show)
        }
    }


    
    if (menus == undefined) {
        window.setTimeout(initSite(), 100);
    }
    //var filters = "collaboration_type,platform"

    var filters = "collaborators,hardware_support,collaboration_type,platform,feature,industry"
    setFilterAccordion(filters); //directory.js
    //    console.log("profiles", profile_posts);
    //  console.log("hardware", hardware_posts);

    //console.log("PROFILE TEMPLATE","style:background:#000;color:#f00;")
    jQuery("#filter-accordion").accordion({
        header: "h3",
        collapsible: true,
        autoHeight: false,
        navigation: true
    });

    if (slug != undefined) {
        if (slug == 'directory') {
            console.log("DIRECTORY","style:background:#000;color:#f00;")
            getStatPosts()
            loadActiveProfiles();
        }

        
    } 
    if (profile_template != undefined) {
        if (profile_template == 'full-profile-template') {

          //  loadFullProfile(active_id)
        }
    }


}
jQuery(function() {
    jQuery('#main-menu').on("click", "a.toggle-menu", function() {

        jQuery('.exo-menu').toggleClass('display');

    });

});

var winTop = jQuery(window).scrollTop();
// Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
jQuery(function() {
    jQuery(window).scroll(function() {

        if (winTop >= 30) {
            jQuery("#site-title").addClass("sticky-header");
            //     jQuery("#sdg-nav").addClass("sticky-header");
            jQuery("#main-menu").addClass("sticky-header");
            jQuery("#pinned-nav").addClass("sticky-header");
        } else {
            jQuery("#site-title").removeClass("sticky-header");
            //      jQuery("#sdg-nav").removeClass("sticky-header");
            jQuery("#main-menu").removeClass("sticky-header");
            jQuery("#pinned-nav").removeClass("sticky-header");
        } //if-else
    }); //win func.
}); //ready func.




function sponsorFooter() {

    var menu_data = menus['sponsor-footer'].menu_array
    var menu_links = ''
    var url = '';
    var logo = '';
    var slug = '';
    // console.log(menu_data, menu_data.length)

    for (var i = 0; i < menu_data.length; i++) {

        //console.log("profile =" + menu_data[i].title, menu_data[i].object_id, profiles[menu_data[i].object_id])
        logo = profiles[menu_data[i].object_id].post_media.logo[0].full_path
        url = profiles[menu_data[i].object_id].info.url
        slug = profiles[menu_data[i].object_id].slug
            //        console.log(url)
        menu_links += "<div class='sponsor col-xs-2 col-sm-1' id='sponsor-footer-" + slug.toLowerCase() + "'><a href='" + url + "' target='_new' title='" + menu_data[i].title + "'> "
        menu_links += '<img src="' + logo + '" alt="' + menu_data[i].title + ' logo">'
        menu_links += "</a></div>"

    }

    jQuery('#sponsor-footer').html(menu_links);
    //    console.log("sponsor-footer", menu_links)
    jQuery('#sponsor-footer-qualcomm').attr('class', 'sponsor  col-sm-offset-1 col-xs-2 col-sm-1')
    jQuery('#sponsor-footer-area').attr('class', 'sponsor col-xs-offset-2 col-sm-offset-0 col-xs-2 col-sm-1')

}

function scrollToAnchor(div) {
    var anchor = $(div);
    $('html,body').animate({
        scrollTop: anchor.offset().top - 100
    }, 'slow');
}