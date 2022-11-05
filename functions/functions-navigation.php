<?php
    function get_home_children(){
		$home_id = get_option( 'page_on_front' );
		$children = get_children( array("post_parent"=>$home_id,'post_type'=>'page','orderby' => 'menu_order ASC','order' => 'ASC') );
		$child_list = array();
		foreach ($children as $key => $value) {
			$thumbnail = get_post_thumbnail_id($value->ID);
			array_push($child_list,
				array(
					"ID"=>$value->ID,
					"slug"=>$value->post_name,
					"title"=>$value->post_title,
					"content"=>$value->post_content,
					"excerpt"=>$value->post_excerpt,
					"section_foot"=>get_post_meta($value->ID,"section_foot",true),
					"thumbnail" => getThumbnail($thumbnail)
					)
				);
		}
		return $child_list;
	}

	function home_children_menu(){
		$home_id = get_option( 'page_on_front' );
		$children = get_children( array("post_parent"=>$home_id,'post_type'=>'page','orderby' => 'menu_order ASC','order' => 'ASC') );
		$child_list = array();
		foreach ($children as $key => $value) {
		 if($value->post_name != 'slideshow'){//rude hack
			if(get_post_meta($value->ID,"redirect",true)){
				$href=get_post_meta($value->ID,"redirect",true);
				$target=' target="_blank"';
            } else if(!is_front_page()) {
                $href = get_home_url()."/#".$value->post_name;
                $target="";
            } else {
				$href = "#".$value->post_name;
				$target="";
			}

          
			print '<li><a class="section-scroll" onclick="closeMenu()" href="'.$href.'"'.$target.'><span>'.$value->post_title.'</a>';// if printed, shows this.
            }
		}
	}


	function get_parent_children($parent_id){
		$children = get_children( array("post_parent"=>$parent_id,'post_type'=>'page','orderby' => 'menu_order ASC','order' => 'ASC') );
		$child_list = array();
		foreach ($children as $key => $value) {
			array_push($child_list,$value);
			
		}
		return $child_list;
    }
    function get_menu_slug($menu_name){
		return	get_term_by('name',$menu_name,'nav_menu')->slug;
	}
    function linkThis($url,$label,$blank_target=true){
        $target = '';  
        $absolute = '';
        if($blank_target == true){
          $target = 'target="_blank"';
        }
        
        if($url != ''){
          return '<a href="'. $absolute.$url.'" '.$target.'>'.$label.'</a>';
        } 
	  }
	  function isSelected($id,$match){
		$selected = '';
		if($id == $match){
			$selected = ' selected';
		}
		return $selected;
	  }


	function getButtonProperties($post){
		return array(
			"id"=>$post->ID,
			"title"=>$post->post_title,
			"content"=>do_blocks($post->post_content),
			"color"=>get_post_meta($post->ID,"color",true),
			"fill"=>get_post_meta($post->ID,"fill",true),
			"stroke"=>get_post_meta($post->ID,"stroke",true),
			"lines_l"=>get_post_meta($post->ID,"lines_l",true),
			"lines_p"=>get_post_meta($post->ID,"lines_p",true)

		);
	}  
	function getNavProperties($post){

		
		$nav_meta = array(
			"CENTER" => getButtonProperties(get_post($post['ID']))
		);
		$children = get_parent_children($post['ID']);
		foreach ($children as $key => $value) {
			$nav_meta[strtoupper($value->post_name)] = getButtonProperties($value);
		}




		return json_encode($nav_meta);
	}
	function get_menu_array($current_menu='Main Menu') {

		$menu_array = wp_get_nav_menu_items($current_menu);
	
		$menu = array();

		foreach ($menu_array as $m) {
		//	
			if (empty($m->menu_item_parent)) { // HACK CHECK HERE TO MAKE SURE THIS DOESN"T FUCK SOMETHING UP
			//	var_dump("attr_title",$m->attr_title);
				$post = get_post($m->object_id);
				$meta = get_post_meta($m->object_id);
				$url = parse_url($m->url);
				$menu[$m->ID] = array();
	
				$menu[$m->ID]['ID'] = $m->ID;
				$menu[$m->ID]['title'] = $m->title;
				$menu[$m->ID]['content'] = $post->post_content;
				$menu[$m->ID]['slug'] = $post->post_name;
				$menu[$m->ID]['parent'] = $m->menu_item_parent;
				$menu[$m->ID]['attr'] = $m->attr_title;
				$menu[$m->ID]['url'] = @$url['path'];
				$menu[$m->ID]['classes'] = $m->classes;
				$menu[$m->ID]['description'] = $m->description;//coords
				$menu[$m->ID]['coords'] = $m->_coords;
				$menu[$m->ID]['confirmation_status'] = $m->_confirmation_status;
				$menu[$m->ID]['point_of_contact'] = $m->_point_of_contact;
				$menu[$m->ID]['notes'] = $m->_notes;
				$menu[$m->ID]['guest_type'] = @$_m->guest_type;
				$menu[$m->ID]['event_type'] = @$_m->event_type;

				$menu[$m->ID]['post'] = $post;
				$menu[$m->ID]['post_type'] = $m->object;
				$menu[$m->ID]['meta'] = $meta;
				$menu[$m->ID]['thumbnail'] = getThumbnail(@$menu[$m->ID]['meta']['_thumbnail_id']);
				
				//$menu[$m->ID]['embed_video_url'] = get_post_meta($m->ID,"embed_video_url",true);
				$menu[$m->ID]['children'] = populate_children($menu_array, $m);
			}
		}

		;
	return $menu;
	
	}
	function populate_children($menu_array, $menu_item){
		$children = array();
		if (!empty($menu_array)){
			foreach ($menu_array as $k=>$m) {
				if ($m->menu_item_parent == $menu_item->ID) {
					$post = get_post($m->object_id);
					$meta = get_post_meta($m->object_id);
					$url = parse_url($m->url);
					$children[$m->ID] = array();
					$children[$m->ID]['ID'] = $m->ID;
					$children[$m->ID]['title'] = $m->title;
					$children[$m->ID]['content'] = $m->content;
					$children[$m->ID]['attr_title'] = $m->attr_title;
					$children[$m->ID]['url'] = @$url['path'];
					$children[$m->ID]['slug'] = $post->post_name;
					$children[$m->ID]['parent'] = $m->menu_item_parent;
					
					$children[$m->ID]['coords'] = $m->_coords;
					$children[$m->ID]['confirmation_status'] = $m->_confirmation_status;
					$children[$m->ID]['point_of_contact'] = $m->_point_of_contact;
					$children[$m->ID]['guest_type'] = @$m->_guest_type;
					$children[$m->ID]['event_type'] = @$m->_event_type;

					$children[$m->ID]['notes'] = $m->_notes;

					$children[$m->ID]['classes'] = $m->classes;
					//$children[$m->ID]['embed_video_url'] = get_post_meta($m->ID,"embed_video_url",true);
				
					
					$children[$m->ID]['post'] = $post;
					$children[$m->ID]['post_type'] = $m->object;
					
					$children[$m->ID]['meta'] = $meta;
					$children[$m->ID]['thumbnail'] = getThumbnail(@$menu[$m->ID]['meta']['_thumbnail_id']);
					unset($menu_array[$k]);
					$children[$m->ID]['children'] = populate_children($menu_array, $m);


				}
			}
		};
		return $children;
	}
