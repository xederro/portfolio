module.exports = function (grunt) {
    grunt.initConfig({
        concat: {
            css: {
                src: ['./src/css/bootstrap.css', './src/css/style.css'],
                dest: './src/css/bulk/bulk.css'
            },
            layout: {
                src: './src/js/bootstrap.bundle.js',
                dest: './src/js/bulk/layout.bulk.js'
            },
            portfolio: {
                src:["./src/js/ageCalculator.js", "./src/js/typeWriter.js","./src/js/projects.js","./src/js/cardGenerator.js"],
                dest: './src/js/bulk/portfolio.bulk.js'
            },
            weather: {
                src:["./src/js/chart.js", "./src/js/jquery.min.js","./src/js/weather.js"],
                dest: './src/js/bulk/weather.bulk.js'
            },
            chat: {
                src:["./src/js/chat.js"],
                dest: './src/js/bulk/chat.bulk.js'
            },
            trends: {
                src:[""],
                dest: './src/js/bulk/trends.bulk.js'
            }
        },
        purgecss: {
            target: {
                options: {
                    content: [
                        './templates/*.php',
                        './templates/**/*.php',
                        'https://localhost/portfolio/',
                        'https://localhost/portfolio/?page=trends',
                        'https://localhost/portfolio/?page=weather',
                        'https://localhost/portfolio/?page=chat',
                        './src/js/*.js'
                    ],
                    safelist: [
                        '::-webkit-scrollbar-track',
                        '::-webkit-scrollbar',
                        '::-webkit-scrollbar-thumb',
                        '::-webkit-scrollbar-thumb'
                    ],
                    keyframes: true,
                    fontFace: true
                },
                files: {
                    './src/css/tidy.css': ['./src/css/bulk/bulk.css']
                }
            }
        },
        cssmin: {
            options: {
                mergeIntoShorthands: false,
                roundingPrecision: -1
            },
            target: {
                files: {
                    './public/css/tidy.min.css': ['./src/css/tidy.css']
                }
            }
        },
        uglify: {
            js: {
                files: {
                    './public/js/layout.min.js': './src/js/bulk/layout.bulk.js',
                    './public/js/portfolio.min.js': './src/js/bulk/portfolio.bulk.js',
                    './public/js/weather.min.js': './src/js/bulk/weather.bulk.js',
                    './public/js/chat.min.js': './src/js/bulk/chat.bulk.js',
                    './public/js/trends.min.js': './src/js/bulk/trends.bulk.js',
                }
            }
        }
    });

    // Load the plugins
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-purgecss');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-uglify');

    // Default tasks
    grunt.registerTask('default', ['concat','purgecss', 'cssmin', 'uglify']);
};