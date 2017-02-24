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
            this.imageElement = $(elem).children('img').last();
            this.container = $(elem);
            this.images = [this.imageElement]; // an array of image elements

            // attach interval
            window.setInterval(this.nextImage.bind(this), (this.duration + this.fadeLength) * 1000);
        },

        /**
         * Display the next image
         */
        changeImage: function (newImage) {
            //if (newImage[0].height < this.container.outerHeight() - 5) {
            //    newImage.css('paddingBottom', (this.container.outerHeight() - 5) - newImage[0].height);
            //}

            //if (!newImage.isAttached) {
            newImage//.css({maxWidth: window.offsetWidth, maxHeight: this.container.outerHeight() - 5})
                .appendTo(this.container);
            //    newImage.isAttached = true;
            //}

            //newImage.css({position: 'static', opacity: 1, maxWidth: '100%'});


            this.imageElement.css(
                {
                    maxWidth: this.imageElement[0].width,
                    position: 'absolute',
                    marginLeft: (newImage.outerWidth() - this.imageElement.outerWidth()) / 2,
                    left: newImage[0].offsetLeft
                }).animate({opacity: 0}, this.fadeLength * 1000, function () {
                    this.imageElement.detach();
                    this.imageElement.css({position: 'static', opacity: 1, maxWidth: '100%'});
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