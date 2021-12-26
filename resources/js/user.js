
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
window.$ = window.jQuery = require('jquery');

require('./user/popper.min');
require('./user/bootstrap.min');
require('./user/script');

$(".field").hover(function () {
    $(this).addClass("hvr-curl-top-right");
});

