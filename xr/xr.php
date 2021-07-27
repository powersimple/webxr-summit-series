<?php
    function enqueue_xr_style() {
        //because without this, there is no site, at least not a coherent one.
        wp_enqueue_style( 'xr',get_stylesheet_directory_uri() . '/xr.css');
       /*
          wp_register_style('bootstrap', '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/css/bootstrap.min.css', null,'1.1', true); 
        wp_enqueue_style('bootstrap');
       */
   
    }
    add_action( 'wp_enqueue_scripts', 'enqueue_xr_style' );

    function enqueue_xr(){
         wp_enqueue_style( 'powersimple',get_stylesheet_directory_uri() . '/xr.css');
         wp_register_script('xr',get_stylesheet_directory_uri() . '/xr.js', array('jquery'),rand(100000,999999), true); 
     wp_enqueue_script('xr');
        }
    add_action( 'wp_enqueue_scripts', 'enqueue_xr' ); 
function my_async_scripts( $tag, $handle, $src ) {
    // the handles of the enqueued scripts we want to async
    $async_scripts = array( 'xr', 'another-script' );

    if ( in_array( $handle, $async_scripts ) ) {
        return '<script type="text/javascript" src="' . $src . '" type="module"></script>' . "\n";
    }

    return $tag;
}
add_filter( 'script_loader_tag', 'my_async_scripts', 10, 3 );

?>