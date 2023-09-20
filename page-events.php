<?php
    get_header();
?>
<section class="home-section home-parallax home-fade home-full-height" id="home" style="background:url(<?=@$hero_image?>) center center no-repeat;background-size:cover;">
    
    </section>

<main role="main" class="main <?=@$section_class?>">
    <div class="row">
        <div class="d-flex container-flex">
            <div class="col-md-7 left" id="profile-videos" >
          
            <div id="profile-index"></div>

<?php

   $profiles = getProfiles();
   $default_video_url = get_post_meta($post->ID,"featured_video_url",true);
 //  indexProfiles($profiles);

//devsummit21,bizsummit21,designsummit21,edsummit22,brandsummit22,prodsummit22,metatraversal4,metatraversal,

$events = "virtual-red-carpet-3,virtual-red-carpet-2,virtual-red-carpet-1,polys1,polys2,polys3,meet-the-makers,devsummit21,bizsummit21,designsummit21,edsummit22,brandsummit22,prodsummit22,special-editions,wolviclaunch,metatraversal1,metatraversal2,metatraversal3,metatraversal4,metatraversal-a-day-in-the-life,metatraversal9";
$lists = eventIndex($events);

if(@$_GET['publish-index']){

    publishThis('index',$lists);
    displayProfileIndex($lists['profile_sort']);
}
    if(@$_GET['publish-profiles']){
      
        publishProfiles('index',$lists);
        
        
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
      //      ros_list = data['ros_list'];
            console.log("sorted profiles",profiles)
            console.log("events_object",events_object)
            displayProfiles(profiles);

        }
  
       


    </script>
 
       
  
    </div>
        <div class="col-md-5 right">
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