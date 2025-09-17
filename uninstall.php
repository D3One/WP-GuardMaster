<?php
/**
 * Cleanup when plugin is deleted
 */
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit; // Exit if accessed directly
}

// Delete options
delete_option( 'wp_guardmaster_login_attempts' );
delete_option( 'wp_guardmaster_lockout_time' );
delete_option( 'wp_guardmaster_admin_email' );
delete_option( 'wp_guardmaster_last_backup_check' );

// Clean up transients
global $wpdb;
$wpdb->query( "DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_wp_guardmaster_%'" );
$wpdb->query( "DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_timeout_wp_guardmaster_%'" );
?>
