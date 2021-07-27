
            <!--
  <a-entity id="table-model" class="center-obj-zone" static-body position="-25 0 -65" rotation="0 -110 0"
            gltf-model="#table" scale="1.5 1.5 1.5" visible="true"></a-entity>
              <a-entity id="chair1-model" class="center-obj-zone" static-body position="-25 0 -65" rotation="0 -110 0"
            gltf-model="#chair" scale="1.5 1.5 1.5" visible="true"></a-entity>
  <a-entity id="chair2-model" class="center-obj-zone" static-body position="-25 0 -65" rotation="0 -110 0"
            gltf-model="#chair" scale="1.5 1.5 1.5" visible="true"></a-entity>


-->


            <!-- -->


            <a-entity id="mountain-model" class="center-obj-zone" static-body position="-25.6 -30 -35" rotation="0 90
             0"
                gltf-model="#mountain" scale="1.5 1.5 1.5" visible="true">


                <a-entity position="-16.125 19.5 17.183" rotation="0 180 0" id="dev-summit-decor" scale="1 1 1"
                    visible="true">
                    <a-entity id="dev-summit-brand" position="-42 48 -110" rotation="0 3.6 0">

                        <a-light id="top" type="ambient" color="white" intensity=".2" position="-0.5 -4 6.5"
                            rotation="0 0 0">
                        </a-light>
                        <a-light type="spot" color="#009" intensity="10" position="-6 -6 -15.5" rotation="60 -75 115"
                            angle="60">
                        </a-light>
                        <a-light type="spot" color="#009" intensity="10" position="6 -9 -15.5" rotation="115 -75 115"
                            angle="60">
                        </a-light>
                        <!--<a-entity id="dev-summmit-logo-hosted" class="center-obj-zone" static-body position="-1.37 -10.5 6.2"
rotation="90 60 -100" gltf-model="#dev-summmit-hosted" scale="20 10 20" visible="true"> </a-entity>-->


                        <!--        
    <a-entity id="dev-summmit-logo-model" class="center-obj-zone" static-body position="-3.9 -10.5 4.567"
    rotation="90 -22 180" gltf-model="#dev-summmit-logo" scale="50 25 50" visible="true"> </a-entity>              <a-entity id="town-hall-logo-model" class="center-obj-zone" static-body position="-3 -10.6 13.5"
rotation="90 -22 180" gltf-model="#town-hall" scale="125 125 125" visible="true"> </a-entity>-->
                        <a-entity id="emblem-model" class="center-obj-zone" static-body position="5 -11 8.464"
                            rotation="0 252 0" gltf-model="#emblem"
                            animation="property: object3D.rotation.y; from: 360; easing: linear; dur: 15000; loop: true;"
                            visible="true"> </a-entity>
                        <a-light id="logo-side-spot" type="spot" color="white" intensity="2"
                            position="-19.044 -3.564 1.939" angle="16" rotation="183.980 101.350 -4.820">




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
                        <a-image material="side:front" mixin="scale-label"
                            src="/assets/images/summit/cards/SponsorCard.jpg" position="-1.11 0.967 -1.379"
                            scale="0.18 0.18 0.18" width="16" height="9"></a-image>


                    </a-entity>

                    <a-entity id="dev-summmit-logo-model" class="center-obj-zone" static-body position="-2.308 7.761 14"
                        rotation="90 180 180" gltf-model="#dev-summmit-logo-square" scale="40 40 40" visible="true">
                    </a-entity>




                </a-entity>

            </a-entity> <!-- MOUNTAIN model-->
            <!-- MOUNTAIN COLLIDER-->
            <a-entity position="-25 0 -76" rotation="0 -109 0" id="nav" gltf-model="#mountain" scale="1.5 1.5 1.5"
                visible="false">

            </a-entity> <!--   ;  Nav Mesh -->
