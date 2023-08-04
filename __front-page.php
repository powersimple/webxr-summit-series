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
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>

<section class="home-section home-parallax home-fade " id="home" style="background:url(<?=$hero_image?>) top center no-repeat;background-size:contain;padding-bottom:25%;">
    
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


<main  role="main" class="main <?=$section_class?>">

  <section class="module" id="<?php echo @$slug?>" role="region">
    <div class="row">
      <div>
      
        <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-offset-1 col-10 ">
       
      <?php 

print do_blocks(do_shortcode($post->post_content));



          $awards = get_menu_array('polys3');


          print "<hr><div>";
          foreach($awards as $key => $award){// outer menu loop
            
            foreach($award['children'] as $c =>$child){// EVENTS loop
              if($child['classes'][0] == 'nomination' || $child['classes'][0] == 'honor'){
                
                print '<h3 class="nomination-category">'.$child['title'].'</h3>';
                print "<ul class='nominee-list'>";
                get_nomination($child['children'],0);//recursive nominees loop
                print "</ul>";
                print '<hR>';
              }

            }

          }
          print "</div>";
          



//          print("<pre>".print_r($awards,true)."</pre>");
//          nomineeAccordion($awards);

          
        ?>
        
          </div>  
        </div>
      </div>

    </div>
  </section>

</main>
<?php get_footer(); ?>