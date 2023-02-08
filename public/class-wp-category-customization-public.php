<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://wp.com/
 * @since      1.0.0
 *
 * @package    wp_Category_Customization
 * @subpackage wp_Category_Customization/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    wp_Category_Customization
 * @subpackage wp_Category_Customization/public
 * @author     Michael Zielonka <me@mikezielonka.com>
 */
class wp_Category_Customization_Public {

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
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in wp_Category_Customization_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The wp_Category_Customization_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-category-customization-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in wp_Category_Customization_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The wp_Category_Customization_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-category-customization-public.js', array( 'jquery' ), $this->version, false );

	}

	public function maybe_override_archive_title($title, $original_title, $prefix)
	{

		if ( is_category() ) {
			$category = get_category( get_query_var( 'cat' ) );
			$cat_id = $category->cat_ID;
			$custom_category_page_title_lt = get_term_meta($cat_id, 'custom_category_page_title_lt', true);
				if (!empty($custom_category_page_title_lt)) {
					$title = $custom_category_page_title_lt;
				}
		}

		return $title;
	}

}
