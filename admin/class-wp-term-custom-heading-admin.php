<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://mikezielonka.com
 * @since      1.0.0
 *
 * @package    Wp_Term_Custom_Heading
 * @subpackage Wp_Term_Custom_Heading/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Term_Custom_Heading
 * @subpackage Wp_Term_Custom_Heading/admin
 * @author     Michael Zielonka <me@mikezielonka.com>
 */
class Wp_Term_Custom_Heading_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Term_Custom_Heading_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Term_Custom_Heading_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-term-custom-heading-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Term_Custom_Heading_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Term_Custom_Heading_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-term-custom-heading-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function category_fields_new( $taxonomy ) { // Function has one field to pass – Taxonomy
		wp_nonce_field( 'category_meta_new_wptch', 'category_meta_new_wptch_nonce' ); // Create a Nonce so that we can verify the integrity of our data

		?>
		<div class="form-field">
			<label for="custom_category_page_title_wptch"><?php esc_html_e( 'Page Title', $this->plugin_name ); ?></label>
			<input type="text" name="custom_category_page_title_wptch" id="custom_category_page_title_wptch" value="">
			<p><?php esc_html_e( 'Use this field if you want to override the category archive title (h1).', $this->plugin_name ); ?></p>
		</div>
		<?php
	}

	public function category_fields_edit( $term, $taxonomy ) { // Function has one field to pass – Taxonomy
		wp_nonce_field( 'category_meta_edit_wptch', 'category_meta_edit_wptch_nonce' ); // Create a Nonce so that we can verify the integrity of our data
		$custom_category_page_title_wptch = get_term_meta($term->term_id, 'custom_category_page_title_wptch', true);

		?>
		<tr class="form-field">
			<th scope="row"><label for="custom_category_page_title_wptch"><?php esc_html_e( 'Page Title', $this->plugin_name ); ?></label></th>
			<td>
				<input type="text" name="custom_category_page_title_wptch" id="custom_category_page_title_wptch" value="<?php echo $custom_category_page_title_wptch; ?>">
				<p class="description"><?php esc_html_e( 'Use this field if you want to override the category archive title (h1).', $this->plugin_name ); ?></p>
			</td>
		</tr>
		<?php
	}

	public function save_category_fields( $term_id ) {

		$custom_category_page_title_wptch = get_term_meta($term_id, 'custom_category_page_title_wptch', true);

		if( ! empty( $_POST['custom_category_page_title_wptch'] ) ) { // IF the user has entered text, update our field.
			 update_term_meta($term_id, 'custom_category_page_title_wptch', esc_attr($_POST['custom_category_page_title_wptch']));
		} elseif( ! empty( $custom_category_page_title_wptch ) ) {
			 update_term_meta($term_id, 'custom_category_page_title_wptch', '');
		}

	}

}
