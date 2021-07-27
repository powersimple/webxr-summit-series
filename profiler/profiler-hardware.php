This is a backup of the code used to match hardware data to profiles

function getHardware(){
    global $wpdb;
    $sql = "SELECT ID, post_title from wp_posts where post_type ='hardware' and post_status = 'publish' and post_parent <> 0 order by post_title";
    $q = $wpdb->get_results($sql);
    $results = array();

    foreach($q as $key => $value){
     array_push($results,$value);
      print "$value->post_title<BR>";
      /*
      if($value->meta_value <> NULL){

        $ids = "SELECT post_id  FROM `wp_postmeta` WHERE `meta_key` LIKE '%$field%' and meta_value = $value->meta_value order by post_id";
      $r = $wpdb->get_results($ids);
        $post_ids = array();
        foreach($r as $meta => $post_results){
          array_push($post_ids,$post_results->post_id);
        }
      
      
      
      $results[$value->meta_value] = $post_ids;
      
        }
*/

    }

    return  $results;
  }

  function getProfileHardware(){
    global $wpdb;
    $sql = "SELECT id, wp_post, company, solution_name, hardware, wp_post from xr_profiles where id > 3";
    
    
    $hardware_list = getHardware();
    
    $q = $wpdb->get_results($sql);
    $results = array();



    foreach($q as $key => $value){//profiles. 
    
    
      // var_dump($value);
            print "<strong>$value->company $value->solution_name</strong><BR>";
      $hardware_array = explode(",",trim($value->hardware));
      foreach($hardware_array as $k => $device){ //profile hardware
        $matched = '';
        $found = false;
        foreach($hardware_list as $h => $device_name ){//hardware
          $list_name = trim(strtolower($device_name->post_title));
         // print trim(strtolower($device))."|".$list_name."<br>";
          if(trim(strtolower($device)) == $list_name){
            $insert = "insert into wp_postmeta (post_id,meta_key,meta_value) values ($value->wp_post,'hardware',$device_name->ID)";
           // $wpdb->query($insert);
            $found = true;
            print "<strong>matched $value->id | $list_name</strong>$insert<BR>";
      // print "$value->id $value->wp_post $device_name->ID $value->solution_name |$device<strong>|$list_name</strong><br>";

          } else {
           
          }
        }
        if(!$found){
          print "not found $device<BR>";
        }



      }
      

        }

    }


 getHardware();
         getProfileHardware();
