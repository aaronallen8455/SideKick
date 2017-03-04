/**
 * Created by Aaron Allen on 2/25/2017.
 */
define([
    'jquery',
    'uiClass'
], function ($, Class) {
    'use strict';

    return Class.extend({
        swipeArea: $('.navigation'),
        htmlEl: $('html'),

        initialize: function (config, element) {
            $(element).click(this.toggle.bind(this));
            this.swipeArea.on('touchstart', this.swipe.bind(this));

            return this._super();
        },

        toggle: function () {
            // open or close the menu
            if (this.htmlEl.hasClass('nav-open')) {
                this.htmlEl.removeClass('nav-open');
                setTimeout(function () {
                    this.htmlEl.removeClass('nav-before-open');
                }.bind(this), 300);
            } else {
                this.htmlEl.addClass('nav-before-open');
                setTimeout(function () {
                    this.htmlEl.addClass('nav-open');
                }.bind(this), 42);
            }
        },

        swipe: function (e) {
            var xCoord = e.originalEvent.touches[0].clientX;

            // close the menu on swipe left
            this.swipeArea.on('touchmove', function (e) {
                var x = e.originalEvent.touches[0].clientX;
                if (xCoord - x >= 20) {
                    this.swipeArea.off('touchmove');
                    this.toggle();
                } else if (x > xCoord) {
                    xCoord = x;
                }
            }.bind(this));

            this.swipeArea.on('touchend', function () {
                this.swipeArea.off('touchmove');
            }.bind(this));
        }
    });
});