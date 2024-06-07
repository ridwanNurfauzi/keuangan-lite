import './bootstrap';

import 'flowbite';

import $ from 'jquery';
import Alpine from 'alpinejs';

Alpine.start();

$(function () {
    setTimeout(() => {
        $('#loading_panel').animate({
            opacity: 0
        }, () => {
            $('#loading_panel').addClass('hidden');
        });
    }, 250);
});
