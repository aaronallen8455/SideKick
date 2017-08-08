define([
    'jquery',
    'uiClass'
], function ($, Class) {
    'use strict';

    return Class.extend({
        initialize: function (config, elem) {
            this._super();

            this.imageSources = config.images;
            this.duration = config.duration;
            this.fadeLength = config.fadeLength;
            this.imageElement = $(elem).children('.slide-show-image-wrapper').last();
            this.container = $(elem);
            this.images = [this.imageElement]; // an array of image elements

            // attach interval
            window.setInterval(this.nextImage.bind(this), (this.duration + this.fadeLength) * 1000);
        },

        /**
         * Display the next image
         */
        changeImage: function (newImage) {

            this.imageElement.css({'z-index': 50, position: 'absolute'});
            newImage.appendTo(this.container);

            this.imageElement.animate({opacity: 0}, this.fadeLength * 1000, function () {
                this.imageElement.detach();
                this.imageElement.css({opacity: 1, 'z-index': 0, position: 'static'});
                this.imageElement = newImage;
            }.bind(this));
        },

        /**
         * Create the next image if doesn't exist
         * @returns string
         */
        nextImage: function () {
            this.currentIndex++;
            if (this.currentIndex === this.imageSources.length) this.currentIndex = 0;

            if (!this.images[this.currentIndex]) {

                var wrapper = $('<div class="slide-show-image-wrapper">'),
                    image = $('<img>').attr('src', this.imageSources[this.currentIndex]);

                this.images[this.currentIndex] = wrapper.append(image);

                // change image on load
                image.load(this.changeImage.bind(this, this.images[this.currentIndex]))
            } else {

                this.changeImage(this.images[this.currentIndex]);
            }
        },

        currentIndex: 0
    })
});