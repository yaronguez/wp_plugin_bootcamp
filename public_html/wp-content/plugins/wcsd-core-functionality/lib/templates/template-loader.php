<?php
/**
  * Override the single template for transcription jobs
  * @param $single_template
  * @return string
  */
function wcsd_book_single_template($single_template)
{
	global $post;
	if ($post->post_type == 'books') {
		if(file_exists(get_stylesheet_directory() . '/single-books.php')) {
			$single_template = get_stylesheet_directory() . '/single-books.php';
		}
		else{
			$single_template = dirname( __FILE__ ) . '/single-books.php';
		}
	}
	return $single_template;
}

add_filter('single_template', 'wcsd_book_single_template', 99);

/**
 * Override the archive template for transcription jobs
 * @param $archive_template
 * @return string
 */

 function wcsd_books_archive_template($archive_template)
    {
        global $post;
        if (is_post_type_archive('books')) {
            if (file_exists(get_stylesheet_directory() . '/archive-books.php')) {
                $archive_template = get_stylesheet_directory() . '/archive-books.php';
            } else {
                $archive_template = dirname( __FILE__ ) . '/archive-books.php';
            }
        } else if (is_tax('genres')) {
            if (file_exists(get_stylesheet_directory() . '/taxonomy-genres.php')) {
                $archive_template = get_stylesheet_directory() . '/taxonomy-genres.php';
            } else {
                $archive_template = dirname( __FILE__ ) . '/taxonomy-genres.php';
            }
        }
        return $archive_template;
    }

add_filter('archive_template', 'wcsd_books_archive_template', 99);