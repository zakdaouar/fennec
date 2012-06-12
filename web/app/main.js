require([
  // Global
  "app",

  // Libs
  "jquery",
  "backbone"
],

function(app, $, Backbone) {

  var Router = Backbone.Router.extend({
    routes: {
      "": "index",
      "test": "test"
    },

    index: function() {
      console.log('index');
    },

    test: function() {
      console.log('test');
    }

  });

  $(function() {
    app.router = new Router();
    Backbone.history.start({ pushState: true, root: app.root});
  });


  $(document).on("click", "a:not([data-bypass])", function(evt) {
    var href = $(this).attr("href");
    var protocol = this.protocol + "//";

    if (href && href.slice(0, protocol.length) !== protocol &&
        href.indexOf("javascript:") !== 0) {
      evt.preventDefault();
      Backbone.history.navigate(href, true);
    }
  });

});
