/**
 * Created by Aaron Allen on 2/25/2017.
 */
define([
    'jquery',
    'uiClass'
], function ($, Class) {
    'use strict';

    return Class.extend({
        toggle: null,
        swipeArea: $('.navigation'),

        initialize: function (config, element) {
            this.toggle = $(element);
            this.toggle.click(this.open.bind(this));

            return this._super();
        },

        open: function () {
            this.swipeArea.toggleClass('nav-open');
        }
    })
});