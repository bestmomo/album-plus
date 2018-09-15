window._ = require('lodash');
window.Popper = require('popper.js').default;
window.swal = require('sweetalert2');

try {
    window.$ = window.jQuery = require('jquery');
    require('bootstrap');
    require('magnific-popup');
    require('@fortawesome/fontawesome-free/js/all.js');
} catch (e) {}