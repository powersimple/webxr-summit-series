console.warn = console.error = () => {}; // Suppresses Three.js warnings. Remove to debug

AFRAME.registerComponent('device-set', { // Device-specific settings
    init: function() {
        var sceneEl = document.querySelector('a-scene');
        var tablestand = sceneEl.querySelectorAll('.table');
        var standup = sceneEl.querySelectorAll('.standup');
        var rig = document.querySelector('#rig');
        var camera = document.querySelector('#camera');
        var state = "stand";
        if (AFRAME.utils.device.isMobile() === true) { // Smartphone Mode
            sceneEl.setAttribute("vr-mode-ui", "enabled", "false");
            document.querySelector('#crosshair').object3D.visible = false; // Hides crosshair for non PC
            document.querySelector('#GL-SP').object3D.visible = true;
            document.querySelector('#SMH-SP').object3D.visible = true;
            for (let each of tablestand) {
             //   each.setAttribute('animation', {property: 'position.y', to: 0.3, dur: 5000});
            }
            for (let each of standup) {
                each.removeAttribute('dynamic-body');
                each.removeAttribute('grabbable');
                each.setAttribute('static-body');
                each.setAttribute('rotation', {z: 90});
                each.dispatchEvent(new CustomEvent("standtrigger"));
            }
        } else if (AFRAME.utils.device.checkHeadsetConnected() === true) { // VR Modes
            document.querySelector('#crosshair').object3D.visible = false; // Hides crosshair for non PC
            document.querySelector('#GL-VR').object3D.visible = true;
            document.querySelector('#SMH-VR').object3D.visible = true;
            rig.setAttribute("movement-controls", "speed", 0.10); // VR movement is slower than other modes for non barfing
        } else if (AFRAME.utils.device.checkHeadsetConnected() === false) { // PC Mode
          //  camera.removeAttribute('look-controls');
          //  camera.setAttribute('fps-look-controls', 'userHeight', 0);
            document.querySelector('#GL-PC').object3D.visible = true;
            document.querySelector('#SMH-PC').object3D.visible = true;
            rig.setAttribute("movement-controls", "speed", 0.15);
            for (let each of tablestand) {
                let poss = each.getAttribute('position');
              //  each.setAttribute('animation', {property: 'position.y', to: poss.y + 0.25, dur: 5000, delay: 50});
            }
            for (let each of standup) { // Stands up small objects
                each.removeAttribute('dynamic-body');
                each.removeAttribute('grabbable');
                each.setAttribute('static-body');
                each.setAttribute('rotation', {z: 90});
                each.dispatchEvent(new CustomEvent("standtrigger"));
            }
            window.addEventListener("keydown", function(e){ // Crouch key for PC
                if(e.keyCode === 67 && state == "stand") { 
                    camera.setAttribute('position', {y: 1.0});
                    state = "crouch";
                } else if (e.keyCode === 67 && state == "crouch") {
                    camera.setAttribute('position', {y: 1.6});
                    state ="stand";
        
                }
            });
    }
}})

