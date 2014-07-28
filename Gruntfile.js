/**
 * Starting Gruntfile.js
 *
 * This is the most basic Gruntfile that we will use.
 * Browse through the code for more detailed comments on
 * individual tasks and functions
 */
'use strict';
module.exports = function(grunt) {

  grunt.initConfig({

/**
 * This is our jshint task.
 * It validates our javascript and
 * gives us feedback.
 */
    jshint: {
      options: {
        jshintrc: '.jshintrc'
      },
      all: [
        'Gruntfile.js',
        'assets/js/*.js',
        //When a file begins with !, that means do not add the file
        '!assets/js/vendor/*.js',
        '!assets/js/scripts.min.js'
      ]
    },
/**
 * This is our sass task.
 * It compiles our sass into css.
 */
    sass: {
      dist: {
        files: {
          'assets/css/styles.min.css': [
            'assets/scss/style.scss'
          ]
        },
        options: {
          //Minify our css
          outputStyle: 'compressed', 
          //Do not create a .sass-cache directory
          noCache: 'true'
        }
      }
    },
/**
 * This is our uglify task.
 * It concatonates and minifies 
 * our javascript.
 *
 * Please comment out or delete any
 * references to unused foundation plugins.
 */
    uglify: {
      dist: {
        files: {
          'assets/js/scripts.min.js': [
            'assets/bower_components/foundation/js/foundation/foundation.js',
            'assets/bower_components/foundation/js/foundation/foundation.abide.js',
            'assets/bower_components/foundation/js/foundation/foundation.accordian.js',
            'assets/bower_components/foundation/js/foundation/foundation.alert.js',
            'assets/bower_components/foundation/js/foundation/foundation.clearing.js',
            'assets/bower_components/foundation/js/foundation/foundation.dropdown.js',
            'assets/bower_components/foundation/js/foundation/foundation.equalizer.js',
            'assets/bower_components/foundation/js/foundation/foundation.interchange.js',
            'assets/bower_components/foundation/js/foundation/foundation.joyride.js',
            'assets/bower_components/foundation/js/foundation/foundation.magellan.js',
            'assets/bower_components/foundation/js/foundation/foundation.offcanvas.js',
            'assets/bower_components/foundation/js/foundation/foundation.orbit.js',
            'assets/bower_components/foundation/js/foundation/foundation.reveal.js',
            'assets/bower_components/foundation/js/foundation/foundation.slider.js',
            'assets/bower_components/foundation/js/foundation/foundation.tab.js',
            'assets/bower_components/foundation/js/foundation/foundation.tooltip.js',
            'assets/bower_components/foundation/js/foundation/foundation.topbar.js',
            'assets/bower_components/foundation/js/vendor/*.js',
            '!assets/bower_components/foundation/js/vendor/jquery.js',
            '!assets/bower_components/foundation/js/vendor/modernizr.js',
            'assets/js/_*.js'
          ],
          'assets/js/vendor/html5shiv.min.js': [
            'assets/bower_components/html5shiv/dist/html5shiv.min.js'
          ],
          'assets/js/vendor/respond.min.js': [
            'assets/bower_components/respond/dest/respond.min.js'
          ],
          'assets/js/vendor/jquery.min.js': [
            'assets/bower_components/jquery/dist/jquery.min.js'
          ]
        }
      }
    },
/**
 * This is our imagemin task.
 * It optimizes our PNGs and JPGs.
 * If you want to optimize an image, make
 * sure to put it in the assets/img/src/ directory
 */
    imagemin: {
      png: {
        options: {
          optimizationLevel: 4
        },
        files: [
          {
            // Set to true to enable the following options…
            expand: true,
            // cwd is 'current working directory'
            cwd: 'assets/img/src',
            src: [
              '**/*.png'
            ],
            // Could also match cwd line above.
            dest: 'assets/img/',
            ext: '.png'
          }
        ]
      },
      jpg: {
        options: {
          progressive: true
        },
        files: [
          {
            // Set to true to enable the following options…
            expand: true,
            // cwd is 'current working directory'
            cwd: 'assets/img/src',
            src: [
              '**/*.jpg'
            ],
            // Could also match cwd. 
            dest: 'assets/img/',
            ext: '.jpg'
          }
        ]
      }
    },
/**
 * This is our modernizr task.
 * It looks at our css and js
 * and generates a lean build of
 * modernizr with only the tests
 * that we need. 
 */
    modernizr: {
      build: {
        devFile: 'assets/bower_components/modernizr/modernizr.js',
        outputFile: 'assets/js/vendor/modernizr.min.js',
        files: {
          'src': [
            ['assets/js/scripts.min.js'],
            ['assets/css/styles.min.css']
          ]
        },
        uglify: true,
        parseFiles: true
      }
    },
/**
 * This is our watch task.
 * It watches certain types
 * of files for certain tasks
 * and then executes the grunt default
 * command when a file is changed/added
 */
    watch: {
      sass: {
        files: [
          'assets/scss/**/*.scss',
        ],
        tasks: ['sass:dist']
      },
      images: {
        files: ['assets/img/src/**/*.{png,jpg}'],
        tasks: ['imagemin'],
      },
      js: {
        files: [
          '<%= jshint.all %>'
        ],
        tasks: ['jshint', 'uglify']
      },
      livereload: {
        options: {
          livereload: true
        },
        files: [
          'assets/css/styles.min.css',
          'assets/js/scripts.min.js',
          '*.html'
        ]
      }
    },
/**
 * This is our clear task.
 * It deletes the conents of the files
 * before anything is compliled into them
 * to prevent code from being duplicated
 */
    clean: {
      dist: [
        'assets/css/styles.min.css',
        'assets/js/scripts.min.js'
      ]
    }
  });

  // Load tasks
  grunt.loadNpmTasks('grunt-contrib-clean');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-imagemin');
  grunt.loadNpmTasks('grunt-modernizr');
  grunt.loadNpmTasks('grunt-sass');

  // Register tasks
  grunt.registerTask('default', [
    'clean',
    'sass:dist',
    'uglify',
    'imagemin',
    'modernizr'
  ]);
  grunt.registerTask('dev', [
    'watch'
  ]);

};
