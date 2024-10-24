(function($) {
  'use strict';

  function initializeTranslator() {
      var $select = $('.goog-te-combo');
      if ($select.length) {
          // Only add exit translation option if select language option exists
          if (!$select.find('option[value="exit"]').length) {
              $select.prepend('<option value="exit">Show Original</option>');
          }

          // Handle select change
          $select.off('change').on('change', function() {
              if ($(this).val() === 'exit') {
                  var $container = $('iframe[id$="container"]');
                  if ($container.length) {
                      var containerDocument = $container.contents();
                      var closeLink = containerDocument.find('a[id$="close"]');
                      if (closeLink.length) {
                          closeLink[0].click();
                      }
                  }
                  $(this).val($(this).find('option:not([value="exit"]):first').val());
              }
          });
      }
  }

  // Check for select element periodically
  $(document).ready(function() {
      // Initial check
      initializeTranslator();
      
      // Keep checking every 500ms for dynamic elements
      setInterval(initializeTranslator, 500);
  });
})(jQuery);
