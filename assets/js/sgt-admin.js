/**
 * Simple Google Translate Admin JavaScript
 *
 * Handles all admin-specific functionality
 */
(function($) {
    'use strict';

    // Initialize color pickers
    function initColorPickers() {
        $('.sgt-color-picker').wpColorPicker({
            change: function(event, ui) {
                $(this).val(ui.color.toString());
                $(this).trigger('change');
            },
            clear: function() {
                $(this).trigger('change');
            }
        });
    }

    // Initialize position dependent fields
    function initPositionFields() {
        const $position = $('select[name="sgt_window_settings[position]"]');
        const $margin = $('input[name="sgt_window_settings[margin]"]');

        function updateMarginLabel() {
            const position = $position.val();
            const directions = position.split('-');
            const label = `Distance from ${directions[0]} and ${directions[1]} edges (px)`;
            $margin.closest('tr').find('th label').text(label);
        }

        $position.on('change', updateMarginLabel);
        updateMarginLabel();
    }

    // Handle language selection
    function initLanguageSelection() {
        const $languageList = $('.sgt-languages-list');
        const $checkboxes = $languageList.find('input[type="checkbox"]');

        // Ensure at least one language is selected
        $checkboxes.on('change', function() {
            const checkedCount = $checkboxes.filter(':checked').length;
            if (checkedCount === 0) {
                $(this).prop('checked', true);
                alert('At least one language must be selected.');
            }
        });

        // Add search functionality
        const $searchInput = $('<input type="text" class="sgt-language-search" placeholder="Search languages...">');
        $languageList.before($searchInput);

        $searchInput.on('input', function() {
            const searchTerm = $(this).val().toLowerCase();
            $languageList.find('label').each(function() {
                const text = $(this).text().toLowerCase();
                $(this).toggle(text.includes(searchTerm));
            });
        });
    }

    // Handle floating window toggle
    function initFloatingWindow() {
        const $enableToggle = $('input[name="sgt_window_settings[enabled]"]');
        const $windowSettings = $('#sgt_window_section').find('tr').not(':first');

        function toggleWindowSettings() {
            $windowSettings.toggle($enableToggle.is(':checked'));
        }

        $enableToggle.on('change', toggleWindowSettings);
        toggleWindowSettings();
    }

    // Initialize all admin functionality
    function init() {
        try {
            initColorPickers();
            initPositionFields();
            initLanguageSelection();
            initFloatingWindow();
        } catch (error) {
            console.error('Error initializing Simple Google Translate admin:', error);
        }
    }

    // Initialize when document is ready
    $(document).ready(init);

})(jQuery);
