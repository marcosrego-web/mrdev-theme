<?php
/**
 * Mr.Dev.'s Framework functions and definitions
 *
 * @link https://marcosrego.com/development/mrdev-framework/
 *
 * @package MarcosRego
 * @subpackage mrdev-framework_wp
 * @since Mr.Dev.'s Framework 1.0
 */

/*MR.DEV'S OPTIONS*/
	/*Optionally include Mr.Dev's Framework inside the theme*/
	if ( !is_dir( WP_PLUGIN_DIR.'/mrdev-framework_wp' ) ) {
		include 'vendor/marcosrego-web/mrdev-framework_wp/mrdev-framework_wp.php';
	}
	
	/*Updates*/
	require 'plugin-update-checker/plugin-update-checker.php';
	$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
		'https://github.com/marcosrego-web/mrdev-theme/',
		__FILE__,
		'mrdev-theme'
	);
	global $mrdev_config_betatest;
	if($mrdev_config_betatest === 1) {
		$myUpdateChecker->setBranch('develop');
	} else {
		$myUpdateChecker->setBranch('master');
	}
/*END OF MR.DEV'S OPTIONS*/

if ( ! function_exists( 'mrdev_support' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since Mr.Dev.'s Framework 1.0
	 *
	 * @return void
	 */
	function mrdev_support() {

		// Add support for block styles.
		add_theme_support( 'wp-block-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style.css' );

	}

endif;

add_action( 'after_setup_theme', 'mrdev_support' );

if ( ! function_exists( 'mrdev_styles' ) ) :

	/**
	 * Enqueue styles.
	 *
	 * @since Mr.Dev.'s Framework 1.0
	 *
	 * @return void
	 */
	function mrdev_styles() {
		// Register theme stylesheet.
		$theme_version = wp_get_theme()->get( 'Version' );

		$version_string = is_string( $theme_version ) ? $theme_version : false;
		wp_register_style(
			'mrdev-style',
			get_template_directory_uri() . '/style.css',
			array(),
			$version_string
		);

		// Enqueue theme stylesheet.
		wp_enqueue_style( 'mrdev-style' );

	}

endif;

add_action( 'wp_enqueue_scripts', 'mrdev_styles' );