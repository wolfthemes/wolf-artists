<?php
/**
 * Wolf Artists core functions
 *
 * General core functions available on admin and frontend
 *
 * @author WolfThemes
 * @category Core
 * @package WolfArtists/Core
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add image sizes
 *
 * These size will be ued for galleries and sliders
 *
 * @since 1.0.0
 */
function wat_add_image_sizes() {

	// add artists image sizes
	//add_image_size( 'CD', 400, 400, true );
}
add_action( 'init', 'wat_add_image_sizes' );

/**
 * wolf_artists page IDs
 *
 * retrieve page ids - used for the main artists page
 *
 * returns -1 if no page is found
 *
 * @param string $page
 * @return int
 */
function wolf_artists_get_page_id() {

	$page_id = -1;

	if ( -1 != get_option( '_wolf_artists_page_id' ) && get_option( '_wolf_artists_page_id' ) ) {

		$page_id = get_option( '_wolf_artists_page_id' );

	}

	if ( -1 != $page_id ) {
		$page_id = apply_filters( 'wpml_object_id', absint( $page_id ), 'page', true ); // filter for WPML
	}

	return $page_id;
}

/**
 * wolf_artists page link
 *
 * retrieve artists page permalink
 *
 *
 * @param string $page
 * @return string
 */
function wolf_artists_get_page_link() {

	$page_id = wolf_artists_get_page_id();

	if ( $page_id != -1 ) {
		return get_permalink( $page_id );
	}
}

/**
 * Get template part (for templates like the artist-loop).
 *
 * @param mixed $slug
 * @param string $name (default: '')
 */
function wolf_artists_get_template_part( $slug, $name = '' ) {
	$template = '';

	$wolf_artists = WOLFARTISTS();

	// Look in yourtheme/slug-name.php and yourtheme/wolf_artists/slug-name.php
	if ( $name )
		$template = locate_template( array( "{$slug}-{$name}.php", "{$wolf_artists->template_url}{$slug}-{$name}.php" ) );

	// Get default slug-name.php
	if ( ! $template && $name && file_exists( $wolf_artists->plugin_path() . "/templates/{$slug}-{$name}.php" ) )
		$template = $wolf_artists->plugin_path() . "/templates/{$slug}-{$name}.php";

	// If template file doesn't exist, look in yourtheme/slug.php and yourtheme/wolf_artists/slug.php
	if ( ! $template )
		$template = locate_template( array( "{$slug}.php", "{$wolf_artists->template_url}{$slug}.php" ) );

	if ( $template )
		load_template( $template, false );
}


/**
 * Get other templates (e.g. ticket attributes) passing attributes and including the file.
 *
 * @param mixed $template_name
 * @param array $args (default: array())
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 */
function wolf_artists_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {

	if ( $args && is_array($args) )
		extract( $args );

	$located = wolf_artists_locate_template( $template_name, $template_path, $default_path );

	do_action( 'wolf_artists_before_template_part', $template_name, $template_path, $located, $args );

	include( $located );

	do_action( 'wolf_artists_after_template_part', $template_name, $template_path, $located, $args );
}


/**
 * Locate a template and return the path for inclusion.
 *
 * This is the load order:
 *
 * yourtheme/$template_path/$template_name
 * yourtheme/$template_name
 * $default_path/$template_name
 *
 * @param mixed $template_name
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 * @return string
 */
function wolf_artists_locate_template( $template_name, $template_path = '', $default_path = '' ) {

	if ( ! $template_path ) $template_path = WOLFARTISTS()->template_url;
	if ( ! $default_path ) $default_path = WOLFARTISTS()->plugin_path() . '/templates/';

	// Look within passed path within the theme - this is priority
	$template = locate_template(
		array(
			trailingslashit( $template_path ) . $template_name,
			$template_name
		)
	);

	// Get default template
	if ( ! $template )
		$template = $default_path . $template_name;

	// Return what we found
	return apply_filters( 'wolf_artists_locate_template', $template, $template_name, $template_path );
}

/**
 * Widget function
 *
 * Displays the show list in the widget
 *
 * @param int $count, string $url, bool $link
 * @return string
 */
function wolf_get_artist_option( $value, $default = null ) {

	$wolf_artists_settings = get_option( 'wolf_artist_settings' );

	if ( isset( $wolf_artists_settings[ $value ] ) && '' != $wolf_artists_settings[ $value ] ) {

		return $wolf_artists_settings[ $value ];

	} elseif( $default ) {

		return $default;
	}
}