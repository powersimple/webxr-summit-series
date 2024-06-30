<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri();?>/images/icons/favicon.ico" />
<?php 




$post_title = modify_post_title();
add_filter('wp_title', 'modify_post_title', 10, 2);
wp_head(); 
    $url = wp_upload_dir();
?>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    
   
    <link href="<?php echo get_stylesheet_directory_uri();?>/assets/lib/animate.css/animate.css" rel="stylesheet">
    <link rel='stylesheet' id='drawer-css'
        href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css' type='text/css'
        media='all' />
        
        <link rel='stylesheet' id='drawer-css'
        href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' type='text/css'
        media='all' />
        <link href="<?php echo get_stylesheet_directory_uri();?>/assets/lib/animate.css/animate.css" rel="stylesheet">


        

    <!-- Main stylesheet and color file-->
    <link href="<?php echo get_stylesheet_directory_uri();?>/style.css" rel="stylesheet">
<?php 





if(is_front_page()){
  $page_title= '';
} else {
  $page_title = $post->post_title . " | ";
}

  if(strpos($_SERVER['HTTP_HOST'],'webxrsummitseries')){
    $page_title = '🅳🅴🆅 '.$page_title;
  } else if (strpos($_SERVER['HTTP_HOST'],'staging')){
    $page_title = '🆂🆃🅰🅶🅸🅽🅶 '.$page_title;// doesn't work
  }
  wp_head(); 


  
    // INCLUDES AFRAME JS TAGES ONLY IF IT IS ENABLED.

  //
 $aframe =    get_post_meta($post->ID,"use_aframe",true);







  if(@$aframe == 1){
    require_once("webxr/libraries/aframe.php");
  }
  // 
  
    // END AFRAME

  //

$rel_path= str_replace(url_root(),"",get_stylesheet_directory_uri());
// section vars used below in JS Default Var declarations
$section_class = @get_post_meta($post->ID,"section_class",true);
$section_menu = @get_post_meta($post->ID,"section_menu",true);
$section_menu_slug = @get_term($section_menu,"nav_menu")->slug;

global $default_embed_video_url;
$default_embed_video_url = "https://www.youtube.com/embed/AWFgm65j4n8?autoplay=1&rel=0";
//phpinfo();

?>
  
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> <!--  -->
    <!--
<link rel='stylesheet' id='drawer-css' href='/assets/css/drawer.css' type='text/css' media='all' />
<link rel='stylesheet' id='drawer-css' href='/assets/css/jquery-ui.css' type='text/css' media='all' />

   
-->

<style>
  main{
    top:150px;
  }

</style>


    <title><?=$page_title?><?=get_bloginfo('name')?> - <?=bloginfo("description");?></title>
 <script>

if (location.protocol !== 'https:') {
    location.replace(`https:${location.href.substring(location.protocol.length)}`);
}
      // Wordpress PHP variables to render into JS at outset.
      var active_id = <?=$post->ID?>,
      active_object = "<?=$post->post_type?>",
      home_page = <?=get_option( 'page_on_front' )?>,
      site_title = "<?=get_bloginfo('name')?>",
      xr_path = "<?=get_stylesheet_directory_uri()?>/xr/",
      data_path = "<?=$rel_path?>/data/",
      useWheelNav = false,
      uploads_path =  "<?=$url['baseurl']?>/",
      section_class = "<?=$section_class?>",
      
      section_menu = "<?=$section_menu?>",
      section_menu_slug = "<?=$section_menu_slug?>",
      slug = "<?=$post->post_name;?>",
      


      profile_template = ''//hack
      </script>
      <?php
     
    
     
    
          if(function_exists('icl_object_id')){
              global $sitepress;

        //     print "var languages = ".json_encode(getLanguageList());
            


        
   
   
  

    $thumbnail =getThumbnail(get_post_thumbnail_id($post->ID),"Full");
          }

         
      ?>
      


  </script>
  <link rel="stylesheet" type="text/css" media="print" href="<?=get_stylesheet_directory_uri()?>/print.css">
</head>

<?php
$page_style = '';
if($bg=get_post_meta($post->ID,'page-background',true)){
   $bg_src = getThumbnail($bg);
  if($bg_src != ''){
    $style_background="background:url($bg_src);background-size:cover";
  }
  $page_style = "style='$style_background'";
}
$section_class = '';
if($section_class==get_post_meta($post->ID,'section',true)){
  $class_bg = $section_class;
}  