/**
* Add custom fields to menu item
*
* This will allow us to play nicely with any other plugin that is adding the same hook
*
* @param  int $item_id 
* @params obj $item - the menu item
* @params array $args
*/
function kia_custom_fields_coords( $item_id, $item ) {

	wp_nonce_field( '_coords_nonce', '_coords_nonce_name' );
	$_coords = get_post_meta( $item_id, '_coords', true );
	?>
	<div class="field-_coords description-wide" style="margin: 5px 0;">
	    <span class="description"><?php _e( "Coordinates", 'coordinates' ); ?></span>
	    <br />

	    <input type="hidden" class="nav-menu-id" value="<?php echo $item_id ;?>" />

	    <div class="logged-input-holder">
	        <input type="text" name="_coords[<?php echo $item_id ;?>]" id="custom-menu-meta-for-<?php echo $item_id ;?>" size="40" value="<?php echo esc_attr( $_coords ); ?>" />
	      
	    </div>

	</div>

	<?php
}
add_action( 'wp_nav_menu_item_custom_fields', 'kia_custom_fields_coords', 10, 2 );

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
add_action( 'wp_update_nav_menu_item', 'kia_nav_update_coords', 10, 2 );



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
add_filter( 'nav_menu_item_title', 'kia_custom_menu_title_coords', 10, 2 );






/*

	CUSTOM MENU META: guest_type


*/



