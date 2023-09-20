<?php

get_header(); 
$section_class = get_post_meta($post->ID,'section_class',true);
print $default_video_url = get_post_meta($post->ID,"embed_video_url",true);
?>

<main role="main" class="main <?=$section_class?>">

<?php
    print do_blocks(do_shortcode($post->post_content));
?>

<div class="row team">

<?php


  
  displayTeam(get_menu_array('team'),'about col-sm-4 col-md-3');

?>







</div>

</div>
  </main>
  <?php get_footer(); ?>