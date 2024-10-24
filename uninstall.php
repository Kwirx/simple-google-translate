<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @link       http://kwirx.com
 * @since      1.0.0
 *
 * @package    Simple_Google_Translate
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

/**
 * Clean up plugin data.
 */
function sgt_cleanup_plugin_data() {
    global $wpdb;

    // Remove plugin options
    delete_option('sgt_settings');

    // Remove any transients
    delete_transient('sgt_cache');

    // Clean up any custom capabilities
    $roles = wp_roles();
    if (!empty($roles)) {
        foreach ($roles->role_objects as $role) {
            $role->remove_cap('manage_sgt_options');
        }
    }

    // If using multisite, clean up each blog
    if (is_multisite()) {
        // Get all blog ids
        $blog_ids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
        
        // Loop through each blog
        foreach ($blog_ids as $blog_id) {
            switch_to_blog($blog_id);
            
            // Delete options for each site
            delete_option('sgt_settings');
            delete_transient('sgt_cache');

            // Clean up capabilities for each site
            $roles = wp_roles();
            if (!empty($roles)) {
                foreach ($roles->role_objects as $role) {
                    $role->remove_cap('manage_sgt_options');
                }
            }
            
            restore_current_blog();
        }
    }

    // Clear any cached data
    wp_cache_flush();
}

// Run cleanup
sgt_cleanup_plugin_data();
