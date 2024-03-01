<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://mikezielonka.com
 * @since      1.0.0
 *
 * @package    Wp_Term_Custom_Heading
 * @subpackage Wp_Term_Custom_Heading/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wp_Term_Custom_Heading
 * @subpackage Wp_Term_Custom_Heading/public
 * @author     Michael Zielonka <me@mikezielonka.com>
 */
class Wp_Term_Custom_Heading_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	public function maybe_override_archive_title($title, $original_title, $prefix)
	{

		if ( is_category() ) {
			$category = get_category( get_query_var( 'cat' ) );
			$cat_id = $category->cat_ID;
			$custom_category_page_title_wptch = get_term_meta($cat_id, 'custom_category_page_title_wptch', true);
				if (!empty($custom_category_page_title_wptch)) {
					$title = $custom_category_page_title_wptch;
				}
		}

		return $title;
	}

}
