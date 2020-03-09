<?php

add_action('init', 'theme_tax_product_typology');
function theme_tax_product_typology()
{
    $labels = array(
        'name' =>  'Typologies',
        'singular_name' => 'Typologie',
        'search_items' =>  'Rechercher une typologie',
        'all_items' => 'Toutes les typologie',
        'parent_item' => 'Typologie parent',
        'parent_item_colon' => 'Typoligie parent,',
        'edit_item' => 'Editer cette typologie',
        'update_item' => 'Mettre à jour cette typologie',
        'add_new_item' => 'Ajouter une nouvelle typologie',
        'new_item_name' => 'Nouvelle typologie',
        'menu_name' => 'Typologies',
    );

    register_taxonomy('product_typology', array('product'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'product-typology', 'with_front' => false)
    ));
}
