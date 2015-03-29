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
class WP_Plugin_BootCamp_Routing {

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
