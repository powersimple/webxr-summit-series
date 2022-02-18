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
			if (empty($m->menu_item_parent)) {
			
				$post = get_post($m->object_id);
				$meta = get_post_meta($m->object_id);
				$menu[$m->ID] = array();
	
				$menu[$m->ID]['ID'] = $m->ID;
				$menu[$m->ID]['title'] = $m->title;
				$menu[$m->ID]['content'] = $post->post_content;
				
				$menu[$m->ID]['slug'] = $post->post_name;
				
				$menu[$m->ID]['url'] = $m->url;
				$menu[$m->ID]['classes'] = $m->classes;
				$menu[$m->ID]['description'] = $m->description;//coords
				$menu[$m->ID]['coords'] = $m->_coords;
				$menu[$m->ID]['duration'] = $m->_duration;
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
					
					$children[$m->ID] = array();
					$children[$m->ID]['ID'] = $m->ID;
					$children[$m->ID]['title'] = $m->title;
					$children[$m->ID]['content'] = $m->content;
					
					$children[$m->ID]['url'] = $m->url;
					$children[$m->ID]['slug'] = $post->post_name;
					$children[$m->ID]['coords'] = $m->_coords;
					$children[$m->ID]['duration'] = $m->_duration;
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














function kia_custom_fields_duration( $item_id, $item ) {

	wp_nonce_field( '_duration_nonce', '_duration_nonce_name' );
	$_duration = get_post_meta( $item_id, '_duration', true );
	?>
	<div class="field-_duration description-wide" style="margin: 5px 0;">
	    <span class="description"><?php _e( "Duration", 'coordinates' ); ?></span>
	    <br />

	    <input type="hidden" class="nav-menu-id" value="<?php echo $item_id ;?>" />

	    <div class="logged-input-holder">
	        <input type="text" name="_duration[<?php echo $item_id ;?>]" id="custom-menu-meta-for-<?php echo $item_id ;?>" size="40" value="<?php echo esc_attr( $_duration ); ?>" />
	      
	    </div>

	</div>

	<?php
}
add_action( 'wp_nav_menu_item_custom_fields', 'kia_custom_fields_duration', 10, 2 );

/**
* COORDINATESave the menu item meta
* 
* @param int $menu_id
* @param int $menu_item_db_id	
*/
function kia_nav_update_duration( $menu_id, $menu_item_db_id ) {

	// Verify this came from our screen and with proper authorization.
	if ( ! isset( $_POST['_duration_nonce_name'] ) || ! wp_verify_nonce( $_POST['_duration_nonce_name'], '_duration_nonce' ) ) {
		return $menu_id;
	}

	if ( isset( $_POST['_duration'][$menu_item_db_id]  ) ) {
		$sanitized_data = $_POST['_duration'][$menu_item_db_id];
		update_post_meta( $menu_item_db_id, '_duration', $sanitized_data );
	} else {
		delete_post_meta( $menu_item_db_id, '_duration' );
	}
}
add_action( 'wp_update_nav_menu_item', 'kia_nav_update_duration', 10, 2 );



/**
* Displays text on the front-end.
*
* @param string   $title The menu item's title.
* @param WP_Post  $item  The current menu item.
* @return string      
*/
function kia_custom_menu_title_duration( $title, $item ) {

	if( is_object( $item ) && isset( $item->ID ) ) {

		$_duration = get_post_meta( $item->ID, '_duration', true );

		if ( ! empty( $_duration ) ) {
			$title .= ' - ' . $_duration;
		}
	}
	return $title;
}
add_filter( 'nav_menu_item_title', 'kia_custom_menu_title_duration', 10, 2 );















?>