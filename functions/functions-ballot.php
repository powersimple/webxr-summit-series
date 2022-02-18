<?php

function getJuror($email){
    
    global $wpdb;
    $sql = "select * from award_jurors where email = '$email'";
    $q = $wpdb->get_row($sql);
 
    return $q;


}
function getJurorLinks(){
    
    global $wpdb;
    $sql = "select * from award_jurors";
    $q = $wpdb->get_results($sql);
 
    foreach($q as $key => $value){
        $hash = md5($value->id."".$value->email);
        $url = 'https://webxrawards.com';
        $url = '';
        if($value->active == 0){
            print "$value->name <a href='$url/ballot/?invite=$hash'>Click Here to Accept Invitation</a><BR>";
        }
    }


    return $q;


}
function get_ballot($menu,$id){
    $nominations = get_nominations('polys2');
    
    $ballot = getJurorBallot($id);
    $last_award = 0;
    print "<form id='ballot-form' action='/ballot/' method='post'>
    <input name='juror_email' type='hidden' value='$_POST[juror_email]'>
    
    <input name='juror_id' type='hidden' value='$id'>";


    print '<table class="nominations">';

    foreach($nominations as $key => $nomination){
       // var_dump($nomination);
        extract($nomination);
        //$classes_array = explode("",$classes_array[0]){}
        if(in_array("nomination",explode(" ",$classes[0]))){
        $award_id = $nomination['id'];
        $counter = 1;
        if($counter == 1){
            print "<tr><th class='category' colspan='6'> $nomination[title]</th></tr>";
            foreach($nominees as $k => $nominee){
                extract($nominee);
                if($classes[0] == 'presenter'){
                    continue;                   
                }
                $nominee_id=$nominee['post']->ID;
                $type = $nominee['post']->post_type;
//                $thumbnail
                if($type == 'resource'){
                   
                    $link = @$nominee['meta']['resource_url'][0];
                } else if($type == 'profile'){
                    $link = @$nominee['meta']['website'][0];
                }

                $src = getThumbnail(get_post_thumbnail_id($nominee_id));
              print "<tr>
              <th rowspan='2'><a href='$link'><img class='thumb' src='$src' alt='$nominee[title]'></a>";
             // var_dump($nominee);
              print "</th>";

              print "<th rowspan='2'><a href='$link' target='_blank'>$nominee[title]</a><BR>
              </th>
              
                <th class='choice'>1st</th>
                <th class='choice'>2nd</th>
                <th class='choice'>3rd</th>
                </tr>";

                print "<tr class='nomination".@$row_class."'>";
                
                $first_choice = '';
                $second_choice = '';
                $third_choice = '';
                $first_choice_checked = '';
                $second_choice_checked = '';
                $third_choice_checked = '';


if(is_array($ballot)){
    
                if(array_key_exists($award_id,$ballot)){
                 
                        if($nominee_id == $ballot[$award_id]['first_choice']){
                            
                            $first_choice_checked = ' checked';
                          
                        }
                    if( $nominee_id == $ballot[$award_id]['second_choice']){
                           
                            $second_choice_checked = ' checked';
                        }
                        if( $nominee_id == $ballot[$award_id]['third_choice']){
                            $third_choice = @$ballot[$award_id]['third_choice'];
                            $third_choice_checked = ' checked';
        
    
                        }

                    }
                }
                print "
                <td class='choice'><input type='radio' name='award[$award_id][first_choice]' value='$nominee_id' $first_choice_checked></td>
                <td class='choice'><input type='radio' name='award[$award_id][second_choice]' value='$nominee_id' $second_choice_checked></td>
                <td class='choice'><input type='radio' name='award[$award_id][third_choice]' value='$nominee_id' $third_choice_checked></td>
                    
                    
  
    
                </tr>";
                
     
              

                   }
                        print "<tr><th colspan='3' class='cert'>
                        
                        ";
       if(@$award_id < 7){
       print "PLEASE SAVE NOW BEFORE PROCEEDING TO THE NEXT CATEGORY.<br>
       I affirm that have reviewed all the nominees in the Oculus Quest Browser this category before voting";
        } else {
             print "
             PLEASE SAVE NOW BEFORE PROCEEDING TO THE NEXT CATEGORY.
             I have reviewed these nominations.";
        }

       print "</td><td><input type='submit' value='SAVE' class='save'></td></tr>";


                    $counter++;




          
        }
        
        print "<BR>";
        }
    }
    print "</table></form>";
}


function getNominations(){
    global $wpdb;
    $sql = "SELECT * FROM `award_nominations`  where active = 1 order by sort";
    $q = $wpdb->get_results($sql);
    $nominations = array();
  
    foreach ($q as $key => $value) {
        if(!array_key_exists($value->award_id,$nominations)){
            $nominations[$value->award_id] = array();
        }
        array_push($nominations[$value->award_id],$value);
    }

    return $nominations;

}
function getJurorID(){
    global $wpdb;
    if(@$_POST['juror_email']){
      //  var_dump($p)
        $sql = "SELECT id FROM `award_jurors` where email = '$_POST[juror_email]'";

        return $wpdb->get_var($sql);
    }

}
function clearJurorBallot($id){
    global $wpdb;
    $wpdb->query("DELETE FROM award_ballot where juror_id = $id");

}

function updateJuror($field,$value,$id){
    global $wpdb;
   $sql = "update award_jurors set $field = '".$value."' where id = $id";
    $wpdb->query($sql);

}
function updateJurorBallot($id){
    //  $ballot = getJurorBallot($id);
  
      clearJurorBallot($id);//DELETES ALL
    global $wpdb;
  
    if(@$_POST['award']){

        foreach($_POST['award'] as $key => $value){
            if(!@$value['first_choice']){
                $value['first_choice'] = 0;
            }
            if(!@$value['second_choice']){
                $value['second_choice'] = 0;
            }
            if(!@$value['third_choice']){
                $value['third_choice'] = 0;
            }

            //INSERTS ALL NEW
            $sql = "INSERT INTO `award_ballot` ( `juror_id`, `award_id`, `first_choice`, `second_choice`, third_choice, `vote_time`) VALUES ('$id', '$key', '$value[first_choice]', '$value[second_choice]','$value[third_choice]', CURRENT_TIMESTAMP);";
            $wpdb->query($sql);


        }
    }
    
}
function getEmailList(){
    global $wpdb;
    $q = $wpdb->get_results("select post_id, meta_value as email from wp_postmeta where meta_key='email' and meta_value<>''");
    
    foreach($q as $key =>$value){
        $p = $wpdb->get_row("select post_title from wp_posts where ID = $value->post_id");
        
        print @$p->post_title."|".$value->email."<br>";
        
        
    }
}


function getJurorBallot($id){
     global $wpdb;
    $sql = "SELECT * FROM `award_ballot` where juror_id = '$id'";
    $q = $wpdb->get_results($sql);

 
    if(count($q) == 0){
        
        updateJurorBallot($id);
        return null;
    } else {
        $ballot = array();
        foreach ($q as $key => $value) {
           // var_dump($value);
           $ballot[$value->award_id] = (array) $value;
        }

        return $ballot;
    }
    

    


}
function insertVote($key,$value){
   
  

}

?>