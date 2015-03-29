<?php

/**
 * Create Genre Taxonomy
 * @since 1.0.0
 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
 */

// Setup taxonomies
function wppb_setup_taxonomies() {
    $labels = array(
        'name' => _x( 'Genres', 'genres' ),
        'singular_name' => _x( 'Genre', 'genres' ),
        'search_items' => _x( 'Search Genres', 'genres' ),
        'popular_items' => _x( 'Popular Genres', 'genres' ),
        'all_items' => _x( 'All Genres', 'genres' ),
        'parent_item' => _x( 'Parent Genre', 'genres' ),
        'parent_item_colon' => _x( 'Parent Genre:', 'genres' ),
        'edit_item' => _x( 'Edit Genre', 'genres' ),
        'update_item' => _x( 'Update Genre', 'genres' ),
        'add_new_item' => _x( 'Add New Genre', 'genres' ),
        'new_item_name' => _x( 'New Genre', 'genres' ),
        'separate_items_with_commas' => _x( 'Separate genres with commas', 'genres' ),
        'add_or_remove_items' => _x( 'Add or remove genres', 'genres' ),
        'choose_from_most_used' => _x( 'Choose from the most used genres', 'genres' ),
        'menu_name' => _x( 'Genres', 'genres' ),
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => false,
        'show_admin_column' => true,
        'hierarchical' => true,
        'rewrite' => true,
        'query_var' => true
    );
    register_taxonomy( 'genres', array('books'), $args );
}
add_action( 'init', 'wppb_setup_taxonomies' );