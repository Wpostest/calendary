const gulp = require('gulp');
const imagemin = require('gulp-imagemin');
const del = require('del');
const sourcemaps = require('gulp-sourcemaps');
const babel = require('gulp-babel');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const sass = require('gulp-sass');
const plumber = require('gulp-plumber');
const cleanCSS = require('gulp-clean-css');
browserSync = require('browser-sync').create();


gulp.task('static', async (done) =>{
    gulp.src('./src/**/*.html').pipe(gulp.dest('./dist'));
    gulp.src('./src/**/*.php').pipe(gulp.dest('./dist'));
    gulp.src('./src/images/**/*').pipe(imagemin()).pipe(gulp.dest('./dist/images'));

    browserSync.reload();
    done();
});

gulp.task('clean', async () =>{
    return del(['dist']);
})

gulp.task('js', async (done) =>{
    gulp.src('./src/assets/js/**/*.js')
        .pipe(sourcemaps.init())
        .pipe(babel({
            presets: ['@babel/env']
        }))
        .pipe(concat('app.js'))
        .pipe(uglify())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('./dist/js/'));

        browserSync.reload();
        done();
});

gulp.task('sass', async (done) =>{
    gulp.src('./src/assets/scss/app.scss')
    .pipe(plumber())
    .pipe(sass())
    .pipe(cleanCSS())
    .pipe(plumber.stop())
    .pipe(gulp.dest('./dist/css/'));

    browserSync.reload();
    done();
});

gulp.task('browser-sync', async () => {
    browserSync.init({
        server: {
            baseDir: "./dist/"
        }
    });
});

gulp.task('watch', async () => {
    browserSync.init({
        server: {
            baseDir: "./dist/"
        },
    });

    gulp.watch('./src/assets/scss/**/*.scss', gulp.series('sass'));
    gulp.watch('./src/assets/js/**/*.js', gulp.series('js'));
    gulp.watch('./src/**/*.html', gulp.series('static'));
});

gulp.task('build', gulp.series('clean', 'static', 'sass', 'js'));








