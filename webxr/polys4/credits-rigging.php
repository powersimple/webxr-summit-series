<?php

$speed = "65";
if(@$_GET['speed']){
    $speed = $_GET['speed'];    
}
$cam_x =0;
$cam_y =1.6;
$cam_z =-3.5;
if(@$_GET['camera']){
    $cam_coords =  explode("~",$_GET['camera']);
    if(count($cam_coords) == 3){
      $cam_x = $cam_coords[0];
      $cam_y = $cam_coords[1];
      $cam_z = $cam_coords[2];
    }
  }
?>



<a-entity>
            <a-text id="GL-VR" visible="false" position="2.55 -0.1 0.01" value="" color="white" width="4"
                line-height="50" text="wrapCount: 30"></a-text>
            <a-text id="GL-PC" visible="false" position="2.55 -0.1 0.1" value="" color="black" width="5"
                line-height="50" text="wrapCount: 30"></a-text>
            <a-text id="GL-SP" visible="false" position="2.55 -0.1 0.1" value="" color="black" width="5"
                line-height="50" text="wrapCount: 30"></a-text>


            <a-text id="SMH-VR" visible="false" position="-6.65 -0.57 0.01" value="" color="black" width="5"
                line-height="60" text="wrapCount: 30"></a-text>
            <a-text id="SMH-PC" visible="false" position="-6.65 -0.75 0.01" value="" color="black" width="5"
                line-height="40" text="wrapCount: 30"></a-text>
            <a-text id="SMH-SP" visible="false" position="-6.65 -0.6 0.01" value="" color="black" width="5"
                line-height="50" text="wrapCount: 25"></a-text>
        </a-entity>


        <a-entity id="rig" rotation-reader thumbstick-logging
            movement-controls="speed:<?=$speed?>;" position="0 0 0">
            <!-- Player Character -->
            <a-box id="body" plane-hit aabb-collider="collideNonVisible: true; objects: .zone" static-body="shape: box"
                position="0 0.05 0" width="0.25" height="0.25" depth="0.25" visible="false"></a-box>
            
                <!-- CAMERA 
                    summit coords position="-40 35 -105" f
 position="<?=$cam_x?> <?=$cam_y?> <?=$cam_z?>" 
                -->
                
            <a-entity camera look-controls="fly:true"  wasd-controls="fly:true; acceleration:<?=$speed?>" raycaster="far: 5; objects: .clickable"
                super-hands="colliderEvent: raycaster-intersection; colliderEventProperty: els; colliderEndEvent:raycaster-intersection-cleared; colliderEndEventProperty: clearedEls;"
                
                position="<?=$cam_x?> <?=$cam_y?> <?=$cam_z?>" 
            
                rotation="0 -25 0"
                
                >
                <a-light id="cam-light-front" color="#ffffff" position="0.73528 -2.47372 0.10294" rotation="-13.54 -7.970000000000001 0" light="type: spot; intensity: 4; angle: 75; distance: 25; shadowRadius: -3.72" visible=""></a-light>
 
                <a-light id="cam-light-left" color="#ffffff" position="-6.03376 0 9.62659" rotation="0 29.999999999999996 0" light="type: spot; intensity: 4; angle: 105.99; distance: 25; shadowRadius: -3.72" visible=""></a-light>
                <a-light id="cam-light-left" color="#ffffff" position="-6.03376 0 9.62659" rotation="0 29.999999999999996 0" light="type: spot; intensity: 4; angle: 105.99; distance: 25; shadowRadius: -3.72" visible=""></a-light><!---->
                



                <a-entity id="crosshair" cursor="rayOrigin:mouse" position="0 0 -0.2"
                    geometry="primitive: ring; radiusInner: 0.002; radiusOuter: 0.003"
                    material="shader: flat" raycaster="far: 5; objects: .clickable" visible="false"></a-entity>
            </a-entity>

            <a-entity mixin="hand"  oculus-touch-controls="hand: left" hand-controls="hand: left; handModelStyle: highPoly; color: #0055ff"> 
             <!-- -->
          <!--  <a-entity fps-counter></a-entity>-->
            </a-entity>
            <a-entity mixin="hand" oculus-touch-controls="hand: right" hand-controls="hand: right; handModelStyle: highPoly; color: #0055ff"   blink-controls ="cameraRig: #rig;  teleportOrigin: #camera; collisionEntities: .collision; hitCylinderColor: #FF0; interval: 10; curveHitColor: #e9974c; curveNumberPoints: 40; curveShootingSpeed: 8;landingNormal:0 2 0"  >   
            </a-entity>
        </a-entity>
        <script>
  AFRAME.registerComponent('arrow-keys', {
    init: function () {
      var camera = document.querySelector('#camera');
      var position = camera.getAttribute('position');

      var animatePosition = function (to, easing, duration) {
        camera.setAttribute('animation__position', {
          property: 'position',
          to: to,
          easing: easing,
          dur: duration
        });
      };

      var handleKeyDown = function (event) {
        var key = event.keyCode;
        var delta = 0.5;

        switch (key) {
          case 37: // left arrow
            animatePosition({
              x: position.x - delta,
              y: position.y,
              z: position.z
            }, 'easeInOutQuad', 1000);
            break;

          case 38: // up arrow
            animatePosition({
              x: position.x,
              y: position.y + delta,
              z: position.z
            }, 'easeInOutQuad', 1000);
            break;

          case 39: // right arrow
            animatePosition({
              x: position.x + delta,
              y: position.y,
              z: position.z
            }, 'easeInOutQuad', 1000);
            break;

          case 40: // down arrow
            animatePosition({
              x: position.x,
              y: position.y - delta,
              z: position.z
            }, 'easeInOutQuad', 1000);
            break;
        }
      };

      var handleKeyUp = function (event) {
        camera.removeAttribute('animation__position');
      };

      document.addEventListener('keydown', handleKeyDown);
      document.addEventListener('keyup', handleKeyUp);
    }
  });
</script>