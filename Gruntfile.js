module.exports = function (grunt) {
    grunt.initConfig({
        concat: {
            css: {
                src: ['./src/css/bootstrap.css', './src/css/style.css'],
                dest: './src/css/bulk/bulk.css'
            },
            layout: {
                src: ['./src/js/bootstrap.bundle.js', './src/js/analytics.js'],
                dest: './src/js/bulk/layout.bulk.js'
            },
            portfolio: {
                src:["./src/js/ageCalculator.js", "./src/js/typeWriter.js","./src/js/projects.js","./src/js/cardGenerator.js"],
                dest: './src/js/bulk/portfolio.bulk.js'
            },
            contact: {
                src:["./src/js/contact.js"],
                dest: './src/js/bulk/contact.bulk.js'
            }
            ,weather: {
                src:["./src/js/chart.js","./src/js/weather.js"],
                dest: './src/js/bulk/weather.bulk.js'
            },
            chat: {
                src:["./src/js/chat.js"],
                dest: './src/js/bulk/chat.bulk.js'
            },
            geo: {
                src:["./src/js/geo.js"],
                dest: './src/js/bulk/geo.bulk.js'
            },
            trends: {
                src:[""],
                dest: './src/js/bulk/trends.bulk.js'
            },
            authDelete: {
                src:["./src/js/delete.js"],
                dest: './src/js/bulk/delete.bulk.js'
            },
            authLogin: {
                src:["./src/js/login.js"],
                dest: './src/js/bulk/login.bulk.js'
            },
            authRegister: {
                src:["./src/js/register.js"],
                dest: './src/js/bulk/register.bulk.js'
            },
            authForget: {
                src:["./src/js/forget.js"],
                dest: './src/js/bulk/forget.bulk.js'
            },
            authReset: {
                src:["./src/js/reset.js"],
                dest: './src/js/bulk/reset.bulk.js'
            },
            short: {
                src:["./src/js/short.js"],
                dest: './src/js/bulk/short.bulk.js'
            }
        },
        uglify: {
            js: {
                files: {
                    './public/js/layout.min.js': './src/js/bulk/layout.bulk.js',
                    './public/js/portfolio.min.js': './src/js/bulk/portfolio.bulk.js',
                    './public/js/contact.min.js': './src/js/bulk/contact.bulk.js',
                    './public/js/weather.min.js': './src/js/bulk/weather.bulk.js',
                    './public/js/chat.min.js': './src/js/bulk/chat.bulk.js',
                    './public/js/trends.min.js': './src/js/bulk/trends.bulk.js',
                    './public/js/geo.min.js': './src/js/bulk/geo.bulk.js',
                    './public/js/short.min.js': './src/js/bulk/short.bulk.js',
                    './public/js/delete.min.js': './src/js/bulk/delete.bulk.js',
                    './public/js/login.min.js': './src/js/bulk/login.bulk.js',
                    './public/js/register.min.js': './src/js/bulk/register.bulk.js',
                    './public/js/update.min.js': './src/js/bulk/update.bulk.js',
                    './public/js/reset.min.js': './src/js/bulk/reset.bulk.js',
                    './public/js/forget.min.js': './src/js/bulk/forget.bulk.js',
                }
            }
        },
        purgecss: {
            target: {
                options: {
                    content: [
                        './templates/*.php',
                        './templates/**/*.php',
                        // 'https://localhost/portfolio/',
                        // 'https://localhost/portfolio/?page=trends',
                        // 'https://localhost/portfolio/?page=weather',
                        // 'https://localhost/portfolio/?page=chat',
                        // 'https://localhost/portfolio/?page=geo',
                        // 'https://localhost/portfolio/?page=authUpdate',
                        // 'https://localhost/portfolio/?page=authRegister',
                        // 'https://localhost/portfolio/?page=authLogin',
                        // 'https://localhost/portfolio/?page=authDelete',
                        'https://localhost/',
                        'https://localhost/?page=trends',
                        'https://localhost/?page=weather',
                        'https://localhost/?page=chat',
                        'https://localhost/?page=geo',
                        'https://localhost/?page=short',
                        'https://localhost/?page=authUpdate',
                        'https://localhost/?page=authRegister',
                        'https://localhost/?page=authLogin',
                        'https://localhost/?page=authDelete',
                        'https://localhost/?page=authReset',
                        'https://localhost/?page=authForget',
                        './public/js/*.min.js'
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
    });

    // Load the plugins
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-purgecss');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-uglify');

    // Default tasks
    grunt.registerTask('default', ['concat', 'uglify','purgecss', 'cssmin']);
};