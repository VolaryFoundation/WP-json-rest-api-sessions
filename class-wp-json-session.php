<?php

class WP_JSON_Session {

	protected $server;

	public function __construct(WP_JSON_ResponseHandler $server) {
		$this->server = $server;
	}

	public function register_routes( $routes ) {
		$session_routes = array(
			'/session' => array(
				array( array( $this, 'get_session' ), WP_JSON_Server::READABLE ),
				array( array( $this, 'new_session' ),  WP_JSON_Server::CREATABLE | WP_JSON_Server::ACCEPT_JSON ),
				array( array( $this, 'delete_session' ),  WP_JSON_Server::DELETABLE )
			)

		);
		return array_merge( $routes, $session_routes );
	}

	public function get_session() {
	  if (!is_user_logged_in()) {
		 return new WP_Error('Not logged in');
	  } else {
		 echo get_currentuserinfo();
	  }
	}

	public function new_session( $creds ) {
		$data = array();
		$data['user_login'] = $creds["user"];
		$data['user_password'] = $creds["password"];
		$data['remember'] = true;
		$user = wp_signon( $data, false );
		if ( is_wp_error($user) ) {
			echo $user->get_error_message();
		}
	}

	public function delete_session() {
		wp_logout();
	}

}

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
