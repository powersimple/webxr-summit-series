<a-entity id="mountain-model" class="center-obj-zone" static-body position="-71.289 0  -125.676"
    rotation="0.660 95.070 0" gltf-model="#mountain" scale="1.5 1.5 1.5" visible="true">


    <a-entity position="-16.125 19.5 17.183" rotation="0 180 0" id="dev-summit-decor" scale="1 1 1" visible="true">
        <a-entity id="dev-summit-brand" position="-64.212 14 3.26" rotation="0 3.6 0">



            <a-entity id="dev-summmit-logo-model" class="center-obj-zone" static-body position="63.300 -7.000 -0.150"
                rotation="90 -94.990 180" gltf-model="#dev-summmit-logo-square" scale="16 16 16" visible="true">
            </a-entity>


            <a-entity id="emblem-model" class="center-obj-zone" static-body position="62.787 -8.499 3.728"
                rotation="0 132.9 0" gltf-model="#emblem" scale="2 2 2"
                animation="property: object3D.rotation.y; from: 360; easing: linear; dur: 15000; loop: true;"
                visible="true"> </a-entity>
            <a-light id="logo-side-spot" type="spot" color="white" intensity="1" position="63.892 -7.570 1.059"
                angle="16.740" rotation="265.690 114.430 -8.33"></a-light>




            <!-- WebXR Site of the Year. table -->
        </a-entity>
        <a-entity id="host-dev-summit" position="-1.17 4.59 0.21" rotation="0 -89.990 0" scale="2 2 2">
            <a-image material="side:front" mixin="scale-label" src="/assets/images/talent/TrevorFlowersSmith.jpg"
                position="0.451  0 0.040" rotation="0 180 0" geometry="primitive: circle; width: 2; height: 2; depth: 3"
                scale=".4 .4 .4" width="5" height="5">
            </a-image>



            <a-entity id="trevor-label" troika-text="value:
        Hosted by Trevor Flowers
May 25, 2021;color:#fff; fontSize:1;align:left;outlineWidth:0.06;" material="shader: standard;"
                position="-1.374 0.016 -0.021" rotation="0 180 0" scale=".2 .2 .2" visibility="true"></a-entity>
        </a-entity>

        <a-entity id="mountain-lights">
            <a-light id="top" type="ambient" color="white" intensity=".2" position="-0.5 -4 6.5" rotation="0 0 0">
            </a-light>


            <a-light id="logo-side-spot" type="spot" color="white" intensity=".5" position="6.774 0.976 0.069"
                angle="50" rotation="41 90 170"></a-light>


            <a-light id="mountain-spot" type="spot" color="#fff" intensity="0.5" position="60 10 0" angle="60"
                rotation="0 104 0"></a-light>


        </a-entity>
        <a-entity id="walls" position="-.5 1 -1" rotation="0 90 0">


            <a-plane height="1" width="2.5" position="-1 1.25 -1.52" rotation="0 0 0"
                material="side: single; color: #000000; transparent: true; opacity: 0.95" side="single">
            </a-plane>
            <a-image material="side:front" mixin="scale-label" src="/assets/images/summit/cards/SponsorCard.jpg"
                position="-1.11 0.967 -1.379" scale="0.18 0.18 0.18" width="16" height="9"></a-image>


        </a-entity>





        <a-entity position="-0 0 0" static-body rotation="0 180 0" id="table-model" gltf-model="#table" scale="1 1 1"
            visible="true">
            <a-entity position="-1.625 0 0" rotation="0 90 0" id="chair1" gltf-model="#chair" scale="1 1 1"
                visible="true"></a-entity>
            <a-entity position="1.625 0 0" rotation="0 270 0" id="chair2" gltf-model="#chair" scale="1 1 1"
                visible="true"></a-entity>
            <a-entity position="-0.75 0 -0.5" rotation="0 0 0" id="chair3" gltf-model="#chair" scale="1 1 1"
                visible="true"></a-entity>
            <a-entity position="0.75 0 -0.5" rotation="0 0 0" id="chair4" gltf-model="#chair" scale="1 1 1"
                visible="true"></a-entity>
            <a-entity position="0.75 0 0.5" rotation="0 180 0" id="chair5" gltf-model="#chair" scale="1 1 1"
                visible="true"></a-entity>
            <a-entity position="-0.75 0 0.5" rotation="0 180 0" id="chair6" gltf-model="#chair" scale="1 1 1"
                visible="true"></a-entity>
            <a-entity position="0 0 -0.5" rotation="0 0 0" id="chair7" gltf-model="#chair" scale="1 1 1" visible="true">
            </a-entity>
            <a-entity position="-0 0 0.5" rotation="0 180 0" id="chair8" gltf-model="#chair" scale="1 1 1"
                visible="true"></a-entity>

        </a-entity>






    </a-entity>

</a-entity> <!-- MOUNTAIN model-->
<!-- MOUNTAIN COLLIDER-->
<a-entity  position="-71.289 0  -125.676"
    rotation="0.660 95.070 0"  id="nav" gltf-model="#mountain" scale="1.5 1.5 1.5" visible="false">

</a-entity> <!--   ;  Nav Mesh -->