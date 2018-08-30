//
//  GULPFILE.JS
//  Author: Nikolas Ramstedt (nikolas.ramstedt@helsingborg.se)
//
//  Commands:
//  "gulp"          -   Build and watch task combined
//  "gulp build"    -   Build assets
//  "gulp watch"    -   Watch for file changes and build changed files
//

const gulp          = require('gulp');
const sass          = require('gulp-sass');
const uglify        = require('gulp-uglify');
const cleanCSS      = require('gulp-clean-css');
const rename        = require('gulp-rename');
const autoprefixer  = require('gulp-autoprefixer');
const plumber       = require('gulp-plumber');
const rev           = require('gulp-rev');
const revDel        = require('rev-del');
const runSequence   = require('run-sequence');
const sourcemaps    = require('gulp-sourcemaps');
const notifier      = require('node-notifier');

//Dependecies required to compile ES5+ Scripts
const browserify = require('browserify');
const source = require('vinyl-source-stream');
const buffer = require('vinyl-buffer');
const babelify = require('babelify');
const eslint = require('gulp-eslint');

// ==========================================================================
// Default Task
// ==========================================================================

gulp.task('default', function(callback) {
    runSequence('build', 'watch', callback);
});

// ==========================================================================
// Build Tasks
// ==========================================================================

gulp.task('build', function(callback) {
    runSequence(['sass', 'scripts'], 'revision', callback);
});

gulp.task('build:sass', function(callback) {
    runSequence('sass', 'revision', callback);
});

gulp.task('build:scripts', function(callback) {
    runSequence('scripts', 'revision', callback);
});

// ==========================================================================
// Watch Task
// ==========================================================================
gulp.task('watch', function() {
    gulp.watch('source/js/**/*.js', ['build:scripts']);
    gulp.watch('source/sass/**/*.scss', ['build:sass']);
});

// ==========================================================================
// SASS Task
// ==========================================================================
gulp.task('sass', function() {
    return gulp.src('source/sass/(#plugin_slug#).scss')
        .pipe(plumber())
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', function(err) {
            console.log(err.message);
            notifier.notify({
              'title': 'SASS Compile Error',
              'message': err.message
            });
        }))
        .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1'))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('dist/css'))
        .pipe(cleanCSS({debug: true}))
        .pipe(gulp.dest('dist/.tmp/css'));
});

// ==========================================================================
// Scripts Task
// ==========================================================================
gulp.task('scripts', function() {
    return browserify('source/js/(#plugin_slug#).js')
        .transform('babelify',{
            presets : ["es2015"]
        })
        .bundle()
        .on('error', function(err){
            console.log(err.stack);

            notifier.notify({
              'title': 'Compile Error',
              'message': err.message
            });

            this.emit("end");
        })
        .pipe(source('(#plugin_slug#).js')) // Converts To Vinyl Stream
        .pipe(buffer()) // Converts Vinyl Stream To Vinyl Buffer
        // Gulp Plugins Here!
        .pipe(sourcemaps.init())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('dist/js'))
        .pipe(uglify())
        .pipe(gulp.dest('dist/.tmp/js'));
});

// ==========================================================================
// Revision Task
// ==========================================================================

gulp.task("revision", function(){
    return gulp.src(["./dist/.tmp/**/*"])
      .pipe(rev())
      .pipe(gulp.dest('./dist'))
      .pipe(rev.manifest('rev-manifest.json', {merge: true}))
      .pipe(revDel({ dest: './dist' }))
      .pipe(gulp.dest('./dist'));
});
