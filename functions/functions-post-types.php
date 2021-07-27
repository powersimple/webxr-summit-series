<?php
add_action( 'init', 'projects_to_cpt' );
function projects_to_cpt() {
    $args = array(
      
        'label'=>"Social",
        'hierarchical'=>false,
        'public'       => true,
        'show_in_rest' => true,
        'show_ui'=>true,
        'label'        => 'project',
        'show_in_rest' => 'project',
        
    );
    register_post_type( 'project', $args );
}
//add_action( 'init', 'socials_to_cpt' );
function socials_to_cpt() {
    $args = array(
      'public'       => true,
      'show_in_rest' => true,
      'label'        => 'Social'
    );
    register_post_type( 'social', $args );
}

function getPostByCategory($cat,$post_type,$template){

    global $post;
    $args = array( 'category_name' => $cat, 'post_type'=>$post_type );
    $posts = get_posts( $args );
    // var_dump($posts);
    foreach( $posts as $post ){
        var_dump($post);
    }






}
//getPostByCategory("sponsor","profile","sponsor-footer");



?>