wp-guardmaster/
│
├── wp-guardmaster.php              # Main plugin file, metadata, loader
├── includes/                        # PHP Classes
│   ├── class-login-limiter.php
│   ├── class-email-notifier.php
│   ├── class-backup-monitor.php
│   ├── class-two-factor-auth.php
│   ├── class-file-scanner.php
│   ├── class-version-hider.php
│   └── class-security-log.php      # For future logging feature
├── assets/
│   ├── js/
│   │   └── 2fa.js                  # Client-side logic for 2FA
│   └── css/
│       └── admin.css               # Styles for admin UI
├── templates/
│   └── email-alert.php             # HTML email template
├── vendor/                         # For Composer dependencies (e.g., 2FA library)
└── uninstall.php                   # Cleanup script
