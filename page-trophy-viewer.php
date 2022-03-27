<?php
    get_header();

   

      $pedestals = get_pedestals('polys2');
    //    var_dump($pedestals);
      $assets = [];
     

   if(@$_GET['dump'] == 'awards'){
     
?>

<div id="dump" style="position:absolute;top:0px; height:100vh;width:20%;background-color:rgba(10,10,10,0.4);color:#fff;z-index:100;overflow-y:scroll;">
    <?php 
    

    
    
    
    ?>
   </div>
<?php
}
   include "webxr/polys2/drawer-experiences.php";
 //   include "webxr/polys2/drawer-nominations.php";

 if(@$_GET['hidemenu']){
    ?>
    <style>
      .sidedrawer{
        display:none;
      }
      </style>
    
    <?php
    }
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
            include "webxr/polys2/assets.php";
            include "webxr/polys2/mixins.php";
            
        ?>

    </a-assets>
    <a-sky src="#sky"></a-sky> 

    <?php
            include "webxr/polys2/rigging.php";
            include "webxr/polys2/lights.php";

?>
<a-entity id="awards-2021" position="0.05 0 -21.2" rotation="0 0 0" scale="1 1 1" visible="true">
    <a-entity id="platform-wrap" visible="true" scale="2 2 2" 
    position="0 -2 0"
                rotation="0 0 0">

                <!--
                <a-image id="12-point" mixin="scale-label" src="/assets/images/bg/12Point2.png"
               
                                                position="0.12 1.145 3.973" scale="14.5 14.5 14.5"  rotation="90 0 0"></a-image>
              <a-image id="6-point" mixin="scale-label" src="/assets/images/bg/6Point.png"
               
                                                position="0.280 1.33 4.344" scale="12 12 12"  rotation="90 30 0"></a-image>-->

            <a-entity id="outer-ring" class="center-obj-zone" static-body
                full-gltf-model="#ring" class="collision" visible="true"
                scale="1 1 1"
                position="0.11 0.069 3.97" 
                static-body="shape: box;" 
               >
                ></a-entity><!-- outer ring -->

                <a-entity id="inner-ring" class="center-obj-zone" static-body
                full-gltf-model="#ring" class="collision" visible="true"
                scale=".8 .8 .8"
                position="0.126 0.569 3.97"
                static-body="shape: box;" 
                ><!-- inner ring -->
            <!--
                <a-entity id="emblem-model" class="center-obj-zone" static-body
                full-gltf-model="#emblem" class="collision" visible="true"
                scale="5 5 5"
                position="-0.41 3.25 0"
                static-body="shape: box;" 
                animation="property: object3D.rotation.y; to: 360; easing: linear; dur: 24000; loop: true;"
                >
                <a-entity id="Polys2-logo-model" class="center-obj-zone" static-body
                        full-gltf-model="#polys2" class="collision" visible="true"
                        scale="5 5 5"
                        position="0 -0.5  0"

                        static-body="shape: box;" 
                    
                        ></a-entity>

            </a-entity>-->
<!-- animation="property: object3D.rotation.y; to: -360; easing: linear; dur: 24000; loop: true;"-->
<?phpvar_dump($_GET);

       $scale= "8 8 8";
           $position="0 -0.25 0";
    ?>

            <a-entity id="trophy-model" class="center-obj-zone" static-body
                full-gltf-model="#2nd-polys-trophy" class="collision" visible="true"
                
                rotation="0 -90 0" animation="property: object3D.rotation.y; to: -360; easing: linear; dur: 24000; loop: true;">
                
                <a-entity id="Polys2-logo-model" class="center-obj-zone" static-body
                        full-gltf-model="#polys2" class="collision" visible="true"
                        scale="<?=$scale?>"
                        position="8 8 8"
                        rotation="0  -30 0"
                        static-body="shape: box;" 
                    
                        ></a-entity>

            </a-entity>
