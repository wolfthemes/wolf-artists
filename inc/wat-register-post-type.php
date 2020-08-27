<?php
/**
 * Artists register post type
 *
 * @author WolfThemes
 * @category Core
 * @package WolfArtists/Admin
 * @version 1.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$labels = array(
	'name' => esc_html__( 'Artists', 'wolf-artists' ),
	'singular_name' => esc_html__( 'Artist', 'wolf-artists' ),
	'add_new' => esc_html__( 'Add New', 'wolf-artists' ),
	'add_new_item' => esc_html__( 'Add New Artist', 'wolf-artists' ),
	'all_items'  =>  esc_html__( 'All Artists', 'wolf-artists' ),
	'edit_item' => esc_html__( 'Edit Artist', 'wolf-artists' ),
	'new_item' => esc_html__( 'New Artist', 'wolf-artists' ),
	'view_item' => esc_html__( 'View Artist', 'wolf-artists' ),
	'search_items' => esc_html__( 'Search Artists', 'wolf-artists' ),
	'not_found' => esc_html__( 'No artists found', 'wolf-artists' ),
	'not_found_in_trash' => esc_html__( 'No artists found in Trash', 'wolf-artists' ),
	'parent_item_colon' => '',
	'menu_name' => esc_html__( 'Artists', 'wolf-artists' ),
);

$args = array(
	'labels' => $labels,
	'public' => true,
	'publicly_queryable' => true,
	'show_ui' => true,
	'show_in_menu' => true,
	'query_var' => false,
	'rewrite' => array( 'slug' => 'artist' ),
	'capability_type' => 'post',
	'has_archive' => false,
	'hierarchical' => false,
	'menu_position' => 5,
	'taxonomies' => array(),
	'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', 'comments' ),
	'exclude_from_search' => false,
	'menu_icon' => 'dashicons-admin-users',
);

register_post_type( 'artist', $args );