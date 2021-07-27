<a-entity id="awards-2020" position="-1.5 0 0" rotation="0 -15 0" scale="1 1 1" visible="true">
    <a-entity id="floor" static-body position="0 -1 -5.131" rotation="0 0 0" scale="0.76 0.76 0.76" gltf-model="#ring">



        <a-image id="measure" mixin="scale-label" src="/assets/images/bg/12Point.png" scale="5.464 5.464 5.464"
            position="0.04 1.2 0.475" rotation="-90 195 180" width="2" height="2" visible="false">
        </a-image>
    </a-entity>

    <a-entity id="trophy" class="center-obj-zone" static-body position="0.182 -7.5 -5.6" rotation="0 0 0"
        gltf-model="#poly" scale="6 6 6 "
        animation="property: object3D.rotation.y; from: 360; easing: linear; dur: 12000; loop: true;" visible="true">

        <a-entity id="polys2-model" class="center-obj-zone" static-body position="0.05 1.4 0"
                        rotation="90 0 0" gltf-model="#polys2" scale="1 .75 1" visible="true">

                    </a-entity>
                    <a-entity id="polys2-date"
                        troika-text="value:February 12, 2022
Nomination Season
Begins October 1;color:#fff; fontSize:.25;align:center;"
                        material="shader: standard;"  position="0 1.27 0"
                        rotation="0 0 0"  scale=".1 .1 .1"></a-entity>

    </a-entity>
    <a-entity id="stonehenge-light-rig" position="0.07 10.67 -5 rotation 0.39 -0.36 0" visible="false">
        <a-light type=" spot" color="#006" intensity="5" position="0.06 -20.73 -0.523" rotation="-270 0 0" angle="30">
        </a-light>

        <a-light type="spot" color="#fff" intensity="4" position="-20.052 -10.724 5.416" rotation="-211.64 106 -0.0"
            angle="30"></a-light>
        <a-light type="spot" color="#009" intensity="6" position="0 1.617 -0.64" rotation="-90 30 0" angle="30">
        </a-light>

        <a-light type="spot" color="#FFF" intensity="6" position="0 1.617 -0.64" rotation="-90 30 0" angle="30">
        </a-light>

        <!--     <a-light type="spot" color="white" intensity="5" position="1 0 -1" rotation="-90 30 0" angle="30"></a-light>
                            <a-light type="spot" color="white" intensity="5" position="-1 0 1" rotation="-90 30 0" angle="30"></a-light>
                            <a-light type="spot" color="white" intensity="5" position="1 0 1" rotation="-90 30 0" angle="30"></a-light>
                            <a-light type="spot" color="white" intensity="5" position="-1 0 -1" rotation="-90 30 0" angle="30"></a-light>-->
    </a-entity>



    <!-- POLY table 
 
   0              
-->

    <a-entity id="light-rig" position="0 0 15" visible="true">
        <!-- LIGHT 
           
        -->


        <a-light id="white1" type="spot" color="white" intensity="5" position="0.72 -4.63 -20.67" rotation="90 90 0">
        </a-light>
        <a-light id="white2" type="spot" color="white" intensity="5" position="0.2 8.16 -20.64" rotation="-90 0 0" angle="45">
        </a-light>
        <a-light id="white3" type="spot" color="#ff4d00" intensity="5" position="-18 15 0" rotation="0 0 0" angle="90">
        </a-light>
        <a-light id="white4" type="spot" color="#6b0000" intensity="5" position="-60 -10 45" rotation="60 0 0"angle="90">
        </a-light>
        <a-light id="white5" type="spot" color="#00bfff" intensity="5" position="6  4 -6" rotation="-90 0 0"angle="90">
        </a-light>



        <!--
            <a-light id="blue1" type="directional" color="blue" intensity="1" position="-13 10 1"></a-light>
            <a-light id="blue1" type="directional" color="blue" intensity="1" position="15 32 10"></a-light>





            <a-light id="green1" type="directional" color="green" intensity="1" position="10 36 -36"></a-light>
            <a-light id="green2" type="directional" color="green" intensity="1" position="0 -4.5 10"></a-light>
           
        <a-light type="directional" color="blue" intensity="1" position="0 36 4"></a-light>
        <a-light type="directional" color="blue" intensity="1" position="0 4.5 10"></a-light>
       

        <a-light id="light-left" intensity=".6" position="-10 3 -5" rotation="0 0 0"></a-light>
        <a-light id="light-back" color="white" intensity=".5" position="-10 3 -5" rotation="0 0 0"></a-light>
       
        <a-light id="light-right" type="point" color="white" intensity=".5" position="15 4.5 -6" rotation="0 0 0">
        </a-light>
            <a-light id="white1" type="point" color="white" intensity=".5" position="24 65 24" rotation="34 14 0">
            </a-light>-->



        <!--
            
            <a-light id="L4" type="point" color="#900" intensity="1" position="0 4.5 -4"></a-light>
            <a-light id="red1" type="ambient" color="#900" intensity="1" position="1.5 4 -9"></a-light>
-->





    </a-entity>



    <!-- POLY table 
-->
    <a-entity class="center-zone" id="table-poly" position="0 .2 0" rotation="0 -90 0">

        <a-entity class="table" static-body="shape: box;" scale="1 1 1" id="poly-pedestal" gltf-model="#pedestal"
            shadow="cast: false; receive: false"></a-entity>
        <a-entity rotation="0 270 0" position="-0.192 0.89 0">
            <a-plane height="0.3" width="0.55" position="0 -0.056 0.005"
                material="side: double; color: #333333; transparent: false; opacity: 1; roughness:1;" side="double">

                <a-entity troika-text='value:2020 WebXR Awards; color:#fff; fontSize:.04;align:center;'
                    material="shader: standard; metalness: 0.8;" position="0 0.09 0.01" rotation="0 0.111 0">
                </a-entity>
                <a-entity troika-text='value:The Polys; color:#fff; fontSize:.07;align:center;'
                    material="shader: standard; metalness: 0.8;" position="0 0.01 0.01" rotation="0 -0.1 0">
                </a-entity>
                <a-entity troika-text='value:Hosted by
