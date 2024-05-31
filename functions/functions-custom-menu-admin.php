<?php

/*

	CUSTOM MENU META: event_length_seconds


*/




function kia_custom_fields_event_length_seconds( $item_id, $item,$label ) {

		
	if($item->object == 'event'){

wp_nonce_field( '_event_length_seconds_nonce', '_event_length_seconds_nonce_name' );
$_event_length_seconds = get_post_meta( $item_id, '_event_length_seconds', true );
?>
<div class="field-_event_length_seconds description-wide" style="margin: 5px 0;">
<span class="description"><?php _e( "Duration (in seconds)", 'event_length_seconds' ); ?></span>
<br />

<input type="hidden" class="nav-menu-id" value="<?php echo $item_id ;?>" />

<div class="logged-input-holder">
<!-- -->


<input type="text" name="_event_length_seconds[<?php echo $item_id ;?>]" id="custom-menu-meta-for-<?php echo $item_id ;?>" size="40" value="<?php echo esc_attr( $_event_length_seconds ); ?>" />

</div>

</div>

<?php
}
}




function kia_nav_update_event_length_seconds( $menu_id, $menu_item_db_id ) {

// Verify this came from our screen and with proper authorization.
if ( ! isset( $_POST['_event_length_seconds_nonce_name'] ) || ! wp_verify_nonce( $_POST['_event_length_seconds_nonce_name'], '_event_length_seconds_nonce' ) ) {
return $menu_id;
}

if ( isset( $_POST['_event_length_seconds'][$menu_item_db_id]  ) ) {
$sanitized_data = $_POST['_event_length_seconds'][$menu_item_db_id];
update_post_meta( $menu_item_db_id, '_event_length_seconds', $sanitized_data );
} else {
delete_post_meta( $menu_item_db_id, '_event_length_seconds' );
}
}




/**
* Displays text on the front-end.
*
* @param string   $title The menu item's title.
* @param WP_Post  $item  The current menu item.
* @return string      
*/
function kia_custom_menu_title_event_length_seconds( $title, $item) {

if( is_object( $item ) && isset( $item->ID ) ) {

$_event_length_seconds = get_post_meta( $item->ID, '_event_length_seconds', true );

if ( ! empty( $_event_length_seconds ) ) {
$title .= ' - ' . $_event_length_seconds;
}
}
return $title;
}
/*
*/
add_action( 'wp_nav_menu_item_custom_fields', 'kia_custom_fields_event_length_seconds', 10,3);
add_action( 'wp_update_nav_menu_item', 'kia_nav_update_event_length_seconds', 10, 2 );
add_filter( 'nav_menu_item_title', 'kia_custom_menu_title_event_length_seconds', 10, 2 );



/* COORDINATES*/


function kia_custom_fields_coords( $item_id, $item ) {

	wp_nonce_field( '_coords_nonce', '_coords_nonce_name' );
	$_coords = get_post_meta( $item_id, '_coords', true );
	?>
	<div class="field-_coords description-wide" style="margin: 5px 0;">
	    <span class="description"><?php _e( "WebXR Coordinates", 'coordinates' ); ?></span>
	    <br />

	    <input type="hidden" class="nav-menu-id" value="<?php echo $item_id ;?>" />

	    <div class="logged-input-holder">
	        <input type="text" name="_coords[<?php echo $item_id ;?>]" id="custom-menu-meta-for-<?php echo $item_id ;?>" size="40" value="<?php echo esc_attr( $_coords ); ?>" />
	      
	    </div>

	</div>

	<?php
}

/**
* COORDINATESave the menu item meta
* 
* @param int $menu_id
* @param int $menu_item_db_id	
*/
function kia_nav_update_coords( $menu_id, $menu_item_db_id ) {

	// Verify this came from our screen and with proper authorization.
	if ( ! isset( $_POST['_coords_nonce_name'] ) || ! wp_verify_nonce( $_POST['_coords_nonce_name'], '_coords_nonce' ) ) {
		return $menu_id;
	}

	if ( isset( $_POST['_coords'][$menu_item_db_id]  ) ) {
		$sanitized_data = $_POST['_coords'][$menu_item_db_id];
		update_post_meta( $menu_item_db_id, '_coords', $sanitized_data );
	} else {
		delete_post_meta( $menu_item_db_id, '_coords' );
	}
}





