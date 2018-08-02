<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package asdf
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */


/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function asdf_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'asdf_pingback_header' );