Julie Smithson and Sophia Moshasha
20 February 2021; color:#fff; fontSize:.025;align:center;' material="shader: standard; metalness: 0.8;"
                    position="0 -0.089 0.01" rotation="0 0 0"></a-entity>
            </a-plane>
        </a-entity>

        <a-entity id="poly-grab" class="clickable center-obj-zone" dynamic-body="shape: box; mass: 2"
            position="0 1.01 0" mixin="obj" rotation="0 180 0" scale="0.25 0.25 0.25" gltf-model="#poly">
            <!--                <a-light type="spot" color="green" intensity="10" position="0 -1 -1.6" rotation="45 180 0" angle="15"></a-light>
                <a-light type="spot" color="blue" intensity="10" position="0 -1 1.6" rotation="45 0 0" angle="15"></a-light>
                <a-light type="spot" color="red" intensity="10" position="-1.6 -1 0" rotation="45 270 0" angle="15"></a-light>
                <a-light type="spot" color="white" intensity="5" position="2 0.17 0" rotation="40 90 0" angle="44"></a-light>-->
        </a-entity>

        <a-entity id="poly-card" rotation="0 0 0" position="3.873 1.5 -0.047" shadow material="color: red">
            <a-entity id="poly-credits">


                <a-text id="poly-title" class="art-text" mixin="table-label" position="-1 0.5 -3" color="white"
                    width="2.5" rotation="0 -90 0" text="value:;wrap-count:50 ">
                    <a-text position="3 7.5 -6" rotation="30 0 0" color="cyan"
                        text="value:February 20, 2021 ;align:center;wrapCount:40" width="10`"></a-text>
                    <a-entity id="the-polys-model" class="center-obj-zone" static-body position="3 11.5 -6"
                        rotation="60 180 180" gltf-model="#the-polys" scale="35 35 35" visible="true">

                    </a-entity>
                    <a-entity id="webxr-awards-model" class="center-obj-zone" static-body position="5.6 8.5 -6"
                        rotation="60 180 180" gltf-model="#webxr-awards" scale="25 25 25" visible="true">
                    </a-entity>


                    <a-text text="value:Julie Smithson; wrapCount:30" width="10" color="white" position="-2.5 6 -6"
                        rotation="30 0 0">
                        <a-text position="0.16 -0.5 0" text="value:Host; wrapCount:60" width="10" color="white">
                        </a-text>
                        <a-image material="side:front" mixin="scale-label"
                            src="/assets/images/talent/Polys-Host-JulieSmithson.jpg" scale="1 1 1" position="-1 -0.3 0"
                            width="2" height="2"></a-image>
                    </a-text>
                    <a-text text="value:Sophia Moshasha; wrapCount:30" width="10" color="white" position="6 6 -6"
                        rotation="30 0 0">
                        <a-text position="0.16 -0.5 0" text="value:Virtual Red Carpet; wrapCount:60" width="10"
                            color="white">
                        </a-text>
                        <a-image material="side:front" mixin="scale-label"
                            src="/assets/images/talent/SophiaMoshasha-PolysRedCarpet.jpg" scale="1 1 1"
                            position="-1 -0.3 0" width="2" height="2"></a-image>
                    </a-text>

                    <a-entity id="credits-card" rotation="0 0 0" position="0 0 0">
                        <a-entity id="credits-card" rotation="0 0 0" position="0 0 0">
                            <a-text position="-4 4 -6" rotation="15 0 0" text="value: Created by Ben Erwin
                    
                    Written and Directed by Ben Erwin
                     
                    Show Producer: Steve Lewis
                    Broadcast Producer: David King
                    Broadcast Engineer: Phil Olshanski
                
                    Producers:
                    Julie Smithson, Sophia Moshasha, Ben Erwin
                
                    Polys Trophy by Linda Ricci
                
                    Music by John Sidorovich
                
                    Publicist Lisi Linares
                    
                    Video Edited by Ben Erwin and Helen Erwin
                    
                    
                    AMBASSADOR: 
                    Alan Smithson
                
                    AWARDS PRESENTERS:
                    WebXR Site of the Year: Ada Rose Cannon @AdaRoseCannon
                    Innovation of the Year: Terry R. Schussler  @Schussler
                    Developer of the Year: Trevor Flowers @TrevorFSmith
                    Framework of the Year: Sikaar Keita@SikaarKe
                    Education Experience of the Year: Kai Frazier@__Kai1
                    Entertainment Experience of the Year: Linda Ricci @Decahedralist
                    Game of the Year: Chris Wilson @ChrisWilso
                    Single User Experience: Aysegul Yonet @AysSomething
                    Multi-User Experience: Liam Broza @LiamBroza
                    
                    HONORS PRESENTERS:
                    Ombudsperson Award to Kent Bye: Kavya Pearlman @KavyaPearlman
                    Lifetime Achievement Award to Mr. Doob: Antony Vitillo  @SkarredGhost
    
                    Thanks to our Generous Donors
                    Jonathan Brandel, Steve Lewis, Cynthia Johnston, Jawad Essadki,
                    Tony Hodgson, Mark Lambert, Joanna Popper, Adeeb Syed, Brendan Bradley,
                    Maria Gonima, Jon Gordon, Keith Thomas, CrimsonZA Replica, David Plant
                    Ozone Universe and LEVR                    

                    @webxrawards
                    webxr.events

                    Presented by Powersimple

                   ; wrapCount:70;baseline:top;" width="8" color="white">
                            </a-text>






                            <a-text position="4 4 -6" rotation="15 0 0" text="value:
                
                RED CARPET INTERVIEWS:
                Daniel Dyboski Bryant  @danieldbryant, Kent Bye @kentbye, 
                Ricardo Cabello, Keith Chan @chekeichan, Trevor Flowers @TrevorFSmith,
                Evo Heyning @EvoHeyning, Arome Ibrihim @aromeibrahim_, Jason Johnston @lojiic,
                Brandon Jones  @tojiro, Christina Kinne @XaosPrinces and Caitlyn Meeks @CaitlynXx, 
                Diego Marcos  @dmarcos, Jason Marsh @jmarshworks and Michael DeBenigno, @thisismichaeld 
                and Erica Stanley @ericastanley 
                               
                THE META-MULTIVERSE
                AltSpace World Builders: Cause and Christi
                Austin Caine @cause_vr and Christi Fenison @christifenison
                
                AltSpace Watch Party Hosted by Educators in VR
                Daniel Dyboski-Bryant @DanielBryant, Lorelle Van Fossen @Lorelle
                Donna McTaggart @donnamct with Terra Celeste-Cronshey, Lida Liberopoulou
                Athena Demos @athenademos & Doug Jacobson @DougJ1100 BRCvr And Rick Tuazon Drew Johnson
                
                Hubs Watch Party World Build and hosted by Matt B. Cool @MattBCool.
                
                Tivoli Cloud
                Caitlyn Meeks, Maki Deprez, Christina 'Xaos Princess' Kinne, Thomas Pasieka
                
                Engage Watch Parties Produced by Steve Lewis
                
                Olympus Campus World by George Kenyon
                Dave School @DAVE_Schoo
                
                BurrCastleXR @BCXR6, 
                Bryan Burr, Dustan Burr, Jared Burr, Dallan Burr, Andrew Burr
                
                WakingDreamXR
                Alex Kohli, Keith Kenyon, Steve Lewis @slewpiter
                
                Film Crew
                Carlos Austin - Austin Photography, @cpaustin2000
                Tony Trudel - Tonycubed Studios    
                Brad Clark - FollowYourBlissMedia
                
                Zoom Hospitality
                Helen Erwin, Shannon Erwin, and David Erwin.
                
                Special Thanks to the W3C Immersive Web Co-Chairs 
                Ada Rose Cannon, @AdaRoseCannon
                Ayşegül Yönet @AysSomething, 
                Chris Wilson @ChrisWilso
                
                Thanks to Terry Schussler, Richard Ward, Karen Alexander and Marcia Carter
                ; wrapCount:75;baseline:top;" width="8" color="white">
                            </a-text>











                        </a-entity>

                        <a-entity class="center-obj-zone" static-body position="-4.5 --1.75 -6" rotation="-15 0 0"
                            gltf-model="#poly" scale="3 3 3 "
                            animation="property: object3D.rotation.y; to: 360; easing: linear; dur: 12000; loop: true;"
                            visible="true">


                        </a-entity>

                </a-text>
            </a-entity>
        </a-entity>

    </a-entity>












    <!-- SINGLE USER EXPERIENCE table -->

    <a-entity class="center-zone" id="table-sue" position="-3 0.2 -0.6" rotation="0 240 0">

        <a-entity class="table" static-body="shape: box;" scale="1 1 1" id="sueoty-pedestal" gltf-model="#pedestal"
            shadow="cast: false; receive: false"></a-entity>
        <a-entity rotation="0 270 0" position="-0.201 0.89 0">
            <a-plane height="0.3" width="0.55" position="0 -0.056 0.005"
                material="side: double; color: #333333; transparent: false; opacity: 1; roughness:1;" side="double">

                <a-entity troika-text='value:Single User Experience of the Year