<!-- <a-entity id="Polys2-logo-model" class="center-obj-zone" static-body
                        full-gltf-model="#polys2" class="collision" visible="true"
                        scale="10 10 10"
                        position="-3 2 0"
                        rotation="0 20 0"
                        static-body="shape: box;" 
                        visible="false"
                    
                        ></a-entity>-->
            
            <a-entity id="logo-wrap"  animation="property: object3D.rotation.y; to: 360; easing: linear; dur: 24000; loop: true;" position="0 -.75 0" visible="false">

            <a-text id="text-sponsored" position="-1.07 1.657 5.178" rotation="0 180 0" color="white"
                        text="value:sponsored by;align:center;wrapCount:40" width="3.36"></a-text>
                    <a-entity id="futurewei-logo-model" class="center-obj-zone" static-body
                        full-gltf-model="#futurewei" class="collision" visible="true"
                        scale=".7 .7 .7"
                        position="-0.3 1.343 5.2"
                        rotation="0 180 0"
                        static-body="shape: box;"  
                    
                        ></a-entity>
 
                        <a-text id="text-presents" position="-4 1.2 -3.32" rotation="0 -300 0" color="white"
                        text="value:presents ;align:center;wrapCount:40" width="3.36"></a-text>

                        <a-entity id="powersimple-logo-model" class="center-obj-zone" static-body
                        full-gltf-model="#powersimple" class="collision" visible="true"
                        scale=".9 .9 2"
                        position="-4.5 1.45 -2.4"
                        rotation="0 -300 0"
                        static-body="shape: box;">
                    
                    </a-entity>
                        
                    

                    <a-entity id="point-cloud-model" class="center-obj-zone" static-body
                        full-gltf-model="#point-cloud" class="collision" visible="true"
                        scale="2 2 2"
                        position="0 2.128 0"
                        rotation="0 45 0"
                        static-body="shape: box;" 
                        >
                    
                    </a-entity>
                    <a-text id="text-association" position="4.2 1.625 -2.96" rotation="0 300 0" color="white"
                        text="value:in association with ;align:center;wrapCount:40" width="3.36"></a-text>
                    <a-entity id="metavrse-logo-model" class="center-obj-zone" static-body
                        full-gltf-model="#metavrse" class="collision" visible="true"
                        scale=".9 .9 .9"
                        position="4.5 1.33 -2.4"
                        rotation="0 300 0"

                        static-body="shape: box;" 
                    
                        ></a-entity>
                </a-entity>


            </a-entity><!-- /inner ring -->



                <!--
                <a-entity id="nav" class="center-obj-zone" static-body
                scale=".6 .6 .6 "
                position="0.124 .8 3.97"
                material="shader: standard; metalness: 0.8;" 
                full-gltf-model="#ring" class="collision" visible="true"></a-entity>-->
    </a-entity><!-- platform-->
    <a-entity id="pedestals" position="0 0 20" rotation="0 0 0">
  <?php

            include "webxr/polys2/pedestals.php";


        ?>
        </a-entity><!-- pedestals -->

    </a-entity><!-- awards 2021-->



  


     





<!--




        <a-entity position="0 -.2  -5.658" id="projector">
            <a-cylinder color="gray" rotation="0 30 0" segments-radial="8" segments-height="1" height="0.15"
                geometry="radius: 0.1"></a-cylinder>
            <a-entity id="holoartproj" visible="false">
                <a-entity mixin="holoprojector"></a-entity>
                <a-entity id="holoartifact" scale="7 7 7" rotation="0 0 0" class="center-obj-zone" static-body
                    position="0 1.25 0" full-gltf-model=""
                    animation="property: object3D.rotation.y; to: 360; easing: linear; dur: 12000; loop: true;"
                    visible="false"></a-entity>
            </a-entity>
        </a-entity>







-->


















</a-scene>
<?php
     get_footer();
?>