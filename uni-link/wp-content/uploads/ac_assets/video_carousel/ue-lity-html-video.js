/**
 * UE HTML5 Video Lightbox Library v1.6
 * Supports multiple widget instances of HTML5 Video.
 */

(function (jQuery) {

    function UEVideoLightbox(lightboxSelector) {
        var $container = jQuery(lightboxSelector);
        if (!$container.length) return;

        function openVideo($trigger) {
            var src = $trigger.data('video-src');
            if (!src) return;

            // Remove any existing video
            $container.empty();

            // Dynamically create video element
            var $video = jQuery('<video>', {
                class: 'ue-lightbox-video',
                controls: true,
                playsinline: true,
                autoplay: true,
                muted: false // <-- unmuted
            }).append(
                jQuery('<source>', {
                    src: src,
                    type: 'video/mp4'
                })
            );

            // Append to container and play
            $container.append($video);
            $video[0].load();
            $video[0].play().catch(function (err) {
                // Handle autoplay restrictions
                console.warn('Video play prevented:', err);
            });
        }

        function closeVideo() {
            var $video = $container.find('video');
            $video.each(function () {
                this.pause();
                this.currentTime = 0;
            });
            // Remove video from DOM
            $container.empty();
        }

        // Lity event handlers
        jQuery(document).on('lity:open', function (event, instance) {
            openVideo(jQuery(instance.opener()));
        });

        jQuery(document).on('lity:close', closeVideo);
    }

    // Expose globally
    window.UEVideoLightbox = UEVideoLightbox;

})(jQuery);
