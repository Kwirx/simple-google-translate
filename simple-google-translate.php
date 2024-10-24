<?php
/**
 * Simple Google Translate
 *
 * @package           Simple_Google_Translate
 * @author            Kwirx Creative
 * @copyright         2023 Kwirx Creative
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Simple Google Translate
 * Plugin URI:        https://kwirx.com/simple-google-translate
 * Description:       A lightweight WordPress plugin that adds Google Translate functionality to any WordPress site.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Kwirx Creative
 * Author URI:        https://kwirx.com
 * Text Domain:       simple-google-translate
 * Domain Path:       /languages
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Plugin version.
define( 'SGT_VERSION', '1.0.0' );
define( 'SGT_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'SGT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'SGT_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 */
function sgt_activate() {
    require_once SGT_PLUGIN_DIR . 'includes/class-sgt-activator.php';
    SGT_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function sgt_deactivate() {
    require_once SGT_PLUGIN_DIR . 'includes/class-sgt-deactivator.php';
    SGT_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'sgt_activate' );
register_deactivation_hook( __FILE__, 'sgt_deactivate' );

/**
 * The core plugin class.
 */
require_once SGT_PLUGIN_DIR . 'includes/class-sgt.php';

/**
 * Begins execution of the plugin.
 *
 * @since    1.0.0
 * @return   void
 */
function sgt_run() {
    $plugin = new Simple_Google_Translate();
    $plugin->run();
}

sgt_run();
