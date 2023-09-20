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

   

<a-scene  renderer="antialias: true;
                   colorManagement: true;
                   sortObjects: true;
                   maxCanvasWidth: 5600;
                   maxCanvasHeight: 2750;"" gltf-model="dracoDecoderPath: assets/draco/;" grab-panels item-grab device-set nomination-link anti-drop
    device-orientation-permission-ui physics="iterations: 30;"
    inspector="https://cdn.jsdelivr.net/gh/aframevr/aframe-inspector@master/dist/aframe-inspector.min.js"
    loading-screen="backgroundColor: #12171a" renderer="colorManagement: true; foveationLevel: 0;maxCanvasWidth:5600;
                   maxCanvasHeight: 3200;"
    background="color: #000000">

    <a-assets timeout="80000"> <a-entity tracked-controls="controller: 0; idPrefix: OpenVR"></a-entity>
    <a-entity tracked-controls="controller: 1; idPrefix: OpenVR"></a-entity>
        <!-- Loads assets -->
        <?php
            include "webxr/polys3/assets.php";
            include "webxr/polys3/mixins.php";
            
        ?>

    </a-assets>
    <a-sky src="#sky" animation="property: object3D.rotation.y; to: -360; easing: linear; dur: 1200000; loop: true;"></a-sky>

    <?php
            include "webxr/polys3/rigging.php";
            include "webxr/polys3/lights.php";
    $showplatform="true";        
    if(@$_GET['showplatform']){
        $showplatform = "false";
     
    }


?>
<a-entity id="awards-2022" position="0 0 0" rotation="0 0 0" scale="1 1 1" visible="true">
    <a-entity id="platform-wrap"  scale="2 2 2" position="-8 -2.1 -36" rotation="0 25 0" visible="<?=$showplatform?>">


      







                <a-entity id="ring1" class="center-obj-zone" static-body
                gltf-model="#ring" class="collision" visible="true"
                scale="1 1 1"
                position="0 -0.005 3"
                static-body="shape: box;" 
                ></a-entity><!-- outer ring -->

                <a-entity id="ring2" class="center-obj-zone" static-body
                gltf-model="#ring"  visible="true"
                scale="1 1 1"
                position="0 0 10"
                static-body="shape: box;" 
                >  </a-entity>
                
                <a-entity id="ring3" class="center-obj-zone" static-body
                gltf-model="#ring" class="collision" visible="true"
                scale="1 1 1"
                position="6 .005 6"
                static-body="shape: box;" 
                >  </a-entity><!-- /inner ring
            
            animation="property: object3D.rotation.y; to: -360; easing: linear; dur: 24000; loop: true;"
            -->

    <a-entity id="logo-wrap"  position="1.776 -2.218 6.18" rotation="0 -17.3 0" scale="2 2 2" visible="false" >
            <?php if(@$_GET['leadsponsor']){

?>
            <a-entity id="Qualcomm-logo-model" class="center-obj-zone" static-body
                        gltf-model="#lead-sponsor" class="collision" visible="true"
                        scale=".05 .05 .025"
                        position="-0.929 1.293 6.077"
                        rotation="0 -7.260 0"
                        static-body="shape: box;"></a-entity>
                        <?php
} else {
?>
  
            <a-entity id="cause-christi-logo-model" class="center-obj-zone" static-body
                        gltf-model="#cause-christi" class="collision" visible="true"
                        scale="3 3 3"
                        position="-0.929 1.293 6.077"
                        rotation="0 -7.260 0"
                        static-body="shape: box;"></a-entity>
                      

                        <a-entity id="powersimple-logo-model" class="center-obj-zone" static-body
                        gltf-model="#powersimple" class="collision" visible="true"
                        scale=".9 .9 2"
                        position="-4.739 1.338 -2.981"
                        rotation="0 -120 0"
                        static-body="shape: box;">
                    
                    </a-entity>

                  
                   
                    <a-entity id="metavrse-logo-model" class="center-obj-zone" static-body
                        gltf-model="#metavrse" class="collision" visible="true"
                        scale=".7 .7 .7"
                        position="5.375 1.457 -2.476"
                        rotation="0 120 0"

                        static-body="shape: box;" 
                    
                        ></a-entity>

                        <a-entity id="vrm-logo-model" class="center-obj-zone" static-body
                        gltf-model="#vrm" class="collision" visible="true"
                        scale="3 3 3"
                        position="-5.318 1.149 1.773"
                        rotation="90 -72.5 0"
                        static-body="shape: box;"></a-entity>


                        <a-entity id="3lbxr-logo-model" class="center-obj-zone" static-body
                        gltf-model="#threelbxr" class="collision" visible="true"
                        scale="3 3 3"
                        position="-5.318 1.149 1.773"
                        rotation="90 -72.5 0"
                        static-body="shape: box;"></a-entity>
                        
                        <a-entity id="vartisans-logo-model" class="center-obj-zone" static-body
                        gltf-model="#vartisans" class="collision" visible="true"
                        scale="3 3 4"
                        position="4.422 1.149 4.271"
                        rotation="0 45 0"
                        static-body="shape: box;">
                    
                    </a-entity>
                        
                    

                  
                   
                    <a-entity id="xrwomen-logo-model" class="center-obj-zone" static-body
                        gltf-model="#xrwomen" class="collision" visible="true"
                        scale="5 8 5"
                        position="1.045 1.406 -5.802"
                        rotation="90 174 0"

                        static-body="shape: box;" 
                    
                        ></a-entity>


<?php
    }
