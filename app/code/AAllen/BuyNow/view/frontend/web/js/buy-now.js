/**
 * Created by Aaron Allen on 2/24/2017.
 */
define([
    'jquery'
], function ($) {
    'use strict';

    return function (config, element) {
        var form = $('#product_addtocart_form');
        var buyNowFlag = $('<input/>').attr({type: 'hidden', name: 'buy_now', value: '1'});
        element.addEventListener('click', function (e) {
            form.append(buyNowFlag);
            form.trigger('submit');
            form.remove(buyNowFlag);
        })
    };
});