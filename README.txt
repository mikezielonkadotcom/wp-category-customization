=== WP Term Custom Heading ===
Contributors: mikezielonka
Tags: kadence, categories
Requires at least: 5.5
Tested up to: 6.7
Requires PHP: 7.4
Stable tag: 1.5.0
License: GPL-2.0+
License URI: https://www.gnu.org/licenses/gpl-2.0.txt

This plugin adds the ability to have a custom h1 title on categories like how Genesis does archive headlines.

== Description ==

This plugin adds the ability to have a custom h1 title on categories like how Genesis does archive headlines.

== Installation ==

Installing the plugin:

1. In your WordPress admin panel, go to Plugins > New Plugin, search for "WP Term Custom Heading" and click "Install now"
2. Alternatively, download the plugin and upload the contents of wp-category-customization.zip to your plugins directory, which usually is /wp-content/plugins/.
3. Activate the plugin

== Frequently Asked Questions ==

= Which themes are supported? =

All themes are supported which uses the "get_the_archive_title" hook to display the category title on the frontend.

= How to customize this title? =

You can use CSS in the Theme Customizer.

= How the option is named in the backend? =

The custom category title is named "Page Title" in the add/edit category pages.

= What taxonomies are supported? =

The default WordPress category taxonomy is supported.

== Screenshots ==

1. You can override the archive title with this custom field.

== Changelog ==

= 1.5.0 =
* Security: Register the term meta with register_term_meta() so REST, WP-CLI and other plugins all pass through sanitize_text_field() and a manage_categories check.
* Security: Escape the custom archive title with esc_html() on output.
* Security: Unslash and sanitize nonce values before wp_verify_nonce().
* Fix: Use get_queried_object() instead of get_category( get_query_var( 'cat' ) ), which produced a PHP warning on multi-category or negative cat queries.
* Fix: Use the literal text domain in admin strings so translation tools pick them up.
* Fix: Uninstall now removes the meta in a single delete_metadata() call.
* Update: Add Requires at least, Requires PHP and Update URI plugin headers.
* Update: Upgrade bundled plugin-update-checker from 5.5 to 5.7 and restrict release assets to .zip files.
* Update: Release workflow verifies the tag matches the plugin Version header and pins actions to commit SHAs.
* Chore: Remove the empty activator and deactivator boilerplate classes.

= 1.4.0 =
* Security: Add nonce verification and capability checks on save.
* Security: Fix XSS — escape output on edit form.
* Fix: Use sanitize_text_field() instead of esc_attr() for input sanitization.
* Fix: Register archive title override as filter instead of action.
* Update: Bump minimum WordPress requirement to 5.5 (uses 3-arg filter signature).

= 1.3.1 =
* Test release workflow.

= 1.3.0 =
* Fix double https:// in author and plugin URIs.
* Add automatic update checking from GitHub.
* Update license URI to HTTPS.

= 1.2 =
* Fix typo.

= 1.1 =
* Fixes and improvements.

= 1.0 =
* First release.