AFRAME.registerComponent("plane-hit", { // Manual occlusion zones
    init: function () {
        sceneEl = document.querySelector('a-scene');
        var el = this.el;

        var gzoneobjs = sceneEl.querySelectorAll(".grab-obj-zone");
        var czoneobjs = sceneEl.querySelectorAll(".center-obj-zone");
        var grabcheck = 0;
        var centercheck = 0;
        var scalecheck = 0;
        var burialcheck = 0;
        var visiswitch = function (zone, toggle) {
            for (let each of zone) {
                each.object3D.visible = toggle;
            }
        }
        var visidistanceswitch = function (zone, toggle) {
            for (let each of zone) {
                let poss = each.getAttribute('position');
                let area = (poss.x + 1) * (poss.z + 1);
                let absarea = Math.abs(area)
                if (each.is('grabbed') == false && absarea <= 3) { // See if object has moved under 2 meters in coordinates
                    each.object3D.visible = toggle; // Hide object if close to table
                } else {
                    each.object3D.visible = true; // Keep object visible if it has been carried
                }
            }
        }
        var lightswitch = function () { // Light switch logic to light the right area
            if (grabcheck == 1 || centercheck == 1 || (scalecheck == 1 && burialcheck == 0)) {
                console.log("main lights on");
                visiswitch(mlightzone, true);
                visiswitch(blightzone, false);
            } else if (scalecheck == 1 && burialcheck == 1) {
                console.log("both lights on");
                visiswitch(mlightzone, true);
                visiswitch(blightzone, true);
            } else {
                console.log("burial lights on");
                visiswitch(mlightzone, false);
                visiswitch(blightzone, true);
            }
        }


        var zonechecker = function () {
            var list = el.components['aabb-collider'].intersectedEls;
            for (let each of list) {
                if (each.id == "just-grab") { // Turn off Scale Model Hall and Centerpiece or not when user is inside Grab Lab
                    console.log("just-grab entered");
                    grabcheck++;
                }
                if (each.id == "just-center") { // Turn off parts of Scale Model Hall and Grab Lab when user is inside Centerpiece area
                    console.log("just-center entered");
                    centercheck++;
                }
                if (each.id == "just-scale") { // Turn off parts of Grab Lab when user is inside Scale Model Hall area
                    console.log("just-scale entered");
                    scalecheck++;
                }
                if (each.id == "just-burial") { // Turn off parts of Burial Chamber when user is inside Scale Model Hall area
                    console.log("just-burial entered");
                    burialcheck++;
                }
            }
            if (grabcheck == 1) {
                console.log("grab on");
                visiswitch(gzone, true);
                visiswitch(gzoneobjs, true);
                visiswitch(scale2, false);
                visiswitch(scale3, false);
                lightswitch();

            } else {
                console.log("grab off");
                visiswitch(gzone, false);
                visidistanceswitch(gzoneobjs, false);
            }
            if (centercheck == 1) {
                console.log("center on");
                visiswitch(czone, true);
                visiswitch(czoneobjs, true);
                visiswitch(scale2, true);
                visiswitch(scale3, true);
                lightswitch();

            } else {
                console.log("center off");
                visiswitch(czone, false);
                visidistanceswitch(czoneobjs, false);
            }
            if (scalecheck == 1) {
                console.log("scale on");
                visiswitch(scale1, true);
                visiswitch(scale2, true);
                visiswitch(scale3, true);
                lightswitch();

            } else {
                console.log("scale off");
                visiswitch(scale1, false);
                visiswitch(scale2, false);
            }
            if (burialcheck == 1) {
                console.log("burial on");
                visiswitch(bzone, true);
                visiswitch(scale3, false);
                lightswitch();
            } else {
                console.log("burial off");
                visiswitch(bzone, false);
            }
            centercheck = 0;
            grabcheck = 0;
            scalecheck = 0;
            burialcheck = 0;

        }


        el.addEventListener("hitstart", function (evt) {
            zonechecker();
        }) // Hitstart end

        el.addEventListener("hitend", function (evt) {
            zonechecker();
            // Hitend end     

        })
    }
})





// Anti-Drop Protection
AFRAME.registerComponent("anti-drop", {
    init: function () {
        sceneEl = document.querySelector('a-scene');
        this.grabbablelist = sceneEl.getElementsByClassName("grabbable");
        this.tick = AFRAME.utils.throttleTick(this.tick, 3000, this);
    },
    dropcheck: function () {
        for (let each of this.grabbablelist) {
            let poss = each.getAttribute('position');
            let area = (poss.x + 1) * (poss.z + 1);
            let absarea = Math.abs(area)
            if (poss.y <= 0.1 && absarea <= 5) {
                each.object3D.position.set(0, 1.4, 0);
                each.components['dynamic-body'].syncToPhysics(); // This makes the position official
            }
        }
    },
    tick: function (t, dt) { // Tick function magic
        this.dropcheck();
    },

})

// Warp
AFRAME.registerComponent("warp", {
    init: function () {
        sceneEl = document.querySelector('a-scene');
        this.el.addEventListener("grab-start", function (evt) {
            document.querySelector("#rig").object3D.position.set(-12.5, 0, -15.5);
        })

    }
})
 