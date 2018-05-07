<?php
/**
 * %NAME% register taxonomy
 *
 * @author %AUTHOR%
 * @category Core
 * @package %PACKAGENAME%/Admin
 * @version %VERSION%
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$labels = array(
	'name' => esc_html__( 'Genres', '%TEXTDOMAIN%' ),
	'singular_name' => esc_html__( 'Genre', '%TEXTDOMAIN%' ),
	'search_items' => esc_html__( 'Search Genres', '%TEXTDOMAIN%' ),
	'popular_items' => esc_html__( 'Popular Genres', '%TEXTDOMAIN%' ),
	'all_items' => esc_html__( 'All Genres', '%TEXTDOMAIN%' ),
	'parent_item' => esc_html__( 'Parent Genre', '%TEXTDOMAIN%' ),
	'parent_item_colon' => esc_html__( 'Parent Genre:', '%TEXTDOMAIN%' ),
	'edit_item' => esc_html__( 'Edit Genre', '%TEXTDOMAIN%' ),
	'update_item' => esc_html__( 'Update Genre', '%TEXTDOMAIN%' ),
	'add_new_item' => esc_html__( 'Add New Genre', '%TEXTDOMAIN%' ),
	'new_item_name' => esc_html__( 'New Genre', '%TEXTDOMAIN%' ),
	'separate_items_with_commas' => esc_html__( 'Separate genres with commas', '%TEXTDOMAIN%' ),
	'add_or_remove_items' => esc_html__( 'Add or remove genres', '%TEXTDOMAIN%' ),
	'choose_from_most_used' => esc_html__( 'Choose from the most used genres', '%TEXTDOMAIN%' ),
	'not_found' => esc_html__( 'No genres found', '%TEXTDOMAIN%' ),
	'menu_name' => esc_html__( 'Genres', '%TEXTDOMAIN%' ),
);

$args = array(

	'labels' => $labels,
	'hierarchical' => true,
	'public' => true,
	'show_ui' => true,
	'query_var' => true,
	'update_count_callback' => '_update_post_term_count',
	'rewrite' => array( 'slug' => 'genre', 'with_front' => false),
);

register_taxonomy( 'artist_genre', array( 'artist' ), $args );