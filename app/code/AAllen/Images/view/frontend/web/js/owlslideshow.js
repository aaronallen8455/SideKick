/**
 * Created by Aaron Allen on 3/15/2017.
 */

define([
    'jquery',
    'owlCarousel'
], function ($) {
    'use strict';

    return function (config, element) {
        $(element).owlCarousel({
            items : 1,
            loop: true,
            center: true,
            mouseDrag: false,
            lazyLoad: false,
            autoplay: true,
            animateOut: 'fadeOut'//,
            //smartSpeed: 1000
        });
    }
});
