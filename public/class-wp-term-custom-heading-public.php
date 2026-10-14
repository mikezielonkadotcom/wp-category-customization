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

	/**
	 * Register the term meta so every write path (REST, WP-CLI, other plugins)
	 * runs through the same sanitization and capability check.
	 *
	 * @since    1.5.0
	 */
	public function register_term_meta() {
		register_term_meta(
			'category',
			'custom_category_page_title_wptch',
			array(
				'type'              => 'string',
				'single'            => true,
				'sanitize_callback' => 'sanitize_text_field',
				'auth_callback'     => function () {
					return current_user_can( 'manage_categories' );
				},
				'show_in_rest'      => true,
			)
		);
	}

	/**
	 * Replace the archive title with the category's custom page title, if set.
	 *
	 * Uses the queried object rather than get_query_var( 'cat' ) so that
	 * multi-category and negative `cat` queries do not yield a null term.
	 *
	 * @since    1.0.0
	 * @param    string    $title             Archive title to be displayed.
	 * @param    string    $original_title    Archive title without prefix.
	 * @param    string    $prefix            Archive title prefix.
	 * @return   string
	 */
	public function maybe_override_archive_title( $title, $original_title, $prefix ) {

		if ( ! is_category() ) {
			return $title;
		}

		$term = get_queried_object();
		if ( ! $term instanceof WP_Term || 'category' !== $term->taxonomy ) {
			return $title;
		}

		$custom = get_term_meta( $term->term_id, 'custom_category_page_title_wptch', true );
		if ( ! empty( $custom ) ) {
			return esc_html( $custom );
		}

		return $title;
	}

}
