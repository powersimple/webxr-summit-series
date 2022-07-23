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

$instructions = 'AWARD INFO';


$panel_script =  do_blocks($post->post_content);

$presentation_script = do_blocks($post->post_content);

$interview_script =do_blocks($post->post_content);


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


$nominations = [];
$nominees = [];
$nominee_list = [];
$award_list = [];
$counter=0;

?>
<div id="accordion" class="run-of-show">
   
   

 
</div>

<?Php








/*




foreach($ros as $i =>$item){ // outer loop.
    extract($item);
    if(!in_array("nomination",explode(" ",$classes[0]))){
       // continue;
      }
    print "<h3>".showCounter($counter)." | $title</h3>";
   // print "<strong>$slug</strong>";
    $current_award = $slug;
    $awards_list[$current_award] = $item['title'];
/*
print "<ol>";
    foreach($nominees as $c => $nominee){
       $current_nomination = $nominee['slug'];
      
       $id = $nominee['post']->ID;
       $type=$nominee['post']->post_type;
      


       if($type == 'profile'|| $type == 'resource'){
    }
        if(!in_array($current_nomination,$nominations)){
            $nominations[$current_nomination] = ["nominations"=>[],"nominee"=>[
                "name"=>$nominee['title'],
                "email"=>@$nominee['meta']['email'][0],
                "website"=>@$nominee['meta']['website'][0],
                "resource_url"=>@$nominee['meta']['resource_url'][0],
                "_thumbnail_id"=>@$nominee['meta']['_thumbnail_id'][0],
                
                
            ]];
            
         }

        array_push($nominations[$current_nomination]['nominations'],$current_award . " ". $current_nomination);

      

      
       print "<li><a href='/wp-admin/post.php?post=$id&action=edit' target='_blank'>$nominee[title]</a>";
    //    print " | ". $type. " | ";

        getMetaLink($nominee['meta'],'email');

        getMetaLink($nominee['meta'],'twitter');
        getMetaLink($nominee['meta'],'website');
        getMetaLink($nominee['meta'],'resource_url');
        
        print "</li>";


       $nominations = getNominee(@$nominee,$nominations,$current_award,$current_nomination);

 
   
    }
print "</ol>";



$counter++;


}


aggregateNominations($nominations);

function aggregateNominations($nominations){


    foreach($nominations as $n => $nominee){
        print $name= $nominee['nominee']['name'];
     print $email= $nominee['nominee']['email'];
        print"<BR>";
        $subject = "Poly Award Nomination";
        if(count($nominee['nominations'])>1){
            $subject = "Poly Award Nominations";
        }
        $body="test";
    
        foreach($nominee['nominations'] as $nom => $award){
         //  print $award;
            print @$awards_list[$award];
            
            print"<BR>";
    
    
        }
    
    
    
    
        if($email != ''){
        print "SUBJECT= $subject<BR>";
        print "<a href='mailto:$email?subject=$subject&body=$body'>EMAIL</a>";
            // print @var_dump($nominee);
        }
    
        print "<BR><BR>";
    }

}









*/

$ros = get_menu_array('edsummit22'); // located in functions-navigation.php
$offset = 0;
if(@$_GET['offset']){
    $offset = $_GET['offset'];
}














function get_other_speakers($this_speaker,$session){
    $panelists = [];
    if(in_array('panel',explode(" ",$session['classes'][0]))){
       
        foreach($session['children'] as $p => $speaker){
           
            if($this_speaker != $speaker['title']){
                array_push($panelists,$speaker['title']);

            //$with .="<li>$this_speaker".$session['post']->title;
        //    $with .= $session['post']->post_title;

               
            if(in_array('moderator',explode(" ",$speaker['classes'][0]))){


            }
            if($session['post']->post_title != $speaker['post']->post_title){
              //  $with .= $speaker['post']->post_title;
            }
            //$with .= "<a href='mailto:".@$speaker['meta']['email'][0]."'>".@$speaker['meta']['email'][0]."</a>";
            ///$with .= wrapSocial('website',@$speaker['meta']['website'][0]);
            //$with .= wrapSocial('twitter',@$speaker['meta']['twitter'][0]);
            //$with .= wrapSocial('linkedin',@$speaker['meta']['linkedin'][0]);
           // $with .= wrapSocial('github',@$speaker['meta']['github'][0]);
            
            
            
           
        }

        }
        $with = "Other invited panelists include: ";
        foreach($panelists as $key=>$panelist){
            if($key == (count($panelists)-1)){
                $with .= " and ";
            }
            if($panelist == 'Karen Alexander'){
                $with .= "myself, ";
            } else {
                $with .= "$panelist, ";
            }

            

            
            
            
        }
        return $with;
        
    }

}















