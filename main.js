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
var directory_list = [],
    active_filters = {},
    active_filter_count = 0,
    filter_posts = {},
    ranked_filters = {},
    max_posts = {}
    max_collaborators = 2,
    max_spectators = '',
    active_profiles = {},
    collaborators_threshots = []

    function loadActiveProfiles() {
        console.log("loadActiveProfiles", profile_posts,profiles_array);
        var this_post = 
        active_profiles = {}
        var logo = ''
        var result_array = [];
        var data = profile_posts
       
        for( var p=0;p<profiles_array.length;p++){
            this_post = profiles_array[p]
          
            if (this_post.info.company != undefined) {
               
                if (this_post.post_media != undefined) {
                    if (this_post.post_media.logo[0] != undefined) {
                        logo = this_post.post_media.logo[0].full_path
                        if(p==99){
                            console.log(99,this_post)
                        }
                        active_profiles[p] = {

                            'id': this_post.id,
                            'name': this_post.name,
                            'logo': logo,
                            'max_collaborators': parseInt(this_post.info.max_collaborators),
                            'max_spectators': this_post.info.max_spectators,
                            'company': this_post.info.company,
                            'solution_name': this_post.info.solution_name,
                            'instances': [],
                            'title': this_post.title,
                            'url': this_post.info.url,
                            'route': '/' + this_post.type +
                                    '/' + this_post.slug
                            }
                        }
                        if(active_filter_count == 0){
                            if(active_profiles[p] != undefined){

                        //  console.log(active_profiles[p])
                            if(active_profiles[p].max_collaborators != undefined){
                                if(max_collaborators<=active_profiles[p].max_collaborators){
                                
                                    result_array.push(active_profiles[p])
                                
                                }
                            }
                        }
                    } else {
                        result_array.push(active_profiles[p])
                    }
                
                }

            }

        }
        





        
        if(max_collaborators>2 && active_filter_count == 0){
    //     console.log("active", result_array)
         result_array = shuffle(result_array)
        }
        jQuery("#profile_logos").html(display_results(result_array.length, result_array))
        return active_profiles;
    }

function getFilterPosts(this_post, filter, value, name) {

    var logo = ''
    if (profile_posts[this_post].post_media.logo[0] != undefined) {
        logo = profile_posts[this_post].post_media.logo[0].full_path
    }


    return post_data = {

        'id': this_post,
        'value': value,
        'slug': profile_posts[this_post].slug,
        'filter': filter,
        'name': name,
        'instances': [{
            filter: filter,
            value: value,
            name: name
        }],
        'logo': logo,
        'max_collaborators': profile_posts[this_post].info.max_collaborators,
        'max_spectators': profile_posts[this_post].info.max_spectators,
        'company': profile_posts[this_post].info.company,
        'solution_name': profile_posts[this_post].info.solution_name,

        'title': profile_posts[this_post].title,
        'url': profile_posts[this_post].info.url,
        'route': '/' + profile_posts[this_post].type +
            '/' + profile_posts[this_post].slug
    }

}


function setFilterAccordion(lists) {
    var accordion_filters = '<form id="filters">'
    jQuery.each(lists.split(','), function(i, v) {
        active_filters[v] = {}
        if (v != 'collaborators') {
            accordion_filters += '<h3>' + v.replace("_", " ") + '</h3>';
            accordion_filters += '<div class="accordion-drawer">'
            if (v == 'hardware_support') {

                for (h in hardware) {
                    if (hardware[h].profiles.length > 0) {


                        accordion_filters += '<span class="data-filter"><input class="form-checkbox" type="checkbox" name="' + hardware[h].slug + '" data-tax="' + v + '" value="' + hardware[h].id + '"><span class="data-label">' + hardware[h].title.rendered + '</span></span>'
                    }

                }
            } else {
                for (i in taxonomies[v]) {
                       //console.log("tax",v, taxonomies[v])

                    if (taxonomies[v][i].posts.length) {
                        accordion_filters += '<span class="data-filter"><input class="form-checkbox" type="checkbox" name="' + taxonomies[v][i].slug + '" data-tax="' + v + '" value="' + taxonomies[v][i].id + '"><span class="data-label">' + taxonomies[v][i].name + '</span></span>'
                    }

                }




            }
            accordion_filters += '</div>'
        }
    })
    accordion_filters += '</div>'
    jQuery("#filter-accordion").html(accordion_filters)



}



function getFilterPosts(this_post, filter, value, name) {

    var logo = ''
    if (profile_posts[this_post].post_media.logo[0] != undefined) {
        logo = profile_posts[this_post].post_media.logo[0].full_path
    }


    return post_data = {

        'id': this_post,
        'value': value,
        'slug': profile_posts[this_post].slug,
        'filter': filter,
        'name': name,
        'instances': [{ filter: filter, value: value, name: name }],
        'logo': logo,
        'max_collaborators': profile_posts[this_post].info.max_collaborators,
        'max_spectators': profile_posts[this_post].info.max_spectators,
        'company': profile_posts[this_post].info.company,
        'solution_name': profile_posts[this_post].info.solution_name,

        'title': profile_posts[this_post].title,
        'url': profile_posts[this_post].info.url,
        'route': '/' + profile_posts[this_post].type +
            '/' + profile_posts[this_post].slug
    }

}



function buildRankedFilters() {
    ranked_filters = {}
    for (var p in filter_posts) {
        var len = filter_posts[p].instances.length
        var this_post = {}
        if (ranked_filters[len] == undefined) {
            ranked_filters[len] = []
        }
        ranked_filters[len].push(filter_posts[p])



    }
    //console.log("ranked", ranked_filters)
    directory_list = [];
    for (r in ranked_filters) {
      //  console.log("ranked",r, ranked_filters)
        ranked_filters[r] = shuffle(ranked_filters[r])
        directory_list.push(display_results(r, ranked_filters[r]))

    }

    directory_list.reverse() //ranked filters need to be flipped upside down before being displayed.

    var display_directory = ''
    for (d in directory_list) {
    //    console.log('directoryList',d)
        if(d == 0){
            display_directory += '<hr><div class="row result-header">These results match all of your criteria</div>';
        } else if (d==1) {
            display_directory += '<hr><div class="row result-header">These results match some of your criteria</div>';
            
        }

        display_directory += directory_list[d];

    }
    if(active_filter_count >0 ){
    jQuery("#profile_logos").html(display_directory)
    }
}


function getResultColumns(count) {

    is_even = (parseInt(count) / 2) == (parseInt(parseInt(count) / 2))
        // console.log(count, is_even, (count / 2), parseInt(count / 2))
    if (is_even) {
        //   console.log("even", is_even, (count / 2) == parseInt(count / 2))
    }
    return 'col-xs-6 col-sm-4 col-md-4 col-lg-3'
    if (count == '1') {
        return 'col-offset-xs-4 col-xs-4'

    } else if (count == '2') {
        return 'col-offset-xs-2 col-xs-4'
    } else if (count == '3') {
        return 'col-xs-2 col-sm-4'
    } else
    if (count == '4') {
        return 'col-xs-2 col-sm-3'
    } else {
        return 'col-xs-6 col-sm-4 col-md-3 col-lg-2'

    }


}

function getFilterInstances(instances) {
    last_filter = ''
        //   filter_results = 'Supports<BR> '
    var filter_results = '<ul>'
    for (i in instances) {
        if (instances[i].filter != last_filter) {
            filter_results += "<span class='filter-type'>"
            if (instances[i].filter == 'hardware_support') {

                filter_results += "Hardware:"

            } else if (instances[i].filter == 'platform') {
                filter_results += "Platforms:"
            } else if (instances[i].filter == 'feature') {
                filter_results += "Features:"
            } else if (instances[i].filter == 'industry') {
                filter_results += "Industries:"
            } else if (instances[i].filter == 'collaboration_type') {
                filter_results += "Collaboration Types:"
            }
            filter_results += "</span>"
        } else {

        }
        filter_results += '<li>' + instances[i].name + "</li>"
        last_filter = instances[i].filter
    }
    filter_results += '<ul>'

    // console.log(filter_results)
    return filter_results

}

/**
 * 
 * 
 * THIS MAKES THE DIRECTORY PRINT TO SCREEN
 * 
 * 
 */

function display_results(count, result_array) {
    var results = ''
    var bootstrap_tiles = 'profile-button ' + getResultColumns(count)
    

    results += '<div class="row display-flex">'
    var label = ''
  
    for (r = 0; r < result_array.length; r++) {
        
        this_post = result_array[r].id;
        if (result_array[r].company == result_array[r].solution_name) {
            label = '<span class="profile-main" title="' + result_array[r].solution_name + '">' + result_array[r].solution_name + '</span>'
            label = result_array[r].company
        } else {
            if (result_array[r].solution_name != '') {
                label = '<span class="profile-main" title="' + result_array[r].solution_name + '">' + result_array[r].solution_name + '</span>'
                label += '<span class="profile-sub" title="' + result_array[r].company + '">by ' + result_array[r].company + '</span>'
            } else {
                label = result_array[r].company
            }
        }


        //        console.log(count, result_array[r])

        results += '<div class="' + bootstrap_tiles + '">'
            //logo_display += '<a href = "' + result_array[r].url + '" target="_new ">'
            //logo_display += '<a href = "' + result_array[r].route + '">'
        results += '<a href = "#' + result_array[r].slug + '" data-profile="' + result_array[r].id + '">'
        results += '<img src="' + result_array[r].logo + '" alt="' + result_array[r].title + ' logo"></a>'
        results += '<div class="profile-data"><span class="profile-label">' + label + '</span>'


        results += "<div class='active-filters'>"
        results += "<span>Max Collaborators: " + result_array[r].max_collaborators + "</span>"
        results += "<span>Max Spectators: " + result_array[r].max_spectators + "</span>"
        results += getFilterInstances(result_array[r].instances) + "</div>"
        if (count > 1) {}

        results += '</div></div>' //close profile data and profile-wrap



    }
    results += '</div>'
   // console.log(results)
    return results
}