/**
* Displays text on the front-end.
*
* @param string   $title The menu item's title.
* @param WP_Post  $item  The current menu item.
* @return string      
*/
function kia_custom_menu_title_coords( $title, $item ) {

	if( is_object( $item ) && isset( $item->ID ) ) {

		$_coords = get_post_meta( $item->ID, '_coords', true );

		if ( ! empty( $_coords ) ) {
			$title .= ' - ' . $_coords;
		}
	}
	return $title;
}
add_action( 'wp_nav_menu_item_custom_fields', 'kia_custom_fields_coords', 10, 2 );
add_action( 'wp_update_nav_menu_item', 'kia_nav_update_coords', 10, 2 );
add_filter( 'nav_menu_item_title', 'kia_custom_menu_title_coords', 10, 2 );















/* offset*/


function kia_custom_fields_offset( $item_id, $item ) {

	wp_nonce_field( '_offset_nonce', '_offset_nonce_name' );
	$_offset = get_post_meta( $item_id, '_offset', true );
	?>
	<div class="field-_offset description-wide" style="margin: 5px 0;">
	    <span class="description"><?php _e( "Item Offset", 'coordinates' ); ?></span>
	    <br />

	    <input type="hidden" class="nav-menu-id" value="<?php echo $item_id ;?>" />

	    <div class="logged-input-holder">
	        <input type="text" name="_offset[<?php echo $item_id ;?>]" id="custom-menu-meta-for-<?php echo $item_id ;?>" size="40" value="<?php echo esc_attr( $_offset ); ?>" />
	      
	    </div>

	</div>

	<?php
}
add_action( 'wp_nav_menu_item_custom_fields', 'kia_custom_fields_offset', 10, 2 );

/**
* COORDINATESave the menu item meta
* 
* @param int $menu_id
* @param int $menu_item_db_id	
*/
function kia_nav_update_offset( $menu_id, $menu_item_db_id ) {

	// Verify this came from our screen and with proper authorization.
	if ( ! isset( $_POST['_offset_nonce_name'] ) || ! wp_verify_nonce( $_POST['_offset_nonce_name'], '_offset_nonce' ) ) {
		return $menu_id;
	}

	if ( isset( $_POST['_offset'][$menu_item_db_id]  ) ) {
		$sanitized_data = $_POST['_offset'][$menu_item_db_id];
		update_post_meta( $menu_item_db_id, '_offset', $sanitized_data );
	} else {
		delete_post_meta( $menu_item_db_id, '_offset' );
	}
}


/**
* Displays text on the front-end.
*
* @param string   $title The menu item's title.
* @param WP_Post  $item  The current menu item.
* @return string      
*/
function kia_custom_menu_title_offset( $title, $item ) {

	if( is_object( $item ) && isset( $item->ID ) ) {

		$_offset = get_post_meta( $item->ID, '_offset', true );

		if ( ! empty( $_offset ) ) {
			$title .= ' - ' . $_offset;
		}
	}
	return $title;
}

add_action( 'wp_update_nav_menu_item', 'kia_nav_update_offset', 10, 2 );


add_filter( 'nav_menu_item_title', 'kia_custom_menu_title_offset', 10, 2 );





























/*

	CUSTOM MENU META: guest_type


*/