function kia_custom_fields_guest_type( $item_id, $item,$label ) {

		
	if($item->object == 'profile'){

wp_nonce_field( '_guest_type_nonce', '_guest_type_nonce_name' );
$_guest_type = get_post_meta( $item_id, '_guest_type', true );
?>
<div class="field-_guest_type description-wide" style="margin: 5px 0;">
<span class="description"><?php _e( "Guest Type", 'guest_type' ); ?></span>
<br />

<input type="hidden" class="nav-menu-id" value="<?php echo $item_id ;?>" />

<div class="logged-input-holder">
<!-- -->


<select size="7" name="_guest_type[<?php echo $item_id ;?>]" id="custom-menu-meta-for-<?php echo $item_id ;?>">
<option value=""<?=selectedOption("",esc_attr($_guest_type ))?>></option>
		<option value="moderator"<?=selectedOption("moderator",esc_attr($_guest_type ))?>>Moderator</option>
		<option value="panelist"<?=selectedOption("panelist",esc_attr($_guest_type ))?>>Panelist</option>
		<option value="presenter"<?=selectedOption("presenter",esc_attr($_guest_type ))?>>Presenter</option>
		<option value="interviewee"<?=selectedOption("interviewee",esc_attr($_guest_type ))?>>Interviewee</option>
		<option value="host"<?=selectedOption("host",esc_attr($_guest_type ))?>>Host</option>
		<option value="co-host"<?=selectedOption("co-host",esc_attr($_guest_type ))?>>Co-Host</option>


		<option value="award-presenter"<?=selectedOption("award-presenter",esc_attr($_guest_type ))?>>Award-Presenter</option>

		<option value="nominee"<?=selectedOption("nominee",esc_attr($_guest_type ))?>>Nominee</option>
		
		


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


<select size="7" name="_event_type[<?php echo $item_id ;?>]" id="custom-menu-meta-for-<?php echo $item_id ;?>">
<option value=""<?=selectedOption("",esc_attr($_event_type ))?>></option>
		<option value="summit"<?=selectedOption("summit",esc_attr($_event_type ))?>>Summit</option>
		<option value="panel"<?=selectedOption("panel",esc_attr($_event_type ))?>>Panel</option>
		<option value="presentation"<?=selectedOption("presentation",esc_attr($_event_type ))?>>Presentation</option>
		<option value="interview"<?=selectedOption("interview",esc_attr($_event_type ))?>>Interview</option>
		<option value="case-study"<?=selectedOption("case-study",esc_attr($_event_type ))?>>Case Study</option>
	
	
		<option value="award-presentation"<?=selectedOption("award-presentation",esc_attr($_event_type ))?>>Award Presentation</option>
		<option value="special-feature"<?=selectedOption("special-feature",esc_attr($_event_type ))?>>Special Feature</option>
		<option value="keynote"<?=selectedOption("keynote",esc_attr($_event_type ))?>>Keynote</option>
		<option value="welcome"<?=selectedOption("welcome",esc_attr($_event_type ))?>>Welcome</option>
	


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


add_action( 'wp_nav_menu_item_custom_fields', 'kia_custom_fields_event_type', 10,3);
add_action( 'wp_update_nav_menu_item', 'kia_nav_update_event_type', 10, 2 );
add_filter( 'nav_menu_item_title', 'kia_custom_menu_title_event_type', 10, 2 );





/*

	CUSTOM MENU META: confirmation_status


*/








	function kia_custom_fields_confirmation_status( $item_id, $item,$label ) {

		if($item->object == 'event'){
			
			?>

			<hr>
			<a target="_new" style="font-size:125%;font-weight:bold;" href="/wp-admin/post.php?action=edit&post=<?=$item->object_id?>">Edit <?=$item->type_label?> <?=$item->title?></a>
		</hr>
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
					
			
				<select size="10" name="_confirmation_status[<?php echo $item_id ;?>]" id="custom-menu-meta-for-<?php echo $item_id ;?>">
				<option value=""<?=selectedOption("",esc_attr($_confirmation_status ))?>></option>
				<option value="needs-invite"<?=selectedOption("needs-invite",esc_attr($_confirmation_status ))?>>Needs Invitation</option>
			
							<option value="team"<?=selectedOption("team",esc_attr($_confirmation_status ))?>>Team</option>
							<option value="invited"<?=selectedOption("invited",esc_attr($_confirmation_status ))?>>Invited</option>
							<option value="agreed"<?=selectedOption("agreed",esc_attr($_confirmation_status ))?>>Agreed</option>
							<option value="agreed-with-conditions"<?=selectedOption("-with-condition",esc_attr($_confirmation_status ))?>>Agreed With Conditions</option>
							
							<option value="registered" <?=selectedOption("registered",esc_attr($_confirmation_status ))?>>Registration Complete</option>
							<option value="registered-no-release" <?=selectedOption("registered-no-release",esc_attr($_confirmation_status ))?>>Registered No Release</option>
							<option value="calendar-sent" <?=selectedOption("calendar-sent",esc_attr($_confirmation_status ))?>>Calendar Sent</option>
							<option value="calendar-sent-no-registration" <?=selectedOption("calendar-sent-no-release",esc_attr($_confirmation_status ))?>>Calendar Sent No Release</option>

							<option value="calendar-sent-no-registration" <?=selectedOption("calendar-sent-no-registration",esc_attr($_confirmation_status ))?>>Calendar Sent No Registration</option>

							<option value="confirmed-no-registration" <?=selectedOption("confirmed-no-registration",esc_attr($_confirmation_status ))?>>Confirmed Calendar No Registration</option>

							<option value="calendar-sent-no-release" <?=selectedOption("calendar-sent-no-release",esc_attr($_confirmation_status ))?>>Calendar Sent No Release</option>
							<option value="confirmed-no-release" <?=selectedOption("confirmed-no-release",esc_attr($_confirmation_status ))?>>Confirmed Calendar No Release</option>



							<option value="prerecord" <?=selectedOption("prerecord",esc_attr($_confirmation_status ))?>>Session Prerecorded</option>
							<option value="complete" <?=selectedOption("complete",esc_attr($_confirmation_status ))?>>Confirmed and Complete</option>


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


add_action( 'wp_nav_menu_item_custom_fields', 'kia_custom_fields_notes', 10,3);
add_action( 'wp_update_nav_menu_item', 'kia_nav_update_notes', 10, 2 );
add_filter( 'nav_menu_item_title', 'kia_custom_menu_title_notes', 10, 2 );









?>