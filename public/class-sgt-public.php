<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @package    Simple_Google_Translate
 * @subpackage Simple_Google_Translate/public
 */

/**
 * The public-facing functionality of the plugin.
 */
class SGT_Public {

    /**
     * The ID of this plugin.
     *
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class.
     *
     * @param string $plugin_name The name of this plugin.
     * @param string $version    The version of this plugin.
     */
    public function __construct( $plugin_name, $version ) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;

        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
        add_action( 'wp_footer', array( $this, 'add_translate_init' ) );
        add_action( 'wp_footer', array( $this, 'add_floating_window' ) );
        add_shortcode( 'google_translate', array( $this, 'google_translate_shortcode' ) );
    }

    /**
     * Get plugin settings with defaults
     */
    private function get_settings() {
        $defaults = array(
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

        $settings = get_option('sgt_settings', $defaults);
        return wp_parse_args($settings, $defaults);
    }

    /**
     * Register the stylesheets and JavaScript for the public-facing side of the site.
     */
    public function enqueue_assets() {
        // Enqueue main stylesheet
        wp_enqueue_style(
            $this->plugin_name,
            SGT_PLUGIN_URL . 'assets/css/sgt-public.css',
            array(),
            $this->version
        );

        // Add dynamic styles
        $this->add_dynamic_styles();

        // Enqueue Google Translate script
        wp_enqueue_script(
            'google-translate',
            'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit',
            array(),
            null,
            true
        );

        // Enqueue plugin script
        wp_enqueue_script(
            $this->plugin_name,
            SGT_PLUGIN_URL . 'assets/js/sgt-public.js',
            array( 'jquery' ),
            $this->version,
            true
        );

        // Localize script with correct settings structure
        $settings = $this->get_settings();
        wp_localize_script(
            $this->plugin_name,
            'sgtSettings',
            array(
                'languages' => $settings['languages'],
                'window' => $settings['window'],
                'hideTopbar' => $settings['hide_topbar']
            )
        );
    }

    /**
     * Add dynamic styles for the floating window.
     */
    private function add_dynamic_styles() {
        $settings = $this->get_settings();
        $window_settings = $settings['window'];

        if (!isset($window_settings['enabled']) || !$window_settings['enabled']) {
            return;
        }

        $position = explode('-', $window_settings['position']);
        $styles = $this->generate_dynamic_styles($window_settings, $position);
        wp_add_inline_style($this->plugin_name, $styles);
    }

    /**
     * Generate dynamic styles based on settings.
     *
     * @param array $settings Window settings.
     * @param array $position Position array.
     * @return string CSS styles.
     */
    private function generate_dynamic_styles($settings, $position) {
        $styles = "
            .sgt-floating-window {
                {$position[0]}: " . absint($settings['margin']) . "px;
                {$position[1]}: " . absint($settings['margin']) . "px;
                padding: " . absint($settings['padding']) . "px;
                background-color: " . sanitize_hex_color($settings['bg_color']) . ";
                color: " . sanitize_hex_color($settings['text_color']) . ";
                font-size: " . absint($settings['font_size']) . "px;
                line-height: " . floatval($settings['line_height']) . ";
                border-radius: " . absint($settings['border_radius']) . "px;
            }
            .goog-te-combo {
                background-color: " . sanitize_hex_color($settings['select_bg_color']) . ";
                color: " . sanitize_hex_color($settings['select_text_color']) . ";
                border-color: " . sanitize_hex_color($settings['select_border_color']) . ";
                font-size: " . absint($settings['select_font_size']) . "px;
                line-height: " . floatval($settings['select_line_height']) . ";
                border-radius: " . absint($settings['select_border_radius']) . "px;
            }
        ";

        return $styles;
    }

    /**
     * Add the initialization script to the footer.
     */
    public function add_translate_init() {
        $settings = $this->get_settings();
        $languages_string = implode(',', array_map('sanitize_text_field', $settings['languages']));
        ?>
        <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: '<?php echo esc_js(get_locale()); ?>',
                includedLanguages: '<?php echo esc_js($languages_string); ?>',
                layout: google.translate.TranslateElement.InlineLayout.VERTICAL,
                autoDisplay: false,
                multilanguagePage: true
            }, 'google_translate_element');

            <?php if ($settings['hide_topbar']): ?>
            // Hide Google Translate top bar
            var style = document.createElement('style');
            style.textContent = '.skiptranslate iframe.skiptranslate { visibility: hidden !important; }';
            document.head.appendChild(style);
            <?php endif; ?>
        }
        </script>
        <?php
    }

    /**
     * Add the floating window HTML.
     */
    public function add_floating_window() {
        $settings = $this->get_settings();
        $window_settings = $settings['window'];

        if (!isset($window_settings['enabled']) || !$window_settings['enabled']) {
            return;
        }

        $custom_text = isset($window_settings['custom_text'])
            ? esc_html($window_settings['custom_text'])
            : esc_html__('Translate Website', 'simple-google-translate');

        ?>
        <div id="sgt-floating-window" class="sgt-floating-window">
            <?php if ($custom_text): ?>
                <div class="sgt-window-text"><?php echo $custom_text; ?></div>
            <?php endif; ?>
            <div id="google_translate_element" class="sgt-translate-element"></div>
        </div>
        <?php
    }

    /**
     * Shortcode callback for displaying the Google Translate Element.
     *
     * @return string The Google Translate Element HTML.
     */
    public function google_translate_shortcode() {
        ob_start();
        ?>
        <div id="google_translate_element" class="sgt-translate-element"></div>
        <?php
        return ob_get_clean();
    }
}
