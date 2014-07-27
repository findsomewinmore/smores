'use strict';
module.exports = function(grunt) {

  grunt.initConfig({
    jshint: {
      options: {
        jshintrc: '.jshintrc'
      },
      all: [
        'Gruntfile.js',
        'assets/js/*.js',
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
          outputStyle: 'compressed',
          noCache: 'true'
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
            // Could also match cwd line above. i.e. project-directory/img/
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
            // Could also match cwd. i.e. project-directory/img/
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
