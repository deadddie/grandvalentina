/**
 * Сайт Grand Hotel Valentina
 *
 * @link https://grandvalentina.ru
 * @author deadie
 */

'use strict';

// config
var min = true;                // css/js minification ON/OFF
var sourcemap = false;         // sourcemaps ON/OFF

// nodejs modules
var gulp = require('gulp'), // основной плагин gulp
    gulpif = require('gulp-if'), // conditionally control the flow of vinyl objects
    imagemin = require('gulp-imagemin'), //минимизация изображений
    pug = require('gulp-pug'), // pug
    sass = require('gulp-sass'), // sass
    sourcemaps = require('gulp-sourcemaps'), // sourcemaps
    rename = require('gulp-rename'), // переименование файлов
    postcss = require('gulp-postcss'), // постпроцессор css
    beautify = require('gulp-cssbeautify'), // бьютифайр
    minify = require('gulp-clean-css'), // минификатор
    gcmq = require('gulp-group-css-media-queries'), // группировка media queries
    cssnext = require('postcss-cssnext'), // postcss autoprefixer и пр.
    terser = require('gulp-terser'), // минификация js
    babel = require('gulp-babel'), // babel,
    spritesmith = require('gulp.spritesmith'), // генератор спрайтов
    webpack = require("webpack"), // webpack
    webpackStream = require("webpack-stream"), // webpack stream
    merge = require('merge-stream'); // объединение потоков

var svgSprite = require('gulp-svg-sprite'),
    svgmin = require('gulp-svgmin'),
    cheerio = require('gulp-cheerio'),
    replace = require('gulp-replace');

// webpack configs
var webpackConfig = require('./webpack.config');

// postcss
var processors = [
    cssnext
];

var appName = 'Grand Hotel Valentina';
var appNameShort = 'ghv';
var templateName = 'grandvalentina';
var appPath = 'templates/' + templateName + '/';
var sourcesPath = 'templates/' + templateName + '/_src/';

var path = {

    // build paths
    build: {
        js: appPath + 'js',
        css: appPath,
        spriteCss: sourcesPath + 'css/base',
        sprite: sourcesPath + 'images',
        html: appPath,
        images: appPath + 'images'
    },

    // sources
    src: {
        js: [
            sourcesPath + 'js/app.js'
        ],
        css: sourcesPath + 'css/[^_]*.scss',
        cssSprites: sourcesPath + 'css/base',
        spriteSvg: sourcesPath + 'images/icons/*.svg',
        spriteCss: appPath + 'images/symbol/sprite.scss',
        sprite: sourcesPath + 'sprites/*.png',
        svgTemplate: sourcesPath + 'css/extra/_sprite_template.scss',
        html: sourcesPath + '*.pug',
        images: [
            sourcesPath + 'images/**/*.[^svg|mustache]*',
            sourcesPath + 'images/sprite.png',
        ]
    },

    // watch files
    watch: {
        js: [
            sourcesPath + 'js/**/[^vendor]*.js',
            sourcesPath + 'js/**/components/*.js',
        ],
        css: [
            sourcesPath + 'css/base/*.scss',
            sourcesPath + 'css/common/*.scss',
            sourcesPath + 'css/extra/*.scss',
            sourcesPath + 'css/components/*.scss',
            sourcesPath + 'css/helpers/*.scss',
            sourcesPath + 'css/pages/*.scss',
            sourcesPath + 'css/vendor/*.scss',
            sourcesPath + 'css/*.scss',
            sourcesPath + '*.pug'
        ],
        spriteSvg: sourcesPath + 'images/icons/*.svg',
        sprite: sourcesPath + 'sprites/*.png',
        html: [
            sourcesPath + '*.pug',
            sourcesPath + '_inc/*.pug',
            sourcesPath + '_inc/common/*.pug',
            sourcesPath + '_inc/components/*.pug',
        ],
        images: sourcesPath + 'images/**/*.*'
    }
};


// images
function imagesBuild () {
    return gulp.src(path.src.images).
        pipe(imagemin({
            progressive: true,
            interlaced: true,
            optimizationLevel: 9,
            //verbose: true,
        })).
        pipe(gulp.dest(path.build.images));
}

