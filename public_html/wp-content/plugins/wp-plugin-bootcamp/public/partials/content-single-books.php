<?php
/**
 * The template for displays books content
 *
 * Used for books-single
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="book-header">
        <?php  the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    </header><!-- .entry-header -->

    <div class="book-wrapper">
        <div class="book-meta">
            <div class="book-image" style="border-color: <?php echo WP_Plugin_BootCamp::get_option('book_color');?>">
                <?php the_post_thumbnail(); ?>
            </div><!-- .post-thumbnail -->
            <div class="book-details">
                <strong>Genres:</strong> <?php the_terms($post->ID,'genres');?><br/>
                <strong>Author:</strong> <?php echo get_post_meta( get_the_ID(), '_wppb_author', true ); ?><br/>
                <strong>Purchase:</strong> <a href="<?php echo get_post_meta(get_the_ID(),'_wppb_amazon', true);?>" title="Amazon">Amazon</a>
            </div>
        </div>


        <div class="book-content">
            <?php
            /* translators: %s: Name of current post */
            the_content( );

            ?>
        </div><!-- .entry-content -->
    </div>

</article><!-- #post-## -->