function displayFilters() {
    for (a in active_filters) { //loops through filter namess
        if (a === 'hardware_support') {
            for (f in active_filters[a]) {
                filter_posts[f] = hardware_posts[f].profiles
                for (p in hardware_posts[f].profiles) {
                    //                     console.log("hardware", active_filters[a])
                }
            }


        } else {
            for (f in active_filters[a]) {
                filter_posts[f] = taxonomies[a][f].posts
            }
            //  console.log(a, active_filters[a])

        }

    }
    //console.log("filter_posts", filter_posts);

}






function getStatPosts() {
    //console.log("profile posts", profile_posts)
    var collaborators = []
    var thresholds = [2,5,10,15,20,25,30,35,40,45,50]
    var spectator_lists = [],
        lists_lists = [],
        filter_posts = {}
        /*    for (i in max.spectators) {
                //  console.log(spectators[i]);

                for (p = 0; p < max.spectators[i].length; p++) {
                    if (profile_posts[p] != undefined) {
                        filter_posts[p] = getFilterPosts(max.spectators[i][p])

                        console.log("spectator_posts", i, profile_posts[max.spectators[i][p]].title)

                    }

                }
            }*/
    for (i in max.collaborators) {
        //    console.log(i, max.collaborators[i]);
        for (p in max.collaborators) {

            if (profile_posts[p] != undefined) {
                collaborators.push = max.collaborators[p]
                //console.log("collaborators_posts", i, profile_posts[max.collaborators[i][p]].title)
               // console.log('concat posts', collaborators)
            }
        
        


        }


    }
//console.log('concat posts', collaborators)
    return collaborators

}

function sortFilters(filter, value) {
    var this_filter = {}
    if (filter === 'hardware_support') {
        this_filter.name = hardware_posts[value].title.rendered
        this_filter.posts = hardware_posts[value].profiles
    } else if (filter === 'collaborators') {
        this_filter.name = "Max Collaborators"
        this_filter.posts = max.collaborators[value]

    } else {
        this_filter.name = taxonomies[filter][value].name
        this_filter.posts = taxonomies[filter][value].posts
    }
    //    console.log(this_filter)


    return this_filter

}

function buildFilters(action, tax, value) {
    active_filters[tax]
    var this_max = 2
    var display_filters = {}
        //  console.log("profile_posts", profile_posts)


    if (action === 'add') {

        if (tax == 'collaborators') {
            active_filters[tax] = []
        } else {
            active_filter_count++
        }

        active_filters[tax][value] = sortFilters(tax, value)

        console.log("added", tax, value, active_filters)
            //       console.log("added", tax, value, active_filters)

    } else if (action === 'remove') {
        //    
        
        if (tax != 'collaborators') {
            delete active_filters[tax][value]
            if(active_filter_count>0){
                active_filter_count--
            }
        }
            //        delete filter_posts[value]
            // console.log(active_filters, "removed", tax, value, active_filters)
    }

    filter_posts = {}
    //console.log("active filter count", active_filter_count)
    if(active_filter_count>0){
        for (a in active_filters) {
            for (f in active_filters[a]) {
                for (p in active_filters[a][f].posts) {

                    this_post = active_filters[a][f].posts[p]


                    if (profile_posts[this_post] != undefined) {
                        
                        if (profile_posts[this_post].info.max_collaborators != undefined) {
                            this_max = parseInt(profile_posts[this_post].info.max_collaborators)
//                            console.log("filtermax_min",this_max,max_collaborators,this_max>max_collaborators)

                            if(this_max>max_collaborators){
                                if (filter_posts[this_post] == undefined) {

                                    filter_posts[this_post] = getFilterPosts(profile_posts[this_post].id, a, f, active_filters[a][f].name)
                                } else {
                                    filter_posts[this_post].instances.push({
                                        filter: a,
                                        value: f,
                                        name: active_filters[a][f].name
                                    })

                                }
                            }
                        }
                    }
                }
            }
        }
    } else {
     //   console.log('no active filters')
        loadActiveProfiles()
    }


    //console.log("FILTER:", active_filters, action, tax, value)
    //console.log("FILTER posts:", filter_posts, action, tax, value)

    buildRankedFilters()




}

function setMax(label, value) {

    var max_count = parseInt(value) + 4
    max_posts[label] = []
    var _arr = []
    var _obj = {}


    for (var i = value; i <= max_count; i++) {
        if (max[label][i] != undefined) {
            for (var a = 0; a < max[label][i].length; a++) {
                _arr.push(max[label][i][a])
            }

        }



    }
    max_posts[label] = _arr

    //console.log("setMax", _arr)
    return max_posts[label]



}

$(function() {
    $("#max-collaborators").slider({
        value: 2,
        min: 0,
        max: 50,
        step: 5,
        create: function( event, ui ) {
            $("#collaborators").html('Minimum Collaborators ' + 2);
            $("#max-collaborators span.ui-slider-handle").html('2+');
        },
        slide: function(event, ui) {
            var val = ui.value + ui.value + '+'
            if (ui.value < 5) {
                if (ui.value < 2) {
                    ui.value = 2
                }
                var val = '2+'

            } else {
                var val = ui.value + '+'
            }
            //console.log("VAL", val)
            max_collaborators = ui.value
            var collaborators = setMax('collaborators', max_collaborators)
          //  console.log("all", max.collaborators)
            if (active_filters.collaborators != undefined) {
                buildFilters('remove', 'collaborators', max_collaborators)
            }
            buildFilters('add', 'collaborators', max_collaborators)
            

            $("#collaborators").html('Minimum Collaborators ' + val);
            $("#max-collaborators span.ui-slider-handle").html(val);
        }
    });
    // $("#collaborators").val("$" + $("#max-collaborators").slider(val));
});
/*

$(function() {
    $("#max-spectators").slider({
        value: 5,
        min: 5,
        max: 50,
        step: 5,
        slide: function(event, ui) {
            var val = ui.value - 4 + '-' + ui.value
            max_spectators = ui.value
            setMax('spectators', max_spectators)
            $("#spectators").html('Spectators ' + val);
            $("#max-spectators span.ui-slider-handle").html(val);
        }
    });
    //  $("#max-spectators").val("$" + $("#max-spectators").slider("value"));
});
*/

/***
 * CLICK ON PROFILE LOGO
 * 
 * 
 * 
 */

$(document).on('click', 'div.profile-button a', function(e) {
    // code here
    //    var this_value = jQuery(this).attr('value')
    var this_profile = jQuery(this).data('profile')
    loadActiveProfile(this_profile);
    scrollToAnchor('#active-profile');
});

$(document).on('click', '#filters :checkbox', function() {
    // code here
    var this_value = jQuery(this).attr('value')
    var this_tax = jQuery(this).data('tax')
    jQuery('#active-profile').html('')
        //console.log(taxonomies[this_tax][this_value].posts)
    if (this.checked) {
        //console.log("checked")
        buildFilters("add", this_tax, this_value)
    } else {
        //console.log("unchecked")
        buildFilters("remove", this_tax, this_value)

        // the checkbox is now no longer checked
    }


});

function shuffle(array) {
    var currentIndex = array.length, temporaryValue, randomIndex;
  
    // While there remain elements to shuffle...
    while (0 !== currentIndex) {
  
      // Pick a remaining element...
      randomIndex = Math.floor(Math.random() * currentIndex);
      currentIndex -= 1;
  
      // And swap it with the current element.
      temporaryValue = array[currentIndex];
      array[currentIndex] = array[randomIndex];
      array[randomIndex] = temporaryValue;
    }
  
    return array;
  }
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

// pass the type in the route
// param = url arguments for the REST API
// callback is a dynamic function name 
// Pass the name of a function and it will return the data to that function

var posts = {},
    pages = {},
    profiles = {},
    profiles_array = [],
    hardware = {},
    taxonomies = {},
    categories = {},
    tags = {},
    menus = {},
    media = {},
    posts_nav = {},
    posts_slug_ids = {},
    last_dest = 'outer-nav',
    menu_levels = [],
    menu_slides = [], // an array for all 
    related = {},
    data_score = 7,
    data_loaded = [],
    state = {},
    social = {},
    data_loaded = false,

    profile_posts = {},
    hardware_posts = {}

state.featured = {
    'transition': {
        'type': 'flip',
        'face': 'front'
    }
}




