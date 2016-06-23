module.exports = function(grunt) {

  // Configure task(s)
  grunt.initConfig({
     pkg: grunt.file.readJSON('package.json'),

     uglify: {
       dev: {
         options: {
           beautify: true,
           mangle: false,
           compress: false,
           preserveComments: 'all'
         }, // options
         src: ['src/main.js'],
         dest: 'javascript/script.min.js'
       }, //dev
       build: {
         src: ['src/main.js'],
         dest: 'javascript/script.min.js'
       } //build
     }, //uglify
     watch: {
       options: {
         livereload: true,
         port: 3306,
       }, //options
       js: {
         files: ['src/*.js'],
         tasks: ['uglify:dev']
       }, //js
       css : {
         files: ['src/*.scss'],
         tasks: ['sass:dev']
       }//css
     }, // watch
     sass: {
       dev: {
         options: {
           outputStyle: 'expanded'
         }, //options
         files: {
           'css/main.css' : 'src/main.scss'
         }//files
       }, //dev
       build: {
         options: {
           outputStyle: 'compressed'
         }, //options
         files: {
           'css/main.css' : 'src/main.scss'
         }
       }//build
     }, //sass
     express:{
  			all:{
  				options:{
  					port:3000,
  					hostname:'localhost',
  					bases:['.'],
  					livereload:true
  				} //options
  			} //all
  		}, //express
      imagemin: {
        dynamic: {
          files: [{
            expand: true,
            cwd: 'images/',
            src: ['**/*.{png,jpg,gif}'],
            dest: 'images/build/'
          }] // files
        } //dynamic
      } //imagemin
  });

  // Load the plugins
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-imagemin');
  //grunt.loadNpmTasks('grunt-express');
  grunt.loadNpmTasks('grunt-sass');




  // Register task(s)
  grunt.registerTask('default', ['uglify:dev', 'sass:dev', 'watch']);
  grunt.registerTask('build', ['uglify:build', 'sass:build']);
  //grunt.registerTask('server',['express','watch']);
};
