


<?Php








/*

//AWRARDS LOOP


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

 // located in functions-navigation.php






$invitation_statuses = [
    "team"=>[],
    "no-status"=>[],
    "needs-invite"=>[],
    "invited"=>[],
    "agreed"=>[],
    "registered-no-release"=>[],
    "registered"=>[],
    "calendar-sent"=>[],
    "calendar-sent-no-release"=>[],
    "calendar-sent-no-registration"=>[],
    
    "confirmed-no-registration"=>[],
    "confirmed-no-release"=>[],


    "prerecord"=>[],
    
    "complete"=>[]

];



if(@$_GET['calendar']){
    print "<a href='?'>Invite mode</a>";
} 
 else if (@$_GET['follow-up']) {
    print "<a href='?follow-up=1'>Followup mode</a>";
} else {
    print "<a href='?calendar=1'>Calendar mode</a>";
}
print "<hr><BR>";



?>




<legend class="invite-legend">
    <strong style="color:#fff">LEGEND - INVITATION COLOR CODES</strong>
    <li class="no-status">NO STATUS</li>
    <li class="team">Team</li>
    <li class="needs-invite">Needs Invitation</li>
    <li class="invited">Invited</li>
    <li class="agreed">Agreed</li>
    <li class="registered-no-release">Registered (release not signed)</li>
    <li class="registered">Registered</li>
    <li class="calendar-sent">Calendar Sent</li>
    <li class="calendar-sent-no-registration">Calendar Sent (no Registration)</li>
    <li class="calendar-sent-no-release">Calendar Sent (no Release Signed)</li>
    <li class="confirmed-no-registration">Calendar Confirmed (no Registration)</li>
    <li class="confirmed-no-release">Calendar Confirmed (no Release Signed)</li>
    <li class="prerecord">Session Prerecorded</li>    
    <li class="complete">Registration Confirmed and Complete</li>

</legend>


<?php




$offset = -4;
if(@$_GET['offset']){
    $offset = $_GET['offset'];
}




//EVENT LEVEL
foreach($ros as $i =>$item){ // this is the top level of the event itself
    //AWARD
   $event_title = $item['post']->post_title;
   $link = get_permalink($item['post']->post_title);
    $session_type = @$item['event_type'][0];
   $green_room_url = @$item['meta']['green_room_url'][0];
   $release_form_url = @$item['meta']['release_form_url'][0];
 



   $start = intval(@$item['meta']['utc_start'][0]);
   $start = $start-(($offset*3600)*-1);// corrects timezone to minue hours
       
   
   
    $sessions = $item['children'];
    $speaker_status = [];
    $holds = [];
    $session_counter = 0;


    //SESSION LEVEL
   foreach($sessions as $s => $session){ // THIS IS THE EVENT SESSION LOOP


    $display_session_counter = $session_counter;
    if($session_counter<10){{
        $display_session_counter = "0".$session_counter;
    }}
    $duration = @$session['meta']['duration'][0]." Minutes";
    $duration = @$session['meta']['event_length_seconds'][0]." seconds";
    


//    var_dump($session);
    $session_type = @$session['event_type'];
    if($session_type ==  ''){
        PRINT $session_type = "<STRONG>SESSION TYPE NOT SET</STRONG>";                
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
        print "$duration<BR>";
    }
        
    print "<h2>$display_session_counter ".date("h:ia",$start)."<span class='session-name'>".$session['post']->post_title."</span>"."<BR>".strtoupper($session_type)." $duration</h2>";
    if($session['post']->post_title == 'Break'){
      //  continue;
    }



      
        $speaker_emails = [];
        
        $moderator = '';
        $moderator_email = '';
        $with = '';
     
        // var_dump($session);
        
        //*speakerS
       

        //SPEAKER LEVEL
       foreach($session['children'] as $p => $speaker){ // THIS IS THE SPEAKER LOOP
            
           $guest_type = @$speaker['guest_type'];
            if($guest_type ==  ''){
              PRINT $guest_type = "<STRONG>GUEST TYPE NOT SET</STRONG>";                
            }

        
           $moderated = '';
           $with = get_other_speakers($speaker['title'],$session) ;
           
           $speaker_name = $speaker['post']->post_title;
            $profile_admin_url = '/wp-admin/post.php?post='.$speaker['post']->ID.'&action=edit';

            // BUILD META STATUS ARRAY
            $is_profile = false;
            if(@$speaker['post']->post_type == 'profile'){
            $is_profile == true;
            
            $speaker_status[$session['post']->ID]['speakers'][$speaker['post']->ID] = [
                    "id"=> $speaker['post']->ID,
                    "speaker"=> $speaker_name,
                    "email"=> @$speaker['meta']['email'][0],
                    "twitter"=> @$speaker['meta']['twitter'][0],
                    "linkedin"=> @$speaker['meta']['linkedin'][0],
                    "github"=> @$speaker['meta']['github'][0],
                    "confirmation_status"=>  @$speaker['confirmation_status'],
                    "point_of_contact"=>  @$speaker['point_of_contact'],
                    "notes"=>  @$speaker['notes'],
                  
                    
                    

                ];
                $status = $speaker_status[$session['post']->ID]['speakers'][$speaker['post']->ID];
                $confirmation_status = $status['confirmation_status'];
                $point_of_contact = $status['point_of_contact'];
                $notes = $status['notes'];
                $meta = $status;
                


                $this_status=[];
                $this_status['speaker_info'] = $status;
                $this_status['session_name'] = $session['post']->post_title;
                $this_status['guest_type'] = $guest_type;
                
                
                if($point_of_contact!=null && $point_of_contact!=""){
                    $this_status['point_of_contact']=$point_of_contact;
                } else {
                    $this_status['point_of_contact'] = "";
                }
                if($notes!=null && $notes!=""){
                    $this_status["notes"]=$notes;
                } else {
                    $this_status["notes"] = "";
                }
                if($confirmation_status == NULL || $confirmation_status == ''){
                    $confirmation_status = "no-status";
                }
               // print "$confirmation_status";

               
                array_push($invitation_statuses["$confirmation_status"],
                                                $this_status
                                                );

                
        
                $send_calendar =  @$speaker['meta']['calendar_sent'][0];
            } else {
                array_push($holds,
                    [  "session_time"=> date("H:i",$start),
                            "session"=> @$session['post']->post_title,
                        "speaker"=> $speaker_name
                    ]
                );
            }
           


           
            
            
          
           

 


            if($guest_type == 'moderator'){
                $moderator = $speaker_name;
                $moderator_email = $speaker['meta']['email'][0];
            $session_script = $panel_script;
               
                    if(@$moderator == $speaker_name){

                        $moderated = "moderated by you.";

                    } else {
                        $moderated = "moderated by ".@$moderator.".";
                    }
                    
                   
                
                $script = $panel_script;
            } else if($guest_type == 'panelist'){
                $moderated = "";
                $with="";
                $session_type='Presentation';
                $session_script = $presentation_script;

            } else if($guest_type == 'presenter'){
                $moderated = "";
                $with="";
                $session_type='Presentation';
                $session_script = $presentation_script;


            } else if($guest_type == 'interviewee'){
                
            
                if(in_array('interviewer',explode(" ",$speaker['classes'][0]))){
                    $with="";

                    $moderator = $speaker_name;
                    $moderator_email = $speaker['meta']['email'][0];
                } else {
                    
    
                }
     
    
    
                
                $session_type='Interview';
                $session_script = @$interview_script;
                   
                        if(@$moderator == $speaker_name){
    
                            $with="";
                            $moderated = ", with you";
    

                        } else {
                            $moderated = " with ".@$moderator." &lt;<a href='mailto:".@$moderator_email."&gt;'>".@$moderator_email."</a>&gt;, ";
                        }
                    
                    
                    $script = @$interview_script;

            }
          

           // var_dump($send_calendar, $is_profile);
        
              
                //print '<BR>Title:
                //<input type="text" size="50" value="'.@$session_type." | ".$session['post']->post_title.' "><Br>';
                //print "<BR>Location:";
                //print '<input type="text" size="50" value="Restream: '.$green_room_url.'"><Br>';


               


                print "<li class='".$confirmation_status."'>$guest_type ".$speaker['title']." ".$confirmation_status."<BR>";
                print "<span class='confirmation-notes'>".ucfirst($point_of_contact)." $notes";
                //var_dump($meta);
                print "</span></li>";

                if(@$_GET['calendar']){

                    if($confirmation_status == 'registered' || $confirmation_status == 'registered-no-release'|| $confirmation_status == 'agreed' || $confirmation_status == 'invited'){
                        print '<div class="admin-invitation">';
                        print "<h3>Calendar Invitation</h3>";

                        getCalendarInvite($session,$item['meta'],$speaker,$start); 
                        print '</div>';

                    }


                } else if(@$_GET['followup']){
print "FOLLOWUP";

                    
                } else {
                    if($confirmation_status == 'needs-invite'){
                    


                        print '<div class="admin-invitation">';
                        print "<h3>Initial Invitation</h3>";
                    
                        $end_time =  + $start+(@$session['meta']['duration'][0]*60);
                        $session_script = personalizeScript($session_script,$session['post']->post_title,$speaker_name,$green_room_url,$start,$end_time,$green_room_time,$moderated,$with,$session['classes'][0]);

                        array_push($speaker_emails,$speaker['title']. '&lt;'.@$speaker['meta']['email'][0].'&gt;');
                        $to = $speaker['title']. '&lt;'.@$speaker['meta']['email'][0].'&gt';
                        $subject = 'Invitation to the '.$event_title.' '.@$session_type." | ".$session['post']->post_title;
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
                    print '</div>';


                
                    //       print "<hr>";
                        ?>
                    <table width="100%">
                    
                    
                        <?php
                    print "<tr>";
                            print "<td></td>";
                            print "<td></td>";
                            print "<td>$speaker_name </td>";
                            print "<td>";
                                
                            print "</td>";
                    /*
                            if(!statusBoolField($status['invitation_sent'],'Invitation Sent')){
                            
                            }
                            if(!statusBoolField($status['calendar_sent'],'Calendar Sent')){
                            
                            }
                            if(!statusBoolField($status['calendar_sent'],'Calendar Confirmed')){
                            
                            }
                            if(!statusBoolField($status['signed_release'],'Signed Release')){
                            
                            }
                    */
                    
                            print "</tr>";
                    
                    ?></table>
                    </hr>
                    <BR><BR><BR>
                    <?php

                    print "<BR><BR>";
                } else {

                }
            }
            
            
            ?>

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
       print "<hr>";
       if(@$_GET['moderators']==1){

       print '<BR>ALL Emails:<BR><textarea cols="80" rows="2">'.implode(",",$speaker_emails).'</textarea><BR>';
       }



       $start = $start + (@$session['meta']['duration'][0]*60);
     
       $session_counter++;
   }
   
    
}

