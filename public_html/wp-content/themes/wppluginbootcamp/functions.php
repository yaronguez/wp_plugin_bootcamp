<?php
// Load parent theme
function wppb_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}
add_action( 'wp_enqueue_scripts', 'wppb_theme_enqueue_styles' );

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


// Setup Custom fields
/**
 * Define the metabox and field configurations.
 */
function wppb_metaboxes() {

    // Start with an underscore to hide fields from custom fields list
    $prefix = '_wppb_';

    /**
     * Initiate the metabox
     */
    $cmb = new_cmb2_box( array(
        'id'            => 'book_details',
        'title'         => __( 'Book Details', 'wppb' ),
        'object_types'  => array( 'books', ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true // Show field names on the left
    ) );

    // Regular text field
    $cmb->add_field( array(
        'name'       => __( 'Author', 'wppb' ),
        'id'         => $prefix . 'author',
        'type'       => 'text'
    ) );

    $cmb->add_field( array(
        'name'  => __('Amazon Link', 'wppb'),
        'id'    => $prefix . 'amazon',
       'type'   => 'text_url'
    ));


}
add_action( 'cmb2_init', 'wppb_metaboxes' );

// Setup shortcode

function wppb_book_shortcode( $atts ) {
    $a = shortcode_atts( array(
        'slug' => false
    ), $atts );

    if($a['slug'] === false){
        return;
    }

    $query = new WP_Query(array(
        'post_type' => 'books',
        'name'=>$a['slug']
    ));

    if(!$query->have_posts()){
        return 'Book not found';
    }

    ob_start();
    while($query->have_posts()): $query->the_post();
        get_template_part( 'content', 'archive-books' );
    endwhile;

    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode( 'display_book', 'wppb_book_shortcode' );