/**
 * Simple Google Translate
 * @requires jQuery
 */

(function($) {
  'use strict';

  // Constants for DOM elements and values
  const ORIGINAL_LANG_OPTION = '<option value="exit">Show Original</option>';
  const SELECT_SELECTOR = '.goog-te-combo';
  const CONTAINER_SELECTOR = 'iframe[id$="container"]';
  const CLOSE_LINK_SELECTOR = 'a[id$="close"]';

  /**
   * Adds the "Show Original" option to the language select dropdown if it doesn't exist.
  */
  function addExitOption($select) {
    if (!$select.find('option[value="exit"]').length) {
      $select.prepend(ORIGINAL_LANG_OPTION);
    }
  }

  /**
   * Handles the action when "Show Original" is selected.
   * Closes the translation and resets the select to its first non-exit option.
   */
  function handleExitTranslation($select) {
    const $container = $(CONTAINER_SELECTOR);
    if ($container.length) {
      const closeLink = $container.contents().find(CLOSE_LINK_SELECTOR)[0];
      if (closeLink) {
        closeLink.click(); // Simulate clicking the close link
      }
    }
    // Reset the select to the first non-exit option
    $select.val($select.find('option:not([value="exit"]):first').val());
  }

  /**
   * Initializes the translator by adding the exit option and setting up the change handler.
   */
  function initializeTranslator() {
    const $select = $(SELECT_SELECTOR);
    if ($select.length) {
      addExitOption($select);
    }
  }

  // Document ready function
  $(document).ready(function() {
    // Initial check for the translator
    initializeTranslator();

    // Set up event listener for user interaction with the select element
    $(document).on('mouseenter focus', SELECT_SELECTOR, initializeTranslator);

  });
})(jQuery);
