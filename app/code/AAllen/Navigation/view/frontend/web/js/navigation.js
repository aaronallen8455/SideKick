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
            this.swipeArea.on('mousedown', this.swipe.bind(this));

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
            var xCoord = e.screenX;

            // close the menu on swipe left
            this.swipeArea.on('mousemove', function (e) {
                if (xCoord - e.screenX >= 20) {
                    this.swipeArea.off('mousemove');
                    this.toggle();
                } else if (e.screenX > xCoord) {
                    xCoord = e.screenX;
                }
            }.bind(this));

            this.swipeArea.on('mouseup', function () {
                this.swipeArea.off('mousemove');
            }.bind(this));
        }
    })
});