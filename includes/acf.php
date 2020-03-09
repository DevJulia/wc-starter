<?php

/**`
 * Permet de sauvegarder les champs ACF dans un fichier JSON versionné
 */
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
function my_acf_json_save_point($path)
{
    $path = get_stylesheet_directory() . '/includes/acf-json';

    return $path;
}

add_filter('acf/settings/load_json', 'my_acf_json_load_point');
function my_acf_json_load_point($path)
{
    $path = [];
    $path[] = get_stylesheet_directory() . '/includes/acf-json';

    return $path;
}


/**
 * Pages d'options
 */
if ( function_exists('acf_add_options_page') ) {

    acf_add_options_page('Accueil');
    acf_add_options_page('Footer');

}

// Fix bug qui ajoute un anti-slash sur les pages d'options
add_action('acf/save_post', 'my_acf_save_post', 1);
function my_acf_save_post($post_id)
{
    if ($post_id === 'options') {
        $_POST = stripslashes_deep($_POST);
    }
}