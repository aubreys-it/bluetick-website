<?php
/**
 * Theme basic setup.
 *
 * @package _bluetick
 */

require get_template_directory() . '/inc/theme-settings.php';

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

/**
 * Load theme plugins
 * 
**/
function cfct_load_plugins() {
    $files = cfct_files(CFCT_PATH.'plugins');
    if (count($files)) {
        foreach ($files as $file) {
            if (file_exists(CFCT_PATH.'plugins/'.$file)) {
                include_once(CFCT_PATH.'plugins/'.$file);
            }
// child theme support
            if (file_exists(STYLESHEETPATH.'/plugins/'.$file)) {
                include_once(STYLESHEETPATH.'/plugins/'.$file);
            }
        }
    }
}

/**
 * Get a list of php files within a given path as well as files in corresponding child themes
 * 
 * @param sting $path Path to the directory to search
 * @return array Files within the path directory
 * 
**/
function cfct_files($path) {
    $files = apply_filters('cfct_files_'.$path, false);
    if ($files) {
        return $files;
    }
    $files = wp_cache_get('cfct_files_'.$path, 'cfct');
    if ($files) {
        return $files;
    }
    $files = array();
    $paths = array($path);
    if (STYLESHEETPATH.'/' != CFCT_PATH) {
        // load child theme files
        $paths[] = STYLESHEETPATH.'/'.str_replace(CFCT_PATH, '', $path);
    }
    foreach ($paths as $path) {
        if (is_dir($path) && $handle = opendir($path)) {
            while (false !== ($file = readdir($handle))) {
                $path = trailingslashit($path);
                if (is_file($path.$file) && strtolower(substr($file, -4, 4)) == ".php") {
                    $files[] = $file;
                }
            }
            closedir($handle);
        }
    }
    $files = array_unique($files);
    wp_cache_set('cfct_files_'.$path, $files, 'cfct', 3600);
    return $files;
}

if ( ! function_exists( '_bluetick_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function _bluetick_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on _bluetick, use a find and replace
		 * to change '_bluetick' to the name of your theme in all the template files
		 */
		load_theme_textdomain( '_bluetick', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', '_bluetick' ),
			'primary_left' => __( 'Primary Menu Left', '_bluetick' ),
			'primary_right' => __( 'Primary Menu Right', '_bluetick' ),
			'secondary_menu' => __( 'Secondary Menu', '_bluetick' ),
			'footer_menu' => __( 'Footer Menu', '_bluetick' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Adding Thumbnail basic support
		 */
		add_theme_support( 'post-thumbnails' );
        add_image_size( 'slide-photo', 1158, 604, true );
         
        
		/*
		 * Adding support for Widget edit icons in customizer
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		// add_theme_support( 'post-formats', array(
		// 	'status',
		// 	'link',
		// 	'photos',
		// 	'reviews',
		// ) );

		// Set up the WordPress core custom background feature.
//		add_theme_support( 'custom-background', apply_filters( '_bluetick_custom_background_args', array(
//			'default-color' => 'ffffff',
//			'default-image' => '',
//		) ) );

        add_filter('jpeg_quality', function($arg){return 100;});
        add_filter( 'wp_editor_set_quality', function($arg){return 100;} );
        
		// Set up the Wordpress Theme logo feature.
		//add_theme_support( 'custom-logo' );

		// Check and setup theme default settings.
		setup_theme_default_settings();
	}
endif; // _bluetick_setup.
add_action( 'after_setup_theme', '_bluetick_setup' );

if ( ! function_exists( 'custom_excerpt_more' ) ) {
	/**
	 * Removes the ... from the excerpt read more link
	 *
	 * @param string $more The excerpt.
	 *
	 * @return string
	 */
	function custom_excerpt_more( $more ) {
		return '';
	}
}
add_filter( 'excerpt_more', 'custom_excerpt_more' );

if ( ! function_exists( 'all_excerpts_get_more_link' ) ) {
	/**
	 * Adds a custom read more link to all excerpts, manually or automatically generated
	 *
	 * @param string $post_excerpt Posts's excerpt.
	 *
	 * @return string
	 */
	function all_excerpts_get_more_link( $post_excerpt ) {
		//echo '$post_excerpt = '.$post_excerpt;
		$excerpt_length_setting = get_field('excerpt_length', 'options');
		$str = $post_excerpt;
		$excerpt_length = str_word_count($str);
		//echo 'length = '.str_word_count($str);
		if($excerpt_length >= $excerpt_length_setting)
		{
			return $post_excerpt . ' [...]<a class="_bluetick-read-more-link" href="' . get_permalink( get_the_ID() ) . '">' . __( 'Continue Reading →',
		'_bluetick' ) . '</a>';
		}
		else
		{
			return $post_excerpt;
		}
	}
}
add_filter( 'wp_trim_excerpt', 'all_excerpts_get_more_link' );

function my_loginURL() {
    return get_bloginfo( 'url' );
}
add_filter('login_headerurl', 'my_loginURL');

function my_logincustomCSSfile() {
    wp_enqueue_style('login-styles', get_template_directory_uri() . '/login/login_styles.css');
}
add_action('login_enqueue_scripts', 'my_logincustomCSSfile');

function custom_excerpt_length( $length ) {
	return get_field('excerpt_length', 'options');
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
