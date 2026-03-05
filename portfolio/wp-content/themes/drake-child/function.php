<?php
/**
 * ✅ Drake Child Theme - Final Fast Icon Load Fix
 */

// 1️⃣ Load Parent Theme CSS
function drake_child_enqueue_styles() {
    wp_enqueue_style(
        'drake-parent-style',
        get_template_directory_uri() . '/style.css'
    );
}
add_action('wp_enqueue_scripts', 'drake_child_enqueue_styles', 5);


// 2️⃣ Preload Line Awesome Fonts (before anything else)
function drake_preload_lineawesome_fonts() {
    $font_path = get_stylesheet_directory_uri() . '/assets/fonts/line-awesome-1.3.0/fonts/';
    echo '<link rel="preload" href="' . $font_path . 'la-solid-900.woff2" as="font" type="font/woff2" crossorigin>';
    echo '<link rel="preload" href="' . $font_path . 'la-regular-400.woff2" as="font" type="font/woff2" crossorigin>';
    echo '<link rel="preload" href="' . $font_path . 'la-brands-400.woff2" as="font" type="font/woff2" crossorigin>';
}
add_action('wp_head', 'drake_preload_lineawesome_fonts', 1);


// 3️⃣ Load Line Awesome CSS instantly in <head>
function drake_load_lineawesome_early() {
    echo '<link rel="stylesheet" href="' . get_stylesheet_directory_uri() . '/assets/fonts/line-awesome-1.3.0/css/line-awesome.min.css" type="text/css" media="all">';
}
add_action('wp_head', 'drake_load_lineawesome_early', 2);


// 4️⃣ Keep Line Awesome cached permanently
function drake_set_cache_headers() {
    if (!headers_sent()) {
        header("Cache-Control: public, max-age=31536000, immutable");
    }
}
add_action('send_headers', 'drake_set_cache_headers');


// 5️⃣ Optional: Disable render-block delay
add_filter('style_loader_tag', function($html, $handle) {
    if (strpos($html, 'line-awesome.min.css') !== false) {
        $html = str_replace(
            "rel='stylesheet'",
            "rel='preload' as='style' onload=\"this.rel='stylesheet'\"",
            $html
        );
    }
    return $html;
}, 10, 1);




// ✅ Fix delayed icon appearance caused by JS animations
function drake_fix_icon_delay() {
    ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const icons = document.querySelectorAll('.la, .lab, .las, [class*="icon"], [class*="social"]');
            icons.forEach(icon => {
                icon.style.opacity = '1';
                icon.style.visibility = 'visible';
                icon.style.transition = 'none';
            });
        });
    </script>
    <?php
}
add_action('wp_footer', 'drake_fix_icon_delay', 100);
