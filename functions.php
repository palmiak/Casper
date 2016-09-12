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
	'lib/class-tgm-plugin-activation.php', //TGM
	'lib/acf.php', //acf fields
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

add_action( 'tgmpa_register', 'sage_register_required_plugins' );

function sage_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		array(
			'name'        => 'WordPress SEO by Yoast',
			'slug'        => 'wordpress-seo',
			'is_callable' => 'wpseo_init',
		),
		array(
			'name'        => 'Disqus',
			'slug'        => 'disqus-comment-system',
			'is_callable' => 'disqus_init',
		),
		array(
			'name'        => 'Advanced Custom Fields',
			'slug'        => 'advanced-custom-fields',
			'is_callable' => 'acf_init',
		),
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'sage',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}

function sage_add_title_to_attachment( $markup, $id ) {
	$att = get_post( $id );
	return str_replace( '<a ', '<a title="'.$att->post_title.'" ', $markup );
}
add_filter( 'wp_get_attachment_link', 'sage_add_title_to_attachment', 10, 5 );

function image_tag_class( $class ) {
	$class .= ' no-barba';
	return $class;
}
add_filter( 'get_image_tag_class', 'image_tag_class' );

function add_rel_to_gallery( $link, $id ) {
	return str_replace( '<a', '<a class="no-barba" ', $link );
}
add_filter( 'wp_get_attachment_link', 'add_rel_to_gallery', 10, 2 );
