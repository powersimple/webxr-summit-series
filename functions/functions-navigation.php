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

?>