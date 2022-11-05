<?php
    get_header();

    //require_once "functions/functions-awards.php";
     // $pedestals = get_pedestals('polys2');
    //    var_dump($pedestals);
      $assets = [];
     
   $menu = get_menu_array("SummitsWheel");
   
   $assets3D = [];

   $panels = getPanelsArray( $menu);
   //var_dump($panels);
    $panels_assets = menu3DAssets("logo3D_src",$panels);



    $assets3D = array_merge($assets3D,$panels_assets); // merge all arrays with assets

     
?>

   

<a-scene gltf-model="dracoDecoderPath: assets/draco/;" grab-panels item-grab device-set nomination-link anti-drop
    device-orientation-permission-ui physics="iterations: 30;"
    inspector="https://cdn.jsdelivr.net/gh/aframevr/aframe-inspector@master/dist/aframe-inspector.min.js"
    loading-screen="backgroundColor: #12171a" renderer="colorManagement: true; foveationLevel: 2;"
    background="color: #000000">
    <a-entity tracked-controls="controller: 0; idPrefix: OpenVR"></a-entity>
    <a-entity tracked-controls="controller: 1; idPrefix: OpenVR"></a-entity>
    <a-assets timeout="800000">
        <!-- Loads assets -->
        <?php
            
            include "webxr/summits22/assets.php";
            include "webxr/summits22/mixins.php";
        ?>

    </a-assets>
    <a-sky src="#sky"></a-sky>

    <?php
            include "webxr/summits22/rigging.php";
            include "webxr/summits22/lights.php";

?>
<a-entity id="summits-2022" position="0 0 0" rotation="0 0 0" scale="1 1 1" visible="true">
   <!-- <a-entity id="platform-wrap" visible="true" scale="1 1 1" 
    position="0 0 0"
                rotation="0 0 0">
                <a-entity id="powersimple-logo-model" class="center-obj-zone" static-body
                        full-gltf-model="#powersimple" class="collision" visible="true"
                        scale=".9 .9 2"
                        position="-4.5 1.45 -2.4"
                        rotation="0 -300 0"
                        static-body="shape: box;">
                    
                    </a-entity>-->
                    <a-entity id="emblem" class="center-obj-zone" static-body
                gltf-model="#emblem"  visible="true"
                scale="20 20 20"
                position="0 80 -120"
                rotation="0 20 0"
                static-body="shape: box;" 
                animation="property: object3D.rotation.y; to: 360; easing: linear; dur: 24000; loop: true;"
                ></a-entity><!-- outer ring -->
                
<!--
                <a-entity id="22SummitsSquareModel" class="center-obj-zone" static-body
                gltf-model="#22SummitsSquare"  visible="true"
                scale="200 200 200"
                position="0 80 -120"
                rotation="0 -60 0"
                static-body="shape: box;" 
                
                ></a-entity>-->
                <!-- outer ring -->

            <a-entity id="platform-model" class="center-obj-zone" static-body
                gltf-model="#platform"  visible="true"
                scale="50 50 50"
                position="0 -2.5 0"
                rotation="0 20 0"
                static-body="shape: box;" 
                ></a-entity><!-- outer ring -->
        <a-entity id="nav" class="center-obj-zone" static-body
                gltf-model="#platform" class="collision" visible="false"
                scale="50 50 50"
                position="0 -2.5 0"
                rotation="0 20 0"
                static-body="shape: box;" 
                ></a-entity><!-- outer ring -->

    <a-entity id="panels" position="0 30 0" rotation="0 0 0" scale="10 10 10">


  <?php
            include "webxr/summits22/panels.php";
            if(@$_GET['townhall']){
          // include "webxr/summits22/townhall.php";
            }
        ?>
        </a-entity><!-- panesls -->

    </a-entity><!-- summits-->



 












</a-scene>
<?php
     get_footer();
?>