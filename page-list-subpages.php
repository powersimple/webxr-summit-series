<a href="?companies=1&event_menu=bizsummit21">Business Summit Companies</a>



<?php
$count = 0;

$offset = 0;
    if(@$_GET['offset']){
        $offset = $_GET['offset'];
    }
    function getIcalDate($time, $inclTime = true)
    {
        return date('Ymd' . ($inclTime ? '\THis' : ''), $time);
    }


function getRunOfShow($summit="DevSummit21"){
    $ros = get_menu_array($summit);
    foreach($ros as $i =>$item){ // this is the top level of the event itself
        print $summit_name = $item['post']->post_title;
        $link = get_permalink($item['post']->post_title);
        @$green_room_url = @$item['meta']['green_room_url'][0];
        $start = intval($item['meta']['utc_start'][0]);
        $start = $start-((@$offset*3600)*-1);// corrects timezone to minue hours
            
        
        
            $sessions = $item['children'];
            $speaker_status = [];
            $holds = [];
        foreach($sessions as $s => $session){
                if($session['post']->post_title == 'Break'){
                  continue;
                }
            // var_dump($session); 
                $session_script = '';
            
            
                $speaker_status[$session['post']->ID] = [
                    "session_time"=> date("H:i",$start),
                    "embed_video_url"=>  get_post_meta($session['post']->ID,'embed_video_url',true),
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
                
            
                $panelists = [];
                if(in_array('panel',explode(" ",$session['classes'][0]))){
                    $with .= '<strong>Panel Contact Info</strong><br><ul>';
                    foreach($session['children'] as $p => $speaker){
                        $with .="<li>";
                    


                        if(in_array('moderator',explode(" ",$speaker['classes'][0]))){


                        }
                        $with .=$speaker['post']->post_title ." - ";
                        
                    //  $with .= "<a href='mailto:".$speaker['meta']['email'][0]."'>".$speaker['meta']['email'][0]."</a>";
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
            }
        }

    }
    return $speaker_status;
}
print "<br>";

 //   print "the $summit_name video playlist is now live";
    print "<br>";
    $total = 65;
 $count =  displaySummitTweets("WebXR Developer Summit: ",'DevSummit21',1,$total);
 $count = displaySummitTweets("WebXR Business Summit: ",'BizSummit21',23,65);
 $count = displaySummitTweets("WebXR Design Summit: ", 'DesignSummit21',43,65);



function displaySummitTweets($summit_name, $summit,$count,$total){
    $skip_one = 0;
    $speaker_status = getRunOfShow($summit);
    foreach($speaker_status as $key=>$session){
//var_dump($session);
        if($skip_one==0){
            $skip_one++;
            continue;
        }
        if($session['session'] == "Break"){
            //continue;
        }
        
        ob_start();    
    
        
        print $count ."/". $total." ".$summit_name." ". $session['session']." thanks - ";
            $speakers = [];
            foreach ($session['speakers'] as $id => $speaker){
                
           //     array_push($speakers,str_replace("https://twitter.com/",$speaker['speaker']." @",$speaker['twitter']));//build list of speakers
                    array_push($speakers,$speaker['speaker']);
 
 
            }
            print implode(", ",$speakers); //clean list of speakers
            print " ".$session['embed_video_url'];
            // print explode(""," ".$session['embed_video_url'])[0];
                

            $list=ob_get_clean();//makes single string
            $len = strlen($list); //counts it.
            $style="";
            if($len>280){
                $style=' style="color:red"';
            }
            print "<input $style type='text' size='$len' value='$list'>";
        print $len;
            
        print "<BR>";  print "<BR>";
        $count++; 
    }
    return $count;
}



/*
function getMetaList($key){
    global $wpdb;
    $q=$wpdb->get_results("select distinct meta_key, meta_value from wp_postmeta where meta_key='company' order by meta_value");
    foreach($q as $key =>$value){
        print $value->meta_value."<br>";
    }
}
getMetaList("company");
*/

?>