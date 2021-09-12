<a-assets timeout="800000">

<a-asset-item id="town-hall-open-forum" response-type="arraybuffer" src="/assets/models/town-hall-open-forum.glb"></a-asset-item>



</a-assets>
<a-entity id="business-town-hall" <?=$seating_position?> scale="1 1 1"
            visible="true">
            <a-light id="business-spot1" type="spot" color="#4de407" distance="20" intensity="10"
                position="-1 1.6 4.6" angle="35" rotation="33.5 -61.7 0">
                </a-light>
            <a-entity id="town-hall-date" troika-text="value:<?=$town_hall_date?>
RSVP: <?=$town_hall_url?>
//webxr.events | @webxrawards;color:#fff; fontSize:1;align:left;baseline:top;" material="shader: standard;"  position="4.02 2.5 2.07" rotation="0 -54.7 0"
 scale=".3 .3 .3" visibility="true"></a-entity>

        <a-entity position="4 4 2" rotation="90 -50 5" id="town-hall-model" gltf-model="#town-hall-open-forum" scale="25 40 25" visible="true"></a-entity>

            <a-entity id="seatingleft1" position="-3.66 0 -0.734" rotation="0 15 0">
            <?php include "chairs-row.php";?>
            </a-entity>

            <a-entity id="seatingleft2" position="-3.66 0 0" rotation="0 15 0">
            <?php include "chairs-row.php";?>
            </a-entity>

            <a-entity id="seatingleft3" position="-3.66 0 0.734" rotation="0 15 0">
            <?php include "chairs-row.php";?>
            </a-entity>
        


            <a-entity id="seating1" position="0 0 -0.5">
            <?php include "chairs-row.php";?>
            </a-entity>
            <a-entity id="seating2" position="0 0 0.24">
            <?php include "chairs-row.php";?>
            </a-entity>
            <a-entity id="seating3" position="0 0 0.97">
            <?php include "chairs-row.php";?>
            </a-entity>




            <a-entity id="seatingleft1" position="3.66 0 -0.734" rotation="0 -30 0">
            <?php include "chairs-row.php";?>
            </a-entity>

            <a-entity id="seatingleft2" position="3.66 0 0" rotation="0 -30 0">
            <?php include "chairs-row.php";?>
            </a-entity>

            <a-entity id="seatingleft3" position="3.66 0 0.734" rotation="0 -30 0">
            <?php include "chairs-row.php";?>
            </a-entity>
            <a-entity id="seatingleft3" position="3.66 0 1.472" rotation="0 -30 0">
            <?php include "chairs-row.php";?>
            </a-entity>





           

            <a-entity id="seatingleft2" position="3.66 0 0" rotation="0 -30 0">
            <?php include "chairs-row.php";?>
            </a-entity>

            <a-entity id="seatingleft3" position="3.66 0 0.734" rotation="0 -30 0">
            <?php include "chairs-row.php";?>
            </a-entity>
            <a-entity id="seatingleft3" position="3.66 0 1.472" rotation="0 -30 0">
            <?php include "chairs-row.php";?>
            </a-entity>

            <a-entity id="seatingright1" position="5 0 4.5" rotation="0 -90 0">
            <?php include "chairs-row.php";?></a-entity>

            <a-entity id="seatingright2" position="4.25 0 4.5" rotation="0 -90 0">
            <?php include "chairs-row.php";?></a-entity>
            <a-entity id="seatingright3" position="3.5 0 4.5" rotation="0 -90 0">
            <?php include "chairs-row.php";?></a-entity>

            </a-entity>

        </a-entity>

        </a-entity>
