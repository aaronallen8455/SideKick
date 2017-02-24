/**
 * Created by Aaron Allen on 2/23/2017.
 */
define([
    'jquery',
    'jquery/ui'
], function ($) {
    'use strict';

    return function (catalogAddToCart) {
        $.widget('aallen.catalogAddToCart', catalogAddToCart, {
            _create: function () {
                // make add to cart button ajax
                this.options.bindSubmit = true;
                this._super();
            }
        });

        return $.aallen.catalogAddToCart;
    };
});