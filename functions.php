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
];

foreach ( $sage_includes as $file ) {
	if ( ! $filepath = locate_template( $file ) ) {
		trigger_error( sprintf( __( 'Error locating %s for inclusion', 'sage' ), $file ), E_USER_ERROR );
	}

	require_once $filepath;
}
unset( $file, $filepath );

function get_logo_url() {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
	return $image[0];
}

function new_excerpt_more( $more ) {
	return '<a class="read-more" href="'. get_the_permalink().'"> &raquo;</a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );

add_filter( 'user_contactmethods', 'modify_contact_methods' );

function modify_contact_methods( $profile_fields ) {
	// Add new fields
	$profile_fields['location'] = __( 'Your location', 'sage' );

	// Remove old fields
	unset( $profile_fields['aim'] );
	unset( $profile_fields['yim'] );
	unset( $profile_fields['jabber'] );
	unset( $profile_fields['facebook'] );
	unset( $profile_fields['twitter'] );
	unset( $profile_fields['gplus'] );
	unset( $profile_fields['youtube'] );
	return $profile_fields;
}

function unregister_categories() {
	unregister_taxonomy_for_object_type( 'category', 'post' );
}
add_action( 'init', 'unregister_categories' );
