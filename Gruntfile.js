'use strict';
/*global module, require*/

module.exports = function config(grunt) {
  require('load-grunt-tasks')(grunt);
  grunt.initConfig({

    eslint: {
      options: {
        configFile: '.eslintrc'
      },
      target: [
        'Gruntfile.js',
        'assets/js/**/*.js',
        '!assets/js/vendor/*.js',
        '!assets/js/scripts.min.js'
      ]
    },

    sass: {
      dist: {
        files: {
          'assets/css/styles.min.css': [
            'assets/scss/style.scss'
          ]
        },
        options: {
          style: 'compressed',

          noCache: true
        }
      }
    },

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
            'assets/js/_*.js',
            '!assets/bower_components/foundation/js/vendor/jquery.js',
            '!assets/bower_components/foundation/js/vendor/modernizr.js'
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

    favicons: {
      options: {
        trueColor: true,
        precomposed: true,
        appleTouchBackgroundColor: '#FFFFFF',
        coast: true,
        windowsTile: true,
        tileBlackWhite: false,
        tileColor: 'auto',
        html: 'partials/meta-favicons.php',
        HTMLPrefix: '<?php echo get_stylesheet_directory_uri(); ?>/assets/img/favicons/'
      },
      icons: {
        src: 'assets/img/favicons/favicon.src.png',
        dest: 'assets/img/favicons'
      }
    },

    watch: {
      sass: {
        files: [
          'assets/**/*.scss'
        ],
        tasks: ['sass:dist']
      },
      images: {
        files: ['assets/img/src/**/*.{png,jpg}'],
        tasks: ['imagemin']
      },
      js: {
        files: [
          'Gruntfile.js',
          'assets/js/*.js'
        ],
        tasks: ['eslint', 'uglify']
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

    clean: {
      dist: [
        'assets/css/styles.min.css',
        'assets/js/scripts.min.js'
      ]
    }
  });

  grunt.registerTask('default', [
    'clean',
    'sass',
    'eslint',
    'uglify',
    'imagemin',
    'modernizr'
  ]);
  grunt.registerTask('dev', [
    'watch'
  ]);

};