2020 Winner; color:#fff; fontSize:.035;align:center;' material="shader: standard; metalness: 0.8;"
                    position="0 0.08 0.01" rotation="0 0.111 0"></a-entity>
                <a-entity troika-text='value:Access to Electricity; color:#fff; fontSize:.05;align:center;'
                    material="shader: standard; metalness: 0.8;" position="0 -0.02 0.01" rotation="0 -0.1 0">
                </a-entity>
                <a-entity troika-text='value:World Bank and Flow Immersive; color:#fff; fontSize:.025;align:center;'
                    material="shader: standard; metalness: 0.8;" position="0 -0.089 0.01" rotation="0 0 0">
                </a-entity>
            </a-plane>
        </a-entity>


        <a-entity id="sueoty-grab" class="clickable center-obj-zone" dynamic-body="shape: box; mass: 2"
            position="0 1.01 0" mixin="obj" rotation="0 -180 0" scale="0.25 0.25 0.25" gltf-model="#sueoty"
            intensity="0.2">
        </a-entity>



        <a-entity id="sueoty-card" rotation="0 0 15" position="3.873 3 -0.047">
            <a-text id="sueoty-title" mixin="table-label" class="art-text" position="0 1.45 -3" color="yellow" width="5"
                rotation="0 -90 0" text="value:;align:center; wrapCount:50 ">



                <a-text position="3 0.5 0" color="cyan"
                    text="value:2020 Single User Experience of the Year;align:center"></a-text>
                <a-text position="3 0.2 0" color="cyan" width="2.5" text="value:Winner;align:center">
                </a-text>

                <a-text text="value:Access To Electricity; wrapCount:30" width="5" color="white" position="2 -0.1 0">

                    <a-text position="0.03 -0.25 0" text="value:Flow Immersive / World Bank; wrapCount:60" width="5"
                        color="white">
                    </a-text>
                    <a-image material="side:front" mixin="scale-label"
                        src="/assets/images/nominees/FlowImmersive-WorldBank.jpg" scale="0.25 0.25 0.25"
                        position="-0.3 -0.091 0" width="2" height="2">
                    </a-image>
                </a-text>

                <a-text position="3 -0.65 0" color="cyan" width="2.5" text="value:Nominees;align:center">
                </a-text>



                <a-entity link="href:https://mixedreality.mozilla.org/hello-webxr/" position=" 0 0 0" rotation="0 0 0">

                    <a-text text="value:Hello WebXR; wrapCount:30" width="5" color="white" position="2 -1 0">
                        <a-text position="0.03 -0.25 0" text="value:Mozilla Mixed Reality; wrapCount:60" width="5"
                            color="white">
                        </a-text>
                        <a-image material="side:front" mixin="scale-label"
                            src="/assets/images/nominees/HelloWebXR-1.jpg" scale="0.25 0.25 0.25"
                            position="-0.3 -0.091 0" width="2" height="2"></a-image>
                    </a-text>
                    <a-text text="value:Blue Cyber; wrapCount:30" width="5" color="white" position="2 -1.6 0">
                        <a-text position="0.03 -0.25 0" text="value:Travis Rogers; wrapCount:60" width="5"
                            color="white">
                        </a-text>
                        <a-image material="side:front" mixin="scale-label" src="/assets/images/nominees/BlueCyber.jpg"
                            scale="0.25 0.25 0.25" position="-0.3 -0.091 0" width="2" height="2"></a-image>
                    </a-text>

                    <a-text text="value:XR Garden; wrapCount:30" width="5" color="white" position="2 -2.2 0">
                        <a-text position="0.03 -0.25 0" text="value:Ada Rose Cannon; wrapCount:60" width="5"
                            color="white">
                        </a-text>
                        <a-image material="side:front" mixin="scale-label" src="/assets/images/nominees/XRGarden.jpg"
                            scale="0.25 0.25 0.25" position="-0.3 -0.091 0" width="2" height="2">
                        </a-image>
                    </a-text>
                    <a-text text="value:Dust Devil; wrapCount:30" width="5" color="white" position="2 -2.8 0">
                        <a-text position="0.03 -0.25 0" text="value:TyroVR; wrapCount:60" width="5" color="white">
                        </a-text>
                        <a-image material="side:front" mixin="scale-label" src="/assets/images/nominees/DustDevil.jpg"
                            scale="0.25 0.25 0.25" position="-0.3 -0.091 0" width="2" height="2">
                        </a-image>
                    </a-text>

            </a-text>


        </a-entity>
        </a-text>


        </a-text>
    </a-entity>




    <!-- MULTI-USER EXPERIENCE table-->

    <a-entity class="center-zone" id="table-mue" position="-4.89 .2 -2.9" rotation="0 210 0">

        <a-entity class="table" static-body="shape: box;" scale="1 1 1" id="mue-pedestal" gltf-model="#pedestal"
            shadow="cast: false; receive: false"></a-entity>
        <a-entity rotation="0 270 0" position="-0.201 0.89 0">
            <a-plane height="0.3" width="0.55" position="0 -0.056 0.005"
                material="side: double; color: #333333; transparent: false; opacity: 1; roughness:1;" side="double">

                <a-entity troika-text='value:Multi-User Experience of the Year
2020 Winner; color:#fff; fontSize:.035;align:center;' material="shader: standard; metalness: 0.8;"
                    position="0 0.08 0.01" rotation="0 0.111 0"></a-entity>
                <a-entity troika-text='value:Mozilla Hubs; color:#fff; fontSize:.05;align:center;'
                    material="shader: standard; metalness: 0.8;" position="0 -0.02 0.01" rotation="0 -0.1 0">
                </a-entity>
                <a-entity troika-text='value:Mozilla Mixed Reality; color:#fff; fontSize:.025;align:center;'
                    material="shader: standard; metalness: 0.8;" position="0 -0.089 0.01" rotation="0 0 0">
                </a-entity>
            </a-plane>
        </a-entity>

        <a-entity id="mue-grab" class="clickable center-obj-zone" dynamic-body="shape: box; mass: 2" position="0 1.01 0"
            mixin="obj" rotation="0 -180 0" scale="0.25 0.25 0.25" gltf-model="#mueoty" intensity="0.2"></a-entity>




        <a-entity id="mue-card" rotation="0 0 15" position="3.873 3 -0.047">
            <a-text id="mue-title" mixin="table-label" class="art-text" position="0 1.45 -3" color="yellow" width="5"
                rotation="0 -90 0" text="value:;align:center; wrapCount:50 ">



                <a-text position="3 0.5 0" color="cyan"
                    text="value:2020 Multi-User Experience of the Year;align:center">
                </a-text>
                <a-text position="3 0.2 0" color="cyan" width="2.5" text="value:Winner;align:center">
                </a-text>
                <a-entity position="0 0 0" rotation="0 0 0">
                    <a-text text="value:Hubs; wrapCount:30" width="5" color="white" position="2 -0.01 0">
                        <a-text position="0.03 -0.25 0" text="value:Mozilla Mixed Reality; wrapCount:60" width="5"
                            color="white">
                        </a-text>
                        <a-image material="side:front" mixin="scale-label" src="/assets/images/nominees/hubs.jpg"
                            scale="0.25 0.25 0.25" position="-0.3 -0.091 0" width="2" height="2"></a-image>
                    </a-text>


                    <a-text position="3 -0.65 0" color="cyan" width="2.5" text="value:Nominees;align:center">
                    </a-text>

                    <a-text text="value:Frame; wrapCount:30" width="5" color="white" position="2 -1 0">
                        <a-text position="0.03 -0.25 0" text="value:Virbela; wrapCount:60" width="5" color="white">
                        </a-text>
                        <a-image material="side:front" mixin="scale-label"
                            src="/assets/images/nominees/frame-logo-01.svg" scale="0.25 0.25 0.25"
                            position="-0.3 -0.091 0" width="2" height="2"></a-image>
                    </a-text>

                    <a-text text="value:Flow; wrapCount:30" width="5" color="white" position="2 -1.6 0">
                        <a-text position="0.03 -0.25 0" text="value:Flow Immersive; wrapCount:60" width="5"
                            color="white">
                        </a-text>
                        <a-image material="side:front" mixin="scale-label"
                            src="/assets/images/nominees/FlowImmersive-Logo.png" scale="0.25 0.25 0.25"
                            position="-0.3 -0.091 0" width="2" height="2"></a-image>
                    </a-text>

                    <a-text text="value:VRLand; wrapCount:30" width="5" color="white" position="2 -2.2 0">
                        <a-text position="0.03 -0.25 0" text="value:VRLand; wrapCount:60" width="5" color="white">
                        </a-text>
                        <a-image material="side:front" mixin="scale-label" src="/assets/images/nominees/VRLand.jpg"
                            scale="0.25 0.25 0.25" position="-0.3 -0.091 0" width="2" height="2"></a-image>
                    </a-text>


            </a-text>


        </a-entity>
        </a-text>


        </a-text>
    </a-entity>

    <!-- Developer of the year  -->
    <a-entity class="center-zone" id="table-doty" position="-5.75 0.2 -5.727" rotation="0 180 0">

        <a-entity class="table" static-body="shape: box;" scale="1 1 1" id="doty-pedestal" gltf-model="#pedestal"
            shadow="cast: false; receive: false"></a-entity>
        <a-entity rotation="0 270 0" position="-0.201 0.89 0">
            <a-plane height="0.3" width="0.55" position="0 -0.056 0.005"
                material="side: double; color: #333333; transparent: false; opacity: 1; roughness:1;" side="double">

                <a-entity troika-text='value:Developer of the Year
