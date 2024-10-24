<?php
/**
 * Admin settings page template
 *
 * @package    Simple_Google_Translate
 * @subpackage Simple_Google_Translate/admin/partials
 */

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

// Check user capabilities
if (!current_user_can('manage_options')) {
    return;
}

// Show success message if settings were saved
if (isset($_GET['settings-updated'])) {
    add_settings_error(
        'sgt_messages',
        'sgt_message',
        __('Settings Saved', 'simple-google-translate'),
        'updated'
    );
}

// Get current tab
$current_tab = isset($_GET['tab']) ? sanitize_text_field(wp_unslash($_GET['tab'])) : 'languages';

// Define tabs
$tabs = array(
    'languages' => __('Languages', 'simple-google-translate'),
    'floating' => __('Floating Widget', 'simple-google-translate'),
);
?>

<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

    <nav class="nav-tab-wrapper">
        <?php foreach ($tabs as $tab => $name) : ?>
            <a href="?page=simple-google-translate&tab=<?php echo esc_attr($tab); ?>" 
               class="nav-tab <?php echo $current_tab === $tab ? 'nav-tab-active' : ''; ?>">
                <?php echo esc_html($name); ?>
            </a>
        <?php endforeach; ?>
    </nav>

    <form action="options.php" method="post" class="sgt-settings-form">
        <?php
        settings_fields('sgt_settings');
        
        if ('languages' === $current_tab) {
            // Languages tab content
            ?>
            <div class="sgt-languages-section">
                <input type="text" 
                       id="sgt-language-search" 
                       class="sgt-language-search" 
                       placeholder="<?php esc_attr_e('Search languages...', 'simple-google-translate'); ?>"
                       autocomplete="off">
                <?php do_settings_sections('simple-google-translate-languages'); ?>
            </div>
            <?php
        } else {
            // Floating selector tab content
            ?>
            <div class="sgt-floating-section">
                <div class="sgt-settings-group">
                    <?php do_settings_sections('simple-google-translate-floating'); ?>
                </div>
            </div>
            <?php
        }

        submit_button();
        ?>
    </form>
</div>

<script>
jQuery(document).ready(function($) {
    // Language search functionality
    $('#sgt-language-search').on('input', function() {
        var searchText = $(this).val().toLowerCase();
        $('.sgt-languages-list label').each(function() {
            var languageName = $(this).find('.sgt-language-name').text().toLowerCase();
            $(this).toggle(languageName.includes(searchText));
        });
    });
});
</script>
