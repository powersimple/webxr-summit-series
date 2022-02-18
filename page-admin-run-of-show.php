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

$panel_script = "Dear [NAME],<br><br>
We are both thrilled and grateful for your participation in the WebXR Design Summit. We're looking forward to a fun, colorful and lively event, because after all... this about creativity! 
Thank you for joining our panel <strong>[SESSION]</strong> at the <strong>WebXR Design Summit on the 12th of October, </strong>[MODERATION]<BR><BR>[WITH]
$instructions";

$presentation_script = "Dear [NAMEd],<br><br>
We are excited for your presentation titled [SESSION] at the <strong>WebXR Design Summit on the 12th of October</strong>.<br><br>
$instructions";

$interview_script = "Dear [NAME],<br><br>
We are excited for your interview [SESSION][MODERATION] at the <strong>WebXR Design Summit on the 12th of October</strong>.<br><br>
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


function getNominee($nominee,$nominations,$current_award,$current_nomination){

    if(count(@$nominee['children'])){
//     
        
        foreach($nominee['children'] as $n => $child){
            print "<tr>";
        //    var_dump($child);
            extract($child);
            $id = $child['post']->ID;
            $type=$child['post']->post_type;
            if($type == 'profile' || $type == 'resource'){
                if(!is_array(@$nominations[$child['slug']])){
                    $nominations[$child['slug']] = ["nominations"=>[],"nominee"=>[
                        "name"=>$child['title'],
                        "email"=>@$child['meta']['email'][0],
                        "website"=>@$child['meta']['website'][0],
                        "resource_url"=>@$child['meta']['resource_url'][0],
                        "_thumbnail_id"=>@$child['meta']['_thumbnail_id'][0],
                    ]];
                  
                 }
                 array_push($nominations[$child['slug']]["nominations"],$current_award);
           
            
         //           array_push($nominations[$current_nomination],$nominee);
            }
         
            $src = getThumbnail(get_post_thumbnail_id($child['post']->ID));
            print "<td>".@$class[0]."</td>";   
        print "<td>";
        if($src != ''){
        print "<img src='$src' alt='".$nominee['post']->post_title."'></td>";
    }
            print "<td>";
           
            print "<a href='/wp-admin/post.php?post=$id&action=edit' target='_blank'>$child[title]</a>";
            print "</td>";
        //    print " | ". @$type. " | ";


            // $child[slug]
           // var_dump($child['meta']);
           
          


           getMetaLink($child['meta'],'email','td');

           getMetaLink($child['meta'],'twitter','td');
           getMetaLink($child['meta'],'website','td');
           getMetaLink($child['meta'],'resource_url','td');
            print "<td>";
            
            print "</td>";
            print "</tr>";
            $nominations = getNominee(@$child,$nominations,$current_award,$current_nomination);
            
        }
//        print "</tr>";

    }
    return $nominations;

}



//$ros = get_nominations('polys2');



function showCounter($counter){
    if($counter<10){
        return "0".$counter;
    }
    return $counter;
}

function getNominees(){

}




