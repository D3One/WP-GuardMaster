<?php
class Login_Limiter {
    public function __construct() {
        add_action('wp_login_failed', array($this, 'track_login_failure')); // Hook into failed login
        add_filter('authenticate', array($this, 'check_ip_lockout'), 30, 3); // Check before auth
    }

    /**
     * Tracks failed login attempts and blocks IPs that exceed the threshold.
     * @param string $username The username used in the failed attempt.
     */
    public function track_login_failure($username) {
        $user_ip = $this->get_client_ip();
        $attempts_limit = get_option('wp_guardmaster_login_attempts', 5);
        $lockout_time = get_option('wp_guardmaster_lockout_time', 900);

        $transient_key = 'wp_guardmaster_failed_' . md5($user_ip); // Use hash for key
        $failed_attempts = get_transient($transient_key);

        if ($failed_attempts === false) {
            set_transient($transient_key, 1, $lockout_time);
        } else {
            $failed_attempts = (int) $failed_attempts + 1;
            set_transient($transient_key, $failed_attempts, $lockout_time);

            if ($failed_attempts >= $attempts_limit) {
                $block_transient_key = 'wp_guardmaster_blocked_' . md5($user_ip);
                set_transient($block_transient_key, 'blocked', $lockout_time);
                // Trigger email alert
                do_action('wp_guardmaster_ip_blocked', $user_ip, $username);
            }
        }
    }

    /**
     * Checks if the attempting IP is currently locked out.
     * @param WP_User|WP_Error|null $user The user object or error.
     * @return WP_User|WP_Error Returns a WP_Error if IP is blocked.
     */
    public function check_ip_lockout($user) {
        $user_ip = $this->get_client_ip();
        $block_transient_key = 'wp_guardmaster_blocked_' . md5($user_ip);

        if (get_transient($block_transient_key) !== false) {
            return new WP_Error('ip_blocked', __('<strong>ERROR</strong>: IP address temporarily locked out due to excessive failed login attempts.', 'wp-guardmaster'));
        }
        return $user;
    }

    /**
     * Gets the client's IP address more reliably.
     * @return string The sanitized IP address.
     */
    private function get_client_ip() {
        $ip = '';
        // Check for shared internet/load balancer IP
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip_array = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $ip = trim($ip_array[0]);
        } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return filter_var($ip, FILTER_VALIDATE_IP) ? $ip : '0.0.0.0';
    }
}
?>
