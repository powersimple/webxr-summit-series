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
function get_ballot($menu){
    $nominations = get_nominations('polys2');
    $last_award = 0;
    print "<form id='ballot-form' action='/ballot/' method='post'>
    <input name='juror_email' type='hidden' value='$_POST[juror_email]'>";
    print '<table class="nominations">';

    foreach($nominations as $key => $nomination){
       // var_dump($nomination);
        extract($nomination);
        //$classes_array = explode("",$classes_array[0]){}
        if(in_array("nomination",explode(" ",$classes[0]))){
        print $title;
        print "<br>";
        $counter = 1;
        if($counter == 1){
            print "<tr><th class='category' colspan='4'>$value->category</th></tr>";
              print "<tr>
              <th></th>
                <th>Nominee</th>
              
                <th class='choice'>1st</th>
                <th class='choice'>2nd</th>
              
              
              </tr>";     
                   }
        foreach($nominees as $k => $nominee){
            print $nominee['title'];
            print "<br>";
        }
        
        print "<BR>";
        }
    }
    print "</table></form>";
}


function getBallot($id){
     
    $nominations = getNominations();
    $ballot = getJurorBallot($id);
   
    $last_award = 0;
    print "<form id='ballot-form' action='/ballot/' method='post'>
    <input name='juror_email' type='hidden' value='$_POST[juror_email]'>";
    print '<table class="nominations">';
    // var_dump($ballot);
    foreach($nominations as $key => $nomination){
      // 
  //      print $nomination->award_id;
  
      $counter = 1;
        foreach($nomination as $nom => $value){
           $first_choice_checked = '';
           $second_choice_checked = '';
           $row_class="odd";
         
           if($counter/2 == intval($counter/2)){
               $row_class="even";
           }
            if($counter == 1){
        print "<tr><th class='category' colspan='4'>$value->category</th></tr>";
          print "<tr>
          <th></th>
            <th>Nominee</th>
          
            <th class='choice'>1st</th>
            <th class='choice'>2nd</th>
          
          
          </tr>";     
               }
$award_id = $value->award_id;
               if(array_key_exists($value->award_id,$ballot)){
                
                    if($value->id == $ballot[$value->award_id]['first_choice']){
                       
           $first_choice_checked = ' checked';
 
                    }
 if( $value->id == $ballot[$value->award_id]['second_choice']){
                   
                    $second_choice_checked = ' checked';

                    }

               }

             
                print "<tr class='nomination $row_class'>
                <td class='thumb'><a href='$value->link' target='_blank'><img src='/assets/images/nominees/$value->image' class='thumb'></a>
                    <td class='nominee'><a href='$value->link' target='_blank'>$value->nomination</a>
                    <BR>$value->nominee</td>
                    <td class='choice'><input type='radio' name='award[$value->award_id][first_choice]' value='$value->id' $first_choice_checked></td>
                    <td class='choice'><input type='radio' name='award[$value->award_id][second_choice]' value='$value->id' $second_choice_checked></td>
                    

    
                </tr>";
            $counter++;
        }
       print "<tr><th colspan='3' class='cert'>";
       if($award_id < 7){
       print "I have reviewed all the nominees in the Oculus Quest Browser this category before voting";
        } else {
             print "I have reviewed these nominations.";
        }

       print "</td><td><input type='submit' value='SAVE' class='save'></td></tr>";

       // $last_award = $nomination->award_id;



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
     $sql = "SELECT id FROM `award_jurors` where email = '$_POST[juror_email]'";
    return $wpdb->get_var($sql);
}
function clearJurorBallot($id){
    global $wpdb;
    $wpdb->query("DELETE FROM award_ballot where juror_id = $id");

}
function updateJurorBallot($id){
    //  $ballot = getJurorBallot($id);

      clearJurorBallot($id);//DELETES ALL
    global $wpdb;
   
 
        foreach($_POST['award'] as $key => $value){
            //INSERTS ALL NEW
            $sql = "INSERT INTO `award_ballot` ( `juror_id`, `award_id`, `first_choice`, `second_choice`, `vote_time`) VALUES ('$id', '$key', '$value[first_choice]', '$value[second_choice]', CURRENT_TIMESTAMP);";
            $wpdb->query($sql);


        }
    


}

function getJurorBallot($id){
     global $wpdb;
    $sql = "SELECT * FROM `award_ballot` where juror_id = '$id'";
    $q = $wpdb->get_results($sql);
    
    
    if(count($q) == 0){
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