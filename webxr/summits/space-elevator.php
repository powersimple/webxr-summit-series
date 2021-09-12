<!-- SPACE ELEVATOR-->
<?php

if(!@$se_pos){
    $se_pos = '-38.586 48 -105.592';
    $se_rot = '0 80 0';
}

?>
<a-entity position="<?=$se_pos?>" rotation="<?=$se_rot?>" id="space-elevator-model" gltf-model="#space-elevator"
    scale=".2 .2 .2" visible="true">
<?php
    /* TEXT UP SIDE THIS SHAFT */
    $elevate = [
        "This Fall",
        "From the Team that Brought You
The Polys - WebXR Awards",
        "and the WebXR Developer Summit",
        "Two Free Events",
        "For Decision Makers",
        "and Creatives",
        "to Elevate Your Game",
        "onto the Immersive Web",
        ""
        
    ];

    $coords =[
        "pos_x"=>-29.2,
        "pos_y"=>0.14,
        "pos_z"=>-27.60,
        "rot_x"=>90,
        "rot_y"=>0,
        "rot_z"=>120,
        "scale"=>3,
        "start_x"=>0,
        "start_y"=>0,
        "start_z"=>0,
        "offset_x"=>0,
        "offset_y"=>0,
        "offset_z"=>-22,
    ];

    print displayTextSeries($elevate,$coords);
?>
    </a-entity>



    <a-entity position="-15.4 -24.36 -20.71" rotation="0 0 0" id="#nav" gltf-model="#platforms" scale="1 1 1"
        visible="false"></a-entity>

    <a-entity position="-15.4 -24.36 -20.71" rotation="0 0 0" id="platforms" gltf-model="#platforms" scale="1 1 1"
        visible="true">


        <a-entity id="platform-content" scale="10 10 10" position="0 600 0">

                <!--
    
        <a-entity id="business-summmit-square-model" class="center-obj-zone" static-body
                gltf-model="#business-summmit-square" visible="true" scale="20 6 20" position="0 0 4.65"
                rotation="90 1.5 180"></a-entity>

            
<a-entity id="futurewei-logo-model" class="center-obj-zone" static-body
                gltf-model="#futurewei-3d-logo" visible="true" scale=".375 .2 .375" position="0 -1.4 4.65"
                rotation="90 3 180"></a-entity>

            <a-image material="side:front" mixin="scale-label" src="/assets/images/talent/SamanthaMathews.jpg"
                position="1.1 -1.05 4.65" rotation="0 180 0"   geometry="primitive: circle; width: 2; height: 2; depth: 3" scale=".3 .3 .3" width="5" height="5">
            </a-image>






            <a-entity id="label-created" troika-text="value:
        Hosted by Samantha Mathews
September 14, 2021;color:#fff; fontSize:.8;align:left;" material="shader: standard;" position="-0.32 -1.05 4.65"
                rotation="0 180 0" scale=".2 .2 .2" visibility="true"></a-entity>


-->





            <a-entity id="design-summmit-square-model" class="center-obj-zone" static-body position="0.2 0.85 -5"
                rotation="90 90 87" gltf-model="#design-summmit-square" scale="20 10 20" visible="true">

            </a-entity>

            <a-image material="side:front" mixin="scale-label" src="/assets/images/talent/KentBye.jpg" geometry="primitive: circle; width: 2; height: 2; depth: 3" scale=".3 .3 .3" 
                position="-0.7 -0.25 -5" rotation="0 0 0" width="5" height="5">


            </a-image>

            <a-entity id="label-created" troika-text="value:
Hosted by Kent Bye
October 12, 2021;color:#fff; fontSize:.8;align:left;" material="shader: standard;" position="0.4 -0.25 -5"
                rotation="0 2.48 0" scale=".2 .2 .2"></a-entity>


<!-- DESIGN AGENDA 
<a-entity id="design-summit-agenda"position="4.2 1 -3" rotation="0 -75 0">
                    <?php
?>
<a-entity id="label-created" troika-text="value:Agenda;color:#fff; fontSize:.8;align:left;" material="shader: standard;" position="1 0 0"
        rotation="0 0 0" scale=".2 .2 .2"></a-entity>

