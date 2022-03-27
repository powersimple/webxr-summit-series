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
  //include "webxr/polys2/laurel-viewer.php";
//   include "webxr/polys2/drawer-experiences.php";
 //   include "webxr/polys2/drawer-nominations.php";'


 $skybox = "MilkyWaySkybox";
 if(@$_GET['skybox']){
   $skybox = $_GET['skybox'];
 }
 $animation = '';
if(@$_GET['animation']){

  $animation = "animation='property: object3D.rotation.y; to: -360; easing: linear; dur: 24000; loop: true;'";

}


$laurel_props = "
  scale='25 25 35'
  position='0 -.2 -6.5'
  rotation='0 20 0' 
";
if(@$_GET['left']){
  $laurel_props = "
    scale='10 10 10'
    position='-8 0 -6.5'
    rotation='0 20 0'
  ";
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


    <img id="sky" src="/assets/images/skybox/<?=$skybox?>.jpg">
  
    
        <!-- Loads assets -->
    <?php 
        if(@$_GET['laurel']){
?>
  <a-asset-item id="laurel" response-type="arraybuffer" position="0 0 0" src="/assets/models/<?=$_GET['laurel']?>.glb"></a-asset-item>

<?php

        }
    

          //  include "webxr/polys2/assets.php";
            include "webxr/polys2/mixins.php";
            
        ?>

    </a-assets>
    <a-sky src="#sky"></a-sky>

    <?php
            include "webxr/polys2/rigging.php";
           // include "webxr/polys2/lights.php";

?>
<a-light id="white-d4" type="directional" color="white" intensity="1" position="0 0  8" rotation="0 0 0" angle="90"></a-light>
<a-light id="red1" type="spot" color="#900" intensity="25 " position="-16 0 -17.5" rotation="0 -60 0" angle="90"></a-light>

<!--
<a-light id="green1" type="point" intensity="1" position="0 -120 10" rotation="0 0 0" angle="90"></a-light>
<a-light id="red1" type="point" color="#900" color="#090" intensity="1" position="-25 -80 -10" rotation="0 0 0" angle="90"></a-light>
<a-light id="red1" type="point" color="#900" color="#090" intensity="1" position="-25 -80 10" rotation="0 0 0" angle="90"></a-light>


<a-light id="yellow1" type="point" color="#Ff0" intensity="1" position="0 -140 100" rotation="0 0 0" angle="90"></a-light>

<a-light id="red1" type="spot" color="#009" intensity="25 " position="16 0 -17.5" rotation="0 300 0" angle="90"></a-light>
-->


<a-light id="white" type="point" color="909" intensity="5" position="0 0 10" rotation="0 0 0" angle="90"></a-light>
<a-entity id="laurel-model" class="center-obj-zone" static-body
                full-gltf-model="#laurel" class="collision" visible="true"
                <?=$laurel_props?> 
                <?=$animation?>
              >
          

            </a-entity>




            
  


     





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