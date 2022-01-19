jQuery(document).ready(function() {

    openDrawer()
    $("body").css("margin-left:0px !important") //RUDE HACK
});
$( window ).scroll(function() {
    pinFooter()

})
$(window).resize(function() {
    pinFooter()

});
function pinFooter(){
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
    console.log('set video', video_path)
    jQuery("#bg-video" + ' video source').attr("src", video_path);
}

function initSite() {
    megaMenu()
   // sponsorFooter()

    getVideo();

    var menu_name = getUrlParameter('event_menu')

  console.log('url',window.location.pathname,getUrlParameter('event_menu'))
    if(window.location.pathname == '/event/webxr-business-summit/'){
        menu_name = 'bizsummit21'
    } else if (window.location.pathname == '/event/webxr-design-summit/'){
        menu_name = 'designsummit21'
    } else if (window.location.pathname == '/event/webxr-developer-summit/'){
        menu_name = 'devsummit21'
    } 

  
    if(menu_name != false){
       
        var run_of_show = runOfShow(menus[menu_name]);
        displayRunOfShow(run_of_show)
        displayRunOfShowTable(run_of_show)
    }


    
    if (menus == undefined) {
        window.setTimeout(initSite(), 100);
    }
    //var filters = "collaboration_type,platform"

    var filters = "collaborators,hardware_support,collaboration_type,platform,feature,industry"
    setFilterAccordion(filters); //directory.js
    //    console.log("profiles", profile_posts);
    //  console.log("hardware", hardware_posts);

    console.log("PROFILE TEMPLATE","style:background:#000;color:#f00;")
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