module.exports = function(grunt) {
	'use strict';

	grunt.initConfig({
		jshint: {
			options: {
				jshintrc: '.jshintrc'
			},
			all: [
				'js/controllers/*.js',
				'js/filters/*.js',
				'js/services/*.js',
				'js/app.js'
			]
		},
		less: {
			development: {
				options: {
					paths: ['css']
				},
				files: {
					'css/styles.dev.css' : 'less/styles.less'
				}
			},
			production: {
				options: {
					paths: ['css'],
					cleancss: true
				},
				files: {
					'css/styles.min.css' : 'less/styles.less'
				}
			}
		},
		uglify: {
			development: {
				options: {
					mangle: false,
					beautify: true
				},
				files: {
					'js/scripts.dev.js': [
//						'js/vendor/bootstrap.js',
//						'js/vendor/angular.js',
						'js/app.js',
						'js/services/postTypesAPI.js',
						'js/controllers/postTypesCtrl.js'
					]
				}
			},
			production: {
				options: {
					compress: {
						global_defs: {
							'DEBUG': false
						},
						dead_code: true,
						drop_console: true
					}
				},
				files: {
					'js/scripts.min.js': [
						'js/scripts.dev.js'
					]
				}
			}
		},

		watch: {
			less: {
				files: [
					'less/styles.less'
				],
				tasks: ['less:development'],
				options: {
					spawn: false
				}
			},
			js: {
				files: [
					'js/**/*.js',
					'Gruntfile.js'
				],
				tasks: ['uglify:development'],
				options: {
					spawn: false
				}
			}
		},
		clean: {
			dist: [
				'css/styles.min.css',
				'js/scripts.min.js'
			]
		}
	});

	// Load tasks
	grunt.loadNpmTasks('grunt-contrib-clean');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-less');

	// Register tasks
	grunt.registerTask('default', [
//		'jshint',
		'clean',
		'uglify',
		'less'
	]);

	grunt.registerTask('prod', [
//		'jshint',
		'clean',
		'uglify:production',
		'less:production'
	]);

	grunt.registerTask('dev', [
		'watch'
	]);

};