'use strict';

import plugins       from 'gulp-load-plugins';
import yargs         from 'yargs';
import browser       from 'browser-sync';
import gulp          from 'gulp';
import rimraf        from 'rimraf';
import yaml          from 'js-yaml';
import fs            from 'fs';
import webpackStream from 'webpack-stream';
import webpack2      from 'webpack';
import named         from 'vinyl-named';
import autoprefixer  from 'autoprefixer';

// Load all Gulp plugins into one variable
const $ = plugins();

// Check for --production flag
const PRODUCTION = !!(yargs.argv.production);

// Load settings from settings.yml
const { COMPATIBILITY, PORT, UNCSS_OPTIONS, PATHS } = loadConfig();

function loadConfig() {
  let ymlFile = fs.readFileSync('config.yml', 'utf8');
  return yaml.load(ymlFile);
}

// Build the "dist" folder by running all of the below tasks
// Sass must be run later so UnCSS can search for used classes in the others assets.
gulp.task('build',
 gulp.series(clean, gulp.parallel(javascript, images), sass)); // removed copy from (javascript, images, copy)

// Build the site, run the server, and watch for file changes
gulp.task('default',
  gulp.series('build', server, watch));

// This happens every time a build starts
function clean(done) {
  rimraf('css', done);
  rimraf('js', done);
  rimraf('images', done);
}

// Copy files out of the assets folder
// This task skips over the "img", "js", and "scss" folders, which are parsed separately
function copy() {
  return gulp.src(PATHS.assets)
    .pipe(gulp.dest('other/assets'));
}


// In production, the CSS is compressed
function sass() {

  const postCssPlugins = [
    // Autoprefixer
    autoprefixer({ browsers: COMPATIBILITY }),

    // UnCSS - Uncomment to remove unused styles in production
    // PRODUCTION && uncss.postcssPlugin(UNCSS_OPTIONS),
  ].filter(Boolean);

  return gulp.src('assets/scss/truss.scss')
    .pipe($.sourcemaps.init())
    .pipe($.sass({
      includePaths: PATHS.sass
    })
      .on('error', $.sass.logError))
    .pipe($.postcss(postCssPlugins))
    .pipe($.if(PRODUCTION, $.cleanCss({ compatibility: 'ie9' })))
    .pipe($.if(!PRODUCTION, $.sourcemaps.write()))
    .pipe(gulp.dest('css'))
    .pipe(browser.reload({ stream: true }));
}

let webpackConfig = {
  mode: (PRODUCTION ? 'production' : 'development'),
  module: {
    rules: [
      {
        test: /\.js$/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: [ "@babel/preset-env" ],
            compact: false
          }
        }
      }
    ]
  },
  devtool: !PRODUCTION && 'source-map'
}


// In production, the file is minified
function javascript() {
  return gulp.src(PATHS.entries)
    .pipe(named())
    .pipe($.sourcemaps.init())
    .pipe(webpackStream(webpackConfig, webpack2))
    .pipe($.if(PRODUCTION, $.uglify()
      .on('error', e => { console.log(e); })
    ))
    .pipe($.if(!PRODUCTION, $.sourcemaps.write()))
    .pipe(gulp.dest('js'));
}

// In production, the images are compressed
function images() {
  return gulp.src('assets/img/**/*')
    .pipe($.if(PRODUCTION, $.imagemin([
      $.imagemin.jpegtran({ progressive: true }),
    ])))
    .pipe(gulp.dest('images'));
}

// Start a server with BrowserSync to preview the site in
function server(done) {
    browser.init({
        proxy : 'http://truss.test'
    });
}

// Reload the browser with BrowserSync
function reload(done) {
  browser.reload();
  done();
}

// Watch for changes to static assets, Sass, and JavaScript
function watch() {
  gulp.watch(PATHS.assets, copy);
  gulp.watch('assets/scss/**/*.scss').on('all', gulp.series(sass, browser.reload));
  gulp.watch('assets/js/**/*.js').on('all', gulp.series(javascript, browser.reload));
  gulp.watch('assets/img/**/*').on('all', gulp.series(images, browser.reload));
}
