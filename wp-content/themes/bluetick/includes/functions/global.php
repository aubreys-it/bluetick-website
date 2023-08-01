<?php

//if( ! defined( 'RFBP_VERSION' ) ) {
//	exit;
//}

/**
 * Prints a list of Recent Facebook Posts
 *
 * Accepted arguments are the same as the shortcode args
 *
 * - number: 5
 * - likes: true
 * - comments: true
 * - excerpt_length: 140
 * - el: div
 * - origin: shortcode
 * - show_page_link: false
 * - show_link_preview: false
 *
 * @param array $args
 * @return void
 */
function recent_facebook_posts( $args = array() ) {
    echo RFBP_Public::instance()->output( $args );
}

/**
 * Get the plugin settings (merged with defaults)
 *
 * @return array
 */
function rfbp_get_settings() {

	static $settings = null;

	if ( is_null( $settings ) ) {

		$defaults = array(
			'app_id' => '2019017498346071',
			'app_secret' => '2eef625b5edb677e3124b6640ba2f602',
			'fb_id' => '_oleaMedicalCenter',
			'load_css' => 1,
			'page_link_text' => __( 'Find us on Facebook', 'recent-facebook-posts' ),
			'link_new_window' => 0,
			'img_size' => 'normal',
			'img_width' => '',
			'img_height' => ''
		);

		// get user options
		$options = get_option( 'rfb_settings', array() );
		$settings = array_merge( $defaults, $options );
	}

	return $settings;
}

/**
 * Register the `Recent Facebook Posts` widget
 */
//function rfbp_register_widget() {
//	include_once get_template_directory() . '/includes/class-widget.php';
//	register_widget( "RFBP_Widget" );
//}

/**
 * @return RFBP_API
 */
function rfbp_get_api() {

	static $api = null;

	if( is_null( $api ) ) {
		$opts = rfbp_get_settings();
		require_once get_template_directory() . '/includes/class-api.php';
		//$api = new RFBP_API( $opts['app_id'], $opts['app_secret'], $opts['fb_id'] );
        $api = new RFBP_API( '2019017498346071', '2eef625b5edb677e3124b6640ba2f602', '_oleaMedicalCenter' );
        //$api = new RFBP_API( '576151719254535', '42dbe7f4f7c4705c1224006aeb3dce5e', 'siteby' );
	}

	return $api;
}

/**
 * @return bool
 */
function rfbp_valid_config() {
	$opts = rfbp_get_settings();
	return ( ! empty( $opts['fb_id'] ) && ! empty( $opts['app_id'] ) && ! empty( $opts['app_secret'] ) );
}

