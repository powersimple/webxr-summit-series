<?php
//phpinfo();die();
get_header(); 
$section_class = get_post_meta($post->ID,'section_class',true);
print $default_video_url = get_post_meta($post->ID,"embed_video_url",true);

if($hero=get_post_meta($post->ID,'hero',true)){
   $hero_image = getThumbnail($hero);
   /*
if($post->post_parent==0){

    print "<div id='section-heading'>";
    $parent_post = get_post($post->post_parent);
    $parent_post_title = $parent_post->post_title;
    echo $parent_post_title;
    print "</div>";
}
*/
?>

<section class="home-section home-parallax home-fade home-full-height" id="home" style="bakground:url(<?=$hero_image?>) center center no-repeat;background-size:cover;">
    
    </section>

<?php
}

?>

<div class="title-bar">
    <h1 class="title"><?=$post->post_title?></h1>
    <?php
    if(@$post->post_excerpt){
    ?>
    <h2 class="featuring">
        <?=$post->post_excerpt?></h1>
    
    <?php
    }
 
    ?>
</div>




<?php

  print do_blocks(do_shortcode($post->post_content));

    if(@$_GET['event_menu']){
       ?>

        <div id="run-of-show">

            <div id="show"></div>
            <div id="sessions"></div>
            <div id="ros_meta"></div>

        </div>
<?php





    }


?>

  <?php
  
  
if(@$_GET['event_menu']){

    ?>
<script>
    jQuery(document).ready(function() {

       

});
    
    
    
</script>
    <?php
}
  get_footer(); ?>