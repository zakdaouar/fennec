define([
  // Global
  "app",

  // Libs
  "jquery",
  "underscore",
  "backbone",
  "text!templates/main/login.html"
],

function(app, $, _, Backbone, login_template) {

  var LoginView = Backbone.View.extend({
    id: 'login',
    render: function ( event ) {
      var _compiled_template = _.template(login_template);
      $(this.el).html(_compiled_template());
      return this;
    }
  });

  return LoginView;
});