?>

<body data-spy="scroll" data-target=".onpage-navigation" data-offset="60" class="<?=@$class_bg?>" <?=@$page_style?>>


        <div class="page-loader">
        <div class="loader">Loading...</div>
      </div>
  

  <div class="flex-wrapper"><!--to maintain sticky footer-->
    <header id="header" class="navbar navbar-custom navbar-fixed-top navbar-transparent" role="navigation">
        <div class="container">
         
          <div class="navbar-header">
         
           <div id="logo" class="onpage-navigation"><a  href="/"></a></div>
            
          </div>
          <div class="collapse navbar-collapse" id="custom-collapse"></div>
    
            <div id="countdown">
              <div id="polyscountdown" class="countdown"></div>
              
            </div>
            <div id="main-menu"></div>
          
          
      </div>  
      
  </header>
  <script>
    window.addEventListener("scroll", function() {
        let scroll = window.pageYOffset;
        let scaleValue = 1 + scroll * 0.0005; // Slower zoom
        let opacityValue = 1 - scroll * 0.0005; // Slower fade

        let parallaxElement = document.querySelector(".parallax");

        // Check if parallaxElement exists before applying transformations
        if (parallaxElement) {
            parallaxElement.style.transform = `scale(${scaleValue})`;
            parallaxElement.style.opacity = opacityValue;
        }
    });
</script>

<?php
  
   

function extract_number($class) {
    preg_match('/\d+$/', $class, $matches);
    return isset($matches[0]) ? intval($matches[0]) : null;
}


      $section_class = @get_post_meta($post->ID,"section_class",true);
    $section_hero_class = @get_post_meta($post->ID,"section_hero_class",true);

      if($section_hero_class == ''){
        $section_hero_class = 'hero-cover-25';
      }
    
      $padding_number = extract_number($section_hero_class);
      if(!empty($padding_number)){
        $padding_bottom = "padding-bottom:$padding_number%";
      } else {
        $padding_bottom = '';
      }

      $hero=get_post_meta($post->ID,'hero',true);
   $hero_image = getThumbnail($hero);
        
      $slides = get_slides($post->ID);
      if($post->post_name != 'nominees'){

      
      ?>

<?php
}
      if($hero){
      ?>


        <section class="parallax home-fade home-full-height hero-content <?=$section_hero_class?> <?=@$section_class?> " id="dynamic-hero" style="background-image:url(<?=$hero_image?>);"></section>
       


    <?php
      } else if(is_array($slides) && count($slides)>0){ 
     
        $slide_version_list = [];
        
        if(is_array($slides) && count($slides)>0){
          ?>
            
   
    <section class="home-section home-parallax home-fade <?=@$section_hero_class?>" id="home">

    <div class="hero-slideshow">
  <!-- Slides will be dynamically added here -->
</div>

        
        </section>
      
      
      <?php
        }
 
?>



    <?php
  
          foreach ($slides as $key => $media_id) {
              $versions = getThumbnailVersions($media_id);
              $version_list = array();
            // var_dump($versions);
              foreach($versions as $v => $version) {
                  $version_list[] = "'$v': '$version'";
              }
              
              $media_data = get_media_data($media_id);
              
              $slide_data = array(
                  "sm" => $versions["thumbnail"],
                  "md" => $versions["medium"],
                  "md_lg" => $versions["medium_large"],
                  "lg" => $versions["large"],
                  "xl" => $versions["1536x1536"],
                  "full"=>$versions["2048x2048"],
                  "title" => $media_data["title"],
                  "alt" => $media_data["alt"],
                  "description" => $media_data["desc"],
                  "caption" => $media_data["caption"]
              );
              
              $slide_json = json_encode($slide_data);
              array_push($slide_version_list, $slide_json);
          }
          
          
          ?>
              <script>
          var hero_slides = [
            <?=implode(",", $slide_version_list)?>
          ];
          </script>
          <?php
        

        $slick =    get_post_meta($post->ID,"use_slick",true);  
        if(@$slick == 1){
          require_once("functions/slick.php");
        }
      }

   
     
    
      
      
      
      ?>

      