2020 Winner; color:#fff; fontSize:.035;align:center;' material="shader: standard; metalness: 0.8;"
                    position="0 0.08 0.01" rotation="0 0.111 0"></a-entity>
                <a-entity troika-text='value:Gabriel Baker; color:#fff; fontSize:.05;align:center;'
                    material="shader: standard; metalness: 0.8;" position="0 -0.02 0.01" rotation="0 -0.1 0">
                </a-entity>
                <a-entity troika-text='value:Frame by Virbela; color:#fff; fontSize:.025;align:center;'
                    material="shader: standard; metalness: 0.8;" position="0 -0.089 0.01" rotation="0 0 0">
                </a-entity>
            </a-plane>
        </a-entity>

        <a-entity id="doty-grab" class="clickable center-obj-zone" dynamic-body="shape: box; mass: 2"
            position="0 1.01 0" mixin="obj" rotation="0 -180 0" scale="0.25 0.25 0.25" gltf-model="#doty"
            intensity="0.2">
        </a-entity>



        <a-entity id="doty-card" rotation="0 0 15" position="3.873 3 -0.047">
            <a-text id="doty-title" mixin="table-label" class="art-text" position="0 1.45 -3" color="yellow" width="5"
                rotation="0 -90 0" text="value:;align:center; wrapCount:5">
                <a-text position="3 0.5 0" color="cyan" text="value:2020 WebXR Developer of the Year;align:center">
                </a-text>
                <a-text position="3 0.2 0" color="cyan" width="2.5" text="value:Winner;align:center">
                </a-text>
                <a-text text="value:Gabriel Baker; wrapCount:30" width="5" color="white" position="2 -0.1 0">
                    <a-text position="0.03 -0.25 0" text="value:Virbela; wrapCount:60" width="5" color="white">
                    </a-text>
                    <a-image material="side:front" mixin="scale-label" src="/assets/images/nominees/GabrielBaker.jpg"
                        scale="0.25 0.25 0.25" position="-0.3 -0.091 0" width="2" height="2"></a-image>
                </a-text>
                <a-text position="3 -0.65 0" color="cyan" width="2.5" text="value:Nominees;align:center">
                </a-text>


                <a-entity position="0 0 0" rotation="0 0 0">
                    <a-text text="value:Jason Johnston ; wrapCount:30" width="5" color="white" position="2 -1 0">
                        <a-text position="0.03 -0.25 0" text="value:Verizon; wrapCount:60" width="5" color="white">
                        </a-text>
                        <a-image material="side:front" mixin="scale-label"
                            src="/assets/images/nominees/JasonJohnston.jpg" scale="0.25 0.25 0.25"
                            position="-0.3 -0.091 0" width="2" height="2"></a-image>
                    </a-text>

                    <a-text text="value:Fernando Serrano; wrapCount:30" width="5" color="white" position="2 -1.6 0">
                        <a-text position="0.03 -0.25 0" text="value:Apple; wrapCount:60" width="5" color="white">
                        </a-text>
                        <a-image material="side:front" mixin="scale-label"
                            src="/assets/images/nominees/FernandoSerrano.jpg" scale="0.25 0.25 0.25"
                            position="-0.3 -0.091 0" width="2" height="2"></a-image>
                    </a-text>






                    <a-text text="value:Jason Marsh; wrapCount:30" width="5" color="white" position="2 -2.2 0">
                        <a-text position="0.03 -0.25 0" text="value:Flow Immersive; wrapCount:60" width="5"
                            color="white">
                        </a-text>
                        <a-image material="side:front" mixin="scale-label" src="/assets/images/nominees/JasonMarsh.jpg"
                            scale="0.25 0.25 0.25" position="-0.3 -0.091 0" width="2" height="2"></a-image>
                    </a-text>

                    <a-text text="value:Diego F. Goberna; wrapCount:30" width="5" color="white" position="2 -2.8 0">
                        <a-text position="0.03 -0.25 0" text="value:Embark Studios; wrapCount:60" width="5"
                            color="white">
                        </a-text>
                        <a-image material="side:front" mixin="scale-label"
                            src="/assets/images/nominees/DiegoGoberna.jpg" scale="0.25 0.25 0.25"
                            position="-0.3 -0.091 0" width="2" height="2"></a-image>
                    </a-text>

                    <a-text text="value:Marlon Lueckert; wrapCount:30" width="5" color="white" position="2 -3.4 0">
                        <a-text position="0.03 -0.25 0" text="value:Virbela; wrapCount:60" width="5" color="white">
                        </a-text>
                        <a-image material="side:front" mixin="scale-label"
                            src="/assets/images/nominees/MarlonLukert.jpg" scale="0.25 0.25 0.25"
                            position="-0.3 -0.091 0" width="2" height="2"></a-image>
                    </a-text>

            </a-text>




        </a-entity>






    </a-entity>
    <!-- WebXR Site of the Year. table -->

    <a-entity class="center-zone" id="table-soty" position="-5 0.2 -8.75" rotation="0 150 0">

        <a-entity class="table" static-body="shape: box;" scale="1 1 1" id="soty-pedestal" gltf-model="#pedestal"
            shadow="cast: false; receive: false"></a-entity>
        <a-entity rotation="0 270 0" position="-0.201 0.89 0">

            <a-plane height="0.3" width="0.55" position="0 -0.056 0.005"
                material="side: double; color: #333333; transparent: false; opacity: 1; roughness:1;" side="double">

                <a-entity troika-text='value:WebXR Site of the Year
        2020 Winner; color:#fff; fontSize:.04;align:center;' material="shader: standard; metalness: 0.8;"
                    position="0 0.08 0.01" rotation="0 0.111 0"></a-entity>
                <a-entity troika-text='value:"Hello WebXR!"; color:#fff; fontSize:.05;align:center;'
                    material="shader: standard; metalness: 0.8;" position="0 -0.02 0.01" rotation="0 -0.1 0">
                </a-entity>
                <a-entity troika-text='value:Fernando Serrano & Diego F. Goberna
        Mozilla Mixed Reality; color:#fff; fontSize:.025;align:center;' material="shader: standard; metalness: 0.8;"
                    position="0 -0.089 0.01" rotation="0 0 0"></a-entity>
            </a-plane>


        </a-entity>

        <a-entity id="soty-grab" class="clickable center-obj-zone grabbable" dynamic-body="shape: box; mass: 2"
            position="0 1.01 0" mixin="obj" rotation="0 -180 0" scale="0.25 0.25 0.25" gltf-model="#soty"
            intensity="0.2">
        </a-entity>



        <a-entity id="soty-card" rotation="0 0 15" position="3.873 3 -0.047">
            <a-text id="soty-title" mixin="table-label" class="art-text" position="0 1.45 -3" color="yellow" width="5"
                rotation="0 -90 0" text="value:;align:center; wrapCount:50 ">



                <a-text position="3 0.5 0" color="cyan" text="value:2020 WebXR Site of the Year;align:center">
                </a-text>
                <a-text position="3 0.2 0" color="cyan" width="2.5" text="value:Winner;align:center">
                </a-text>
                <a-entity link="href:https://mixedreality.mozilla.org/hello-webxr/" position=" 0 0 0" rotation="0 0 0">

                    <a-text text="value:Hello WebXR; wrapCount:30" width="5" color="white" position="2 -0.1 0">
                        <a-text position="0.03 -0.25 0" text="value:Mozilla Mixed Reality; wrapCount:60" width="5"
                            color="white">
                        </a-text>
                        <a-image material="side:front" mixin="scale-label"
                            src="/assets/images/nominees/HelloWebXR-1.jpg" scale="0.25 0.25 0.25"
                            position="-0.3 -0.091 0" width="2" height="2"></a-image>
                    </a-text>
                    <a-text position="3 -0.65 0" color="cyan" width="2.5" text="value:Nominees;align:center">
                    </a-text>

                    <a-text text="value:AnVRopomotron; wrapCount:30" width="5" color="white" position="2 -1 0">
                        <a-text position="0.03 -0.25 0" text="value:Dr. Keith Chan; wrapCount:60" width="5"
                            color="white">
                        </a-text>
                        <a-image material="side:front" mixin="scale-label"
                            src="/assets/images/nominees/Anvropomotron.jpg" scale="0.25 0.25 0.25"
                            position="-0.3 -0.091 0" width="2" height="2">
                        </a-image>
                    </a-text>

                    <a-text text="value:Blue Cyber; wrapCount:30" width="5" color="white" position="2 -1.6 0">
                        <a-text position="0.03 -0.25 0" text="value:Travis Rogers; wrapCount:60" width="5"
                            color="white">
                        </a-text>
                        <a-image material="side:front" mixin="scale-label" src="/assets/images/nominees/BlueCyber.jpg"
                            scale="0.25 0.25 0.25" position="-0.3 -0.091 0" width="2" height="2">
                        </a-image>
                    </a-text>
                    <a-text text="value:What You Don't Know; wrapCount:30" width="5" color="white" position="2 -2.2 0">
                        <a-text position="0.03 -0.25 0"
                            text="value:Jono & Mr. Doob, Music by Matthew Dear; wrapCount:60" width="5" color="white">
                        </a-text>
                        <a-image material="side:front" mixin="scale-label"
                            src="/assets/images/nominees/WhatYouDontKnow.jpg" scale="0.25 0.25 0.25"
                            position="-0.3 -0.091 0" width="2" height="2"></a-image>
                    </a-text>

                    <a-text text="value:2020 US Election; wrapCount:30" width="5" color="white" position="2 -2.8 0">
                        <a-text position="0.03 -0.25 0" text="value:Flow Immersive; wrapCount:60" width="5"
                            color="white">
                        </a-text>
                        <a-image material="side:front" mixin="scale-label"
                            src="/assets/images/nominees/2020USElection.jpg" scale="0.25 0.25 0.25"
                            position="-0.3 -0.091 0" width="2" height="2"></a-image>
                    </a-text>


            </a-text>


        </a-entity>
        </a-text>


        </a-text>
    </a-entity>


    <!-- Ombudsman Award table -->

    <a-entity class="center-zone" id="table-oa" position="-2.92 .2 -10.7" rotation="0 120 0">

        <a-entity class="table" static-body="shape: box;" scale="1 1 1" id="oa-pedestal" gltf-model="#pedestal"
            shadow="cast: false; receive: false"></a-entity>
        <a-entity rotation="0 270 0" position="-0.201 0.89 0">
            <a-plane height="0.3" width="0.55" position="0 -0.056 0.005"
                material="side: double; color: #333333; transparent: false; opacity: 1; roughness:1;" side="double">

                <a-entity troika-text='value:Ombudsperson Award
