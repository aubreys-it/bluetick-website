<?php
/**
 * Understrap functions and definitions
 *
 * @package _olea
 */

/**
 * Theme setup and custom theme supports.
 */
require get_template_directory() . '/inc/setup.php';

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Load functions to secure your WP install.
 */
require get_template_directory() . '/inc/security.php';

/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/enqueue.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/pagination.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/custom-comments.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load custom WordPress nav walker.
 */
require get_template_directory() . '/inc/bootstrap-wp-navwalker.php';

/**
 * Load WooCommerce functions.
 */
require get_template_directory() . '/inc/woocommerce.php';

/**
 * Load Editor functions.
 */
require get_template_directory() . '/inc/editor.php';

if( function_exists('acf_add_options_page') ) {
		
		acf_add_options_page(array(
			'page_title' 	=> 'Options',
			'menu_title'	=> 'Options',
			'menu_slug' 	=> 'options',
			'capability'	=> 'edit_posts',
			'redirect'	=> false
		));
		
//		acf_add_options_sub_page(array(
//			'page_title' 	=> 'Page 1',
//			'menu_title'	=> 'Page 1',
//			'parent_slug'	=> 'options',
//		));
//		
//		acf_add_options_sub_page(array(
//			'page_title' 	=> 'Page 2',
//			'menu_title'	=> 'Page 2',
//			'parent_slug'	=> 'options',
//		));
	
	}

// Include Global code
	require_once get_template_directory() . '/includes/functions/global.php';
    require_once get_template_directory() . '/includes/functions/helpers.php';

    $settings = rfbp_get_settings();

	if( ! is_admin() ) {
		// frontend requests
        require_once get_template_directory() . '/includes/class-public.php';
		$rfbp_public = RFBP_Public::instance( $settings );
		$rfbp_public->add_hooks();

	} 

function mytheme_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

