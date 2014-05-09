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