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
class WP_Plugin_BootCamp_Shortcodes {

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
            WP_Plugin_BootCamp::get_template_part( 'content', 'archive-books' );
        endwhile;

        wp_reset_postdata();
        return ob_get_clean();
    }

    public function register_shortcodes(){
        add_shortcode( 'display_book', array($this, 'display_book_shortcode' ));
    }



}
