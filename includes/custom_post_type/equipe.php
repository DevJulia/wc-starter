<?php

add_action( 'init', 'theme_cpt_equipe' );
function theme_cpt_equipe()
{
    $labels = array(
        'name' => 'Equipe',
        'singular_name' => 'Equipe',
        'add_new' => 'Ajouter une personne',
        'add_new_item' => 'Ajouter une nouvelle personne',
        'edit_item' => 'Editer une personne',
        'new_item' => 'Nouvelle personne',
        'view_item' => 'Voir la personne',
        'search_items' => 'Rechercher une personne',
        'not_found' =>  'Aucune personne',
        'not_found_in_trash' => 'Aucune personne dans la corbeille',
        'parent_item_colon' => '',
        'menu_name' => 'Equipe'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'page',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => 5,
        'exclude_from_search' => false,
        'supports' => array('title', 'editor', 'thumbnail', 'page-attributes', 'revisions')
    );

    register_post_type('equipe', $args);

    // On crée une taxonomie permettant de classifier les lieux ci-dessus
    $labels = array(
        'name' =>  'Types',
        'singular_name' => 'Type',
        'search_items' =>  'Rechercher un type',
        'all_items' => 'Tous les types',
        'parent_item' => 'Type parent',
        'parent_item_colon' => 'Type parent,',
        'edit_item' => 'Editer ce type',
        'update_item' => 'Mettre à jour ce type',
        'add_new_item' => 'Ajouter une nouveau type',
        'new_item_name' => 'Nouveau type',
        'menu_name' => 'Types',
    );

    register_taxonomy('equipe_cat', array('equipe'), array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'equipe-cat', 'with_front' => false)
    ));
}

add_filter('manage_equipe_posts_columns', 'theme_equipe_head_columns', 10);
function theme_equipe_head_columns($columns)
{
    $new = [];

    foreach ($columns as $key => $title) {
        if ($key === 'date') {
            $new['equipe_cat'] = 'Type';
        }

        $new[$key] = $title;
    }

    return $new;
}
add_action('manage_equipe_posts_custom_column', 'theme_equipe_content_columns', 10, 2);
function theme_equipe_content_columns($column_name, $post_ID)
{
    if ($column_name === 'equipe_cat') {
        $type = wp_get_post_terms($post_ID, 'equipe_cat');

        if ($type) {
            echo $type[0]->name;
        }
    }
}