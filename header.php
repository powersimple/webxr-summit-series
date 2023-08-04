<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri();?>/images/icons/favicon.ico" />
<?php 


wp_head(); 
    $url = wp_upload_dir();
?>
    <link href="<?php echo get_stylesheet_directory_uri();?>/assets/lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    
   
    <link href="<?php echo get_stylesheet_directory_uri();?>/assets/lib/animate.css/animate.css" rel="stylesheet">
    <link rel='stylesheet' id='drawer-css'
        href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' type='text/css'
        media='all' />
    <link href="<?php echo get_stylesheet_directory_uri();?>/assets/lib/flexslider/flexslider.css" rel="stylesheet">

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


  ?>





  <?php
// 
  
    // INCLUDES AFRAME JS TAGES ONLY IF IT IS ENABLED.

  //
 $aframe =    get_post_meta($post->ID,"use_aframe",true);
  if(@$aframe == 1){
    //hacks
    $speed = "0.2";
    if(@$_GET['speed']){
        $speed = $_GET['speed'];    
    }
    if($post->ID == 13){ 
      $_GET['event_menu'] = 'bizsummit21';
  
  }
    $menu = 'bizsummit21';
    $model='';

    if(@$_GET['event_menu']){
        $menu = $_GET['event_menu'];
    }
 
    $summit_square_model = 'business-summmit-square';
    if(@$_GET['summit_model']){
        $summit_square_model = $_GET['summit_model'];
    }

    $aframe_version="1.2.0";
    if(@$_GET['aframe-version']){
      $aframe_version=$_GET['aframe-version'];

    }

?>

<script src="https://aframe.io/releases/<?=$aframe_version?>/aframe.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/mrdoob/three.js@r134/examples/js/deprecated/Geometry.js"></script>
<script src="/assets/js/aframe-extras.js"></script>
    <script src="https://unpkg.com/aframe-event-set-component@5.0.0/dist/aframe-event-set-component.min.js"></script>
    <script src="/assets/js/aframe-physics-system.min.js"></script>
    <script src="https://unpkg.com/aframe-aabb-collider-component@3.1.0/dist/aframe-aabb-collider-component.min.js">
    </script>
    <script src="/assets/js/aframe-look-controls.js"></script>
    <script src="https://unpkg.com/aframe-orbit-controls@1.3.0/dist/aframe-orbit-controls.min.js"></script>

    <
  <script src="https://unpkg.com/super-hands@^3.0.1/dist/super-hands.min.js"></script>
    <script src="https://unpkg.com/aframe-physics-extras@0.1.2/dist/aframe-physics-extras.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/aframe-blink-controls/dist/aframe-blink-controls.min.js"></script>
   
    </script>
    <script src="/assets/js/aframe-troika-text.min.js"></script>
    <script src="/assets/js/msc_basis_transcoder.js"></script>

    <script src="https://unpkg.com/aframe-fps-counter-component/dist/aframe-fps-counter-component.min.js"></script>


    <style>
  .a-enter-ar-button{
           display: none !important;/* */
            
        }       
            <?php
              /// 
              //DISAPPEARS THE HEADER AND FOOTER FOR PURE AFRAME
              //USED IN VIRTUALPRODUCTION
              ///

            if(@$_GET['disappear']==1){
            ?>
              
                    .a-enter-ar-button, .a-enter-vr-button, .toggle-edit, .sidedrawer
                  {
                        display: none !important;
                        
                    } 
                    header, footer {
                        display: none !important;
                        
                    } 

            <?php
              } 
            ?>
    </style>

<?php
  }
  // 
  
    // END AFRAME

  //
$rel_path= str_replace(url_root(),"",get_stylesheet_directory_uri());
?>
    <script src="/assets/js/jquery.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> <!--  -->
    <!---->
<link rel='stylesheet' id='drawer-css' href='/assets/css/drawer.css' type='text/css' media='all' />
<link rel='stylesheet' id='drawer-css' href='/assets/css/jquery-ui.css' type='text/css' media='all' />
    <link rel='stylesheet' id='drawer-css'
        href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' type='text/css'
        media='all' />





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
      slug = "<?=$post->post_name;?>",
      profile_template = ''//hack
      
      
      var hero_slides = [
          <?php $slides = get_slides($post->ID);
          $slide_version_list = array();
        foreach ($slides as $key => $media_id) {
          $src= wp_get_attachment_image_src( $media_id,"Full");
          //var_dump($src);//var_dump(get_media_data($media_id));
          $media_data = get_media_data($media_id);
        //  var_dump($media_data);
          $versions = getThumbnailVersions($media_id);
          $version_list = array();
          foreach($versions as $v => $version){https://twitter.com/hunicke
              array_push($version_list,"'".$v."'".": '".$version."'");

          }
          array_push($slide_version_list,"{".implode(",",$version_list)."}
          ");
          
        
        // print "<BR>";
          // var_dump($versions);
            extract((array) get_media_data($media_id));
        }
        print implode(",",$slide_version_list);
      
        ?>
         ]
      <?php
      // post specific hacks
     
    
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

  <body data-spy="scroll" data-target=".onpage-navigation" data-offset="60" class="<?php echo @$class_bg;?>" <?=$page_style?>>


        <div class="page-loader">
        <div class="loader">Loading...</div>
      </div>
<header id="header" class="navbar navbar-custom navbar-fixed-top navbar-transparent" role="navigation">
        <div class="container">
         
          <div class="navbar-header">
         
           <div id="logo" class="onpage-navigation"><a  href="/"></a></div>
            
          </div>
          <div class="collapse navbar-collapse" id="custom-collapse">
         

                   
                  
                  
            </div>
            <div id="menu"></div>
            <div id="countdown">
              <div id="polyscountdown" class="countdown"></div>
              
            </div>
            <div id="main-menu"></div>
            <div id="social-menu">

            

            <a href="https://twitter.com/webxrawards" target="_blank"
                class="fa fa-twitter" title="Follow us on Twitter"></a>
            <a href="https://www.instagram.com/webxrawards/" target="_blank" class="fa fa-instagram"
                title="Follow us on Instagram"></a>
            <a href="https://www.facebook.com/groups/webxrawards" target="_blank" class="fa fa-facebook"
                title="Join our Facebook Group"></a>
            <a href="https://www.linkedin.com/company/the-polys/" target="_blank" class="fa fa-linkedin"
                title="Connect with us on LinkedIn" target="_blank"></a>

            <a href="https://discord.gg/T5vRuM5cDS" class="fa discord" target="_blank"
                title="Join our community Discord"></a>
        </div>
        
      </div>  
    
</header>
      