2020 Honoree; color:#fff; fontSize:.035;align:center;' material="shader: standard; metalness: 0.8;"
                    position="0 0.08 0.01" rotation="0 0.111 0"></a-entity>
                <a-entity troika-text='value:Kent Bye; color:#fff; fontSize:.05;align:center;'
                    material="shader: standard; metalness: 0.8;" position="0 -0.02 0.01" rotation="0 -0.1 0">
                </a-entity>
                <a-entity troika-text='value:Host of Voices of VR Podcast
Author: XR Ethics Manifesto; color:#fff; fontSize:.025;align:center;' material="shader: standard; metalness: 0.8;"
                    position="0 -0.089 0.01" rotation="0 0 0"></a-entity>
            </a-plane>
        </a-entity>

        <a-entity id="oa-grab" class="clickable center-obj-zone" dynamic-body="shape: box; mass: 2" position="0 1.01 0"
            mixin="obj" rotation="0 -180 0" scale="0.25 0.25 0.25" gltf-model="#ombudsperson" intensity="0.2">
        </a-entity>
        <a-entity id="oa-card" rotation="0 0 15" position="3.873 3 -0.047">
            <a-text id="oa-title" mixin="table-label" class="art-text" position="0 0.293 0.23" color="yellow" width="5"
                rotation="0 -90 0" text="value:;align:center; wrapCount:50 ">



                <a-text position="-0.189 1.226 0" color="cyan"
                    text="value:Ombudsperson Award;wrapCount:40;align:center">
                </a-text>
                <a-text position="-0.164 0.97 0" color="cyan" width="3"
                    text="value:2020 Honoree: Kent Bye  - @kentbye;align:center">
                </a-text>
                <a-entity position="0 0 0" rotation="0 0 0">

                    <a-text position="0.45 -0.34 0"
                        text="value: Kent Bye's journalism helps keep XR honest. 
                    As host of the Voices in VR Podcast, Kent has been interviewing the top minds in the industry for approaching one thousand episodes. Keeping in mind the big picture, his subtantive and well-researched insights drill into the moral and ethical questions making him defacto ombudsman and conscience for the conversations we need to having about XR tech.
                    The WebXR Awards salutes and thanks Kent Bye for his exemplary and critcally important work. ;wrapCount:30" width="2.5"
                        color="white">

                        <a-image material="side:front" mixin="scale-label" src="/assets/images/nominees/Kent-Bye.jpg"
                            scale="1 1 1" position="-2.182 0 0" width="2" height="2"></a-image>
                    </a-text>

            </a-text>


        </a-entity>

    </a-entity>











    <!-- LIFETIME ACHEIVEMENT table -->

    <a-entity class="center-zone" id="table-ltaa" position="0 .2 -11.5" rotation="0 90 0">

        <a-entity class="table" static-body="shape: box;" scale="1 1 1" id="ltaa-pedestal" gltf-model="#pedestal"
            shadow="cast: false; receive: false"></a-entity>
        <a-entity rotation="0 270 0" position="-0.201 0.89 0">
            <a-plane height="0.3" width="0.55" position="0 -0.056 0.005"
                material="side: double; color: #333333; transparent: false; opacity: 1; roughness:1;" side="double">

                <a-entity troika-text='value:Lifetime Achievement Award
2020 Honoree; color:#fff; fontSize:.035;align:center;' material="shader: standard; metalness: 0.8;"
                    position="0 0.08 0.01" rotation="0 0.111 0"></a-entity>
                <a-entity troika-text='value:Ricardo Cabello; color:#fff; fontSize:.05;align:center;'
                    material="shader: standard; metalness: 0.8;" position="0 -0.02 0.01" rotation="0 -0.1 0">
                </a-entity>
                <a-entity troika-text='value:Mr. Doob - Creator of ThreeJS; color:#fff; fontSize:.025;align:center;'
                    material="shader: standard; metalness: 0.8;" position="0 -0.089 0.01" rotation="0 0 0">
                </a-entity>
            </a-plane>
        </a-entity>


        <a-entity id="ltaa-grab" class="clickable center-obj-zone" dynamic-body="shape: box; mass: 2"
            position="0 1.01 0" mixin="obj" rotation="0 -180 0" scale="0.25 0.25 0.25" gltf-model="#lifetime"
            intensity="0.2">
        </a-entity>
        <a-entity id="ltaa-card" rotation="0 0 15" position="3.873 3 -0.047">
            <a-text id="ltaa-title" mixin="table-label" class="art-text" position="0 0.293 0.23" color="yellow"
                width="5" rotation="0 -90 0" text="value:;align:center; wrapCount:50 ">



                <a-text position="-0.189 1.226 0" color="cyan"
                    text="value:Lifetime Achievement Award;wrapCount:40;align:center">
                </a-text>
                <a-text position="-0.164 0.97 0" color="cyan" width="3"
                    text="value:2020 Honoree: Ricardo Cabello - @mrdoob;align:center">
                </a-text>
                <a-entity position="0 0 0" rotation="0 0 0">

                    <a-text position="0.45 -0.34 0"
                        text="value: Ricardo Cabello, known by the handle 'Mr. Doob' is the creator of ThreeJS. Since 2010 he has maintained one of the most influential open source repos in history, which is foundational to WebXR.  ThreeJS has over 120 releases, over 35,000 commits and has been forked over 25,000 times. It abstracts WebGL to JavaScript democratizing 3D graphics for Web Programmers.
                   The WebXR honors Ricardo's work with its first Lifetime Achievement Award. Thank you Ricardo.;wrapCount:30" width="2.5"
                        color="white">

                        <a-image material="side:front" mixin="scale-label"
                            src="/assets/images/nominees/ricardo-cabello.jpg" scale="1 1 1" position="-2.182 0 0"
                            width="2" height="2"></a-image>
                    </a-text>

            </a-text>


        </a-entity>

    </a-entity>










    <!-- Framework of the year -->

    <a-entity class="center-zone" id="table-foty" position="3 0.2 -10.63" rotation="0 60 0">

        <a-entity class="table" static-body="shape: box;" scale="1 1 1" id="foty-pedestal" gltf-model="#pedestal"
            shadow="cast: false; receive: false"></a-entity>
        <a-entity rotation="0 270 0" position="-0.201 0.89 0">
            <a-plane height="0.3" width="0.55" position="0.004 -0.056 0.005"
                material="side: double; color: #333333; transparent: false; opacity: 1; roughness:1;" side="double">

                <a-entity troika-text='value:Framework of the Year
