<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @package    Simple_Google_Translate
 * @subpackage Simple_Google_Translate/admin
 */

class SGT_Admin {
    private $plugin_name;
    private $version;

    public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;

        add_action('admin_menu', array($this, 'add_plugin_admin_menu'));
        add_action('admin_init', array($this, 'register_settings'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_assets'));
    }

    public function enqueue_assets($hook) {
        if ('settings_page_simple-google-translate' !== $hook) {
            return;
        }

        wp_enqueue_style('wp-color-picker');
        wp_enqueue_style(
            $this->plugin_name . '-admin',
            plugin_dir_url(dirname(__FILE__)) . 'assets/css/sgt-admin.css',
            array('wp-color-picker'),
            $this->version
        );

        wp_enqueue_script('wp-color-picker');
        wp_enqueue_script(
            $this->plugin_name . '-admin',
            plugin_dir_url(dirname(__FILE__)) . 'assets/js/sgt-admin.js',
            array('jquery', 'wp-color-picker'),
            $this->version,
            true
        );
    }

    public function add_plugin_admin_menu() {
        add_options_page(
            'Simple Google Translate Settings',
            'Google Translate',
            'manage_options',
            'simple-google-translate',
            array($this, 'display_plugin_setup_page')
        );
    }

    public function register_settings() {
        register_setting(
            'sgt_settings',
            'sgt_settings',
            array($this, 'sanitize_settings')
        );

        // Languages Section
        add_settings_section(
            'sgt_languages_section',
            '',
            '__return_false',
            'simple-google-translate-languages'
        );

        // Floating Widget Section
        add_settings_section(
            'sgt_floating_widget_section',
            'Floating Widget Settings',
            '__return_false',
            'simple-google-translate-floating'
        );

        // Custom Text Section
        add_settings_section(
            'sgt_custom_text_section',
            'Custom Text Settings',
            '__return_false',
            'simple-google-translate-floating'
        );

        // Select Box Section
        add_settings_section(
            'sgt_select_box_section',
            'Select Box Settings',
            '__return_false',
            'simple-google-translate-floating'
        );

        // Add Language fields
        add_settings_field(
            'sgt_languages',
            'Select Languages',
            array($this, 'render_languages_field'),
            'simple-google-translate-languages',
            'sgt_languages_section'
        );

        add_settings_field(
            'sgt_hide_topbar',
            'Hide Translation Bar',
            array($this, 'render_hide_topbar_field'),
            'simple-google-translate-languages',
            'sgt_languages_section'
        );

        $this->add_window_fields();
    }

    private function add_window_fields() {
        // Floating Widget Settings
        $widget_fields = array(
            'enabled' => array('label' => 'Enable Floating Window', 'type' => 'toggle'),
            'position' => array('label' => 'Window Position', 'type' => 'select'),
            'margin' => array('label' => 'Distance from Edge (px)', 'type' => 'number'),
            'padding' => array('label' => 'Padding (px)', 'type' => 'number'),
            'bg_color' => array('label' => 'Background Color', 'type' => 'color'),
            'border_radius' => array('label' => 'Border Radius (px)', 'type' => 'number'),
        );

        foreach ($widget_fields as $field => $config) {
            add_settings_field(
                'sgt_window_' . $field,
                $config['label'],
                array($this, 'render_window_field'),
                'simple-google-translate-floating',
                'sgt_floating_widget_section',
                array('field' => $field, 'type' => $config['type'])
            );
        }

        // Custom Text Settings
        $text_fields = array(
            'custom_text' => array('label' => 'Custom Text', 'type' => 'text'),
            'text_color' => array('label' => 'Text Color', 'type' => 'color'),
            'font_size' => array('label' => 'Font Size (px)', 'type' => 'number'),
            'line_height' => array('label' => 'Line Height', 'type' => 'number'),
        );

        foreach ($text_fields as $field => $config) {
            add_settings_field(
                'sgt_window_' . $field,
                $config['label'],
                array($this, 'render_window_field'),
                'simple-google-translate-floating',
                'sgt_custom_text_section',
                array('field' => $field, 'type' => $config['type'])
            );
        }

        // Select Box Settings
        $select_fields = array(
            'select_bg_color' => array('label' => 'Background Color', 'type' => 'color'),
            'select_text_color' => array('label' => 'Text Color', 'type' => 'color'),
            'select_border_color' => array('label' => 'Border Color', 'type' => 'color'),
            'select_border_radius' => array('label' => 'Border Radius (px)', 'type' => 'number'),
            'select_font_size' => array('label' => 'Font Size (px)', 'type' => 'number'),
            'select_line_height' => array('label' => 'Line Height', 'type' => 'number'),
        );

        foreach ($select_fields as $field => $config) {
            add_settings_field(
                'sgt_window_' . $field,
                $config['label'],
                array($this, 'render_window_field'),
                'simple-google-translate-floating',
                'sgt_select_box_section',
                array('field' => $field, 'type' => $config['type'])
            );
        }
    }

    public function render_languages_field() {
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/languages.php';
        $languages = sgt_get_supported_languages();
        $settings = get_option('sgt_settings', $this->get_default_settings());
        $selected_languages = isset($settings['languages']) ? $settings['languages'] : array('en', 'es');

        ?>
        <div class="sgt-languages-wrapper">
            <div class="sgt-languages-list">
                <?php
                foreach ($languages as $code => $lang) {
                    printf(
                        '<label>
                            <input type="checkbox" name="sgt_settings[languages][]" value="%1$s" %2$s>
                            <img src="https://flagcdn.com/16x12/%3$s.png" alt="%4$s flag" loading="lazy">
                            <span class="sgt-language-name">%4$s</span>
                        </label>',
                        esc_attr($code),
                        checked(in_array($code, $selected_languages, true), true, false),
                        esc_attr($lang['flag']),
                        esc_html($lang['name'])
                    );
                }
                ?>
            </div>
        </div>
        <?php
    }

    public function render_hide_topbar_field() {
        $settings = get_option('sgt_settings', $this->get_default_settings());
        $hide_topbar = isset($settings['hide_topbar']) ? $settings['hide_topbar'] : false;
        ?>
        <div class="sgt-settings-field">
            <label class="sgt-toggle">
                <input type="checkbox" name="sgt_settings[hide_topbar]" value="1" <?php checked($hide_topbar, true); ?>>
                <span class="sgt-toggle-slider"></span>
            </label>
            <p class="description">
                <?php esc_html_e('Enable this option to hide the Google Translate bar that appears at the top of the content.', 'simple-google-translate'); ?>
            </p>
        </div>
        <?php
    }

    public function render_window_field($args) {
        if (!current_user_can('manage_options')) {
            return;
        }

        $settings = get_option('sgt_settings', $this->get_default_settings());
        $field = $args['field'];
        $type = $args['type'];
        $value = isset($settings['window'][$field]) ? $settings['window'][$field] : '';

        switch ($type) {
            case 'toggle':
                $this->render_toggle_field($field, $value);
                break;

            case 'select':
                $this->render_position_field($value);
                break;

            case 'color':
                $this->render_color_field($field, $value);
                break;

            case 'number':
                $min = in_array($field, array('line_height', 'select_line_height')) ? 0.1 : 0;
                $max = in_array($field, array('line_height', 'select_line_height')) ? 3 : 100;
                $step = in_array($field, array('line_height', 'select_line_height')) ? 0.1 : 1;
                $this->render_number_field($field, $value, $min, $max, $step);
                break;

            default:
                $this->render_text_field($field, $value);
                break;
        }
    }

    private function render_toggle_field($field, $value) {
        ?>
        <label class="sgt-toggle">
            <input type="checkbox" 
                   name="sgt_settings[window][<?php echo esc_attr($field); ?>]" 
                   value="1" 
                   <?php checked($value, true); ?>>
            <span class="sgt-toggle-slider"></span>
        </label>
        <?php
    }

    private function render_position_field($value) {
        $positions = array(
            'top-left' => 'Top Left',
            'top-right' => 'Top Right',
            'bottom-left' => 'Bottom Left',
            'bottom-right' => 'Bottom Right'
        );

        echo '<select name="sgt_settings[window][position]" class="regular-text">';
        foreach ($positions as $pos => $label) {
            printf(
                '<option value="%1$s" %2$s>%3$s</option>',
                esc_attr($pos),
                selected($value, $pos, false),
                esc_html($label)
            );
        }
        echo '</select>';
    }

    private function render_color_field($field, $value) {
        printf(
            '<input type="text" 
                   name="sgt_settings[window][%1$s]" 
                   value="%2$s" 
                   class="sgt-color-picker" 
                   data-alpha-enabled="true">',
            esc_attr($field),
            esc_attr($value)
        );
    }

    private function render_number_field($field, $value, $min, $max, $step) {
        printf(
            '<input type="number" 
                   name="sgt_settings[window][%1$s]" 
                   value="%2$s" 
                   min="%3$s" 
                   max="%4$s" 
                   step="%5$s" 
                   class="small-text">',
            esc_attr($field),
            esc_attr($value),
            esc_attr($min),
            esc_attr($max),
            esc_attr($step)
        );
    }

    private function render_text_field($field, $value) {
        printf(
            '<input type="text" 
                   name="sgt_settings[window][%1$s]" 
                   value="%2$s" 
                   class="regular-text">',
            esc_attr($field),
            esc_attr($value)
        );
    }

    private function get_default_settings() {
        return array(
            'languages' => array('en', 'es'),
            'hide_topbar' => false,
            'window' => array(
                'enabled' => true,
                'position' => 'bottom-right',
                'margin' => '20',
                'padding' => '10',
                'bg_color' => '#ffffff',
                'border_radius' => '4',
                'custom_text' => 'Translate Website',
                'text_color' => '#000000',
                'font_size' => '14',
                'line_height' => '1.4',
                'select_bg_color' => '#ffffff',
                'select_text_color' => '#000000',
                'select_border_color' => '#cccccc',
                'select_border_radius' => '4',
                'select_font_size' => '14',
                'select_line_height' => '1.4',
            )
        );
    }

    public function sanitize_settings($input) {
        $old_settings = get_option('sgt_settings', $this->get_default_settings());
        $sanitized = $old_settings;

        // Update only the relevant section based on what was submitted
        if (isset($input['languages'])) {
            $sanitized['languages'] = $this->sanitize_languages($input['languages']);
            $sanitized['hide_topbar'] = isset($input['hide_topbar']);
        }

        if (isset($input['window'])) {
            $sanitized['window'] = $this->sanitize_window_settings($input['window']);
        }

        return $sanitized;
    }

    private function sanitize_languages($input) {
        if (!is_array($input)) {
            return array('en', 'es');
        }
        return array_map('sanitize_text_field', $input);
    }

    private function sanitize_window_settings($input) {
        if (!is_array($input)) {
            return $this->get_default_settings()['window'];
        }

        $defaults = $this->get_default_settings()['window'];
        $sanitized = array();

        // Boolean fields
        $sanitized['enabled'] = isset($input['enabled']) ? (bool) $input['enabled'] : $defaults['enabled'];

        // Position
        $valid_positions = array('top-left', 'top-right', 'bottom-left', 'bottom-right');
        $sanitized['position'] = in_array($input['position'], $valid_positions, true) ? $input['position'] : $defaults['position'];

        // Colors
        $color_fields = array('bg_color', 'text_color', 'select_bg_color', 'select_text_color', 'select_border_color');
        foreach ($color_fields as $field) {
            $sanitized[$field] = sanitize_hex_color($input[$field]) ?: $defaults[$field];
        }

        // Numbers
        $number_fields = array(
            'margin' => array(0, 100),
            'padding' => array(0, 100),
            'border_radius' => array(0, 100),
            'font_size' => array(8, 32),
            'select_font_size' => array(8, 32),
            'select_border_radius' => array(0, 100),
        );

        foreach ($number_fields as $field => $range) {
            $sanitized[$field] = $this->sanitize_number($input[$field], $range[0], $range[1], $defaults[$field]);
        }

        // Line heights
        $sanitized['line_height'] = $this->sanitize_number($input['line_height'], 0.1, 3, $defaults['line_height']);
        $sanitized['select_line_height'] = $this->sanitize_number($input['select_line_height'], 0.1, 3, $defaults['select_line_height']);

        // Text
        $sanitized['custom_text'] = sanitize_text_field($input['custom_text']);

        return $sanitized;
    }

    private function sanitize_number($value, $min, $max, $default) {
        $number = floatval($value);
        if ($number < $min || $number > $max) {
            return $default;
        }
        return $number;
    }

    public function display_plugin_setup_page() {
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/sgt-admin-display.php';
    }
}
