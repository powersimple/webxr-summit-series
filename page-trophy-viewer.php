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
    <a-entity id="platform-wrap"  scale="2 2 2" position="-8 -1.62 -40" rotation="0 25 0" visible="<?=$showplatform?>">


      
                
                <!-- /inner ring
            
            animation="property: object3D.rotation.y; to: -360; easing: linear; dur: 24000; loop: true;"
            -->
<!--
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
  
           

<?php
    }
?>






















                </a-entity>





--->

            
             
            
            
        




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
          // include "webxr/polys4/pedestals.php";
        }

        ?>
        </a-entity><!-- pedestals -->
        <?php
             include "webxr/polys4/lights.php";
             if($showplatform == "true"){
            ?>
        <a-entity id="trophy-rotation" class="center-obj-zone" 
                visible="true"
                scale="1 1 1"
                position="0 -43.5 -29"
                rotation="0 0 0" 
                animation="property: object3D.rotation.y; to: -360; easing: linear; dur: 24000; loop: true;">

        <a-entity id="trophy-model" class="center-obj-zone" 
                gltf-model="#trophy"  visible="true"
                scale="80 80 80"
                position="0 0 0"
                rotation="0 0 0" 
           >

        </a-entity>
                
          

       
                    
                <?php
             }
                ?>

            </a-entity>
    </a-entity><!-- awards 2022-->



  


     





















</a-scene>
<?php
     get_footer();
?>`