<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Handles maintenance mode enforcement.
 */
class SMM_Maintenance {

	/**
	 * Initialize maintenance hooks.
	 *
	 * @return void
	 */
	public static function init() {

		/*
		 * Runs early enough to handle both frontend
		 * and WordPress admin requests.
		 */
		add_action(
			'init',
			array( __CLASS__, 'handle_request' ),
			0
		);

	}


	/**
	 * Determine whether the current request should be blocked.
	 *
	 * @return void
	 */
	public static function handle_request() {

		/**
		 * Maintenance mode disabled.
		 */
		if ( ! self::is_enabled() ) {
			return;
		}


		/**
		 * Administrators have full access while
		 * maintenance mode is active.
		 */
		if ( current_user_can( 'manage_options' ) ) {
			return;
		}


		/**
		 * Keep the standard WordPress login page
		 * available so administrators can authenticate.
		 */
		if (
			isset( $GLOBALS['pagenow'] ) &&
			'wp-login.php' === $GLOBALS['pagenow']
		) {
			return;
		}


		/**
		 * Everyone who is not an administrator is
		 * blocked from the website, including access
		 * to wp-admin.
		 */
		self::send_maintenance_response();

	}


	/**
	 * Check whether maintenance mode is enabled.
	 *
	 * @return bool
	 */
	private static function is_enabled() {

		return (bool) get_option(
			SMM_OPTION_ENABLED,
			false
		);

	}


	/**
	 * Send the HTTP 503 maintenance response.
	 *
	 * @return void
	 */
	private static function send_maintenance_response() {

		/**
		 * Tell clients and search engines that the
		 * site is temporarily unavailable.
		 */
		status_header( 503 );


		/**
		 * Prevent maintenance responses from being
		 * cached by browsers and intermediary caches.
		 */
		nocache_headers();


		/**
		 * Ask clients to retry after approximately
		 * one hour.
		 */
		header( 'Retry-After: 3600' );


		/**
		 * Render the maintenance page.
		 */
		echo SMM_Renderer::render();

		exit;

	}

}