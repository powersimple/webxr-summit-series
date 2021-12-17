<?php
                    $trophy_offset = "0.008 4.367 -1.009";
                    $pedestal_scale = ".5 .5 .5";
                    $card_title = "";
                ?>

                <a-entity id="pedestal-1" position="0 0 -3" scale="<?=$pedestal_scale?>">

                 
                    <a-entity class="center-obj-zone" static-body
                    gltf-model="#pedestal" visible="true" scale="1 1 1" position="0 .5 -1"
                    rotation="0 0 0"></a-entity>
                    <a-entity id="2nd-polys-trophy-model" class="center-obj-zone" static-body
                    gltf-model="#2nd-polys-trophy" visible="true" scale="1 1 1" position="<?=$trophy_offset?>"
                    rotation="0 -50 0"></a-entity>
                    <a-entity rotation="0 37.5 0" position="0.18 4.2 -0.8">
                    <a-plane height="0.3" width="0.55" position="0.004 -0.056 0.005"
                        material="side: double; color: #333333; transparent: false; opacity: 1; roughness:1;" side="double">

                        <a-entity troika-text='value:Experience of the Year
        ; color:#fff; fontSize:.04;align:center;' material="shader: standard; metalness: 0.8;"
                            position="0 0.08 0.01" rotation="0 0.111 0"></a-entity>
                    <!--    <a-entity troika-text='value:Troika; color:#606; fontSize:.05;align:center;'
                            material="shader: standard; metalness: 0.8;" position="0 -0.02 0.01" rotation="0 -0.1 0">
                        </a-entity>
                        <a-entity troika-text='value:Jason Johnston; color:#fff; fontSize:.025;align:center;'
                            material="shader: standard; metalness: 0.8;" position="0 -0.089 0.01" rotation="0 0 0">
                        </a-entity>-->
                    </a-plane>
                </a-entity>
                </a-entity> 
                    <!-- POLY table 
-->
        <a-entity class="center-zone" id="table-poly" position="0 .2 0" rotation="0 -90 0">

<a-entity class="table" static-body="shape: box;" scale="1 1 1" id="poly-pedestal" gltf-model="#pedestal"
    shadow="cast: false; receive: false"></a-entity>
    <a-entity rotation="0 270 0" position="-0.192 0.89 0">
        <a-plane height="0.3" width="0.55" position="0 -0.056 0.005"
        material="side: double; color: #333333; transparent: false; opacity: 1; roughness:1;" side="double">

        <a-entity troika-text='value:2020 WebXR Awards; color:#fff; fontSize:.04;align:center;' material="shader: standard; metalness: 0.8;"
            position="0 0.09 0.01" rotation="0 0.111 0"></a-entity>
<a-entity troika-text='value:The Polys; color:#fff; fontSize:.07;align:center;' material="shader: standard; metalness: 0.8;"
            position="0 0.01 0.01" rotation="0 -0.1 0"></a-entity>
            <a-entity troika-text='value:Hosted by
Julie Smithson and Sophia Moshasha
20 February 2021; color:#fff; fontSize:.025;align:center;' material="shader: standard; metalness: 0.8;"
            position="0 -0.089 0.01" rotation="0 0 0"></a-entity>
    </a-plane>
</a-entity>

<a-entity id="poly-grab" class="clickable center-obj-zone" dynamic-body="shape: box; mass: 2"
    position="0 3.88 0" mixin="obj" rotation="0 180 0" scale="1 1 1" gltf-model="#2nd-polys-trophy">
<!--                <a-light type="spot" color="green" intensity="10" position="0 -1 -1.6" rotation="45 180 0" angle="15"></a-light>
    <a-light type="spot" color="blue" intensity="10" position="0 -1 1.6" rotation="45 0 0" angle="15"></a-light>
    <a-light type="spot" color="red" intensity="10" position="-1.6 -1 0" rotation="45 270 0" angle="15"></a-light>
    <a-light type="spot" color="white" intensity="5" position="2 0.17 0" rotation="40 90 0" angle="44"></a-light>-->
</a-entity>

<a-entity id="poly-card" rotation="0 0 0" position="3.873 1.5 -0.047" shadow material="color: red">
    <a-entity id="poly-credits">
        
       
    <a-text id="poly-title" class="art-text" mixin="table-label" position="-1 0.5 -3" color="white"
        width="2.5" rotation="0 -90 0" text="value:;wrap-count:50 ">


<a-text text="value:Julie Smithson; wrapCount:30" width="10" color="white" position="-2.5 6 -6" rotation="30 0 0">
    <a-text position="0.16 -0.5 0" text="value:Host; wrapCount:60" width="10"
        color="white">
    </a-text>
    <a-image material="side:front" mixin="scale-label" src="/assets/images/talent/Polys-Host-JulieSmithson.jpg"
        scale="1 1 1" position="-1 -0.3 0" width="2" height="2"></a-image>
</a-text>
<a-text text="value:Sophia Moshasha; wrapCount:30" width="10" color="white" position="6 6 -6" rotation="30 0 0">
    <a-text position="0.16 -0.5 0" text="value:Virtual Red Carpet; wrapCount:60" width="10"
        color="white">
    </a-text>
    <a-image material="side:front" mixin="scale-label" src="/assets/images/talent/SophiaMoshasha-PolysRedCarpet.jpg"
        scale="1 1 1" position="-1 -0.3 0" width="2" height="2"></a-image>
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

       ; wrapCount:70;baseline:top;" width="8"
        color="white">
    </a-text>
    
    
    
    
    
    
    <a-text position="4 4 -6" rotation="15 0 0" text="value:
    
 
                   
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
    
    Thanks to Terry Schussler, Richard Ward, Karen Alexander, Leila Amirsadeghi, Joe Smith and Marcia Carter
    ; wrapCount:75;baseline:top;" width="8"
    color="white">
    </a-text>











</a-entity>

     
    </a-text>
</a-entity>
</a-entity>

</a-entity>