$nominations = [];
$nominees = [];
$nominee_list = [];
$award_list = [];
$counter=0;
function getRunOfShowAccordion($ros){
    
    $nominations = [];
    $nominees = [];
    $nominee_list = [];
    $award_list = [];
    $counter = 0;
    
    foreach($ros as $i =>$item){ // outer loop.
        extract($item);
    

        $current_award = $slug;
        $awards_list[$current_award] = $item['title'];
        
        if(!in_array("nomination",explode(" ",$classes[0]))){
           // continue;
          }
         // var_dump($duration = @$item['meta']);
         if( $duration = @$item['meta']['duration'][0]){
          
         } else {
             $duration = 210;
          }
          $length = gmdate("i:s", $duration);
          $start = @$meta['utc_start'][0];
           
          if($start != '' && $start != 0){
            $start_date_time = date("m-d h:ia",$start);  
            $current_time = $start;
          }  else {

          
            $start_date_time = date("h:ia",$current_time);
          }
          @$current_time = $current_time + $duration;
          
          $the_time = date("H:m",$current_time);

        print "<h3><span class='ros-event'>".showCounter($counter)." | $title </span><span class='ros-time'>$start_date_time | $length</span></h3>";
        print "<div>"; 
    if(@$meta['show_journal'][0]){
        if(@$_GET['cues']){

       
        print "<div class='show-journal'>". @$meta['show_journal'][0]."</div>";
    }

    }

        

        
        if(is_array($nominees)){
        print "<table class='segment'>";
        foreach($nominees as $c => $nominee){
            extract($nominee);
            

            $class= explode(" ",$classes[0]);
            //var_dump($class);
            
           $current_nomination = $nominee['slug'];
          
           $id = $nominee['post']->ID;
           $type=$nominee['post']->post_type;
          $thumbnail = @$nominee['meta']['_thumbnail_id'][0];
       
    
           if($type == 'profile'|| $type == 'resource'){
        }
            if(!in_array($current_nomination,$nominations)){
            }
                $nominations[$current_nomination] = ["nominations"=>[],"nominee"=>[
                    "name"=>$nominee['title'],
                    "email"=>@$nominee['meta']['email'][0],
                    "website"=>@$nominee['meta']['website'][0],
                    "resource_url"=>@$nominee['meta']['resource_url'][0],
                    "_thumbnail_id"=>@$nominee['meta']['_thumbnail_id'][0],
                    
                    
                ]];
                
            
    
            array_push($nominations[$current_nomination]['nominations'],$current_award . " ". $current_nomination);
    
          
            print "<tr><td colspan='9'><hr></td></tr>";
          
           print "<tr class='$classes[0]'>";
      
           if(in_array('presenter',$class)){
        
            }  

        $src = getThumbnail(get_post_thumbnail_id($nominee['post']->ID));

            print "<td class='designation'>".ucfirst($class[0])."</td>";   
        print "<td class='thumbnail'>";
        if($src){
        print "<img src='$src' alt='".$nominee['post']->post_title."'>";
    
        
        }
        print "</td>";
           print"<td class='name' ><a href='/wp-admin/post.php?post=$id&action=edit' target='_blank'>$nominee[title]</a></td>";
        //    print " | ". $type. " | ";
    

            getMetaLink($nominee['meta'],'email','td');
    
            getMetaLink($nominee['meta'],'twitter','td');
            getMetaLink($nominee['meta'],'website','td');
            getMetaLink($nominee['meta'],'linkedin','td');
            getMetaLink($nominee['meta'],'instagram','td');
            

            getMetaLink($nominee['meta'],'resource_url','td');
            
            print "</tr>";
           
            if(@$_GET['credential']){
                print "<tr><td>";
                print "<td colspan='9'>";
                print "<textarea cols='30' rows='5'>";
print $nominee['post']->post_title;
print "
";
                if(@$nominee['meta']['profile_title'][0]){
print $nominee['meta']['profile_title'][0].", ";
                }
                if(@$nominee['meta']['company'][0]){
print $nominee['meta']['company'][0];
                 }
                 
                 if(@$nominee['meta']['twitter'][0]){
print "
";
                    
print str_replace("https://twitter.com/","@",$nominee['meta']['twitter'][0]);
                 }
                 print "</textarea>";

 
              // var_dump($nominee['meta']);
                print "</td>";
                print "</td></tr>";

            }
    
    
           $nominations = getNominee(@$nominee,$nominations,$current_award,$current_nomination);
    
     
       
        }
    print "</table>";
    } else {//not an array of nominees

    }
   

        print"</div>";
        

        $counter++;

        }//run of show
}

?>
<div id="accordion" class="run-of-show">
   
    <?php
    $vrc = get_nominations('virtual-red-carpet-2');
    getRunOfShowAccordion($vrc);
    ?>

    <?php
    $ceremony = get_nominations('polys2');
    getRunOfShowAccordion($ceremony);
    ?>
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


}*/


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











$ros = get_menu_array('polys2'); // located in functions-navigation.php
$offset = 0;
if(@$_GET['offset']){
    $offset = $_GET['offset'];
}
















/*














foreach($ros as $i =>$item){ // this is the top level of the event itself
    //AWARD
    print $item['post']->post_title;
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
        
        //*speakerS
        $panelists = [];
        if(in_array('panel',explode(" ",$session['classes'][0]))){
            $with .= '<strong>Panel Contact Info</strong><br><ul>';
            foreach($session['children'] as $p => $speaker){
                $with .="<li>";
              


                if(in_array('moderator',explode(" ",$speaker['classes'][0]))){


                }
                $with .=$speaker['post']->post_title ." - ";
                
                $with .= "<a href='mailto:".$speaker['meta']['email'][0]."'>".$speaker['meta']['email'][0]."</a>";
                $with .= wrapSocial('website',@$speaker['meta']['website'][0]);
                $with .= wrapSocial('twitter',@$speaker['meta']['twitter'][0]);
                $with .= wrapSocial('linkedin',@$speaker['meta']['linkedin'][0]);
                $with .= wrapSocial('github',@$speaker['meta']['github'][0]);
                
                
                
                $with .="</li>";

            }
            $with .="</ul>";
            
        }

       
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
                    "twitter"=> @$speaker['meta']['twitter'][0],
                    "linkedin"=> @$speaker['meta']['linkedin'][0],
                    "github"=> @$speaker['meta']['github'][0],
                    
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
              
                print '<BR>Title:
                <input type="text" size="50" value="Poly Nomination: '.@$session_type." | ".$session['post']->post_title.' "><Br>';
                print "<BR>Location:";
                print '<input type="text" size="50" value="Restream: '.$green_room_url.'"><Br>';

            
                if(array_key_exists('email',$speaker['meta'])){
                    $end_time =  + $start+(@$session['meta']['duration'][0]*60);
                    $session_script = personalizeScript($session_script,$session['post']->post_title,$speaker_name,$green_room_url,$start,$end_time,$green_room_time,$moderated,$with);

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