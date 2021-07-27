<?php
/*
Plugin Name: Restrict Page Access
Plugin URI: https://gist.github.com/1338673
Description: Allows administrators to give editors permission to edit only certain posts
Author: Christopher Davis
Author URI: http://christopherdavis.me
License: GPL2
*/

add_action( 'edit_user_profile', 'xrc_user_user_profile' );
/**
 * Adds an additional multi select on user profile pages
 */
function xrc_user_user_profile( $user )
{
    // only show this on editor pages
    if( ! in_array( 'editor', $user->roles ) ) return;
    
    // get the pages.
    $pages = get_posts(
        array(
            'post_type'     => 'profile',
            'numberposts'   => -1,
            'post_status'   => 'any',
            'orderby' => 'post_title',
            'order' => 'asc'
            
        )
    );
    
    // Bail if we don't have pages.
    if( ! $pages ) return;
    
    // Which pages can our user edit?
    $allowed = get_user_meta( $user->ID, 'xrc_user_pages', true );
    if( ! is_array( $allowed ) || empty( $allowed ) ) $allowed = array();
    
    // nonce-i-fy things
    wp_nonce_field( 'xrc_user_nonce', 'xrc_user_nonce' );
    
    // section heading...
    echo '<h3>' . __( 'Grant this User permission to edit...' ) . '</h3>';
    echo '<select multiple="multiple" name="xrc_user[]">';
    echo '<option value="0">None</option>';
    foreach( $pages as $p )
    {
        // for use in checked() later...
        $selected = in_array( $p->ID, $allowed ) ? 'on' : 'off';
        echo '<option ' . selected( 'on', $selected, false ) . ' value="' . esc_attr( $p->ID ) . '">' . esc_html( $p->post_title ) . '</option>';
    }
    echo '</select>';
}

add_action( 'edit_user_profile_update', 'xrc_user_user_save' );
/**
 * Saves the newly added multi select box that restricts posts
 */
function xrc_user_user_save( $user_id )
{
    // verify our nonce
    if( ! isset( $_POST['xrc_user_nonce'] ) || ! wp_verify_nonce( $_POST['xrc_user_nonce'], 'xrc_user_nonce' ) )
        return;
        
    // make sure our fields are set
    if( ! isset( $_POST['xrc_user'] ) ) 
        return;
        
    $save = array();
    foreach( $_POST['xrc_user'] as $p )
    {
        $save[] = absint( $p );
    }
    update_user_meta( $user_id, 'xrc_user_pages', $save );
}

add_action( 'load-post.php', 'xrc_user_kill_edit' );
/**
 * Don't allow users to load just any page for editing
 */
function xrc_user_kill_edit()
{
    $post_id = isset( $_REQUEST['post'] ) ? absint( $_REQUEST['post'] ) : 0;
    if( ! $post_id ) return;
    
    // bail if this isn't a page
    if( 'page' !== get_post_type( $post_id ) ) return;
    
    $user = wp_get_current_user();
    
    // If the user is an admin, bail.
    if( in_array( 'administrator', $user->roles ) ) return;
    
    $allowed = get_user_meta( $user->ID, 'xrc_user_pages', true );
    if( ! is_array( $allowed ) || empty( $allowed ) ) $allowed = array();
    
    // if the user can't edit this page, stop the loading...
    if( ! in_array( $post_id, $allowed ) )
    {
        wp_die( 
            __( 'User cannot edit this page' ),
            __( "You can't edit this post" ),
            array( 'response' => 403 )
        );
    }
}

add_action( 'pre_post_update', 'xrc_user_stop_update' );
/**
 * Prevents users without permission from updating pages
 */
function xrc_user_stop_update( $post_id )
{
    // not a page? bail.
    if( 'page' !== get_post_type( $post_id ) ) return;
    
    $user = wp_get_current_user();
    
    // not an editor?  bail.
    if( in_array( 'administrator', $user->roles ) ) return;
    
    $allowed = get_user_meta( $user->ID, 'xrc_user_pages', true );
    if( ! is_array( $allowed ) || empty( $allowed ) ) $allowed = array();
    
    if( ! in_array( $post_id, $allowed ) ) 
    {
        wp_die( 
            __( 'User cannot edit this page' ),
            __( "You can't edit this post" ),
            array( 'response' => 403 )
        );
    }
}

add_action( 'load-edit.php', 'xrc_user_load_edit' );
/**
 * Might add a filter to the `parse_query` if a user lands on the page
 * list table and their roll is anything but administrator
 */
function xrc_user_load_edit()
{
    $user = wp_get_current_user();
    
    // allow admins to see everything
    if( in_array( 'administrator', $user->roles ) ) return;
    
    $post_type = isset( $_GET['post_type'] ) ? $_GET['post_type'] : 'post';
    
    if( 'page' != $post_type ) return;
    
    add_filter( 'parse_query', 'xrc_user_parse_query' );
}

/**
 * Filters page list to include only pages users can edit
 */
function xrc_user_parse_query( $wp )
{
    $user = wp_get_current_user();
    $pages = get_user_meta( $user->ID, 'xrc_user_pages', true );
    if( empty( $pages ) || ! is_array( $pages ) ) $pages = array();
    $wp->query_vars['post__in'] = $pages;
}