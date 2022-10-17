<?php
//phpinfo(); die();
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


  $profile_meta = get_post_meta($post->ID);
  $thumbnail = getThumbnail(@$profile_meta['_thumbnail_id'][0],"medium");
                  
if(strpos(@$_SERVER['HTTP_REFERER'],"localhost")){

  $thumbnail = str_replace('https://',"/",$thumbnail);
  $thumbnail = str_replace(@$_GET['host_root'],"/",$thumbnail);

  $thumbnail = str_replace('/webxrsummitseries/',"/",$thumbnail);
 }
  
  $profile_events = getProfileEvents($post->ID);

?>
    <script>
  var profile_template = 'full-profile-template'




</script>
<?php
if($hero=get_post_meta($post->ID,'hero',true)){
  $hero_image = getThumbnail($hero);


 if(@$hero_image != ''){
?>
<section class="home-section home-parallax home-fade home-full-height" id="home" style="background:url(<?=$hero_image?>) center center no-repeat;background-size:cover;">
    
    </section>
<?php
 }
}
?>


<main role="main" id="main" class="main">

  <section class="module profile-container" id="<?php echo @$slug?>" role="region">
  <div class="row">
      <div class="container profile-title">
        <h1><?= $post->post_title;?> 
        </h1>
        <h5>
        <?= wrapMeta($profile_meta,'profile_title','span');?>, 
        <?= wrapMeta($profile_meta,'company','span
        ');?>
        </h5>
        <hr>
      </div>
  </div>

    <div class="row">
      <div class="container">

        <div class="col-sm-3 col-md-4">
          <div class="profile-thumbnail">
            <img src="<?=$thumbnail?>" alt="<?=$post->post_title?> profile pic">
          </div>

          <div class="profile-meta">
          <?php
          $profile_meta = get_post_meta($post->ID);


      
  
          if($post->post_excerpt !=''){
            ?>
            <h4><?=$post->post_excerpt?></h4>
            <?php
              }
            ?>

         
        <div class="speaker-meta">
       
        <?= wrapMeta($profile_meta,'twitter','a');?>
        <?= wrapMeta($profile_meta,'linkedin','a');?>
        <?= wrapMeta($profile_meta,'github','a');?>
        <?= wrapMeta($profile_meta,'website','a');?>
        </div>

          </div>
        </div>
        <div class="col-sm-9 col-md-8">
      
          <?php
          if(is_gutenberg()){
            print do_blocks($post->post_content);
            } else {
              print str_replace("</span>","</span><br></br>",$post->post_content);
            }
          ?>
        
        </div>

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

  </section>
</main>


  

  <?php get_footer(); ?>