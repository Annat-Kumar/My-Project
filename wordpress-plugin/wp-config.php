<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */
// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'a572016d_kevin');
/** MySQL database username */
define('DB_USER', 'a572016d_kevin');
/** MySQL database password */
define('DB_PASSWORD', 'D@5BqJh*KBKC');
/** MySQL hostname */
define('DB_HOST', 'localhost');
/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');
/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '=5N>G$yw[ ]En{4{h^G90x`( &F9Ci9>$!bTY]b$x:8-2w)B)@R1~.$8+1{J{v;c');
define('SECURE_AUTH_KEY',  'PjL!K)gFIpYpN@>G)nSO]#ka9cmTe0Z?XZzqeMdl)c^;W:/2QooT|)lZy*%`TF;x');
define('LOGGED_IN_KEY',    '%r|ux}CpuJu2TyI$|unO;!cg=;IT.VZ hs00mAAWbPov6iM~13HB;6X 1lyeg*4{');
define('NONCE_KEY',        'N<quR(@*6n6,Kq#wnz3Rs3~Fed&`9XNr*#+1>k}o/NlAQw7*i=8zT<=XUgW#RtTI');
define('AUTH_SALT',        '%$_^YR7y48/[xP=a#jO@Z=n{7 G-K(Y(Qh**@a>e~ X:aY3/fO0Pu!>Z|Qe3Zm7^');
define('SECURE_AUTH_SALT', 'gkoR?38*)>[R^;C0LN(t!P]ftsW SrVB*weFX~|<&=de!W&Q^MzEHr5c;#(^r b+');
define('LOGGED_IN_SALT',   'Z?QAWf/>pyh%~a4mLEI_4;N~O~1%1g>qg=Nke#/M{w{F6lGPL:X6>eJVyDrjSO?i');
define('NONCE_SALT',       ' ;_-[ZYR3_/`O?is#>pOUl~(Hfi(K37,FS|H0z^x|un>d(QrC{-FCw/<cQ`9/4)9');
/**#@-*/
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';
/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);
/* That's all, stop editing! Happy blogging. */
/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

error_reporting(1);
@ini_set('display_errors', 1);