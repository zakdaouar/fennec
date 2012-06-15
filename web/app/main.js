require([
  // Global
  "app",

  // Libs
  "jquery",
  "underscore",
  "backbone",

  // views
  "views/main/loginView"
],

function(app, $, _, Backbone, LoginView) {

  var Router = Backbone.Router.extend({
    routes: {
      "": "index"
    },

    index: function() {
      var view = new LoginView();
      view.render();
      app.layout.append(view.el);
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