function kia_custom_fields_guest_type( $item_id, $item,$label ) {

		
	if($item->object == 'profile' || $item->object == 'resource'){

wp_nonce_field( '_guest_type_nonce', '_guest_type_nonce_name' );
$_guest_type = get_post_meta( $item_id, '_guest_type', true );
?>
<div class="field-_guest_type description-wide" style="margin: 5px 0;">
<span class="description"><?php _e( "Guest Type", 'guest_type' ); ?></span>
<br />

<input type="hidden" class="nav-menu-id" value="<?php echo $item_id ;?>" />

<div class="logged-input-holder">
<!-- -->


<select size="8" name="_guest_type[<?php echo $item_id ;?>]" id="custom-menu-meta-for-<?php echo $item_id ;?>">
<option value=""<?=selectedOption("",esc_attr($_guest_type ))?>></option>
	<option value="award-presenter"<?=selectedOption("award-presenter",esc_attr($_guest_type ))?>>Award-Presenter</option>
	<option value="interviewee"<?=selectedOption("interviewee",esc_attr($_guest_type ))?>>Interviewee</option>
	<option value="host"<?=selectedOption("host",esc_attr($_guest_type ))?>>Host</option>
	<option value="ambassador"<?=selectedOption("ambassador",esc_attr($_guest_type ))?>>Ambassador</option>
	
	<option value="nominee"<?=selectedOption("nominee",esc_attr($_guest_type ))?>>Nominee</option>

	<option value="honoree"<?=selectedOption("honoree",esc_attr($_guest_type ))?>>Honoree</option>
	<option value="nominated-experience"<?=selectedOption("nominated-experience",esc_attr($_guest_type ))?>>Nominated experience</option>
	
	<option value="special-guest"<?=selectedOption("special-guest",esc_attr($_guest_type ))?>>Special Guest</option>
			
		<!--<option value="moderator"<?=selectedOption("moderator",esc_attr($_guest_type ))?>>Moderator</option>
		<option value="panelist"<?=selectedOption("panelist",esc_attr($_guest_type ))?>>Panelist</option>
		<option value="presenter"<?=selectedOption("presenter",esc_attr($_guest_type ))?>>Presenter</option>
		<option value="interviewee"<?=selectedOption("interviewee",esc_attr($_guest_type ))?>>Interviewee</option>
		<option value="host"<?=selectedOption("host",esc_attr($_guest_type ))?>>Host</option>
		<option value="co-host"<?=selectedOption("co-host",esc_attr($_guest_type ))?>>Co-Host</option>



		<option value="nominee"<?=selectedOption("nominee",esc_attr($_guest_type ))?>>Nominee</option>
	-->
		


</select>


</div>

</div>

<?php
}
}




function kia_nav_update_guest_type( $menu_id, $menu_item_db_id ) {

// Verify this came from our screen and with proper authorization.
if ( ! isset( $_POST['_guest_type_nonce_name'] ) || ! wp_verify_nonce( $_POST['_guest_type_nonce_name'], '_guest_type_nonce' ) ) {
return $menu_id;
}

if ( isset( $_POST['_guest_type'][$menu_item_db_id]  ) ) {
$sanitized_data = $_POST['_guest_type'][$menu_item_db_id];
update_post_meta( $menu_item_db_id, '_guest_type', $sanitized_data );
} else {
delete_post_meta( $menu_item_db_id, '_guest_type' );
}
}




/**
* Displays text on the front-end.
*
* @param string   $title The menu item's title.
* @param WP_Post  $item  The current menu item.
* @return string      
*/
function kia_custom_menu_title_guest_type( $title, $item) {

if( is_object( $item ) && isset( $item->ID ) ) {

$_guest_type = get_post_meta( $item->ID, '_guest_type', true );

if ( ! empty( $_guest_type ) ) {
$title .= ' - ' . $_guest_type;
}
}
return $title;
}

/**/
add_action( 'wp_nav_menu_item_custom_fields', 'kia_custom_fields_guest_type', 10,3);
add_action( 'wp_update_nav_menu_item', 'kia_nav_update_guest_type', 10, 2 );
add_filter( 'nav_menu_item_title', 'kia_custom_menu_title_guest_type', 10, 2 );



/*

	CUSTOM MENU META: event_type


*/