function getStaticJSON(filename, callback, dest) {
    // route =  the type 
    // param = url arguments for the REST API
    // callback = dynamic function name 
    // Pass in the name of a function and it will return the data to that function

    // local absolute path to the REST API + routing arguments
    //data_path is configured in header.php
    var json_data = data_path + filename + ".json"
        //console.log("data_path", data_path)
        // console.log("jsonfile", json_data);
    jQuery.ajax({
        url: json_data, // the url
        data: '',
        success: function(data, textStatus, request) {
            console.log("load json", data);
            //      data_loaded.push(callback);
            return data,

                callback(data, dest) // this is the callback that sends the data to your custom function

        },
        error: function(data, textStatus, request) {
            //console.log(endpoint,data.responseText)
        },

        cache: false
    })
}
/*
//THIS SECTION IS DEPRECATED, Data now consolidated into one content packet
getStaticJSON('posts', setPosts) // get posts

// retrieves all projects, with fields from REST API
getStaticJSON('pages', setPosts) // get pages

// retrieves all projects, with fields from REST API
getStaticJSON('project', setPosts) // get the projects

// retrieves all categories for the development category
getStaticJSON('categories', setCategories) // returns the children of a specified parent category

// retrieves all categories for the development category
getStaticJSON('tags', setTags) // returns the tags

// retrieves top menu
getStaticJSON('menus', setMenus) // returns the tags

getStaticJSON('media', setMedia) // returns the tags
*/
if (data_loaded == false) {
    getStaticJSON('content', setData) // returns all content
}

function setData(data) { //sets all content arrays
    // console.log("setData", data)
    posts = setPosts(data.posts)
    pages = setPosts(data.pages)
    profiles = setPosts(data.profile)
    events = setPosts(data.event)
  //  console.log("profiles",profiles)
    for (p in posts) {

        if (profiles[p].type == 'profile') {
            profiles[p].name = profiles[p].title.rendered
            profile_posts[profiles[p].id] = profiles[p]
            profiles_array.push(profiles[p]);

        } else if (profiles[p].type == 'hardware') {
            hardware_posts[profiles[p].id] = profiles[p]
        }
    }
    profiles_array = sort_array('title',profiles_array)
    hardware = data.hardware
        //  console.log("HRDWARE", hardware)
    for (h in hardware) {
        hardware[h].name = hardware[h].title.rendered
        hardware_posts[hardware[h].id] = hardware[h]

    }
    //console.log("HARDWARE", hardware_posts)
    //  setPosts(data.social)
    setCategories(data.categories)

    var taxonomies = "industry,feature,collaboration_type,platform"
    var taxes = taxonomies.split(",")
    for (var t = 0; t < taxes.length; t++) {
        setTaxonomy(data, taxes[t])

    }
    /*
    setTaxonomy(data, "industry")
    setTaxonomy(data, "feature")
    setTaxonomy(data, "collaboration_type")
    setTaxonomy(data, "platform")
    */


    setTags(data.tags)
    setMenus(data.menus)
    
        //  setMedia(data.media) media embeded into posts 
    initSite()
    data_loaded = true;
}


function sort_array (prop, arr) {
    prop = prop.split('.');
    var len = prop.length;
    
    arr.sort(function (a, b) {
        var i = 0;
        while( i < len ) {
            a = a[prop[i]];
            b = b[prop[i]];
            i++;
        }
        if (a < b) {
            return -1;
        } else if (a > b) {
            return 1;
        } else {
            return 0;
        }
    });
    return arr;
};


function setPosts(data) { // special function for the any post type

    var type = 'post'

    //console.log("data", data)
    if (Array.isArray(data)) {

        for (var i = 0; i < data.length; i++) { // loop through the list of data
            //console.log("home", data[i].id)
            /*
              The REST API nests the output of title and content in the rendered variable, 
              so we must unpack and set it our way, which is just .title and .content
            */
            if (data[i].title !== undefined && data[i].title.rendered !== undefined) { // make sure the var is there
                data[i].title = data[i].title.rendered // lose that stupid rendered parameter
            }

            if (data[i].content !== undefined && data[i].content.rendered !== undefined) { // make sure the var is there
                data[i].content = data[i].content.rendered // lose the unnecessary "rendered" parameter
            }


            //console.log(dest,data[i]);
            if (data[i].type !== undefined) { // make sure the var is there
                type = data[i].type // set the type for the log

                posts[data[i].id] = data[i] // adds a key of the post id to address all data in the post as a JSON object
            }

        }
    } else if (data != undefined) {
        console.log("data about to error", data)
        type = data.type // set the type for the log

        posts[data.id] = data // adds a key of the post id to address all data in the post as a JSON object

    }


    //console.log("posts", posts)


    return posts
}
function setMedia(data) {

    for (var m = 0; m < data.length; m++) {
        media[data[m].id] = data[m].data;
    }
    console.log("media", media);
}

function getMediaID(post_id, attr) {
    //console.log(post_id,attr)
    if (posts[id][attr] != undefined) { //is featured_media defined
        var media_id = posts[post_id][attr]

        if (media_id > 0) { // is it set to a value above zero?

            if (media[media_id] != undefined) {
                return media_id
            } else {
                return 0
            }

            // returns 


        } else {
            return 0
        }

    } else {
        return 0
    }


}

function getImageSRC(id, dest, size) { // id = media id

    //  console.log("set image", id, dest, size, media[id])
    if (media[id] != undefined) {


        var full_path = uploads_path + media[id].path // uploads path is in header
        var src = media[id].file; // this defaults to the basic file



        if (media[id].mime == "image/svg+xml") { // if it's an SVG, let the src pass through
            return full_path + src;
        } else { //for real images

            if (size == 'square' || size == 1) { // if for a square area
                src = getSquareVersion(media[id].meta.sizes, dest) // get the size version of the sq
                    //      console.log('square',src)
            } else if (size == 'thumbnail') {
                src = getSquareVersion(media[id].meta.sizes, dest)
                    //       console.log('thumbnail', src)
            } else {

                src = media[id].meta.sizes[size] // returns specified size
                    //console.log('default', size, media[id].meta.sizes,src)
            }

        }

        if (dest == '') { //set path to '' to return the src only
            //console.log("Src return", full_path + src)
            return full_path + src;




        } else { // if dest is specified, set the src to the id and 

            return full_path + src;
        }
        // show the wrapper

    } else {

        return ''
    }

}

function toggleFace(dest, type) {
    //console.log("toggle-face", dest, type, state[dest])
    if (state[dest].transition.face == 'front') {
        return 'back'
    } else {
        return 'front'
    }
}

function loadTemplate(dest, type) { // dest is name of place to put template, type = transition type
    //console.log("load template",dest,type)
    var template = jQuery('#' + dest + "-template").html(); // gets the empty contents of x-template script tag for this dest
    if (type == "flip") { // requires a front back wraper around template contents
        var front = '<div class="card front">' + template + '</div>' // wraps template in a front class
        var back = '<div class="card back">' + template + '</div>' // wrapte template in a back class
        jQuery('#' + dest).html(front + back); // loads both front and back into template into dest
    } else {
        jQuery('#' + dest).html(template); // defaults to empty template contents
    }

}

function clearImageText() {

}

function getAspect(w, h) {
    if (w == h) {
        return 'square'
    } else {
        return Math.round(w / h)
    }

}

function setImageContent(loc, title, caption, desc, alt, src) {

    //console.log("SET IMAGE CONTENT",loc,title,caption,desc,alt,src)
    setTimeout(function() {
        jQuery(loc + " .title").html(title)
        jQuery(loc + " .caption").html(caption)
        jQuery(loc + " .description").html(desc)
        jQuery(loc + " .image").attr('alt', alt)
        jQuery(loc + " .image").attr('src', src)
    }, 250)

}




function transitionImage(dest, type, media_id) {

    if (jQuery('#' + dest).html() == '' || state[dest].transition != type) { // load the template, only if you need to
        state[dest].transition.type = type // if transition type has changed, set it
        loadTemplate(dest, type)
    }
    var aspect = getAspect(parseInt(jQuery("#" + dest).width()), parseInt(jQuery("#" + dest).height())) // pass the sizes of the destination to get the aspect
    var src = getImageSRC(media_id, dest + ' .image', aspect) //returns appropriate image sice.
    if (type == 'flip') {
        var next_face = toggleFace(dest, type) // flip requires front and back, will return opposite based on state
        console.log("FLIP", next_face, dest, type, media_id, src)
        if (next_face == 'back') {
            //  jQuery('#featured').css("transform", "rotateY(180deg)")
        }
        if (media[media_id] != undefined) {
            /*
            //console.log('next face', next_face)
            var flip_chain = {
                flip_out: function () {
                        jQuery(dest).css('transform', 'rotateY(90deg)')
                        console.log('flipout')
                        return flip_chain
                    },
                set_content: function () {
                    setImageContent( '#' + dest + " ." + next_face, //uses "loc" instead of dest to allow for card faces.
                        media[media_id].title,
                        media[media_id].caption,
                        media[media_id].desc,
                        media[media_id].alt,
                        src)
                                            return flip_chain

                },
                flip_in: function() {
                    //jQuery(dest).css('transform', 'rotateY(90deg)')
                    console.log('flipin')

                    return flip_chain
                }
            }
            flip_chain.flip_out().set_content().flip_in()
            */


            setImageContent('#' + dest + " ." + next_face, //uses "loc" instead of dest to allow for card faces.
                media[media_id].title,
                media[media_id].caption,
                media[media_id].desc,
                media[media_id].alt,
                src)

            state[dest].transition.face = next_face
                /*jQuery(function () {
                    jQuery("#"+dest).flip({
                        axis: "y", // y or x
                        reverse: false, // true and false
                        trigger: "hover", // click or hover
                        speed: '250',
                        autoSize: false
                    });
                })*/
                //   console.log('next face', next_face)

        } else {
            setImageContent('#' + dest + " ." + next_face, '', '', '', '', '')
        }
        jQuery('#' + dest).toggleClass('is-flipped')

    }





}




