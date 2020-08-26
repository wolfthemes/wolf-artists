<?php
/**
 * %NAME% Functions
 *
 * Hooked-in functions for %NAME% related events on the front-end.
 *
 * @author WolfThemes
 * @category Core
 * @package WolfArtists/Functions
 * @since 1.0.0
 */

/**
 * Handle redirects before content is output - hooked into template_redirect so is_page videos.
 *
 * @return void
 */
function wolf_artists_template_redirect() {

	if ( is_page( wolf_artists_get_page_id() ) && ! post_password_required() ) {
		wolf_artists_get_template( 'artists-template.php' );
		exit();
	}
}