<?php
    
    
    
    
 //   print displayAgendaList(getAgenda(434),-2.8,-0.15,0);
  //  print displayAgendaList(getAgenda(444),-0.25,-0.15,0);
   // print displayAgendaList(getAgenda(493),2,-0.15,0);   



   



//   print displayAgendaList(getAgenda(518),3,-0.15,0);   
    
    


?>



            </a-entity>-->




<!--
            <a-light id="ambient" type="ambient" color="white" distance="20" intensity="6"
                    position="0.231 0 -1.079" angle="90"
                        rotation="0 -30 0"></a-light>-->

            <a-light id="business-spot1" type="spot" color="#fff" distance="20" intensity="3"
                position="1.019 -1 1.692" angle="90" rotation="000 -208.45 0">
                </a-light>

                <a-light id="business-spot2" type="spot" color="#ff8800" distance="35" intensity="20"
                position="-8.44 0 -3.7" angle="90" rotation="0 152 0">    </a-light>   

                <a-light id="business-spot3" type="spot" color="#ff8800" distance="20" angle="51.4" intensity="6"
                position="5.68 -1.69 4" 
                    rotation="9.56 116.4 1">
                </a-light>

                <a-light id="design-spot1" type="spot" color="#ffbb00" distance="20" intensity="6"
                    position="0.231 0 -1.079" angle="90"
                        rotation="0 -30 0"></a-light>

                        <a-light id="design-spot2" type="spot" color="#ff4d00"  angle="90" distance="60" intensity="6"
                    position="4.562 -0.23 1.552" rotation="-1.5 -36.5 0"></a-light>

                    <a-light id="design-spot3" type="spot" color="#ff0000" distance="20" angle="90" intensity="6"
                    position="-3.55 0.225 -3.314" 
                    rotation="0 -28.5 0"></a-light>
            <a-entity id="platform-lighting" visible="true">
            

            


                <a-light id="platform-side-spot" type="spot" color="#ff8800" intensity="20" position="-2.17 2.87 -1.399 "
                angle="15.25" rotation="-96.3 -117 0" distance="15"></a-light>
            
                



                <a-light id="shaft-spot1" type="spot" color="#ffffff" intensity="10" position="0 -4.19 -5"
                angle="60" rotation="91 180 0" distance="60"></a-light>
            
                
                <a-light id="shaft-spot2" type="spot" color="#ffffff" intensity="10" position="0.5 -9 4.753"
                angle="60" rotation="120 -30 0" distance="60"></a-light>





<a-light id="shaft-spot1" type="spot" color="#ffffff" intensity="10" position="-2.9 -26.3 -21.47"
                angle="60" rotation="-8.28 180 0" distance="80"></a-light>
            
                
                <a-light id="shaft-spot2" type="spot" color="#ffffff" intensity="10" position="3 -27.4 19.46"
                angle="65" rotation="-2.84 -30 0" distance="80"></a-light>











                    
        </a-entity><!--platform light
    

                
    -->


<a-entity id="polys2-model" class="center-obj-zone" static-body position="0.313 16 0"
                rotation="90 30 0" gltf-model="#polys2" scale="10 10 10
                " visible="true"></a-entity>
            <a-entity id="polys2-date"
                troika-text="value:February 12, 2022;color:#fff; fontSize:1.2;align:right;"
                material="shader: standard;" position="0.742 15.12 -0.362" rotation="0 30 0" scale=".2 .2 .2"></a-entity>
                <a-entity id="Nomination-season"
                troika-text="value:Nomination Season Begins Oct 1;color:#fff; fontSize:.65;align:center;"
                material="shader: standard;" position="0.782 14.82 -0.353" rotation="0 30 0" scale=".2 .2 .2"></a-entity>

            <a-entity id="emblem-model" class="center-obj-zone" static-body position="0 17.5 0" scale="2 2 2"
                rotation="0 252 0" gltf-model="#emblem"
                animation="property: object3D.rotation.y; from: 360; easing: linear; dur: 15000; loop: true;"
                visible="true"> </a-entity>



        </a-entity>







    </a-entity>
    


</a-entity> <!-- /SPACE ELEVATOR-->


