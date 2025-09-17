<?php
/**
 * Monitors backup files and sends alerts if they're missing or outdated
 */
class WP_GuardMaster_Backup_Monitor {

	/**
	 * Constructor - adds hooks to WordPress
	 */
	public function __construct() {
		// Hook into our daily event
		add_action( 'wp_guardmaster_daily_event', array( $this, 'check_backups' ) );
	}

	/**
	 * Checks for backups and sends alert if needed
	 */
	public function check_backups() {
		// Define where to look for backups
		$backup_path = defined( 'WP_BACKUP_DIR' ) ? WP_BACKUP_DIR : WP_CONTENT_DIR . '/backups/';
		$max_days_without_backup = 7; // Alert if no backup in 7 days
		
		// Get the latest backup file
		$latest_backup = $this->get_latest_backup( $backup_path );
		
		if ( ! $latest_backup ) {
			// No backups found
			$this->send_backup_alert( __( 'No backup files found in the backup directory.', 'wp-guardmaster' ) );
			return;
		}
		
		// Check how old the backup is
		$backup_time = filemtime( $latest_backup );
		$days_since_backup = floor( ( time() - $backup_time ) / DAY_IN_SECONDS );
		
		if ( $days_since_backup >= $max_days_without_backup ) {
			// Backup is too old
			$message = sprintf(
				__( 'The latest backup is %d days old. Please create a new backup soon.', 'wp-guardmaster' ),
				$days_since_backup
			);
			$this->send_backup_alert( $message );
		}
		
		// Update last check time
		update_option( 'wp_guardmaster_last_backup_check', time() );
	}

	/**
	 * Finds the latest backup file in the specified directory
	 * @param string $backup_dir Directory to search for backups
	 * @return string|bool Path to latest backup file or false if none found
	 */
	private function get_latest_backup( $backup_dir ) {
		if ( ! is_dir( $backup_dir ) ) {
			return false;
		}
		
		$latest_backup = false;
		$latest_time = 0;
		
		// Scan directory for backup files
		$files = scandir( $backup_dir );
		
		foreach ( $files as $file ) {
			$file_path = $backup_dir . '/' . $file;
			
			// Skip directories and non-backup files
			if ( is_dir( $file_path ) || ! preg_match( '/\.(zip|tar|gz|sql)$/i', $file ) ) {
				continue;
			}
			
			// Check if this is the newest file
			$file_time = filemtime( $file_path );
			if ( $file_time > $latest_time ) {
				$latest_time = $file_time;
				$latest_backup = $file_path;
			}
		}
		
		return $latest_backup;
	}

	/**
	 * Sends backup alert email
	 * @param string $message The alert message to include in the email
	 */
	private function send_backup_alert( $message ) {
		$to = get_option( 'wp_guardmaster_admin_email' );
		$subject = __( 'Backup Warning on Your Site', 'wp-guardmaster' );
		
		$email_message = sprintf(
			__( 'Hello,%sThis is a backup alert from your site %s.%sAlert: %s%sPlease check your backup system to ensure your data is properly protected.%s', 'wp-guardmaster' ),
			"\r\n\r\n",
			get_site_url(),
			"\r\n\r\n",
			$message,
			"\r\n\r\n",
			"\r\n"
		);
		
		wp_mail( $to, $subject, $email_message );
	}
}
?>
