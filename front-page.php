<?php
    get_header();

    require_once "functions/functions-awards.php";
      $pedestals = get_pedestals('polys3');
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
 //  include "webxr/polys3/drawer-experiences.php";
 //   include "webxr/polys2/drawer-nominations.php";
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
            include "webxr/polys3/assets.php";
            include "webxr/polys3/mixins.php";
            
        ?>

    </a-assets>
    <a-sky src="#sky"></a-sky>

    <?php
            include "webxr/polys3/rigging.php";
            include "webxr/polys3/lights.php";

?>
<a-entity id="awards-2022" position="0 0 0" rotation="0 0 0" scale="1 1 1" visible="true">
    <a-entity id="platform-wrap" visible="true" scale="2 2 2" position="-8 -2 -36" rotation="0 25 0">

      







                <a-entity id="ring1" class="center-obj-zone" static-body
                gltf-model="#ring" class="collision" visible="true"
                scale="1 1 1"
                position="0 -0.050 3"
                static-body="shape: box;" 
                ></a-entity><!-- outer ring -->

                <a-entity id="ring2" class="center-obj-zone" static-body
                gltf-model="#ring"  visible="true"
                scale="1 1 1"
                position="0 -0.050 10"
                static-body="shape: box;" 
                >  </a-entity>
                
                <a-entity id="ring3" class="center-obj-zone" static-body
                gltf-model="#ring" class="collision" visible="true"
                scale="1 1 1"
                position="6 0 6"
                static-body="shape: box;" 
                >  </a-entity><!-- /inner ring -->






<!--
            
                <a-entity id="trophy-model" class="center-obj-zone" static-body
                gltf-model="#The3rdPolysTrophy-hosts" class="collision" visible="true"
                scale="50 50 50"
                position="2.083 -27.000 6.532"
                rotation="0 0 0" 
                animation="property: object3D.rotation.y; to: -360; easing: linear; dur: 24000; loop: true;">
                
            
                <a-entity id="Polys3-logo-model" class="center-obj-zone" static-body
                        gltf-model="#The3rdPolysLogo" class="collision" visible="true"
                        scale=".75 .75 .375  "
                        position="0 0.6 0"
                        rotation="0  -30 0"
                        static-body="shape: box;" 
                    
                        ></a-entity>
                        
                      
                       

                        <a-entity id="point-cloud-model" class="center-obj-zone" static-body
                        gltf-model="#point-cloud" class="collision" visible="true"
                        scale="1 1 1 "
                        position="0 2.056 0"
                        rotation="0 45 0"
                        static-body="shape: box;">
                    
                    </a-entity>
                    
            </a-entity>
-->
            
            
            <a-entity id="logo-wrap"  position="2.011 -2.178 5.901" rotation="0 -18 0" scale="2 2 2">
               
                    <a-entity id="ZeroSpace-logo-model" class="center-obj-zone" static-body
                        gltf-model="#zerospace-logo" class="collision" visible="true"
                        scale="4 4 5"
                        position="-0.897 1.338 6.137"
                        rotation="0 -7.260 0"
                        static-body="shape: box;"></a-entity>

                        <a-entity troika-text='value:LIVE from ; color:#f5f5f5; align:center; color:#fff; fontSize:.1;align:center;' position="-1.412 1.551 6.059"
                        rotation="0 0 0"></a-entity>

                        <a-entity id="powersimple-logo-model" class="center-obj-zone" static-body
                        gltf-model="#powersimple" class="collision" visible="true"
                        scale=".9 .9 2"
                        position="-4.739 1.338 -2.981"
                        rotation="0 -120 0"
                        static-body="shape: box;">
                    
                    </a-entity>
                        
                    

                  
                   
                    <a-entity id="metavrse-logo-model" class="center-obj-zone" static-body
                        gltf-model="#metavrse" class="collision" visible="true"
                        scale=".9 .9 .9"
                        position="5.375 1.457 -2.476"
                        rotation="0 120 0"

                        static-body="shape: box;" 
                    
                        ></a-entity>
                </a-entity>





                <!--
                <a-entity id="nav" class="center-obj-zone" static-body
                scale=".6 .6 .6 "
                position="0.124 .8 3.97"
                material="shader: standard; metalness: 0.8;" 
                gltf-model="#ring" class="collision" visible="true"></a-entity>-->
                </a-entity><!-- platform-->
    <a-entity id="pedestals" position="0 0.060 0" rotation="0 0 0">
  <?php

            include "webxr/polys3/pedestals.php";


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
                    position="0 1.25 0" gltf-model=""
                    animation="property: object3D.rotation.y; to: 360; easing: linear; dur: 12000; loop: true;"
                    visible="false"></a-entity>
            </a-entity>
        </a-entity>







-->


















</a-scene>
<?php
     get_footer();
?>