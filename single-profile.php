<?php

get_header(); 
/*
$postmeta = get_post_meta($post->ID);
$screenshots = $postmeta['screenshot'];
 
$logo = $postmeta['logo'];

$company = $postmeta['company'];
 $solution_name = $postmeta['solution_name'];



$screenshot_array = array();
foreach($screenshots as $key => $image_id){
  array_push($screenshots,getThumbnail($image_id,"hero"));

}
//print json_encode($screenshot_array);
*/
  $current_event = 13;


  function getProfileEvents($id){
    global $wpdb;
    $sql = "select post_id from wp_postmeta where meta_value = $id and meta_key like 'event_%'";
    return $wpdb->get_results($sql);
    

  }
  function getProfileSession($id){
    global $wpdb;
    $sql = "select ID, post_title, post_excerpt, post_content, post_parent from wp_posts where ID = $id";
    return $wpdb->get_results($sql);
    

  }
 
  $profile_meta = get_post_meta($post->ID);
  $thumbnail = getThumbnail(@$profile_meta['_thumbnail_id'][0],"large");
                  
  $thumbnail = str_replace(@$_GET['host_root'],"/",$thumbnail);
  $thumbnail = str_replace('/webxrsummitseries/',"/",$thumbnail);
  $thumbnail = str_replace('https://',"/",$thumbnail);
  
  $profile_events = getProfileEvents($post->ID);

?>
    <script>
  var profile_template = 'full-profile-template'




</script>



<main role="main" id="main">

  <section class="module profile-container" id="<?php echo @$slug?>" role="region">
<div class="row">
<div class="container" style="background-color:#fff">
    <?php

include "webxr/summits/session-profile-card.php";

        foreach($profile_events as $s => $session){
          $this_session = getProfileSession($session->post_id)[0];
          $session_meta = get_post_meta($session->post_id);
          $track = null;
          if($this_session->post_parent == $current_event){
            
            $event = getProfileSession($current_event)[0];
           
            
          } else {
            $grand_parent = getProfileSession($this_session->post_parent)[0];
            //var_dump($grand_parent);
            if(empty(getProfileSession($grand_parent->post_parent)[0])){
              $event = getProfileSession($grand_parent->post_parent);

            } else {
              $track = getProfileSession($this_session->post_parent)[0];
              $event = getProfileSession($grand_parent->post_parent)[0];
            }
           
             
             
              
          }
          
          
          if(!empty($event)){
            ?>
         <h2><?=$event->post_title?></h2>
          <?php
            if(!empty(@$track)){
                ?>
 <h3><?=$track->post_title?></h3>
                <?php
            }
          ?>
          <h4><?=$this_session->post_title?></h4>
          <?php 
          } 
        }
  


    ?>
     
  

  <?php
  
    
    //$event_meta = getEventMeta($current_event);
   

  ?>



</section>
</div>

</div>
  </main>


  

  <?php get_footer(); ?>