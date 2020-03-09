<?php

function theme_load_styles() {
    if (!is_admin()) {
        // wp_register_style('slick_css', THEME_URL . '/assets/vendor/slick/slick.css?' . filemtime(THEME_PATH . '/assets/vendor/slick/slick.css'), [], '1.0', 'all');
        // wp_enqueue_style('slick_css');

        //DEV
        wp_register_style('theme_style', THEME_URL . '/assets/build/main.css?' . filemtime(THEME_PATH . '/assets/build/main.css'), [], '1.0', 'all');

        //PROD
        // wp_register_style('theme_style', THEME_URL . '/dist/main.min.css?' . filemtime(THEME_PATH . '/dist/main.min.css'), [], '1.0', 'all');
        
        wp_enqueue_style('theme_style');

        wp_enqueue_style( 'wpb-google-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700', false );
    }
}

add_action('wp_enqueue_scripts', 'theme_load_styles', 99);