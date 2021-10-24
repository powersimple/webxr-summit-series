<a-mixin id="obj" hoverable
                grabbable="startButtons: trackpaddown, triggerdown, gripclose, gripdown, abuttondown, bbuttondown, xbuttondown, ybuttondown, thumbstickdown, mousedown; endButtons: trackpadup, triggerup, gripopen, gripup, abuttonup, bbuttonup, xbuttonup, ybuttonup, thumbstickup, mouseup"
                scale="1 1 1" rotation="0 0 0"
                animation="property: object3D.position.y; to: 1.45; startEvents: standtrigger; dur: 5000" shadow>
            </a-mixin>
            <a-mixin id="button" static-body hoverable
                clickable="startButtons: trackpaddown, triggerdown, gripclose, gripdown, thumbstickdown, mousedown; endButtons: trackpadup, triggerup, gripopen, gripup, thumbstickup, mouseup"
                shadow></a-mixin>
            <a-mixin id="holoprojector" color="#ff6a00" position="0 0.3 0" rotation="180 0 0" height="0.05"
                geometry="primitive: cone; segmentsRadial: 3; openEnded: true; radiusBottom: 0.5; segmentsHeight: 1"
                material="emissive: #ff6a00; wireframe: true"
                animation="property: rotation; to: 180 360 0; loop: true; easing: linear; dur: 10000"></a-mixin>
            <a-mixin id="hand" physics-collider static-body="shape: box" collision-filter="collisionForces: false;"
                super-hands="colliderEvent: collisions; 
                              colliderEventProperty: els;
                              colliderEndEvent: collisions;
                              colliderEndEventProperty: clearedEls;
                              grabStartButtons: trackpaddown, triggerdown, gripclose, gripdown, thumbstickdown, mousedown; 
                              grabEndButtons: trackpadup, triggerup, gripopen, gripup, thumbstickup, mouseup">
            </a-mixin>
            </a-mixin>
            <a-mixin id="table-label" position="0 0 -1" rotation="0 -90 0" visible="false"
                text="width: 2; color: black; lineHeight: 60; wrap-count: 35"></a-mixin>
            <a-mixin id="burial-label" position="0 0 -1" text="width: 2; color: black; lineHeight: 60; wrap-count: 35">
            </a-mixin>
            <a-mixin id="table-caption" text="align: right; color: black; lineHeight: 55; wrap-count: 50"></a-mixin>
            <a-mixin id="scale-box" visible="false"></a-mixin>
            <a-mixin id="scale-label-border" geometry="primitive: plane; height: 1.05; width: 1.05; buffer: false"
                material="color: #375719; shader: flat;"></a-mixin>
            <a-mixin id="scale-label" geometry="primitive: plane; height: 1; width: 1; buffer: false"
                material="color: #dadada; shader: flat;"></a-mixin>
            <a-mixin id="scale-text" text="color: black; width: 2; wrapCount: 45"></a-mixin>
            <a-mixin id="credit-text" text=" color: black; width: 2; wrapCount: 70; lineHeight: 55">

            </a-mixin>
            <a-mixin id="mapmarker" scale="0.17 0.17 0.17" rotation="-90 0 0"
                geometry="primitive: cone; radiusBottom: 0.2; radiusTop: 0.01; segmentsRadial: 6"
                material="color: #ffaa00"> </a-mixin>