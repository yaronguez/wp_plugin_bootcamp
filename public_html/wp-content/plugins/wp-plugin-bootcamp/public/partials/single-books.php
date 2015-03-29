<?php
/**
 * The template for displaying all single books
 *
 * @package WP_Plugin_BootCamp
 * @since WP Plugin BootCamp 1.0
 */

get_header(); ?>
<style type="text/css">
    <?php echo WP_Plugin_BootCamp::get_option('custom_css');?>
</style>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php
        // Start the loop.
        while ( have_posts() ) : the_post();


            WP_Plugin_BootCamp::get_template_part( 'content', 'single-books' );

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

            // Previous/next post navigation.
            the_post_navigation( array(
                'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'twentyfifteen' ) . '</span> ' .
                    '<span class="screen-reader-text">' . __( 'Next book:', 'twentyfifteen' ) . '</span> ' .
                    '<span class="post-title">%title</span>',
                'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'twentyfifteen' ) . '</span> ' .
                    '<span class="screen-reader-text">' . __( 'Previous book:', 'twentyfifteen' ) . '</span> ' .
                    '<span class="post-title">%title</span>',
            ) );

            // End the loop.
        endwhile;
        ?>

    </main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
