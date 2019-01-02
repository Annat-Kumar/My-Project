<?php
/** Enable W3 Total Cache Edge Mode */
define('W3TC_EDGE_MODE', true); // Added by W3 Total Cache
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * @package WordPress
 */
define(‘COOKIE_DOMAIN’, ”);
define(‘COOKIEPATH’, ”);
define(‘SITECOOKIEPATH’, ”);
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'reliable_mig');
/** MySQL database username */
define('DB_USER', 'reliable_mig');
/** MySQL database password */
define('DB_PASSWORD', '3igp~P}M#z1y');
/** MySQL hostname */
define('DB_HOST', 'localhost');
/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');
/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');
/**  Authentication Unique Keys and Salts.
*/
define('AUTH_KEY',         'mP^B~K6?!&aK-.C:O9$Mw7WxA1LS)FW#A%1WFAHe?8<;PEtO:Jyq#SJ7$p}tK0|&');
define('SECURE_AUTH_KEY',  'E7V1AYva.Q-^9i3&!w)A*|2n @2|5-k;FR+rIs0?7x:B9S-C./3a[7%{b/Vlq99N');
define('LOGGED_IN_KEY',    '|?|Zx>,M/H31M|ZuYnoX:*Q|i!S%Jw=)[Cn7Yy[+!B.Km?lw!hrxBi7Cr(Tr|.Z0');
define('NONCE_KEY',        'g;r_rPo@WNb+vVQD.g=jo)#M#pW^ih<fg4S_{|w]0|az/l/)6:TBta}tw{F5C$8U');
define('AUTH_SALT',        'G$ir`kCqzFtQ7m=y|~EmX<(D5F`n7@oY.kU;yj5itdxX4y81p!R[hE&E#+gGDzr#');
define('SECURE_AUTH_SALT', '--/1wmIv!pQ{-@ey?@Xr)7]gx?]Y9L9c.ETt*r_H ^@-VUaP Y89`kqkqQ/TN%[#');
define('LOGGED_IN_SALT',   'yumK5de~q+bwy7!bmYGsa3YCZ~w09AW5S3AItSn?[c!Hz+|F@N@+-=-JHV=5+D+e');
define('NONCE_SALT',       '+U0fx0&b$+18n!R7mqt]4b.~*NAHT3RTaf:UA{dX{Pa2V-SV&/ lk}t:i+qxBO7;');
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';
/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');
/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);
define('WP_ALLOW_MULTISITE', true);
define('WP_MEMORY_LIMIT', '256M');
/* That's all, stop editing! Happy blogging. */
/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
