<?php
    get_header();
//    get_eventsFromTable(15);
    require_once "webxr/functions-aframe.php";
    
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
       
        .a-enter-vr{display:none; }*/
        .a-enter-ar-button, .a-enter-vr-button{
            position:fixed !important;
            right:20px !important;
            bottom:20px !important;
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
    src="/assets/models/elevator/SpaceElevatorTower.glb"></a-asset-item>
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

<a-asset-item id="table" response-type="arraybuffer" src="/assets/models/table.glb"></a-asset-item>
<a-asset-item id="chair" response-type="arraybuffer" src="/assets/models/chair.glb"></a-asset-item>



            <?php// include "webxr/summits/assets.php";?>
            <?php include "webxr/summits/mixins.php";?>


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
            movement-controls="speed: 0.2; constrainToNavMesh: true;fly: true " position="0 0.1 1">
            <!-- Player Character -->
            <a-box id="body" plane-hit aabb-collider="collideNonVisible: true; objects: .zone" static-body="shape: box"
                position="0 0.05 0" width="0.25" height="0.25" depth="0.25" visible="false"></a-box>

            <!-- CAMERA 
                    summit coords position="-40 35 -105" f

                -->

            <a-entity id="camera" camera look-controls raycaster="far: 5; objects: .clickable"
                super-hands="colliderEvent: raycaster-intersection; colliderEventProperty: els; colliderEndEvent:raycaster-intersection-cleared; colliderEndEventProperty: clearedEls;"
                position="-39 167.5 -101" rotation="180 150 0">
                <a-entity id="crosshair" cursor="rayOrigin:mouse" position="0 0 -0.2"
                    geometry="primitive: ring; radiusInner: 0.002; radiusOuter: 0.003" material="shader: flat"
                    raycaster="far: 5; objects: .clickable" visible="false"></a-entity>
            </a-entity>
            <a-entity mixin="hand" hand-controls="hand: left; handModelStyle: lowPoly; color: #0055ff">
                <!--<a-entity fps-counter></a-entity>-->

            </a-entity>
            <a-entity mixin="hand" hand-controls="hand: right; handModelStyle: lowPoly; color: #0055ff"
                blink-controls="cameraRig: #rig;  teleportOrigin: #camera; collisionEntities: #mountain-model; hitCylinderColor: #00; interval: 10; curveHitColor: #e9974c; curveNumberPoints: 40; curveShootingSpeed: 8">
            </a-entity>
        </a-entity>
        <a-entity id="rig" rotation-reader thumbstick-logging
            movement-controls="speed: 0.1; constrainToNavMesh: true;fly: true" position="-39 157 -97.5" rotation="0 0 0">
           
            <a-box id="body" plane-hit aabb-collider="collideNonVisible: true; objects: .zone" static-body="shape: box"
                position="0 0.05 0" width="0.25" height="0.25" depth="0.25" visible="false"></a-box>

            <a-entity id="camera" camera look-controls capture-mouse cursor="rayOrigin:mouse" camera="zoom: 1"
                raycaster="far: 5; objects: .clickable" super-hands="colliderEvent: raycaster-intersection;
                             colliderEventProperty: els;
                             colliderEndEvent:raycaster-intersection-cleared;
                             colliderEndEventProperty: clearedEls;" position="0 0 0" rotation="0 0 0"></a-entity>

            <a-entity mixin="hand" hand-controls="hand: left; handModelStyle: highPoly; color: #ffcccc"></a-entity>
            <a-entity mixin="hand" hand-controls="hand: right; handModelStyle: highPoly; color: #ffcccc"></a-entity>

            <a-entity oculus-touch-controls="hand: left" vive-controls="hand: left" thumb-controls="hand: left">
            </a-entity>
            <a-entity oculus-touch-controls="hand: right" vive-controls="hand: right " thumb-controls="hand: right"
                blink-controls="cameraRig: #rig; teleportOrigin: #camera; collisionEntities: #nav #platform-collider; hitCylinderColor: #e9974c; interval: 10; curveHitColor: #e9974c; curveNumberPoints: 40; curveShootingSpeed: 8">
            </a-entity>

        </a-entity>  




        <?php include "webxr/summits/space-elevator.php";?>



        <a-entity id="mountain-model" class="center-obj-zone" static-body position="-25 0 -76" rotation="0 -109 0"
            gltf-model="#mountain" scale="1.5 1.5 1.5" visible="true">


            <a-entity position="-16.125 19.5 17.183" rotation="0 180 0" id="dev-summit-decor" scale="1 1 1" visible="true">
            <a-entity id="dev-summit-brand" position="-42 48 -110" rotation="0 3.6 0">

<a-light id="top" type="ambient" color="white" intensity=".2" position="-0.5 -4 6.5" rotation="0 0 0">
</a-light>
<a-light type="spot" color="#009" intensity="10" position="-6 -6 -15.5" rotation="60 -75 115" angle="60">
</a-light>
<a-light type="spot" color="#009" intensity="10" position="6 -9 -15.5" rotation="115 -75 115" angle="60">
</a-light>
<!--<a-entity id="dev-summmit-logo-hosted" class="center-obj-zone" static-body position="-1.37 -10.5 6.2"
rotation="90 60 -100" gltf-model="#dev-summmit-hosted" scale="20 10 20" visible="true"> </a-entity>-->


<!--        
    <a-entity id="dev-summmit-logo-model" class="center-obj-zone" static-body position="-3.9 -10.5 4.567"
    rotation="90 -22 180" gltf-model="#dev-summmit-logo" scale="50 25 50" visible="true"> </a-entity>              <a-entity id="town-hall-logo-model" class="center-obj-zone" static-body position="-3 -10.6 13.5"
rotation="90 -22 180" gltf-model="#town-hall" scale="125 125 125" visible="true"> </a-entity>-->
<a-entity id="emblem-model" class="center-obj-zone" static-body position="5 -11 8.464" rotation="0 252 0"
    gltf-model="#emblem"
    animation="property: object3D.rotation.y; from: 360; easing: linear; dur: 15000; loop: true;"
    visible="true"> </a-entity>
<a-light id="logo-side-spot" type="spot" color="white" intensity="2" position="-19.044 -3.564 1.939"
    angle="16" rotation="183.980 101.350 -4.820">




    <!-- WebXR Site of the Year. table -->
</a-entity>


                <a-light id="logo-side-spot" type="spot" color="white" intensity=".5" position="6.774 0.976 0.069"
                    angle="50" rotation="38.9 89 168.09"></a-light>
                <a-light id="crater-spot" type="spot" color="white" intensity="1" position="0 5 0" angle="22.5"
                    rotation="270 -71 -72"></a-light>
                <a-light id="crater-spot" type="spot" color="white" distance="60" angle="60" intensity=".4"
                    position="33 -10 -4" rotation="200 -81 -80"></a-light>
                <a-light id="crater-spot" type="spot" color="white" distance="60" angle="40" intensity=".4"
                    position="14.55 8.262 6.951" angle="40" rotation="176.5 -102 -83.44"></a-light>

                <a-entity id="walls" position="-.5 1 -1" rotation="0 90 0">


                    <a-plane height="1" width="2.5" position="-1 1.25 -1.52" rotation="0 0 0"
                        material="side: single; color: #000000; transparent: true; opacity: 0.95" side="single">
                    </a-plane>
                    <a-image material="side:front" mixin="scale-label" src="/assets/images/summit/cards/SponsorCard.jpg"
                        position="-1.11 0.967 -1.379" scale="0.18 0.18 0.18" width="16" height="9"></a-image>


                </a-entity>

                <a-entity id="dev-summmit-logo-model" class="center-obj-zone" static-body position="-2.308 7.761 14"
            rotation="90 180 180" gltf-model="#dev-summmit-logo-square" scale="40 40 40" visible="true"> </a-entity>




            </a-entity>

        </a-entity> <!-- MOUNTAIN model-->
        <!-- MOUNTAIN COLLIDER-->
        <a-entity position="-25 0 -76" rotation="0 -109 0" id="nav" gltf-model="#mountain" scale="1.5 1.5 1.5"
            visible="false">

        </a-entity> <!--   ;  Nav Mesh -->


        <!--
  <a-entity id="table-model" class="center-obj-zone" static-body position="-25 0 -65" rotation="0 -110 0"
            gltf-model="#table" scale="1.5 1.5 1.5" visible="true"></a-entity>
              <a-entity id="chair1-model" class="center-obj-zone" static-body position="-25 0 -65" rotation="0 -110 0"
            gltf-model="#chair" scale="1.5 1.5 1.5" visible="true"></a-entity>
  <a-entity id="chair2-model" class="center-obj-zone" static-body position="-25 0 -65" rotation="0 -110 0"
            gltf-model="#chair" scale="1.5 1.5 1.5" visible="true"></a-entity>


-->


        <!-- -->





        <a-entity id="polys-brand" position="0 13 5" visible="false">
            <a-light type="spot" color="#009" intensity="10" position="-6 -6 -15.5" rotation="60 -75 115" angle="60">
            </a-light>
            <a-light type="spot" color="#009" intensity="10" position="6 -9 -15.5" rotation="115 -75 115" angle="60">
            </a-light>

            <a-entity id="the-polys-model" class="center-obj-zone" static-body position="-1 0 -20" rotation="90 180 180"
                gltf-model="#the-polys" scale="35 35 35" visible="true">

            </a-entity>
            <a-entity id="webxr-awards-model" class="center-obj-zone" static-body position="2.6 -2.5 -20"
                rotation="90 180 180" gltf-model="#webxr-awards" scale="25 25 25" visible="true"></a-entity>

            <a-entity id="label-will-return"
                troika-text="value: Returns February 2022; color:#ffffff; fontSize:.618;outlineWidth:0.06;side:front"
                material="shader: standard; metalness: 0.8;" position="2.5 -3.5 -20" rotation="0 0 0"></a-entity>

        </a-entity>

      



























        <a-entity id="credits" position="-39 36 -115" rotation="0 160.5 0" visible="false">









            <a-entity id="label-created" troika-text="value:Created by
Ben Erwin;color:#fff; fontSize:.25;align:center;" material="shader: standard;" position="-0.3 -2 -10.9"
                rotation="0 0 0"></a-entity>
            <a-entity id="label-created"
                troika-text="value:Music by John Sidorovich;color:#fff; fontSize:.125;align:center;"
                material="shader: standard;" position="-0.3 -5.3 -10.9" rotation="0 0 0" visible="false"></a-entity>

            <a-entity id="label-created" position="0 1  0" rotation="0 0 0" troika-text="value:Produced by:
Steve Lewis -  Julie Smithson - Sophia Moshasha
Karen Alexander - Linda Ricci - Ben Erwin;color:#fff; fontSize:.5;align:center;" material="shader: standard;">
            </a-entity>


            <a-entity id="label-created" position="0 0  10" rotation="0 0 0" troika-text="value:Hosted by Trevor Flowers
 with Julie Smithson;color:#fff; fontSize:.5;align:center;" material="shader: standard;"></a-entity>




            <a-entity id="label-created" position="0 0 15" rotation="0 0 0"
                troika-text="value:The WebXR Awards and Summit Series;color:#fff; fontSize:.5;align:center;"
                material="shader: standard;"></a-entity>
            <a-entity id="label-created" position="0 0 20" rotation="0 0 0"
                troika-text="value:A Point Cloud Production;color:#fff; fontSize:.5;align:center;"
                material="shader: standard;"></a-entity>
            <a-entity id="label-created" position="0 0 25" rotation="0 0 0"
                troika-text="value:Powersimple Presents;color:#fff; fontSize:.5;align:center;"
                material="shader: standard;"></a-entity>


        </a-entity>




        <?php// include "webxr/polys/2020-Polys.php";?>





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



















    </a-scene>
</body>
<script>
    jQuery("#menu").click(function () {

        jQuery(".sidedrawer").animate({
            left: 0,
            opacity: 1
        }, 500);
        jQuery("body").animate({
            marginLeft: 250,
        }, 500);
        jQuery("#menuclose").show();
        jQuery(this).hide();
    });

    jQuery("#menuclose").click(function () {
        jQuery(".appswitchdropdown").hide();
        jQuery(".sidedrawer").animate({
            left: -250,
            opacity: 1
        }, 300);
        jQuery("body").animate({
            marginLeft: 0,
        }, 300);
        jQuery("#menu").show();
        jQuery(this).hide();
    });

    jQuery(".appswitch").click(function () {
        jQuery(".appswitchdropdown").toggle();
    });
    jQuery(".page").hover(function () {
        jQuery(".appswitchdropdown").hide();
    });
    jQuery(".appconversation").click(function () {
        jQuery("#nav, .page, .sidedrawer,.appswitchdropdown").hide();
        jQuery(".convo").show();
        jQuery("body").css({
            marginLeft: 0,
        }, 500);
    });

    jQuery(".convo").click(function () {
        jQuery("#nav, .page, .sidedrawer,.appswitchdropdown").show();
        jQuery(".convo, .trendscontent ").hide();
        jQuery("body").css({
            marginLeft: 250,
        }, 500);
    });

    jQuery(".appstudio").click(function () {
        jQuery(".spark, .sparkcontent, .sparklist").hide();
        jQuery(".studio, .studiolist").show();
        jQuery('#logo').css('background-position', '0px 0px');
        jQuery('.appswitch').css('background-position', '0px 0px');
    });



    jQuery(".collapse").click(function () {
        jQuery(".collapse").hide();
        jQuery(".expand").show();
        jQuery('.sidedrawer').css('width', '60px');
        jQuery(".sparklist div, .appswitch").css({
            width: 50,
        }, 500);

        jQuery("body").animate({
            marginLeft: 60,
        }, 500);


    });

    jQuery(function () {
        jQuery("#accordion").accordion({
            autoHeight: true
        });
    });
</script>
<?php get_footer();?>
</html>