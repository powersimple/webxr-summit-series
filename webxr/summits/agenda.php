<a-entity position="<?=$this_ros['position']?>" rotation="<?=$this_ros['rotation']?>" id="agenda" scale="<?=$this_ros['scale']?>"  visible="true">
<?php

if(@$this_ros){

    $ros = get_menu_array($this_ros['menu']); // located in functions-navigation.php
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
            <a-entity id="<?=sanitize_title($session['post']->post_title)?>" position="<?=$session_pos['x']?> <?=$session_pos['y']?> <?=$session_pos['z']?>" rotation="<?=$session_rot['x']?> <?=$session_rot['y']?> <?=$session_rot['z']?>"> 
                <!--SESSION WRAPPER-->
                
                
                <a-entity id="label-<?=$session_slug?>" troika-text="value:<?=$session['title']?>;color:#c88d0e; fontSize:.8;align:left;anchor:left;" material="shader: standard;" 
                position="0 0 0" rotation="0 180 0" scale=".2 .2 .2" visibility="true"></a-entity>



        
            
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
                        <a-entity id="<?=sanitize_title($speaker['post']->post_title)?>-<?=sanitize_title($session['post']->post_title)?>"
                        position="<?=$speaker_pos['x']?> <?=$speaker_pos['y']?> <?=$speaker_pos['z']?>"
                        >

                        <!--SPEAKER LABEL-->
                            <a-entity id="label-<?=sanitize_title($speaker['post']->post_title)?>-<?=sanitize_title($session['post']->post_title)?>" troika-text="value:<?=$speaker['post']->post_title?>                            
                            ;color:#fff; fontSize:.7;align:center;anchor:center;" material="shader: standard;" position="0 -.1 0"
                                            rotation="0 180 0" scale=".2 .2 .2" visibility="true"></a-entity>

                                        <!--SPEAKER CREDS-->
                                            <a-entity id="label-<?=sanitize_title($speaker['post']->post_title)?>-<?=sanitize_title($session['post']->post_title)?>" troika-text="value:<?=$speaker['meta']['profile_title'][0]?>

<?=$speaker['meta']['company'][0]?>
                            
                            ;color:#fff; fontSize:.5;align:center;anchor:center;" material="shader: standard;" position="0 -.3 0"
                                            rotation="0 180 0" scale=".2 .2 .2" visibility="true"></a-entity>
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

                    print "</a-entity>";// END SPEAKER WRAP
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
           print "</a-entity>";// END SESSION WRAP

        }
    }
}
?>






        
            

            

             



</a-entity>