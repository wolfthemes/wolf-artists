<?php
/**
 * %PACKAGENAME% Hooks
 *
 * Action/filter hooks used for %PACKAGENAME% functions/templates
 *
 * @author %AUTHOR%
 * @category Core
 * @package %PACKAGENAME%/Templates
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed direct
}

/**
 * Body class
 *
 * @see  wat_body_class()
 */
add_filter( 'body_class', 'wat_body_class' );

/**
 * WP Header
 *
 * @see  wat_generator_tag()
 */
add_action( 'get_the_generator_html', 'wat_generator_tag', 10, 2 );
add_action( 'get_the_generator_xhtml', 'wat_generator_tag', 10, 2 );

/**
 * Content wrappers
 *
 * @see wolf_artists_output_content_wrapper()
 * @see wolf_artists_output_content_wrapper_end()
 */
add_action( 'wolf_artists_before_main_content', 'wolf_artists_output_content_wrapper', 10 );
add_action( 'wolf_artists_after_main_content', 'wolf_artists_output_content_wrapper_end', 10 );

add_action( 'template_redirect', 'wolf_artists_template_redirect', 40 );