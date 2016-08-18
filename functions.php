<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
	'lib/assets.php',    // Scripts and stylesheets
	'lib/extras.php',    // Custom functions
	'lib/setup.php',     // Theme setup
	'lib/titles.php',    // Page titles
	'lib/wrapper.php',   // Theme wrapper class
	'lib/customizer.php', // Theme customizer
	'lib/class-flexible.php', //flexible content
];

foreach ( $sage_includes as $file ) {
	if ( ! $filepath = locate_template( $file ) ) {
		trigger_error( sprintf( __( 'Error locating %s for inclusion', 'sage' ), $file ), E_USER_ERROR );
	}

	require_once $filepath;
}
unset( $file, $filepath );

register_nav_menus( array(
	'main_menu_1'     	=> 'Menu główne - lewo',
	'main_menu_2'    => 'Menu główne - prawo',
	'main_menu_3' 	=> 'Menu główne - mobile',
	'main_menu_4'     	=> 'Menu - foooter',
) );

if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page();
}

if ( is_admin() ) {
	$content = new FlexibleContent( $_POST['post_ID'] );
	//przy każdym zapisie wpisu odpalamy funkcję
	add_action( 'acf/save_post', [ $content, 'content_on_save' ], 99 );
}
