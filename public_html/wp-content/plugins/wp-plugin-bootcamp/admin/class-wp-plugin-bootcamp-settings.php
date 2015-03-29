<?php
/**
 * CMB2 Theme Options
 * @version 0.1.0
 */
class WP_Plugin_BootCamp_Settings {
    /**
     * Instance of this class.
     */
    protected static $instance = null;

    /**
     * Option key, and option page slug
     * @var string
     */
    private $key = 'wppb_options';

    /**
     * Options page metabox id
     * @var string
     */
    private $metabox_id = 'wppb_option_metabox';

    /**
     * Options Page hook
     * @var string
     */
    protected $options_page = '';

    protected $title = 'Plugin BootCamp Settings';


    /**
     * Return an instance of this class.
     *
     * @since     1.0.0
     *
     * @return    Trestian_SOS    A single instance of this class.
     */
    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Register our setting to WP
     * @since  0.1.0
     */
    public function init() {
        register_setting( $this->key, $this->key );
    }

    /**
     * Add menu options page
     * @since 0.1.0
     */
    public function add_options_page() {
        $this->options_page = add_menu_page( $this->title, $this->title, 'manage_options', $this->key, array( $this, 'admin_page_display' ) );
    }

    /**
     * Admin page markup. Mostly handled by CMB2
     * @since  0.1.0
     */
    public function admin_page_display() {
        ?>
        <div class="wrap cmb2_options_page <?php echo $this->key; ?>">
            <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
            <?php cmb2_metabox_form( $this->metabox_id, $this->key ); ?>
        </div>
    <?php
    }

    /**
     * Add the options metabox to the array of metaboxes
     * @since  0.1.0
     */
    function add_options_page_metabox() {

        $cmb = new_cmb2_box( array(
            'id'      => $this->metabox_id,
            'hookup'  => false,
            'show_on' => array(
                // These are important, don't remove
                'key'   => 'options-page',
                'value' => array( $this->key, )
            ),
        ) );

        // Set our CMB2 fields

        $cmb->add_field( array(
            'name' => __( 'Custom CSS', 'myprefix' ),
            'desc' => __( 'Custom CSS for the Book Page', 'wppb' ),
            'id'   => 'custom_css',
            'type' => 'textarea'
        ) );

        $cmb->add_field( array(
            'name'    => __( 'Book Border Color', 'wppb' ),
            'desc'    => __( 'Choose the color for the book image border', 'wppb' ),
            'id'      => 'book_color',
            'type'    => 'colorpicker',
            'default' => '#bada55',
        ) );

    }

    /**
     * Public getter method for retrieving protected/private variables
     * @since  0.1.0
     * @param  string  $field Field to retrieve
     * @return mixed          Field value or exception is thrown
     */
    public function __get( $field ) {
        // Allowed fields to retrieve
        if ( in_array( $field, array( 'key', 'metabox_id', 'title', 'options_page' ), true ) ) {
            return $this->{$field};
        }

        throw new Exception( 'Invalid property: ' . $field );
    }

}