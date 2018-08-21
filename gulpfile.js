// General.
var pkg				= require('./package.json');
var project 			= pkg.name;
var title			= pkg.title;

// Build.
var buildZipDestination	  = './build/';
var buildFiles            = ['./**', '!build', '!build/**', '!node_modules/**', '!*.json', '!*.map', '!*.xml', '!gulpfile.js', '!*.sublime-project', '!*.sublime-workspace', '!*.sublime-gulp.cache', '!*.log', '!*.DS_Store', '!*.gitignore', '!TODO', '!*.git', '!*.ftppass', '!*.DS_Store', '!sftp.json', '!yarn.lock', '!*.md', '!package.lock'];
var cleanFiles		  = ['./build/'+project+'/', './build/'+project+' 2/', './build/'+project+'.zip' ];
var buildDestination	  = './build/'+project+'/';
var buildDestinationFiles = './build/'+project+'/**/*';

// Translation.
var text_domain             	= '@@textdomain';
var destFile                	= project+'.pot';
var packageName             	= pkg.title;
var bugReport               	= pkg.author_uri;
var lastTranslator          	= pkg.author;
var team                    	= pkg.author_shop;
var translatePath           	= './languages';
var translatableFiles       	= ['./**/*.php'];

// Release.
var cleanSrcFiles	  = ['./build/'+project+'/src/'];

/**
 * Load Plugins.
 */
var gulp		= require('gulp');
var del                 = require('del');
var notify	   	= require('gulp-notify');
var replace	  	= require('gulp-replace-task');
var zip		  	= require('gulp-zip');
var copy		= require('gulp-copy');
var cache               = require('gulp-cache');
var gulpif              = require('gulp-if');
var wpPot        	= require('gulp-wp-pot');

/**
 * Tasks.
 */
gulp.task('clearCache', function(done) {
	cache.clearAll();
	done();
});

gulp.task('clean', function(done) {
	return del( cleanFiles );
	done();
});

gulp.task('cleanSrc', function(done) {

	return del( cleanSrcFiles );

	done();
});

gulp.task('copy', function(done) {
	return gulp.src( buildFiles )
	.pipe( copy( buildDestination ) );
	done();
});

gulp.task( 'updateVersion', function(done) {
	return gulp.src( './*.php' )

	.pipe( replace( {
		patterns: [
			{
				match: /(\d+\.+\d+\.+\d)/,
				replacement: pkg.version
			},
		],
		usePrefix: false
	} ) )
	.pipe( gulp.dest( './' ) );
	done();
});

gulp.task('variables', function(done) {
	return gulp.src( buildDestinationFiles )
	.pipe(replace({
		patterns: [
		{
			match: 'pkg.name',
			replacement: project
		},
		{
			match: 'pkg.title',
			replacement: pkg.title
		},
		{
			match: 'pkg.version',
			replacement: pkg.version
		},
		{
			match: 'pkg.author',
			replacement: pkg.author
		},
		{
			match: 'pkg.author_shop',
			replacement: pkg.author_shop
		},
		{
			match: 'pkg.license',
			replacement: pkg.license
		},
		{
			match: 'textdomain',
			replacement: pkg.name
		},
		{
			match: 'pkg.description',
			replacement: pkg.description
		},
		{
			match: 'pkg.tested_up_to',
			replacement: pkg.tested_up_to
		}
		]
	}))
	.pipe(gulp.dest( buildDestination ));
	done();
});

gulp.task( 'translate', function (done) {
	return gulp.src( translatableFiles )
	.pipe( wpPot( {
		domain        : text_domain,
		destFile      : destFile,
		package       : project,
		bugReport     : bugReport,
		lastTranslator: lastTranslator,
		team          : team
	} ))
	.pipe( gulp.dest( translatePath ) )
	done();
});

gulp.task('zip', function(done) {
	return gulp.src( buildDestination + '/**', { base: 'build' } )
	.pipe( zip( project + '.zip' ) )
	.pipe( gulp.dest( buildZipDestination ) );
	done();
});

/**
 * Release Tasks.
 */
gulp.task( 'release-notice', function(done) {
	return gulp.src( './' )
	.pipe( notify( { message: 'The v' + pkg.version + ' release of ' + title + ' has been built.', onLast: false } ) )
	done();
});

gulp.task('build', gulp.series( 'clearCache', 'clean', 'updateVersion', 'copy', 'cleanSrc', 'variables', 'translate', 'zip', 'release-notice',  function(done) {
	done();
} ) );



