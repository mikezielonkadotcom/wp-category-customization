<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * This file may be updated more in future version of the Boilerplate; however, this is the
 * general skeleton and outline for how the file should work.
 *
 * For more information, see the following discussion:
 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/pull/123#issuecomment-28541913
 *
 * @link       https://mikezielonka.com
 * @since      1.0.0
 *
 * @package    Wp_Term_Custom_Heading
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Remove custom term meta from all categories.
$terms = get_terms( array(
	'taxonomy'   => 'category',
	'hide_empty' => false,
	'fields'     => 'ids',
) );

if ( ! is_wp_error( $terms ) ) {
	foreach ( $terms as $term_id ) {
		delete_term_meta( $term_id, 'custom_category_page_title_wptch' );
	}
}
