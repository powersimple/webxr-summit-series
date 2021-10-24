<a-asset-item id="pedestal" response-type="arraybuffer" src="/assets/models/pedestal.glb">
                </a-asset-item>

                <a-asset-item id="buttonmodel" response-type="arraybuffer" src="/assets/models/button.glb">
                </a-asset-item>
                <a-asset-item id="buttonupmodel" response-type="arraybuffer" src="/assets/models/button-up.glb">
                </a-asset-item>
                <a-asset-item id="emblem" response-type="arraybuffer" src="/assets/models/emblem.glb"></a-asset-item>
                <a-asset-item id="mountain" response-type="arraybuffer" src="/assets/models/mountain9b.glb">
                </a-asset-item>
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
                    src="/assets/models/elevator/SpaceElevatorTower-colorshaft.glb"></a-asset-item>
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


                <a-entity id="rig" rotation-reader thumbstick-logging
                movement-controls="speed: 0.2; constrainToNavMesh: true;fly: true " position="0 0.1 1">
                <!-- Player Character -->
                <a-box id="body" plane-hit aabb-collider="collideNonVisible: true; objects: .zone"
                    static-body="shape: box" position="0 0.05 0" width="0.25" height="0.25" depth="0.25"
                    visible="false"></a-box>

                <!-- CAMERA 
                    summit coords position="-40 35 -105" f

                -->