foreach($invitation_statuses as $is => $invitation_status){
    print "<span class='$is'>".strtoupper(str_replace("_","",$is)).'</span><br><ol class="$is">';
            foreach($invitation_status as $key=>$status){
                extract($status);
                extract($speaker_info);
                
                print "<li class='$is'>$session_name | <a target='_new' href='/wp-admin/post.php?action=edit&post=$id'><span class='$is'>".$speaker."</span></a> $guest_type";
                if($email !=""){
                    print " | <a class='email' href='mailto:$email'>$email</a>";
                } else {
                    print "NO EMAIL";
                }
                if($linkedin !=""){
                    print " | <a href='$linkedin' target='_blank'><i class='fa fa-linkedin'></i></a>";
                }
                if($email !=""){
                    print " | <a href='$twitter' target='_blank'><i class='fa fa-twitter'></i></a>";
                }
                print "<span class='status-notes'>";
                if($point_of_contact !=""){
                    print " | $point_of_contact";
                }
                
                if($notes!=""){
                    print " | $notes";
                }
                print "</span></li>";

            }
            print '</ol><hr>';

        }









//var_dump($invitation_statuses);
$_REQUEST['status'] = [
    'calendar_sent'=>[],
    'calendar_confirmed'=>[],
    'signed_release'=>[],
    
];





?>

