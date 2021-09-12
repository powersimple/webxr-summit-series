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

$instructions = '<BR>Karen Alexander and Linda Ricci are looking forward to welcoming you to our Green Room.<br><br>
<strong>JOIN US IN THE GREEN ROOM: <a href="[GREEN_ROOM_URL]">[GREEN_ROOM_URL]</a> at [GREEN_ROOM_TIME] PDT</strong> for mic and camera checks, and screen sharing if necessary.<br>
<br>
The session will begin promptly at [START_TIME] Pacific Daylight Time (UTC-7) and end at [END_TIME] PDT<br>
<br>
If possible, please use a 1080p webcam and sit in a well-lit area. We will be using the Streamyard platform, which supports green screen. You are welcome to use a custom 1920x1080 jpg or png image file as your background.<BR>
<br>
Please accept this calendar invite to confirm your engagement.<br>
<br>
We are excited for you to share your expertise with our global audience.<br>
If you have any questions don\'t hesitate to reach out to us at <a href="mailto:webxrevents@gmail.com">webxrevents@gmail.com</a><br>

<br>
See you on September 14th!<br><br>
Your friends,<br>
The Polys – WebXR Awards and WebXR Summit Series Team';
    


$panel_script = "Dear [NAME],<br><br>
Thank you for joining our panel <strong>[SESSION]</strong> [MODERATION] at the <strong>WebXR Business Summit on the 14th of September</strong>.<br><br>
$instructions";

$presentation_script = "Dear [NAME],<br><br>
We are excited for your presentation titled [SESSION] at the <strong>WebXR Business Summit on the 14th of September</strong>.<br><br>
Please notify us if you have any special requirements other than screen sharing such as playing video. If you will be screen sharing, it is helpful to share on a second monitor if possible so you can monitor the session on the first monitor.<br> 
$instructions";

$interview_script = "Dear [NAME],<br><br>
We are excited for your interview [SESSION][MODERATION] at the <strong>WebXR Business Summit on the 14th of September</strong>.<br><br>
$instructions";


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
    function showEmails(){
        global $wpdb;
        $sql="select m.meta_value as email, p.ID, p.post_title as name from wp_posts p, wp_postmeta m where p.ID = m.post_id and meta_key = 'email' and p.post_status = 'publish' order by post_title";
        $q=$wpdb->get_results($sql);
        foreach($q as $key=>$value){
            print "$value->name | $value->email<br>";
        }
    }

  print do_blocks(do_shortcode($post->post_content));
  function personalizeScript($script,$session,$name,$green_room_url,$start_time,$end_time,$green_room_time,$moderation=""){
    $script = str_replace('[SESSION]','"'.$session.'"',$script);
    $name = explode(" ",$name);
    $script = str_replace('[NAME]',$name[0],$script);
    $script = str_replace('[START_TIME]',date("H:i",$start_time),$script);
    $script = str_replace('[END_TIME]',date("H:i",$end_time),$script);
    
    $script = str_replace('[GREEN_ROOM_URL]',$green_room_url,$script);
    $script = str_replace('[GREEN_ROOM_TIME]',date("H:i",$green_room_time),$script);
    $script = str_replace('[MODERATION]',$moderation,$script);
    
    

    return $script;

}





$ros = get_menu_array('BizSummit21'); // located in functions-navigation.php
$offset = 0;
if(@$_GET['offset']){
    $offset = $_GET['offset'];
}
function getIcalDate($time, $inclTime = true)
{
    return date('Ymd' . ($inclTime ? '\THis' : ''), $time);
}