foreach($ros as $i =>$item){ // this is the top level of the event itself
    //AWARD
    $item['post']->post_title;
   $link = get_permalink($item['post']->post_title);
   $green_room_url = @$item['meta']['green_room_url'][0];
   $start = intval(@$item['meta']['utc_start'][0]);
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
        $with = '';
     
        // var_dump($session);
        
        //*speakerS
       

       
       foreach($session['children'] as $p => $speaker){



           $moderated = '';
           $with = get_other_speakers($speaker['title'],$session) ;
           
           $speaker_name = $speaker['post']->post_title;
            $profile_admin_url = '/wp-admin/post.php?post='.$speaker['post']->ID.'&action=edit';

            // BUILD META STATUS ARRAY
            $is_profile = false;
            if(@$speaker['post']->post_type == 'profile'){
            $is_profile == true;
            
            $speaker_status[$session['post']->ID]['speakers'][$speaker['post']->ID] = [
               
                    "speaker"=> $speaker_name,
                    "email"=> @$speaker['meta']['email'][0],
                    "twitter"=> @$speaker['meta']['twitter'][0],
                    "linkedin"=> @$speaker['meta']['linkedin'][0],
                    "github"=> @$speaker['meta']['github'][0],
                    "invitation_sent"=>  @$speaker['meta']['invitation_sent'],
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
           


           if(in_array('panel',explode(" ",$session['classes'][0]))){
            
            
            if(in_array('moderator',explode(" ",$speaker['classes'][0]))){
                $moderator = $speaker_name;
                $moderator_email = $speaker['meta']['email'][0];
            } else {
             

            }

 


            
            $session_type='Panel';
            $session_script = $panel_script;
               
                    if(@$moderator == $speaker_name){

                        $moderated = "moderated by you.";

                    } else {
                        $moderated = "moderated by ".@$moderator.".";
                    }
                    
                   
                
                $script = $panel_script;
            } else if(in_array('presentation',explode(" ",$session['classes'][0]))){
                $moderated = "";
                $with="";
                $session_type='Presentation';
                $session_script = $presentation_script;

            } else if(in_array('interview',explode(" ",$session['classes'][0]))){
                
            
                if(in_array('interviewer',explode(" ",$speaker['classes'][0]))){
                    $with="";

                    $moderator = $speaker_name;
                    $moderator_email = $speaker['meta']['email'][0];
                } else {
                    
    
                }
     
    
    
                
                $session_type='Interview';
                $session_script = $interview_script;
                   
                        if(@$moderator == $speaker_name){
    
                            $with="";
                            $moderated = ", with you";
    

                        } else {
                            $moderated = " with ".@$moderator." &lt;<a href='mailto:".@$moderator_email."&gt;'>".@$moderator_email."</a>&gt;, ";
                        }
                    
                    
                    $script = $interview_script;

            }
          

           // var_dump($send_calendar, $is_profile);
            if(@$send_calendar == 0){
              
                //print '<BR>Title:
                //<input type="text" size="50" value="'.@$session_type." | ".$session['post']->post_title.' "><Br>';
                //print "<BR>Location:";
                //print '<input type="text" size="50" value="Restream: '.$green_room_url.'"><Br>';

                print "<h3>".$speaker['title']."</h3><BR>";
                
                    $end_time =  + $start+(@$session['meta']['duration'][0]*60);
                    $session_script = personalizeScript($session_script,$session['post']->post_title,$speaker_name,$green_room_url,$start,$end_time,$green_room_time,$moderated,$with);

                    array_push($speaker_emails,$speaker['title']. '&lt;'.@$speaker['meta']['email'][0].'&gt;');
                    $to = $speaker['title']. '&lt;'.@$speaker['meta']['email'][0].'&gt';
                    $subject = 'Invitation to the WebXR Education Summit '.@$session_type." | ".$session['post']->post_title;
                if(array_key_exists('email',$speaker['meta'])){
                    print '<BR>Email:
                    <input type="text" size="50" value="'.$to.'"><Br>';
                } else {
                   // continue;
                 
                    print "<span style='color:red'>NO EMAIL</span><BR>";
                }

                print '<BR>Subject:
                <input type="text" size="75" value="'.@$subject.'"><Br>
                <a href="mailto:'.@$to.'?cc=webxrevents@gmail.com&subject='.htmlentities(@$subject).'">Email</a>
                ';
            
                
                
                print '<div class="invitation" cols="80" rows="5">'.@$session_script.'</div>';



               
                $status = $speaker_status[$session['post']->ID]['speakers'][$speaker['post']->ID];
                //       print "<hr>";
                       ?>
                <table width="100%">
                
                
                       <?php
                   print "<tr>";
                        print "<td></td>";
                        print "<td></td>";
                        print "<td>$speaker_name </td>";
                
                        if(!statusBoolField($status['invitation_sent'],'Invitation Sent')){
                          
                        }
                        if(!statusBoolField($status['calendar_sent'],'Calendar Sent')){
                           
                        }
                        if(!statusBoolField($status['calendar_sent'],'Calendar Confirmed')){
                           
                        }
                        if(!statusBoolField($status['signed_release'],'Signed Release')){
                           
                        }
                
                
                        print "</tr>";
                
                ?></table>
                </hr>
                <BR><BR><BR>
                <?php

                print "<BR><BR>";
            } else {

            }?>

<!--
ICS
 <form method="post" action="<?php echo get_stylesheet_directory_uri();?>/download-ics.php">
                <input type="hidden" name="appt" value="<?=sanitize_title($speaker_name)."-".$session_slug?>">
                <input type="hidden" name="date_start" value="<?=getIcalDate($green_room_time)?>">
                <input type="hidden" name="date_end" value="<?=getIcalDate($end)?>">
                <input type="hidden" name="location" value="Restream <?=$green_room_url?>">
                <textarea style="visibility:hidden;" name="description"><?=addslashes($session_script)?></textarea>
                <input type="hidden" name="summary" value="WebXR Design Summit - Green Room">
                <input type="hidden" name="url" value="<?=$link?>">
                <input type="submit" value="Download ICS">
                
            </form>-->
            <?php

       }// partcipants loop

       if(@$_GET['moderators']==1){

       print '<BR>ALL Emails:<BR><textarea cols="80" rows="2">'.implode(",",$speaker_emails).'</textarea><BR>';
       }



       $start = $start + (@$session['meta']['duration'][0]*60);
     

   }
   
    
}
$_REQUEST['status'] = [
    'calendar_sent'=>[],
    'calendar_confirmed'=>[],
    'signed_release'=>[],
    
];





?>



<div class="row">
    <div class="container">
    <?php
    var_dump($speaker_status);
/*
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
*/

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

/*

*/


?>
<!--
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


  </main>-->
  <?php get_footer(); ?>