// html
function htmlBuild() {
    return gulp.src(path.src.html).
        pipe(pug({
            pretty: '    '
        })).
        pipe(gulp.dest(path.build.html));
}

// css
function cssBuild() {
    return gulp.src(path.src.css).
        pipe(sourcemaps.init()).
        pipe(sass({
            'compress': false,
            'include css': true
        })).
        pipe(postcss(processors)).
        pipe(gcmq()).
        pipe(beautify()).
        pipe(rename({
            basename: 'template_styles',
            extname: '.css'
        })).
        //pipe(gulpif(min, minify())).
        pipe(gulpif(sourcemap, sourcemaps.write('.'))).
        pipe(gulp.dest(path.build.css));
}

// custom js
function jsBuild() {
    return gulp.src(path.src.js).
        pipe(webpackStream(webpackConfig), webpack).
        pipe(babel({
            presets: ['env']
        })).
        pipe(gulpif(min, terser({
                mangle: false,
                compress: false
            })
        )).
        pipe(rename({
            suffix: '.min'
        })).
        pipe(gulp.dest(path.build.js));
}

// sprites (SVG)
function spriteSvgBuild() {
    return gulp.src(path.src.spriteSvg).
        // minify svg
        pipe(svgmin({
            js2svg: {
                pretty: true
            }
        })).
        // remove all fill, style and stroke declarations in out shapes
        pipe(cheerio({
            run: function ($) {
                $('[fill]').removeAttr('fill');
                $('[stroke]').removeAttr('stroke');
                $('[style]').removeAttr('style');
                $('style').remove();
            },
            parserOptions: {
                xmlMode: true
            }
        })).
        // cheerio plugin create unnecessary string '&gt;', so replace it
        pipe(replace('&gt;', '>')).
        // build svg sprite
        pipe(svgSprite({
            mode: {
                symbol: {
                    sprite: 'sprite.svg',
                    render: {
                        scss: {
                            template: path.src.svgTemplate,
                        },
                    },
                    example: true, // build HTML page with sprites
                },
            }
        })).
        pipe(gulp.dest(path.build.images)).
        pipe(moveSpriteCss());
}

// move scss sprites to src
function moveSpriteCss () {
    return gulp.src(path.src.spriteCss).
        pipe(rename({
            basename: '_sprites'
        })).
        pipe(gulp.dest(path.build.spriteCss));
}

// sprites (PNG)
function spriteBuild() {
    var spriteData =
        gulp.src(path.src.sprite).
            pipe(spritesmith({
                imgName: 'sprite.png',
                imgPath: 'images/sprite.png',
                cssName: '_sprites_png.scss',
                cssFormat: 'scss',
                    algorithm: 'binary-tree',
                //padding: 1,
                cssVarMap: function (sprite) {
                    sprite.name = appNameShort + '-icon-' + sprite.name;
                }
            }));
    var imgStream = spriteData.img.
        pipe(gulp.dest(path.build.sprite)); // путь, куда сохраняем картинку
    var cssStream = spriteData.css.
        pipe(gulp.dest(path.src.cssSprites));
    return merge(imgStream, cssStream);
}

// tasks
gulp.task('sprite:build', spriteBuild);
gulp.task('spriteSvg:build', spriteSvgBuild);
gulp.task('css:build', cssBuild);
gulp.task('js:build', jsBuild);
gulp.task('html:build', htmlBuild);
gulp.task('images:build', imagesBuild);

// watch
function watch() {
    gulp.watch(path.watch.sprite, gulp.series('sprite:build'));
    gulp.watch(path.watch.spriteSvg, gulp.series('spriteSvg:build'));
    gulp.watch(path.watch.css, gulp.series('css:build'));
    gulp.watch(path.watch.js, gulp.series('js:build'));
    //gulp.watch(path.watch.html, gulp.series('html:build'));
    gulp.watch(path.watch.images, gulp.series('images:build'));
}

gulp.task('watch', watch);

// build task
gulp.task('build', gulp.parallel(
    gulp.series('sprite:build', 'images:build', 'spriteSvg:build'),
    'css:build',
    'js:build',
    //'html:build',
));

// default task
gulp.task('default', gulp.series('build', 'watch'));