/* GET FEATURED IMAGE BY POST ID */
function setImage(post_id, dest, attr, type, size) {
    //console.log("set image", post_id, size)
    var transition_type = "flip"
    if (posts[post_id] != undefined) { //you passed a post ID, is it there?
        var media_id = getMediaID(post_id, attr) //returns zero if doesn't exist

        if (media_id > 0) { //is media_id
            jQuery('#' + dest).fadeIn()

            // var src = getImageSRC(media_id, dest + '-image', 'square')
            // setMediaText(media_id, dest + '-image')
            // jQuery("#" + dest + '-image').attr("src", src)
            transitionImage(dest, transition_type, media_id)

            //console.log("set", media_id, src)


        } else {
            //console.log("media off", media_id)
            jQuery('#' + dest).fadeOut()
        }

    }


}


function wrapTag(tag, str) {
    return "<" + tag + ">" + str + "</" + tag + ">"
}

function setMediaText(id, dest) { // old

    if (media[id] != undefined) {
        // console.log("caption",media[id]);
        jQuery('#' + dest + "-title").html(media[id].title)
        jQuery('#' + dest + "-caption").html(media[id].caption)
        jQuery('#' + dest + "-description").html(media[id].desc)
        jQuery('#' + dest).attr("alt", media[id].alt);
    } else {
        //console.log("clear media text",dest);
        jQuery('#' + dest + "-title").html('')
        jQuery('#' + dest + "-caption").html('')
        jQuery('#' + dest + "-description").html('')
        jQuery('#' + dest).attr("alt", '');
    }

}

function getSquareVersion(sizes, dest) {

    box = { // object getting the container dimensions
            w: jQuery(dest + "-container").width(),
            h: jQuery(dest + "-container").height()
        }
        // console.log("box",box,"dest"+dest,sizes)

    if (box.w > 1280 || box.h > 1280) { //over 1500 use large
        //    console.log("sq-lg")
        return sizes['sq-lg']
    } else if ((box.w > 250 || box.h > 250) && (box.w <= 1280 || box.h <= 1280)) {
        // console.log("sq-med")
        return sizes['sq-med']
    } else {
        //  console.log("sq-sm")
        return sizes['sq-sm']
    }


}

function setVideo(id, dest) {


    if (media[id] != undefined) {

        var full_path = uploads_path + media[id].path // uploads path is in header
        var src = media[id].file; // this defaults to the basic file

        var video = jQuery(dest + ' video source').attr("src", full_path + src);

        //    console.log("unhide video player")

        jQuery(dest + ' video')[0].load();

        video = jQuery(dest + ' video source').attr("src", full_path + src);
        jQuery(dest).fadeIn()
    } else {
        //    console.log("no video, hide player")
        jQuery(dest).fadeOut();
    }

}

function setScreenImages(screen_images, dest, callback) {
    var images = []
    for (var i = 0; i < screen_images.length; i++) {
        //  console.log("screen image",screen_images[i])
        images.push({
            "src": getImageSRC(screen_images[i], '#screen-image', "square"),
            "data": media[screen_images[i]]
        })

    }
    state.screen_images = images
        //console.log("set ScreenImages", screen_images, dest, images, callback);
        //callback(dest)
        //initParticleTranstion(dest)
    if (images.length > 0 && callback == 'circleViewer') {
        circleViewer(dest, state.screen_images) // buggy
    }
    //  callback(dest,images)



}
function videoOverlay(src)  {
    $('#video-holder, #overlay').fadeIn('slow');
    console.log(src)
    $('#video-container').html('<iframe src="'+src+'" frameborder=0 allowfullscreen></iframe>');
}
  
  $(document).on('touchend, mouseup', function(e) {
    if (!$('#video').is(e.target)) {
      $('#video, #overlay').fadeOut('slow');
      $('#video-container').html('');
    }
  })

  // video overlayer: start

$(".js-overlay-start").unbind("click").bind("click", function(e) {
	e.preventDefault();
	var src = $(this).attr("data-url");
	$(".overlay-video").show();
	setTimeout(function() {
		$(".overlay-video").addClass("o1");
		$("#player").attr("src", src);
	}, 100);
});

// video overlayer: close it if you click outside of the modal

$(".overlay-video").click(function(event) {
	if (!$(event.target).closest(".videoWrapperExt").length) {
		var PlayingVideoSrc = $("#player").attr("src").replace("&autoplay=1", "");
		$("#player").attr("src", PlayingVideoSrc);
		$(".overlay-video").removeClass("o1");
		setTimeout(function() {
			$(".overlay-video").hide();
		}, 600);
	}
});

// video overlayer: close it via the X icon

$(".close").click(function(event) {
		var PlayingVideoSrc = $("#player").attr("src").replace("&autoplay=1", "");
		$("#player").attr("src", PlayingVideoSrc);
		$(".overlay-video").removeClass("o1");
		setTimeout(function() {
			$(".overlay-video").hide();
		}, 600);

});

function megaMenu() {
    var classes = ''
    var megamenu = '<nav id="megamenu" class="content">'
    megamenu += '<ul class="exo-menu">';

    megamenu += getMegaMenu(menus.megamenu.menu_levels, classes);

    megamenu += '<a href="#" class="toggle-menu visible-xs-block"><i class="fa fa-bars"></i></a>'


    megamenu += '</ul></nav>'
        //console.log("megamenu=", megamenu)
    jQuery("#main-menu").html(megamenu);
}

function getMegaMenu(items, parent_classes) {
    //console.log(items, parent_classes)

    var this_item = 0,
        menu_items = '',
        classes = '',
        ulclass = '',
        headwrap = '',
        footwrap = '',
        link = "#",
        outer = 'li',
        level = 0,
        target = ''
    for (var i = 0; i < items.length; i++) {

        this_item = items[i]
        headwrap = ''
        footwrap = ''
        classes = ''
        link = ''
        outer = 'li'

        if (this_item.classes != '') {
            classes = ' class="' + this_item.classes + '"'
            ulclass = this_item.classes + '-ul'

        }
    

        if (this_item.classes != undefined) {
            if (this_item.classes.indexOf('mega-drop-down')) {
                //      console.log(this_item.title, "mega")

                headwrap = '<div class="animated fadeIn mega-menu">'
                headwrap += '<div class="mega-menu-wrap">'
                headwrap += '<div class="row">'
                headwrap = '<ul class="' + ulclass + ' animated fadeIn">'
                footwrap = '</ul></div></div></div>'

            } else if (this_item.classes.indexOf('drop-down')) {

                headwrap = '<ul class="' + ulclass + ' animated fadeIn">'
                footwrap = '</ul>'


            } else {
                headwrap = '<ul class="' + ulclass + ' animated fadeIn">'
                footwrap = '</ul>'
            }
            if (this_item.parent_classes == 'mega-drop-down') {
                outer = 'div'
            }
            if (this_item.object == 'gradelevel') {
                //   console.log("obj", this_item)
            }
           
            switch (this_item.object) {
                case "feature":
                    link = this_item.url
                    break
                case "category":
                    link = this_item.url
                    break
                case "industry":
                    link = this_item.url
                    break
                case "custom":
                    link = this_item.url

                    break

                case "conference":
                    link = this_item.url
                    break
                case "award":
                    link = this_item.url
                    break

                    // default: link = '#';
            }
            //    console.log(this_item)
            if(this_item.xfn != ''){
                this_item.url += '#'+this_item.xfn
                link += '#'+this_item.xfn
            }
            if (this_item.url == '') {
                //menu_items += '<' + outer + ' ' + classes + '><span>' + this_item.title + '</span>' this needs to open the dropdown
                if (this_item.target != '') {
                    target = 'target="_blank"'
                }

                menu_items += '<' + outer + ' ' + classes + '><a href="' + link + '"' + target + '>' + this_item.title + '</a>'
            } else {
                menu_items += '<' + outer + ' ' + classes + '><a href="' + this_item.url + '">' + this_item.title + '</a>'
            }

            if (this_item.children != undefined) {

                if (this_item.children.length > 0) {
                    menu_items += headwrap
                        //     console.log("wrap",headwrap,footwrap)
                    menu_items += getMegaMenu(this_item.children, this_item.classes)

                    menu_items += footwrap

                }
            }
            menu_items += '</li>'
        }

    }

    return menu_items;
}
var menu_config = {
    'megamenu': {
        'menu_type': 'megamenu',
        'location': '#main-menu'
    },
    'sponsor-footer': {
        'menu_type': 'profile',
        'location': '#sponsor-footer'
    },
    'social-links': {
        'menu_type': 'social',
        'location': '#social'
    },
    'bizsummit21': {
        'menu_type': 'run-of-show',
        'location': '#run-of-show'

    },
    'designsummit21': {
        'menu_type': 'run-of-show',
        'location': '#run-of-show'

    },
    'devsummit21': {
        'menu_type': 'run-of-show',
        'location': '#run-of-show'

    }
}
function runOfShow(id){
    console.log("run of show"+id)
       console.log(menus[id])
    var show = menus[id]
    for (var i = 0; i < show.length; i++) {
        show[show[i].slug] = {}

    }
    console.log(show)



}



