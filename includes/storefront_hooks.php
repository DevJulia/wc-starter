<?php
/**
 * Surcharge de fonctions ou des hooks du thème Storefront
 */

add_action('init', function() {
    /*
    remove_action( 'storefront_post_content_before', 'storefront_post_thumbnail', 10 );

    remove_action( 'storefront_single_post_bottom', 'storefront_post_taxonomy', 5 );
    remove_action( 'storefront_single_post_bottom', 'storefront_post_nav', 10 );
    remove_action( 'storefront_single_post_bottom', 'storefront_display_comments', 20 );

    remove_action( 'storefront_before_content', 'woocommerce_breadcrumb', 10 );
    remove_action( 'storefront_before_content', 'woocommerce_breadcrumb', 10 );
    */
});


// Supprime la sidebar
add_action('get_header', 'remove_storefront_sidebar');
function remove_storefront_sidebar()
{
    remove_action('storefront_sidebar', 'storefront_get_sidebar', 10);

    return;

    if (is_woocommerce()) {
        remove_action('storefront_sidebar', 'storefront_get_sidebar', 10);
    }
}


if ( ! function_exists( 'storefront_post_header' ) ) {
    /**
     * Display the post header with a link to the single post
     *
     * @since 1.0.0
     */
    function storefront_post_header() {
        ?>
        <header class="entry-header">
            <?php
            if ( is_single() ) {
                the_title( '<h1 class="entry-title">', '</h1>' );
                ?>
                <div class="entry-metas">
                    <?php storefront_post_meta(); ?>
                </div>
                <?php
            } else {
                if ( 'post' === get_post_type() ) {
                    storefront_post_meta();
                }

                the_title( sprintf( '<h2 class="alpha entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
            }
            ?>
        </header><!-- .entry-header -->
        <?php
    }
}