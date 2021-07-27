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