function kia_custom_fields_event_type( $item_id, $item,$label ) {

		
	if($item->object == 'event'){

wp_nonce_field( '_event_type_nonce', '_event_type_nonce_name' );
$_event_type = get_post_meta( $item_id, '_event_type', true );
?>
<div class="field-_event_type description-wide" style="margin: 5px 0;">
<span class="description"><?php _e( "Event Type", 'event_type' ); ?></span>
<br />

<input type="hidden" class="nav-menu-id" value="<?php echo $item_id ;?>" />

<div class="logged-input-holder">
<!-- -->


<select size="13" name="_event_type[<?php echo $item_id ;?>]" id="custom-menu-meta-for-<?php echo $item_id ;?>">
<option value=""<?=selectedOption("",esc_attr($_event_type ))?>></option>
	
	
	
		<option value="nomination-category"<?=selectedOption("nomination-category",esc_attr($_event_type ))?>>Nomination Category</option>
		<option value="honors-presentation"<?=selectedOption("honors-presentation",esc_attr($_event_type ))?>>Honors Presentation</option>
		<option value="red-carpet-interview"<?=selectedOption("red-carpet-interview",esc_attr($_event_type ))?>>Red Carpet Interview</option>
		<option value="category-intro"<?=selectedOption("category-intro",esc_attr($_event_type ))?>>Category Intro</option>

		<option value="special-feature"<?=selectedOption("special-feature",esc_attr($_event_type ))?>>Special Feature</option>
		<option value="sponsor-segment"<?=selectedOption("sponsor-segment",esc_attr($_event_type ))?>>Sponsor Segment</option>
		<option value="acceptance-speech"<?=selectedOption("acceptance-speech",esc_attr($_event_type ))?>>Acceptance Speech</option>
		

		<option value="keynote"<?=selectedOption("keynote",esc_attr($_event_type ))?>>Keynote</option>
		<option value="welcome"<?=selectedOption("welcome",esc_attr($_event_type ))?>>Welcome</option>
		<option value="thanks"<?=selectedOption("thanks",esc_attr($_event_type ))?>>Thanks</option>
		<option value="credits"<?=selectedOption("credits",esc_attr($_event_type ))?>>Credits</option>
		<option value="checkin"<?=selectedOption("checkin",esc_attr($_event_type ))?>>Watch Party Check-in</option>
		
		

		<!--Summmits -->

	<!--	<option value="summit"<?=selectedOption("summit",esc_attr($_event_type ))?>>Summit</option>
		<option value="panel"<?=selectedOption("panel",esc_attr($_event_type ))?>>Panel</option>
		<option value="presentation"<?=selectedOption("presentation",esc_attr($_event_type ))?>>Presentation</option>
		<option value="interview"<?=selectedOption("interview",esc_attr($_event_type ))?>>Interview</option>
		<option value="case-study"<?=selectedOption("case-study",esc_attr($_event_type ))?>>Case Study</option>-->


</select>


</div>

</div>

<?php
}
}




function kia_nav_update_event_type( $menu_id, $menu_item_db_id ) {

// Verify this came from our screen and with proper authorization.
if ( ! isset( $_POST['_event_type_nonce_name'] ) || ! wp_verify_nonce( $_POST['_event_type_nonce_name'], '_event_type_nonce' ) ) {
return $menu_id;
}

if ( isset( $_POST['_event_type'][$menu_item_db_id]  ) ) {
$sanitized_data = $_POST['_event_type'][$menu_item_db_id];
update_post_meta( $menu_item_db_id, '_event_type', $sanitized_data );
} else {
delete_post_meta( $menu_item_db_id, '_event_type' );
}
}




/**
* Displays text on the front-end.
*
* @param string   $title The menu item's title.
* @param WP_Post  $item  The current menu item.
* @return string      
*/
function kia_custom_menu_title_event_type( $title, $item) {

if( is_object( $item ) && isset( $item->ID ) ) {

$_event_type = get_post_meta( $item->ID, '_event_type', true );

if ( ! empty( $_event_type ) ) {
$title .= ' - ' . $_event_type;
}
}
return $title;
}

/*
*/
add_action( 'wp_nav_menu_item_custom_fields', 'kia_custom_fields_event_type', 10,3);
add_action( 'wp_update_nav_menu_item', 'kia_nav_update_event_type', 10, 2 );
add_filter( 'nav_menu_item_title', 'kia_custom_menu_title_event_type', 10, 2 );

