<?php
/**
 * Artists Admin Functions
 *
 * Functions available on both the front-end and admin.
 *
 * @author WolfThemes
 * @category Admin
 * @package WolfArtists/Functions
 * @since 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Display archive page state
 *
 * @param array $states
 * @param object $post
 * @return array $states
 */
function wat_custom_post_states( $states, $post ) {

	if ( 'page' == get_post_type( $post->ID ) && absint( $post->ID ) === wolf_artists_get_page_id() ) {

		$states[] = esc_html__( 'Artists Page' );
	}

	return $states;
}
add_filter( 'display_post_states', 'wat_custom_post_states', 10, 2 );

/**
 * Get sync artist term
 *
 * @return array $taxonomies
 */
function wat_get_artist_sync_terms() {

	$taxonomies = array();

	if ( class_exists( 'Wolf_Discography' ) && get_theme_mod( 'discography_terms_artist_sync' ) ) {
		$taxonomies[] = 'band';
	}

	if ( class_exists( 'Wolf_Events' ) && get_theme_mod( 'events_terms_artist_sync' ) ) {
		$taxonomies[] = 'we_artist';
	}

	if ( class_exists( 'Wolf_Portfolio' ) && get_theme_mod( 'work_terms_artist_sync' ) ) {
		$taxonomies[] = 'work_artist';
	}

	if ( class_exists( 'Wolf_Videos' ) && get_theme_mod( 'videos_terms_artist_sync' ) ) {
		$taxonomies[] = apply_filters( 'wolf_artists_video_artist_slug', 'video_type' );
	}

	if ( class_exists( 'Wolf_Albums' ) && get_theme_mod( 'albums_terms_artist_sync' ) ) {
		$taxonomies[] = 'gallery_type';
	}

	return $taxonomies;
}

/**
 * Sync term for releases, videos, and events when an artist post is created
 *
 * @param int $post_id
 * @param object $post
 */
function wat_sync_artist_terms_name( $post_id, $post ) {

	if ( wp_is_post_revision( $post_id ) ) {
		return ;
	}

	if ( isset( $_POST['post_type'] ) && is_object( $post ) ) {

		$current_post_type = get_post_type( $post->ID );

		if ( 'artist' !== $_POST['post_type'] || ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		$artist_name = ( isset( $_POST['post_title'] ) ) ? esc_attr( $_POST['post_title'] ) : esc_html__( 'New Artist', '%TEXDOMOMAIN%' );
		$term_slug = sanitize_title_with_dashes( $artist_name );

		foreach ( wat_get_artist_sync_terms() as $taxonomy ) {

			$tax_meta_id = '_' . $taxonomy . '_term_id';
			$term_id = absint( get_post_meta( $post_id, $tax_meta_id, true ) );

			/* update if term exists */
			if ( $term_id && term_exists( $term_id, $taxonomy ) ) {

				wp_update_term( $term_id, $taxonomy, array(
					'term_id' => $term_id,
					'name' => $artist_name,
				) );

			/* else create term */
			} else {

				$new_term_id = wp_insert_term(
					$artist_name,
					$taxonomy,
					array(
						'slug' => $term_slug,
					)
				);

				if ( is_array( $new_term_id ) && isset( $new_term_id['term_id'] ) ) {
					update_post_meta( $post_id, '_' . $taxonomy . '_term_id', absint( $new_term_id['term_id'] ) );
				}
			}
		}
	}
}
add_action( 'save_post', 'wat_sync_artist_terms_name', 10, 2 );

/**
 * Sync term slugs
 *
 * @param string $slug
 * @param int $post_id
 * @param string $post_status
 * @param string $post_type
 * @return string $slug
 */
function wat_sync_artist_terms_slug( $slug, $post_id, $post_status, $post_type ) {

	if ( 'artist' === $post_type ) {

		foreach ( wat_get_artist_sync_terms() as $taxonomy ) {

			$tax_meta_id = '_' . $taxonomy . '_term_id';
			$term_id = absint( get_post_meta( $post_id, $tax_meta_id, true ) );

			/* update if term exists */
			if ( $term_id && term_exists( $term_id, $taxonomy ) ) {

				wp_update_term( $term_id, $taxonomy, array(
					'slug' => $slug,
				) );
			}
		}
	}

	return $slug;
}
add_filter( 'wp_unique_post_slug', 'wat_sync_artist_terms_slug', 10, 4 );

/**
 * Delete artist terms
 *
 * @param int $post_id
 */
function wat_delete_artist_terms( $post_id ) {

	if ( 'artist' === get_post_type() ) {

		foreach ( wat_get_artist_sync_terms() as $taxonomy ) {

			$tax_meta_id = '_' . $taxonomy . '_term_id';
			$term_id = absint( get_post_meta( $post_id, $tax_meta_id, true ) );

			/* delete term */
			if ( $term_id && term_exists( $term_id, $taxonomy ) ) {

				wp_delete_term( $term_id, $taxonomy );
			}
		}
	}
}
add_action( 'before_delete_post', 'wat_delete_artist_terms' );