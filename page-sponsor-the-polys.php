<?php

get_header(); 
$section_class = get_post_meta($post->ID,'section_class',true);
$default_video_url = get_post_meta($post->ID,"featured_video_url",true);


?>


<main role="main" class="main <?=$section_class?>">

    <div class="d-flex container-flex">
        <div class="col-md-7 left">
            <h1><?=$post->post_title?></h1>
        <?php

print do_blocks($post->post_content);
?>
        </div>

        <div class="col-md-5 right">
                <div class="sticky">
                    <h5 class="download"><a href="/wp-content/uploads/2023/08/SponsorThe4thPolys-WebXRAwards-Deck.pdf" target="_new">Download Our Sponsor Deck (pdf)</a></h5
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
            <div class="partners">
        <?php   
               
            ?>
        </div>
        </div>
       
    </div>
    </div>
    
   
</main>
  <?php get_footer(); ?>