/*


CUSTOM MENU META: Edit link


*/


function kia_custom_fields_edit_link( $item_id, $item,$label ) {
	if($item->object != 'custom'){
?>
<!--
<hr>
        <a target="_new" style="font-size:125%;font-weight:bold;" href="/wp-admin/post.php?action=edit&post=<?=$item->object_id?>">Edit <?=$item->type_label?> <?=$item->title?></a>-->
<?php
	}
}
add_action( 'wp_nav_menu_item_custom_fields', 'kia_custom_fields_edit_link', 10,3);



/*


CUSTOM MENU META: appearance_type


*/


function kia_custom_fields_appearance_type( $item_id, $item,$label ) {

    if($item->object == 'event'){
        
        ?>

        <hr>
        <a target="_new" style="font-size:125%;font-weight:bold;" href="/wp-admin/post.php?action=edit&post=<?=$item->object_id?>">Edit <?=$item->type_label?> <?=$item->title?></a>
    </hr>
    <?php
    }
                    if($item->object == 'profile'){
        $item->menu_class = "fred";
    wp_nonce_field( '_appearance_type_nonce', '_appearance_type_nonce_name' );
    $_appearance_type = get_post_meta( $item_id, '_appearance_type', true );
    
    ?>
    <div class="field-_appearance_type description-wide" style="margin: 5px 0;">
        <hr>
                <!--        <a target="_new" style="font-size:125%;font-weight:bold;" href="/wp-admin/post.php?action=edit&post=<?=$item->object_id?>">Edit <?=$item->type_label?> <?=$item->title?></a>
                    </hr>

	-->		<span class="description"><?php _e( "Appearance Type $item_id", 'appearance_type' ); ?></span>
        <br />

        <input type="hidden" class="nav-menu-id" value="<?php echo $item_id ;?>" />

        <div class="logged-input-holder">
            <!-- -->
                
        
            <select size="6" name="_appearance_type[<?php echo $item_id ;?>]" id="custom-menu-meta-for-<?php echo $item_id ;?>">
            <option value=""<?=selectedOption("",esc_attr($_appearance_type ))?>></option>
            
                        <option value="inperson"<?=selectedOption("inperson",esc_attr($_appearance_type ))?>>In Person | Main Stage</option>
						<option value="maybe"<?=selectedOption("maybe",esc_attr($_appearance_type ))?>>In Person Maybe</option>
                        <option value="liveremote"<?=selectedOption("liveremote",esc_attr($_appearance_type ))?>>Live Remote</option>
                        <option value="prerecorded"<?=selectedOption("prerecorded",esc_attr($_appearance_type ))?>>Prerecorded</option>
						<option value="scatter"<?=selectedOption("in_person_video_call",esc_attr($_appearance_type ))?>>In Person | Video Call</option>
						
						<option value="vipzoom"<?=selectedOption("vipzoom",esc_attr($_appearance_type ))?>>VIP Zoom</option>
						
                       


            </select>
        

        </div>

    </div>

    <?php
}
}



function kia_nav_update_appearance_type( $menu_id, $menu_item_db_id ) {

    // Verify this came from our screen and with proper authorization.
    if ( ! isset( $_POST['_appearance_type_nonce_name'] ) || ! wp_verify_nonce( $_POST['_appearance_type_nonce_name'], '_appearance_type_nonce' ) ) {
        return $menu_id;
    }

    if ( isset( $_POST['_appearance_type'][$menu_item_db_id]  ) ) {
        $sanitized_data = $_POST['_appearance_type'][$menu_item_db_id];
        update_post_meta( $menu_item_db_id, '_appearance_type', $sanitized_data );
    } else {
        delete_post_meta( $menu_item_db_id, '_appearance_type' );
    }
}




/**
* Displays text on the front-end.
*
* @param string   $title The menu item's title.
* @param WP_Post  $item  The current menu item.
* @return string      
*/
function kia_custom_menu_title_appearance_type( $title, $item) {

    if( is_object( $item ) && isset( $item->ID ) ) {

        $_appearance_type = get_post_meta( $item->ID, '_appearance_type', true );

        if ( ! empty( $_appearance_type ) ) {
            $title .= ' - ' . $_appearance_type;
        }
    }
    return $title;
}

