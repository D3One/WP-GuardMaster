<?php
/**
 * Plugin Name: WP GuardMaster
 * Plugin URI:  https://github.com/ivanpiskunov/wp-guardmaster
 * Description: A lightweight security plugin for WordPress offering basic hardening and monitoring.
 * Version:     1.0.0
 * Author:      Ivan Piskunov
 * Author URI:  https://ivanpiskunov.com
 * License:     GPL v3 or later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: wp-guardmaster
 */

// Prevent direct access (security best practice)
defined('ABSPATH') || exit;

// Define constants for easy path referencing
define('WP_GUARDMASTER_PLUGIN_URL', plugin_dir_url(__FILE__));
define('WP_GUARDMASTER_PLUGIN_DIR', plugin_dir_path(__FILE__));

// Autoloader or manual include for classes
require_once WP_GUARDMASTER_PLUGIN_DIR . 'includes/class-login-limiter.php';
require_once WP_GUARDMASTER_PLUGIN_DIR . 'includes/class-email-notifier.php';
require_once WP_GUARDMASTER_PLUGIN_DIR . 'includes/class-backup-monitor.php';
require_once WP_GUARDMASTER_PLUGIN_DIR . 'includes/class-two-factor-auth.php';
require_once WP_GUARDMASTER_PLUGIN_DIR . 'includes/class-file-scanner.php';
require_once WP_GUARDMASTER_PLUGIN_DIR . 'includes/class-version-hider.php';

// Initialize plugin components
function wp_guardmaster_init() {
    new Login_Limiter();
    new Email_Notifier();
    new Backup_Monitor();
    new Two_Factor_Auth();
    new File_Scanner();
    new Version_Hider();
}
add_action('plugins_loaded', 'wp_guardmaster_init');

// Activation Hook: Set default options
function wp_guardmaster_activate() {
    add_option('wp_guardmaster_login_attempts', 5); // OWASP recommends a low threshold
    add_option('wp_guardmaster_lockout_time', 900); // 15 minutes
    add_option('wp_guardmaster_admin_email', get_option('admin_email'));
    add_option('wp_guardmaster_last_backup_check', null);
    // Store current WP version for FIM baseline
    update_option('wp_guardmaster_wp_version', get_bloginfo('version'));

    // Setup custom cron schedules if needed
    if (!wp_next_scheduled('wp_guardmaster_daily_cron')) {
        wp_schedule_event(time(), 'daily', 'wp_guardmaster_daily_cron');
    }
}
register_activation_hook(__FILE__, 'wp_guardmaster_activate');

// Deactivation Hook: Clean up transients and cron jobs
function wp_guardmaster_deactivate() {
    global $wpdb;
    // Delete all IP block transients
    $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_wp_guardmaster_blocked_%'");
    $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_timeout_wp_guardmaster_blocked_%'");

    wp_clear_scheduled_hook('wp_guardmaster_daily_cron');
}
register_deactivation_hook(__FILE__, 'wp_guardmaster_deactivate');
?>
