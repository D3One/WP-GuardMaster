<?php
/**
 * HTML template for security alert emails
 * Variables passed in: $alert_type, $site_url, $details, $time
 */
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title><?php echo esc_html( $alert_type ); ?> - Security Alert</title>
</head>
<body>
	<div style="max-width: 600px; margin: 0 auto; font-family: Arial, sans-serif;">
		<h2 style="color: #d63638;">Security Alert: <?php echo esc_html( $alert_type ); ?></h2>
		
		<p>Your site <strong><?php echo esc_url( $site_url ); ?></strong> has generated a security alert.</p>
		
		<div style="background-color: #f0f0f1; padding: 15px; margin: 15px 0;">
			<h3 style="margin-top: 0;">Alert Details:</h3>
			<p><?php echo wp_kses_post( $details ); ?></p>
			<p><strong>Time:</strong> <?php echo esc_html( $time ); ?></p>
		</div>
		
		<p>Please review this activity and take appropriate action if necessary.</p>
		
		<hr style="border: 0; border-top: 1px solid #ccc; margin: 20px 0;">
		
		<footer>
			<p style="color: #666; font-size: 12px;">
				This is an automated message from the WP GuardMaster security plugin on <?php echo esc_url( get_site_url() ); ?>.
			</p>
		</footer>
	</div>
</body>
</html>
