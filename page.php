<?php

get_header(); 
$section_class = get_post_meta($post->ID,'section_class',true);
$default_video_url = get_post_meta($post->ID,"featured_video_url",true);
$video_playlist = get_post_meta($post->ID,"video_playlist",true);

$section_menu = get_post_meta($post->ID,"section_menu",true);

?>


<main role="main" class="main <?=$section_class?>">



<div class="d-flex container-flex">
  <div class="col-md-7 left">

  <?php
   print do_blocks(do_shortcode($post->post_content));
    if(@$section_class == 'ceremony'){
      
      if(@$section_menu){
        
        require_once "functions/functions-awards.php";
       $awards = get_menu_array($section_menu);
        require_once('templates/awards.php');
     }
    }
  ?>


  </div>


<div class="col-md-5 right">
    <div class="sticky">
  

       

       
  <?php if($default_video_url != ''){
    require_once('templates/embed-video.php');
    }
   ?>
  </main>
  <?php get_footer(); ?>     