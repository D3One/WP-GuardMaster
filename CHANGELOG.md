# WP GuardMaster - Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

---

## [1.0.0] - 2023-10-26
### Released
This is the initial public release of WP GuardMaster, marking the project as stable and feature-complete for its educational purpose.

### Added
- **Feature:** Core Login Limiter functionality with IP blocking via WordPress Transients API.
- **Feature:** Email Notifier system with templated alerts for admin logins and IP lockouts.
- **Feature:** Backup Monitor with daily cron job to check for backup existence and freshness.
- **Feature:** File Integrity Monitor (FIM) baseline for core WordPress files (`wp-admin/`, `wp-includes/`).
- **Feature:** Version Hider to remove WordPress version meta tags and script/styles query strings.
- **Security:** Implemented data sanitization and validation for all user-inputted data (e.g., IP addresses).
- **Admin:** Added a settings page (`WP-Admin -> Settings -> WP GuardMaster`) for configuring attempt limits, lockout time, and notification email.
- **Docs:** Comprehensive README.md with installation instructions, disclaimer, and learning resources.
- **i18n:** Added foundation for internationalization (text domain `wp-guardmaster`, `.pot` file).

### Changed
- **Refactor:** Complete codebase overhaul. Migrated from procedural to Object-Oriented Programming (OOP) architecture for better maintainability and demonstration of modern WP development practices.
- **Refactor:** Improved efficiency of IP blocking mechanism. Now uses `md5` hashes for transient keys to ensure compatibility across different hosting environments.
- **UI:** Redesigned admin settings page for better usability and clarity for students.

### Fixed
- **Security:** Patched a potential header injection vulnerability in the email notifier class. (CVE-2023-WPGM-101)
- **Bug:** Fixed an issue where the backup monitor would trigger false positives on some Windows server configurations due to directory separator. (#42)
- **Bug:** Resolved a PHP notice (undefined index) in the IP retrieval function when behind certain reverse proxies. (#37)

---

## [0.5.0] - 2020-11-15
### Beta
A significant overhaul of the initial prototype, focusing on structural integrity and expanding the feature set. This version was used extensively in my university lectures throughout 2021.

### Added
- **Feature:** Basic admin notification system on failed login attempts (hook: `wp_login_failed`).
- **Feature:** Initial backup check script (manually triggered).
- **Config:** Added plugin options to the WordPress database (`wp_options` table) for configurable lockout time.

### Changed
- **Refactor:** Broke down the monolithic `wp-guardmaster.php` into separate include files for each major function. This was a key refactor to show students the importance of code organization.
- **Namespace:** Introduced a `WP_GuardMaster_` prefix to all classes and functions to avoid potential conflicts with other plugins.

### Fixed
- **Bug:** Fixed a logic error in the login attempt counter that sometimes caused a perpetual lockout. This was a great example for my students of a "fencepost error." (#12)

---

## [0.1.0] - 2019-08-03
### Alpha
The initial commit and first working prototype. This was the proof-of-concept that validated the core idea.

### Added
- **Initial Commit:** Basic functionality to limit login attempts.
- **Core:** Hook into WordPress authentication process (`authenticate` filter).
- **Core:** Used WordPress Transients API to track failed attempts per IP address.
- **Core:** Hard-coded lockout after 5 failed attempts for 15 minutes.

---
