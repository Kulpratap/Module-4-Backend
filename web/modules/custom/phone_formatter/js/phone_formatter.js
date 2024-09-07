(function ($, Drupal) {
  Drupal.behaviors.phoneFormatter = {
    attach: function (context, settings) {
      $('input.phone-number', context).once('phoneFormatter').each(function () {
        $(this).on('input', function () {
          var input = $(this).val().replace(/\D/g, '');
          if (input.length >= 10) {
            input = '(' + input.substring(0, 3) + ') ' + input.substring(3, 6) + '-' + input.substring(6, 10);
            $(this).val(input);
          }
        });
      });
    }
  };
})(jQuery, Drupal);
