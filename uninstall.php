<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

/**
 * Remove plugin settings when the plugin is deleted.
 */
delete_option( 'smm_enabled' );
delete_option( 'smm_message' );