/**/
add_action( 'wp_nav_menu_item_custom_fields', 'kia_custom_fields_appearance_type', 10,3);
add_action( 'wp_update_nav_menu_item', 'kia_nav_update_appearance_type', 10, 2 );
add_filter( 'nav_menu_item_title', 'kia_custom_menu_title_appearance_type', 10, 2 );


/*

	CUSTOM MENU META: confirmation_status


*/








	function kia_custom_fields_confirmation_status( $item_id, $item,$label ) {

		if($item->object == 'event'){
			
			?>
<!--
			<hr>
			<a target="_new" style="font-size:125%;font-weight:bold;" href="/wp-admin/post.php?action=edit&post=<?=$item->object_id?>">Edit <?=$item->type_label?> <?=$item->title?></a>
		</hr>-->
		<?php
		}
						if($item->object == 'profile'){
			$item->menu_class = "fred";
		wp_nonce_field( '_confirmation_status_nonce', '_confirmation_status_nonce_name' );
		$_confirmation_status = get_post_meta( $item_id, '_confirmation_status', true );
		
		?>
		<div class="field-_confirmation_status description-wide" style="margin: 5px 0;">
		    <hr>
							<a target="_new" style="font-size:125%;font-weight:bold;" href="/wp-admin/post.php?action=edit&post=<?=$item->object_id?>">Edit <?=$item->type_label?> <?=$item->title?></a>
						</hr>

<!--	-->		<span class="description"><?php _e( "Confirmation Status $item_id", 'confirmation_status' ); ?></span>
			<br />
	
			<input type="hidden" class="nav-menu-id" value="<?php echo $item_id ;?>" />

			<div class="logged-input-holder">
				<!-- -->
					
			
				<select size="8" name="_confirmation_status[<?php echo $item_id ;?>]" id="custom-menu-meta-for-<?php echo $item_id ;?>">
				<option value=""<?=selectedOption("",esc_attr($_confirmation_status ))?>></option>
				<option value="needs-invite"<?=selectedOption("needs-invite",esc_attr($_confirmation_status ))?>>Needs Invitation</option>
			
							<option value="team"<?=selectedOption("team",esc_attr($_confirmation_status ))?>>Team</option>
							<option value="invited"<?=selectedOption("invited",esc_attr($_confirmation_status ))?>>Invited</option>
							<option value="agreed"<?=selectedOption("agreed",esc_attr($_confirmation_status ))?>>Agreed</option>
							<option value="scheduled-prepcall"<?=selectedOption("scheduled-prepcall",esc_attr($_confirmation_status ))?>>Scheduled Prepcall</option>
							<option value="prepcall-completed"<?=selectedOption("prepcall-completed",esc_attr($_confirmation_status ))?>>Prep Call Completed</option>
							<option value="prerecord-edit-complete"<?=selectedOption("prerecord-edit-complete",esc_attr($_confirmation_status ))?>>Prerecord Edit Complete</option>
							<option value="complete" <?=selectedOption("complete",esc_attr($_confirmation_status ))?>>Confirmed and Complete</option>

							<!--<option value="agreed-with-conditions"<?=selectedOption("-with-condition",esc_attr($_confirmation_status ))?>>Agreed With Conditions</option>
							
							<option value="registered" <?=selectedOption("registered",esc_attr($_confirmation_status ))?>>Registration Complete</option>
							<option value="registered-no-release" <?=selectedOption("registered-no-release",esc_attr($_confirmation_status ))?>>Registered No Release</option>
							<option value="calendar-sent" <?=selectedOption("calendar-sent",esc_attr($_confirmation_status ))?>>Calendar Sent</option>
							<option value="calendar-sent-no-registration" <?=selectedOption("calendar-sent-no-release",esc_attr($_confirmation_status ))?>>Calendar Sent No Release</option>

							<option value="calendar-sent-no-registration" <?=selectedOption("calendar-sent-no-registration",esc_attr($_confirmation_status ))?>>Calendar Sent No Registration</option>

							<option value="confirmed-no-registration" <?=selectedOption("confirmed-no-registration",esc_attr($_confirmation_status ))?>>Confirmed Calendar No Registration</option>

							<option value="calendar-sent-no-release" <?=selectedOption("calendar-sent-no-release",esc_attr($_confirmation_status ))?>>Calendar Sent No Release</option>
							<option value="confirmed-no-release" <?=selectedOption("confirmed-no-release",esc_attr($_confirmation_status ))?>>Confirmed Calendar No Release</option>
					


							<option value="prerecord" <?=selectedOption("prerecord",esc_attr($_confirmation_status ))?>>Session Prerecorded</option>	-->

							

				</select>
			

			</div>

		</div>

		<?php
}
	}
	function selectedOption($str,$val){
		if($str == $val){
			return " selected";
		}

	}

	
	function kia_nav_update_confirmation_status( $menu_id, $menu_item_db_id ) {

		// Verify this came from our screen and with proper authorization.
		if ( ! isset( $_POST['_confirmation_status_nonce_name'] ) || ! wp_verify_nonce( $_POST['_confirmation_status_nonce_name'], '_confirmation_status_nonce' ) ) {
			return $menu_id;
		}

		if ( isset( $_POST['_confirmation_status'][$menu_item_db_id]  ) ) {
			$sanitized_data = $_POST['_confirmation_status'][$menu_item_db_id];
			update_post_meta( $menu_item_db_id, '_confirmation_status', $sanitized_data );
		} else {
			delete_post_meta( $menu_item_db_id, '_confirmation_status' );
		}
	}
	



	/**
	* Displays text on the front-end.
	*
	* @param string   $title The menu item's title.
	* @param WP_Post  $item  The current menu item.
	* @return string      
	*/
	function kia_custom_menu_title_confirmation_status( $title, $item) {

		if( is_object( $item ) && isset( $item->ID ) ) {

			$_confirmation_status = get_post_meta( $item->ID, '_confirmation_status', true );

			if ( ! empty( $_confirmation_status ) ) {
				$title .= ' - ' . $_confirmation_status;
			}
		}
		return $title;
	}

