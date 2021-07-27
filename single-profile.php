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
?>
    <script>
  var profile_template = 'full-profile-template'




</script>
<section id="profile-hero"></section>





<main role="main" id="main">

  <section class="module profile-container" id="<?php echo @$slug?>" role="region">
<div class="row">
<div class="container">
 
  

  <div id="full-profile"></div>

</section>
</div>

</div>
  </main>


   <div id="full-profile-template" style="display:none;">
      <div class="row">
          <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2 logo-holder display-flex">
            <div class="profile-logo"></div>
            <div class="profile-contact"></div>
            
          </div>
          <div class="col-xs-12 col-sm-9 col-md-9 col-lg-6 info-holder display-flex">

            <div class="profile-info">
              <div class="solution_name"><h1></h1></div>
              <div class="company"><h2></h2></div>
              <div class="blurb"></div>
              
              

              <div class="use-cases"></div>
              

              <div class="view-profile"></div>

            </div>

          </div>
          <div class="xs-col-12 col-sm-12 col-md-12 col-lg-4 tag-holder display-flex">
            <div class="demo-video"></div>
            
            <div class="hardware filter-list"></div>
            <div class="platform filter-list"></div>
             <div class="feature filter-list"></div>
              <div class="industry filter-list"></div>
               <div class="collaboration_type filter-list"></div>
          </div>
      </div>
  
    </div><!--template-->

  <?php get_footer(); ?>