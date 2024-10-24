<?php
/**
 * Define the internationalization functionality
 *
 * @link       http://kwirx.com
 * @since      1.0.0
 *
 * @package    Simple_Google_Translate
 * @subpackage Simple_Google_Translate/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @package    Simple_Google_Translate
 * @subpackage Simple_Google_Translate/includes
 * @author     Kwirx Creative
 */
class SGT_i18n {

    /**
     * Load the plugin text domain for translation.
     *
     * @since    1.0.0
     */
    public function load_plugin_textdomain() {
        load_plugin_textdomain(
            'simple-google-translate',
            false,
            dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
        );
    }
}
