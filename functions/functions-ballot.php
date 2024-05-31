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

function getJurorCandidates(){
    global $wpdb;
    $q = $wpdb->get_results("select ID, post_title from wp_posts where post_type ='profile'");
    print "<table>";
    foreach($q as $key=>$profile){
        $email = get_post_meta($profile->ID,'email',true);
        if($email != ''){
        print "<tr><td>$profile->post_title</td><td>$email</td></tr>";
    }   
    }


    print "</table>";



}


function get_ballot($award_id,$children,$counter){
    if(@$_POST['juror_id']){
        $ballot = getJurorBallot($award_id,$_POST['juror_id']);
      //  var_dump($ballot);

      if(@$ballot[$award_id]){
      print "<tr><th colspan='4'>You have already voted in this category ✅. <br>You may change your vote if you wish.</th>";
    } else{
        print "<tr><th colspan='4'>Click on the Nominee Name or Laurel to launch link your immersive Browser. Evaluation of Experience Nominations may only be done exclusively though an immersive browser. Do not use a 2D screen.<hr></th>";
    }

    print "<tr><th></th><th>First Choice</th><th>Second Choice</th><th>Third Choice</th>";

    foreach($children as $c =>$child){
      extract($child);
     
    //  print("<pre>".print_r($meta,true)."</pre>");
     // print $counter;
     $thumbnail_src = getThumbnail(@$meta['_thumbnail_id'][0],"thumbnail");
     if($classes[0] == 'honor'){
        continue;
     }
      if($classes[0] == 'presenter'){
        continue;
        print "<h4 class='presenter'>";
        if($thumbnail_src != '' && $counter == 0){
          print "<img src='$thumbnail_src' alt='$title' title='$title' class='nomination-thumbnail'>";
        }
        print "Presented by ";
      //  print @$meta['thumbnail_id']; 
        print "<span class='presented-by'>".$child['title'];
        print get_nominee_meta($child['meta']);
        print "</span></h4>";
       
      } else{
        $item_class = 'nominee';
        if($counter>0){
          $item_class = 'nominee-credit';
          
        }
        print "<tr>";
        print "<td class='$item_class'>";
        $nominee_id = $child['ID'];
     
        
        if($thumbnail_src != '' && $counter == 0){
            if(@$_meta['private_resource_url'][0]!=''){
               
                @$meta['resource_url'][0] = @$meta['private_resource_url'][0];
            }
            
      
            if(@$meta['resources'][0]!=''){
               
                @$meta['resource_url'][0] = @$meta['resources'][0];
            }
           if(@$meta['private_resource_url'][0] != NULL){
            $meta['resource_url'][0] = $meta['private_resource_url'][0];
           }
          if(@$meta['resource_url'][0] != '' ){
            $nominee_class= '';
            if($counter == 0){
                $nominee_class= 'nom';

            }

            print "<a href='".$meta['resource_url'][0]."' target='_blank' class='nominee-image $item_class'>";
          
           } else {
            print "<span class='nominee-image'>";
           }
          print "<img src='$thumbnail_src'  class='nomination-thumbnail'>";
          if(@$meta['resource_url'][0] != ''){

            print "</a>";
          
           } else {
            print "</span>";
          
           }
           if($classes[0] == 'winner'){
            print "<span class='winner'></span>";
          }  
          if(@$meta['resource_info_url'][0] != '' ){
            print "<a href='".$meta['resource_info_url'][0]."' target='_blank' class=' $item_class'>More Info about this Nominee</a>";
          }
        }
       
     // var_dump(@$ballot[$award_id]);
      print "</td>";

      $first_choice_checked = '';
      $second_choice_checked = '';
      $third_choice_checked = '';
      if($nominee_id == @$ballot[$award_id]['first_choice']){
        $first_choice_checked = ' checked';        
      }
      if($nominee_id == @$ballot[$award_id]['second_choice']){
        $second_choice_checked = ' checked';        
      }
      if($nominee_id == @$ballot[$award_id]['third_choice']){
        $third_choice_checked = ' checked';        
      }

      
      print  "<td class='choice $first_choice_checked'><input type='radio' name='award[$award_id][first_choice]' value='$nominee_id'". @$first_choice_checked.">
      ";
//print      countNomineeChoice($award_id,$nominee_id,"first");

      print "
      </td>";

      print "<td class='choice $second_choice_checked'><input type='radio' name='award[$award_id][second_choice]' value='$nominee_id' ".@$second_choice_checked."> ";
   //   print      countNomineeChoice($award_id,$nominee_id,"second");
      
            print "</td>";
      
      print "<td class='choice $third_choice_checked'><input type='radio' name='award[$award_id][third_choice]' value='$nominee_id' ".@$third_choice_checked."> ";
     // print      countNomineeChoice($award_id,$nominee_id,"third");
      
            print "</td>";

      print "</tr>";
      print "<tr><td colspan='4' class='nominee-info'>";
      print get_nominee_info($child,$counter);
       
      // print "|".@$child['meta']['github']."|";
     if(is_array(@$children)){
       $counter++;
       if($counter == 2 && count($children)){
         print ",";
       }
       get_nomination($children,$counter);
      
       $counter --;
     }
      print "</td></tr>";




      print "<tr><td colspan='4'><hr></td></tr>";
      }
      
      

    }
        }//!@ juror id; 
  }

  function countNomineeChoice($award_id,$nominee_id,$choice){
    global $wpdb;
    $sql = "Select count(*) as votes from award_ballot where award_id = $award_id and ".$choice."_choice = $nominee_id";
    if(@$_GET['revealcount']){}
    return $wpdb->get_var($sql);


  }
  




