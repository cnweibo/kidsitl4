module.exports = function (grunt){
	grunt.initConfig({
		pkg: grunt.file.readJSON("package.json"),
		uglify: {
			options: {
				compress: true,
				sourceMap: "dist/app.map",
				mangle: false,
				banner: "/* copyright <%= pkg.author %> | <%= pkg.license %> " + 
				        " @<%= grunt.template.today('yyyy-mm-dd') %> */"
			},
			math: {
				src: "dest/appMath.concat.js",
				dest: "dist/appMath.min.js"
			},
			yinbiao: {
				src: "dest/appYinbiao.concat.js",
				dest: "dist/appYinbiao.min.js"
			}
		},
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
		concat: {
			options: {
				seperator: ";",
				banner: "/*kidsit concat*/\n"
			},
			math: {
				src: ["htmlapp/libs/jquery.min.js","htmlapp/libs/jquery.color.min.js","htmlapp/libs/bootstrap.min.js","htmlapp/js/custom.js","htmlapp/libs/angular.min.js",
					  "htmlapp/libs/angular-route.min.js","htmlapp/libs/angular-timer.js","htmlapp/libs/angular-animate.min.js","htmlapp/libs/angular-toastr.js",
					  "htmlapp/js/kidsitanimatelib.js","htmlapp/libs/ui-bootstrap-tpls-0.11.0.min.js","htmlapp/libs/TweenMax.min.js","htmlapp/js/examApp.js"],
				dest: "dest/appMath.concat.js"
			},
			yinbiao: {
				src: ["htmlapp/libs/jquery.min.js","htmlapp/libs/jquery.color.min.js","htmlapp/libs/bootstrap.min.js","htmlapp/js/custom.js","htmlapp/libs/angular.min.js",
					  "htmlapp/libs/angular-route.min.js","htmlapp/js/angularinit.js",
					  "htmlapp/libs/ui-bootstrap-tpls-0.11.0.min.js","htmlapp/libs/TweenMax.min.js",
					   "htmlapp/js/highlightpattern.js","htmlapp/js/kidsitanimatelib.js","htmlapp/js/guestaddword.js",
					   "htmlapp/libs/ng-animate.js","htmlapp/js/yinbiaoapp.js"],
				dest: "dest/appYinbiao.concat.js"
			},
		},
		watch: {
			scripts: {
				files: ['src/*.js'],
				tasks: ['jshint']
			}
		},
		clean: {
			target: ['dist','dest']
		}
	});
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-clean');

	grunt.registerTask("default",['concat:math','uglify:math']);
	grunt.registerTask("rebuild",['clean','default']);
};