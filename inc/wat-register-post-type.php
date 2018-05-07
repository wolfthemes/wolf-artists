<?php
/**
 * %NAME% register post type
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
	'name' => esc_html__( 'Artists', '%TEXTDOMAIN%' ),
	'singular_name' => esc_html__( 'Artist', '%TEXTDOMAIN%' ),
	'add_new' => esc_html__( 'Add New', '%TEXTDOMAIN%' ),
	'add_new_item' => esc_html__( 'Add New Artist', '%TEXTDOMAIN%' ),
	'all_items'  =>  esc_html__( 'All Artists', '%TEXTDOMAIN%' ),
	'edit_item' => esc_html__( 'Edit Artist', '%TEXTDOMAIN%' ),
	'new_item' => esc_html__( 'New Artist', '%TEXTDOMAIN%' ),
	'view_item' => esc_html__( 'View Artist', '%TEXTDOMAIN%' ),
	'search_items' => esc_html__( 'Search Artists', '%TEXTDOMAIN%' ),
	'not_found' => esc_html__( 'No artists found', '%TEXTDOMAIN%' ),
	'not_found_in_trash' => esc_html__( 'No artists found in Trash', '%TEXTDOMAIN%' ),
	'parent_item_colon' => '',
	'menu_name' => esc_html__( 'Artists', '%TEXTDOMAIN%' ),
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