?>






















                </a-entity>





<!---->

            
             
            
            
        




                <!--
                <a-entity id="nav" class="center-obj-zone" static-body
                scale=".6 .6 .6 "
                position="0.124 .8 3.97"
                material="shader: standard; metalness: 0.8;" 
                gltf-model="#ring" class="collision" visible="true"></a-entity>-->
                </a-entity><!-- platform-->
    <a-entity id="pedestals" position="0 0.060 0" rotation="0 0 0">
  <?php

        if($showplatform == "true"){
            include "webxr/polys3/pedestals.php";
        }

        ?>
        </a-entity><!-- pedestals -->



                <a-entity id="Polys3-logo-model" class="center-obj-zone" static-body
                        gltf-model="#The3rdPolysLogo"  visible="true"
                        scale=".02 .02 .015"
                        position="0 0.621 0"
                        rotation="0  90 0"
                        ></a-entity>

        <a-entity id="trophy-model" class="center-obj-zone" 
                gltf-model="#trophy"  visible="true"
                scale="100 100 100"
                position="1 -56.180 -27"
                rotation="0 0 0" 
                animation="property: object3D.rotation.y; to: -360; easing: linear; dur: 24000; loop: true;">
                
            <?php
             if($showplatform == "true"){
            ?>

                <a-entity id="Polys3-logo-model" class="center-obj-zone" static-body
                        gltf-model="#The3rdPolysLogo"  visible="true"
                        scale=".02 .02 .015"
                        position="0 0.621 0"
                        rotation="0  90 0"
                        ></a-entity>
                        
                      
                       <!--
                    <a-entity id="ZeroSpace-logo-model" class="center-obj-zone" static-body
                        gltf-model="#zerospace-logo" class="collision" visible="true"
                        scale=".1 .1 .2"
                        position="0.031 0.582 0.018"
                        rotation="0 -29.4 0"
                        static-body="shape: box;"></a-entity>

                        <a-entity troika-text='value:LIVE from ; color:#f5f5f5; align:center; color:#fff; fontSize:.01;align:center;'scale=".3 .3 .3"
                        position="0.020 0.5875 0.012"
                        rotation="0 -29.4 0"  ></a-entity>-->

                        <a-entity id="point-cloud-model" class="center-obj-zone" static-body
                        gltf-model="#point-cloud" 
                        scale="1 1 1 "
                        position="0 2.056 0"
                        rotation="0 45 0"
                        >                    
                    </a-entity>
                    
                <?php
             }
                ?>

            </a-entity>
    </a-entity><!-- awards 2022-->



  


     





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
?>`