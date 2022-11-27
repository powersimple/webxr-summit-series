<?php
    get_header();

    //require_once "functions/functions-awards.php";
     // $pedestals = get_pedestals('polys2');
    //    var_dump($pedestals);
      $assets = [];
     
   $menu = get_menu_array("SummitsWheel");
   
   $assets3D = [];

   $panels = getPanelsArray( $menu);
   //var_dump($panels);
    $panels_assets = menu3DAssets("logo3D_src",$panels);



    $assets3D = array_merge($assets3D,$panels_assets); // merge all arrays with assets

     
?>

   

<a-scene gltf-model="dracoDecoderPath: assets/draco/;" grab-panels item-grab device-set nomination-link anti-drop
    device-orientation-permission-ui physics="iterations: 30;"
    inspector="https://cdn.jsdelivr.net/gh/aframevr/aframe-inspector@master/dist/aframe-inspector.min.js"
    loading-screen="backgroundColor: #12171a" renderer="colorManagement: true; foveationLevel: 2;"
    background="color: #000000">
    <a-entity tracked-controls="controller: 0; idPrefix: OpenVR"></a-entity>
    <a-entity tracked-controls="controller: 1; idPrefix: OpenVR"></a-entity>
    <a-assets timeout="800000">
        <!-- Loads assets -->
        <?php
            
            include "webxr/summits22/assets.php";
            include "webxr/summits22/mixins.php";
        ?>

    </a-assets>
    <a-sky src="#sky"></a-sky>

    <?php
            include "webxr/summits22/rigging.php";
            include "webxr/summits22/lights.php";

?>
<a-entity id="summits-2022" position="0 0 0" rotation="0 0 0" scale="1 1 1" visible="true">
   <!-- <a-entity id="platform-wrap" visible="true" scale="1 1 1" 
    position="0 0 0"
                rotation="0 0 0">
                <a-entity id="powersimple-logo-model" class="center-obj-zone" static-body
                        full-gltf-model="#powersimple" class="collision" visible="true"
                        scale=".9 .9 2"
                        position="-4.5 1.45 -2.4"
                        rotation="0 -300 0"
                        static-body="shape: box;">
                    
                    </a-entity>-->
                    <a-entity id="emblem class="center-obj-zone" static-body
                gltf-model="#emblem"  visible="true"
                scale="20 20 20"
                position="0 80 -120"
                rotation="0 20 0"
                static-body="shape: box;" 
                animation="property: object3D.rotation.y; to: 360; easing: linear; dur: 24000; loop: true;"
                ></a-entity><!-- outer ring -->
                
            <a-entity id="platform-model" class="center-obj-zone" static-body
                gltf-model="#platform"  visible="true"
                scale="50 50 50"
                position="0 -2.5 0"
                rotation="0 20 0"
                static-body="shape: box;" 
                ></a-entity><!-- outer ring -->
        <a-entity id="nav" class="center-obj-zone" static-body
                gltf-model="#platform" class="collision" visible="false"
                scale="50 50 50"
                position="0 -2.5 0"
                rotation="0 20 0"
                static-body="shape: box;" 
                ></a-entity><!-- outer ring -->

    <a-entity id="panels" position="0 30 0" rotation="0 0 0" scale="10 10 10">


  <?php
            include "webxr/summits22/panels.php";
            if(@$_GET['townhall']){
            //include "webxr/summits22/townhall.php";
            }
        ?>
        </a-entity><!-- panesls -->

    </a-entity><!-- summits-->



 












</a-scene>
<?php


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






<main id="main" class="main overlay"  role="main">

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
                    var run_of_shows = [] 
                    

                    runofshows.push(runOfShow('<?=$_GET['event_menu']?>'))

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
<?php
    }
?> 

  </main>
  <?php
     get_footer();
?>