function setMenus(data) {
    //console.log("raw menu data",data)

    for (var i = 0; i < data.length; i++) {
        menus[data[i].slug] = {}
        menus[data[i].slug].menu_array = []
        menus[data[i].slug].menu_levels = []
        menus[data[i].slug].name = data[i].name
        menus[data[i].slug].slug = data[i].slug
        menus[data[i].slug].items = setMenu(data[i].slug, data[i].items)

        //console.log("slug", data[i].slug)
    }
    buildMenuData();
       //console.log("raw menu data", menus)

}

function setMenu(slug, items) {
    menu = {}
        //console.log("setMenu",dest,slug,items)
    for (var i = 0; i < items.length; i++) {
        menu[items[i].ID] = setMenuItem(slug, items[i])
            // console.log("setMenu", items[i].ID, slug, items)
        if (items[i].menu_item_parent != 0) { //recursive
            menu[items[i].menu_item_parent].children.push(items[i].ID) //children empty array is created in setMenuItem

        } else {
        }
        menus[slug].menu_array.push(menu[items[i].ID])

    }
    // console.log("MENU ARRAY",menus[dest].menu_array)
    // console.log("SetMenu", slug, menu)
    return menu
}

function setMenuItem(slug, item) {
    //console.log("setMenuItem",item)
    this_item = {}
    this_item.menu_id = item.ID
    this_item.title = item.title

    this_item.menu_order = item.menu_order
    this_item.object = item.object
    this_item.object_id = item.object_id
    this_item.parent = item.menu_item_parent
    this_item.classes = item.classes
    this_item.url = item.url
    this_item.description = item.description
    this_item.slug = slug
    this_item.xfn = item.xfn



    this_item.children = [] //this array is populated in Set Menu

    return this_item
}

jQuery(document).ready(function() {
    if ( $.isFunction(window.localTrigger) ) {
        localTrigger();
        console.log("triggered")
    } else {
        console.log("not triggered")
    }


});

function menu_order(a, b) {
    if (a.menu_order < b.menu_order)
        return -1;
    if (a.menu_order > b.menu_order)
        return 1;
    return 0;
}

function setLinearNav(m) {
    var counter = 0
    menus[m].linear_nav = [];
    var id = 0
    for (var i in menus[m].items) {


        // menu.items[i].post = posts[menu.items[i].object_id]
        menus[m].items[i].slug = i


        id = menus[m].items[i].object_id
        menus[m].linear_nav.push(menus[m].items[i])


        counter++;
    }
    menus[m].linear_nav.sort(menu_order);


    //console.log("linear_nav", menus[m].linear_nav);
    // console.log("posts_nav", posts_nav);

}

function setLinearDataNav(m, data) { // sets local data into linear array for wheel
    menus[m].data_nav = []
    menus[m].slug_nav = []
    var counter = 0,
        outer_counter = 0,
        inner_counter = 0,
        inner_subcounter = 0,
        grandparent = 0,
        next_parent = 0,
        dest = 'outer-nav'

    // THESE 3 NESTED LOOPS POPULATE THE data_nav array WITH WHAT IT NEEDS TO BUILD THE WHEEL AND HAVE IT BE CONTROLLED BY THE ORDERED NOTCHES FROM THE NAV
    //console.log(m,data)
    for (var d = 0; d < data.length; d++) { //outer
        dest = 'outer-nav'
        data[d].dest = dest;
        data[d].slice = outer_counter;
        data[d].notch = counter;
        grandparent = counter;
        menus[m].data_nav.push(data[d])
        menus[m].slug_nav[data[d].slug] = counter
        counter++;
        for (var c = 0; c < data[d].children.length; c++) { //children
            data[d].children[c].dest = "inner-nav"
            data[d].children[c].slice = c
            data[d].children[c].notch = counter
            data[d].children[c].parent = grandparent
            next_parent = counter
            menus[m].data_nav.push(data[d].children[c])
            menus[m].slug_nav[data[d].children[c].slug] = counter;
            counter++
            for (var g = 0; g < data[d].children[c].children.length; g++) { //grandchildren
                data[d].children[c].children[g].dest = "inner-subnav"
                data[d].children[c].children[g].slice = g
                data[d].children[c].children[g].notch = counter
                data[d].children[c].children[g].grandparent = grandparent
                data[d].children[c].children[g].parent = next_parent

                menus[m].data_nav.push(data[d].children[c].children[g])
                menus[m].slug_nav[data[d].children[c].children[g].slug] = counter;
                counter++
            }
            // console.log("dataNav", data);
        }

        outer_counter++;

    }
    //console.log("dataNav",m, menus[m].data_nav);
    //console.log("slug_nav",m, menus[m].slug_nav);
}

function getSlug(item, _of, _array, _it) {
    var slug = ''
    if (item != undefined) {
        slug = item.slug
        if (posts[item.object_id] != undefined) {
            slug = posts[item.object_id].slug
        }
    } else {
        //  console.log("get slug item undefined",slug,item.object_id,item,_of,_array,_it)
    }
    return slug

}

function buildMenuData() {

    // needs post variable
    if (posts == undefined) {
        //console.log("No Posts Data Yet",  posts)
        window.setTimeout(buildMenuData(), 10);
    } else {




        for (var m in menus) { // 
            var data = [];
            //console.log('menu loop',m)
            if (menu_config[m] != undefined) {
                var items = ''

                //menus[m].items.sort(function(a,b){return a.menu_order-b.menu_order})



                menus[m].menu_array = [];
                for (var i in menus[m].items) {
                    // console.log('menu item', menus[m].items[i], menu_config[m].location)
                    if (menus[m].items[i].parent == 0) {
                        // console.log("menu", menus[m].items[i].title)

                        menus[m].menu_array.push(menus[m].items[i]);
                    }
                    // items += '<a href="#" class="">' + menus[m].items[i].title + '</a>'

                }
                menus[m].menu_array.sort(menu_order);


                var children = [];
                var this_menu = menus[m].menu_array
                var slug = ''
                for (var a = 0; a < this_menu.length; a++) {
                    children = [];

                    for (var c = 0; c < this_menu[a].children.length; c++) {
                        var grandchildren = [];
                        var nested_children = menus[m].items[this_menu[a].children[c]].children;
                        for (var g = 0; g < nested_children.length; g++) {
                            slug = getSlug(menus[m].items[nested_children[g]], g, "g", nested_children, g)
                            grandchildren.push( // data for childe menus
                                {
                                    "title": menus[m].items[nested_children[g]].title,
                                    "url": menus[m].items[nested_children[g]].url,
                                    "slug": slug,
                                    "object": menus[m].items[nested_children[g]].object,
                                    "object_id": menus[m].items[nested_children[g]].object_id, // the post id
                                    "classes": menus[m].items[nested_children[g]].classes,
                                    "description": menus[m].items[nested_children[g]].description,
                                    "description": menus[m].items[nested_children[g]].xfn,
                                    
                                }
                            )

                        }

                        slug = getSlug(menus[m].items[this_menu[a].children[c]], "c", this_menu[a].children[c], c)
                            //console.log('bad slug', menus[m].items[this_menu[a].children[c]])
                        children.push( // data for child menus
                            {
                                "title": menus[m].items[this_menu[a].children[c]].title,
                                "slug": slug,
                                "url": menus[m].items[this_menu[a].children[c]].url,
                                "object": menus[m].items[this_menu[a].children[c]].object,
                                "object_id": menus[m].items[this_menu[a].children[c]].object_id, // the post id
                                "classes": menus[m].items[this_menu[a].children[c]].classes,
                                "description": menus[m].items[this_menu[a].children[c]].description,
                                "xfn": menus[m].items[this_menu[a].children[c]].xfn,
                                
                                "children": grandchildren

                            }
                        )

                    }
                    //console.log('outer', this_menu[a].object_id,  this_menu[a])
                    slug = getSlug(this_menu[a], "o", this_menu, a)
                        //  console.log(this_menu[a])
                    data.push({ // data for top level
                        "title": this_menu[a].title,
                        //"id": this_menu[a].id,
                        "slug": slug,
                        "url": this_menu[a].url,
                        "object": this_menu[a].object,
                        "object_id": this_menu[a].object_id, //the post_id
                        "children": children,
                        "classes": this_menu[a].classes,
                        "description": this_menu[a].description,
                        "xfn": this_menu[a].xfn
                    })

                }
                menus[m].menu_levels = data
                console.log("menu level data",m,menus[m].menu_levels)

                menu_levels = data;
               
                setLinearDataNav(m, data);
                setLinearNav(m)
                    





                //circleMenu('.circle a')
            }

        }

    }

}
function displayValidField() {

}


