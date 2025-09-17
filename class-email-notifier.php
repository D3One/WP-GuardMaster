<?php
/**
 * Handles security email notifications
 */
class WP_GuardMaster_Email_Notifier {

	/**
	 * Constructor - adds hooks to WordPress
	 */
	public function __construct() {
		// Hook into our custom action for IP blocking
		add_action( 'wp_guardmaster_ip_blocked', array( $this, 'send_ip_blocked_email' ), 10, 2 );
		// Hook into admin login notifications
		add_action( 'wp_login', array( $this, 'check_admin_login' ), 10, 2 );
	}

	/**
	 * Sends email notification about blocked IP
	 * @param string $blocked_ip The blocked IP address
	 * @param string $username The username used in attempts
	 */
	public function send_ip_blocked_email( $blocked_ip, $username ) {
		$to = get_option( 'wp_guardmaster_admin_email' );
		$subject = __( 'Security Alert: IP Blocked on Your Site', 'wp-guardmaster' );
		
		$message = sprintf(
			__( 'Hello,%sAn IP address has been temporarily blocked on your site %s due to too many failed login attempts.%sDetails:%s- Blocked IP: %s%s- Username used: %s%s- Time of block: %s%s', 'wp-guardmaster' ),
			"\r\n\r\n",
			get_site_url(),
			"\r\n\r\n",
			"\r\n",
			$blocked_ip,
			"\r\n",
			$username,
			"\r\n",
			current_time( 'mysql' ),
			"\r\n\r\n"
		);
		
		wp_mail( $to, $subject, $message );
	}

	/**
	 * Checks if an admin logged in and sends notification
	 * @param string $user_login The user's login name
	 * @param WP_User $user The user object
	 */
	public function check_admin_login( $user_login, $user ) {
		// Check if the user has administrator capabilities
		if ( in_array( 'administrator', (array) $user->roles ) ) {
			$user_ip = $this->get_client_ip();
			$to = get_option( 'wp_guardmaster_admin_email' );
			$subject = __( 'Security Notice: Administrator Login', 'wp-guardmaster' );
			
			$message = sprintf(
				__( 'Hello,%sAn administrator has logged in to your site %s.%sDetails:%s- Username: %s%s- IP Address: %s%s- Login Time: %s%s', 'wp-guardmaster' ),
				"\r\n\r\n",
				get_site_url(),
				"\r\n\r\n",
				"\r\n",
				$user_login,
				"\r\n",
				$user_ip,
				"\r\n",
				current_time( 'mysql' ),
				"\r\n\r\n"
			);
			
			wp_mail( $to, $subject, $message );
		}
	}

	/**
	 * Gets the client's IP address (same as in Login_Limiter)
	 * @return string Sanitized IP address
	 */
	private function get_client_ip() {
		$ip = '';
		
		if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
			$ip_list = explode( ',', $_SERVER['HTTP_X_FORWARDED_FOR'] );
			$ip = trim( $ip_list[0] );
		} elseif ( ! empty( $_SERVER['REMOTE_ADDR'] ) ) {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		
		return filter_var( $ip, FILTER_VALIDATE_IP ) ? $ip : '0.0.0.0';
	}
}
?>
