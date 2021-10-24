<?php
    get_header();
//    get_eventsFromTable(15);
    require_once "webxr/functions-aframe.php";
    $speed = "0.1";
    if(@$_GET['speed']){
        $speed = $_GET['speed'];    
    }

     ?>



    
   
    <script>
        if (location.protocol !== 'https:') {
            location.replace(`https:${location.href.substring(location.protocol.length)}`);
        }
    </script>
    <style>
        /* */
        /*
            #top-nav{display:none; }
       
        .a-enter-ar{display:bock; }*/
        .a-enter-ar-button{
            display: none;
        } 
        .a-enter-vr-button{
            position:fixed !important;
            right:20px !important;
            bottom:20px !important;

        } 
        header, footer,{
           /* 
           display: none;*/
        }
    </style>

</head>

<body background="#000">
    <div id="top-nav">
        <div id="menu"></div>
        <div id="menuclose"></div>

        <div id="logo"></div>





    <a-scene look-switch anti-drop grab-panels burial-grab item-grab device-set device-orientation-permission-ui gltf-model="dracoDecoderPath: assets/draco/;" grab-panels item-grab device-set nomination-link 
        device-orientation-permission-ui physics="iterations: 30;"
        inspector="https://cdn.jsdelivr.net/gh/aframevr/aframe-inspector@master/dist/aframe-inspector.min.js"
        loading-screen="backgroundColor: #12171a" renderer="colorManagement: true; foveationLevel: 2;"
        background="color: #000000">
        <a-entity tracked-controls="controller: 0; idPrefix: OpenVR"></a-entity>
        <a-entity tracked-controls="controller: 1; idPrefix: OpenVR"></a-entity>

        <a-assets timeout="800000">
             <!-- Loads models -->
 <a-asset-item id="pedestal" response-type="arraybuffer" src="/assets/models/pedestal.glb"></a-asset-item>

<a-asset-item id="buttonmodel" response-type="arraybuffer" src="/assets/models/button.glb"></a-asset-item>
<a-asset-item id="buttonupmodel" response-type="arraybuffer" src="/assets/models/button-up.glb">
</a-asset-item>
<a-asset-item id="emblem" response-type="arraybuffer" src="/assets/models/emblem.glb"></a-asset-item>
<a-asset-item id="mountain" response-type="arraybuffer" src="/assets/models/mountain9b.glb"></a-asset-item>
<a-asset-item id="dev-summmit-logos-square" response-type="arraybuffer"
    src="/assets/models/dev-summit-logo-square.glb"></a-asset-item>
<!--   <a-asset-item id="town-hall" response-type="arraybuffer"
    src="/assets/models/TownHall.glb"></a-asset-item>-->
<a-asset-item id="dev-summmit-hosted" response-type="arraybuffer" src="/assets/models/hostedby.glb">
</a-asset-item>
<a-asset-item id="business-summmit-square" response-type="arraybuffer"
    src="/assets/models/BusinessSummitSquare.glb"></a-asset-item>
<a-asset-item id="business-summmit-wide" response-type="arraybuffer"
    src="/assets/models/BusinessSummit-wide.glb"></a-asset-item>
<a-asset-item id="design-summmit-wide" response-type="arraybuffer"
    src="/assets/models/DesignSummit-wide.glb"></a-asset-item>
<a-asset-item id="design-summmit-square" response-type="arraybuffer"
    src="/assets/models/DesignSummit-square.glb"></a-asset-item>
<a-asset-item id="design-summmit-square" response-type="arraybuffer"
    src="/assets/models/DesignSummit-square.glb"></a-asset-item>
<a-asset-item id="space-elevator" response-type="arraybuffer"
    src="/assets/models/elevator/ElevatorShaftPink.glb"></a-asset-item>
<a-asset-item id="business-platform" response-type="arraybuffer"
    src="/assets/models/elevator/business-platform.glb"></a-asset-item>
<a-asset-item id="design-platform" response-type="arraybuffer"
    src="/assets/models/elevator/design-platform.glb"></a-asset-item>
<a-asset-item id="platforms" response-type="arraybuffer" src="/assets/models/elevator/platforms.glb">
</a-asset-item>
<a-asset-item id="walkway" response-type="arraybuffer" src="/assets/models/elevator/walkway.glb">
</a-asset-item>

<a-asset-item id="futurewei-3d-logo" response-type="arraybuffer"
    src="/assets/models/sponsors/futurewei1.glb"></a-asset-item>
    <a-asset-item id="polys2" response-type="arraybuffer" src="/assets/models/Polys2.glb"></a-asset-item>
<img id="sky" src="/assets/images/skybox/blueskybox.jpg">
<img id="green" src="/assets/images/skybox/greenscreen.jpg">
<a-asset-item id="table" response-type="arraybuffer" src="/assets/models/table.glb"></a-asset-item>
<a-asset-item id="chair" response-type="arraybuffer" src="/assets/models/chair.glb"></a-asset-item>



            <?php// include "webxr/summitsold/assets.php";?>
            <?php include "webxr/summitsold/mixins.php";?>


        </a-assets>


        <a-sky src="#sky"></a-sky>
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
            movement-controls="speed: <?=$speed?>; constrainToNavMesh: true;fly: true" position="-41 161 -95" rotation="0 0 0">
           
            <a-box id="body" plane-hit aabb-collider="collideNonVisible: true; objects: .zone" static-body="shape: box"
                position="0 0.05 0" width="0.25" height="0.25" depth="0.25" visible="false"></a-box>

            <a-entity id="camera" camera look-controls capture-mouse cursor="rayOrigin:mouse" camera="zoom: 1"
                raycaster="far: 5; objects: .clickable" super-hands="colliderEvent: raycaster-intersection;
                             colliderEventProperty: els;
                             colliderEndEvent:raycaster-intersection-cleared;
                             colliderEndEventProperty: clearedEls;" position="0 0 0" rotation="0 0 0"></a-entity>

            <a-entity mixin="hand" hand-controls="hand: left; handModelStyle: highPoly; color: #ffcccc"></a-entity>
            <a-entity mixin="hand" hand-controls="hand: right; handModelStyle: highPoly; color: #ffcccc"></a-entity>
<!--
            <a-entity oculus-touch-controls="hand: left" vive-controls="hand: left" thumb-controls="hand: left" blink-controls="cameraRig: #rig; teleportOrigin: #camera; collisionEntities: #nav; hitCylinderColor: #e9974c; interval: 10; curveHitColor: #e9974c; curveNumberPoints: 40; curveShootingSpeed: 8">
            </a-entity>
            <a-entity oculus-touch-controls="hand: right" vive-controls="hand: right " thumb-controls="hand: right">
            </a-entity>-->

            
        </a-entity>  




        <?php include "webxr/summitsold/space-elevator.php";?>
        <?php include "webxr/summitsold/lowpolymountain.php";?>

        <?php // include "webxr/summitsold/partners.php"; ?>

































    </a-scene>
</body>

<?php get_footer();?>
</html>