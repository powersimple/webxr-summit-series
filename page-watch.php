<?php

get_header(); 
$section_class = get_post_meta($post->ID,'section_class',true);
$default_video_url = get_post_meta($post->ID,"featured_video_url",true);
$video_playlist = get_post_meta($post->ID,"video_playlist",true);

$section_menu = get_post_meta($post->ID,"section_menu",true);

?>

<script>
// Example event object
const event = {
    title: "Your Event Title",
    description: "This is a <strong>HTML formatted</strong> description.",
    startTime: "20240101T000000Z",
    endTime: "20240101T020000Z"
};

createCalendarEvent(event);
</script>
<main role="main" class="main <?=$section_class?>">



<div class="d-flex container-flex">
  <div class="col-md-7 left">
  <div class="widget-container">
    <h2>Join Our Event!</h2>
    <p>Don't miss out on this exciting opportunity.</p>
    <button class="widget-button" onclick="addToGoogleCalendar(eventConfig)">Add to Google Calendar</button>
    <button class="widget-button" onclick="downloadICS(eventConfig)">Download ICS</button>
</div>
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