function loadActiveProfile(id) {
    var this_profile = profile_posts[id]
    console.log("profile-posts", profile_posts[id], filter_posts[id])
        /* LOGO */
        var logo = ''
        if (profile_posts[id].post_media.logo != undefined) {
            
            var logo_path = this_profile.post_media.logo[0].full_path
            console.log("logo path",logo_path)
            var logo = '<img src="' + logo_path + '" alt="' + this_profile.info.company + ' logo">'
            
        } else { logo = ''}

            var route = '/' + profile_posts[id].type + '/' + profile_posts[id].slug

            if (this_profile.post_media != undefined) {

            var logo_path = this_profile.post_media.logo[0].full_path
            console.log("logo path",logo_path)
            var logo = '<img src="' + logo_path + '" alt="' + this_profile.info.company + ' logo">'

            console.log("logo",logo)
            
            //$('#full-profile-template .profile-logo').html(logo);
            }
            $('#profile-template .profile-logo').html(logo);
    /* COMPANY */
    $('#profile-template .solution_name h4').html(this_profile.info.solution_name);

    /* SOLUTION NAME */
    $('#profile-template .company h5').html("by: " + this_profile.info.company);

    /* EXCERPT */
    $('#profile-template .blurb').html(profile_posts[id].excerpt.rendered);
    /* Use Cases */
    if (profile_posts[id].info.use_cases != undefined) {
        var use_cases = profile_posts[id].info.use_cases
        if (use_cases.length > 200) {
            use_cases = use_cases.substring(0, 200);
        }
    }

    $('#profile-template .use-cases').html(use_cases) // + " <a href='" + filter_posts[id].route + "'>more..</a>"

    var route = '/' + profile_posts[id].type + '/' + profile_posts[id].slug



    /*TAGS*/
    var profile_hardware = getProfileTags('Hardware', hardware_posts, this_profile.support_hardware, 'hardware')

    var profile_platform = getProfileTags('Platforms', taxonomies.platform, this_profile.platform, 'platform')

    var profile_industry = getProfileTags('Industries', taxonomies.industry, this_profile.industry, 'industry')

    var profile_feature = getProfileTags('Features', taxonomies.feature, this_profile.feature, 'feature')

    var profile_collaboration_type = getProfileTags('Collaboration Types', taxonomies.collaboration_type, this_profile.collaboration_type, 'collaboration_type')

    var profile_link = '<a href="' + route + '" class="profile-link" target="_new"  title="View the full profile of ' + this_profile.info.company + '">For more information on ' + this_profile.info.company + '<br>View their full XR Collaboration Profile</a>'

    $('#profile-template .view-profile').html(profile_link);
    var template = jQuery('#profile-template').html();

    /* INJECTION */
    $('#active-profile').html(template)

}


function loadFullProfile(id) {

    var this_profile = profile_posts[id]
        /* LOGO */
  //  console.log(this_profile)






    /* COMPANY */
    $('#full-profile-template .solution_name h1').html(this_profile.info.solution_name);

    /* SOLUTION NAME */
    $('#full-profile-template .company h2').html("by: " + this_profile.info.company);

    /* EXCERPT */
    $('#full-profile-template .blurb').html(profile_posts[id].excerpt.rendered);

    var demo_video = profile_posts[id].info.demo_video
    console.log("demo video", demo_video)

    if (demo_video != undefined && demo_video != undefined != '') {
        if (demo_video.includes('youtu')) {
            $('#full-profile-template .demo-video').html(embedYouTubeVideo(demo_video));
        }
    }


    $('#full-profile-template .profile-contact').html(getProfileContact(profile_posts[id].info));


    /* Use Cases */
    if (profile_posts[id].info.use_cases != undefined) {
        var use_cases = profile_posts[id].info.use_cases
        if (use_cases.length > 200) {
            //        use_cases = use_cases.substring(0, 200);
        }
    }

    $('#full-profile-template .use-cases').html(use_cases)


    /*TAGS*/
    var profile_hardware = getProfileTags('Hardware', hardware_posts, this_profile.support_hardware, 'hardware')

    var profile_platform = getProfileTags('Platforms', taxonomies.platform, this_profile.platform, 'platform')

    var profile_industry = getProfileTags('Industries', taxonomies.industry, this_profile.industry, 'industry')

    var profile_feature = getProfileTags('Features', taxonomies.feature, this_profile.feature, 'feature')

    var profile_collaboration_type = getProfileTags('Collaboration Types', taxonomies.collaboration_type, this_profile.collaboration_type, 'collaboration_type')

    //   var profile_link = '<a href="' + filter_posts[id].route + '" class="profile-link" title="View the full profile of ' + this_profile.info.company + '">For more information on ' + this_profile.info.company + '<br>View their full XR Collaboration Profile</a>'

    //$('#full-profile-template .view-profile').html(profile_link);
    var logo_path = profile_posts[id].post_media.logo[0].full_path
    var logo = '<img src="' + logo_path + '" alt="' + this_profile.info.company + ' logo">'
    $('#full-profile-template .profile-logo').html(logo);
    if (this_profile.post_media != undefined) {




        var heros = getHeroImages(id)
        if (heros.length > 0) {


            var hero = heros[0].laptop
        }
        if (hero != undefined) {
            $('#profile-hero').css('background-image', 'url(' + hero + ')');
        } else {
            $('#profile-hero').css('display', 'none');
            $('#main').css('margin-top', '100px;');
        }
    }

    var template = jQuery('#full-profile-template').html();

    /* INJECTION */


    $('#full-profile').html(template)

}


function getProfileContact(info) {
    console.log(info)
    var contact = {}

    if (info.url == undefined) { contact.url = '' }

    if (info.email == undefined) { contact.email = '' }

    for (f in info) {
        //  console.log(f, info[f])
        if (f == 'url') {

            contact[f] = '<a class="contact" href="' + info[f] + '" target=_new" title="' + info[f] + '">Website</a><br>'

        } else if (f == 'email') {
            if (info[f] != undefined) {
                contact[f] = '<a class="contact" href="mailto:' + info[f] + '"title="email' + info[f] + '">email</a><br>'
            } else {
                contact[f] = ''
            }
        } else {
            contact[f] = '<a class="contact fa fa-' + f + '" href="' + info[f] + '" target=_new" title="' + info[f] + '"></a><br>'
        }

    }
    result = contact.url + contact.email
    result += showSocial(info, 'linkedin');
    result += showSocial(info, 'twitter');
    result += showSocial(info, 'facebook');
    result += showSocial(info, 'instagram');
    return result;


}

function showSocial(info, f) {
    if (info[f] != undefined) {
        return info[f] = '<a class="contact social-icon fa fa-' + f + '" href="' + info[f] + '" target=_new" title="' + info[f] + '"></a>'
    } else {
        return ''
    }

}

function getHeroImages(id) {

    profile_data = profile_posts[id]
    console.log(profile_data)
    if (profile_data.post_media.screenshot.length > 0) {
        var screenshots_array = profile_data.post_media.screenshot
        var screenshots_data = []

        if (screenshots_array.length > 0) {
            for (var s = 0; s < screenshots_array.length; s++) {
                this_image = screenshots_array[s]
                if (this_image.meta.sizes != undefined) {
                    var image_data = {
                        path: this_image.path,
                        alt: this_image.alt,
                        title: this_image.title,
                        mobile: uploads_path + this_image.path + this_image.meta.sizes.medium,
                        tablet: uploads_path + this_image.path + this_image.meta.sizes.medium_large,
                        laptop: uploads_path + this_image.path + this_image.meta.sizes.large,
                        desktop: uploads_path + this_image.path + this_image.meta.sizes.hero,

                    }
                    screenshots_data.push(image_data)
                } else if (this_image.file != '') {
                    if (this_image.full_path != undefined) {
                        var image_data = {
                            full_path: this_image.full_path
                        }
                        screenshots_data.push(image_data)
                    }
                }
            }
            return screenshots_data
        }

    } else {
        return []
    }

    console.log("heros", screenshots_data)

}






function embedYouTubeVideo(url) {
    var ID = '';
    url = url.replace(/(>|<)/gi, '').split(/(vi\/|v=|\/v\/|youtu\.be\/|\/embed\/)/);
    if (url[2] !== undefined) {
        ID = url[2].split(/[^0-9a-z_\-]/i);
        ID = ID[0];
    } else {
        ID = url;
    }
    return '<div class="video-wrap"><iframe  src="//www.youtube.com/embed/' + ID + '?" frameborder="0" allowfullscreen></iframe></div>'

}



jQuery(function() {
    $(".mail").keyup(function() {
        var VAL = this.value;

        var email = new RegExp('^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$');

        if (email.test(VAL)) {
            alert('Great, you entered an E-Mail-address');
        }
    });
});


function getProfileTags(label, tag_data, tags, el) {
    //console.log(label, tags, el)
    var profile_tag_labels = []

    var element = '#' + profile_template + ' .' + el
        //console.log(element)
    if (tags.length > 0) {

        for (var t = 0; t < tags.length; t++) {

            profile_tag_labels.push(tag_data[tags[t]].name);
            //   profile_tag_labels.push(hardware_posts[t].title.rendered)
        }
        console.log(label + " tags", profile_tag_labels.join(","))

        $(element).html("<span class='filter-type'>" + label + ":</span> " + profile_tag_labels.join(", "));

    } else {
        $(element).css("display:none")
    }
}

