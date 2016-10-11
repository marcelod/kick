module.exports = function (grunt) {

  grunt.initConfig({

    // Import package manifest
    pkg: grunt.file.readJSON("bootstrap-colorpickersliders.jquery.json"),

    // Banner definitions
    meta: {
      banner: "/*\n" +
        " *  <%= pkg.title || pkg.name %> - v<%= pkg.version %>\n" +
        " *\n" +
        " *  <%= pkg.description %>\n" +
        " *  <%= pkg.homepage %>\n" +
        " *\n" +
        " *  Made by <%= pkg.author.name %>\n" +
        " *  Under <%= pkg.licenses[0].type %> License\n" +
        " *\n" +
        " *  Requirements: " +
        " *\n" +
        " *      TinyColor: https://github.com/bgrins/TinyColor/\n" +
        " *\n" +
        " *  Using color math algorithms from EasyRGB Web site:/\n" +
        " *      http://www.easyrgb.com/index.php?X=MATH" +
        " */\n"
    },

    // Concat definitions
    concat: {
      js: {
        src: ["src/bootstrap.colorpickersliders.js"],
        dest: "dist/bootstrap.colorpickersliders.js"
      },
      js2: {
        src: ["src/bootstrap.colorpickersliders.nocielch.js"],
        dest: "dist/bootstrap.colorpickersliders.nocielch.js"
      },
      css: {
        src: ["src/bootstrap.colorpickersliders.css"],
        dest: "dist/bootstrap.colorpickersliders.css"
      },
      options: {
        banner: "<%= meta.banner %>"
      }
    },

    // Lint definitions
    jshint: {
      files: ["src/bootstrap.colorpickersliders.js", "src/bootstrap.colorpickersliders.nocielch.js"],
      options: {
        jshintrc: ".jshintrc"
      }
    },

    // Minify definitions
    uglify: {
      js: {
        src: ["dist/bootstrap.colorpickersliders.js"],
        dest: "dist/bootstrap.colorpickersliders.min.js"
      },
      js2: {
        src: ["dist/bootstrap.colorpickersliders.nocielch.js"],
        dest: "dist/bootstrap.colorpickersliders.nocielch.min.js"
      },
      options: {
        banner: "<%= meta.banner %>"
      }
    },

    cssmin: {
      css: {
        src: ["dist/bootstrap.colorpickersliders.css"],
        dest: "dist/bootstrap.colorpickersliders.min.css"
      },
      options: {
        banner: "<%= meta.banner %>"
      }
    }

  });

  grunt.loadNpmTasks("grunt-contrib-concat");
  grunt.loadNpmTasks("grunt-contrib-jshint");
  grunt.loadNpmTasks("grunt-contrib-uglify");
  grunt.loadNpmTasks("grunt-contrib-cssmin");

  grunt.registerTask("default", ["jshint", "concat", "uglify", "cssmin"]);
  grunt.registerTask("travis", ["jshint"]);

};
