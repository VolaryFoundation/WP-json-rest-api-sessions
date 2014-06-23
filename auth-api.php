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

//==========================================================================//
// This file is part of JSON Rest API Sessions.                             //
//                                                                          //
// JSON Rest API Events is Copyright 2014 Volary Foundation and             //
// Contributors                                                             //
//                                                                          //
// JSON Rest API Sessions is free software: you can redistribute it and/or  //
// modify it under the terms of the GNU Affero General Public License as    //
// published by the Free Software Foundation, either version 3 of the       //
// License, or  at your option) any later version.                          //
//                                                                          //
// JSON Rest API Sessions is distributed in the hope that it will be useful,//
// but  WITHOUT ANY WARRANTY; without even the implied warranty of          //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU        //
// Affero General Public License for more details.                          //
//                                                                          //
// You should have received a copy of the GNU Affero General Public         //
// License along with JSON Rest API Events.  If not, see                    //
// <http://www.gnu.org/licenses/>.                                          //
//==========================================================================//