foreach($ros as $i =>$item){ // this is the top level of the event itself
   print $item['post']->post_title;
   $link = get_permalink($item['post']->post_title);
   $green_room_url = $item['meta']['green_room_url'][0];
   $start = intval($item['meta']['utc_start'][0]);
   $start = $start-(($offset*3600)*-1);// corrects timezone to minue hours
       
   
   
    $sessions = $item['children'];
    $speaker_status = [];
    $holds = [];
   foreach($sessions as $s => $session){
        if($session['post']->post_title == 'Break'){
          //  continue;
        }
  // var_dump($session); 
        $session_script = '';
       
       
        $speaker_status[$session['post']->ID] = [
            "session_time"=> date("H:i",$start),
                
            "session"=> @$session['post']->post_title,
            "speakers"=> [],
                
        ];
        
        



        $session_slug=sanitize_title($session['post']->post_title);
        $session_blurb= do_blocks($session['post']->post_content);
        $green_room_time = $start - (15*60);
        if(@$_GET['invites']){
        print "<h3>".$session['post']->post_title;
        print "</h3>";
        
        print "GREEN ROOM TIME: ".date("H:i",$green_room_time)."<BR>";
        print "START TIME: " .date("H:i",$start);
        print "DURATION: ".$session['meta']['duration'][0]." Minutes<BR>";
    }
        




      
        $speaker_emails = [];
        
        $moderator = '';
        $moderator_email = '';
        
        //*speakerS*/
       
       foreach($session['children'] as $p => $speaker){
           $moderated = '';
           $speaker_name = $speaker['post']->post_title;
            $profile_admin_url = '/wp-admin/post.php?post='.$speaker['post']->ID.'&action=edit';

            // BUILD META STATUS ARRAY
            $is_profile = false;
            if(@$speaker['post']->post_type == 'profile'){
            $is_profile == true;
            
            $speaker_status[$session['post']->ID]['speakers'][$speaker['post']->ID] = [
               
                    "speaker"=> $speaker_name,
                    "email"=> @$speaker['meta']['email'][0],
                    "signed_release"=>  @$speaker['meta']['signed_release'],
                    "calendar_sent"=>  @$speaker['meta']['calendar_sent'],
                    "calendar_confirmed"=>  @$speaker['meta']['calendar_confirmed'],
                    
                ];
                $send_calendar =  @$speaker['meta']['calendar_sent'][0];
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
            $session_script = $panel_script;
               
                    if(@$moderator == $speaker_name){

                        $moderated = ", moderated by you";

                    } else {
                        $moderated = "moderated by ".@$moderator." &lt;<a href='mailto:".@$moderator_email."&gt;'>".@$moderator_email."</a>&gt;, ";
                    }
                
                
                $script = $panel_script;
            } else if(in_array('presentation',explode(" ",$session['classes'][0]))){
                $moderated = "";

                $session_type='Presentation';
                $session_script = $presentation_script;

            } else if(in_array('interview',explode(" ",$session['classes'][0]))){
                
            
                if(in_array('interviewer',explode(" ",$speaker['classes'][0]))){
                    $moderator = $speaker_name;
                    $moderator_email = $speaker['meta']['email'][0];
                } else {
                    
    
                }
     
    
    
                
                $session_type='Interview';
                $session_script = $interview_script;
                   
                        if(@$moderator == $speaker_name){
    
                            $moderated = ", with you";
    
                        } else {
                            $moderated = " with ".@$moderator." &lt;<a href='mailto:".@$moderator_email."&gt;'>".@$moderator_email."</a>&gt;, ";
                        }
                    
                    
                    $script = $interview_script;

            }
           // var_dump($send_calendar, $is_profile);
            if(@$send_calendar == 0){
              
                print '<BR>Title:
                <input type="text" size="50" value="WebXR Business Summit '.@$session_type.'"><Br>';
                print "<BR>Location:";
                print '<input type="text" size="50" value="Streamyard: '.$green_room_url.'"><Br>';

            
                if(array_key_exists('email',$speaker['meta'])){
                    $end_time =  + $start+($session['meta']['duration'][0]*60);
                $session_script = personalizeScript($session_script,$session['post']->post_title,$speaker_name,$green_room_url,$start,$end_time,$green_room_time,$moderated);

                    array_push($speaker_emails,$speaker['title']. '&lt;'.$speaker['meta']['email'][0].'&gt;');
                    print '<BR>Emails:
                    <input type="text" size="50" value="'.$speaker['title']. '&lt;'.$speaker['meta']['email'][0].'&gt;'.'"><Br>';
                } else {
                    print "<span style='color:red'>NO EMAIL</span><BR>";
                }
            
            
                
                
                print '<div class="invitation" cols="80" rows="5">'.@$session_script.'</div>';



               
                ?>
           
                <?php

                print "<BR><BR>";
            } else {

            }?>


ICS
 <form method="post" action="<?php echo get_stylesheet_directory_uri();?>/download-ics.php">
                <input type="hidden" name="appt" value="<?=sanitize_title($speaker_name)."-".$session_slug?>">
                <input type="hidden" name="date_start" value="<?=getIcalDate($green_room_time)?>">
                <input type="hidden" name="date_end" value="<?=getIcalDate($end)?>">
                <input type="hidden" name="location" value="Streamyard <?=$green_room_url?>">
                <textarea style="visibility:hidden;" name="description"><?=addslashes($session_script)?></textarea>
                <input type="hidden" name="summary" value="WebXR Business Summit - Green Room">
                <input type="hidden" name="url" value="<?=$link?>">
                <input type="submit" value="Download ICS">
                
            </form>
            <?php

       }// partcipants loop
       if(@$_GET['moderators']==1){

       print '<BR>ALL Emails:<BR><textarea cols="80" rows="2">'.implode(",",$speaker_emails).'</textarea><BR>';
       }
       $start = $start + ($session['meta']['duration'][0]*60);

//       print "<hr>";
   }
   
    
}
$_REQUEST['status'] = [
    'calendar_sent'=>[],
    'calendar_confirmed'=>[],
    'signed_release'=>[],
    
];


