<?php

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
