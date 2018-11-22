var gulp = require('gulp');

var concat = require('gulp-concat');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');

//script paths
var jsFiles = ['*.js', '!gulpfile.js'],
    jsDest = 'Resources/js/scripts';

gulp.task('scripts', function() {
    return gulp.src(jsFiles)
        .pipe(concat('scripts.js'))
        .pipe(gulp.dest(jsDest))
        .pipe(uglify('Resources/js/scripts/script.js'))
        .pipe(gulp.dest(jsDest));
});
