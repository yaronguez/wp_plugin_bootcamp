<?php
/**
 * The template for displaying books archive
 *
 * @package WP_Plugin_BootCamp
 * @since WP Plugin BootCamp 1.0
 */

get_header(); ?>

<section id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php if ( have_posts() ) : ?>

            <header class="page-header">
                <?php
                the_archive_title( '<h1 class="page-title">', '</h1>' );
                the_archive_description( '<div class="taxonomy-description">', '</div>' );
                ?>
            </header><!-- .page-header -->

            <?php
            // Start the Loop.
            while ( have_posts() ) : the_post();

                /*
                 * Include the Post-Format-specific template for the content.
                 * If you want to override this in a child theme, then include a file
                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                 */
                WP_Plugin_BootCamp::get_template_part( 'content', 'archive-books' );

                // End the loop.
            endwhile;

            // Previous/next page navigation.
            the_posts_pagination( array(
                'prev_text'          => __( 'Previous page', 'wpbc' ),
                'next_text'          => __( 'Next page', 'wpbc' ),
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'wpbc' ) . ' </span>',
            ) );

        // If no content, include the "No posts found" template.
        else :
            get_template_part( 'content', 'none' );

        endif;
        ?>

    </main><!-- .site-main -->
</section><!-- .content-area -->

<?php get_footer(); ?>
