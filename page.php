<?php

get_header(); 
$section_class = get_post_meta($post->ID,'section_class',true);
print $default_video_url = get_post_meta($post->ID,"embed_video_url",true);


?>


<main role="main" class="main <?=$section_class?>">


  </main>
  <?php get_footer(); ?>