2020 Winner; color:#fff; fontSize:.04;align:center;' material="shader: standard; metalness: 0.8;"
                    position="0 0.08 0.01" rotation="0 0.111 0"></a-entity>
                <a-entity troika-text='value:Troika; color:#fff; fontSize:.05;align:center;'
                    material="shader: standard; metalness: 0.8;" position="0 -0.02 0.01" rotation="0 -0.1 0">
                </a-entity>
                <a-entity troika-text='value:Jason Johnston; color:#fff; fontSize:.025;align:center;'
                    material="shader: standard; metalness: 0.8;" position="0 -0.089 0.01" rotation="0 0 0">
                </a-entity>
            </a-plane>
        </a-entity>

        <a-entity id="foty-grab" class="clickable center-obj-zone" dynamic-body="shape: box; mass: 2"
            position="0 1.01 0" mixin="obj" rotation="0 -180 0" scale="0.25 0.25 0.25" gltf-model="#foty"
            intensity="0.2">
        </a-entity>



        <a-entity id="foty-card" rotation="0 0 15" position="3.873 3 -0.047">
            <a-text id="foty-title" mixin="table-label" class="art-text" position="0 1.45 -3" color="yellow" width="5"
                rotation="0 -90 0" text="value:;align:center; wrapCount:5">
                <a-text position="3 0.5 0" color="cyan" text="value:2020 Framework of the Year;align:center">
                </a-text>
                <a-text position="3 0.2 0" color="cyan" width="2.5" text="value:Winner;align:center">
                </a-text>
                <a-text text="value:Troika; wrapCount:30" width="5" color="white" position="2 -0.1 0">
                    <a-text position="0.03 -0.25 0" text="value:Protectwise, Jason Johnston; wrapCount:60" width="5"
                        color="white">
                    </a-text>
                    <a-image material="side:front" mixin="scale-label" src="/assets/images/nominees/Troika.jpg"
                        scale="0.25 0.25 0.25" position="-0.3 -0.091 0" width="2" height="2"></a-image>
                </a-text>
                <a-text position="3 -0.65 0" color="cyan" width="2.5" text="value:Nominees;align:center">
                </a-text>
                <a-entity position="0 0 0" rotation="0 0 0">

                    <a-text text="value:AFrame; wrapCount:30" width="5" color="white" position="2 -1 0">
                        <a-text position="0.03 -0.25 0"
                            text="value:Diego Marcos, Kevin Ngo, Don McCurdy, 300+ Contributors; wrapCount:60" width="5"
                            color="white">
                        </a-text>
                        <a-image material="side:front" mixin="scale-label" src="/assets/images/nominees/A-Frame-01.svg"
                            scale="0.25 0.25 0.25" position="-0.3 -0.091 0" width="2" height="2"></a-image>
                    </a-text>




                    <a-text text="value:BabylonJS; wrapCount:30" width="5" color="white" position="2 -1.6 0">
                        <a-text position="0.03 -0.25 0" text="value:David Catuhe, 300+ contributors; wrapCount:60"
                            width="5" color="white">
                        </a-text>
                        <a-image material="side:front" mixin="scale-label"
                            src="/assets/images/nominees/BabylonJS-01.svg" scale="0.25 0.25 0.25"
                            position="-0.3 -0.091 0" width="2" height="2"></a-image>
                    </a-text>

                    <a-text text="value:Multi App Integration Toolbox; wrapCount:30" width="5" color="white"
                        position="2 -2.2 0">
                        <a-text position="0.03 -0.25 0" text="value:Pluto; wrapCount:60" width="5" color="white">
                        </a-text>
                        <a-image material="side:front" mixin="scale-label" src="/assets/images/nominees/pluto.jpg"
                            scale="0.25 0.25 0.25" position="-0.3 -0.091 0" width="2" height="2"></a-image>
                    </a-text>


            </a-text>

            </a-text>




        </a-entity>






    </a-entity>



    <!-- GAME table -->

    <a-entity class="center-zone" id="table-goty" position="5 0.2 -8.5" rotation="0 30 0">

        <a-entity class="table" static-body="shape: box;" scale="1 1 1" id="goty-pedestal" gltf-model="#pedestal"
            shadow="cast: false; receive: false"></a-entity>
        <a-entity rotation="0 270 0" position="-0.201 0.89 0">
            <a-plane height="0.3" width="0.55" position="0 -0.056 0.005"
                material="side: double; color: #333333; transparent: false; opacity: 1; roughness:1;" side="double">

                <a-entity troika-text='value:Game of the Year
2020 Winner; color:#fff; fontSize:.035;align:center;' material="shader: standard; metalness: 0.8;"
                    position="0 0.08 0.01" rotation="0 0.111 0"></a-entity>

                <a-entity troika-text='value:TowerMax Fitness: Reaction; color:#fff; fontSize:.04;align:center;'
                    material="shader: standard; metalness: 0.8;" position="0 -0.02 0.01" rotation="0 -0.1 0">
                </a-entity>
                <a-entity troika-text='value:Sven Meyenberg
