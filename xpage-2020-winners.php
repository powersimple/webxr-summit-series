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




<?php
}

?>




<main  role="main" class="main <?=$section_class?>">

  <section class="module" id="<?php echo @$slug?>" role="region">
    
    
      
       
      <?php 

        print do_blocks(do_shortcode($post->post_content));

       

        $awards = get_menu_array('polys1');

        require_once('templates/nominees-and-winners.php');
        
          
        ?>
       
         

    </div>
  </section>

</main>
<?php get_footer(); ?>