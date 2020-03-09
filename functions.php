<?php

if (file_exists(__DIR__.'/vendor/autoload.php')) {
    require __DIR__.'/vendor/autoload.php';
}

/* Constantes */
define('THEME_PATH', get_stylesheet_directory());
define('THEME_URL', get_stylesheet_directory_uri());

/* Chargements des scripts CSS et JS */
require_once 'includes/scripts.php';
require_once 'includes/styles.php';


/* Chargements des CPT & taxonomies */
//require_once 'includes/custom_post_type/equipe.php';
//require_once 'includes/taxonomy/product_typology.php';

require_once 'includes/storefront_hooks.php';
require_once 'includes/api.php';
require_once 'includes/acf.php';
require_once 'includes/woocommerce.php';