SROMLINE; color:#fff; fontSize:.025;align:center;' material="shader: standard; metalness: 0.8;"
                    position="0 -0.089 0.01" rotation="0 0 0"></a-entity>
            </a-plane>
        </a-entity>

        <a-entity id="goty-grab" class="clickable center-obj-zone" dynamic-body="shape: box; mass: 2"
            position="0 1.01 0" mixin="obj" rotation="0 -180 0" scale="0.25 0.25 0.25" gltf-model="#goty"
            intensity="0.2">
        </a-entity>



        <a-entity id="goty-card" rotation="0 0 15" position="3.873 3 -0.047">
            <a-text id="goty-title" mixin="table-label" class="art-text" position="0 1.45 -3" color="yellow" width="5"
                rotation="0 -90 0" text="value:;align:center; wrapCount:50 ">



                <a-text position="3 0.5 0" color="cyan" text="value:2020 Game of the Year;align:center">
                </a-text>
                <a-text position="3 0.2 0" color="cyan" width="2.5" text="value:Winner;align:center">
                </a-text>



                <a-text text="value:TowerMax Fitness: Reaction; wrapCount:30" width="5" color="white"
                    position="2 -0.1 0">
                    <a-text position="0.03 -0.25 0" text="value:Sven Meyenberg - SROMLINE; wrapCount:60" width="5"
                        color="white">
                    </a-text>
                    <a-image material="side:front" mixin="scale-label" src="/assets/images/nominees/TowerMaxFitness.jpg"
                        scale="0.25 0.25 0.25" position="-0.3 -0.091 0" width="2" height="2"></a-image>
                </a-text>
                <a-text position="3 -0.65 0" color="cyan" width="2.5" text="value:Nominees;align:center">
                </a-text>

                <a-entity position="0 0 0" rotation="0 0 0">


                    <a-text text="value:Moonrider; wrapCount:30" width="5" color="white" position="2 -1 0">
                        <a-text position="0.03 -0.25 0" text="value:Supermedium; wrapCount:60" width="5" color="white">
                        </a-text>
                        <a-image material="side:front" mixin="scale-label" src="/assets/images/nominees/Moonrider.jpg"
                            scale="0.25 0.25 0.25" position="-0.3 -0.091 0" width="2" height="2"></a-image>
                    </a-text>

                    <a-text text="value:Back To Space; wrapCount:30" width="5" color="white" position="2 -1.6 0">
                        <a-text position="0.03 -0.25 0" text="value:Timmy Kokke; wrapCount:60" width="5" color="white">
                        </a-text>
                        <a-image material="side:front" mixin="scale-label" src="/assets/images/nominees/BackToSpace.jpg"
                            scale="0.25 0.25 0.25" position="-0.3 -0.091 0" width="2" height="2"></a-image>
                    </a-text>
                    <a-text text="value:Rovr Run; wrapCount:30" width="5" color="white" position="2 -2.2 0">
                        <a-text position="0.03 -0.25 0" text="value:8th Wall; wrapCount:60" width="5" color="white">
                        </a-text>
                        <a-image material="side:front" mixin="scale-label" src="/assets/images/nominees/RovrRun.jpg"
                            scale="0.25 0.25 0.25" position="-0.3 -0.091 0" width="2" height="2"></a-image>
                    </a-text>



            </a-text>


        </a-entity>

    </a-entity>






    <!-- Innovation of the year  -->
    <a-entity class="center-zone" id="table-ioty" position="5.75 .2 -5.655" rotation="0 0 0">

        <a-entity class="table" static-body="shape: box;" scale="1 1 1" id="ioty-pedestal" gltf-model="#pedestal"
            shadow="cast: false; receive: false"></a-entity>
        <a-entity rotation="0 270 0" position="-0.201 0.89 0">
            <a-plane height="0.3" width="0.55" position="0 -0.056 0.005"
                material="side: double; color: #333333; transparent: false; opacity: 1; roughness:1;" side="double">

                <a-entity troika-text='value:Innovation of the Year
2020 Winner; color:#fff; fontSize:.035;align:center;' material="shader: standard; metalness: 0.8;"
                    position="0 0.08 0.01" rotation="0 0.111 0"></a-entity>
                <a-entity troika-text='value:ECSY; color:#fff; fontSize:.05;align:center;'
                    material="shader: standard; metalness: 0.8;" position="0 -0.02 0.01" rotation="0 -0.1 0">
                </a-entity>
                <a-entity troika-text='value:Fernando Serrano; color:#fff; fontSize:.025;align:center;'
                    material="shader: standard; metalness: 0.8;" position="0 -0.089 0.01" rotation="0 0 0">
                </a-entity>
            </a-plane>
        </a-entity>

        <a-entity id="ioty-grab" class="clickable center-obj-zone" dynamic-body="shape: box; mass: 2"
            position="0 1.01 0" mixin="obj" rotation="0 -180 0" scale="0.25 0.25 0.25" gltf-model="#ioty"
            intensity="0.2">
        </a-entity>



        <a-entity id="ioty-card" rotation="0 0 15" position="3.873 3 -0.047">
            <a-text id="ioty-title" mixin="table-label" class="art-text" position="0 1.45 -3" color="yellow" width="5"
                rotation="0 -90 0" text="value:;align:center; wrapCount:5">
                <a-text position="3 0.5 0" color="cyan" text="value:2020 Innovation of the Year;align:center">
                </a-text>
                <a-text position="3 0.2 0" color="cyan" width="2.5" text="value:Winner;align:center">
                </a-text>
                <a-text text="value:ECSY - Entity Component System; wrapCount:30" width="5" color="white"
                    position="2 -0.1 0">
                    <a-text position="0.03 -0.25 0" text="value:Fernando Serrano; wrapCount:60" width="5" color="white">
                    </a-text>
                    <a-image material="side:front" mixin="scale-label" src="/assets/images/nominees/ECSY.jpg"
                        scale="0.25 0.25 0.25" position="-0.3 -0.091 0" width="2" height="2"></a-image>
                </a-text>

                <a-text position="3 -0.65 0" color="cyan" width="2.5" text="value:Nominees;align:center">
                </a-text>
                <a-entity position="0 0 0" rotation="0 0 0">







                    <a-text text="value:WebXR Hand Tracking; wrapCount:30" width="5" color="white" position="2 -1 0">
                        <a-entity position="0.03 -0.25 0"
                            text="value:shader: msdf; font:https://cdn.aframe.io/fonts/mozillavr.fnt; wrapCount:60"
                            width="5" color="white">
                        </a-entity>
                        <a-text position="0.03 -0.25 0" text="value:Marlon Luckert, Virbela; wrapCount:60" width="5"
                            color="white">
                        </a-text>
                        <a-image material="side:front" mixin="scale-label"
                            src="/assets/images/nominees/HandTracking.jpg" scale="0.25 0.25 0.25"
                            position="-0.3 -0.091 0" width="2" height="2"></a-image>
                    </a-text>

                    <a-text text="value:Basis Universal Compression; wrapCount:30" width="5" color="white"
                        position="2 -1.6 0">
                        <a-text position="0.03 -0.25 0" text="value:Binomial, LLC; wrapCount:60" width="5"
                            color="white">
                        </a-text>
                        <a-image material="side:front" mixin="scale-label" src="/assets/images/nominees/Binomial.jpg"
                            scale="0.25 0.25 0.25" position="-0.3 -0.091 0" width="2" height="2"></a-image>
                    </a-text>

                    <a-text text="value:WebGPU; wrapCount:30" width="5" color="white" position="2 -2.2 0">
                        <a-text position="0.03 -0.25 0" text="value:W3C; wrapCount:60" width="5" color="white">
                        </a-text>
                        <a-image material="side:front" mixin="scale-label" src="/assets/images/nominees/WebGPU.jpg"
                            scale="0.25 0.25 0.25" position="-0.3 -0.091 0" width="2" height="2"></a-image>
                    </a-text>


            </a-text>




        </a-entity>






    </a-entity>














    <!-- Entertainment Experience table -->
    <a-entity class="center-zone" id="table-eeoty" position="4.9 0.2 -2.898" rotation="0 330 0">

        <a-entity class="table" static-body="shape: box;" scale="1 1 1" id="eeoty-pedestal" gltf-model="#pedestal"
            shadow="cast: false; receive: false"></a-entity>
        <a-entity rotation="0 270 0" position="-0.201 0.89 0">
            <a-plane height="0.3" width="0.55" position="0 -0.056 0.005"
                material="side: double; color: #333333; transparent: false; opacity: 1; roughness:1;" side="double">

                <a-entity troika-text='value:Entertainment Experience of the Year
2020 Winner; color:#fff; fontSize:.0325;align:center;' material="shader: standard; metalness: 0.8;"
                    position="0 0.08 0.01" rotation="0 0.111 0"></a-entity>
                <a-entity troika-text="value:What You Don't Know; color:#fff; fontSize:.05;align:center;"
                    material="shader: standard; metalness: 0.8;" position="0 -0.02 0.01" rotation="0 -0.1 0">
                </a-entity>
                <a-entity troika-text='value:Jono and Mr.Doob
