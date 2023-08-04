<?php
	function get_section_menu($section_menu){
		print "section menu";
		print $section_menu;

	}

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

	function get_menus_for_swap($term_id,$term_id2) {

		$rest_url = '/wp-json/wp/v2/menus?menus';

		$wp_menus = wp_get_nav_menus($args=['term_taxonomy_id'=>$term_id] );//BUG THIS RETURNS AN EXTRA COPY OF THE FIRST MENU FOR NO REASON
		
		$i = 0;
		$rest_menus = array();
		foreach ( $wp_menus as $wp_menu ) :

			$menu = (array) $wp_menu;
			
			
			$rest_menus[ $i ]                = $menu;
			$rest_menus[ $i ]['ID']          = $menu['term_id'];
			$rest_menus[ $i ]['name']        = $menu['name'];
			$rest_menus[ $i ]['slug']        = $menu['slug'];
			$rest_menus[ $i ]['description'] = $menu['description'];
			$rest_menus[ $i ]['count']       = $menu['count'];
			
/*
				hack to customize items to educe bloat
				This reduced menu json file size by more than 80%
			*/           
			$items = wp_get_nav_menu_items( $menu['term_id'] );
		   
			$custom_items = array();
			foreach($items as $key => $value){
				// this gets rid of the infernal and wasteful printing of the absolute path in a url for local.
				$url = str_replace("http:","",$value->url);
				$url = str_replace("https:","",$value->url);
				$url = str_replace(get_site_url(),"",$value->url);
				
				array_push($custom_items,
					array(
						"ID"=>$value->ID,
						"object"=>$value->object,
						"object_id"=>$value->object_id,
						"menu_item_parent"=>$value->menu_item_parent,
						"menu_order"=>$value->menu_order,
						"title"=>$value->title,
						"content"=>get_post( $value->object_id )->post_content,
						'attr' => $value->attr_title,
						"url"=>$url,
						"slug"=>sanitize_title($value->title),
						"coords" => $value->_coords,
						"offset" => $value->_offset,
						
					//    "confirmation_status" => $value->_confirmation_status,
						
						"post_parent" => $value->post_parent,
						"classes" => implode(" ",$value->classes),       
						"description" => $value->description,
						'target' => $value->target,
						'xfn' => $value->xfn,
						
						
						)
				);
			}
		  

			$rest_menus[$i]['items'] = $menu['term_id'] ? $custom_items : array();
			//hack to add items to menu call
		 //  $rest_menus[$i]['items'] = $menu['term_id'] ? wp_get_nav_menu_items( $menu['term_id'] ) : array();
			

			//commented out, because it's not necessary
		   // $rest_menus[ $i ]['meta']['links']['collection'] = $rest_url;
		   // $rest_menus[ $i ]['meta']['links']['self']       = $rest_url . $menu['term_id'];
			
			$i ++;
		endforeach;
		
		return apply_filters( 'rest_menus_format_menus', $rest_menus );
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
				$menu[$m->ID]['attr_title'] = $m->attr_title;
				$menu[$m->ID]['menu_type'] = $m->object;
				$menu[$m->ID]['url'] = @$url['path'];
				$menu[$m->ID]['classes'] = $m->classes;
				$menu[$m->ID]['description'] = $m->description;//coords
				$menu[$m->ID]['coords'] = $m->_coords;
				$menu[$m->ID]['offset'] = $m->_offset;
				
				$menu[$m->ID]['confirmation_status'] = $m->_confirmation_status;
				$menu[$m->ID]['event_length_seconds'] = $m->_event_length_seconds;
				
				$menu[$m->ID]['point_of_contact'] = $m->_point_of_contact;
				$menu[$m->ID]['notes'] = $m->_notes;
				$menu[$m->ID]['guest_type'] = @$_m->guest_type;
				$menu[$m->ID]['event_type'] = @$_m->event_type;
				$menu[$m->ID]['appearance_type'] = @$m->_appearance_type;

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
					$children[$m->ID]['menu_type'] = $m->object;
					$children[$m->ID]['url'] = @$url['path'];
					$children[$m->ID]['slug'] = $post->post_name;
					$children[$m->ID]['parent'] = $m->menu_item_parent;
					
					$children[$m->ID]['coords'] = $m->_coords;
					$children[$m->ID]['offset'] = $m->_offset;
					
					$children[$m->ID]['confirmation_status'] = $m->_confirmation_status;
					$children[$m->ID]['event_length_seconds'] = $m->_event_length_seconds;
	
					$children[$m->ID]['point_of_contact'] = $m->_point_of_contact;
					$children[$m->ID]['guest_type'] = @$m->_guest_type;
					$children[$m->ID]['event_type'] = @$m->_event_type;
					$children[$m->ID]['appearance_type'] = @$m->_appearance_type;
					

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


	