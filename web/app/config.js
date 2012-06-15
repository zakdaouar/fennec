require.config({

  deps: ["main"],

  paths: {
    // JavaScript folders
    libs: "../assets/js/libs",
    plugins: "../assets/js/plugins",
    templates: "../assets/templates",

    // Libraries
    jquery: "../assets/js/libs/jquery",
    backbone: "../assets/js/libs/backbone",
    underscore: "../assets/js/libs/underscore",
    text: "../assets/js/libs/text"
  },

  shim: {
    underscore: {
      exports: "_"
    },
    backbone: {
      deps: ["underscore", "jquery"],
      exports: "Backbone"
    }
  }

});
