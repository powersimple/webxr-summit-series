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
function getClassy(slug) {
    if (slug.includes("metatraversal")) {
        return "metatraversal";
    }
    else if (slug.includes("polys")) {
        return "polys";
    } else if (slug.includes("summit")) {
        return "summit";
    } else if (slug.includes("wolvic")) {
        return "summit";
    } else if (slug.includes("special-edition")) {
            return "summit";
    }  else if (slug.includes("golf")) {
        return "golf";
      } else if (slug.includes("makers")) {
        return "polys";
    } else if (slug.includes("hall")) {
        return "hall";
    }
    else {
        return 'else'; // Return an empty string if "metatraversal" is not found
    }
}

function getLabel(a) {
    switch (a) {
        case 'metatraversal':
            return 'MetaTr@versal';
        case 'polys':
            return 'The Poly Awards';
        case 'summit':
            return 'WebXR Summit Series';
        case 'summit':
                return 'WebXR Summit Series';
        case 'golf':
            return 'Ready Player Golf';
        case 'makers':
            return 'Meet the Makers!';
        case 'polys':
            return 'XR Hall of Fame';
        default:
            return 'else'; // Return an empty string for other values of 'a'
    }
}

function displayProfiles(profiles){
    var profile_list = '<div id="profiles">'
    var events = []
    var embed_video_url = ''
    var slug = ''
    for(var p = 0;p<profiles.length;p++){
      
       
        profile_list += '<span id="'+profiles[p].slug+'">'
        profile_list += profiles[p].sort;
        profile_list += '</span>'

        profile_list += ', '+profiles[p].profile_title+", "+profiles[p].company
        
        events = profiles[p].events; 

        
      //  console.log("EVENTS",events)
        
        for(var e=0;e<events.length;e++){
          slug = events[e].event_slug
            profile_list += '<li>'
             
            embed_video_url = events_object[slug].children[events[e].session_key].meta.embed_video_url 
           // var session_children = events_object[events[e].event_slug].children[events[e].session_id].children

            profile_list += '<a href="#'+slug+'" onclick="setROS(\''+events[e].event_slug+'\');playSessionVideo(\''+embed_video_url+'\',\''+events[e].session_id+'\',\'\');">'
            
            profile_list += events[e].session_title
           // profile_list += embed_video_url
            
            profile_list += ', '
            profile_list += '</a>'
            profile_list += '<span class="'+events[e].event_slug+'">'
            profile_list += events[e].event_title
            profile_list += '</span>'
            profile_list += '</li>'
                

        }/**/
    }
    profile_list += '</div>'
    $("#profile-index").html(profile_list);

}

function loadProfileData(data){
    console.log("LOAD profile",data)
    
  var this_class = '';
  
    var appearances = '<h4>Appearances by '+data.profile.title+'</h4><hr>';
    var appearances_array = [];
    for(var e=0;e<data.events.length;e++){

     
      this_class = getClassy(data.events[e].event_slug)
      if(this_class != ''){
        if(appearances_array[this_class] == undefined){
        appearances_array[this_class] =[]
       }
       appearances_array[this_class].push(data.events[e])
      }
     

      
    }
  
    appearances += '<ul class="appearances">';
    profile_events = appearances_array;
    for(a in appearances_array){

       

      console.log("appearances_array[a]",a,appearances_array[a])
      appearances += '<li class="event-title '+a+'">'+getLabel(a)+'</li>'
      for(var e=0;e<appearances_array[a].length;e++){
        console.log("appearances_array[a][e]",appearances_array[a][e])
        this_class = getClassy(appearances_array[a][e].event_slug)
        appearances += '<li class="appearance"><a onclick="playProfileVideo(\''+a+'\','+e+')">'+appearances_array[a][e].session_title+'</a> | <span class="'+this_class+' '+appearances_array[a][e].event_slug+'">'+appearances_array[a][e].event_title+'</span></li>'
      }
    }
    
    appearances += '</ul>';
    $('#appearances').html(appearances)
   }
