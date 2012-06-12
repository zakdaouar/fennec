define([
  // Libs
  "jquery",
  "lodash",
  "backbone"
],

function($, _, Backbone) {
  
  var JST = window.JST = window.JST || {};

  return _.extend({

    fetchTemplate: function(path) {
      path += ".html";

      if (!JST[path]) {
        $.ajax({
          url: "/" + path,
          dataType: "text",
          cache: false,
          async: false,

          success: function(contents) {
            JST[path] = _.template(contents);
          }
        });
      }

      return JST[path];
    },

    module: function(additionalProps) {
      return _.extend({ Views: {} }, additionalProps);
    },

    // Change this to handle routes correctly
    root: '/~riad/fennec/web/index.php/'

  }, Backbone.Events);
});