function loadProfile(id) {
    return profile_posts[id]

}
var ros_meta = {
    timezone: []
}
function runOfShow(menu){
    var show = menu.menu_levels;
    
        if(show.length != undefined){
        
        for (var s = 0; s < show.length; s++) {
            var this_event = show[s]
            this_event.sessions = [];
            this_event.info =events[show[s].object_id]
            for (var n = 0; n < show[s].children.length; n++) {   // sessions the children of shows
                session = show[s].children[n]
                session.info = events[show[s].children[n].object_id]
            //  console.log(n,"info",session.info)
            //   session.info = events[show[s].children[n].object_id]
        

                session.profiles = []
            
                // session.info = events[show[s].sessions[n].object_id]
                for (var p = 0; p < show[s].children[n].children.length; p++) { // profiles

                
                    if(session.object=='profile'){ }
                        this_profile = show[s].children[n].children[p]
                
                        this_profile.profile = profiles[this_profile.object_id];
                        session.profiles.push(this_profile)
                    // console.log("profile",this_profile)
                
                
                }   
                this_event.sessions.push(session)
            this_event.sessions    
            }    
            


        }
        if(getUrlParameter('meta') == 'show'){
            displayMeta()

        }   


        return this_event
    }

}
function displayMeta(){
    var meta = ''
    for(m in ros_meta){
            meta+='<h4>'+m+'</h4>'
            console.log("meta",m,ros_meta[m])
        for(i=0;i<ros_meta[m].length;i++){
            meta+=ros_meta[m][i].id+'|'+ros[m][i].name+"<br>"

        }
    }
    $("#ros_meta").html(meta)

}
function adjustTimeZone(event_time,timezone){
    

    var time = timezone.split("| ")

    var offset = new Date()
    //console.log("Adjust",offset.getTimezoneOffset());
    var adjustment = offset.getTimezoneOffset()
    if(time[0]<0){
        adjustment = adjustment*-1
    }
    var adjust = ((parseInt(time[0])*60)*60)+adjustment; 

    var card = '<span class="timezone">'+convertDate(adjust)+'</span>'

    return card
}
function getProfileCard(this_profile,event_time){
    var title = ''
    var card = ''
    var credential = ''
    var social = ''

    var info = this_profile.profile.meta

    if(info != undefined){
        if(getUrlParameter('timezone') == 'show'){
            var timezone = this_profile.profile.meta.timezone[0]
            if(timezone != undefined){
            
              
                
                card+= adjustTimeZone(event_time,timezone)
            } else{
              
                ros_meta.timezone.push({id:this_profile.object_id,name:this_profile.title})
            }
    
        }
       
        

        if(info.profile_title != undefined){
            credential +=  '<span>'+info.profile_title.trim()+", "+'</span>'
        }
        if(info.company != undefined){
            credential += '<span>'+info.company.trim()+'</span>'
        }
        if(info.twitter != undefined){
          credential += '<span>@'+info.twitter.replace("https://twitter.com/","")+'</span>'
        }
        if(credential != ''){
            card += '<span class="credential">'+credential+'</span>'
        }
        if(info.twitter != undefined){
            social +='<a target="_new" class="twitter" href="'+info.twitter+'"><i class="fa fa-twitter social-icon" title="'+this_profile.title+' on Twitter"></i></a>'
        }
        if(info.linkedin != undefined){
            social +='<a target="_new" class="linkedin" href="'+info.linkedin+'"><i class="fa fa-linkedin social-icon" title="'+this_profile.title+' on LinkedIn"></i></a>'
        }
        if(info.github != undefined){
            social +='<a target="_new" class="github" href="'+info.linkedin+'"><i class="fa fa-github social-icon" title="'+this_profile.title+' on GitHub"></i></a>'
        }
        if(social != ''){
            card+='<span class="social">'+social+'</span>'
        }
       
        return card;
    } else {
        console.log("no profile info",this_profile)
    }
    

  
    



    
} 


function displayRunOfShowTable(runOfShow){

 //   console.log(runOfShow)
   
    var show = '<h2>'+runOfShow.title+'</h2>'
    var now = new Date()
    var showtime = runOfShow.info.event_info.utc_start;
    var tense = "future";
    if(now>showtime){
        tense = "past"
    }
    console.log("TENSE", tense)
    $("#show").html(show)
    var duration = 0;
    var sessions = '<div id="schedule">'
    var this_profile = ''
    var width_override = ''
    var card_size = 1
    var cell_width = '100%';
    var cols = '';
    for (var n = 0; n < runOfShow.sessions.length; n++) { 
      //  console.log("session-info",runOfShow.sessions[n].info,showtime)
        if(runOfShow.sessions[n].info != undefined){
            
            if(runOfShow.sessions[n].info.event_info.duration != ''){
            duration = parseInt(runOfShow.sessions[n].info.event_info.duration)*60
            event_time = showtime// this passes it below
            
            display_event_time = localTime(showtime)//converst
            start_time = showtime
            showtime = parseInt(showtime)+duration; //add duration for next 
            //console.log("duration",runOfShow.sessions[n],duration,display_event_time,convertDate(showtime))
                
                }
            // console.log("info not undefined",runOfShow.sessions[n],duration,display_event_time,convertDate(showtime))
            }
    //        console.log(runOfShow.sessions[n],duration,display_event_time,convertDate(showtime))
            sessions += '<div class="row session">'
            
            sessions += '<div class="col-sm-2 col-md-1">'
            if(tense == 'future'){
            sessions += '<h3 class="ros"><span class="spacer"></span><span class="session-time">'+display_event_time+' </span></h3>'
            } else {
                if(runOfShow.sessions[n].info.meta.embed_video_url != undefined){
                    sessions += '<a href="#" class="watch video-button" onclick="playVideo(\''+runOfShow.sessions[n].info.meta.embed_video_url+'\')" class="watch"><i title="WATCH" class="fa fa-youtube"></i><br> Watch</a>'
                }
            }
          //  sessions += '<div class="card-mode">'
        //  sessions += '<img src="/wp-content/uploads/2021/09/BusinessSummitBrandCard.png"+ alt="'+runOfShow.title+'">'
        /*
        sessions += '<ul class="session-times card-info">'
        sessions += '<li class="event-date">14 September 2021</li>'
 
        sessions += '<li><span>PDT</span><BR>'+convertDateTime(start_time,-7) +'</li>'
        sessions += '<li><span>EDT</span><BR>'+convertDateTime(start_time,-4) +'</li>'
        sessions += '<li><span>UTC</span><BR>'+convertDateTime(start_time,0) +'</li>'
        sessions += '<li><span>BST</span><BR>'+convertDateTime(start_time,1) +'</li>'
        sessions += '<li><span>CEST</span><BR>'+convertDateTime(start_time,2) +'</li>'
        sessions += '<li><span>CST</span><BR>'+convertDateTime(start_time,8) +'</li>'
        sessions+= '</ul>'
        */
        sessions+= '</div>'
      
        sessions+= '<div class="col-sm-3 col-md-2">'
        
        sessions += '<h3 class="session-title ">'+runOfShow.sessions[n].title+'</h3>'
    //   

    sessions+= '</div>'
        sessions +='<div class="col-sm-6 col-md-8">'//session

            sessions += '<div class="row" class="speaker-list">'
            width_override = ''
            
            if(runOfShow.sessions[n].profiles.length == 5){
                width_override = 'fifth'
                card_size = 1
                cols='fifth'
            } else if(runOfShow.sessions[n].profiles.length == 1){
                width_override = 'presentation'
                card_size = 2
                cols='col-sm-6 col-md-3'

            } else if(runOfShow.sessions[n].profiles.length == 2){
                width_override = 'pair'
                card_size = 2
                cols='col-sm-6 col-md-3'

            } else {
                width_override = ''
                card_size = 1
                cols='col-sm-6 col-md-3'

            }

            
        

cell_width = 100/runOfShow.sessions[n].profiles.length+'%';

        for (var p = 0; p < runOfShow.sessions[n].profiles.length; p++) { //speakers
            
            this_profile = runOfShow.sessions[n].profiles[p]
               
                    sessions += '<div  class="profile-card '+cols+' '+ this_profile.classes +'">'

               // console.log("THIS PROFILE",this_profile)
                if(this_profile.profile != undefined){
                    sessions += getProfileThumbnail(this_profile,'thumbnail');
                 /*                   if(card_size == 1){
                      
                    } else {
                        
                        sessions += getProfileThumbnail(this_profile,'medium');

                    }*/
                    if((width_override == 'presentation') || (width_override == 'pair')){
                        sessions += '</div><div class="col-sm-6 col-md-3">'
                    }
                    sessions += '<span class="profile-info">'
                
                    sessions += '<span class="profile-name ' +this_profile.slug+'">'+this_profile.title+'</span>'
                    
                   
                sessions += getProfileCard(this_profile,event_time);
                
                if(width_override == 'presentation'){
                   sessions += '</div><div class="col-sm-12 col-md-8 talk-blurb">'
                
             //       console.log(this_profile.profile);
                if(this_profile.profile.meta.talk_description != undefined){
                    sessions += '<span class="blurb">'+this_profile.profile.meta.talk_description+'</span>'
                }
            }
                sessions += '</span>'
                
                } else {
                    if(getUrlParameter('hold') == 'show'){
                        sessions += '<span class="profile-name">'+this_profile.title+'</span>'
                   }
                   
                }

                
                



                sessions += '</div>'


           }
           
           sessions += '</div>'
           sessions += '</div>'


           

          
        sessions += '</div>'
    }
    sessions +='</div>'
    $("#ros-table").html(sessions)

   
    if(getUrlParameter('collapse') != 'all'){
       
    //    activateAccordion("#ros-accordion")
    }
    if(getUrlParameter('cards') == 'show'){
    //    $('#ros-accordion').addClass('cards')

   }

}

function playVideo(src){
   $("#video-player").attr("src",src)

}

function getProfileThumbnail(this_profile,size){
   
    var profile_thumbnail = '<div class="profile-thumbnail">'

    if(this_profile.profile.thumbnail_url != undefined){
        var path = this_profile.profile.thumbnail_url[size] 
        if(path != undefined){
        profile_thumbnail +='<img src="'+path+'" alt="'+this_profile.title+'" title="'+this_profile.title+'">'
        }
    }
    profile_thumbnail += '</div>'
    return profile_thumbnail;
}

function displayRunOfShow(runOfShow){
    displayRunOfShowTable(runOfShow)
    displayRunOfShowCards(runOfShow)
    if(getUrlParameter('cards') != 'show'){
       
        //    activateAccordion("#ros-accordion")
        }
    
   
}

