<?php
/**
 * %NAME% Template Functions
 *
 * Functions used in the template files to output content - in most cases hooked in via the template actions. All functions are pluggable.
 *
 * @author WolfThemes
 * @category Core
 * @package WolfArtists/Templates
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Output generator tag to aid debugging.
 */
function wat_generator_tag( $gen, $type ) {
	switch ( $type ) {
		case 'html':
			$gen .= "\n" . '<meta name="generator" content="WolfArtists ' . esc_attr( WAT_VERSION ) . '">';
			break;
		case 'xhtml':
			$gen .= "\n" . '<meta name="generator" content="WolfArtists ' . esc_attr( WAT_VERSION ) . '" />';
			break;
	}
	return $gen;
}

/**
 * Add specific class to the body when we're on the artists page
 *
 * @param array $classes
 * @return array $classes
 */
function wat_body_class( $classes ) {

	if ( is_page( wolf_artists_get_page_id() ) ) {
		$classes[] = 'artists-page';
	}

	if (
		! is_singular( 'release' )
		&& ( 'release' == get_post_type() || ( function_exists( 'wolf_artists_get_page_id' ) && is_page( wolf_artists_get_page_id() ) ) )
	) {
		$classes[] = 'wolf-artists';
	}

	return $classes;
}

if ( ! function_exists( 'wolf_artists_output_content_wrapper' ) ) {

	/**
	 * Output the start of the page wrapper.
	 *
	 * @access public
	 * @return void
	 */
	function wolf_artists_output_content_wrapper() {
		wolf_artists_get_template( 'global/wrapper-start.php' );
	}
}


if ( ! function_exists( 'wolf_artists_output_content_wrapper_end' ) ) {

	/**
	 * Output the end of the page wrapper.
	 *
	 * @access public
	 * @return void
	 */
	function wolf_artists_output_content_wrapper_end() {
		wolf_artists_get_template( 'global/wrapper-end.php' );
	}
}

if ( ! function_exists( 'wolf_artists_loop_start' ) ) {

	/**
	 * Output the start of a ticket loop. By default this is a UL
	 *
	 * @access public
	 * @return void
	 */
	function wolf_artists_loop_start( $echo = true ) {
		ob_start();
		wolf_artists_get_template( 'loop/loop-start.php' );
		if ( $echo )
			echo ob_get_clean();
		else
			return ob_get_clean();
	}
}


if ( ! function_exists( 'wolf_artists_loop_end' ) ) {

	/**
	 * Output the end of a ticket loop. By default this is a UL
	 *
	 * @access public
	 * @return void
	 */
	function wolf_artists_loop_end( $echo = true ) {
		ob_start();

		wolf_artists_get_template( 'loop/loop-end.php' );

		if ( $echo )
			echo ob_get_clean();
		else
			return ob_get_clean();
	}
}