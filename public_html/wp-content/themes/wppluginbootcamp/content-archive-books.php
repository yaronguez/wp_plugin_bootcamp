<?php
/**
 * The template for displays books content in archive
 *
 * Used for books-archive.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="book-wrapper-archive">
        <div class="book-image">
            <a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_post_thumbnail('thumbnail'); ?></a>
        </div><!-- .post-thumbnail -->

        <div class="book-header-archive">
            <h2><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a></h2>
            <div class="book-details">
                 <?php the_terms($post->ID,'genres');?><br/>
                <strong>Author:</strong> <?php echo get_post_meta( get_the_ID(), '_wppb_author', true ); ?><br/>
                <strong>Purchase:</strong> <a href="<?php echo get_post_meta(get_the_ID(),'_wppb_amazon', true);?>" title="Amazon">Amazon</a>
            </div>
        </div>
    </div>
</article><!-- #post-## -->
