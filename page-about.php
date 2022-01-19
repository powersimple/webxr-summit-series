<?php

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

<section class="home-section home-parallax home-fade home-full-height" id="home" style="background:url(<?=$hero_image?>) center center no-repeat;background-size:cover;">
    
    </section>

<?php
}

?>

<div class="title-bar">
    <h1 class="title"><?=$post->post_title?></h1>
    <?php
    if(@$post->post_content){
    ?>
    <h2 class="featuring">
        <?=$post->post_content?></h1>
    
    <?php
    }
 
    ?>
</div>
<main role="main" class="main <?=$section_class?>">


<div class="row">
<div class="container">
 



<?php

  print do_blocks(do_shortcode($post->post_content));

  $team = getProfileChildrenIDs(586);
  $hosts = getProfileChildrenIDs(598);
?>






</div>

</div>

</div>
  </main>
  <?php get_footer(); ?>