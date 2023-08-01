<?php
/**
 * Check and setup theme's default settings
 *
 * @package _bluetick
 *
 */

if ( ! function_exists( 'setup_theme_default_settings' ) ) :
	function setup_theme_default_settings() {

		// check if settings are set, if not set defaults.
		// Caution: DO NOT check existence using === always check with == .
		// Latest blog posts style.
		$_bluetick_posts_index_style = get_theme_mod( '_bluetick_posts_index_style' );
		if ( '' == $_bluetick_posts_index_style ) {
			set_theme_mod( '_bluetick_posts_index_style', 'default' );
		}

		// Sidebar position.
		$_bluetick_sidebar_position = get_theme_mod( '_bluetick_sidebar_position' );
		if ( '' == $_bluetick_sidebar_position ) {
			set_theme_mod( '_bluetick_sidebar_position', 'right' );
		}

		// Container width.
		$_bluetick_container_type = get_theme_mod( '_bluetick_container_type' );
		if ( '' == $_bluetick_container_type ) {
			set_theme_mod( '_bluetick_container_type', 'container' );
		}
	}
endif;
