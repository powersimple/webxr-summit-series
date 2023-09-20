<?php
get_header(); 


  $profile_meta = get_post_meta($post->ID);
  $thumbnail = getThumbnail(@$profile_meta['_thumbnail_id'][0],"medium_large");

  $default_video_url = get_post_meta($post->ID,"featured_video_url",true);
  $profile_events = getProfileEvents($post->ID);

?>
    <script>
  var profile_template = 'full-profile-template'
  var profile_events = [];
  var default_video_url = '<?=$default_video_url?>';


</script>



<main role="main" id="main" class="main">
<div class="row">
  <div class="container">

    <h1 class="profile-header"><?=$post->post_title?></h1>
    <div class="profile-meta">
          <h5>
            <?= wrapMeta($profile_meta,'profile_title','span');?>
          <?php  if(@$profile_meta['company'][0] != ''){
              print ", ";
            }?>
            <?= wrapMeta($profile_meta,'company','span');?>
          </h5>
          <div class="social">
            <div class="social-icons">
              
         
          <?= wrapMeta($profile_meta,'linkedin','a');?>
          <?= wrapMeta($profile_meta,'github','a');?>
          <?= wrapMeta($profile_meta,'website','a');?>
          <?= wrapMeta($profile_meta,'twitter','a');?>
          </div>
    </div>
    </div>
    </div>
</div>
<div class="row">
<div class="d-flex container-flex">
<div class="col-md-7 left" id="profile-videos" >
      


<?php


?>

<div class="profile">
  
<img src="<?=$thumbnail?>" alt="<?=$post->post_title?> profile pic" class="float-left">
         

       
          <?php
         if($post->post_excerpt != ""){
          print "<h2 class='featuring'>".nl2br($post->post_excerpt)."</h2><hr>";
        }


          if(is_gutenberg()){
            print do_blocks($post->post_content);
            } else {
              print str_replace("</span>","</span><br></br>",$post->post_content);
            }
          ?>
        
        </div>
        </div>
        <div class="col-md-5 right">
          
    <?php
$show_player = true;
if($default_video_url != ''){
  $show_player = false;
}
  require_once('templates/embed-video.php');
  
?>
          <div id="appearances"></div>
          </div>
          


        </div>

      </div>

</main>

<script>
  
 jQuery(document).ready(function() {

 
  getStaticJSON('profiles/profile-<?=$post->ID?>', loadProfileData);

})
</script>
  

  <?php get_footer(); ?>