function displayRunOfShowCards(runOfShow){
        
    var show = '<h2>'+runOfShow.title+'</h2>'

    var showtime = runOfShow.info.event_info.utc_start;
    console.log("SHOWTIME",showtime)
    $("#show").html(show)
    var duration = 0;
    var sessions = '<div id="ros-accordion" class="cards">'
    var this_profile = ''
    var width_override = ''
    var card_size = 1
    
    for (var n = 0; n < runOfShow.sessions.length; n++) { 

        if(runOfShow.sessions[n].info != undefined){
            
            if(runOfShow.sessions[n].info.event_info.duration != ''){
            duration = parseInt(runOfShow.sessions[n].info.event_info.duration)*60
            event_time = showtime// this passes it below
            display_event_time = localTime(showtime)//converst
            start_time = showtime
            showtime = parseInt(showtime)+duration; //add duration for next 
            //console.log("duration",runOfShow.sessions[n],duration,display_event_time,convertDate(showtime))
                
            }
           // console.log("info not undefined",runOfShow.sessions[n],duration,display_event_time,convertDate(showtime))
        }
//        console.log(runOfShow.sessions[n],duration,display_event_time,convertDate(showtime))
      //  console.log("title time",display_event_time,runOfShow.sessions[n].title)
        sessions += '<h3 class="ros"><span class="spacer"></span><span class="session-time"> </span> '+runOfShow.sessions[n].title+'</h3>'
        sessions += '<div class="card-mode">'
      //  sessions += '<img src="/wp-content/uploads/2021/09/BusinessSummitBrandCard.png"+ alt="'+runOfShow.title+'">'
      sessions += '<ul class="session-times card-info">'
        sessions += '<li class="event-date">12 October 2021</li>'
       sessions += '<li><span>Los Angeles</span><BR>'+convertDateTime(start_time,-7) +'</li>'
        sessions += '<li><span>New York</span><BR>'+convertDateTime(start_time,-4) +'</li>'
        sessions += '<li><span>UTC</span><BR>'+convertDateTime(start_time,0) +'</li>'
        sessions += '<li><span>London</span><BR>'+convertDateTime(start_time,1) +'</li>'
        sessions += '<li><span>Paris</span><BR>'+convertDateTime(start_time,2) +'</li>'
        sessions += '<li><span>Beijing</span><BR>'+convertDateTime(start_time,8) +'</li>'
      
      sessions+= '</ul>'
        sessions += '<h3 class="card-info">'+runOfShow.sessions[n].title+'</h3>'
     //   

        sessions += '<div id="speaker-list" class="row">'
        width_override = ''
        
        if(runOfShow.sessions[n].profiles.length == 5){
            width_override = 'fifth'
            card_size = 1
        } else if(runOfShow.sessions[n].profiles.length == 1){
            width_override = 'presentation'
            card_size = 2
        } else if(runOfShow.sessions[n].profiles.length == 2){
            width_override = 'pair'
            card_size = 2
        } else {
            width_override = ''
            card_size = 1
        }

        for (var p = 0; p < runOfShow.sessions[n].profiles.length; p++) { 
            
            this_profile = runOfShow.sessions[n].profiles[p]
                sessions += '<div class="col-sm-3 '+ width_override+'">'
                    sessions += '<div class="profile-card" class="'+ this_profile.classes +'">'
               // console.log("THIS PROFILE",this_profile)
                if(this_profile.profile != undefined){
                    if(card_size == 1){
                        sessions += getProfileThumbnail(this_profile,'thumbnail');
                    } else {
                        
                        sessions += getProfileThumbnail(this_profile,'medium');

                    }
                    sessions += '<span class="profile-info">'
                
                    sessions += '<span class="profile-name ' +this_profile.slug+'">'+this_profile.title+'</span>'
                    
    
                sessions += getProfileCard(this_profile,event_time);
                
                
                    if(width_override == 'presentation'){

                        if(this_profile.profile.meta.talk_description != undefined){
                            sessions += '<span class="blurb">'+this_profile.profile.meta.talk_description+'</span>'
                        }
                    }
                sessions += '</span>'
                
                } else {
                    if(getUrlParameter('hold') == 'show'){
                        sessions += '<span class="profile-name">'+this_profile.title+'</span>'
                   }
                   
                }

                
                



                sessions += '</div>'

                sessions += '</div>'

           }
           sessions += '</div>'

           sessions += '<div class="card-footer">'
           sessions += '<span class="event-info">'
           sessions += '<a class="rsvp-link" href"https://bit.ly/WebXRDesignSummit21" target="_new">RSVP: https://bit.ly/WebXRDesignSummit21</a><br>'
           sessions += '<a class="rsvp-link" href"https://webxr.events/" target="_new">//webxr.events</a> | '
           sessions += '<a class="rsvp-link" href"https://twitter.com/webxrawards" target="_new">@webxrawards</a> | '
           sessions += '<a class="rsvp-link" href"https://twitter.com/#webxrsummit" target="_new">#webxrsummit</a><br>'
           sessions += '</span>'
           sessions += '<span class="sponsor-logo futurewei-logo"><a href="https://futurewei.com" target="_new"  title="Futurewei Technologies"><img src="/wp-content/uploads/2021/09/Futurewei-White.png" alt="Futurewei Technologies Logo"></a></span>'
           

           sessions += '</div>'
           

          
        sessions += '</div>'
    }
    sessions +='</div>'
    $("#sessions").html(sessions)

   
    if(getUrlParameter('collapse') != 'all'){
       
    //    activateAccordion("#ros-accordion")
    }
    if(getUrlParameter('cards') == 'show'){
    //    $('#ros-accordion').addClass('cards')

   }

}
jQuery(document).ready(function() {

  

});
function activateAccordion(id){
    console.log("triggered")
    jQuery(id).accordion({
        header: "h3",
        collapsible: false,
        autoHeight: true,
        heightStyle:"content",
        navigation: true
    });

}

function displayShow(){

}
function displaySession(){
    
}
function displayProfile(){
    
}
function utcDate(d){
    d= new Date(d);

    return  d.getUTCMonth()+1+' '+ d.getUTCDate() + ' '+ d.getUTCFullYear()
 
}
function utcTime(d,offset){
    d= new Date(d);
    var tail= 'GMT', D= [d.getUTCFullYear(), d.getUTCMonth()+1, d.getUTCDate()],
    T= [d.getUTCHours(), d.getUTCMinutes(), d.getUTCSeconds()];
    if(+T[0]> 12){
        T[0]-= 12;
        tail= ' pm '+tail;
    }
    else tail= ' am '+tail;
    var i= 3;
    while(i){
        --i;
        if(D[i]<10) D[i]= '0'+D[i];
        if(T[i]<10) T[i]= '0'+T[i];
    }
    return D.join('/')+' '+T.join(':')+ tail;
}
function localTime(unix_timestamp){
    
    // Create a new JavaScript Date object based on the timestamp
    // multiplied by 1000 so that the argument is in milliseconds, not seconds.

    var date = new Date(unix_timestamp * 1000);

    var utc_offset_hours = date.getTimezoneOffset()/60
    
    
    // Hours part from the timestamp
    var hours = parseInt(date.getHours())


    // Minutes part from the timestamp
    var minutes = "0" + date.getMinutes();
    // Seconds part from the timestamp
    var seconds = "0" + date.getSeconds();
    
    // Will display time in 10:30:23 format
    return hours + ':' + minutes.substr(-2);
}
function convertDate(unix_timestamp,offset){

}
function convertDateTime(unix_timestamp,offset){
    
    // Create a new JavaScript Date object based on the timestamp
    // multiplied by 1000 so that the argument is in milliseconds, not seconds.

    var date = new Date(unix_timestamp * 1000);

    var utc_offset_hours = date.getTimezoneOffset()/60


    
    // Hours part from the timestamp
    var hours = parseInt(date.getHours())
    var hours_adjusted = hours+utc_offset_hours
   
    var utc_adjusted = hours_adjusted+offset
    if(utc_adjusted>=24){
        utc_adjusted = utc_adjusted-24
    }
 

    // Minutes part from the timestamp
    var minutes = "0" + date.getMinutes();
    // Seconds part from the timestamp
    var seconds = "0" + date.getSeconds();
    
    // Will display time in 10:30:23 format
    return parseInt(utc_adjusted) + ':' + minutes.substr(-2);
}

$(".video-button").on('click', function(event){
    console.log("THIS",$(this).data('url'))

});
function setChildCategories(data) {
    for (var i = 0; i < data.length; i++) {
        categories[data[i].id] = data[i]
    }
    // console.log('categories', categories)

    return data
}

function setCategories(data) {
    // console.log("categories json", data)
    if (data != null) {
        for (var i = 0; i < data.length; i++) { //creates object of categories by key
            categories[data[i].id] = data[i]
        }
    }
    //  console.log('categories', categories)

    return data
}

function setTaxonomy(data, tax) {
    taxonomies[tax] = {}
    if (data[tax] != null) {
        for (var i = 0; i < data[tax].length; i++) { //creates object of categories by key
            taxonomies[tax][data[tax][i].id] = data[tax][i]
        }
    }
    // console.log(tax, taxonomies[tax])

    return data
}

function setTags(data) {
    for (var i = 0; i < data.length; i++) {
        tags[data[i].id] = data[i]
    }
    //console.log('tags', tags)

    return data
}