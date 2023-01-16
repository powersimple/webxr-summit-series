<?php
    get_header();
?>
<section class="home-section home-parallax home-fade home-full-height" id="home" style="background:url(<?=@$hero_image?>) center center no-repeat;background-size:cover;">
    
    </section>

<main role="main" class="main <?=@$section_class?>">
    <div class="row">
        <div class="container">
            <div id="profile-index"></div>
            <div id="event-index">


<?php

   $profiles = getProfiles();
   $default_video_url = "";
 //  indexProfiles($profiles);

//devsummit21,bizsummit21,designsummit21,edsummit22,brandsummit22,prodsummit22,metatraversal4,metatraversal,

$events = "devsummit21,bizsummit21,designsummit21,edsummit22,brandsummit22,prodsummit22,metatraversal4,metatraversal1,metatraversal4,metatraversal3,wolviclaunch,virtual-red-carpet-2";
$lists = eventIndex($events);
    
    if(@$_GET['publish-index']){
      
        publishThis('index',$lists);
        displayProfileIndex($lists['profile_sort']);
    }
   

    ?><script>
        var profiles = []
        var sorted_profiles = []
        var events_object = {}
        var currentROS = ''
        var ros_list = {};
        jQuery(document).ready(function() {

            getStaticJSON('index', loadIndex) 
            

        })

        function loadIndex(data){
        
           console.log("data",data)
          
            
            for(var p in data['profile_sort']){
                sorted_profiles.push(data['profile_sort'][p])
                 
                
            }
            for(var e in data['event_list']){
                events_object[data['event_list'][e].slug] = data['event_list'][e]
                 
                
            }

            profiles = sort_array('sort',sorted_profiles);
            ros_list = data['ros_list'];
            console.log("sorted profiles",profiles)
            console.log("events_object",events_object)
            displayProfiles(profiles);

            
       
        


        }
        function getUrlVars()
{
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}
        function setROS(slug){//passes wp slug;
            var menu_name = ros_list[slug]//converts it to menu_name;
           console.log("menu name",menu_name,menus['menu_name'])
           
            currentROS = runOfShow(menus[menu_name])
          console.log("set",currentROS)
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


   
         





    </script>
    <?php
/*
    $profiles = getProfiles();
   
    foreach($profiles as $key=> $value){
        $value->post_title;
         $sort = get_post_meta($value->ID,"sort_name",true);
         $company = get_post_meta($value->ID,"company",true);
         if($sort ==""){
            print $value->post_title ."$sort ".get_last_name_first($value->post_title);
            print "<BR>";

         } else {
           print "|$sort $company<BR>";
         }
    


    }
  */  

//print_r($lists);
 

    
    //updateProfileIndex($lists['profile_sort']);
   





?>
            </div>
        </div>
    </div>
 
 <div class="container">
     <div class="video-position">
            <div class="video-wrap">
            <div id="video-wrap-header"></div>

            <div class="video-wrap">

        
            <iframe id="video-player" src="<?=$default_video_url?>"  frameborder="0" allowfullscreen></iframe>
                
            </div> 
            <div id="video-wrap-footer"></div>
        </div>

    </div>            
</div>    
   <?php if($default_video_url != ''){?>
<?php
    }
?> 

</main>


<?php
    get_footer();
?>