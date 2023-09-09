<?php
get_header(); 


  $profile_meta = get_post_meta($post->ID);
  $thumbnail = getThumbnail(@$profile_meta['_thumbnail_id'][0],"medium");

  
  $profile_events = getProfileEvents($post->ID);

?>
    <script>
  var profile_template = 'full-profile-template'




</script>



<main role="main" id="main" class="main">

<div class="row">
<div class="d-flex container-flex">
<div class="col-md-7 left" id="ros-table" >
  
      


          <div class="profile-thumbnail">
            <img src="<?=$thumbnail?>" alt="<?=$post->post_title?> profile pic">
          </div>

          <div class="profile-meta">
        

      
  
        

         
        <div class="speaker-meta">
        <h5>
          <?= wrapMeta($profile_meta,'profile_title','span');?>, 
          <?= wrapMeta($profile_meta,'company','span');?>
        </h5>
        <?= wrapMeta($profile_meta,'twitter','a');?>
        <?= wrapMeta($profile_meta,'linkedin','a');?>
        <?= wrapMeta($profile_meta,'github','a');?>
        <?= wrapMeta($profile_meta,'website','a');?>
        </div>

          </div>

      
          <?php
          if(is_gutenberg()){
            print do_blocks($post->post_content);
            } else {
              print str_replace("</span>","</span><br></br>",$post->post_content);
            }
          ?>
        
        </div>
        <div class="col-md-5 right">
<?php


/*

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
  
*/

    ?>
     



        </div>

      </div>

</main>


  

  <?php get_footer(); ?>