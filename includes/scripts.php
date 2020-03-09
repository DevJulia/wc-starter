<?php

add_action('wp_enqueue_scripts', 'theme_load_scripts', 99);
function theme_load_scripts() {
    if( !is_admin()) {
        // JS
        // wp_register_script('slick_js', THEME_URL . '/assets/vendor/slick/slick.min.js?' . filemtime(THEME_PATH . '/assets/vendor/slick/slick.min.js'), ['jquery'], '1.0', true);
        // wp_enqueue_script('slick_js');
        wp_deregister_script('jquery');
		wp_register_script('jquery',THEME_URL . '/assets/vendor/jquery/jquery-3.4.1.min.js?' . filemtime(THEME_PATH . '/assets/vendor/jquery/jquery-3.4.1.min.js'), '1.0', true);
		wp_enqueue_script('jquery');

        //DEV
        wp_register_script('theme_script', THEME_URL . '/assets/build/main.js?' . filemtime(THEME_PATH . '/assets/build/main.js'), ['jquery'], '1.0', true);

        //PROD
        // wp_register_script('theme_script', THEME_URL . '/dist/main.min.js?' . filemtime(THEME_PATH . '/dist/main.min.js'), ['jquery'], '1.0', true);

        wp_enqueue_script('theme_script');

        wp_localize_script('theme_script', 'mantion', [
            'ajaxurl' => admin_url('admin-ajax.php')
        ]);        
    }
}
