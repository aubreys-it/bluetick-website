<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package _bluetick
 */

if ( ! function_exists( '_bluetick_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function _bluetick_posted_on($type = 0) {
	if ( 'post' === get_post_type() ) {		

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		//$time_string = get_the_date( 'Y-m-d \a\t h:i A' );
		//$time_string = get_the_date( 'g:ia F jS, Y' ); // 4:04pm April 1, 2018
		$time_string = get_the_date( 'g:ia' ); // 4:04pm
		// $time_string = sprintf( $time_string,
		// 	esc_attr( get_the_date( '' ) ),
		// 	esc_html( get_the_date() )
		// );	

		if($type == "standard")
		{		

			// $posted_on = sprintf(
			// 	esc_html_x( 'Posted at %s', 'post date', '_bluetick' ),
			// 	'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
			// );

			$categories_list = get_the_category_list( esc_html__( ', ', '_bluetick' ) );
			if ( $categories_list && _bluetick_categorized_blog() ) {
				$posted_on .= sprintf(
					'<span class="cat-links">' . esc_html_x( '%s', 'post date', '_bluetick' ) . '</span>',
					$categories_list.''
				);
			}

			/* translators: used between list items, there is a space after the comma */
			// $tags_list = get_the_tag_list( '', esc_html__( ', ', '_bluetick' ) );
			// if ( $tags_list ) {
			// 	$posted_on .= sprintf(
			// 		'<span class="tags-links">' . esc_html_x( ' %1$s', '_bluetick' ) . '</span>',
			// 		$tags_list
			// 	);
			// }
		}

		printf( '<span class="posted-on">' . $posted_on . '</span>');

		
	}
}
endif;

if ( ! function_exists( '_bluetick_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function _bluetick_entry_footer($type = 0) {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {		

		// $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		// if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		// 	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		// }
		// $time_string = sprintf( $time_string,
		// 	esc_attr( get_the_date( 'c' ) ),
		// 	esc_html( get_the_date() ),
		// 	esc_attr( get_the_modified_date( 'c' ) ),
		// 	esc_html( get_the_modified_date() )
		// );

		// /* translators: used between list items, there is a space after the comma */
		// $categories_list = get_the_category_list( esc_html__( ', ', '_bluetick' ) );
		// if ( $categories_list && _bluetick_categorized_blog() ) {
		// 	printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', '_bluetick' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		// }

		// if($type == "standard")
		// {
		// 	$posted_on = sprintf(
		// 		esc_html_x( 'on %s', 'post date', '_bluetick' ),
		// 		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		// 	);
		// }

		// printf( '<span class="posted-on">' . $posted_on . '</span>');

		// /* translators: used between list items, there is a space after the comma */
		// $tags_list = get_the_tag_list( '', esc_html__( ', ', '_bluetick' ) );
		// if ( $tags_list ) {
		// 	printf( '<span class="tags-links">' . esc_html__( 'About %1$s', '_bluetick' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		// }

		printf( '<span class="posted-on">' . $posted_on . '</span>');
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function _bluetick_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( '_bluetick_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );
		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );
		set_transient( '_bluetick_categories', $all_the_cool_cats );
	}
	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so components_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so components_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in _bluetick_categorized_blog.
 */
function _bluetick_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( '_bluetick_categories' );
}
add_action( 'edit_category', '_bluetick_category_transient_flusher' );
add_action( 'save_post',     '_bluetick_category_transient_flusher' );

