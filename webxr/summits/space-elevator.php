        <!-- SPACE ELEVATOR-->
        <a-entity position="-40.4 43.02 -107.6" rotation="0 80 0" id="space-elevator-model" gltf-model="#space-elevator"
            scale=".2 .2 .2" visible="true">
            <a-entity position="0 -20.24 0" rotation="0 0 0" id="#nav" gltf-model="#platforms" scale="1 1 1"
                visible="false"></a-entity>

            <a-entity position="0 -20.24 0" rotation="0 0 0" id="platforms" gltf-model="#platforms" scale="1 1 1"
                visible="true">


                <a-entity id="platform-content" scale="10 10 10" position="0 600 0">

                    <a-entity id="">

                    </a-entity>


                   

                    <a-entity id="business-summmit-square-model" class="center-obj-zone" static-body
                        gltf-model="#business-summmit-square" visible="true" scale="20 6 20" position="0 -0.25 4.65"
                        rotation="90 1.5 180"></a-entity>
 <a-entity id="futurewei-logo-model" class="center-obj-zone" static-body
                        gltf-model="#futurewei-3d-logo" visible="true" scale=".375 .2 .375" position="0 -1.65 4.65"
                        rotation="90 3 180"></a-entity>

                    <a-image material="side:front" mixin="scale-label" src="/assets/images/talent/SamanthaMathews.jpg"
                        position="1.1 -1.3 4.65" rotation="0 180 0"   geometry="primitive: circle; width: 2; height: 2; depth: 3" scale=".3 .3 .3" width="5" height="5">
                    </a-image>






                    <a-entity id="label-created" troika-text="value:
                Hosted by Samantha Mathews
September 14, 2021;color:#fff; fontSize:.8;align:left;" material="shader: standard;" position="-0.32 -1.3 4.65"
                        rotation="0 180 0" scale=".2 .2 .2" visibility="true"></a-entity>


                        <!-- BUSINESS AGENDA -->
                    <a-entity id="business-summit-agenda"
                    position="-4.1 0 4" 
                    rotation="0 105 0">
                            <?php
?>
<a-entity id="label-created" troika-text="value:Agenda;color:#fff; fontSize:.8;align:left;" material="shader: standard;" position="1 0 0"
                rotation="0 0 0" scale=".2 .2 .2"></a-entity>

 <?php
           
           
          
            
           print displayAgendaList(getAgenda(406),-2.5,-0.15,0);
           print displayAgendaList(getAgenda(420),-0.25,-0.15,0);
           print displayAgendaList(getAgenda(519),2,-0.15,0);   
           


    ?>



                    </a-entity>









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


     <!-- DESIGN AGENDA -->
     <a-entity id="design-summit-agenda"position="4.2 1 -3" rotation="0 -75 0">
                            <?php
?>
<a-entity id="label-created" troika-text="value:Agenda;color:#fff; fontSize:.8;align:left;" material="shader: standard;" position="1 0 0"
                rotation="0 0 0" scale=".2 .2 .2"></a-entity>

 <?php
           
           
          
            
           print displayAgendaList(getAgenda(434),-2.8,-0.15,0);
           print displayAgendaList(getAgenda(444),-0.25,-0.15,0);
           print displayAgendaList(getAgenda(493),2,-0.15,0);   
        //   print displayAgendaList(getAgenda(518),3,-0.15,0);   
           
           


    ?>



                    </a-entity>




<!--
                    <a-light id="ambient" type="ambient" color="white" distance="20" intensity="6"
                            position="0.231 0 -1.079" angle="90"
                             rotation="0 -30 0"></a-light>-->

                    <a-light id="business-spot1" type="spot" color="#fff" distance="20" intensity="3"
                        position="1.019 -1 1.692" angle="90" rotation="000 -208.45 0">
                        </a-light>

                        <a-light id="business-spot2" type="spot" color="#ff8800" distance="35" intensity="20"
                        position="-8.44 0 -3.7" angle="90" rotation="0 149.4 0">    </a-light>   

                        <a-light id="business-spot3" type="spot" color="#ff8800" distance="20" angle="51.4" intensity="6"
                        position="5.68 -1.69 4" 
                         rotation="9.56 116.4 1">
                        </a-light>

                        <a-light id="design-spot1" type="spot" color="#ffbb00" distance="20" intensity="6"
                            position="0.231 0 -1.079" angle="90"
                             rotation="0 -30 0"></a-light>

                             <a-light id="design-spot2" type="spot" color="#ff4d00"  angle="90" distance="60" intensity="6"
                            position="4.562 -0.23 1.552" rotation="0 -32 0"></a-light>

                            <a-light id="design-spot3" type="spot" color="#ff0000" distance="20" angle="90" intensity="6"
                            position="-3.55 0.225 -3.314" 
                            rotation="0 -28.5 0"></a-light>
                    <a-entity id="platform-lighting" visible="true">
                    

                    


                        <a-light id="platform-side-spot" type="spot" color="#ff8800" intensity="20" position="-2.17 2.87 -1.399 "
                        angle="15.25" rotation="-96.3 -117 0" distance="15"></a-light>
                  
                        
                        <a-light id="shaftlight1" type="spot" color="#ffffff" distance="20" angle="90" intensity="6"
                            position="-3.55 0.225 -3.314" 
                            rotation="0 -28.5 0"></a-light>
                    <a-entity id="platform-lighting" visible="true">
                        
                    <a-light id="design-spot3" type="spot" color="#ffffff" distance="20" angle="90" intensity="6"
                            position="-3.55 0.225 -3.314" 
                            rotation="0 -28.5 0"></a-light>
                    <a-entity id="platform-lighting" visible="true">
                        



                           
                </a-entity><!--platform light
            
        
                      
            -->
                        <!--
            <a-entity position="1.8 -1 -4" static-body rotation="0 180 0" id="table-model" gltf-model="#table"
            scale="1 1 1" visible="true">
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
            <a-entity position="0 0 -0.5" rotation="0 0 0" id="chair7" gltf-model="#chair" scale="1 1 1"
                visible="true"></a-entity>
            <a-entity position="-0 0 0.5" rotation="0 180 0" id="chair8" gltf-model="#chair" scale="1 1 1"
                visible="true"></a-entity>

        </a-entity>-->
        
        <a-entity id="polys2-model" class="center-obj-zone" static-body position="0.313 15.15 0"
                        rotation="90 30 0" gltf-model="#polys2" scale="5 5 5" visible="true">

                    </a-entity>
                    <a-entity id="polys2-date"
                        troika-text="value:February 12, 2022;color:#fff; fontSize:.5;align:center;"
                        material="shader: standard;" position="0 14.28 0" rotation="0 30 0" scale=".2 .2 .2"></a-entity>

                    <a-entity id="emblem-model" class="center-obj-zone" static-body position="0 16.5 0" scale="3 3 3"
                        rotation="0 252 0" gltf-model="#emblem"
                        animation="property: object3D.rotation.y; from: 360; easing: linear; dur: 15000; loop: true;"
                        visible="true"> </a-entity>



                </a-entity>







            </a-entity>
        </a-entity> <!-- /SPACE ELEVATOR-->