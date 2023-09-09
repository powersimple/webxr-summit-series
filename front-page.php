<?php
require_once "functions/functions-awards.php";
function url(){
  return sprintf(
    "%s://%s%s",
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
    $_SERVER['SERVER_NAME'],
    $_SERVER['REQUEST_URI']
  );
}



get_header(); ?>

<?php
$section_class = get_post_meta($post->ID,'section_class',true);
print $default_video_url = get_post_meta($post->ID,"embed_video_url",true);



?>


<main  role="main" class="main <?=$section_class?>">

 

</main>
<?php get_footer(); ?>