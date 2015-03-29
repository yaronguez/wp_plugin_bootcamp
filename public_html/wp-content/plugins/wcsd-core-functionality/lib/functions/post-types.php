<?php
/**
 * Create Rotator post type
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */

// Set up post types
function wppb_setup_post_types(){
    $labels = array(
        'name' => _x( 'Books', 'books' ),
        'singular_name' => _x( 'Book', 'books' ),
        'add_new' => _x( 'Add New', 'books' ),
        'add_new_item' => _x( 'Add New Book', 'books' ),
        'edit_item' => _x( 'Edit Book', 'books' ),
        'new_item' => _x( 'New Book', 'books' ),
        'view_item' => _x( 'View Book', 'books' ),
        'search_items' => _x( 'Search Books', 'books' ),
        'not_found' => _x( 'No books found', 'books' ),
        'not_found_in_trash' => _x( 'No books found in Trash', 'books' ),
        'parent_item_colon' => _x( 'Parent Book:', 'books' ),
        'menu_name' => _x( 'Books', 'books' ),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', 'comments', 'revisions' ),
        'taxonomies' => array( 'genre' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
		'menu_icon' => 'dashicons-book-alt',
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );
    register_post_type( 'books', $args );
}
add_action( 'init', 'wppb_setup_post_types' );
