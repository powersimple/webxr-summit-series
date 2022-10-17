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
<style>
div.editable {
    width: 300px;
    height: 200px;
    border: 1px solid #ccc;
    padding: 5px;
}

strong {
  font-weight: bold;
}

</style>
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
 



<?php

if(@$_GET['roster']){


$ros = get_menu_array($_GET['roster']); // located in functions-navigation.php
$offset = 0;
if(@$_GET['offset']){
    $offset = $_GET['offset'];
}

foreach($ros as $i =>$item){ // this is the top level of the event itself
    
   print $item['post']->post_title;
   $link = get_permalink($item['post']->post_title);
   $green_room_url = @$item['meta']['green_room_url'][0];
   $start = intval($item['meta']['utc_start'][0]);
   $start = $start-(($offset*3600)*-1);// corrects timezone to minue hours
       
   
   
    $sessions = $item['children'];
    $speaker_status = [];
    $holds = [];
   foreach($sessions as $s => $session){
    //   var_dump($session);
        if($session['post']->post_title == 'Break'){
          //  continue;
        }
  // var_dump($session); 
        $session_script = '';
       
       
        $speaker_status[$session['post']->ID] = [
            "session_time"=> date("H:i",$start),
            "start"=>$start,    
            "session"=> @$session['post']->post_title,
            "content"=> @$session['post']->post_content,
            "session_type" => $session['classes'][0],
            "speakers"=> [],

            
        ];
        
        



        $session_slug=sanitize_title($session['post']->post_title);
        $session_blurb= do_blocks($session['post']->post_content);
        $green_room_time = $start - (15*60);
        if(@$_GET['invites']){
        print "<h3>".$session['post']->post_title;
        print "</h3>";
        
        print "GREEN ROOM TIME: ".date("H:i",$green_room_time)."<BR>";
        print "START TIME: " .date("H:i",$start)."<BR>";
        print "DURATION: ".$session['meta']['duration'][0]." Minutes<BR>";
    }
        




      
        $speaker_emails = [];
        
        $moderator = '';
        $moderator_email = '';
        
        //*speakerS*/
       
       foreach($session['children'] as $p => $speaker){
           $moderated = '';
           $speaker_name = $speaker['post']->post_title;
           $content = $speaker['post']->post_content;
           
            $profile_admin_url = '/wp-admin/post.php?post='.$speaker['post']->ID.'&action=edit';

            // BUILD META STATUS ARRAY
            $is_profile = false;
            if(@$speaker['post']->post_type == 'profile'){
            $is_profile == true;
            $speaker_status[$session['post']->ID]['speakers'][$speaker['post']->ID] = [
               
                "speaker_id"=> $speaker['post']->ID,
                    "speaker"=> $speaker_name,
                   

                    "email"=> @$speaker['meta']['email'][0],
                    "linkedin"=> @$speaker['meta']['linkedin'][0],
                    "twitter"=> @$speaker['meta']['twitter'][0],
                    "email"=> @$speaker['meta']['email'][0],
                    "company"=> @$speaker['meta']['company'][0],
                    "profile_title"=> @$speaker['meta']['profile_title'][0],
                    
                    "registration_pending"=>  @$speaker['meta']['registration_pending'],
                    "signed_release"=>  @$speaker['meta']['signed_release'],
                    "calendar_sent"=>  @$speaker['meta']['calendar_sent'],
                    "calendar_confirmed"=>  @$speaker['meta']['calendar_confirmed'],
                    "suppress_speaker_list"=>  @$speaker['meta']['suppress_speaker_list'],
                    
                    
                ];
            } else {
                array_push($holds,
                    [  "session_time"=> date("H:i",$start),
                            "session"=> @$session['post']->post_title,
                        "speaker"=> $speaker_name
                    ]
                );
            }
          // var_dump($speaker_name, $speaker_status[$session['post']->ID]['speakers'][$speaker['post']->ID]);


           if(in_array('panel',explode(" ",$session['classes'][0]))){
            
            if(in_array('moderator',explode(" ",$speaker['classes'][0]))){
                $moderator = $speaker_name;
                $moderator_email = $speaker['meta']['email'][0];
            } else {
                

            }
 


            
            $session_type='Panel';
            //$session_script = $panel_script;
               
                    if(@$moderator == $speaker_name){

                        $moderated = ", moderated by you";

                    } else {
                        $moderated = "moderated by ".@$moderator." &lt;<a href='mailto:".@$moderator_email."&gt;'>".@$moderator_email."</a>&gt;, ";
                    }
                
                
           //     $script = $panel_script;
            } else if(in_array('presentation',explode(" ",$session['classes'][0]))){
                $moderated = "";

                $session_type='Presentation';
               // $session_script = $presentation_script;

            } else if(in_array('interview',explode(" ",$session['classes'][0]))){
                
            
                if(in_array('interviewer',explode(" ",$speaker['classes'][0]))){
                    $moderator = $speaker_name;
                    $moderator_email = $speaker['meta']['email'][0];
                } else {
                    
    
                }
     
    
    
                
                $session_type='Interview';
                $session_script = @$interview_script;
                   
                        if(@$moderator == $speaker_name){
    
                            $moderated = ", with you";
    
                        } else {
                            $moderated = " with ".@$moderator." &lt;<a href='mailto:".@$moderator_email."&gt;'>".@$moderator_email."</a>&gt;, ";
                        }
                    
                    
                    $script = @$interview_script;

            }
            
            if(!@$speaker['meta']['calendar_sent'][0] && $is_profile){
            } else {

            }
            /*
                print '<BR>Title:
                <input type="text" size="50" value="WebXR Education Summit '.@$session_type.'"><Br>';
                print "<BR>Location:";
                print '<input type="text" size="50" value="Restream: '.$green_room_url.'"><Br>';
            */
            
                if(array_key_exists('email',$speaker['meta'])){
                    $end_time =  + $start+(@$session['meta']['duration'][0]*60);
                    $session_script = personalizeScript($session_script,$session['post']->post_title,$speaker_name,$green_room_url,$start,$end_time,$green_room_time,$moderated);

                    array_push($speaker_emails,$speaker['title']. '&lt;'.$speaker['meta']['email'][0].'&gt;');
             //       print '<BR>Emails: <input type="text" size="50" value="'.$speaker['title']. '&lt;'.$speaker['meta']['email'][0].'&gt;'.'"><Br>';
                } else {
               //     print "<span style='color:red'>NO EMAIL</span><BR>";
                }
            
            
                
                
         //       print '<div class="invitation" cols="80" rows="5">'.@$session_script.'</div>';



                $end = $green_room_time + ((@$session['meta']['duration'][0]+15)*60);
           /*
           ?>
            <form method="post" action="<?php echo get_stylesheet_directory_uri();?>/download-ics.php">
                <input type="hidden" name="appt" value="<?=sanitize_title($speaker_name)."-".$session_slug?>">
                <input type="hidden" name="date_start" value="<?=getIcalDate($green_room_time)?>">
                <input type="hidden" name="date_end" value="<?=getIcalDate($end)?>">
                <input type="hidden" name="location" value="Restream <?=$green_room_url?>">
                <textarea style="visibility:hidden;" name="description"><?=addslashes($session_script)?></textarea>
                <input type="hidden" name="summary" value="WebXR Education Summit - Green Room">
                <input type="hidden" name="url" value="<?=$link?>">
                <input type="submit" value="Download ICS">
                
            </form>
                <?php


                print "<BR><BR>";
            
                */
       }// partcipants loop
       if(@$_GET['moderators']==1){

       print '<BR>ALL Emails:<BR><textarea cols="80" rows="2">'.implode(",",$speaker_emails).'</textarea><BR>';
       }
       $start = $start + (@$session['meta']['duration'][0]*60);

//       print "<hr>";
   }
   
    
}
$_REQUEST['status'] = [

    'calendar_sent'=>[],
    'calendar_confirmed'=>[],
    'signed_release'=>[],
    
];

?>

<style>
u{
    text-decoration:none;
}
</style>

<div class="row">
    <div class="container whitebg">
<strong>WebXR Production Summit Agenda and Roster</strong><br>
(Times listed are Eastern Daylight Time)<BR>
<BR>


    <?php
$last_session = '';
$pending = [];
foreach($speaker_status as $key => $value){
    $start = $value['start'];
    $offset=-4;
    $start = $start-((@$offset*3600)*-1);// corrects timezone to minue hours
?>


    <BR><strong><?=date("g:i a",$start)?> | <?=$value['session']?></strong><BR>
    

<?php

print strip_tags($value['content']);
print "<br><span style='text-decoration:underline'>";
print ucfirst($value['session_type']);
print "</span><br>";

    foreach($value['speakers'] as $id => $speaker){
        

        ?>
     	• <?=$speaker['speaker'];?> - <?=$speaker['profile_title'];?>, <?=$speaker['company'];?> 
         <?php if(!@$_GET['nocontactinfo']){
             ?>
         <a href='mailto:<?=$speaker['email'];?>' target='_blank' style='color:#0000cc'> | <?=$speaker['email'];?></a> | 
         
         <a href='<?=$speaker['twitter'];?>' target='_blank' style='color:#0000cc'><?=str_replace("https://twitter.com/","@",$speaker['twitter']);?></a> | 

         <a href='<?=$speaker['linkedin'];?>' target='_blank' style='color:#0000cc'>LinkedIn</a>
         <?php
         }
         ?>
         <BR>

        <?php
                if(!@$speaker['registration_pending']){
        } else {
            array_push($pending,$speaker);
        //  print "&#x27A1; Speaker Confirmed, Announcment Pending<BR>";
        }
   
    }
    
}
print"<BR>";


/*
?>
<BR><BR>
<strong>PENDING REGISTRATION</strong>
<?php

foreach($pending as $key => $speaker){
print "&#x27A1;";
?>
  <?=$speaker['speaker'];?> <?=$speaker['profile_title'];?>, <?=$speaker['company'];?><BR>
<?php
}
*/
?>



    </div>
</div>



<?php
/*
?>



<div class="row">
    <div class="container">
    <?php

//STATUS
print "<table id='speaker-status'>";
print "<tr>";
print "<th>TIME</th>";
print "<th>SESSION</th>";
print "<th>SPEAKER ID</th>";
print "<th>SPEAKER</th>";
print "<th>Title,</th>";
print "<th>LinkedIn</th>";
print "<th>Twitter</th>";
//print "<th>CONFIRMED TIME</th>";
//print "<th>RELEASE</th>";


print "</tr>";


$last_session = '';
foreach($speaker_status as $key => $value){
       
    print "<tr>";
    print "<th>".$last_session = $value['session_time']."</th>";
    print "<th>".$value['session']."</th>";
    print "<td colspan='7'></td>";
    
       

    foreach($value['speakers'] as $id => $speaker){
        if($value['session_time'] == $last_session){
            print "<tr><td colspan='6'><hr></td>";
        }

        print "<tr>";
        print "<td></td>";
        print "<td></td>";
        print "<td>".$speaker['speaker_id']."</td>";
        print "<td>".$speaker['speaker']."</td>";
        print "<td>".$speaker['profile_title'].", ";
        print "<td>".$speaker['company']."</td>";
      
        print "<td>".$speaker['linkedin']."</td>";
        print "<td>".$speaker['twitter']."</td>";



        print "</tr>";
    
        
    }
}





?>
</table>
<hr>
<?php
    function negativeStatus($field){
        print "NOT $field<BR>
        <ul>";
            foreach($_REQUEST['status'][$field] as $key => $value){
                print "<li>$value[speaker] $value[email]</li>";

            }

        print "</ul>
        <hr>";

    }

 //   negativeStatus('calendar_sent');
  //  negativeStatus('calendar_confirmed');
   // negativeStatus('signed_release');

?>
        <h3>HOLDS</h3>
<?php

    foreach($holds as $key =>$value){
        print "$value[session_time] $value[speaker] $value[session] <br>";
    }
   



?>


</div>
</div>

<?php
 
?>


</div>

</div>


</div>
<?php
*/
}//roster
?>


</div>
</div>


  </main>
  <?php get_footer(); ?>