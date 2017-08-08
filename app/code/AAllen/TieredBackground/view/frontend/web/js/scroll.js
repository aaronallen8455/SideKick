define([
    'jquery'
], function ($) {
    'use strict';

    return function (config) {
        var topEl = $(config.top), // the top drawn cloud
            middleEl = $(config.middle), // the middle cloud
            bottomEl = $(config.bottom), // the bottom "closest" cloud
            bottomInitPosition = parseInt(bottomEl.css('bottom').slice(0,-2)), // init y-position of top
            midInitPosition = parseInt(middleEl.css('bottom').slice(0,-2)),
            topInitPosition = parseInt(topEl.css('bottom').slice(0,-2)),
            bottomMidRatio = bottomInitPosition / midInitPosition,
            bottomTopRatio = bottomInitPosition / topInitPosition;
            //animationQueued = false;

        function onScroll(e) {
            var yScroll = window.scrollY;
            //if (!animationQueued) {
            //    animationQueued = true;

            //    window.requestAnimationFrame(function () {
                    // number of pixels to change bottom cloud position by
                    var change = .035 * yScroll;

                    // change position of the clouds
                    bottomEl.css('bottom', bottomInitPosition + change);
                    middleEl.css('bottom', midInitPosition + change * bottomMidRatio);
                    topEl.css('bottom', topInitPosition + change * bottomTopRatio);

            //        animationQueued = false;
        //        });
        //    }
        }

        $(window).scroll(onScroll);
    };
});