Music by Matthew Dear; color:#fff; fontSize:.025;align:center;' material="shader: standard; metalness: 0.8;"
                    position="0 -0.089 0.01" rotation="0 0 0"></a-entity>
            </a-plane>
        </a-entity>


        <a-entity id="eeoty-grab" class="clickable center-obj-zone" dynamic-body="shape: box; mass: 2"
            position="0 1.01 0" mixin="obj" rotation="0 -180 0" scale="0.25 0.25 0.25" gltf-model="#eeoty"
            intensity="0.2"></a-entity>



        <a-entity id="eeoty-card" rotation="0 0 15" position="3.3 3 0.30">
            <a-text id="eeoty-title" mixin="table-label" class="art-text" position="0 1.45 -3" color="yellow" width="5"
                rotation="0 -90 0" text="value:;align:center; wrapCount:50 ">



                <a-text position="3 0.5 0" color="cyan"
                    text="value:2020 Entertainment Experience of the Year;align:center">
                </a-text>
                <a-text position="3 0.2 0" color="cyan" width="2.5" text="value:Winner;align:center">
                </a-text>
                <a-text text="value:What You Don't Know; wrapCount:30" width="5" color="white" position="2 -0.1 0">
                    <a-text position="0.03 -0.25 0" text="value:Jono & Mr. Doob, Music by Matthew Dear; wrapCount:60"
                        width="5" color="white">
                    </a-text>
                    <a-image material="side:front" mixin="scale-label" src="/assets/images/nominees/WhatYouDontKnow.jpg"
                        scale="0.25 0.25 0.25" position="-0.3 -.1 0" width="2" height="2"></a-image>
                </a-text>
                <a-text position="3 -0.65 0" color="cyan" width="2.5" text="value:Nominees;align:center">
                </a-text>


                <a-entity position="0 0 0" rotation="0 0 0">

                    <a-text text="value:Blue Cyber; wrapCount:30" width="5" color="white" position="2 -1 0">
                        <a-text position="0.03 -0.25 0" text="value:Travis Rogers; wrapCount:60" width="5"
                            color="white">
                        </a-text>
                        <a-image material="side:front" mixin="scale-label" src="/assets/images/nominees/BlueCyber.jpg"
                            scale="0.25 0.25 0.25" position="-0.3 -0.091 0" width="2" height="2"></a-image>
                    </a-text>
                    <a-text text="value:XR Dinosaurs; wrapCount:30" width="5" color="white" position="2 -1.6 0">
                        <a-text position="0.03 -0.25 0" text="value:Brandon Jones; wrapCount:60" width="5"
                            color="white">
                        </a-text>
                        <a-image material="side:front" mixin="scale-label" src="/assets/images/nominees/XRDinosaurs.jpg"
                            scale="0.25 0.25 0.25" position="-0.3 -0.091 0" width="2" height="2"></a-image>
                    </a-text>
                    <a-text text="value:Spiderman; wrapCount:30" width="5" color="white" position="2 -2.2 0">
                        <a-text position="0.03 -0.25 0" text="value:Tal Kol; wrapCount:60" width="5" color="white">
                        </a-text>
                        <a-image material="side:front" mixin="scale-label"
                            src="/assets/images/nominees/SpiderManWebVR.jpg" scale="0.25 0.25 0.25"
                            position="-0.3 -0.091 0" width="2" height="2"></a-image>
                    </a-text>
                    <a-text text="value:VR Cybershop; wrapCount:30" width="5" color="white" position="2 -2.8 0">
                        <a-text position="0.03 -0.25 0" text="value:Rebuff Reality; wrapCount:60" width="5"
                            color="white">
                        </a-text>
                        <a-image material="side:front" mixin="scale-label" src="/assets/images/nominees/vrcybershop.jpg"
                            scale="0.25 0.25 0.25" position="-0.3 -0.091 0" width="2" height="2"></a-image>
                    </a-text>
            </a-text>


        </a-entity>
    </a-entity>




    <!-- Education Experience table 
-->

    <a-entity class="center-zone" id="table-edoty" position="2.91 0.2 -0.949" rotation="0 300 0">

        <a-entity class="table" static-body="shape: box;" scale="1 1 1" id="edoty-pedestal" gltf-model="#pedestal"
            shadow="cast: false; receive: false"></a-entity>
        <a-entity rotation="0 270 0" position="-0.201 0.89 0">
            <a-plane height="0.3" width="0.55" position="0 -0.056 0.005"
                material="side: double; color: #333333; transparent: false; opacity: 1; roughness:1;" side="double">

                <a-entity troika-text='value:Education Experience of the Year
2020 Winner; color:#fff; fontSize:.035;align:center;' material="shader: standard; metalness: 0.8;"
                    position="0 0.08 0.01" rotation="0 0.111 0"></a-entity>
                <a-entity troika-text='value:AnVRopomotron; color:#fff; fontSize:.05;align:center;'
                    material="shader: standard; metalness: 0.8;" position="0 -0.02 0.01" rotation="0 -0.1 0">
                </a-entity>
                <a-entity troika-text='value:Dr. Keith Chan; color:#fff; fontSize:.025;align:center;'
                    material="shader: standard; metalness: 0.8;" position="0 -0.089 0.01" rotation="0 0 0">
                </a-entity>
            </a-plane>
        </a-entity>

        <a-entity id="edoty-grab" class="clickable center-obj-zone" dynamic-body="shape: box; mass: 2"
            position="0 1.01 0" mixin="obj" rotation="0 -180 0" scale="0.25 0.25 0.25" gltf-model="#edoty"
            intensity="0.2">
        </a-entity>
        `


        <a-entity id="edoty-card" rotation="0 0 15" position="3.873 3 -0.047">
            <a-text id="edoty-title" mixin="table-label" class="art-text" position="0 1.45 -3" color="yellow" width="5"
                rotation="0 -90 0" text="value:;align:center; wrapCount:50 ">



                <a-text position="3 0.5 0" color="cyan" text="value:2020 Education Experience of the Year;align:center">
                </a-text>
                <a-text position="3 0.2 0" color="cyan" width="2.5" text="value:Nominees;align:center">
                </a-text>

                <a-text text="value:AnVRopomotron; wrapCount:30" width="5" color="white" position="2 -0.1 0">
                    <a-text position="0.03 -0.25 0" text="value:Dr. Keith Chan; wrapCount:60" width="5" color="white">
                    </a-text>
                    <a-image material="side:front" mixin="scale-label" src="/assets/images/nominees/Anvropomotron.jpg"
                        scale="0.25 0.25 0.25" position="-0.3 -0.091 0" width="2" height="2"></a-image>
                </a-text>
                <a-text position="3 -0.65 0" color="cyan" width="2.5" text="value:Nominees;align:center">
                </a-text>




                <a-entity position="0 0 0" rotation="0 0 0">

                    <!--- href="https://lernendurcherleben.ch/windkraftanlage/" title="WindKraft" image="images/nominees/Windkraft.jpg"-->
                    <a-text class="ext-link" link="https://lernendurcherleben.ch/windkraftanlage/"
                        text="value:Windkraft; wrapCount:30" width="5" color="white" position="2 -1. 0">
                        <a-text position="0.03 -0.25 0" text="value:Lernen Durch Erleben; wrapCount:60" width="5"
                            color="white">
                        </a-text>
                        <a-image material="side:front" mixin="scale-label" src="/assets/images/nominees/Windkraft.jpg"
                            scale="0.25 0.25 0.25" position="-0.3 -0.091 0" width="2" height="2"></a-image>
                    </a-text>


                    <a-text text="value:Super Stars; wrapCount:30" width="5" color="white" position="2 -1.6 0">
                        <a-text position="0.03 -0.25 0" text="value:Supermedium; wrapCount:60" width="5" color="white">
                        </a-text>
                        <a-image material="side:front" mixin="scale-label" src="/assets/images/nominees/NightSky.jpg"
                            scale="0.25 0.25 0.25" position="-0.3 -0.091 0" width="2" height="2"></a-image>
                    </a-text>

                    <a-text text="value:Access Mars; wrapCount:30" width="5" color="white" position="2 -2.2 0">
                        <a-text position="0.03 -0.25 0" text="value:Google and NASA/JPL; wrapCount:60" width="5"
                            color="white">
                        </a-text>
                        <a-image material="side:front" mixin="scale-label" src="/assets/images/nominees/AccessMars.jpg"
                            scale="0.25 0.25 0.25" position="-0.3 -0.091 0" width="2" height="2"></a-image>
                    </a-text>

            </a-text>
        </a-entity>
    </a-entity>




    <a-entity id="webxremblem" class="center-zone" position="0.32 12 -5.357">
    <a-entity scale="7 7 7" rotation="0 0 0" class="center-obj-zone" static-body position="0 1.25 0"
                    gltf-model="#emblem"
                    animation="property: object3D.rotation.y; to: 360; easing: linear; dur: 12000; loop: true;"
                    visible="true"></a-entity>
            </a-entity>
     



    </a-entity>

</a-entity>