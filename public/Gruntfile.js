module.exports = function (grunt){
	grunt.initConfig({
		pkg: grunt.file.readJSON("package.json"),

		// FOLLOWING IS THE JS BUILD PROCESS //
		// ngAnnotate for standardize angular module injection
		ngAnnotate: {
			options: {
				singleQuotes: true,
			},
			examapp: {
				files: [
					{
						expand: true,
						src: ['htmlapp/examApp/examApp.js','htmlapp/syscommon/kidsitanimatelib.js'],
						ext: '.annotated.js', // Dest filepaths will have this extension.
						extDot: 'last',       // Extensions in filenames begin after the last dot
					},
				],
			},
			yinbiaoapp: {
				files: [
					{
						expand: true,
						src: ['htmlapp/yinbiaoApp/angularinit.js','htmlapp/yinbiaoApp/highlightppattern.js',
							'htmlapp/syscommon/kidsitanimatelib.js','htmlapp/yinbiaoApp/guestaddword.js','htmlapp/yinbiaoApp/yinbiaoapp.js',],
						ext: '.annotated.js', // Dest filepaths will have this extension.
						extDot: 'last',       // Extensions in filenames begin after the last dot
					},
				],
			},
			todoapp: {
				files: [
					{
						expand: true,
							src:[
								'htmlapp/todoApp/common/base.js',
								'htmlapp/todoApp/app.js',
								'htmlapp/todoApp/todoCtrl.js',
								'htmlapp/todoApp/todoStorage.js',
								'htmlapp/todoApp/todoFocus.js',
								'htmlapp/todoApp/todoEscape.js'
							],
						ext: '.annotated.js', // Dest filepaths will have this extension.
						extDot: 'last',       // Extensions in filenames begin after the last dot
					},
				],
			},
		},

		// to concat all the js files together
		concat: {
			options: {
				seperator: ";",
				banner: "/*kidsit concat*/\n"
			},
			math: {
				src: ["htmlapp/libs/jquery/dist/jquery.min.js","htmlapp/libs/jquery-color/jquery.color.js","htmlapp/libs/bootstrap/dist/bootstrap.min.js","htmlapp/syscommon/custom.js","htmlapp/libs/angular/angular.min.js",
						"htmlapp/libs/angular-route/angular-route.min.js","htmlapp/libs/angular-timer.js","htmlapp/libs/angular-animate/angular-animate.min.js","htmlapp/libs/angular-toastr/dist/angular-toastr.js",
						"htmlapp/libs/angular-bootstrap/ui-bootstrap-tpls.min.js","htmlapp/libs/TweenMax.min.js",
						"htmlapp/libs/ng-pageslide/dist/angular-pageslide-directive.js",
						"htmlapp/libs/highcharts/index.js","htmlapp/libs/highcharts-ng/dist/highcharts-ng.min.js",
						"htmlapp/examApp/improvementCharts.ctrl.js",
						"htmlapp/examApp/examApp.annotated.js","htmlapp/syscommon/kidsitanimatelib.annotated.js","htmlapp/libs/angular-busy/dist/angular-busy.js"],
				dest: "concat/appMath.concat.js"
			},
			yinbiao: {
				src: ["htmlapp/libs/jquery/dist/jquery.min.js","htmlapp/libs/jquery-color/jquery.color.js","htmlapp/libs/bootstrap/dist/bootstrap.min.js","htmlapp/syscommon/custom.js","htmlapp/libs/angular/angular.min.js",
						"htmlapp/libs/angular-route/angular-route.min.js","htmlapp/yinbiaoApp/angularinit.annotated.js",
						"htmlapp/libs/angular-bootstrap/ui-bootstrap-tpls.min.js","htmlapp/libs/TweenMax.min.js",
						"htmlapp/yinbiaoApp/highlightppattern.annotated.js","htmlapp/syscommon/kidsitanimatelib.annotated.js","htmlapp/yinbiaoApp/guestaddword.annotated.js",
						"htmlapp/libs/angular-animate/angular-animate.min.js","htmlapp/yinbiaoApp/yinbiaoapp.annotated.js"],
				dest: "concat/appYinbiao.concat.js"
			},
			todo: {
				src: [
						'htmlapp/todoApp/common/base.js',
						'htmlapp/libs/angular/angular.js',
						'htmlapp/todoApp/app.js',
						'htmlapp/libs/angular-busy/dist/angular-busy.js',
						'htmlapp/todoApp/todoCtrl.js',
						'htmlapp/todoApp/todoStorage.js',
						'htmlapp/todoApp/todoFocus.js',
						'htmlapp/todoApp/todoEscape.js'
					],
				dest: "concat/appTodo.concat.js"
			},
			siteindex: {
				src: [
						"htmlapp/libs/jquery/dist/jquery.min.js",
						"htmlapp/libs/jquery-color/jquery.color.js",
						"htmlapp/libs/bootstrap/dist/js/bootstrap.min.js",
						"htmlapp/syscommon/custom.js"
					],
				dest: "concat/siteindex.concat.js"
			}
		},

		// to minimize/uglify JS into one production
		uglify: {
			options: {
				compress: true,
				sourceMap: "dist/app.map",
				mangle: false,
				banner: "/* copyright <%= pkg.author %> | <%= pkg.license %> " +
						" @<%= grunt.template.today('yyyy-mm-dd') %> */"
			},
			math: {
				src: "concat/appMath.concat.js",
				dest: "dist/appMath.min.js"
			},
			yinbiao: {
				src: "concat/appYinbiao.concat.js",
				dest: "dist/appYinbiao.min.js"
			},
			todo: {
				src: "concat/appTodo.concat.js",
				dest: "dist/appTodo.min.js"
			},
			siteindex: {
				src: "concat/siteindex.concat.js",
				dest: "dist/siteindex.min.js"
			}
		},

		// FOLLOWING IS FOR CSS BUILD PROCESS //
		cssmin: {
			layoutConcat: {
			files: {
				'dist/css/bladelayout.concat.css': ['htmlapp/libs/bootstrap/dist/css/bootstrap.css', 'bootstrap/css/bootstrap-theme.min.css',
				'htmlapp/libs/angular-toastr/dist/angular-toastr.css','htmlapp/assets/custom.css']
			}
			},
			layoutmin: {
				files: [{
					expand: true,
					cwd: 'dist/css',
					src: ['bladelayout.concat.css', '!*.min.css'],
					dest: 'dist/css/',
					ext: '.min.css'
				}]
			}
		},

		// create two version template for dev and release
		targethtml: {
			mathrelease: {
			files: {
				'../app/views/site/mathexercise/examcreate.blade.php': '../app/views/site/mathexercise/examcreate.blade.php.htm'
			}
			},
			mathdev: {
			files: {
				'../app/views/site/mathexercise/examcreate.blade.php': '../app/views/site/mathexercise/examcreate.blade.php.htm'
				}
			},
			yinbiaorelease: {
			files: {
				'../app/views/site/yinbiao/show.blade.php': '../app/views/site/yinbiao/show.blade.php.htm'
				}
			},
			yinbiaodev: {
			files: {
				'../app/views/site/yinbiao/show.blade.php': '../app/views/site/yinbiao/show.blade.php.htm'
				}
			},
			tododev: {
			files: {
				'../app/views/site/todo/index.blade.php': '../app/views/site/todo/index.blade.php.htm'
				}
			},
			todorelease: {
			files: {
				'../app/views/site/todo/index.blade.php': '../app/views/site/todo/index.blade.php.htm'
				}
			}
		},

		// to do static code checking in realtime
		jshint: {
			options: {
				eqeqeq: true,
				curly: true,
				undef: true,
				unused: true
			},
			target: {
				src: "src/*.js"
			}
		},

		// to watch the file change and automate build process
		watch: {
			scripts: {
				files: ['../app/views/site/mathexercise/*.htm'],
				// files: ['htmlapp/js/*.js'],
				tasks: ['targethtml:mathdev']
			}
		},

		// to clean up unneeded files and directories
		clean: {
			target: ['dist','concat']
		}
	});
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-clean');

	grunt.loadNpmTasks('grunt-ng-annotate');

	grunt.loadNpmTasks('grunt-targethtml');

	grunt.loadNpmTasks('grunt-contrib-cssmin');

	grunt.registerTask("default",['mathdev','yinbiaodev','tododev']);
	grunt.registerTask("release",['mathrelease','yinbiaorelease','todorelease','siteindexrelease']);

	grunt.registerTask("mathdev",['targethtml:mathdev']);
	grunt.registerTask("mathrelease",['targethtml:mathrelease','ngAnnotate:examapp','concat:math','uglify:math']);
	grunt.registerTask("yinbiaodev",['targethtml:yinbiaodev']);
	grunt.registerTask("yinbiaorelease",['targethtml:yinbiaorelease','ngAnnotate:yinbiaoapp','concat:yinbiao','uglify:yinbiao']);
	grunt.registerTask("tododev",['targethtml:tododev']);
	grunt.registerTask("todorelease",['targethtml:todorelease','ngAnnotate:todoapp','concat:todo','uglify:todo']);
	grunt.registerTask("siteindexrelease",['concat:siteindex','uglify:siteindex']);

	grunt.registerTask("yinbiao",['ngAnnotate:yinbiaoapp','concat:yinbiao','uglify:yinbiao']);
	grunt.registerTask("rebuild",['clean','default']);
};