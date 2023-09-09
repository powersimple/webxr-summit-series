<?php

get_header(); 

$default_video_url = get_post_meta($post->ID,"embed_video_url",true);
$session_type = get_post_meta($post->ID,"session_type",true);

?>

<script>
var queryString = window.location.search;

var urlParams = new URLSearchParams(queryString);

urlParams.set('collapse', 'all')
urlParams.set('cards', 'show')

</script>


<main id="main" class="main"  role="main">




      <div class="d-flex container-flex">
<div class="col-md-7 left event-post">
<?php

print do_blocks($post->post_content);
?>
<div id="ros-table"></div>
<?php
$trophy_embed_id = get_post_meta($post->ID,"looking_glass_embed_trophy",true);
$trophy_base_embed_id = get_post_meta($post->ID,"looking_glass_embed_trophy_base",true);

if((trim($trophy_embed_id) != '') && (trim($trophy_base_embed_id) != '')){

?>
    <div class="row">
                  <?php 
                  
               if($trophy_embed_id != ''){?>
                <div class="col col-sm-6">
               <?php
                embed_LKBlock_by_id($trophy_embed_id);
                ?>

</div>
            <?php } 
             if($trophy_embed_id != ''){
            ?>
  <div class="col col-sm-6">

            <?php } ?>

            <?php
                embed_LKBlock_by_id($trophy_base_embed_id);
                ?>
               
                   
                </div>
<?php
}
?>
    <div class="event-content order-sm-12 col-sm-7 col-md-8 col-lg-9 col-xl-10">
     

         <div class="order-xs-1 col-sm-12  col-xl-4 col-xxl-5" >
             <div class="text-wrap">
         

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


            <div class="col-md-5 right">
                <div class="sticky">
                <?php if($default_video_url != ''){?>
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
                $sponsor_board = get_post_meta($post->ID,"sponsor_board",true);
            
                if($sponsor_board != ''){
                    $src = getThumbnail($sponsor_board, 'medium_large');
                    ?>
                    <div class="sponsor-board">
                        <img src="<?=$src?>" />
                    </div>
                    <?php
                }
               ?>
            </div>
        </div>
    </div>

        
           






</main>
<?php
get_footer();
?>