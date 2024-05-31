
    <?php
    get_header();
    require_once "functions/functions-awards.php";
      $pedestals = get_pedestals('polys4');
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
 //  include "webxr/polys4/drawer-experiences.php";
 //   include "webxr/polys2/drawer-nominations.php";
?>

   

<a-scene grab-panels item-grab device-set nomination-link anti-drop device-orientation-permission-ui physics="iterations: 30" renderer="antialias: true;
                   colorManagement: true;
                   sortObjects: true;
                   maxCanvasWidth: 8000;
                   maxCanvasHeight: 1800;"" gltf-model="dracoDecoderPath: assets/draco/;" 
    device-orientation-permission-ui physics="iterations: 30;"
    inspector="https://cdn.jsdelivr.net/gh/aframevr/aframe-inspector@master/dist/aframe-inspector.min.js"
    loading-screen="backgroundColor: #12171a" renderer="colorManagement: true; foveationLevel: 0;maxCanvasWidth:5600;
                   maxCanvasHeight: 3200;"
    background="color: #000000">

    <a-assets timeout="80000"> <a-entity tracked-controls="controller: 0; idPrefix: OpenVR"></a-entity>
    <a-entity tracked-controls="controller: 1; idPrefix: OpenVR"></a-entity>
        <!-- Loads assets -->
        <?php
            include "webxr/polys4/assets.php";
            include "webxr/polys4/mixins.php";
            
        ?>

    </a-assets>
    <a-sky src="#sky" animation="property: object3D.rotation.y; to: -360; easing: linear; dur: 1200000; loop: true;"></a-sky>

    <?php
            include "webxr/polys4/rigging.php";
           
    $showplatform="true";        
    if(@$_GET['showplatform']){
        $showplatform = "false";
     
    }


?>
<a-entity id="awards-2022" position="0 0 27.5" rotation="0 0 0" scale="1 1 1" visible="true">
<a-entity id="lighting" visible="true" static-body position="0 0 10" rotation="0 0 0"  animation="property: object3D.rotation.y; to: 360; easing: linear; dur: 24000; loop: true;">

   
<a-light id="red-d7" type="point" color="#990000" intensity="5" position="16 0 0" rotation="90 -90 0" angle="90"></a-light>
<a-light id="green-d7" type="point" color="#99c800" intensity="5" position="0 16 0" rotation="90 -90 0" angle="90"></a-light>
<a-light id="blue-d7" type="point" color="#000099" intensity="5" position="0 0 16" rotation="90 -90 0" angle="90"></a-light>

<a-light id="white-d8" color="white" position="-22.42293 0.04765 304.98845" rotation="76.450 0 0" angle="80" light="angle: 75; type: spot; intensity: 55.32; shadowRadius: -3.72" visible=""></a-light>
<a-light id="white-d9" color="white" position="-90.67807 -5.219 -11.07101" rotation="-72.85237 -90.623 -168.32020000000003" angle="80" light="angle: 75; type: spot; intensity: 20; shadowRadius: -3.72" visible=""></a-light>
<a-light id="white-d8" color="white" position="72.597 -21.54833 -22.56896" rotation="0 89.9 0" angle="80" light="angle: 75; type: spot; intensity: 5; shadowRadius: -3.72" visible=""></a-light>
<a-light id="white-d8" color="white" position="0 4.55193 90" rotation="-75.71 0 0" angle="80" light="angle: 75; type: spot; intensity: 10; shadowRadius: -3.72" visible=""></a-light>
</a-entity>
        <?php
//             include "webxr/polys4/lights.php"; 
             if($showplatform == "true"){
            ?>
        <a-entity id="trophy-rotation" class="center-obj-zone" 
                visible="true"
                scale="1 1 1"
                position="0 0 0"
                rotation="0 0 0" 
               >

        <a-entity id="trophy-model" class="center-obj-zone" 
                gltf-model="#trophy"  visible="true"
                scale="1 1 1"
                position="0 0 0"
                rotation="0 60 0" 
                animation="property: object3D.rotation.y; to: -360; easing: linear; dur: 24000; loop: true;"
           >

        </a-entity>
                
          

            
                     
                    
                <?php
             }
                ?>

            </a-entity>
    </a-entity><!-- awards 2022-->
<a-entity id="trophy-model" class="center-obj-zone" gltf-model="/assets/models/polys/4th/2023-SophiaMoshasha.glb" visible="" scale="2 2 2" position="-7.06641 -1.51463 -28.08047" rotation="0 -104.76971859776658 0" animation="property: object3D.rotation.y; to: -360; easing: linear; dur: 24000; loop: true">

        </a-entity>
        <a-entity id="trophy-model" class="center-obj-zone" gltf-model="/assets/models/polys/4th/2023-SophiaMoshasha.glb" visible="" scale="2 2 2" position="-7.06641 -1.51463 -28.08047" rotation="0 -104.76971859776658 0" animation="property: object3D.rotation.y; to: -360; easing: linear; dur: 24000; loop: true">

                        <a-light id="light" color="white" position="4.56962 1.56774 -0.62147" rotation="-3.37 96.53 0"  light="color: #ffc800; angle: 16.160; type: spot; intensity: 20;distance:3;" visible=""></a-light>
        <a-light id="light-p4c-experience-of-the-year" color="white" position="3.36421 1.18394 -6.93381"rotation="13.58 90.2 0" light="color: #ffc800; angle: 16.16; type: spot; intensity: 20; distance:5;" visible=""></a-light>
        <a-light id="light-p4c-experience-of-the-year" color="white" position="0.14272 -0.34994 3.48613" rotation="36.96 1.9100000000000001 0" light="color: #ffc800; angle: 21.4; type: spot; intensity: 23.11; distance: 4.41"  visible=""></a-light>
                      
                      </a-entity>


  


     



















</a-scene>
<?php
     get_footer();
?>`

  


     



















</a-scene>
<?php
     get_footer();
?>