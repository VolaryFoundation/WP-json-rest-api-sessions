<?php

/**
 * Plugin Name: session-api
 * Description: JSON-based REST API for WordPress, developed as part of GSoC 2013.
 * Author: Ryan McCue
 * Author URI: http://ryanmccue.info/
 * Version: 0.9
 * Plugin URI: https://github.com/rmccue/WP-API
 */

function session_api_init( $server ) {
    global $session_api;
    require_once dirname( __FILE__ ) . '/class-wp-json-session.php';
    $session_api = new WP_JSON_Session( $server );
    add_filter( 'json_endpoints', array( $session_api, 'register_routes' ), 0 );
}

add_action( 'wp_json_server_before_serve', 'session_api_init' );