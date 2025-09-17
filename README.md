# WP GuardMaster 🛡️

![WordPress](https://img.shields.io/badge/WordPress-%23FFF?logo=wordpress&logoColor=117AC9)
![PHP](https://img.shields.io/badge/PHP-%23FFF?logo=php&logoColor=777BB4)
![License: GPL v3](https://img.shields.io/badge/License-GPLv3-blue.svg)
![Educational Project](https://img.shields.io/badge/Project%20Type-Educational-lightgrey)

**WP GuardMaster** is a feature-rich, conceptual WordPress security plugin developed as an educational pet project. It demonstrates core principles of web application security, specifically within the WordPress ecosystem, by implementing several essential hardening and monitoring features.

This project is created by **Ivan Piskunov** for educational demonstration, to illustrate security concepts for students and to serve as a learning tool for secure WordPress development practices.

> **⚠️ Important Disclaimer: This is NOT a production-ready security solution.**
> This plugin was developed for **educational and self-learning purposes only**. It is intended to demonstrate security concepts and should not be relied upon to protect live websites. Always use professionally developed and maintained security solutions for any production environment.

<img width="1664" height="928" alt="image" src="https://github.com/user-attachments/assets/3084ab06-85c0-41a2-91ee-ae1c5e213913" />

## 🚀 Project Goals

*   **Educational Tool:** To serve as a practical example for students and developers learning about WordPress plugin development and web application security (OWASP Top 10 principles) .
*   **Concept Demonstration:** To demonstrate how key security features (like brute force protection, monitoring, and hardening) can be implemented structurally in WordPress.
*   **Best Practices Showcase:** To illustrate coding standards, WordPress hooks, and security-aware development practices within the WordPress plugin architecture .

## ✨ Features

WP GuardMaster implements several foundational security features:

*   **Brute Force Login Protection:** Limits failed login attempts from a single IP address using WordPress Transients API to temporarily block malicious actors .
*   **Email Notifications:** Alerts the site administrator via email upon events like IP lockout and successful admin logins (for oversight).
*   **Backup Monitoring:** Checks for the existence and freshness of backup files in a specified directory and sends warnings if backups are outdated or missing.
*   **Two-Factor Authentication (2FA):** (Planned feature) Adds an extra layer of security to the WordPress login process for administrators, a highly recommended practice .
*   **File Integrity Monitoring (FIM):** (Basic Implementation) Scans core WordPress files for unauthorized modifications by comparing against known hashes.
*   **WordPress Version Hiding:** Removes the WordPress version number from generated pages and feeds to reduce the attack surface (security through obscurity).

## 📁 Project Structure

```
wp-guardmaster/
├── wp-guardmaster.php              # Main plugin file. Contains metadata, header comment, and initializes all components.
├── includes/                       # Directory containing all primary PHP classes for functionality.
│   ├── class-login-limiter.php     # Handles login attempt limiting and IP blocking.
│   ├── class-email-notifier.php    # Manages templating and sending of email alerts.
│   ├── class-backup-monitor.php    # Contains logic for checking backup files and their dates.
│   ├── class-two-factor-auth.php   # (Planned) Handles 2FA setup and validation.
│   ├── class-file-scanner.php      # Scans core files for changes (File Integrity Monitoring).
│   ├── class-version-hider.php     # Removes WordPress version metadata.
│   └── class-security-log.php      # (Planned) For logging security events to a custom database table.
├── assets/
│   ├── js/
│   │   └── script.js               # Client-side JavaScript (e.g., for 2FA AJAX interactions).
│   └── css/
│       └── style.css               # Styles for any admin-facing elements.
├── templates/
│   └── email-alert.php             # HTML template for security alert emails.
├── uninstall.php                   # Script to clean up options and database tables upon plugin deletion.
└── README.md                       # This file.
```

## ⚙️ Installation

1.  Download the ZIP archive of this repository.
2.  In your WordPress admin dashboard, navigate to **Plugins > Add New**.
3.  Click **Upload Plugin** and choose the downloaded ZIP file.
4.  Click **Install Now** and then **Activate the Plugin**.
5.  The plugin will set default options upon activation. Configuration is intended to be done directly within the code for this educational version.

## 🛡️ Important Disclaimer & Warning

**This software is provided for educational purposes only.** It is a demonstration project and should be considered a **supplementary security measure, not a comprehensive solution**.

*   **No Warranty:** The author, **Ivan Piskunov**, is not responsible for any damages resulting from the use of this software.
*   **Not for Production:** This plugin is **not designed or tested for production environments**. Using it on a live site is **not recommended** and is done at your own risk.
*   **No Guarantee of Protection:** This code does not guarantee 100% protection for your website. Sophisticated attacks may bypass these measures.
*   **Potential Errors:** As a pet project, the code may contain unintentional errors, bugs, or security flaws. It should be thoroughly reviewed and tested in a safe, isolated environment (e.g., a local development or staging site) before any experimental use.
*   **Use Professional Solutions:** For production websites, always rely on professionally developed, widely-audited, and regularly updated security plugins from established providers.

## 📜 License

This project is licensed under the **GNU General Public License v3.0**. This is the standard license for WordPress plugins, ensuring freedom to use, study, share, and modify.

See the [LICENSE](LICENSE) file for full details.

## 🔬 Learning Resources & Best Practices

This project draws inspiration from and aims to adhere to security best practices outlined by authoritative sources:

*   **OWASP Top 10:** A standard awareness document for web application security risks. WP GuardMaster touches on A02 (Cryptographic Failures - via 2FA), A05 (Security Misconfiguration), and A07 (Identification and Authentication Failures) .
*   **WordPress Developer Handbook: Security:** The official guide to writing secure WordPress code, covering data validation, escaping, and nonces .
*   **WordPress Hardening:** The WordPress.org team's guide to securing your WordPress installation.

## 🏆 Inspiration & Industry Standards

This educational project was inspired by and aims to emulate the core concepts behind professional, industry-leading WordPress security plugins such as:

*   **[Wordfence Security](https://www.wordfence.com/):** Renowned for its robust endpoint firewall and malware scanner. It's a prime example of a comprehensive, all-in-one security solution for WordPress .
*   **[Sucuri Security](https://sucuri.net/):** Known for its powerful website firewall (WAF), incident response, and malware cleanup services. It exemplifies the DNS-level firewall approach .
*   **All In One WP Security & Firewall:** A strong free plugin that uses a points-based grading system to help users improve their site's security posture, much like the conceptual approach here .

## 🤝 Contributing

As this is primarily a personal educational project, large-scale contributions are not expected. However, constructive feedback, suggestions for improving code clarity for educational purposes, or fixes for glaring issues are welcome through GitHub Issues and Pull Requests. Please ensure any code follows WordPress coding standards and security best practices.

---

**Created by Ivan Piskunov | Cybersecurity Expert, Lecturer** (c)