/**/
	add_action( 'wp_nav_menu_item_custom_fields', 'kia_custom_fields_confirmation_status', 10,3);
	add_action( 'wp_update_nav_menu_item', 'kia_nav_update_confirmation_status', 10, 2 );
	add_filter( 'nav_menu_item_title', 'kia_custom_menu_title_confirmation_status', 10, 2 );

/*

	CUSTOM MENU META: point_of_contact


*/










	function kia_custom_fields_point_of_contact( $item_id, $item,$label ) {

		
		if($item->object == 'profile'){

wp_nonce_field( '_point_of_contact_nonce', '_point_of_contact_nonce_name' );
$_point_of_contact = get_post_meta( $item_id, '_point_of_contact', true );
?>
<div class="field-_point_of_contact description-wide" style="margin: 5px 0;">
<span class="description"><?php _e( "Point of Contact", 'point_of_contact' ); ?></span>
<br />

<input type="hidden" class="nav-menu-id" value="<?php echo $item_id ;?>" />

<div class="logged-input-holder">
<!-- -->
	

<select size="7" name="_point_of_contact[<?php echo $item_id ;?>]" id="custom-menu-meta-for-<?php echo $item_id ;?>">
			<option value="ben"<?=selectedOption("ben",esc_attr($_point_of_contact ))?>>Ben</option>
			<option value="julie"<?=selectedOption("julie",esc_attr($_point_of_contact ))?>>Julie</option>
			<option value="sophia" <?=selectedOption("sophia",esc_attr($_point_of_contact ))?>>Sophia</option>
			<option value="karen" <?=selectedOption("karen",esc_attr($_point_of_contact ))?>>Karen</option>
			<option value="daniel" <?=selectedOption("daniel",esc_attr($_point_of_contact ))?>>Daniel</option>
			<option value="linda" <?=selectedOption("linda",esc_attr($_point_of_contact ))?>>Linda</option>
			<option value="helen" <?=selectedOption("helen",esc_attr($_point_of_contact ))?>>Helen</option>
			


</select>


</div>

</div>

<?php
}
}




