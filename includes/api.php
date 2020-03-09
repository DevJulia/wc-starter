<?php

// Bloque le scan des auteurs, via ?author=1, ?author=2, etc.
if (!is_admin()) {
    // default URL format
    if (isset($_SERVER['QUERY_STRING']) && preg_match('/author=([0-9]*)/i', $_SERVER['QUERY_STRING'])) {
        return new WP_Error( 'access_forbidden', 'Access forbidden.', array( 'status' => 401 ) );
    }
    add_filter('redirect_canonical', 'shapeSpace_check_enum', 10, 2);
}
function shapeSpace_check_enum($redirect, $request) {
    // permalink URL format
    if (preg_match('/\?author=([0-9]*)(\/*)/i', $request)) {
        return new WP_Error( 'access_forbidden', 'Access forbidden.', array( 'status' => 401 ) );
    }
    else return $redirect;
}

// Désactive l'accès à l'API JSON aux utilisateurs non connectés
add_filter('rest_authentication_errors', 'secure_api_access');
function secure_api_access($result)
{
    if ( ! empty( $result ) ) {
        return $result;
    }
    if ( ! is_user_logged_in() ) {
        return new WP_Error( 'rest_not_logged_in', 'You are not currently logged in.', array( 'status' => 401 ) );
    }
    return $result;
}