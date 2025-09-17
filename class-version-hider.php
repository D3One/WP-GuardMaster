<?php
/**
 * Hides WordPress version information for security
 */
class WP_GuardMaster_Version_Hider {

	/**
	 * Constructor - adds hooks to WordPress
	 */
	public function __construct() {
		// Remove WordPress version from core files
		add_filter( 'the_generator', array( $this, 'remove_version' ) );
		
		// Remove version from scripts and styles
		add_filter( 'script_loader_src', array( $this, 'remove_version_from_assets' ) );
		add_filter( 'style_loader_src', array( $this, 'remove_version_from_assets' ) );
	}

	/**
	 * Removes WordPress version from meta tags
	 * @return string Empty string to remove version info
	 */
	public function remove_version() {
		return '';
	}

	/**
	 * Removes version query string from scripts and styles
	 * @param string $src The source URL of the asset
	 * @return string The URL without version query string
	 */
	public function remove_version_from_assets( $src ) {
		if ( strpos( $src, 'ver=' ) ) {
			$src = remove_query_arg( 'ver', $src );
		}
		return $src;
	}
}
?>
