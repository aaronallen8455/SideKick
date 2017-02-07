define([
    'jquery'
], function ($) {
    'use strict';

    var center = 215;

    function Layer(element) {
        this.element = element;
        this.factor = null;
        this.initialYposition = parseInt($(element).css('bottom').slice(0,-2));
        Layer.items.push(this);
    }

    Layer.items = [];
    Layer.incrementConst = .0005;

    /**
     * scroll all layers
     * @param e
     */
    Layer.scrollAll = function (e) {
        for (var i=0; i<Layer.items.length; i++) {
            Layer.items[i].scroll(window.scrollY);
        }
    };

    /**
     * scroll the layer down an amount dependant on initial position
     * @param scrollY
     */
    Layer.prototype.scroll = function (scrollY) {
        //if (this.initialYposition <= 120) return; // bottom cloud is static

        if (!this.factor) {
            // init factor based on initial position
            this.factor = this.constructor.incrementConst * (this.initialYposition - center);
        }

        this.element.style.bottom = this.initialYposition - (scrollY * this.factor) + 'px';
    };

    return function (config, element) {
        new Layer(element);

        // attach the scroll handler
        document.addEventListener('scroll', Layer.scrollAll, false);
    };
});