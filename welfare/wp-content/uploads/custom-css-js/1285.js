<!-- start Simple Custom CSS and JS -->
<script type="text/javascript">
jQuery(document).ready(function($) {

    // PLAY VIDEO on clicking play button
    $('.video-pop-btn').on('click', function() {
        const video = $('.guten-popup video').get(0);
        if (video) {
            setTimeout(function() {
                video.play();
            }, 300); // small delay for popup animation
        }
    });

    // PAUSE VIDEO on clicking close icon
    $('.guten-popup-close').on('click', function() {
        const video = $('.guten-popup video').get(0);
        if (video) {
            video.pause();
            video.currentTime = 0; // optional: reset to start
        }
    });

});
</script>
<!-- end Simple Custom CSS and JS -->
