<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * Removes the custom page title meta from every term that has it.
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

// Delete the meta key from all terms in one query.
delete_metadata( 'term', 0, 'custom_category_page_title_wptch', '', true );
