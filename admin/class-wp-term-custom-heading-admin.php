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
				<input type="text" name="custom_category_page_title_wptch" id="custom_category_page_title_wptch" value="<?php echo esc_attr( $custom_category_page_title_wptch ); ?>">
				<p class="description"><?php esc_html_e( 'Use this field if you want to override the category archive title (h1).', $this->plugin_name ); ?></p>
			</td>
		</tr>
		<?php
	}

	public function save_category_fields( $term_id ) {

		// Verify nonce — accept either the "new" or "edit" nonce.
		$valid_nonce = false;
		if ( isset( $_POST['category_meta_new_wptch_nonce'] ) ) {
			$valid_nonce = wp_verify_nonce( $_POST['category_meta_new_wptch_nonce'], 'category_meta_new_wptch' );
		} elseif ( isset( $_POST['category_meta_edit_wptch_nonce'] ) ) {
			$valid_nonce = wp_verify_nonce( $_POST['category_meta_edit_wptch_nonce'], 'category_meta_edit_wptch' );
		}

		if ( ! $valid_nonce ) {
			return;
		}

		// Capability check.
		if ( ! current_user_can( 'manage_categories' ) ) {
			return;
		}

		if ( isset( $_POST['custom_category_page_title_wptch'] ) ) {
			$value = sanitize_text_field( wp_unslash( $_POST['custom_category_page_title_wptch'] ) );
			update_term_meta( $term_id, 'custom_category_page_title_wptch', $value );
		}

	}

}
