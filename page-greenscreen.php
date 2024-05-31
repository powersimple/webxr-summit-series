<?php

//phpinfo(); die();

get_header();
//    get_eventsFromTable(15);
    require_once "functions/functions-aframe.php";
    $speed = "0.2";
    if(@$_GET['speed']){
        $speed = $_GET['speed'];    
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
  
    $cam_x = 0;
$cam_y = 1.6;
$cam_z = 0;

if(@$_GET['camera']){
  $cam_coords =  explode("~",$_GET['camera']);
  if(count($cam_coords) == 3){
    $cam_x = $cam_coords[0];
    $cam_y = $cam_coords[1];
    $cam_z = $cam_coords[2];
  }
}

    $thumbnail =getThumbnail(get_post_thumbnail_id($post->ID),"Full");
     ?>



    
   
    <script>
        if (location.protocol !== 'https:') {
            location.replace(`https:${location.href.substring(location.protocol.length)}`);
        }
    </script>
  

 




    <a-scene look-switch anti-drop grab-panels burial-grab item-grab device-set device-orientation-permission-ui gltf-model="dracoDecoderPath: assets/draco/;" grab-panels item-grab device-set nomination-link 
        device-orientation-permission-ui physics="iterations: 30;"
        inspector="https://cdn.jsdelivr.net/gh/aframevr/aframe-inspector@master/dist/aframe-inspector.min.js"
        loading-screen="backgroundColor: #12171a" renderer="colorManagement: true; foveationLevel: 2;"
        background="color: #000000">
        <a-entity tracked-controls="controller: 0; idPrefix: OpenVR"></a-entity>
        <a-entity tracked-controls="controller: 1; id Prefix: OpenVR"></a-entity>

        <a-assets timeout="800000">
             <!-- Loads models -->
    <a-asset-item id="2nd-polys-trophy" response-type="arraybuffer"
    src="/assets/models/polys/trophies/VEOTY-WINNER-TheMagicOfFlight.glb"></a-asset-item>

    <a-asset-item id="pedestal" response-type="arraybuffer" src="/assets/models/polys/pedestal.glb"></a-asset-item>
    
    <img id="sky" src="/assets/images/skybox/bluescreen.jpg">


            <?php// include "webxr/summits/assets.php";?>
            <?php include "webxr/summits/mixins.php";?>
            <a-asset-item id="platform" response-type="arraybuffer" src="/assets/models/polys/platform.glb"></a-asset-item>
        </a-assets>


        <a-sky src="#sky"></a-sky>
        <a-entity id="lighting" visible="true" static-body position="0 15 -25" rotation="0 0 0" >



<a-light id="white-d1" type="directional" color="white" intensity="5" position="0 10 -50" rotation="0 180 0" angle="90"></a-light>


<a-light id="white-d2" type="directional" color="white" intensity="5" position="-50 10 0" rotation="90 -90 0" angle="90"></a-light>


<a-light id="white-d3" type="directional" color="white" intensity="5" position="50 10 0" rotation="-90 90 0" angle="90"></a-light>


<a-light id="white-d4" type="directional" color="white" intensity="5" position="0 10 50" rotation="0 0 0" angle="90"></a-light>






<a-light id="green1" type="point" intensity="1" position="0 -120 10" rotation="0 0 0" angle="90"></a-light>
<a-light id="red1" type="point" color="#900" color="#090" intensity="1" position="-25 -80 -10" rotation="0 0 0" angle="90"></a-light>
<a-light id="blue1" type="point" color="#009" intensity="1" position="24 -80 -10" rotation="0 0 0" angle="90"></a-light>


<a-light id="yellow1" type="point" color="#Ff0" intensity="1" position="0 -140 100" rotation="0 0 0" angle="90"></a-light>

<a-light id="purple1" type="point" color="909" intensity="1" position="0 100 10" rotation="0 0 0" angle="90"></a-light>





<a-light id="yellow1" type="spot" color="#fff" intensity="15" position="0 5 30" rotation="-90 0 0" angle="90"></a-light>


        <a-entity id="rig" rotation-reader thumbstick-logging
            movement-controls="speed: <?=$speed?>; constrainToNavMesh: true;fly: true" position="<?=$cam_x?> <?=$cam_y?> <?=$cam_z?>" rotation="0 0 0">
           
            <a-box id="body" plane-hit aabb-collider="collideNonVisible: true; objects: .zone" static-body="shape: box"
                position="0 0.05 0" width="0.25" height="0.25" depth="0.25" visible="false"></a-box>

            <a-entity id="camera" camera look-controls capture-mouse cursor="rayOrigin:mouse" camera="zoom: 1"
                raycaster="far: 5; objects: .clickable" super-hands="colliderEvent: raycaster-intersection;
                             colliderEventProperty: els;
                             colliderEndEvent:raycaster-intersection-cleared;
                             colliderEndEventProperty: clearedEls;" position="0 0 0" rotation="0 0 0"></a-entity>

            <a-entity mixin="hand" hand-controls="hand: left; handModelStyle: highPoly; color: #ffcccc"></a-entity>
            <a-entity mixin="hand" hand-controls="hand: right; handModelStyle: highPoly; color: #ffcccc"></a-entity>

            <a-entity oculus-touch-controls="hand: left" vive-controls="hand: left" thumb-controls="hand: left" blink-controls="cameraRig: #rig; teleportOrigin: #camera; collisionEntities: #nav; hitCylinderColor: #e9974c; interval: 10; curveHitColor: #e9974c; curveNumberPoints: 40; curveShootingSpeed: 8">
            </a-entity>
            <a-entity oculus-touch-controls="hand: right" vive-controls="hand: right " thumb-controls="hand: right">
            </a-entity><!---->

            
        </a-entity>  

       
     <a-entity id="2nd-polys-trophy-model" class="center-obj-zone" static-body
                gltf-model="#2nd-polys-trophy" visible="true" scale="10 10 10"   animation="property: object3D.rotation.y; from: 360; easing: linear; dur: 12000; loop: true;"  material="shader: standard; metalness: 1 roughness:0;" position="0.183 -0.29 -10"
                rotation="0 -90 0"></a-entity>

    <a-entity id="light-rig" position="0 60 0">

    <a-light id="Spin-spot1" type="spot" color="#fff" distance="150" intensity="30" position="0 0 0"angle="250" rotation="0 0 0"></a-light></a-entity>
    
    <a-light id="white1" type="spot" color="white" intensity="50" position="0.3 27 -1" rotation="90 90 0">
        </a-light>
        <a-light id="white2" type="directional" color="white" intensity="50" position="2 22 -6" rotation="-90 0 0" angle="45">
        </a-light>
        <a-light id="white3" type="spot" color="#ff4d00" intensity="5" position="-36 15 10" rotation="0 0 0" angle="90">
        </a-light>
        <a-light id="white4" type="spot" color="#6b0000" intensity="5" position="-60 -10 45" rotation="60 0 0"angle="90">
        </a-light>
        <a-light id="white5" type="directional" color="#00bfff" intensity="5" position="6  4 -6" rotation="-90 0 0"angle="90">
        </a-light>
        

        <a-light id="white6" type="spot" color="white" intensity="50" position="5 -1.5 -10" rotation="45 90 0">
        </a-light>





        <?php 
        
    
        ?>






<a-entity id="partner-events">   </a-entity>
        
        <?php 
     //       require_once "webxr/polys2/partners.php";

            
        ?>
    
  


























    </a-scene>
</body>

<?php get_footer();?>
</html>