
<?php
global $year;
$year = "2021";
global $conf_year;
$conf_year = "1st";
//global $conf_year = "6th";

get_header(); 
$featured_video = get_post_meta($post->ID,"featured_video",true);
$thumbnail = getThumbnail(get_post_meta($post->ID,"_thumbnail_id",true));
///OLD HERO PATH wp-content/uploads/2020/05/XRC-HeroVideo.mp4

?>

<section class="home-section home-parallax home-fade  id="home">
      <div id="bg-video" class="hero-video">
          
          <!--<video   playsinline autoplay muted loop poster="<?=$thumbnail?>" id="bgvideo" name="media"><source src="/hero/XRC-HeroVideo2021.mp4" type="video/mp4"></video>-->
</video>
      </div>

       
      <div id="home-tagline"><h1><?=get_bloginfo('name')?> </h1>
<h2><?=bloginfo("description");?></h2></div>

      </section>
      <main class="main" role="main">


  <section class="module" id="<?php echo @$slug?>" role="region">
<div class="row">
<div class="container">
  <div class="col-sm-2 col md-3"></div>
  <div class="col-xs-12 col-sm-8 col md-6">
  <h1><?=$post->post_title?></h1>
<?php
  getChildList(0,'resource');
  print do_shortcode(do_blocks($post->post_content));
?>
</div>
</div>

</div>
</section>

        
      <?php
 //require_once('lava.html');
$pages = get_home_children();
 
foreach($pages as $key => $value){
  
  extract((array)$value);

  if(!get_post_meta($ID,"redirect",true)){ //don't render if external url.

              $section_class = get_post_meta($ID,"section_class",true);
  

  ?>
      <section class="module<?php print " $section_class";?>" id="<?php echo $slug?>">
          <div class="container">
            <?php
            if(file_exists (get_stylesheet_directory()."/page-$slug.php") ){
         //     var_dump($value);
              require_once(get_stylesheet_directory()."/page-$slug.php"); // includes page-slug.php if it exists
            } else {
            ?>
            
              
                <h2 class="module-title font-alt"><?php echo $title?></h2>
                  <?php echo do_shortcode(do_blocks($content));
                    
                  ?>
                  

                </div> 
              </div>
            
            
            
            <?php 
              } 
            ?>

          </div>
         
           <?php
          }
          ?>
        </section>
        <?php 
          
          if(trim(@$section_foot) != ''){
            ?><div class="section-foot">
              <img  src="<?php echo getThumbnail($section_foot,"Full");?>">

        </div>
       

<?php
    }
  }
  ?>
  </main>
  <script>
    document.addEventListener( 'wpcf7mailsent', function( event ) {
      var pdf = '/wp-content/uploads/2021/03/XR-Collaboration-2021-Edition.v1.pdf'

  var link = document.createElement('a');
      link.href = pdf;
      link.download = 'XR-Collaboration-2021-Edition.v1.pdf';
      link.dispatchEvent(new MouseEvent('click'));
   
}, false );
  </script>
  <?php get_footer(); ?>