function xget_ballot($menu,$id){
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
function clearJurorBallot($award_id, $juror_id){
    global $wpdb;
    $wpdb->query("DELETE FROM award_ballot where award_id = $award_id and juror_id = $juror_id");

}

function updateJuror($field,$value,$id){
    global $wpdb;
   $sql = "update award_jurors set $field = '".$value."' where id = $id";
    $wpdb->query($sql);

}
function updateJurorBallot($award_id,$juror_id){
    //  $ballot = getJurorBallot($id);
  
      clearJurorBallot($award_id, $juror_id);//DELETES ALL
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
            $sql = "INSERT INTO `award_ballot` ( `juror_id`, `award_id`, `first_choice`, `second_choice`, third_choice, `vote_time`) VALUES ('$juror_id', '$award_id', '$value[first_choice]', '$value[second_choice]','$value[third_choice]', CURRENT_TIMESTAMP);";
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


function getJurorBallot($award_id,$juror_id){
     global $wpdb;
    $sql = "SELECT * FROM `award_ballot` where juror_id = '$juror_id'";
    $q = $wpdb->get_results($sql);

 
    if(count($q) == 0){
        

        updateJurorBallot($award_id,$juror_id);

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
function get_nom_name($id){
    global $wpdb;
  print   $sql = "select post_title from wp_posts where ID = $id";
    return $wpdb->get_var($sql);
}


function get_ballot_results(){
    global $wpdb;
    $sql = "SELECT distinct a.award_id, p.post_title FROM `award_ballot` a, wp_posts p where a.award_id = p.ID ";
    $awards = $wpdb->get_results($sql);

    foreach($awards as $key=>$value){
        print "$value->award_id $value->post_title";
        $sql = "SELECT first_choice, second_choice, third_choice
        from award_ballot
        where award_id = $value->award_id
        group by first_choice, second_choice, third_choice
        ";
        $distinct_noms = $wpdb->get_results($sql);
        foreach($distinct_noms as $key=>$noms){
            print $noms->first_choice;
            print get_nom_name($noms->first_choice);




            print "<br>";
        }


        print "<br>";
    }
    

}


?>