function kia_nav_update_point_of_contact( $menu_id, $menu_item_db_id ) {

// Verify this came from our screen and with proper authorization.
if ( ! isset( $_POST['_point_of_contact_nonce_name'] ) || ! wp_verify_nonce( $_POST['_point_of_contact_nonce_name'], '_point_of_contact_nonce' ) ) {
return $menu_id;
}

if ( isset( $_POST['_point_of_contact'][$menu_item_db_id]  ) ) {
$sanitized_data = $_POST['_point_of_contact'][$menu_item_db_id];
update_post_meta( $menu_item_db_id, '_point_of_contact', $sanitized_data );
} else {
delete_post_meta( $menu_item_db_id, '_point_of_contact' );
}
}




/**
* Displays text on the front-end.
*
* @param string   $title The menu item's title.
* @param WP_Post  $item  The current menu item.
* @return string      
*/
function kia_custom_menu_title_point_of_contact( $title, $item) {

if( is_object( $item ) && isset( $item->ID ) ) {

$_point_of_contact = get_post_meta( $item->ID, '_point_of_contact', true );

if ( ! empty( $_point_of_contact ) ) {
$title .= ' - ' . $_point_of_contact;
}
}
return $title;
}

/**/
add_action( 'wp_nav_menu_item_custom_fields', 'kia_custom_fields_point_of_contact', 10,3);
add_action( 'wp_update_nav_menu_item', 'kia_nav_update_point_of_contact', 10, 2 );
add_filter( 'nav_menu_item_title', 'kia_custom_menu_title_point_of_contact', 10, 2 );



/*

	CUSTOM MENU META: notes


*/










function kia_custom_fields_notes( $item_id, $item,$label ) {

		
	if($item->object == 'profile'){

wp_nonce_field( '_notes_nonce', '_notes_nonce_name' );
$_notes = get_post_meta( $item_id, '_notes', true );
?>
<div class="field-_notes description-wide" style="margin: 5px 0;">
<span class="description"><?php _e( "Notes", 'notes' ); ?></span>
<br />

<input type="hidden" class="nav-menu-id" value="<?php echo $item_id ;?>" />

<div class="logged-input-holder">
<!-- -->


<textarea size="5" name="_notes[<?php echo $item_id ;?>]" id="custom-menu-meta-for-<?php echo $item_id ;?>"><?=esc_attr($_notes )?></textarea>


</div>

</div>

<?php
}
}



function kia_nav_update_notes( $menu_id, $menu_item_db_id ) {

// Verify this came from our screen and with proper authorization.
if ( ! isset( $_POST['_notes_nonce_name'] ) || ! wp_verify_nonce( $_POST['_notes_nonce_name'], '_notes_nonce' ) ) {
return $menu_id;
}

if ( isset( $_POST['_notes'][$menu_item_db_id]  ) ) {
$sanitized_data = $_POST['_notes'][$menu_item_db_id];
update_post_meta( $menu_item_db_id, '_notes', $sanitized_data );
} else {
delete_post_meta( $menu_item_db_id, '_notes' );
}
}




/**
* Displays text on the front-end.
*
* @param string   $title The menu item's title.
* @param WP_Post  $item  The current menu item.
* @return string      
*/
function kia_custom_menu_title_notes( $title, $item) {

if( is_object( $item ) && isset( $item->ID ) ) {

$_notes = get_post_meta( $item->ID, '_notes', true );

if ( ! empty( $_notes ) ) {
$title .= ' - ' . $_notes;
}
}
return $title;
}

/**/
add_action( 'wp_nav_menu_item_custom_fields', 'kia_custom_fields_notes', 10,3);
add_action( 'wp_update_nav_menu_item', 'kia_nav_update_notes', 10, 2 );
add_filter( 'nav_menu_item_title', 'kia_custom_menu_title_notes', 10, 2 );









?>