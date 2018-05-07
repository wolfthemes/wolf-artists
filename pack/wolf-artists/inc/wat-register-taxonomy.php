<?php
/**
 * Wolf Artists register taxonomy
 *
 * @author WolfThemes
 * @category Core
 * @package WolfArtists/Admin
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$labels = array(
	'name' => esc_html__( 'Genres', 'wolf-artists' ),
	'singular_name' => esc_html__( 'Genre', 'wolf-artists' ),
	'search_items' => esc_html__( 'Search Genres', 'wolf-artists' ),
	'popular_items' => esc_html__( 'Popular Genres', 'wolf-artists' ),
	'all_items' => esc_html__( 'All Genres', 'wolf-artists' ),
	'parent_item' => esc_html__( 'Parent Genre', 'wolf-artists' ),
	'parent_item_colon' => esc_html__( 'Parent Genre:', 'wolf-artists' ),
	'edit_item' => esc_html__( 'Edit Genre', 'wolf-artists' ),
	'update_item' => esc_html__( 'Update Genre', 'wolf-artists' ),
	'add_new_item' => esc_html__( 'Add New Genre', 'wolf-artists' ),
	'new_item_name' => esc_html__( 'New Genre', 'wolf-artists' ),
	'separate_items_with_commas' => esc_html__( 'Separate genres with commas', 'wolf-artists' ),
	'add_or_remove_items' => esc_html__( 'Add or remove genres', 'wolf-artists' ),
	'choose_from_most_used' => esc_html__( 'Choose from the most used genres', 'wolf-artists' ),
	'not_found' => esc_html__( 'No genres found', 'wolf-artists' ),
	'menu_name' => esc_html__( 'Genres', 'wolf-artists' ),
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