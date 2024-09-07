(function (Drupal, drupalSettings) {
  Drupal.behaviors.myCustomBehavior = {
    attach: function (context, settings) {
      console.log('PHP to Js:', drupalSettings.myCustomModule.someValue);

      console.log('Attaching behavior to context:', context);

      if (drupalSettings.myCustomModule.someValue === 'change_color') {
        document.querySelector('.node').style.backgroundColor = '#40ff00';
      }
    }
  };
})(Drupal, drupalSettings);
