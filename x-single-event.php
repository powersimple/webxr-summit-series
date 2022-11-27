<?php

get_header(); 
$default_video_url = get_post_meta($post->ID,"embed_video_url",true);
$session_type = get_post_meta($post->ID,"session_type",true);
$section_class = get_post_meta($post->ID,"section_class",true);
$honorees = get_post_meta($post->ID,"event_honoree");    
$moderator = get_post_meta($post->ID,"event_moderator");    
$guests = get_post_meta($post->ID,"event_guest");    

$profiles = array_merge($honorees,$moderator,$guests);


if($hero=get_post_meta($post->ID,'hero',true)){
   $hero_image = getThumbnail($hero);
   /*
if($post->post_parent==0){

    print "<div id='section-heading'>";
    $parent_post = get_post($post->post_parent);
    $parent_post_title = $parent_post->post_title;
    echo $parent_post_title;
    print "</div>";
}
*/
?>
<script>
var queryString = window.location.search;

var urlParams = new URLSearchParams(queryString);

urlParams.set('collapse', 'all')
urlParams.set('cards', 'show')

</script>
<section class="home-section home-parallax home-fade home-full-height" id="home" style="background:url(<?=$hero_image?>) top center no-repeat">
    
    </section>

<?php
}

?>






<main class="main" style="max-width:100% !important;padding:0px !important" role="main">

<?php
    
?>


<div class="title-bar">
    <h1 class="title"><?=$post->post_title?></h1>
    <div class="text-wrap">
         <?=do_blocks($post->post_content)?>
</div>
    <?php
    if(@$post->post_excerpt){
      
    ?>
    <h2 class="featuring">
        <?=$post->post_excerpt?></h1>
    
    <?php
    }
 
    ?>
</div>
<?php
if(@$_GET['ros-list']){
    ?>
<div id="ros-list"></div>

    <?php
}
?>

<section class="module" id="ros-table" >
    <?php

?>

</section>


    <div class="row">
    <?php
if(($post->ID!=13) || (@$_GET['cards'] == 'show')){




if($post->post_parent == 0){
    $event_id = $post->ID;
} else {
    $event_id = get_post($post->ID)->post_parent;
    if(get_post($event_id)->post_parent != 0){
      //  $event_id = get_post($post->ID)->post_parent;
    }

}

$utc_start =  get_post_meta($event_id,"utc_start",true); 
$tense = null;
if(is_date($utc_start)){
   print $now = date("Y-m-d");
    print $then = date("Y-m-d", $utc_start);
    if($now > $then){
print         $tense = "past";
    } else {
       print $tense = "future";
    }
}


$events = getChildList($event_id,$post_type,$sort='menu_order');



 if(count($events)){
?>
<style>
    .bs-example{
    	margin: 20px;
    }
    .modal-dialog iframe{
        margin: 0 auto;
        display: block;
    }
</style>
<?php
    $summit_profiles = [];


    print"
    </div>";
} else {

}
// EVENT SPECIFIC HACKS


    ?>
        <?php
    }
        ?>
    <div class="event-content order-sm-12 col-sm-7 col-md-8 col-lg-9 col-xl-10">
     


     <div class="row">
     <div class="col-md-12  col-xl-8 col-xxl-7">
            
         </div>
         <div class="order-xs-1 col-sm-12  col-xl-4 col-xxl-5" >
             <div class="text-wrap">
         <?php do_blocks($post->post_content)?>

        <?php
            if(@$_GET['event_menu']){
                ?>

                <h3>Agenda</h3>
                <div id="sessions"></div>
                <script>

             //   console.log("show ros")
                    jQuery(document).ready(function() {
                        //triggers Run of show script when event menu param is present
                    var run_of_show = runOfShow('<?=$_GET['event_menu']?>');
                    //console.log("ROS",run_of_show)
                    displayRunOfShow(run_of_show)

                    printdisplayRunOfShowList(run_of_show)

                    displayRunOfShowTable(run_of_show)
                    
                    
                });
                </script>

                <?php
            }

        ?>

            </div>

            <div>
          <!--  <h3>Speakers</h3>-->
         <?php 
         //displayProfiles(array_unique($summit_profiles),$post->ID,"event_guest",$session_type);?>
            </div>

         </div>
        
     
     </div>
 </div>
<?php if($default_video_url != ''){?>
 <div class="container">
     <div class="row pin-bottom">
    
        <div class="video-wrap">

      
        <iframe id="video-player" src="<?=$default_video_url?>"  frameborder="0" allowfullscreen></iframe>
            
        </div> 
    </div>            
</div>    
<?php
    }
?> 

  </main>
  <?php
    

  get_footer(); ?>