function statusBoolField($status,$field){
    print "<td>";
    if($status == null){
        print "⌛";
        return false;
    } else if($status[0]=="0") {
        print "⌛";
        return false;

    } else {
        print "✅";
        return true;
    }
    print "</td>";

}




?>



<div class="row">
    <div class="container">
    <?php

//STATUS
print "<table id='speaker-status'>";
print "<tr>";
print "<th>TIME</th>";

print "<th>SPEAKER</th>";
print "<th>SESSION</th>";
print "<th>CALENDAR SENT</th>";
print "<th>CONFIRMED TIME</th>";
print "<th>RELEASE</th>";


print "</tr>";


$last_session = '';
foreach($speaker_status as $key => $value){
       
    print "<tr>";
    print "<th>".$last_session = $value['session_time']."</th>";
    print "<th>".$value['session']."</th>";
    print "<td colspan='4'></td>";
    
       

    foreach($value['speakers'] as $id => $speaker){
        if($value['session_time'] == $last_session){
            print "<tr><td colspan='6'><hr></td>";
        }

        print "<tr>";
        print "<td></td>";
        print "<td></td>";
        print "<td>".$speaker['speaker']."</td>";


        if(!statusBoolField($speaker['calendar_sent'],'calendar_sent')){
            array_push($_REQUEST['status']['calendar_sent'],[
                "speaker"=>$speaker['speaker'],
                'email'=>$speaker['email'],
            ]);
        }
        if(!statusBoolField($speaker['calendar_confirmed'],'calendar_confirmed')){
            array_push($_REQUEST['status']['calendar_confirmed'],[
                "speaker"=>$speaker['speaker'],
                'email'=>$speaker['email']
            ]);

        }
        if(!statusBoolField($speaker['signed_release'],'signed_release')){
            array_push($_REQUEST['status']['signed_release'],[
                "speaker"=>$speaker['speaker'],
                'email'=>$speaker['email']
            ]);
        }


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

    negativeStatus('calendar_sent');
    negativeStatus('calendar_confirmed');
    negativeStatus('signed_release');

?>
        <h3>HOLDS</h3>
<?php

    foreach($holds as $key =>$value){
        print "$value[session_time] $value[speaker] $value[session] <br>";
    }
?>


</div>
</div>

</div>

</div>

</div>




</div>
</div>


  </main>
  <?php get_footer(); ?>