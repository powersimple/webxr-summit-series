<?php
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

    $aframe_version="1.4.2";
    if(@$_GET['aframe-version']){
      $aframe_version=$_GET['aframe-version'];

    }

?>

<script src="https://aframe.io/releases/<?=$aframe_version?>/aframe.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/mrdoob/three.js@r134/examples/js/deprecated/Geometry.js"></script>
<script src="https://cdn.jsdelivr.net/gh/c-frame/aframe-extras@7.0.0/dist/aframe-extras.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aframe-event-set-component@5.0.0/dist/aframe-event-set-component.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/c-frame/aframe-physics-system@v4.2.2/dist/aframe-physics-system.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aframe-aabb-collider-component@3.1.0/dist/aframe-aabb-collider-component.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/super-hands@^3.0.3/dist/super-hands.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aframe-physics-extras@0.1.2/dist/aframe-physics-extras.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri();?>/webxr/libraries/simple-navmesh-constraint.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aframe-blink-controls/dist/aframe-blink-controls.min.js"></script>
   
    </script>
    <script src="<?php echo get_stylesheet_directory_uri();?>/assets/js/aframe-troika-text.min.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri();?>/assets/js/msc_basis_transcoder.js"></script>

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