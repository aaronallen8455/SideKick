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
            this.imageElement = $(elem).children('img');
            this.container = $(elem);
            this.images = []; // an array of image elements

            // attach interval
            window.setInterval(this.nextImage.bind(this), this.duration * 1000);
        },

        /**
         * Display the next image
         */
        changeImage: function (newImage) {
            if (newImage[0].height < this.container.outerHeight() - 5) {
                newImage.css('paddingBottom', (this.container.outerHeight() - 5) - newImage[0].height);
            }

            newImage.css({maxWidth: this.container.outerWidth(), maxHeight: this.container.outerHeight() - 5})
                .appendTo(this.container);


            this.imageElement.css(
                {
                    position: 'absolute',
                    marginLeft: (newImage.outerWidth() - this.imageElement.outerWidth()) / 2
                }).fadeOut(this.fadeLength * 1000, function () {
                    this.imageElement.detach();
                    this.imageElement.css({position: 'static', display: 'default'});
                    this.imageElement = newImage;
                }.bind(this)
            );
        },

        /**
         * Create the next image if doesn't exist
         * @returns string
         */
        nextImage: function () {
            this.currentIndex++;
            if (this.currentIndex == this.imageSources.length) this.currentIndex = 0;

            if (!this.images[this.currentIndex]) {
                this.images[this.currentIndex] = $('<img>')
                    .attr('src', this.imageSources[this.currentIndex]);
                // change image on load
                this.images[this.currentIndex]
                    .load(this.changeImage.bind(this, this.images[this.currentIndex]))
            } else {
                this.changeImage(this.images[this.currentIndex]);
            }
        },

        currentIndex: 0
    })
});