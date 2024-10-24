<?php
/**
 * Fired during plugin activation
 *
 * @link       http://kwirx.com
 * @since      1.0.0
 *
 * @package    Simple_Google_Translate
 * @subpackage Simple_Google_Translate/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @package    Simple_Google_Translate
 * @subpackage Simple_Google_Translate/includes
 * @author     Kwirx Creative
 */
class SGT_Activator {

    /**
     * Initialize default settings on activation.
     *
     * @since    1.0.0
     */
    public static function activate() {
        // Set default languages
        if ( ! get_option( 'sgt_languages' ) ) {
            update_option( 'sgt_languages', array( 'en', 'es' ) );
        }

        // Set default window settings
        if ( ! get_option( 'sgt_window_settings' ) ) {
            update_option(
                'sgt_window_settings',
                array(
                    'position'    => 'bottom-right',
                    'bg_color'    => '#ffffff',
                    'text_color'  => '#000000',
                    'padding'     => '10',
                    'custom_text' => 'Translate Website',
                    'margin'      => '20',
                )
            );
        }
    }
}
