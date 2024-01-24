<?php
// Register Competitions Custom Post Type
function trpia_register_competitions_post_type() {
    $labels = array(
        'name'               => 'Competitions',
        'singular_name'      => 'Competition',
        'add_new'            => 'Add New Competition',
        'add_new_item'       => 'Add New Competition',
        'edit_item'          => 'Edit Competition',
        'new_item'           => 'New Competition',
        'all_items'          => 'All Competitions',
        'view_item'          => 'View Competition',
        'search_items'       => 'Search Competitions',
        'not_found'          => 'No competitions found',
        'not_found_in_trash' => 'No competitions found in Trash',
        'parent_item_colon'  => '',
        'menu_name'          => 'Competitions'
    );
  
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'competitions' ),
        'flush_rewrite_rules' => true, 
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon' => 'dashicons-star-filled',
        'supports'           => array( 'title', 'editor', 'thumbnail' )
    );
  
    register_post_type( 'competitions', $args );
}

add_action( 'init', 'trpia_register_competitions_post_type' );

// Register Entries Custom Post Type
function trpia_register_entries_post_type() {
    $labels = array(
        'name'               => 'Entries',
        'singular_name'      => 'Entry',
        'add_new'            => 'Add New Entry',
        'add_new_item'       => 'Add New Entry',
        'edit_item'          => 'Edit Entry',
        'new_item'           => 'New Entry',
        'all_items'          => 'All Entries',
        'view_item'          => 'View Entry',
        'search_items'       => 'Search Entries',
        'not_found'          => 'No entries found',
        'not_found_in_trash' => 'No entries found in Trash',
        'parent_item_colon'  => '',
        'menu_name'          => 'Entries'
    );
  
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'entries' ),
        'flush_rewrite_rules' => true, 
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon' => 'dashicons-clipboard',
        'supports'           => array( 'title', 'editor', 'thumbnail' )
    );
  
    register_post_type( 'entries', $args );
}

add_action( 'init', 'trpia_register_entries_post_type' );