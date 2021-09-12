<?php

get_header(); 


$section_class = get_post_meta($post->ID,'section_class',true);
print $default_video_url = get_post_meta($post->ID,"embed_video_url",true);

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

<section class="home-section home-parallax home-fade home-full-height" id="home" style="background:url(<?=$hero_image?>) center center no-repeat;background-size:cover;">
    
    </section>

<?php
}


?>







<div class="title-bar">
    <h1 class="title"><?=$post->post_title?></h1>
    <?php
    if(@$post->post_excerpt){
    ?>
    <h2 class="featuring">
        <?=$post->post_excerpt?></h1>
    
    <?php
    }
 
    ?>
</div>
<main role="main" class="main <?=$section_class?>">


<div class="row">
<div class="container">
 



<div id="cards">
<?php

if(@$_GET['ros']){

    $ros = get_menu_array($_GET['ros']); // located in functions-navigation.php
    $offset = 0;
    if(@$_GET['offset']){
        $offset = $_GET['offset'];
    }


    foreach($ros as $i =>$item){ // this is the top level of the event itself
    // print $item['post']->post_title;
    $link = get_permalink($item['post']->post_title);
    $green_room_url = $item['meta']['green_room_url'][0];
    $start = intval($item['meta']['utc_start'][0]);
    $start = $start-(($offset*3600)*-1);// corrects timezone to minue hours
        
    $session_pos= [
        "x"=>0,
        "y"=>0,
        "z"=>0,
    ];
    $session_rot= [
        "x"=>0,
        "y"=>0,
        "z"=>0,
    ];

    
        $sessions = $item['children'];
        $speaker_status = [];
        $holds = [];
        $session_counter = 0;
        $group_counter = 0;
        
    foreach($sessions as $s => $session){
            if($session['post']->post_title == 'Break'){
            continue;
            }
    // var_dump($session); 
            $session_script = '';
        
        
            $speaker_status[$session['post']->ID] = [
                "session_time"=> date("H:i",$start),
                    
                "session"=> @$session['post']->post_title,
                "speakers"=> [],
                    
            ];
            
            



            $session_slug=sanitize_title($session['title']);

            $session_blurb= do_blocks($session['post']->post_content);
        




        
            $speaker_emails = [];
            
            $moderator = '';
            $moderator_email = '';
       

            ?>
            <div id="<?=sanitize_title($session['post']->post_title)?>"> 
                <!--SESSION WRAPPER-->
                
                
                <div id="label-<?=$session_slug?>"><?=$session['post']->post_title?></div>



        
            
<?php


            $speaker_counter = 0;
            $speaker_pos = [
                "x"=>0,
                "y"=>-1,
                "z"=>0,
            ];
            foreach($session['children'] as $p => $speaker){
                $is_profile = false;
                if(@$speaker['post']->post_type == 'profile'){



                    $thumbnail = getThumbnail(@$speaker['meta']['_thumbnail_id'][0],"thumbnail");
                  
                    $thumbnail = str_replace(@$_GET['host_root'],"/",$thumbnail);
                    $thumbnail = str_replace('/webxrsummitseries/',"/",$thumbnail);
                    $thumbnail = str_replace('https://',"/",$thumbnail);
                    
                    
                ?>
                <!--SPEAKER WRAPPER-->
                        <div id="<?=sanitize_title($speaker['post']->post_title)?>-<?=sanitize_title($session['post']->post_title)?>">
                        

                        <!--SPEAKER LABEL-->
                            <div id="label-<?=sanitize_title($speaker['post']->post_title)?>-<?=sanitize_title($session['post']->post_title)?>" >

                                        <!--SPEAKER CREDS-->
                                            <div id="label-<?=sanitize_title($speaker['post']->post_title)?>-<?=sanitize_title($session['post']->post_title)?>" >

<?=$speaker['meta']['company'][0]?>
                            
                        </div>
                        <?php
                            if($thumbnail){
                            ?>

                                    <a-image material="side:front" id="pic-<?=$speaker['post']->post_title?>" mixin="scale-label" src="<?=$thumbnail?>"
                                    position="0 0.5 0" rotation="0 180 0"   geometry="primitive: circle; width: 2; height: 2; depth: 3" scale=".3 .3 .3" width="5" height="5">
                                    </a-image>
                        <?php
                                }// image exists
                                        $speaker_counter++;
                                        if($speaker_counter == 5){
                                            $speaker_counter = 0;
                                        } else {
                                            $speaker_pos['x'] = $speaker_pos['x']-1.2;
                                        }

                    print "</div>";// END SPEAKER WRAP
                    if(@$speaker_counter == count($session['children'])){
                        $speaker_counter = 0;
 //                       die();
                    } else {
                        
                    }

                    }//IS PROFILE
            }// SPEAKER LOOP



            $session_counter++;
            if($session_counter == 3){
                $session_counter = 0;
                $group_counter++;
                
                $session_pos['y'] = 0;
                $session_pos['x'] = $session_pos['x']-5;
              //  $session_pos['z'] = $session_pos['z']-1.5;

            // $session_rot['y'] = $session_rot['y']-20;

            } else {
                $session_pos['y'] = $session_pos['y']-1.7;
               

            }
         //   $session_pos['x'] = $session_pos['x']-1;
           print "</div>";// END SESSION WRAP

        }
    }
}
?>






        
            

            

             



</div>



</div>
</div>


  </main>
  <?php get_footer(); ?>