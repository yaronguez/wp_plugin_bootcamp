<?php

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