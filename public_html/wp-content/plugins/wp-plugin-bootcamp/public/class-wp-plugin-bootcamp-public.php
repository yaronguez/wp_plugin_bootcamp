<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    WP_Plugin_BootCamp
 * @subpackage WP_Plugin_BootCamp/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    WP_Plugin_BootCamp
 * @subpackage WP_Plugin_BootCamp/public
 * @author     Yaron Guez <yaron@trestian.com>
 */
class WP_Plugin_BootCamp_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in WP_Plugin_BootCamp_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The WP_Plugin_BootCamp_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-plugin-bootcamp-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in WP_Plugin_BootCamp_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The WP_Plugin_BootCamp_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-plugin-bootcamp-public.js', array( 'jquery' ), $this->version, false );

	}

    /**
     * Register post types
     */
    public function register_post_types(){
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

    /**
     * Register Taxonomies
     */
    public function register_taxonomies(){
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

    /**
     * Display Book Shortcode
     * @param $atts
     * @return string|void
     */
    public function display_book_shortcode( $atts ) {
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

    public function register_shortcodes(){
        add_shortcode( 'display_book', array($this, 'display_book_shortcode' ));
    }

    /**
     * Override the single template for transcription jobs
     * @param $single_template
     * @return string
     */
    public function single_template($single_template)
    {
        global $post;

        if ($post->post_type == 'books') {
            if(file_exists(get_stylesheet_directory() . '/single-books.php')) {
                $single_template = get_stylesheet_directory() . '/single-books.php';
            }
            else{
                $single_template = dirname( __FILE__ ) . '/partials/single-books.php';
            }
        }
        return $single_template;
    }

    /**
     * Override the archive template for transcription jobs
     * @param $archive_template
     * @return string
     */
    public function archive_template($archive_template)
    {
        global $post;

        if ( is_post_type_archive ( 'books' ) ) {
            if(file_exists(get_stylesheet_directory() . '/archive-books.php')){
                $archive_template = get_stylesheet_directory() . '/archive-books.php';
            }
            else{
                $archive_template = dirname( __FILE__ ) . '/partials/archive-books.php';
            }
        }
        else if(is_tax('genres')){
            if(file_exists(get_stylesheet_directory() . '/taxonomy-genres.php')){
                $archive_template = get_stylesheet_directory() . '/taxonomy-genres.php';
            }
            else{
                $archive_template = dirname( __FILE__ ) . '/partials/taxonomy-genres.php';
            }
        }
        return $archive_template;
    }

}
