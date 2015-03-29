<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    WP_Plugin_BootCamp
 * @subpackage WP_Plugin_BootCamp/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    WP_Plugin_BootCamp
 * @subpackage WP_Plugin_BootCamp/includes
 * @author     Yaron Guez <yaron@trestian.com>
 */
class WP_Plugin_BootCamp {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      WP_Plugin_BootCamp_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'wp-plugin-bootcamp';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - WP_Plugin_BootCamp_Loader. Orchestrates the hooks of the plugin.
	 * - WP_Plugin_BootCamp_i18n. Defines internationalization functionality.
	 * - WP_Plugin_BootCamp_Admin. Defines all hooks for the admin area.
	 * - WP_Plugin_BootCamp_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wp-plugin-bootcamp-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wp-plugin-bootcamp-i18n.php';

		/** ADMIN CLASSES **/
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wp-plugin-bootcamp-metaboxes.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-wp-plugin-bootcamp-settings.php';

        /** PUBLIC CLASSES */

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-wp-plugin-bootcamp-scripts.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-wp-plugin-bootcamp-post-types.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-wp-plugin-bootcamp-shortcodes.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-wp-plugin-bootcamp-routing.php';

        /**
         * Load CMB2 class
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/cmb2/init.php';

        /**
         * Load CMB2 Admin Settings class
         */


		$this->loader = new WP_Plugin_BootCamp_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the WP_Plugin_BootCamp_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new WP_Plugin_BootCamp_i18n();
		$plugin_i18n->set_domain( $this->get_plugin_name() );

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_metaboxes = new WP_Plugin_BootCamp_Metaboxes( $this->get_plugin_name(), $this->get_version() );
        $plugin_settings = WP_Plugin_BootCamp_Settings::get_instance();

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_metaboxes, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_metaboxes, 'enqueue_scripts' );
        $this->loader->add_action('cmb2_init', $plugin_metaboxes, 'register_metaboxes');

        $this->loader->add_action( 'admin_init', $plugin_settings, 'init' );
        $this->loader->add_action( 'admin_menu', $plugin_settings, 'add_options_page' );
        $this->loader->add_action( 'cmb2_init', $plugin_settings, 'add_options_page_metabox' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_scripts = new WP_Plugin_BootCamp_Scripts( $this->get_plugin_name(), $this->get_version() );
        $plugin_post_types = new WP_Plugin_BootCamp_Post_Types( $this->get_plugin_name(), $this->get_version() );
        $plugin_shortcodes = new WP_Plugin_BootCamp_Shortcodes( $this->get_plugin_name(), $this->get_version() );
        $plugin_routing = new WP_Plugin_BootCamp_Routing( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_scripts, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_scripts, 'enqueue_scripts' );
        $this->loader->add_action('init', $plugin_post_types, 'register_post_types');
        $this->loader->add_action('init', $plugin_post_types, 'register_taxonomies');
        $this->loader->add_action('init', $plugin_shortcodes, 'register_shortcodes');
        $this->loader->add_filter('single_template', $plugin_routing, 'single_template'); // Load custom single template for books
        $this->loader->add_filter('archive_template', $plugin_routing, 'archive_template'); // Load custom archive template for books

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    WP_Plugin_BootCamp_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

    /**
     * STATIC HELPER FUNCTIONS
     * */

    public static function get_option($option){
        return cmb2_get_option('wppb_options',$option);
    }

    /**
     * Get template part if exists in theme, or from partials otherwise.
     * @param $slug
     * @param null $name
     */
    public static function get_template_part($slug, $name = null){
        $template = '';

        // Name provided
        if ( $name ) {
            // Check theme folder
            $template = locate_template( array( "{$slug}-{$name}.php" ) );
            if(! $template && file_exists(plugin_dir_path(dirname( __FILE__ )) . "/public/partials/{$slug}-{$name}.php")){
                // Use partials version
                $template = plugin_dir_path(dirname( __FILE__ )) . "/public/partials/{$slug}-{$name}.php";
            }
        } else {
            // Check theme folder
            $template = locate_template(array("{$slug}.php"));
            if(! $template && file_exists(plugin_dir_path(dirname( __FILE__ )) . "/public/partials/{$slug}.php")){
                // Use partials version
                $template = plugin_dir_path(dirname( __FILE__ )) . "/public/partials/{$slug}.php";
            }
        }

        if ( $template ) {
            load_template( $template, false );
        }
    }


}
